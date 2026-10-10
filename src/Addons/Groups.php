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
        $user = $this->flarum->user();
        if ($user->id !== null && $user->id !== 0) {
            $user_groups = $user->getDirtyRelationships()['groups'] ?? null;
            if ($user_groups !== null) {
                $groups = [];

                /** Search flarum groups - @noinspection NullPointerExceptionInspection */
                $flarum_groups = Arr::pluck(
                    $this->flarum->api->groups()->request()->collect()->all(),
                    'attributes.nameSingular',
                    'id'
                );

                foreach ($user_groups as $user_group) {
                    if (empty($user_group) || !is_string($user_group)) {
                        continue;
                    }

                    // Find ID of the group
                    $id = array_key_first(Arr::where($flarum_groups, static fn($name): bool => $name === $user_group));
                    // If it doesn't exists, create it
                    if (in_array($id, [0, '', null], true)) {
                        $id = $this->createGroup($user_group);
                    }

                    $groups[] = [
                        'type' => 'groups',
                        'id' => $id
                    ];
                }

                $this->flarum->api->users($user->id)->patch([
                    'relationships' => [
                        'groups' => [
                            'data' => $groups
                        ],
                    ],
                ])->request();

                $user->relationships->clearDirty();
            }
        }
    }

    /**
     * Add a group to Flarum
     *
     *
     * @return mixed
     * @noinspection MissingReturnTypeInspection
     */
    public function createGroup(string $group)
    {
        $response = $this->flarum->api->groups()->post([
            'type' => 'groups',
            'attributes' => [
                'namePlural' => $group,
                'nameSingular' => $group
            ]
        ])->request();
        return $response->id;
    }
}
