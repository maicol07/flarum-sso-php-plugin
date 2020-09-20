<?php


namespace Maicol07\SSO\Addons;

class Groups extends Core
{
    protected $actions = [
        'after_login' => 'setGroups',
        'after_signup' => 'setGroups'
    ];
    protected $filters = [];
    
    /**
     * Removes any group from a user.
     *
     * @param string $username
     */
    public function removeGroups(string $username): void
    {
        $this->setGroups($username, []);
    }
    
    /**
     * Sets groups to a user
     *
     * @param string $username
     * @param array|null $groups
     */
    public function setGroups(string $username, ?array $groups): void
    {
        if (is_null($groups)) {
            return;
        }
        $user = $this->master->api->users($username)->request();
        if (!empty($user->id)) {
            $group_names = [];
            
            // Check if user is admin
            $user_groups = $user->relationships['groups'];
            if (array_key_exists(1, $user_groups)) {
                if (!$this->master->set_groups_admins) {
                    return;
                }
                $group_names[] = [
                    'type' => 'groups',
                    'id' => 1
                ];
            }
            
            $flarum_groups = $this->master->api->groups()->request();
            foreach ($flarum_groups as $group) {
                if (in_array($group->attributes['nameSingular'], $groups, true)) {
                    $group_names[] = [
                        'type' => 'groups',
                        'id' => $group->id
                    ];
                    unset($groups[array_search($group->attributes['nameSingular'], $groups, true)]);
                }
            }
            
            // Create groups not found
            foreach ($groups as $group) {
                if (empty($group) or !is_string($group)) {
                    continue;
                }
                $id = $this->createGroup($group);
                $group_names[] = [
                    'type' => 'groups',
                    'id' => $id
                ];
            }
            
            $this->master->api->users($user->id)->patch([
                'relationships' => [
                    'groups' => [
                        'data' => $group_names
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
