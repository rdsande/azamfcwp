<?php
/**
 * Settings to display the "Maintenance" menu.
 *
 * @package daext-soccer-engine
 */

if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_attr__( 'You do not have sufficient permissions to access this page.', 'dase' ) );
}

?>

<!-- process data -->

<?php

if ( isset( $_POST['form_submitted'] ) ) {

	extract( $_POST );

	// prepare data.
	$task                = intval( $_POST['task'], 10 );
	$total_query_results = 0;

	$invalid_data_message = '';
	$invalid_data         = false;

	if ( false === $invalid_data ) {

		switch ( $task ) {

			// Delete Data.
			case 0:
				$database_table_a = $this->shared->get( 'database_tables' );
				foreach ( $database_table_a as $key => $database_table ) {

					global $wpdb;
					$table_name   = $wpdb->prefix . $this->shared->get( 'slug' ) . '_' . $database_table['name'];
					$query_result = $wpdb->query( "DELETE FROM $table_name" );

					if ( $query_result !== false ) {

						if ( $query_result > 0 ) {
							$total_query_results  = $total_query_results + intval( $query_result, 10 );
							$process_data_message = '<div class="updated settings-error notice is-dismissible below-h2"><p>' . intval(
								$query_result,
								10
							) . '&nbsp' . esc_attr__(
								'records have been successfully deleted.',
								'dase'
							) . '</p></div>';
						} else {
							$process_data_message = '<div class="updated settings-error notice is-dismissible below-h2"><p>' . esc_attr__(
								'The are no records in this range.',
								'dase'
							) . '</p></div>';
						}
					}
				}

				$process_data_message = '<div class="updated settings-error notice is-dismissible below-h2"><p>' . intval(
					$total_query_results,
					10
				) . '&nbsp' . esc_attr__(
					'records have been successfully deleted.',
					'dase'
				) . '</p></div>';

				break;

			// Delete Transients.
			case 1:
				$result = $this->shared->delete_plugin_transients();

				// Generate message.
				if ( $result ) {
					$process_data_message = '<div class="updated settings-error notice is-dismissible below-h2"><p>' . esc_html__(
						'The transients have been successfully deleted.',
						'dase'
					) . '</p></div>';
				} else {
					$process_data_message = '<div class="error settings-error notice is-dismissible below-h2"><p>' . esc_html__(
						'There are no transients at the moment.',
						'dase'
					) . '</p></div>';
				}

				break;

		}
	}
}

?>

<!-- output -->

<div class="wrap">

	<div id="daext-header-wrapper" class="daext-clearfix">

		<h2><?php esc_attr_e( 'Soccer Engine - Maintenance', 'dase' ); ?></h2>

	</div>

	<div id="daext-menu-wrapper">

		<?php
		if ( isset( $invalid_data_message ) ) {
			echo $invalid_data_message;
		}
		?>
		<?php
		if ( isset( $process_data_message ) ) {
			echo $process_data_message;
		}
		?>

		<!-- table -->

		<div>

			<form id="form-maintenance" method="POST"
					action="admin.php?page=<?php echo $this->shared->get( 'slug' ); ?>-maintenance"
					autocomplete="off">

				<input type="hidden" value="1" name="form_submitted">

				<div class="daext-form-container">

					<div class="daext-form-title"><?php esc_attr_e( 'Maintenance', 'dase' ); ?></div>

					<table class="daext-form daext-form-table">

						<!-- Task -->
						<tr>
							<th scope="row"><?php esc_attr_e( 'Task', 'dase' ); ?></th>
							<td>
								<select id="task" name="task" class="daext-display-none">
									<option value="0" selected="selected"><?php esc_attr_e( 'Delete Data', 'dase' ); ?></option>
									<option value="1"><?php esc_attr_e( 'Delete Transients', 'dase' ); ?></option>
								</select>
								<div class="help-icon"
									title='<?php esc_attr_e( 'The task that should be performed.', 'dase' ); ?>'></div>
							</td>
						</tr>

					</table>

					<!-- submit button -->
					<div class="daext-form-action">
						<input id="execute-task" class="button" type="submit"
								value="<?php esc_attr_e( 'Execute Task', 'dase' ); ?>">
					</div>

				</div>

			</form>

		</div>

	</div>

</div>

<!-- Dialog Confirm -->
<div id="dialog-confirm" title="<?php esc_attr_e( 'Execute the task?', 'dase' ); ?>" class="daext-display-none">
	<p>
	<?php
	esc_attr_e(
		'Multiple database items are going to be deleted. Do you really want to proceed?',
		'dase'
	);
	?>
			</p>
</div>