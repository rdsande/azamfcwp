<?php
/**
 * Settings to display the "Transfers" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'transfer',
	'database_column_primary_key'   => 'transfer_id',

	// Menu.
	'url_slug'                      => 'transfers',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Transfers', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Transfers', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Transfer', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Transfer', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Transfer', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Transfer', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The transfer has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The transfer has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The transfer has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'transfers_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'transfer_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the transfer.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'player_id',
			'label'           => __( 'Player', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The player.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_player_name',
		),
		array(
			'database_column' => 'transfer_type_id',
			'label'           => __( 'Transfer Type', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The transfer type.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_transfer_type_name',
		),
		array(
			'database_column' => 'team_id_left',
			'label'           => __( 'Team Left', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The team left by the player.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_team_name',
		),
		array(
			'database_column' => 'team_id_joined',
			'label'           => __( 'Team Joined', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The team joined by the player.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_team_name',
		),
		array(
			'database_column' => 'date',
			'label'           => __( 'Date', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The date of the transfer.', $this->shared->get( 'slug' ) ),
			'filter'          => 'format_date_timestamp',
		),
		array(
			'database_column' => 'fee',
			'label'           => __( 'Fee', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The transfer fee.', $this->shared->get( 'slug' ) ),
			'filter'          => 'money_format',
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_transfers' ), 10 ),

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
			'column'                  => 'transfer_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Transfer Type', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The transfer type.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_transfer_types(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'team_id_left',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Team Left', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The team left by the player.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_teams( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'team_id_joined',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Team Joined', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The team joined by the player.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_teams( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Date', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The date of the transfer.', $this->shared->get( 'slug' ) ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'required'                => true,
			'searchable'              => false,
		),
		array(
			'column'                  => 'fee',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Fee', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The fee of the transfer.', $this->shared->get( 'slug' ) ),
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
			'message' => __( 'Please add at least one player type with the', $this->shared->get( 'slug' ) ) .
						'&nbsp' .
						'<a href="' . get_admin_url() . 'admin.php?page=dase-players">' .
						__( 'Players', $this->shared->get( 'slug' ) ) .
						'</a> ' .
						__( 'menu', $this->shared->get( 'slug' ) ) .
						'.',
		),
		array(
			'status'  => $menu_utility->num_of_teams() === 0,
			'message' => __( 'Please add at least one team with the', $this->shared->get( 'slug' ) ) .
						'&nbsp' .
						'<a href="' . get_admin_url() . 'admin.php?page=dase-teams">' .
						__( 'Teams', $this->shared->get( 'slug' ) ) .
						'</a> ' .
						__( 'menu', $this->shared->get( 'slug' ) ) .
						'.',
		),
		array(
			'status'  => $menu_utility->num_of_transfer_types() === 0,
			'message' => __( 'Please add at least one transfer type with the', $this->shared->get( 'slug' ) ) .
						'&nbsp' .
						'<a href="' . get_admin_url() . 'admin.php?page=dase-transfer-types">' .
						__( 'Transfer Types', $this->shared->get( 'slug' ) ) .
						'</a> ' .
						__( 'menu', $this->shared->get( 'slug' ) ) .
						'.',
		),
	),

);
$menu->generate_menu();
