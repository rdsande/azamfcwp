<?php
/**
 * Settings to display the "Jersey Sets" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'jersey_set',
	'database_column_primary_key'   => 'jersey_set_id',

	// Menu.
	'url_slug'                      => 'jersey-sets',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Jersey Set', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Jersey Sets', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create New Jersey Set', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Jersey Set', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Jersey Set', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Jersey Set', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The jersey set has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The jersey set has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The jersey set has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'jersey_sets_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'jersey_set_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the jersey set.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The name of the jersey set.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'description',
			'label'           => __( 'Description', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The description of the jersey set.', $this->shared->get( 'slug' ) ),
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_jersey_sets' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The name of the jersey set.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'description',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Description', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The description of the jersey set.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
	),

);

$menu->settings['fields'][] = array(
	'target' => 'players',
	'label'  => __( 'Players', $this->shared->get( 'slug' ) ),
	'type'   => 'group-trigger',
);

for ( $i = 1;$i <= 50;$i++ ) {

	$menu->settings['fields'][] = array(
		'class'                   => 'players',
		'column'                  => 'player_id_' . $i,
		'query_placeholder_token' => 'd',
		'label'                   => __( 'Player', $this->shared->get( 'slug' ) ) . ' ' . $i,
		'tooltip'                 => __( 'The player', $this->shared->get( 'slug' ) ) . ' ' . $i . '.',
		'type'                    => 'select',
		'select_items'            => $menu_utility->select_players( true ),
		'validation_regex'        => null,
		'maxlength'               => '1',
		'required'                => false,
		'searchable'              => false,
	);

	$menu->settings['fields'][] = array(
		'class'                   => 'players',
		'column'                  => 'jersey_number_player_id_' . $i,
		'query_placeholder_token' => 'd',
		'label'                   => __( 'Jersey Number Player', $this->shared->get( 'slug' ) ) . ' ' . $i,
		'tooltip'                 => __( 'The jersery number of player', $this->shared->get( 'slug' ) ) . ' ' . $i . '.',
		'type'                    => 'text',
		'maxlength'               => '3',
		'required'                => false,
		'searchable'              => false,
	);

}

$menu->generate_menu();
