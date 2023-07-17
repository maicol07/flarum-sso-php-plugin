<?php
namespace Maicol07\SSO\User;

use Maicol07\SSO\Flarum;

/**
 * Class Relationships
 * @package Maicol07\SSO\User
 */
class Relationships
{
    /** @var array */
    public $groups = [];
    
    /**
     * @return array{groups: array{data: array<int, array{type: string, id: mixed}>}}
     */
    public function toArray(Flarum $flarum): array
    {
        $groups = [];
        $flarum_groups = $flarum->api->groups()->request();
        foreach ($flarum_groups as $flarum_group) {
            if (in_array($flarum_group->attributes['nameSingular'], $this->groups, true)) {
                $groups[] = [
                    'type' => 'groups',
                    'id' => $flarum_group->id
                ];
            }
        }
        
        return [
            'groups' => [
                'data' => $groups
            ]
        ];
    }
}
