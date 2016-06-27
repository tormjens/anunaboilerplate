<?php

/**
 * Class for creating views
 */
class Anunaboilerplate_Views {

	/**
	 * A really simple view engine (pure PHP)
	 * @param  string $view      Name of the view
	 * @param  array  $arguments Arguments to be passed
	 * @return string            Args
	 */
	public function render($view, $arguments = [])
	{
		extract($arguments);
		ob_start();
		include($this->getViewPath($view));
		return ob_get_clean();
	}

	/**
	 * Gets the full path to view
	 * @param  string $view
	 * @return string
	 */
	protected function getViewPath($view)
	{
		$view = str_replace('.', '/', $view);
		$file = ANUNABOILERPLATE_DIR . 'views/' . $view . '.php';
		return $file;
	}

	/**
	 * Checks if a view exists
	 * @param  string $view
	 * @return boolean
	 */
	protected function viewExists($view)
	{
		return file_exists($this->getViewPath($view));
	}

}
