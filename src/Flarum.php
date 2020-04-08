<?php
namespace Maicol07\SSO;

use Delight\Cookie\Cookie;

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

    /* @var bool  */
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
    public function __construct(string $url, string $root_domain, string $api_key, string $password_token, int $lifetime=14, bool $insecure=false)
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
    public function login(string $username, string $email, string $password=null, array $groups=null)
    {
        if (empty($password)) {
            $password = $this->createPassword($username);
        }
        $token = $this->getToken($username, $password);

        if (empty($token)) {
            $signed_up = $this->signup($username, $password, $email);
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
    public function setGroups(string $username, $groups) {
    	if (is_null($groups)) {
    		return;
	    }
	    $user = $this->api->users($username)->request();
	    if (!empty($user->id)) {
	    	$group_names = [];
	    	// Check if user is admin
		    if ($user->relationships['groups'][1]->id == 1) {
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
					    'id'   => $group->id
				    ];
				    unset($groups[array_search($group->attributes['nameSingular'], $groups)]);
			    }
		    }

		    // Create groups not found
		    foreach ($groups as $group) {
		    	$id = $this->createGroup($group);
			    $group_names[] = [
				    'type' => 'groups',
				    'id'   => $id
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
    public function removeGroups(string $username) {
    	$this->setGroups($username, []);
    }

	/**
	 * Add a group to Flarum
	 *
	 * @param string $group
	 *
	 * @return mixed
	 */
    public function createGroup(string $group) {
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
	 * @return bool
	 */
	private function signup(string $username, string $password, string $email)
	{
		$data = [
			"type" => "users",
			"attributes" => [
				"username" => $username,
				"password" => $password,
				"email" => $email,
			]
		];

		$user = $this->api->users(null)->post($data)->request();

		return isset($user->id);
	}

	/**
	 * Deletes a user from Flarum database. Generally, you should use this method when an user successfully deleted
	 * his account from your SSO system (or main website)
	 *
	 * @param string $username
	 */
	public function delete(string $username) {
		// Logout the user
		$this->logout();
		$user = $this->api->users($username);
		if (!empty($user->id)) {
			$this->api->users($user->id)->delete()->request();
		}
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
     * @author maicol07
     * @return string
     */
    public function getForumLink() {
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

        $json = $this->api->getRest()->post($this->url . '/api/token', ['json' => $data])->getBody()->getContents();
        $response = json_decode($json);

        return isset($response->token) ? $response->token : '';
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
