<?php
/**
 * @author		WP-Cloud <code@wp-cloud.org>
 * @copyright	Copyright (c) 2014, WP-Cloud
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GPLv2
 * @package		WPC\ExtendedLinkManager\Frontend
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
class WPC_ExtendedLinkManager_Frontend {

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

	} // END __construct()

	/**
	 * Getter method for retrieving the object instance.
	 *
	 * @since 1.0.0
	 */
	public static function get_instance() {

		return self::$instance;

	} // END get_instance()

} // END class WPC_ExtendedLinkManager_Frontend
