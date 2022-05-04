<?php
/**
 * The ACF template part for displaying Image-Content grid.
 *
 * @package Netbiz
 */

$image = '';
if ( get_sub_field( 'image_content_image' ) ) {
	$image = df_resize( get_sub_field( 'image_content_image' ), '', 890, 543, true, true );
}
$content       = get_sub_field( 'image_content_content' );
$heading       = $content['image_content_heading'];
$text          = $content['image_content_text'];
$layout        = get_sub_field( 'image_content_layout' );
$is_background = get_sub_field( 'image_content_background' );
$order_class   = '';
$classes       = 'image-content-wrapper mt-12';

if ( ! $image['url'] && ! $content ) {
	return;
}
if ( $is_background ) {
	$classes = 'image-content-wrapper bg-theme-color text-dark-section-text py-12 mt-12';
}
if ( 'content' === $layout ) {
	$order_class = ' lg:order-first';
}
?>

<section class="<?php echo esc_html( $classes ); ?>">
	<div class="container">

		<div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-10">
			<?php
			if ( $image['url'] ) {
				echo '<div class="image"><img class="w-full" src="' . esc_url( $image['url'] ) . '"></div>';
			}

			if ( $content ) {
				printf(
					'<div class="content%s">
						<h3 class="text-4xl font-black mb-8">%s</h3>
						<p>%s</p>
					</div>',
					esc_html( $order_class ),
					wp_kses_post( $heading ),
					wp_kses_post( $text )
				);
			}
			?>
		</div>

	</div>
</section>
