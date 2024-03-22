<?php
namespace Maicol07\SSO;

use GuzzleHttp\Exception\ClientException;
use Maicol07\Flarum\Api\Resource\Collection;
use Maicol07\Flarum\Api\Resource\Item;
use Maicol07\SSO\User\Attributes;
use Maicol07\SSO\User\Relationships;
use Maicol07\SSO\User\Traits\Auth;

/**
 * Class User
 *
 * @package Maicol07\SSO
 */
class User
{
    use Auth;

    /** @var null|int */
    public $id;

    /** @var string */
    public $type = 'users';

    /** @var Attributes */
    public $attributes;

    /** @var Relationships */
    public $relationships;

    /** @var bool */
    public $isAdmin = false;

    /** @var Flarum */
    private $flarum;

    public function __construct(?string $username, Flarum $flarum)
    {
        $this->flarum = $flarum;
        $this->attributes = new Attributes();
        $this->relationships = new Relationships();
        $this->attributes->username = $username;

        $this->flarum->filter_hook('before_user_init', $this);

        if ($username !== null && $username !== '') {
            $this->fetch();
        }

        $this->flarum->filter_hook('after_user_init', $this);
    }

    /**
     * Updates a user. If user id is not set, user will be fetched. Warning! User needs to be found with username or email, so one of those two has to be the old one
     */
    public function update(): bool
    {
        if ($this->id === null || $this->id === 0) {
            if (!$this->fetch()) {
                return false;
            }
        }

        $this->flarum->action_hook('before_update');

        $response = $this->flarum->api->users($this->id)->patch([
            'attributes' => $this->getDirtyAttributes()
        ])->request();

        $this->flarum->action_hook('after_update', $response);

        $result = ($response->id === $this->id);

        if ($result) {
            $this->attributes->clearDirty();
        }

        return $result;
    }

    /**
     * Deletes a user from Flarum database. Generally, you should use this method when an user successfully deleted
     * his account from your SSO system (or main website)
     */
    public function delete(): bool
    {
        $this->flarum->action_hook('before_delete');

        // Logout the user
        $this->flarum->logout();
        if ($this->id === null || $this->id === 0) {
            return false;
        }

        try {
            $result = $this->flarum->api->users($this->id)->delete()->request();
        } catch (ClientException $e) {
            if ($e->getCode() === 404 && $e->getResponse()->getReasonPhrase() === "Not Found") {
                $result = false;
            } else {
                throw $e;
            }
        }

        $this->flarum->action_hook('after_delete');
        $this->flarum->deleteSessionTokenCookie();
        $this->flarum->deleteRememberTokenCookie();
        $this->flarum->deleteLogoutCookie();
        $this->flarum->action_hook('after_delete_cookies');
        return $result;
    }

    /**
     * Fetch user data from Flarum
     *
     * @return bool Returns true if successful, false or exception (other than Not Found) otherwise
     */
    public function fetch(): bool
    {
        try {
            $user = $this->flarum->api->users($this->attributes->username)->request();
            assert($user instanceof Item);
        } catch (ClientException $e) {
            if ($e->getCode() === 404 && $e->getResponse()->getReasonPhrase() === "Not Found") {
                // User doesn't exists in Flarum
                $this->id = null;
                return false;
            }

            throw $e;
        }

        $this->id = $user->id ?? null;

        // Set attributes
        foreach ($user->attributes ?? [] as $attribute => $value) {
            $this->attributes->$attribute = $value;
        }
        $this->attributes->clearDirty();

        $groups = $user->relationships['groups'] ?? [];

        // Admin?
        if (array_key_exists(1, $groups)) {
            $this->isAdmin = true;
        }

        // Set groups
        foreach ($groups as $group) {
            $this->relationships->groups[] = $group->attributes['nameSingular'];
        }
        $this->relationships->clearDirty();

        return true;
    }

    public function getAttributes(): array
    {
        return $this->attributes->toArray();
    }

    public function getDirtyAttributes(): array
    {
        return $this->attributes->dirtyToArray();
    }

    public function getRelationships(): array
    {
        return $this->relationships->toArray();
    }

    public function getDirtyRelationships(): array
    {
        return $this->relationships->dirtyToArray();
    }
}
