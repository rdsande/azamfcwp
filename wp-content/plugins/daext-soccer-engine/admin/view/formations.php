<?php

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'formation',
	'database_column_primary_key'   => 'formation_id',

	// Menu.
	'url_slug'                      => 'formations',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Formation', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Formations', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Formation', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Formation', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Formation', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Formation', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The formation has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The formation has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The formation has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'formations_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'formation_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the formation.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The name of the formation.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'description',
			'label'           => __( 'Description', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The description of the formation.', $this->shared->get( 'slug' ) ),
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_formations' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The name of the formation.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'description',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Description', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The description of the formation.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
	),
);

for ( $i = 1;$i <= 11;$i++ ) {
	$menu->settings['fields'][] = array(
		'column'                  => 'x_position_' . $i,
		'query_placeholder_token' => 's',
		'label'                   => __( 'X Position', $this->shared->get( 'slug' ) ) . ' ' . $i,
		'tooltip'                 => __( 'The X position of player', $this->shared->get( 'slug' ) ) . ' ' . $i . '.',
		'type'                    => 'text',
		'maxlength'               => '3',
		'value'                   => '1',
		'required'                => true,
		'searchable'              => true,
	);

	$menu->settings['fields'][] = array(
		'column'                  => 'y_position_' . $i,
		'query_placeholder_token' => 's',
		'label'                   => __( 'Y Position ', $this->shared->get( 'slug' ) ) . ' ' . $i,
		'tooltip'                 => __( 'The Y position of player', $this->shared->get( 'slug' ) ) . ' ' . $i . '.',
		'type'                    => 'text',
		'maxlength'               => '3',
		'value'                   => '1',
		'required'                => true,
		'searchable'              => true,
	);

}

$menu->generate_menu();
