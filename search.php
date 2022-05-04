<?php
/**
 * The template for displaying Team CPT.
 *
 * @package Netbiz
 */

get_header();
?>

<section class="latest-news mt-16">
	<div class="container">

		<?php
		echo '<div class="item-wrap grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-10">';

		if ( ! have_posts() ) {
			echo '<p>No posts found.</p>';
		}

		while ( have_posts() ) :
			the_post();

			$thumbnail    = '';
			$thumbnail_id = '';
			$title_html   = '';
			$meta_html    = '';
			$btn_html     = '';
			$date         = get_the_date();
			$categories   = get_the_category_list( esc_html__( ', ', 'netbiz' ) );

			if ( has_post_thumbnail() ) {
				$thumbnail_id = get_post_thumbnail_id( get_the_id() );
				$image        = df_resize( $thumbnail_id, '', 425, 308, true, true );

				$thumbnail = sprintf(
					'<img class="w-full" src="%s" alt="%s">',
					$image['url'],
					get_the_title()
				);
			}

			if ( $date || $categories ) {
				$meta_html = sprintf(
					'<div class="meta-info flex justify-between mt-6">
						<div class="date">%s</div>
						<div class="category">%s</div>
					</div>',
					$date,
					$categories
				);
			}
			if ( get_the_title() ) {
				$title_html = sprintf(
					'<h3 class="text-2xl font-bold mt-6 hover:text-theme-color">
						<a href="%s">%s</a>
					</h3>',
					get_permalink(),
					get_the_title()
				);
			}
			$btn_html = sprintf(
				'<a class="mt-6 group" href="%s">%s <i class="far fa-long-arrow-alt-right transition ease-in-out group-hover:translate-x-2"></i></a>',
				get_permalink(),
				__( 'Read More', 'netbiz' )
			);

			printf(
				'<div class="single-item flex flex-col">
					%s
					%s
					%s
					%s
				</div>',
				$thumbnail, // phpcs:ignore
				wp_kses_post( $meta_html ),
				wp_kses_post( $title_html ),
				wp_kses_post( $btn_html )
			);

		endwhile;

		wp_reset_postdata();

		echo '</div>';
		?>

	</div>
</section>

<?php bootstrap_pagination(); ?>

<?php
get_footer();
