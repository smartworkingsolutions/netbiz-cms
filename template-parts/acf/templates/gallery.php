<?php
/**
 * The ACF template part for displaying Gallery.
 *
 * @package Netbiz
 */

?>

<section class="gallery bg-theme-color py-14 xl:py-20 mt-12">
	<div class="container">

		<?php

		// Check lists exists.
		if ( have_rows( 'gallery_lists' ) ) :

			echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-11">';

			// Loop through rows.
			while ( have_rows( 'gallery_lists' ) ) :
				the_row();

				// Load sub field value.
				$image = '';
				if ( get_sub_field( 'gallery_image' ) ) {
					$image = df_resize( get_sub_field( 'gallery_image' ), '', 424, 475, true, true );
				}
				$caption = get_sub_field( 'gallery_caption_text' );

				if ( $image['url'] ) {
					printf(
						'<a class="image-popup" href="%1$s" title="%2$s">
                            <img class="w-full" src="%1$s" alt="%2$s">
                        </a>',
						esc_url( $image['url'] ),
						esc_html( $caption )
					);
				}

			endwhile;

			echo '</div>';

		endif;

		?>

	</div>
</section>
