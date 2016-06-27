<?php

/**
 * The module class
 */
abstract class Anunaboilerplate_Module {

    /**
     * Holds a plugin instance
     * @var Anunaboilerplate_Plugin
     */
    protected $plugin;

    /**
     * Builds the module
     * @param Anunaboilerplate_Plugin $plugin
     */
    public function __construct(Anunaboilerplate_Plugin $plugin)
    {
        $this->plugin = $plugin;
        $this->load();
    }

    /**
     * Loads up everything
     * @return void
     */
    abstract protected function load();

}
