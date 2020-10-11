<?php
namespace Maicol07\SSO\Addons;

use Illuminate\Support\Arr;

/**
 * Class Groups
 * @package Maicol07\SSO\Addons
 */
class Groups extends Core
{
    protected $actions = [
        'after_login' => 'setGroups',
        'after_signup' => 'setGroups',
        'after_update' => 'setGroups'
    ];
    
    /**
     * Sets groups to a user
     *
     */
    public function setGroups(): void
    {
        $user = $this->master->user;
        if (!empty($user->id)) {
            $groups = $user->relationships->groups;
            
            // Create groups not found
            foreach ($groups as $group) {
                if (empty($group) or !is_string($group)) {
                    continue;
                }
                $flarum_groups = $this->master->api->groups()->request();
                foreach ($flarum_groups as $flarum_group) {
                    if (Arr::get($flarum_group, 'attributes.nameSingular') === $group) {
                        $id = Arr::get($flarum_group, 'id');
                    }
                }
                if (empty($id)) {
                    $id = $this->createGroup($group);
                }
                $group_names[] = [
                    'type' => 'groups',
                    'id' => $id
                ];
            }
            
            $this->master->api->users($user->id)->patch([
                'relationships' => [
                    'groups' => [
                        'data' => $groups
                    ],
                ],
            ])->request();
        }
    }
    
    /**
     * Add a group to Flarum
     *
     * @param string $group
     *
     * @return mixed
     */
    public function createGroup(string $group)
    {
        $response = $this->master->api->groups()->post([
            'type' => 'groups',
            'attributes' => [
                'namePlural' => $group,
                'nameSingular' => $group
            ]
        ])->request();
        return $response->id;
    }
}
