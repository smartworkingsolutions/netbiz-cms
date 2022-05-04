<?php
/**
 * The ACF template part for displaying FAQs.
 *
 * @package Netbiz
 */

$heading  = get_sub_field( 'faqs_heading' );
$post_num = get_sub_field( 'number_of_faqs' ) ? get_sub_field( 'number_of_faqs' ) : '3';
$count    = 1;
?>

<section class="faqs mt-14">
	<div class="container">

		<?php

		// Heading.
		if ( $heading ) {
			echo '<h2 class="text-4.5xl font-black text-center mb-10 leading-none sm:leading-normal">' . wp_kses_post( $heading ) . '</h2>';
		}

		echo '<div class="accordion flex flex-col space-y-10">';

		$query = new WP_Query( // phpcs:ignore
			[
				'post_type'      => 'faqs',
				'posts_per_page' => $post_num,
			]
		);

		if ( ! $query->have_posts() ) {
			echo '<p>No posts found.</p>';
		}

		while ( $query->have_posts() ) :
			$query->the_post();

			$is_link = get_field( 'link_to_single_page' );

			$checked = 1 === $count ? ' checked' : '';

			if ( $is_link ) {
				printf(
					'<a href="%s" class="arrow-link relative block bg-theme-color text-dark-section-text text-xl md:text-2xl font-bold pl-11 pr-20 py-7 cursor-pointer">
						<span class="mr-2 xl:mr-8">%s.</span>%s
					</a>',
					esc_url( get_permalink() ),
					esc_html( $count ),
					esc_html( get_the_title() )
				);
			} else {
				printf(
					'<div class="w-full">
						<input type="checkbox" name="panel" id="panel-%1$s" class="hidden"%2$s>
						<label for="panel-%1$s" class="relative block bg-theme-color text-dark-section-text text-xl md:text-2xl font-bold pl-11 pr-20 py-7 cursor-pointer"><span class="mr-2 xl:mr-8">%1$s.</span>%3$s</label>
						<div class="accordion__content bg-theme-color text-dark-section-text px-11 xl:px-24 overflow-hidden">
							<p id="panel%1$s">%4$s</p>
						</div>
					</div>',
					esc_html( $count ),
					esc_html( $checked ),
					esc_html( get_the_title() ),
					wp_kses_post( get_the_excerpt() )
				);
			}

			++$count;

		endwhile;

		wp_reset_postdata();

		echo '</div>';

		?>

	</div>
</section>
