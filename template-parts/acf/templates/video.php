<?php
/**
 * The ACF template part for displaying Testimonials.
 *
 * @package Netbiz
 */

$video = get_sub_field( 'video_id' );
if ( ! $video ) {
	return;
}
?>

<section class="video mt-14">
	<div class="container">
		<iframe class="w-full aspect-video" src="https://www.youtube.com/embed/<?php echo esc_html( $video ); ?>"></iframe>
	</div>
</section>
