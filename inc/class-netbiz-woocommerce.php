<?php
/**
 * Netbiz Woocommerce class for extra funtionality and overriding.
 *
 * @package Netbiz
 */

defined( 'WPINC' ) || exit;

/**
 * Main class for Netbiz Woocommerce
 */
class Netbiz_Woocommerce {

	/**
	 * The Construct
	 */
	public function __construct() {
		$this->hooks();
	}

	/**
	 * Hooks and Filters.
	 */
	public function hooks() {

		// wrapper.
		add_action( 'netbiz_after_header', [ $this, 'wp_add_wrapper_after_header' ], 20 );
		add_action( 'netbiz_before_footer', [ $this, 'wp_close_wrapper_before_footer' ] );

		// Add/Remove breadcrumb.
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

		// Remove shop title.
		add_filter( 'woocommerce_show_page_title', [ $this, 'hide_shop_page_title' ] );

		// Wrap results and filter dropdown into div.
		add_action( 'woocommerce_before_shop_loop', [ $this, 'wc_result_count_start' ], 15 );
		add_action( 'woocommerce_before_shop_loop', [ $this, 'wp_close_div' ], 35 );

		// Add custom icon into Add to cart button.
		// Move price and wrap into div with cart icon.
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		add_action( 'woocommerce_after_shop_loop_item', [ $this, 'wc_price_cart_start' ], 5 );
		add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 5 );
		add_filter( 'woocommerce_after_shop_loop_item', [ $this, 'wc_custom_add_to_cart_text' ], 10 );
		add_action( 'woocommerce_after_shop_loop_item', [ $this, 'wc_price_cart_end' ], 10 );

		// Add/Close div.
		add_action( 'woocommerce_checkout_after_customer_details', [ $this, 'wp_add_div' ] );
		add_action( 'woocommerce_review_order_after_payment', [ $this, 'wp_close_div' ] );

		// Remove order note from Checkout page.
		add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

		// Remove coupon form from Checkout page.
		remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

		// Add review stars into products.
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

		// WC sidebar.
		add_filter( 'is_active_sidebar', [ $this, 'wc_remove_sidebar' ], 10, 2 );

		// Update WC Pagination arrow text.
		add_filter( 'woocommerce_pagination_args', [ $this, 'wc_pagination_arrow' ] );

		// Update slider options.
		add_filter( 'woocommerce_single_product_carousel_options', [ $this, 'wc_flexslider_options' ] );

		// Add ACF fields into shop page.
		add_action( 'netbiz_before_footer', [ $this, 'shop_acf_fields' ] );

		// Move positions of price and meta in single product.
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );

	}

	/**
	 * Add wrapper after header.
	 */
	public function wp_add_wrapper_after_header() {
		if ( ! is_woocommerce() ) {
			return;
		}
		echo '<div class="wc-wrapper"><div class="container">';
	}

	/**
	 * Add wrapper before footer.
	 */
	public function wp_close_wrapper_before_footer() {
		if ( ! is_woocommerce() ) {
			return;
		}
		echo '</div></div>';
	}

	/**
	 * Remove shop title.
	 *
	 * @param string $title default title of shop page.
	 */
	public function hide_shop_page_title( $title ) {
		if ( is_shop() ) {
			$title = false;
		}
		return $title;
	}

	/**
	 * Add Custom icon in Add to cart button
	 */
	public function wc_custom_add_to_cart_text() {
		global $product;
		$link = $product->get_permalink();
		echo do_shortcode( '<a href="' . $link . '" class="button product_type_simple add_to_cart_button ajax_add_to_cart"><i class="far fa-shopping-cart"></i></a>' );
	}

	/**
	 * Add div.
	 */
	public function wp_add_div() {
		echo '<div>';
	}

	/**
	 * Close div.
	 */
	public function wp_close_div() {
		echo '</div>';
	}

	/**
	 * Wrap price and cart - start.
	 */
	public function wc_price_cart_start() {
		echo '<div class="flex justify-between bg-theme-color px-5 pb-5">';
	}
	/**
	 * Wrap price and cart - end.
	 */
	public function wc_price_cart_end() {
		echo '</div>';
	}

	/**
	 * Wrap result count - start.
	 */
	public function wc_result_count_start() {
		echo '<div class="flex justify-between items-center mb-6">';
	}

	/**
	 * Remove sidebar from selecting pages.
	 */
	public function wc_remove_sidebar() {
		if ( function_exists( 'is_woocommerce' ) ) {
			if ( is_product() || is_cart() || is_checkout() || is_account_page() ) {
				return false;
			}
		}
		return true;
	}

	/**
	 * Update WC Pagination arrow text.
	 *
	 * @param array $args default args.
	 */
	public function wc_pagination_arrow( $args ) {

		$args['prev_text'] = 'Prev';
		$args['next_text'] = 'Next';

		return $args;
	}

	/**
	 * Filer WooCommerce Flexslider options - Add Navigation Arrows.
	 *
	 * @param array $options default array.
	 */
	public function wc_flexslider_options( $options ) {

		$options['directionNav'] = true;
		$options['controlNav']   = false;

		return $options;
	}

	/**
	 * ACF fields for shop page.
	 */
	public function shop_acf_fields() {
		if ( function_exists( 'is_woocommerce' ) ) {
			if ( ! is_shop() ) {
				return;
			}
		}

		$shop_page_id = wc_get_page_id( 'shop' );

		$acfp = new acf_flexible_content_to_partials( $shop_page_id, 'templates' );
		$acfp->render();
	}

}

/**
 * Init
 */
new Netbiz_Woocommerce();
