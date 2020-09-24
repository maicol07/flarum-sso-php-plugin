<?php


namespace Maicol07\SSO\User;


class Attributes
{
    /** @var string */
    public $username;
    
    /** @var string */
    public $email;
    
    /** @var string|null */
    public $password;
    
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}