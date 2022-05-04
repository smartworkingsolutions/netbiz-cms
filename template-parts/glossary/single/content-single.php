<?php
/**
 * The template part for displaying Glossary single content.
 *
 * @package Netbiz
 */

?>

<section class="my-16">
	<div class="container">

	<?php
	while ( have_posts() ) :
		the_post();

		the_title( '<h2 class="text-4.5xl font-bold mb-8">', '<h2>' );

		echo '<div class="wysiwyg-editor space-y-7">';
		the_content();
		echo '</div>';

	endwhile; // End of the loop.
	?>

	</div>
</section>
