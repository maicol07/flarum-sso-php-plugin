<?php


namespace Maicol07\SSO\Traits;

use Delight\Cookie\Cookie;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Maicol07\Flarum\Api\Resource\Item;
use Maicol07\SSO\Flarum;

trait Basic
{
    /** @var Flarum */
    private $parent;
    
    /**
     * Deletes a user from Flarum database. Generally, you should use this method when an user successfully deleted
     * his account from your SSO system (or main website)
     *
     * @param string $username
     */
    public function delete(string $username): void
    {
        $this->hooks->do_action('before_delete', $username);
        // Logout the user
        $this->logout();
        $user = $this->api->users($username)->request();
        if (!empty($user->id)) {
            $this->api->users($user->id)->delete()->request();
            $this->hooks->do_action('after_delete', $username);
        }
    }
    
    /**
     * Logs out the user from Flarum. Generally, you should use this method when an user successfully logged out from
     * your SSO system (or main website)
     */
    public function logout(): bool
    {
        $this->hooks->do_action('before_logout');
        
        // Delete the flarum session cookie to logout from Flarum
        $url = parse_url($this->url);
        $flarum_cookie = new Cookie('flarum_session');
        $flarum_cookie->setDomain($this->root_domain)
            ->setPath(Arr::get($url, 'path'))
            ->setHttpOnly(true)
            ->setSecureOnly(true)
            ->delete();
        
        // Delete the plugin cookie
        $done = $this->cookie->delete();
        
        $this->hooks->do_action('after_logout', $done);
        
        return $done;
    }
    
    /**
     * Logs the user in Flarum. Generally, you should use this method when an user successfully log into
     * your SSO system (or main website). You can also set groups to your users with an array
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
        $this->hooks->do_action('before_login', $username, $email, $password, $groups);
        
        if (empty($password)) {
            $password = $this->createPassword($username);
        }
        $token = $this->getToken($username, $password);
        
        $this->hooks->do_action('after_token_obtained', $username, $email, $password, $groups, $token);
        
        // Backward compatibility: search for existing user
        try {
            $this->api->users($username)->request();
            if (empty($token)) {
                $password = $this->createPassword($username);
                $token = $this->getToken($username, $password);
            }
        } catch (ClientException $e) {
            // If user is not signed up in Flarum
            if ($e->getCode() === 404 and $e->getResponse()->getReasonPhrase() === "Not Found") {
                $signed_up = $this->signup($username, $password, $email, $groups);
                if (!$signed_up) {
                    return false;
                }
                $this->hooks->do_action('after_signup', $username, $email, $password, $groups);
                $token = $this->getToken($username, $password);
            } else {
                throw $e;
            }
        }
    
        $this->hooks->do_action('after_login', $username, $email, $password, $groups, $token);
    
        // Save cookie
        return $this->cookie->setValue($token)
            ->setExpiryTime(time() + $this->getLifetimeSeconds())
            ->setDomain($this->root_domain)
            ->save();
    }
    
    /**
     * Generates a password based on username and password token
     *
     * @param string $username
     * @return string
     */
    private function createPassword(string $username): string
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
    private function getToken(string $username, string $password): ?string
    {
        $data = [
            'identification' => $username,
            'password' => $password,
            'lifetime' => $this->getLifetimeSeconds(),
        ];
        
        try {
            $response = $this->api->token()->post($data)->request();
            return $response->token ?? '';
        } catch (ClientException $e) {
            if ($e->getResponse()->getReasonPhrase() === "Unauthorized") {
                return null;
            }
            throw $e;
        }
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
    private function signup(string $username, string $password, string $email, $groups = null): ?bool
    {
        $this->hooks->do_action('before_signup', $username, $email, $password, $groups);
        $data = [
            "type" => "users",
            "attributes" => [
                "username" => $username,
                "password" => $password,
                "email" => $email,
            ]
        ];
        
        try {
            $user = $this->api->users()->post($data)->request();
            $this->hooks->do_action('after_signup', $user, $username, $email, $password, $groups);
            return isset($user->id);
        } catch (ClientException $e) {
            if ($e->getResponse()->getReasonPhrase() === "Unprocessable Entity") {
                return null;
            }
            throw $e;
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
    public function update(string $username, string $email, string $password = null): void
    {
        $this->hooks->do_action('before_update', $username, $email, $password);
        // Get user ID
        $users = $this->getUsersList();
        $id = null;
        foreach ($users as $user) {
            if ($user->attributes['username'] === $username or $user->attributes['email'] === $email) {
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
        
        $this->hooks->do_action('after_update', $username, $email, $password);
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
            $response = $this->api->users()->offset($offset)->request();
            if ($response instanceof Item and empty($response->type)) {
                $offset = null;
                continue;
            }
            
            $list = $list->merge($response->collect()->all());
            $offset = array_key_last($list->all()) + 1;
        }
        
        return empty($filter) ? $list : $list->pluck($filter)->all();
    }
}
