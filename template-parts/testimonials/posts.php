<?php
/**
 * The ACF template part for displaying Testimonials posts
 *
 * @package Netbiz
 */

$heading      = get_field( 'cpt_testimonials_heading', 'option' );
$social_links = get_social_links();
?>

<section class="image-content-wrapper my-16">
	<div class="container">

		<div class="grid sm:flex sm:space-x-8 justify-center items-center mb-12">
			<?php
			if ( $heading ) {
				echo '<button class="open-modal text-2xl font-bold mb-4 sm:mb-0" data-modal="review">' . esc_html( $heading ) . '</button>';
			}
			?>
			<ul class="flex space-x-12 text-3xl">
				<?php
				if ( $social_links['facebook'] ) {
					echo '<li><a class="text-theme-color hover:text-dark-color" href="' . esc_url( $social_links['facebook'] ) . '"><i class="fab fa-facebook"></i></a></li>';
				}
				if ( $social_links['instagram'] ) {
					echo '<li><a class="text-theme-color hover:text-dark-color" href="' . esc_url( $social_links['instagram'] ) . '"><i class="fa fa-instagram"></i></a></li>';
				}
				if ( $social_links['twitter'] ) {
					echo '<li><a class="text-theme-color hover:text-dark-color" href="' . esc_url( $social_links['twitter'] ) . '"><i class="fa fa-twitter"></i></a></li>';
				}
				if ( $social_links['linkedin'] ) {
					echo '<li><a class="text-theme-color hover:text-dark-color" href="' . esc_url( $social_links['linkedin'] ) . '"><i class="fa fa-linkedin"></i></a></li>';
				}
				?>
			</ul>
		</div>

		<?php
		// Posts.
		echo '<div class="grid grid-cols-1 lg:grid-cols-2 gap-10">';

		if ( ! have_posts() ) {
			echo '<p>No posts found.</p>';
		}

		while ( have_posts() ) :
			the_post();

			$title_html   = '';
			$rating_html  = '';
			$company_html = '';
			$rating_html  = '';

			$company = get_field( 'testimonials_company_name' );
			$rating  = get_field( 'testimonials_rating' );

			if ( $company ) {
				$company_html = ' (' . $company . ')';
			}
			if ( get_the_title() || $company ) {
				$title_html = sprintf(
					'<h3 class="text-2xl font-bold">%s%s</h3>',
					get_the_title(),
					$company_html
				);
			}
			if ( $rating ) {
				$rating_html  = '<div class="stars flex space-x-2 text-theme-color text-xl">';
				$rating_html .= 1 <= $rating ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
				$rating_html .= 2 <= $rating ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
				$rating_html .= 3 <= $rating ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
				$rating_html .= 4 <= $rating ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
				$rating_html .= 5 == $rating ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>'; // phpcs:ignore
				$rating_html .= '</div>';
			}

			printf(
				'<div class="grid gap-4 border-b-2 border-theme-color pb-4">
					<div class="title flex items-center space-x-2">
						%s
						%s
					</div>
					%s
				</div>',
				wp_kses_post( $title_html ),
				wp_kses_post( $rating_html ),
				wp_kses_post( wp_trim_words( get_the_excerpt(), 50 ) )
			);

		endwhile;

		wp_reset_postdata();

		echo '</div>';

		?>

	</div>
</section>

<?php bootstrap_pagination(); ?>
