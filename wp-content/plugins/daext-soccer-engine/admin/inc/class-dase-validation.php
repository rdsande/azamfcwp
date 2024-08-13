<?php
/**
 * This class includes validation functions used in the back-end menus and in the REST API.
 *
 * @package daext-soccer-engine
 */

/**
 * This class includes validation functions used in the back-end menus and in the REST API.
 */
class Dase_Validation {

	private $shared = null;

	public function __construct( $shared ) {

		// assign an instance of the plugin info.
		$this->shared = $shared;

		// Validation functions ---------------------------------------------------------------------------------------.
	}

	// Simple Validations ---------------------------------------------------------------------------------------------.
	private function validate_text_0_255( $value ) {

		if ( preg_match( '/^.{0,255}$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_text_1_255( $value ) {

		if ( preg_match( '/^.{1,255}$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_url( $value ) {

		if ( preg_match( '/^.{0,2083}$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_url_empty_allowed( $value ) {

		if ( preg_match( '/^.{0,2083}$/u', $value ) === 1 or
			strlen( trim( $value ) ) === 0 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_tinyint_unsigned( $value ) {

		if ( preg_match( '/^\d{1,3}$/u', $value ) === 1 and
			intval( $value, 10 ) <= 255 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_int_unsigned( $value ) {

		if ( preg_match( '/^\d{1,10}$/u', $value ) === 1 and
			intval( $value, 10 ) <= 4294967295 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_bigint_unsigned( $value ) {

		if ( preg_match( '/^\d{1,20}$/u', $value ) === 1 and
			intval( $value, 10 ) <= 18446744073709551616 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_date( $value ) {

		if ( preg_match( '/^\d{4}-\d{2}-\d{2}$/u', $value ) ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_date_empty_allowed( $value ) {

		if ( $value === null or
			preg_match( '/^\d{4}-\d{2}-\d{2}$/u', $value ) or
			strlen( trim( $value ) ) === 0 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_time( $value ) {

		// Ref: https://stackoverflow.com/questions/7536755/regular-expression-for-matching-hhmm-time-format
		if ( preg_match( '/^(0[0-9]|1[0-9]|2[0-3]|[0-9]):[0-5][0-9]$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_time_empty_allowed( $value ) {

		// Ref: https://stackoverflow.com/questions/7536755/regular-expression-for-matching-hhmm-time-format .
		if ( preg_match( '/^(0[0-9]|1[0-9]|2[0-3]|[0-9]):[0-5][0-9]$/u', $value ) === 1
			or strlen( $value ) === 0 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_decimal_15_2( $value ) {

		if ( preg_match( '/^\d{1,15}(?:\.\d{1,2})?$/u', $value ) ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_bool( $value ) {

		if ( preg_match( '/^0|1$/u', $value ) ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_color( $value ) {

		if ( preg_match( '/^#(?:[0-9a-fA-F]{3}){1,2}$/u', $value ) ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_comma_separated_list_of_numbers( $value ) {

		if ( preg_match( '/^(\s*(\d+\s*,\s*)+\d+\s*|\s*\d+\s*)$/u', $value ) ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_rounds( $value ) {

		if ( intval( $value, 10 ) >= 1 and intval( $value, 10 ) <= 128 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_player_foot( $value ) {

		if ( preg_match( '/^0|1|2|3$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_competition_order_type( $value ) {

		if ( preg_match( '/^0|1|2$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_player_position_abbreviation( $value ) {

		if ( preg_match( '/^.{1,3}$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_team_slot( $value ) {

		if ( preg_match( '/^0|1$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_competition_order_by( $value ) {

		if ( preg_match( '/^0|1|2|3|4|5$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}


	private function validate_jersey_number( $value ) {

		if ( preg_match( '/^\d{0,3}$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_player_height( $value ) {

		if ( preg_match( '/^\d{0,3}$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_match_part( $value ) {

		if ( preg_match( '/^0|1|2|3|4$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_formation_position( $value ) {

		if ( preg_match( '/^\d{1,3}$/u', $value ) === 1 and
			intval( $value, 10 ) >= 0 and
			intval( $value, 10 ) <= 100 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_player_position_not_available_allowed( $id ) {

		if ( intval( $id, 10 ) === 0 ) {
			return true;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player_position';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE player_position_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function transfer_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_transfer_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE transfer_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function trophy_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_trophy_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE trophy_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function injury_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_injury_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE injury_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function ranking_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_ranking_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE ranking_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function referee_badge_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee_badge_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE referee_badge_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function competition_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_competition';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE competition_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function competition_exists_none_allowed( $id ) {

		if ( intval( $id, 10 ) === 0 ) {
			return true;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_competition';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE competition_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function formation_exists_none_allowed( $id ) {

		if ( intval( $id, 10 ) === 0 ) {
			return true;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_formation';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE formation_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function player_award_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player_award_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE player_award_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function player_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE player_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function unavailable_player_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_unavailable_player_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE unavailable_player_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function staff_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE staff_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function jersey_set_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_jersey_set';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE jersey_set_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function jersey_set_exists_none_allowed( $id ) {

		if ( intval( $id, 10 ) === 0 ) {
			return true;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_jersey_set';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE jersey_set_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function staff_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE staff_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function staff_award_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff_award_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE staff_award_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function stadium_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_stadium';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE stadium_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function stadium_exists_none_allowed( $id ) {

		if ( intval( $id, 10 ) === 0 ) {
			return true;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_stadium';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE stadium_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function team_contract_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team_contract_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE team_contract_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function agency_contract_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency_contract_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE agency_contract_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function agency_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE agency_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function team_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE team_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function team_exists_none_allowed( $id ) {

		if ( intval( $id, 10 ) === 0 ) {
			return true;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE team_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function referee_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE referee_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function referee_exists_none_allowed( $id ) {

		if ( intval( $id, 10 ) === 0 ) {
			return true;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE referee_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_country( $value ) {

		if ( preg_match( '/^\w{2}$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_country_none_allowed( $value ) {

		if ( preg_match( '/^\w{2}$/u', $value ) === 1
			or strlen( $value ) === 0 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_attendance( $value ) {

		if ( preg_match( '/^\d{0,10}$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_national_team_confederation( $value ) {

		if ( intval( $value, 10 ) >= 0 and intval( $value, 10 ) <= 5 ) {
			return true;
		} else {
			return false;
		}
	}

	// Custom Validations -----------------------------------------------------------------------------------------------

	/**
	 * The custom validation of the "Players" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function players_validation( $values, $update_id = false ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Single Fields Validations ------------------------------------------------------------------------------------

		// First Name
		if ( ! $this->validate_text_1_255( $values['first_name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "First Name" field.', 'dase' );
		}

		// Last Name
		if ( ! $this->validate_text_1_255( $values['last_name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Last Name" field.', 'dase' );
		}

		// Image
		if ( ! $this->validate_url_empty_allowed( $values['image'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Image" field.', 'dase' );
		}

		// Gender
		if ( ! $this->validate_bool( $values['gender'] ) ) {
			$result['messages'][] = __( 'Please enter a valid date in the "Date of Death" field.', 'dase' );
		}

		// Date of Birth
		if ( ! $this->validate_date_empty_allowed( $values['date_of_birth'] ) ) {
			$result['messages'][] = __( 'Please enter a valid date in the "Date of Birth" field.', 'dase' );
		}

		// Date of Birth
		if ( ! $this->validate_date_empty_allowed( $values['date_of_death'] ) ) {
			$result['messages'][] = __( 'Please enter a valid date in the "Date of Death" field.', 'dase' );
		}

		// Citizenship
		if ( ! $this->validate_country( $values['citizenship'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Citizenship" field.', 'dase' );
		}

		// Second Citizenship
		if ( ! $this->validate_country_none_allowed( $values['second_citizenship'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Second Citizenship" field.', 'dase' );
		}

		// Retired
		if ( ! $this->validate_bool( $values['retired'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Retired" field.', 'dase' );
		}

		// Player Position
		if ( ! $this->validate_player_position_not_available_allowed( $values['player_position_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Player Position" field.', 'dase' );
		}

		// Foot
		if ( ! $this->validate_player_foot( $values['foot'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Foot" field.', 'dase' );
		}

		// Height
		if ( ! $this->validate_player_height( $values['height'] ) ) {
			$result['messages'][] = __( 'Please enter a valid date in the "Height" field.', 'dase' );
		}

		// Custom Validation --------------------------------------------------------------------------------------------

		// Verify if the "Start Date" is before the "End Date.
		if ( $values['date_of_birth'] !== null and $values['date_of_death'] !== null and
												$values['date_of_birth'] > $values['date_of_death'] ) {
			$result['messages'][] = __( 'The "Date of Birth" must be before the "Date of Death".', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Player Positions" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function player_positions_validation( $values, $update_id = false ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Single Fields Validations ------------------------------------------------------------------------------------

		// Name
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		// Abbreviation
		if ( ! $this->validate_player_position_abbreviation( $values['abbreviation'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Abbreviation" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation used in the "Player Awards" menu and in 'daext-soccer-engine/v1/player_awards' REST API
	 * endpoint.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function player_awards_validation( $values, $update_id = false ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Single Fields Validations ------------------------------------------------------------------------------------

		// Player
		if ( ! $this->player_exists( $values['player_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Player" field.', 'dase' );
		}

		// Player Award Type
		if ( ! $this->player_award_type_exists( $values['player_award_type_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Player Award Type" field.', 'dase' );
		}

		// Asignment Date
		if ( ! $this->validate_date( $values['assignment_date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Assignment Date" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation used in the "Player Award Types" menu and in 'daext-soccer-engine/v1/player_award_types'
	 * REST API endpoint.
	 *
	 * If the form is valid an array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function player_award_types_validation( $values, $update_id = false ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Single Fields Validations ----------------------------------------------------------------------------------.

		// Name
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Referees" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function referees_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// First Name.
		if ( ! $this->validate_text_1_255( $values['first_name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "First Name" field.', 'dase' );
		}

		// Last Name.
		if ( ! $this->validate_text_1_255( $values['last_name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Last Name" field.', 'dase' );
		}

		// Image
		if ( ! $this->validate_url_empty_allowed( $values['image'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Image" field.', 'dase' );
		}

		// Gender.
		if ( ! $this->validate_bool( $values['gender'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Gender" field.', 'dase' );
		}

		// Date of Birth.
		if ( ! $this->validate_date_empty_allowed( $values['date_of_birth'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Date of Birth" field.', 'dase' );
		}

		// Date of Death.
		if ( ! $this->validate_date_empty_allowed( $values['date_of_death'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Date of Death" field.', 'dase' );
		}

		// Citizenship.
		if ( ! $this->validate_country( $values['citizenship'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Citizenship" field.', 'dase' );
		}

		// Second Citizenship.
		if ( ! $this->validate_country_none_allowed( $values['second_citizenship'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Second Citizenship" field.', 'dase' );
		}

		// Retired.
		if ( ! $this->validate_bool( $values['retired'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Retired" field.', 'dase' );
		}

		// Place of Birth.
		if ( ! $this->validate_text_0_255( $values['place_of_birth'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Place of Birth" field.', 'dase' );
		}

		// Residence.
		if ( ! $this->validate_text_0_255( $values['residence'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Residence" field.', 'dase' );
		}

		// Job.
		if ( ! $this->validate_text_0_255( $values['job'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Job" field.', 'dase' );
		}

		// Verify if the "Start Date" is before the "End Date.
		if ( $values['date_of_birth'] !== null and $values['date_of_death'] !== null and
												$values['date_of_birth'] > $values['date_of_death'] ) {
			$result['messages'][] = __( 'The "Date of Birth" must be before the "Date of Death".', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Matches" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function matches_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Single Fields Validations ----------------------------------------------------------------------------------.

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		// Competition.
		if ( ! $this->competition_exists_none_allowed( $values['competition_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Competition" field.', 'dase' );
		}

		// Team 1.
		if ( ! $this->team_exists( $values['team_id_1'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Team 1" field.', 'dase' );
		}

		// Team 2.
		if ( ! $this->team_exists( $values['team_id_2'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Team 2" field.', 'dase' );
		}

		// Date.
		if ( ! $this->validate_date( $values['date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Date" field.', 'dase' );
		}

		// Time.
		if ( ! $this->validate_time( $values['time'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Time" field. E.g. 9:30, 15:00, 20:45', 'dase' );
		}

		// First Half Additional Time.
		if ( ! $this->validate_tinyint_unsigned( $values['fh_additional_time'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "First Half Extra Time" field.', 'dase' );
		}

		// Second Half Additional Time.
		if ( ! $this->validate_tinyint_unsigned( $values['sh_additional_time'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Second Half Extra Time" field.', 'dase' );
		}

		// First Half Extra Time Additional Time.
		if ( ! $this->validate_tinyint_unsigned( $values['fh_extra_time_additional_time'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "First Half Extra Time Additional Time" field.', 'dase' );
		}

		// Second Half Extra Time Additional Time.
		if ( ! $this->validate_tinyint_unsigned( $values['sh_extra_time_additional_time'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Second Half Extra Time Additional Time" field.', 'dase' );
		}

		// Referee.
		if ( ! $this->referee_exists_none_allowed( $values['referee_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Referee" field.', 'dase' );
		}

		// Stadium.
		if ( ! $this->stadium_exists_none_allowed( $values['stadium_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Stadium" field.', 'dase' );
		}

		// Attendance.
		if ( ! $this->validate_attendance( $values['attendance'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Attendance" field.', 'dase' );
		}

		// Process the validations for both the teams.
		for ( $t = 1;$t <= 2;$t++ ) {

			// Player 1-11.
			for ( $i = 1;$i <= 11;$i++ ) {

				if ( ! $this->shared->player_exists_none_allowed( $values[ 'team_' . $t . '_lineup_player_id_' . $i ] ) ) {
					$result['messages'][] = __( 'Please enter a valid value in the "Player ', 'dase' ) .
					$i . __( '" field.', 'dase' );
				}
			}

			// Substitute 1-20.
			for ( $i = 1;$i <= 20;$i++ ) {

				if ( ! $this->shared->player_exists_none_allowed( 'team_' . $t . '_substitute_player_id_' . $i ) ) {
					$result['messages'][] = __( 'Please enter a valid value in the "Substitute ', 'dase' ) .
					$i . __( '" field.', 'dase' );
				}
			}

			// Staff 1-20.
			for ( $i = 1;$i <= 20;$i++ ) {

				if ( ! $this->shared->staff_exists_none_allowed( 'team_' . $t . '_staff_id_' . $i ) ) {
					$result['messages'][] = __( 'Please enter a valid value in the "Staff ', 'dase' ) .
					$i . __( '" field.', 'dase' );
				}
			}

			// Formation.
			if ( ! $this->formation_exists_none_allowed( 'team_' . $t . '_formation_id' ) ) {
				$result['messages'][] = __( 'Please enter a valid value in the "Formation" field.', 'dase' );
			}

			// Jersey Set.
			if ( ! $this->jersey_set_exists_none_allowed( 'team_' . $t . '_jersey_set_id' ) ) {
				$result['messages'][] = __( 'Please enter a valid value in the "Jersey Set" field.', 'dase' );
			}
		}

		// Do not allow to enter multiple time the same player --------------------------------------------------------.
		$player_a = array();

		// Do not allow to modify a match which is already associated with an event.
		if ( $update_id > 0 ) {
			global $wpdb;
			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_event';
			$safe_sql   = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE match_id = %d", $update_id );
			$count      = $wpdb->get_var( $safe_sql );
			if ( $count > 0 ) {
				$result['messages'][] = __( "This match is associated with one or more events and can't be edited.", 'dase' );
			}
		}

		// Do not allow to enter multiple times the same player -------------------------------------------------------.

		// Check in the lineup.
		for ( $i = 1;$i <= 11;$i++ ) {
			if ( $values[ 'team_1_lineup_player_id_' . $i ] > 0 and
				in_array( $values[ 'team_1_lineup_player_id_' . $i ], $player_a ) ) {
				$result['messages'][] = __( "You can't use this player multiple times", 'dase' ) .
										': ' . $this->shared->get_player_name( $values[ 'team_1_lineup_player_id_' . $i ] );
			} else {
				$player_a[] = $values[ 'team_1_lineup_player_id_' . $i ];
			}
			if ( $values[ 'team_2_lineup_player_id_' . $i ] > 0 and
				in_array( $values[ 'team_2_lineup_player_id_' . $i ], $player_a ) ) {
				$result['messages'][] = __( "You can't use this player multiple times", 'dase' ) .
										': ' . $this->shared->get_player_name( $values[ 'team_2_lineup_player_id_' . $i ] );
			} else {
				$player_a[] = $values[ 'team_2_lineup_player_id_' . $i ];
			}
		}

		// Check in the substitutions.
		for ( $i = 1;$i <= 20;$i++ ) {
			if ( $values[ 'team_1_substitute_player_id_' . $i ] > 0 and
				in_array( $values[ 'team_1_substitute_player_id_' . $i ], $player_a ) ) {
				$result['messages'][] = __( "You can't use this player multiple times", 'dase' ) .
										': ' . $this->shared->get_player_name( $values[ 'team_1_substitute_player_id_' . $i ] );
			} else {
				$player_a[] = $values[ 'team_1_substitute_player_id_' . $i ];
			}
			if ( $values[ 'team_2_substitute_player_id_' . $i ] > 0 and
				in_array( $values[ 'team_2_substitute_player_id_' . $i ], $player_a ) ) {
				$result['messages'][] = __( "You can't use this player multiple times", 'dase' ) .
										': ' . $this->shared->get_player_name( $values[ 'team_2_substitute_player_id_' . $i ] );
			} else {
				$player_a[] = $values[ 'team_2_substitute_player_id_' . $i ];
			}
		}

		// Do not allow to enter multiple time the same staff ---------------------------------------------------------.
		$staff_a = array();

		// Check in the staff.
		for ( $i = 1;$i <= 20;$i++ ) {
			if ( $values[ 'team_1_staff_id_' . $i ] > 0 ) {
				if ( in_array( $values[ 'team_1_staff_id_' . $i ], $staff_a ) ) {
					$result['messages'][] = __( "You can't use this staff multiple times", 'dase' ) .
											': ' . $this->shared->get_staff_name( $values[ 'team_1_staff_id_' . $i ] );
					continue;
				}
				$staff_a[] = $values[ 'team_1_staff_id_' . $i ];
			}
			if ( $values[ 'team_2_staff_id_' . $i ] > 0 ) {
				if ( in_array( $values[ 'team_2_staff_id_' . $i ], $staff_a ) ) {
					$result['messages'][] = __( "You can't use this staff multiple times", 'dase' ) .
											': ' . $this->shared->get_staff_name( $values[ 'team_2_staff_id_' . $i ] );
					continue;
				}
				$staff_a[] = $values[ 'team_2_staff_id_' . $i ];
			}
		}

		// Do not allow to enter a team that doesn't belong to the selected competition -------------------------------.
		if ( $values['competition_id'] > 0 ) {

			global $wpdb;
			$table_name      = $wpdb->prefix . $this->shared->get( 'slug' ) . '_competition';
			$safe_sql        = $wpdb->prepare( "SELECT * FROM $table_name WHERE competition_id = %d", $values['competition_id'] );
			$competition_obj = $wpdb->get_row( $safe_sql );

			// Check Team 1.
			$team_found = false;
			for ( $t = 1;$t <= 128;$t++ ) {
				if ( $values['team_id_1'] === $competition_obj->{'team_id_' . $t} ) {
					$team_found = true;
					continue;
				}
			}

			if ( ! $team_found ) {
				$result['messages'][] = __( 'Team 1 is not present in the selected competition.', 'dase' );
			}

			// Check Team 2.
			$team_found = false;
			for ( $t = 1;$t <= 128;$t++ ) {
				if ( $values['team_id_2'] === $competition_obj->{'team_id_' . $t} ) {
					$team_found = true;
					continue;
				}
			}

			if ( ! $team_found ) {
				$result['messages'][] = __( 'Team 2 is not present in the selected competition.', 'dase' );
			}
		}

		// Do not allow to set the same team in both the team slots ---------------------------------------------------.
		if ( intval( $values['team_id_1'], 10 ) === intval( $values['team_id_2'], 10 ) ) {

			$result['messages'][] = __( "You can't select multiple times the same team.", 'dase' );

		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Squads" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function squads_validation( $values, $update_id = false ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Single Fields Validations ----------------------------------------------------------------------------------.

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		// Player (1-11).
		for ( $i = 1;$i <= 11;$i++ ) {

			if ( ! $this->shared->player_exists_none_allowed( $values[ 'lineup_player_id_' . $i ] ) ) {
				$result['messages'][] = __( 'Please enter a valid value in the "Player', 'dase' ) . ' ' .
				$i . __( '" field.', 'dase' );
			}
		}

		// Substitute (1-20).
		for ( $i = 1;$i <= 20;$i++ ) {

			if ( ! $this->shared->player_exists_none_allowed( $values[ 'substitute_player_id_' . $i ] ) ) {
				$result['messages'][] = __( 'Please enter a valid value in the "Substitutes', 'dase' ) . ' ' .
					$i . __( '" field.', 'dase' );
			}
		}

		// Staff (1-20).
		for ( $i = 1;$i <= 20;$i++ ) {

			if ( ! $this->shared->staff_exists_none_allowed( $values[ 'staff_id_' . $i ] ) ) {
				$result['messages'][] = __( 'Please enter a valid value in the "Staff', 'dase' ) . ' ' .
					$i . __( '" field.', 'dase' );
			}
		}

		// Jersey Set.
		if ( ! $this->jersey_set_exists_none_allowed( $values['jersey_set_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Jersey Set" field.', 'dase' );
		}

		// Formation.
		if ( ! $this->formation_exists_none_allowed( $values['formation_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Formation" field.', 'dase' );
		}

		// Do not allow to enter multiple time the same player --------------------------------------------------------.
		$player_a = array();

		// Check in the lineup.
		for ( $i = 1;$i <= 11;$i++ ) {
			if ( $values[ 'lineup_player_id_' . $i ] > 0 ) {
				if ( in_array( $values[ 'lineup_player_id_' . $i ], $player_a ) ) {
					$result['messages'][] = __( "You can't use this player multiple times", 'dase' ) .
											': ' . $this->get_player_name( $values[ 'lineup_player_id_' . $i ] );
					continue;
				}
				$player_a[] = $values[ 'lineup_player_id_' . $i ];
			}
		}

		// Check in the substitutions.
		for ( $i = 1;$i <= 20;$i++ ) {
			if ( $values[ 'substitute_player_id_' . $i ] > 0 ) {
				if ( in_array( $values[ 'substitute_player_id_' . $i ], $player_a ) ) {
					$result['messages'][] = __( "You can't use this player multiple times", 'dase' ) .
											': ' . $this->get_player_name( $values[ 'substitute_player_id_' . $i ] );
					continue;
				}
				$staff_a[] = $values[ 'substitute_player_id_' . $i ];
				if ( in_array( $values[ 'substitute_player_id_' . $i ], $player_a ) ) {
					$result['messages'][] = __( "You can't use this player multiple times", 'dase' ) .
											': ' . $this->get_player_name( $values[ 'substitute_player_id_' . $i ] );
					continue;
				}
				$staff_a[] = $values[ 'substitute_player_id_' . $i ];
			}
		}

		// Do not allow to enter multiple time the same staff ---------------------------------------------------------.
		$staff_a = array();

		// Check in the staff.
		for ( $i = 1;$i <= 20;$i++ ) {
			if ( $values[ 'staff_id_' . $i ] > 0 ) {
				if ( in_array( $values[ 'staff_id_' . $i ], $staff_a ) ) {
					$result['messages'][] = __( "You can't use this staff multiple times", 'dase' ) .
											': ' . $this->get_staff_name( $values[ 'staff_id_' . $i ] );
					continue;
				}
				$staff_a[] = $values[ 'staff_id_' . $i ];
			}
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Events" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function events_validation( $values, $update_id = false ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Single Fields Validations ----------------------------------------------------------------------------------.

		// Data.
		if ( ! $this->validate_bool( $values['data'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Data" field.', 'dase' );
		}

		// Match.
		if ( ! $this->shared->match_exists( $values['match_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Match" field.', 'dase' );
		}

		// Team.
		if ( ! $this->validate_team_slot( $values['team_slot'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Team" field.', 'dase' );
		}

		// Match Effect.
		if ( ! $this->shared->match_effect_exists( $values['match_effect'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Match Effect" field.', 'dase' );
		}

		// Player.
		if ( ! $this->shared->player_exists_none_allowed( $values['player_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Player" field.', 'dase' );
		}

		// Player Substitution Out.
		if ( ! $this->shared->player_exists_none_allowed( $values['player_id_substitution_out'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Player Substitution Out" field.', 'dase' );
		}

		// Player Substitution In.
		if ( ! $this->shared->player_exists_none_allowed( $values['player_id_substitution_in'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Player Substitution In" field.', 'dase' );
		}

		// Staff.
		if ( ! $this->shared->staff_exists_none_allowed( $values['staff_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Staff" field.', 'dase' );
		}

		// Part.
		if ( ! $this->validate_match_part( $values['part'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Part" field.', 'dase' );
		}

		// Custom Validation ------------------------------------------------------------------------------------------.

		if ( intval( $values['data'] ) === 0 ) {

			// Basic.
			return $result;

		} else {

			// Complete.

			// Validate Match Effect with the related selections.
			switch ( $values['match_effect'] ) {

				// Goal.
				case 1:
					// Only a player should be selected.
					if ( $values['player_id'] > 0 and
						$values['player_id_substitution_out'] == 0 and
						$values['player_id_substitution_in'] == 0 and
						$values['staff_id'] == 0 ) {
						// correct.
					} else {
						$result['messages'][] = __( 'The "Goal" event can only be associated with a player.', 'dase' );

					}

					// The selected player should be present in the team associated with the event.
					if (
						$values['player_id'] > 0 and
						intval(
							$values['team_slot'] + 1,
							10
						) !== $this->shared->get_team_of_player_in_match(
							$values['match_id'],
							$values['player_id']
						) ) {
						$result['messages'][] = __(
							'The selected player should be present in the team associated with the event.',
							'dase'
						);
					}

					break;

				// Yellow Card.
				case 2:
					// Only a player or a staff should be selected.
					if ( ( $values['player_id'] > 0 and $values['player_id_substitution_out'] == 0 and $values['player_id_substitution_in'] == 0 and $values['staff_id'] == 0 ) or
						( $values['player_id'] == 0 and $values['player_id_substitution_out'] == 0 and $values['player_id_substitution_in'] == 0 and $values['staff_id'] > 0 ) ) {
						// correct
					} else {
						$result['messages'][] = __( 'The "Yellow Card" event can only be associated with a player or with a staff.', 'dase' );
					}

					// The selected player should be present in the team associated with the event.
					if (
						$values['player_id'] > 0 and
						intval(
							$values['team_slot'] + 1,
							10
						) !== $this->shared->get_team_of_player_in_match(
							$values['match_id'],
							$values['player_id']
						) ) {
						$result['messages'][] = __(
							'The selected player should be present in the team associated with the event.',
							'dase'
						);
					}

					// The selected staff should be present in the team associated with the event.
					if (
						$values['staff_id'] > 0 and
						intval(
							$values['team_slot'] + 1,
							10
						) !== $this->shared->get_team_of_staff_in_match(
							$values['match_id'],
							$values['staff_id']
						) ) {
						$result['messages'][] = __(
							'The selected staff should be present in the team associated with the event.',
							'dase'
						);
					}

					break;

				// Red Card.
				case 3:
					// Only a player or a staff should be selected.
					if ( ( $values['player_id'] > 0 and $values['player_id_substitution_out'] == 0 and $values['player_id_substitution_in'] == 0 and $values['staff_id'] == 0 ) or
						( $values['player_id'] == 0 and $values['player_id_substitution_out'] == 0 and $values['player_id_substitution_in'] == 0 and $values['staff_id'] > 0 ) ) {
						// correct.
					} else {
						$result['messages'][] = __( 'The "Red Card" event can only be associated with a player or with a staff.', 'dase' );
					}

					// The selected player should be present in the team associated with the event.
					if (
						$values['player_id'] > 0 and
						intval(
							$values['team_slot'] + 1,
							10
						) !== $this->shared->get_team_of_player_in_match(
							$values['match_id'],
							$values['player_id']
						) ) {
						$result['messages'][] = __(
							'The selected player should be present in the team associated with the event.',
							'dase'
						);
					}

					// The selected staff should be present in the team associated with the event.
					if (
						$values['staff_id'] > 0 and
						intval(
							$values['team_slot'] + 1,
							10
						) !== $this->shared->get_team_of_staff_in_match(
							$values['match_id'],
							$values['staff_id']
						) ) {
						$result['messages'][] = __(
							'The selected staff should be present in the team associated with the event.',
							'dase'
						);
					}

					break;

				// Substitution.
				case 4:
					// The Player Substitution Out and Players Substitution In should be selected.
					if ( $values['player_id'] == 0 and
						$values['player_id_substitution_out'] > 0 and
						$values['player_id_substitution_in'] > 0 and
						$values['staff_id'] == 0 ) {
						// correct
					} else {
						$result['messages'][] = __( 'The "Substitution" event can only be associated with a Player Substitution Our and a Player Substitution In.', 'dase' );

					}

					// The selected "Player Substitution Out" should be present in the team associated with the event.
					if (
						$values['player_id_substitution_out'] > 0 and
						intval(
							$values['team_slot'] + 1,
							10
						) !== $this->shared->get_team_of_player_in_match(
							$values['match_id'],
							$values['player_id_substitution_out']
						) ) {
						$result['messages'][] = __(
							'The selected "Player Substitution Out" should be present in the team associated with the event.',
							'dase'
						);
					}

					// The selected "Player Substitution In" should be present in the team associated with the event.
					if (
						$values['player_id_substitution_in'] > 0 and
						intval(
							$values['team_slot'] + 1,
							10
						) !== $this->shared->get_team_of_player_in_match(
							$values['match_id'],
							$values['player_id_substitution_in']
						) ) {
						$result['messages'][] = __(
							'The selected "Player Substitution In" should be present in the team associated with the event.',
							'dase'
						);
					}

					break;

			}

			// Validate Time.
			switch ( intval( $values['part'], 10 ) ) {

				case 0:
					if ( $values['time'] < 1 or $values['time'] > 45 ) {
						$result['messages'][] = __( 'The first half time should be a value between between 1 and 45.', 'dase' );
					}
					break;

				case 1:
					if ( $values['time'] < 1 or $values['time'] > 45 ) {
						$result['messages'][] = __( 'The second half time should be a value between between 1 and 45.', 'dase' );
					}
					break;

				case 2:
					if ( $values['time'] < 1 or $values['time'] > 15 ) {
						$result['messages'][] = __( 'The first half extra time should be a value between between 1 and 15.', 'dase' );
					}
					break;

				case 3:
					if ( $values['time'] < 1 or $values['time'] > 15 ) {
						$result['messages'][] = __( 'The second half extra time should be a value between between 1 and 15.', 'dase' );
					}
					break;

				case 4:
					if ( $values['time'] < 1 or $values['time'] > 30 ) {
						$result['messages'][] = __( 'The penalty time should be a value between between 1 and 30.', 'dase' );
					}
					break;

			}

			// Validate Additional Time.
			if ( preg_match( '/^\d{1,2}$/u', $values['additional_time'] ) !== 1 or
				intval( $values['additional_time'], 10 ) < 0 or intval( $values['additional_time'], 10 ) > 60 ) {
				$result['messages'][] = __( 'The additional time should be a value between 0 and 60.', 'dase' );
			}

			// Validate Description.
			if ( preg_match( '/^.{1,1000}$/u', $values['description'] ) !== 1 ) {
				$result['messages'][] = __( 'Please enter a valid description.', 'dase' );
			}

			if ( count( $result['messages'] ) > 0 ) {
				$result['status'] = false;
			}

			return $result;

		}
	}

	/**
	 * The custom validation of the "Team Contracts" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function team_contracts_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Single Fields Validations ----------------------------------------------------------------------------------.

		// Player.
		if ( ! $this->player_exists( $values['player_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid player in the "Player" field.', 'dase' );
		}

		// Team.
		if ( ! $this->team_exists( $values['team_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Team" field.', 'dase' );
		}

		// Contract Type.
		if ( ! $this->team_contract_type_exists( $values['team_contract_type_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Contract Type" field.', 'dase' );
		}

		// Start Date.
		if ( ! $this->validate_date( $values['start_date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Start Date" field.', 'dase' );
		}

		// End Date.
		if ( ! $this->validate_date( $values['end_date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "End Date" field.', 'dase' );
		}

		// Salary.
		if ( ! $this->validate_decimal_15_2( $values['salary'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Salary" field.', 'dase' );
		}

		// Verify if the "Start Date" is before the "End Date.
		if ( $values['start_date'] > $values['end_date'] ) {
			$result['messages'][] = __( 'The "Start Date" must be before the "End Date".', 'dase' );
		}

		// Verify if another team contract of the same player exists in the same period.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team_contract';
		$safe_sql   = $wpdb->prepare(
			"SELECT COUNT(*) FROM $table_name WHERE
        team_contract_id != %d AND
        player_id = %d AND 
        ((end_date > %s AND 
        start_date < %s) OR 
        (end_date > %s AND 
        start_date < %s))
        ",
			intval( $update_id, 10 ),
			intval( $values['player_id'], 10 ),
			$values['start_date'],
			$values['start_date'],
			$values['end_date'],
			$values['end_date']
		);
		$count      = intval( $wpdb->get_var( $safe_sql ), 10 );

		if ( $count !== 0 ) {
			$result['messages'][] = __( 'Another team contract of the same player exists in the same period.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Agency Contracts" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function agency_contracts_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Single Fields Validations ----------------------------------------------------------------------------------.

		// Player.
		if ( ! $this->player_exists( $values['player_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid player in the "Player" field.', 'dase' );
		}

		// Agency.
		if ( ! $this->agency_exists( $values['agency_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Agency" field.', 'dase' );
		}

		// Contract Type.
		if ( ! $this->agency_contract_type_exists( $values['agency_contract_type_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Contract Type" field.', 'dase' );
		}

		// Start Date.
		if ( ! $this->validate_date( $values['start_date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Start Date" field.', 'dase' );
		}

		// End Date.
		if ( ! $this->validate_date( $values['end_date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "End Date" field.', 'dase' );
		}

		// Verify if the "Start Date" is before the "End Date.
		if ( $values['start_date'] > $values['end_date'] ) {
			$result['messages'][] = __( 'The "Start Date" must be before the "End Date".', 'dase' );
		}

		// Verify if another agency contract of the same player exists in the same period.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency_contract';
		$safe_sql   = $wpdb->prepare(
			"SELECT COUNT(*) FROM $table_name WHERE
        agency_contract_id != %d AND
        player_id = %d AND 
        ((end_date > %s AND 
        start_date < %s) OR 
        (end_date > %s AND 
        start_date < %s))
        ",
			intval( $update_id, 10 ),
			intval( $values['player_id'], 10 ),
			$values['start_date'],
			$values['start_date'],
			$values['end_date'],
			$values['end_date']
		);
		$count      = intval( $wpdb->get_var( $safe_sql ), 10 );

		if ( $count !== 0 ) {
			$result['messages'][] = __( 'Another agency contract of the same player exists in the same period.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Agency Contracts" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function agency_contract_types_validation( $values, $update_id = false ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Market Value Transitions" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function market_value_transitions_validation( $values, $update_id = false ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Player.
		if ( ! $this->player_exists( $values['player_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Player" field.', 'dase' );
		}

		// Date.
		if ( ! $this->validate_date( $values['date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Date" field.', 'dase' );
		}

		// Value.
		if ( ! $this->validate_decimal_15_2( $values['value'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Value" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Unavailable Players" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function unavailable_players_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Single Fields Validations ----------------------------------------------------------------------------------.

		// Player.
		if ( ! $this->player_exists( $values['player_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid player in the "Player" field.', 'dase' );
		}

		// Unavailable Player Type.
		if ( ! $this->unavailable_player_type_exists( $values['unavailable_player_type_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid unavailable player type in the "Unavailable Player Type" field.', 'dase' );
		}

		// Start Date.
		if ( ! $this->validate_date( $values['start_date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid date in the "Start Date" field.', 'dase' );
		}

		// End Date.
		if ( ! $this->validate_date( $values['end_date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid date in the "End Date" field.', 'dase' );
		}

		// Verify if the "Start Date" is before the "End Date.
		if ( $values['start_date'] > $values['end_date'] ) {
			$result['messages'][] = __( 'The "Start Date" must be before the "End Date".', 'dase' );
		}

		// Verify if another unavailable player of the same player exists in the same period.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_unavailable_player';
		$safe_sql   = $wpdb->prepare(
			"SELECT COUNT(*) FROM $table_name WHERE
        unavailable_player_id != %d AND
        player_id = %d AND 
        ((end_date > %s AND 
        start_date < %s) OR 
        (end_date > %s AND 
        start_date < %s))
        ",
			intval( $update_id, 10 ),
			intval( $values['player_id'], 10 ),
			$values['start_date'],
			$values['start_date'],
			$values['end_date'],
			$values['end_date']
		);
		$count      = intval( $wpdb->get_var( $safe_sql ), 10 );

		if ( $count !== 0 ) {
			$result['messages'][] = __( 'Another unavailable player of the same player exists in the same period.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Unavailable Players" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function unavailable_player_types_validation( $values, $update_id = false ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Single Fields Validations ----------------------------------------------------------------------------------.

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Injuries" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function injuries_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Single Fields Validations ----------------------------------------------------------------------------------.

		// Player.
		if ( ! $this->player_exists( $values['player_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Player" field.', 'dase' );
		}

		// Injury Type.
		if ( ! $this->injury_type_exists( $values['injury_type_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Injury Type" field.', 'dase' );
		}

		// Start Date.
		if ( ! $this->validate_date( $values['start_date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid date in the "Start Date" field.', 'dase' );
		}

		// End Date.
		if ( ! $this->validate_date( $values['end_date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid date in the "End Date" field.', 'dase' );
		}

		// Verify if the "Start Date" is before the "End Date.
		if ( $values['start_date'] > $values['end_date'] ) {
			$result['messages'][] = __( 'The "Start Date" must be before the "End Date".', 'dase' );
		}

		// Verify if another injury of the same player exists in the same period.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_injury';
		$safe_sql   = $wpdb->prepare(
			"SELECT COUNT(*) FROM $table_name WHERE
        injury_id != %d AND
        player_id = %d AND 
        ((end_date > %s AND 
        start_date < %s) OR 
        (end_date > %s AND 
        start_date < %s))
        ",
			intval( $update_id, 10 ),
			intval( $values['player_id'], 10 ),
			$values['start_date'],
			$values['start_date'],
			$values['end_date'],
			$values['end_date']
		);
		$count      = intval( $wpdb->get_var( $safe_sql ), 10 );

		if ( $count !== 0 ) {
			$result['messages'][] = __( 'Another injury of the same player exists in the same period.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Injuries" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function injury_types_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Single Fields Validations ----------------------------------------------------------------------------------.

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Referee Badges" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function referee_badges_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Single Fields Validations ----------------------------------------------------------------------------------.

		// Referee.
		if ( ! $this->referee_exists( $values['referee_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Referee" field.', 'dase' );
		}

		// Referee Badge Type.
		if ( ! $this->referee_badge_type_exists( $values['referee_badge_type_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Referee Badge Type" field.', 'dase' );
		}

		// Start Date.
		if ( ! $this->validate_date( $values['start_date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Start Date" field.', 'dase' );
		}

		// End Date.
		if ( ! $this->validate_date( $values['end_date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "End Date" field.', 'dase' );
		}

		// Verify if the "Start Date" is before the "End Date.
		if ( $values['start_date'] > $values['end_date'] ) {
			$result['messages'][] = __( 'The "Start Date" must be before the "End Date".', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Referee Badges" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function referee_badge_types_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Single Fields Validations ----------------------------------------------------------------------------------.

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Staff" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function staff_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// First Name.
		if ( ! $this->validate_text_1_255( $values['first_name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "First Name" field.', 'dase' );
		}

		// Last Name.
		if ( ! $this->validate_text_1_255( $values['last_name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Last Name" field.', 'dase' );
		}

		// Image.
		if ( ! $this->validate_url_empty_allowed( $values['image'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Image" field.', 'dase' );
		}

		// Gender.
		if ( ! $this->validate_bool( $values['gender'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Gender" field.', 'dase' );
		}

		// Date of Birth.
		if ( ! $this->validate_date_empty_allowed( $values['date_of_birth'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Date of Birth" field.', 'dase' );
		}

		// Date of Death.
		if ( ! $this->validate_date_empty_allowed( $values['date_of_death'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Date of Death" field.', 'dase' );
		}

		// Citizenship.
		if ( ! $this->validate_country( $values['citizenship'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Citizenship" field.', 'dase' );
		}

		// Second Citizenship.
		if ( ! $this->validate_country_none_allowed( $values['second_citizenship'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Second Citizenship" field.', 'dase' );
		}

		// Retired.
		if ( ! $this->validate_bool( $values['retired'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Retired" field.', 'dase' );
		}

		// Staff Type.
		if ( ! $this->staff_type_exists( $values['staff_type_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Staff Type" field.', 'dase' );
		}

		// Verify if the "Start Date" is before the "End Date.
		if ( $values['date_of_birth'] !== null and $values['date_of_death'] !== null and
												$values['date_of_birth'] > $values['date_of_death'] ) {
			$result['messages'][] = __( 'The "Date of Birth" must be before the "Date of Death".', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Staff Types" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function staff_types_validation( $values, $update_id = false ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Staff Awards" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function staff_awards_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Staff.
		if ( ! $this->staff_exists( $values['staff_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Staff Exists" field.', 'dase' );
		}

		// Staff Award Type.
		if ( ! $this->staff_award_type_exists( $values['staff_award_type_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Staff Award Type" field.', 'dase' );
		}

		// Assignment Date.
		if ( ! $this->validate_date( $values['assignment_date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Assignment Date" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Staff Awards" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function staff_award_types_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Teams" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function teams_validation( $values, $update_id = false ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		// Logo.
		if ( ! $this->validate_url_empty_allowed( $values['logo'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Logo" field.', 'dase' );
		}

		// Type.
		if ( ! $this->validate_bool( $values['type'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Type" field.', 'dase' );
		}

		// Club Nation.
		if ( ! $this->validate_country( $values['club_nation'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Club Nation" field.', 'dase' );
		}

		// National Team Confederation.
		if ( ! $this->validate_national_team_confederation( $values['national_team_confederation'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "National Team Confederation" field.', 'dase' );
		}

		// Stadium.
		if ( ! $this->stadium_exists_none_allowed( $values['stadium_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Stadium" field.', 'dase' );
		}

		// Full Name.
		if ( ! $this->validate_text_0_255( $values['full_name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Full Name" field.', 'dase' );
		}

		// Address.
		if ( ! $this->validate_text_0_255( $values['address'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Address" field.', 'dase' );
		}

		// Tel.
		if ( ! $this->validate_text_0_255( $values['tel'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Tel" field.', 'dase' );
		}

		// Fax.
		if ( ! $this->validate_text_0_255( $values['fax'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Fax" field.', 'dase' );
		}

		// Website URL.
		if ( ! $this->validate_text_0_255( $values['website_url'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Website URL" field.', 'dase' );
		}

		// Foundation Date.
		if ( ! $this->validate_date_empty_allowed( $values['foundation_date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Foundation Date" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Formations" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function formations_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		// X Position 1-11.
		for ( $i = 1;$i <= 11;$i++ ) {

			if ( ! $this->validate_formation_position( $values[ 'x_position_' . $i ] ) ) {
				$result['messages'][] = __( 'Please enter a valid value in the "X Position', 'dase' ) . ' ' .
				$i . ' ' . __( 'field.', 'dase' );
			}
		}

		// Y Position 1-11.
		for ( $i = 1;$i <= 11;$i++ ) {

			if ( ! $this->validate_formation_position( $values[ 'y_position_' . $i ] ) ) {
				$result['messages'][] = __( 'Please enter a valid value in the "Y Position', 'dase' ) . ' ' .
					$i . ' ' . __( 'field.', 'dase' );
			}
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Jerset Sets" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function jersey_sets_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		// Player 1-50.
		for ( $i = 1;$i <= 11;$i++ ) {

			if ( ! $this->shared->player_exists_none_allowed( $values[ 'player_id_' . $i ] ) ) {
				$result['messages'][] = __( 'Please enter a valid value in the "Player', 'dase' ) . ' ' .
					$i . ' ' . __( 'field.', 'dase' );
			}
		}

		// Jersey Number Player 1-50.
		for ( $i = 1;$i <= 11;$i++ ) {

			if ( ! $this->validate_jersey_number( $values[ 'jersey_number_player_id_' . $i ] ) ) {
				$result['messages'][] = __( 'Please enter a valid value in the "Jersey Number Player', 'dase' ) . ' ' .
					$i . ' ' . __( 'field.', 'dase' );
			}
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Stadiums" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function stadiums_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		// Image.
		if ( ! $this->validate_url_empty_allowed( $values['image'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Image" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Trophies" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function trophies_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Trophy Type.
		if ( ! $this->trophy_type_exists( $values['trophy_type_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Trophy Type" field.', 'dase' );
		}

		// Team.
		if ( ! $this->team_exists( $values['team_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Team" field.', 'dase' );
		}

		// Assignment Date.
		if ( ! $this->validate_date( $values['assignment_date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Assignment Date" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Trophy Types" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function trophy_types_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		// Logo.
		if ( ! $this->validate_url_empty_allowed( $values['logo'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Logo" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Ranking Transitions" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function ranking_transitions_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Team.
		if ( ! $this->team_exists( $values['team_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Team" field.', 'dase' );
		}

		// Ranking Type.
		if ( ! $this->ranking_type_exists( $values['ranking_type_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Ranking Type" field.', 'dase' );
		}

		// Date.
		if ( ! $this->validate_date( $values['date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Date" field.', 'dase' );
		}

		// Value.
		if ( ! $this->validate_int_unsigned( $values['value'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Value" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Ranking Types" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function ranking_types_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Competitions" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function competitions_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		// Logo.
		if ( ! $this->validate_url_empty_allowed( $values['logo'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Logo" field.', 'dase' );
		}

		// Rounds.
		if ( ! $this->validate_rounds( $values['rounds'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Rounds" field.', 'dase' );
		}

		// Type.
		if ( ! $this->validate_bool( $values['type'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Type" field.', 'dase' );
		}

		// Team 1-128.
		for ( $i = 1;$i <= 128;$i++ ) {

			if ( ! $this->team_exists_none_allowed( $values[ 'team_id_' . $i ] ) ) {
				$result['messages'][] = __( 'Please enter a valid value in the "Team', 'dase' )
				. ' ' . $i . '"' . __( 'field.', 'dase' );
			}
		}

		// Victory Points.
		if ( ! $this->validate_tinyint_unsigned( $values['rr_victory_points'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Victory Points" field.', 'dase' );
		}

		// Draw Points.
		if ( ! $this->validate_tinyint_unsigned( $values['rr_draw_points'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Draw Points" field.', 'dase' );
		}

		// Defeat Points.
		if ( ! $this->validate_tinyint_unsigned( $values['rr_defeat_points'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Defeat Points" field.', 'dase' );
		}

		// Order (Priority 1).
		if ( ! $this->validate_competition_order_type( $values['rr_sorting_order_1'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Order 1" field.', 'dase' );
		}

		// Order by (Priority 1).
		if ( ! $this->validate_competition_order_by( $values['rr_sorting_order_by_1'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Order by 1" field.', 'dase' );
		}

		// Order (Priority 2).
		if ( ! $this->validate_competition_order_type( $values['rr_sorting_order_2'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Order 2" field.', 'dase' );
		}

		// Order by (Priority 2).
		if ( ! $this->validate_competition_order_by( $values['rr_sorting_order_by_2'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Order by 2" field.', 'dase' );
		}

		// Do not allow to modify a competition which is already associated with a match.
		if ( $update_id > 0 ) {
			global $wpdb;
			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_match';
			$safe_sql   = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE competition_id = %d", $update_id );
			$count      = $wpdb->get_var( $safe_sql );
			if ( $count > 0 ) {
				$result['messages'][] = __( "This competition is already associated with a match and can't be edited.", 'dase' );
			}
		}

		// Validate the number of rounds of an elimination competition.
		switch ( $values['type'] ) {

			// Elimination.
			case 0:
				if ( $values['rounds'] > 7 ) {
					$result['messages'][] = __( 'The number of rounds of an elimination competition should be between 1 and 7.', 'dase' );
				}

				break;

			// Round Robin.
			case 1:
				break;

		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Transfers" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function transfers_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Player.
		if ( ! $this->player_exists( $values['player_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Player" field.', 'dase' );
		}

		// Transfer Type.
		if ( ! $this->transfer_type_exists( $values['transfer_type_id'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Transfer Type" field.', 'dase' );
		}

		// Team Left.
		if ( ! $this->team_exists_none_allowed( $values['team_id_left'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Team Left" field.', 'dase' );
		}

		// Team Joined.
		if ( ! $this->team_exists_none_allowed( $values['team_id_joined'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Team Joined" field.', 'dase' );
		}

		// Date.
		if ( ! $this->validate_date( $values['date'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Date" field.', 'dase' );
		}

		// Fee.
		if ( ! $this->validate_decimal_15_2( $values['fee'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Fee" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Transfer Types" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function transfer_types_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Team Contract Types" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function team_contract_types_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Agencies" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	public function agencies_validation( $values, $update_id = false ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Name.
		if ( ! $this->validate_text_1_255( $values['name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Name" field.', 'dase' );
		}

		// Description.
		if ( ! $this->validate_text_1_255( $values['description'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Description" field.', 'dase' );
		}

		// Full Name.
		if ( ! $this->validate_text_0_255( $values['full_name'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Full Name" field.', 'dase' );
		}

		// Address
		if ( ! $this->validate_text_0_255( $values['address'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Address" field.', 'dase' );
		}

		// Telephone Number.
		if ( ! $this->validate_text_0_255( $values['tel'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Telephone" field.', 'dase' );
		}

		// Fax Number.
		if ( ! $this->validate_text_0_255( $values['fax'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Fax" field.', 'dase' );
		}

		// Website.
		if ( ! $this->validate_url( $values['website'] ) ) {
			$result['messages'][] = __( 'Please enter a valid value in the "Website" field.', 'dase' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}
}
