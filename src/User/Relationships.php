<?php

namespace Maicol07\SSO\User;

/**
 * Class Relationships
 * @package Maicol07\SSO\User
 *
 * @property string[] $groups
 */
class Relationships
{
    private array $relationships = [];

    private array $dirty = [];


    public function __set(string $name, mixed $value): void
    {
        $this->dirty[$name] = $value;
        $this->relationships[$name] = $value;
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
        return isset($this->dirty[$name]) || isset($this->relationships[$name]);
    }

    public function toArray(): array
    {
        return $this->relationships;
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
