<?php
/**
 * The template part for displaying Widget 2 in footer.
 *
 * @package Netbiz
 */

$social_links = get_social_links();
$heading      = get_field( 'fw2_heading', 'option' );
$hours        = get_field( 'fw2_opening_time', 'option' );
$contact      = get_field( 'fw2_contact', 'option' );
$address      = get_field( 'fw2_address', 'option' );
$btn          = get_field( 'fw2_button', 'option' );

$social_icons = get_field( 'fw2_social_icons', 'options' );

if ( ! $heading && ! $hours && ! $contact && ! $address && ! $btn && ! is_array( $social_links ) ) {
	return;
}
?>

<div class="f-widget col-span-2">

	<?php

	if ( $heading ) {
		echo '<h3 class="widget-title text-xl text-theme-color mb-6">' . esc_html( $heading ) . '</h3>';
	}

	?>

	<ul class="list grid grid-cols-1 md:grid-cols-2 gap-x-10 2xl:gap-x-14 gap-y-8">

		<?php
		if ( $hours ) {
			echo '<li>' . $hours . '</li>'; //phpcs:ignore.
		}
		if ( $contact ) {
			echo '<li>' . $contact . '</li>'; //phpcs:ignore.
		}
		if ( $address ) {
			echo '<li>' . $address . '</li>'; //phpcs:ignore.
		}
		?>
		<li>
			<?php
			if ( $social_icons && $social_icons['fw2_social_heading'] ) {
				echo '<h4 class="font-bold">' . esc_html( $social_icons['fw2_social_heading'] ) . '</h4>';
			}
			?>
			<!-- <h4 class="font-bold">Social</h4> -->
			<ul class="flex space-x-6">
				<?php
				if ( $social_links['twitter'] && in_array( 'Twitter', $social_icons['fw2_social_icons'], true ) ) {
					echo '<li><a class="hover:text-theme-color" href="' . esc_url( $social_links['twitter'] ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>';
				}
				if ( $social_links['linkedin'] && in_array( 'LinkedIn', $social_icons['fw2_social_icons'], true ) ) {
					echo '<li><a class="hover:text-theme-color" href="' . esc_url( $social_links['linkedin'] ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
				}
				if ( $social_links['instagram'] && in_array( 'Instagram', $social_icons['fw2_social_icons'], true ) ) {
					echo '<li><a class="hover:text-theme-color" href="' . esc_url( $social_links['instagram'] ) . '" target="_blank"><i class="fa fa-instagram"></i></a></li>';
				}
				if ( $social_links['facebook'] && in_array( 'Facebook', $social_icons['fw2_social_icons'], true ) ) {
					echo '<li><a class="hover:text-theme-color" href="' . esc_url( $social_links['facebook'] ) . '" target="_blank"><i class="fab fa-facebook"></i></a></li>';
				}
				?>
			</ul>
		</li>
	</ul>
	<?php
	if ( $btn ) {
		printf(
			'<a href="%s" class="button button-border button-white w-full mt-12" target="%s">%s</a>',
			esc_url( $btn['url'] ),
			esc_html( $btn['target'] ),
			esc_html( $btn['title'] )
		);
	}
	?>
</div>
