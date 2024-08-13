<?php
/**
 * Settings to display the "Market Value Transitions" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'market_value_transition',
	'database_column_primary_key'   => 'market_value_transition_id',

	// Menu.
	'url_slug'                      => 'market-value-transitions',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Market Value Transition', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Market Value Transitions', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Market Value Transition', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Market Value Transition', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Market Value Transition', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Market Value Transition', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The market value transition has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The market value transition has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The market value transition has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'market_value_transitions_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'market_value_transition_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the market value transition.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'player_id',
			'label'           => __( 'Player', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The player.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_player_name',
		),
		array(
			'database_column' => 'date',
			'label'           => __( 'Date', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The date of the market value transition.', $this->shared->get( 'slug' ) ),
			'filter'          => 'format_date_timestamp',
		),
		array(
			'database_column' => 'value',
			'label'           => __( 'Value', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The value of the player.', $this->shared->get( 'slug' ) ),
			'filter'          => 'money_format',
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_market_value_transitions' ), 10 ),

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
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Date', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The date of the market value transition.', $this->shared->get( 'slug' ) ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'required'                => true,
			'searchable'              => false,
		),
		array(
			'column'                  => 'value',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Value', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The value of the player.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
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
	),

);
$menu->generate_menu();
