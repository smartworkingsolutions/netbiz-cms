<?php
/**
 * The template for displaying Testimonials CPT.
 *
 * @package Netbiz
 */

acf_form_head();

get_header();

	get_template_part( 'template-parts/testimonials/review', 'form' );
	get_template_part( 'template-parts/testimonials/posts' );

get_footer();
