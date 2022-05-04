<?php
/**
 * The ACF template part for displaying Testimonials in case study page.
 *
 * @package Netbiz
 */

$heading  = get_field( 'cs_testimonial_heading', 'option' );
$post_num = get_field( 'cs_number_of_testimonials', 'option' );

if ( ! $heading && ! $post_num ) {
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

		echo '<div class="item-wrap mb-8">';

		$query = new WP_Query( // phpcs:ignore
			[
				'post_type'      => 'testimonials',
				'posts_per_page' => $post_num,
			]
		);

		if ( ! $query->have_posts() ) {
			echo '<p>No posts found.</p>';
		}

		while ( $query->have_posts() ) :
			$query->the_post();

			printf(
				'<div class="single-item flex flex-col space-y-10 text-center relative">
					<p>%s</p>
					<p>%s</p>
				</div>',
				wp_kses_post( wp_trim_words( get_the_excerpt(), 18 ) ),
				wp_kses_post( get_the_title() )
			);

		endwhile;

		wp_reset_postdata();

		echo '</div>';

		?>

	</div>
</section>
