<?php
/**
 * Settings to display the "Export" menu.
 *
 * @package daext-soccer-engine
 */

if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_attr__( 'You do not have sufficient permissions to access this page.', 'dase' ) );
}

?>

<!-- output -->

<div class="wrap">

	<h2><?php esc_attr_e( 'Soccer Engine - Export', 'dase' ); ?></h2>

	<div id="daext-menu-wrapper">

		<p><?php esc_attr_e( 'Click the Export button to generate an XML file that includes all the data.', 'dase' ); ?></p>

		<!-- the data sent through this form are handled by the export_xml_controller() method called with the WordPress init action -->
		<form method="POST" action="admin.php?page=dase-export">

			<div class="daext-widget-submit">
				<input name="dase_export" class="button button-primary" type="submit"
						value="<?php esc_attr_e( 'Export', 'dase' ); ?>">
			</div>

		</form>

	</div>

</div>