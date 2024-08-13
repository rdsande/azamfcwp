<?php
/**
 * This class generates a back-end menus based on the provided data.
 *
 * @package daext-soccer-engine
 */

/**
 * This class generates a back-end menus based on the provided data.
 */
class Dase_Menu {

	private $edit_mode;
	private $edit_id;
	private $item_obj;
	private $process_data_message;
	private $update_id;
	private $invalid_data_message;
	private $invalid_data;
	private $blocking_condition_active;
	public $shared;
	public $settings    = array();
	public $values      = array();
	private $validation = array();

	public function __construct( $shared ) {

		// assign an instance of the plugin info.
		$this->shared = $shared;

		// Assign an instance of the validation class to a class property.
		require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-validation.php';
		$this->validation = new Dase_Validation( $this->shared );
	}

	public function create_update_database_table() {

		if ( isset( $_POST['update_id'] ) || isset( $_POST['form_submitted'] ) ) {

			// Sanitization -------------------------------------------------------------------------------------------.
			if ( isset( $_POST['update_id'] ) ) {
				$this->update_id = intval( $_POST['update_id'], 10 );
			}

			foreach ( $this->settings['fields'] as $key => $field ) {

				if ( isset( $field['unsaved'] ) && $field['unsaved'] ) {
					continue;
				}

				switch ( $field['type'] ) {

					case 'date':
						if ( 0 === strlen( trim( $_POST[ $field['column'] ] ) ) ) {
							$this->values[ $field['column'] ] = null;
						} else {
							$this->values[ $field['column'] ] = trim( $_POST[ $field['column'] . '_alt_field' ] );
						}

						break;

					case 'select-multiple':
						if ( isset( $_POST[ $field['column'] ] ) ) {
							$this->values[ $field['column'] ] = maybe_serialize( $_POST[ $field['column'] ] );
						} else {
							$this->values[ $field['column'] ] = '';
						}
						break;

					case 'text':
					case 'select':
					case 'image':
					case 'color':
					case 'time':
						$this->values[ $field['column'] ] = trim( $_POST[ $field['column'] ] );
						break;

				}
			}

			// Validation ---------------------------------------------------------------------------------------------.
			foreach ( $this->settings['fields'] as $key => $field ) {

				if ( isset( $field['unsaved'] ) && $field['unsaved'] ) {
					continue;
				}

				// Validation Regex.
				if ( isset( $field['validation_regex'] ) ) {
					foreach ( $field['validation_regex'] as $key1 => $validation_regex ) {
						if ( preg_match( $validation_regex['regex'], $this->values[ $field['column'] ] ) !== 1 ) {
							$this->invalid_data_message .= '<div class="error settings-error notice is-dismissible below-h2"><p>' . esc_attr( $validation_regex['message'] ) . '</p></div>';
							$this->invalid_data          = true;
						}
					}
				}
			}

			// Custom Validation --------------------------------------------------------------------------------------.
			if ( isset( $this->settings['custom_validation'] ) ) {
				$custom_validation_result = $this->validation->{$this->settings['custom_validation']}( $this->values, $this->update_id );
				if ( true !== $custom_validation_result['status'] ) {
					$this->invalid_data = true;
					foreach ( $custom_validation_result['messages'] as $message ) {
						$this->invalid_data_message .= '<div class="error settings-error notice is-dismissible below-h2"><p>' . $message . '</p></div>';
					}
				}
			}
		}

		// Update Existing Record -------------------------------------------------------------------------------------.
		if ( isset( $_POST['update_id'] ) and ! isset( $this->invalid_data ) ) {

			// update the database.
			global $wpdb;
			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_' . $this->settings['database_table_name'];

			$query = "UPDATE $table_name SET ";

			$array_for_prepare = array();
			foreach ( $this->settings['fields'] as $key => $field ) {

				if ( isset( $field['unsaved'] ) and $field['unsaved'] ) {
					continue;}

				if ( 'group-trigger' !== $field['type'] ) {

					$query .= $field['column'] . ' = ';

					$query .= '%' . $field['query_placeholder_token'];

					if ( ( $key + 1 ) < count( $this->settings['fields'] ) ) {
						$query .= ',';
					}

					$array_for_prepare[] = $this->values[ $field['column'] ];

				}
			}

			$query .= ' WHERE ' . $this->settings['database_column_primary_key'] . ' = %d';

			$array_for_prepare[] = intval( $_POST['update_id'], 10 );

			$safe_sql = $wpdb->prepare(
				$query,
				$array_for_prepare
			);

			$query_result = $wpdb->query( $safe_sql );

			if ( $query_result !== false ) {
				$this->process_data_message = '<div class="updated settings-error notice is-dismissible below-h2"><p>' . esc_attr( $this->settings['label_item_updated'] ) . '</p></div>';
			}
		} else {

			// Add New Record -----------------------------------------------------------------------------------------.
			if ( isset( $_POST['form_submitted'] ) and ! isset( $this->invalid_data ) ) {

				// insert into the database.
				global $wpdb;
				$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_' . $this->settings['database_table_name'];

				$query = "INSERT INTO $table_name SET ";

				$array_for_prepare = array();
				foreach ( $this->settings['fields'] as $key => $field ) {

					if ( isset( $field['unsaved'] ) and $field['unsaved'] ) {
						continue;}

					if ( 'group-trigger' !== $field['type'] ) {

						$query .= $field['column'] . ' = ';

						$query .= '%' . $field['query_placeholder_token'];

						if ( ( $key + 1 ) < count( $this->settings['fields'] ) ) {
							$query .= ',';
						}

						$array_for_prepare[] = $this->values[ $field['column'] ];

					}
				}

				$safe_sql = $wpdb->prepare(
					$query,
					$array_for_prepare
				);

				$query_result = $wpdb->query( $safe_sql );

				if ( $query_result !== false ) {
					$this->process_data_message = '<div class="updated settings-error notice is-dismissible below-h2"><p>' . esc_attr( $this->settings['label_item_added'] ) . '</p></div>';
				}
			}
		}
	}

	public function process_incoming_data() {

		// Delete the item.
		if ( isset( $_POST['delete_id'] ) ) {

			$delete_id = intval( $_POST['delete_id'], 10 );
			$deletable = $this->shared->{'check_deletable'}( $this->settings['database_table_name'], $delete_id );

			if ( ! $deletable['status'] ) {

				$this->process_data_message = '<div class="error settings-error notice is-dismissible below-h2"><p>' . esc_attr( $deletable['message'] ) . '</p></div>';

			} else {

				global $wpdb;
				$table_name   = $wpdb->prefix . $this->shared->get( 'slug' ) . '_' . $this->settings['database_table_name'];
				$safe_sql     = $wpdb->prepare( "DELETE FROM $table_name WHERE " . $this->settings['database_column_primary_key'] . ' = %d ', $delete_id );
				$query_result = $wpdb->query( $safe_sql );

				if ( false !== $query_result ) {
					$this->process_data_message = '<div class="updated settings-error notice is-dismissible below-h2"><p>' . esc_attr( $this->settings['label_item_deleted'] ) . '</p></div>';
				}
			}
		}

		// Clone the item.
		if ( $this->settings['enable_clone_button'] and isset( $_POST['clone_id'] ) ) {

			global $wpdb;
			$clone_id = intval( $_POST['clone_id'], 10 );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_' . $this->settings['database_table_name'];
			$wpdb->query( "CREATE TEMPORARY TABLE dase_temporary_table SELECT * FROM $table_name WHERE " . $this->settings['database_column_primary_key'] . " = $clone_id" );
			$wpdb->query( 'UPDATE dase_temporary_table SET ' . $this->settings['database_column_primary_key'] . ' = NULL' );
			$wpdb->query( "INSERT INTO $table_name SELECT * FROM dase_temporary_table" );
			$wpdb->query( 'DROP TEMPORARY TABLE IF EXISTS dase_temporary_table' );

		}

		// Determine if we are in edit mode.
		if ( isset( $_GET['edit_id'] ) ) {
			$this->edit_mode = true;
			$this->edit_id   = intval( $_GET['edit_id'], 10 );
		} else {
			$this->edit_mode = false;
		}

		// If we are in edit mode get the item data.
		if ( $this->edit_mode ) {
			global $wpdb;
			$table_name     = $wpdb->prefix . $this->shared->get( 'slug' ) . '_' . $this->settings['database_table_name'];
			$safe_sql       = $wpdb->prepare( "SELECT * FROM $table_name WHERE " . $this->settings['database_column_primary_key'] . ' = %d ', $this->edit_id );
			$this->item_obj = $wpdb->get_row( $safe_sql );
		}
	}

	public function generate_header_html() {

		?>

		<div id="daext-header-wrapper" class="daext-clearfix">

			<h2><?php echo esc_attr( $this->settings['plugin_name'] ) . '&nbsp' . '-' . '&nbsp' . esc_attr( $this->settings['label_plural'] ); ?></h2>

			<form action="admin.php" method="get" id="daext-search-form">

				<input type="hidden" name="page" value="dase-<?php echo $this->settings['url_slug']; ?>">

				<p><?php echo esc_attr( $this->settings['label_perform_your_search'] ); ?></p>

				<?php
				if ( isset( $_GET['s'] ) and mb_strlen( trim( $_GET['s'] ) ) > 0 ) {
					$search_string = $_GET['s'];
				} else {
					$search_string = '';
				}
				?>

				<input type="text" name="s"
						value="<?php echo esc_attr( stripslashes( $search_string ) ); ?>" autocomplete="off" maxlength="255">
				<input type="submit" value="">

			</form>

		</div>

		<?php
	}

	public function generate_blocking_messages() {

		if ( isset( $this->settings['blocking_conditions'] ) ) {

			foreach ( $this->settings['blocking_conditions'] as $key => $blocking_condition ) {

				if ( $blocking_condition['status'] ) {

					$this->blocking_condition_active = true;

					echo '<p>' . $blocking_condition['message'] . '</p>';

				}
			}
		}
	}

	public function generate_paginated_table_html() {

		if ( $this->blocking_condition_active ) {
			return;}

		?>

		<?php
		if ( isset( $this->invalid_data_message ) ) {
			echo $this->invalid_data_message;
		}
		?>
		<?php
		if ( isset( $this->process_data_message ) ) {
			echo $this->process_data_message;
		}
		?>

		<!-- table -->

		<?php

		$filter = '';

		// Create the query part used to filter the results when a search is performed.
		if ( mb_strlen( trim( $filter ) ) === 0 and isset( $_GET['s'] ) and mb_strlen( trim( $_GET['s'] ) ) > 0 ) {
			$search_string = $_GET['s'];
			global $wpdb;

			$query = 'WHERE (';

			$searchable_fields = array();
			foreach ( $this->settings['fields'] as $key => $field ) {
				if ( isset( $field['searchable'] ) && $field['searchable'] ) {
					$searchable_fields[] = $field;
				}
			}

			$array_for_prepare = array();

			// Add the ID field.
			$query              .= $this->settings['database_table_name'] . '_id LIKE %s';
			$array_for_prepare[] = '%' . $search_string . '%';

			// Add the searchable fields.
			foreach ( $searchable_fields as $key => $field ) {

				$query              .= 'OR ' . $field['column'] . ' LIKE %' . $field['query_placeholder_token'];
				$array_for_prepare[] = '%' . $search_string . '%';

			}

			$query .= ')';

			$filter = $wpdb->prepare( $query, $array_for_prepare );

		}

		// Retrieve the total number of items.
		global $wpdb;
		$table_name  = $wpdb->prefix . $this->shared->get( 'slug' ) . '_' . $this->settings['database_table_name'];
		$total_items = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name $filter" );

		// Initialize the pagination class.
		require_once $this->shared->get( 'dir' ) . '/admin/inc/class-dase-pagination.php';
		$pag = new dase_pagination();
		$pag->set_total_items( $total_items );// Set the total number of items.
		$pag->set_record_per_page( $this->settings['pagination_items'] ); // Set records per page.
		$pag->set_target_page( 'admin.php?page=' . $this->shared->get( 'slug' ) . '-' . $this->settings['url_slug'] );// Set target page.
		$pag->set_current_page();// Set the current page number from $_GET.

		?>

		<!-- Query the database -->
		<?php
		$query_limit = $pag->query_limit();
		$results     = $wpdb->get_results(
			"SELECT * FROM $table_name $filter ORDER BY " . $this->settings['database_column_primary_key'] . " DESC $query_limit",
			ARRAY_A
		);
		?>

		<?php if ( count( $results ) > 0 ) : ?>

			<div class="daext-items-container">

				<!-- list of tables -->
				<table class="daext-items">
					<thead>
					<tr>

						<?php foreach ( $this->settings['pagination_columns'] as $pagination_column ) : ?>
							<th>
								<div><?php echo esc_attr( $pagination_column['label'] ); ?></div>
								<div class="help-icon" title="<?php echo esc_attr( $pagination_column['tooltip'] ); ?>"></div>
							</th>
						<?php endforeach; ?>

						<th></th>
					</tr>
					</thead>
					<tbody>

					<?php foreach ( $results as $result ) : ?>
						<tr>

							<?php foreach ( $this->settings['pagination_columns'] as $pagination_column ) : ?>
								<?php if ( isset( $pagination_column['filter'] ) ) : ?>
									<td>
										<?php
											$value = $this->shared->{$pagination_column['filter']}( $result[ $pagination_column['database_column'] ], $result );
											echo esc_attr( $value );
										?>
									</td>
								<?php else : ?>
									<td><?php echo esc_attr( stripslashes( $result[ $pagination_column['database_column'] ] ) ); ?></td>
								<?php endif; ?>

							<?php endforeach; ?>

							<td class="icons-container"
								<?php if ( $this->settings['enable_clone_button'] ) : ?>
									style="width: 76px !important; min-width: 76px !important;"
								<?php endif; ?>
							>
								<?php if ( $this->settings['enable_clone_button'] ) : ?>
									<form method="POST"
											action="admin.php?page=<?php echo $this->shared->get( 'slug' ); ?>-<?php echo $this->settings['url_slug']; ?>">
										<input type="hidden" name="clone_id" value="<?php echo $result[ $this->settings['database_column_primary_key'] ]; ?>">
										<input class="menu-icon clone help-icon" type="submit" value="">
									</form>
								<?php endif; ?>
								<a class="menu-icon edit"
									href="admin.php?page=<?php echo $this->shared->get( 'slug' ); ?>-<?php echo $this->settings['url_slug']; ?>&edit_id=<?php echo $result[ $this->settings['database_column_primary_key'] ]; ?>"></a>
								<form id="form-delete-<?php echo $result[ $this->settings['database_column_primary_key'] ]; ?>" method="POST"
										action="admin.php?page=<?php echo $this->shared->get( 'slug' ); ?>-<?php echo $this->settings['url_slug']; ?>">
									<input type="hidden" value="<?php echo $result[ $this->settings['database_column_primary_key'] ]; ?>"
											name="delete_id">
									<input class="menu-icon delete" type="submit" value="">
								</form>
							</td>
						</tr>
					<?php endforeach; ?>

					</tbody>

				</table>

			</div>

			<!-- Display the pagination -->
			<?php if ( $pag->total_items > 0 ) : ?>
				<div class="daext-tablenav daext-clearfix">
					<div class="daext-tablenav-pages">
						<span class="daext-displaying-num"><?php echo $pag->total_items; ?>
							&nbsp
							<?php
							esc_attr_e(
								'items',
								'dase'
							);
							?>
								</span>
						<?php $pag->show(); ?>
					</div>
				</div>
			<?php endif; ?>

		<?php else : ?>

			<?php

			if ( mb_strlen( trim( $filter ) ) > 0 ) {
				echo '<div class="error settings-error notice is-dismissible below-h2"><p>' . $this->settings['label_no_results_match_filter'] . '</p></div>';
			}

			?>

		<?php endif; ?>

		<?php
	}

	public function convert_fields_to_associative_array( $fields_in_numeric_array ) {

		$fields_in_associative_array = array();
		foreach ( $fields_in_numeric_array as $key => $field ) {
			$fields_in_associative_array[ $field['column'] ] = $field;
			unset( $fields_in_associative_array[ $field['column'] ]['column'] );
		}

		return $fields_in_associative_array;
	}

	public function generate_form_html() {

		$this->shared->set_met_and_ml();

		if ( $this->blocking_condition_active ) {
			return;}

		?>

		<div>

			<form method="POST" action="admin.php?page=<?php echo $this->shared->get( 'slug' ); ?>-<?php echo $this->settings['url_slug']; ?>" autocomplete="off">

				<input type="hidden" value="1" name="form_submitted">

				<div class="daext-form-container">

					<div class="daext-form-title">
						<?php if ( $this->edit_mode ) : ?>
							<?php echo esc_attr( $this->settings['label_edit_item'] ) . '&nbsp' . intval( $this->edit_id, 10 ); ?>
						<?php else : ?>
							<?php echo esc_attr( $this->settings['label_create_new_item'] ); ?>
						<?php endif; ?>

					</div>

					<table class="daext-form daext-form-table">

						<?php if ( $this->edit_mode ) : ?>
							<input type="hidden" name="update_id" value="<?php echo $this->item_obj->{$this->settings['database_column_primary_key']}; ?>"/>
						<?php endif; ?>

						<?php foreach ( $this->settings['fields'] as $key => $field ) : ?>

							<?php

							if ( 'group-trigger' !== $field['type'] ) {
								if ( isset( $field['class'] ) ) {
									$container_classes = esc_attr( $field['class'] ) . ' ' . 'display-none';
								} else {
									$container_classes = 'tr_' . esc_attr( $field['column'] );
								}
							}

							switch ( $field['type'] ) {

								// Group Trigger ----------------------------------------------------------------------.
								case 'group-trigger':
									?>

									<tr class="group-trigger" data-trigger-target="<?php echo $field['target']; ?>">
										<th class="group-title"><?php echo esc_attr( $field['label'] ); ?></th>
										<td>
											<div class="expand-icon"></div>
										</td>
									</tr>

									<?php

									break;

								// Input Text ---------------------------------------------------------------------------------------.
								case 'text':
									?>

									<tr class="<?php echo $container_classes; ?>">
										<th><label for="<?php echo $field['column']; ?>"><?php echo esc_attr( $field['label'] ); ?><?php $this->generate_optional_label( $field ); ?></label></th>
										<td>
											<input type="text" id="<?php echo $field['column']; ?>" maxlength="<?php echo $field['maxlength']; ?>" size="30" name="<?php echo $field['column']; ?>"
											<?php if ( $this->edit_mode ) : ?>
												value="<?php echo esc_attr( stripslashes( $this->item_obj->{$field['column']} ) ); ?>"
											<?php else : ?>
												<?php if ( isset( $field['value'] ) ) : ?>
													value="<?php echo $field['value']; ?>"
												<?php endif; ?>
											<?php endif; ?>
											/>
											<div class="help-icon" title="<?php echo esc_attr( $field['tooltip'] ); ?>"></div>
										</td>
									</tr>

									<?php

									break;

								// Select -------------------------------------------------------------------------------------------.
								case 'select':
									?>

									<tr class="<?php echo $container_classes; ?>">
										<th scope="row"><label for="title"><?php echo esc_attr( $field['label'] ); ?><?php $this->generate_optional_label( $field ); ?></label></th>
										<td>
											<select id="<?php echo esc_attr( $field['column'] ); ?>" name="<?php echo esc_attr( $field['column'] ); ?>" class="daext-display-none">
												<?php

												foreach ( $field['select_items'] as $item ) {
													if ( $this->edit_mode and ! isset( $field['unsaved'] ) or
														( isset( $field['unsaved'] ) and $field['unsaved'] === false ) ) {
														$select = (string) $this->item_obj->{$field['column']} === (string) $item['value'] ? 'selected="selected"' : '';
													} else {
														$select = $item['selected'] ? 'selected="selected"' : '';
													}
													echo '<option value="' . esc_attr( $item['value'] ) . '" ' . $select . '>' . esc_attr( $item['text'] ) . '</option>';
												}

												?>
											</select>
											<div class="help-icon" title='<?php echo esc_attr( $field['tooltip'] ); ?>'></div>

										</td>
									</tr>

									<?php

									break;

								// Select Multiple --------------------------------------------------------------------.
								case 'select-multiple':
									?>

									<tr class="<?php echo $container_classes; ?>">
										<th scope="row"><label for="title"><?php echo esc_attr( $field['label'] ); ?><?php $this->generate_optional_label( $field ); ?></label></th>
										<td>
											<select id="<?php echo esc_attr( $field['column'] ); ?>" name="<?php echo esc_attr( $field['column'] ); ?>[]" class="daext-display-none" multiple>
												<?php

												foreach ( $field['select_items'] as $item ) {
													if ( $this->edit_mode ) {

														$this->item_obj->{$field['column']} = maybe_unserialize( $this->item_obj->{$field['column']} );
														if ( is_array( $this->item_obj->{$field['column']} ) and in_array( $item['value'], $this->item_obj->{$field['column']} ) ) {
															$select = 'selected="selected"';
														} else {
															$select = '';
														}
													} elseif ( is_array( $field['select_default_items'] ) and in_array( $item['value'], $field['select_default_items'] ) ) {

															$select = 'selected="selected"';
													} else {
														$select = '';
													}
													echo '<option value="' . esc_attr( $item['value'] ) . '" ' . $select . '>' . esc_attr( $item['text'] ) . '</option>';
												}

												?>
											</select>
											<div class="help-icon" title='<?php echo esc_attr( $field['tooltip'] ); ?>'></div>

										</td>
									</tr>

									<?php

									break;

								// Date -------------------------------------------------------------------------------.
								case 'date':
									?>

									<tr class="<?php echo $container_classes; ?>">
										<th><label for="title"><?php echo esc_attr( $field['label'] ); ?><?php $this->generate_optional_label( $field ); ?></label></th>
										<td>
											<input type="text" id="<?php echo str_replace( '_', '-', $field['column'] ); ?>" maxlength="100" size="30" name="<?php echo $field['column']; ?>"

											/>
											<input type="hidden" id="<?php echo str_replace( '_', '-', $field['column'] ); ?>-alt-field" name="<?php echo $field['column']; ?>_alt_field"
												<?php if ( $this->edit_mode ) : ?>
													value="<?php echo esc_attr( stripslashes( $this->item_obj->{$field['column']} ) ); ?>"
												<?php endif; ?>
											/>
											<div class="help-icon" title="<?php echo esc_attr( $field['tooltip'] ); ?>"></div>
										</td>
									</tr>

									<?php

									break;

								// Time -------------------------------------------------------------------------------.
								case 'time':
									?>

									<tr class="<?php echo $container_classes; ?>">
										<th><label for="title"><?php echo esc_attr( $field['label'] ); ?><?php $this->generate_optional_label( $field ); ?></label></th>
										<td>
											<input type="text" id="<?php echo $field['column']; ?>" maxlength="<?php echo $field['maxlength']; ?>" size="30" name="<?php echo $field['column']; ?>"
												<?php if ( $this->edit_mode ) : ?>
													value="<?php echo esc_attr( $this->shared->format_time( stripslashes( $this->item_obj->{$field['column']} ) ) ); ?>"
												<?php else : ?>
													<?php if ( isset( $field['value'] ) ) : ?>
														value="<?php echo esc_attr( $this->shared->format_time( stripslashes( $field['value'] ) ) ); ?>"
													<?php endif; ?>
												<?php endif; ?>
											/>
											<div class="help-icon" title="<?php echo esc_attr( $field['tooltip'] ); ?>"></div>
										</td>
									</tr>

									<?php

									break;

								// Image ------------------------------------------------------------------------------.
								case 'image':
									?>

									<tr class="<?php echo $container_classes; ?>">
										<th scope="row"><label for="<?php echo $field['column']; ?>"><?php echo esc_attr( $field['label'] ); ?><?php $this->generate_optional_label( $field ); ?></label></th>
										<td>

											<div class="image-uploader">
												<img class="selected-image"
													<?php if ( $this->edit_mode ) : ?>
														src="<?php echo esc_attr( stripslashes( $this->item_obj->{$field['column']} ) ); ?>"
														<?php echo strlen( trim( $this->item_obj->{$field['column']} ) ) == 0 ? 'style="display: none;"' : ''; ?>
													<?php else : ?>
														src=""
														style="display: none"
													<?php endif; ?>
												>
												<input
													type="hidden"
													id="<?php echo $field['column']; ?>"
													maxlength="2083"
													name="<?php echo $field['column']; ?>"
													<?php if ( $this->edit_mode ) : ?>
														value="<?php echo esc_attr( stripslashes( $this->item_obj->{$field['column']} ) ); ?>"
													<?php endif; ?>
												>
												<a class="button_add_media"
													<?php if ( $this->edit_mode ) : ?>
													data-set-remove="<?php echo strlen( trim( $this->item_obj->{$field['column']} ) ) == 0 ? 'set' : 'remove'; ?>"
													data-set="<?php echo esc_attr( $field['set_image'] ); ?>"
													data-remove="<?php echo esc_attr( $field['remove_image'] ); ?>"
												>
														<?php echo strlen( trim( $this->item_obj->{$field['column']} ) ) == 0 ? esc_attr__( $field['set_image'] ) : esc_attr__( $field['remove_image'] ); ?>
												</a>
													<?php else : ?>
														data-set="<?php echo esc_attr( $field['set_image'] ); ?>"
														data-remove="<?php echo esc_attr( $field['remove_image'] ); ?>"
														data-set-remove="set"><?php echo esc_attr( $field['set_image'] ); ?></a>
													<?php endif; ?>
												<p class="description"><?php echo esc_attr( $field['instructions'] ); ?></p>
											</div>

										</td>
									</tr>

									<?php

									break;

								// Color ------------------------------------------------------------------------------.
								case 'color':
									?>

									<tr class="<?php echo $container_classes; ?>">
										<th><label for="title"><?php echo esc_attr( $field['label'] ); ?><?php $this->generate_optional_label( $field ); ?></label></th>
										<td>
											<input type="text" id="<?php echo $field['column']; ?>" class="wp-color-picker" maxlength="7" size="30" name="<?php echo $field['column']; ?>"
												<?php if ( $this->edit_mode ) : ?>
													value="<?php echo esc_attr( stripslashes( $this->item_obj->{$field['column']} ) ); ?>"
												<?php else : ?>
													<?php if ( isset( $field['value'] ) ) : ?>
														value="<?php echo $field['value']; ?>"
													<?php endif; ?>
												<?php endif; ?>
											/>
											<div class="help-icon" title="<?php echo esc_attr( $field['tooltip'] ); ?>"></div>
										</td>
									</tr>

									<?php

									break;

							}

							?>

						<?php endforeach; ?>

					</table>

					<!-- submit button -->
					<div class="daext-form-action">
						<input class="button" type="submit"
							<?php if ( $this->edit_mode ) : ?>
								value="<?php echo esc_attr( $this->settings['label_update_item'] ); ?>"
							<?php else : ?>
								value="<?php echo esc_attr( $this->settings['label_add_item'] ); ?>"
							<?php endif; ?>
						>
						<input id="cancel" class="button" type="submit" value="<?php echo esc_attr( $this->settings['label_cancel_item'] ); ?>"
						data-url="<?php menu_page_url( $this->shared->get( 'slug' ) . '-' . esc_attr( $this->settings['url_slug'] ) ); ?>"
						>
					</div>

				</div>

			</form>

		</div>

		<?php
	}

	public function generate_menu() {

		$this->process_incoming_data();
		$this->create_update_database_table();

		?>

		<div class="wrap">

			<?php $this->generate_header_html(); ?>

			<div id="daext-menu-wrapper" class="daext-menu-wrapper-<?php echo esc_attr( $this->settings['url_slug'] ); ?>">

				<?php

				$this->generate_blocking_messages();
				$this->generate_paginated_table_html();
				$this->generate_form_html();

				?>

			</div><!-- #daext-menu-wrapper -->

		</div><!-- .wrap -->

		<?php
	}

	private function generate_optional_label( $field ) {

		if ( isset( $field['required'] ) && $field['required'] === true ) {
			echo '&nbsp<span>' . esc_attr__( '*', $this->shared->get( 'slug' ) ) . '</span>';
		}
	}

	// Simple Validations -----------------------------------------------------------------------------------------------
	// private function validate_text_0_255($value){
	//
	// if (preg_match('/^.{0,255}$/u', $value) === 1) {
	// return true;
	// }else{
	// return false;
	// }
	//
	// }
	//
	// private function validate_text_1_255($value){
	//
	// if (preg_match('/^.{1,255}$/u', $value) === 1) {
	// return true;
	// }else{
	// return false;
	// }
	//
	// }
	//
	// private function validate_url($value){
	//
	// if (preg_match('/^.{0,2083}$/u', $value) === 1) {
	// return true;
	// }else{
	// return false;
	// }
	//
	// }
	//
	// private function validate_url_empty_allowed($value){
	//
	// if (preg_match('/^.{0,2083}$/u', $value) === 1 or
	// strlen(trim($value)) === 0) {
	// return true;
	// }else{
	// return false;
	// }
	//
	// }
	//
	// private function validate_tinyint_unsigned($value){
	//
	// if (preg_match('/^\d{1,3}$/u', $value) === 1 AND
	// intval($value, 10) <= 255) {
	// return true;
	// }else{
	// return false;
	// }
	//
	// }
	//
	// private function validate_int_unsigned($value){
	//
	// if (preg_match('/^\d{1,10}$/u', $value) === 1 AND
	// intval($value, 10) <= 4294967295) {
	// return true;
	// }else{
	// return false;
	// }
	//
	// }
	//
	// private function validate_bigint_unsigned($value){
	//
	// if (preg_match('/^\d{1,20}$/u', $value) === 1 AND
	// intval($value, 10) <= 18446744073709551616) {
	// return true;
	// }else{
	// return false;
	// }
	//
	// }
	//
	// private function validate_date($value){
	//
	// if (preg_match('/^\d{4}-\d{2}-\d{2}$/u', $value)){
	// return true;
	// }else{
	// return false;
	// }
	//
	// }
	//
	// private function validate_date_empty_allowed($value){
	//
	// if (preg_match('/^\d{4}-\d{2}-\d{2}$/u', $value) or
	// strlen(trim($value)) === 0){
	// return true;
	// }else{
	// return false;
	// }
	//
	// }
	//
	// private function validate_time($value) {
	//
	// Ref: https://stackoverflow.com/questions/7536755/regular-expression-for-matching-hhmm-time-format
	// if ( preg_match( '/^(0[0-9]|1[0-9]|2[0-3]|[0-9]):[0-5][0-9]$/u', $value ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function validate_time_empty_allowed($value) {
	//
	// Ref: https://stackoverflow.com/questions/7536755/regular-expression-for-matching-hhmm-time-format
	// if ( preg_match( '/^(0[0-9]|1[0-9]|2[0-3]|[0-9]):[0-5][0-9]$/u', $value ) === 1
	// or strlen($value) === 0) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function validate_decimal_15_2($value){
	//
	// if (preg_match('/^\d{1,15}(?:\.\d{1,2})?$/u', $value)){
	// return true;
	// }else{
	// return false;
	// }
	//
	// }
	//
	// private function validate_bool($value){
	//
	// if (preg_match('/^0|1$/u', $value)){
	// return true;
	// }else{
	// return false;
	// }
	//
	// }
	//
	// private function validate_color($value){
	//
	// if (preg_match('/^#(?:[0-9a-fA-F]{3}){1,2}$/u', $value)){
	// return true;
	// }else{
	// return false;
	// }
	//
	// }
	//
	// private function validate_comma_separated_list_of_numbers($value){
	//
	// if (preg_match('/^(\s*(\d+\s*,\s*)+\d+\s*|\s*\d+\s*)$/u', $value)){
	// return true;
	// }else{
	// return false;
	// }
	//
	// }
	//
	// private function validate_rounds( $value ) {
	//
	// if ( intval( $value, 10 ) >= 1 and intval( $value, 10 ) <= 128 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function validate_player_foot( $value ) {
	//
	// if ( preg_match( '/^0|1|2|3$/u', $value ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function validate_competition_order_type( $value ) {
	//
	// if ( preg_match( '/^0|1|2$/u', $value ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function validate_player_position_abbreviation( $value ) {
	//
	// if ( preg_match( '/^.{1,3}$/u', $value ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function validate_team_slot( $value ) {
	//
	// if ( preg_match( '/^0|1$/u', $value ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function validate_competition_order_by( $value ) {
	//
	// if ( preg_match( '/^0|1|2|3|4|5$/u', $value ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	//
	// private function validate_jersey_number( $value ) {
	//
	// if ( preg_match( '/^\d{0,3}$/u', $value ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function validate_player_height( $value ) {
	//
	// if ( preg_match( '/^\d{0,3}$/u', $value ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function validate_match_part( $value ) {
	//
	// if ( preg_match( '/^0|1|2|3|4$/u', $value ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function validate_formation_position( $value ) {
	//
	// if ( preg_match( '/^\d{1,3}$/u', $value ) === 1 and
	// intval($value, 10) >= 0 and
	// intval($value, 10) <= 100) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function validate_player_position_not_available_allowed( $id ) {
	//
	// if ( intval( $id, 10 ) === 0 ) {
	// return true;
	// }
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_player_position";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE player_position_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function transfer_type_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_transfer_type";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE transfer_type_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function trophy_type_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_trophy_type";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE trophy_type_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function ranking_type_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_ranking_type";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE ranking_type_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function referee_badge_type_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_referee_badge_type";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE referee_badge_type_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function competition_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_competition";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE competition_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function competition_exists_none_allowed( $id ) {
	//
	// if ( intval( $id, 10 ) === 0 ) {
	// return true;
	// }
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_competition";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE competition_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function formation_exists_none_allowed( $id ) {
	//
	// if ( intval( $id, 10 ) === 0 ) {
	// return true;
	// }
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_formation";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE formation_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function player_award_type_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_player_award_type";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE player_award_type_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function player_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_player";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE player_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function unavailable_player_type_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_unavailable_player_type";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE unavailable_player_type_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function staff_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_staff";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE staff_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function jersey_set_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_jersey_set";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE jersey_set_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function jersey_set_exists_none_allowed( $id ) {
	//
	// if ( intval( $id, 10 ) === 0 ) {
	// return true;
	// }
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_jersey_set";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE jersey_set_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function staff_type_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_staff_type";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE staff_type_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function staff_award_type_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_staff_award_type";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE staff_award_type_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function stadium_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_stadium";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE stadium_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function stadium_exists_none_allowed( $id ) {
	//
	// if ( intval( $id, 10 ) === 0 ) {
	// return true;
	// }
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_stadium";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE stadium_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function team_contract_type_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_team_contract_type";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE team_contract_type_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function agency_contract_type_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_agency_contract_type";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE agency_contract_type_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function agency_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_agency";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE agency_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function team_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_team";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE team_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function team_exists_none_allowed( $id ) {
	//
	// if ( intval( $id, 10 ) === 0 ) {
	// return true;
	// }
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_team";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE team_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function referee_exists( $id ) {
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_referee";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE referee_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function referee_exists_none_allowed( $id ) {
	//
	// if ( intval( $id, 10 ) === 0 ) {
	// return true;
	// }
	//
	// global $wpdb;
	// $table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . "_referee";
	// $sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE referee_id = %d", $id );
	// $count      = $wpdb->get_var( $sql );
	//
	// if ( intval( $count, 10 ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function validate_country( $value ) {
	//
	// if ( preg_match( '/^\w{2}$/u', $value ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function validate_country_none_allowed( $value ) {
	//
	// if ( preg_match( '/^\w{2}$/u', $value ) === 1
	// or strlen( $value ) === 0 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function validate_attendance( $value ) {
	//
	// if ( preg_match( '/^\d{0,10}$/u', $value ) === 1 ) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
	//
	// private function validate_national_team_confederation( $value ) {
	//
	// if (intval($value, 10) >= 0 and intval($value, 10) <= 5) {
	// return true;
	// } else {
	// return false;
	// }
	//
	// }
}