<?php
/**
 * The ACF template part for displaying pdf download.
 *
 * @package Netbiz
 */

$heading = get_sub_field( 'pdf_downloads_heading' );
?>

<section class="download-wrapper my-16">
	<div class="container">

		<?php

		// Heading.
		if ( $heading ) {
			echo '<h2 class="text-4.5xl font-black text-center mb-10 leading-none sm:leading-normal">' . wp_kses_post( $heading ) . '</h2>';
		}

		// Check lists exists.
		if ( have_rows( 'pdf_downloads_grid_lists' ) ) :

			echo '<div class="item-wrap grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-4 gap-10 xl:gap-y-16">';

			// Loop through rows.
			while ( have_rows( 'pdf_downloads_grid_lists' ) ) :
				the_row();

				// Load sub field value.
				$content = get_sub_field( 'pdf_downloads_content' );

				$title_html = '';
				$file_html  = '';

				if ( get_sub_field( 'pdf_downloads_title' ) ) {
					$title_html = '<h3 class="text-xl 2xl:text-2xl font-bold">' . get_sub_field( 'pdf_downloads_title' ) . '</h3>';
				}
				if ( get_sub_field( 'pdf_downloads_pdf' ) ) {
					$file_html = '<a href="' . get_sub_field( 'pdf_downloads_pdf' ) . '" class="text-3xl" target="_blank"><i class="fal fa-download"></i></a>';
				}

				printf(
					'<div class="single-item flex flex-col border-t-[16px] border-theme-color pt-8 space-y-4">
						<div class="flex justify-between space-x-2">
							%s
							%s
						</div>
						<p>%s</p>
					</div>',
					wp_kses_post( $title_html ),
					wp_kses_post( $file_html ),
					wp_kses_post( $content )
				);

			endwhile;

			echo '</div>';

		endif;

		?>

	</div>
</section>
