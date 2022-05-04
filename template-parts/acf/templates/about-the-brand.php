<?php
/**
 * The ACF template part for displaying About the brand.
 *
 * @package Netbiz
 */

$heading = get_sub_field( 'about_the_brand_heading' );
?>

<section class="about-the-brand mt-14">
	<div class="container">

		<?php

		// Heading.
		if ( $heading ) {
			echo '<h2 class="text-4.5xl font-black text-center mb-8 leading-none sm:leading-normal">' . wp_kses_post( $heading ) . '</h2>';
		}

		// Check lists exists.
		if ( have_rows( 'about_the_brand_grid_lists' ) ) :

			echo '<div class="item-wrap grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-x-10 gap-y-10 xl:gap-y-16">';

			// Loop through rows.
			while ( have_rows( 'about_the_brand_grid_lists' ) ) :
				the_row();

				// Load sub field value.
				$image = '';
				if ( get_sub_field( 'about_grid_image' ) ) {
					$image = df_resize( get_sub_field( 'about_grid_image' ), '', 425, 476, true, true );
				}
				$about_title = get_sub_field( 'about_grid_heading' );
				$about_link  = get_sub_field( 'about_grid_link' );

				$image_html = '';
				$title_html = '';
				$link_html  = '';

				if ( $image && ! $about_link ) {
					$image_html = sprintf(
						'<div class="w-full relative">
							<img class="w-full h-auto 3xl:h-[476px] object-cover object-left" src="%s" alt="%s">
						</div>',
						$image['url'],
						$about_title
					);
				}
				if ( $image && $about_link ) {
					$image_html = sprintf(
						'<a href="%s" class="w-full block relative">
							<img class="w-full h-auto 3xl:h-[476px] object-cover object-left" src="%s" alt="%s">
						</a>',
						$about_link['url'],
						$image['url'],
						$about_title
					);
				}
				if ( $about_title && $about_link ) {
					$title_html = sprintf(
						'<h3 class="text-2xl font-bold"><a href="%s" target="%s">%s</a></h3>',
						$about_link['url'],
						$about_link['target'],
						$about_title
					);
				}
				if ( $about_title && ! $about_link ) {
					$title_html = sprintf(
						'<h3 class="text-2xl font-bold">%s</h3>',
						$about_title
					);
				}
				if ( $about_link ) {
					$link_html = sprintf(
						'<a class="group" href="%s" target="%s">%s <i class="far fa-long-arrow-alt-right transition ease-in-out group-hover:translate-x-2"></i></a>',
						$about_link['url'],
						$about_link['target'],
						$about_link['title']
					);
				}

				printf(
					'<div class="single-item transition ease-in-out hover:-translate-y-1 hover:scale-105 duration-300 relative">
						%s
						<div class="flex flex-col bg-black/30 px-10 py-11 space-y-4 text-white absolute left-0 bottom-0 right-0 z-10">
							%s
							%s
						</div>
					</div>',
					wp_kses_post( $image_html ),
					wp_kses_post( $title_html ),
					wp_kses_post( $link_html )
				);

			endwhile;

			echo '</div>';

		endif;

		?>

	</div>
</section>
