<?php


namespace Maicol07\SSO\Traits;

use Delight\Cookie\Cookie;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Arr;

trait Basic
{
    /**
     * Logs the user in Flarum. Generally, you should use this method when an user successfully log into
     * your SSO system (or main website).
     *
     * @return string
     */
    public function login()
    {
        $this->flarum->action_hook('before_login');
        
        if (empty($this->attributes->password)) {
            $this->attributes->password = $this->createPassword();
        }
        $token = $this->getToken();
    
        $this->flarum->action_hook('after_token_obtained', $token);
        
        // Backward compatibility: search for existing user
        try {
            $this->flarum->api->users($this->attributes->username)->request();
            if (empty($token)) {
                $this->attributes->password = $this->createPassword();
                $token = $this->getToken();
            }
        } catch (ClientException $e) {
            // If user is not signed up in Flarum
            if ($e->getCode() === 404 and $e->getResponse()->getReasonPhrase() === "Not Found") {
                $signed_up = $this->signup();
                if (!$signed_up) {
                    return false;
                }
                $this->flarum->action_hook('after_signup');
                $token = $this->getToken();
            } else {
                throw $e;
            }
        }
    
        $this->flarum->action_hook('after_login', $token);
        
        // Save cookie
        return $this->flarum->cookie->setValue($token)
            ->setExpiryTime(time() + $this->getLifetimeSeconds())
            ->setDomain($this->flarum->root_domain)
            ->save();
    }
    
    /**
     * Sign up user in Flarum. Generally, you should use this method when an user successfully log into
     * your SSO system (or main website) and you found out that user don't have a token (because he hasn't an account on Flarum)
     *
     * @return bool
     */
    private function signup(): ?bool
    {
        $this->flarum->action_hook('before_signup');
        $data = [
            "type" => "users",
            "attributes" => $this->getAttributes()
        ];
        
        try {
            $user = $this->flarum->api->users()->post($data)->request();
            $this->flarum->action_hook('after_signup');
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
     */
    public function update(): void
    {
        $this->flarum->action_hook('before_update');
        
        $this->flarum->api->users($this->id)->patch([
            'attributes' => $this->getAttributes()
        ])->request();
    
        $this->flarum->action_hook('after_update');
    }
    
    /**
     * Logs out the user from Flarum. Generally, you should use this method when an user successfully logged out from
     * your SSO system (or main website)
     */
    public function logout(): bool
    {
        $this->flarum->action_hook('before_logout');
        
        // Delete the flarum session cookie to logout from Flarum
        $url = parse_url($this->flarum->url);
        $flarum_cookie = new Cookie('flarum_session');
        $flarum_cookie->setDomain($this->flarum->root_domain)
            ->setPath(Arr::get($url, 'path'))
            ->setHttpOnly(true)
            ->setSecureOnly(true)
            ->delete();
        
        // Delete the plugin cookie
        $done = $this->flarum->cookie->delete();
    
        $this->flarum->action_hook('after_logout', $done);
        
        return $done;
    }
    
    /**
     * Deletes a user from Flarum database. Generally, you should use this method when an user successfully deleted
     * his account from your SSO system (or main website)
     */
    public function delete(): void
    {
        $this->flarum->action_hook('before_delete');
        // Logout the user
        $this->logout();
        if (!empty($this->id)) {
            $this->flarum->api->users($this->id)->delete()->request();
            $this->flarum->action_hook('after_delete');
        }
    }
    
    /**
     * Generates a password based on username and password token
     *
     * @return string
     */
    private function createPassword(): string
    {
        return hash('sha256', $this->attributes->username . $this->flarum->password_token);
    }
    
    /**
     * Get user token from Flarum (if user exists)
     *
     * @return string
     */
    private function getToken(): ?string
    {
        $data = [
            'identification' => $this->attributes->username,
            'password' => $this->attributes->password,
            'lifetime' => $this->getLifetimeSeconds(),
        ];
        
        try {
            $response = $this->flarum->api->token()->post($data)->request();
            return $response->token ?? '';
        } catch (ClientException $e) {
            if ($e->getResponse()->getReasonPhrase() === "Unauthorized") {
                return null;
            }
            throw $e;
        }
    }
    
    /**
     * Get Token lifetime in seconds
     *
     * @return float|int
     */
    private function getLifetimeSeconds()
    {
        return $this->flarum->lifetime * 60 * 60 * 24;
    }
}
