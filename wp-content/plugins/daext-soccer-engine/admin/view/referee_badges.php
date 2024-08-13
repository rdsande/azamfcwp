<?php
/**
 * Settings to display the "Referee Badges" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'referee_badge',
	'database_column_primary_key'   => 'referee_badge_id',

	// Menu.
	'url_slug'                      => 'referee-badges',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Referee Badge', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Referee Badges', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Referee Badge', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Referee Badge', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Referee Badge', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Referee Badge', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The referee badge has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The referee badge has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The referee badge has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'referee_badges_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'referee_badge_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the referee badge.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'referee_id',
			'label'           => __( 'Referee', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The referee.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_referee_name',
		),
		array(
			'database_column' => 'referee_badge_type_id',
			'label'           => __( 'Referee Badge Type', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The name of the referee badge type.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_referee_badge_type_name',
		),
		array(
			'database_column' => 'start_date',
			'label'           => __( 'Start Date', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The start date of the referee badge.', $this->shared->get( 'slug' ) ),
			'filter'          => 'format_date_timestamp',
		),
		array(
			'database_column' => 'end_date',
			'label'           => __( 'End Date', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The end date of the referee badge.', $this->shared->get( 'slug' ) ),
			'filter'          => 'format_date_timestamp',
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_referee_badges' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'referee_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Referee', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The referee.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_referees(),
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'referee_badge_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Referee Badge Type', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The referee badge type.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_referee_badge_types(),
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
			'status'  => $menu_utility->num_of_referees() === 0,
			'message' => __( 'Please add at least one referee with the', $this->shared->get( 'slug' ) ) .
						'&nbsp' .
						'<a href="' . get_admin_url() . 'admin.php?page=dase-referees">' .
						__( 'Referees', $this->shared->get( 'slug' ) ) .
						'</a> ' .
						__( 'menu', $this->shared->get( 'slug' ) ) .
						'.',
		),
		array(
			'status'  => $menu_utility->num_of_referee_badge_types() === 0,
			'message' => __( 'Please add at least one referee badge type with the', $this->shared->get( 'slug' ) ) .
						'&nbsp' .
						'<a href="' . get_admin_url() . 'admin.php?page=dase-referee-badge-types">' .
						__( 'Referee Badge Types', $this->shared->get( 'slug' ) ) .
						'</a> ' .
						__( 'menu', $this->shared->get( 'slug' ) ) .
						'.',
		),
	),

);
$menu->generate_menu();
