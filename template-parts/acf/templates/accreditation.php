<?php
/**
 * The ACF template part for displaying Accreditation.
 *
 * @package Netbiz
 */

$heading = get_sub_field( 'accreditation_heading' );
?>

<section class="accreditation my-14">
	<div class="container">

		<?php

		// Heading.
		if ( $heading ) {
			echo '<h2 class="text-4.5xl font-black text-center mb-8 leading-none sm:leading-normal">' . wp_kses_post( $heading ) . '</h2>';
		}

		// Check lists exists.
		if ( have_rows( 'accreditation_logos' ) ) :

			echo '<div class="item-wrap grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-10">';

			// Loop through rows.
			while ( have_rows( 'accreditation_logos' ) ) :
				the_row();

				// Load sub field value.
				$image = '';
				if ( get_sub_field( 'accreditation_image' ) ) {
					$image = df_resize( get_sub_field( 'accreditation_image' ), '', 275, false, true, true );
				}
				$url = get_sub_field( 'accreditation_link' );

				if ( $url && $image['url'] ) {
					printf(
						'<a href="%s"><img class="mx-auto" src="%s"></a>',
						esc_url( $url ),
						esc_url( $image['url'] )
					);
				}
				if ( ! $url && $image['url'] ) {
					printf(
						'<img class="mx-auto" src="%s">',
						esc_url( $image['url'] )
					);
				}

			endwhile;

			echo '</div>';

		endif;

		?>

	</div>
</section>
