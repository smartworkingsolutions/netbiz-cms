<?php
/**
 * Netbiz functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Netbiz
 */

if ( ! defined( 'THEME_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'THEME_VERSION', '1.0.0' );
}

if ( ! function_exists( 'netbiz_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function netbiz_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Netbiz, use a find and replace
		 * to change 'netbiz' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'netbiz', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			[
				'main-menu'  => esc_html__( 'Primary', 'netbiz' ),
				'slide-menu' => esc_html__( 'Sliding', 'netbiz' ),
			]
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			]
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'netbiz_custom_background_args',
				[
					'default-color' => 'ffffff',
					'default-image' => '',
				]
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			[
				'height'      => 50,
				'width'       => 138,
				'flex-width'  => true,
				'flex-height' => true,
			]
		);
	}
endif;
add_action( 'after_setup_theme', 'netbiz_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function netbiz_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'netbiz_content_width', 640 );
}
add_action( 'after_setup_theme', 'netbiz_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function netbiz_widgets_init() {
	register_sidebar(
		[
			'name'          => esc_html__( 'Sidebar', 'netbiz' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'netbiz' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		]
	);
}
add_action( 'widgets_init', 'netbiz_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function netbiz_scripts() {

	$version = CUSTOMCACHE_VERSION;
	$path    = get_template_directory_uri();

	/**
	 * Styles
	 */
	// Main style css.
	wp_enqueue_style( 'netbiz-style', get_stylesheet_uri(), [], $version );

	// Magnific popup css.
	wp_enqueue_style( 'netbiz-magnific-popup-css', $path . '/css/magnific-popup.css', [], $version );

	// Slick css.
	wp_enqueue_style( 'netbiz-slick-css', $path . '/css/slick.css', [], $version );

	// Custom css for override.
	wp_enqueue_style( 'custom-css', $path . '/css/custom.css', [], $version );

	/**
	 * Scripts
	 */

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Theme's scrips.
	wp_enqueue_script( 'netbiz-magnific-popup', $path . '/js/jquery.magnific-popup.min.js', [], $version, true );
	wp_enqueue_script( 'netbiz-slick', $path . '/js/slick.min.js', [], $version, true );
	wp_enqueue_script( 'netbiz-custom', $path . '/js/custom.js', [ 'jquery' ], $version, true );

	// Tabs.
	if ( is_page_template( 'page-donation.php' ) ) {
		wp_enqueue_script( 'netbiz-tabs', $path . '/js/tabs.js', [], $version, true );
	}

	// Fontawesome icons.
	wp_enqueue_script( 'fontawesome5', '//kit.fontawesome.com/a0eab14e0c.js', [], $version, false );

	// FB.
	wp_enqueue_script( 'fb-root', '//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v12.0', [], '', true ); //phpcs:ignore

}
add_action( 'wp_enqueue_scripts', 'netbiz_scripts' );

/**
 * Add extra attributes to enqueued scripts.
 *
 * @param string $tag default.
 * @param string $handle default.
 */
function add_extra_attributes( $tag, $handle ) {
	return false !== strpos( $handle, 'fontawesome5' )
		? str_replace( ' src', ' crossorigin="anonymous" src', $tag )
		: $tag;
}
add_filter( 'script_loader_tag', 'add_extra_attributes', 10, 2 );

/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function custom_admin_style() {
	wp_enqueue_style( 'custom-admin-css', get_template_directory_uri() . '/admin/css/acf.css', false, CUSTOMCACHE_VERSION );
}
add_action( 'admin_enqueue_scripts', 'custom_admin_style' );

/**
 * Update settings from options.
 */
function add_theme_options() {
	$theme_color       = get_field( 'theme_color', 'options' );
	$text_color        = get_field( 'text_color', 'options' );
	$dar_bg_text_color = get_field( 'dark_background_text_color', 'options' );
	$footer_bg_color   = get_field( 'footer_background_color', 'options' );
	$footer_text_color = get_field( 'footer_text_color', 'options' );
	$overlay_color     = get_field( 'overlay_color', 'options' );
	$font              = get_field( 'font_settings', 'option' );
	?>
	<style>
		:root {
			--color-primary: <?php echo esc_html( $theme_color ); ?>;
			--color-dark: <?php echo esc_html( $text_color ); ?>;
			--color-dark-section-text: <?php echo esc_html( $dar_bg_text_color ); ?>;
			--color-footer-bg: <?php echo esc_html( $footer_bg_color ); ?>;
			--color-footer-text: <?php echo esc_html( $footer_text_color ); ?>;
			--color-overlay: <?php echo esc_html( $overlay_color ); ?>;
		}
		body {
			font-family: '<?php echo $font ? esc_html( $font['font'] ) : 'Roboto'; ?>';
		}
	</style>
	<?php
}
add_filter( 'wp_head', 'add_theme_options', 10 );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * All classes here
 */
require get_template_directory() . '/inc/class-netbiz-menu-walker.php';
require get_template_directory() . '/inc/class-netbiz-actions.php';
require get_template_directory() . '/inc/class-netbiz-schema.php';
require get_template_directory() . '/inc/class-custom-post-types.php';
require get_template_directory() . '/inc/class-netbiz-forms.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'wooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';

	// Load WooCommerce extra funtionality.
	require get_template_directory() . '/inc/class-netbiz-woocommerce.php';
}

/**
 * Load ACF Options panel.
 */
require get_template_directory() . '/inc/class-acf-options-panel.php';

/**
 * ACF content filter preview path.
 */
function get_acf_preview_path() {
	$path = 'template-parts/acf/images';
	if ( is_child_theme() ) {
		$path = '../netbiz-cms/template-parts/acf/images';
	}
	return $path;
}
add_filter( 'acf-flexible-content-preview.images_path', 'get_acf_preview_path' );

/**
 * This will remove the default image sizes and the medium_large size.
 *
 * @param array $sizes default sizes.
 */
function prefix_remove_default_images( $sizes ) {
	unset( $sizes['small'] ); // 150px.
	unset( $sizes['medium'] ); // 300px.
	unset( $sizes['large'] ); // 1024px.
	unset( $sizes['medium_large'] ); // 768px.
	return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'prefix_remove_default_images' );

/**
 * This will remove the default image sizes and the medium_large size.
 */
function remove_big_image_sizes() {
	remove_image_size( '1536x1536' ); // 2 x Medium Large (1536 x 1536)
	remove_image_size( '2048x2048' ); // 2 x Large (2048 x 2048)
}
add_action( 'init', 'remove_big_image_sizes' );

/**
 * Modifies the custom posts type query.
 *
 * @param object $query The default query.
 * @return object $query The modified query.
 */
function modify_archive_query( $query ) {

	// Case study.
	if ( $query->is_main_query() && ! is_admin() && is_post_type_archive( 'case-study' ) ) {
		$post_num = get_field( 'number_of_case_study_posts', 'option' ) ? get_field( 'number_of_case_study_posts', 'option' ) : '16';
		$query->set( 'posts_per_page', $post_num );
	}

	// Team.
	if ( $query->is_main_query() && ! is_admin() && is_post_type_archive( 'team' ) ) {
		$post_num = get_field( 'ot_number_of_posts', 'option' ) ? get_field( 'ot_number_of_posts', 'option' ) : '12';
		$query->set( 'posts_per_page', $post_num );
	}

	return $query;
}
add_filter( 'pre_get_posts', 'modify_archive_query' );

/**
 * Modify ACF Form Label for Post Title Field.
 *
 * @param object $field The default field.
 * @return object $field The modified field.
 */
function wd_post_title_acf_name( $field ) {
	if ( 'testimonials' !== get_post_type() ) {
		return;
	}
	if ( is_admin() ) {
		return;
	}
	$field['label'] = 'Full Name';
	return $field;
}
add_filter( 'acf/load_field/name=_post_title', 'wd_post_title_acf_name' );

/**
 * Modify ACF field for Post Content.
 *
 * @param object $field The default field.
 * @return object $field The modified field.
 */
function change_post_content_type( $field ) {
	if ( 'testimonials' !== get_post_type() ) {
		return;
	}
	if ( is_admin() ) {
		return;
	}
	if ( 'wysiwyg' === $field['type'] ) {
		$field['tabs']         = 'text';
		$field['toolbar']      = 'basic';
		$field['media_upload'] = 0;
	}
	return $field;
}
add_filter( 'acf/load_field/name=_post_content', 'change_post_content_type' );
