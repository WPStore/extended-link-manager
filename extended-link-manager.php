<?php
/**
 * @author		WP-Cloud <code@wp-cloud.org>
 * @copyright	Copyright (c) 2014, WP-Cloud
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GPLv2
 * @package		WPC\ExtendedLinkManager
 * @version		1.0
 */

/*
Plugin Name: Extended Link-Manager
Plugin URI: https://github.com/wp-cloud/extended-link-manager
Description: @TODO
Version: 1.0
Author: WP-Cloud
Author URI: http://www.wp-cloud.de
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: extended-link-manager
Domain Path: /languages

    Extended Link-Manager
    Copyright (C) 2014 WP-Cloud (http://www.wp-cloud.de)

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

/**
 * @todo Development notes for Extended Link-Manager:
 * - use 'namespaces'
 * - use autoloader with APC support
 */

/** Namespaces */
// namespace WPC;

//avoid direct calls to this file
if ( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

/** Load all of the necessary class files for the plugin */
spl_autoload_register( 'WPC_ExtendedLinkManager::autoload' );

/**
 * Main class to run the plugin
 *
 * @since	1.0.0
 */
class WPC_ExtendedLinkManager {

	static $permission = 'edit_theme_options';
	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @static
	 * @access	private
	 * @since	1.0.0
	 */
	private static $instance;

	/**
	 * Current version of the plugin.
	 *
	 * @var		string
	 * @access	public
	 * @since	1.0.0
	 */
	public $version = '1.0';

	/**
	 * Holds a copy of the main plugin filepath.
	 *
	 * @var		string
	 * @access	private
	 * @since	1.0.0
	 */
	private static $file = __FILE__;

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @access	public
	 * @since	1.0.0
	 */
	public function __construct() {

		self::$instance = $this;

//		add_action( 'widgets_init', array( $this, 'widget' ) );
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

		$wpc_exlm_global = new WPC_ExtendedLinkManager_Init();

		if ( !is_admin() ) {

			$wpc_exlm_frontend = new WPC_ExtendedLinkManager_Frontend();

		}

		if ( is_admin() ) {

			$wpc_exlm_admin = new WPC_ExtendedLinkManager_Admin();

		}

//		register_activation_hook( __FILE__, array( 'ExtendedLinkManager', 'activate_plugin' ) );
//		register_deactivation_hook( __FILE__, array( 'ExtendedLinkManager', 'deactivate_plugin' ) );

	} // END __construct()

	/**
	 * PSR-0 compliant autoloader to load classes as needed.
	 *
	 * @static
	 * @access	public
	 * @since	1.0.0
	 *
	 * @param	string	$classname The name of the class
	 * @return	null	Return early if the class name does not start with the correct prefix
	 */
	public static function autoload( $classname ) {

		if ( 'WPC_ExtendedLinkManager' !== mb_substr( $classname, 0, 23 ) ) {
			return;
		}

		$class = substr( $classname, 4 );
		$filename = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . str_replace( '_', DIRECTORY_SEPARATOR, $class ) . '.php';

		if ( file_exists( $filename ) ) {
			require $filename;
		}

	} // END autoload()

	/**
	 * Getter method for retrieving the object instance.
	 *
	 * @static
	 * @access	public
	 * @since	1.0.0
	 *
	 * @return	object	self::$instance
	 */
	public static function get_instance() {

		return self::$instance;

	} // END get_instance()

	/**
	 * Getter method for retrieving the main plugin filepath.
	 *
	 * @static
	 * @access	public
	 * @since	1.0.0
	 *
	 * @return	string	self::$file
	 */
	public static function get_file() {

		return self::$file;

	} // END get_file()

	/**
	 * Load the plugin's textdomain hooked to 'plugins_loaded'.
	 *
	 * @action	plugins_loaded
	 * @uses	load_plugin_textdomain()
	 * @uses	dirname()
	 * @uses	plugin_basename()
	 *
	 * @access	private
	 * @since	1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'extended-link-manager',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages/'
		);

	} // END load_plugin_textdomain()

	/**
	 * Fired when plugin is activated
	 *
	 * @action	register_activation_hook
	 *
	 * @access	public	@todo
	 * @since	1.0.0
	 *
	 * @param	bool	$network_wide TRUE if WPMU 'super admin' uses Network Activate option
	 */
	public function activate_plugin( $network_wide ) {

	} // END activate_plugin()

	/**
	 * Fired when plugin is deactivated
	 *
	 * @action	register_deactivation_hook
	 *
	 * @access	public	@todo
	 * @since	1.0.0
	 *
	 * @param	bool	$network_wide TRUE if WPMU 'super admin' uses Network Activate option
	 */
	public function deactivate_plugin( $network_wide ) {

	} // END deactivate_plugin()

} // END class WPC_Exlm

/**
 * Instantiate the main class
 *
 * @since	1.0.0
 * @access	public
 *
 * @var	object	$wpc_exlm holds the instantiated class {@uses WPC_ExtendedLinkManager}
 */
$wpc_exlm = new WPC_ExtendedLinkManager();
