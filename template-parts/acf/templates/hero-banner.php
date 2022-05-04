<?php
/**
 * The ACF template part for displaying Hero Banner.
 *
 * @package Netbiz
 */

if ( ! have_rows( 'hero_add_slide' ) ) {
	return;
}
?>

<section class="w-full hero-banner relative">

	<?php
	// Check lists exists.
	if ( have_rows( 'hero_add_slide' ) ) :

		echo '<div class="hero-slider w-full">';

		// Loop through rows.
		while ( have_rows( 'hero_add_slide' ) ) :
			the_row();

			$image = '';
			if ( get_sub_field( 'hero_banner_background_image' ) ) {
				$image = df_resize( get_sub_field( 'hero_banner_background_image' ), '', 1920, 690, true, true );
			}
			$heading = get_sub_field( 'hero_banner_heading' );
			$content = get_sub_field( 'hero_banner_text' );
			$btn     = get_sub_field( 'hero_banner_button' );

			echo '<div class="item-wrap relative">';

			if ( $image || $heading ) {
				printf(
					'<div class="w-full">
						<img class="w-full h-[600px] xl:h-[690px] object-cover" src="%s" alt="%s">
					</div>',
					esc_url( $image['url'] ),
					esc_html( $heading )
				);
			}
			echo '<div class="bg-overlay-color absolute inset-0 lg:hidden"></div>';
			if ( $heading || $content || $btn ) {
				?>
				<div class="caption w-full lg:w-[70%] xl:w-[55%] px-6 lg:px-26 text-center lg:text-left text-dark-color absolute top-1/2 left-0 -translate-y-1/2">
					<div class="container">
						<?php
						if ( $heading ) {
							echo '<h1 class="text-5xl md:text-6xl font-bold leading-tight">' . wp_kses_post( $heading ) . '</h1>';
						}
						if ( $content ) {
							echo '<p class="mt-8">' . wp_kses_post( $content ) . '</p>';
						}
						if ( $btn ) {
							printf(
								'<a href="%s" class="button button-border mt-6" target="%s">%s</a>',
								esc_url( $btn['url'] ),
								esc_html( $btn['target'] ),
								esc_html( $btn['title'] )
							);
						}
						?>
					</div>
				</div>
				<?php
			}

			echo '</div>';

		endwhile;

		echo '</div>';

	endif;
	?>

</section>

