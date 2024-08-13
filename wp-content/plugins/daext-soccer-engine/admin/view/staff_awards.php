<?php
/**
 * Settings to display the "Staff Awards" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'staff_award',
	'database_column_primary_key'   => 'staff_award_id',

	// Menu.
	'url_slug'                      => 'staff-awards',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Staff Award', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Staff Awards', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Staff Award', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Staff Award', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Staff Award', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Staff Award', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The staff award has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The staff award has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The staff award has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'staff_awards_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'staff_award_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the staff award.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'staff_id',
			'label'           => __( 'Staff', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The staff name.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_staff_name',
		),
		array(
			'database_column' => 'staff_award_type_id',
			'label'           => __( 'Staff Award Type', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The staff award type.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_staff_award_type_name',
		),
		array(
			'database_column' => 'assignment_date',
			'label'           => __( 'Assignment Date', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The assignment date.', $this->shared->get( 'slug' ) ),
			'filter'          => 'format_date_timestamp',
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_staff_awards' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'staff_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Staff', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The staff member.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_staff(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'staff_award_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Staff Award Type', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The staff award type.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_staff_award_types(),
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
			'status'  => $menu_utility->num_of_staff_award_types() === 0,
			'message' => __( 'Please add at least one staff award type with the', $this->shared->get( 'slug' ) ) .
						'&nbsp' .
						'<a href="' . get_admin_url() . 'admin.php?page=dase-staff-award-types">' .
						__( 'Staff Award Types', $this->shared->get( 'slug' ) ) .
						'</a> ' .
						__( 'menu', $this->shared->get( 'slug' ) ) .
						'.',
		),
		array(
			'status'  => $menu_utility->num_of_staffs() === 0,
			'message' => __( 'Please add at least one staff with the', $this->shared->get( 'slug' ) ) .
						'&nbsp' .
						'<a href="' . get_admin_url() . 'admin.php?page=dase-staff">' .
						__( 'Staff', $this->shared->get( 'slug' ) ) .
						'</a> ' .
						__( 'menu', $this->shared->get( 'slug' ) ) .
						'.',
		),
	),

);
$menu->generate_menu();
