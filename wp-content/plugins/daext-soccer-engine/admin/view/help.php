<?php
/**
 * Settings to display the "Help" menu.
 *
 * @package daext-soccer-engine
 */

if ( ! current_user_can( 'edit_posts' ) ) {
	wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'dase' ) );
}

?>

<!-- output -->

<div class="wrap">

	<h2><?php esc_html_e( 'Soccer Engine - Help', 'dase' ); ?></h2>

	<div id="daext-menu-wrapper">

		<p><?php esc_html_e( 'Visit the resources below to find your answers or to ask questions directly to the plugin developers.', 'dase' ); ?></p>
		<ul>
			<li><a href="https://daext.com/doc/soccer-engine-pro/"><?php esc_html_e( 'Plugin Documentation', 'dase' ); ?>
			<li><a href="https://daext.com/support/"><?php esc_html_e( 'Support Conditions', 'dase' ); ?>
			</li>
			<li><a href="https://daext.com"><?php esc_html_e( 'Developer Website', 'dase' ); ?></a></li>
		</ul>

	</div>

</div>