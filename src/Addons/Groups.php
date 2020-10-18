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
            $groups = [];
    
            /** Search flarum groups - @noinspection NullPointerExceptionInspection */
            $flarum_groups = Arr::pluck(
                $this->master->api->groups()->request()->collect()->all(),
                'attributes.nameSingular',
                'id'
            );
    
            foreach ($user->relationships->groups as $group) {
                if (empty($group) or !is_string($group)) {
                    continue;
                }
        
                // Find ID of the group
                $id = array_key_first(Arr::where($flarum_groups, function ($name) {
                    global $group;
                    return $name === $group;
                }));
                // If it doesn't exists, create it
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
