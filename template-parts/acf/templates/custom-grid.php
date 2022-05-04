<?php
/**
 * The ACF template part for displaying Custom grid.
 *
 * @package Netbiz
 */

$heading = get_sub_field( 'custom_grid_heading' );
?>

<section class="featured-products mt-14">
	<div class="container">

		<?php

		// Heading.
		if ( $heading ) {
			echo '<h2 class="text-4.5xl font-black text-center mb-8 leading-none sm:leading-normal">' . wp_kses_post( $heading ) . '</h2>';
		}

		// Check lists exists.
		if ( have_rows( 'custom_grid_lists' ) ) :

			echo '<div class="item-wrap grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-x-10 gap-y-10 xl:gap-y-16">';

			// Loop through rows.
			while ( have_rows( 'custom_grid_lists' ) ) :
				the_row();

				// Load sub field value.
				$image = '';
				if ( get_sub_field( 'custom_grid_image' ) ) {
					$image = df_resize( get_sub_field( 'custom_grid_image' ), '', 424, 371, true, true );
				}
				$service_title = get_sub_field( 'custom_grid_title' );
				$service_link  = get_sub_field( 'custom_grid_link' );

				$image_html = '';
				$title_html = '';

				if ( $image ) {
					$image_html = sprintf(
						'<a href="%s" class="w-full block relative"><img class="w-full" src="%s" alt="%s"></a>',
						$service_link,
						$image['url'],
						$service_title
					);
				}
				if ( $service_title ) {
					$title_html = sprintf(
						'<h3 class="text-center font-bold bg-theme-color p-5"><a href="%s">%s</a></h3>',
						$service_link,
						$service_title
					);
				}

				printf(
					'<div class="single-item text-2xl transition ease-in-out hover:-translate-y-1 hover:scale-105 duration-300 text-dark-section-text">
						%s
						%s
					</div>',
					wp_kses_post( $image_html ),
					wp_kses_post( $title_html )
				);

			endwhile;

			echo '</div>';

		endif;

		?>

	</div>
</section>
