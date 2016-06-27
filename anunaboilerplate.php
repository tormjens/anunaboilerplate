<?php
/*
Plugin Name:  Anunatak: Plugin Boilerplate
Description:  A boilerplate to get up and running with plugins in no time.
Plugin URI: http://anunatak.no
Author: Tor Morten Jensen
Author URI: http://tormorten.no
Version: 0.0.1
*/

/**
 * The path to the plugin
 */
define( 'ANUNABOILERPLATE_DIR', plugin_dir_path( __FILE__ ) );

/**
 * The url to the plugin
 */
define( 'ANUNABOILERPLATE_URL', plugin_dir_url( __FILE__ ) );

/**
 * The url to the plugin
 */
define( 'ANUNABOILERPLATE_VERSION', '1.0.0' );

/**
 * Autoload all classes in the lib/-folder
 * @param  string $className The name of class
 * @return void
 */
function anunaboilerplate_autoload($className) {
    $segments = explode( '_', $className );
    unset($segments[0]);
    $name = array_map('strtolower', $segments);
    $name = implode('/', $name);
    $filename = ANUNABOILERPLATE_DIR . "lib/" . $name. ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}

spl_autoload_register('anunaboilerplate_autoload');

/**
 * Load the plugin
 * @return void
 */
function anunaboilerplate_load() {
    global $anunaboilerplate;
    $anunaboilerplate = new Anunaboilerplate_Plugin;
}
add_action('plugins_loaded', 'anunaboilerplate_load');
