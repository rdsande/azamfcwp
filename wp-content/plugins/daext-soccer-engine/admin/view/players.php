<?php
/**
 * Settings to display the "Player" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'player',
	'database_column_primary_key'   => 'player_id',

	// Menu.
	'url_slug'                      => 'players',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Players', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Players', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Player', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Player', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Player', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Player', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The player has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The player has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The player has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'players_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'player_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the player.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'first_name',
			'label'           => __( 'First Name', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The first name of the player.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'last_name',
			'label'           => __( 'Last Name', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The last name of the player.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'player_position_id',
			'label'           => __( 'Player Position', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The position of the player.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_player_position_name',
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_players' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'first_name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'First Name', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The first name of the player.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'last_name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Last Name', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The last name of the player.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'image',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Image', $this->shared->get( 'slug' ) ),
			'instructions'            => __( 'Select an image that represents this player.', $this->shared->get( 'slug' ) ),
			'set_image'               => __( 'Set Image', $this->shared->get( 'slug' ) ),
			'remove_image'            => __( 'Remove Image', $this->shared->get( 'slug' ) ),
			'type'                    => 'image',
			'maxlength'               => '2083',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'gender',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Gender', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The gender of the player.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 0,
					'text'     => __( 'Male', 'dase' ),
					'selected' => true,
				),
				array(
					'value'    => 1,
					'text'     => __( 'Female', 'dase' ),
					'selected' => false,
				),
			),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'date_of_birth',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Date of Birth', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The date of birth of the player.', $this->shared->get( 'slug' ) ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'date_of_death',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Date of Death', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The date of death of the player.', $this->shared->get( 'slug' ) ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'citizenship',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Citizenship', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The citizenship of the player.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_countries( false ),
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'second_citizenship',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Second Citizenship', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The second citizenship of the player.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_countries( true ),
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'retired',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Retired', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The retired status of the player.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 0,
					'text'     => 'No',
					'selected' => true,
				),
				array(
					'value'    => 1,
					'text'     => 'Yes',
					'selected' => false,
				),
			),
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'player_position_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Player Position', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The position of the player.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_player_positions( true ),
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'foot',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Foot', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The foot of the player.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_foot(),
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'height',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Height', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The height of the player.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '3',
			'value'                   => '0',
			'required'                => false,
			'searchable'              => false,
		),
	),

	// Blocking Conditions
	'blocking_conditions'           => array(
		array(
			'status'  => $menu_utility->num_of_player_positions() === 0,
			'message' => __( 'Please add at least one player position with the', $this->shared->get( 'slug' ) ) .
						'&nbsp' .
						'<a href="' . get_admin_url() . 'admin.php?page=dase-player-positions">' .
						__( 'Player Positions', $this->shared->get( 'slug' ) ) .
						'</a> ' .
						__( 'menu', $this->shared->get( 'slug' ) ) .
						'.',
		),
	),

);
$menu->generate_menu();
