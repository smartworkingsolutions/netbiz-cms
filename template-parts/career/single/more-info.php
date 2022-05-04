<?php
/**
 * The template part for displaying More info in career single content.
 *
 * @package Netbiz
 */

// Check lists exists.
if ( have_rows( 'career_more_info' ) ) :

	echo '<div class="content w-full lg:w-1/2 xl:w-3/5 space-y-14">';

	// Loop through rows.
	while ( have_rows( 'career_more_info' ) ) :
		the_row();

		// Load sub field value.
		$heading = get_sub_field( 'c_more_info_heading' );
		$content = get_sub_field( 'c_more_info_content' );

		printf(
			'<div class="flex flex-col">
				<h3 class="text-2xl font-bold mb-6">%s</h3>
				<p>%s</p>
			</div>',
			wp_kses_post( $heading ),
			wp_kses_post( $content )
		);

	endwhile;

	echo '</div>';

endif;
