<?php
/**
 * The template part for displaying icons in header.
 *
 * @package Netbiz
 */

$is_search = get_field( 'enable_search', 'options' );
$is_menu   = get_field( 'enable_sliding_menu', 'options' );
$btn       = get_field( 'add_button_optional', 'options' );
$full_nav  = new Netbiz_Menu_Walker( 'full-menu' );

$ham_icon_classes = '';
if ( ! $is_menu && $full_nav ) {
	$ham_icon_classes = ' xl:hidden';
}
?>

<div class="header-icons flex items-center ml-10 space-x-4 sm:space-x-6 lg:space-x-8 text-theme-color text-2xl">

	<!-- <div class="heart-icon hover:text-dark-color">
		<a href="#"><i class="fa fa-heart"></i></a>
	</div> -->

	<?php
	// Button.
	if ( $btn ) {
		printf(
			'<div class="header-button hidden xl:block"><a href="%s" class="button text-lg" target="%s">%s</a></div>',
			esc_url( $btn['url'] ),
			esc_html( $btn['target'] ),
			esc_html( $btn['title'] )
		);
	}

	// Cart icon.
	if ( function_exists( 'netbiz_woocommerce_header_cart' ) ) {
		netbiz_woocommerce_header_cart();
	}

	// Search icon.
	if ( $is_search ) {
		?>
		<div class="search-icon hover:text-dark-color">
			<button><i class="fa fa-search"></i></button>                        
		</div>
		<?php
	}
	if ( $is_menu || $full_nav ) {
		?>
		<div class="mobile-menu-wrapper<?php echo esc_html( $ham_icon_classes ); ?>">
			<button class="mobile-menu-button hover:text-dark-color">
				<i class="fa fa-bars"></i>
			</button>
		</div>
		<?php
	}
	?>

</div>
