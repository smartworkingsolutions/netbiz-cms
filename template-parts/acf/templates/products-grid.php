<?php
/**
 * The ACF template part for displaying Products grid.
 *
 * @package Netbiz
 */

$heading  = get_sub_field( 'products_grid_heading' );
$post_num = get_sub_field( 'products_number_of_posts' );
$order_by = get_sub_field( 'products_filter_by' );
$btn      = get_sub_field( 'products_grid_button' );
?>

<section class="featured-products mt-14">
	<div class="container">

		<?php

		// Heading.
		if ( $heading ) {
			echo '<h2 class="text-4.5xl font-black text-center mb-8 leading-none sm:leading-normal">' . wp_kses_post( $heading ) . '</h2>';
		}

		if ( ! is_woocommerce_activated() ) {
			echo '<p class="text-center">Please install/activate <span class="font-bold">WooCommerce</span> plugin to show products.</p>';
		} else {
			// Products shortcode.
			echo do_shortcode( '[products limit="' . esc_html( $post_num ) . '" columns="4" orderby="' . esc_html( $order_by ) . '"]' );
		}

		// Button.
		if ( $btn ) {
			printf(
				'<div class="text-center mt-14">
					<a href="%s" class="button button-border lg:w-96" target="%s">%s</a>
				</div>',
				esc_url( $btn['url'] ),
				esc_html( $btn['target'] ),
				esc_html( $btn['title'] )
			);
		}
		?>

	</div>
</section>
