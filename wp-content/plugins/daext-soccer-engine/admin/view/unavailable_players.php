<?php
/**
 * Settings to display the "Unavailable Players" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'unavailable_player',
	'database_column_primary_key'   => 'unavailable_player_id',

	// Menu.
	'url_slug'                      => 'unavailable-players',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Unavailable Player', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Unavailable Players', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Unavailable Player', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Unavailable Player', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Unavailable Player', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Unavailable Player', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The unavailable player has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The unavailable player has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The unavailable player has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'unavailable_players_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'unavailable_player_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the unavailable player.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'player_id',
			'label'           => __( 'Player', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The unavailable player.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_player_name',
		),
		array(
			'database_column' => 'unavailable_player_type_id',
			'label'           => __( 'Unavailable Player Type', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The unavailable player type.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_unavailable_player_type_name',
		),
		array(
			'database_column' => 'start_date',
			'label'           => __( 'Start Date', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The start date.', $this->shared->get( 'slug' ) ),
			'filter'          => 'format_date_timestamp',
		),
		array(
			'database_column' => 'end_date',
			'label'           => __( 'End Date', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The end date.', $this->shared->get( 'slug' ) ),
			'filter'          => 'format_date_timestamp',
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_unavailable_players' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'player_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Player', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The unavailable player.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_players(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'unavailable_player_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Unavailable Player Type', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The unavailable player type.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_unavailable_player_types(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'start_date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Start Date', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The start date.', $this->shared->get( 'slug' ) ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'required'                => true,
			'searchable'              => false,
		),
		array(
			'column'                  => 'end_date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'End Date', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The end date.', $this->shared->get( 'slug' ) ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'required'                => true,
			'searchable'              => false,
		),
	),

	// Blocking Conditions.
	'blocking_conditions'           => array(
		array(
			'status'  => $menu_utility->num_of_players() === 0,
			'message' => __( 'Please add at least one player with the', $this->shared->get( 'slug' ) ) .
						'&nbsp' .
						'<a href="' . get_admin_url() . 'admin.php?page=dase-players">' .
						__( 'Players', $this->shared->get( 'slug' ) ) .
						'</a> ' .
						__( 'menu', $this->shared->get( 'slug' ) ) .
						'.',
		),
		array(
			'status'  => $menu_utility->num_of_unavailable_player_types() === 0,
			'message' => __( 'Please add at least one unavailable player type with the', $this->shared->get( 'slug' ) ) .
						'&nbsp' .
						'<a href="' . get_admin_url() . 'admin.php?page=dase-unavailable-player-types">' .
						__( 'Unavailable Player Types', $this->shared->get( 'slug' ) ) .
						'</a> ' .
						__( 'menu', $this->shared->get( 'slug' ) ) .
						'.',
		),
	),

);
$menu->generate_menu();
