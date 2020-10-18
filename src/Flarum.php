<?php /** @noinspection PhpPrivateFieldCanBeLocalVariableInspection @noinspection PhpUndefinedMethodInspection */

namespace Maicol07\SSO;

use Delight\Cookie\Cookie;
use Hooks\Hooks;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Maicol07\Flarum\Api\Client;
use Maicol07\Flarum\Api\Resource\Item;

/**
 * Flarum SSO
 *
 * @author maicol07
 * @package Maicol07\SSO
 */
class Flarum
{
    /* @var Client Api client */
    public $api;
    
    /* @var Cookie */
    public $cookie;
    
    /* @var int How many days should the login be valid */
    public $lifetime;
    
    /* @var string Random token to create passwords */
    public $password_token;
    
    /* @var string Main site or SSO system domain */
    public $root_domain;
    
    /* @var bool Set groups also for admins */
    public $set_groups_admins;
    
    /* @var string Flarum URL */
    public $url;
    
    /** @var User */
    public $user;
    
    /** @var Hooks */
    protected $hooks;
    
    /** @var array List of loaded addons */
    private $addons = [];
    
    /**
     * Flarum constructor
     *
     * @param array $config {
     * @type string $url Flarum URL
     * @type string $root_domain Main site or SSO system domain
     * @type string $api_key Random key from the api_keys table of your Flarum forum
     * @type string $password_token Random token to create passwords
     * @type int $lifetime How many days should the login be valid. Default: 14
     * @type bool $insecure Insecure mode (use only if you don't have an SSL certificate). Default: false
     * @type bool $set_groups_admins Set groups for admins. Set to false if you don't want to set groups to admins. Default: true
     * }
     *
     */
    public function __construct(array $config)
    {
        // Urls
        $this->url = Arr::get($config, 'url');
        // Fix URL scheme
        if (empty(Arr::get(parse_url($this->url), 'scheme'))) {
            $this->url = 'https://' . $this->url;
        }
        
        $this->root_domain = Arr::get($config, 'root_domain');
        $url = parse_url($this->root_domain);
        if (!empty(Arr::get($url, 'host'))) {
            $this->root_domain = Arr::get($url, 'host');
        }
        
        $this->password_token = Arr::get($config, 'password_token');
        
        // Api client
        $options = [];
        if (Arr::get($config, 'insecure', false)) {
            $options['verify'] = false;
        }
        $this->api = new Client($this->url, ['token' => Arr::get($config, 'api_key')], $options);
        
        $this->cookie = (new Cookie('flarum_remember'))->setDomain($this->root_domain);
        $this->lifetime = Arr::get($config, 'lifetime', 14);
        $this->set_groups_admins = Arr::get($config, 'set_groups_admins', true);
    
        // Initialize addons
        $this->hooks = new Hooks();
        foreach ($this->addons as $key => $addon) {
            unset($this->addons[$key]);
            $this->addons[$key] = new $addon($this->hooks, $this);
        }
    }
    
    /**
     * Logs out the current user from Flarum. Generally, you should use this method when an user successfully logged out from
     * your SSO system (or main website)
     */
    public function logout(): bool
    {
        $this->action_hook('before_logout');
        
        // Delete the plugin cookie
        $done = $this->cookie->delete();
        
        $this->hooks->do_action('after_logout', $done);
        
        return $done;
    }
    
    /**
     * Adds an addon
     *
     * @param string $addon Class name to add as addon
     * @return int
     */
    public function addAddon(string $addon): int
    {
        $this->addons[] = new $addon($this->hooks, $this);
        return array_key_last($this->addons);
    }
    
    /**
     * Removes an addon
     *
     * @param string $addon Addon class name to remove
     * @return $this
     */
    public function removeAddon(string $addon): Flarum
    {
        $key = array_search($addon, $this->addons, true);
        $hook = $this->addons[$key];
        $hook->unload();
        unset($hook);
        return $this;
    }
    
    public function setAddonAttributes(string $addon, array $attributes): Flarum
    {
        $hook = $this->addons[array_search($addon, $this->addons, true)];
        foreach ($attributes as $key => $value) {
            $hook->$key = $value;
        }
        return $this;
    }
    
    /**
     * A simple proxy to Hook do_action function
     *
     * @param string $tag
     * @return int|null
     */
    public function action_hook(string $tag): ?int
    {
        $args = func_get_args();
        array_shift($args);
    
        if (!$this->hooks->has_action($tag)) {
            return -1;
        }
        $this->hooks->do_action($tag, $args);
        return null;
    }
    
    /**
     * A simple proxy to Hook apply_filters function
     *
     * @param string $tag
     * @param $value
     *
     * @return mixed
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function filter_hook(string $tag, $value)
    {
        if (!$this->hooks->has_filter($tag)) {
            return -1;
        }
        return $this->hooks->apply_filters($tag, $value);
    }
    
    /**
     * Redirects the user to your Flarum instance
     */
    public function redirect(): void
    {
        header('Location: ' . $this->getForumLink());
        die();
    }
    
    /**
     * Set the Flarum remember cookie
     *
     * @param string $token Token to set as the cookie value
     * @return bool
     */
    public function setCookie(string $token): bool
    {
        return $this->cookie->setValue($token)
            ->setExpiryTime(time() + $this->getLifetimeSeconds())
            ->saveAndSet();
    }
    
    /**
     * Gets a collection of the users actually signed up on Flarum, with all the properties
     *
     * @param null|string|array $filters Include in the returned collection only the values from filter(s)
     * Can be one or more of the following: type, id, attributes, attributes.username, attributes.displayName,
     * attributes.avatarUrl, attributes.joinTime, attributes.discussionCount, attributes.commentCount,
     * attributes.canEdit, attributes.canDelete, attributes.lastSeenAt, attributes.isEmailConfirmed, attributes.email,
     * attributes.markedAllAsReadAt, attributes.unreadNotificationCount, attributes.newNotificationCount,
     * attributes.preferences, attributes.canSuspend, attributes.bio, attributes.newFlagCount,
     * attributes.canViewRankingPage, attributes.Points, attributes.canPermanentNicknameChange, attributes.canEditPolls,
     * attributes.canStartPolls, attributes.canSelfEditPolls, attributes.canVotePolls, attributes.cover,
     * attributes.cover_thumbnail, relationships, relationships.groups
     *
     * There could be more if you have other extensions that adds them to Flarum API
     *
     * @return Collection
     */
    public function getUsersList($filters = null): Collection
    {
        $offset = 0;
        $collection = collect();
        
        while ($offset !== null) {
            $response = $this->api->users()->offset($offset)->request();
            if ($response instanceof Item and empty($response->type)) {
                $offset = null;
                continue;
            }
            
            $collection = $collection->merge($response->collect()->all());
            $offset = array_key_last($collection->all()) + 1;
        }
        
        // Filters
        $filtered = collect();
        if (!empty($filters)) {
            $grouped = true;
            if (is_string($filters)) {
                $filters = [$filters];
                $grouped = false;
            }
            
            foreach ($filters as $filter) {
                $plucked = $collection->pluck($filter);
                if (!empty($grouped)) {
                    $plucked = [$filter => $plucked];
                }
                $filtered = $filtered->mergeRecursive($plucked);
            }
            $collection = $filtered;
        }
        
        return $collection;
    }
    
    /**
     * Returns Flarum link
     *
     * @return string
     * @author maicol07
     * @noinspection PhpUnused
     * @noinspection UnknownInspectionInspection
     */
    public function getForumLink(): string
    {
        return $this->url;
    }
    
    /**
     * Get Token lifetime in seconds
     *
     * @return float|int
     */
    public function getLifetimeSeconds()
    {
        return $this->lifetime * 60 * 60 * 24;
    }
}
