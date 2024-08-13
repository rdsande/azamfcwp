<?php
/**
 * Settings to display the "Events" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'event',
	'database_column_primary_key'   => 'event_id',

	// Menu.
	'url_slug'                      => 'events',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Event', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Events', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Event', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Event', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Event', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Event', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The event has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The event has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The event has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'events_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'event_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the event.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'data',
			'label'           => __( 'Data', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The type of data associated with the event.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_data_name',
		),
		array(
			'database_column' => 'match_id',
			'label'           => __( 'Match', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The match of the event.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_match_name',
		),
		array(
			'database_column' => 'team_slot',
			'label'           => __( 'Team', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The team of the event.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_team_slot_name',
		),
		array(
			'database_column' => 'match_effect',
			'label'           => __( 'Match Effect', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The effect of the event on the match.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_match_effect_name',
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_events' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'data',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Data', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The type of data associated with the event.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 0,
					'text'     => __( 'Basic', 'dase' ),
					'selected' => false,
				),
				array(
					'value'    => 1,
					'text'     => __( 'Complete', 'dase' ),
					'selected' => true,
				),
			),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'match_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Match', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The match of the event.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_matches(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'team_slot',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Team', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The team of the event.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 0,
					'text'     => __( 'Team 1', 'dase' ),
					'selected' => false,
				),
				array(
					'value'    => 1,
					'text'     => __( 'Team 2', 'dase' ),
					'selected' => false,
				),
			),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'match_effect',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Match Effect', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The effect of the event on the match.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_match_effects(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'player_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Player', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The player who caused the event.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_players( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'player_id_substitution_out',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Player Substitution Out', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The replaced player of a substitution event.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_players( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'player_id_substitution_in',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Player Substitution In', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The new player of a substitution event.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_players( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'staff_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Staff', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The staff member who caused the event.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_staff( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'part',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Part', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The part of the match.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_parts(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'time',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Time', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The time of the event in the selected match part.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '2',
			'value'                   => '1',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'additional_time',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Additional Time', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The additional time of the event in the selected match part.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '2',
			'value'                   => '0',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'description',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Description', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The description of the event.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '1000',
			'required'                => true,
			'searchable'              => true,
		),
	),

	// Blocking Conditions.
	'blocking_conditions'           => array(
		array(
			'status'  => $this->shared->get_number_of_matches() === 0,
			'message' => __( 'Please add at least one match with the', $this->shared->get( 'slug' ) ) .
						'&nbsp' .
						'<a href="' . get_admin_url() . 'admin.php?page=dase-matches">' .
						__( 'Matches', $this->shared->get( 'slug' ) ) .
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
