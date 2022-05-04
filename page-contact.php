<?php
/**
 * Template Name: Contact Us Page
 * The template for displaying contact us info and contact form.
 *
 * @package Netbiz
 */

get_header();
?>

<section class="image-content-wrapper my-16">
	<div class="container">

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

			<?php get_template_part( 'template-parts/contact/contact', 'details' ); ?>

			<?php get_template_part( 'template-parts/contact/contact', 'form' ); ?>

		</div>

	</div>
</section>

<?php
get_footer();
