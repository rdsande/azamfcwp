<?php
/**
 * Settings to display the "Agencies" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'agency',
	'database_column_primary_key'   => 'agency_id',

	// Menu.
	'url_slug'                      => 'agencies',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Agency', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Agencies', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Agency', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Agency', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Agency', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Agency', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The agency has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The agency has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The agency has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'agencies_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'agency_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the Agency.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The name of the agency.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'description',
			'label'           => __( 'Description', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The description of the agency.', $this->shared->get( 'slug' ) ),
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_agencies' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The name of the agency.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'description',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Description', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The description of the agency.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'full_name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Full Name', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The full name of the agency.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'address',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Address', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The address of the agency.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'tel',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Telephone Number', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The telephone number of the agency.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'fax',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Fax Number', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The fax number of the agency.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'website',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Website', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The website of the agency.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '2083',
			'required'                => false,
			'searchable'              => true,
		),
	),
);
$menu->generate_menu();
