<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Netbiz
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function netbiz_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		[
			'thumbnail_image_width' => 424,
			'single_image_width'    => 890,
			'single_image_height'   => 498,
			'product_grid'          => [
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			],
		]
	);
	// add_theme_support( 'wc-product-gallery-zoom' );
	// add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'netbiz_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function netbiz_woocommerce_scripts() {
	wp_enqueue_style( 'netbiz-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', [], THEME_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'netbiz-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'netbiz_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function netbiz_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'netbiz_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function netbiz_woocommerce_related_products_args( $args ) {
	$defaults = [
		'posts_per_page' => 4,
		'columns'        => 4,
	];

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'netbiz_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'netbiz_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function netbiz_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main woocommerce-page">
				<div class="container">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'netbiz_woocommerce_wrapper_before' );

if ( ! function_exists( 'netbiz_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function netbiz_woocommerce_wrapper_after() {
		?>
				</div>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'netbiz_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'netbiz_woocommerce_header_cart' ) ) {
			netbiz_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'netbiz_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function netbiz_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		netbiz_woocommerce_cart_link();
		$fragments['.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'netbiz_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'netbiz_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function netbiz_woocommerce_cart_link() {
		$count = WC()->cart->get_cart_contents_count();
		?>
		<div class="cart-icon hover:text-dark-color">
			<a class="cart-contents relative" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'netbiz' ); ?>">
				<i class="fa fa-shopping-cart"></i>
				<?php
				if ( $count > 0 ) {
					?>
					<span class="w-4 h-4 grid place-content-center text-[10px] text-white bg-dark-color rounded-full absolute -top-1 -right-3"><?php echo $count; // phpcs:ignore ?></span>
					<?php
				}
				?>
			</a>
		</div>
		<?php
	}
}

if ( ! function_exists( 'netbiz_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function netbiz_woocommerce_header_cart() {
		$class = '';
		if ( is_cart() ) {
			$class = 'current-menu-item';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php netbiz_woocommerce_cart_link(); ?>
			</li>
			<li>
				<div class="widget widget_shopping_cart">
					<div class="widget_shopping_cart_content">
						<?php woocommerce_mini_cart(); ?>
					</div>
				</div>
			</li>
		</ul>
		<?php
	}
}
