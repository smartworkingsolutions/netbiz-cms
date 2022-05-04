<?php
/**
 * Template Name: Home Page
 * The template for displaying HomePage
 *
 * @package Netbiz
 */

get_header();

/**
 * Loop Templates
 */
$acfp = new acf_flexible_content_to_partials( get_the_ID(), 'templates' );
$acfp->render();

get_footer();
