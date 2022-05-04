<?php
/**
 * The template part for displaying career single content.
 *
 * @package Netbiz
 */

?>

<section class="job-apply my-16">
	<div class="container">

		<?php
		while ( have_posts() ) :
			the_post();

			$ref_id   = '';
			$salary   = '';
			$contract = '';
			$location = '';

			if ( get_field( 'cmi_job_ref_number' ) ) {
				$ref_id = sprintf(
					'<li>
						<span class="font-bold">%s</span>
						<span>%s</span>
					</li>',
					__( 'Job Ref Number:', 'netbiz' ),
					get_field( 'cmi_job_ref_number' )
				);
			}
			if ( get_field( 'cmi_salary' ) ) {
				$salary = sprintf(
					'<li>
						<span class="font-bold">%s</span>
						<span>%s</span>
					</li>',
					__( 'Salary:', 'netbiz' ),
					get_field( 'cmi_salary' )
				);
			}
			if ( get_field( 'cmi_contract' ) ) {
				$contract = sprintf(
					'<li>
						<span class="font-bold">%s</span>
						<span>%s</span>
					</li>',
					__( 'Contract:', 'netbiz' ),
					get_field( 'cmi_contract' )
				);
			}
			if ( get_field( 'cmi_location' ) ) {
				$location = sprintf(
					'<li>
						<span class="font-bold">%s</span>
						<span>%s</span>
					</li>',
					__( 'Location:', 'netbiz' ),
					get_field( 'cmi_location' )
				);
			}

			the_title( '<h2 class="text-4.5xl font-black mb-10">', '</h3>' );

			printf(
				'<div class="meta">
					<ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
						%s
						%s
						%s
						%s
					</ul>
				</div>',
				wp_kses_post( $ref_id ),
				wp_kses_post( $salary ),
				wp_kses_post( $contract ),
				wp_kses_post( $location )
			);

			echo '<div class="wysiwyg-editor space-y-7 mt-14">';
			the_content();
			echo '</div>';
			?>

			<!-- Content and form start -->
			<div class="block lg:flex lg:items-start mt-14 lg:space-x-10">

				<?php get_template_part( 'template-parts/career/single/more', 'info' ); ?>
				<?php get_template_part( 'template-parts/career/single/apply', 'form' ); ?>

			</div>
			<!-- Content and form end -->

			<?php

		endwhile; // End of the loop.
		?>

	</div>
</section>
