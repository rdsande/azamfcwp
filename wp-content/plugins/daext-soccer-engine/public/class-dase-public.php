<?php
/**
 * This class should be used to work with the public side of WordPress.
 *
 * @package daext-soccer-engine
 */

/**
 * This class should be used to work with the public side of WordPress.
 */
class Dase_Public {

	// General class properties.
	protected static $instance = null;
	private $shared            = null;
	private $charts            = array();

	private function __construct() {

		// Assign an instance of the plugin info.
		$this->shared = Dase_Shared::get_instance();

		// Load public css.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

		// Load public js.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Write in front-end head.
		add_action( 'wp_head', array( $this, 'wr_public_head' ) );

		// shortcodes.
		add_shortcode( 'se-transfers', array( $this, 'transfers' ) );
		add_shortcode( 'se-team-contracts', array( $this, 'team_contracts' ) );
		add_shortcode( 'se-agency-contracts', array( $this, 'agency_contracts' ) );
		add_shortcode( 'se-players', array( $this, 'players' ) );
		add_shortcode( 'se-player-awards', array( $this, 'player_awards' ) );
		add_shortcode( 'se-unavailable-players', array( $this, 'unavailable_players' ) );
		add_shortcode( 'se-injuries', array( $this, 'injuries' ) );
		add_shortcode( 'se-staff', array( $this, 'staff' ) );
		add_shortcode( 'se-staff-awards', array( $this, 'staff_awards' ) );
		add_shortcode( 'se-trophies', array( $this, 'trophies' ) );
		add_shortcode( 'se-matches', array( $this, 'matches' ) );
		add_shortcode( 'se-ranking-transitions', array( $this, 'ranking_transitions' ) );
		add_shortcode( 'se-ranking-transitions-chart', array( $this, 'ranking_transitions_chart' ) );
		add_shortcode( 'se-market-value-transitions', array( $this, 'market_value_transitions' ) );
		add_shortcode( 'se-market-value-transitions-chart', array( $this, 'market_value_transitions_chart' ) );
		add_shortcode( 'se-match-timeline', array( $this, 'match_timeline' ) );
		add_shortcode( 'se-match-commentary', array( $this, 'match_commentary' ) );
		add_shortcode( 'se-match-lineup', array( $this, 'match_lineup' ) );
		add_shortcode( 'se-match-visual-lineup', array( $this, 'match_visual_lineup' ) );
		add_shortcode( 'se-match-substitutions', array( $this, 'match_substitutions' ) );
		add_shortcode( 'se-match-staff', array( $this, 'match_staff' ) );
		add_shortcode( 'se-squad-lineup', array( $this, 'squad_lineup' ) );
		add_shortcode( 'se-squad-substitutions', array( $this, 'squad_substitutions' ) );
		add_shortcode( 'se-squad-staff', array( $this, 'squad_staff' ) );
		add_shortcode( 'se-competition-standings-table', array( $this, 'competition_standings_table' ) );
		add_shortcode( 'se-competition-round', array( $this, 'competition_round' ) );
		add_shortcode( 'se-match-score', array( $this, 'match_score' ) );
		add_shortcode( 'se-player-summary', array( $this, 'player_summary' ) );
		add_shortcode( 'se-staff-summary', array( $this, 'staff_summary' ) );
		add_shortcode( 'se-referee-summary', array( $this, 'referee_summary' ) );
		add_shortcode( 'se-referee-statistics-by-competition', array( $this, 'referee_statistics_by_competition' ) );
		add_shortcode( 'se-referee-statistics-by-team', array( $this, 'referee_statistics_by_team' ) );

		// Actions used to instantiate the line charts generated with Chart.js.
		add_action( 'get_footer', array( $this, 'ranking_transitions_instantiate_charts' ) );
		add_action( 'get_footer', array( $this, 'market_value_transitions_instantiate_charts' ) );
	}

	/**
	 * Creates an instance of this class.
	 */
	public static function get_instance() {

		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	// Load public css.
	public function enqueue_styles() {

		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-general',
			$this->shared->get( 'url' ) . 'public/assets/css/general.css',
			array(),
			$this->shared->get( 'ver' )
		);

		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-paginated-table',
			$this->shared->get( 'url' ) . 'public/assets/css/paginated-table.css',
			array(),
			$this->shared->get( 'ver' )
		);

		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-match-commentary',
			$this->shared->get( 'url' ) . 'public/assets/css/match-commentary.css',
			array(),
			$this->shared->get( 'ver' )
		);

		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-match-score',
			$this->shared->get( 'url' ) . 'public/assets/css/match-score.css',
			array(),
			$this->shared->get( 'ver' )
		);

		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-match-timeline',
			$this->shared->get( 'url' ) . 'public/assets/css/match-timeline.css',
			array(),
			$this->shared->get( 'ver' )
		);

		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-match-visual-lineup',
			$this->shared->get( 'url' ) . 'public/assets/css/match-visual-lineup.css',
			array(),
			$this->shared->get( 'ver' )
		);

		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-person-summary',
			$this->shared->get( 'url' ) . 'public/assets/css/person-summary.css',
			array(),
			$this->shared->get( 'ver' )
		);

		$upload_dir_data = wp_upload_dir();
		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-custom',
			$upload_dir_data['baseurl'] . '/dase_uploads/custom-' . get_current_blog_id() . '.css',
			array(),
			$this->shared->get( 'ver' )
		);
	}

	// Load public js.
	public function enqueue_scripts() {

		// Generate the array that will be passed to wp_localize_script().
		$php_data = array(
			'nonce'   => wp_create_nonce( 'dase' ),
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		);

		// Paginated Table Utility.
		wp_enqueue_script(
			$this->shared->get( 'slug' ) . '-paginated-table',
			$this->shared->get( 'url' ) . 'public/assets/js/paginated-table-class.js',
			array(),
			$this->shared->get( 'ver' ),
			true
		);

		// Event Tooltip Handler.
		wp_enqueue_script(
			$this->shared->get( 'slug' ) . '-event-tooltip-handler',
			$this->shared->get( 'url' ) . 'public/assets/js/event-tooltip-handler.js',
			array(),
			$this->shared->get( 'ver' ),
			true
		);

		// Match Visual Lineup.
		wp_enqueue_script(
			$this->shared->get( 'slug' ) . '-match-visual-lineup',
			$this->shared->get( 'url' ) . 'public/assets/js/match-visual-lineup.js',
			array(),
			$this->shared->get( 'ver' ),
			true
		);

		// MomentJs.
		wp_enqueue_script(
			$this->shared->get( 'slug' ) . '-moment-js',
			$this->shared->get( 'url' ) . 'public/inc/moment-js/moment.js',
			array( 'jquery' ),
			$this->shared->get( 'ver' ),
			false
		);

		// ChartJs.
		wp_enqueue_script(
			$this->shared->get( 'slug' ) . '-chart-js',
			$this->shared->get( 'url' ) . 'public/inc/chart-js/Chart.min.js',
			array( 'dase-moment-js' ),
			$this->shared->get( 'ver' ),
			false
		);

		// Make a series of useful PHP data available to the JavaScript part in the DASE_PHPDATA object.
		wp_localize_script( $this->shared->get( 'slug' ) . '-paginated-table', 'DASE_PHPDATA', $php_data );
	}

	/**
	 * Write in front-end head.
	 *
	 * @return void
	 */
	public function wr_public_head() {

		if ( strlen( trim( get_option( $this->shared->get( 'slug' ) . '_google_font_url' ) ) ) > 0 ) {
			echo '<link href="' . esc_url( get_option( $this->shared->get( 'slug' ) . '_google_font_url' ) ) . '" rel="stylesheet">';
		}

		?>

		<script>

			/**
			* This function is the JavaScript version of https://www.php.net/manual/en/function.number-format.php
			*
			* Reference: https://stackoverflow.com/questions/12820312/equivalent-to-php-function-number-format-in-jquery-javascript
			*
			*/
			window.dase_number_format = function(number, decimals, dec_point, thousands_sep) {
			// Strip all characters but numerical ones.
			number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
			var n = !isFinite(+number) ? 0 : +number,
				prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
				sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
				dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
				s = '',
				toFixedFix = function(n, prec) {
					var k = Math.pow(10, prec);
					return '' + Math.round(n * k) / k;
				};
			// Fix for IE parseFloat(0.55).toFixed(0) = 0;
			s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
			if (s[0].length > 3) {
				s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
			}
			if ((s[1] || '').length < prec) {
				s[1] = s[1] || '';
				s[1] += new Array(prec - s[1].length + 1).join('0');
			}
			return s.join(dec);
			};

			/**
			* This function is the JavaScript version of \Dase_Shared::money_format.
			* @param num
			* @returns {string|*}
			*/
			window.dase_money_format = function(num) {

			//init
			let round_symbol = '';

			//get from the plugin options
			let decimal_separator = '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_money_format_decimal_separator' ) ); ?>';
			let thousands_separator = '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_money_format_thousands_separator' ) ); ?>';
			let decimals = 
			<?php
			echo intval(
				get_option( $this->shared->get( 'slug' ) . '_money_format_decimals' ),
				10
			);
			?>
							;
			let simplify_million = 
			<?php
			echo intval(
				get_option( $this->shared->get( 'slug' ) . '_money_format_simplify_million' ),
				10
			) ? 'true' : 'false'
			?>
									;
			let simplify_million_decimals = 
			<?php
			echo intval(
				get_option( $this->shared->get( 'slug' ) . '_money_format_simplify_million_decimals' ),
				10
			);
			?>
											;
			let million_symbol = '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_money_format_million_symbol' ) ); ?>';
			let simplify_thousands = 
			<?php
			echo intval(
				get_option( $this->shared->get( 'slug' ) . '_money_format_simplify_thousands' ),
				10
			) ? 'true' : 'false'
			?>
										;
			let simplify_thousands_decimals = 
			<?php
			echo intval(
				get_option( $this->shared->get( 'slug' ) . '_money_format_simplify_thousands_decimals' ),
				10
			);
			?>
												;
			let thousands_symbol = '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_money_format_thousands_symbol' ) ); ?>';
			let currency = '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_money_format_currency' ) ); ?>';
			let currency_position = 
			<?php
			echo intval(
				get_option( $this->shared->get( 'slug' ) . '_money_format_currency_position' ),
				10
			);
			?>
									;

			if (num > 1000000 && simplify_million === true) {

				//Simplify Million
				num = num / 1000000;
				round_symbol = million_symbol;
				num = window.dase_number_format(num, simplify_million_decimals, decimal_separator, thousands_separator);

			} else if (num > 1000 && simplify_thousands === true) {

				//Simplify Thousands
				num = num / 1000;
				round_symbol = thousands_symbol;
				num = window.dase_number_format(num, simplify_thousands_decimals, decimal_separator, thousands_separator);

			}else{

				//Not Simplified
				num = window.dase_number_format(num, decimals, decimal_separator, thousands_separator);

			}

			//add the round symbol
			num = num + round_symbol;

			//add currency -------------------------------------------------------------------------------------------------
			if (currency_position === 0) {
				return currency + num;
			} else {
				return num + currency;
			}

			return num;

			};

		</script>

		<?php
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Transfers" blocks and is also the
	 * callback of the [transfers] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function transfers( $atts ) {

		// Set the default values if needed.
		$atts = shortcode_atts(
			array(
				'player-id'                   => 0,
				'transfer-type-id'            => 0,
				'team-id-left'                => 0,
				'team-id-joined'              => 0,
				'start-date'                  => '',
				'end-date'                    => '',
				'fee-lower-limit'             => 0,
				'fee-higher-limit'            => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Sanitize data.
		$player_id                   = intval( $atts['player-id'], 10 );
		$transfer_type_id            = intval( $atts['transfer-type-id'], 10 );
		$team_id_left                = intval( $atts['team-id-left'], 10 );
		$team_id_joined              = intval( $atts['team-id-joined'], 10 );
		$start_date                  = $atts['start-date'];
		$end_date                    = $atts['end-date'];
		$fee_lower_limit             = intval( $atts['fee-lower-limit'], 10 );
		$fee_higher_limit            = intval( $atts['fee-higher-limit'], 10 );
		$columns                     = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$hidden_columns_breakpoint_1 = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$hidden_columns_breakpoint_2 = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$pagination                  = intval( $atts['pagination'] );

		// Init data.
		$table_data               = array();
		$table_data['table_name'] = 'transfers';

		// Filters.
		$table_data['filter']                     = array();
		$table_data['filter']['player_id']        = $player_id;
		$table_data['filter']['transfer_type_id'] = $transfer_type_id;
		$table_data['filter']['team_id_left']     = $team_id_left;
		$table_data['filter']['team_id_joined']   = $team_id_joined;
		$table_data['filter']['start_date']       = $start_date;
		$table_data['filter']['end_date']         = $end_date;
		$table_data['filter']['fee_lower_limit']  = $fee_lower_limit;
		$table_data['filter']['fee_higher_limit'] = $fee_higher_limit;

		// Columns.
		if ( count( $columns ) > 0 ) {
			$table_data['columns'] = $columns;
		}

		if ( count( $hidden_columns_breakpoint_1 ) > 0 ) {
			$table_data['hidden_columns_breakpoint_1'] = $hidden_columns_breakpoint_1;
		}

		if ( count( $hidden_columns_breakpoint_2 ) > 0 ) {
			$table_data['hidden_columns_breakpoint_2'] = $hidden_columns_breakpoint_2;
		}

		if ( $pagination > 0 ) {
			$table_data['pagination'] = $pagination;
		}

		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Players" blocks and is also the
	 * callback of the [players] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function players( $atts ) {

		// Set the default values if needed.
		$atts = shortcode_atts(
			array(
				'start-date-of-birth'         => '',
				'end-date-of-birth'           => '',
				'citizenship'                 => '',
				'foot'                        => '',
				'player-position-id'          => '',
				'squad-id'                    => '',
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                  = array();
		$table_data['table_name']                    = 'players';
		$table_data['filter']                        = array();
		$table_data['filter']['start_date_of_birth'] = $atts['start-date-of-birth'];
		$table_data['filter']['end_date_of_birth']   = $atts['end-date-of-birth'];
		$table_data['filter']['citizenship']         = $atts['citizenship'];
		$table_data['filter']['foot']                = $atts['foot'];
		$table_data['filter']['player_position_id']  = intval( $atts['player-position-id'], 10 );
		$table_data['filter']['squad_id']            = intval( $atts['squad-id'], 10 );
		$table_data['columns']                       = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1']   = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2']   = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                    = intval( $atts['pagination'] );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Player Awards" blocks and is also the
	 * callback of the [player-awards] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function player_awards( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'player-award-type-id'        => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                   = array();
		$table_data['table_name']                     = 'player_awards';
		$table_data['filter']                         = array();
		$table_data['filter']['player_award_type_id'] = intval( $atts['player-award-type-id'], 10 );
		$table_data['columns']                        = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1']    = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2']    = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                     = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Unavailable Players" blocks and is
	 * also the callback of the [unavailable-players] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function unavailable_players( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'player-id'                   => 0,
				'unavailable-player-type-id'  => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                        = array();
		$table_data['table_name']          = 'unavailable_player';
		$table_data['filter']              = array();
		$table_data['filter']['player_id'] = intval( $atts['player-id'], 10 );
		$table_data['filter']['unavailable_player_type_id'] = intval( $atts['unavailable-player-type-id'], 10 );
		$table_data['columns']                              = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1']          = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2']          = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                           = intval( $atts['pagination'] );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Injuries" blocks and is also the
	 * callback of the [injuries] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function injuries( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'player-id'                   => 0,
				'injury-type-id'              => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'injuries';
		$table_data['filter']                      = array();
		$table_data['filter']['player_id']         = intval( $atts['player-id'], 10 );
		$table_data['filter']['injury_type_id']    = intval( $atts['injury-type-id'], 10 );
		$table_data['columns']                     = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'] );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Staff" blocks and is also the
	 * callback of the [staff] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function staff( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'staff-type-id'               => 0,
				'retired'                     => 0,
				'gender'                      => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'staff';
		$table_data['filter']                      = array();
		$table_data['filter']['staff_type_id']     = intval( $atts['staff-type-id'], 10 );
		$table_data['filter']['retired']           = intval( $atts['retired'], 10 );
		$table_data['filter']['gender']            = intval( $atts['gender'], 10 );
		$table_data['columns']                     = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'] );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Staff Awards" blocks and is also the
	 * callback of the [staff-awards] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function staff_awards( $atts ) {

		// Set the default values if needed.
		$atts = shortcode_atts(
			array(
				'staff-award-type-id'         => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                  = array();
		$table_data['table_name']                    = 'staff_award';
		$table_data['filter']                        = array();
		$table_data['filter']['staff_award_type_id'] = intval( $atts['staff-award-type-id'], 10 );
		$table_data['columns']                       = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1']   = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2']   = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                    = intval( $atts['pagination'] );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Trophies" blocks and is also the
	 * callback of the [trophies] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function trophies( $atts ) {

		// Set the default values if needed.
		$atts = shortcode_atts(
			array(
				'trophy-type-id'              => 0,
				'team-id'                     => 0,
				'start-assignment-date'       => '',
				'end-assignment-date'         => '',
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                    = array();
		$table_data['table_name']                      = 'trophy';
		$table_data['filter']                          = array();
		$table_data['filter']['trophy_type_id']        = intval( $atts['trophy-type-id'], 10 );
		$table_data['filter']['team_id']               = intval( $atts['team-id'], 10 );
		$table_data['filter']['start_assignment_date'] = $atts['start-assignment-date'];
		$table_data['filter']['end_assignment_date']   = $atts['end-assignment-date'];
		$table_data['columns']                         = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1']     = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2']     = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                      = intval( $atts['pagination'] );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This method is at the same time used to generate the dynamic output of the "Ranking Transitions Chart" blocks and
	 * is also the callback of the [ranking-transitions-chart] shortcode.
	 *
	 * This method does what follows:
	 *
	 * - Returns the canvas container used to plot the Chart.js chart of this "Ranking Transitions Chart".
	 * - Adds to the $chart class property the data of the chart. These data will be used later by
	 * \Dase_Public::ranking_transitions_instantiate_charts (which runs with the "get_footer" hook) to instatiante the
	 * chart.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	function ranking_transitions_chart( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'team-id-1'       => 0,
				'team-id-2'       => 0,
				'team-id-3'       => 0,
				'team-id-4'       => 0,
				'ranking-type-id' => 0,
				'start-date'      => '',
				'end-date'        => '',
			),
			$atts
		);

		// Assign and sanitize data.
		$team_id_1                = intval( $atts['team-id-1'], 10 );
		$team_id_2                = intval( $atts['team-id-2'], 10 );
		$team_id_3                = intval( $atts['team-id-3'], 10 );
		$team_id_4                = intval( $atts['team-id-4'], 10 );
		$chart['ranking_type_id'] = intval( $atts['ranking-type-id'], 10 );
		$chart['start_date']      = $atts['start-date'];
		$chart['end_date']        = $atts['end-date'];
		$chart['id']              = 'dase-chart-' . ( intval( count( $this->charts ), 10 ) + 1 );

		for ( $i = 1;$i <= 4;$i++ ) {

			if ( ${'team_id_' . $i} > 0 ) {

				global $wpdb;
				$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team';
				$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE team_id = %d", ${'team_id_' . $i} );
				$team_obj   = $wpdb->get_row( $safe_sql );
				if ( $team_obj === null ) {
					continue;}

				$chart['teams'][] = array(
					'name' => $team_obj->name,
				);

				global $wpdb;
				$table_name           = $wpdb->prefix . $this->shared->get( 'slug' ) . '_ranking_transition';
				$safe_sql             = $wpdb->prepare( "SELECT * FROM $table_name WHERE team_id = %d AND ranking_type_id = %d ORDER BY date ASC", ${'team_id_' . $i}, $chart['ranking_type_id'] );
				$ranking_transition_a = $wpdb->get_results( $safe_sql, ARRAY_A );

				foreach ( $ranking_transition_a as $key => $ranking_transition ) {

					$chart['teams'][ count( $chart['teams'] ) - 1 ]['data'][] =
						array(
							'date'  => date( 'Ymd', strtotime( $ranking_transition['date'] ) ),
							'value' => intval( $ranking_transition['value'], 10 ),
						);

				}
			}
		}

		if ( isset( $chart['teams'][0]['data'] ) or
			isset( $chart['teams'][1]['data'] ) or
			isset( $chart['teams'][2]['data'] ) or
			isset( $chart['teams'][3]['data'] ) ) {

			$this->charts[] = $chart;
			return '<canvas id="' . $chart['id'] . '" class="dase-line-chart"></canvas>';

		} else {

			return '<p class="dase-no-data-paragraph">' . __( 'There are no data associated with your selection.', 'dase' ) . '</p>';

		}
	}

	/**
	 * This method, which runs with the "get_footer" hook, instantiates all the Chart.js charts of the
	 * "Ranking Transitions Chart" based on the data available in the $chart class property.
	 */
	function ranking_transitions_instantiate_charts() {

		// If there are no charts in this post return.
		if ( is_null( $this->charts ) ) {
			return;
		}

		// Turn on output buffer.
		ob_start();

		foreach ( $this->charts as $key0 => $chart ) {

			if ( ! array_key_exists( 'teams', $chart ) ) {
				continue;
			}

			?>

			<script>

				<?php

				$datasets = '';

				$datasets .= 'datasets: [';

				$line_color_a       = $this->shared->get_array_of_colors( get_option( $this->shared->get( 'slug' ) . '_line_chart_dataset_line_color' ) );
				$background_color_a = $this->shared->get_array_of_colors( get_option( $this->shared->get( 'slug' ) . '_line_chart_dataset_background_color' ) );

				foreach ( $chart['teams'] as $key1 => $team ) {

					if ( ! isset( $team['data'] ) ) {
						continue;}

						$datasets .= '{';
						$datasets .= "label: '" . $this->shared->prepare_javascript_string( stripslashes( $team['name'] ) ) . "',";
						$datasets .= 'borderColor: "' . $this->shared->prepare_javascript_string( stripslashes( $line_color_a[ $key1 ] ) ) . '",';
						$datasets .= 'backgroundColor: "' . $this->shared->prepare_javascript_string( stripslashes( $background_color_a[ $key1 ] ) ) . '",';
						$datasets .= 'pointBackgroundColor: "' . $this->shared->prepare_javascript_string( stripslashes( $background_color_a[ $key1 ] ) ) . '",';
						$datasets .= 'pointHoverBackgroundColor: "' . $this->shared->prepare_javascript_string( stripslashes( $background_color_a[ $key1 ] ) ) . '",';
						$datasets .= 'borderWidth: "' . '1' . '",';
						$datasets .= 'pointStyle: "' . 'circle' . '",';
						// $datasets .= 'pointRadius: "' . '3' . '",';
						$datasets .= 'pointHitRadius: "' . '1' . '",';
						$datasets .= 'pointHoverRadius: "' . '3' . '",';
						$datasets .= 'pointBorderWidth: "' . '1' . '",';
					if ( intval( get_option( $this->shared->get( 'slug' ) . '_line_chart_fill' ), 10 ) === 1 ) {
						$fill = 'true';
					} else {
						$fill = 'false';
					}
						$datasets .= 'fill: ' . $fill . ',';
						$datasets .= 'data:[';

					foreach ( $team['data'] as $key3 => $data ) {

						$datasets .= "{x: new moment('" . $data['date'] . "'),";
						$datasets .= 'y: ' . $data['value'] . ',},';

					}

						$datasets .= ']},';

				}

				$datasets .= '],';

				// Generate title text.
				$start_date   = $chart['start_date'];
				$end_date     = $chart['end_date'];
				$ranking_type = $this->shared->get_ranking_type_name( $chart['ranking_type_id'] );
				$title        = 'Ranking transitions for the ' . $ranking_type . ' in the period between ' . $start_date . ' and ' . $end_date . '.';

				// Generate data for JavaScript.
				$font_family = get_option( $this->shared->get( 'slug' ) . '_font_family' );

				?>

				// General Settings.
				Chart.defaults.global.responsive = true;
				Chart.defaults.global.maintainAspectRatio = true;
				Chart.defaults.global.responsiveAnimationDuration = 0;
				Chart.defaults.global.title.display = false;
				Chart.defaults.global.title.position = 'top';
				Chart.defaults.global.title.fullWidth = true;
				Chart.defaults.global.title.fontSize = 11;
				Chart.defaults.global.title.fontFamily = '<?php echo esc_js( $font_family ); ?>';
				Chart.defaults.global.title.fontColor = '#666';
				Chart.defaults.global.title.fontStyle = 'bold';
				Chart.defaults.global.title.padding = 11;
				Chart.defaults.global.title.text = '<?php echo $title; ?>';
				Chart.defaults.global.legend.display = <?php echo intval( get_option( $this->shared->get( 'slug' ) . '_line_chart_show_legend' ) ) ? 'true' : 'false'; ?>;
				Chart.defaults.global.legend.position = '<?php echo $this->shared->get_legend_position_for_chartjs( get_option( $this->shared->get( 'slug' ) . '_line_chart_legend_position' ) ); ?>'
				Chart.defaults.global.legend.fullWidth = true;
				Chart.defaults.global.legend.labels.boxWidth = 40;
				Chart.defaults.global.legend.labels.fontSize = 11;
				Chart.defaults.global.legend.labels.fontStyle = 'normal';
				Chart.defaults.global.legend.labels.fontColor = '<?php echo $this->shared->prepare_javascript_string( ( get_option( $this->shared->get( 'slug' ) . '_line_chart_font_color' ) ) ); ?>';
				Chart.defaults.global.legend.labels.fontFamily = '<?php echo $this->shared->prepare_javascript_string( $font_family ); ?>';
				Chart.defaults.global.legend.labels.padding = 11;
				Chart.defaults.global.tooltips.enabled = <?php echo intval( get_option( $this->shared->get( 'slug' ) . '_line_chart_show_tooltips' ) ) ? 'true' : 'false'; ?>;;
				Chart.defaults.global.tooltips.mode = 'single';
				Chart.defaults.global.tooltips.backgroundColor = '<?php echo $this->shared->prepare_javascript_string( ( get_option( $this->shared->get( 'slug' ) . '_line_chart_tooltips_background_color' ) ) ); ?>';
				Chart.defaults.global.tooltips.titleFontFamily = '<?php echo esc_js( $font_family ); ?>';
				Chart.defaults.global.tooltips.titleFontSize = 11;
				Chart.defaults.global.tooltips.titleFontStyle = 'normal';
				Chart.defaults.global.tooltips.titleFontColor = '<?php echo $this->shared->prepare_javascript_string( ( get_option( $this->shared->get( 'slug' ) . '_line_chart_tooltips_font_color' ) ) ); ?>';
				Chart.defaults.global.tooltips.titleMarginBottom = 6;
				Chart.defaults.global.tooltips.bodyFontFamily = '<?php echo esc_js( $font_family ); ?>';
				Chart.defaults.global.tooltips.bodyFontSize = 11;
				Chart.defaults.global.tooltips.bodyFontStyle = 'normal';
				Chart.defaults.global.tooltips.bodyFontColor = '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_line_chart_tooltips_font_color' ) ); ?>';
				Chart.defaults.global.tooltips.footerFontFamily = '<?php echo $this->shared->prepare_javascript_string( $font_family ); ?>';
				Chart.defaults.global.tooltips.footerFontSize = 11;
				Chart.defaults.global.tooltips.footerFontStyle = 'bold';
				Chart.defaults.global.tooltips.footerFontColor = '#fff';
				Chart.defaults.global.tooltips.footerMarginTop = 6;
				Chart.defaults.global.tooltips.xPadding = 6;
				Chart.defaults.global.tooltips.yPadding = 6;
				Chart.defaults.global.tooltips.caretSize = 5;
				Chart.defaults.global.tooltips.cornerRadius = 6;
				Chart.defaults.global.tooltips.multiKeyBackground = '#fff';
				Chart.defaults.global.hover.animationDuration = 400;
				Chart.defaults.global.animation.duration = 1000;
				Chart.defaults.global.animation.easing = 'easeOutQuart';
				Chart.defaults.scale.gridLines.display = <?php echo intval( get_option( $this->shared->get( 'slug' ) . '_line_chart_show_gridlines' ) ) ? 'true' : 'false'; ?>;;

				// Instantiation.
				var ctx = document.getElementById('<?php echo $chart['id']; ?>').getContext('2d');

				new Chart(ctx, {
				type: 'line',
				data: {
					<?php echo $datasets; ?>
				},
				options: {
					legend: {
					onClick: null
					},
					elements: {
					line: {
						tension: 0
					}
					},
					scales: {
					xAxes: [{
						type: 'time',
						ticks: {
						fontFamily: '<?php echo $this->shared->prepare_javascript_string( $font_family ); ?>',
						fontSize: 11,
						fontColor: '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_line_chart_font_color' ) ); ?>',
						},
						gridLines: {
						color: '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_line_chart_gridlines_color' ) ); ?>',
						},
					}],
					yAxes: [{
						ticks: {
						fontFamily: '<?php echo $this->shared->prepare_javascript_string( $font_family ); ?>',
						fontSize: 11,
						fontColor: '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_line_chart_font_color' ) ); ?>',
						userCallback: function (tick) {
							var tick_output = tick.toString();
							return tick_output;
						},
						},
						gridLines: {
						color: '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_line_chart_gridlines_color' ) ); ?>',
						},
					}]
					},
					tooltips: {
					callbacks: {
						title: function(tooltip) {
						let date = tooltip[0].xLabel.substr(0, 12);
						if(date.substr(11, 12) === ','){
							date = date.substr(0, 11);
						}
						return date;
						},
						label: function(tooltipItem, data) {
						return data.datasets[tooltipItem.datasetIndex].label + ': ' + tooltipItem.value + '';
						}
					}
					}
				}
				});

			</script>

			<?php

		}

		$out = ob_get_clean();
		echo( $out );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Team Contracts" blocks and is also
	 * the callback of the [team-contracts] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function team_contracts( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'team-id'                     => 0,
				'team-contract-type-id'       => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                    = array();
		$table_data['table_name']                      = 'team_contract';
		$table_data['filter']                          = array();
		$table_data['filter']['team_id']               = intval( $atts['team-id'], 10 );
		$table_data['filter']['team_contract_type_id'] = intval( $atts['team-contract-type-id'], 10 );
		$table_data['columns']                         = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1']     = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2']     = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                      = intval( $atts['pagination'] );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Agency Contracts" blocks and is
	 * also the callback of the [agency-contracts] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function agency_contracts( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'agency-id'                   => 0,
				'agency-contract-type-id'     => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                      = array();
		$table_data['table_name']                        = 'agency_contract';
		$table_data['filter']                            = array();
		$table_data['filter']['agency_id']               = intval( $atts['agency-id'], 10 );
		$table_data['filter']['agency_contract_type_id'] = intval( $atts['agency-contract-type-id'], 10 );
		$table_data['columns']                           = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1']       = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2']       = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                        = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This method is at the same time used to generate the dynamic output of the "Market Value Transitions Chart" blocks
	 * and is also the callback of the [market-value-transitions-chart] shortcode.
	 *
	 * This method does what follows:
	 *
	 * - Returns the canvas container used to plot the Chart.js chart of this "Market Value Transition Chart".
	 * - Adds to the $chart class property the data of the chart. These data will be used later by
	 * \Dase_Public::market_value_transitions_instantiate_charts (which runs with the "get_footer" hook) to instantiate
	 * the
	 * chart.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	function market_value_transitions_chart( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'player-id-1' => 0,
				'player-id-2' => 0,
				'player-id-3' => 0,
				'player-id-4' => 0,
				'start-date'  => '',
				'end-date'    => '',
			),
			$atts
		);

		// Assign and sanitize data.
		$player_id_1         = intval( $atts['player-id-1'], 10 );
		$player_id_2         = intval( $atts['player-id-2'], 10 );
		$player_id_3         = intval( $atts['player-id-3'], 10 );
		$player_id_4         = intval( $atts['player-id-4'], 10 );
		$chart['start_date'] = $atts['start-date'];
		$chart['end_date']   = $atts['end-date'];
		$chart['id']         = 'dase-chart-' . ( intval( count( $this->charts ), 10 ) + 1 );

		for ( $i = 1;$i <= 4;$i++ ) {

			if ( ${'player_id_' . $i} > 0 ) {

				global $wpdb;
				$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player';
				$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d", ${'player_id_' . $i} );
				$player_obj = $wpdb->get_row( $safe_sql );
				if ( $player_obj === null ) {
					continue;}

				$chart['players'][] = array(
					'name' => $this->shared->get_player_name( $player_obj->player_id ),
				);

				global $wpdb;
				$table_name                = $wpdb->prefix . $this->shared->get( 'slug' ) . '_market_value_transition';
				$safe_sql                  = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d ORDER BY date ASC", ${'player_id_' . $i} );
				$market_value_transition_a = $wpdb->get_results( $safe_sql, ARRAY_A );

				foreach ( $market_value_transition_a as $key => $market_value_transition ) {

					$chart['players'][ count( $chart['players'] ) - 1 ]['data'][] =
						array(
							'date'  => date( 'Ymd', strtotime( $market_value_transition['date'] ) ),
							'value' => $market_value_transition['value'],
						);

				}
			}
		}

		if ( isset( $chart['players'][0]['data'] ) or
			isset( $chart['players'][1]['data'] ) or
			isset( $chart['players'][2]['data'] ) or
			isset( $chart['players'][3]['data'] ) ) {

			$this->charts[] = $chart;
			return '<canvas id="' . $chart['id'] . '" class="dase-line-chart"></canvas>';

		} else {

			return '<p class="dase-no-data-paragraph">' . __( 'There are no data associated with your selection.', 'dase' ) . '</p>';

		}
	}

	/**
	 * This method, which runs with the "get_footer"_ hook, instantiates all the Chart.js charts of the
	 * "Market Value Transition Chart" based on the data available in the $chart class property.
	 */
	function market_value_transitions_instantiate_charts() {

		// If there are no charts in this post return.
		if ( is_null( $this->charts ) ) {
			return;
		}

		// Turn on output buffer.
		ob_start();

		foreach ( $this->charts as $key0 => $chart ) {

			if ( ! array_key_exists( 'players', $chart ) ) {
				continue;
			}

			$money_format_currency = get_option( $this->shared->get( 'slug' ) . '_money_format_currency' );
			$money_format_position = get_option( $this->shared->get( 'slug' ) . '_money_format_currency_position' );

			if ( intval( $money_format_position, 10 ) === 0 ) {
				$currency_before = $money_format_currency;
				$currency_after  = '';
			} else {
				$currency_before = '';
				$currency_after  = $money_format_currency;
			}

			?>

			<script>

				<?php

				$datasets = '';

				$datasets .= 'datasets: [';

				$line_color_a       = $this->shared->get_array_of_colors( get_option( $this->shared->get( 'slug' ) . '_line_chart_dataset_line_color' ) );
				$background_color_a = $this->shared->get_array_of_colors( get_option( $this->shared->get( 'slug' ) . '_line_chart_dataset_background_color' ) );

				foreach ( $chart['players'] as $key1 => $team ) {

					if ( ! isset( $team['data'] ) ) {
						continue;}

					$datasets .= '{';
					$datasets .= "label: '" . $this->shared->prepare_javascript_string( stripslashes( $team['name'] ) ) . "',";
					$datasets .= 'borderColor: "' . $this->shared->prepare_javascript_string( stripslashes( $line_color_a[ $key1 ] ) ) . '",';
					$datasets .= 'backgroundColor: "' . $this->shared->prepare_javascript_string( stripslashes( $background_color_a[ $key1 ] ) ) . '",';
					$datasets .= 'pointBackgroundColor: "' . $this->shared->prepare_javascript_string( stripslashes( $background_color_a[ $key1 ] ) ) . '",';
					$datasets .= 'pointHoverBackgroundColor: "' . $this->shared->prepare_javascript_string( stripslashes( $background_color_a[ $key1 ] ) ) . '",';
					$datasets .= 'borderWidth: "' . '1' . '",';
					$datasets .= 'pointStyle: "' . 'circle' . '",';
					// $datasets .= 'pointRadius: "' . '3' . '",';
					$datasets .= 'pointHitRadius: "' . '1' . '",';
					$datasets .= 'pointHoverRadius: "' . '3' . '",';
					$datasets .= 'pointBorderWidth: "' . '1' . '",';
					if ( intval( get_option( $this->shared->get( 'slug' ) . '_line_chart_fill' ), 10 ) === 1 ) {
						$fill = 'true';
					} else {
						$fill = 'false';
					}
					$datasets .= 'fill: ' . $fill . ',';
					$datasets .= 'data:[';

					foreach ( $team['data'] as $key3 => $data ) {

						$datasets .= "{x: new moment('" . $data['date'] . "'),";
						$datasets .= 'y: ' . $data['value'] . ',},';

					}

					$datasets .= ']},';

				}

				$datasets .= '],';

				// Generate title text.
				$start_date = $chart['start_date'];
				$end_date   = $chart['end_date'];
				$title      = 'Transfer market transitions in the period between ' . $start_date . ' and ' . $end_date . '.';

				// Generate data for JavaScript.
				$font_family = get_option( $this->shared->get( 'slug' ) . '_font_family' );

				?>

				// General Settings.
				Chart.defaults.global.responsive = true;
				Chart.defaults.global.maintainAspectRatio = true;
				Chart.defaults.global.responsiveAnimationDuration = 0;
				Chart.defaults.global.title.display = false;
				Chart.defaults.global.title.position = 'top';
				Chart.defaults.global.title.fullWidth = true;
				Chart.defaults.global.title.fontSize = 11;
				Chart.defaults.global.title.fontFamily = '<?php echo $this->shared->prepare_javascript_string( ( $font_family ) ); ?>';
				Chart.defaults.global.title.fontColor = '#666';
				Chart.defaults.global.title.fontStyle = 'bold';
				Chart.defaults.global.title.padding = 11;
				Chart.defaults.global.title.text = '<?php echo $title; ?>';
				Chart.defaults.global.legend.display = <?php echo intval( get_option( $this->shared->get( 'slug' ) . '_line_chart_show_legend' ) ) ? 'true' : 'false'; ?>;
				Chart.defaults.global.legend.position = '<?php echo $this->shared->get_legend_position_for_chartjs( get_option( $this->shared->get( 'slug' ) . '_line_chart_legend_position' ) ); ?>'
				Chart.defaults.global.legend.fullWidth = true;
				Chart.defaults.global.legend.labels.boxWidth = 40;
				Chart.defaults.global.legend.labels.fontSize = 11;
				Chart.defaults.global.legend.labels.fontStyle = 'normal';
				Chart.defaults.global.legend.labels.fontColor = '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_line_chart_font_color' ) ); ?>';
				Chart.defaults.global.legend.labels.fontFamily = '<?php echo esc_js( $font_family ); ?>';
				Chart.defaults.global.legend.labels.padding = 11;
				Chart.defaults.global.tooltips.enabled = <?php echo intval( get_option( $this->shared->get( 'slug' ) . '_line_chart_show_tooltips' ) ) ? 'true' : 'false'; ?>;;
				Chart.defaults.global.tooltips.mode = 'single';
				Chart.defaults.global.tooltips.backgroundColor = '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_line_chart_tooltips_background_color' ) ); ?>';
				Chart.defaults.global.tooltips.titleFontFamily = '<?php echo $this->shared->prepare_javascript_string( stripslashes( $font_family ) ); ?>';
				Chart.defaults.global.tooltips.titleFontSize = 11;
				Chart.defaults.global.tooltips.titleFontStyle = 'normal';
				Chart.defaults.global.tooltips.titleFontColor = '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_line_chart_tooltips_font_color' ) ); ?>';
				Chart.defaults.global.tooltips.titleMarginBottom = 6;
				Chart.defaults.global.tooltips.bodyFontFamily = '<?php echo $this->shared->prepare_javascript_string( $font_family ); ?>';
				Chart.defaults.global.tooltips.bodyFontSize = 11;
				Chart.defaults.global.tooltips.bodyFontStyle = 'normal';
				Chart.defaults.global.tooltips.bodyFontColor = '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_line_chart_tooltips_font_color' ) ); ?>';
				Chart.defaults.global.tooltips.footerFontFamily = '<?php echo $this->shared->prepare_javascript_string( $font_family ); ?>';
				Chart.defaults.global.tooltips.footerFontSize = 11;
				Chart.defaults.global.tooltips.footerFontStyle = 'bold';
				Chart.defaults.global.tooltips.footerFontColor = '#fff';
				Chart.defaults.global.tooltips.footerMarginTop = 6;
				Chart.defaults.global.tooltips.xPadding = 6;
				Chart.defaults.global.tooltips.yPadding = 6;
				Chart.defaults.global.tooltips.caretSize = 5;
				Chart.defaults.global.tooltips.cornerRadius = 6;
				Chart.defaults.global.tooltips.multiKeyBackground = '#fff';
				Chart.defaults.global.hover.animationDuration = 400;
				Chart.defaults.global.animation.duration = 1000;
				Chart.defaults.global.animation.easing = 'easeOutQuart';
				Chart.defaults.scale.gridLines.display = <?php echo intval( get_option( $this->shared->get( 'slug' ) . '_line_chart_show_gridlines' ) ) ? 'true' : 'false'; ?>;;

				// Instantiation
				var ctx = document.getElementById('<?php echo $chart['id']; ?>').getContext('2d');

				new Chart(ctx, {
					type: 'line',
					data: {
						<?php echo $datasets; ?>
					},
					options: {
					legend: {
						onClick: null
					},
					elements: {
						line: {
						tension: 0
						}
					},
					scales: {
						xAxes: [{
						type: 'time',
						ticks: {
							fontFamily: '<?php echo $this->shared->prepare_javascript_string( $font_family ); ?>',
							fontSize: 11,
							fontColor: '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_line_chart_font_color' ) ); ?>',
						},
						gridLines: {
							color: '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_line_chart_gridlines_color' ) ); ?>',
						},
						}],
						yAxes: [{
						ticks: {
							fontFamily: '<?php echo $this->shared->prepare_javascript_string( $font_family ); ?>',
							fontSize: 11,
							fontColor: '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_line_chart_font_color' ) ); ?>',
							userCallback: function (tick) {
								var tick_output = tick.toString();
								return window.dase_money_format(tick_output);
							},
						},
						gridLines: {
							color: '<?php echo $this->shared->prepare_javascript_string( get_option( $this->shared->get( 'slug' ) . '_line_chart_gridlines_color' ) ); ?>',
						},
						}]
					},
					tooltips: {
						callbacks: {
						title: function(tooltip) {
							let date = tooltip[0].xLabel.substr(0, 12);
							if(date.substr(11, 12) === ','){
							date = date.substr(0, 11);
							}
							return date;
						},
						label: function(tooltipItem, data) {
							return data.datasets[tooltipItem.datasetIndex].label + ': ' + window.dase_money_format(tooltipItem.value);
						}
						}
					}
					}
				});

			</script>

			<?php

		}

		$out = ob_get_clean();
		echo( $out );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Market Value Transitions" blocks and
	 * is also the callback of the [market-value-transitions] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function market_value_transitions( $atts ) {

		// Set the default values if needed.
		$atts = shortcode_atts(
			array(
				'player-id'                   => 0,
				'start-date'                  => '',
				'end-date'                    => '',
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'market_value_transition';
		$table_data['filter']['player_id']         = intval( $atts['player-id'], 10 );
		$table_data['filter']['start_date']        = $atts['start-date'];
		$table_data['filter']['end_date']          = $atts['end-date'];
		$table_data['columns']                     = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'] );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Ranking Transitions" blocks and is
	 * also the callback of the [ranking-transitions] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function ranking_transitions( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'team-id'                     => 0,
				'ranking-type-id'             => 0,
				'start-date'                  => '',
				'end-date'                    => '',
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'ranking_transition';
		$table_data['filter']                      = array();
		$table_data['filter']['team_id']           = intval( $atts['team-id'], 10 );
		$table_data['filter']['ranking_type_id']   = $atts['ranking-type-id'];
		$table_data['filter']['start_date']        = $atts['start-date'];
		$table_data['filter']['end_date']          = $atts['end-date'];
		$table_data['columns']                     = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'] );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Matches" blocks and is also the
	 * callback of the [matches] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function matches( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'team-id-1'                   => 0,
				'team-id-2'                   => 0,
				'start-date'                  => '',
				'end-date'                    => '',
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'match';
		$table_data['filter']                      = array();
		$table_data['filter']['team_id_1']         = intval( $atts['team-id-1'], 10 );
		$table_data['filter']['team_id_2']         = intval( $atts['team-id-2'], 10 );
		$table_data['filter']['start_date']        = $atts['start-date'];
		$table_data['filter']['end_date']          = $atts['end-date'];
		$table_data['columns']                     = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'] );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Match Lineup" blocks and is also the
	 * callback of the [match-lineup] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function match_lineup( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'match-id'                    => 0,
				'team-slot'                   => 1,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'match_lineup';
		$table_data['filter']                      = array();
		$table_data['filter']['match_id']          = intval( $atts['match-id'], 10 );
		$table_data['filter']['team_slot']         = intval( $atts['team-slot'], 10 );
		$table_data['columns']                     = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'] );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Match Substitutions" blocks and is
	 * also the callback of the [match-substitutions] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function match_substitutions( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'match-id'                    => 0,
				'team-slot'                   => 1,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'match_substitutions';
		$table_data['filter']                      = array();
		$table_data['filter']['match_id']          = intval( $atts['match-id'], 10 );
		$table_data['filter']['team_slot']         = intval( $atts['team-slot'], 10 );
		$table_data['columns']                     = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'] );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Match Staff" blocks and is also the
	 * callback of the [match-staff] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function match_staff( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'match-id'                    => 0,
				'team-slot'                   => 1,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'match_staff';
		$table_data['filter']                      = array();
		$table_data['filter']['match_id']          = intval( $atts['match-id'], 10 );
		$table_data['filter']['team_slot']         = intval( $atts['team-slot'], 10 );
		$table_data['columns']                     = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'] );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Competition Standings Table" blocks
	 * and is also the callback of the [competition-standings-table] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function competition_standings_table( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'competition-id'              => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'competition_standings_table';
		$table_data['filter']                      = array();
		$table_data['filter']['competition_id']    = intval( $atts['competition-id'], 10 );
		$table_data['columns']                     = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Competition Round" blocks and is
	 * also the callback of the [competition-round] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function competition_round( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'competition-id'              => 0,
				'round'                       => 0,
				'type'                        => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'competition_round';
		$table_data['filter']                      = array();
		$table_data['filter']['competition_id']    = intval( $atts['competition-id'], 10 );
		$table_data['filter']['round']             = intval( $atts['round'], 10 );
		$table_data['filter']['type']              = intval( $atts['type'], 10 );
		$table_data['columns']                     = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Match Timeline" blocks and is also
	 * the callback of the [match-timeline] shortcode.
	 *
	 * Returns the HTML of the match timeline.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function match_timeline( $atts ) {

		// If a transient is available return the transient.
		$transient_name = 'dase_' . hash( 'sha512', json_encode( __FUNCTION__ . json_encode( $atts ) ) );
		$data           = get_transient( $transient_name );
		if ( $data !== false ) {
			return $data; }

		// Get the data.
		$atts         = shortcode_atts(
			array(
				'match-id'     => 0,
				'match-effect' => 0,
			),
			$atts
		);
		$match_id     = intval( $atts['match-id'], 10 );
		$match_effect = intval( $atts['match-effect'], 10 );

		// Get match.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d", $match_id );
		$match_obj  = $wpdb->get_row( $safe_sql );

		if ( null === $match_obj ) {
			return '<p class="dase-no-data-paragraph">' . __( 'There are no data associated with your selection.', 'dase' ) . '</p>';
		}

		// Get the events
		if ( 0 === $match_effect ) {
			$query_part = 'match_effect != 0';
		} else {
			$query_part = 'match_effect = ' . $match_effect;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_event';
		$safe_sql   = $wpdb->prepare(
			"SELECT * FROM $table_name WHERE match_id = %d AND data = 1 AND " . $query_part . ' ORDER BY part DESC, time DESC, additional_time DESC, event_id DESC',
			$match_id
		);
		$event_a    = $wpdb->get_results( $safe_sql, ARRAY_A );

		if ( 0 === count( $event_a ) ) {
			return '<p class="dase-no-data-paragraph">' . __( 'There are no data associated with your selection.', 'dase' ) . '</p>';
		}

		// turn on output buffer.
		ob_start();

		?>

		<div class="dase-match-timeline">

		<div class="dase-match-timeline-title"><?php esc_attr_e( 'Match Timeline', 'dase' ); ?></div>
		<div class="dase-match-timeline-content">

		<?php

		foreach ( $event_a as $key => $event ) {

			switch ( $event['match_effect'] ) {

				case 1:
					$person_name  = $this->shared->get_player_name( $event['player_id'] );
					$person_image = $this->shared->get_player_image( $event['player_id'] );

					/**
					 * Is "Own Goal" if:
					 *
					 * - The event is associated with team 1 and the player is of team 2 or
					 * or
					 * - The event is associated with team 2 and the player is of team
					 *
					 * Otherwise is "Goal".
					 */

					if (
							( 0 === intval( $event['team_slot'], 10 ) &&
							$this->shared->get_team_of_player_in_match( $event['match_id'], $event['player_id'] ) === 2 ) ||
							( 1 === intval( $event['team_slot'], 10 ) &&
							$this->shared->get_team_of_player_in_match( $event['match_id'], $event['player_id'] ) === 1 )
							) {
						$match_effect = __( 'Own Goal', 'dase' );
					} else {
						$match_effect = __( 'Goal', 'dase' );
					}

					break;

				case 2:
					if ( intval( $event['player_id'], 10 ) !== 0 ) {
						$person_name  = $this->shared->get_player_name( $event['player_id'] );
						$person_image = $this->shared->get_player_image( $event['player_id'] );
					} else {
						$person_name  = $this->shared->get_staff_name( $event['staff_id'] );
						$person_image = $this->shared->get_staff_image( $event['staff_id'] );
					}
					$match_effect = __( 'Yellow Card', 'dase' );
					break;

				case 3:
					if ( intval( $event['player_id'], 10 ) !== 0 ) {
						$person_name  = $this->shared->get_player_name( $event['player_id'] );
						$person_image = $this->shared->get_player_image( $event['player_id'] );
					} else {
						$person_name  = $this->shared->get_staff_name( $event['staff_id'] );
						$person_image = $this->shared->get_staff_image( $event['staff_id'] );
					}
					$match_effect = __( 'Red Card', 'dase' );
					break;

				case 4:
					$person_name  = $this->shared->get_player_name( $event['player_id_substitution_in'] ) .
									' (' . $this->shared->get_player_name( $event['player_id_substitution_out'] ) . ')';
					$person_image = $this->shared->get_player_image( $event['player_id_substitution_in'] );
					$match_effect = __( 'Substitution', 'dase' );
					break;

			}

			if ( intval( $event['team_slot'], 10 ) === 0 ) {
				$logo_url = $this->shared->get_team_logo_url( $match_obj->team_id_1 );
			} else {
				$logo_url = $this->shared->get_team_logo_url( $match_obj->team_id_2 );
			}

			?>


						<div class="dase-match-timeline-content-row">

							<?php if ( intval( $event['team_slot'], 10 ) === 0 ) : ?>

								<div class="dase-match-timeline-content-row-cell dase-match-timeline-content-team-1-logo">
									<?php if ( strlen( $logo_url ) > 0 ) : ?>
										<?php echo '<img src="' . esc_url( $logo_url ) . '">'; ?>
									<?php else : ?>
										<?php echo $this->shared->get_default_team_logo_svg(); ?>
									<?php endif; ?>
								</div>

								<div class="dase-match-timeline-content-row-cell dase-match-timeline-content-team-1-player">
									<div class="dase-match-timeline-player-container-team-1">
										<div class="dase-match-timeline-player-container-team-1-image">
											<?php echo $person_image; ?>
										</div>
										<div class="dase-match-timeline-player-container-team-1-content">
											<?php
											echo '<div class="dase-match-timeline-player-name">' . esc_attr( $person_name ) . '</div>';
											echo '<div class="dase-match-timeline-description">' . esc_attr( $match_effect ) . '</div>';
											?>
										</div>
									</div>
								</div>

								<div class="dase-match-timeline-content-row-cell dase-match-timeline-content-clock">
									<?php echo $this->shared->generate_clock( intval( $event['time'], 10 ), intval( $event['additional_time'], 10 ), intval( $event['part'], 10 ) ); ?>
								</div>

								<!-- Team 2 Logo -->
								<div class="dase-match-timeline-content-row-cell dase-match-timeline-content-team-2-player dase-match-timeline-content-team-2-player-empty">
									<div class="dase-match-timeline-player-container-team-2">
										<div class="dase-match-timeline-player-container-team-2-image">
										</div>
										<div class="dase-match-timeline-player-container-team-2-content">
											<div class="dase-match-timeline-player-name"></div><div class="dase-match-timeline-description"></div>                                </div>
									</div>
								</div>
								<!-- Team 2 Logo -->
								<div class="dase-match-timeline-content-row-cell dase-match-timeline-content-team-2-logo dase-match-timeline-content-team-2-logo-empty">
								</div>

							<?php else : ?>

								<!-- Team 1 Logo -->
								<div class="dase-match-timeline-content-row-cell dase-match-timeline-content-team-1-logo dase-match-timeline-content-team-1-logo-empty">
								</div>
								<!-- Team 1 Player -->
								<div class="dase-match-timeline-content-row-cell dase-match-timeline-content-team-1-player dase-match-timeline-content-team-1-player-empty">
									<div class="dase-match-timeline-player-container-team-1">
										<div class="dase-match-timeline-player-container-team-1-image">
										</div>
										<div class="dase-match-timeline-player-container-team-1-content">
											<div class="dase-match-timeline-player-name"></div><div class="dase-match-timeline-description"></div>                                </div>
									</div>
								</div>

								<div class="dase-match-timeline-content-row-cell dase-match-timeline-content-clock">
									<?php echo $this->shared->generate_clock( intval( $event['time'], 10 ), intval( $event['additional_time'], 10 ), intval( $event['part'], 10 ) ); ?>
								</div>

								<div class="dase-match-timeline-content-row-cell dase-match-timeline-content-team-2-player">
									<div class="dase-match-timeline-player-container-team-2">
										<div class="dase-match-timeline-player-container-team-2-image">
											<?php echo $person_image; ?>
										</div>
										<div class="dase-match-timeline-player-container-team-2-content">
											<?php
											echo '<div class="dase-match-timeline-player-name">' . esc_attr( $person_name ) . '</div>';
											echo '<div class="dase-match-timeline-description">' . esc_attr( $match_effect ) . '</div>';
											?>
										</div>
									</div>
								</div>

								<!-- >Team 2 Logo -->
								<div class="dase-match-timeline-content-row-cell dase-match-timeline-content-team-2-logo">
									<?php if ( strlen( $logo_url ) > 0 ) : ?>
										<?php echo '<img src="' . esc_url( $logo_url ) . '">'; ?>
									<?php else : ?>
										<?php echo $this->shared->get_default_team_logo_svg(); ?>
									<?php endif; ?>
								</div>

							<?php endif; ?>

						</div>


			<?php

		}

		?>

		</div>

		</div>

		<?php

		$data = ob_get_clean();
		$this->shared->set_transient_based_on_settings( $transient_name, $data );
		return $data;
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Match Score" blocks and is also the
	 * callback of the [match-score] shortcode.
	 *
	 * Returns the HTML of match score.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function match_score( $atts ) {

		// If a transient is available return the transient.
		$transient_name = 'dase_' . hash( 'sha512', json_encode( __FUNCTION__ . json_encode( $atts ) ) );
		$data           = get_transient( $transient_name );
		if ( $data !== false ) {
			return $data; }

		// get the data.
		$atts     = shortcode_atts(
			array(
				'match-id' => 0,
			),
			$atts
		);
		$match_id = intval( $atts['match-id'], 10 );

		// Get match.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d", $match_id );
		$match_obj  = $wpdb->get_row( $safe_sql );

		if ( null === $match_obj ) {
			return '<p class="dase-no-data-paragraph">' . __( 'There are no data associated with your selection.', 'dase' ) . '</p>';
		}

		// Competition image and name.
		if ( $match_obj->competition_id > 0 ) {
			$competition_turn_name = $this->shared->get_competition_turn( $match_obj->match_id );
			$competition_turn_type = $this->shared->get_competition_turn_type( $match_obj->match_id );
		} else {
			$competition_turn_name = '';
			$competition_turn_type = '';
		}

		// team 1 logo.
		$team_1_logo_url = $this->shared->get_team_logo_url( $match_obj->team_id_1 );

		// team 1 name.
		$team_1_name = $this->shared->get_team_name( $match_obj->team_id_1 );

		// team 1 position (only if it's the match of round robin competition).
		$team_1_position = $this->shared->get_team_position_in_competition( $match_obj->team_id_1, $match_obj->competition_id );

		// team 2 logo.
		$team_2_logo_url = $this->shared->get_team_logo_url( $match_obj->team_id_2 );

		// team 2 name.
		$team_2_name = $this->shared->get_team_name( $match_obj->team_id_2 );

		// team 2 position (only if it's the match of round-robin competition).
		$team_2_position = $this->shared->get_team_position_in_competition( $match_obj->team_id_2, $match_obj->competition_id );

		// round of the competition.
		$competition_round = $match_obj->round;

		// date of the match.
		$match_date = date( 'D, M j, Y', strtotime( $match_obj->date ) );

		// time of the match.
		$match_time = date( 'g:i A', strtotime( $match_obj->time ) );

		// match result.
		$match_result = $this->shared->get_match_result( $match_obj->match_id );

		// name of the stadium.
		$stadium_name = $this->shared->get_stadium_name( $match_obj->stadium_id );

		// number of attendance.
		$match_attendance = number_format( $match_obj->attendance, 0, ',', '.' );

		// name of the referee.
		$match_referee = $this->shared->get_referee_name( $match_obj->referee_id );

		// Additional info 1.
		$additional_info_1 = '';
		if ( strlen( $competition_turn_name ) > 0 and strlen( $competition_round ) > 0 ) {
			$additional_info_1 = esc_attr( $competition_turn_name ) . ' ' . intval( $competition_round, 10 ) . ' ';
			if ( $competition_turn_type !== false ) {
				$additional_info_1 .= '(' . esc_attr( $competition_turn_type ) . ') |';
			}
		}
		$additional_info_1 .= esc_attr( $match_date ) . ' | ' . esc_attr( $match_time );

		ob_start();

		?>

		<div class="dase-match-score">

			<div class="dase-match-score-header"><?php esc_attr_e( 'Match Score', 'dase' ); ?></div>
			<div class="dase-match-score-body">
				<div class="dase-match-score-body-team-1">
					<div class="dase-match-score-body-team-1-logo">
						<?php if ( strlen( $team_1_logo_url ) > 0 ) : ?>
							<?php echo '<img src="' . esc_url( stripslashes( $team_1_logo_url ) ) . '">'; ?>
						<?php else : ?>
							<?php echo $this->shared->get_default_team_logo_svg(); ?>
						<?php endif; ?>
					</div>
					<div class="dase-match-score-body-team-1-details">
						<div class="dase-match-score-body-team-1-name">
							<?php esc_attr_e( stripslashes( $team_1_name ) ); ?>
						</div>
						<?php if ( $team_1_position !== false ) : ?>
							<div class="dase-match-score-body-team-1-position">
								<?php echo esc_attr__( 'Position:', 'dase' ) . ' ' . intval( $team_1_position, 10 ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="dase-match-score-body-center">
					<div class="dase-match-score-body-info"><?php echo $additional_info_1; ?></div>
					<div class="dase-match-score-body-result">
						<div class="dase-match-score-body-match-result"><?php echo esc_attr( $match_result ); ?></div>
					</div>
					<div class="dase-match-score-body-additional-info">
						<?php

						if ( $stadium_name !== false and $match_attendance !== 0 ) {
							$separator = '| ';
						} else {
							$separator = '';
						}

						?>
						<div class="dase-match-score-body-additional-info-stadium-attendance"><?php echo $stadium_name !== false ? esc_attr( $stadium_name ) : ''; ?> <?php echo intval( $match_attendance, 10 ) !== 0 ? $separator . __( 'Attendance', 'dase' ) . ': ' . $match_attendance : ''; ?></div>
						<div class="dase-match-score-body-additional-info-referee"><?php echo $match_referee !== false ? esc_attr__( 'Referee', 'dase' ) . ': ' . esc_attr( $match_referee ) : ''; ?></div>
					</div>
				</div>
				<div class="dase-match-score-body-team-2">
					<div class="dase-match-score-body-team-2-logo">
						<div class="dase-match-score-body-team-2-logo">
							<?php if ( strlen( $team_2_logo_url ) > 0 ) : ?>
								<?php echo '<img src="' . esc_url( stripslashes( $team_2_logo_url ) ) . '">'; ?>
							<?php else : ?>
								<?php echo $this->shared->get_default_team_logo_svg(); ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="dase-match-score-body-team-2-details">
						<div class="dase-match-score-body-team-2-name">
							<?php esc_attr_e( stripslashes( $team_2_name ) ); ?>
						</div>
						<?php if ( $team_2_position !== false ) : ?>
							<div class="dase-match-score-body-team-2-position">
								<?php echo esc_attr__( 'Position', 'dase' ) . ': ' . intval( $team_2_position, 10 ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

		</div>

		<?php

		$data = ob_get_clean();
		$this->shared->set_transient_based_on_settings( $transient_name, $data );
		return $data;
	}

	/**
	 * Returns the HTML of the visual lineup of a team with the related substitutes.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function match_visual_lineup( $atts ) {

		// If a transient is available return the transient
		$transient_name = 'dase_' . hash( 'sha512', json_encode( __FUNCTION__ . json_encode( $atts ) ) );
		$data           = get_transient( $transient_name );
		if ( $data !== false ) {
			return $data; }

		// get the data
		$atts      = shortcode_atts(
			array(
				'match-id'  => 0,
				'team-slot' => 1,
			),
			$atts
		);
		$match_id  = intval( $atts['match-id'], 10 );
		$team_slot = intval( $atts['team-slot'], 10 );

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d", $match_id );
		$match_obj  = $wpdb->get_row( $safe_sql );

		if ( $match_obj === null ) {
			return '<p class="dase-no-data-paragraph">' . __( 'There are no data associated with your selection.', 'dase' ) . '</p>';
		}

		ob_start();

		$team_obj = $this->shared->get_team_obj( $match_obj->{'team_id_' . $team_slot} );

		?>

		<div class="dase-match-visual-lineup">

			<div class="dase-match-visual-lineup-left">

				<div class="dase-match-visual-lineup-left-header">

					<?php

					$string_part = '';
					if ( intval( $match_obj->{'team_' . $team_slot . '_formation_id'}, 10 ) > 0 ) {
						$string_part = ': ' . esc_attr( $this->shared->get_formation_name( $match_obj->{'team_' . $team_slot . '_formation_id'} ) );
					}
					echo esc_attr__( 'Starting Lineup', 'dase' ) . $string_part;

					?>

				</div>

				<div class="dase-match-visual-lineup-left-formation">

					<?php

					$image_field_url = add_query_arg(
						array(
							'formation_field_background_color' => urlencode( get_option( $this->shared->get( 'slug' ) . '_formation_field_background_color' ) ),
							'formation_field_line_color' => urlencode( get_option( $this->shared->get( 'slug' ) . '_formation_field_line_color' ) ),
							'formation_field_line_stroke_width' => urlencode( get_option( $this->shared->get( 'slug' ) . '_formation_field_line_stroke_width' ) ),
						),
						$this->shared->get( 'url' ) . 'public/assets/img/formation/field.php'
					);

					?>
					<img class="dase-match-visual-lineup-left-formation-image" src="<?php echo esc_url( $image_field_url ); ?>">

					<?php

					for ( $i = 1;$i <= 11;$i++ ) {

						$player_id  = $match_obj->{'team_' . $team_slot . '_lineup_player_id_' . $i};
						$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player';
						$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d", $player_id );
						$player_obj = $wpdb->get_row( $safe_sql );

						?>

						<div class="dase-match-visual-lineup-left-formation-player-container" <?php echo $this->shared->set_player_position( $i, $match_obj->{'team_' . $team_slot . '_formation_id'} ); ?> <?php echo $this->shared->set_field_position_data( $i, $match_obj->{'team_' . $team_slot . '_formation_id'} ); ?>>

							<div class="dase-match-visual-lineup-left-formation-player-jersey-number">

								<?php echo $this->shared->get_player_jersey_number_in_match( $player_obj->player_id, $match_id, $team_slot ); ?>

							</div>

							<div class="dase-match-visual-lineup-left-formation-player-name">

								<?php echo esc_attr( stripslashes( $player_obj->last_name ) ); ?>

							</div>

						</div>

						<?php echo $this->shared->get_player_events_icons( $player_obj->player_id, $match_id ); ?>

						<?php

					}

					?>

				</div>

			</div>

			<div class="dase-match-visual-lineup-right">

				<div class="dase-match-visual-lineup-right-header">

					<?php esc_attr_e( 'Substitutes', 'dase' ); ?>

				</div>

				<table class="dase-match-visual-lineup-right-table">

					<tbody>
					<?php

					// Substitutes ------------------------------------------------------------------------------------.
					for ( $i = 1;$i <= 20;$i++ ) {

						$player_id  = $match_obj->{'team_' . $team_slot . '_substitute_player_id_' . $i};
						$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player';
						$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d", $player_id );
						$player_obj = $wpdb->get_row( $safe_sql );

						if ( null !== $player_obj ) {
							?>

							<tr>
								<td><?php echo esc_attr( $this->shared->get_player_jersey_number_in_match( $player_obj->player_id, $match_id, $team_slot ) ); ?></td>
								<td>
									<div class="dase-match-visual-lineup-right-table-player">
										<div class="dase-match-visual-lineup-right-table-player-name"><?php echo esc_attr( $this->shared->get_player_name( $player_obj->player_id ) ); ?></div>
										<div class="dase-match-visual-lineup-right-table-events-container">
											<?php echo $this->shared->get_player_events_icons( $player_obj->player_id, $match_id ); ?>
										</div>
									</div>
								</td>
								<td><?php echo $this->shared->get_player_position_abbreviation( $this->shared->get_player_position_id( $player_obj->player_id ) ); ?></td>
							</tr>

							<?php
						}
					}

					// Staff --------------------------------------------------------------------------------------------
					for ( $i = 1;$i <= 20;$i++ ) {

						$staff_id   = $match_obj->{'team_' . $team_slot . '_staff_id_' . $i};
						$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff';
						$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE staff_id = %d", $staff_id );
						$staff_obj  = $wpdb->get_row( $safe_sql );

						if ( null !== $staff_obj ) {
							?>

							<tr>
								<td colspan="3">
									<div class="dase-match-visual-lineup-right-table-staff">
										<div class="dase-match-visual-lineup-right-table-staff-type"><?php echo esc_attr( $this->shared->get_staff_type_name( $staff_obj->staff_type_id ) ); ?>:&nbsp;</div>
										<div class="dase-match-visual-lineup-right-table-staff-name"><?php echo esc_attr( $this->shared->get_staff_name( $staff_obj->staff_id ) ); ?></div>
										<div class="dase-match-visual-lineup-right-table-events-container"><?php echo $this->shared->get_staff_events_icons( $staff_obj->staff_id, $match_id ); ?></div>
									</div>
								</td>


								</div>
							</tr>

							<?php
						}
					}

					?>



					</tbody>

				</table>

			</div>

		</div>

		<?php

		$data = ob_get_clean();
		$this->shared->set_transient_based_on_settings( $transient_name, $data );
		return $data;
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Match Commentary" blocks and is also the
	 * callback of the [match-commentary] shortcode.
	 *
	 * Returns the HTML of the match commentary.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function match_commentary( $atts ) {

		// If a transient is available return the transient
		$transient_name = 'dase_' . hash( 'sha512', json_encode( __FUNCTION__ . json_encode( $atts ) ) );
		$data           = get_transient( $transient_name );
		if ( $data !== false ) {
			return $data; }

		// get the data
		$atts     = shortcode_atts(
			array(
				'match-id' => 0,
			),
			$atts
		);
		$match_id = intval( $atts['match-id'], 10 );

		// Get event
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_event';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d AND data = 1 ORDER BY part DESC, time DESC, additional_time DESC, event_id DESC", $match_id );
		$event_a    = $wpdb->get_results( $safe_sql, ARRAY_A );

		if ( count( $event_a ) === 0 ) {
			return '<p class="dase-no-data-paragraph">' . __( 'There are no data associated with your selection.', 'dase' ) . '</p>';
		}

		ob_start();

		?>

		<div class="dase-match-commentary">

			<div class="dase-match-commentary-title"><?php esc_attr_e( 'Match Commentary', 'dase' ); ?></div>

			<div class="dase-match-commentary-content">

			<?php

			foreach ( $event_a as $key => $event ) {

				// init vars.
				$image  = null;
				$row_1  = null;
				$row_2  = null;
				$row_3  = null;
				$minute = $this->shared->get_time_format_120( $event['time'], $event['part'] );

				?>

				<div class="dase-match-commentary-row">

					<div class="dase-match-commentary-event-time">
						<div class="dase-match-commentary-event-time-container">
							<div class="dase-match-commentary-event-time-top">
								<?php echo intval( $minute, 10 ) . '′'; ?>
								<?php if ( intval( $event['additional_time'], 10 ) > 0 ) : ?>
									<?php echo '+&nbsp;' . intval( $event['additional_time'], 10 ) . '′'; ?>
								<?php endif; ?>
							</div>
							<div class="dase-match-commentary-event-time-bottom">
								<?php

								if ( $event['match_effect'] > 0 ) {
									echo $this->shared->get_event_icon_html( $event['match_effect'] );
									// echo '<img class="dase-match-commentary-event-image" src="' . $this->shared->get_event_type_icon_url($event['match_effect']) . '">';
								}

								?>
							</div>
						</div>
					</div>

					<div class="dase-match-commentary-event-data">

						<?php if ( intval( $event['match_effect'], 10 ) !== 0 ) : ?>

							<div class="dase-match-commentary-event-details dase-clearfix">

								<?php

								switch ( $event['match_effect'] ) {

									// Goal.
									case 1:
										$image = $this->shared->get_player_image( $event['player_id'] );
										$row_1 = $this->shared->get_match_result( $match_id, 'text', $event['time'] );
										$row_2 = __( 'Goal for', 'dase' ) . ' ' . $this->shared->get_team_name( $this->shared->get_team_of_event( $event['event_id'] ) );
										$row_3 = $this->shared->get_player_name( $event['player_id'] );
										break;

									// Yellow Card.
									case 2:
										if ( intval( $event['player_id'], 10 ) !== 0 ) {
											$image = $this->shared->get_player_image( $event['player_id'] );
										} else {
											$image = $this->shared->get_staff_image( $event['staff_id'] );
										}
										$row_1 = __( 'Yellow Card', 'dase' );
										$row_2 = __( 'Yellow Card for', 'dase' ) . ' ' . $this->shared->get_team_name( $this->shared->get_team_of_event( $event['event_id'] ) );
										if ( intval( $event['player_id'], 10 ) !== 0 ) {
											$row_3 = $this->shared->get_player_name( $event['player_id'] );
										} else {
											$row_3 = $this->shared->get_staff_name( $event['staff_id'] );
										}
										break;

									// Red Card.
									case 3:
										if ( intval( $event['player_id'], 10 ) !== 0 ) {
											$image = $this->shared->get_player_image( $event['player_id'] );
										} else {
											$image = $this->shared->get_staff_image( $event['staff_id'] );
										}
										$row_1 = __( 'Red Card', 'dase' );
										$row_2 = __( 'Red Card for', 'dase' ) . ' ' . $this->shared->get_team_name( $this->shared->get_team_of_event( $event['event_id'] ) );
										if ( intval( $event['player_id'], 10 ) !== 0 ) {
											$row_3 = $this->shared->get_player_name( $event['player_id'] );
										} else {
											$row_3 = $this->shared->get_staff_name( $event['staff_id'] );
										}
										break;

									// Substitution.
									case 4:
										$image = $this->shared->get_player_image( $event['player_id_substitution_in'] );
										$row_1 = __( 'Substitution', 'dase' );
										$row_2 = $this->shared->get_player_name( $event['player_id_substitution_in'] );
										$row_3 = __( 'For', 'dase' ) . ' ' . $this->shared->get_player_name( $event['player_id_substitution_out'] );
										break;

								}

								?>

								<?php if ( $image !== null && $row_1 !== null && $row_2 !== null && $row_3 !== null ) : ?>
									<div class="dase-match-commentary-event-details-left"><?php echo $image; ?></div>
									<div class="dase-match-commentary-event-details-right">
										<div class="dase-match-commentary-event-details-row dase-match-commentary-event-details-row-1"><?php echo esc_attr( $row_1 ); ?></div>
										<div class="dase-match-commentary-event-details-row dase-match-commentary-event-details-row-2"><?php echo esc_attr( $row_2 ); ?></div>
										<div class="dase-match-commentary-event-details-row dase-match-commentary-event-details-row-3"><?php echo esc_attr( $row_3 ); ?></div>
									</div>
								<?php endif; ?>

							</div>

						<?php endif; ?>

						<div class="dase-match-commentary-event-description"><?php echo esc_attr( stripslashes( $event['description'] ) ); ?></div>

					</div>

				</div>

				<?php

			}

			?>

			</div> <!-- .dase-match-commentary-content -->

		</div> <!-- .dase-match-commentary -->

		<?php

		$data = ob_get_clean();
		$this->shared->set_transient_based_on_settings( $transient_name, $data );
		return $data;
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Squad Lineup" blocks and is also the
	 * callback of the [squad-lineup] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function squad_lineup( $atts ) {

		// Set default values if needed
		$atts = shortcode_atts(
			array(
				'squad-id'                    => 1,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'squad_lineup';
		$table_data['filter']['squad_id']          = intval( $atts['squad-id'], 10 );
		$table_data['columns']                     = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'] );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Squad Substitutions" blocks and is also the
	 * callback of the [squad-substitutions] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function squad_substitutions( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'squad-id'                    => 1,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'squad_substitutions';
		$table_data['filter']['squad_id']          = intval( $atts['squad-id'], 10 );
		$table_data['columns']                     = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'] );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Squad Staff" blocks and is also the
	 * callback of the [squad-staff] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function squad_staff( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'squad-id'                    => 1,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'squad_staff';
		$table_data['filter']['squad_id']          = intval( $atts['squad-id'], 10 );
		$table_data['columns']                     = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'] );

		// Return the the container and the JavaScript instantiation of the paginated table
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Player Summary" blocks and is also the
	 * callback of the [player-summary] shortcode.
	 *
	 * Returns the HTML of the player summary.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 * @throws Exception
	 */
	public function player_summary( $atts ) {

		// If a transient is available return the transient.
		$transient_name = 'dase_' . hash( 'sha512', json_encode( __FUNCTION__ . json_encode( $atts ) ) );
		$data           = get_transient( $transient_name );
		if ( $data !== false ) {
			return $data; }

		// get the data.
		$atts      = shortcode_atts(
			array(
				'player-id' => 1,
			),
			$atts
		);
		$player_id = intval( $atts['player-id'], 10 );

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d", $player_id );
		$player_obj = $wpdb->get_row( $safe_sql );

		if ( null === $player_obj ) {
			return '<p class="dase-no-data-paragraph">' . __( 'There are no data associated with your selection.', 'dase' ) . '</p>';
		}

		$data = array(
			'title'         => __( 'Player Summary', 'dase' ),
			'image_html'    => $this->shared->get_player_image( $player_obj->player_id ),
			'item_1_field'  => __( 'Name', 'dase' ),
			'item_1_value'  => $this->shared->get_player_name( $player_obj->player_id ),
			'item_2_field'  => __( 'Date of Birth', 'dase' ),
			'item_2_value'  => $this->shared->format_date_timestamp( $player_obj->date_of_birth ),
			'item_3_field'  => __( 'Age', 'dase' ),
			'item_3_value'  => $this->shared->get_player_age( $player_obj->player_id ),
			'item_4_field'  => __( 'Height', 'dase' ),
			'item_4_value'  => $this->shared->format_player_height( $player_obj->height ),
			'item_5_field'  => __( 'Citizenship', 'dase' ),
			'item_5_value'  => $this->shared->get_country_name_from_alpha_2_code( $player_obj->citizenship ),
			'item_6_field'  => __( 'Position', 'dase' ),
			'item_6_value'  => $this->shared->get_player_position_name( $player_obj->player_position_id ),
			'item_7_field'  => __( 'Foot', 'dase' ),
			'item_7_value'  => $this->shared->format_foot( $player_obj->foot ),
			'item_8_field'  => __( 'Agency', 'dase' ),
			'item_8_value'  => $this->shared->get_agency_of_player( $player_obj->player_id ),
			'item_9_field'  => __( 'Ownership', 'dase' ),
			'item_9_value'  => $this->shared->get_team_name( $this->shared->get_player_owner( $player_obj->player_id ) ),
			'item_10_field' => __( 'Contract Expires', 'dase' ),
			'item_10_value' => $this->shared->format_date_timestamp( $this->shared->get_team_contract_expiration( $player_obj->player_id ) ),
			'item_11_field' => __( 'Current Club', 'dase' ),
			'item_11_value' => $this->shared->get_player_current_club( $player_obj->player_id ),
			'item_12_field' => __( 'Joined', 'dase' ),
			'item_12_value' => $this->shared->get_player_current_club_joined_date( $player_obj->player_id ),
		);

		$data = $this->shared->person_summary( $data );
		$this->shared->set_transient_based_on_settings( $transient_name, $data );
		return $data;
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Staff Summary" blocks and is also the
	 * callback of the [staff-summary] shortcode.
	 *
	 * Returns the HTML of the staff summary.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 * @throws Exception
	 */
	public function staff_summary( $atts ) {

		// If a transient is available return the transient.
		$transient_name = 'dase_' . hash( 'sha512', json_encode( __FUNCTION__ . json_encode( $atts ) ) );
		$data           = get_transient( $transient_name );
		if ( false !== $data ) {
			return $data; }

		// Get the data.
		$atts     = shortcode_atts(
			array(
				'staff-id' => 1,
			),
			$atts
		);
		$staff_id = intval( $atts['staff-id'], 10 );

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE staff_id = %d", $staff_id );
		$staff_obj  = $wpdb->get_row( $safe_sql );

		if ( null === $staff_obj ) {
			return '<p class="dase-no-data-paragraph">' . __( 'There are no data associated with your selection.', 'dase' ) . '</p>';
		}

		$data = array(
			'title'         => __( 'Staff Summary', 'dase' ),
			'image_html'    => $this->shared->get_staff_image( $staff_obj->staff_id ),
			'item_1_field'  => __( 'Name', 'dase' ),
			'item_1_value'  => $this->shared->get_staff_name( $staff_obj->staff_id ),
			'item_2_field'  => __( 'Date of Birth', 'dase' ),
			'item_2_value'  => $this->shared->format_date_timestamp( $staff_obj->date_of_birth ),
			'item_3_field'  => __( 'Age', 'dase' ),
			'item_3_value'  => $this->shared->get_staff_age( $staff_obj->staff_id ),
			'item_4_field'  => __( 'Citizenship', 'dase' ),
			'item_4_value'  => $this->shared->get_country_name_from_alpha_2_code( $staff_obj->citizenship ),
			'item_5_field'  => __( 'Staff Type', 'dase' ),
			'item_5_value'  => $this->shared->get_staff_type_name( $staff_obj->staff_type_id ),
			'item_6_field'  => __( 'Preferred Formation', 'dase' ),
			'item_6_value'  => $this->shared->get_staff_favorite_formation( $staff_obj->staff_type_id ),
			'item_7_field'  => __( 'PPM', 'dase' ),
			'item_7_value'  => $this->shared->get_staff_ppm( $staff_obj->staff_id ),
			'item_8_field'  => __( 'Goals', 'dase' ),
			'item_8_value'  => $this->shared->get_staff_average_goal( $staff_obj->staff_id, 'scored' ) . ' : ' . $this->shared->get_staff_average_goal( $staff_obj->staff_id, 'conceded' ),
			'item_9_field'  => __( 'Matches', 'dase' ),
			'item_9_value'  => $this->shared->get_staff_number_of_matches( $staff_obj->staff_id ),
			'item_10_field' => __( 'Won', 'dase' ),
			'item_10_value' => $this->shared->get_staff_number_of_matches( $staff_obj->staff_id, 'won' ),
			'item_11_field' => __( 'Drawn', 'dase' ),
			'item_11_value' => $this->shared->get_staff_number_of_matches( $staff_obj->staff_id, 'drawn' ),
			'item_12_field' => __( 'Lost', 'dase' ),
			'item_12_value' => $this->shared->get_staff_number_of_matches( $staff_obj->staff_id, 'lost' ),
		);

		$data = $this->shared->person_summary( $data );
		$this->shared->set_transient_based_on_settings( $transient_name, $data );
		return $data;
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Referee Summary" blocks and is also
	 * the callback of the [referee-summary] shortcode.
	 *
	 * Returns the HTML of the referee summary.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function referee_summary( $atts ) {

		// If a transient is available return the transient.
		$transient_name = 'dase_' . hash( 'sha512', json_encode( __FUNCTION__ . json_encode( $atts ) ) );
		$data           = get_transient( $transient_name );
		if ( $data !== false ) {
			return $data; }

		// get the data.
		$atts       = shortcode_atts(
			array(
				'referee-id' => 1,
			),
			$atts
		);
		$referee_id = intval( $atts['referee-id'], 10 );

		global $wpdb;
		$table_name  = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee';
		$safe_sql    = $wpdb->prepare( "SELECT * FROM $table_name WHERE referee_id = %d", $referee_id );
		$referee_obj = $wpdb->get_row( $safe_sql );

		if ( $referee_obj === null ) {
			return '<p class="dase-no-data-paragraph">' . __( 'There are no data associated with your selection.', 'dase' ) . '</p>';
		}

		$data = array(
			'title'         => __( 'Referee Summary', 'dase' ),
			'image_html'    => $this->shared->get_referee_image( $referee_obj->referee_id ),
			'item_1_field'  => __( 'Name', 'dase' ),
			'item_1_value'  => $this->shared->get_referee_name( $referee_obj->referee_id ),
			'item_2_field'  => __( 'Date of Birth', 'dase' ),
			'item_2_value'  => $this->shared->format_date_timestamp( $referee_obj->date_of_birth ),
			'item_3_field'  => __( 'Age', 'dase' ),
			'item_3_value'  => $this->shared->get_referee_age( $referee_obj->referee_id ),
			'item_4_field'  => __( 'Citizenship', 'dase' ),
			'item_4_value'  => $this->shared->get_country_name_from_alpha_2_code( $referee_obj->citizenship ),
			'item_5_field'  => __( 'Place of Birth', 'dase' ),
			'item_5_value'  => $referee_obj->place_of_birth,
			'item_6_field'  => __( 'Residence', 'dase' ),
			'item_6_value'  => $referee_obj->residence,
			'item_7_field'  => __( 'Job', 'dase' ),
			'item_7_value'  => $referee_obj->job,
			'item_8_field'  => __( 'Retired', 'dase' ),
			'item_8_value'  => intval( $referee_obj->retired, 10 ) === 1 ? __( 'Yes', 'dase' ) : __( 'No', 'dase' ),
			'item_9_field'  => __( 'Badges', 'dase' ),
			'item_9_value'  => $this->shared->get_referee_badges( $referee_obj->referee_id ),
			'item_10_field' => __( 'Appearances', 'dase' ),
			'item_10_value' => $this->shared->get_referee_appearances( $referee_obj->referee_id ),
			'item_11_field' => __( 'Yellow Cards', 'dase' ),
			'item_11_value' => $this->shared->get_referee_yellow_cards( $referee_obj->referee_id ),
			'item_12_field' => __( 'Red Cards', 'dase' ),
			'item_12_value' => $this->shared->get_referee_red_cards( $referee_obj->referee_id ),
		);

		$data = $this->shared->person_summary( $data );
		$this->shared->set_transient_based_on_settings( $transient_name, $data );
		return $data;
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Referee Statistics by Competition"
	 * blocks and is also the callback of the [referee-statistics-by-competition] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function referee_statistics_by_competition( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'referee-id'                  => 1,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$settings                                = array();
		$settings['table_name']                  = 'referee_statistics_by_competition';
		$settings['filter']                      = array();
		$settings['filter']['referee_id']        = intval( $atts['referee-id'], 10 );
		$settings['columns']                     = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$settings['hidden_columns_breakpoint_1'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$settings['hidden_columns_breakpoint_2'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$settings['pagination']                  = intval( $atts['pagination'] );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $settings );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Referee Statistics by Team"
	 * blocks and is also the callback of the [referee-statistics-by-team] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Dase_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DasePaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function referee_statistics_by_team( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'referee-id'                  => 1,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$settings                                = array();
		$settings['table_name']                  = 'referee_statistics_by_team';
		$settings['filter']['referee_id']        = intval( $atts['referee-id'], 10 );
		$settings['columns']                     = $this->shared->comma_separated_string_to_array( $atts['columns'] );
		$settings['hidden_columns_breakpoint_1'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-1'] );
		$settings['hidden_columns_breakpoint_2'] = $this->shared->comma_separated_string_to_array( $atts['hidden-columns-breakpoint-2'] );
		$settings['pagination']                  = intval( $atts['pagination'] );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $settings );
	}
}
