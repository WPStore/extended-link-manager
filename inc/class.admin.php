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
	} // END __construct()
    
	// Access this plugin's working instance
	public static function get_instance() {
		if ( NULL === self::$instance )
			self::$instance = new self;
		return self::$instance;
	} // END get_instance()
	
	public static function init() {
		add_action( 'admin_init', array( 'ExtendedLinkManager_Admin', 'register_settings' ) );
		add_action( 'admin_menu' , array( 'ExtendedLinkManager_Admin', 'admin_menu' ) );
		add_filter( 'plugin_row_meta', array( 'ExtendedLinkManager_Admin', 'set_plugin_meta' ), 10, 2 );
	} // END init()
	
	static function admin_menu() {
		$menus = array(
			array(
				'parent_slug' => 'options-general.php',
				'page_title' => __( 'Settings') . ' &rsaquo; ' . __( 'Links', 'extended-link-manager' ),
				'menu_title' => __( 'Links', 'extended-link-manager' ),
				'capability' => ExtendedLinkManager::$permission,
				'menu_slug' => 'exlm-settings',
				'function' => array( 'ExtendedLinkManager_Admin', 'settings_page' )
			)
		);

		WPCAdmin::register_menus( $menus );
	} // END admin_menu()
	
	static function register_settings() {
		$settings[] = array(
			'id' => 'exlm',
			'title' => 'Plugin-Loader ' . __('Settings' ),
			'desc' => __('This is the desc for the section #1 for the plugin loader', 'jquery-plugin-loader' ),
			'page_tab' => 'exlm-settings-main',
			'fields' => array(
				array(
					'id'	=> 'headjs',
					'title'	=> 'HeadJS Loader',
					'type'	=> 'checkbox',
					'args'	=> array(
						'desc'	=> 'Use the HeadJS library to load the jQuery plugins'
					)
				),
			),
		);

//		register_setting( $option_group, $option_name, $sanitize_callback );
//		$register_settings = array(
//			'option_group' => 'settings_page_jqpl-settings',
//			'option_name' => 'settings_page_jqpl-settings',
//			'sanitize_callback' => ''
//		);

		WPCAdmin::register_settings( $settings );
	} // END register_settings()
	
	static function settings_page() {
		WPCAdmin::settings_page(
			'options-general',
			__( 'Link', 'extended-link-manager' ) . ' ' . __( 'Settings' ),
			'exlm-settings-main',
			'vertical',
			array( 
				array( __( 'Main', 'extended-link-manager' ), 'exlm-settings-main' ),
				array( __( 'Refresh', 'extended-link-manager' ), 'exlm-settings-second' ),
				array( __( 'Third', 'extended-link-manager' ), 'exlm-settings-third' )
			)
		);
	} // END settings_page()
	
	static function set_plugin_meta( $links, $file ) {	
		if ( $file == plugin_basename( EXLM_BASENAME ) ) {
			return array_merge(
				$links,
				array( 
					'<a href="https://github.com/wp-cloud/extended-link-manager" target="_blank">GitHub</a>',
					'<a href="https://github.com/wp-cloud/extended-link-manager/issues" target="_blank">Issues</a>'
				)
			);
		}
		return $links;
	} // END set_plugin_meta()

} // END class ExtendedLinkManager_Admin
