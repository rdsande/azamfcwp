<?php
/**
 * Settings to display the "Player Positions" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'player_position',
	'database_column_primary_key'   => 'player_position_id',

	// Menu.
	'url_slug'                      => 'player-positions',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Player Position', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Player Positions', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Player Position', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Player Position', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Player Position', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Player Position', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The player position has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The player position has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The player position has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'player_positions_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'player_position_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the player position.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The name of the player position.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'description',
			'label'           => __( 'Description', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The description of the player position.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'abbreviation',
			'label'           => __( 'Abbreviation', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The abbreviation of the player position.', $this->shared->get( 'slug' ) ),
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_player_positions' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The name of the player position.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'description',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Description', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The description of the player position.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'abbreviation',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Abbreviation', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The abbreviation of the player position.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '3',
			'required'                => true,
			'searchable'              => true,
		),
	),
);
$menu->generate_menu();
