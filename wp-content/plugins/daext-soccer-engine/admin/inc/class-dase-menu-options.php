<?php
/**
 * This class adds the options with the related callbacks and validations.
 *
 * @package daext-soccer-engine
 */

/**
 * This class adds the options with the related callbacks and validations.
 */
class Dase_Menu_Options {

	private $shared = null;

	public function __construct( $shared ) {

		// assign an instance of the plugin info.
		$this->shared = $shared;

		// Style Section ----------------------------------------------------------------------------------------------.
		add_settings_section(
			'dase_colors_settings_section',
			null,
			null,
			'dase_colors_options'
		);

		add_settings_field(
			'table_header_background_color',
			esc_attr__( 'Table Header Background Color', 'dase' ),
			array( $this, 'table_header_background_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_table_header_background_color',
			array( $this, 'table_header_background_color_validation' )
		);

		add_settings_field(
			'table_header_border_color',
			esc_attr__( 'Table Header Border Color', 'dase' ),
			array( $this, 'table_header_border_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_table_header_border_color',
			array( $this, 'table_header_border_color_validation' )
		);

		add_settings_field(
			'table_header_font_color',
			esc_attr__( 'Table Header Font Color', 'dase' ),
			array( $this, 'table_header_font_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_table_header_font_color',
			array( $this, 'table_header_font_color_validation' )
		);

		add_settings_field(
			'table_body_background_color',
			esc_attr__( 'Table Body Background Color', 'dase' ),
			array( $this, 'table_body_background_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_table_body_background_color',
			array( $this, 'table_body_background_color_validation' )
		);

		add_settings_field(
			'table_body_border_color',
			esc_attr__( 'Table Body Border Color', 'dase' ),
			array( $this, 'table_body_border_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_table_body_border_color',
			array( $this, 'table_body_border_color_validation' )
		);

		add_settings_field(
			'table_body_font_color',
			esc_attr__( 'Table Body Font Color', 'dase' ),
			array( $this, 'table_body_font_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_table_body_font_color',
			array( $this, 'table_body_font_color_validation' )
		);

		add_settings_field(
			'table_pagination_background_color',
			esc_attr__( 'Table Pagination Background Color', 'dase' ),
			array( $this, 'table_pagination_background_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_table_pagination_background_color',
			array( $this, 'table_pagination_background_color_validation' )
		);

		add_settings_field(
			'table_pagination_border_color',
			esc_attr__( 'Table Pagination Border Color', 'dase' ),
			array( $this, 'table_pagination_border_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_table_pagination_border_color',
			array( $this, 'table_pagination_border_color_validation' )
		);

		add_settings_field(
			'table_pagination_font_color',
			esc_attr__( 'Table Pagination Font Color', 'dase' ),
			array( $this, 'table_pagination_font_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_table_pagination_font_color',
			array( $this, 'table_pagination_font_color_validation' )
		);

		add_settings_field(
			'table_pagination_disabled_background_color',
			esc_attr__( 'Table Pagination Disabled Background Color', 'dase' ),
			array( $this, 'table_pagination_disabled_background_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_table_pagination_disabled_background_color',
			array( $this, 'table_pagination_disabled_background_color_validation' )
		);

		add_settings_field(
			'table_pagination_disabled_border_color',
			esc_attr__( 'Table Pagination Disabled Border Color', 'dase' ),
			array( $this, 'table_pagination_disabled_border_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_table_pagination_disabled_border_color',
			array( $this, 'table_pagination_disabled_border_color_validation' )
		);

		add_settings_field(
			'table_pagination_disabled_font_color',
			esc_attr__( 'Table Pagination Disabled Font Color', 'dase' ),
			array( $this, 'table_pagination_disabled_font_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_table_pagination_disabled_font_color',
			array( $this, 'table_pagination_disabled_font_color_validation' )
		);

		add_settings_field(
			'line_chart_dataset_line_color',
			esc_attr__( 'Line Chart Dataset Line Color', 'dase' ),
			array( $this, 'line_chart_dataset_line_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_line_chart_dataset_line_color',
			array( $this, 'line_chart_dataset_line_color_validation' )
		);

		add_settings_field(
			'line_chart_dataset_background_color',
			esc_attr__( 'Line Chart Dataset Background Color', 'dase' ),
			array( $this, 'line_chart_dataset_background_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_line_chart_dataset_background_color',
			array( $this, 'line_chart_dataset_background_color_validation' )
		);

		add_settings_field(
			'line_chart_font_color',
			esc_attr__( 'Line Chart Font Color', 'dase' ),
			array( $this, 'line_chart_font_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_line_chart_font_color',
			array( $this, 'line_chart_font_color_validation' )
		);

		add_settings_field(
			'line_chart_tooltips_background_color',
			esc_attr__( 'Line Chart Tooltips Background Color', 'dase' ),
			array( $this, 'line_chart_tooltips_background_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_line_chart_tooltips_background_color',
			array( $this, 'line_chart_tooltips_background_color_validation' )
		);

		add_settings_field(
			'line_chart_tooltips_font_color',
			esc_attr__( 'Line Chart Tooltips Font Color', 'dase' ),
			array( $this, 'line_chart_tooltips_font_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_line_chart_tooltips_font_color',
			array( $this, 'line_chart_tooltips_font_color_validation' )
		);

		add_settings_field(
			'line_chart_gridlines_color',
			esc_attr__( 'Line Chart Gridlines Color', 'dase' ),
			array( $this, 'line_chart_gridlines_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_line_chart_gridlines_color',
			array( $this, 'line_chart_gridlines_color_validation' )
		);

		add_settings_field(
			'formation_field_background_color',
			esc_attr__( 'Formation Field Background Color', 'dase' ),
			array( $this, 'formation_field_background_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_formation_field_background_color',
			array( $this, 'formation_field_background_color_validation' )
		);

		add_settings_field(
			'formation_field_line_color',
			esc_attr__( 'Formation Field Line Color', 'dase' ),
			array( $this, 'formation_field_line_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_formation_field_line_color',
			array( $this, 'formation_field_line_color_validation' )
		);

		add_settings_field(
			'formation_field_player_number_background_color',
			esc_attr__( 'Formation Player Number Background Color', 'dase' ),
			array( $this, 'formation_field_player_number_background_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_formation_field_player_number_background_color',
			array( $this, 'formation_field_player_number_background_color_validation' )
		);

		add_settings_field(
			'formation_field_player_number_border_color',
			esc_attr__( 'Formation Player Number Border Color', 'dase' ),
			array( $this, 'formation_field_player_number_border_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_formation_field_player_number_border_color',
			array( $this, 'formation_field_player_number_border_color_validation' )
		);

		add_settings_field(
			'formation_field_player_number_font_color',
			esc_attr__( 'Formation Player Number Font Color', 'dase' ),
			array( $this, 'formation_field_player_number_font_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_formation_field_player_number_font_color',
			array( $this, 'formation_field_player_number_font_color_validation' )
		);

		add_settings_field(
			'formation_field_player_name_font_color',
			esc_attr__( 'Formation Player Name Font Color', 'dase' ),
			array( $this, 'formation_field_player_name_font_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_formation_field_player_name_font_color',
			array( $this, 'formation_field_player_name_font_color_validation' )
		);

		add_settings_field(
			'clock_background_color',
			esc_attr__( 'Clock Background Color', 'dase' ),
			array( $this, 'clock_background_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_clock_background_color',
			array( $this, 'clock_background_color_validation' )
		);

		add_settings_field(
			'clock_primary_ticks_color',
			esc_attr__( 'Clock Primary Ticks Color', 'dase' ),
			array( $this, 'clock_primary_ticks_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_clock_primary_ticks_color',
			array( $this, 'clock_primary_ticks_color_validation' )
		);

		add_settings_field(
			'clock_secondary_ticks_color',
			esc_attr__( 'Clock Secondary Ticks Color', 'dase' ),
			array( $this, 'clock_secondary_ticks_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_clock_secondary_ticks_color',
			array( $this, 'clock_secondary_ticks_color_validation' )
		);

		add_settings_field(
			'clock_border_color',
			esc_attr__( 'Clock Border Color', 'dase' ),
			array( $this, 'clock_border_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_clock_border_color',
			array( $this, 'clock_border_color_validation' )
		);

		add_settings_field(
			'clock_overlay_color',
			esc_attr__( 'Clock Overlay Color', 'dase' ),
			array( $this, 'clock_overlay_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_clock_overlay_color',
			array( $this, 'clock_overlay_color_validation' )
		);

		add_settings_field(
			'clock_extra_time_overlay_color',
			esc_attr__( 'Clock Extra Time Overlay Color', 'dase' ),
			array( $this, 'clock_extra_time_overlay_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_clock_extra_time_overlay_color',
			array( $this, 'clock_extra_time_overlay_color_validation' )
		);

		add_settings_field(
			'event_icon_goal_color',
			esc_attr__( 'Event Icon Goal Color', 'dase' ),
			array( $this, 'event_icon_goal_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_event_icon_goal_color',
			array( $this, 'event_icon_goal_color_validation' )
		);

		add_settings_field(
			'event_icon_yellow_card_color',
			esc_attr__( 'Event Icon Yellow Card Color', 'dase' ),
			array( $this, 'event_icon_yellow_card_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_event_icon_yellow_card_color',
			array( $this, 'event_icon_yellow_card_color_validation' )
		);

		add_settings_field(
			'event_icon_red_card_color',
			esc_attr__( 'Event Icon Red Card Color', 'dase' ),
			array( $this, 'event_icon_red_card_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_event_icon_red_card_color',
			array( $this, 'event_icon_red_card_color_validation' )
		);

		add_settings_field(
			'event_icon_substitution_left_arrow_color',
			esc_attr__( 'Event Icon Substitution Left Arrow Color', 'dase' ),
			array( $this, 'event_icon_substitution_left_arrow_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_event_icon_substitution_left_arrow_color',
			array( $this, 'event_icon_substitution_left_arrow_color_validation' )
		);

		add_settings_field(
			'event_icon_substitution_right_arrow_color',
			esc_attr__( 'Event Icon Substitution Right Arrow Color', 'dase' ),
			array( $this, 'event_icon_substitution_right_arrow_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_event_icon_substitution_right_arrow_color',
			array( $this, 'event_icon_substitution_right_arrow_color_validation' )
		);

		add_settings_field(
			'default_avatar_color',
			esc_attr__( 'Default Avatar Color', 'dase' ),
			array( $this, 'default_avatar_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_default_avatar_color',
			array( $this, 'default_avatar_color_validation' )
		);

		add_settings_field(
			'default_avatar_background_color',
			esc_attr__( 'Default Avatar Background Color', 'dase' ),
			array( $this, 'default_avatar_background_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_default_avatar_background_color',
			array( $this, 'default_avatar_background_color_validation' )
		);

		add_settings_field(
			'default_team_logo_color',
			esc_attr__( 'Default Team Logo Color', 'dase' ),
			array( $this, 'default_team_logo_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_default_team_logo_color',
			array( $this, 'default_team_logo_color_validation' )
		);

		add_settings_field(
			'default_team_logo_background_color',
			esc_attr__( 'Default Team Logo Background Color', 'dase' ),
			array( $this, 'default_team_logo_background_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_default_team_logo_background_color',
			array( $this, 'default_team_logo_background_color_validation' )
		);

		add_settings_field(
			'default_competition_logo_color',
			esc_attr__( 'Default Competition Logo Color', 'dase' ),
			array( $this, 'default_competition_logo_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_default_competition_logo_color',
			array( $this, 'default_competition_logo_color_validation' )
		);

		add_settings_field(
			'default_competition_logo_background_color',
			esc_attr__( 'Default Competition Logo Background Color', 'dase' ),
			array( $this, 'default_competition_logo_background_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_default_competition_logo_background_color',
			array( $this, 'default_competition_logo_background_color_validation' )
		);

		add_settings_field(
			'default_trophy_type_logo_color',
			esc_attr__( 'Default Trophy Type Logo Color', 'dase' ),
			array( $this, 'default_trophy_type_logo_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_default_trophy_type_logo_color',
			array( $this, 'default_trophy_type_logo_color_validation' )
		);

		add_settings_field(
			'default_trophy_type_logo_background_color',
			esc_attr__( 'Default Trophy Type Logo Background Color', 'dase' ),
			array( $this, 'default_trophy_type_logo_background_color_callback' ),
			'dase_colors_options',
			'dase_colors_settings_section'
		);

		register_setting(
			'dase_colors_options',
			'dase_default_trophy_type_logo_background_color',
			array( $this, 'default_trophy_type_logo_background_color_validation' )
		);

		// Capabilities Section ---------------------------------------------------------------------------------------.
		add_settings_section(
			'dase_capabilities_settings_section',
			null,
			null,
			'dase_capabilities_options'
		);

		add_settings_field(
			'capability_menu_players',
			esc_attr__( 'Menu Players', 'dase' ),
			array( $this, 'capability_menu_players_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_players',
			array( $this, 'capability_menu_players_validation' )
		);

		add_settings_field(
			'capability_menu_player_positions',
			esc_attr__( 'Menu Player Positions', 'dase' ),
			array( $this, 'capability_menu_player_positions_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_player_positions',
			array( $this, 'capability_menu_player_positions_validation' )
		);

		add_settings_field(
			'capability_menu_player_awards',
			esc_attr__( 'Menu Player Awards', 'dase' ),
			array( $this, 'capability_menu_player_awards_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_player_awards',
			array( $this, 'capability_menu_player_awards_validation' )
		);

		add_settings_field(
			'capability_menu_player_award_types',
			esc_attr__( 'Menu Player Award Types', 'dase' ),
			array( $this, 'capability_menu_player_award_types_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_player_award_types',
			array( $this, 'capability_menu_player_award_types_validation' )
		);

		add_settings_field(
			'capability_menu_unavailable_players',
			esc_attr__( 'Menu Unavailable Players', 'dase' ),
			array( $this, 'capability_menu_unavailable_players_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_unavailable_players',
			array( $this, 'capability_menu_unavailable_players_validation' )
		);

		add_settings_field(
			'capability_menu_unavailable_player_types',
			esc_attr__( 'Menu Unavailable Players Types', 'dase' ),
			array( $this, 'capability_menu_unavailable_player_types_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_unavailable_player_types',
			array( $this, 'capability_menu_unavailable_player_types_validation' )
		);

		add_settings_field(
			'capability_menu_injuries',
			esc_attr__( 'Menu Injuries', 'dase' ),
			array( $this, 'capability_menu_injuries_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_injuries',
			array( $this, 'capability_menu_injuries_validation' )
		);

		add_settings_field(
			'capability_menu_injury_types',
			esc_attr__( 'Menu Injury Types', 'dase' ),
			array( $this, 'capability_menu_injury_types_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_injury_types',
			array( $this, 'capability_menu_injury_types_validation' )
		);

		add_settings_field(
			'capability_menu_staff',
			esc_attr__( 'Menu Staff', 'dase' ),
			array( $this, 'capability_menu_staff_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_staff',
			array( $this, 'capability_menu_staff_validation' )
		);

		add_settings_field(
			'capability_menu_staff_types',
			esc_attr__( 'Menu Staff Types', 'dase' ),
			array( $this, 'capability_menu_staff_types_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_staff_types',
			array( $this, 'capability_menu_staff_types_validation' )
		);

		add_settings_field(
			'capability_menu_staff_awards',
			esc_attr__( 'Menu Staff Awards', 'dase' ),
			array( $this, 'capability_menu_staff_awards_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_staff_awards',
			array( $this, 'capability_menu_staff_awards_validation' )
		);

		add_settings_field(
			'capability_menu_staff_award_types',
			esc_attr__( 'Menu Staff Awards Types', 'dase' ),
			array( $this, 'capability_menu_staff_award_types_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_staff_award_types',
			array( $this, 'capability_menu_staff_award_types_validation' )
		);

		add_settings_field(
			'capability_menu_referees',
			esc_attr__( 'Menu Referees', 'dase' ),
			array( $this, 'capability_menu_referees_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_referees',
			array( $this, 'capability_menu_referees_validation' )
		);

		add_settings_field(
			'capability_menu_referee_badges',
			esc_attr__( 'Menu Referee Badges', 'dase' ),
			array( $this, 'capability_menu_referee_badges_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_referee_badges',
			array( $this, 'capability_menu_referee_badges_validation' )
		);

		add_settings_field(
			'capability_menu_referee_badge_types',
			esc_attr__( 'Menu Referee Badge Type', 'dase' ),
			array( $this, 'capability_menu_referee_badge_types_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_referee_badge_types',
			array( $this, 'capability_menu_referee_badge_types_validation' )
		);

		add_settings_field(
			'capability_menu_teams',
			esc_attr__( 'Menu Teams', 'dase' ),
			array( $this, 'capability_menu_teams_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_teams',
			array( $this, 'capability_menu_teams_validation' )
		);

		add_settings_field(
			'capability_menu_squads',
			esc_attr__( 'Menu Squads', 'dase' ),
			array( $this, 'capability_menu_squads_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_squads',
			array( $this, 'capability_menu_squads_validation' )
		);

		add_settings_field(
			'capability_menu_formations',
			esc_attr__( 'Menu Formations', 'dase' ),
			array( $this, 'capability_menu_formations_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_formations',
			array( $this, 'capability_menu_formations_validation' )
		);

		add_settings_field(
			'capability_menu_jersey_sets',
			esc_attr__( 'Menu Jersey Sets', 'dase' ),
			array( $this, 'capability_menu_jersey_sets_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_jersey_sets',
			array( $this, 'capability_menu_jersey_sets_validation' )
		);

		add_settings_field(
			'capability_menu_stadiums',
			esc_attr__( 'Menu Stadiums', 'dase' ),
			array( $this, 'capability_menu_stadiums_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_stadiums',
			array( $this, 'capability_menu_stadiums_validation' )
		);

		add_settings_field(
			'capability_menu_trophies',
			esc_attr__( 'Menu Trophies', 'dase' ),
			array( $this, 'capability_menu_trophies_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_trophies',
			array( $this, 'capability_menu_players_validation' )
		);

				add_settings_field(
					'capability_menu_players',
					esc_attr__( 'Menu Players', 'dase' ),
					array( $this, 'capability_menu_players_callback' ),
					'dase_capabilities_options',
					'dase_capabilities_settings_section'
				);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_players',
			array( $this, 'capability_menu_players_validation' )
		);

		add_settings_field(
			'capability_menu_trophy_types',
			esc_attr__( 'Menu Trophy Types', 'dase' ),
			array( $this, 'capability_menu_trophy_types_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_trophy_types',
			array( $this, 'capability_menu_trophy_types_validation' )
		);

		add_settings_field(
			'capability_menu_ranking_transitions',
			esc_attr__( 'Menu Ranking Transitions', 'dase' ),
			array( $this, 'capability_menu_ranking_transitions_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_ranking_transitions',
			array( $this, 'capability_menu_ranking_transitions_validation' )
		);

		add_settings_field(
			'capability_menu_ranking_types',
			esc_attr__( 'Menu Ranking Types', 'dase' ),
			array( $this, 'capability_menu_ranking_types_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_ranking_types',
			array( $this, 'capability_menu_ranking_types_validation' )
		);

		add_settings_field(
			'capability_menu_matches',
			esc_attr__( 'Menu Matches', 'dase' ),
			array( $this, 'capability_menu_matches_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_matches',
			array( $this, 'capability_menu_players_validation' )
		);

		add_settings_field(
			'capability_menu_events',
			esc_attr__( 'Menu Events', 'dase' ),
			array( $this, 'capability_menu_events_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		add_settings_field(
			'capability_menu_events_wizard',
			esc_attr__( 'Menu Events Wizard', 'dase' ),
			array( $this, 'capability_menu_events_wizard_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_events_wizard',
			array( $this, 'capability_menu_events_wizard_validation' )
		);

		add_settings_field(
			'capability_menu_competitions',
			esc_attr__( 'Menu Competitions', 'dase' ),
			array( $this, 'capability_menu_competitions_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_competitions',
			array( $this, 'capability_menu_competitions_validation' )
		);

		add_settings_field(
			'capability_menu_transfers',
			esc_attr__( 'Menu Transfers', 'dase' ),
			array( $this, 'capability_menu_transfers_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_transfers',
			array( $this, 'capability_menu_transfers_validation' )
		);

		add_settings_field(
			'capability_menu_transfer_types',
			esc_attr__( 'Menu Transfer Types', 'dase' ),
			array( $this, 'capability_menu_transfer_types_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_transfer_types',
			array( $this, 'capability_menu_transfer_types_validation' )
		);

		add_settings_field(
			'capability_menu_team_contracts',
			esc_attr__( 'Menu Team Contracts', 'dase' ),
			array( $this, 'capability_menu_team_contracts_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_team_contracts',
			array( $this, 'capability_menu_team_contracts_validation' )
		);

		add_settings_field(
			'capability_menu_team_contract_types',
			esc_attr__( 'Menu Contract Types', 'dase' ),
			array( $this, 'capability_menu_team_contract_types_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_team_contract_types',
			array( $this, 'capability_menu_team_contract_types_validation' )
		);

		add_settings_field(
			'capability_menu_agencies',
			esc_attr__( 'Menu Agencies', 'dase' ),
			array( $this, 'capability_menu_agencies_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_agencies',
			array( $this, 'capability_menu_agencies_validation' )
		);

		add_settings_field(
			'capability_menu_agency_contracts',
			esc_attr__( 'Menu Agency Contracts', 'dase' ),
			array( $this, 'capability_menu_agency_contracts_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_agency_contracts',
			array( $this, 'capability_menu_agency_contracts_validation' )
		);

		add_settings_field(
			'capability_menu_agency_contract_types',
			esc_attr__( 'Menu Agency Contract Types', 'dase' ),
			array( $this, 'capability_menu_agency_contract_types_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_agency_contract_types',
			array( $this, 'capability_menu_agency_contract_types_validation' )
		);

		add_settings_field(
			'capability_menu_market_value_transitions',
			esc_attr__( 'Menu Market Value Transitions', 'dase' ),
			array( $this, 'capability_menu_market_value_transitions_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_menu_market_value_transitions',
			array( $this, 'capability_menu_market_value_transitions_validation' )
		);

		add_settings_field(
			'capability_rest_api',
			esc_attr__( 'REST API', 'dase' ),
			array( $this, 'capability_rest_api_callback' ),
			'dase_capabilities_options',
			'dase_capabilities_settings_section'
		);

		register_setting(
			'dase_capabilities_options',
			'dase_capability_rest_api',
			array( $this, 'capability_rest_api_validation' )
		);

		// Pagination Section -----------------------------------------------------------------------------------------.
		add_settings_section(
			'dase_pagination_settings_section',
			null,
			null,
			'dase_pagination_options'
		);

		add_settings_field(
			'pagination_menu_players',
			esc_attr__( 'Menu Players', 'dase' ),
			array( $this, 'pagination_menu_players_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_players',
			array( $this, 'pagination_menu_players_validation' )
		);

		add_settings_field(
			'pagination_menu_player_positions',
			esc_attr__( 'Menu Player Positions', 'dase' ),
			array( $this, 'pagination_menu_player_positions_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_player_positions',
			array( $this, 'pagination_menu_player_positions_validation' )
		);

		add_settings_field(
			'pagination_menu_player_awards',
			esc_attr__( 'Menu Player Awards', 'dase' ),
			array( $this, 'pagination_menu_player_awards_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_player_awards',
			array( $this, 'pagination_menu_player_awards_validation' )
		);

		add_settings_field(
			'pagination_menu_unavailable_players',
			esc_attr__( 'Menu Unavailable Players', 'dase' ),
			array( $this, 'pagination_menu_unavailable_players_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_unavailable_players',
			array( $this, 'pagination_menu_unavailable_players_validation' )
		);

		add_settings_field(
			'pagination_menu_unavailable_player_types',
			esc_attr__( 'Menu Unavailable Player Types', 'dase' ),
			array( $this, 'pagination_menu_unavailable_player_types_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_unavailable_player_types',
			array( $this, 'pagination_menu_unavailable_player_types_validation' )
		);

		add_settings_field(
			'pagination_menu_injuries',
			esc_attr__( 'Menu Injuries', 'dase' ),
			array( $this, 'pagination_menu_injuries_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_injuries',
			array( $this, 'pagination_menu_injuries_validation' )
		);

		add_settings_field(
			'pagination_menu_injury_types',
			esc_attr__( 'Menu Injury Types', 'dase' ),
			array( $this, 'pagination_menu_injury_types_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_injury_types',
			array( $this, 'pagination_menu_injury_types_validation' )
		);

		add_settings_field(
			'pagination_menu_players',
			esc_attr__( 'Menu Players', 'dase' ),
			array( $this, 'pagination_menu_players_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_players',
			array( $this, 'pagination_menu_players_validation' )
		);

		add_settings_field(
			'pagination_menu_staff',
			esc_attr__( 'Menu Staff', 'dase' ),
			array( $this, 'pagination_menu_staff_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_staff',
			array( $this, 'pagination_menu_staff_validation' )
		);

		add_settings_field(
			'pagination_menu_staff_types',
			esc_attr__( 'Menu Staff Types', 'dase' ),
			array( $this, 'pagination_menu_staff_types_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_staff_types',
			array( $this, 'pagination_menu_staff_types_validation' )
		);

		add_settings_field(
			'pagination_menu_staff_awards',
			esc_attr__( 'Menu Staff Awards', 'dase' ),
			array( $this, 'pagination_menu_staff_awards_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_staff_awards',
			array( $this, 'pagination_menu_staff_awards_validation' )
		);

		add_settings_field(
			'pagination_menu_staff_award_types',
			esc_attr__( 'Menu Staff Award Types', 'dase' ),
			array( $this, 'pagination_menu_staff_award_types_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_staff_award_types',
			array( $this, 'pagination_menu_staff_award_types_validation' )
		);

		add_settings_field(
			'pagination_menu_referees',
			esc_attr__( 'Menu Referees', 'dase' ),
			array( $this, 'pagination_menu_referees_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_referees',
			array( $this, 'pagination_menu_referees_validation' )
		);

		add_settings_field(
			'pagination_menu_referee_badges',
			esc_attr__( 'Menu Referee Badges', 'dase' ),
			array( $this, 'pagination_menu_referee_badges_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_referee_badges',
			array( $this, 'pagination_menu_referee_badges_validation' )
		);

		add_settings_field(
			'pagination_menu_referee_badge_types',
			esc_attr__( 'Menu Referee Badge Types', 'dase' ),
			array( $this, 'pagination_menu_referee_badge_types_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_referee_badge_types',
			array( $this, 'pagination_menu_referee_badge_types_validation' )
		);

		add_settings_field(
			'pagination_menu_teams',
			esc_attr__( 'Menu Teams', 'dase' ),
			array( $this, 'pagination_menu_teams_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_teams',
			array( $this, 'pagination_menu_teams_validation' )
		);

		add_settings_field(
			'pagination_menu_squads',
			esc_attr__( 'Menu Squads', 'dase' ),
			array( $this, 'pagination_menu_squads_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_squads',
			array( $this, 'pagination_menu_squads_validation' )
		);

		add_settings_field(
			'pagination_menu_formations',
			esc_attr__( 'Menu Formations', 'dase' ),
			array( $this, 'pagination_menu_formations_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_formations',
			array( $this, 'pagination_menu_formations_validation' )
		);

		add_settings_field(
			'pagination_menu_stadiums',
			esc_attr__( 'Menu Stadius', 'dase' ),
			array( $this, 'pagination_menu_stadiums_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_stadiums',
			array( $this, 'pagination_menu_stadiums_validation' )
		);

		add_settings_field(
			'pagination_menu_trophies',
			esc_attr__( 'Menu Trophies', 'dase' ),
			array( $this, 'pagination_menu_trophies_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_trophies',
			array( $this, 'pagination_menu_trophies_validation' )
		);

		add_settings_field(
			'pagination_menu_trophy_types',
			esc_attr__( 'Menu Trophy Types', 'dase' ),
			array( $this, 'pagination_menu_trophy_types_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_trophy_types',
			array( $this, 'pagination_menu_trophy_types_validation' )
		);

		add_settings_field(
			'pagination_menu_ranking_transitions',
			esc_attr__( 'Menu Ranking Transitions', 'dase' ),
			array( $this, 'pagination_menu_ranking_transitions_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_ranking_transitions',
			array( $this, 'pagination_menu_ranking_transitions_validation' )
		);

		add_settings_field(
			'pagination_menu_ranking_types',
			esc_attr__( 'Menu Ranking Types', 'dase' ),
			array( $this, 'pagination_menu_ranking_types_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_ranking_types',
			array( $this, 'pagination_menu_ranking_types_validation' )
		);

		add_settings_field(
			'pagination_menu_matches',
			esc_attr__( 'Menu Matches', 'dase' ),
			array( $this, 'pagination_menu_matches_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_matches',
			array( $this, 'pagination_menu_matches_validation' )
		);

		add_settings_field(
			'pagination_menu_events',
			esc_attr__( 'Menu Events', 'dase' ),
			array( $this, 'pagination_menu_events_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_events',
			array( $this, 'pagination_menu_events_validation' )
		);

		add_settings_field(
			'pagination_menu_competitions',
			esc_attr__( 'Menu Competitions', 'dase' ),
			array( $this, 'pagination_menu_competitions_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_competitions',
			array( $this, 'pagination_menu_competitions_validation' )
		);

		add_settings_field(
			'pagination_menu_transfers',
			esc_attr__( 'Menu Transfers', 'dase' ),
			array( $this, 'pagination_menu_transfers_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_transfers',
			array( $this, 'pagination_menu_transfers_validation' )
		);

		add_settings_field(
			'pagination_menu_transfer_types',
			esc_attr__( 'Menu Transfer Types', 'dase' ),
			array( $this, 'pagination_menu_transfer_types_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_transfer_types',
			array( $this, 'pagination_menu_transfer_types_validation' )
		);

				add_settings_field(
					'pagination_menu_team_contracts',
					esc_attr__( 'Menu Team Contracts', 'dase' ),
					array( $this, 'pagination_menu_team_contracts_callback' ),
					'dase_pagination_options',
					'dase_pagination_settings_section'
				);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_team_contracts',
			array( $this, 'pagination_menu_team_contracts_validation' )
		);

		add_settings_field(
			'pagination_menu_team_contract_types',
			esc_attr__( 'Menu Team Contract Types', 'dase' ),
			array( $this, 'pagination_menu_team_contract_types_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_team_contract_types',
			array( $this, 'pagination_menu_team_contract_types_validation' )
		);

		add_settings_field(
			'pagination_menu_agencies',
			esc_attr__( 'Menu Agencies', 'dase' ),
			array( $this, 'pagination_menu_agencies_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_agencies',
			array( $this, 'pagination_menu_agencies_validation' )
		);

		add_settings_field(
			'pagination_menu_agency_contracts',
			esc_attr__( 'Menu Agency Contracts', 'dase' ),
			array( $this, 'pagination_menu_agency_contracts_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_agency_contracts',
			array( $this, 'pagination_menu_agency_contracts_validation' )
		);

		add_settings_field(
			'pagination_menu_agency_contract_types',
			esc_attr__( 'Menu Agency Contracts Types', 'dase' ),
			array( $this, 'pagination_menu_agency_contract_types_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_agency_contract_types',
			array( $this, 'pagination_menu_agency_contract_types_validation' )
		);

		add_settings_field(
			'pagination_menu_market_value_transitions',
			esc_attr__( 'Menu Market Value Transitions', 'dase' ),
			array( $this, 'pagination_menu_market_value_transitions_callback' ),
			'dase_pagination_options',
			'dase_pagination_settings_section'
		);

		register_setting(
			'dase_pagination_options',
			'dase_pagination_menu_market_value_transitions',
			array( $this, 'pagination_menu_market_value_transitions_validation' )
		);

		// Advanced Section -------------------------------------------------------------------------------------------.
		add_settings_section(
			'dase_advanced_settings_section',
			null,
			null,
			'dase_advanced_options'
		);

		add_settings_field(
			'money_format_decimal_separator',
			esc_attr__( 'Money Format Decimal Separator', 'dase' ),
			array( $this, 'money_format_decimal_separator_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_money_format_decimal_separator',
			array( $this, 'money_format_decimal_separator_validation' )
		);

		add_settings_field(
			'money_format_thousands_separator',
			esc_attr__( 'Money Format Thousands Separator', 'dase' ),
			array( $this, 'money_format_thousands_separator_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_money_format_thousands_separator',
			array( $this, 'money_format_thousands_separator_validation' )
		);

		add_settings_field(
			'money_format_decimals',
			esc_attr__( 'Money Format Decimals', 'dase' ),
			array( $this, 'money_format_decimals_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_money_format_decimals',
			array( $this, 'money_format_decimals_validation' )
		);

		add_settings_field(
			'money_format_simplify_million',
			esc_attr__( 'Money Format Simplify Million', 'dase' ),
			array( $this, 'money_format_simplify_million_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_money_format_simplify_million',
			array( $this, 'money_format_simplify_million_validation' )
		);

		add_settings_field(
			'money_format_simplify_million_decimals',
			esc_attr__( 'Money Format Simplify Million Decimals', 'dase' ),
			array( $this, 'money_format_simplify_million_decimals_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_money_format_simplify_million_decimals',
			array( $this, 'money_format_simplify_million_decimals_validation' )
		);

		add_settings_field(
			'money_format_million_symbol',
			esc_attr__( 'Money Format Million Symbol', 'dase' ),
			array( $this, 'money_format_million_symbol_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_money_format_million_symbol',
			array( $this, 'money_format_million_symbol_validation' )
		);

		add_settings_field(
			'money_format_simplify_thousands',
			esc_attr__( 'Money Format Simplify Thousands', 'dase' ),
			array( $this, 'money_format_simplify_thousands_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_money_format_simplify_thousands',
			array( $this, 'money_format_simplify_thousands_validation' )
		);

		add_settings_field(
			'money_format_simplify_thousands_decimals',
			esc_attr__( 'Money Format Simplify Thousands Decimals', 'dase' ),
			array( $this, 'money_format_simplify_thousands_decimals_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_money_format_simplify_thousands_decimals',
			array( $this, 'money_format_simplify_thousands_decimals_validation' )
		);

		add_settings_field(
			'money_format_thousands_symbol',
			esc_attr__( 'Money Format Thousands Symbol', 'dase' ),
			array( $this, 'money_format_thousands_symbol_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_money_format_thousands_symbol',
			array( $this, 'money_format_thousands_symbol_validation' )
		);

		add_settings_field(
			'money_format_currency',
			esc_attr__( 'Money Format Currency', 'dase' ),
			array( $this, 'money_format_currency_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_money_format_currency',
			array( $this, 'money_format_currency_validation' )
		);

		add_settings_field(
			'money_format_currency_position',
			esc_attr__( 'Money Format Currency Position', 'dase' ),
			array( $this, 'money_format_currency_position_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_money_format_currency_position',
			array( $this, 'money_format_currency_position_validation' )
		);

		add_settings_field(
			'height_measurement_unit',
			esc_attr__( 'Height Measurement Unit', 'dase' ),
			array( $this, 'height_measurement_unit_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_height_measurement_unit',
			array( $this, 'height_measurement_unit_validation' )
		);

		add_settings_field(
			'set_max_execution_time',
			esc_attr__( 'Set Max Execution Time', 'dase' ),
			array( $this, 'set_max_execution_time_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_set_max_execution_time',
			array( $this, 'set_max_execution_time_validation' )
		);

		add_settings_field(
			'max_execution_time_value',
			esc_attr__( 'Max Execution Time Value', 'dase' ),
			array( $this, 'max_execution_time_value_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_max_execution_time_value',
			array( $this, 'max_execution_time_value_validation' )
		);

		add_settings_field(
			'set_memory_limit',
			esc_attr__( 'Set Memory Limit', 'dase' ),
			array( $this, 'set_memory_limit_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_set_memory_limit',
			array( $this, 'set_memory_limit_validation' )
		);

		add_settings_field(
			'memory_limit_value',
			esc_attr__( 'Memory Limit Value', 'dase' ),
			array( $this, 'memory_limit_value_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_memory_limit_value',
			array( $this, 'memory_limit_value_validation' )
		);

		add_settings_field(
			'transient_expiration',
			esc_attr__( 'Transient Expiration', 'dase' ),
			array( $this, 'transient_expiration_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_transient_expiration',
			array( $this, 'transient_expiration_validation' )
		);

		add_settings_field(
			'rest_api_authentication_read',
			esc_attr__( 'REST API Authentication (Read)', 'dase' ),
			array( $this, 'rest_api_authentication_read_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_rest_api_authentication_read',
			array( $this, 'rest_api_authentication_read_validation' )
		);

		add_settings_field(
			'rest_api_authentication_create',
			esc_attr__( 'REST API Authentication (Create)', 'dase' ),
			array( $this, 'rest_api_authentication_create_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_rest_api_authentication_create',
			array( $this, 'rest_api_authentication_create_validation' )
		);

		add_settings_field(
			'rest_api_key',
			esc_attr__( 'REST API Key', 'dase' ),
			array( $this, 'rest_api_key_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_rest_api_key',
			array( $this, 'rest_api_key_validation' )
		);

		add_settings_field(
			'line_chart_show_legend',
			esc_attr__( 'Line Chart Show Legend', 'dase' ),
			array( $this, 'line_chart_show_legend_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_line_chart_show_legend',
			array( $this, 'line_chart_show_legend_validation' )
		);

		add_settings_field(
			'line_chart_show_gridlines',
			esc_attr__( 'Line Chart Show Gridlines', 'dase' ),
			array( $this, 'line_chart_show_gridlines_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_line_chart_show_gridlines',
			array( $this, 'line_chart_show_gridlines_validation' )
		);

		add_settings_field(
			'line_chart_show_tooltips',
			esc_attr__( 'Line Chart Show Tooltips', 'dase' ),
			array( $this, 'line_chart_show_tooltips_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_line_chart_show_tooltips',
			array( $this, 'line_chart_show_tooltips_validation' )
		);

		add_settings_field(
			'line_chart_legend_position',
			esc_attr__( 'Line Chart Legend Position', 'dase' ),
			array( $this, 'line_chart_legend_position_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_line_chart_legend_position',
			array( $this, 'line_chart_legend_position_validation' )
		);

		add_settings_field(
			'line_chart_fill',
			esc_attr__( 'Line Chart Fill', 'dase' ),
			array( $this, 'line_chart_fill_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_line_chart_fill',
			array( $this, 'line_chart_fill_validation' )
		);

		add_settings_field(
			'formation_field_line_stroke_width',
			esc_attr__( 'Formation Field Line Stroke Width', 'dase' ),
			array( $this, 'formation_field_line_stroke_width_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_formation_field_line_stroke_width',
			array( $this, 'formation_field_line_stroke_width_validation' )
		);

		add_settings_field(
			'block_margin_top',
			esc_attr__( 'Block Margin Top', 'dase' ),
			array( $this, 'block_margin_top_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_block_margin_top',
			array( $this, 'block_margin_top_validation' )
		);

		add_settings_field(
			'block_margin_bottom',
			esc_attr__( 'Block Margin Bottom', 'dase' ),
			array( $this, 'block_margin_bottom_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_block_margin_bottom',
			array( $this, 'block_margin_bottom_validation' )
		);

		add_settings_field(
			'responsive_breakpoint_1',
			esc_attr__( 'Responsive Breakpoint 1', 'dase' ),
			array( $this, 'responsive_breakpoint_1_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_responsive_breakpoint_1',
			array( $this, 'responsive_breakpoint_1_validation' )
		);

		add_settings_field(
			'responsive_breakpoint_2',
			esc_attr__( 'Responsive Breakpoint 2', 'dase' ),
			array( $this, 'responsive_breakpoint_2_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_responsive_breakpoint_2',
			array( $this, 'responsive_breakpoint_2_validation' )
		);

		add_settings_field(
			'font_family',
			esc_attr__( 'Font Family', 'dase' ),
			array( $this, 'font_family_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_font_family',
			array( $this, 'font_family_validation' )
		);

		add_settings_field(
			'google_font_url',
			esc_attr__( 'Google Font URL', 'dase' ),
			array( $this, 'google_font_url_callback' ),
			'dase_advanced_options',
			'dase_advanced_settings_section'
		);

		register_setting(
			'dase_advanced_options',
			'dase_google_font_url',
			array( $this, 'google_font_url_validation' )
		);
	}

	public function table_header_background_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_table_header_background_color' ) ) . '" type="text" id="dase-table-header-background-color" name="dase_table_header_background_color" maxlength="91" size="30"/>';
		$html .= '<input id="dase-table-header-background-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-table-header-background-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the header background color.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function table_header_background_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color_or_colors, $input ) ) {
			add_settings_error(
				'table_header_background_color',
				'table_header_background_color',
				esc_attr__( 'Please enter a valid color in the "Table Header Background Color" option.', 'dase' )
			);
			$output = get_option( 'dase_table_header_background_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function table_header_border_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_table_header_border_color' ) ) . '" type="text" id="dase-table-header-border-color" name="dase_table_header_border_color" maxlength="91" size="30"/>';
		$html .= '<input id="dase-table-header-border-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-table-header-border-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the header border color.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function table_header_border_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color_or_colors, $input ) ) {
			add_settings_error(
				'table_header_border_color',
				'table_header_border_color',
				esc_attr__( 'Please enter a valid color in the "Table Header Border Color" option.', 'dase' )
			);
			$output = get_option( 'dase_table_header_border_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function table_header_font_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_table_header_font_color' ) ) . '" type="text" id="dase-table-header-font-color" name="dase_table_header_font_color" maxlength="91" size="30"/>';
		$html .= '<input id="dase-table-header-font-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-table-header-font-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the header font color.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function table_header_font_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color_or_colors, $input ) ) {
			add_settings_error(
				'table_header_font_color',
				'table_header_font_color',
				esc_attr__( 'Please enter a valid color in the "Table Header Font Color" option.', 'dase' )
			);
			$output = get_option( 'dase_table_header_font_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function table_body_background_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_table_body_background_color' ) ) . '" type="text" id="dase-table-body-background-color" name="dase_table_body_background_color" maxlength="91" size="30"/>';
		$html .= '<input id="dase-table-body-background-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-table-body-background-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the body background color.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function table_body_background_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color_or_colors, $input ) ) {
			add_settings_error(
				'table_body_background_color',
				'table_body_background_color',
				esc_attr__( 'Please enter a valid color in the "Table Body Background Color" option.', 'dase' )
			);
			$output = get_option( 'dase_table_body_background_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function table_body_border_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_table_body_border_color' ) ) . '" type="text" id="dase-table-body-border-color" name="dase_table_body_border_color" maxlength="91" size="30"/>';
		$html .= '<input id="dase-table-body-border-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-table-body-border-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the body border color.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function table_body_border_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color_or_colors, $input ) ) {
			add_settings_error(
				'table_body_border_color',
				'table_body_border_color',
				esc_attr__( 'Please enter a valid color in the "Table Body Border Color" option.', 'dase' )
			);
			$output = get_option( 'dase_table_body_border_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function table_body_font_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_table_body_font_color' ) ) . '" type="text" id="dase-table-body-font-color" name="dase_table_body_font_color" maxlength="91" size="30"/>';
		$html .= '<input id="dase-table-body-font-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-table-body-font-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the body font color.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function table_body_font_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color_or_colors, $input ) ) {
			add_settings_error(
				'table_body_font_color',
				'table_body_font_color',
				esc_attr__( 'Please enter a valid color in the "Table Body Font Color" option.', 'dase' )
			);
			$output = get_option( 'dase_table_body_font_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function line_chart_dataset_line_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_line_chart_dataset_line_color' ) ) . '" type="text" id="dase-line-chart-dataset-line-color" name="dase_line_chart_dataset_line_color" maxlength="91" size="30"/>';
		$html .= '<input id="dase-line-chart-dataset-line-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-line-chart-dataset-line-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color or a comma separated list of colors that will be used for the areas of the line chart.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function table_pagination_background_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_table_pagination_background_color' ) ) . '" type="text" id="dase-table-pagination-background-color" name="dase_table_pagination_background_color" maxlength="91" size="30"/>';
		$html .= '<input id="dase-table-pagination-background-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-table-pagination-background-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the pagination background color.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function table_pagination_background_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color_or_colors, $input ) ) {
			add_settings_error(
				'table_pagination_background_color',
				'table_pagination_background_color',
				esc_attr__( 'Please enter a valid color in the "Table Pagination Background Color" option.', 'dase' )
			);
			$output = get_option( 'dase_table_pagination_background_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function table_pagination_border_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_table_pagination_border_color' ) ) . '" type="text" id="dase-table-pagination-border-color" name="dase_table_pagination_border_color" maxlength="91" size="30"/>';
		$html .= '<input id="dase-table-pagination-border-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-table-pagination-border-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the pagination border color.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function table_pagination_border_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color_or_colors, $input ) ) {
			add_settings_error(
				'table_pagination_border_color',
				'table_pagination_border_color',
				esc_attr__( 'Please enter a valid color in the "Table Pagination Border Color" option.', 'dase' )
			);
			$output = get_option( 'dase_table_pagination_border_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function table_pagination_font_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_table_pagination_font_color' ) ) . '" type="text" id="dase-table-pagination-font-color" name="dase_table_pagination_font_color" maxlength="91" size="30"/>';
		$html .= '<input id="dase-table-pagination-font-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-table-pagination-font-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the pagination font color.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function table_pagination_font_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color_or_colors, $input ) ) {
			add_settings_error(
				'table_pagination_font_color',
				'table_pagination_font_color',
				esc_attr__( 'Please enter a valid color in the "Table Pagination Font Color" option.', 'dase' )
			);
			$output = get_option( 'dase_table_pagination_font_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function table_pagination_disabled_background_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_table_pagination_disabled_background_color' ) ) . '" type="text" id="dase-table-pagination-disabled-background-color" name="dase_table_pagination_disabled_background_color" maxlength="91" size="30"/>';
		$html .= '<input id="dase-table-pagination-disabled-background-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-table-pagination-disabled-background-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the pagination disabled background color.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function table_pagination_disabled_background_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color_or_colors, $input ) ) {
			add_settings_error(
				'table_pagination_disabled_background_color',
				'table_pagination_disabled_background_color',
				esc_attr__( 'Please enter a valid color in the "Table Pagination Disabled Background Color" option.', 'dase' )
			);
			$output = get_option( 'dase_table_pagination_disabled_background_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function table_pagination_disabled_border_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_table_pagination_disabled_border_color' ) ) . '" type="text" id="dase-table-pagination-disabled-border-color" name="dase_table_pagination_disabled_border_color" maxlength="91" size="30"/>';
		$html .= '<input id="dase-table-pagination-disabled-border-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-table-pagination-disabled-border-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the pagination disabled border color.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function table_pagination_disabled_border_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color_or_colors, $input ) ) {
			add_settings_error(
				'table_pagination_disabled_border_color',
				'table_pagination_disabled_border_color',
				esc_attr__( 'Please enter a valid color in the "Table Pagination Disabled Border Color" option.', 'dase' )
			);
			$output = get_option( 'dase_table_pagination_disabled_border_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function table_pagination_disabled_font_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_table_pagination_disabled_font_color' ) ) . '" type="text" id="dase-table-pagination-disabled-font-color" name="dase_table_pagination_disabled_font_color" maxlength="91" size="30"/>';
		$html .= '<input id="dase-table-pagination-disabled-font-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-table-pagination-disabled-font-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the pagination disabled font color.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function table_pagination_disabled_font_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color_or_colors, $input ) ) {
			add_settings_error(
				'table_pagination_disabled_font_color',
				'table_pagination_disabled_font_color',
				esc_attr__( 'Please enter a valid color in the "Table Pagination Disabled Font Color" option.', 'dase' )
			);
			$output = get_option( 'dase_table_pagination_disabled_font_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function line_chart_dataset_background_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_line_chart_dataset_background_color' ) ) . '" type="text" id="dase-line-chart-dataset-background-color" name="dase_line_chart_dataset_background_color" maxlength="91" size="30"/>';
		$html .= '<input id="dase-line-chart-dataset-background-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-line-chart-dataset-background-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color or a comma separated list of colors that will be used for the lines of the line chart.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function line_chart_dataset_background_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color_or_colors, $input ) ) {
			add_settings_error(
				'line_chart_dataset_background_color',
				'line_chart_dataset_background_color',
				esc_attr__( 'Please enter a valid color or a comma separated list of colors in the "Line Chart Dataset Background Color" option.', 'dase' )
			);
			$output = get_option( 'dase_line_chart_dataset_background_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function line_chart_show_legend_callback( $args ) {

		$html  = '<select id="dase-line-chart-show-legend" name="dase_line_chart_show_legend" class="daext-display-none">';
		$html .= '<option ' . selected( intval( get_option( 'dase_line_chart_show_legend' ) ), 0, false ) . ' value="0">' . __( 'No', 'dase' ) . '</option>';
		$html .= '<option ' . selected( intval( get_option( 'dase_line_chart_show_legend' ) ), 1, false ) . ' value="1">' . __( 'Yes', 'dase' ) . '</option>';
		$html .= '</select>';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This option determines if the legend of the line chart should be displayed.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function line_chart_show_legend_validation( $input ) {

		return intval( $input, 10 ) == 1 ? '1' : '0';
	}

	public function line_chart_show_gridlines_callback( $args ) {

		$html  = '<select id="dase-line-chart-show-gridlines" name="dase_line_chart_show_gridlines" class="daext-display-none">';
		$html .= '<option ' . selected( intval( get_option( 'dase_line_chart_show_gridlines' ) ), 0, false ) . ' value="0">' . __( 'No', 'dase' ) . '</option>';
		$html .= '<option ' . selected( intval( get_option( 'dase_line_chart_show_gridlines' ) ), 1, false ) . ' value="1">' . __( 'Yes', 'dase' ) . '</option>';
		$html .= '</select>';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This option determines if the gridlines of the line chart should be displayed.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function line_chart_show_gridlines_validation( $input ) {

		return intval( $input, 10 ) == 1 ? '1' : '0';
	}

	public function line_chart_show_tooltips_callback( $args ) {

		$html  = '<select id="dase-line-chart-show-tooltips" name="dase_line_chart_show_tooltips" class="daext-display-none">';
		$html .= '<option ' . selected( intval( get_option( 'dase_line_chart_show_tooltips' ) ), 0, false ) . ' value="0">' . __( 'No', 'dase' ) . '</option>';
		$html .= '<option ' . selected( intval( get_option( 'dase_line_chart_show_tooltips' ) ), 1, false ) . ' value="1">' . __( 'Yes', 'dase' ) . '</option>';
		$html .= '</select>';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This option determines if the tooltips of the line chart should be displayed.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function line_chart_show_tooltips_validation( $input ) {

		return intval( $input, 10 ) == 1 ? '1' : '0';
	}

	public function line_chart_legend_position_callback( $args ) {

		$html  = '<select id="dase-line-chart-legend-position" name="dase_line_chart_legend_position" class="daext-display-none">';
		$html .= '<option ' . selected( intval( get_option( 'dase_line_chart_legend_position' ) ), 0, false ) . ' value="0">' . __( 'Top', 'dase' ) . '</option>';
		$html .= '<option ' . selected( intval( get_option( 'dase_line_chart_legend_position' ) ), 1, false ) . ' value="1">' . __( 'Right', 'dase' ) . '</option>';
		$html .= '<option ' . selected( intval( get_option( 'dase_line_chart_legend_position' ) ), 2, false ) . ' value="2">' . __( 'Bottom', 'dase' ) . '</option>';
		$html .= '<option ' . selected( intval( get_option( 'dase_line_chart_legend_position' ) ), 3, false ) . ' value="3">' . __( 'Left', 'dase' ) . '</option>';
		$html .= '</select>';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This option determines the position of the legend in the line chart.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function line_chart_legend_position_validation( $input ) {

		return intval( $input, 10 );
	}

	public function line_chart_font_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_line_chart_font_color' ) ) . '" type="text" id="dase-line-chart-font-color" name="dase_line_chart_font_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-line-chart-font-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-line-chart-font-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the fonts of the line chart.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function line_chart_font_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'line_chart_font_color',
				'line_chart_font_color',
				esc_attr__( 'Please enter a valid color in the "Line Chart Font Color" option.', 'dase' )
			);
			$output = get_option( 'dase_line_chart_font_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function line_chart_tooltips_background_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_line_chart_tooltips_background_color' ) ) . '" type="text" id="dase-line-chart-tooltips-background-color" name="dase_line_chart_tooltips_background_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-line-chart-tooltips-background-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-line-chart-tooltips-background-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the background of the line chart tooltips.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function line_chart_tooltips_background_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'line_chart_tooltips_background_color',
				'line_chart_tooltips_background_color',
				esc_attr__( 'Please enter a valid color in the "Line Chart Tooltips Background Color" option.', 'dase' )
			);
			$output = get_option( 'dase_line_chart_tooltips_background_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function line_chart_tooltips_font_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_line_chart_tooltips_font_color' ) ) . '" type="text" id="dase-line-chart-tooltips-font-color" name="dase_line_chart_tooltips_font_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-line-chart-tooltips-font-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-line-chart-tooltips-font-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the fonts of the line chart tooltips.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function line_chart_tooltip_font_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'line_chart_tooltips_font_color',
				'line_chart_tooltips_font_color',
				esc_attr__( 'Please enter a valid color in the "Line Chart Tooltips font Color" option.', 'dase' )
			);
			$output = get_option( 'dase_line_chart_tooltips_font_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function line_chart_gridlines_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_line_chart_gridlines_color' ) ) . '" type="text" id="dase-line-chart-gridlines-color" name="dase_line_chart_gridlines_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-line-chart-gridlines-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-line-chart-gridlines-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the gridlines of the line chart.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function line_chart_gridlines_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'line_chart_gridlines_color',
				'line_chart_gridlines_color',
				esc_attr__( 'Please enter a valid color in the "Line Chart Tooltip Background Color" option.', 'dase' )
			);
			$output = get_option( 'dase_line_chart_gridlines_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function line_chart_fill_callback( $args ) {

		$html  = '<select id="dase-line-chart-fill" name="dase_line_chart_fill" class="daext-display-none">';
		$html .= '<option ' . selected( intval( get_option( 'dase_line_chart_fill' ) ), 0, false ) . ' value="0">' . __( 'No', 'dase' ) . '</option>';
		$html .= '<option ' . selected( intval( get_option( 'dase_line_chart_fill' ) ), 1, false ) . ' value="1">' . __( 'Yes', 'dase' ) . '</option>';
		$html .= '</select>';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This option determines if the fill of the lines of the line chart should be displayed.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function line_chart_fill_validation( $input ) {

		return intval( $input, 10 ) == 1 ? '1' : '0';
	}

	public function formation_field_background_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_formation_field_background_color' ) ) . '" type="text" id="dase-formation-field-background-color" name="dase_formation_field_background_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-formation-field-background-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-formation-field-background-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the background of the field.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function formation_field_background_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'formation_field_background_color',
				'formation_field_background_color',
				esc_attr__( 'Please enter a valid color in the "Formation Field Background Color" option.', 'dase' )
			);
			$output = get_option( 'dase_formation_field_background_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function formation_field_line_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_formation_field_line_color' ) ) . '" type="text" id="dase-formation-field-line-color" name="dase_formation_field_line_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-formation-field-line-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-formation-field-line-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the lines of the field.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function formation_field_line_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'formation_field_line_color',
				'formation_field_line_color',
				esc_attr__( 'Please enter a valid color in the "Formation Field Line Color" option.', 'dase' )
			);
			$output = get_option( 'dase_formation_field_line_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function formation_field_line_stroke_width_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-formation-field-line-stroke-width" name="dase_formation_field_line_stroke_width" class="regular-text" value="' . esc_attr( get_option( 'dase_formation_field_line_stroke_width' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The stroke width used for the lines of the field.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function formation_field_line_stroke_width_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 0 or $input > 100 ) {
			add_settings_error( 'dase_formation_field_line_stroke_width', 'dase_formation_field_line_stroke_width', __( 'Please enter a valid value in the "Formation Field Line Stroke Width" option.', 'dase' ) );
			$output = get_option( 'dase_formation_field_line_stroke_width' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function formation_field_player_number_background_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_formation_field_player_number_background_color' ) ) . '" type="text" id="dase-formation-field-player-number-background-color" name="dase_formation_field_player_number_background_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-formation-field-player-number-background-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-formation-field-player-number-background-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the background of the player number.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function formation_field_player_number_background_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'formation_field_player_number_background_color',
				'formation_field_player_number_background_color',
				esc_attr__( 'Please enter a valid color in the "Formation Field Player Number Background Color" option.', 'dase' )
			);
			$output = get_option( 'dase_formation_field_player_number_background_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function formation_field_player_number_border_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_formation_field_player_number_border_color' ) ) . '" type="text" id="dase-formation-field-player-number-border-color" name="dase_formation_field_player_number_border_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-formation-field-player-number-border-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-formation-field-player-number-border-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the border of the player number.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function formation_field_player_number_border_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'formation_field_player_number_border_color',
				'formation_field_player_number_border_color',
				esc_attr__( 'Please enter a valid color in the "Formation Field Player Number Border Color" option.', 'dase' )
			);
			$output = get_option( 'dase_formation_field_player_number_border_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function formation_field_player_number_font_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_formation_field_player_number_font_color' ) ) . '" type="text" id="dase-formation-field-player-number-font-color" name="dase_formation_field_player_number_font_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-formation-field-player-number-font-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-formation-field-player-number-font-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the font of the player number.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function formation_field_player_number_font_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'formation_field_player_number_font_color',
				'formation_field_player_number_font_color',
				esc_attr__( 'Please enter a valid color in the "Formation Field Player Number Font Color" option.', 'dase' )
			);
			$output = get_option( 'dase_formation_field_player_number_font_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function formation_field_player_name_font_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_formation_field_player_name_font_color' ) ) . '" type="text" id="dase-formation-field-player-name-font-color" name="dase_formation_field_player_name_font_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-formation-field-player-name-font-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-formation-field-player-name-font-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the font of the player name.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function formation_field_player_name_font_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'formation_field_player_name_font_color',
				'formation_field_player_name_font_color',
				esc_attr__( 'Please enter a valid color in the "Formation Field Player Name Font Color" option.', 'dase' )
			);
			$output = get_option( 'dase_formation_field_player_name_font_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function clock_background_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_clock_background_color' ) ) . '" type="text" id="dase-clock-background-color" name="dase_clock_background_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-clock-background-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-clock-background-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the background color of the clock.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function clock_background_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'clock_background_color',
				'clock_background_color',
				esc_attr__( 'Please enter a valid color in the "Clock Background Color" option.', 'dase' )
			);
			$output = get_option( 'dase_clock_background_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function clock_primary_ticks_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_clock_primary_ticks_color' ) ) . '" type="text" id="dase-clock-primary-ticks-color" name="dase_clock_primary_ticks_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-clock-primary-ticks-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-clock-primary-ticks-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the primary ticks of the clock.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function clock_primary_ticks_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'clock_primary_ticks_color',
				'clock_primary_ticks_color',
				esc_attr__( 'Please enter a valid color in the "Clock Primary Ticks Color" option.', 'dase' )
			);
			$output = get_option( 'dase_clock_primary_ticks_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function clock_secondary_ticks_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_clock_secondary_ticks_color' ) ) . '" type="text" id="dase-clock-secondary-ticks-color" name="dase_clock_secondary_ticks_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-clock-secondary-ticks-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-clock-secondary-ticks-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the secondary ticks of the clock.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function clock_secondary_ticks_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'clock_secondary_ticks_color',
				'clock_secondary_ticks_color',
				esc_attr__( 'Please enter a valid color in the "Clock Secondary Ticks Color" option.', 'dase' )
			);
			$output = get_option( 'dase_clock_secondary_ticks_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function clock_border_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_clock_border_color' ) ) . '" type="text" id="dase-clock-border-color" name="dase_clock_border_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-clock-border-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-clock-border-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the border of the clock.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function clock_border_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'clock_border_color',
				'clock_border_color',
				esc_attr__( 'Please enter a valid color in the "Clock Border Color Color" option.', 'dase' )
			);
			$output = get_option( 'dase_clock_border_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function clock_overlay_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_clock_overlay_color' ) ) . '" type="text" id="dase-clock-overlay-color" name="dase_clock_overlay_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-clock-overlay-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-clock-overlay-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the overlay of the clock.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function clock_overlay_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'clock_overlay_color',
				'clock_overlay_color',
				esc_attr__( 'Please enter a valid color in the "Clock Overlay Color" option.', 'dase' )
			);
			$output = get_option( 'dase_clock_overlay_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function clock_extra_time_overlay_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_clock_extra_time_overlay_color' ) ) . '" type="text" id="dase-clock-extra-time-overlay-color" name="dase_clock_extra_time_overlay_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-clock-extra-time-overlay-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-clock-extra-time-overlay-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'A color that will be used for the extra time overlay of the clock.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function clock_extra_time_overlay_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'clock_extra_time_overlay_color',
				'clock_extra_time_overlay_color',
				esc_attr__( 'Please enter a valid color in the "Clock Extra Time Overlay Color" option.', 'dase' )
			);
			$output = get_option( 'dase_clock_extra_time_overlay_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function event_icon_goal_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_event_icon_goal_color' ) ) . '" type="text" id="dase-event-icon-goal-color" name="dase_event_icon_goal_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-event-icon-goal-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-event-icon-goal-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'The color of the goal event icon.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function event_icon_goal_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'event_icon_goal_color',
				'event_icon_goal_color',
				esc_attr__( 'Please enter a valid color in the "Event Icon Goal Color" option.', 'dase' )
			);
			$output = get_option( 'dase_event_icon_goal_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function event_icon_yellow_card_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_event_icon_yellow_card_color' ) ) . '" type="text" id="dase-event-icon-yellow-card-color" name="dase_event_icon_yellow_card_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-event-icon-yellow-card-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-event-icon-yellow-card-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'The color of the yellow card event icon.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function event_icon_red_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'event_icon_red_color',
				'event_icon_red_color',
				esc_attr__( 'Please enter a valid color in the "Event Icon Red Color" option.', 'dase' )
			);
			$output = get_option( 'dase_event_icon_red_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function event_icon_red_card_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_event_icon_red_card_color' ) ) . '" type="text" id="dase-event-icon-red-card-color" name="dase_event_icon_red_card_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-event-icon-red-card-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-event-icon-red-card-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'The color of the red card event icon.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function event_icon_red_card_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'event_icon_red_card_color',
				'event_icon_red_card_color',
				esc_attr__( 'Please enter a valid color in the "Event Icon Red Card Color" option.', 'dase' )
			);
			$output = get_option( 'dase_event_icon_goal_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function event_icon_substitution_left_arrow_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_event_icon_substitution_left_arrow_color' ) ) . '" type="text" id="dase-event-icon-substitution-left-arrow-color" name="dase_event_icon_substitution_left_arrow_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-event-icon-substitution-left-arrow-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-event-icon-substitution-left-arrow-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'The color of the subsitution left arrow event icon.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function event_icon_substitution_left_arrow_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'event_icon_substitution_left_arrow_color',
				'event_icon_substitution_left_arrow_color',
				esc_attr__( 'Please enter a valid color in the "Event Icon Substitution Left Arrow Color" option.', 'dase' )
			);
			$output = get_option( 'dase_event_icon_substitution_left_arrow_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function event_icon_substitution_right_arrow_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_event_icon_substitution_right_arrow_color' ) ) . '" type="text" id="dase-event-icon-substitution-right-arrow-color" name="dase_event_icon_substitution_right_arrow_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-event-icon-substitution-right-arrow-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-event-icon-substitution-right-arrow-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'The color of the subsitution right arrow event icon.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function event_icon_substitution_right_arrow_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'event_icon_substitution_right_arrow_color',
				'event_icon_substitution_right_arrow_color',
				esc_attr__( 'Please enter a valid color in the "Event Icon Substitution Right Arrow Color" option.', 'dase' )
			);
			$output = get_option( 'dase_event_icon_substitution_right_arrow_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function default_avatar_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_default_avatar_color' ) ) . '" type="text" id="dase-default-avatar-color" name="dase_default_avatar_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-default-avatar-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-default-avatar-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'The color of the default avatar.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function default_avatar_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'default_avatar_color',
				'default_avatar_color',
				esc_attr__( 'Please enter a valid color in the "Default Avatar Color" option.', 'dase' )
			);
			$output = get_option( 'dase_default_avatar_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function default_avatar_background_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_default_avatar_background_color' ) ) . '" type="text" id="dase-default-avatar-background-color" name="dase_default_avatar_background_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-default-avatar-background-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-default-avatar-background-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'The background color of the default avatar.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function default_avatar_background_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'default_avatar_background_color',
				'default_avatar_background_color',
				esc_attr__( 'Please enter a valid color in the "Default Avatar Background Color" option.', 'dase' )
			);
			$output = get_option( 'dase_default_avatar_background_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function default_team_logo_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_default_team_logo_color' ) ) . '" type="text" id="dase-default-team-logo-color" name="dase_default_team_logo_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-default-team-logo-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-default-team-logo-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'The color of the default team logo.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function default_team_logo_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'default_team_logo_color',
				'default_team_logo_color',
				esc_attr__( 'Please enter a valid color in the "Default Team Logo Color" option.', 'dase' )
			);
			$output = get_option( 'dase_default_team_logo_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function default_team_logo_background_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_default_team_logo_background_color' ) ) . '" type="text" id="dase-default-team-logo-background-color" name="dase_default_team_logo_background_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-default-team-logo-background-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-default-team-logo-background-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'The background color of the default team logo.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function default_team_logo_background_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'default_team_logo_background_color',
				'default_team_logo_background_color',
				esc_attr__( 'Please enter a valid color in the "Default Team Logo Background Color" option.', 'dase' )
			);
			$output = get_option( 'dase_default_team_logo_background_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function default_competition_logo_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_default_competition_logo_color' ) ) . '" type="text" id="dase-default-competition-logo-color" name="dase_default_competition_logo_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-default-competition-logo-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-default-competition-logo-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'The color of the default competition logo.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function default_competition_logo_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'default_competition_logo_color',
				'default_competition_logo_color',
				esc_attr__( 'Please enter a valid color in the "Default Competition Logo Color" option.', 'dase' )
			);
			$output = get_option( 'dase_default_competition_logo_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function default_competition_logo_background_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_default_competition_logo_background_color' ) ) . '" type="text" id="dase-default-competition-logo-background-color" name="dase_default_competition_logo_background_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-default-competition-logo-background-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-default-competition-logo-background-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'The background color of the default competition logo.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function default_competition_logo_background_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'default_competition_logo_background_color',
				'default_competition_logo_background_color',
				esc_attr__( 'Please enter a valid color in the "Default Competition Logo Background Color" option.', 'dase' )
			);
			$output = get_option( 'dase_default_competition_logo_background_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function default_trophy_type_logo_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_default_trophy_type_logo_color' ) ) . '" type="text" id="dase-default-trophy-type-logo-color" name="dase_default_trophy_type_logo_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-default-trophy-type-logo-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-default-trophy-type-logo-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'The color of the default trophy type logo.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function default_trophy_type_logo_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'default_trophy_type_logo_color',
				'default_trophy_type_logo_color',
				esc_attr__( 'Please enter a valid color in the "Default Trophy Type Logo Color" option.', 'dase' )
			);
			$output = get_option( 'dase_default_trophy_type_logo_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function default_trophy_type_logo_background_color_callback( $args ) {

		$html  = '<input value="' . esc_attr( get_option( 'dase_default_trophy_type_logo_background_color' ) ) . '" type="text" id="dase-default-trophy-type-logo-background-color" name="dase_default_trophy_type_logo_background_color" maxlength="21" size="30"/>';
		$html .= '<input id="dase-default-trophy-type-logo-background-color-spectrum" class="spectrum-input" type="text">';
		$html .= '<div id="dase-default-trophy-type-logo-background-color-spectrum-toggle" class="spectrum-toggle"></div>';
		$html .= '<div class="help-icon" title="' . esc_attr__(
			'The background color of the trophy type logo.',
			'dase'
		) . '"></div>';

		echo $html;
	}

	public function default_trophy_type_logo_background_color_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_color, $input ) ) {
			add_settings_error(
				'default_trophy_type_logo_background_color',
				'default_trophy_type_logo_background_color',
				esc_attr__( 'Please enter a valid color in the "Default Trophy Type Logo Background Color" option.', 'dase' )
			);
			$output = get_option( 'dase_default_trophy_type_logo_background_color' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function capability_menu_players_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-players" name="dase_capability_menu_players" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_players' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Players" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_players_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_players', 'dase_capability_menu_players', __( 'Please enter a valid capability in the "Menu Players" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_players' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_player_positions_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-player-positions" name="dase_capability_menu_player_positions" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_player_positions' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Players" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_player_positions_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_player_positions', 'dase_capability_menu_player_positions', __( 'Please enter a valid capability in the "Menu Player Positions" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_player_positions' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_player_awards_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-player-awards" name="dase_capability_menu_player_awards" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_player_awards' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Player Awards" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_player_awards_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_player_awards', 'dase_capability_menu_player_awards', __( 'Please enter a valid capability in the "Menu Player Awards" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_player_awards' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_player_award_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-player-award-types" name="dase_capability_menu_player_award_types" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_player_award_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Player Award Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_player_award_types_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_player_award_types', 'dase_capability_menu_player_award_types', __( 'Please enter a valid capability in the "Menu Player Award Types" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_player_award_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_unavailable_players_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-unavailable-players" name="dase_capability_menu_unavailable_players" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_unavailable_players' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Unavailable Players" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_unavailable_players_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_unavailable_players', 'dase_capability_menu_unavailable_players', __( 'Please enter a valid capability in the "Menu Unavailable Players" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_unavailable_players' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_unavailable_player_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-unavailable-player-types" name="dase_capability_menu_unavailable_player_types" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_unavailable_player_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Unavailable Player Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_unavailable_player_types_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_unavailable_player_types', 'dase_capability_menu_unavailable_player_types', __( 'Please enter a valid capability in the "Menu Unavailable Player Types" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_unavailable_player_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_injuries_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-injuries" name="dase_capability_menu_injuries" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_injuries' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Injuries" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_injuries_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_injuries', 'dase_capability_menu_injuries', __( 'Please enter a valid capability in the "Menu Injuries" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_injuries' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_injury_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-injury-types" name="dase_capability_menu_injury_types" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_injury_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Injury Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_injury_types_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_injury_types', 'dase_capability_menu_injury_types', __( 'Please enter a valid capability in the "Menu Injury Types" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_injury_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_staff_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-staff" name="dase_capability_menu_staff" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_staff' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Staff" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_staff_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_staff', 'dase_capability_menu_staff', __( 'Please enter a valid capability in the "Menu Staff" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_staff' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_staff_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-staff-types" name="dase_capability_menu_staff_types" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_staff_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Staff Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_staff_types_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_staff_types', 'dase_capability_menu_staff_types', __( 'Please enter a valid capability in the "Menu Staff Types" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_staff_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_staff_awards_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-staff-awards" name="dase_capability_menu_staff_awards" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_staff_awards' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Staff Awards" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_staff_awards_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_staff_awards', 'dase_capability_menu_staff_awards', __( 'Please enter a valid capability in the "Menu Staff Awards" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_staff_awards' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_staff_award_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-staff-award-types" name="dase_capability_menu_staff_award_types" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_staff_award_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Staff Award Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_staff_award_types_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_staff_award_types', 'dase_capability_menu_staff_award_types', __( 'Please enter a valid capability in the "Menu Staff Award Types" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_staff_award_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_referees_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-referees" name="dase_capability_menu_referees" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_referees' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Referees" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_referees_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_referees', 'dase_capability_menu_referees', __( 'Please enter a valid capability in the "Referees" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_referees' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_referee_badges_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-referee-badges" name="dase_capability_menu_referee_badges" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_referee_badges' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Referee Badges" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_referee_badges_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_referee_badges', 'dase_capability_menu_referee_badges', __( 'Please enter a valid capability in the "Menu Referee Badges" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_referee_badges' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_referee_badge_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-referee-badge-types" name="dase_capability_menu_referee_badge_types" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_referee_badge_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Referee Badge Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_referee_badge_types_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_referee_badge_types', 'dase_capability_menu_referee_badge_types', __( 'Please enter a valid capability in the "Menu Referee Badge Types" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_referee_badge_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_teams_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-teams" name="dase_capability_menu_teams" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_teams' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Teams" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_teams_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_teams', 'dase_capability_menu_teams', __( 'Please enter a valid capability in the "Menu Teams" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_teams' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_squads_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-squads" name="dase_capability_menu_squads" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_squads' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Squads" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_squads_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_squads', 'dase_capability_menu_squads', __( 'Please enter a valid capability in the "Menu Squads" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_squads' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_formations_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-formations" name="dase_capability_menu_formations" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_formations' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Formations" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_formations_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_formations', 'dase_capability_menu_formations', __( 'Please enter a valid capability in the "Menu Formations" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_formations' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_jersey_sets_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-jersey-sets" name="dase_capability_menu_jersey_sets" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_jersey_sets' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Jersey Sets" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_jersey_sets_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_jersey_sets', 'dase_capability_menu_jersey_sets', __( 'Please enter a valid capability in the "Menu Jersey Sets" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_jersey_sets' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_stadiums_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-stadiums" name="dase_capability_menu_stadiums" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_stadiums' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Stadiums" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_stadiums_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_stadiums', 'dase_capability_menu_stadiums', __( 'Please enter a valid capability in the "Menu Stadiums" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_stadiums' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_trophies_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-trophies" name="dase_capability_menu_trophies" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_trophies' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Trophies" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_trophies_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_trophies', 'dase_capability_menu_trophies', __( 'Please enter a valid capability in the "Menu Trophies" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_trophies' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_trophy_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-trophy-types" name="dase_capability_menu_trophy_types" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_trophy_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Trophy Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_trophy_types_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_trophy_types', 'dase_capability_menu_trophy_types', __( 'Please enter a valid capability in the "Trophy Types" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_trophy_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_ranking_transitions_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-ranking-transitions" name="dase_capability_menu_ranking_transitions" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_ranking_transitions' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Ranking Transitions" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_ranking_transitions_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_ranking_transitions', 'dase_capability_menu_ranking_transitions', __( 'Please enter a valid capability in the "Ranking Transitions" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_ranking_transitions' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_ranking_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-ranking-types" name="dase_capability_menu_ranking_types" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_ranking_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Ranking Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_ranking_types_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_ranking_types', 'dase_capability_menu_ranking_types', __( 'Please enter a valid capability in the "Menu Ranking Types" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_ranking_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_matches_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-matches" name="dase_capability_menu_matches" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_matches' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Matches" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_matches_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_matches', 'dase_capability_menu_matches', __( 'Please enter a valid capability in the "Menu Matches" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_matches' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_events_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-events" name="dase_capability_menu_events" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_events' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Events" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_events_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_events', 'dase_capability_menu_events', __( 'Please enter a valid capability in the "Menu Events" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_events' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_events_wizard_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-events-wizard" name="dase_capability_menu_events_wizard" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_events_wizard' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Events Wizard" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_events_wizard_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_events_wizard', 'dase_capability_menu_events_wizard', __( 'Please enter a valid capability in the "Menu Events Wizard" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_events_wizard' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_competitions_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-competitions" name="dase_capability_menu_competitions" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_competitions' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Competitions" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_competitions_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_competitions', 'dase_capability_menu_competitions', __( 'Please enter a valid capability in the "Menu Competitions" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_competitions' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_transfers_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-transfers" name="dase_capability_menu_transfers" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_transfers' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Transfers" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_transfers_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_transfers', 'dase_capability_menu_transfers', __( 'Please enter a valid capability in the "Menu Transfers" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_transfers' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_transfer_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-transfer-types" name="dase_capability_menu_transfer_types" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_transfer_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Transfer Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_transfer_types_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_transfer_types', 'dase_capability_menu_transfer_types', __( 'Please enter a valid capability in the "Menu Transfer Types" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_transfer_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_team_contracts_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-team-contracts" name="dase_capability_menu_team_contracts" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_team_contracts' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Team Contracts" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_team_contracts_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_team_contracts', 'dase_capability_menu_team_contracts', __( 'Please enter a valid capability in the "Menu Team Contracts" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_team_contracts' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_team_contract_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-team_contract-types" name="dase_capability_menu_team_contract_types" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_team_contract_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Team Contract Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_team_contract_types_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_team_contract_types', 'dase_capability_menu_team_contract_types', __( 'Please enter a valid capability in the "Menu Team Contract Types" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_team_contract_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_agencies_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-agencies" name="dase_capability_menu_agencies" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_agencies' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Agencies" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_agencies_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_agencies', 'dase_capability_menu_agencies', __( 'Please enter a valid capability in the "Menu Agencies" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_agencies' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_agency_contracts_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-agency-contracts" name="dase_capability_menu_agency_contracts" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_agency_contracts' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Agency Contracts" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_agency_contracts_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_agency_contracts', 'dase_capability_menu_agency_contracts', __( 'Please enter a valid capability in the "Menu Agency Contracts" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_agency_contracts' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_agency_contract_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-agency-contract-types" name="dase_capability_menu_agency_contract_types" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_agency_contract_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Agency Contract Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_agency_contract_types_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_agency_contract_types', 'dase_capability_menu_agency_contract_types', __( 'Please enter a valid capability in the "Menu Agency Contract Types" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_agency_contract_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_menu_market_value_transitions_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-menu-market-value-transitions" name="dase_capability_menu_market_value_transitions" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_menu_market_value_transitions' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the "Market Value Transition" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_menu_market_value_transitions_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_menu_market_value_transitions', 'dase_capability_menu_market_value_transitions', __( 'Please enter a valid capability in the "Menu Market Value Transition" option.', 'dase' ) );
			$output = get_option( 'dase_capability_menu_market_value_transitions' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function capability_rest_api_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-capability-rest-api" name="dase_capability_rest_api" class="regular-text" value="' . esc_attr( get_option( 'dase_capability_rest_api' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The capability required to get access on the REST API.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function capability_rest_api_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_capability, $input ) ) {
			add_settings_error( 'dase_capability_rest_api', 'dase_capability_menu_rest_api', __( 'Please enter a valid capability in the "REST API" option.', 'dase' ) );
			$output = get_option( 'dase_capability_rest_api' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_players_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-players" name="dase_pagination_menu_players" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_players' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Players" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_players_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_players', 'dase_pagination_menu_players', __( 'Please enter a valid value in the "Menu Players" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_players' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_player_positions_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-player-positions" name="dase_pagination_menu_player_positions" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_player_positions' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Player Positions" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_player_positions_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_player_positions', 'dase_pagination_menu_player_positions', __( 'Please enter a valid value in the "Menu Player Positions" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_player_positions' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_player_awards_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-player-awards" name="dase_pagination_menu_player_awards" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_player_awards' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Player Positions" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_player_awards_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_player_awards', 'dase_pagination_menu_player_awards', __( 'Please enter a valid value in the "Menu Player Awards" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_player_awards' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_player_award_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-player-award-types" name="dase_pagination_menu_player_award_types" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_player_award_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Player Award Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_player_award_types_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_player_award_types', 'dase_pagination_menu_player_award_types', __( 'Please enter a valid value in the "Menu Player Award Types" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_player_award_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_unavailable_players_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-unavailable-players" name="dase_pagination_menu_unavailable_players" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_unavailable_players' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Unavailable Players" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_unavailable_players_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_unavailable_players', 'dase_pagination_menu_unavailable_players', __( 'Please enter a valid value in the "Menu Unavailable Players" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_unavailable_players' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}


	public function pagination_menu_unavailable_player_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-unavailable-player-types" name="dase_pagination_menu_unavailable_player_types" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_unavailable_player_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Unavailable Player Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_unavailable_player_types_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_unavailable_player_types', 'dase_pagination_menu_unavailable_player_types', __( 'Please enter a valid value in the "Menu Unavailable Player Types" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_unavailable_player_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}


	public function pagination_menu_injuries_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-injuries" name="dase_pagination_menu_injuries" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_injuries' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Injuries" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_injuries_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_injuries', 'dase_pagination_menu_injuries', __( 'Please enter a valid value in the "Menu Injuries" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_injuries' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}


	public function pagination_menu_injury_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-injury-types" name="dase_pagination_menu_injury_types" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_injury_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Injury Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_injury_types_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_injury_types', 'dase_pagination_menu_injury_types', __( 'Please enter a valid value in the "Menu Injury Types" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_injury_type' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_staff_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-staff" name="dase_pagination_menu_staff" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_staff' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Staff" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_staff_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_staff', 'dase_pagination_menu_staff', __( 'Please enter a valid value in the "Menu Staff" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_staff' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_staff_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-staff-types" name="dase_pagination_menu_staff_types" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_staff_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Staff Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_staff_types_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_staff_types', 'dase_pagination_menu_staff_types', __( 'Please enter a valid value in the "Menu Staff Types" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_staff_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_staff_awards_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-staff-awards" name="dase_pagination_menu_staff_awards" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_staff_awards' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Staff Awards" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_staff_awards_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_staff_awards', 'dase_pagination_menu_staff_awards', __( 'Please enter a valid value in the "Menu Staff Awards" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_staff_awards' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_staff_award_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-staff-award-types" name="dase_pagination_menu_staff_award_types" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_staff_award_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Staff Award Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_staff_award_types_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_staff_award_types', 'dase_pagination_menu_staff_award_types', __( 'Please enter a valid value in the "Menu Staff Award Types" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_staff_award_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}


	public function pagination_menu_referees_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-referees" name="dase_pagination_menu_referees" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_referees' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Referees" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_referees_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_referees', 'dase_F', __( 'Please enter a valid value in the "Menu Referees" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_referees' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_referee_badges_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-referee_badges" name="dase_pagination_menu_referee_badges" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_referee_badges' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Players" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_referee_badges_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_referee_badges', 'dase_pagination_menu_referee_badges', __( 'Please enter a valid value in the "Menu Referee Badges" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_referee_badges' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_referee_badge_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-referee-badge-types" name="dase_pagination_menu_referee_badge_types" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_referee_badge_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Players" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_referee_badge_types_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_referee_badge_types', 'dase_pagination_menu_referee_badge_types', __( 'Please enter a valid value in the "Menu Referee Badge Types" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_referee_badge_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_teams_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-teams" name="dase_pagination_menu_teams" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_teams' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Teams" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_teams_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_teams', 'dase_pagination_menu_teams', __( 'Please enter a valid value in the "Menu Teams" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_teams' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_squads_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-squads" name="dase_pagination_menu_squads" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_squads' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Squads" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_squads_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_squads', 'dase_pagination_menu_squads', __( 'Please enter a valid value in the "Menu Squads" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_squads' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_formations_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-formations" name="dase_pagination_menu_formations" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_formations' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Formations" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_formations_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_formations', 'dase_pagination_menu_formations', __( 'Please enter a valid value in the "Menu Formations" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_formations' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_jersey_sets_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-jersey-sets" name="dase_pagination_menu_jersey_sets" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_jersey_sets' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Jersey Sets" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_jersey_sets_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_jersey_sets', 'dase_pagination_menu_jersey_sets', __( 'Please enter a valid value in the "Menu Jersey Sets" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_jersey_sets' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_stadiums_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-sadiums" name="dase_pagination_menu_stadiums" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_stadiums' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Stadiums" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_stadiums_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_stadiums', 'dase_pagination_menu_stadiums', __( 'Please enter a valid value in the "Menu Stadiums" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_stadiums' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_trophies_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-trophies" name="dase_pagination_menu_trophies" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_trophies' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Trophies" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_trophies_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_trophies', 'dase_pagination_menu_trophies', __( 'Please enter a valid value in the "Menu Trophies" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_trophies' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_trophy_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-trophy-types" name="dase_pagination_menu_trophy_types" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_trophy_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Trophy Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_trophy_types_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_trophy_types', 'dase_pagination_menu_trophy_types', __( 'Please enter a valid value in the "Menu Trophy Ty" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_trophy_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_ranking_transitions_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-ranking-transitions" name="dase_pagination_menu_ranking_transitions" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_ranking_transitions' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Ranking Transitions" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_ranking_transitions_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_ranking_transitions', 'dase_pagination_menu_ranking_transitions', __( 'Please enter a valid value in the "Menu Ranking Transitions" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_ranking_transitions' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_ranking_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-ranking-types" name="dase_pagination_menu_ranking_types" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_ranking_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Ranking Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_ranking_types_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 || $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_ranking_types', 'dase_pagination_menu_ranking_types', __( 'Please enter a valid value in the "Menu Ranking Types" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_ranking_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_matches_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-matches" name="dase_pagination_menu_matches" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_matches' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Matches" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_matches_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 || $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_matches', 'dase_pagination_menu_matches', __( 'Please enter a valid value in the "Menu Matches" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_matches' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_events_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-events" name="dase_pagination_menu_events" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_events' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Events" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_events_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 || $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_events', 'dase_pagination_menu_events', __( 'Please enter a valid value in the "Menu Events" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_events' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_competitions_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-competitions" name="dase_pagination_menu_competitions" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_competitions' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Competitions" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_competitions_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 || $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_competitions', 'dase_pagination_menu_competitions', __( 'Please enter a valid value in the "Menu Competitions" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_competitions' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_transfers_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-transfers" name="dase_pagination_menu_transfers" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_transfers' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Transfers" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_transfers_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 || $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_transfers', 'dase_pagination_menu_transfers', __( 'Please enter a valid value in the "Menu Transfers" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_transfers' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_transfer_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-transfer-types" name="dase_pagination_menu_transfer_types" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_transfer_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Transfer Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_transfer_types_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 || $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_transfer_types', 'dase_pagination_menu_transfer_types', __( 'Please enter a valid value in the "Menu Transfer Types" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_transfer_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_team_contracts_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-team-contracts" name="dase_pagination_menu_team_contracts" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_team_contracts' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Team Contracts" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_team_contracts_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 || $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_team_contracts', 'dase_pagination_menu_team_contracts', __( 'Please enter a valid value in the "Menu Team Contracts" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_team_contracts' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_team_contract_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-team-contract-types" name="dase_pagination_menu_team_contract_types" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_team_contract_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Team Contract Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_team_contract_types_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 || $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_team_contract_types', 'dase_pagination_menu_team_contract_types', __( 'Please enter a valid value in the "Menu Team Contract Types" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_team_contract_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_agencies_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-agencies" name="dase_pagination_menu_agencies" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_agencies' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Agencies" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_agencies_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_agencies', 'dase_pagination_menu_agencies', __( 'Please enter a valid value in the "Menu Agencies" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_agencies' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_agency_contracts_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-agency-contracts" name="dase_pagination_menu_agency_contracts" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_agency_contracts' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Agency Contracts" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_agency_contracts_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 || $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_agency_contracts', 'dase_pagination_menu_agency_contracts', __( 'Please enter a valid value in the "Menu Agency Contracts" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_agency_contracts' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_agency_contract_types_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-agency-contract-types" name="dase_pagination_menu_agency_contract_types" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_agency_contract_types' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Agency Contract Types" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_agency_contract_types_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 || $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_agency_contract_types', 'dase_pagination_menu_agency_contract_types', __( 'Please enter a valid value in the "Menu Agency Contract Types" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_agency_contract_types' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function pagination_menu_market_value_transitions_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-pagination-menu-market-value-transitions" name="dase_pagination_menu_market_value_transitions" class="regular-text" value="' . esc_attr( get_option( 'dase_pagination_menu_market_value_transitions' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This options determines the number of elements per page displayed in the "Market Value Transitions" menu.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function pagination_menu_market_value_transitions_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 || $input > 1000 ) {
			add_settings_error( 'dase_pagination_menu_market_value_transitions', 'dase_pagination_menu_market_value_transitions', __( 'Please enter a valid value in the "Menu Market Value Transitions" option.', 'dase' ) );
			$output = get_option( 'dase_pagination_menu_market_value_transitions' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	// Advanced Section -------------------------------------------------------------------------------------------------
	public function money_format_decimal_separator_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-money-format-decimal-separator" name="dase_money_format_decimal_separator" class="regular-text" value="' . esc_attr( get_option( 'dase_money_format_decimal_separator' ) ) . '" />';
		$html .= '<div maxlength="3" class="help-icon" title="' . esc_attr(
			__(
				'The number of decimals displayed in the money format.',
				'dase'
			)
		) . '"></div>';

		echo $html;
	}

	public function money_format_decimal_separator_validation( $input ) {

		if ( strlen( $input ) > 3 ) {
			add_settings_error(
				'dase_money_format_decimal_separator',
				'dase_money_format_decimal_separator',
				__( 'Please enter a valid decimal separator in the "Money Format Decimal Separator" field.', 'dase' )
			);
			$output = get_option( 'dase_money_format_decimal_separator' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function money_format_thousands_separator_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-money-format-thousands-separator" name="dase_money_format_thousands_separator" class="regular-text" value="' . esc_attr( get_option( 'dase_money_format_thousands_separator' ) ) . '" />';
		$html .= '<div maxlength="3" class="help-icon" title="' . esc_attr(
			__(
				'The thousands separator displayed in the money format.',
				'dase'
			)
		) . '"></div>';

		echo $html;
	}

	public function money_format_thousands_separator_validation( $input ) {

		if ( strlen( $input ) > 3 ) {
			add_settings_error(
				'dase_money_format_thousands_separator',
				'dase_money_format_thousands_separator',
				__( 'Please enter a valid decimal separator in the "Money Format Thousands Separator" field.', 'dase' )
			);
			$output = get_option( 'dase_money_format_thousands_separator' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function money_format_decimals_callback( $args ) {

		$html  = '<input maxlength=1 autocomplete="off" type="text" id="dase-money-format-decimals" name="dase_money_format_decimals" class="regular-text" value="' . esc_attr( get_option( 'dase_money_format_decimals' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr(
			__(
				'The number of decimals displayed in the money format.',
				'dase'
			)
		) . '"></div>';

		echo $html;
	}

	public function money_format_decimals_validation( $input ) {

		if ( intval( $input, 10 ) < 0 || intval( $input, 10 ) > 9 ) {
			add_settings_error(
				'dase_money_format_decimals',
				'dase_money_format_decimals',
				__( 'Please enter a valid number of decimals in the "Money Format Decimals" field.', 'dase' )
			);
			$output = get_option( 'dase_money_format_decimals' );
		} else {
			$output = $input;
		}

		return intval( $output, 10 );
	}

	public function money_format_simplify_million_callback( $args ) {

		$html  = '<select id="dase-money-format-simplify-million" name="dase_money_format_simplify_million" class="daext-display-none">';
		$html .= '<option ' . selected( intval( get_option( 'dase_money_format_simplify_million' ) ), 0, false ) . ' value="0">' . __( 'No', 'dase' ) . '</option>';
		$html .= '<option ' . selected( intval( get_option( 'dase_money_format_simplify_million' ) ), 1, false ) . ' value="1">' . __( 'Yes', 'dase' ) . '</option>';
		$html .= '</select>';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This option determines if the values over one million should be simplified.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function money_format_simplify_million_validation( $input ) {

		return intval( $input, 10 ) == 1 ? '1' : '0';
	}

	public function money_format_simplify_million_decimals_callback( $args ) {

		$html  = '<input maxlength=1 autocomplete="off" type="text" id="dase-money-format-simplify-million-decimals" name="dase_money_format_simplify_million_decimals" class="regular-text" value="' . esc_attr( get_option( 'dase_money_format_simplify_million_decimals' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr(
			__(
				'The number of decimals displayed in the money format simplify million.',
				'dase'
			)
		) . '"></div>';

		echo $html;
	}

	public function money_format_simplify_million_decimals_validation( $input ) {

		if ( intval( $input, 10 ) < 0 || intval( $input, 10 ) > 9 ) {
			add_settings_error(
				'dase_money_format_simplify_million_decimals',
				'dase_money_format_simplify_million_decimals',
				__( 'Please enter a valid number of decimals in the "Money Format Simplify Million Decimals" field.', 'dase' )
			);
			$output = get_option( 'dase_money_format_simplify_million_decimals' );
		} else {
			$output = $input;
		}

		return intval( $output, 10 );
	}

	public function money_format_million_symbol_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-money-format-million-symbol" name="dase_money_format_million_symbol" class="regular-text" value="' . esc_attr( get_option( 'dase_money_format_million_symbol' ) ) . '" />';
		$html .= '<div maxlength="3" class="help-icon" title="' . esc_attr(
			__(
				'The million symbol in the money format.',
				'dase'
			)
		) . '"></div>';

		echo $html;
	}

	public function money_format_million_symbol_validation( $input ) {

		if ( strlen( $input ) > 3 ) {
			add_settings_error(
				'dase_money_format_million_symbol',
				'dase_money_format_million_symbol',
				__( 'Please enter a valid million symbol in the "Money Format Million Symbol" field.', 'dase' )
			);
			$output = get_option( 'dase_money_format_million_symbol' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function money_format_simplify_thousands_callback( $args ) {

		$html  = '<select id="dase-money-format-simplify-thousands" name="dase_money_format_simplify_thousands" class="daext-display-none">';
		$html .= '<option ' . selected( intval( get_option( 'dase_money_format_simplify_thousands' ) ), 0, false ) . ' value="0">' . __( 'No', 'dase' ) . '</option>';
		$html .= '<option ' . selected( intval( get_option( 'dase_money_format_simplify_thousands' ) ), 1, false ) . ' value="1">' . __( 'Yes', 'dase' ) . '</option>';
		$html .= '</select>';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This option determines if the values over one thousand should be simplified.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function money_format_simplify_thousands_validation( $input ) {

		return intval( $input, 10 ) == 1 ? '1' : '0';
	}

	public function money_format_simplify_thousands_decimals_callback( $args ) {

		$html  = '<input maxlength=1 autocomplete="off" type="text" id="dase-money-format-simplify-thousands-decimals" name="dase_money_format_simplify_thousands_decimals" class="regular-text" value="' . esc_attr( get_option( 'dase_money_format_simplify_thousands_decimals' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr(
			__(
				'The number of decimals displayed in the money format simplify thousands.',
				'dase'
			)
		) . '"></div>';

		echo $html;
	}

	public function money_format_simplify_thousands_decimals_validation( $input ) {

		if ( intval( $input, 10 ) < 0 || intval( $input, 10 ) > 9 ) {
			add_settings_error(
				'dase_money_format_simplify_thousands_decimals',
				'dase_money_format_simplify_thousands_decimals',
				__( 'Please enter a valid number of decimals in the "Money Format Simplify Thousands Decimals" field.', 'dase' )
			);
			$output = get_option( 'dase_money_format_simplify_thousands_decimals' );
		} else {
			$output = $input;
		}

		return intval( $output, 10 );
	}

	public function money_format_thousands_symbol_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-money-format-thousands-symbol" name="dase_money_format_thousands_symbol" class="regular-text" value="' . esc_attr( get_option( 'dase_money_format_thousands_symbol' ) ) . '" />';
		$html .= '<div maxlength="3" class="help-icon" title="' . esc_attr(
			__(
				'The thousands symbol in the money format.',
				'dase'
			)
		) . '"></div>';

		echo $html;
	}

	public function money_format_thousands_symbol_validation( $input ) {

		if ( strlen( $input ) > 3 ) {
			add_settings_error(
				'dase_money_format_thousands_symbol',
				'dase_money_format_thousands_symbol',
				__( 'Please enter a valid thousands symbol in the "Money Format Thousands Symbol" field.', 'dase' )
			);
			$output = get_option( 'dase_money_format_thousands_symbol' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function money_format_currency_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-money-format-currency" name="dase_money_format_currency" class="regular-text" value="' . esc_attr( get_option( 'dase_money_format_currency' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr(
			__(
				'The currency of the money format.',
				'dase'
			)
		) . '"></div>';

		echo $html;
	}

	public function money_format_currency_validation( $input ) {

		if ( strlen( trim( $input ) ) < 1 or strlen( trim( $input ) ) > 10 ) {
			add_settings_error(
				'dase_money_format_currency',
				'dase_money_format_currency',
				__( 'Please enter a valid currency in the "Money Format Currency" field.', 'dase' )
			);
			$output = get_option( 'dase_money_format_currency' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function money_format_currency_position_callback( $args ) {

		$html  = '<select id="dase-money-format-currency-position" name="dase_money_format_currency_position" class="daext-display-none">';
		$html .= '<option ' . selected( intval( get_option( 'dase_money_format_currency_position' ) ), 0, false ) . ' value="0">' . __( 'Left', 'dase' ) . '</option>';
		$html .= '<option ' . selected( intval( get_option( 'dase_money_format_currency_position' ) ), 1, false ) . ' value="1">' . __( 'Right', 'dase' ) . '</option>';
		$html .= '</select>';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The currency position in the money format.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function money_format_currency_position_validation( $input ) {

		return intval( $input, 10 ) == 1 ? '1' : '0';
	}

	public function height_measurement_unit_callback( $args ) {

		$html  = '<select id="dase-height-measurement-unit" name="dase_height_measurement_unit" class="daext-display-none">';
		$html .= '<option ' . selected( intval( get_option( 'dase_height_measurement_unit' ) ), 0, false ) . ' value="0">' . __( 'Meter', 'dase' ) . '</option>';
		$html .= '<option ' . selected( intval( get_option( 'dase_height_measurement_unit' ) ), 1, false ) . ' value="1">' . __( 'Inch', 'dase' ) . '</option>';
		$html .= '</select>';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The measurement unit used for the height.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function height_measurement_unit_validation( $input ) {

		return intval( $input, 10 ) == 1 ? '1' : '0';
	}

	public function set_max_execution_time_callback( $args ) {

		$html  = '<select id="dase-set-max-execution-time" name="dase_set_max_execution_time" class="daext-display-none">';
		$html .= '<option ' . selected( intval( get_option( 'dase_set_max_execution_time' ) ), 0, false ) . ' value="0">' . __( 'No', 'dase' ) . '</option>';
		$html .= '<option ' . selected( intval( get_option( 'dase_set_max_execution_time' ) ), 1, false ) . ' value="1">' . __( 'Yes', 'dase' ) . '</option>';
		$html .= '</select>';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'Select "Yes" to enable a custom "Max Execution Time Value" on resource intensive scripts.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function set_max_execution_time_validation( $input ) {

		return intval( $input, 10 ) == 1 ? '1' : '0';
	}

	public function max_execution_time_value_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-max-execution-time-value" name="dase_max_execution_time_value" class="regular-text" value="' . esc_attr( get_option( 'dase_max_execution_time_value' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr(
			__(
				'This value determines the maximum number of seconds allowed to execute resource intensive scripts.',
				'dase'
			)
		) . '"></div>';

		echo $html;
	}

	public function max_execution_time_value_validation( $input ) {

		if ( intval( $input, 10 ) < 1 or intval( $input, 10 ) > 1000000 ) {
			add_settings_error(
				'dase_max_execution_time_value',
				'dase_max_execution_time_value',
				__( 'Please enter a number from 1 to 1000000 in the "Max Execution Time Value" option.', 'dase' )
			);
			$output = get_option( 'dase_max_execution_time_value' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function set_memory_limit_callback( $args ) {

		$html  = '<select id="dase-set-memory-limit" name="dase_set_memory_limit" class="daext-display-none">';
		$html .= '<option ' . selected( intval( get_option( 'dase_set_memory_limit' ) ), 0, false ) . ' value="0">' . __( 'No', 'dase' ) . '</option>';
		$html .= '<option ' . selected( intval( get_option( 'dase_set_memory_limit' ) ), 1, false ) . ' value="1">' . __( 'Yes', 'dase' ) . '</option>';
		$html .= '</select>';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'Select "Yes" to enable a custom "Memory Limit Value" on resource intensive scripts.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function set_memory_limit_validation( $input ) {

		return intval( $input, 10 ) == 1 ? '1' : '0';
	}

	public function memory_limit_value_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-memory-limit-value" name="dase_memory_limit_value" class="regular-text" value="' . esc_attr( get_option( 'dase_memory_limit_value' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr(
			__(
				'This value determines the PHP memory limit in megabytes allowed to execute resource intensive scripts.',
				'dase'
			)
		) . '"></div>';

		echo $html;
	}

	public function memory_limit_value_validation( $input ) {

		if ( intval( $input, 10 ) < 0 or intval( $input, 10 ) > 1000000 ) {
			add_settings_error(
				'dase_memory_limit_value',
				'dase_memory_limit_value',
				__( 'Please enter a number from 1 to 1000000 in the "Memory Limit Value" option.', 'dase' )
			);
			$output = get_option( 'dase_memory_limit_value' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function transient_expiration_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-transient-expiration" name="dase_transient_expiration" class="regular-text" value="' . esc_attr( get_option( 'dase_transient_expiration' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr(
			__(
				'Enter the transient expiration in seconds or set 0 to not use a transient.',
				'dase'
			)
		) . '"></div>';

		echo $html;
	}

	public function transient_expiration_validation( $input ) {

		if ( intval( $input, 10 ) < 0 or intval( $input, 10 ) > 1000000 ) {
			add_settings_error(
				'dase_transient_expiration',
				'dase_transient_expiration',
				__( 'Please enter a number from 1 to 1000000 in the "Transient Expiration" option.', 'dase' )
			);
			$output = get_option( 'dase_transient_expiration' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function rest_api_authentication_read_callback( $args ) {

		$html  = '<select id="dase-rest-api-authentication-read" name="dase_rest_api_authentication_read" class="daext-display-none">';
		$html .= '<option ' . selected( intval( get_option( 'dase_rest_api_authentication_read' ) ), 0, false ) . ' value="0">' . __( 'Cookies', 'dase' ) . '</option>';
		$html .= '<option ' . selected( intval( get_option( 'dase_rest_api_authentication_read' ) ), 1, false ) . ' value="1">' . __( 'REST API Key', 'dase' ) . '</option>';
		$html .= '<option ' . selected( intval( get_option( 'dase_rest_api_authentication_read' ) ), 2, false ) . ' value="2">' . __( 'None', 'dase' ) . '</option>';
		$html .= '</select>';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This option determines the type of authentication required to get access on the REST API endpoints of type "Read".', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function rest_api_authentication_read_validation( $input ) {

		return intval( $input, 10 );
	}

	public function rest_api_authentication_create_callback( $args ) {

		$html  = '<select id="dase-rest-api-authentication-create" name="dase_rest_api_authentication_create" class="daext-display-none">';
		$html .= '<option ' . selected( intval( get_option( 'dase_rest_api_authentication_create' ) ), 0, false ) . ' value="0">' . __( 'Cookies', 'dase' ) . '</option>';
		$html .= '<option ' . selected( intval( get_option( 'dase_rest_api_authentication_create' ) ), 1, false ) . ' value="1">' . __( 'REST API Key', 'dase' ) . '</option>';
		$html .= '</select>';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'This option determines the type of authentication required to get access on the REST API endpoints of type "Create".', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function rest_api_authentication_create_validation( $input ) {

		return intval( $input, 10 );
	}

	public function rest_api_key_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-rest-api-key" name="dase_rest_api_key" class="regular-text" value="' . esc_attr( get_option( 'dase_rest_api_key' ) ) . '" />';
		$html .= '<div maxlength="1024" class="help-icon" title="' . esc_attr(
			__(
				'The REST API key.',
				'dase'
			)
		) . '"></div>';

		echo $html;
	}

	public function rest_api_key_validation( $input ) {

		if ( strlen( trim( $input ) ) < 128 ) {
			add_settings_error(
				'dase_block_margin_top',
				'dase_block_margin_top',
				__( 'Please enter a REST API Key length with at least 128 characters.', 'dase' )
			);
			$output = get_option( 'dase_rest_api_key' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function block_margin_top_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-block-margin-top" name="dase_block_margin_top" class="regular-text" value="' . esc_attr( get_option( 'dase_block_margin_top' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr(
			__(
				'The top margin of the blocks.',
				'dase'
			)
		) . '"></div>';

		echo $html;
	}

	public function block_margin_top_validation( $input ) {

		if ( intval( $input, 10 ) < 0 && intval( $input, 10 ) > 1000000 ) {
			add_settings_error(
				'dase_block_margin_top',
				'dase_block_margin_top',
				__( 'Please enter a number from 0 to 1000000 in the "Block Margin Top" option.', 'dase' )
			);
			$output = get_option( 'dase_block_margin_top' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function block_margin_bottom_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-block-margin-bottom" name="dase_block_margin_bottom" class="regular-text" value="' . esc_attr( get_option( 'dase_block_margin_bottom' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr(
			__(
				'The bottom margin of the blocks.',
				'dase'
			)
		) . '"></div>';

		echo $html;
	}

	public function block_margin_bottom_validation( $input ) {

		if ( intval( $input, 10 ) < 0 && intval( $input, 10 ) > 1000000 ) {
			add_settings_error(
				'dase_block_margin_bottom',
				'dase_block_margin_bottom',
				__( 'Please enter a number from 0 to 1000000 in the "Block Margin Bottom" option.', 'dase' )
			);
			$output = get_option( 'dase_block_margin_bottom' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function responsive_breakpoint_1_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-responsive-breakpoint-1" name="dase_responsive_breakpoint_1" class="regular-text" value="' . esc_attr( get_option( 'dase_responsive_breakpoint_1' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr(
			__(
				'When the browser viewport width goes below the value in pixels defined with this option the first responsive version of the layout elements generated by the plugin will be enabled.',
				'dase'
			)
		) . '"></div>';

		echo $html;
	}

	public function responsive_breakpoint_1_validation( $input ) {

		if ( intval( $input, 10 ) < 1 && intval( $input, 10 ) > 1000000 ) {
			add_settings_error(
				'dase_responsive_breakpoint_1',
				'dase_responsive_breakpoint_1',
				__( 'Please enter a number from 1 to 1000000 in the "Responsive Breakpoint 1" option.', 'dase' )
			);
			$output = get_option( 'dase_responsive_breakpoint_1' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function responsive_breakpoint_2_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-responsive-breakpoint-2" name="dase_responsive_breakpoint_2" class="regular-text" value="' . esc_attr( get_option( 'dase_responsive_breakpoint_2' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr(
			__(
				'When the browser viewport width goes below the value in pixels defined with this option the second responsive version of the layout elements generated by the plugin will be enabled.',
				'dase'
			)
		) . '"></div>';

		echo $html;
	}

	public function responsive_breakpoint_2_validation( $input ) {

		if ( intval( $input, 10 ) < 1 && intval( $input, 10 ) > 1000000 ) {
			add_settings_error(
				'dase_responsive_breakpoint_2',
				'dase_responsive_breakpoint_2',
				__( 'Please enter a number from 1 to 1000000 in the "Responsive Breakpoint 2" option.', 'dase' )
			);
			$output = get_option( 'dase_responsive_breakpoint_2' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function font_family_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-font-family" name="dase_font_family" class="regular-text" value="' . esc_attr( get_option( 'dase_font_family' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr( __( 'The font family of the text displayed in all the layout elements generated by the plugin.', 'dase' ) ) . '"></div>';

		echo $html;
	}

	public function font_family_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_font_family_or_font_families, $input ) ) {
			add_settings_error( 'dase_font_family', 'dase_table_pagination_font_family', __( 'Please enter a valid font family in the "Font Family" option.', 'dase' ) );
			$output = get_option( 'dase_font_family' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function google_font_url_callback( $args ) {

		$html  = '<input autocomplete="off" type="text" id="dase-google-font-url" name="dase_google_font_url" class="regular-text" value="' . esc_attr( get_option( 'dase_google_font_url' ) ) . '" />';
		$html .= '<div class="help-icon" title="' . esc_attr(
			__(
				'The URL of the Google Font loaded by the plugin in the front-end.',
				'dase'
			)
		) . '"></div>';

		echo $html;
	}

	public function google_font_url_validation( $input ) {

		if ( ! preg_match( $this->shared->url_regex, $input ) and strlen( trim( $input ) ) > 0 ) {
			add_settings_error( 'dase_google_font_url', 'dase_google_font_url', __( 'Please enter a valid URL in the "Google Font 1" option.', 'dase' ) );
			$output = get_option( 'dase_google_font_url' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}
}
