<?php

namespace Maicol07\SSO\User;

/**
 * Class Attributes
 * @package Maicol07\SSO\User
 */

/**
 * @property string $username
 * @property string $email
 * @property string|null $password
 * @property string $displayName WARNING! This is read only! Overwriting this when updating the user won't do anything! To change the display name use the $nickname variable (beta16+. Nickname extension required).
 * @property string $nickname WARNING! This is write only! To read this attribute use the $displayName property. To change the nickname you must have the nickname extension installed on your Flarum.
 * @property string $avatarUrl
 * @property string $joinTime
 * @property int $discussionCount
 * @property int $commentCount
 * @property bool $canEdit
 * @property bool $canDelete
 * @property bool $canSuspend
 * @property string $bio
 * @property bool $canViewBio
 * @property bool $canEditBio
 * @property bool $canSpamblock
 * @property bool $blocksPd
 * @property bool $cannotBeDirectMessaged
 * @property bool $isBanned
 * @property bool $canBandIP
 * @property array $usernameHistory
 * @property bool $canViewWarnings
 * @property bool $canManageWarnings
 * @property bool $canDeleteWarnings
 * @property int $visibleWarningCount
 */
class Attributes
{
    private array $dirty = [];

    private array $attrs = [];

    public function __set(string $name, mixed $value): void
    {
        $this->dirty[$name] = $value;
        $this->attrs[$name] = $value;
    }

    public function &__get(string $name): mixed
    {
        if (isset($this->dirty[$name])) {
            return $this->dirty[$name];
        }

        if (isset($this->relationships[$name])) {
            return $this->relationships[$name];
        }

        $null = null;
        return $null;
    }

    public function __isset(string $name): bool
    {
        return isset($this->dirty[$name]) || isset($this->attrs[$name]);
    }

    public function toArray(): array
    {
        return $this->attrs;
    }

    public function dirtyToArray(): array
    {
        return $this->dirty;
    }

    public function clearDirty(): void
    {
        $this->dirty = [];
    }
}
