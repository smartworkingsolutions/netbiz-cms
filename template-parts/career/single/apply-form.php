<?php
/**
 * The template part for displaying Apply form on career single content.
 *
 * @package Netbiz
 */

?>

<div class="form bg-theme-color text-dark-section-text px-12 py-14 mt-10 lg:mt-0 w-full lg:w-1/2 xl:w-2/5">
	<h3 class="text-2xl font-bold mb-2"><?php esc_html_e( 'Apply for this Job', 'netbiz' ); ?></h3>
	<p><?php esc_html_e( 'Fill out the application form below to apply for this job.', 'netbiz' ); ?></p>

	<?php echo do_shortcode( '[contactforms form_name="apply_form"]' ); ?>
</div>
