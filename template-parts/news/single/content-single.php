<?php
/**
 * The template part for displaying single content.
 *
 * @package Netbiz
 */

?>

<section class="image-content-wrapper my-16">
	<div class="container">

		<article class="grid grid-cols-1 gap-10 lg:flex lg:space-x-10 lg:gap-0">

			<?php
			while ( have_posts() ) :
				the_post();

				$thumbnail    = '';
				$thumbnail_id = '';
				$date         = get_the_date();

				echo '<div class="image shrink-0 space-y-10">';
				if ( has_post_thumbnail() ) {
					$thumbnail_id = get_post_thumbnail_id( get_the_id() );
					$image        = df_resize( $thumbnail_id, '', 735, 420, true, true );

					printf(
						'<img class="w-full lg:w-[500px] 3xl:w-[735px] h-[420px] object-cover" src="%s" alt="%s">',
						esc_url( $image['url'] ),
						esc_html( get_the_title() )
					);
				}

				// ACF image loop start.
				while ( have_rows( 'add_more_images' ) ) :
					the_row();

					$image = '';
					if ( get_sub_field( 'news_more_image' ) ) {
						$image = df_resize( get_sub_field( 'news_more_image' ), '', 735, 420, true, true );
						printf(
							'<img class="w-full lg:w-[500px] 3xl:w-[735px] h-[420px] object-cover hidden lg:block" src="%s">',
							esc_url( $image['url'] )
						);
					}

				endwhile;
				// ACF image loop end.
				echo '</div>';
				?>

				<div class="content w-full">
					<div class="meta sm:flex justify-between mb-4 3xl:mb-5">
						<div>
							<?php
								esc_html_e( 'Posted on ', 'netbiz' );
								echo esc_html( $date );
							?>
						</div>
						<div class="flex space-x-6 mt-2 sm:mt-0">
							<span><?php esc_html_e( 'Share it:', 'netbiz' ); ?></span>
							<div class="flex space-x-6">
								<?php get_template_part( 'template-parts/case-study/single/social', 'share' ); ?>
							</div>
						</div>
					</div>

					<?php
					the_title( '<h2 class="text-2xl font-bold mb-6 3xl:mb-10">', '</h2>' );
					echo '<div class="wysiwyg-editor space-y-8">';
					the_content();
					echo '</div>';
					?>

				</div>

				<?php
				echo '<div class="image shrink-0 space-y-10 lg:hidden">';
				// ACF image loop start.
				while ( have_rows( 'add_more_images' ) ) :
					the_row();

					$image = '';
					if ( get_sub_field( 'news_more_image' ) ) {
						$image = df_resize( get_sub_field( 'news_more_image' ), '', 735, 420, true, true );
						printf(
							'<img class="w-full lg:w-[500px] 3xl:w-[735px] h-[420px] object-cover" src="%s">',
							esc_url( $image['url'] )
						);
					}

				endwhile;
				// ACF image loop end.
				echo '</div>';

			endwhile; // End of the loop.
			?>

		</article>

	</div>
</section>
