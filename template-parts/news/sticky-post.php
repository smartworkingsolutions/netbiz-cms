<?php
/**
 * The ACF template part for displaying Sticky Post.
 *
 * @package Netbiz
 */

?>

<section class="image-content-wrapper mt-16">
	<div class="container">

		<?php
		$query = new WP_Query( // phpcs:ignore
			[
				'posts_per_page'      => 1,
				'post__in'            => get_option( 'sticky_posts' ),
				'ignore_sticky_posts' => 1,
			]
		);

		while ( $query->have_posts() ) :
			$query->the_post();

			$thumbnail    = '';
			$thumbnail_id = '';
			$title_html   = '';
			$meta_html    = '';
			$btn_html     = '';
			$date         = get_the_date();
			$categories   = get_the_category_list( esc_html__( ', ', 'netbiz' ) );

			if ( has_post_thumbnail() ) {
				$thumbnail_id = get_post_thumbnail_id( get_the_id() );
				$image        = df_resize( $thumbnail_id, '', 735, 439, true, true );

				$thumbnail = sprintf(
					'<div class="image">
						<img class="w-full h-[480px] object-cover" src="%s" alt="%s">
					</div>',
					$image['url'],
					get_the_title()
				);
			}

			if ( $date || $categories ) {
				$meta_html = sprintf(
					'<div class="meta flex justify-between mb-4 3xl:mb-5">
						<div>%s</div>
						<div class="cat">%s</div>
					</div>',
					$date,
					$categories
				);
			}
			if ( get_the_title() ) {
				$title_html = sprintf(
					'<h2 class="text-2xl font-bold mb-6 3xl:mb-10 hover:text-theme-color">
						<a href="%s">%s</a>
					</h3>',
					get_permalink(),
					get_the_title()
				);
			}
			$btn_html = sprintf(
				'<a class="group block mt-4 2xl:mt-6" href="%s">%s <i class="far fa-long-arrow-alt-right transition ease-in-out group-hover:translate-x-2"></i></a>',
				get_permalink(),
				__( 'Read More', 'netbiz' )
			);

			printf(
				'<article class="grid grid-cols-1 lg:grid-cols-2 gap-10 sticky">
					%s
					<div class="content">
						%s
						%s
						<div class="space-y-8">%s</div>
						%s
					</div>
				</article>',
				$thumbnail, // phpcs:ignore
				wp_kses_post( $meta_html ),
				wp_kses_post( $title_html ),
				html_entity_decode( wp_trim_words( htmlentities( wpautop( get_the_content() ) ), 160, '...' ) ), // phpcs:ignore
				wp_kses_post( $btn_html )
			);

		endwhile;

		wp_reset_postdata();
		?>

	</div>
</section>