<?php


namespace Maicol07\SSO;

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
    
    /** @var int */
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
    
    public function __construct(string $username, Flarum $flarum)
    {
        $this->flarum = $flarum;
        $this->flarum->user = &$this;
    
        $this->attributes = new Attributes();
        $this->relationships = new Relationships();
    
        $user = $this->flarum->api->users($username)->request();
        if (!empty($user->id)) {
            $this->id = $user->id;
            // User exists in Flarum. Search attributes
            foreach ($user->attributes as $attribute => $value) {
                $this->attributes->$attribute = $value;
            }
        
            // Admin?
            if (array_key_exists(1, $user->relationships['groups'])) {
                $this->isAdmin = true;
            }
            
            // Search for groups
            foreach ($user->relationships['groups'] as $id => $group) {
                $this->relationships->groups[] = $group->attributes['nameSingular'];
            }
        }
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