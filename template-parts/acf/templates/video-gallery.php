<?php
/**
 * The ACF template part for displaying Video Gallery.
 *
 * @package Netbiz
 */

$count = 1;
?>

<section class="video-gallery my-16">
	<div class="container">

		<?php

		// Check lists exists.
		if ( have_rows( 'video_gallery_lists' ) ) :

			echo '<div class="grid grid-cols-1 lg:grid-cols-2 gap-x-10 gap-y-16">';

			// Loop through rows.
			while ( have_rows( 'video_gallery_lists' ) ) :
				the_row();

				// Load sub field value.
				$image = '';
				if ( get_sub_field( 'video_image' ) ) {
					$image = df_resize( get_sub_field( 'video_image' ), '', 890, 395, true, true );
				}
				$embed   = get_sub_field( 'youtube_video_embed' );
				$heading = get_sub_field( 'video_gallery_title' );
				$content = get_sub_field( 'video_gallery_content' );

				printf(
					'<div class="single-item text-center">
						<a class="open-modal modal-%1$s grid relative" href="#" data-modal="%1$s">
							<div class="text-white text-4xl border-2 border-white w-32 h-32 rounded-full grid place-content-center absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2"><i class="fas fa-play"></i></div>
							<img class="w-full aspect-video" src="%2$s">
						</a>
						<h3 class="text-2xl font-bold mt-8">%3$s</h3>
						<p class="mt-6">%4$s</p>
					</div>
					<div class="video-modal video-modal-%1$s bg-white shadow-md w-11/12 fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-[9999px] z-30 transition-all">
						<div class="grid grid-cols-1 lg:grid-cols-5 items-center">
							<iframe class="w-full aspect-video lg:col-span-3" src="https://www.youtube.com/embed/%6$s"></iframe>
							<div class="lg:px-8 lg:py-10 lg:col-span-2">
								<button class="close w-7 h-7 text-2xl font-bold rounded-full bg-white grid place-content-center absolute top-4 right-4">X</button>
								<h3 class="text-2xl font-bold hidden lg:block">%3$s</h3>
								<p class="mt-6 hidden lg:block">%5$s</p>
							</div>
						</div>
					</div>',
					esc_html( $count ),
					esc_url( $image['url'] ),
					esc_html( $heading ),
					wp_kses_post( wp_trim_words( $content, 30, '' ) ),
					wp_kses_post( $content ),
					wp_kses_post( $embed ),
				);

				++$count;

			endwhile;

			echo '</div>';

		endif;

		?>

<div class="video-modal-overlay w-full h-full fixed inset-0 z-20 bg-black/30 hidden"></div>
	</div>
</section>
