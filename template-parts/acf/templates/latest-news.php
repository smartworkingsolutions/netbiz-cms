<?php
/**
 * The ACF template part for displaying Testimonials.
 *
 * @package Netbiz
 */

$heading  = get_sub_field( 'latest_news_heading' );
$post_num = get_sub_field( 'latest_news_number_of_posts' ) ? get_sub_field( 'latest_news_number_of_posts' ) : '4';
$random   = get_sub_field( 'show_random_posts' );
?>

<section class="latest-news bg-theme-color text-dark-section-text mt-14 py-14">
	<div class="container">

		<?php
		if ( $heading ) {
			echo '<h2 class="text-4.5xl font-black text-center mb-10 leading-none sm:leading-normal">' . wp_kses_post( $heading ) . '</h2>';
		}

		echo '<div class="item-wrap grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-10">';

		$args = [
			'posts_per_page' => $post_num,
			'order'          => 'ASC',
			'post__not_in'   => get_option( 'sticky_posts' ),
		];

		if ( 'yes' === $random ) {
			$args['post__not_in'] = [ get_the_ID() ];
			$args['orderby']      = 'rand';
		}

		$query = new WP_Query( $args );

		if ( ! $query->have_posts() ) {
			echo '<p>No posts found.</p>';
		}

		while ( $query->have_posts() ) :
			$query->the_post();

			$thumbnail    = '';
			$thumbnail_id = '';
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
			$btn_html = sprintf(
				'<a class="mt-6 group" href="%s">%s <i class="far fa-long-arrow-alt-right transition ease-in-out group-hover:translate-x-2"></i></a>',
				get_permalink(),
				__( 'Read More', 'netbiz' )
			);

			printf(
				'<div class="single-item flex flex-col">
					%s
					%s
					<h3 class="text-2xl font-bold mt-6">%s</h3>
					%s
				</div>',
				$thumbnail, // phpcs:ignore
				wp_kses_post( $meta_html ),
				esc_html( get_the_title() ),
				wp_kses_post( $btn_html )
			);

		endwhile;

		wp_reset_postdata();

		echo '</div>';
		?>

	</div>
</section>
