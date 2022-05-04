<?php
/**
 * The ACF template part for displaying CTA.
 *
 * @package Netbiz
 */

$image = '';
if ( get_sub_field( 'home_cta_background_image' ) ) {
	$image = df_resize( get_sub_field( 'home_cta_background_image' ), '', 1924, 634, true, true );
}
$heading1 = get_sub_field( 'home_cta_heading_1' );
$heading2 = get_sub_field( 'home_cta_heading_2' );
$btn      = get_sub_field( 'home_cta_button' );

if ( ! get_sub_field( 'home_cta_background_image' ) && ! $heading1 && ! $heading2 && ! $btn ) {
	return;
}
?>

<section class="w-full h-[600px] xl:h-[634px] relative mt-16 bg-cover bg-no-repeat bg-fixed" style="background-image: url('<?php echo $image['url'] ? esc_url( $image['url'] ) : ''; ?>');">
	<div class="caption w-full px-6 sm:px-12 lg:px-26 text-center lg:text-left text-white absolute top-1/2 left-0 -translate-y-1/2">
		<div class="container">
			<?php
			if ( $heading1 ) {
				echo '<h2 class="font-bold md:text-6xl leading-snug hidden md:block">' . wp_kses_post( $heading1 ) . '</h2>';
			}
			if ( $heading2 ) {
				echo '<h2 class="font-bold md:text-6xl leading-snug mt-2 hidden md:block">' . wp_kses_post( $heading2 ) . '</h2>';
			}
			if ( $heading1 || $heading2 ) {
				echo '<h2 class="text-4xl font-bold leading-snug md:hidden">' . wp_kses_post( $heading1 ) . ' ' . wp_kses_post( $heading2 ) . '</h2>';
			}
			if ( $btn ) {
				printf(
					'<a href="%s" class="button button-border button-white mt-12" target="%s">%s</a>',
					esc_url( $btn['url'] ),
					esc_html( $btn['target'] ),
					esc_html( $btn['title'] )
				);
			}
			?>
		</div>
	</div>
</section>
