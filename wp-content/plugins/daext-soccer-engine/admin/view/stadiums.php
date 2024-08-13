<?php
/**
 * Settings to display the "Stadiums" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'stadium',
	'database_column_primary_key'   => 'stadium_id',

	// Menu.
	'url_slug'                      => 'stadiums',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Stadium', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Stadiums', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Stadium', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Stadium', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Stadium', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Stadium', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The stadium has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The stadium has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The stadium has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'stadiums_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'stadium_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the stadium.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The name of the stadium.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'description',
			'label'           => __( 'Description', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The description of the stadium.', $this->shared->get( 'slug' ) ),
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_stadiums' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The name of the stadium.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'description',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Description', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The description of the stadium.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'image',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Image', $this->shared->get( 'slug' ) ),
			'instructions'            => __( 'Select an image that represents this stadium.', $this->shared->get( 'slug' ) ),
			'set_image'               => __( 'Set Image', $this->shared->get( 'slug' ) ),
			'remove_image'            => __( 'Remove Image', $this->shared->get( 'slug' ) ),
			'type'                    => 'image',
			'maxlength'               => '2083',
			'required'                => false,
			'searchable'              => true,
		),
	),
);
$menu->generate_menu();
