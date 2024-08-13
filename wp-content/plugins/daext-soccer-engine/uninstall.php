<?php
/**
 * Uninstall plugin.
 *
 * @package daext-soccer-engine
 */

// Exit if this file is called outside WordPress.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die();
}

require_once plugin_dir_path( __FILE__ ) . 'shared/class-dase-shared.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/class-dase-admin.php';

// Delete options and tables.
Dase_Admin::un_delete();
