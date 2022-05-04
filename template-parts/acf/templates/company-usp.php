<?php
/**
 * The ACF template part for displaying company usp.
 *
 * @package Netbiz
 */

$heading = get_sub_field( 'company_usp_heading' );
?>

<section class="company-usp bg-theme-color mt-14 py-14 text-dark-section-text">
	<div class="container">

		<?php

		// Heading.
		if ( $heading ) {
			echo '<h2 class="text-4.5xl font-black text-center mb-10 leading-none sm:leading-normal">' . wp_kses_post( $heading ) . '</h2>';
		}

		// Check lists exists.
		if ( have_rows( 'company_usp_grid_lists' ) ) :

			echo '<div class="item-wrap grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-10">';

			// Loop through rows.
			while ( have_rows( 'company_usp_grid_lists' ) ) :
				the_row();

				// Load sub field value.
				$icon = get_sub_field( 'company_usp_icon' );
				$text = get_sub_field( 'company_usp_text' );

				$icon_html = '';

				if ( $icon ) {
					$icon_html = sprintf(
						'<img class="w-full h-24" src="%s">',
						$icon
					);
				}

				printf(
					'<div class="single-item flex flex-col space-y-6 text-center">
						%s
						<p>%s</p>
					</div>',
					wp_kses_post( $icon_html ),
					wp_kses_post( $text )
				);

			endwhile;

			echo '</div>';

		endif;

		?>

	</div>
</section>
