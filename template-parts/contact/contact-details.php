<?php
/**
 * The template for displaying contact details in contact us page.
 *
 * @package Netbiz
 */

get_header();

$heading     = get_field( 'contact_us_heading' );
$description = get_field( 'contact_us_description' );
?>

<div class="contact-details">

	<?php
	if ( $heading || $description ) {
		echo '<h2 class="text-2xl font-bold mb-6">' . wp_kses_post( $heading ) . '</h2>';
		echo '<p>' . wp_kses_post( $description ) . '</p>';
	}

	// Check lists exists.
	if ( have_rows( 'contact_us_contact_info' ) ) :

		echo '<ul class="list grid grid-cols-1 gap-y-10 mt-10">';

		// Loop through rows.
		while ( have_rows( 'contact_us_contact_info' ) ) :
			the_row();

			// Load sub field value.
			$details1 = get_sub_field( 'contact_us_details_1' );
			$details2 = get_sub_field( 'contact_us_details_2' );
			$details3 = get_sub_field( 'contact_us_details_3' );

			printf(
				'<li>%s</li>
				<li>%s</li>
				<li>%s</li>',
				wp_kses_post( $details1 ),
				wp_kses_post( $details2 ),
				wp_kses_post( $details3 )
			);

		endwhile;

		echo '</ul>';

	endif;
	?>

</div>
