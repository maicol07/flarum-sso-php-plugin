<?php
namespace Maicol07\SSO\Addons;

use Hooks\Hooks;
use Maicol07\SSO\Exceptions\MissingRequiredAddonException;
use Maicol07\SSO\Flarum;

/**
 * Class Core
 * @package Maicol07\SSO\Addons
 */
class Core
{
    /** @var array Actions list */
    protected $actions = [];

    /** @var array Filters list */
    protected $filters = [];

    /** @var array Required addons that needs to be loaded before this one */
    protected $required = [];

    public function __construct(protected \Hooks\Hooks $hooks, protected \Maicol07\SSO\Flarum $flarum)
    {
        $this->load();
    }

    /**
     * Load Addons hooks. If the addons require other addons loaded before it, then it will raise an exception
     */
    public function load(): Core
    {
        // Check required addons
        $required = [];
        foreach ($this->required as $addon) {
            if (!$this->flarum->isAddonLoaded($addon)) {
                $required[] = $addon;
            }
        }
        
        if ($required !== []) {
            throw new MissingRequiredAddonException('Following required addons not loaded: ' . implode(', ', $required) . '. You need to load it/them to use this addon');
        }

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

            foreach ($methods as $method) {
                $this->hooks->{"{$op}_$type"}($name, [$this, $method]);
            }
        }
    }

    /**
     * Unload Addons hooks
     */
    public function unload(): Core
    {
        $this->manageHooks('remove');
        return $this;
    }
}
