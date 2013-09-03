<?php
//avoid direct calls to this file
if ( ! function_exists( 'add_filter' ) ) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

class ExtendedLinkManager_Frontend {
	
	// Plugin instance
	protected static $instance = NULL;
	
	public function __construct() {
		if ( ! is_admin() )
			return NULL;
	}
    
	// Access this plugin's working instance
	public static function get_instance() {
		if ( NULL === self::$instance )
			self::$instance = new self;

		return self::$instance;
	}
	
	public static function init() {
		return;
	}

} // END class ExtendedLinkManager_Frontend
