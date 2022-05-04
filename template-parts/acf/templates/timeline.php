<?php
/**
 * The ACF template part for displaying timeline.
 *
 * @package Netbiz
 */

$heading = get_sub_field( 'timeline_heading' );
?>

<section class="timeline mt-14">

	<?php
	if ( $heading ) {
		echo '<div class="container">';
		echo '<h2 class="text-4.5xl font-black text-center mb-10 leading-none sm:leading-normal">' . esc_html( $heading ) . '</h2>';
		echo '</div>';
	}

	// Check lists exists.
	if ( have_rows( 'timeline_grid_lists' ) ) :

		echo '<div class="xl:border-b-2 xl:border-dark-color">';
		echo '<div class="container">';
		echo '<div class="item-wrap grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-10">';

		// Loop through rows.
		while ( have_rows( 'timeline_grid_lists' ) ) :
			the_row();

			// Load sub field value.
			$image = '';
			if ( get_sub_field( 'timeline_image' ) ) {
				$image = df_resize( get_sub_field( 'timeline_image' ), '', 425, 320, true, true );
			}
			$post_title = get_sub_field( 'timeline_title' );
			$text       = get_sub_field( 'timeline_text' );
			$img_html   = '';

			if ( get_sub_field( 'timeline_image' ) ) {
				$img_html = sprintf(
					'<img class="w-full" src="%s" alt="%s">',
					$image['url'],
					$post_title
				);
			}

			printf(
				'<div class="single-item flex flex-col text-center space-y-8">
					%s
					<h3 class="text-2xl font-semibold"><a class="animate-line" href="#">%s</a></h3>
					<p>%s</p>
					<div class="hidden xl:block w-7 h-7 rounded-full bg-theme-color mx-auto translate-y-[14px]"></div>
				</div>',
				wp_kses_post( $img_html ),
				wp_kses_post( $post_title ),
				wp_kses_post( $text )
			);

		endwhile;

		echo '</div>';
		echo '</div>';
		echo '</div>';

	endif;
	?>

	</div>

</section>
