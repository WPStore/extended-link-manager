<?php
/**
 * @author		WP-Cloud <code@wp-cloud.org>
 * @copyright	Copyright (c) 2014, WP-Cloud
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GPLv2
 * @package		WPC\ExtendedLinkManager
 */

/** Namespaces */
// namespace WPC\ExtendedLinkManager;

//avoid direct calls to this file
if ( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

/**
 * @todo
 *
 * @since	1.0.0
 */
class WPC_ExtendedLinkManager_Init {

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

		add_action( 'init' , array( $this, 'register_cpt' ) );

	} // END __construct()

	/**
	 * Getter method for retrieving the object instance.
	 *
	 * @since 1.0.0
	 */
	public static function get_instance() {

		return self::$instance;

	} // END get_instance()

	/**
	 * Desc.
	 *
	 * @since 1.0.0
	 */
	static function register_cpt() {
		$cpt_labels = array(
			'name'					=> __( 'Links', 'extended-link-manager' ),
			'singular_name'			=> __( 'Link', 'extended-link-manager' ),
			'all_items'				=> __( 'All Links', 'extended-link-manager' ),
			'add_new'				=> __( 'Add New', 'extended-link-manager' ),
			'add_new_item'			=> __( 'Add New Link', 'extended-link-manager' ),
			'edit'					=> __( 'Edit', 'extended-link-manager' ),
			'edit_item'				=> __( 'Edit Link', 'extended-link-manager' ),
			'new_item'				=> __( 'New Link', 'extended-link-manager' ),
			'view_item'				=> __( 'View Link', 'extended-link-manager' ),
			'search_items'			=> __( 'Search Links', 'extended-link-manager' ),
			'not_found'				=> __( 'No links found.', 'extended-link-manager' ),
			'not_found_in_trash'	=> __( 'Nothing found in Trash', 'extended-link-manager' ),
			'menu_name'				=> __( 'Links', 'extended-link-manager' ),
		);

		$cpt_args = array(
			'labels'				=> $cpt_labels,
			'description'			=> __( 'Links description', 'extended-link-manager' ),
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'show_in_menu'			=> true,
			'query_var'				=> true,
			'rewrite'				=> array(
				'slug' => 'link',
				'with_front' => true,
			),
			'capability_type'		=> 'post',
			'has_archive'			=> 'links',
			'hierarchical'			=> true,
			'menu_position'			=> null,
			// 'menu_icon' => plugins_url( EXLM_BASENAME ) . '/img/links-icon.png', // @todo fix
			'supports'				=> array( 'title' ),
		);

		$cat_labels = array(
			'name'			=> __( 'Categories' ), /* name of the custom taxonomy */
			'singular_name'	=> __( 'Category' ), /* single taxonomy name */
			'search_items'	=> __( 'Search Categories' ), /* search title for taxomony */
			'all_items'		=> __( 'All Categories' ), /* all title for taxonomies */
//			'parent_item' => __( 'Parent Custom Category', 'extended-link-manager' ), /* parent title for taxonomy */
//			'parent_item_colon' => __( 'Parent Custom Category:', 'extended-link-manager' ), /* parent taxonomy title */
			'edit_item'		=> __( 'Edit Category' ), /* edit custom taxonomy title */
			'update_item'	=> __( 'Update Category' ), /* update title for taxonomy */
			'add_new_item'	=> __( 'Add New Category' ), /* add new title for taxonomy */
			'new_item_name'	=> __( 'New Category Name' ) /* name title for taxonomy */
		);

		$cat_args = array(
			'hierarchical'		=> true,
			'labels'			=> $cat_labels,
			'show_admin_column'	=> true,
			'show_ui'			=> true,
			'query_var'			=> true,
			'rewrite'			=> array(
				'slug' => 'links',
			),
		);

		$tag_labels = array(
			'name'				=> __( 'Tags' ), /* name of the custom taxonomy */
			'singular_name'		=> __( 'Tag' ), /* single taxonomy name */
			'search_items'		=> __( 'Search Tags' ), /* search title for taxomony */
			'all_items'			=> __( 'All Tags' ), /* all title for taxonomies */
			'parent_item'		=> __( 'Parent Tag' ), /* parent title for taxonomy */
			'parent_item_colon'	=> __( 'Parent Tag:' ), /* parent taxonomy title */
			'edit_item'			=> __( 'Edit Tag' ), /* edit custom taxonomy title */
			'update_item'		=> __( 'Update Tag' ), /* update title for taxonomy */
			'add_new_item'		=> __( 'Add New Tag' ), /* add new title for taxonomy */
			'new_item_name'		=> __( 'New Tag Name' ), /* name title for taxonomy */
		);

		$tag_args = array(
			'hierarchical'		=> false,
			'labels'			=> $tag_labels,
			'show_admin_column'	=> true,
			'show_ui'			=> true,
			'query_var'			=> true,
			// 'rewrite' => array( 'slug' => 'links' ) // ???
		);

		register_post_type( 'link', $cpt_args );
		register_taxonomy( 'link-category', 'link', $cat_args );
		register_taxonomy( 'link-tag', 'link', $tag_args );

	} // END register_cpt

} // END class WPC_ExtendedLinkManager_Init
