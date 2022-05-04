<?php
/**
 * The template part for displaying team's single content.
 *
 * @package Netbiz
 */

?>

<section class="image-content-wrapper py-12 mb-6">
	<div class="container">

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

			<?php
			while ( have_posts() ) :
				the_post();

				$thumbnail     = '';
				$thumbnail_id  = '';
				$linkedin_html = '';

				$profile  = get_field( 'team_single_job_profile' );
				$linkedin = get_field( 'team_single_linkedin' );

				if ( $linkedin ) {
					$linkedin_html = sprintf(
						'<div class="cv flex items-center space-x-3">
							<a href="%s" target="_blank" class="icon text-3xl"><i class="fab fa-linkedin"></i></a>
						</div>',
						$linkedin
					);
				}

				if ( has_post_thumbnail() ) {
					$thumbnail_id = get_post_thumbnail_id( get_the_id() );
					$image        = df_resize( $thumbnail_id, '', 894, 497, true, true );

					printf(
						'<div class="image">
							<img src="%s" alt="%s">
						</div>',
						esc_url( $image['url'] ),
						esc_html( get_the_title() )
					);
				}

				echo '<div class="content">';

				echo '<div class="flex justify-between">';

				the_title( '<h3 class="text-2xl font-black mb-8">', '</h3>' );

				echo '</div>';

				if ( $profile || $linkedin ) {
					printf(
						'<div class="meta flex justify-between items-center mb-10">
							<div>%s</div>
							%s
						</div>',
						esc_html( $profile ),
						wp_kses_post( $linkedin_html )
					);
				}

				echo '<div class="space-y-8">';
				the_content();
				echo '</div>';

				echo '</div>';

			endwhile; // End of the loop.
			?>

		</div>

	</div>
</section>
