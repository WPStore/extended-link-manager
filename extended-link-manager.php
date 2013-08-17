<?php
/*
Plugin Name: Extended Link-Manager
Plugin URI: #
Description: @TODO
Version: 0.1-dev
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

if ( ! class_exists( 'ExtendedLinkManager' ) ) {

	// =============
	// Plugin basename
	define( 'EXLM_BASENAME', plugin_basename( __FILE__ ) );
	// =============
	// Plugin basedir/path
	define( 'EXLM_PATH', dirname( __FILE__ ) );
	// =============
	
	add_action(
		'plugins_loaded', 
		array ( 'ExtendedLinkManager', 'get_instance' )
	);

	class ExtendedLinkManager {
		
		// Plugin constants
		const VERSION = '0.1-dev';
		// Plugin instance + variables
		protected static $instance = NULL;
		protected $loaded_textdomain = false;
		
		public function __construct() {
			$this->load_plugin_textdomain();
			$this->load_classes();
		}
        
		// Access this plugin’s working instance
		public static function get_instance() {
			if ( NULL === self::$instance )
				self::$instance = new self;

			return self::$instance;
		}       
	
		// load classes from INC path
		protected function load_classes() {
			foreach( glob( EXLM_PATH . '/inc/class.*.php' ) as $class ) {
				require_once $class;
			}
		}
		
		protected function load_plugin_textdomain() {
			if (!$this->loaded_textdomain) {
				load_plugin_textdomain( 'extended-link-manager' , false, EXLM_PATH  . '/languages');
				$this->loaded_textdomain = true;
			}
		}
		
	} // END class ExtendedLinkManager
	
} // END if class_exists
