<?php
/**
 * The ACF template part for displaying Custom Testimonials using ACF.
 *
 * @package Netbiz
 */

$heading = get_sub_field( 'custom_testimonials_heading' );

if ( ! $heading && ! have_rows( 'testimonials_lists' ) ) {
	return;
}
?>

<section class="testimonials bg-theme-color text-dark-section-text mt-14 py-14">
	<div class="container">

		<?php

		// Heading.
		if ( $heading ) {
			echo '<h2 class="text-4.5xl font-black text-center mb-10 leading-none sm:leading-normal">' . wp_kses_post( $heading ) . '</h2>';
		}

		// Check lists exists.
		if ( have_rows( 'testimonials_lists' ) ) :

			echo '<div class="item-wrap mb-8">';

			// Loop through rows.
			while ( have_rows( 'testimonials_lists' ) ) :
				the_row();

				// Load sub field value.
				$testimonial = get_sub_field( 'testimonials_text' );
				$author_name = get_sub_field( 'testimonials_author_name' );

				if ( ! $testimonial && ! $author_name ) {
					echo '<p>Please add testimonials.</p>';
				}
				if ( $testimonial || $author_name ) {
					printf(
						'<div class="single-item flex flex-col space-y-10 text-center relative">
							<p>%s</p>
							<p>%s</p>
						</div>',
						wp_kses_post( $testimonial ),
						wp_kses_post( $author_name )
					);
				}

			endwhile;

			echo '</div>';

		endif;

		?>

	</div>
</section>
