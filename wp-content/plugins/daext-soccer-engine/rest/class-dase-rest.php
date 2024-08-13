<?php
/**
 * This class should be used to work with the REST API.
 *
 * @package daext-soccer-engine
 */

/**
 * This class should be used to work with the REST API
 */
class Dase_Rest {

	// General class properties.
	protected static $instance             = null;
	private $shared                        = null;
	private $invalid_authentication_object = null;
	private $validation                    = array();

	private function __construct() {

		// Assign an instance of the plugin info.
		$this->shared = Dase_Shared::get_instance();

		$this->invalid_authentication_object = new WP_REST_Response( 'Invalid authentication.', '403' );

		/*
		 * Add custom routes to the Rest API
		 */
		add_action( 'rest_api_init', array( $this, 'rest_api_register_route' ) );

		// Assign an instance of the validation class to a class property.
		require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-validation.php';
		$this->validation = new Dase_Validation( $this->shared );
	}

	/**
	 * Create an instance of this class.
	 */
	public static function get_instance() {

		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/*
	 * Add custom routes to the Rest API.
	 */
	function rest_api_register_route() {

		// Add the GET 'daext-soccer-engine/v1/agencies' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/agencies',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_agencies_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/agency-contracts' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/agency-contracts',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_agency_contracts_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/agency-contract-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/agency-contract-types',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_agency_contract_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/competitions' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/competitions',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_competitions_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/events' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/events',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_events_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/formations' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/formations',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_formations_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/injuries' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/injuries',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_injuries_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/injury-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/injury-types',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_injury_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/jersey-sets' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/jersey-sets',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_jersey_sets_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/market-value-transitions' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/market-value-transitions',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_market_value_transitions_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/matches' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/matches',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_matches_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/players' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/players',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_players_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/player-awards' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/player-awards',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_player_awards_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/player-award-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/player-award-types',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_player_award_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/player-positions' endpoint to the Rest API
		register_rest_route(
			'daext-soccer-engine/v1',
			'/player-positions',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_player_positions_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/ranking-transitions' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/ranking-transitions',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_ranking_transitions_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/ranking-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/ranking-types',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_ranking_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/referees' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/referees',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_referees_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/referee-badges' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/referee-badges',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_referee_badges_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/referee-badge-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/referee-badge-types',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_referee_badge_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/squads' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/squads',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_squads_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/stadiums' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/stadiums',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_stadiums_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/staff' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/staff',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_staff_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/staff-awards' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/staff-awards',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_staff_awards_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/staff-award-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/staff-award-types',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_staff_award_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/staff-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/staff-types',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_staff_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/teams' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/teams',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_teams_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/team-contracts' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/team-contracts',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_team_contracts_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/team-contract-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/team-contract-types',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_team_contract_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/transfers' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/transfers',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_transfers_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/transfer-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/transfer-types',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_transfer_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/trophies' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/trophies',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_trophies_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/trophy-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/trophy-types',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_trophy_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/unavailable-players' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/unavailable-players',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_unavailable_players_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the GET 'daext-soccer-engine/v1/unavailable-player-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/unavailable-player-types',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_read_unavailable_player_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/events' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/events',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_event_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/players' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/players',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_player_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/player-positions' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/player-positions',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_player_positions_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/player-awards' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/player-awards',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_player_awards_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/player-award-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/player-award-types',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_player_award_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/unavailable-players' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/unavailable-players',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_unavailable_players_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/unavailable-player-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/unavailable-player-types',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_unavailable_player_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/injuries' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/injuries',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_injuries_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/injury-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/injury-types',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_injury_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/staff' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/staff',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_staff_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/staff-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/staff-types',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_staff_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/staff-awards' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/staff-awards',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_staff_awards_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/staff-award-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/staff-award-types',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_staff_award_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/referees' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/referees',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_referees_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/referee-badges' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/referee-badges',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_referee_badges_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/referee-badge-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/referee-badge-types',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_referee_badge_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/teams' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/teams',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_teams_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/squads' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/squads',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_squads_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/formations' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/formations',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_formations_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/jersey-sets' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/jersey-sets',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_jersey_sets_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/stadiums' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/stadiums',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_stadiums_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/trophies' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/trophies',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_trophies_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/trophy-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/trophy-types',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_trophy_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/ranking-transitions' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/ranking-transitions',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_ranking_transitions_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/ranking-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/ranking-types',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_ranking_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/matches' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/matches',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_matches_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/competitions' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/competitions',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_competitions_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/transfers' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/transfers',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_transfers_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/transfer_types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/transfer_types',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_transfer_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/team-contracts' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/team-contracts',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_team_contracts_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/team-contract-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/team-contract-types',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_team_contract_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/agencies' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/agencies',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_agencies_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/agency-contracts' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/agency-contracts',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_agency_contracts_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/agency-contract-types' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/agency-contract-types',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_agency_contract_types_callback' ),
				'permission_callback' => '__return_true',
			)
		);

		// Add the POST 'daext-soccer-engine/v1/market-value-transitions' endpoint to the Rest API.
		register_rest_route(
			'daext-soccer-engine/v1',
			'/market-value-transitions',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_soccer_engine_create_market_value_transitions_callback' ),
				'permission_callback' => '__return_true',
			)
		);
	}

	/*
	 * Callback for the GET 'daext-soccer-engine/v1/agencies' endpoint of the Rest API.
	 */
	function rest_api_daext_soccer_engine_read_agencies_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('agency_id', 'name', 'description', 'full_name', 'address', 'tel', 'fax', 'website')
		 */

		// Get data.
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// Validate data.
		if ( $page === null ) {
			$page = 1;}
		if ( $per_page === null ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}
		if ( ! in_array( $orderby, array( 'agency_id', 'name', 'description', 'full_name', 'address', 'tel', 'fax', 'website' ) ) ) {
			$orderby = 'agency_id';}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Include
		$where_string .= $this->generate_where_include_exclude( $include, 'agency_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'agency_id', true );

		global $wpdb;
		$table_name = $wpdb->prefix . 'dase_agency';
		$sql        = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$agency_a   = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start    = $page * $per_page - $per_page;
		$agency_a = array_slice( $agency_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response
			$response = new WP_REST_Response( $agency_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	 * Callback for the GET 'daext-soccer-engine/v1/agency-contracts' endpoint of the Rest API.
	 */
	function rest_api_daext_soccer_engine_read_agency_contracts_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 * - agency contract type
		 * - player
		 * - agency
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('agency_contract_id', 'agency_contract_type_id', 'player_id', 'start_date', 'end_date',
		 * 'agency_id')
		 */

		// Get data.
		$agency_contract_type = $request->get_param( 'agency_contract_type' );
		$player               = $request->get_param( 'player' );
		$agency               = $request->get_param( 'agency' );
		$page                 = $request->get_param( 'page' );
		$per_page             = $request->get_param( 'per_page' );
		$include              = $request->get_param( 'include' );
		$exclude              = $request->get_param( 'exclude' );
		$order                = $request->get_param( 'order' );
		$orderby              = $request->get_param( 'orderby' );

		// Validate data.
		if ( null === $page ) {
			$page = 1;}
		if ( null === $per_page ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}
		if ( ! in_array(
			$orderby,
			array(
				'agency_contract_id',
				'agency_contract_type_id',
				'player_id',
				'start_date',
				'end_date',
				'agency_id',
			)
		) ) {
			$orderby = 'agency_contract_id';}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Agency Contract Type.
		if ( $agency_contract_type > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'agency_contract_type_id = %d', $agency_contract_type );
		}

		// Player.
		if ( $player > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'player_id = %d', $player );
		}

		// Agency.
		if ( $agency > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'agency_id = %d', $agency );
		}

		// Include.
		$where_string .= $this->generate_where_include_exclude( $include, 'agency_contract_id' );

		// Exclude.
		$where_string .= $this->generate_where_include_exclude( $exclude, 'agency_contract_id', true );

		global $wpdb;
		$table_name        = $wpdb->prefix . 'dase_agency_contract';
		$sql               = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$agency_contract_a = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start             = $page * $per_page - $per_page;
		$agency_contract_a = array_slice( $agency_contract_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response.
			$response = new WP_REST_Response( $agency_contract_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	 * Callback for the GET 'daext-soccer-engine/v1/agency-contract-types' endpoint of the Rest API.
	 */
	function rest_api_daext_soccer_engine_read_agency_contract_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('agency_contract_type_id', 'name', 'description')
		 */

		// Get data.
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// Validate data.
		if ( null === $page ) {
			$page = 1;}
		if ( null === $per_page ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}
		if ( ! in_array( $orderby, array( 'agency_contract_type_id', 'name', 'description' ) ) ) {
			$orderby = 'agency_contract_type_id';}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Include.
		$where_string .= $this->generate_where_include_exclude( $include, 'agency_contract_id' );

		// Exclude.
		$where_string .= $this->generate_where_include_exclude( $exclude, 'agency_contract_id', true );

		global $wpdb;
		$table_name             = $wpdb->prefix . 'dase_agency_contract_type';
		$sql                    = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$agency_contract_type_a = $wpdb->get_results( $sql );

		// Apply page and per_page.
		$start                  = $page * $per_page - $per_page;
		$agency_contract_type_a = array_slice( $agency_contract_type_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response.
			$response = new WP_REST_Response( $agency_contract_type_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	* Callback for the GET 'daext-soccer-engine/v1/competitions' endpoint of the Rest API.
	*/
	function rest_api_daext_soccer_engine_read_competitions_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('competition_id', 'name', 'description', 'logo', 'type', 'rounds')
		 */

		// Get data.
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// Validate data.
		if ( null === $page ) {
			$page = 1;}
		if ( null === $per_page ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}
		$fields = array( 'competition_id', 'name', 'description', 'logo', 'type', 'rounds' );
		for ( $i = 1;$i <= 128;$i++ ) {
			$fields[] = 'team_id_' . $i;
		}

		if ( ! in_array( $orderby, $fields ) ) {
			$orderby = 'competition_id';}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Include.
		$where_string .= $this->generate_where_include_exclude( $include, 'competition_id' );

		// Exclude.
		$where_string .= $this->generate_where_include_exclude( $exclude, 'competition_id', true );

		global $wpdb;
		$table_name    = $wpdb->prefix . 'dase_competition';
		$sql           = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$competition_a = $wpdb->get_results( $sql );

		// Apply page and per_page.
		$start         = $page * $per_page - $per_page;
		$competition_a = array_slice( $competition_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response.
			$response = new WP_REST_Response( $competition_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	 * Callback for the GET 'daext-soccer-engine/v1/events' endpoint of the Rest API.
	 */
	function rest_api_daext_soccer_engine_read_events_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - match
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('event_id', 'data', 'match_id', 'part', 'team_slot', 'time', 'additional_time', 'description',
		 * 'match_effect', 'player_id', 'player_id_substitution_out', 'player_id_substitution_in', 'staff_id')
		 */

		// Get data.
		$match    = $request->get_param( 'match' );
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// Validate data.
		if ( null === $page ) {
			$page = 1;}
		if ( null === $per_page ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}
		if ( ! in_array(
			$orderby,
			array(
				'event_id',
				'data',
				'match_id',
				'part',
				'team_slot',
				'time',
				'additional_time',
				'description',
				'match_effect',
				'player_id',
				'player_id_substitution_out',
				'player_id_substitution_in',
				'staff_id',
			)
		) ) {
			$orderby = 'event_id';}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Position.
		if ( $match > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'match_id = %d', $match );
		}

		// Include.
		$where_string .= $this->generate_where_include_exclude( $include, 'event_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'event_id', true );

		global $wpdb;
		$table_name = $wpdb->prefix . 'dase_event';
		$sql        = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$event_a    = $wpdb->get_results( $sql );

		// Apply page and per_page.
		$start   = $page * $per_page - $per_page;
		$event_a = array_slice( $event_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response.
			$response = new WP_REST_Response( $event_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	 * Callback for the GET 'daext-soccer-engine/v1/players' endpoint of the Rest API.
	 */
	function rest_api_daext_soccer_engine_read_players_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * -
		 * - citizenship
		 * - position
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('id', 'first_name', 'last_name', 'citizenship', 'second_citizenship', 'position', 'date_of_birth',
		 * 'date_of_death', 'gender', 'height', 'foot', 'retired')
		 */

		// Get data.
		$citizenship = $request->get_param( 'citizenship' );
		$position    = $request->get_param( 'position' );
		$page        = $request->get_param( 'page' );
		$per_page    = $request->get_param( 'per_page' );
		$include     = $request->get_param( 'include' );
		$exclude     = $request->get_param( 'exclude' );
		$order       = $request->get_param( 'order' );
		$orderby     = $request->get_param( 'orderby' );

		// Validate data.
		if ( null === $page ) {
			$page = 1;}
		if ( null === $per_page ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}
		if ( ! in_array(
			$orderby,
			array(
				'id',
				'first_name',
				'last_name',
				'citizenship',
				'second_citizenship',
				'position',
				'date_of_birth',
				'date_of_death',
				'gender',
				'height',
				'foot',
				'retired',
			)
		) ) {
			$orderby = 'player_id';}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Citizenship.
		if ( strlen( $citizenship ) > 1 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( "citizenship = '%s' OR second_citizenship = '%s'", $citizenship, $citizenship );
		}

		// Position.
		if ( $position > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'player_position_id = %d', $position );
		}

		// Include.
		$where_string .= $this->generate_where_include_exclude( $include, 'player_id' );

		// Exclude.
		$where_string .= $this->generate_where_include_exclude( $exclude, 'player_id', true );

		global $wpdb;
		$table_name = $wpdb->prefix . 'dase_player';
		$sql        = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$player_a   = $wpdb->get_results( $sql );

		// Apply page and per_page.
		$start    = $page * $per_page - $per_page;
		$player_a = array_slice( $player_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response.
			$response = new WP_REST_Response( $player_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	 * Callback for the GET 'daext-soccer-engine/v1/formations' endpoint of the Rest API.
	 */
	function rest_api_daext_soccer_engine_read_formations_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('formation_id', 'name', 'description')
		 */

		// Get data.
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// Validate data.
		if ( null === $page ) {
			$page = 1;}
		if ( null === $per_page ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		$fields = array( 'formation_id', 'name', 'description' );
		for ( $i = 1;$i <= 11;$i++ ) {
			$fields[] = 'x_position_' . $i;
		}
		if ( ! in_array( $orderby, $fields ) ) {
			$orderby = 'formation_id';}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Include.
		$where_string .= $this->generate_where_include_exclude( $include, 'formation_id' );

		// Exclude.
		$where_string .= $this->generate_where_include_exclude( $exclude, 'formation_id', true );

		global $wpdb;
		$table_name  = $wpdb->prefix . 'dase_formation';
		$sql         = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$formation_a = $wpdb->get_results( $sql );

		// Apply page and per_page.
		$start       = $page * $per_page - $per_page;
		$formation_a = array_slice( $formation_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response.
			$response = new WP_REST_Response( $formation_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	 * Callback for the GET 'daext-soccer-engine/v1/injuries' endpoint of the Rest API.
	 */
	function rest_api_daext_soccer_engine_read_injuries_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - injury type
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('injury_id', 'injury_type_id', 'start_date', 'end_date', 'player_id')
		 */

		// get data
		$injury_type = $request->get_param( 'injury_type' );
		$player      = $request->get_param( 'player' );
		$page        = $request->get_param( 'page' );
		$per_page    = $request->get_param( 'per_page' );
		$include     = $request->get_param( 'include' );
		$exclude     = $request->get_param( 'exclude' );
		$order       = $request->get_param( 'order' );
		$orderby     = $request->get_param( 'orderby' );

		// Validate data.
		if ( null === $page ) {
			$page = 1;}
		if ( null === $per_page ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'injury_id', 'injury_type_id', 'start_date', 'end_date', 'player_id' ) ) ) {
			$orderby = 'injury_id';}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Injury Type.
		if ( $injury_type > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'injury_type_id = %d', $injury_type );
		}

		// Player.
		if ( $player > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'player_id = %d', $player );
		}

		// Include.
		$where_string .= $this->generate_where_include_exclude( $include, 'injury_id' );

		// Exclude.
		$where_string .= $this->generate_where_include_exclude( $exclude, 'injury_id', true );

		global $wpdb;
		$table_name = $wpdb->prefix . 'dase_injury';
		$sql        = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$injury_a   = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start    = $page * $per_page - $per_page;
		$injury_a = array_slice( $injury_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response.
			$response = new WP_REST_Response( $injury_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	 * Callback for the GET 'daext-soccer-engine/v1/injuries' endpoint of the Rest API.
	 */
	function rest_api_daext_soccer_engine_read_jersey_sets_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('jersey_set_id', 'name', 'description')
		 */

		// Get data.
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// Validate data.
		if ( null === $page ) {
			$page = 1;}
		if ( null === $per_page ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		$fields = array( 'jersey_set_id', 'name', 'description' );
		for ( $i = 1;$i <= 50;$i++ ) {
			$fields[] = 'player_id_' . $i;
		}
		for ( $i = 1;$i <= 50;$i++ ) {
			$fields[] = 'jersey_number_player_id_' . $i;
		}
		if ( ! in_array( $orderby, $fields ) ) {
			$orderby = 'jersey_set_id';}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Include.
		$where_string .= $this->generate_where_include_exclude( $include, 'jersey_set_id' );

		// Exclude.
		$where_string .= $this->generate_where_include_exclude( $exclude, 'jersey_set_id', true );

		global $wpdb;
		$table_name   = $wpdb->prefix . 'dase_jersey_set';
		$sql          = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$jersey_set_a = $wpdb->get_results( $sql );

		// Apply page and per_page.
		$start        = $page * $per_page - $per_page;
		$jersey_set_a = array_slice( $jersey_set_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response.
			$response = new WP_REST_Response( $jersey_set_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	 * Callback for the GET 'daext-soccer-engine/v1/market-value-transitions' endpoint of the Rest API.
	 */
	function rest_api_daext_soccer_engine_read_market_value_transitions_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('market_value_transition_id', 'date', 'value', 'player_id')
		 */

		// Get data.
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// Validate data.
		if ( null === $page ) {
			$page = 1;}
		if ( null === $per_page ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'market_value_transition_id', 'date', 'value', 'player_id' ) ) ) {
			$orderby = 'market_value_transition_id';}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Include.
		$where_string .= $this->generate_where_include_exclude( $include, 'market_value_transition_id' );

		// Exclude.
		$where_string .= $this->generate_where_include_exclude( $exclude, 'market_value_transition_id', true );

		global $wpdb;
		$table_name                = $wpdb->prefix . 'dase_market_value_transition';
		$sql                       = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$market_value_transition_a = $wpdb->get_results( $sql );

		// Apply page and per_page.
		$start                     = $page * $per_page - $per_page;
		$market_value_transition_a = array_slice( $market_value_transition_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response.
			$response = new WP_REST_Response( $market_value_transition_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	* Callback for the GET 'daext-soccer-engine/v1/matches' endpoint of the Rest API.
	*/
	function rest_api_daext_soccer_engine_read_matches_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - team id 1
		 * - team id 2
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('match_id', 'name', 'description', 'competition_id', 'round', 'type', 'team_id_1', 'team_id_2',
		 * 'date', 'time', 'fh_additional_time', 'sh_additional_time', 'fh_extra_time_additional_time',
		 * 'sh_extra_time_additional_time')
		 */

		// Get data.
		$team_id_1 = $request->get_param( 'team_id_1' );
		$team_id_2 = $request->get_param( 'team_id_2' );
		$page      = $request->get_param( 'page' );
		$per_page  = $request->get_param( 'per_page' );
		$include   = $request->get_param( 'include' );
		$exclude   = $request->get_param( 'exclude' );
		$order     = $request->get_param( 'order' );
		$orderby   = $request->get_param( 'orderby' );

		// Validate data.
		if ( null === $page ) {
			$page = 1;}
		if ( null === $per_page ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		$fields = array(
			'match_id',
			'name',
			'description',
			'competition_id',
			'round',
			'type',
			'team_id_1',
			'team_id_2',
			'date',
			'time',
			'fh_additional_time',
			'sh_additional_time',
			'fh_extra_time_additional_time',
			'sh_extra_time_additional_time',
		);
		for ( $i = 1;$i <= 11;$i++ ) {
			$fields[] = 'team_1_lineup_player_id_' . $i;
		}
		for ( $i = 1;$i <= 20;$i++ ) {
			$fields[] = 'team_1_substitution_player_id_' . $i;
		}
		for ( $i = 1;$i <= 20;$i++ ) {
			$fields[] = 'team_1_staff_id_' . $i;
		}
		for ( $i = 1;$i <= 11;$i++ ) {
			$fields[] = 'team_2_lineup_player_id_' . $i;
		}
		for ( $i = 1;$i <= 20;$i++ ) {
			$fields[] = 'team_2_substitution_player_id_' . $i;
		}
		for ( $i = 1;$i <= 20;$i++ ) {
			$fields[] = 'team_2_staff_id_' . $i;
		}
		$fields[] = array_merge(
			$fields,
			array(
				'stadium_id',
				'team_1_formation_id',
				'team_2_formation_id',
				'attendance',
				'referee_id',
				'player_id_injuries',
				'player_id_unavailable',
				'team_1_jersey_set_id',
				'team_2_jersey_set_id',
			)
		);
		if ( ! in_array( $orderby, $fields ) ) {
			$orderby = 'match_id';}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Team ID 1.
		if ( $team_id_1 > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'team_id_1 = %d', $team_id_1 );
		}

		// Team ID 2.
		if ( $team_id_2 > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'team_id_2 = %d', $team_id_2 );
		}

		// Include.
		$where_string .= $this->generate_where_include_exclude( $include, 'market_value_transition_id' );

		// Exclude.
		$where_string .= $this->generate_where_include_exclude( $exclude, 'market_value_transition_id', true );

		global $wpdb;
		$table_name = $wpdb->prefix . 'dase_match';
		$sql        = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$match_a    = $wpdb->get_results( $sql );

		// Apply page and per_page.
		$start   = $page * $per_page - $per_page;
		$match_a = array_slice( $match_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response.
			$response = new WP_REST_Response( $match_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	* Callback for the GET 'daext-soccer-engine/v1/player-awards' endpoint of the Rest API.
	*/
	function rest_api_daext_soccer_engine_read_player_awards_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - player award type
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('player_award_id', 'player_award_type_id', 'assignment_date', 'player_id')
		 */

		// Get data.
		$player_award_type = $request->get_param( 'player_award_type' );
		$player_id         = $request->get_param( 'player_id' );
		$page              = $request->get_param( 'page' );
		$per_page          = $request->get_param( 'per_page' );
		$include           = $request->get_param( 'include' );
		$exclude           = $request->get_param( 'exclude' );
		$order             = $request->get_param( 'order' );
		$orderby           = $request->get_param( 'orderby' );

		// Validate data.
		if ( null === $page ) {
			$page = 1;}
		if ( null === $per_page ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'player_award_id', 'player_award_type_id', 'assignment_date', 'player_id' ) ) ) {
			$orderby = 'player_award_id';}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Player award type.
		if ( $player_award_type > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'player_award_type_id = %d', $player_award_type );
		}

		// Player.
		if ( $player_id > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'player_id = %d', $player );
		}

		// Include.
		$where_string .= $this->generate_where_include_exclude( $include, 'player_award_id' );

		// Exclude.
		$where_string .= $this->generate_where_include_exclude( $exclude, 'player_award_id', true );

		global $wpdb;
		$table_name = $wpdb->prefix . 'dase_player_award';
		$sql        = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$match_a    = $wpdb->get_results( $sql );

		// Apply page and per_page.
		$start          = $page * $per_page - $per_page;
		$player_award_a = array_slice( $match_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response.
			$response = new WP_REST_Response( $player_award_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	* Callback for the GET 'daext-soccer-engine/v1/player-awards' endpoint of the Rest API.
	*/
	function rest_api_daext_soccer_engine_read_player_award_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('player_award_type_id', 'name', 'description')
		 */

		// Get data.
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// Validate data.
		if ( null === $page ) {
			$page = 1;}
		if ( null === $per_page ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'player_award_type_id', 'name', 'description' ) ) ) {
			$orderby = 'player_award_type_id';}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Include.
		$where_string .= $this->generate_where_include_exclude( $include, 'player_award_type_id' );

		// Exclude.
		$where_string .= $this->generate_where_include_exclude( $exclude, 'player_award_type_id', true );

		global $wpdb;
		$table_name          = $wpdb->prefix . 'dase_player_award_type';
		$sql                 = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$player_award_type_a = $wpdb->get_results( $sql );

		// Apply page and per_page.
		$start               = $page * $per_page - $per_page;
		$player_award_type_a = array_slice( $player_award_type_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response.
			$response = new WP_REST_Response( $player_award_type_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	* Callback for the GET 'daext-soccer-engine/v1/player-awards' endpoint of the Rest API.
	*/
	function rest_api_daext_soccer_engine_read_player_positions_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('player_position_id', 'name', 'description', 'abbreviation')
		 */

		// get data
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// Validate data.
		if ( null === $page ) {
			$page = 1;}
		if ( null === $per_page ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'player_position_id', 'name', 'description', 'abbreviation' ) ) ) {
			$orderby = 'player_position_id';}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Include.
		$where_string .= $this->generate_where_include_exclude( $include, 'player_position_id' );

		// Exclude.
		$where_string .= $this->generate_where_include_exclude( $exclude, 'player_position_id', true );

		global $wpdb;
		$table_name        = $wpdb->prefix . 'dase_player_position';
		$sql               = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$player_position_a = $wpdb->get_results( $sql );

		// Apply page and per_page.
		$start             = $page * $per_page - $per_page;
		$player_position_a = array_slice( $player_position_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response.
			$response = new WP_REST_Response( $player_position_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	* Callback for the GET 'daext-soccer-engine/v1/ranking_transitions' endpoint of the Rest API.
	*/
	function rest_api_daext_soccer_engine_read_ranking_transitions_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - ranking type
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('ranking_transition_id', 'ranking_type_id', 'value', 'team_id', 'date')
		 */

		// Get data.
		$ranking_type = $request->get_param( 'ranking_type' );
		$page         = $request->get_param( 'page' );
		$per_page     = $request->get_param( 'per_page' );
		$include      = $request->get_param( 'include' );
		$exclude      = $request->get_param( 'exclude' );
		$order        = $request->get_param( 'order' );
		$orderby      = $request->get_param( 'orderby' );

		// validate data
		if ( null === $page ) {
			$page = 1;}
		if ( null === $per_page ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'ranking_transition_id', 'ranking_type_id', 'value', 'team_id', 'date' ) ) ) {
			$orderby = 'ranking_transition_id';}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Ranking type.
		if ( $ranking_type > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'ranking_type_id = %d', $ranking_type );
		}

		// Include.
		$where_string .= $this->generate_where_include_exclude( $include, 'player_transition_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'player_transition_id', true );

		global $wpdb;
		$table_name           = $wpdb->prefix . 'dase_ranking_transition';
		$sql                  = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$ranking_transition_a = $wpdb->get_results( $sql );

		// Apply page and per_page.
		$start                = $page * $per_page - $per_page;
		$ranking_transition_a = array_slice( $ranking_transition_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response.
			$response = new WP_REST_Response( $ranking_transition_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	* Callback for the GET 'daext-soccer-engine/v1/ranking_types' endpoint of the Rest API.
	*/
	function rest_api_daext_soccer_engine_read_ranking_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('ranking_type_id', 'name', 'description')
		 */

		// Get data.
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// validate data
		if ( $page === null ) {
			$page = 1;}
		if ( $per_page === null ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'ranking_type_id', 'name', 'description' ) ) ) {
			$orderby = 'ranking_type_id';}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Include.
		$where_string .= $this->generate_where_include_exclude( $include, 'player_type_id' );

		// Exclude.
		$where_string .= $this->generate_where_include_exclude( $exclude, 'player_type_id', true );

		global $wpdb;
		$table_name     = $wpdb->prefix . 'dase_ranking_type';
		$sql            = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$ranking_type_a = $wpdb->get_results( $sql );

		// Apply page and per_page.
		$start          = $page * $per_page - $per_page;
		$ranking_type_a = array_slice( $ranking_type_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response
			$response = new WP_REST_Response( $ranking_type_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	* Callback for the GET 'daext-soccer-engine/v1/referee-badges' endpoint of the Rest API.
	*/
	function rest_api_daext_soccer_engine_read_referee_badges_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - referee
		 * - referee badge type
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('referee_badge_id', 'referee_id', 'referee_badge_type_id', 'start_date', 'end_date')
		 */

		// Get data.
		$referee            = $request->get_param( 'referee' );
		$referee_badge_type = $request->get_param( 'referee_badge_type' );
		$page               = $request->get_param( 'page' );
		$per_page           = $request->get_param( 'per_page' );
		$include            = $request->get_param( 'include' );
		$exclude            = $request->get_param( 'exclude' );
		$order              = $request->get_param( 'order' );
		$orderby            = $request->get_param( 'orderby' );

		// Validate data.
		if ( null === $page ) {
			$page = 1;}
		if ( null === $per_page ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'referee_badge_id', 'referee_id', 'referee_badge_type_id', 'start_date', 'end_date' ) ) ) {
			$orderby = 'referee_id';
		}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Referee.
		if ( $referee > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'referee_id = %d', $referee );
		}

		// Referee badge type.
		if ( $referee_badge_type > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'referee_badge_type_id = %d', $referee_badge_type );
		}

		// Include.
		$where_string .= $this->generate_where_include_exclude( $include, 'referee_badge_id' );

		// Exclude.
		$where_string .= $this->generate_where_include_exclude( $exclude, 'referee_badge_id', true );

		global $wpdb;
		$table_name      = $wpdb->prefix . 'dase_referee_badge';
		$sql             = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$referee_badge_a = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start           = $page * $per_page - $per_page;
		$referee_badge_a = array_slice( $referee_badge_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response.
			$response = new WP_REST_Response( $referee_badge_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	* Callback for the GET 'daext-soccer-engine/v1/referee-badge-types' endpoint of the Rest API.
	*/
	function rest_api_daext_soccer_engine_read_referee_badge_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('referee_badge_type_id', 'name', 'description')
		 */

		// get data.
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// Validate data.
		if ( null === $page ) {
			$page = 1;}
		if ( null === $per_page ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'referee_badge_type_id', 'name', 'description' ) ) ) {
			$orderby = 'referee_badge_type_id';
		}

		// Generate the query parts used to filter the results --------------------------------------------------------.
		$where_string = '';
		global $wpdb;

		// Include
		$where_string .= $this->generate_where_include_exclude( $include, 'referee_badge_type_id' );

		// Exclude.
		$where_string .= $this->generate_where_include_exclude( $exclude, 'referee_badge_type_id', true );

		global $wpdb;
		$table_name           = $wpdb->prefix . 'dase_referee_badge_type';
		$sql                  = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$referee_badge_type_a = $wpdb->get_results( $sql );

		// Apply page and per_page.
		$start                = $page * $per_page - $per_page;
		$referee_badge_type_a = array_slice( $referee_badge_type_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response.
			$response = new WP_REST_Response( $referee_badge_type_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/**
	* Callback for the GET 'daext-soccer-engine/v1/squads' endpoint of the Rest API.
	*/
	function rest_api_daext_soccer_engine_read_squads_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - jersey set
		 * - formation
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('squad_id', 'name', 'description', 'jersey_set_id', 'formation_id')
		 */

		// Get data.
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// Validate data.
		if ( $page === null ) {
			$page = 1;}
		if ( $per_page === null ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		$fields = array( 'referee_badge_type_id', 'name', 'description' );
		for ( $i = 1;$i <= 11;$i++ ) {
			$fields[] = 'lineup_player_id_' . $i;
		}
		for ( $i = 1;$i <= 20;$i++ ) {
			$fields[] = 'substitute_player_id_' . $i;
		}
		for ( $i = 1;$i <= 20;$i++ ) {
			$fields[] = 'staff_id_' . $i;
		}
		$fields[] = array_merge( $fields, array( 'jersey_set_id', 'formation_id' ) );
		if ( ! in_array( $orderby, $fields ) ) {
			$orderby = 'squad_id';}

		// Generate the query parts used to filter the results ----------------------------------------------------------
		$where_string = '';
		global $wpdb;

		// Include
		$where_string .= $this->generate_where_include_exclude( $include, 'squad_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'squad_id', true );

		global $wpdb;
		$table_name = $wpdb->prefix . 'dase_squad';
		$sql        = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$squad_a    = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start   = $page * $per_page - $per_page;
		$squad_a = array_slice( $squad_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response
			$response = new WP_REST_Response( $squad_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/*
	* Callback for the GET 'daext-soccer-engine/v1/stadiums' endpoint of the Rest API
	*/
	function rest_api_daext_soccer_engine_read_stadiums_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('stadium_id', 'name', 'description', 'image')
		 */

		// get data
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// validate data
		if ( $page === null ) {
			$page = 1;}
		if ( $per_page === null ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'stadium_id', 'name', 'description', 'image' ) ) ) {
			$orderby = 'stadium_id';}

		// Generate the query parts used to filter the results ----------------------------------------------------------
		$where_string = '';
		global $wpdb;

		// Include
		$where_string .= $this->generate_where_include_exclude( $include, 'stadium_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'stadium_id', true );

		global $wpdb;
		$table_name = $wpdb->prefix . 'dase_stadium';
		$sql        = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$stadium_a  = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start     = $page * $per_page - $per_page;
		$stadium_a = array_slice( $stadium_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response
			$response = new WP_REST_Response( $stadium_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/*
	* Callback for the GET 'daext-soccer-engine/v1/staff' endpoint of the Rest API
	*/
	function rest_api_daext_soccer_engine_read_staff_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - citizenship
		 * - staff type
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('staff_id', 'first_name', 'last_name', 'image', 'citizenship', 'second_citizenship',
		 * 'staff_type_id', 'retired', 'gender', 'date_of_birth', 'date_of_death')
		 */

		// get data
		$citizenship = $request->get_param( 'citizenship' );
		$staff_type  = $request->get_param( 'staff_type' );
		$page        = $request->get_param( 'page' );
		$per_page    = $request->get_param( 'per_page' );
		$include     = $request->get_param( 'include' );
		$exclude     = $request->get_param( 'exclude' );
		$order       = $request->get_param( 'order' );
		$orderby     = $request->get_param( 'orderby' );

		// validate data
		if ( $page === null ) {
			$page = 1;}
		if ( $per_page === null ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array(
			$orderby,
			array(
				'staff_id',
				'first_name',
				'last_name',
				'image',
				'citizenship',
				'second_citizenship',
				'staff_type_id',
				'retired',
				'gender',
				'date_of_birth',
				'date_of_death',
			)
		) ) {
			$orderby = 'staff_id';}

		// Generate the query parts used to filter the results ----------------------------------------------------------
		$where_string = '';
		global $wpdb;

		// Citizenship
		if ( strlen( $citizenship ) > 1 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( "citizenship = '%s' OR second_citizenship = '%s'", $citizenship, $citizenship );
		}

		// Staff type
		if ( $staff_type > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'staff_type_id = %d', $staff_type );
		}

		// Include
		$where_string .= $this->generate_where_include_exclude( $include, 'staff_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'staff_id', true );

		global $wpdb;
		$table_name = $wpdb->prefix . 'dase_staff';
		$sql        = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$staff_a    = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start   = $page * $per_page - $per_page;
		$staff_a = array_slice( $staff_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response
			$response = new WP_REST_Response( $staff_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/*
	* Callback for the GET 'daext-soccer-engine/v1/staff-awards' endpoint of the Rest API
	*/
	function rest_api_daext_soccer_engine_read_staff_awards_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - staff award type
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('staff_award_id', 'staff_award_type_id', 'assignment_date', 'staff_id')
		 */

		// get data
		$staff_award_type = $request->get_param( 'staff_award_type' );
		$page             = $request->get_param( 'page' );
		$per_page         = $request->get_param( 'per_page' );
		$include          = $request->get_param( 'include' );
		$exclude          = $request->get_param( 'exclude' );
		$order            = $request->get_param( 'order' );
		$orderby          = $request->get_param( 'orderby' );

		// validate data
		if ( $page === null ) {
			$page = 1;}
		if ( $per_page === null ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'staff_award_id', 'staff_award_type_id', 'assignment_date', 'staff_id' ) ) ) {
			$orderby = 'staff_award_id';}

		// Generate the query parts used to filter the results ----------------------------------------------------------
		$where_string = '';
		global $wpdb;

		// Staff award type
		if ( $staff_award_type > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'staff_award_type_id = %d', $staff_award_type );
		}

		// Include
		$where_string .= $this->generate_where_include_exclude( $include, 'staff_award_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'staff_award_id', true );

		global $wpdb;
		$table_name    = $wpdb->prefix . 'dase_staff_award';
		$sql           = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$staff_award_a = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start         = $page * $per_page - $per_page;
		$staff_award_a = array_slice( $staff_award_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response
			$response = new WP_REST_Response( $staff_award_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/*
	* Callback for the GET 'daext-soccer-engine/v1/staff-awards' endpoint of the Rest API
	*/
	function rest_api_daext_soccer_engine_read_staff_award_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('staff_award_type_id', 'name', 'description')
		 */

		// get data
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// validate data
		if ( $page === null ) {
			$page = 1;}
		if ( $per_page === null ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'staff_award_type_id', 'name', 'description' ) ) ) {
			$orderby = 'staff_award_type_id';}

		// Generate the query parts used to filter the results ----------------------------------------------------------
		$where_string = '';
		global $wpdb;

		// Include
		$where_string .= $this->generate_where_include_exclude( $include, 'staff_award_type_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'staff_award_type_id', true );

		global $wpdb;
		$table_name         = $wpdb->prefix . 'dase_staff_award_type';
		$sql                = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$staff_award_type_a = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start              = $page * $per_page - $per_page;
		$staff_award_type_a = array_slice( $staff_award_type_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response
			$response = new WP_REST_Response( $staff_award_type_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/*
	* Callback for the GET 'daext-soccer-engine/v1/staff-types' endpoint of the Rest API
	*/
	function rest_api_daext_soccer_engine_read_staff_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('staff_type_id', 'name', 'description')
		 */

		// get data
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// validate data
		if ( $page === null ) {
			$page = 1;}
		if ( $per_page === null ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'staff_type_id', 'name', 'description' ) ) ) {
			$orderby = 'staff_type_id';}

		// Generate the query parts used to filter the results ----------------------------------------------------------
		$where_string = '';
		global $wpdb;

		// Include
		$where_string .= $this->generate_where_include_exclude( $include, 'staff_type_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'staff_type_id', true );

		global $wpdb;
		$table_name   = $wpdb->prefix . 'dase_staff_type';
		$sql          = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$staff_type_a = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start        = $page * $per_page - $per_page;
		$staff_type_a = array_slice( $staff_type_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response
			$response = new WP_REST_Response( $staff_type_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/*
	* Callback for the GET 'daext-soccer-engine/v1/teams' endpoint of the Rest API
	*/
	function rest_api_daext_soccer_engine_read_teams_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('team_id', 'name', 'description', 'logo', 'type', 'foundation_date', 'stadium_id', 'full_name',
		 * 'address', 'tel', 'fax', 'website_url', 'club_nation', 'national_team_confederation')
		 */

		// get data
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// validate data
		if ( $page === null ) {
			$page = 1;}
		if ( $per_page === null ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array(
			$orderby,
			array(
				'team_id',
				'name',
				'description',
				'logo',
				'type',
				'foundation_date',
				'stadium_id',
				'full_name',
				'address',
				'tel',
				'fax',
				'website_url',
				'club_nation',
				'national_team_confederation',
			)
		) ) {
			$orderby = 'team_id';
		}

		// Generate the query parts used to filter the results ----------------------------------------------------------
		$where_string = '';
		global $wpdb;

		// Include
		$where_string .= $this->generate_where_include_exclude( $include, 'team_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'team_id', true );

		global $wpdb;
		$table_name = $wpdb->prefix . 'dase_team';
		$sql        = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$team_a     = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start  = $page * $per_page - $per_page;
		$team_a = array_slice( $team_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response
			$response = new WP_REST_Response( $team_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/*
	* Callback for the GET 'daext-soccer-engine/v1/team-contracts' endpoint of the Rest API
	*/
	function rest_api_daext_soccer_engine_read_team_contracts_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('team_contract_id', 'team_contract_type_id', 'player_id', 'start_date', 'end_date', 'salary',
		 * 'team_id')
		 */

		// get data
		$team_contract_type = $request->get_param( 'team_contract_type' );
		$player             = $request->get_param( 'player' );
		$team               = $request->get_param( 'team' );
		$page               = $request->get_param( 'page' );
		$per_page           = $request->get_param( 'per_page' );
		$include            = $request->get_param( 'include' );
		$exclude            = $request->get_param( 'exclude' );
		$order              = $request->get_param( 'order' );
		$orderby            = $request->get_param( 'orderby' );

		// validate data
		if ( $page === null ) {
			$page = 1;}
		if ( $per_page === null ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array(
			$orderby,
			array(
				'team_contract_id',
				'team_contract_type_id',
				'player_id',
				'start_date',
				'end_date',
				'salary',
				'team_id',
			)
		) ) {
			$orderby = 'team_contract_id';
		}

		// Generate the query parts used to filter the results ----------------------------------------------------------
		$where_string = '';
		global $wpdb;

		// Include
		$where_string .= $this->generate_where_include_exclude( $include, 'team_contract_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'team_contract_id', true );

		global $wpdb;
		$table_name      = $wpdb->prefix . 'dase_team_contract';
		$sql             = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$team_contract_a = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start           = $page * $per_page - $per_page;
		$team_contract_a = array_slice( $team_contract_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response
			$response = new WP_REST_Response( $team_contract_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/*
	* Callback for the GET 'daext-soccer-engine/v1/team-contract-types' endpoint of the Rest API
	*/
	function rest_api_daext_soccer_engine_read_team_contract_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('team_contract_type_id', 'name', 'description')
		 */

		// get data
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// validate data
		if ( $page === null ) {
			$page = 1;}
		if ( $per_page === null ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'team_contract_type_id', 'name', 'description' ) ) ) {
			$orderby = 'team_contract_type_id';
		}

		// Generate the query parts used to filter the results ----------------------------------------------------------
		$where_string = '';
		global $wpdb;

		// Include
		$where_string .= $this->generate_where_include_exclude( $include, 'team_contract_type_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'team_contract_type_id', true );

		global $wpdb;
		$table_name           = $wpdb->prefix . 'dase_team_contract_type';
		$sql                  = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$team_contract_type_a = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start                = $page * $per_page - $per_page;
		$team_contract_type_a = array_slice( $team_contract_type_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response
			$response = new WP_REST_Response( $team_contract_type_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/*
	* Callback for the GET 'daext-soccer-engine/v1/transfers' endpoint of the Rest API
	*/
	function rest_api_daext_soccer_engine_read_transfers_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - player
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('transfer_id', 'player_id', 'date', 'team_id_left', 'team_id_joined', 'fee', 'transfer_type_id')
		 */

		// get data
		$player   = $request->get_param( 'player' );
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// validate data
		if ( $page === null ) {
			$page = 1;}
		if ( $per_page === null ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array(
			$orderby,
			array(
				'transfer_id',
				'player_id',
				'date',
				'team_id_left',
				'team_id_joined',
				'fee',
				'transfer_type_id',
			)
		) ) {
			$orderby = 'transfer_id';
		}

		// Generate the query parts used to filter the results ----------------------------------------------------------
		$where_string = '';
		global $wpdb;

		// Include
		$where_string .= $this->generate_where_include_exclude( $include, 'transfer_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'transfer_id', true );

		global $wpdb;
		$table_name = $wpdb->prefix . 'dase_transfer';
		$sql        = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$transfer_a = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start      = $page * $per_page - $per_page;
		$transfer_a = array_slice( $transfer_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response
			$response = new WP_REST_Response( $transfer_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/*
	* Callback for the GET 'daext-soccer-engine/v1/transfer-types' endpoint of the Rest API
	*/
	function rest_api_daext_soccer_engine_read_transfer_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('transfer_type_id', 'name', 'description')
		 */

		// get data
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// validate data
		if ( $page === null ) {
			$page = 1;}
		if ( $per_page === null ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'transfer_type_id', 'name', 'description' ) ) ) {
			$orderby = 'transfer_type_id';
		}

		// Generate the query parts used to filter the results ----------------------------------------------------------
		$where_string = '';
		global $wpdb;

		// Include
		$where_string .= $this->generate_where_include_exclude( $include, 'transfer_type_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'transfer_type_id', true );

		global $wpdb;
		$table_name      = $wpdb->prefix . 'dase_transfer_type';
		$sql             = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$transfer_type_a = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start           = $page * $per_page - $per_page;
		$transfer_type_a = array_slice( $transfer_type_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response
			$response = new WP_REST_Response( $transfer_type_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/*
	* Callback for the GET 'daext-soccer-engine/v1/trophies' endpoint of the Rest API
	*/
	function rest_api_daext_soccer_engine_read_trophies_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - trophy type
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('trophy_id', 'trophy_type_id', 'team_id', 'assignment_date')
		 */

		// get data
		$trophy_type = $request->get_param( 'trophy_type' );
		$page        = $request->get_param( 'page' );
		$per_page    = $request->get_param( 'per_page' );
		$include     = $request->get_param( 'include' );
		$exclude     = $request->get_param( 'exclude' );
		$order       = $request->get_param( 'order' );
		$orderby     = $request->get_param( 'orderby' );

		// validate data
		if ( $page === null ) {
			$page = 1;}
		if ( $per_page === null ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'trophy_id', 'trophy_type_id', 'team_id', 'assignment_date' ) ) ) {
			$orderby = 'trophy_id';
		}

		// Generate the query parts used to filter the results ----------------------------------------------------------
		$where_string = '';
		global $wpdb;

		// Trophy type
		if ( $trophy_type > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'trophy_type_id = %d', $trophy_type );
		}

		// Include
		$where_string .= $this->generate_where_include_exclude( $include, 'trophy_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'trophy_id', true );

		global $wpdb;
		$table_name = $wpdb->prefix . 'dase_trophy';
		$sql        = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$trophy_a   = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start    = $page * $per_page - $per_page;
		$trophy_a = array_slice( $trophy_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response
			$response = new WP_REST_Response( $trophy_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/*
	* Callback for the GET 'daext-soccer-engine/v1/trophy-types' endpoint of the Rest API
	*/
	function rest_api_daext_soccer_engine_read_trophy_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('trophy_type_id', 'name', 'description', 'logo')
		 */

		// get data
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// validate data
		if ( $page === null ) {
			$page = 1;}
		if ( $per_page === null ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'trophy_type_id', 'name', 'description', 'logo' ) ) ) {
			$orderby = 'trophy_type_id';
		}

		// Generate the query parts used to filter the results ----------------------------------------------------------
		$where_string = '';
		global $wpdb;

		// Include
		$where_string .= $this->generate_where_include_exclude( $include, 'trophy_type_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'trophy_type_id', true );

		global $wpdb;
		$table_name    = $wpdb->prefix . 'dase_trophy_type';
		$sql           = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$trophy_type_a = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start         = $page * $per_page - $per_page;
		$trophy_type_a = array_slice( $trophy_type_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response
			$response = new WP_REST_Response( $trophy_type_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/*
	* Callback for the GET 'daext-soccer-engine/v1/unavailable-players' endpoint of the Rest API
	*/
	function rest_api_daext_soccer_engine_read_unavailable_players_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('unavailable_player_id', 'player_id', 'unavailable_player_type_id', 'start_date', 'end_date')
		 */

		// get data
		$unavailable_player_type = $request->get_param( 'unavailable_player_type' );
		$page                    = $request->get_param( 'page' );
		$per_page                = $request->get_param( 'per_page' );
		$include                 = $request->get_param( 'include' );
		$exclude                 = $request->get_param( 'exclude' );
		$order                   = $request->get_param( 'order' );
		$orderby                 = $request->get_param( 'orderby' );

		// validate data
		if ( $page === null ) {
			$page = 1;}
		if ( $per_page === null ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array(
			$orderby,
			array(
				'unavailable_player_id',
				'player_id',
				'unavailable_player_type_id',
				'start_date',
				'end_date',
			)
		) ) {
			$orderby = 'unavailable_player_id';
		}

		// Generate the query parts used to filter the results ----------------------------------------------------------
		$where_string = '';
		global $wpdb;

		// Unavailable player type
		if ( $unavailable_player_type > 0 ) {
			$where_string .= $this->shared->add_query_part( $where_string ) . $wpdb->prepare( 'unavailable_player_type_id = %d', $unavailable_player_type );
		}

		// Include
		$where_string .= $this->generate_where_include_exclude( $include, 'trophy_type_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'trophy_type_id', true );

		global $wpdb;
		$table_name           = $wpdb->prefix . 'dase_unavailable_player';
		$sql                  = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$unavailable_player_a = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start                = $page * $per_page - $per_page;
		$unavailable_player_a = array_slice( $unavailable_player_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			// Prepare the response
			$response = new WP_REST_Response( $unavailable_player_a, '200' );

		} else {

			return false;
		}

		return $response;
	}

	/*
	* Callback for the GET 'daext-soccer-engine/v1/unavailable-player-types' endpoint of the Rest API
	*/
	function rest_api_daext_soccer_engine_read_unavailable_player_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'read' ) ) {
			return $this->invalid_authentication_object;
		}

		/**
		 * Parameters:
		 *
		 * - page (default: 1)
		 * - per_page (default: 10)
		 * - include
		 * - exclude
		 * - order (default: 'desc'; One of: 'asc', 'desc')
		 * - orderby ('unavailable_player_type_id', 'name', 'description')
		 */

		// get data
		$page     = $request->get_param( 'page' );
		$per_page = $request->get_param( 'per_page' );
		$include  = $request->get_param( 'include' );
		$exclude  = $request->get_param( 'exclude' );
		$order    = $request->get_param( 'order' );
		$orderby  = $request->get_param( 'orderby' );

		// validate data
		if ( $page === null ) {
			$page = 1;}
		if ( $per_page === null ) {
			$per_page = 10;}
		if ( ! in_array( $order, array( 'asc', 'desc' ) ) ) {
			$order = 'ASC';
		} else {
			$order = strtoupper( $order );
		}

		if ( ! in_array( $orderby, array( 'unavailable_player_type_id', 'name', 'description' ) ) ) {
			$orderby = 'unavailable_player_type_id';
		}

		// Generate the query parts used to filter the results ----------------------------------------------------------
		$where_string = '';
		global $wpdb;

		// Include
		$where_string .= $this->generate_where_include_exclude( $include, 'unavailable_player_type_id' );

		// Exclude
		$where_string .= $this->generate_where_include_exclude( $exclude, 'unavailable_player_type_id', true );

		global $wpdb;
		$table_name                = $wpdb->prefix . 'dase_unavailable_player_type';
		$sql                       = "SELECT * FROM $table_name $where_string ORDER BY $orderby $order";
		$unavailable_player_type_a = $wpdb->get_results( $sql );

		// Apply page and per_page
		$start                     = $page * $per_page - $per_page;
		$unavailable_player_type_a = array_slice( $unavailable_player_type_a, $start, $per_page );

		if ( $wpdb->num_rows > 0 ) {

			$response = new WP_REST_Response( $unavailable_player_type_a, '200' );

		} else {

			return false;

		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_event_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['data']                       = $request->get_param( 'data' );
		$data['match_id']                   = $request->get_param( 'match_id' );
		$data['part']                       = $request->get_param( 'part' );
		$data['team_slot']                  = $request->get_param( 'team_slot' );
		$data['time']                       = $request->get_param( 'time' );
		$data['additional_time']            = $request->get_param( 'additional_time' );
		$data['description']                = $request->get_param( 'description' );
		$data['match_effect']               = $request->get_param( 'match_effect' );
		$data['player_id']                  = $request->get_param( 'player_id' );
		$data['player_id_substitution_out'] = $request->get_param( 'player_id_substitution_out' );
		$data['player_id_substitution_in']  = $request->get_param( 'player_id_substitution_in' );
		$data['staff_id']                   = $request->get_param( 'staff_id' );

		$custom_validation_result = $this->validation->menu_events_custom_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_event';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    data = %d,
                    match_id = %d,
                    part = %d,
                    team_slot = %d,
                    time = %d,
                    additional_time = %d,
                    description = %s,
                    match_effect = %d,
                    player_id = %d,
                    player_id_substitution_out = %d,
                    player_id_substitution_in = %d",
			$data['data'],
			$data['match_id'],
			$data['part'],
			$data['team_slot'],
			$data['time'],
			$data['additional_time'],
			$data['description'],
			$data['match_effect'],
			$data['player_id'],
			$data['player_id_substitution_out'],
			$data['player_id_substitution_in']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_player_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['first_name']         = $request->get_param( 'first_name' );
		$data['last_name']          = $request->get_param( 'last_name' );
		$data['image']              = $request->get_param( 'image' );
		$data['citizenship']        = $request->get_param( 'citizenship' );
		$data['second_citizenship'] = $request->get_param( 'second_citizenship' );
		$data['player_position_id'] = $request->get_param( 'player_position_id' );
		$data['URL']                = $request->get_param( 'URL' );
		$data['date_of_birth']      = $request->get_param( 'date_of_birth' );
		$data['date_of_death']      = $request->get_param( 'date_of_death' );
		$data['gender']             = $request->get_param( 'gender' );
		$data['height']             = $request->get_param( 'height' );
		$data['foot']               = $request->get_param( 'foot' );
		$data['retired']            = $request->get_param( 'retired' );

		$custom_validation_result = $this->validation->menu_players_custom_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    first_name = %s,
                    last_name = %s,
                    image = %s,
                    citizenship = %s,
                    second_citizenship = %s,
                    player_position_id = %d,
                    URL = %s,
                    date_of_birth = %s,
                    date_of_death = %s,
                    gender = %d,
                    height = %d,
                    foot = %d,
                    retired = %d
                    ",
			$data['first_name'],
			$data['last_name'],
			$data['image'],
			$data['citizenship'],
			$data['second_citizenship'],
			$data['player_position_id'],
			$data['URL'],
			$data['date_of_birth'],
			$data['date_of_death'],
			$data['gender'],
			$data['height'],
			$data['foot'],
			$data['retired']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_player_positions_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['name']         = $request->get_param( 'name' );
		$data['description']  = $request->get_param( 'description' );
		$data['abbreviation'] = $request->get_param( 'abbreviation' );

		$custom_validation_result = $this->validation->player_positions_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player_position';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    name = %s,
                    description = %s,
                    abbreviation = %s
                    ",
			$data['name'],
			$data['description'],
			$data['abbreviation']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_player_awards_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['player_id']            = $request->get_param( 'player_id' );
		$data['player_award_type_id'] = $request->get_param( 'player_award_type_id' );
		$data['assignment_date']      = $request->get_param( 'assignment_date' );

		$custom_validation_result = $this->validation->player_awards_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player_award';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    player_id = %d,
                    player_award_type_id = %d,
                    assignment_date = %s
                    ",
			$data['player_id'],
			$data['player_award_type_id'],
			$data['assignment_date']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_player_award_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['name']        = $request->get_param( 'name' );
		$data['description'] = $request->get_param( 'description' );

		$custom_validation_result = $this->validation->player_award_types_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player_award_type';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    name = %s,
                    description = %s
                    ",
			$data['name'],
			$data['description']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_unavailable_players_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['player_id']                  = $request->get_param( 'player_id' );
		$data['unavailable_player_type_id'] = $request->get_param( 'unavailable_player_type_id' );
		$data['start_date']                 = $request->get_param( 'start_date' );
		$data['end_date']                   = $request->get_param( 'end_date' );

		$custom_validation_result = $this->validation->unavailable_players_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_unavailable_player';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    player_id = %d,
                    unavailable_player_type_id = %d,
                    start_date = %s,
                    end_date = %s
                    ",
			$data['player_id'],
			$data['unavailable_player_type_id'],
			$data['start_date'],
			$data['end_date']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_unavailable_player_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['name']        = $request->get_param( 'name' );
		$data['description'] = $request->get_param( 'description' );

		$custom_validation_result = $this->validation->unavailable_player_types_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_unavailable_player_type';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    name = %s,
                    description = %s
                    ",
			$data['name'],
			$data['description']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_injuries_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['injury_type_id'] = $request->get_param( 'injury_type_id' );
		$data['start_date']     = $request->get_param( 'start_date' );
		$data['end_date']       = $request->get_param( 'end_date' );
		$data['player_id']      = $request->get_param( 'player_id' );

		$custom_validation_result = $this->validation->injuries_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_injury';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    injury_type_id = %d,
                    start_date = %s,
                    end_date = %s,
                    player_id = %d
                    ",
			$data['injury_type_id'],
			$data['start_date'],
			$data['end_date'],
			$data['player_id']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_injury_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['name']        = $request->get_param( 'name' );
		$data['description'] = $request->get_param( 'description' );

		$custom_validation_result = $this->validation->injury_types_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_injury_type';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    name = %s,
                    description = %s
                    ",
			$data['name'],
			$data['description']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_staff_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['first_name']         = $request->get_param( 'first_name' );
		$data['last_name']          = $request->get_param( 'last_name' );
		$data['image']              = $request->get_param( 'image' );
		$data['citizenship']        = $request->get_param( 'citizenship' );
		$data['second_citizenship'] = $request->get_param( 'second_citizenship' );
		$data['staff_type_id']      = $request->get_param( 'staff_type_id' );
		$data['retired']            = $request->get_param( 'retired' );
		$data['gender']             = $request->get_param( 'gender' );
		$data['date_of_birth']      = $request->get_param( 'date_of_birth' );
		$data['date_of_death']      = $request->get_param( 'date_of_death' );

		$custom_validation_result = $this->validation->staff_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    first_name = %s,
                    last_name = %s,
                    image = %s,
                    citizenship = %s,
                    second_citizenship = %s,
                    staff_type_id = %d,
                    retired = %d,
                    gender = %d,
                    date_of_birth = %s,
                    date_of_death = %s
                    ",
			$data['first_name'],
			$data['last_name'],
			$data['image'],
			$data['citizenship'],
			$data['second_citizenship'],
			$data['staff_type_id'],
			$data['retired'],
			$data['gender'],
			$data['date_of_birth'],
			$data['date_of_death']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_staff_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['name']        = $request->get_param( 'name' );
		$data['description'] = $request->get_param( 'description' );

		$custom_validation_result = $this->validation->staff_types_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff_type';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    name = %s,
                    description = %s
                    ",
			$data['name'],
			$data['description']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_staff_awards_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['staff_award_type_id'] = $request->get_param( 'staff_award_type_id' );
		$data['assignment_date']     = $request->get_param( 'assignment_date' );
		$data['staff_id']            = $request->get_param( 'staff_id' );

		$custom_validation_result = $this->validation->staff_awards_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff_award';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                  staff_award_type_id = %d,
                  assignment_date = %s,
                  staff_id = %d
                    ",
			$data['staff_award_type_id'],
			$data['assignment_date'],
			$data['staff_id'],
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_staff_award_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['name']        = $request->get_param( 'name' );
		$data['description'] = $request->get_param( 'description' );

		$custom_validation_result = $this->validation->staff_award_types_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff_award_type';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                  name = %s,
                  description = %s
                    ",
			$data['name'],
			$data['description']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_referees_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['first_name']         = $request->get_param( 'first_name' );
		$data['last_name']          = $request->get_param( 'last_name' );
		$data['image']              = $request->get_param( 'image' );
		$data['citizenship']        = $request->get_param( 'citizenship' );
		$data['second_citizenship'] = $request->get_param( 'second_citizenship' );
		$data['place_of_birth']     = $request->get_param( 'place_of_birth' );
		$data['residence']          = $request->get_param( 'residence' );
		$data['retired']            = $request->get_param( 'retired' );
		$data['gender']             = $request->get_param( 'gender' );
		$data['job']                = $request->get_param( 'job' );
		$data['date_of_birth']      = $request->get_param( 'date_of_birth' );
		$data['date_of_death']      = $request->get_param( 'date_of_death' );

		$custom_validation_result = $this->validation->referees_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    first_name = %s,
                    last_name = %s,
                    image = %s,
                    citizenship = %s,
                    second_citizenship = %s,
                    place_of_birth = %s,
                    residence = %s,
                    retired = %d,
                    gender = %d,
                    job = %s,
                    date_of_birth = %s,
                    date_of_death = %s
                    ",
			$data['first_name'],
			$data['last_name'],
			$data['image'],
			$data['citizenship'],
			$data['second_citizenship'],
			$data['place_of_birth'],
			$data['residence'],
			$data['retired'],
			$data['gender'],
			$data['job'],
			$data['date_of_birth'],
			$data['date_of_death'],
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_referee_badges_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['referee_id']            = $request->get_param( 'referee_id' );
		$data['referee_badge_type_id'] = $request->get_param( 'referee_badge_type_id' );
		$data['start_date']            = $request->get_param( 'start_date' );
		$data['end_date']              = $request->get_param( 'end_date' );

		$custom_validation_result = $this->validation->referee_badges_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee_badge';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                referee_id = %d,
                referee_badge_type_id = %d,
                start_date = %s,
                end_date = %s      
                    ",
			$data['referee_id'],
			$data['referee_badge_type_id'],
			$data['start_date'],
			$data['end_date']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_referee_badge_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['name']        = $request->get_param( 'name' );
		$data['description'] = $request->get_param( 'description' );

		$custom_validation_result = $this->validation->referee_badge_types_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee_badge_type';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                name = %s,
                description = %s     
                    ",
			$data['name'],
			$data['description'],
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_teams_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['name']                        = $request->get_param( 'name' );
		$data['description']                 = $request->get_param( 'description' );
		$data['logo']                        = $request->get_param( 'logo' );
		$data['type']                        = $request->get_param( 'type' );
		$data['foundation_date']             = $request->get_param( 'foundation_date' );
		$data['stadium_id']                  = $request->get_param( 'stadium_id' );
		$data['full_name']                   = $request->get_param( 'full_name' );
		$data['address']                     = $request->get_param( 'address' );
		$data['tel']                         = $request->get_param( 'tel' );
		$data['fax']                         = $request->get_param( 'fax' );
		$data['website_url']                 = $request->get_param( 'website_url' );
		$data['club_nation']                 = $request->get_param( 'club_nation' );
		$data['national_team_confederation'] = $request->get_param( 'national_team_confederation' );

		$custom_validation_result = $this->validation->teams_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// Insert into the database.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    name = %s,
                    description = %s,
                    logo = %s,
                    type = %d,
                    foundation_date = %s,
                    stadium_id = %d,
                    full_name = %s,
                    address = %s,
                    tel = %s,
                    fax = %s,
                    website_url = %s,
                    club_nation = %s,
                    national_team_confederation = %d
                    ",
			$data['name'],
			$data['description'],
			$data['logo'],
			$data['type'],
			$data['foundation_date'],
			$data['stadium_id'],
			$data['full_name'],
			$data['address'],
			$data['tel'],
			$data['fax'],
			$data['website_url'],
			$data['club_nation'],
			$data['national_team_confederation']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_squads_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['name']        = $request->get_param( 'name' );
		$data['description'] = $request->get_param( 'description' );

		for ( $i = 1;$i <= 11;$i++ ) {
			$data[ 'lineup_player_id_' . $i ] = $request->get_param( 'lineup_player_id_' . $i );
		}

		for ( $i = 1;$i <= 20;$i++ ) {
			$data[ 'substitute_player_id_' . $i ] = $request->get_param( 'substitute_player_id_' . $i );
		}

		for ( $i = 1;$i <= 20;$i++ ) {
			$data[ 'staff_id_' . $i ] = $request->get_param( 'staff_id_' . $i );
		}

		$data['jersey_set_id'] = $request->get_param( 'jersey_set_id' );
		$data['formation_id']  = $request->get_param( 'formation_id' );

		$custom_validation_result = $this->validation->squads_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_squad';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
            name = %s,
            description = %s,
            lineup_player_id_1 = %d,
            lineup_player_id_2 = %d,
            lineup_player_id_3 = %d,
            lineup_player_id_4 = %d,
            lineup_player_id_5 = %d,
            lineup_player_id_6 = %d,
            lineup_player_id_7 = %d,
            lineup_player_id_8 = %d,
            lineup_player_id_9 = %d,
            lineup_player_id_10 = %d,
            lineup_player_id_11 = %d,
            substitute_player_id_1 = %d,
            substitute_player_id_2 = %d,
            substitute_player_id_3 = %d,
            substitute_player_id_4 = %d,
            substitute_player_id_5 = %d,
            substitute_player_id_6 = %d,
            substitute_player_id_7 = %d,
            substitute_player_id_8 = %d,
            substitute_player_id_9 = %d,
            substitute_player_id_10 = %d,
            substitute_player_id_11 = %d,
            substitute_player_id_12 = %d,
            substitute_player_id_13 = %d,
            substitute_player_id_14 = %d,
            substitute_player_id_15 = %d,
            substitute_player_id_16 = %d,
            substitute_player_id_17 = %d,
            substitute_player_id_18 = %d,
            substitute_player_id_19 = %d,
            substitute_player_id_20 = %d,
            staff_id_1 = %d,
            staff_id_2 = %d,
            staff_id_3 = %d,
            staff_id_4 = %d,
            staff_id_5 = %d,
            staff_id_6 = %d,
            staff_id_7 = %d,
            staff_id_8 = %d,
            staff_id_9 = %d,
            staff_id_10 = %d,
            staff_id_11 = %d,
            staff_id_12 = %d,
            staff_id_13 = %d,
            staff_id_14 = %d,
            staff_id_15 = %d,
            staff_id_16 = %d,
            staff_id_17 = %d,
            staff_id_18 = %d,
            staff_id_19 = %d,
            staff_id_20 = %d,
            jersey_set_id = %d,
            formation_id = %d
                    ",
			$data['name'],
			$data['description'],
			$data['lineup_player_id_1'],
			$data['lineup_player_id_2'],
			$data['lineup_player_id_3'],
			$data['lineup_player_id_4'],
			$data['lineup_player_id_5'],
			$data['lineup_player_id_6'],
			$data['lineup_player_id_7'],
			$data['lineup_player_id_8'],
			$data['lineup_player_id_9'],
			$data['lineup_player_id_10'],
			$data['lineup_player_id_11'],
			$data['substitute_player_id_1'],
			$data['substitute_player_id_2'],
			$data['substitute_player_id_3'],
			$data['substitute_player_id_4'],
			$data['substitute_player_id_5'],
			$data['substitute_player_id_6'],
			$data['substitute_player_id_7'],
			$data['substitute_player_id_8'],
			$data['substitute_player_id_9'],
			$data['substitute_player_id_10'],
			$data['substitute_player_id_11'],
			$data['substitute_player_id_12'],
			$data['substitute_player_id_13'],
			$data['substitute_player_id_14'],
			$data['substitute_player_id_15'],
			$data['substitute_player_id_16'],
			$data['substitute_player_id_17'],
			$data['substitute_player_id_18'],
			$data['substitute_player_id_19'],
			$data['substitute_player_id_20'],
			$data['staff_id_1'],
			$data['staff_id_2'],
			$data['staff_id_3'],
			$data['staff_id_4'],
			$data['staff_id_5'],
			$data['staff_id_6'],
			$data['staff_id_7'],
			$data['staff_id_8'],
			$data['staff_id_9'],
			$data['staff_id_10'],
			$data['staff_id_11'],
			$data['staff_id_12'],
			$data['staff_id_13'],
			$data['staff_id_14'],
			$data['staff_id_15'],
			$data['staff_id_16'],
			$data['staff_id_17'],
			$data['staff_id_18'],
			$data['staff_id_19'],
			$data['staff_id_20'],
			$data['jersey_set_id'],
			$data['formation_id']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_formations_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// Get data.
		$data['name']        = $request->get_param( 'name' );
		$data['description'] = $request->get_param( 'description' );

		for ( $i = 1;$i <= 11;$i++ ) {
			$data[ 'x_position_' . $i ] = $request->get_param( 'x_position_' . $i );
		}

		for ( $i = 1;$i <= 11;$i++ ) {
			$data[ 'y_position_' . $i ] = $request->get_param( 'y_position_' . $i );
		}

		$custom_validation_result = $this->validation->formations_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// Insert into the database.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_formation';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                        name = %s,
                      description = %s,
                      x_position_1 = %d,
                      x_position_2 = %d,
                      x_position_3 = %d,
                      x_position_4 = %d,
                      x_position_5 = %d,
                      x_position_6 = %d,
                      x_position_7 = %d,
                      x_position_8 = %d,
                      x_position_9 = %d,
                      x_position_10 = %d,
                      x_position_11 = %d,
                      y_position_1 = %d,
                      y_position_2 = %d,
                      y_position_3 = %d,
                      y_position_4 = %d,
                      y_position_5 = %d,
                      y_position_6 = %d,
                      y_position_7 = %d,
                      y_position_8 = %d,
                      y_position_9 = %d,
                      y_position_10 = %d,
                      y_position_11 = %d
                    ",
			$data['name'],
			$data['description'],
			$data['x_position_1'],
			$data['x_position_2'],
			$data['x_position_3'],
			$data['x_position_4'],
			$data['x_position_5'],
			$data['x_position_6'],
			$data['x_position_7'],
			$data['x_position_8'],
			$data['x_position_9'],
			$data['x_position_10'],
			$data['x_position_11'],
			$data['y_position_1'],
			$data['y_position_2'],
			$data['y_position_3'],
			$data['y_position_4'],
			$data['y_position_5'],
			$data['y_position_6'],
			$data['y_position_7'],
			$data['y_position_8'],
			$data['y_position_9'],
			$data['y_position_10'],
			$data['y_position_11']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_jersey_sets_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['name']        = $request->get_param( 'name' );
		$data['description'] = $request->get_param( 'description' );

		for ( $i = 1;$i <= 50;$i++ ) {
			$data[ 'player_id_' . $i ] = $request->get_param( 'player_id_' . $i );
		}

		for ( $i = 1;$i <= 50;$i++ ) {
			$data[ 'jersey_number_player_id_' . $i ] = $request->get_param( 'jersey_number_player_id_' . $i );
		}

		$custom_validation_result = $this->validation->jersey_sets_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_jersey_set';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                      `name` = %s,
                      description = %s,
                      player_id_1 = %d,
                      player_id_2 = %d,
                      player_id_3 = %d,
                      player_id_4 = %d,
                      player_id_5 = %d,
                      player_id_6 = %d,
                      player_id_7 = %d,
                      player_id_8 = %d,
                      player_id_9 = %d,
                      player_id_10 = %d,
                      player_id_11 = %d,
                      player_id_12 = %d,
                      player_id_13 = %d,
                      player_id_14 = %d,
                      player_id_15 = %d,
                      player_id_16 = %d,
                      player_id_17 = %d,
                      player_id_18 = %d,
                      player_id_19 = %d,
                      player_id_20 = %d,
                      player_id_21 = %d,
                      player_id_22 = %d,
                      player_id_23 = %d,
                      player_id_24 = %d,
                      player_id_25 = %d,
                      player_id_26 = %d,
                      player_id_27 = %d,
                      player_id_28 = %d,
                      player_id_29 = %d,
                      player_id_30 = %d,
                      player_id_31 = %d,
                      player_id_32 = %d,
                      player_id_33 = %d,
                      player_id_34 = %d,
                      player_id_35 = %d,
                      player_id_36 = %d,
                      player_id_37 = %d,
                      player_id_38 = %d,
                      player_id_39 = %d,
                      player_id_40 = %d,
                      player_id_41 = %d,
                      player_id_42 = %d,
                      player_id_43 = %d,
                      player_id_44 = %d,
                      player_id_45 = %d,
                      player_id_46 = %d,
                      player_id_47 = %d,
                      player_id_48 = %d,
                      player_id_49 = %d,
                      player_id_50 = %d,
                      jersey_number_player_id_1 = %d,
                      jersey_number_player_id_2 = %d,
                      jersey_number_player_id_3 = %d,
                      jersey_number_player_id_4 = %d,
                      jersey_number_player_id_5 = %d,
                      jersey_number_player_id_6 = %d,
                      jersey_number_player_id_7 = %d,
                      jersey_number_player_id_8 = %d,
                      jersey_number_player_id_9 = %d,
                      jersey_number_player_id_10 = %d,
                      jersey_number_player_id_11 = %d,
                      jersey_number_player_id_12 = %d,
                      jersey_number_player_id_13 = %d,
                      jersey_number_player_id_14 = %d,
                      jersey_number_player_id_15 = %d,
                      jersey_number_player_id_16 = %d,
                      jersey_number_player_id_17 = %d,
                      jersey_number_player_id_18 = %d,
                      jersey_number_player_id_19 = %d,
                      jersey_number_player_id_20 = %d,
                      jersey_number_player_id_21 = %d,
                      jersey_number_player_id_22 = %d,
                      jersey_number_player_id_23 = %d,
                      jersey_number_player_id_24 = %d,
                      jersey_number_player_id_25 = %d,
                      jersey_number_player_id_26 = %d,
                      jersey_number_player_id_27 = %d,
                      jersey_number_player_id_28 = %d,
                      jersey_number_player_id_29 = %d,
                      jersey_number_player_id_30 = %d,
                      jersey_number_player_id_31 = %d,
                      jersey_number_player_id_32 = %d,
                      jersey_number_player_id_33 = %d,
                      jersey_number_player_id_34 = %d,
                      jersey_number_player_id_35 = %d,
                      jersey_number_player_id_36 = %d,
                      jersey_number_player_id_37 = %d,
                      jersey_number_player_id_38 = %d,
                      jersey_number_player_id_39 = %d,
                      jersey_number_player_id_40 = %d,
                      jersey_number_player_id_41 = %d,
                      jersey_number_player_id_42 = %d,
                      jersey_number_player_id_43 = %d,
                      jersey_number_player_id_44 = %d,
                      jersey_number_player_id_45 = %d,
                      jersey_number_player_id_46 = %d,
                      jersey_number_player_id_47 = %d,
                      jersey_number_player_id_48 = %d,
                      jersey_number_player_id_49 = %d,
                      jersey_number_player_id_50 = %d
                    ",
			$data['name'],
			$data['description'],
			$data['player_id_1'],
			$data['player_id_2'],
			$data['player_id_3'],
			$data['player_id_4'],
			$data['player_id_5'],
			$data['player_id_6'],
			$data['player_id_7'],
			$data['player_id_8'],
			$data['player_id_9'],
			$data['player_id_10'],
			$data['player_id_11'],
			$data['player_id_12'],
			$data['player_id_13'],
			$data['player_id_14'],
			$data['player_id_15'],
			$data['player_id_16'],
			$data['player_id_17'],
			$data['player_id_18'],
			$data['player_id_19'],
			$data['player_id_20'],
			$data['player_id_21'],
			$data['player_id_22'],
			$data['player_id_23'],
			$data['player_id_24'],
			$data['player_id_25'],
			$data['player_id_26'],
			$data['player_id_27'],
			$data['player_id_28'],
			$data['player_id_29'],
			$data['player_id_30'],
			$data['player_id_31'],
			$data['player_id_32'],
			$data['player_id_33'],
			$data['player_id_34'],
			$data['player_id_35'],
			$data['player_id_36'],
			$data['player_id_37'],
			$data['player_id_38'],
			$data['player_id_39'],
			$data['player_id_40'],
			$data['player_id_41'],
			$data['player_id_42'],
			$data['player_id_43'],
			$data['player_id_44'],
			$data['player_id_45'],
			$data['player_id_46'],
			$data['player_id_47'],
			$data['player_id_48'],
			$data['player_id_49'],
			$data['player_id_50'],
			$data['jersey_number_player_id_1'],
			$data['jersey_number_player_id_2'],
			$data['jersey_number_player_id_3'],
			$data['jersey_number_player_id_4'],
			$data['jersey_number_player_id_5'],
			$data['jersey_number_player_id_6'],
			$data['jersey_number_player_id_7'],
			$data['jersey_number_player_id_8'],
			$data['jersey_number_player_id_9'],
			$data['jersey_number_player_id_10'],
			$data['jersey_number_player_id_11'],
			$data['jersey_number_player_id_12'],
			$data['jersey_number_player_id_13'],
			$data['jersey_number_player_id_14'],
			$data['jersey_number_player_id_15'],
			$data['jersey_number_player_id_16'],
			$data['jersey_number_player_id_17'],
			$data['jersey_number_player_id_18'],
			$data['jersey_number_player_id_19'],
			$data['jersey_number_player_id_20'],
			$data['jersey_number_player_id_21'],
			$data['jersey_number_player_id_22'],
			$data['jersey_number_player_id_23'],
			$data['jersey_number_player_id_24'],
			$data['jersey_number_player_id_25'],
			$data['jersey_number_player_id_26'],
			$data['jersey_number_player_id_27'],
			$data['jersey_number_player_id_28'],
			$data['jersey_number_player_id_29'],
			$data['jersey_number_player_id_30'],
			$data['jersey_number_player_id_31'],
			$data['jersey_number_player_id_32'],
			$data['jersey_number_player_id_33'],
			$data['jersey_number_player_id_34'],
			$data['jersey_number_player_id_35'],
			$data['jersey_number_player_id_36'],
			$data['jersey_number_player_id_37'],
			$data['jersey_number_player_id_38'],
			$data['jersey_number_player_id_39'],
			$data['jersey_number_player_id_40'],
			$data['jersey_number_player_id_41'],
			$data['jersey_number_player_id_42'],
			$data['jersey_number_player_id_43'],
			$data['jersey_number_player_id_44'],
			$data['jersey_number_player_id_45'],
			$data['jersey_number_player_id_46'],
			$data['jersey_number_player_id_47'],
			$data['jersey_number_player_id_48'],
			$data['jersey_number_player_id_49'],
			$data['jersey_number_player_id_50']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_stadiums_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// Get data.
		$data['name']        = $request->get_param( 'name' );
		$data['description'] = $request->get_param( 'description' );
		$data['image']       = $request->get_param( 'image' );

		$custom_validation_result = $this->validation->stadiums_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// Insert into the database.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_stadium';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                      name = %s,
                      description = %s,
                      image = %s
                    ",
			$data['name'],
			$data['description'],
			$data['image']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_trophies_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// Get data.
		$data['trophy_type_id']  = $request->get_param( 'trophy_type_id' );
		$data['team_id']         = $request->get_param( 'team_id' );
		$data['assignment_date'] = $request->get_param( 'assignment_date' );

		$custom_validation_result = $this->validation->trophies_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// Insert into the database.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_trophy';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                      trophy_type_id = %d,
                      team_id = %d,
                      assignment_date = %s
                    ",
			$data['trophy_type_id'],
			$data['team_id'],
			$data['assignment_date']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_trophy_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['name']        = $request->get_param( 'name' );
		$data['description'] = $request->get_param( 'description' );
		$data['logo']        = $request->get_param( 'logo' );

		$custom_validation_result = $this->validation->trophy_types_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_trophy_type';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                        name = %s,
                        description = %s,
                        logo = %s
                    ",
			$data['name'],
			$data['description'],
			$data['logo']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_ranking_transitions_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['ranking_type_id'] = $request->get_param( 'ranking_type_id' );
		$data['value']           = $request->get_param( 'value' );
		$data['team_id']         = $request->get_param( 'team_id' );
		$data['date']            = $request->get_param( 'date' );

		$custom_validation_result = $this->validation->ranking_transitions_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_ranking_transition';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                      ranking_type_id = %d,
                      value = %d,
                      team_id = %d,
                      date = %s
                    ",
			$data['ranking_type_id'],
			$data['value'],
			$data['team_id'],
			$data['date']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_ranking_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['name']        = $request->get_param( 'name' );
		$data['description'] = $request->get_param( 'description' );

		$custom_validation_result = $this->validation->ranking_types_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_ranking_type';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                      name = %s,
                      description = %s
                    ",
			$data['name'],
			$data['description']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_matches_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['name']                          = $request->get_param( 'name' );
		$data['description']                   = $request->get_param( 'description' );
		$data['competition_id']                = $request->get_param( 'competition_id' );
		$data['round']                         = $request->get_param( 'round' );
		$data['type']                          = $request->get_param( 'type' );
		$data['team_id_1']                     = $request->get_param( 'team_id_1' );
		$data['team_id_2']                     = $request->get_param( 'team_id_2' );
		$data['date']                          = $request->get_param( 'date' );
		$data['time']                          = $request->get_param( 'time' );
		$data['fh_additional_time']            = $request->get_param( 'fh_additional_time' );
		$data['sh_additional_time']            = $request->get_param( 'sh_additional_time' );
		$data['fh_extra_time_additional_time'] = $request->get_param( 'fh_extra_time_additional_time' );
		$data['sh_extra_time_additional_time'] = $request->get_param( 'sh_extra_time_additional_time' );
		$data['referee_id']                    = $request->get_param( 'referee_id' );
		$data['stadium_id']                    = $request->get_param( 'stadium_id' );
		$data['attendance']                    = $request->get_param( 'attendance' );

		// Get the data for both teams
		for ( $t = 1;$t <= 2;$t++ ) {

			// Player 1-11
			for ( $i = 1;$i <= 11;$i++ ) {

				$data[ 'team_' . $t . '_lineup_player_id_' . $i ] = $request->get_param( 'team_' . $t . '_lineup_player_id_' . $i );

			}

			// Substitute 1-20
			for ( $i = 1;$i <= 20;$i++ ) {

				$data[ 'team_' . $t . '_substitute_player_id_' . $i ] = $request->get_param( 'team_' . $t . '_substitute_player_id_' . $i );

			}

			// Staff 1-20
			for ( $i = 1;$i <= 20;$i++ ) {

				$data[ 'team_' . $t . '_staff_id_' . $i ] = $request->get_param( 'team_' . $t . '_staff_id_' . $i );

			}

			// Formation
			$data[ 'team_' . $t . '_formation_id' ] = $request->get_param( 'team_' . $t . '_formation_id' );

			// Jersey Set
			$data[ 'team_' . $t . '_jersey_set_id' ] = $request->get_param( 'team_' . $t . '_jersey_set_id' );

		}

		$custom_validation_result = $this->validation->matches_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    name = %s,
                    description = %s,
                    competition_id = %d,
                    round = %d,
                    type = %d,
                    team_id_1 = %d,
                    team_id_2 = %d,
                    date = %s,
                    time = %s,
                    fh_additional_time = %d,
                    sh_additional_time = %d,
                    fh_extra_time_additional_time = %d,
                    sh_extra_time_additional_time = %d,
                    team_1_lineup_player_id_1 = %d,
                    team_1_lineup_player_id_2 = %d,
                    team_1_lineup_player_id_3 = %d,
                    team_1_lineup_player_id_4 = %d,
                    team_1_lineup_player_id_5 = %d,
                    team_1_lineup_player_id_6 = %d,
                    team_1_lineup_player_id_7 = %d,
                    team_1_lineup_player_id_8 = %d,
                    team_1_lineup_player_id_9 = %d,
                    team_1_lineup_player_id_10 = %d,
                    team_1_lineup_player_id_11 = %d,
                    team_1_substitute_player_id_1 = %d,
                    team_1_substitute_player_id_2 = %d,
                    team_1_substitute_player_id_3 = %d,
                    team_1_substitute_player_id_4 = %d,
                    team_1_substitute_player_id_5 = %d,
                    team_1_substitute_player_id_6 = %d,
                    team_1_substitute_player_id_7 = %d,
                    team_1_substitute_player_id_8 = %d,
                    team_1_substitute_player_id_9 = %d,
                    team_1_substitute_player_id_10 = %d,
                    team_1_substitute_player_id_11 = %d,
                    team_1_substitute_player_id_12 = %d,
                    team_1_substitute_player_id_13 = %d,
                    team_1_substitute_player_id_14 = %d,
                    team_1_substitute_player_id_15 = %d,
                    team_1_substitute_player_id_16 = %d,
                    team_1_substitute_player_id_17 = %d,
                    team_1_substitute_player_id_18 = %d,
                    team_1_substitute_player_id_19 = %d,
                    team_1_substitute_player_id_20 = %d,
                    team_1_staff_id_1 = %d,
                    team_1_staff_id_2 = %d,
                    team_1_staff_id_3 = %d,
                    team_1_staff_id_4 = %d,
                    team_1_staff_id_5 = %d,
                    team_1_staff_id_6 = %d,
                    team_1_staff_id_7 = %d,
                    team_1_staff_id_8 = %d,
                    team_1_staff_id_9 = %d,
                    team_1_staff_id_10 = %d,
                    team_1_staff_id_11 = %d,
                    team_1_staff_id_12 = %d,
                    team_1_staff_id_13 = %d,
                    team_1_staff_id_14 = %d,
                    team_1_staff_id_15 = %d,
                    team_1_staff_id_16 = %d,
                    team_1_staff_id_17 = %d,
                    team_1_staff_id_18 = %d,
                    team_1_staff_id_19 = %d,
                    team_1_staff_id_20 = %d,
                    team_2_lineup_player_id_1 = %d,
                    team_2_lineup_player_id_2 = %d,
                    team_2_lineup_player_id_3 = %d,
                    team_2_lineup_player_id_4 = %d,
                    team_2_lineup_player_id_5 = %d,
                    team_2_lineup_player_id_6 = %d,
                    team_2_lineup_player_id_7 = %d,
                    team_2_lineup_player_id_8 = %d,
                    team_2_lineup_player_id_9 = %d,
                    team_2_lineup_player_id_10 = %d,
                    team_2_lineup_player_id_11 = %d,
                    team_2_substitute_player_id_1 = %d,
                    team_2_substitute_player_id_2 = %d,
                    team_2_substitute_player_id_3 = %d,
                    team_2_substitute_player_id_4 = %d,
                    team_2_substitute_player_id_5 = %d,
                    team_2_substitute_player_id_6 = %d,
                    team_2_substitute_player_id_7 = %d,
                    team_2_substitute_player_id_8 = %d,
                    team_2_substitute_player_id_9 = %d,
                    team_2_substitute_player_id_10 = %d,
                    team_2_substitute_player_id_11 = %d,
                    team_2_substitute_player_id_12 = %d,
                    team_2_substitute_player_id_13 = %d,
                    team_2_substitute_player_id_14 = %d,
                    team_2_substitute_player_id_15 = %d,
                    team_2_substitute_player_id_16 = %d,
                    team_2_substitute_player_id_17 = %d,
                    team_2_substitute_player_id_18 = %d,
                    team_2_substitute_player_id_19 = %d,
                    team_2_substitute_player_id_20 = %d,
                    team_2_staff_id_1 = %d,
                    team_2_staff_id_2 = %d,
                    team_2_staff_id_3 = %d,
                    team_2_staff_id_4 = %d,
                    team_2_staff_id_5 = %d,
                    team_2_staff_id_6 = %d,
                    team_2_staff_id_7 = %d,
                    team_2_staff_id_8 = %d,
                    team_2_staff_id_9 = %d,
                    team_2_staff_id_10 = %d,
                    team_2_staff_id_11 = %d,
                    team_2_staff_id_12 = %d,
                    team_2_staff_id_13 = %d,
                    team_2_staff_id_14 = %d,
                    team_2_staff_id_15 = %d,
                    team_2_staff_id_16 = %d,
                    team_2_staff_id_17 = %d,
                    team_2_staff_id_18 = %d,
                    team_2_staff_id_19 = %d,
                    team_2_staff_id_20 = %d,
                    stadium_id = %d,
                    team_1_formation_id = %d,
                    team_2_formation_id = %d,
                    attendance = %d,
                    referee_id = %d,
                    team_1_jersey_set_id = %d,
                    team_2_jersey_set_id = %d
                    ",
			$data['name'],
			$data['description'],
			$data['competition_id'],
			$data['round'],
			$data['type'],
			$data['team_id_1'],
			$data['team_id_2'],
			$data['date'],
			$data['time'],
			$data['fh_additional_time'],
			$data['sh_additional_time'],
			$data['fh_extra_time_additional_time'],
			$data['sh_extra_time_additional_time'],
			$data['team_1_lineup_player_id_1'],
			$data['team_1_lineup_player_id_2'],
			$data['team_1_lineup_player_id_3'],
			$data['team_1_lineup_player_id_4'],
			$data['team_1_lineup_player_id_5'],
			$data['team_1_lineup_player_id_6'],
			$data['team_1_lineup_player_id_7'],
			$data['team_1_lineup_player_id_8'],
			$data['team_1_lineup_player_id_9'],
			$data['team_1_lineup_player_id_10'],
			$data['team_1_lineup_player_id_11'],
			$data['team_1_substitute_player_id_1'],
			$data['team_1_substitute_player_id_2'],
			$data['team_1_substitute_player_id_3'],
			$data['team_1_substitute_player_id_4'],
			$data['team_1_substitute_player_id_5'],
			$data['team_1_substitute_player_id_6'],
			$data['team_1_substitute_player_id_7'],
			$data['team_1_substitute_player_id_8'],
			$data['team_1_substitute_player_id_9'],
			$data['team_1_substitute_player_id_10'],
			$data['team_1_substitute_player_id_11'],
			$data['team_1_substitute_player_id_12'],
			$data['team_1_substitute_player_id_13'],
			$data['team_1_substitute_player_id_14'],
			$data['team_1_substitute_player_id_15'],
			$data['team_1_substitute_player_id_16'],
			$data['team_1_substitute_player_id_17'],
			$data['team_1_substitute_player_id_18'],
			$data['team_1_substitute_player_id_19'],
			$data['team_1_substitute_player_id_20'],
			$data['team_1_staff_id_1'],
			$data['team_1_staff_id_2'],
			$data['team_1_staff_id_3'],
			$data['team_1_staff_id_4'],
			$data['team_1_staff_id_5'],
			$data['team_1_staff_id_6'],
			$data['team_1_staff_id_7'],
			$data['team_1_staff_id_8'],
			$data['team_1_staff_id_9'],
			$data['team_1_staff_id_10'],
			$data['team_1_staff_id_11'],
			$data['team_1_staff_id_12'],
			$data['team_1_staff_id_13'],
			$data['team_1_staff_id_14'],
			$data['team_1_staff_id_15'],
			$data['team_1_staff_id_16'],
			$data['team_1_staff_id_17'],
			$data['team_1_staff_id_18'],
			$data['team_1_staff_id_19'],
			$data['team_1_staff_id_20'],
			$data['team_2_lineup_player_id_1'],
			$data['team_2_lineup_player_id_2'],
			$data['team_2_lineup_player_id_3'],
			$data['team_2_lineup_player_id_4'],
			$data['team_2_lineup_player_id_5'],
			$data['team_2_lineup_player_id_6'],
			$data['team_2_lineup_player_id_7'],
			$data['team_2_lineup_player_id_8'],
			$data['team_2_lineup_player_id_9'],
			$data['team_2_lineup_player_id_10'],
			$data['team_2_lineup_player_id_11'],
			$data['team_2_substitute_player_id_1'],
			$data['team_2_substitute_player_id_2'],
			$data['team_2_substitute_player_id_3'],
			$data['team_2_substitute_player_id_4'],
			$data['team_2_substitute_player_id_5'],
			$data['team_2_substitute_player_id_6'],
			$data['team_2_substitute_player_id_7'],
			$data['team_2_substitute_player_id_8'],
			$data['team_2_substitute_player_id_9'],
			$data['team_2_substitute_player_id_10'],
			$data['team_2_substitute_player_id_11'],
			$data['team_2_substitute_player_id_12'],
			$data['team_2_substitute_player_id_13'],
			$data['team_2_substitute_player_id_14'],
			$data['team_2_substitute_player_id_15'],
			$data['team_2_substitute_player_id_16'],
			$data['team_2_substitute_player_id_17'],
			$data['team_2_substitute_player_id_18'],
			$data['team_2_substitute_player_id_19'],
			$data['team_2_substitute_player_id_20'],
			$data['team_2_staff_id_1'],
			$data['team_2_staff_id_2'],
			$data['team_2_staff_id_3'],
			$data['team_2_staff_id_4'],
			$data['team_2_staff_id_5'],
			$data['team_2_staff_id_6'],
			$data['team_2_staff_id_7'],
			$data['team_2_staff_id_8'],
			$data['team_2_staff_id_9'],
			$data['team_2_staff_id_10'],
			$data['team_2_staff_id_11'],
			$data['team_2_staff_id_12'],
			$data['team_2_staff_id_13'],
			$data['team_2_staff_id_14'],
			$data['team_2_staff_id_15'],
			$data['team_2_staff_id_16'],
			$data['team_2_staff_id_17'],
			$data['team_2_staff_id_18'],
			$data['team_2_staff_id_19'],
			$data['team_2_staff_id_20'],
			$data['stadium_id'],
			$data['team_1_formation_id'],
			$data['team_2_formation_id'],
			$data['attendance'],
			$data['referee_id'],
			$data['team_1_jersey_set_id'],
			$data['team_2_jersey_set_id']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_competitions_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data
		$data['name']        = $request->get_param( 'name' );
		$data['description'] = $request->get_param( 'description' );
		$data['logo']        = $request->get_param( 'logo' );
		$data['type']        = $request->get_param( 'type' );
		$data['rounds']      = $request->get_param( 'rounds' );

		for ( $i = 1;$i <= 128;$i++ ) {
			$data[ 'team_id_' . $i ] = $request->get_param( 'team_id_' . $i );
		}

		$data['rr_victory_points']     = $request->get_param( 'rr_victory_points' );
		$data['rr_draw_points']        = $request->get_param( 'rr_draw_points' );
		$data['rr_defeat_points']      = $request->get_param( 'rr_defeat_points' );
		$data['rr_sorting_order_1']    = $request->get_param( 'rr_sorting_order_1' );
		$data['rr_sorting_order_by_1'] = $request->get_param( 'rr_sorting_order_by_1' );
		$data['rr_sorting_order_2']    = $request->get_param( 'rr_sorting_order_2' );
		$data['rr_sorting_order_by_2'] = $request->get_param( 'rr_sorting_order_by_2' );

		$custom_validation_result = $this->validation->competitions_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_competition';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                name = %s,
                description = %s,
                logo = %s,
                type = %d,
                rounds = %d,
                team_id_1 = %d,
                team_id_2 = %d,
                team_id_3 = %d,
                team_id_4 = %d,
                team_id_5 = %d,
                team_id_6 = %d,
                team_id_7 = %d,
                team_id_8 = %d,
                team_id_9 = %d,
                team_id_10 = %d,
                team_id_11 = %d,
                team_id_12 = %d,
                team_id_13 = %d,
                team_id_14 = %d,
                team_id_15 = %d,
                team_id_16 = %d,
                team_id_17 = %d,
                team_id_18 = %d,
                team_id_19 = %d,
                team_id_20 = %d,
                team_id_21 = %d,
                team_id_22 = %d,
                team_id_23 = %d,
                team_id_24 = %d,
                team_id_25 = %d,
                team_id_26 = %d,
                team_id_27 = %d,
                team_id_28 = %d,
                team_id_29 = %d,
                team_id_30 = %d,
                team_id_31 = %d,
                team_id_32 = %d,
                team_id_33 = %d,
                team_id_34 = %d,
                team_id_35 = %d,
                team_id_36 = %d,
                team_id_37 = %d,
                team_id_38 = %d,
                team_id_39 = %d,
                team_id_40 = %d,
                team_id_41 = %d,
                team_id_42 = %d,
                team_id_43 = %d,
                team_id_44 = %d,
                team_id_45 = %d,
                team_id_46 = %d,
                team_id_47 = %d,
                team_id_48 = %d,
                team_id_49 = %d,
                team_id_50 = %d,
                team_id_51 = %d,
                team_id_52 = %d,
                team_id_53 = %d,
                team_id_54 = %d,
                team_id_55 = %d,
                team_id_56 = %d,
                team_id_57 = %d,
                team_id_58 = %d,
                team_id_59 = %d,
                team_id_60 = %d,
                team_id_61 = %d,
                team_id_62 = %d,
                team_id_63 = %d,
                team_id_64 = %d,
                team_id_65 = %d,
                team_id_66 = %d,
                team_id_67 = %d,
                team_id_68 = %d,
                team_id_69 = %d,
                team_id_70 = %d,
                team_id_71 = %d,
                team_id_72 = %d,
                team_id_73 = %d,
                team_id_74 = %d,
                team_id_75 = %d,
                team_id_76 = %d,
                team_id_77 = %d,
                team_id_78 = %d,
                team_id_79 = %d,
                team_id_80 = %d,
                team_id_81 = %d,
                team_id_82 = %d,
                team_id_83 = %d,
                team_id_84 = %d,
                team_id_85 = %d,
                team_id_86 = %d,
                team_id_87 = %d,
                team_id_88 = %d,
                team_id_89 = %d,
                team_id_90 = %d,
                team_id_91 = %d,
                team_id_92 = %d,
                team_id_93 = %d,
                team_id_94 = %d,
                team_id_95 = %d,
                team_id_96 = %d,
                team_id_97 = %d,
                team_id_98 = %d,
                team_id_99 = %d,
                team_id_100 = %d,
                team_id_101 = %d,
                team_id_102 = %d,
                team_id_103 = %d,
                team_id_104 = %d,
                team_id_105 = %d,
                team_id_106 = %d,
                team_id_107 = %d,
                team_id_108 = %d,
                team_id_109 = %d,
                team_id_110 = %d,
                team_id_111 = %d,
                team_id_112 = %d,
                team_id_113 = %d,
                team_id_114 = %d,
                team_id_115 = %d,
                team_id_116 = %d,
                team_id_117 = %d,
                team_id_118 = %d,
                team_id_119 = %d,
                team_id_120 = %d,
                team_id_121 = %d,
                team_id_122 = %d,
                team_id_123 = %d,
                team_id_124 = %d,
                team_id_125 = %d,
                team_id_126 = %d,
                team_id_127 = %d,
                team_id_128 = %d,
                rr_victory_points = %d,
                rr_draw_points = %d,
                rr_defeat_points = %d,
                rr_sorting_order_1 = %d,
                rr_sorting_order_by_1 = %d,
                rr_sorting_order_2 = %d,
                rr_sorting_order_by_2 = %d
                    ",
			$data['name'],
			$data['description'],
			$data['logo'],
			$data['type'],
			$data['rounds'],
			$data['team_id_1'],
			$data['team_id_2'],
			$data['team_id_3'],
			$data['team_id_4'],
			$data['team_id_5'],
			$data['team_id_6'],
			$data['team_id_7'],
			$data['team_id_8'],
			$data['team_id_9'],
			$data['team_id_10'],
			$data['team_id_11'],
			$data['team_id_12'],
			$data['team_id_13'],
			$data['team_id_14'],
			$data['team_id_15'],
			$data['team_id_16'],
			$data['team_id_17'],
			$data['team_id_18'],
			$data['team_id_19'],
			$data['team_id_20'],
			$data['team_id_21'],
			$data['team_id_22'],
			$data['team_id_23'],
			$data['team_id_24'],
			$data['team_id_25'],
			$data['team_id_26'],
			$data['team_id_27'],
			$data['team_id_28'],
			$data['team_id_29'],
			$data['team_id_30'],
			$data['team_id_31'],
			$data['team_id_32'],
			$data['team_id_33'],
			$data['team_id_34'],
			$data['team_id_35'],
			$data['team_id_36'],
			$data['team_id_37'],
			$data['team_id_38'],
			$data['team_id_39'],
			$data['team_id_40'],
			$data['team_id_41'],
			$data['team_id_42'],
			$data['team_id_43'],
			$data['team_id_44'],
			$data['team_id_45'],
			$data['team_id_46'],
			$data['team_id_47'],
			$data['team_id_48'],
			$data['team_id_49'],
			$data['team_id_50'],
			$data['team_id_51'],
			$data['team_id_52'],
			$data['team_id_53'],
			$data['team_id_54'],
			$data['team_id_55'],
			$data['team_id_56'],
			$data['team_id_57'],
			$data['team_id_58'],
			$data['team_id_59'],
			$data['team_id_60'],
			$data['team_id_61'],
			$data['team_id_62'],
			$data['team_id_63'],
			$data['team_id_64'],
			$data['team_id_65'],
			$data['team_id_66'],
			$data['team_id_67'],
			$data['team_id_68'],
			$data['team_id_69'],
			$data['team_id_70'],
			$data['team_id_71'],
			$data['team_id_72'],
			$data['team_id_73'],
			$data['team_id_74'],
			$data['team_id_75'],
			$data['team_id_76'],
			$data['team_id_77'],
			$data['team_id_78'],
			$data['team_id_79'],
			$data['team_id_80'],
			$data['team_id_81'],
			$data['team_id_82'],
			$data['team_id_83'],
			$data['team_id_84'],
			$data['team_id_85'],
			$data['team_id_86'],
			$data['team_id_87'],
			$data['team_id_88'],
			$data['team_id_89'],
			$data['team_id_90'],
			$data['team_id_91'],
			$data['team_id_92'],
			$data['team_id_93'],
			$data['team_id_94'],
			$data['team_id_95'],
			$data['team_id_96'],
			$data['team_id_97'],
			$data['team_id_98'],
			$data['team_id_99'],
			$data['team_id_100'],
			$data['team_id_101'],
			$data['team_id_102'],
			$data['team_id_103'],
			$data['team_id_104'],
			$data['team_id_105'],
			$data['team_id_106'],
			$data['team_id_107'],
			$data['team_id_108'],
			$data['team_id_109'],
			$data['team_id_110'],
			$data['team_id_111'],
			$data['team_id_112'],
			$data['team_id_113'],
			$data['team_id_114'],
			$data['team_id_115'],
			$data['team_id_116'],
			$data['team_id_117'],
			$data['team_id_118'],
			$data['team_id_119'],
			$data['team_id_120'],
			$data['team_id_121'],
			$data['team_id_122'],
			$data['team_id_123'],
			$data['team_id_124'],
			$data['team_id_125'],
			$data['team_id_126'],
			$data['team_id_127'],
			$data['team_id_128'],
			$data['rr_victory_points'],
			$data['rr_draw_points'],
			$data['rr_defeat_points'],
			$data['rr_sorting_order_1'],
			$data['rr_sorting_order_by_1'],
			$data['rr_sorting_order_2'],
			$data['rr_sorting_order_by_2']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_transfers_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// Get data.
		$data['player_id']        = $request->get_param( 'player_id' );
		$data['date']             = $request->get_param( 'date' );
		$data['team_id_left']     = $request->get_param( 'team_id_left' );
		$data['team_id_joined']   = $request->get_param( 'team_id_joined' );
		$data['fee']              = $request->get_param( 'fee' );
		$data['transfer_type_id'] = $request->get_param( 'transfer_type_id' );

		$custom_validation_result = $this->validation->transfers_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// Insert into the database.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_transfer';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    player_id = %d,
                    date = %s,
                    team_id_left = %d,
                    team_id_joined = %d,
                    fee = %s,
                    transfer_type_id = %d
                    ",
			$data['player_id'],
			$data['date'],
			$data['team_id_left'],
			$data['team_id_joined'],
			$data['fee'],
			$data['transfer_type_id'],
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_transfer_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// Get data.
		$data['name']        = $request->get_param( 'name' );
		$data['description'] = $request->get_param( 'description' );

		$custom_validation_result = $this->validation->transfer_types_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// Insert into the database.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_transfer_type';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                        name = %s,
                        description = %s
                    ",
			$data['name'],
			$data['description']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_team_contracts_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// Get data.
		$data['team_contract_type_id'] = $request->get_param( 'team_contract_type_id' );
		$data['player_id']             = $request->get_param( 'player_id' );
		$data['start_date']            = $request->get_param( 'start_date' );
		$data['end_date']              = $request->get_param( 'end_date' );
		$data['salary']                = $request->get_param( 'salary' );
		$data['team_id']               = $request->get_param( 'team_id' );

		$custom_validation_result = $this->validation->team_contracts_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// Insert into the database.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team_contract';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    team_contract_type_id = %d,
                    player_id = %d,
                    start_date = %s,
                    end_date = %s,
                    salary = %s,
                    team_id = %d
                    ",
			$data['team_contract_type_id'],
			$data['player_id'],
			$data['start_date'],
			$data['end_date'],
			$data['salary'],
			$data['team_id']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_team_contract_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// Get data.
		$data['name']        = $request->get_param( 'name' );
		$data['description'] = $request->get_param( 'description' );

		$custom_validation_result = $this->validation->team_contract_types_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// Insert into the database.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team_contract_type';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    name = %s,
                    description = %s
                    ",
			$data['name'],
			$data['description']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_agencies_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data.
		$data['name']        = $request->get_param( 'name' );
		$data['description'] = $request->get_param( 'description' );
		$data['full_name']   = $request->get_param( 'full_name' );
		$data['address']     = $request->get_param( 'address' );
		$data['tel']         = $request->get_param( 'tel' );
		$data['fax']         = $request->get_param( 'fax' );
		$data['website']     = $request->get_param( 'website' );

		$custom_validation_result = $this->validation->agencies_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    name = %s,
                    description = %s,
                    full_name = %s,
                    address = %s,
                    tel = %s,
                    fax = %s,
                    website = %s
                    ",
			$data['name'],
			$data['description'],
			$data['full_name'],
			$data['address'],
			$data['tel'],
			$data['fax'],
			$data['website']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_agency_contracts_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// Get data.
		$data['agency_contract_type_id'] = $request->get_param( 'agency_contract_type_id' );
		$data['player_id']               = $request->get_param( 'player_id' );
		$data['start_date']              = $request->get_param( 'start_date' );
		$data['end_date']                = $request->get_param( 'end_date' );
		$data['agency_id']               = $request->get_param( 'agency_id' );

		$custom_validation_result = $this->validation->agency_contracts_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency_contract';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    agency_contract_type_id = %d,
                    player_id = %d,
                    start_date = %s,
                    end_date = %s,
                    agency_id = %d
                    ",
			$data['agency_contract_type_id'],
			$data['player_id'],
			$data['start_date'],
			$data['end_date'],
			$data['agency_id']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_agency_contract_types_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// get data.
		$data['name']        = $request->get_param( 'name' );
		$data['description'] = $request->get_param( 'description' );

		$custom_validation_result = $this->validation->agency_contract_types_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// insert into the database.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency_contract_type';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    name = %s,
                    description = %s
                    ",
			$data['name'],
			$data['description']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	public function rest_api_daext_soccer_engine_create_market_value_transitions_callback( $request ) {

		if ( ! $this->authenticate_rest_request( $request, 'create' ) ) {
			return $this->invalid_authentication_object;
		}

		$data = array();

		// Get data.
		$data['date']      = $request->get_param( 'date' );
		$data['value']     = $request->get_param( 'value' );
		$data['player_id'] = $request->get_param( 'player_id' );

		$custom_validation_result = $this->validation->market_value_transitions_validation( $data );

		if ( $custom_validation_result['status'] !== true ) {
			return new WP_REST_Response( 'The provided data are invalid.', '400' );
		}

		// Insert into the database.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_market_value_transition';
		$safe_sql   = $wpdb->prepare(
			"INSERT INTO $table_name SET 
                    date = %s,
                    value = %s,
                    player_id = %d
                    ",
			$data['date'],
			$data['value'],
			$data['player_id']
		);

		$query_result = $wpdb->query( $safe_sql );

		if ( $query_result !== false ) {
			$response = new WP_REST_Response( 'Data successfully added.', '200' );
		} else {
			$response = new WP_REST_Response( 'Query failed.', '500' );
		}

		return $response;
	}

	// Validations ------------------------------------------------------------------------------------------------------

	/**
	 * Utility method used to generate the part of the query used to list only the items added with the "include" and
	 * "exclude" URL parameters.
	 *
	 * @param $id_s
	 * @param $primary_key
	 * @param bool        $not
	 *
	 * @return string
	 */
	private function generate_where_include_exclude( $id_s, $primary_key, $not = false ) {

		global $wpdb;
		$where_string = '';
		$not          = $not ? ' NOT' : '';

		if ( $id_s !== null ) {
			$id_a = explode( ',', $id_s );
			if ( count( $id_a ) > 0 ) {
				$where_string .= $this->shared->add_query_part( $where_string ) . $primary_key . $not . ' IN (';
				foreach ( $id_a as $key => $id ) {
					$where_string .= $wpdb->prepare( '%d', $id );
					if ( $key + 1 < count( $id_a ) ) {
						$where_string .= ',';
					}
				}
				$where_string .= ')';
			}
		}

		return $where_string;
	}

	/**
	 * Authenticates the request based on the type of request and on the authentication options defined in the plugin
	 * options.
	 *
	 * Two discretional category of requests have been created. The "read" category used to read the plugin data, and
	 * the "create" category used to create new items in the plugin data.
	 *
	 * @param $request
	 * @param string  $type
	 *
	 * @return bool
	 */
	private function authenticate_rest_request( $request, $type = 'read' ) {

		switch ( $type ) {

			case 'read':
				$authentication = intval( get_option( $this->shared->get( 'slug' ) . '_rest_api_authentication_read' ), 10 );
				break;

			case 'create':
				$authentication = intval( get_option( $this->shared->get( 'slug' ) . '_rest_api_authentication_create' ), 10 );
				break;

		}

		$response = false;
		switch ( $authentication ) {

			// Cookies.
			case 0:
				if ( current_user_can( get_option( $this->shared->get( 'slug' ) . '_capability_rest_api' ) ) ) {
					$response = true;
				}
				break;

			// REST API Key.
			case 1:
				$rest_api_key = $request->get_param( 'rest_api_key' );
				if ( isset( $rest_api_key ) and
					$rest_api_key === get_option( $this->shared->get( 'slug' ) . '_rest_api_key' ) ) {
					$response = true;
				}
				break;

			// None.
			case 2:
				$response = true;
				break;

		}

		return $response;
	}
}
