<?php
/**
 * The template part for displaying Posts in case study page.
 *
 * @package Netbiz
 */

?>

<section class="about-the-brand mt-14">
	<div class="container">

		<?php

		echo '<div class="item-wrap grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-x-10 gap-y-10 xl:gap-y-16">';

		if ( ! have_posts() ) {
			echo '<p>No posts found.</p>';
		}

		while ( have_posts() ) :
			the_post();

			$thumbnail    = '';
			$thumbnail_id = '';

			if ( has_post_thumbnail() ) {
				$thumbnail_id = get_post_thumbnail_id( get_the_id() );
				$image        = df_resize( $thumbnail_id, '', 425, 476, true, true );

				$thumbnail = sprintf(
					'<img class="w-full h-auto 3xl:h-[476px] object-cover object-left" src="%s" alt="%s">',
					$image['url'],
					get_the_title()
				);
			}
			if ( get_the_title() ) {
				$title_html = sprintf(
					'<h3 class="text-2xl font-bold"><a href="%s">%s</a></h3>',
					get_permalink(),
					get_the_title()
				);
			}
			$link_html = sprintf(
				'<a class="group" href="%s">%s <i class="far fa-long-arrow-alt-right transition ease-in-out group-hover:translate-x-2"></i></a>',
				get_permalink(),
				get_the_title()
			);

			printf(
				'<div class="single-item transition ease-in-out hover:-translate-y-1 hover:scale-105 duration-300 relative">
					%s
					<div class="flex flex-col bg-black/30 px-10 py-11 space-y-4 text-white absolute left-0 bottom-0 right-0">
						%s
						%s
					</div>
				</div>',
				$thumbnail, // phpcs:ignore
				wp_kses_post( $title_html ),
				wp_kses_post( $link_html )
			);

		endwhile;

		wp_reset_postdata();

		echo '</div>';

		?>

	</div>
</section>

<?php bootstrap_pagination(); ?>
