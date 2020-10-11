<?php /** @noinspection PhpUnused */


namespace Maicol07\SSO\User;

/**
 * Class Attributes
 * @package Maicol07\SSO\User
 */
class Attributes
{
    /** @var string */
    public $username;
    
    /** @var string */
    public $email;
    
    /** @var string|null */
    public $password;
    
    /** @var string */
    public $displayName;
    
    /** @var string */
    public $avatarUrl;
    
    /** @var string */
    public $joinTime;
    
    /** @var int */
    public $discussionCount;
    
    /** @var int */
    public $commentCount;
    
    /** @var bool */
    public $canEdit;
    
    /** @var bool */
    public $canDelete;
    
    /** @var bool */
    public $canSuspend;
    
    /** @var string */
    public $bio;
    
    /** @var bool */
    public $canViewBio;
    
    /** @var bool */
    public $canEditBio;
    
    /** @var bool */
    public $canSpamblock;
    
    /** @var bool */
    public $blocksPd;
    
    /** @var bool */
    public $cannotBeDirectMessaged;
    
    /** @var bool */
    public $isBanned;
    
    /** @var bool */
    public $canBandIP;
    
    /** @var array */
    public $usernameHistory;
    
    /** @var bool */
    public $canViewWarnings;
    
    /** @var bool */
    public $canManageWarnings;
    
    /** @var bool */
    public $canDeleteWarnings;
    
    /** @var int */
    public $visibleWarningCount;
    
    
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
