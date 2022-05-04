<?php
/**
 * The template part for displaying Social icons in sliding menu.
 *
 * @package Netbiz
 */

$social_links = get_social_links();

if ( ! $social_links && ! is_array( $social_links ) ) {
	return;
}
?>

<div class="social-icons text-3xl mt-auto mb-6">
	<ul class="flex justify-between">
		<?php
		if ( $social_links['twitter'] ) {
			echo '<li><a class="hover:opacity-70" href="' . esc_url( $social_links['twitter'] ) . '"><i class="fa fa-twitter"></i></a></li>';
		}
		if ( $social_links['linkedin'] ) {
			echo '<li><a class="hover:opacity-70" href="' . esc_url( $social_links['linkedin'] ) . '"><i class="fa fa-linkedin"></i></a></li>';
		}
		if ( $social_links['instagram'] ) {
			echo '<li><a class="hover:opacity-70" href="' . esc_url( $social_links['instagram'] ) . '"><i class="fa fa-instagram"></i></a></li>';
		}
		if ( $social_links['facebook'] ) {
			echo '<li><a class="hover:opacity-70" href="' . esc_url( $social_links['facebook'] ) . '"><i class="fa fa-facebook"></i></a></li>';
		}
		?>
	</ul>
</div>
