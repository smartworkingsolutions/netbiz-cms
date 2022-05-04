<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Netbiz
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function netbiz_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'netbiz_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function netbiz_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'netbiz_pingback_header' );


/**
 * Get svg file content.
 *
 * @param string $path path of the SVG file.
 * @param string $echo print|return.
 *
 * @return string
 */
function get_svg( $path, $echo = true ) {

	$file = get_template_directory() . '/images/' . $path . '.svg';

	if ( ! file_exists( $file ) ) {
		return;
	}

	$svg = file_get_contents( $file ); // phpcs:ignore

	if ( $echo ) {
		echo $svg; // phpcs:ignore
	} else {
		return $svg;
	}
}

/**
 * Get Social Icons links.
 */
function get_social_links() {

	$social_urls   = [];
	$facebook_url  = get_field( 'facebook_url', 'options' );
	$instagram_url = get_field( 'instagram_url', 'options' );
	$twitter_url   = get_field( 'twitter_url', 'options' );
	$linkedin_url  = get_field( 'linkedin_url', 'options' );

	$social_urls = [
		'facebook'  => $facebook_url ? $facebook_url : '',
		'instagram' => $instagram_url ? $instagram_url : '',
		'twitter'   => $twitter_url ? $twitter_url : '',
		'linkedin'  => $linkedin_url ? $linkedin_url : '',
	];

	return $social_urls;
}

/**
 * Strip spaces and special characters.
 *
 * @param string $string string needed for clean.
 */
function netbiz_clean( $string ) {
	$string = str_replace( ' ', '', $string ); // Replaces all spaces with hyphens.
	return preg_replace( '/[^A-Za-z0-9\-]/', '', $string ); // Removes special chars.
}

if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	/**
	 * Check if WooCommerce is activated
	 */
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Check if WooCommerce page
 *
 * @return boolean
 */
function is_woocommerce_page() {
	if ( function_exists( 'is_woocommerce' ) ) {
		if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
			return true;
		}
	}
	return false;
}

/**
 * Remove 'Category:', 'Tag:', 'Author:', 'Archives:' and Other 'taxonomy name:' in the archive title
 *
 * @param string $title default title.
 * @return $title       modified title.
 */
function archive_remove_title_prefix( $title ) {
	return preg_replace( '/^\w+: /', '', $title );
}
add_filter( 'get_the_archive_title', 'archive_remove_title_prefix' );

/**
 * Add starts with args into WP_query.
 *
 * @param string $where where.
 * @param string $query default query.
 */
function add_starts_with_into_query( $where, $query ) {
	global $wpdb;

	$starts_with = esc_sql( $query->get( 'starts_with' ) );

	if ( $starts_with ) {
		$where .= " AND $wpdb->posts.post_title LIKE '$starts_with%'";
	}

	return $where;
}
add_filter( 'posts_where', 'add_starts_with_into_query', 10, 2 );

/**
 * List posts alphabetically under first letter of title
 *
 * @param string $letter first letter.
 */
function get_post_by_letter( $letter ) {

	$args = [
		'post_type'   => 'glossary',
		'orderby'     => 'title',
		'order'       => 'ASC',
		'starts_with' => $letter,
	];

	$query = new WP_Query( $args );

	if ( ! $query->have_posts() ) {
		return;
	}

	$random_number = wp_rand( 10000, 10000000 );
	?>

	<div class="w-full basis-1/2 text-dark-section-text">
		<input type="checkbox" name="panel" id="right-panel-<?php echo esc_html( $random_number ); ?>" class="hidden">
		<label for="right-panel-<?php echo esc_html( $random_number ); ?>" class="relative block bg-theme-color text-2xl font-bold px-10 py-7 cursor-pointer"><span class="mr-8"><?php echo esc_html( $letter ); ?></label>
		<div class="accordion__content bg-theme-color px-10 overflow-hidden">
			<p id="right-panel<?php echo esc_html( $random_number ); ?>">

			<?php
			while ( $query->have_posts() ) :
				$query->the_post();

				printf(
					'<a class="block mb-3 leading-none group" href="%s">%s <i class="far fa-long-arrow-alt-right ml-2 transition ease-in-out group-hover:translate-x-2"></i></a>',
					esc_url( get_permalink() ),
					esc_html( get_the_title() )
				);

			endwhile;

			wp_reset_postdata();
			?>

			</p>
		</div>
	</div>

	<?php
}

