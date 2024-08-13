<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @package daext-soccer-engine
 */

/*
 * This class should be used to work with the administrative side of WordPress.
 */

class Dase_Admin {


	protected static $instance = null;
	private $shared            = null;

	private $screen_id_matches                  = null;
	private $screen_id_events                   = null;
	private $screen_id_events_wizard            = null;
	private $screen_id_competitions             = null;
	private $screen_id_transfers                = null;
	private $screen_id_transfer_types           = null;
	private $screen_id_team_contracts           = null;
	private $screen_id_team_contract_types      = null;
	private $screen_id_agency                   = null;
	private $screen_id_agency_contracts         = null;
	private $screen_id_agency_contract_types    = null;
	private $screen_id_market_value_transitions = null;
	private $screen_id_players                  = null;
	private $screen_id_player_positions         = null;
	private $screen_id_player_awards            = null;
	private $screen_id_player_award_types       = null;
	private $screen_id_unavailable_players      = null;
	private $screen_id_unavailable_player_types = null;
	private $screen_id_injuries                 = null;
	private $screen_id_injury_types             = null;
	private $screen_id_staff                    = null;
	private $screen_id_staff_types              = null;
	private $screen_id_staff_awards             = null;
	private $screen_id_staff_award_types        = null;
	private $screen_id_referees                 = null;
	private $screen_id_referee_badges           = null;
	private $screen_id_referee_badge_types      = null;
	private $screen_id_squads                   = null;
	private $screen_id_teams                    = null;
	private $screen_id_formations               = null;
	private $screen_id_jersey_sets              = null;
	private $screen_id_stadiums                 = null;
	private $screen_id_trophies                 = null;
	private $screen_id_trophy_types             = null;
	private $screen_id_ranking_transitions      = null;
	private $screen_id_ranking_types            = null;
	private $screen_id_import                   = null;
	private $screen_id_export                   = null;
	private $screen_id_maintenance              = null;
	private $screen_id_help                     = null;
	private $screen_id_options                  = null;

	private function __construct() {

		// Assign an instance of the plugin info.
		$this->shared = Dase_Shared::get_instance();

		// Load admin stylesheets and JavaScript
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Write in back end head.
		add_action( 'admin_head', array( $this, 'wr_admin_head' ) );

		// Add the admin menu.
		add_action( 'admin_menu', array( $this, 'me_add_admin_menu' ) );

		// Load the options API registrations and callbacks.
		add_action( 'admin_init', array( $this, 'op_register_options' ) );

		// This hook is triggered during the creation of a new blog.
		add_action( 'wpmu_new_blog', array( $this, 'new_blog_create_options_and_tables' ), 10, 6 );

		// This hook is triggered during the deletion of a blog.
		add_action( 'delete_blog', array( $this, 'delete_blog_delete_options_and_tables' ), 10, 1 );

		// Export XML controller.
		add_action( 'init', array( $this, 'export_xml_controller' ) );
	}

	/**
	 * Return an instance of this class.
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Write in the admin head.
	 */
	public function wr_admin_head() {

		echo '<script type="text/javascript">';
		echo 'var daseAjaxUrl = "' . admin_url( 'admin-ajax.php' ) . '";';
		echo 'var daseNonce = "' . wp_create_nonce( 'dase' ) . '";';
		echo 'var daseAdminUrl = "' . get_admin_url() . '";';
		echo 'var daseJqueryUiDatepickerLocalizationIt = {
		    monthNamesShort: [ "Gen","Feb","Mar","Apr","Mag","Giu", "Lug","Ago","Set","Ott","Nov","Dic" ],
          dayNamesMin: [ "Do","Lu","Ma","Me","Gi","Ve","Sa" ],
        };';
		echo '</script>';
	}

	/**
	 * Enqueue admin specific styles.
	 */
	public function enqueue_admin_styles() {

		$screen = get_current_screen();

		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-general',
			$this->shared->get( 'url' ) . 'admin/assets/css/general.css',
			array(),
			$this->shared->get( 'ver' )
		);

		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-fontello',
			$this->shared->get( 'url' ) . 'admin/assets/font/fontello/css/dase-fontello.css',
			array(),
			$this->shared->get( 'ver' )
		);

		// Framework Menu.
		if ( $screen->id == $this->screen_id_ranking_types or
			$screen->id == $this->screen_id_ranking_transitions or
			$screen->id == $this->screen_id_staff or
			$screen->id == $this->screen_id_staff_types or
			$screen->id == $this->screen_id_player_awards or
			$screen->id == $this->screen_id_player_award_types or
			$screen->id == $this->screen_id_staff_awards or
			$screen->id == $this->screen_id_staff_award_types or
			$screen->id == $this->screen_id_referees or
			$screen->id == $this->screen_id_referee_badges or
			$screen->id == $this->screen_id_referee_badge_types or
			$screen->id == $this->screen_id_unavailable_players or
			$screen->id == $this->screen_id_unavailable_player_types or
			$screen->id == $this->screen_id_trophies or
			$screen->id == $this->screen_id_trophy_types or
			$screen->id == $this->screen_id_team_contracts or
			$screen->id == $this->screen_id_team_contract_types or
			$screen->id == $this->screen_id_agency_contracts or
			$screen->id == $this->screen_id_agency_contract_types or
			$screen->id == $this->screen_id_injuries or
			$screen->id == $this->screen_id_injury_types or
			$screen->id == $this->screen_id_transfers or
			$screen->id == $this->screen_id_transfer_types or
			$screen->id == $this->screen_id_players or
			$screen->id == $this->screen_id_player_positions or
			$screen->id == $this->screen_id_market_value_transitions or
			$screen->id == $this->screen_id_stadiums or
			$screen->id == $this->screen_id_competitions or
			$screen->id == $this->screen_id_teams or
			$screen->id == $this->screen_id_squads or
			$screen->id == $this->screen_id_matches or
			$screen->id == $this->screen_id_events or
			$screen->id == $this->screen_id_events_wizard or
			$screen->id == $this->screen_id_formations or
			$screen->id == $this->screen_id_jersey_sets or
			$screen->id == $this->screen_id_agency or
			$screen->id == $this->screen_id_maintenance ) {

			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-framework-menu',
				$this->shared->get( 'url' ) . 'admin/assets/css/framework/menu.css',
				array(),
				$this->shared->get( 'ver' )
			);

		}

		// jQuery UI Tooltip.
		if ( $screen->id == $this->screen_id_ranking_types or
			$screen->id == $this->screen_id_ranking_transitions or
			$screen->id == $this->screen_id_staff or
			$screen->id == $this->screen_id_staff_types or
			$screen->id == $this->screen_id_player_awards or
			$screen->id == $this->screen_id_player_award_types or
			$screen->id == $this->screen_id_staff_awards or
			$screen->id == $this->screen_id_staff_award_types or
			$screen->id == $this->screen_id_referees or
			$screen->id == $this->screen_id_referee_badges or
			$screen->id == $this->screen_id_referee_badge_types or
			$screen->id == $this->screen_id_unavailable_players or
			$screen->id == $this->screen_id_unavailable_player_types or
			$screen->id == $this->screen_id_trophies or
			$screen->id == $this->screen_id_trophy_types or
			$screen->id == $this->screen_id_team_contracts or
			$screen->id == $this->screen_id_team_contract_types or
			$screen->id == $this->screen_id_agency_contracts or
			$screen->id == $this->screen_id_agency_contract_types or
			$screen->id == $this->screen_id_injuries or
			$screen->id == $this->screen_id_injury_types or
			$screen->id == $this->screen_id_transfers or
			$screen->id == $this->screen_id_transfer_types or
			$screen->id == $this->screen_id_players or
			$screen->id == $this->screen_id_player_positions or
			$screen->id == $this->screen_id_market_value_transitions or
			$screen->id == $this->screen_id_stadiums or
			$screen->id == $this->screen_id_competitions or
			$screen->id == $this->screen_id_teams or
			$screen->id == $this->screen_id_squads or
			$screen->id == $this->screen_id_matches or
			$screen->id == $this->screen_id_events or
			$screen->id == $this->screen_id_events_wizard or
			$screen->id == $this->screen_id_formations or
			$screen->id == $this->screen_id_jersey_sets or
			$screen->id == $this->screen_id_agency ) {

			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-jquery-ui-tooltip',
				$this->shared->get( 'url' ) . 'admin/assets/css/jquery-ui-tooltip.css',
				array(),
				$this->shared->get( 'ver' )
			);

		}

		// Chosen.
		if ( $screen->id == $this->screen_id_ranking_types or
			$screen->id == $this->screen_id_ranking_transitions or
			$screen->id == $this->screen_id_staff or
			$screen->id == $this->screen_id_staff_types or
			$screen->id == $this->screen_id_player_awards or
			$screen->id == $this->screen_id_player_award_types or
			$screen->id == $this->screen_id_staff_awards or
			$screen->id == $this->screen_id_staff_award_types or
			$screen->id == $this->screen_id_referees or
			$screen->id == $this->screen_id_referee_badges or
			$screen->id == $this->screen_id_referee_badge_types or
			$screen->id == $this->screen_id_unavailable_players or
			$screen->id == $this->screen_id_unavailable_player_types or
			$screen->id == $this->screen_id_trophies or
			$screen->id == $this->screen_id_trophy_types or
			$screen->id == $this->screen_id_team_contracts or
			$screen->id == $this->screen_id_agency_contracts or
			$screen->id == $this->screen_id_injuries or
			$screen->id == $this->screen_id_transfers or
			$screen->id == $this->screen_id_players or
			$screen->id == $this->screen_id_market_value_transitions or
			$screen->id == $this->screen_id_competitions or
			$screen->id == $this->screen_id_teams or
			$screen->id == $this->screen_id_squads or
			$screen->id == $this->screen_id_jersey_sets or
			$screen->id == $this->screen_id_matches or
			$screen->id == $this->screen_id_events or
			$screen->id == $this->screen_id_events_wizard or
			$screen->id == $this->screen_id_agency or
			$screen->id == $this->screen_id_maintenance ) {

			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-chosen',
				$this->shared->get( 'url' ) . 'admin/assets/inc/chosen/chosen-min.css',
				array(),
				$this->shared->get( 'ver' )
			);
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-chosen-custom',
				$this->shared->get( 'url' ) . 'admin/assets/css/chosen-custom.css',
				array(),
				$this->shared->get( 'ver' )
			);

		}

		// jQuery UI Datepicker.
		if ( $screen->id == $this->screen_id_ranking_transitions or
			$screen->id == $this->screen_id_staff or
			$screen->id == $this->screen_id_player_awards or
			$screen->id == $this->screen_id_staff_awards or
			$screen->id == $this->screen_id_referees or
			$screen->id == $this->screen_id_referee_badges or
			$screen->id == $this->screen_id_referee_badge_types or
			$screen->id == $this->screen_id_unavailable_players or
			$screen->id == $this->screen_id_trophies or
			$screen->id == $this->screen_id_team_contracts or
			$screen->id == $this->screen_id_agency_contracts or
			$screen->id == $this->screen_id_injuries or
			$screen->id == $this->screen_id_transfers or
			$screen->id == $this->screen_id_market_value_transitions or
			$screen->id == $this->screen_id_teams or
			$screen->id == $this->screen_id_matches or
			$screen->id == $this->screen_id_players ) {

			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-jquery-ui',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.css',
				array(),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-jquery-ui-custom',
				$this->shared->get( 'url' ) . 'admin/assets/css/jquery-ui-datepicker-custom.css',
				array(),
				$this->shared->get( 'ver' )
			);

		}

		// Framework Menu.
		if ( $screen->id == $this->screen_id_matches ) {

			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-menu-matches',
				$this->shared->get( 'url' ) . 'admin/assets/css/menu-matches.css',
				array(),
				$this->shared->get( 'ver' )
			);

		}

		// Menu Maintenance.
		if ( $screen->id == $this->screen_id_maintenance ) {

			// jQuery UI Dialog.
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-jquery-ui-dialog',
				$this->shared->get( 'url' ) . 'admin/assets/css/jquery-ui-dialog.css',
				array(),
				$this->shared->get( 'ver' )
			);
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-jquery-ui-dialog-custom',
				$this->shared->get( 'url' ) . 'admin/assets/css/jquery-ui-dialog-custom.css',
				array(),
				$this->shared->get( 'ver' )
			);

		}

		// Menu Help.
		if ( $screen->id == $this->screen_id_help ) {

			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-menu-help',
				$this->shared->get( 'url' ) . 'admin/assets/css/menu-help.css',
				array(),
				$this->shared->get( 'ver' )
			);

		}

		// Menu options.
		if ( $screen->id == $this->screen_id_options ) {
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-menu-options',
				$this->shared->get( 'url' ) . 'admin/assets/css/menu-options.css',
				array(),
				$this->shared->get( 'ver' )
			);
			wp_enqueue_style( $this->shared->get( 'slug' ) . '-spectrum', $this->shared->get( 'url' ) . 'admin/assets/inc/spectrum/spectrum.css', array(), $this->shared->get( 'ver' ) );
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-framework-options',
				$this->shared->get( 'url' ) . 'admin/assets/css/framework/options.css',
				array(),
				$this->shared->get( 'ver' )
			);
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-jquery-ui-tooltip',
				$this->shared->get( 'url' ) . 'admin/assets/css/jquery-ui-tooltip.css',
				array(),
				$this->shared->get( 'ver' )
			);
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-chosen',
				$this->shared->get( 'url' ) . 'admin/assets/inc/chosen/chosen-min.css',
				array(),
				$this->shared->get( 'ver' )
			);
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-chosen-custom',
				$this->shared->get( 'url' ) . 'admin/assets/css/chosen-custom.css',
				array(),
				$this->shared->get( 'ver' )
			);
		}
	}

	/*
	 * Enqueue admin-specific JavaScript.
	 */
	public function enqueue_admin_scripts() {

		$wp_localize_script_data = array(
			'locale'     => esc_attr( get_locale() ),
			'deleteText' => esc_attr__( 'Delete', 'dase' ),
			'cancelText' => esc_attr__( 'Cancel', 'dase' ),
			'chooseText' => esc_attr__( 'Add Color', 'dase' ),
		);

		$screen = get_current_screen();

		// Framework Menu.
		if ( $screen->id == $this->screen_id_ranking_types or
			$screen->id == $this->screen_id_ranking_transitions or
			$screen->id == $this->screen_id_staff or
			$screen->id == $this->screen_id_staff_types or
			$screen->id == $this->screen_id_player_awards or
			$screen->id == $this->screen_id_player_award_types or
			$screen->id == $this->screen_id_staff_awards or
			$screen->id == $this->screen_id_staff_award_types or
			$screen->id == $this->screen_id_referees or
			$screen->id == $this->screen_id_referee_badges or
			$screen->id == $this->screen_id_referee_badge_types or
			$screen->id == $this->screen_id_unavailable_players or
			$screen->id == $this->screen_id_unavailable_player_types or
			$screen->id == $this->screen_id_trophies or
			$screen->id == $this->screen_id_trophy_types or
			$screen->id == $this->screen_id_team_contracts or
			$screen->id == $this->screen_id_team_contract_types or
			$screen->id == $this->screen_id_agency_contracts or
			$screen->id == $this->screen_id_agency_contract_types or
			$screen->id == $this->screen_id_injuries or
			$screen->id == $this->screen_id_injury_types or
			$screen->id == $this->screen_id_transfers or
			$screen->id == $this->screen_id_transfer_types or
			$screen->id == $this->screen_id_players or
			$screen->id == $this->screen_id_player_positions or
			$screen->id == $this->screen_id_market_value_transitions or
			$screen->id == $this->screen_id_stadiums or
			$screen->id == $this->screen_id_competitions or
			$screen->id == $this->screen_id_teams or
			$screen->id == $this->screen_id_squads or
			$screen->id == $this->screen_id_matches or
			$screen->id == $this->screen_id_events or
			$screen->id == $this->screen_id_events_wizard or
			$screen->id == $this->screen_id_formations or
			$screen->id == $this->screen_id_jersey_sets or
			$screen->id == $this->screen_id_agency ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-daext-menu',
				$this->shared->get( 'url' ) . 'admin/assets/js/framework/menu.js',
				'jquery',
				$this->shared->get( 'ver' )
			);

		}

		// jQuery UI Tooltip.
		if ( $screen->id == $this->screen_id_ranking_types or
			$screen->id == $this->screen_id_ranking_transitions or
			$screen->id == $this->screen_id_staff or
			$screen->id == $this->screen_id_staff_types or
			$screen->id == $this->screen_id_player_awards or
			$screen->id == $this->screen_id_player_award_types or
			$screen->id == $this->screen_id_staff_awards or
			$screen->id == $this->screen_id_staff_award_types or
			$screen->id == $this->screen_id_referees or
			$screen->id == $this->screen_id_referee_badges or
			$screen->id == $this->screen_id_referee_badge_types or
			$screen->id == $this->screen_id_unavailable_players or
			$screen->id == $this->screen_id_unavailable_player_types or
			$screen->id == $this->screen_id_trophies or
			$screen->id == $this->screen_id_trophy_types or
			$screen->id == $this->screen_id_team_contracts or
			$screen->id == $this->screen_id_team_contract_types or
			$screen->id == $this->screen_id_agency_contracts or
			$screen->id == $this->screen_id_agency_contract_types or
			$screen->id == $this->screen_id_injuries or
			$screen->id == $this->screen_id_injury_types or
			$screen->id == $this->screen_id_transfers or
			$screen->id == $this->screen_id_transfer_types or
			$screen->id == $this->screen_id_players or
			$screen->id == $this->screen_id_player_positions or
			$screen->id == $this->screen_id_market_value_transitions or
			$screen->id == $this->screen_id_stadiums or
			$screen->id == $this->screen_id_competitions or
			$screen->id == $this->screen_id_teams or
			$screen->id == $this->screen_id_squads or
			$screen->id == $this->screen_id_matches or
			$screen->id == $this->screen_id_events or
			$screen->id == $this->screen_id_events_wizard or
			$screen->id == $this->screen_id_formations or
			$screen->id == $this->screen_id_jersey_sets or
			$screen->id == $this->screen_id_agency ) {

			wp_enqueue_script( 'jquery-ui-tooltip' );
			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-jquery-ui-tooltip-init',
				$this->shared->get( 'url' ) . 'admin/assets/js/jquery-ui-tooltip-init.js',
				'jquery',
				$this->shared->get( 'ver' )
			);

		}

		// Chosen.
		if ( $screen->id == $this->screen_id_ranking_types or
			$screen->id == $this->screen_id_ranking_transitions or
			$screen->id == $this->screen_id_staff or
			$screen->id == $this->screen_id_staff_types or
			$screen->id == $this->screen_id_player_awards or
			$screen->id == $this->screen_id_player_award_types or
			$screen->id == $this->screen_id_staff_awards or
			$screen->id == $this->screen_id_staff_award_types or
			$screen->id == $this->screen_id_referees or
			$screen->id == $this->screen_id_referee_badges or
			$screen->id == $this->screen_id_referee_badge_types or
			$screen->id == $this->screen_id_unavailable_players or
			$screen->id == $this->screen_id_unavailable_player_types or
			$screen->id == $this->screen_id_trophies or
			$screen->id == $this->screen_id_trophy_types or
			$screen->id == $this->screen_id_team_contracts or
			$screen->id == $this->screen_id_agency_contracts or
			$screen->id == $this->screen_id_injuries or
			$screen->id == $this->screen_id_transfers or
			$screen->id == $this->screen_id_players or
			$screen->id == $this->screen_id_market_value_transitions or
			$screen->id == $this->screen_id_competitions or
			$screen->id == $this->screen_id_teams or
			$screen->id == $this->screen_id_squads or
			$screen->id == $this->screen_id_jersey_sets or
			$screen->id == $this->screen_id_matches or
			$screen->id == $this->screen_id_events or
			$screen->id == $this->screen_id_events_wizard or
			$screen->id == $this->screen_id_agency or
			$screen->id == $this->screen_id_maintenance ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-chosen',
				$this->shared->get( 'url' ) . 'admin/assets/inc/chosen/chosen-min.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-chosen-init',
				$this->shared->get( 'url' ) . 'admin/assets/js/chosen-init.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

		}

		// Media Uploader.
		if ( $screen->id == $this->screen_id_staff or
			$screen->id == $this->screen_id_trophy_types or
			$screen->id == $this->screen_id_players or
			$screen->id == $this->screen_id_referees or
			$screen->id == $this->screen_id_referee_badges or
			$screen->id == $this->screen_id_referee_badge_types or
			$screen->id == $this->screen_id_stadiums or
			$screen->id == $this->screen_id_competitions or
			$screen->id == $this->screen_id_teams ) {

			wp_enqueue_media();
			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-media-uploader',
				$this->shared->get( 'url' ) . 'admin/assets/js/media-uploader.js',
				'jquery',
				$this->shared->get( 'ver' )
			);

		}

		// Group Trigger.
		if ( $screen->id == $this->screen_id_squads or
			$screen->id == $this->screen_id_matches or
			$screen->id == $this->screen_id_teams or
			$screen->id == $this->screen_id_jersey_sets or
			$screen->id == $this->screen_id_competitions or
			$screen->id == $this->screen_id_events_wizard ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-group-trigger',
				$this->shared->get( 'url' ) . 'admin/assets/js/framework/group-trigger.js',
				'jquery',
				$this->shared->get( 'ver' )
			);

		}

		// Menu Staff.
		if ( $screen->id == $this->screen_id_staff ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-staff',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-staff.js',
				array( 'jquery', $this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-staff', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Events.
		if ( $screen->id == $this->screen_id_events ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-events',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-events.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

		}

		// Menu Ranking Transitions
		if ( $screen->id == $this->screen_id_ranking_transitions ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-ranking-transitions',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-ranking-transitions.js',
				array( 'jquery', $this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-ranking-transitions', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Player Awards.
		if ( $screen->id == $this->screen_id_player_awards ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-player-awards',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-player-awards.js',
				array( 'jquery', $this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-player-awards', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Player Awards.
		if ( $screen->id == $this->screen_id_staff_awards ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-staff-awards',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-staff-awards.js',
				array( 'jquery', $this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-staff-awards', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Unavailable Players.
		if ( $screen->id == $this->screen_id_unavailable_players ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-unavailable-players',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-unavailable-players.js',
				array( 'jquery', $this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-unavailable-players', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Trophies.
		if ( $screen->id == $this->screen_id_trophies ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-trophies',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-trophies.js',
				array( 'jquery', $this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-trophies', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Team Contracts.
		if ( $screen->id == $this->screen_id_team_contracts ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-team-contracts',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-team-contracts.js',
				array( 'jquery', $this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-team-contracts', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Agency Contracts.
		if ( $screen->id == $this->screen_id_agency_contracts ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-agency-contracts',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-agency-contracts.js',
				array( 'jquery', $this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-agency-contracts', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Injuries.
		if ( $screen->id == $this->screen_id_injuries ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-injuries',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-injuries.js',
				array( 'jquery', $this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-injuries', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Transfers.
		if ( $screen->id == $this->screen_id_transfers ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-transfers',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-transfers.js',
				array( 'jquery', $this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-transfers', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Players.
		if ( $screen->id == $this->screen_id_players ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-players',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-players.js',
				array( 'jquery', $this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-players', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Market Value Transition.
		if ( $screen->id == $this->screen_id_market_value_transitions ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-market-value-transitions',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-market-value-transitions.js',
				array( 'jquery', $this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-market-value-transitions', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Teams.
		if ( $screen->id == $this->screen_id_teams ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-teams',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-teams.js',
				array( 'jquery', $this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-teams', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Matches.
		if ( $screen->id == $this->screen_id_matches ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-matches',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-matches.js',
				array( 'jquery', $this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-matches', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Referees.
		if ( $screen->id == $this->screen_id_referees ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-referees',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-referees.js',
				array( 'jquery', $this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-referees', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Referee Badges.
		if ( $screen->id == $this->screen_id_referee_badges ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-referee-badges',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-referee-badges.js',
				array( 'jquery', $this->shared->get( 'slug' ) . '-custom-jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-referee-badges', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Maintenance.
		if ( $screen->id == $this->screen_id_maintenance ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-maintenance',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-maintenance.js',
				array( 'jquery', 'jquery-ui-dialog' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-maintenance', 'objectL10n', $wp_localize_script_data );

		}

		// Menu options.
		if ( $screen->id == $this->screen_id_options ) {

			wp_enqueue_script( $this->shared->get( 'slug' ) . '-spectrum', $this->shared->get( 'url' ) . 'admin/assets/inc/spectrum/spectrum.js', 'jquery', $this->shared->get( 'ver' ) );
			wp_localize_script( $this->shared->get( 'slug' ) . '-spectrum', 'objectL10n', $wp_localize_script_data );
			wp_enqueue_script( 'jquery-ui-tooltip' );
			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-jquery-ui-tooltip-init',
				$this->shared->get( 'url' ) . 'admin/assets/js/jquery-ui-tooltip-init.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);
			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-chosen',
				$this->shared->get( 'url' ) . 'admin/assets/inc/chosen/chosen-min.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);
			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-jquery-ui-chosen-init',
				$this->shared->get( 'url' ) . 'admin/assets/js/chosen-init.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);
			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-options',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-options.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

		}
	}

	/**
	 * Plugin activation.
	 */
	public function ac_activate( $networkwide ) {

		/*
		 * delete options and tables for all the sites in the network
		 */
		if ( function_exists( 'is_multisite' ) and is_multisite() ) {

			/**
			 * If this is a "Network Activation" create the options and tables
			 * for each blog.
			 */
			if ( $networkwide ) {

				// Get the current blog id.
				global $wpdb;
				$current_blog = $wpdb->blogid;

				// Create an array with all the blog ids.
				$blogids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );

				// Iterate through all the blogs.
				foreach ( $blogids as $blog_id ) {

					// Switch to the iterated blog.
					switch_to_blog( $blog_id );

					// Create options and tables for the iterated blog.
					$this->ac_initialize_options();
					$this->ac_create_database_tables();
					$this->ac_initialize_custom_css();

				}

				// Switch to the current blog.
				switch_to_blog( $current_blog );

			} else {

				/**
				 * if this is not a "Network Activation" create options and
				 * tables only for the current blog
				 */
				$this->ac_initialize_options();
				$this->ac_create_database_tables();
				$this->ac_initialize_custom_css();

			}
		} else {

			/*
			 * if this is not a multisite installation create options and
			 * tables only for the current blog
			 */
			$this->ac_initialize_options();
			$this->ac_create_database_tables();
			$this->ac_initialize_custom_css();

		}
	}

	/**
	 * Create the options and tables for the newly created blog.
	 *
	 * @param $blog_id
	 * @param $user_id
	 * @param $domain
	 * @param $path
	 * @param $site_id
	 * @param $meta
	 *
	 * @return void
	 */
	public function new_blog_create_options_and_tables( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {

		global $wpdb;

		/*
		 * if the plugin is "Network Active" create the options and tables for
		 * this new blog
		 */
		if ( is_plugin_active_for_network( 'daext-soccer-engine/init.php' ) ) {

			// Get the id of the current blog.
			$current_blog = $wpdb->blogid;

			// Switch to the blog that is being activated.
			switch_to_blog( $blog_id );

			// Create options and database tables for the new blog.
			$this->ac_initialize_options();
			$this->ac_create_database_tables();
			$this->ac_initialize_custom_css();

			// Switch to the current blog.
			switch_to_blog( $current_blog );

		}
	}

	/**
	 * Delete options and tables for the deleted blog.
	 *
	 * @param $blog_id
	 *
	 * @return void
	 */
	public function delete_blog_delete_options_and_tables( $blog_id ) {

		global $wpdb;

		// Get the id of the current blog.
		$current_blog = $wpdb->blogid;

		// Switch to the blog that is being activated.
		switch_to_blog( $blog_id );

		// Create options and database tables for the new blog.
		$this->un_delete_options();
		$this->un_delete_database_tables();

		// Switch to the current blog.
		switch_to_blog( $current_blog );
	}

	/*
	 * initialize plugin options
	 */
	private function ac_initialize_options() {

		foreach ( $this->shared->get( 'options' ) as $key => $value ) {
			add_option( $key, $value );
		}
	}

	/**
	 * Create the plugin database tables.
	 */
	private function ac_create_database_tables() {

		global $wpdb;

		// Get the database character collate that will be appended at the end of each query.
		$charset_collate = $wpdb->get_charset_collate();

		// check database version and create the database.
		if ( intval( get_option( $this->shared->get( 'slug' ) . '_database_version' ), 10 ) < 999 ) {

			require_once ABSPATH . 'wp-admin/includes/upgrade.php';

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_ranking_type';
			$sql        = "CREATE TABLE $table_name (
                ranking_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (ranking_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_ranking_transition';
			$sql        = "CREATE TABLE $table_name (
                ranking_transition_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                ranking_type_id BIGINT(20) UNSIGNED DEFAULT NULL,
                value INT DEFAULT NULL,
                team_id BIGINT(20) UNSIGNED DEFAULT NULL,
                date DATE DEFAULT NULL,
                PRIMARY KEY (ranking_transition_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff';
			$sql        = "CREATE TABLE $table_name (
                staff_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                first_name TEXT DEFAULT NULL,
                last_name TEXT DEFAULT NULL,
                image TEXT DEFAULT NULL,
                citizenship TEXT DEFAULT NULL,
                second_citizenship TEXT DEFAULT NULL,
                staff_type_id BIGINT DEFAULT NULL,
                retired TINYINT(1) DEFAULT NULL,
                gender TINYINT(1) DEFAULT NULL,
                date_of_birth DATE DEFAULT NULL,
                date_of_death DATE DEFAULT NULL,
                PRIMARY KEY (staff_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff_type';
			$sql        = "CREATE TABLE $table_name (
                staff_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (staff_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player_award';
			$sql        = "CREATE TABLE $table_name (
                player_award_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                player_award_type_id BIGINT(20) UNSIGNED DEFAULT NULL,
                assignment_date DATE DEFAULT NULL,
                player_id BIGINT(20) UNSIGNED DEFAULT NULL,
                PRIMARY KEY (player_award_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player_award_type';
			$sql        = "CREATE TABLE $table_name (
                player_award_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (player_award_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff_award';
			$sql        = "CREATE TABLE $table_name (
                staff_award_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                staff_award_type_id BIGINT(20) UNSIGNED DEFAULT NULL,
                assignment_date DATE DEFAULT NULL,
                staff_id BIGINT(20) UNSIGNED DEFAULT NULL,
                PRIMARY KEY (staff_award_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff_award_type';
			$sql        = "CREATE TABLE $table_name (
                staff_award_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (staff_award_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_unavailable_player';
			$sql        = "CREATE TABLE $table_name (
                unavailable_player_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                player_id BIGINT UNSIGNED DEFAULT NULL,
                unavailable_player_type_id BIGINT(20) UNSIGNED DEFAULT NULL,
                start_date DATE DEFAULT NULL,
                end_date DATE DEFAULT NULL,
                PRIMARY KEY (unavailable_player_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_unavailable_player_type';
			$sql        = "CREATE TABLE $table_name (
                unavailable_player_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (unavailable_player_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_trophy';
			$sql        = "CREATE TABLE $table_name (
                trophy_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                trophy_type_id BIGINT(20) UNSIGNED DEFAULT NULL,
                team_id BIGINT(20) UNSIGNED DEFAULT NULL,
                assignment_date DATE DEFAULT NULL,
                PRIMARY KEY (trophy_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_trophy_type';
			$sql        = "CREATE TABLE $table_name (
                trophy_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                logo TEXT DEFAULT NULL,
                PRIMARY KEY (trophy_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency';
			$sql        = "CREATE TABLE $table_name (
                agency_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                full_name TEXT DEFAULT NULL,
                address TEXT DEFAULT NULL,
                tel TEXT DEFAULT NULL,
                fax TEXT DEFAULT NULL,
                website TEXT DEFAULT NULL,
                PRIMARY KEY (agency_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team_contract';
			$sql        = "CREATE TABLE $table_name (
                team_contract_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                team_contract_type_id BIGINT(20) UNSIGNED NOT NULL,
                player_id BIGINT(20) UNSIGNED DEFAULT NULL,
                start_date DATE DEFAULT NULL,
                end_date DATE DEFAULT NULL,
                salary DECIMAL(15, 2) NULL,
                team_id BIGINT(20) UNSIGNED NOT NULL,
                PRIMARY KEY (team_contract_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team_contract_type';
			$sql        = "CREATE TABLE $table_name (
                team_contract_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (team_contract_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency_contract';
			$sql        = "CREATE TABLE $table_name (
                agency_contract_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                agency_contract_type_id BIGINT(20) UNSIGNED NOT NULL,
                player_id BIGINT(20) UNSIGNED DEFAULT NULL,
                start_date DATE DEFAULT NULL,
                end_date DATE DEFAULT NULL,
                agency_id BIGINT(20) UNSIGNED NOT NULL,
                PRIMARY KEY (agency_contract_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency_contract_type';
			$sql        = "CREATE TABLE $table_name (
                agency_contract_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (agency_contract_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_injury';
			$sql        = "CREATE TABLE $table_name (
                injury_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                injury_type_id BIGINT(20) UNSIGNED NOT NULL,
                start_date DATE DEFAULT NULL,
                end_date DATE DEFAULT NULL,
                player_id BIGINT(20) UNSIGNED NULL,
                PRIMARY KEY (injury_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_injury_type';
			$sql        = "CREATE TABLE $table_name (
                injury_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (injury_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_transfer';
			$sql        = "CREATE TABLE $table_name (
                transfer_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                player_id BIGINT(20) UNSIGNED DEFAULT NULL,
                date DATE DEFAULT NULL,
                team_id_left BIGINT(20) UNSIGNED DEFAULT NULL,
                team_id_joined BIGINT(20) UNSIGNED DEFAULT NULL,
                fee DECIMAL(15, 2) NULL,
                transfer_type_id BIGINT(20) UNSIGNED DEFAULT NULL,
                PRIMARY KEY (transfer_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_transfer_type';
			$sql        = "CREATE TABLE $table_name (
                transfer_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (transfer_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player';
			$sql        = "CREATE TABLE $table_name (
                player_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                first_name TEXT DEFAULT NULL,
                last_name TEXT DEFAULT NULL,
                image TEXT,
                citizenship TEXT DEFAULT NULL,
                second_citizenship TEXT DEFAULT NULL,
                player_position_id BIGINT(20) UNSIGNED DEFAULT NULL,
                URL TEXT DEFAULT NULL,
                date_of_birth DATE DEFAULT NULL,
                date_of_death DATE DEFAULT NULL,
                gender TINYINT(1) DEFAULT NULL,
                height SMALLINT(5) UNSIGNED DEFAULT NULL,
                foot TINYINT DEFAULT NULL,
                retired TINYINT(1) DEFAULT NULL,
                PRIMARY KEY (player_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player_position';
			$sql        = "CREATE TABLE $table_name (
                player_position_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                abbreviation TEXT DEFAULT NULL,
                PRIMARY KEY (player_position_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_market_value_transition';
			$sql        = "CREATE TABLE $table_name (
                market_value_transition_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                date DATE DEFAULT NULL,
                value DECIMAL(15,2) NULL,
                player_id BIGINT(20) UNSIGNED DEFAULT NULL,	
                PRIMARY KEY (market_value_transition_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_stadium';
			$sql        = "CREATE TABLE $table_name (
                stadium_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                image TEXT DEFAULT NULL,
                PRIMARY KEY (stadium_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_competition';
			$sql        = "CREATE TABLE $table_name (
                competition_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                logo TEXT DEFAULT NULL,
                type TINYINT(1) DEFAULT NULL,
                rounds SMALLINT DEFAULT NULL,\n";
			for ( $i = 1;$i <= 128;$i++ ) {
				$sql .= "team_id_$i BIGINT DEFAULT NULL,\n";}
				$sql .= "rr_victory_points TINYINT(1) DEFAULT NULL,
				rr_draw_points TINYINT(1) DEFAULT NULL,
				rr_defeat_points TINYINT(1) DEFAULT NULL,
				rr_sorting_order_1 TINYINT(1) DEFAULT NULL,
				rr_sorting_order_by_1 TINYINT(1) DEFAULT NULL,
				rr_sorting_order_2 TINYINT(1) DEFAULT NULL,
				rr_sorting_order_by_2 TINYINT(1) DEFAULT NULL,
                PRIMARY KEY (competition_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team';
			$sql        = "CREATE TABLE $table_name (
                team_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                logo TEXT DEFAULT NULL,
                type TINYINT(1) DEFAULT NULL,
                foundation_date DATE DEFAULT NULL,
                stadium_id BIGINT DEFAULT NULL,
                full_name TEXT DEFAULT NULL,
                address TEXT DEFAULT NULL,
                tel TEXT DEFAULT NULL,
                fax TEXT DEFAULT NULL,
                website_url TEXT DEFAULT NULL,
                club_nation TEXT DEFAULT NULL,
                national_team_confederation TINYINT(1) DEFAULT NULL,
                PRIMARY KEY (team_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_squad';
			$sql        = "CREATE TABLE $table_name (
                squad_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,\n";
			for ( $i = 1;$i <= 11;$i++ ) {
				$sql .= "lineup_player_id_$i BIGINT DEFAULT NULL,\n";}
			for ( $i = 1;$i <= 20;$i++ ) {
				$sql .= "substitute_player_id_$i BIGINT DEFAULT NULL,\n";}
			for ( $i = 1;$i <= 20;$i++ ) {
				$sql .= "staff_id_$i BIGINT DEFAULT NULL,\n";}
				$sql .= "jersey_set_id BIGINT DEFAULT NULL,
                formation_id BIGINT DEFAULT NULL,
                PRIMARY KEY (squad_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_match';
			$sql        = "CREATE TABLE $table_name (
                match_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                competition_id BIGINT DEFAULT NULL,
                round SMALLINT DEFAULT NULL,
                type TINYINT(1) DEFAULT NULL,
                team_id_1 BIGINT DEFAULT NULL,
                team_id_2 BIGINT DEFAULT NULL,
                date DATE DEFAULT NULL,
                time TIME DEFAULT NULL,
                fh_additional_time TINYINT(1) DEFAULT NULL,
                sh_additional_time TINYINT(1) DEFAULT NULL,
                fh_extra_time_additional_time TINYINT(1) DEFAULT NULL,
                sh_extra_time_additional_time TINYINT(1) DEFAULT NULL,\n";
			for ( $t = 1;$t <= 2;$t++ ) {
				for ( $i = 1;$i <= 11;$i++ ) {
					$sql .= 'team_' . $t . "_lineup_player_id_$i BIGINT DEFAULT NULL,\n";}
				for ( $i = 1;$i <= 20;$i++ ) {
					$sql .= 'team_' . $t . "_substitute_player_id_$i BIGINT DEFAULT NULL,\n";}
				for ( $i = 1;$i <= 20;$i++ ) {
					$sql .= 'team_' . $t . "_staff_id_$i BIGINT DEFAULT NULL,\n";}
			}
				$sql .= "stadium_id BIGINT DEFAULT NULL,
				team_1_formation_id BIGINT DEFAULT NULL,
				team_2_formation_id BIGINT DEFAULT NULL,
				attendance INT DEFAULT NULL,
				referee_id BIGINT DEFAULT NULL,
				player_id_injured TEXT DEFAULT NULL,
				player_id_unavailable TEXT DEFAULT NULL,
				team_1_jersey_set_id BIGINT DEFAULT NULL,
				team_2_jersey_set_id BIGINT DEFAULT NULL,
                PRIMARY KEY (match_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_event';
			$sql        = "CREATE TABLE $table_name (
                event_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                data TINYINT(1) DEFAULT NULL,
                match_id BIGINT(20) DEFAULT NULL,
                part TINYINT(1) DEFAULT NULL,
                team_slot TINYINT(1) DEFAULT NULL,
                time TINYINT(1) UNSIGNED DEFAULT NULL,
                additional_time TINYINT(1) UNSIGNED DEFAULT NULL,
                description TEXT DEFAULT NULL,
                match_effect TINYINT(1) DEFAULT NULL,
                player_id BIGINT DEFAULT NULL,
                player_id_substitution_out BIGINT DEFAULT NULL,
                player_id_substitution_in BIGINT DEFAULT NULL,
                staff_id BIGINT DEFAULT NULL,
                PRIMARY KEY (event_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_formation';
			$sql        = "CREATE TABLE $table_name (
                formation_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                x_position_1 SMALLINT DEFAULT NULL,
                y_position_1 SMALLINT DEFAULT NULL,
                x_position_2 SMALLINT DEFAULT NULL,
                y_position_2 SMALLINT DEFAULT NULL,
                x_position_3 SMALLINT DEFAULT NULL,
                y_position_3 SMALLINT DEFAULT NULL,
                x_position_4 SMALLINT DEFAULT NULL,
                y_position_4 SMALLINT DEFAULT NULL,
                x_position_5 SMALLINT DEFAULT NULL,
                y_position_5 SMALLINT DEFAULT NULL,
                x_position_6 SMALLINT DEFAULT NULL,
                y_position_6 SMALLINT DEFAULT NULL,
                x_position_7 SMALLINT DEFAULT NULL,
                y_position_7 SMALLINT DEFAULT NULL,
                x_position_8 SMALLINT DEFAULT NULL,
                y_position_8 SMALLINT DEFAULT NULL,
                x_position_9 SMALLINT DEFAULT NULL,
                y_position_9 SMALLINT DEFAULT NULL,
                x_position_10 SMALLINT DEFAULT NULL,
                y_position_10 SMALLINT DEFAULT NULL,
                x_position_11 SMALLINT DEFAULT NULL,
                y_position_11 SMALLINT DEFAULT NULL,
                PRIMARY KEY (formation_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_jersey_set';
			$sql        = "CREATE TABLE $table_name (
                jersey_set_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	        	name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,\n";
			for ( $i = 1;$i <= 50;$i++ ) {
				$sql .= "player_id_$i BIGINT DEFAULT NULL,\n";}
			for ( $i = 1;$i <= 50;$i++ ) {
				$sql .= "jersey_number_player_id_$i BIGINT DEFAULT NULL,\n";}
				$sql .= "PRIMARY KEY (jersey_set_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee';
			$sql        = "CREATE TABLE $table_name (
                referee_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                first_name TEXT DEFAULT NULL,
                last_name TEXT DEFAULT NULL,
                image TEXT DEFAULT NULL,
                citizenship TEXT DEFAULT NULL,
                second_citizenship TEXT DEFAULT NULL,
                place_of_birth TEXT DEFAULT NULL,
                residence TEXT DEFAULT NULL,
                retired TINYINT(1) DEFAULT NULL,
                gender TINYINT(1) DEFAULT NULL,
                job TEXT DEFAULT NULL,
                date_of_birth DATE DEFAULT NULL,
                date_of_death DATE DEFAULT NULL,
                PRIMARY KEY (referee_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee_badge';
			$sql        = "CREATE TABLE $table_name (
                referee_badge_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                referee_id BIGINT(20) DEFAULT NULL,
                referee_badge_type_id BIGINT(20) DEFAULT NULL,
                start_date DATE DEFAULT NULL,
                end_date DATE DEFAULT NULL,
                PRIMARY KEY (referee_badge_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee_badge_type';
			$sql        = "CREATE TABLE $table_name (
                referee_badge_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (referee_badge_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			// Update database version
			update_option( $this->shared->get( 'slug' ) . '_database_version', '1' );

		}
	}

	/*
	 * initialize the custom-[blog_id].css file
	 */
	public function ac_initialize_custom_css() {

		/*
		 * Write the custom-[blog_id].css file or die if the file can't be
		 * created or modified
		 */
		if ( $this->write_custom_css() === false ) {
			die( "The plugin can't write files in the upload directory." );
		}
	}

	/*
	 * Plugin delete.
	 */
	public static function un_delete() {

		/**
		 * Delete options and tables for all the sites in the network.
		 */
		if ( function_exists( 'is_multisite' ) and is_multisite() ) {

			// get the current blog id.
			global $wpdb;
			$current_blog = $wpdb->blogid;

			// create an array with all the blog ids.
			$blogids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );

			// iterate through all the blogs.
			foreach ( $blogids as $blog_id ) {

				// switch to the iterated blog.
				switch_to_blog( $blog_id );

				// create options and tables for the iterated blog.
				self::un_delete_options();
				self::un_delete_database_tables();

			}

			// switch to the current blog.
			switch_to_blog( $current_blog );

		} else {

			/**
			 * If this is not a multisite installation delete options and tables only for the current blog.
			 */
			self::un_delete_options();
			self::un_delete_database_tables();

		}
	}

	/*
	 * Delete plugin options.
	 */
	public static function un_delete_options() {

		// assign an instance of Dase_Shared.
		$shared = Dase_Shared::get_instance();

		foreach ( $shared->get( 'options' ) as $key => $value ) {
			delete_option( $key );
		}
	}

	/**
	 * Delete plugin database tables.
	 */
	public static function un_delete_database_tables() {

		// assign an instance of Dase_Shared.
		$shared = Dase_Shared::get_instance();

		global $wpdb;
		$database_table_a = $shared->get( 'database_tables' );
		foreach ( $database_table_a as $key => $database_table ) {

			$table_name = $wpdb->prefix . $shared->get( 'slug' ) . '_' . $database_table['name'];
			$sql        = "DROP TABLE $table_name";
			$wpdb->query( $sql );

		}
	}

	/**
	 * Register the admin menu.
	 */
	public function me_add_admin_menu() {

		// Matches ----------------------------------------------------------------------------------------------------.
		add_menu_page(
			esc_attr__( 'SE', 'dase' ),
			esc_attr__( 'SE Matches', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_matches' ),
			$this->shared->get( 'slug' ) . '-matches',
			function () {
				include_once 'view/matches.php';},
			'none'
		);

		$this->screen_id_matches = add_submenu_page(
			$this->shared->get( 'slug' ) . '-matches',
			esc_attr__( 'SE - Matches', 'dase' ),
			esc_attr__( 'Matches', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_matches' ),
			$this->shared->get( 'slug' ) . '-matches',
			function () {
				include_once 'view/matches.php';}
		);

		$this->screen_id_events = add_submenu_page(
			$this->shared->get( 'slug' ) . '-matches',
			esc_attr__( 'SE - Events', 'dase' ),
			esc_attr__( 'Events', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_events' ),
			$this->shared->get( 'slug' ) . '-events',
			function () {
				include_once 'view/events.php';}
		);

		$this->screen_id_events_wizard = add_submenu_page(
			$this->shared->get( 'slug' ) . '-matches',
			esc_attr__( 'SE - Events Wizard', 'dase' ),
			esc_attr__( 'Events Wizard', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_events_wizard' ),
			$this->shared->get( 'slug' ) . '-events-wizard',
			function () {
				include_once 'view/events_wizard.php';}
		);

		$this->screen_id_competitions = add_submenu_page(
			$this->shared->get( 'slug' ) . '-matches',
			esc_attr__( 'SE - Competitions', 'dase' ),
			esc_attr__( 'Competitions', 'dase' ),
			'manage_options',
			$this->shared->get( 'slug' ) . '-competitions',
			function () {
				include_once 'view/competitions.php';}
		);

		// Transfers --------------------------------------------------------------------------------------------------.
		add_menu_page(
			esc_attr__( 'SE', 'dase' ),
			esc_attr__( 'SE Transfers', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_transfers' ),
			$this->shared->get( 'slug' ) . '-transfers',
			function () {
				include_once 'view/transfers.php';},
			'none'
		);

		$this->screen_id_transfers = add_submenu_page(
			$this->shared->get( 'slug' ) . '-transfers',
			esc_attr__( 'SE - Transfers', 'dase' ),
			esc_attr__( 'Transfers', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_transfers' ),
			$this->shared->get( 'slug' ) . '-transfers',
			function () {
				include_once 'view/transfers.php';}
		);

		$this->screen_id_transfer_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-transfers',
			esc_attr__( 'SE - Transfer Types', 'dase' ),
			esc_attr__( 'Transfer Types', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_transfer_types' ),
			$this->shared->get( 'slug' ) . '-transfer-types',
			function () {
				include_once 'view/transfer_types.php';}
		);

		$this->screen_id_team_contracts = add_submenu_page(
			$this->shared->get( 'slug' ) . '-transfers',
			esc_attr__( 'SE - Team Contracts', 'dase' ),
			esc_attr__( 'Team Contracts', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_team_contracts' ),
			$this->shared->get( 'slug' ) . '-team-contracts',
			function () {
				include_once 'view/team_contracts.php';}
		);

		$this->screen_id_team_contract_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-transfers',
			esc_attr__( 'SE - Team Contract Types', 'dase' ),
			esc_attr__( 'Team Contract Types', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_team_contract_types' ),
			$this->shared->get( 'slug' ) . '-team-contract-types',
			function () {
				include_once 'view/team_contract_types.php';}
		);

		$this->screen_id_agency = add_submenu_page(
			$this->shared->get( 'slug' ) . '-transfers',
			esc_attr__( 'SE - Agencies', 'dase' ),
			esc_attr__( 'Agencies', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_agencies' ),
			$this->shared->get( 'slug' ) . '-agencies',
			function () {
				include_once 'view/agencies.php';}
		);

		$this->screen_id_agency_contracts = add_submenu_page(
			$this->shared->get( 'slug' ) . '-transfers',
			esc_attr__( 'SE - Agency Contracts', 'dase' ),
			esc_attr__( 'Agency Contracts', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_agency_contracts' ),
			$this->shared->get( 'slug' ) . '-agency-contracts',
			function () {
				include_once 'view/agency_contracts.php';}
		);

		$this->screen_id_agency_contract_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-transfers',
			esc_attr__( 'SE - Agency Contract Types', 'dase' ),
			esc_attr__( 'Agency Contract Types', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_agency_contract_types' ),
			$this->shared->get( 'slug' ) . '-agency-contract-types',
			function () {
				include_once 'view/agency_contract_types.php';}
		);

		$this->screen_id_market_value_transitions = add_submenu_page(
			$this->shared->get( 'slug' ) . '-transfers',
			esc_attr__( 'SE - Market Value Transitions', 'dase' ),
			esc_attr__( 'Market Value Transitions', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_market_value_transitions' ),
			$this->shared->get( 'slug' ) . '-market-value-transitions',
			function () {
				include_once 'view/market_value_transitions.php';}
		);

		// Players ----------------------------------------------------------------------------------------------------.
		add_menu_page(
			esc_attr__( 'SE', 'dase' ),
			esc_attr__( 'SE Players', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_players' ),
			$this->shared->get( 'slug' ) . '-players',
			function () {
				include_once 'view/players.php';},
			'none'
		);

		$this->screen_id_players = add_submenu_page(
			$this->shared->get( 'slug' ) . '-players',
			esc_attr__( 'SE - Players', 'dase' ),
			esc_attr__( 'Players', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_players' ),
			$this->shared->get( 'slug' ) . '-players',
			function () {
				include_once 'view/players.php';}
		);

		$this->screen_id_player_positions = add_submenu_page(
			$this->shared->get( 'slug' ) . '-players',
			esc_attr__( 'SE - Player Positions', 'dase' ),
			esc_attr__( 'Player Positions', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_player_positions' ),
			$this->shared->get( 'slug' ) . '-player-positions',
			function () {
				include_once 'view/player_positions.php';}
		);

		$this->screen_id_player_awards = add_submenu_page(
			$this->shared->get( 'slug' ) . '-players',
			esc_attr__( 'SE - Player Awards', 'dase' ),
			esc_attr__( 'Player Awards', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_player_awards' ),
			$this->shared->get( 'slug' ) . '-player-awards',
			function () {
				include_once 'view/player_awards.php';}
		);

		$this->screen_id_player_award_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-players',
			esc_attr__( 'SE - Player Award Types', 'dase' ),
			esc_attr__( 'Player Award Types', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_player_award_types' ),
			$this->shared->get( 'slug' ) . '-player-award-types',
			function () {
				include_once 'view/player_award_types.php';}
		);

		$this->screen_id_unavailable_players = add_submenu_page(
			$this->shared->get( 'slug' ) . '-players',
			esc_attr__( 'SE - Unavailable Players', 'dase' ),
			esc_attr__( 'Unavailable Players', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_unavailable_players' ),
			$this->shared->get( 'slug' ) . '-unavailable-players',
			function () {
				include_once 'view/unavailable_players.php';}
		);

		$this->screen_id_unavailable_player_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-players',
			esc_attr__( 'SE - Unavailable Player Types', 'dase' ),
			esc_attr__( 'Unavailable Player Types', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_unavailable_player_types' ),
			$this->shared->get( 'slug' ) . '-unavailable-player-types',
			function () {
				include_once 'view/unavailable_player_types.php';}
		);

		$this->screen_id_injuries = add_submenu_page(
			$this->shared->get( 'slug' ) . '-players',
			esc_attr__( 'SE - Injuries', 'dase' ),
			esc_attr__( 'Injuries', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_injuries' ),
			$this->shared->get( 'slug' ) . '-injuries',
			function () {
				include_once 'view/injuries.php';}
		);

		$this->screen_id_injury_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-players',
			esc_attr__( 'SE - Injury Types', 'dase' ),
			esc_attr__( 'Injury Types', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_injury_types' ),
			$this->shared->get( 'slug' ) . '-injury-types',
			function () {
				include_once 'view/injury_types.php';}
		);

		// Staff ------------------------------------------------------------------------------------------------------.
		add_menu_page(
			esc_attr__( 'SE', 'dase' ),
			esc_attr__( 'SE Staff', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_staff' ),
			$this->shared->get( 'slug' ) . '-staff',
			function () {
				include_once 'view/staff.php';},
			'none'
		);

		$this->screen_id_staff = add_submenu_page(
			$this->shared->get( 'slug' ) . '-staff',
			esc_attr__( 'SE - Staff', 'dase' ),
			esc_attr__( 'Staff', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_staff' ),
			$this->shared->get( 'slug' ) . '-staff',
			function () {
				include_once 'view/staff.php';}
		);

		$this->screen_id_staff_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-staff',
			esc_attr__( 'SE - Staff Types', 'dase' ),
			esc_attr__( 'Staff Types', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_staff_types' ),
			$this->shared->get( 'slug' ) . '-staff-types',
			function () {
				include_once 'view/staff_types.php';}
		);

		$this->screen_id_staff_awards = add_submenu_page(
			$this->shared->get( 'slug' ) . '-staff',
			esc_attr__( 'SE - Staff Awards', 'dase' ),
			esc_attr__( 'Staff Awards', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_staff_awards' ),
			$this->shared->get( 'slug' ) . '-staff-awards',
			function () {
				include_once 'view/staff_awards.php';}
		);

		$this->screen_id_staff_award_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-staff',
			esc_attr__( 'SE - Staff Award Types', 'dase' ),
			esc_attr__( 'Staff Award Types', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_staff_award_types' ),
			$this->shared->get( 'slug' ) . '-staff-award-types',
			function () {
				include_once 'view/staff_award_types.php';}
		);

		// Staff ------------------------------------------------------------------------------------------------------.
		add_menu_page(
			esc_attr__( 'SE', 'dase' ),
			esc_attr__( 'SE Referees', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_referees' ),
			$this->shared->get( 'slug' ) . '-referees',
			function () {
				include_once 'view/referees.php';},
			'none'
		);

		$this->screen_id_referees = add_submenu_page(
			$this->shared->get( 'slug' ) . '-referees',
			esc_attr__( 'SE - Referees', 'dase' ),
			esc_attr__( 'Referees', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_referees' ),
			$this->shared->get( 'slug' ) . '-referees',
			function () {
				include_once 'view/referees.php';}
		);

		$this->screen_id_referee_badges = add_submenu_page(
			$this->shared->get( 'slug' ) . '-referees',
			esc_attr__( 'SE - Referee Badges', 'dase' ),
			esc_attr__( 'Referee Badges', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_referee_badges' ),
			$this->shared->get( 'slug' ) . '-referee-badges',
			function () {
				include_once 'view/referee_badges.php';}
		);

		$this->screen_id_referee_badge_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-referees',
			esc_attr__( 'SE - Referee Badge Types', 'dase' ),
			esc_attr__( 'Referee Badge Types', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_referee_badge_types' ),
			$this->shared->get( 'slug' ) . '-referee-badge-types',
			function () {
				include_once 'view/referee_badge_types.php';}
		);

		// Teams ------------------------------------------------------------------------------------------------------.
		add_menu_page(
			esc_attr__( 'SE', 'dase' ),
			esc_attr__( 'SE Teams', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_teams' ),
			$this->shared->get( 'slug' ) . '-teams',
			function () {
				include_once 'view/teams.php';},
			'none'
		);

		$this->screen_id_teams = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Teams', 'dase' ),
			esc_attr__( 'Teams', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_teams' ),
			$this->shared->get( 'slug' ) . '-teams',
			function () {
				include_once 'view/teams.php';}
		);

		$this->screen_id_squads = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Squads', 'dase' ),
			esc_attr__( 'Squads', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_squads' ),
			$this->shared->get( 'slug' ) . '-squads',
			function () {
				include_once 'view/squads.php';}
		);

		$this->screen_id_formations = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Formations', 'dase' ),
			esc_attr__( 'Formations', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_formations' ),
			$this->shared->get( 'slug' ) . '-formations',
			function () {
				include_once 'view/formations.php';}
		);

		$this->screen_id_jersey_sets = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Jersey Sets', 'dase' ),
			esc_attr__( 'Jersey Sets', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_jersey_sets' ),
			$this->shared->get( 'slug' ) . '-jersey-sets',
			function () {
				include_once 'view/jersey_sets.php';}
		);

		$this->screen_id_stadiums = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Stadiums', 'dase' ),
			esc_attr__( 'Stadiums', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_stadiums' ),
			$this->shared->get( 'slug' ) . '-stadiums',
			function () {
				include_once 'view/stadiums.php';}
		);

		$this->screen_id_trophies = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Trophies', 'dase' ),
			esc_attr__( 'Trophies', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_trophies' ),
			$this->shared->get( 'slug' ) . '-trophies',
			function () {
				include_once 'view/trophies.php';}
		);

		$this->screen_id_trophy_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Trophy Types', 'dase' ),
			esc_attr__( 'Trophy Types', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_trophy_types' ),
			$this->shared->get( 'slug' ) . '-trophy-types',
			function () {
				include_once 'view/trophy_types.php';}
		);

		$this->screen_id_ranking_transitions = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Ranking Transitions', 'dase' ),
			esc_attr__( 'Ranking Transitions', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_ranking_transitions' ),
			$this->shared->get( 'slug' ) . '-ranking-transitions',
			function () {
				include_once 'view/ranking_transitions.php';}
		);

		$this->screen_id_ranking_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Ranking Types', 'dase' ),
			esc_attr__( 'Ranking Types', 'dase' ),
			get_option( $this->shared->get( 'slug' ) . '_capability_menu_ranking_types' ),
			$this->shared->get( 'slug' ) . '-ranking-types',
			function () {
				include_once 'view/ranking_types.php';}
		);

		// Options ----------------------------------------------------------------------------------------------------.
		add_menu_page(
			esc_attr__( 'SE', 'dase' ),
			esc_attr__( 'SE Settings', 'dase' ),
			'manage_options',
			$this->shared->get( 'slug' ) . '-import',
			function () {
				include_once 'view/import.php';},
			'none'
		);

		$this->screen_id_import = add_submenu_page(
			$this->shared->get( 'slug' ) . '-import',
			esc_attr__( 'SE - Import', 'dase' ),
			esc_attr__( 'Import', 'dase' ),
			'manage_options',
			$this->shared->get( 'slug' ) . '-import',
			function () {
				include_once 'view/import.php';}
		);

		$this->screen_id_export = add_submenu_page(
			$this->shared->get( 'slug' ) . '-import',
			esc_attr__( 'SE - Export', 'dase' ),
			esc_attr__( 'Export', 'dase' ),
			'manage_options',
			$this->shared->get( 'slug' ) . '-export',
			function () {
				include_once 'view/export.php';}
		);

		$this->screen_id_maintenance = add_submenu_page(
			$this->shared->get( 'slug' ) . '-import',
			esc_attr__( 'SE - Maintenance', 'dase' ),
			esc_attr__( 'Maintenance', 'dase' ),
			'manage_options',
			$this->shared->get( 'slug' ) . '-maintenance',
			function () {
				include_once 'view/maintenance.php';}
		);

		$this->screen_id_help = add_submenu_page(
			$this->shared->get( 'slug' ) . '-import',
			esc_attr__( 'SE - Help', 'dase' ),
			esc_attr__( 'Help', 'dase' ),
			'manage_options',
			$this->shared->get( 'slug' ) . '-help',
			function () {
				include_once 'view/help.php';}
		);

		$this->screen_id_options = add_submenu_page(
			$this->shared->get( 'slug' ) . '-import',
			esc_attr__( 'SE - Options', 'dase' ),
			esc_attr__( 'Options', 'dase' ),
			'manage_options',
			$this->shared->get( 'slug' ) . '-options',
			function () {
				include_once 'view/options.php';}
		);
	}

	/**
	 * Register options.
	 */
	public function op_register_options() {

		require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-options.php';
		new Dase_Menu_Options( $this->shared );
	}

	/**
	 * Generates the XML file with included all the plugin data.
	 *
	 * Note that the XML file is served when the "Export" button available in the "Export" menu is clicked.
	 */
	public function export_xml_controller() {

		/*
		 * Intercept requests that come from the "Export" button of the
		 * "Soccer Engine -> Export" menu and generate the downloadable XML file
		 */
		if ( isset( $_POST['dase_export'] ) ) {

			// verify capability
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_attr__( 'You do not have sufficient permissions to access this page.' ) );
			}

			// generate the header of the XML file.
			header( 'Content-Encoding: UTF-8' );
			header( 'Content-type: text/xml; charset=UTF-8' );
			header( 'Content-Disposition: attachment; filename=soccer-engine-' . time() . '.xml' );
			header( 'Pragma: no-cache' );
			header( 'Expires: 0' );

			// generate initial part of the XML file.
			$out  = '<?xml version="1.0" encoding="UTF-8" ?>';
			$out .= '<root>';

			global $wpdb;
			foreach ( $this->shared->get( 'database_tables' ) as $key => $database_table ) {

				// get the data from the db.
				$record_a = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . $this->shared->get( 'slug' ) . '_' . $database_table['name'] . ' ORDER BY ' . $database_table['sort_by'] . ' ASC', ARRAY_A );

				// if there are data generate the csv header and the content.
				if ( count( $record_a ) > 0 ) {

					$out .= '<' . $database_table['name'] . '>';

					// set column content.
					foreach ( $record_a as $record ) {

						$out .= '<record>';

						// get all the indexes of the $table array.
						$index_keys = array_keys( $record );

						// cycle through all the indexes of $table and create all the tags related to this record.
						foreach ( $index_keys as $index ) {

							$out .= '<' . $index . '>' . esc_attr( $record[ $index ] ) . '</' . $index . '>';

						}

						$out .= '</record>';

					}

					$out .= '</' . $database_table['name'] . '>';

				}
			}

			// generate the final part of the XML file.
			$out .= '</root>';

			echo $out;
			die();

		}
	}

	/**
	 * Generate the custom-[blog_id].css file based on the plugin options.
	 */
	public function write_custom_css() {

		// turn on output buffering.
		ob_start();

		?>

		/* Table Header Background Color */
		<?php $table_header_background_color = get_option( $this->shared->get( 'slug' ) . '_table_header_background_color' ); ?>
		.dase-paginated-table-container table thead th,
		.dase-match-timeline-title,
		.dase-match-commentary-title,
		.dase-match-visual-lineup-left-header,
		.dase-match-visual-lineup-right-header,
		.dase-match-score-header,
		.dase-person-summary-content-title
		{background: <?php echo esc_attr( $table_header_background_color ); ?> !important;}

		/* Table Header Border Color */
		<?php $table_header_border_color = get_option( $this->shared->get( 'slug' ) . '_table_header_border_color' ); ?>
		.dase-paginated-table-container table thead th,
		.dase-match-timeline-title,
		.dase-match-commentary-title,
		.dase-match-visual-lineup-left-header,
		.dase-match-visual-lineup-right-header,
		.dase-match-score-header,
		.dase-person-summary-content-title
		{border-color: <?php echo esc_attr( $table_header_border_color ); ?> !important;}

		/* Table Header Font Color */
		<?php $table_header_font_color = get_option( $this->shared->get( 'slug' ) . '_table_header_font_color' ); ?>
		.dase-paginated-table-container table thead th,
		.dase-match-timeline-title,
		.dase-match-commentary-title,
		.dase-match-visual-lineup-left-header,
		.dase-match-visual-lineup-right-header,
		.dase-match-score-header,
		.dase-person-summary-content-title
		{color: <?php echo esc_attr( $table_header_font_color ); ?> !important;}

		/* Table Body Background Color */
		<?php $table_body_background_color = get_option( $this->shared->get( 'slug' ) . '_table_body_background_color' ); ?>
		.dase-paginated-table-container table tbody td,
		.dase-match-timeline-content-row,
		.dase-match-commentary-content,
		.dase-match-visual-lineup-right table td,
		.dase-match-score-body,
		.dase-person-summary-content-wrapper
		{background: <?php echo esc_attr( $table_body_background_color ); ?> !important;}

		/* Table Body Border Color */
		<?php $table_body_border_color = get_option( $this->shared->get( 'slug' ) . '_table_body_border_color' ); ?>
		.dase-paginated-table-container table tbody td,
		.dase-match-timeline-content-row,
		.dase-match-commentary-content,
		.dase-match-commentary-event-data,
		.dase-match-commentary-row,
		.dase-match-visual-lineup-right table td,
		.dase-match-score-body
		{border-color: <?php echo esc_attr( $table_body_border_color ); ?> !important;}

		/* Table Body Font Color */
		<?php $table_body_font_color = get_option( $this->shared->get( 'slug' ) . '_table_body_font_color' ); ?>
		.dase-paginated-table-container table tbody td,
		.dase-match-timeline-player-name,
		.dase-match-timeline-description,
		.dase-match-visual-lineup-right table td,
		.dase-match-score-body,
		.dase-match-commentary-event-time-top,
		.dase-match-commentary-event-description,
		.dase-match-commentary-event-details-row,
		.dase-match-score-body-team-1-name,
		.dase-match-score-body-team-1-position,
		.dase-match-score-body-match-result,
		.dase-match-score-body-team-2-name,
		.dase-match-score-body-team-2-position,
		.dase-person-summary-information-item-field,
		.dase-person-summary-information-item-value
		{color: <?php echo esc_attr( $table_body_font_color ); ?> !important;}

		/* Table Pagination Background Color */
		<?php $table_pagination_background_color = get_option( $this->shared->get( 'slug' ) . '_table_pagination_background_color' ); ?>
		.dase-paginated-table-pagination .dase-paginated-table-pagination-inner > a
		{background: <?php echo esc_attr( $table_pagination_background_color ); ?> !important;}

		/* Table Pagination Border Color */
		<?php $table_pagination_border_color = get_option( $this->shared->get( 'slug' ) . '_table_pagination_border_color' ); ?>
		.dase-paginated-table-pagination .dase-paginated-table-pagination-inner > a
		{border-color: <?php echo esc_attr( $table_pagination_border_color ); ?> !important;}

		/* Table Pagination Font Color */
		<?php $table_pagination_font_color = get_option( $this->shared->get( 'slug' ) . '_table_pagination_font_color' ); ?>
		.dase-paginated-table-pagination .dase-paginated-table-pagination-inner > a,
		.dase-paginated-table-pagination .dase-paginated-table-pagination-inner > span
		{color: <?php echo esc_attr( $table_pagination_font_color ); ?> !important;}



		/* Table Pagination Disabled Background Color */
		<?php $table_pagination_disabled_background_color = get_option( $this->shared->get( 'slug' ) . '_table_pagination_disabled_background_color' ); ?>
		.dase-paginated-table-pagination .dase-paginated-table-pagination-inner > a.disabled
		{background: <?php echo esc_attr( $table_pagination_disabled_background_color ); ?> !important;}

		/* Table Pagination Disabled Border Color */
		<?php $table_pagination_disabled_border_color = get_option( $this->shared->get( 'slug' ) . '_table_pagination_disabled_border_color' ); ?>
		.dase-paginated-table-pagination .dase-paginated-table-pagination-inner > a.disabled
		{border-color: <?php echo esc_attr( $table_pagination_disabled_border_color ); ?> !important;}

		/* Table Pagination Disabled Font Color */
		<?php $table_pagination_disabled_font_color = get_option( $this->shared->get( 'slug' ) . '_table_pagination_disabled_font_color' ); ?>
		.dase-paginated-table-pagination .dase-paginated-table-pagination-inner > a.disabled
		{color: <?php echo esc_attr( $table_pagination_disabled_font_color ); ?> !important;}

		/* Formation Field Player Number Background Color */
		<?php $formation_field_player_number_background_color = get_option( $this->shared->get( 'slug' ) . '_formation_field_player_number_background_color' ); ?>
		.dase-match-visual-lineup-left-formation-player-jersey-number
		{background: <?php echo esc_attr( $formation_field_player_number_background_color ); ?> !important;}

		/* Formation Field Player Number Border Color */
		<?php $formation_field_player_number_border_color = get_option( $this->shared->get( 'slug' ) . '_formation_field_player_number_border_color' ); ?>
		.dase-match-visual-lineup-left-formation-player-jersey-number
		{border-color: <?php echo esc_attr( $formation_field_player_number_border_color ); ?> !important;}

		/* Formation Field Player Number Font Color */
		<?php $formation_field_player_number_font_color = get_option( $this->shared->get( 'slug' ) . '_formation_field_player_number_font_color' ); ?>
		.dase-match-visual-lineup-left-formation-player-jersey-number
		{color: <?php echo esc_attr( $formation_field_player_number_font_color ); ?> !important;}

		/* Formation Field Player Name Font Color */
		<?php $formation_field_player_name_font_color = get_option( $this->shared->get( 'slug' ) . '_formation_field_player_name_font_color' ); ?>
		.dase-match-visual-lineup-left-formation-player-name
		{color: <?php echo esc_attr( $formation_field_player_name_font_color ); ?> !important;}

		/* Block Margin Top */

		.dase-paginated-table-container,
		.dase-line-chart,
		.dase-match-timeline,
		.dase-match-commentary,
		.dase-match-score,
		.dase-person-summary,
		.dase-match-visual-lineup{
		<?php $block_margin_top = get_option( $this->shared->get( 'slug' ) . '_block_margin_top' ); ?>
		margin-top: <?php echo intval( $block_margin_top, 10 ); ?>px !important;
		<?php $block_margin_bottom = get_option( $this->shared->get( 'slug' ) . '_block_margin_bottom' ); ?>
		margin-bottom: <?php echo intval( $block_margin_bottom, 10 ); ?>px !important;
		}

		<?php

		$responsive_breakpoint_1 = get_option( $this->shared->get( 'slug' ) . '_responsive_breakpoint_1' );
		$responsive_breakpoint_2 = get_option( $this->shared->get( 'slug' ) . '_responsive_breakpoint_2' );

		?>

		/* Breakpoint 1 */
		@media screen and (min-width: <?php echo intval( $responsive_breakpoint_2, 10 ) + 1; ?>px) and (max-width: <?php echo intval( $responsive_breakpoint_1, 10 ); ?>px){

		/* Paginated Table -------------------------------------------------------------------------------------- */
		.dase-paginated-table-container [data-breakpoint-1-hidden="1"]{
		display: none !important;
		}

		/* Match Timeline --------------------------------------------------------------------------------------- */
		.dase-match-timeline-content-clock{
		order: 1 !important;
		}

		.dase-match-timeline-content-team-1-logo,
		.dase-match-timeline-content-team-2-logo{
		order: 2 !important;;
		flex-basis: 50px !important;
		}

		.dase-match-timeline-content-team-1-player,
		.dase-match-timeline-content-team-2-player{
		order: 3 !important;;
		flex-basis: calc(100% - 110px) !important;
		}

		.dase-match-timeline-player-container-team-1-image{
		flex-basis: 40px !important;
		order: 1 !important;
		margin: 0 10px 0 0 !important;
		}

		.dase-match-timeline-content-team-1-logo img,
		.dase-match-timeline-content-team-1-logo svg{
		margin: 0 10px 0 0 !important;
		}

		.dase-match-timeline-player-container-team-1 .dase-match-timeline-player-name,
		.dase-match-timeline-player-container-team-1 .dase-match-timeline-description{
		text-align: left !important;
		}

		.dase-match-timeline-player-container-team-1-content{
		flex-basis: calc(100% - 50px) !important;
		order: 2 !important;
		}

		.dase-match-timeline-content-team-1-player-empty,
		.dase-match-timeline-content-team-2-player-empty,
		.dase-match-timeline-content-team-1-logo-empty,
		.dase-match-timeline-content-team-2-logo-empty{
		display: none !important;
		}

		/* Match Score ------------------------------------------------------------------------------------------ */
		.dase-match-score-body-info,
		.dase-match-score-body-additional-info-stadium-attendance,
		.dase-match-score-body-additional-info-referee{
		display: none !important;
		}

		.dase-match-score-body-result{
		margin: 0 !important;
		}

		.dase-match-score-body-team-1-logo,
		.dase-match-score-body-team-2-logo{
		flex-basis: 40px !important;
		height: 40px !important;
		}

		.dase-match-score-body-team-1-logo img, .dase-match-score-body-team-1-logo svg,
		.dase-match-score-body-team-2-logo img, .dase-match-score-body-team-2-logo svg{
		height: 40px !important;
		min-width: 40px !important;
		}

		.dase-match-score-body-team-1-details,
		.dase-match-score-body-team-2-details {
		flex-basis: calc(100% - 40px) !important;
		min-height: 40px !important;
		height: auto !important;
		}

		.dase-match-score-body-match-result{
		line-height: 24px !important;
		height: auto !important;
		font-size: 11px !important;
		font-weight: 700 !important;
		margin: 8px 0 8px 0 !important;
		}

		.dase-match-score-body-team-1-name,
		.dase-match-score-body-team-2-name{
		height: auto !important;
		font-size: 11px !important;
		line-height: 14px !important;
		min-height: 14px !important;
		margin: 13px 0 13px 0 !important;
		}

		.dase-match-score-body-team-1,
		.dase-match-score-body-team-2{
		flex-basis: calc( 50% - 24px ) !important;
		}

		.dase-match-score-body-center{
		flex-basis: 48px !important;
		}

		/* Person Summary --------------------------------------------------------------------------------------- */
		.dase-person-summary-image{
		display: none !important;
		}

		.dase-person-summary-information {
		flex-basis: 100% !important;
		display: flex !important;
		flex-direction: column !important;
		}

		/* Match Visual Lineup ---------------------------------------------------------------------------------- */
		.dase-match-visual-lineup{
		flex-direction: column !important;
		}

		.dase-match-visual-lineup-left,
		.dase-match-visual-lineup-right{
		flex-basis: 100% !important;
		}

		}

		/* Breakpoint 2 */
		@media screen and (max-width: <?php echo intval( $responsive_breakpoint_2, 10 ); ?>px) {

		/* Paginated Table -------------------------------------------------------------------------------------- */
		.dase-paginated-table-container [data-breakpoint-2-hidden="1"]{
		display: none !important;
		}

		/* Match Timeline --------------------------------------------------------------------------------------- */
		.dase-match-timeline-content-clock{
		order: 1 !important;
		}

		.dase-match-timeline-content-team-1-logo,
		.dase-match-timeline-content-team-2-logo{
		display: none !important;
		}

		.dase-match-timeline-content-team-1-player,
		.dase-match-timeline-content-team-2-player{
		order: 2;
		flex-basis: calc(100% - 60px) !important;
		}

		.dase-match-timeline-player-container-team-1-image,
		.dase-match-timeline-player-container-team-2-image{
		display: none !important;
		}

		.dase-match-timeline-player-container-team-1 .dase-match-timeline-player-name,
		.dase-match-timeline-player-container-team-1 .dase-match-timeline-description{
		text-align: left !important;
		}

		.dase-match-timeline-content-row-cell{
		min-height: 40px !important;
		height: auto !important;
		}

		.dase-match-timeline-player-container-team-1-content{
		flex-basis: calc(100% - 50px) !important;
		order: 2 !important;
		}

		.dase-match-timeline-content-team-1-player-empty,
		.dase-match-timeline-content-team-2-player-empty,
		.dase-match-timeline-content-team-1-logo-empty,
		.dase-match-timeline-content-team-2-logo-empty{
		display: none !important;
		}

		/* Match Commentary ------------------------------------------------------------------------------------- */
		.dase-match-commentary-event-details-left{
		display: none !important;
		}

		.dase-match-commentary-event-details-right {
		width: 100% !important;
		}

		/* Match Score ------------------------------------------------------------------------------------------ */
		.dase-match-score-body-info,
		.dase-match-score-body-additional-info-stadium-attendance,
		.dase-match-score-body-additional-info-referee{
		display: none !important;
		}

		.dase-match-score-body-team-1-logo,
		.dase-match-score-body-team-2-logo{
		flex-basis: 40px !important;
		height: 40px !important;
		}

		.dase-match-score-body-team-1-logo img, .dase-match-score-body-team-1-logo svg,
		.dase-match-score-body-team-2-logo img, .dase-match-score-body-team-2-logo svg{
		height: 40px !important;
		min-width: 40px !important;
		}

		.dase-match-score-body-team-1-details,
		.dase-match-score-body-team-2-details{
		flex-basis: calc(100% - 40px) !important;
		min-height: 40px !important;
		height: auto !important;
		}

		.dase-match-score-body-match-result{
		line-height: 24px !important;
		height: auto !important;
		font-size: 11px !important;
		font-weight: 700 !important;
		margin: 8px 0 8px 0 !important;
		}

		.dase-match-score-body-team-1-name,
		.dase-match-score-body-team-2-name{
		height: auto !important;
		font-size: 11px !important;
		line-height: 14px !important;
		min-height: 14px !important;
		margin: 13px 0 13px 0 !important;
		}

		.dase-match-score-body-team-1,
		.dase-match-score-body-team-2{
		flex-basis: calc( 50% - 24px ) !important;
		}

		.dase-match-score-body-center{
		flex-basis: 48px !important;
		}

		.dase-match-score-body-result{
		margin: 0 !important;
		}

		.dase-match-score-body-team-1-logo,
		.dase-match-score-body-team-2-logo{
		display: none !important;
		}

		.dase-match-score-body-team-1-details,
		.dase-match-score-body-team-2-details{
		flex-basis: calc(100%) !important;
		padding: 0 !important;
		}

		/* Person Summary --------------------------------------------------------------------------------------- */
		.dase-person-summary-image{
		display: none !important;
		}

		.dase-person-summary-information {
		flex-basis: 100% !important;
		display: flex !important;
		flex-direction: column !important;
		}

		/* Match Visual Lineup ---------------------------------------------------------------------------------- */
		.dase-match-visual-lineup{
		flex-direction: column !important;
		}

		.dase-match-visual-lineup-left,
		.dase-match-visual-lineup-right{
		flex-basis: 100% !important;
		}

		}
		/* Font Family */
		<?php $font_family = get_option( $this->shared->get( 'slug' ) . '_font_family' ); ?>
		.dase-paginated-table-container *,
		.dase-no-data-paragraph *,
		.dase-match-timeline *,
		.dase-match-commentary *,
		.dase-match-visual-lineup *,
		.dase-match-score *,
		.dase-person-summary *
		{font-family: <?php echo $font_family; ?> !important;}

		<?php

		$custom_css_string = ob_get_clean();

		// Get the upload directory path and the file path.
		$upload_dir_path  = $this->get_plugin_upload_path();
		$upload_file_path = $this->get_plugin_upload_path() . 'custom-' . get_current_blog_id() . '.css';

		// If the plugin upload directory doesn't exist create it.
		if ( ! is_dir( $upload_dir_path ) ) {
			mkdir( $upload_dir_path );
		}

		// Write the custom css file.
		return @file_put_contents(
			$upload_file_path,
			$custom_css_string,
			LOCK_EX
		);
	}

	/**
	 * Get the plugin upload path.
	 *
	 * @return string The plugin upload path
	 */
	public function get_plugin_upload_path() {

		$upload_path = WP_CONTENT_DIR . '/uploads/dase_uploads/';

		return $upload_path;
	}
}
