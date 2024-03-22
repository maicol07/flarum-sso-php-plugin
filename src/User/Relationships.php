<?php

namespace Maicol07\SSO\User;

use Maicol07\SSO\Flarum;

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

    public function __get(string $name): mixed
    {
        return $this->dirty[$name] ?? $this->relationships[$name];
    }

    public function __isset(string $name): bool
    {
        return isset($this->dirty[$name]) || isset($this->relationships[$name]);
    }

    public function toArray(): array
    {
        return $this->relationships;
    }

    public function dirtyToArray(Flarum $flarum): array
    {
        return $this->dirty;
    }

    public function clearDirty(): void
    {
        $this->dirty = [];
    }
}
