<?php

class Anunaboilerplate_Script extends Anunaboilerplate_Module {

	/**
	 * The location
	 * @var null
	 */
	protected $where = null;

	/**
	 * The file
	 * @var null
	 */
	protected $file = null;

	/**
	 * The dependencies
	 * @var array
	 */
	protected $deps = [];

	/**
	 * Localized strings
	 * @var array
	 */
	protected $localize = [];

	/**
	 * Place in footer
	 * @var boolean
	 */
	protected $footer = false;

	/**
	 * Is admin script
	 * @var boolean
	 */
	protected $admin = false;

	/**
	 * Creates a handle for a file
	 * @return string
	 */
	protected function getHandle()
	{
		$segments = explode('.', $this->file);
		$name     = $segments[0];
		$handle   = $this->plugin->getSlug() . '/' . $name;
		return $handle;
	}

	/**
	 * Creates a object name for a file
	 * @return string
	 */
	protected function getObjectName()
	{
		$segments = explode('.', $this->file);
		$name     = $segments[0];
		$handle   = $this->plugin->getObjectName() . ucfirst($name);
		return $handle;
	}

	/**
	 * Gets the extension for a file name
	 * @return string
	 */
	protected function getExtension()
	{
		$segments = explode('.', $this->file);
		return end($segments);
	}

	/**
	 * Adds actions and set class props
	 * @param  string  $where
	 * @param  string  $file
	 * @param  boolean $admin
	 * @param  array   $deps
	 * @param  boolean $footer
	 * @return void
	 */
	public function enqueue($where, $file, $admin = false, $deps = [], $footer = false)
	{
		$this->where  = $where;
		$this->file   = $file;
		$this->admin  = $admin;
		$this->deps   = $deps;
		$this->footer = $footer;
		if(!$this->admin) {
			add_action('wp_enqueue_scripts', array($this, 'enqueueScript'));
		} else if($this->admin) {
			add_action('admin_enqueue_scripts', array($this, 'enqueueScript'));
		}
		return $this;
	}

	/**
	 * Enqueues a file
	 * @param  string  $file   Filename
	 * @param  array   $deps   Dependencies
	 * @param  boolean $footer Can it be included in footer
	 * @return void
	 */
	public function enqueueScript($hook)
	{
		if($this->where === '*' || $this->where === $hook) {
			if($this->getExtension() === 'js') {
				$src = ANUNABOILERPLATE_URL . 'assets/dist/js/'. $this->file;
				wp_enqueue_script( $this->getHandle(), $src, $this->deps, ANUNABOILERPLATE_VERSION, $this->footer );
			} elseif($this->getExtension() === 'css') {
				$src = ANUNABOILERPLATE_URL . 'assets/dist/css/'. $this->file;
				wp_enqueue_style( $this->getHandle(), $src, $this->deps, ANUNABOILERPLATE_VERSION );
			}
			return $this;
		}
		return null;
	}

	/**
	 * Localize a script (must be chained)
	 * @param  string $file
	 * @param  array  $localize
	 * @return void
	 */
	public function localize($localize = [])
	{
		$this->localize = $localize;
		if(!$this->admin) {
			add_action('wp_enqueue_scripts', array($this, 'localizeScript'));
		} else if($this->admin) {
			add_action('admin_enqueue_scripts', array($this, 'localizeScript'));
		}

		return $this->getObjectName();
	}

	/**
	 * Localize a script
	 * @param  string $file
	 * @param  array  $localize
	 * @return void
	 */
	public function localizeScript($hook)
	{
		if($this->where === '*' || $this->where === $hook) {
			if($this->getExtension() === 'js') {
				wp_localize_script( $this->getHandle(), $this->getObjectName(), $this->localize );
			}
		}
		return $this->getObjectName();
	}
}
