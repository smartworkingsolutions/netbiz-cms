<?php
/**
 * The ACF template part for displaying Services posts grid.
 *
 * @package Netbiz
 */

$heading  = get_sub_field( 'services_grid_heading' );
$post_num = get_sub_field( 'services_grid_number_of_posts' ) ? get_sub_field( 'services_grid_number_of_posts' ) : '4';
?>

<section class="featured-products mt-14">
	<div class="container">

		<?php

		// Heading.
		if ( $heading ) {
			echo '<h2 class="text-4.5xl font-black text-center mb-8 leading-none sm:leading-normal">' . wp_kses_post( $heading ) . '</h2>';
		}

		echo '<div class="item-wrap grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-x-10 gap-y-10 xl:gap-y-16">';

		$query = new WP_Query( // phpcs:ignore
			[
				'post_type'      => 'services',
				'posts_per_page' => $post_num,
			]
		);

		if ( ! $query->have_posts() ) {
			echo '<p>No posts found.</p>';
		}

		while ( $query->have_posts() ) :
			$query->the_post();

			$thumbnail    = '';
			$thumbnail_id = '';
			$title_html   = '';

			if ( has_post_thumbnail() ) {
				$thumbnail_id = get_post_thumbnail_id( get_the_id() );
				$image        = df_resize( $thumbnail_id, '', 424, 371, true, true );

				$thumbnail = sprintf(
					'<div class="w-full relative"><img class="w-full" src="%s" alt="%s"></div>',
					$image['url'],
					get_the_title()
				);
			}

			$title_html = sprintf(
				'<h3 class="text-center font-bold bg-theme-color p-5"><a href="%s">%s</a></h3>',
				get_permalink(),
				get_the_title()
			);

			printf(
				'<div class="single-item text-2xl transition ease-in-out hover:-translate-y-1 hover:scale-105 duration-300 text-dark-section-text">
					%s
					%s
				</div>',
				$thumbnail, //phpcs:ignore
				wp_kses_post( $title_html )
			);

		endwhile;

		wp_reset_postdata();

		echo '</div>';

		?>

	</div>
</section>
