<?php
/**
 * The ACF template part for displaying Team posts
 *
 * @package Netbiz
 */

?>

<section class="mt-16">
	<div class="container">

		<?php

		echo '<div class="item-wrap grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-x-10 gap-y-14">';

		if ( ! have_posts() ) {
			echo '<p>No posts found.</p>';
		}

		while ( have_posts() ) :
			the_post();

			$thumbnail    = '';
			$thumbnail_id = '';
			$content      = '';
			$footer       = '';

			$email    = get_field( 'team_single_email' );
			$phone    = get_field( 'team_single_phone' );
			$linkedin = get_field( 'team_single_linkedin' );
			$profile  = get_field( 'team_single_job_profile' );

			$email_html    = '';
			$phone_html    = '';
			$linkedin_html = '';

			if ( has_post_thumbnail() ) {
				$thumbnail_id = get_post_thumbnail_id( get_the_id() );
				$image        = df_resize( $thumbnail_id, '', 425, 362, true, true );

				$thumbnail = sprintf(
					'<a href="%s"><img class="w-full" src="%s" alt="%s"></a>',
					get_permalink(),
					$image['url'],
					get_the_title()
				);
			}

			$content = sprintf(
				'<div class="text flex flex-col text-center my-8">
					<h3 class="text-2xl font-bold mb-2"><a class="hover:text-theme-color" href="%s">%s</a></h3>
					<p>%s</p>
				</div>',
				get_permalink(),
				get_the_title(),
				$profile
			);

			if ( $email ) {
				$email_html = '<a class="w-full hover:opacity-80" href="mailto:' . $email . '"><i class="far fa-envelope"></i></a>';
				if ( $phone ) {
					$email_html .= '<span class="w-full">|</span>';
				}
			}
			if ( $phone ) {
				$phone_html = '<a class="w-full hover:opacity-80" href="tel:' . $phone . '"><i class="far fa-phone"></i></a>';
				if ( $linkedin ) {
					$phone_html .= '<span class="w-full">|</span>';
				}
			}
			if ( $linkedin ) {
				$linkedin_html = '<a class="w-full hover:opacity-80" href="' . $linkedin . '"><i class="fab fa-linkedin-in"></i>';
			}

			if ( $email || $phone || $linkedin ) {
				$footer = sprintf(
					'<footer class="flex justify-center bg-theme-color text-dark-section-text text-2xl text-center px-7 py-3">
						%s
						%s
						%s
					</footer>',
					$email_html,
					$phone_html,
					$linkedin_html
				);
			}

			printf(
				'<div class="single-item flex flex-col">
					%s
					%s
					%s
				</div>',
				$thumbnail, // phpcs:ignore
				wp_kses_post( $content ),
				wp_kses_post( $footer )
			);

		endwhile;

		wp_reset_postdata();

		echo '</div>';

		?>

	</div>
</section>

<?php bootstrap_pagination(); ?>
