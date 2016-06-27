<?php

/**
 * The scripts class
 */
class Anunaboilerplate_Scripts extends Anunaboilerplate_Module {

	/**
	 * Enqueues a file
	 * @param  string  $file   Filename
	 * @param  array   $deps   Dependencies
	 * @param  boolean $footer Can it be included in footer
	 * @return void
	 */
	public function enqueue($where, $file, $deps = [], $footer = false)
	{
		$script = $this->plugin->loadModule('Anunaboilerplate_Script');
		return $script->enqueue($where, $file, $deps, $footer);
	}

}
