<?php
/**
 * The template part for displaying single content.
 *
 * @package Netbiz
 */

?>

<section class="w-full hero-title">
	<div class="container">

		<div class="item-wrap grid grid-cols-1 lg:grid-cols-2 gap-10">

			<?php
			// Check lists exists.
			if ( have_rows( 'cs_slider' ) ) :

				echo '<div class="slider-container">';

				echo '<div class="slider-full mb-4">';

				// Loop through rows.
				while ( have_rows( 'cs_slider' ) ) :
					the_row();

					// Load sub field value.
					$image = '';
					if ( get_sub_field( 'cs_slide' ) ) {
						$image = df_resize( get_sub_field( 'cs_slide' ), '', 890, 500, true, true );
					}

					if ( $image['url'] ) {
						echo '<img class="w-full h-[500px] object-cover" src="' . esc_url( $image['url'] ) . '">';
					}

				endwhile;

				echo '</div>';

				echo '<div class="carousel">';

				// Loop through rows.
				while ( have_rows( 'cs_slider' ) ) :
					the_row();

					// Load sub field value.
					$image = '';
					if ( get_sub_field( 'cs_slide' ) ) {
						$image = df_resize( get_sub_field( 'cs_slide' ), '', 116, 118, true, true );
					}

					if ( $image['url'] ) {
						echo '<img src="' . esc_url( $image['url'] ) . '">';
					}

				endwhile;

				echo '</div>';

				echo '</div>';

			endif;
			?>

			<div class="text-container">
				<?php
				while ( have_posts() ) :
					the_post();

					echo '<div class="heading block xl:flex xl:justify-between xl:items-center">';

					the_title( '<h3 class="text-2xl font-bold">', '</h3>' );

					echo '<div class="share shrink-0 mt-4 xl:mt-0 space-x-2">';
					get_template_part( 'template-parts/case-study/single/social', 'share' );
					echo '</div>';

					echo '</div>';

					echo '<div class="meta text-sm mt-4 xl:mt-10">' . esc_html__( 'Posted On : ', 'netbiz' ) . get_the_date() . '</div>';
					echo '<div class="wysiwyg-editor space-y-7 mt-4 xl:mt-10">';
					the_content();
					echo '</div>';

				endwhile; // End of the loop.
				?>
			</div>


		</div>

	</div>
</section>
