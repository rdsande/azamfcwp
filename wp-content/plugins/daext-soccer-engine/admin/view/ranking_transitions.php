<?php
/**
 * Settings to display the "Ranking Transitions" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'ranking_transition',
	'database_column_primary_key'   => 'ranking_transition_id',

	// Menu.
	'url_slug'                      => 'ranking-transitions',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Ranking Transition', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Ranking Transitions', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Ranking Transition', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Ranking Transition', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Ranking Transition', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Ranking Transition', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The ranking transition has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The ranking transition has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The ranking transition has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'ranking_transitions_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'ranking_transition_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the ranking transition.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'team_id',
			'label'           => __( 'Team', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The team of the ranking transition.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_team_name',
		),
		array(
			'database_column' => 'ranking_type_id',
			'label'           => __( 'Ranking Type', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ranking type.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_ranking_type_name',
		),
		array(
			'database_column' => 'date',
			'label'           => __( 'Date', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The date of the ranking transition.', $this->shared->get( 'slug' ) ),
			'filter'          => 'format_date_timestamp',
		),
		array(
			'database_column' => 'value',
			'label'           => __( 'Value', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ranking value.', $this->shared->get( 'slug' ) ),
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_ranking_transitions' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'team_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Team', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The team of the ranking transition.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_teams(),
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'ranking_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Ranking Type', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The ranking type.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_ranking_types(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Date', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The date of the ranking transition.', $this->shared->get( 'slug' ) ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'required'                => true,
			'searchable'              => false,
		),
		array(
			'column'                  => 'value',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Value', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The ranking value.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'value'                   => '1',
			'required'                => true,
			'searchable'              => true,
		),
	),

	// Blocking Conditions.
	'blocking_conditions'           => array(
		array(
			'status'  => $menu_utility->num_of_ranking_types() === 0,
			'message' => __( 'Please add at least one ranking type with the', $this->shared->get( 'slug' ) ) .
						'&nbsp' .
						'<a href="' . get_admin_url() . 'admin.php?page=dase-ranking-types">' .
						__( 'Ranking Types', $this->shared->get( 'slug' ) ) .
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
