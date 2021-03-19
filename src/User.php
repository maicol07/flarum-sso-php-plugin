<?php
namespace Maicol07\SSO;

use GuzzleHttp\Exception\ClientException;
use Maicol07\SSO\Traits\Basic;
use Maicol07\SSO\User\Attributes;
use Maicol07\SSO\User\Relationships;

/**
 * Class User
 *
 * @package Maicol07\SSO
 */
class User
{
    use Basic;

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
        $this->flarum->user = &$this;

        $this->id = null;
        $this->attributes = new Attributes();
        $this->relationships = new Relationships();
        $this->attributes->username = $username;

        $this->flarum->filter_hook('before_user_init', $this);

        if (!empty($username)) {
            $this->fetchUser();
        }

        $this->flarum->filter_hook('after_user_init', $this);
    }

    /**
     * Fetch user data from Flarum
     *
     * @return bool Returns true if successful, false or exception (other than Not Found) otherwise
     */
    public function fetchUser(): bool
    {
        try {
            $user = $this->flarum->api->users($this->attributes->username)->request();
        } catch (ClientException $e) {
            if ($e->getCode() === 404 and $e->getResponse()->getReasonPhrase() === "Not Found") {
                // User doesn't exists in Flarum
                $this->id = null;
                return false;
            }
            throw $e;
        }

        $this->id = $user->id;

        // Set attributes
        foreach ($user->attributes as $attribute => $value) {
            $this->attributes->$attribute = $value;
        }

        // Admin?
        if (array_key_exists(1, $user->relationships['groups'])) {
            $this->isAdmin = true;
        }

        // Set groups
        foreach ($user->relationships['groups'] as $group) {
            $this->relationships->groups[] = $group->attributes['nameSingular'];
        }

        return true;
    }

    public function getAttributes(): array
    {
        return $this->attributes->toArray();
    }

    public function getRelationships(): array
    {
        return $this->relationships->toArray($this->flarum);
    }
}
