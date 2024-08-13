<?php
/**
 * Settings to display the "Squads" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'squad',
	'database_column_primary_key'   => 'squad_id',

	// Menu.
	'url_slug'                      => 'squads',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Squad', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Squads', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create Squad', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Squad', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Squad', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Squad', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The squad has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The squad has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The squad has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'squads_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'squad_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the squad.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The name of the squad.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'description',
			'label'           => __( 'Description', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The description of the jersey set.', $this->shared->get( 'slug' ) ),
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_squads' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The name of the squad.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'description',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Description', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The description of the squad.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
	),

);

$menu->settings['fields'][] = array(
	'target' => 'lineup',
	'label'  => __( 'Lineup', $this->shared->get( 'slug' ) ),
	'type'   => 'group-trigger',
);

for ( $i = 1;$i <= 11;$i++ ) {
	$menu->settings['fields'][] = array(
		'class'                   => 'lineup',
		'column'                  => 'lineup_player_id_' . $i,
		'query_placeholder_token' => 'd',
		'label'                   => __( 'Player', $this->shared->get( 'slug' ) ) . ' ' . $i,
		'tooltip'                 => __( 'The player', $this->shared->get( 'slug' ) ) . ' ' . $i . ' ' . __( 'of the squad.', $this->shared->get( 'slug' ) ),
		'type'                    => 'select',
		'select_items'            => $menu_utility->select_players( true ),
		'validation_regex'        => null,
		'maxlength'               => '1',
		'required'                => false,
		'searchable'              => false,
	);
}

$menu->settings['fields'][] = array(
	'target' => 'substitutes',
	'label'  => __( 'Substitutes', $this->shared->get( 'slug' ) ),
	'type'   => 'group-trigger',
);

for ( $i = 1;$i <= 20;$i++ ) {
	$menu->settings['fields'][] = array(
		'class'                   => 'substitutes',
		'column'                  => 'substitute_player_id_' . $i,
		'query_placeholder_token' => 'd',
		'label'                   => __( 'Substitute', $this->shared->get( 'slug' ) ) . ' ' . $i,
		'tooltip'                 => __( 'The substitute', $this->shared->get( 'slug' ) ) . ' ' . $i . ' ' . __( 'of the squad.', $this->shared->get( 'slug' ) ),
		'type'                    => 'select',
		'select_items'            => $menu_utility->select_players( true ),
		'validation_regex'        => null,
		'maxlength'               => '1',
		'required'                => false,
		'searchable'              => false,
	);
}

$menu->settings['fields'][] = array(
	'target' => 'staff',
	'label'  => __( 'Staff', $this->shared->get( 'slug' ) ),
	'type'   => 'group-trigger',
);

for ( $i = 1;$i <= 20;$i++ ) {
	$menu->settings['fields'][] = array(
		'class'                   => 'staff',
		'column'                  => 'staff_id_' . $i,
		'query_placeholder_token' => 'd',
		'label'                   => __( 'Staff', $this->shared->get( 'slug' ) ) . ' ' . $i,
		'tooltip'                 => __( 'The staff member', $this->shared->get( 'slug' ) ) . ' ' . $i . '.',
		'type'                    => 'select',
		'select_items'            => $menu_utility->select_staff( true ),
		'validation_regex'        => null,
		'maxlength'               => '1',
		'required'                => false,
		'searchable'              => false,
	);
}

$menu->settings['fields'][] = array(
	'target' => 'advanced',
	'label'  => __( 'Advanced', $this->shared->get( 'slug' ) ),
	'type'   => 'group-trigger',
);

$menu->settings['fields'][] = array(
	'class'                   => 'advanced',
	'column'                  => 'formation_id',
	'query_placeholder_token' => 'd',
	'label'                   => __( 'Formation', $this->shared->get( 'slug' ) ),
	'tooltip'                 => __( 'The formation', $this->shared->get( 'slug' ) ),
	'type'                    => 'select',
	'select_items'            => $menu_utility->select_formations( true ),
	'validation_regex'        => null,
	'maxlength'               => '1',
	'required'                => false,
	'searchable'              => false,
);

$menu->settings['fields'][] = array(
	'class'                   => 'advanced',
	'column'                  => 'jersey_set_id',
	'query_placeholder_token' => 'd',
	'label'                   => __( 'Jersey Set', $this->shared->get( 'slug' ) ),
	'tooltip'                 => __( 'The jersey set.', $this->shared->get( 'slug' ) ),
	'type'                    => 'select',
	'select_items'            => $menu_utility->select_jersey_sets( true ),
	'validation_regex'        => null,
	'maxlength'               => '1',
	'required'                => false,
	'searchable'              => false,
);

$menu->generate_menu();
