<?php

namespace Maicol07\SSO\Addons;

use Hooks\Hooks;
use Maicol07\SSO\Flarum;

class Core
{
    /** @var Hooks */
    protected $hooks;
    /** @var array Actions list */
    protected $actions = [];
    /** @var array Filters list */
    protected $filters = [];
    /** @var Flarum */
    protected $master;
    
    /**
     * Core constructor.
     * @param Hooks $hooks
     * @param Flarum $master
     */
    public function __construct(Hooks $hooks, Flarum $master)
    {
        $this->master = $master;
        $this->hooks = $hooks;
        $this->load();
    }
    
    /**
     * Load Addons hooks
     *
     * @return $this
     */
    public function load(): Core
    {
        $this->manageHooks('add');
        return $this;
    }
    
    /**
     * Manages hooks addition/removal
     *
     * @param string $op Must be 'add' or 'remove'
     */
    private function manageHooks(string $op): void
    {
        foreach (array_merge($this->actions, $this->filters) as $name => $method) {
            $type = in_array($method, $this->actions, true) ? 'action' : 'filter';
            $methods = is_array($method) ? $method : [$method];
            
            foreach ($methods as $m) {
                $this->hooks->{"{$op}_{$type}"}($name, [$this, $m]);
            }
        }
    }
    
    /**
     * Unload Addons hooks
     *
     * @return $this
     */
    public function unload(): Core
    {
        $this->manageHooks('remove');
        return $this;
    }
}