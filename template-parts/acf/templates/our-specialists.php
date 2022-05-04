<?php
/**
 * The ACF template part for displaying Our specialists.
 *
 * @package Netbiz
 */

$heading = get_sub_field( 'specialists_heading' );
?>

<section class="our-specialists mt-26 mb-16">
	<div class="container">

		<?php

		// Heading.
		if ( $heading ) {
			echo '<h2 class="text-4.5xl font-black text-center mb-10 leading-none sm:leading-normal">' . wp_kses_post( $heading ) . '</h2>';
		}

		// Check lists exists.
		if ( have_rows( 'specialists' ) ) :

			echo '<div class="item-wrap grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-10">';

			// Loop through rows.
			while ( have_rows( 'specialists' ) ) :
				the_row();

				// Load sub field value.
				$image = '';
				if ( get_sub_field( 'specialists_image' ) ) {
					$image = df_resize( get_sub_field( 'specialists_image' ), '', 425, 362, true, true );
				}
				$name  = get_sub_field( 'specialists_name' );
				$text  = get_sub_field( 'specialists_text' );
				$email = get_sub_field( 'specialists_email' );
				$phone = get_sub_field( 'specialists_phone_number' );
				$web   = get_sub_field( 'specialists_website' );

				$image_html = '';
				$content    = '';
				$footer     = '';

				if ( $image['url'] ) {
					$image_html = sprintf(
						'<img class="w-full" src="%s" alt="%s">',
						$image['url'],
						$name
					);
				}
				if ( $name || $text ) {
					$content = sprintf(
						'<div class="text flex flex-col text-center my-8">
							<h3 class="text-2xl font-bold mb-2">%s</h3>
							<p>%s</p>
						</div>',
						$name,
						$text
					);
				}
				if ( $email || $phone || $web ) {
					$footer = sprintf(
						'<footer class="flex justify-between bg-theme-color text-dark-section-text text-2xl px-10 py-3">
							<a href="mailto:%s"><i class="far fa-envelope"></i></a>
							<span>|</span>
							<a href="tel:%s"><i class="far fa-phone"></i></a>
							<span>|</span>
							<a href="%s"><i class="far fa-user"></i></a>
						</footer>',
						$email,
						$phone,
						$web
					);
				}

				printf(
					'<div class="single-item flex flex-col">
						%s
						%s
						%s
					</div>',
					wp_kses_post( $image_html ),
					wp_kses_post( $content ),
					wp_kses_post( $footer )
				);

			endwhile;

			echo '</div>';

		endif;

		?>

	</div>
</section>
