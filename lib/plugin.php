<?php

/**
 * Main plugin class
 * Acts as a extremely primitive container, and injects itself into every loaded module.
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
		/**
		 * Loads the scripts module
		 */
		$this->loadModule('Anunaboilerplate_Scripts');

		/**
		 * Loads the views module
		 */
		$this->loadModule('Anunaboilerplate_Views');
	}

	/**
	 * Adds a module
	 * @param  string $module
	 * @return void
	 */
	public function loadModule($module)
	{
		if(class_exists($module)) {
			$instance = new $module($this);
			$this->modules[$this->getModuleSlug($module)] = $instance;
			return $instance;
		}
	}

	/**
	 * Get a module from the container
	 * @param  string $module
	 * @return mixed
	 */
	public function getModule($module)
	{
		if(isset($this->modules[$module])) {
			return $this->modules[$module];
		}
		return null;
	}

	/**
	 * Gets the slug of a module
	 * @param  string $module
	 * @return string
	 */
	protected function getModuleSlug($module)
	{
		// split into segments
		$segments = explode('_', $module);

		// the end of the segments is the module
		$last = end($segments);

		return strtolower($last);

	}

	/**
	 * Creates a plugin instance statically
	 * @return Github_Explorer_Plugin
	 */
	public static function instance()
	{
		return new static;
	}

	/**
	 * Guesses the plugin slug
	 * @return string
	 */
	public function getSlug()
	{
		// get the name of the plugin class
		$class = get_class();

		// split into segments
		$segments = explode('_', $class);

		// the end of the segments is the module
		$last = end($segments);

		// remove the module
		$name = str_replace($last, '', $class);

		// remove the lodash
		$name = substr($name, 0, -1);

		// sanitize as a slug and return
		return sanitize_title( $name );
	}

	/**
	 * Guesses the plugin object name
	 * @return string
	 */
	public function getObjectName()
	{
		// get the name of the plugin class
		$class = get_class();

		// split into segments
		$segments = explode('_', $class);

		$segments = array_map('ucfirst', $segments);

		// the end of the segments is the module
		$last = end($segments);

		// remove the module
		$name = str_replace($last, '', $class);

		// remove the lodash
		$name = substr($name, 0, -1);

		// Will become snake case
		$name = str_replace('_', '', $name);

		// sanitize as a slug and return
		return $name;
	}

}
