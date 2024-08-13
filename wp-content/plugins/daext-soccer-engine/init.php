<?php
/**
 * Plugin Name: Soccer Engine
 * Description: Store, analyze and display soccer data in your WordPress website.
 * Version: 1.25
 * Author: DAEXT
 * Author URI: https://daext.com
 *
 * @package daext-soccer-engine
 */

// Prevent direct access to this file.
if ( ! defined( 'WPINC' ) ) {
	die();
}

// Class shared across public and admin.
require_once plugin_dir_path( __FILE__ ) . 'shared/class-dase-shared.php';

// Public.
require_once plugin_dir_path( __FILE__ ) . 'public/class-dase-public.php';
add_action( 'plugins_loaded', array( 'Dase_Public', 'get_instance' ) );

// Rest API.
require_once plugin_dir_path( __FILE__ ) . 'rest/class-dase-rest.php';
add_action( 'plugins_loaded', array( 'Dase_Rest', 'get_instance' ) );

// Perform the Gutenberg related activities only if Gutenberg is present.
if ( function_exists( 'register_block_type' ) ) {
	require_once plugin_dir_path( __FILE__ ) . 'blocks/src/init.php';
}

// Admin.
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	// Admin.
	require_once plugin_dir_path( __FILE__ ) . 'admin/class-dase-admin.php';
	add_action( 'plugins_loaded', array( 'Dase_Admin', 'get_instance' ) );

	// Activate.
	register_activation_hook( __FILE__, array( Dase_Admin::get_instance(), 'ac_activate' ) );

}

// Ajax.
if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {

	// Admin.
	require_once plugin_dir_path( __FILE__ ) . 'class-dase-ajax.php';
	add_action( 'plugins_loaded', array( 'Dase_Ajax', 'get_instance' ) );

}
