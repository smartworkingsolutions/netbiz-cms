<?php
/**
 * The template part for displaying Widget 1 in footer.
 *
 * @package Netbiz
 */

$heading = get_field( 'fw1_heading', 'option' );

if ( ! $heading && ! have_rows( 'fw1_links', 'option' ) ) {
	return;
}
?>
<div class="f-widget">
	<?php

	if ( $heading ) {
		echo '<h3 class="widget-title text-xl text-theme-color mb-6">' . esc_html( $heading ) . '</h3>';
	}

	if ( have_rows( 'fw1_links', 'option' ) ) :

		echo '<div class="links"><ul class="space-y-4">';

		while ( have_rows( 'fw1_links', 'option' ) ) :
			the_row();

			$links = get_sub_field( 'fw1_link' );

			if ( $links ) {
				printf(
					'<li>
						<a class="hover:text-theme-color" href="%s" target="%s">%s</a>
					</li>',
					esc_url( $links['url'] ),
					esc_html( $links['target'] ),
					esc_html( $links['title'] )
				);
			}


		endwhile;

		echo '</ul></div>';

	endif;
	?>
</div>
