<?php
/**
 * The ACF template part for displaying Join our team.
 *
 * @package Netbiz
 */

$heading  = get_sub_field( 'our_team_heading' );
$grid_btn = get_sub_field( 'our_team_grid_button' );
$count    = 1;
?>

<section class="join-our-team bg-theme-color mt-16 py-14">
	<div class="container">

		<?php

		// Heading.
		if ( $heading ) {
			echo '<h2 class="text-4.5xl font-black text-dark-section-text text-center mb-10 leading-none sm:leading-normal">' . wp_kses_post( $heading ) . '</h2>';
		}

		// Check lists exists.
		if ( have_rows( 'our_team_lists' ) ) :

			echo '<div class="item-wrap grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-4 gap-10">';

			// Loop through rows.
			while ( have_rows( 'our_team_lists' ) ) :
				the_row();

				// Load sub field value.
				$job_title = get_sub_field( 'our_team_title' );
				$meta1     = get_sub_field( 'our_team_meta_1' );
				$meta2     = get_sub_field( 'our_team_meta_2' );
				$content   = get_sub_field( 'our_team_content' );
				$btn       = get_sub_field( 'our_team_button' );

				$meta_html = '';
				$text_html = '';
				$btn_html  = '';

				if ( $meta1 || $meta2 ) {
					$meta_html = sprintf(
						'<div class="meta-info flex justify-center mt-8 leading-none">
							<div class="pr-3 mr-3 mb-2 border-r border-dark-color">%s</div>
							<div>%s</div>
						</div>',
						$meta1,
						$meta2
					);
				}

				if ( $content ) {
					$text_html = sprintf(
						'<p><span class="mr-2">%s :</span>%s</p>',
						esc_html__( 'Job Description', 'netbiz' ),
						$content
					);
				}

				if ( $btn ) {
					$btn_html = sprintf(
						'<a class="button mt-8" href="%s" target="%s">%s</a>',
						$btn['url'],
						$btn['target'],
						$btn['title']
					);
				}

				printf(
					'<div class="single-item flex flex-col bg-white p-8 text-center justify-center">
                        <h3 class="text-xl 3xl:text-2xl font-bold">%s</h3>
                        %s
                        %s
                        %s
                    </div>',
					esc_html( $job_title ),
					wp_kses_post( $meta_html ),
					wp_kses_post( $text_html ),
					wp_kses_post( $btn_html )
				);

				++$count;

			endwhile;

			if ( $grid_btn ) {
				printf(
					'<a href="%s" target="%s" class="grid place-content-center bg-white text-2xl font-bold text-center hover:bg-dark-color hover:text-white"><span class="w-full lg:w-4/5 mx-auto py-4">%s</span></a>',
					esc_url( $grid_btn['url'] ),
					esc_html( $grid_btn['target'] ),
					wp_kses_post( $grid_btn['title'] )
				);
			}

			echo '</div>';

		endif;

		?>

	</div>
</section>
