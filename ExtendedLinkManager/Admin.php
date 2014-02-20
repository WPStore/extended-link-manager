<?php
/**
 * @author		WP-Cloud <code@wp-cloud.org>
 * @copyright	Copyright (c) 2014, WP-Cloud
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GPLv2
 * @package		WPC\ExtendedLinkManager\Admin
 */

/** Namespaces */
// namespace WPC\ExtendedLinkManager;

//avoid direct calls to this file
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

/**
 * @todo
 *
 * @since	1.0.0
 */
class WPC_ExtendedLinkManager_Admin {

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 1.0.0
	 *
	 * @var object
	 */
	private static $instance;

	/**
	 * Getter method for retrieving the object instance.
	 *
	 * @since 1.0.0
	 */
	public static function get_instance() {

		return self::$instance;

	} // END get_instance()

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		self::$instance = $this;

		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_menu' , array( $this, 'admin_menu' ) );
		add_filter( 'plugin_action_links_' . plugin_basename( WPC_ExtendedLinkManager::get_file() ), array( $this, 'add_action_links' ) );
		add_filter( 'plugin_row_meta', array( $this, 'set_plugin_meta' ), 10, 2 );

	} // END __construct()

	/**
	 * Desc.
	 *
	 * @since 1.0.0
	 */
	public function admin_menu() {

		add_submenu_page(
			'options-general.php',
			__( 'Link-Manager Settings', 'extended-link-manager' ),
			__( 'Link-Manager', 'extended-link-manager' ),
			apply_filters( 'exlm_settings_permission', 'edit_theme_options' ),
			'link-manager',
			array( $this, 'settings_page' )
		);

	} // END admin_menu()

	/**
	 * Desc.
	 *
	 * @since 1.0.0
	 */
	public function register_settings() {
	} // END register_settings()

	/**
	 * Desc.
	 *
	 * @since 1.0.0
	 */
	public function settings_page() { ?>

		<div class="wrap">
			<h2><?php _e( 'Link-Manager Settings', 'extended-link-manager' ); ?></h2>
		</div><!-- .wrap -->

	<?php
	} // END settings_page()

	/**
	 * Desc.
	 *
	 * @since 1.0.0
	 */
	public function set_plugin_meta( $links, $file ) {

		if ( $file == plugin_basename( WPC_ExtendedLinkManager::get_file() ) ) { // @todo
			return array_merge(
				$links,
				array(
					'<a href="https://github.com/wp-cloud/extended-link-manager" target="_blank">GitHub</a>',
					'<a href="https://github.com/wp-cloud/extended-link-manager/issues" target="_blank">Issues</a>',
				)
			);
		}
		return $links;

	} // END set_plugin_meta()

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    0.1.0
	 * @access   public
	 *
	 * @see      admin_url()
	 *
	 * @param    array $links Array of links
	 * @return   array Array of links
	 */
	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . add_query_arg( 'page', 'link-manager', admin_url( 'options-general.php' ) ) . '">' . __( 'Settings' ) . '</a>'
			),
			$links
		);

	} // END add_action_links()

} // END class WPC_ExtendedLinkManager_Admin
