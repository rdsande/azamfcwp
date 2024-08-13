<?php
/**
 * Settings to display the "Team Contracts" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'team_contract',
	'database_column_primary_key'   => 'team_contract_id',

	// Menu.
	'url_slug'                      => 'team-contracts',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Team Contract', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Team Contracts', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Team Contract', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Team Contract', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Team Contract', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Team Contract', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The contract has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The contract has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The contract has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'team_contracts_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'team_contract_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the contract.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'player_id',
			'label'           => __( 'Player', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The player.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_player_name',
		),
		array(
			'database_column' => 'team_id',
			'label'           => __( 'Team', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The team of the player.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_team_name',
		),
		array(
			'database_column' => 'team_contract_type_id',
			'label'           => __( 'Contract Type', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The contract type.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_team_contract_type_name',
		),
		array(
			'database_column' => 'start_date',
			'label'           => __( 'Start Date', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The start date of the contract.', $this->shared->get( 'slug' ) ),
			'filter'          => 'format_date_timestamp',
		),
		array(
			'database_column' => 'end_date',
			'label'           => __( 'End Date', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The end date of the contract.', $this->shared->get( 'slug' ) ),
			'filter'          => 'format_date_timestamp',
		),
		array(
			'database_column' => 'salary',
			'label'           => __( 'Salary', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The salary of the player.', $this->shared->get( 'slug' ) ),
			'filter'          => 'money_format',
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_team_contracts' ), 10 ),

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
			'column'                  => 'team_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Team', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The team of the player.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_teams(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'team_contract_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Contract Type', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The contract type.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_team_contract_types(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'start_date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Start Date', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The start date of the contract.', $this->shared->get( 'slug' ) ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'required'                => true,
			'searchable'              => false,
		),
		array(
			'column'                  => 'end_date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'End Date', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The end date of the contract.', $this->shared->get( 'slug' ) ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'required'                => true,
			'searchable'              => false,
		),
		array(
			'column'                  => 'salary',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Salary', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The salary of the contract.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
	),

	// Blocking Conditions
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
			'status'  => $menu_utility->num_of_team_contract_types() === 0,
			'message' => __( 'Please add at least one team contract type with the', $this->shared->get( 'slug' ) ) .
						'&nbsp' .
						'<a href="' . get_admin_url() . 'admin.php?page=dase-team-contract-types">' .
						__( 'Team Contract Types', $this->shared->get( 'slug' ) ) .
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
	),

);
$menu->generate_menu();
