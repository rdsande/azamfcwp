<?php
/**
 * Settings to display the "Import" menu.
 *
 * @package daext-soccer-engine
 */

if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_attr__( 'You do not have sufficient permissions to access this page.', 'dase' ) );
}

?>

<!-- output -->

<div class="wrap">

	<h2><?php esc_attr_e( 'Soccer Engine - Import', 'dase' ); ?></h2>

	<div id="daext-menu-wrapper">

		<?php

		$this->shared->set_met_and_ml();

		// Process the xml file upload.
		if ( isset( $_FILES['file_to_upload'] ) &&
			isset( $_FILES['file_to_upload']['name'] ) &&
			preg_match( '/^.+\.xml$/', $_FILES['file_to_upload']['name'], $matches ) === 1
		) {

			$counter = 0;

			/**
			 * Import the data available in a previously exported XML file. Note that, to preserve the referential
			 * integrity, the data of the tables available in the imported XML file are parsed based on the
			 * order determined by the hierarchical level defined in the Dase_Shared::database_tables property.
			 */
			if ( file_exists( $_FILES['file_to_upload']['tmp_name'] ) ) {

				global $wpdb;
				$primary_key_change_a = array();

				// read xml file.
				$xml = simplexml_load_file( $_FILES['file_to_upload']['tmp_name'] );

				// Sort the database tables based on their hierarchical level from the lowest to the higher.
				$database_table_a = $this->shared->get( 'database_tables' );
				usort(
					$database_table_a,
					function ( $a, $b ) {
						return $a['hierarchy_level'] - $b['hierarchy_level'];
					}
				);

				foreach ( $database_table_a as $key => $database_table ) {

					$table_a = $xml->{$database_table['name']};

					if ( count( $table_a ) > 0 ) {

						foreach ( $table_a->record as $single_record ) {

							// convert object to array.
							$single_table_a = get_object_vars( $single_record );

							// replace empty objects with empty strings to prevent notices on the next insert() method.
							$single_table_a = $this->shared->replace_empty_objects_with_empty_strings( $single_table_a );

							// save the id key.
							$original_key = $single_table_a[ $database_table['sort_by'] ];

							// remove the id key
							unset( $single_table_a[ $database_table['sort_by'] ] );

							if ( $this->shared->table_has_foreign_keys( $database_table['name'] ) ) {

								/**
								 * Replace the values of old foreign keys (stored in the XML file) with the new keys
								 * (retrieved after the actual creation of the record in the database table).
								 *
								 * Note that this step is necessary to preserve the referential integrity of the
								 * imported data.
								 */
								foreach ( $single_table_a as $field_name => $field_value ) {

									/**
									 * For performance reasons perform the next foreach (used to replace the value of the
									 * old foreign keys with the new keys retrieved after the actual creation of the
									 * database table) only if the database table field is a foreign key.
									 */
									if ( $this->shared->is_foreign_key( $database_table['name'], $field_name ) ) {
										foreach ( $primary_key_change_a as $primary_key_change ) {
											if ( $primary_key_change['key_name'] === $this->shared->get_comparable_field_name( $database_table['name'], $field_name ) ) {
												if ( intval( $field_value, 10 ) === $primary_key_change['old_key_value'] ) {
													$single_table_a[ $field_name ] = $primary_key_change['new_key_value'];
												}
											}
										}
									}
								}
							}

							// add in the database table
							$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_' . $database_table['name'];
							$wpdb->insert(
								$table_name,
								$single_table_a
							);
							$inserted_table_id = $wpdb->insert_id;

							if ( 0 !== $inserted_table_id ) {

								/**
								 * Save in a hash table the old foreign key value (stored in the XML file) with the
								 * related new foreign key value (retrieved after the actual creation of the record in
								 * the database table).
								 *
								 * Note that this step is necessary to preserve the referential integrity of the
								 * imported data.
								 */
								$primary_key_change_a[] = array(
									'key_name'      => $database_table['sort_by'],
									'old_key_value' => intval( $original_key, 10 ),
									'new_key_value' => intval( $inserted_table_id, 10 ),
								);

								++$counter;

							}
						}
					}
				}

				echo '<div class="updated settings-error notice is-dismissible below-h2"><p>' . $counter . ' ' . esc_attr__( 'records have been added.', 'dase' ) . '</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">' . esc_attr__( 'Dismiss this notice.', 'dase' ) . '</span></button></div>';

			}
		}

		?>

		<p><?php esc_attr_e( 'Import the tables stored in your XML file by clicking the Upload file and import button.', 'dase' ); ?></p>
		<form enctype="multipart/form-data" id="import-upload-form" method="post" class="wp-upload-form" action="">
			<p>
				<label for="upload"><?php esc_attr_e( 'Choose a file from your computer:', 'dase' ); ?></label>
				<input type="file" id="upload" name="file_to_upload">
			</p>
			<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary"
									value="<?php esc_attr_e( 'Upload file and import', 'dase' ); ?>"></p>
		</form>
		<p><strong><?php esc_attr_e( 'IMPORTANT: This menu should only be used to import the XML files generated with the "Export" menu.', 'dase' ); ?></strong></p>

	</div>

</div>