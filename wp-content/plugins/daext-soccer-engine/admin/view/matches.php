<?php
/**
 * Settings to display the "Matches" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'match',
	'database_column_primary_key'   => 'match_id',

	// Menu.
	'url_slug'                      => 'matches',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Match', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Matches', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create Match', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Match', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Match', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Match', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The match has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The match has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The match has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'matches_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'match_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the match.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The name of the match.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'team_id_1',
			'label'           => __( 'Team 1', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The team 1 of the match.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_team_name',
		),
		array(
			'database_column' => 'team_id_2',
			'label'           => __( 'Team 2', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The team 2 of the match.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_team_name',
		),
		array(
			'database_column' => 'date',
			'label'           => __( 'Date', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The date of the match.', $this->shared->get( 'slug' ) ),
			'filter'          => 'format_date_timestamp',
		),
		array(
			'database_column' => 'time',
			'label'           => __( 'Time', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The time of the match.', $this->shared->get( 'slug' ) ),
			'filter'          => 'format_time',
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_matches' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The name of the match.', $this->shared->get( 'slug' ) ),
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
			'column'                  => 'competition_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Competition', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The competition of the match.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_competitions( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'round',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Round', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The round of the competition.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 1,
					'text'     => '1',
					'selected' => true,
				),
				array(
					'value'    => 2,
					'text'     => '2',
					'selected' => false,
				),
				array(
					'value'    => 3,
					'text'     => '3',
					'selected' => false,
				),
				array(
					'value'    => 4,
					'text'     => '4',
					'selected' => false,
				),
			),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'type',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Type', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The type of round of the competition.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 0,
					'text'     => __( 'Single Leg', 'dase' ),
					'selected' => true,
				),
				array(
					'value'    => 1,
					'text'     => __( 'First Leg', 'dase' ),
					'selected' => false,
				),
				array(
					'value'    => 2,
					'text'     => __( 'Second Leg', 'dase' ),
					'selected' => false,
				),
			),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'team_id_1',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Team 1', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The team 1 of the match.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_teams(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'searchable'              => false,
		),
		array(
			'column'                  => 'team_id_2',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Team 2', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The team 2 of the match.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_teams(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'squad_id_1',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Import Squad 1', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'Use this selector to import the lineup, the substitutes, the staff members and the advanced options of team 1 from a squad.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_squads( true ),
			'validation_regex'        => null,
			'searchable'              => false,
			'unsaved'                 => true,
		),
		array(
			'column'                  => 'squad_id_2',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Import Squad 2', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'Use this selector to import the lineup, the substitutes, the staff members and the advanced options of team 2 from a squad.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_squads( true ),
			'validation_regex'        => null,
			'searchable'              => false,
			'required'                => false,
			'unsaved'                 => true,
		),
		array(
			'column'                  => 'date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Date', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The date of the match.', $this->shared->get( 'slug' ) ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'required'                => true,
			'searchable'              => false,
		),
		array(
			'column'                  => 'time',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Time', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The time of the match in the HH:MM format. E.g. 9:30, 15:00, 20:45', $this->shared->get( 'slug' ) ),
			'type'                    => 'time',
			'maxlength'               => '5',
			'required'                => true,
			'searchable'              => false,
		),
		array(
			'target' => 'additional-information',
			'label'  => __( 'Additional Information', $this->shared->get( 'slug' ) ),
			'type'   => 'group-trigger',
		),
		array(
			'class'                   => 'additional-information',
			'column'                  => 'fh_additional_time',
			'query_placeholder_token' => 's',
			'label'                   => __( 'First Half Additional Time', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The additional time of the first half in minutes.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'value'                   => '0',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'class'                   => 'additional-information',
			'column'                  => 'sh_additional_time',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Second Half Additional Time', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The additional time of the second half in minutes.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'value'                   => '0',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'class'                   => 'additional-information',
			'column'                  => 'fh_extra_time_additional_time',
			'query_placeholder_token' => 's',
			'label'                   => __( 'First Half Extra Time Additional Time', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The additional time of the first half extra time in minutes.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'value'                   => '0',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'class'                   => 'additional-information',
			'column'                  => 'sh_extra_time_additional_time',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Second Half Extra Time Additional Time', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The additional time of the second half extra time in minutes.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'value'                   => '0',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'class'                   => 'additional-information',
			'column'                  => 'referee_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Referee', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The referee of the match.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_referees( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'class'                   => 'additional-information',
			'column'                  => 'stadium_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Stadium', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The stadium of the match.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_stadiums( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'class'                   => 'additional-information',
			'column'                  => 'attendance',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Attendance', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The attendance of the match.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '10',
			'value'                   => '0',
			'required'                => false,
			'searchable'              => true,
		),
	),

	// Blocking Conditions
	'blocking_conditions'           => array(
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

for ( $t = 1;$t <= 2;$t++ ) {

	$menu->settings['fields'][] = array(
		'target' => 'lineup-team-' . $t,
		'label'  => __( 'Lineup Team', $this->shared->get( 'slug' ) ) . ' ' . $t,
		'type'   => 'group-trigger',
	);

	for ( $i = 1;$i <= 11;$i++ ) {
		$menu->settings['fields'][] = array(
			'class'                   => 'lineup-team-' . $t,
			'column'                  => 'team_' . $t . '_lineup_player_id_' . $i,
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Player', $this->shared->get( 'slug' ) ) . ' ' . $i,
			'tooltip'                 => __( 'The player', $this->shared->get( 'slug' ) ) . ' ' . $i . ' ' . __( 'of team', $this->shared->get( 'slug' ) ) . ' ' . $t . '.',
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_players( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		);
	}

	$menu->settings['fields'][] = array(
		'target' => 'substitutes-team-' . $t,
		'label'  => __( 'Substitutes Team', $this->shared->get( 'slug' ) ) . ' ' . $t,
		'type'   => 'group-trigger',
	);

	for ( $i = 1;$i <= 20;$i++ ) {
		$menu->settings['fields'][] = array(
			'class'                   => 'substitutes-team-' . $t,
			'column'                  => 'team_' . $t . '_substitute_player_id_' . $i,
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Substitute', $this->shared->get( 'slug' ) ) . ' ' . $i,
			'tooltip'                 => __( 'The substitute', $this->shared->get( 'slug' ) ) . ' ' . $i . ' ' . __( 'of team', $this->shared->get( 'slug' ) ) . ' ' . $t . '.',
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_players( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		);
	}

	$menu->settings['fields'][] = array(
		'target' => 'staff-team-' . $t,
		'label'  => __( 'Staff Team', $this->shared->get( 'slug' ) ) . ' ' . $t,
		'type'   => 'group-trigger',
	);

	for ( $i = 1;$i <= 20;$i++ ) {
		$menu->settings['fields'][] = array(
			'class'                   => 'staff-team-' . $t,
			'column'                  => 'team_' . $t . '_staff_id_' . $i,
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Staff', $this->shared->get( 'slug' ) ) . ' ' . $i,
			'tooltip'                 => __( 'The staff', $this->shared->get( 'slug' ) ) . ' ' . $i . ' ' . __( 'of team', $this->shared->get( 'slug' ) ) . ' ' . $t . '.',
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_staff( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		);
	}

	$menu->settings['fields'][] = array(
		'target' => 'advanced-team-' . $t,
		'label'  => __( 'Advanced Team', $this->shared->get( 'slug' ) ) . ' ' . $t,
		'type'   => 'group-trigger',
	);

	$menu->settings['fields'][] = array(
		'class'                   => 'advanced-team-' . $t,
		'column'                  => 'team_' . $t . '_formation_id',
		'query_placeholder_token' => 'd',
		'label'                   => __( 'Formation', $this->shared->get( 'slug' ) ),
		'tooltip'                 => __( 'The formation', $this->shared->get( 'slug' ) ) . ' ' . __( 'of team', $this->shared->get( 'slug' ) ) . ' ' . $t . '.',
		'type'                    => 'select',
		'select_items'            => $menu_utility->select_formations( true ),
		'validation_regex'        => null,
		'maxlength'               => '1',
		'required'                => false,
		'searchable'              => false,
	);

	$menu->settings['fields'][] = array(
		'class'                   => 'advanced-team-' . $t,
		'column'                  => 'team_' . $t . '_jersey_set_id',
		'query_placeholder_token' => 'd',
		'label'                   => __( 'Jersey Set', $this->shared->get( 'slug' ) ),
		'tooltip'                 => __( 'The jersey set', $this->shared->get( 'slug' ) ) . ' ' . __( 'of team', $this->shared->get( 'slug' ) ) . ' ' . $t . '.',
		'type'                    => 'select',
		'select_items'            => $menu_utility->select_jersey_sets( true ),
		'validation_regex'        => null,
		'maxlength'               => '1',
		'required'                => false,
		'searchable'              => false,
	);

}

$menu->generate_menu();
