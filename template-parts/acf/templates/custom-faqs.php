<?php
/**
 * The ACF template part for displaying Custom FAQs.
 *
 * @package Netbiz
 */

$heading  = get_sub_field( 'custom_faqs_heading' );
$post_num = get_sub_field( 'number_of_faqs' ) ? get_sub_field( 'number_of_faqs' ) : '3';
$count    = 1;
?>

<section class="faqs mt-14">
	<div class="container">

		<?php

		// Heading.
		if ( $heading ) {
			echo '<h2 class="text-4.5xl font-black text-center mb-10 leading-none sm:leading-normal">' . wp_kses_post( $heading ) . '</h2>';
		}

		// Check lists exists.
		if ( have_rows( 'faqs_lists' ) ) :

			echo '<div class="accordion flex flex-col space-y-10">';

			// Loop through rows.
			while ( have_rows( 'faqs_lists' ) ) :
				the_row();

				// Load sub field value.
				$ques    = get_sub_field( 'custom_faqs_question' );
				$ans     = get_sub_field( 'custom_faqs_answer' );
				$checked = 1 === $count ? ' checked' : '';

				printf(
					'<div class="w-full">
						<input type="checkbox" name="panel" id="panel-%1$s" class="hidden"%2$s>
						<label for="panel-%1$s" class="relative block bg-theme-color text-dark-section-text text-xl md:text-2xl font-bold pl-11 pr-20 py-7 cursor-pointer"><span class="mr-2 xl:mr-8">%1$s.</span>%3$s</label>
						<div class="accordion__content bg-theme-color text-dark-section-text px-11 xl:px-24 overflow-hidden">
							<p id="panel%1$s">%4$s</p>
						</div>
					</div>',
					esc_html( $count ),
					esc_html( $checked ),
					esc_html( $ques ),
					wp_kses_post( $ans )
				);

				++$count;

			endwhile;

			echo '</div>';

		endif;

		?>

	</div>
</section>
