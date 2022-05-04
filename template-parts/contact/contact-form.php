<?php
/**
 * The template for displaying contact details in contact us page.
 *
 * @package Netbiz
 */

get_header();

$heading     = get_field( 'contact_form_heading' );
$description = get_field( 'contact_form_description' );
?>

<div class="contact-form">
	<?php
	if ( $heading || $description ) {
		echo '<h2 class="text-2xl font-bold mb-6">' . wp_kses_post( $heading ) . '</h2>';
		echo '<p>' . wp_kses_post( $description ) . '</p>';
	}
	?>

	<?php echo do_shortcode( '[contactforms form_name="enquiry_form"]' ); ?>
</div>
