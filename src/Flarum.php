<?php /** @noinspection PhpUndefinedMethodInspection */

namespace Maicol07\SSO;

use Delight\Cookie\Cookie;
use Hooks\Hooks;
use Illuminate\Support\Arr;
use Maicol07\Flarum\Api\Client;
use Maicol07\SSO\Traits\Basic;

/**
 * Flarum SSO
 *
 * @author fabwu
 * @author maicol07
 * @package src
 */
class Flarum
{
    use Basic;
    
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
    
    /** @var Hooks */
    protected $hooks;
    
    /** @var array List of loaded addons */
    private $addons = [];
    
    /**
     * Flarum constructor
     *
     * @param string $url Flarum URL
     * @param string $root_domain Main site or SSO system domain
     * @param string $api_key Random key from the api_keys table of your Flarum forum
     * @param string $password_token Random token to create passwords
     * @param int $lifetime How many days should the login be valid
     * @param bool $insecure Insecure mode (use only if you don't have an SSL certificate)
     * @param bool $set_groups_admins Set groups for admins. Set to false if you don't want to set groups to admins
     *
     * @noinspection CallableParameterUseCaseInTypeContextInspection
     */
    public function __construct(
        string $url,
        string $root_domain,
        string $api_key,
        string $password_token,
        int $lifetime = 14,
        bool $insecure = false,
        bool $set_groups_admins = true
    )
    {
        // Urls
        $this->url = $url;
        // Fix URL scheme
        if (empty(Arr::get(parse_url($this->url), 'scheme'))) {
            $this->url = 'https://' . $this->url;
        }
    
        $url = parse_url($root_domain);
        if (!empty(Arr::get($url, 'host'))) {
            $root_domain = Arr::get($url, 'host');
        }
        $this->root_domain = $root_domain;
        $this->password_token = $password_token;
    
        // Api client
        $options = [];
        if ($insecure) {
            $options['verify'] = false;
        }
        $this->api = new Client($this->url, ['token' => $api_key], $options);
        
        $this->cookie = new Cookie('flarum_remember');
        $this->lifetime = $lifetime;
        $this->set_groups_admins = $set_groups_admins;
        
        // Initialize addons
        $this->hooks = new Hooks();
        foreach ($this->addons as $key => $addon) {
            unset($this->addons[$key]);
            $this->addons[$key] = new $addon($this->hooks, $this);
        }
    }
    
    /**
     * Adds an addon
     *
     * @param string $addon Class name to add as addon
     * @return $this
     */
    public function addAddon(string $addon): Flarum
    {
        $this->addons[] = new $addon($this->hooks, $this);
        return $this;
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
    
    /**
     * Redirects the user to your Flarum instance
     */
    public function redirect(): void
    {
        header('Location: ' . $this->getForumLink());
        die();
    }
    
    /**
     * Get Token lifetime in seconds
     *
     * @return float|int
     */
    private function getLifetimeSeconds()
    {
        return $this->lifetime * 60 * 60 * 24;
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
}
