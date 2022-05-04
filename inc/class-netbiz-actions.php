<?php
/**
 * All custom actions here.
 *
 * @package Netbiz
 */

defined( 'WPINC' ) || exit;

/**
 * Main class for Actions
 */
class Netbiz_Actions {

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
		add_action( 'netbiz_after_header', [ $this, 'get_page_breadcrumbs' ], 10 );
		add_action( 'netbiz_after_header', [ $this, 'get_page_title_section' ], 20 );
	}

	/**
	 * Page Breadcrumb.
	 */
	public function get_page_breadcrumbs() {
		if ( is_page_template( 'page-home.php' ) || is_404() ) {
			return;
		}
		if ( is_page() && ! get_the_title( get_the_id() ) ) {
			return;
		}
		?>
			<section class="breadcrumb">
				<div class="container">

					<ul class="flex py-2 text-dark-color/60">
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'netbiz' ); ?></a></li>
						<li class="mx-2">></li>

						<?php
						// Middle.
						if ( is_single() ) {
							if ( 'post' === get_post_type() ) {
								printf(
									'<li class="capitalize"><a href="%s">%s</a></li>
									<li class="mx-2">></li>',
									esc_url( home_url( '/' ) . 'news' ),
									esc_html__( 'News', 'netbiz' )
								);
							} else {
								printf(
									'<li class="capitalize"><a href="%s">%s</a></li>
									<li class="mx-2">></li>',
									is_woocommerce_page() ? esc_url( home_url( '/' ) . 'shop' ) : esc_url( home_url( '/' ) . get_post_type() ),
									esc_html( str_replace( '-', ' ', get_post_type() ) )
								);
							}
						}
						if ( is_category() ) {
							printf(
								'<li class="capitalize">%s</li>
								<li class="mx-2">></li>',
								esc_html__( 'Category', 'netbiz' )
							);
						}
						?>

						<?php
						// Last.
						if ( is_home() ) {
							$current_page = '<li>' . get_the_title( get_option( 'page_for_posts', true ) ) . '</li>';
						}
						if ( is_archive() ) {
							if ( is_woocommerce_page() ) {
								$current_page = '<li>' . esc_html( woocommerce_page_title( false ) ) . '</li>';
							} else {
								$current_page = '<li>' . get_the_archive_title() . '</li>';
							}
						}
						if ( is_search() ) {
							$current_page = '<li>' . get_search_query() . '</li>';
						}
						if ( is_page() || is_single() ) {
							$current_page = '<li>' . wp_kses_post( get_the_title( get_the_id() ) ) . '</li>';
						}
						if ( is_woocommerce_activated() && is_shop() ) {
							$current_page = '<li>' . esc_html( woocommerce_page_title( false ) ) . '</li>';
						}
						echo $current_page; // phpcs:ignore
						?>
					</ul>

				</div>
			</section>
		<?php
	}

	/**
	 * Page Title.
	 */
	public function get_page_title_section() {
		if ( is_page_template( 'page-home.php' ) || is_singular( 'case-study' ) || is_404() ) {
			return;
		}
		if ( is_page() && ! get_the_title( get_the_id() ) ) {
			return;
		}
		?>
		<section class="w-full hero-title bg-theme-color text-dark-section-text py-11">
			<div class="container">
			<?php
			if ( is_home() ) {
				$page_title = '<h2 class="text-4.5xl font-black text-center leading-none sm:leading-normal">' . get_the_title( get_option( 'page_for_posts', true ) ) . '</h2>';
			}
			if ( is_archive() ) {
				if ( is_woocommerce_page() ) {
					$page_title = '<h2 class="text-4.5xl font-black text-center leading-none sm:leading-normal">' . esc_html( woocommerce_page_title( false ) ) . '</h2>';
				} else {
					$page_title = '<h1 class="text-4.5xl font-black text-center leading-none sm:leading-normal">' . get_the_archive_title() . '</h1>';
				}
			}
			if ( is_search() ) {
				$page_title = '<h1 class="text-4.5xl font-black text-center leading-none sm:leading-normal">' . get_search_query() . '</h1>';
			}
			if ( is_page() || is_single() ) {
				if ( is_singular( 'faqs' ) ) {
					$page_title = '<h2 class="text-4.5xl font-black leading-none">' . esc_html( get_the_title( get_the_id() ) ) . '</h2>';

				} else {
					$page_title = '<h2 class="text-4.5xl font-black text-center leading-none sm:leading-normal">' . esc_html( get_the_title( get_the_id() ) ) . '</h2>';
				}
			}
			if ( is_woocommerce_activated() && is_shop() ) {
				$page_title = '<h2 class="text-4.5xl font-black text-center leading-none sm:leading-normal">' . esc_html( woocommerce_page_title( false ) ) . '</h2>';
			}
			echo $page_title; // phpcs:ignore
			?>
			</div>
		</section>
		<?php
	}

}

// Init.
new Netbiz_Actions();
