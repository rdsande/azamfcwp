<?php
/**
 * Settings to display the "Referees" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'referee',
	'database_column_primary_key'   => 'referee_id',

	// Menu.
	'url_slug'                      => 'referees',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Referee', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Referees', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Referee', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Referee', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Referee', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Referee', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The referee has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The referee has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The referee has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'referees_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'referee_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the referee.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'first_name',
			'label'           => __( 'First Name', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The first name of the referee.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'last_name',
			'label'           => __( 'Last Name', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The last name of the referee.', $this->shared->get( 'slug' ) ),
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_referees' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'first_name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'First Name', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The first name of the referee.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'last_name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Last Name', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The last name of the referee.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'image',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Image', $this->shared->get( 'slug' ) ),
			'instructions'            => __( 'Select an image that represents this referee.', $this->shared->get( 'slug' ) ),
			'set_image'               => __( 'Set Image', $this->shared->get( 'slug' ) ),
			'remove_image'            => __( 'Remove Image', $this->shared->get( 'slug' ) ),
			'type'                    => 'image',
			'maxlength'               => '2083',
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'gender',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Gender', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The gender of the referee.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 0,
					'text'     => __( 'Male', 'dase' ),
					'selected' => true,
				),
				array(
					'value'    => 1,
					'text'     => __( 'Female', 'dase' ),
					'selected' => false,
				),
			),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'date_of_birth',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Date of Birth', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The date of birth of the referee.', $this->shared->get( 'slug' ) ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'date_of_death',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Date of Death', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The date of death of the referee.', $this->shared->get( 'slug' ) ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'citizenship',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Citizenship', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The citizenship of the referee.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_countries( false ),
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'second_citizenship',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Second citizenship', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The second citizenship of the referee.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_countries( true ),
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'retired',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Retired', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The retired status of the referee.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 0,
					'text'     => __( 'No', 'dase' ),
					'selected' => true,
				),
				array(
					'value'    => 1,
					'text'     => __( 'Yes', 'dase' ),
					'selected' => false,
				),
			),
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'place_of_birth',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Place of Birth', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The place of birth of the referee.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'residence',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Residence', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The residence of the referee.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'job',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Job', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The job of the referee.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => false,
			'searchable'              => true,
		),
	),
);
$menu->generate_menu();
