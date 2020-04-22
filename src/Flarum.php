<?php /** @noinspection PhpUndefinedMethodInspection */

namespace Maicol07\SSO;

use Delight\Cookie\Cookie;
use GuzzleHttp\Exception\ClientException;

/**
 * Flarum SSO
 *
 * @author fabwu
 * @author maicol07
 * @package src
 */
class Flarum
{
	/* @var Cookie */
	private $cookie;

	/* @var string Flarum URL */
	private $url;

	/* @var string Main site or SSO system domain */
	private $root_domain;

	/* @var \Flagrow\Flarum\Api\Flarum Api client */
	private $api;

	/* @var string Random token to create passwords */
	private $password_token;

	/* @var int How many days should the login be valid */
	private $lifetime;

	/* @var bool */
	private $insecure;

	/**
	 * Flarum constructor
	 *
	 * @param string $url Flarum URL
	 * @param string $root_domain Main site or SSO system domain
	 * @param string $api_key Random key from the api_keys table of your Flarum forum
	 * @param string $password_token Random token to create passwords
	 * @param int $lifetime How many days should the login be valid
	 * @param bool $insecure Insecure mode (use only if you don't have an SSL certificate)
	 */
	public function __construct(string $url, string $root_domain, string $api_key, string $password_token, int $lifetime = 14, bool $insecure = false)
	{
		// Urls
		$this->url = $url;
		$url = parse_url($root_domain);
		if (!empty($url['host'])) {
			$root_domain = $url['host'];
		}
		$this->root_domain = $root_domain;
		$this->password_token = $password_token;

		// Api client
		$options = [];
		if ($insecure) {
			$options['verify'] = false;
		}
		$this->api = new \Flagrow\Flarum\Api\Flarum($this->url, ['token' => $api_key], $options);

		$this->cookie = new Cookie('flarum_remember');
		$this->lifetime = $lifetime;
	}

	/**
	 * Logs the user in Flarum. Generally, you should use this method when an user successfully log into
	 * your SSO system (or main website). If user is already signed up in Flarum database (not signed up with this
	 * extension) you need to pass plain user password as third parameter (for example Flarum admin)
	 * You can also set groups to your users with an array
	 *
	 * @param string $username
	 * @param string $email
	 * @param string|null $password
	 * @param array|null $groups
	 *
	 * @return string
	 */
	public function login(string $username, string $email, string $password = null, $groups = null)
	{
		if (empty($password)) {
			$password = $this->createPassword($username);
		}
		$token = $this->getToken($username, $password);
		// Backward compatibility: search for existing user
		$users = $this->getUserslist();
		if (empty($token) and in_array($username, $users)) {
			$password = $this->createPassword($username);
			$token = $this->getToken($username, $password);
		}

		if (empty($token)) {
			$signed_up = $this->signup($username, $password, $email, $groups);
			if (!$signed_up) {
				return false;
			}
			$token = $this->getToken($username, $password);
		}

		$this->setGroups($username, $groups);

		return $this->setCookie($token, time() + $this->getLifetimeSeconds());
	}

	/**
	 * Sets groups to a user
	 *
	 * @param string $username
	 * @param array|null $groups
	 */
	public function setGroups(string $username, $groups)
	{
		if (is_null($groups)) {
			return;
		}
		$user = $this->api->users($username)->request();
		if (!empty($user->id)) {
			$group_names = [];
			// Check if user is admin
			$user_groups = $user->relationships['groups'];
			if (!empty($user_groups) and $user_groups[1]->id == 1) {
				$group_names[] = [
					'type' => 'groups',
					'id' => 1
				];
			}

			$flarum_groups = $this->api->groups(null)->request();
			foreach ($flarum_groups->items as $group) {
				if (in_array($group->attributes['nameSingular'], $groups)) {
					$group_names[] = [
						'type' => 'groups',
						'id' => $group->id
					];
					unset($groups[array_search($group->attributes['nameSingular'], $groups)]);
				}
			}

			// Create groups not found
			foreach ($groups as $group) {
				if (empty($group) or !is_string($group)) {
					return;
				}
				$id = $this->createGroup($group);
				$group_names[] = [
					'type' => 'groups',
					'id' => $id
				];
			}

			$this->api->users($user->id)->patch([
				'relationships' => [
					'groups' => [
						'data' => $group_names
					],
				],
			])->request();
		}
	}

	/**
	 * Removes any group from a user.
	 *
	 * @param string $username
	 */
	public function removeGroups(string $username)
	{
		$this->setGroups($username, []);
	}

	/**
	 * Add a group to Flarum
	 *
	 * @param string $group
	 *
	 * @return mixed
	 */
	public function createGroup(string $group)
	{
		$response = $this->api->groups(null)->post([
			'type' => 'groups',
			'attributes' => [
				'namePlural' => $group,
				'nameSingular' => $group
			]
		])->request();
		return $response->id;
	}

	/**
	 * Logs out the user from Flarum. Generally, you should use this method when an user successfully logged out from
	 * your SSO system (or main website)
	 */
	public function logout()
	{
		// Delete the flarum session cookie to logout from Flarum
		$flarum_cookie = new Cookie('flarum_session');
		$url = parse_url($this->url);
		$flarum_cookie->setDomain($url['host']);
		$flarum_cookie->setPath($url['path']);
		$flarum_cookie->setHttpOnly(true);
		$flarum_cookie->setSecureOnly(true);
		$flarum_cookie->delete();
		// Delete the plugin cookie
		return $this->cookie->delete();
	}

	/**
	 * Sign up user in Flarum. Generally, you should use this method when an user successfully log into
	 * your SSO system (or main website) and you found out that user don't have a token (because he hasn't an account on Flarum)
	 *
	 * @param string $username
	 * @param string $password
	 * @param string $email
	 * @param array|null $groups
	 * @return bool
	 */
	private function signup(string $username, string $password, string $email, $groups = null)
	{
		$data = [
			"type" => "users",
			"attributes" => [
				"username" => $username,
				"password" => $password,
				"email" => $email,
			]
		];

		try {
			$user = $this->api->users(null)->post($data)->request();
			$this->setGroups($username, $groups);
			return isset($user->id);
		} catch (ClientException $e) {
			if ($e->getResponse()->getReasonPhrase() == "Unprocessable Entity") {
				return null;
			}
			throw $e;
		}
	}

	/**
	 * Deletes a user from Flarum database. Generally, you should use this method when an user successfully deleted
	 * his account from your SSO system (or main website)
	 *
	 * @param string $username
	 */
	public function delete(string $username)
	{
		// Logout the user
		$this->logout();
		$user = $this->api->users($username);
		if (!empty($user->id)) {
			$this->api->users($user->id)->delete()->request();
		}
	}

	/**
	 * Updates a user. Warning! User needs to be find with username or email, so one of those two has to be the old one
	 *
	 * @param string $username Old/new username. Username will be changed if email matches the one in Flarum database,
	 * else it will be used to find the user ID
	 * @param string $email Old/new email. Email will be changed if username matches the one in Flarum database,
	 * else it will be used to find the user ID
	 * @param string|null $password New password (changes old password to this one)
	 */
	public function update(string $username, string $email, string $password = null)
	{
		// Get user ID
		$users = $this->getUsersList(true);
		$id = null;
		foreach ($users as $user) {
			if ($user->attributes['username'] == $username or $user->attributes['email'] == $email) {
				$id = $user->id;
			}
		}
		// Update username and email
		$this->api->users($id)->patch([
			'attributes' => [
				'username' => $username,
				'email' => $email,
				'password' => $password
			]
		])->request();
	}

	/**
	 * Redirects the user to your Flarum instance
	 */
	public function redirectToForum()
	{
		header('Location: ' . $this->url);
		die();
	}

	/**
	 * Returns Flarum link
	 *
	 * @return string
	 * @author maicol07
	 */
	public function getForumLink()
	{
		return $this->url;
	}


	/**
	 * Generates a password based on username and password token
	 *
	 * @param string $username
	 * @return string
	 */
	private function createPassword(string $username)
	{
		return hash('sha256', $username . $this->password_token);
	}

	/**
	 * Get user token from Flarum (if user exists)
	 *
	 * @param string $username
	 * @param string|null $password
	 * @return string
	 */
	private function getToken(string $username, string $password)
	{
		$data = [
			'identification' => $username,
			'password' => $password,
			'lifetime' => $this->getLifetimeSeconds(),
		];

		try {
			$json = $this->api->getRest()->post($this->url . '/api/token', ['json' => $data])->getBody()->getContents();
			$response = json_decode($json);

			return isset($response->token) ? $response->token : '';
		} catch (ClientException $e) {
			if ($e->getResponse()->getReasonPhrase() == "Unauthorized") {
				return null;
			}
			throw $e;
		}
	}

	/**
	 * Gets the list of the users actually signed up on Flarum, with all the properties
	 *
	 * @param null|string $filter If set, returns the full users list (with other info) and not only the usernames
	 * Can be one of the following: type, id, attributes, attributes.username, attributes.displayName,
	 * attributes.avatarUrl, attributes.joinTime, attributes.discussionCount, attributes.commentCount,
	 * attributes.canEdit, attributes.canDelete, attributes.lastSeenAt, attributes.isEmailConfirmed, attributes.email,
	 * attributes.markedAllAsReadAt, attributes.unreadNotificationCount, attributes.newNotificationCount,
	 * attributes.preferences, attributes.canSuspend, attributes.bio, attributes.newFlagCount,
	 * attributes.canViewRankingPage, attributes.Points, attributes.canPermanentNicknameChange, attributes.canEditPolls,
	 * attributes.canStartPolls, attributes.canSelfEditPolls, attributes.canVotePolls, attributes.cover,
	 * attributes.cover_thumbnail, relationships, relationships.groups
	 *
	 * There could be more if you have other extensions that adds them to Flarum API
	 *
	 * @return array|Collection
	 */
	public function getUsersList($filter = null)
	{
		$offset = 0;
		$list = collect();

		while ($offset !== null) {
			$response = $this->api->users(null)->offset($offset)->request();
			if ($response instanceof Item and empty($response->type)) {
				$offset = null;
				continue;
			}

			$list = $list->merge($response->collect()->all());
			$offset = array_key_last($list->all()) + 1;
		}

		return empty($filter) ? $list : $list->pluck($filter)->all();
	}

	/**
	 * Set Flarum auth cookie
	 *
	 * @param string $token
	 * @param int $time
	 * @return bool
	 */
	private function setCookie(string $token, int $time)
	{
		$this->cookie->setValue($token);
		$this->cookie->setExpiryTime($time);
		$this->cookie->setDomain($this->root_domain);
		return $this->cookie->save();
	}

	/**
	 * Get Token lifetime in seconds
	 *
	 * @return float|int
	 */
	private function getLifetimeSeconds()
	{
		return $this->lifetime * 60 * 60 * 24;
	}
}
