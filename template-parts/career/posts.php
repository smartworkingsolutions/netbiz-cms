<?php
/**
 * The ACF template part for displaying Career Posts.
 *
 * @package Netbiz
 */

?>

<section class="join-team my-16">
	<div class="container">

		<?php
		echo '<div class="grid grid-cols-1 lg:grid-cols-2 gap-x-10 gap-y-16">';

		if ( ! have_posts() ) {
			echo '<p>No posts found.</p>';
		}

		while ( have_posts() ) :
			the_post();

			$title_html = '';
			$btn_html   = '';
			$meta_html  = '';
			$content    = '';

			$contract = get_field( 'cmi_contract' );
			$location = get_field( 'cmi_location' );

			if ( $contract || $location ) {
				$meta_html = sprintf(
					'<div class="meta-info flex justify-center mt-6 leading-none">
						<div class="pr-2 mr-2 mb-2 border-r-2 border-dark-section-text">%s</div>
						<div>%s</div>
					</div>',
					$contract,
					$location
				);
			}
			if ( get_the_title() ) {
				$title_html = sprintf(
					'<h3 class="text-2xl font-bold">
                        %1$s <a href="%2$s">%3$s</a>
					</h3>',
					__( 'Job Profile :', 'netbiz' ),
					get_permalink(),
					get_the_title()
				);
			}
			if ( get_the_content() ) {
				$content = sprintf(
					'<p><span class="mr-2">%s</span>%s</p>',
					__( 'Job Description :', 'netbiz' ),
					get_the_content()
				);
			}
			$btn_html = sprintf(
				'<div>
					<a class="button button-white mt-4" href="%s">%s</a>
				</div>',
				get_permalink(),
				__( 'Apply Now', 'netbiz' )
			);

			printf(
				'<div class="single-item flex flex-col bg-theme-color text-dark-section-text px-8 py-10 text-center justify-center">
                    %s
                    %s
                    %s
                    %s
                </div>',
				wp_kses_post( $title_html ),
				wp_kses_post( $meta_html ),
				wp_kses_post( $content ),
				wp_kses_post( $btn_html )
			);

		endwhile;

		wp_reset_postdata();

		echo '</div>';
		?>

	</div>
</section>

<?php bootstrap_pagination(); ?>
