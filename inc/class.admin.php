<?php
//avoid direct calls to this file
if ( ! function_exists( 'add_filter' ) ) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

class ExtendedLinkManager_Admin {
	
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
		add_action( 'admin_menu' , array( 'ExtendedLinkManager_Admin', 'admin_menu' ) );
		add_filter( 'plugin_row_meta', array( 'ExtendedLinkManager_Admin', 'set_plugin_meta' ), 10, 2 );
	}
	
	static function admin_menu() {
		// The plugins page
		ExtendedLinkManager::$page = add_theme_page(
			__( '', 'extended-link-manager'),
			__( '', 'extended-link-manager'),
			'edit_theme_options',
			'',
			array( 'ExtendedLinkManager_Admin', 'register_assets' )
		);
		
		add_action( 'load-'.ExtendedLinkManager::$page, array( 'ExtendedLinkManager_Admin', 'register_assets') );
	}
	
	static function register_assets() {
		
	}
	
	static function set_plugin_meta( $links, $file ) {	
		if ( $file == plugin_basename( JQPL_BASENAME ) ) {
			return array_merge(
				$links,
				array( 
					'<a href="https://github.com/wp-cloud/extended-link-manager" target="_blank">GitHub</a>',
					'<a href="https://github.com/wp-cloud/extended-link-manager/issues" target="_blank">Issues</a>'
				)
			);
		}
		return $links;
	}

} // END class ExtendedLinkManager_Admin
