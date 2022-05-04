<?php
/**
 * The template part for displaying Widget 3 in footer.
 *
 * @package Netbiz
 */

$heading = get_field( 'fw3_heading', 'option' );
$address = get_field( 'fw3_address_alt', 'option' );

if ( ! $heading && ! $address ) {
	return;
}
?>

<div class="f-widget md:text-right xl:col-span-3">

	<?php

	if ( $heading ) {
		echo '<h3 class="widget-title text-xl text-theme-color mb-6">' . esc_html( $heading ) . '</h3>';
	}

	if ( $address ) {
		echo '<address class="not-italic grid gap-y-4">' . $address . '</address>'; //phpcs:ignore.
	}

	?>

</div>
