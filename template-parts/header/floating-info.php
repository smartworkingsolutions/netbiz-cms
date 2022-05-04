<?php
/**
 * The template part for displaying floating contact info in header.
 *
 * @package Netbiz
 */

$number       = get_field( 'global_phone_number', 'option' );
$number_link  = netbiz_clean( $number );
$email        = get_field( 'global_email', 'option' );
$social_links = get_social_links();

?>

<div class="floating-info fixed left-0 top-1/2 -translate-y-1/2 z-20 hidden sm:block text-dark-section-text">
	<ul class="w-12 grid bg-theme-color">
		<?php
		if ( $number ) {
			echo '<li class="w-12 h-12 grid justify-center items-center border-b border-dark-section-text"><a href="tel:' . esc_html( $number_link ) . '"><i class="fa fa-phone"></i></a></li>';
		}
		if ( $email ) {
			printf(
				'<li class="-rotate-90 whitespace-nowrap w-12 h-32 flex justify-center items-center"><a href="mailto:%s">%s</a></li>',
				esc_html( $email ),
				esc_html__( 'Contact Us', 'netbiz' )
			);
		}
		if ( $social_links['facebook'] ) {
			echo '<li class="w-12 h-12 grid justify-center items-center border-t border-b border-dark-section-text"><a href="' . esc_url( $social_links['facebook'] ) . '"><i class="fab fa-facebook"></i></a></li>';
		}
		if ( $social_links['twitter'] ) {
			echo '<li class="w-12 h-12 grid justify-center items-center border-b border-dark-section-text"><a href="' . esc_url( $social_links['twitter'] ) . '"><i class="fa fa-twitter"></i></a></li>';
		}
		if ( $social_links['instagram'] ) {
			echo '<li class="w-12 h-12 grid justify-center items-center"><a href="' . esc_url( $social_links['instagram'] ) . '"><i class="fa fa-instagram"></i></a></li>';
		}
		?>
	</ul>
</div>
