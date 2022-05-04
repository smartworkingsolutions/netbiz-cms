<?php
/**
 * The ACF template part for displaying Instragram feeds.
 *
 * @package Netbiz
 */

$heading   = get_sub_field( 'instagram_heading' );
$shortcode = get_sub_field( 'instagram_shortcodes' );
?>

<section class="instagram mt-14">
	<div class="container">

		<?php

		// Heading.
		if ( $heading ) {
			echo '<h2 class="text-4.5xl font-black text-center mb-10 leading-none sm:leading-normal">' . wp_kses_post( $heading ) . '</h2>';
		}

		// Shortcode.
		echo do_shortcode( $shortcode );

		?>

	</div>
</section>
