<?php

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

    /* @var string Domain of your main site without http:// or https:// */
    private $root_domain;

    /* @var string Random key from the api_keys table of your Flarum forum */
    private $api_key;

	/* @var string Random token to create passwords */
    private $password_token;

    /* @var int How many days should the login be valid */
    private $lifetime;

	/**
	 * Flarum constructor
	 *
	 * @param string $url
	 * @param string $root_domain
	 * @param string $api_key
	 * @param string $password_token
	 * @param int $lifetime
	 */
    public function __construct(string $url, string $root_domain, string $api_key, string $password_token, int $lifetime=14)
    {
        $this->url = $url;
        $this->root_domain = $root_domain;
        $this->api_key = $api_key;
        $this->password_token = $password_token;
        $this->lifetime = $lifetime;
        $this->cookie = new Cookie('flarum_remember');
    }

    /**
     * Logs the user in Flarum. Generally, you should use this method when an user successfully log into
     * your SSO system (or main website). If user is already signed up in Flarum database (not signed up with this
     * extension) you need to pass plain user password as third parameter (for example Flarum admin)
     *
     * @param string $username
     * @param string $email
     * @param string|null $password
     * @return string
     */
    public function login(string $username, string $email, $password=null)
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

        return $this->setCookie($token, time() + $this->getLifetimeSeconds());
    }

    /**
     * Logs out the user from Flarum. Generally, you should use this method when an user successfully logged out from
     * your SSO system (or main website)
     */
    public function logout()
    {
		$flarum_cookie = new Cookie('flarum_session');
		$flarum_cookie->delete();
		return $this->cookie->delete();
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
     * @param string $password
     * @return string
     */
    private function getToken(string $username, string $password)
    {
        $data = [
            'identification' => $username,
            'password' => $password,
            'lifetime' => $this->getLifetimeSeconds(),
        ];

        $response = $this->sendRequest('/api/token', $data);

        return isset($response['token']) ? $response['token'] : '';
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
            "data" => [
                "type" => "users",
                "attributes" => [
                    "username" => $username,
                    "password" => $password,
                    "email" => $email,
                ]
            ]
        ];

        $response = $this->sendRequest('/api/users', $data);

        return isset($response['data']['id']);
    }

    /**
     * Deletes a user from Flarum database. Generally, you should use this method when an user successfully deleted
     * his account from your SSO system (or main website)
     *
     * @param string $username
     */
    public function delete(string $username) {
        $response = $this->sendRequest("/api/users/" . $username, [], 'GET');
        if (!empty($response['id'])) {
            $this->sendRequest("/api/users/" . $response['id'], [], 'DELETE');
        }
    }

    /**
     * Send a request to Flarum JSON API. Default method is POST.
     *
     * @param string $path
     * @param array $data
     * @param string $method
     * @return mixed
     */
    private function sendRequest(string $path, array $data=[], string $method='POST')
    {

        // use key 'http' even if you send the request to https://...
        $options = [
            'http' => [
                'header'  => 'Authorization: Token ' . $this->api_key . '; userId=1',
                'method'  => $method,
                'content' => http_build_query($data),
                'ignore_errors' => true
            ]
        ];
        $context  = stream_context_create($options);
        $result = file_get_contents($this->url . $path, false, $context);
        return json_decode($result, true);
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
