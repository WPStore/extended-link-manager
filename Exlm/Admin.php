<?php
//avoid direct calls to this file
if ( ! function_exists( 'add_filter' ) ) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

class Exlm_Admin {
	
	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 1.0.0
	 *
	 * @var object
	 */
	private static $instance;

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		self::$instance = $this;

		if ( ! is_admin() )
			return NULL;
		
		add_action( 'admin_init', array( 'Exlm_Admin', 'register_settings' ) );
		add_action( 'admin_menu' , array( 'Exlm_Admin', 'admin_menu' ) );
		add_filter( 'plugin_row_meta', array( 'Exlm_Admin', 'set_plugin_meta' ), 10, 2 );
		
	} // END __construct()
	
	static function admin_menu() {
		
		add_options_page(
			__( 'Settings') . ' &rsaquo; ' . __( 'Links', 'extended-link-manager' ),
			__( 'Links', 'extended-link-manager' ),
			Exlm::get_instance()->permission,
			'exlm-settings',
			array( 'Exlm_Admin', 'settings_page' )
		);

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

		// WPCAdmin::register_settings( $settings );
		
	} // END register_settings()
	
	static function settings_page() {
//		WPCAdmin::settings_page(
//			'options-general',
//			__( 'Link', 'extended-link-manager' ) . ' ' . __( 'Settings' ),
//			'exlm-settings-main',
//			'vertical',
//			array( 
//				array( __( 'Main', 'extended-link-manager' ), 'exlm-settings-main' ),
//				array( __( 'Refresh', 'extended-link-manager' ), 'exlm-settings-second' ),
//				array( __( 'Third', 'extended-link-manager' ), 'exlm-settings-third' )
//			)
//		);
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
	
	/**
	 * Getter method for retrieving the object instance.
	 *
	 * @since 1.0.0
	 */
	public static function get_instance() {

		return self::$instance;

	} // END get_instance()

} // END class Exlm_Admin
