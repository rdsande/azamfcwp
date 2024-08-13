<?php
/**
 * Settings to display the "Competitions" menu.
 *
 * @package daext-soccer-engine
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu.php';
$menu = new Dase_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-menu-utility.php';
$menu_utility   = new Dase_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'competition',
	'database_column_primary_key'   => 'competition_id',

	// Menu.
	'url_slug'                      => 'competitions',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', $this->shared->get( 'slug' ) ),
	'label_singular'                => __( 'Competition', $this->shared->get( 'slug' ) ),
	'label_plural'                  => __( 'Competitions', $this->shared->get( 'slug' ) ),
	'label_create_new_item'         => __( 'Create Competition', $this->shared->get( 'slug' ) ),
	'label_edit_item'               => __( 'Edit Competition', $this->shared->get( 'slug' ) ),
	'label_add_item'                => __( 'Add Competition', $this->shared->get( 'slug' ) ),
	'label_update_item'             => __( 'Update Competition', $this->shared->get( 'slug' ) ),
	'label_cancel_item'             => __( 'Cancel', $this->shared->get( 'slug' ) ),
	'label_perform_your_search'     => __( 'Perform your Search', $this->shared->get( 'slug' ) ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', $this->shared->get( 'slug' ) ),
	'label_item_deleted'            => __( 'The competition has been successfully deleted.', $this->shared->get( 'slug' ) ),
	'label_item_added'              => __( 'The competition has been successfully added.', $this->shared->get( 'slug' ) ),
	'label_item_updated'            => __( 'The competition has been successfully updated.', $this->shared->get( 'slug' ) ),
	'custom_validation'             => 'competitions_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'competition_id',
			'label'           => __( 'ID', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The ID of the competition.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The name of the competition.', $this->shared->get( 'slug' ) ),
		),
		array(
			'database_column' => 'type',
			'label'           => __( 'Type', $this->shared->get( 'slug' ) ),
			'tooltip'         => __( 'The type of competition.', $this->shared->get( 'slug' ) ),
			'filter'          => 'get_competition_type_name',
		),
	),

	// Pagination Items.
	'pagination_items'              => intval( get_option( $this->shared->get( 'slug' ) . '_pagination_menu_competitions' ), 10 ),

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Name', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The name of the competition.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'description',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Description', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The description of the competition.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'logo',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Logo', $this->shared->get( 'slug' ) ),
			'instructions'            => __( 'Select a logo that represents this competition.', $this->shared->get( 'slug' ) ),
			'set_image'               => __( 'Set Image', $this->shared->get( 'slug' ) ),
			'remove_image'            => __( 'Remove Image', $this->shared->get( 'slug' ) ),
			'type'                    => 'image',
			'maxlength'               => '2083',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'rounds',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Rounds', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The number of rounds of the competition.', $this->shared->get( 'slug' ) ),
			'type'                    => 'text',
			'value'                   => '8',
			'maxlength'               => '3',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'type',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Type', $this->shared->get( 'slug' ) ),
			'tooltip'                 => __( 'The type of competition.', $this->shared->get( 'slug' ) ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 0,
					'text'     => esc_attr__( 'Elimination', 'dase' ),
					'selected' => true,
				),
				array(
					'value'    => 1,
					'text'     => esc_attr__( 'Round Robin', 'dase' ),
					'selected' => false,
				),
			),
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
	),

);

$menu->settings['fields'][] = array(
	'target' => 'teams',
	'label'  => __( 'Teams', $this->shared->get( 'slug' ) ),
	'type'   => 'group-trigger',
);

for ( $i = 1;$i <= 128;$i++ ) {
	$menu->settings['fields'][] = array(
		'class'                   => 'teams',
		'column'                  => 'team_id_' . $i,
		'query_placeholder_token' => 'd',
		'label'                   => __( 'Team', $this->shared->get( 'slug' ) ) . ' ' . $i,
		'tooltip'                 => __( 'The team', $this->shared->get( 'slug' ) ) . ' ' . $i . '.',
		'type'                    => 'select',
		'select_items'            => $menu_utility->select_teams( true ),
		'validation_regex'        => null,
		'maxlength'               => '1',
		'required'                => false,
		'searchable'              => false,
	);
}

$menu->settings['fields'][] = array(
	'target' => 'round-robin',
	'label'  => __( 'Round Robin', $this->shared->get( 'slug' ) ),
	'type'   => 'group-trigger',
);
$menu->settings['fields'][] = array(
	'class'                   => 'round-robin',
	'column'                  => 'rr_victory_points',
	'query_placeholder_token' => 's',
	'label'                   => __( 'Victory Points', $this->shared->get( 'slug' ) ),
	'tooltip'                 => __( 'The number of points assigned to a team when a victory is achieved in a Round Robin competition.', $this->shared->get( 'slug' ) ),
	'type'                    => 'text',
	'value'                   => '3',
	'maxlength'               => '255',
	'required'                => true,
	'searchable'              => true,
);
$menu->settings['fields'][] = array(
	'class'                   => 'round-robin',
	'column'                  => 'rr_draw_points',
	'query_placeholder_token' => 's',
	'label'                   => __( 'Draw Points', $this->shared->get( 'slug' ) ),
	'tooltip'                 => __( 'The number of points assigned to a team when a draw is achieved in a Round Robin competition.', $this->shared->get( 'slug' ) ),
	'type'                    => 'text',
	'value'                   => '1',
	'maxlength'               => '255',
	'required'                => true,
	'searchable'              => true,
);
$menu->settings['fields'][] = array(
	'class'                   => 'round-robin',
	'column'                  => 'rr_defeat_points',
	'query_placeholder_token' => 's',
	'label'                   => __( 'Defeat Points', $this->shared->get( 'slug' ) ),
	'tooltip'                 => __( 'The number of points assigned to a team when a defeat is achieved in a Round Robin competition.', $this->shared->get( 'slug' ) ),
	'type'                    => 'text',
	'value'                   => '0',
	'maxlength'               => '255',
	'required'                => true,
	'searchable'              => true,
);
$menu->settings['fields'][] = array(
	'class'                   => 'round-robin',
	'column'                  => 'rr_sorting_order_1',
	'query_placeholder_token' => 'd',
	'label'                   => __( 'Order (Priority 1)', $this->shared->get( 'slug' ) ),
	'tooltip'                 => __( 'This option allows you to enable (in descending or ascending order) or disable the order for the specified column.', $this->shared->get( 'slug' ) ),
	'type'                    => 'select',
	'select_items'            => array(
		array(
			'value'    => 0,
			'text'     => __( 'Descending', 'dase' ),
			'selected' => true,
		),
		array(
			'value'    => 1,
			'text'     => __( 'Ascending', 'dase' ),
			'selected' => false,
		),
	),
	'maxlength'               => '1',
	'searchable'              => false,
);
$rr_sorting_order_by_1      = array(
	array(
		'value'    => 0,
		'text'     => __( 'Won', 'dase' ),
		'selected' => false,
	),
	array(
		'value'    => 1,
		'text'     => __( 'Drawn', 'dase' ),
		'selected' => false,
	),
	array(
		'value'    => 2,
		'text'     => __( 'Lost', 'dase' ),
		'selected' => false,
	),
	array(
		'value'    => 3,
		'text'     => __( 'Goals', 'dase' ),
		'selected' => false,
	),
	array(
		'value'    => 4,
		'text'     => __( 'Goal Difference', 'dase' ),
		'selected' => false,
	),
	array(
		'value'    => 5,
		'text'     => __( 'Points', 'dase' ),
		'selected' => true,
	),
);
$menu->settings['fields'][] = array(
	'class'                   => 'round-robin',
	'column'                  => 'rr_sorting_order_by_1',
	'query_placeholder_token' => 'd',
	'label'                   => __( 'Order by (Priority 1)', $this->shared->get( 'slug' ) ),
	'tooltip'                 => __( 'This option allows you to determine for which column the order should be applied.', $this->shared->get( 'slug' ) ),
	'type'                    => 'select',
	'select_items'            => $rr_sorting_order_by_1,
	'maxlength'               => '1',
	'searchable'              => false,
);
$menu->settings['fields'][] = array(
	'class'                   => 'round-robin',
	'column'                  => 'rr_sorting_order_2',
	'query_placeholder_token' => 'd',
	'label'                   => __( 'Order (Priority 2)', $this->shared->get( 'slug' ) ),
	'tooltip'                 => __( 'This option allows you to enable (in descending or ascending order) or disable the order for the specified column.', $this->shared->get( 'slug' ) ),
	'type'                    => 'select',
	'select_items'            => array(
		array(
			'value'    => 0,
			'text'     => __( 'Descending', 'dase' ),
			'selected' => false,
		),
		array(
			'value'    => 1,
			'text'     => __( 'Ascending', 'dase' ),
			'selected' => false,
		),
	),
	'maxlength'               => '1',
	'searchable'              => false,
);
$rr_sorting_order_by_2      = array(
	array(
		'value'    => 0,
		'text'     => __( 'Won', 'dase' ),
		'selected' => false,
	),
	array(
		'value'    => 1,
		'text'     => __( 'Drawn', 'dase' ),
		'selected' => false,
	),
	array(
		'value'    => 2,
		'text'     => __( 'Lost', 'dase' ),
		'selected' => false,
	),
	array(
		'value'    => 3,
		'text'     => __( 'Goals', 'dase' ),
		'selected' => false,
	),
	array(
		'value'    => 4,
		'text'     => __( 'Goal Difference', 'dase' ),
		'selected' => true,
	),
	array(
		'value'    => 5,
		'text'     => __( 'Points', 'dase' ),
		'selected' => false,
	),
);
$menu->settings['fields'][] = array(
	'class'                   => 'round-robin',
	'column'                  => 'rr_sorting_order_by_2',
	'query_placeholder_token' => 'd',
	'label'                   => __( 'Order by (Priority 2)', $this->shared->get( 'slug' ) ),
	'tooltip'                 => __( 'This option allows you to determine for which column the order should be applied.', $this->shared->get( 'slug' ) ),
	'type'                    => 'select',
	'select_items'            => $rr_sorting_order_by_2,
	'maxlength'               => '1',
	'searchable'              => false,
);

$menu->generate_menu();
