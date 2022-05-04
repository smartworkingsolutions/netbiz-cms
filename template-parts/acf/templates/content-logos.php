<?php
/**
 * The ACF template part for displaying Content Logos.
 *
 * @package Netbiz
 */

$heading = get_sub_field( 'content_logos_heading' );
$content = get_sub_field( 'content_logos_content' );

if ( ! $heading && ! $content && ! have_rows( 'content_logos_logos' ) ) {
	return;
}
?>

<section class="content-logos py-12">
	<div class="container">

		<div class="grid grid-cols-1 xl:flex gap-10 xl:gap-20">

			<div class="content w-full">
				<?php
				// Heading and content.
				if ( $heading ) {
					echo '<h2 class="text-4.5xl font-bold mb-8 leading-none">' . wp_kses_post( $heading ) . '</h2>';
				}
				if ( $content ) {
					echo '<p>' . wp_kses_post( $content ) . '</p>';
				}
				?>
			</div>

			<?php
			// Check lists exists.
			if ( have_rows( 'content_logos_logos' ) ) :

				echo '<div class="logos flex space-x-4 shrink-0">';

				// Loop through rows.
				while ( have_rows( 'content_logos_logos' ) ) :
					the_row();

					// Load sub field value.
					$image = get_sub_field( 'content_logos_logo' );

					if ( $image ) {
						printf(
							'<img class="w-full h-[226px] object-scale-down" src="%s">',
							esc_url( $image )
						);
					}

				endwhile;

				echo '</div>';

			endif;
			?>

		</div>

	</div>
</section>
