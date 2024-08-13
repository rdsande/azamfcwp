<?php
/**
 * Enqueue the Gutenberg block assets for the backend.
 *
 * @package daext-soccer-engine
 */

// Prevent direct access to this file.
if ( ! defined( 'WPINC' ) ) {
	die();
}

/**
 * Enqueue the Gutenberg block assets for the backend.
 *
 * 'wp-blocks': includes block type registration and related functions.
 * 'wp-element': includes the WordPress Element abstraction for describing the structure of your blocks.
 */
function dase_editor_assets() {

	$shared = dase_Shared::get_instance();

	// Styles ---------------------------------------------------------------------------------------------------------.

	// Block.
	wp_enqueue_style(
		'dase-editor-css',
		plugins_url( 'dist/editor.css', __DIR__ ),
		array( 'wp-edit-blocks' )// Dependency to include the CSS after it.
	);

	// Scripts --------------------------------------------------------------------------------------------------------.

	// Block.
	wp_enqueue_script(
		'dase-editor-js', // Handle.
		plugins_url( '/dist/blocks.build.js', __DIR__ ), // We register the block here.
		array( 'wp-blocks', 'wp-element' ), // Dependencies.
		false,
		true // Enqueue the script in the footer.
	);

	/*
	 * Add the translations associated with this script in the JED/json format.
	 *
	 * Reference: https://make.wordpress.org/core/2018/11/09/new-javascript-i18n-support-in-wordpress/
	 *
	 * Argument 1: Handler
	 * Argument 2: Domain
	 * Argument 3: Location where the JED/json file is located.
	 *
	 * Note that:
	 *
	 * - The JED/json file should be named [domain]-[locale]-[handle].json to be actually detected by WordPress.
	 * - The JED/json file is generated with https://github.com/mikeedwards/po2json from the .po file
	 */
	wp_set_script_translations( 'dase-editor-js', 'dase', $shared->get( 'dir' ) . 'blocks/lang' );
}

add_action( 'enqueue_block_editor_assets', 'dase_editor_assets' );

/**
 * Enqueue the Gutenberg block assets for both frontend and backend.
 */
function dase_style_assets() {

	// Not used with this block.
	return;

	// Styles ---------------------------------------------------------------------------------------------------------.
	wp_enqueue_style(
		'dase-style-css',
		plugins_url( 'dist/style.css', __DIR__ ),
		array( 'wp-blocks' )// Dependency to include the CSS after it.
	);
}

add_action( 'enqueue_block_assets', 'dase_style_assets' );

/**
 * Add the Soccer Engine block category.
 *
 * @param $categories
 * @param $post
 *
 * @return array
 */
function add_dase_soccer_engine( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'dase-soccer-engine',
				'title' => __( 'Soccer Engine', 'dase' ),
			),
		)
	);
}

add_filter( 'block_categories_all', 'add_dase_soccer_engine', 10, 2 );

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_player_summary_render( $attributes ) {

	if ( isset( $attributes['playerId'] ) ) {
		$public = dase_Public::get_instance();

		return $public->player_summary(
			array(
				'player-id' => $attributes['playerId'],
			)
		);
	}
}

register_block_type(
	'dase/player-summary',
	array(
		'render_callback' => 'dase_player_summary_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function dase_transfers_render( $attributes ) {

	if ( isset( $attributes['playerId'] ) ) {
		$public = dase_Public::get_instance();

		return $public->transfers(
			array(
				'player-id'                   => $attributes['playerId'],
				'transfer-type-id'            => $attributes['transferTypeId'],
				'team-id-left'                => $attributes['teamIdLeft'],
				'team-id-joined'              => $attributes['teamIdJoined'],
				'start-date'                  => $attributes['startDate'],
				'end-date'                    => $attributes['endDate'],
				'fee-lower-limit'             => $attributes['feeLowerLimit'],
				'fee-higher-limit'            => $attributes['feeHigherLimit'],
				'columns'                     => $attributes['columns'],
				'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
				'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
				'pagination'                  => $attributes['pagination'],
			)
		);
	}
}

register_block_type(
	'dase/transfers',
	array(
		'render_callback' => 'dase_transfers_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_team_contracts_render( $attributes ) {

	if ( isset( $attributes['teamId'] ) &&
		isset( $attributes['teamContractTypeId'] ) ) {
		$public = dase_Public::get_instance();

		return $public->team_contracts(
			array(
				'team-id'                     => $attributes['teamId'],
				'team-contract-type-id'       => $attributes['teamContractTypeId'],
				'columns'                     => $attributes['columns'],
				'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
				'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
				'pagination'                  => $attributes['pagination'],
			)
		);
	}
}

register_block_type(
	'dase/team-contracts',
	array(
		'render_callback' => 'dase_team_contracts_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string|void
 */
function dase_agency_contracts_render( $attributes ) {

	if ( isset( $attributes['agencyId'] ) ) {
		$public = dase_Public::get_instance();

		return $public->agency_contracts(
			array(
				'agency-id'                   => $attributes['agencyId'],
				'agency-contract-type-id'     => $attributes['agencyContractTypeId'],
				'columns'                     => $attributes['columns'],
				'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
				'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
				'pagination'                  => $attributes['pagination'],
			)
		);
	}
}

register_block_type(
	'dase/agency-contracts',
	array(
		'render_callback' => 'dase_agency_contracts_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_players_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->players(
		array(
			'start-date-of-birth'         => $attributes['startDateOfBirth'],
			'end-date-of-birth'           => $attributes['endDateOfBirth'],
			'citizenship'                 => $attributes['citizenship'],
			'foot'                        => $attributes['foot'],
			'player-position-id'          => $attributes['playerPositionId'],
			'squad-id'                    => $attributes['squadId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/players',
	array(
		'render_callback' => 'dase_players_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_player_awards_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->player_awards(
		array(
			'player-award-type-id'        => $attributes['playerAwardTypeId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/player-awards',
	array(
		'render_callback' => 'dase_player_awards_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_unavailable_players_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->unavailable_players(
		array(
			'player-id'                   => $attributes['playerId'],
			'unavailable-player-type-id'  => $attributes['unavailablePlayerTypeId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/unavailable-players',
	array(
		'render_callback' => 'dase_unavailable_players_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_injuries_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->injuries(
		array(
			'player-id'                   => $attributes['playerId'],
			'injury-type-id'              => $attributes['injuryTypeId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/injuries',
	array(
		'render_callback' => 'dase_injuries_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_staff_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->staff(
		array(
			'retired'                     => $attributes['retired'],
			'gender'                      => $attributes['gender'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/staff',
	array(
		'render_callback' => 'dase_staff_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_staff_award_type_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->staff_awards(
		array(
			'staff-award-type-id'         => $attributes['staffAwardTypeId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/staff-awards',
	array(
		'render_callback' => 'dase_staff_award_type_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_trophies_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->trophies(
		array(
			'trophy-type-id'              => $attributes['trophyTypeId'],
			'team-id'                     => $attributes['teamId'],
			'start-assignment-date'       => $attributes['startAssignmentDate'],
			'end-assignment-date'         => $attributes['endAssignmentDate'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/trophies',
	array(
		'render_callback' => 'dase_trophies_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_matches_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->matches(
		array(
			'team-id-1'                   => $attributes['teamId1'],
			'team-id-2'                   => $attributes['teamId2'],
			'start-date'                  => $attributes['startDate'],
			'end-date'                    => $attributes['endDate'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/matches',
	array(
		'render_callback' => 'dase_matches_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_ranking_transitions_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->ranking_transitions(
		array(
			'team-id'                     => $attributes['teamId'],
			'ranking-type-id'             => $attributes['rankingTypeId'],
			'start-date'                  => $attributes['startDate'],
			'end-date'                    => $attributes['endDate'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/ranking-transitions',
	array(
		'render_callback' => 'dase_ranking_transitions_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_ranking_transitions_chart_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->ranking_transitions_chart(
		array(
			'team-id-1'       => $attributes['teamId1'],
			'team-id-2'       => $attributes['teamId2'],
			'team-id-3'       => $attributes['teamId3'],
			'team-id-4'       => $attributes['teamId4'],
			'ranking-type-id' => $attributes['rankingTypeId'],
			'start-date'      => $attributes['startDate'],
			'end-date'        => $attributes['endDate'],
		)
	);
}

register_block_type(
	'dase/ranking-transitions-chart',
	array(
		'render_callback' => 'dase_ranking_transitions_chart_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_market_value_transitions_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->market_value_transitions(
		array(
			'player-id'                   => $attributes['playerId'],
			'start-date'                  => $attributes['startDate'],
			'end-date'                    => $attributes['endDate'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/market-value-transitions',
	array(
		'render_callback' => 'dase_market_value_transitions_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_market_value_transitions_chart_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->market_value_transitions_chart(
		array(
			'player-id-1' => $attributes['playerId1'],
			'player-id-2' => $attributes['playerId2'],
			'player-id-3' => $attributes['playerId3'],
			'player-id-4' => $attributes['playerId4'],
			'start-date'  => $attributes['startDate'],
			'end-date'    => $attributes['endDate'],
		)
	);
}

register_block_type(
	'dase/market-value-transitions-chart',
	array(
		'render_callback' => 'dase_market_value_transitions_chart_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_match_timeline_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->match_timeline(
		array(
			'match-id'     => $attributes['matchId'],
			'match-effect' => $attributes['matchEffect'],
		)
	);
}

register_block_type(
	'dase/match-timeline',
	array(
		'render_callback' => 'dase_match_timeline_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_match_commentary_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->match_commentary(
		array(
			'match-id' => $attributes['matchId'],
		)
	);
}

register_block_type(
	'dase/match-commentary',
	array(
		'render_callback' => 'dase_match_commentary_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_match_lineup_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->match_lineup(
		array(
			'match-id'                    => $attributes['matchId'],
			'team-slot'                   => $attributes['teamSlot'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/match-lineup',
	array(
		'render_callback' => 'dase_match_lineup_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_match_visual_lineup_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->match_visual_lineup(
		array(
			'match-id'  => $attributes['matchId'],
			'team-slot' => $attributes['teamSlot'],
		)
	);
}

register_block_type(
	'dase/match-visual-lineup',
	array(
		'render_callback' => 'dase_match_visual_lineup_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_match_substitutions_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->match_substitutions(
		array(
			'match-id'                    => $attributes['matchId'],
			'team-slot'                   => $attributes['teamSlot'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/match-substitutions',
	array(
		'render_callback' => 'dase_match_substitutions_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_match_staff_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->match_staff(
		array(
			'match-id'                    => $attributes['matchId'],
			'team-slot'                   => $attributes['teamSlot'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/match-staff',
	array(
		'render_callback' => 'dase_match_staff_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_squad_lineup_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->squad_lineup(
		array(
			'squad-id'                    => $attributes['squadId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/squad-lineup',
	array(
		'render_callback' => 'dase_squad_lineup_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_squad_substitutions_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->squad_substitutions(
		array(
			'squad-id'                    => $attributes['squadId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/squad-substitutions',
	array(
		'render_callback' => 'dase_squad_substitutions_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_squad_staff_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->squad_staff(
		array(
			'squad-id'                    => $attributes['squadId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/squad-staff',
	array(
		'render_callback' => 'dase_squad_staff_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_competition_standings_table_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->competition_standings_table(
		array(
			'competition-id'              => $attributes['competitionId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/competition-standings-table',
	array(
		'render_callback' => 'dase_competition_standings_table_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_competition_round_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->competition_round(
		array(
			'competition-id'              => $attributes['competitionId'],
			'round'                       => $attributes['round'],
			'type'                        => $attributes['type'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}

register_block_type(
	'dase/competition-round',
	array(
		'render_callback' => 'dase_competition_round_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_match_score_render( $attributes ) {

	$public = dase_Public::get_instance();

	return $public->match_score(
		array(
			'match-id' => $attributes['matchId'],
		)
	);
}

register_block_type(
	'dase/match-score',
	array(
		'render_callback' => 'dase_match_score_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_staff_summary_render( $attributes ) {

	if ( isset( $attributes['staffId'] ) ) {
		$public = dase_Public::get_instance();

		return $public->staff_summary(
			array(
				'staff-id' => $attributes['staffId'],
			)
		);
	}
}

register_block_type(
	'dase/staff-summary',
	array(
		'render_callback' => 'dase_staff_summary_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_referee_summary_render( $attributes ) {

	if ( isset( $attributes['refereeId'] ) ) {
		$public = dase_Public::get_instance();

		return $public->referee_summary(
			array(
				'referee-id' => $attributes['refereeId'],
			)
		);
	}
}

register_block_type(
	'dase/referee-summary',
	array(
		'render_callback' => 'dase_referee_summary_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_referee_statistics_by_competition_render( $attributes ) {

	if ( isset( $attributes['refereeId'] ) ) {
		$public = dase_Public::get_instance();

		return $public->referee_statistics_by_competition(
			array(
				'referee-id'                  => $attributes['refereeId'],
				'columns'                     => $attributes['columns'],
				'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
				'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
				'pagination'                  => $attributes['pagination'],
			)
		);
	}
}

register_block_type(
	'dase/referee-statistics-by-competition',
	array(
		'render_callback' => 'dase_referee_statistics_by_competition_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 *
 * @param array $attributes The block attributes.
 *
 * @return false|string
 */
function dase_referee_statistics_by_team_render( $attributes ) {

	if ( isset( $attributes['refereeId'] ) ) {
		$public = dase_Public::get_instance();

		return $public->referee_statistics_by_team(
			array(
				'referee-id'                  => $attributes['refereeId'],
				'columns'                     => $attributes['columns'],
				'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
				'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
				'pagination'                  => $attributes['pagination'],
			)
		);
	}
}

register_block_type(
	'dase/referee-statistics-by-team',
	array(
		'render_callback' => 'dase_referee_statistics_by_team_render',
	)
);
