<?php

/**
 * Main plugin class
 */
class Anunaboilerplate_Plugin {

    /**
     * Holds the modules
     * @var array
     */
    protected $modules = array();

    /**
     * Construct plugin
     */
    public function __construct()
    {
        $this->loadModules();
    }

    /**
     * Loads up all the different modules
     * @return void
     */
    protected function loadModules()
    {
        $this->loadModule('Anunabuilder_Scripts');
    }

    /**
     * Adds a module
     * @param  string $module
     * @return void
     */
    protected function loadModule($module)
    {
        if(class_exists($module)) {
            $this->modules[] = new $module($this);
        }
    }

    /**
     * Creates a plugin instance statically
     * @return Github_Explorer_Plugin
     */
    public static function instance()
    {
        return new static;
    }

}
