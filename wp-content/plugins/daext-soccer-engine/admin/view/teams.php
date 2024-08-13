<?php
/**
 * Settings to display the "Teams" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'team',
	'database_column_primary_key'   => 'team_id',

	// Menu.
	'url_slug'                      => 'teams',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Team', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Teams', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create Team', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Team', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Team', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Team', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The team has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The team has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The team has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'teams_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'team_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the team.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The name of the team.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'type',
			'label'           => __( 'Type', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The type of team.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_team_type_name',
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_teams' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The name of the team.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'description',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Description', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The description of the team.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'logo',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Logo', $this->shared->get( 'slug' ) ),
			'instructions'            => __( 'Select a logo that represents this team.', $this->shared->get( 'slug' ) ),
			'set_image'               => __( 'Set Image', $this->shared->get( 'slug' ) ),
			'remove_image'            => __( 'Remove Image', $this->shared->get( 'slug' ) ),
			'type'                    => 'image',
			'maxlength'               => '2083',
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'type',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Type', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The type of team.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 0,
					'text'     => 'Club',
					'selected' => true,
				),
				array(
					'value'    => 1,
					'text'     => 'National Team',
					'selected' => false,
				),
			),
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'club_nation',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Club Nation', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The club nation.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_countries(),
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'national_team_confederation',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'National Team Confederation', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The national team confederation.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_national_team_confederations(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'stadium_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Stadium', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The stadium of the team.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_stadiums( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'full_name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Full Name', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The full name of the team.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'address',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Address', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The address of the team.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'tel',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Tel', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The telephone number of the team.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'fax',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Fax', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The fax number of the team.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'website_url',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Website URL', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The website URL of the team.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'foundation_date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Foundation Date', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The foundation date of the team.', $this->shared->get( 'slug' ) ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
	),

);
$menu->generate_menu();
