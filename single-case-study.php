<?php
/**
 * The template for displaying all single case study page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Netbiz
 */

get_header();

	get_template_part( 'template-parts/case-study/single/content', 'single' );

	/**
	 * Loop Templates
	 */
	$acfp = new acf_flexible_content_to_partials( get_the_ID(), 'templates' );
	$acfp->render();

get_footer();
