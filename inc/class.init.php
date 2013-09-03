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
		add_action( 'init' , array( 'ExtendedLinkManager_Init', 'register_cpt' ) );
		
		load_plugin_textdomain( 'extended-link-manager' , false, EXLM_PATH . '/languages' );
	}
	
	// @TODO rewrite_flush!!
	static function register_cpt() {
		$cpt_labels = array(
			'name' => __( 'Links', 'extended-link-manager' ),
			'singular_name' => __( 'Link', 'extended-link-manager' ),
			'all_items' => __( 'All Links', 'extended-link-manager' ),
			'add_new' => __( 'Add New', 'extended-link-manager' ),
			'add_new_item' => __( 'Add New Link', 'extended-link-manager' ),
			'edit' => __( 'Edit', 'extended-link-manager' ),
			'edit_item' => __( 'Edit Link', 'extended-link-manager' ),
			'new_item' => __( 'New Link', 'extended-link-manager' ),
			'view_item' => __( 'View Link', 'extended-link-manager' ),
			'search_items' => __( 'Search Links', 'extended-link-manager' ),
			'not_found' => __( 'No links found.', 'extended-link-manager' ),
			'not_found_in_trash' => __( 'Nothing found in Trash', 'extended-link-manager' ),
			// 'parent_item_colon' => '',
			'menu_name' => __( 'Links', 'extended-link-manager' )
		);
		
		$cpt_args = array(
			'labels' => $cpt_labels,
			'description' => __( 'Links description', 'extended-link-manager' ),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'link',
				'with_front' => true
			),
			'capability_type' => 'post',
			'has_archive' => 'links',
			'hierarchical' => true,
			'menu_position' => null,
			'menu_icon' => get_stylesheet_directory_uri() . '/img/links-icon.png', /* the icon for the custom post type menu */
			'supports' => array( 'title' )
		); 
		
		$tax_labels = array(
			'name' => __( 'Categories' ), /* name of the custom taxonomy */
			'singular_name' => __( 'Category' ), /* single taxonomy name */
			'search_items' => __( 'Search Categories' ), /* search title for taxomony */
			'all_items' => __( 'All Categories' ), /* all title for taxonomies */
//			'parent_item' => __( 'Parent Custom Category', 'extended-link-manager' ), /* parent title for taxonomy */
//			'parent_item_colon' => __( 'Parent Custom Category:', 'extended-link-manager' ), /* parent taxonomy title */
			'edit_item' => __( 'Edit Category' ), /* edit custom taxonomy title */
			'update_item' => __( 'Update Category' ), /* update title for taxonomy */
			'add_new_item' => __( 'Add New Category' ), /* add new title for taxonomy */
			'new_item_name' => __( 'New Category Name' ) /* name title for taxonomy */
		);
		
		$tax_args = array(
			'hierarchical' => true,
			'labels' => $tax_labels,
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'links' ) // ???
		);
		
		register_post_type( 'link', $cpt_args );
		register_taxonomy( 'link-category', 'link', $tax_args );

	} // END register_cpt
} // END class ExtendedLinkManager_Init
