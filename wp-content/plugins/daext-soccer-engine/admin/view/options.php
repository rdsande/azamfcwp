<?php
/**
 * Settings to display the "Options" menu.
 *
 * @package daext-soccer-engine
 */

if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( __( 'You do not have sufficient capabilities to access this page.' ) );
}

?>

<div class="wrap">

	<h2><?php esc_attr_e( 'Soccer Engine - Options', 'dase' ); ?></h2>

	<?php

	// settings errors.
	if ( isset( $_GET['settings-updated'] ) and $_GET['settings-updated'] == 'true' ) {
		if ( $this->write_custom_css() === false ) {
			?>
			<div id="setting-error-settings_updated" class="error settings-error notice is-dismissible below-h2">
				<p><strong><?php esc_html_e( "The plugin can't write files in the upload directory.", 'dase' ); ?></strong></p>
				<button type="button" class="notice-dismiss"><span
							class="screen-reader-text">Dismiss this notice.</span></button>
			</div>
			<?php
		}
		settings_errors();
	}

	?>

	<div id="daext-options-wrapper">

		<?php
		// get current tab value.
		$active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'colors_options';
		?>

		<div class="nav-tab-wrapper">
			<a href="?page=dase-options&tab=colors_options"
				class="nav-tab <?php echo $active_tab == 'colors_options' ? 'nav-tab-active' : ''; ?>">
										<?php
											esc_attr_e(
												'Colors',
												'dase'
											);
											?>
					</a>
			<a href="?page=dase-options&tab=capabilities_options"
				class="nav-tab <?php echo $active_tab == 'capabilities_options' ? 'nav-tab-active' : ''; ?>">
										<?php
											esc_attr_e(
												'Capabilities',
												'dase'
											);
											?>
					</a>
			<a href="?page=dase-options&tab=pagination_options"
				class="nav-tab <?php echo $active_tab == 'pagination_options' ? 'nav-tab-active' : ''; ?>">
										<?php
											esc_attr_e(
												'Pagination',
												'dase'
											);
											?>
					</a>
			<a href="?page=dase-options&tab=advanced_options"
				class="nav-tab <?php echo $active_tab == 'advanced_options' ? 'nav-tab-active' : ''; ?>">
										<?php
											esc_attr_e(
												'Advanced',
												'dase'
											);
											?>
					</a>
		</div>

		<form method="post" action="options.php" autocomplete="off">

			<?php

			if ( $active_tab == 'colors_options' ) {

				settings_fields( $this->shared->get( 'slug' ) . '_colors_options' );
				do_settings_sections( $this->shared->get( 'slug' ) . '_colors_options' );

			}

			if ( $active_tab == 'capabilities_options' ) {

				settings_fields( $this->shared->get( 'slug' ) . '_capabilities_options' );
				do_settings_sections( $this->shared->get( 'slug' ) . '_capabilities_options' );

			}

			if ( $active_tab == 'pagination_options' ) {

				settings_fields( $this->shared->get( 'slug' ) . '_pagination_options' );
				do_settings_sections( $this->shared->get( 'slug' ) . '_pagination_options' );

			}

			if ( $active_tab == 'advanced_options' ) {

				settings_fields( $this->shared->get( 'slug' ) . '_advanced_options' );
				do_settings_sections( $this->shared->get( 'slug' ) . '_advanced_options' );

			}

			?>

			<div class="daext-options-action">
				<input type="submit" name="submit" id="submit" class="button"
						value="<?php esc_attr_e( 'Save Changes', 'dase' ); ?>">
			</div>

		</form>

	</div>

</div>