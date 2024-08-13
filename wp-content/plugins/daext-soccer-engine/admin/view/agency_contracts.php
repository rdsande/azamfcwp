<?php
/**
 * Settings to display the "Agency Contracts" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'agency_contract',
	'database_column_primary_key'   => 'agency_contract_id',

	// Menu.
	'url_slug'                      => 'agency-contracts',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Agency Contract', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Agency Contracts', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Agency Contract', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Agency Contract', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Agency Contract', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Agency Contract', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The contract has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The contract has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The contract has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'agency_contracts_validation',

	// Pagination Columns
	'pagination_columns'            => array(
		array(
			'database_column' => 'agency_contract_id',
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
			'database_column' => 'agency_id',
			'label'           => __( 'Agency', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The agency of the player.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_agency_name',
		),
		array(
			'database_column' => 'agency_contract_type_id',
			'label'           => __( 'Agency Contract Type', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The contract type.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_agency_contract_type_name',
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
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_agency_contracts' ), 10 ),

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
			'column'                  => 'agency_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Agency', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The agency.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_agencies(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'agency_contract_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Contract Type', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The contract type.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_agency_contract_types(),
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
			'status'  => $menu_utility->num_of_agency_contract_types() === 0,
			'message' => __( 'Please add at least one contract type with the', $this->shared->get( 'slug' ) ) .
						'&nbsp' .
						'<a href="' . get_admin_url() . 'admin.php?page=dase-agency-contract-types">' .
						__( 'Agency Contract Types', $this->shared->get( 'slug' ) ) .
						'</a> ' .
						__( 'menu', $this->shared->get( 'slug' ) ) .
						'.',
		),
		array(
			'status'  => $menu_utility->num_of_agencies() === 0,
			'message' => __( 'Please add at least one agency with the', $this->shared->get( 'slug' ) ) .
						'&nbsp' .
						'<a href="' . get_admin_url() . 'admin.php?page=dase-agencies">' .
						__( 'Teams', $this->shared->get( 'slug' ) ) .
						'</a> ' .
						__( 'menu', $this->shared->get( 'slug' ) ) .
						'.',
		),
	),

);
$menu->generate_menu();
