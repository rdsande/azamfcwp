<?php
/**
 * Settings to display the "Player Awards" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'player_award',
	'database_column_primary_key'   => 'player_award_id',

	// Menu.
	'url_slug'                      => 'player-awards',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Player Award', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Player Awards', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Player Award', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Player Award', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Player Award', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Player Award', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The player award has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The player award has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The player award has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'player_awards_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'player_award_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the player award.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'player_id',
			'label'           => __( 'Player', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The player.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_player_name',
		),
		array(
			'database_column' => 'player_award_type_id',
			'label'           => __( 'Player Award Type', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The player award type.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_player_award_type_name',
		),
		array(
			'database_column' => 'assignment_date',
			'label'           => __( 'Assignment Date', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The assignment date of the player award.', $this->shared->get( 'slug' ) ),
			'filter'          => 'format_date_timestamp',
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_player_awards' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'player_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Player', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The player.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_players(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'searchable'              => false,
		),
		array(
			'column'                  => 'player_award_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Player Award Type', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The player award type.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_player_award_types(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'searchable'              => false,
		),
		array(
			'column'                  => 'assignment_date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Assignment Date', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The assignment date of the player award.', $this->shared->get( 'slug' ) ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'required'                => true,
			'searchable'              => false,
		),
	),

	// Blocking Conditions.
	'blocking_conditions'           => array(
		array(
			'status'  => $menu_utility->num_of_player_award_types() === 0,
			'message' => __( 'Please add at least one player award type with the', $this->shared->get( 'slug' ) ) .
						'&nbsp' .
						'<a href="' . get_admin_url() . 'admin.php?page=dase-player-award-types">' .
						__( 'Player Award Types', $this->shared->get( 'slug' ) ) .
						'</a> ' .
						__( 'menu', $this->shared->get( 'slug' ) ) .
						'.',
		),
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
	),

);
$menu->generate_menu();
