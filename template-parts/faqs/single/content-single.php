<?php
/**
 * The template part for displaying FAQs single content.
 *
 * @package Netbiz
 */

?>

<section class="content mt-16">
	<div class="container">

	<?php
	while ( have_posts() ) :
		the_post();

		echo '<div class="wysiwyg-editor space-y-7">';
		the_content();
		echo '</div>';

	endwhile; // End of the loop.
	?>

	</div>
</section>

<?php
/**
 * Template loop
 */
$acfp = new acf_flexible_content_to_partials( get_the_ID(), 'templates' );
$acfp->render();
