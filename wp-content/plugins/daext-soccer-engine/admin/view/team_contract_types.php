<?php
/**
 * Settings to display the "Team Contract Types" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'team_contract_type',
	'database_column_primary_key'   => 'team_contract_type_id',

	// Menu.
	'url_slug'                      => 'team-contract-types',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Team Contract Type', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Team Contract Types', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Team Contract Type', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Team Contract Type', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Team Contract Type', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Team Contract Type', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The team contract type has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The team contract type has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The team contract type has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'team_contract_types_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'team_contract_type_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the team contract type.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The name of the team contract type.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'description',
			'label'           => __( 'Description', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The description of the team contract type.', $this->shared->get( 'slug' ) ),
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_team_contract_types' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The name of the team contract type.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'description',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Description', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The description of the team contract type.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
	),
);
$menu->generate_menu();
