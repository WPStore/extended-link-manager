<?php
/*
Plugin Name: Extended Link-Manager
Plugin URI: https://github.com/wp-cloud/extended-link-manager
Description: @TODO
Version: 1.0-dev
Author: Foe Services
Author URI: http://www.foe-services.de/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: extended-link-manager
Domain Path: /languages

    Extended Link-Manager
    Copyright (C) 2013 Foe Services (http://foe-services.de)

    This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

//avoid direct calls to this file
if ( ! function_exists( 'add_filter' ) ) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

/** Load all of the necessary class files for the plugin */
spl_autoload_register( 'Exlm::autoload' );

class Exlm {

	static $permission = 'edit_theme_options';

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 1.0.0
	 *
	 * @var object
	 */
	private static $instance;

	/**
	 * Current version of the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $version = '1.0-dev';

	/**
	 * Holds a copy of the main plugin filepath.
	 *
	 * @since 1.2.0
	 *
	 * @var string
	 */
	private static $file = __FILE__;

	/**
	 * Constructor. Hooks all interactions into correct areas to start
	 * the class.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		self::$instance = $this;

		$exlm_init = new Exlm_Init();
		$exlm_admin = new Exlm_Admin();
		$exlm_frontend = new Exlm_Frontend();

		register_activation_hook( __FILE__, array( 'Exlm', 'activate' ) );
		register_deactivation_hook( __FILE__, array( 'Exlm', 'deactivate' ) );

	}

	/**
	 * PSR-0 compliant autoloader to load classes as needed.
	 *
	 * @since 1.0.0
	 *
	 * @param string $classname The name of the class
	 * @return null Return early if the class name does not start with the correct prefix
	 */
	public static function autoload( $classname ) {

		if ( 'Exlm' !== mb_substr( $classname, 0, 4 ) )
			return;

		$filename = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . str_replace( '_', DIRECTORY_SEPARATOR, $classname ) . '.php';
		if ( file_exists( $filename ) )
			require $filename;

	}

	/**
	 * Getter method for retrieving the object instance.
	 *
	 * @since 1.0.0
	 */
	public static function get_instance() {

		return self::$instance;

	} // END get_instance() 

	public function activate() {
		flush_rewrite_rules();
	} // END activate()

	public function deactivate() {
		flush_rewrite_rules();
	} // END deactivate()

} // END class ExtendedLinkManager
	
$exlm = new Exlm();
