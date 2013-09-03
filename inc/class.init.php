<?php
/**
 * 
 */

//avoid direct calls to this file
if ( ! function_exists( 'add_filter' ) ) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

class ExtendedLinkManager_Init {
	
	public static function init() {
		add_action( 'init' , array( $this, 'register_cpt' ) );
		
		load_plugin_textdomain( 'extended-link-manager' , false, EXLM_PATH  . '/languages' );
	}
	
	// @TODO rewrite_flush!!
	function register_cpt() {
		$labels = array(
			'name' => __( 'Custom Types', 'extended-link-manager' ), /* This is the Title of the Group */
			'singular_name' => __( 'Custom Post', 'extended-link-manager' ), /* This is the individual type */
			'all_items' => __( 'All Custom Posts', 'extended-link-manager' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'extended-link-manager' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Custom Type', 'extended-link-manager' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'extended-link-manager' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Post Types', 'extended-link-manager' ), /* Edit Display Title */
			'new_item' => __( 'New Post Type', 'extended-link-manager' ), /* New Display Title */
			'view_item' => __( 'View Post Type', 'extended-link-manager' ), /* View Display Title */
			'search_items' => __( 'Search Post Type', 'extended-link-manager' ), /* Search Custom Type Title */
			'not_found' => __( 'Nothing found in the Database.', 'extended-link-manager' ), /* This displays if there are no entries yet */
			'not_found_in_trash' => __( 'Nothing found in Trash', 'extended-link-manager' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => '',
			'menu_name' => __( 'Books', '')
		);
		
		$args = array(
			'labels' => $labels,
			'description' => __( 'This is the example custom post type', 'extended-link-manager' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'custom_type',
				'with_front' => false
			), /* you can specify its url slug */
			'capability_type' => 'post',
			'has_archive' => 'custom_type', /* you can rename the slug here */ 
			'hierarchical' => true,
			'menu_position' => null,
			'menu_icon' => get_stylesheet_directory_uri() . '/img/links-icon.png', /* the icon for the custom post type menu */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky' )
		); 

		register_post_type( 'link', $args );	
	}
		
} // END class ExtendedLinkManager_CPT

// $exlm_cpt = ExtendedLinkManager_CPT::get_instance();
