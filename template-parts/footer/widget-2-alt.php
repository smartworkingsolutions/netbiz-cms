<?php
/**
 * The template part for displaying Widget 2 in footer layout 2.
 *
 * @package Netbiz
 */

$heading = get_field( 'fw2_heading', 'option' );

if ( ! $heading && ! have_rows( 'fw2_links', 'option' ) ) {
	return;
}
?>
<div class="f-widget">
	<?php

	if ( $heading ) {
		echo '<h3 class="widget-title text-xl text-theme-color mb-6">' . esc_html( $heading ) . '</h3>';
	}

	if ( have_rows( 'fw2_links', 'option' ) ) :

		echo '<div class="links"><ul class="space-y-4">';

		while ( have_rows( 'fw2_links', 'option' ) ) :
			the_row();

			$links = get_sub_field( 'fw2_link' );

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
