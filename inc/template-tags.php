<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Netbiz
 */

/**
 * Prints HTML of logo.
 */
function theme_logo() {
	?>
	<div class="logo w-60">
	<?php
	if ( has_custom_logo() ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image          = wp_get_attachment_image_src( $custom_logo_id, 'full' );
		$image_url      = $image[0];

		printf(
			'<a href="%s" class="navbar-brand">
				<img src="%s">
			</a>',
			esc_url( get_home_url() ),
			esc_url( $image_url )
		);
	} else {
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand" rel="home"><?php bloginfo( 'name' ); ?></a>
		<?php
	}
	?>
	</div>
	<?php
}

if ( ! function_exists( 'netbiz_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function netbiz_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'netbiz' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'netbiz_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function netbiz_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'netbiz' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'netbiz_author_avatar' ) ) :
	/**
	 * Prints HTML with author image for the current author.
	 *
	 * @param string $size size of avatar image.
	 */
	function netbiz_author_avatar( $size = '100' ) {
		if ( function_exists( 'get_avatar' ) ) :
			echo get_avatar( get_the_author_meta( 'email' ), $size );
		endif;
	}
endif;

if ( ! function_exists( 'netbiz_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function netbiz_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'netbiz' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'netbiz' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'netbiz' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'netbiz' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'netbiz' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'netbiz' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'netbiz_post_title' ) ) {
	/**
	 * Displays an optional post title.
	 */
	function netbiz_post_title() {

		if ( is_singular() && ! is_front_page() ) :
			the_title( '<h1 class="page-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

	}
}

if ( ! function_exists( 'netbiz_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @param string $thumb cuustom thumb size.
	 */
	function netbiz_post_thumbnail( $thumb = 'post-thumbnail' ) {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						$thumb,
						[
							'alt' => the_title_attribute(
								[
									'echo' => false,
								]
							),
						]
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

/**
 * Prints HTML of header.
 */
function theme_header_html() {

	$is_search = get_field( 'enable_search', 'options' );

	// Mobile menu.
	get_template_part( 'template-parts/header/mobile', 'menu' );
	// Floating contact info.
	get_template_part( 'template-parts/header/floating', 'info' );
	?>

	<!-- Header start -->
	<header class="site-header w-full shadow-md relative z-[1]">
	<div class="container">

		<div class="header-wrap min-h-[108px] flex justify-between items-center space-x-2 bg-white text-dark-color py-5 relative z-10">

			<?php theme_logo(); ?>

			<!-- Nav bar start -->
			<div class="main-nav flex items-center">

				<?php get_template_part( 'template-parts/header/main', 'menu' ); ?>

				<?php get_template_part( 'template-parts/header/main', 'icons' ); ?>

			</div>
			<!-- Nav bar end -->

		</div>

	</div>
	<!-- Container end -->

	<?php
	if ( $is_search ) {
		?>
		<div class="search-box flex flex-col justify-center items-center transition">
			<div class="container flex justify-end items-center">
				<?php get_search_form(); ?>
				<div class="close text-2xl ml-4">
					<button><i class="fal fa-times"></i></button>
				</div>
			</div>
		</div>
		<?php
	}
	?>

	</header>
	<!-- Header end -->

	<?php

}

/**
 * Prints HTML of footer.
 */
function theme_footer_html() {

	$layout            = get_field( 'select_footer_layout', 'option' );
	$container_classes = 'grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-5 gap-12';

	if ( 'footer-2' === $layout ) {
		$container_classes = 'grid grid-cols-1 md:grid-cols-3 xl:grid-cols-5 gap-12';
	}
	?>

	<footer class="site-footer bg-footer-bg text-footer-text py-12">
		<div class="container">

			<div class="<?php echo esc_html( $container_classes ); ?>">
				<?php
				/**
				 * Widgets here
				 */

				if ( 'footer-1' === $layout ) {
					get_template_part( 'template-parts/footer/widget', '1' );
					get_template_part( 'template-parts/footer/widget', '2' );
					get_template_part( 'template-parts/footer/widget', '3' );
				}
				if ( 'footer-2' === $layout ) {
					get_template_part( 'template-parts/footer/widget', '1' );
					get_template_part( 'template-parts/footer/widget-2', 'alt' );
					get_template_part( 'template-parts/footer/widget-3', 'alt' );
				}
				?>

			</div>

		</div><!-- container end -->
	</footer>

	<!-- Copyrights -->
	<?php
	theme_copyrights_html();
}

/**
 * Prints HTML of Copyrights.
 */
function theme_copyrights_html() {

	$copyright_text = get_field( 'copyright_text', 'option' );

	if ( ! $copyright_text && ! have_rows( 'copyright_menu', 'option' ) ) {
		return;
	}
	?>

	<!-- Copyrights start -->
	<div class="copyrights bg-white text-dark-color text-sm py-3">
		<div class="container">

			<div class="copyrights-wrap grid justify-center text-center md:text-left md:flex md:justify-between md:items-center space-y-2 md:space-y-0">
				<div class="copyrights-text sm:flex">
					<?php
					if ( $copyright_text ) {
						echo wp_kses_post( $copyright_text );
					}

					// Check lists exists.
					if ( have_rows( 'copyright_menu', 'option' ) ) :

						echo '<ul class="links flex mt-2 sm:mt-0 space-x-4 sm:space-x-0">';

						// Loop through rows.
						while ( have_rows( 'copyright_menu', 'option' ) ) :
							the_row();

							$link = get_sub_field( 'copyright_menu_item' );

							if ( $link ) {
								printf(
									'<li class="slash-before"><a class="hover:text-theme-color" href="%s" target="%s">%s</a></li>',
									esc_url( $link['url'] ),
									esc_html( $link['target'] ),
									esc_html( $link['title'] )
								);
							}

						endwhile;

						echo '</ul>';

					endif;
					?>
				</div>
				<div class="develop-by">
					<a class="hover:text-theme-color" href="https://www.netbizgroup.co.uk/">Web Design Company</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Copyrights end -->

	<?php
}
