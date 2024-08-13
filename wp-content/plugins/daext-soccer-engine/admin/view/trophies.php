<?php
/**
 * Settings to display the "Trophies" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'trophy',
	'database_column_primary_key'   => 'trophy_id',

	// Menu.
	'url_slug'                      => 'trophies',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Trophy', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Trophies', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Trophy', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Trophy', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Trophy', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Trophy', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The trophy has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The trophy has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The trophy has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'trophies_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'trophy_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the trophy.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'trophy_type_id',
			'label'           => __( 'Trophy Type', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The trophy type.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_trophy_type_name',
		),
		array(
			'database_column' => 'team_id',
			'label'           => __( 'Team', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The team.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_team_name',
		),
		array(
			'database_column' => 'assignment_date',
			'label'           => __( 'Assignment Date', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The assignment date.', $this->shared->get( 'slug' ) ),
			'filter'          => 'format_date_timestamp',
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_trophies' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'trophy_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Trophy Type', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The trophy type.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_trophy_types(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'team_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Team', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The team associated with the trophy.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_teams(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'assignment_date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Assignment Date', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The assignment date.', $this->shared->get( 'slug' ) ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'required'                => true,
			'searchable'              => false,
		),
	),

	// Blocking Conditions.
	'blocking_conditions'           => array(
		array(
			'status'  => $menu_utility->num_of_trophy_types() === 0,
			'message' => __( 'Please add at least one trophy type with the', $this->shared->get( 'slug' ) ) .
						'&nbsp' .
						'<a href="' . get_admin_url() . 'admin.php?page=dase-trophy-types">' .
						__( 'Trophy Types', $this->shared->get( 'slug' ) ) .
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
