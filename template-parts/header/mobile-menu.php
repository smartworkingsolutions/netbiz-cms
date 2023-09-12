<?php
/**
 * The template part for displaying Mobile menu in header.
 *
 * @package Netbiz
 */

$is_menu  = get_field( 'enable_sliding_menu', 'options' );
$full_nav = new Netbiz_Menu_Walker( 'full-menu' );
$nav      = new Netbiz_Menu_Walker( 'slide-menu' );

if ( ! $is_menu && ! $nav && ! $full_nav ) {
	return;
}
?>

<!-- Mobile menu -->
<div class="mobile-menu slide-close flex flex-col bg-theme-color text-dark-section-text w-96 h-screen overflow-y-auto px-10 py-2 fixed right-0 top-0 z-30 transition-all duration-200">

	<div class="close text-2xl mt-8">
		<button><i class="fal fa-times"></i></button>
	</div>

	<nav class="clone xl:hidden mb-8"></nav>
	<nav><?php echo $nav->build_menu( 'mobile' ); // phpcs:ignore ?></nav>

	<?php get_template_part( 'template-parts/header/social', 'icons' ); ?>

</div>
<div class="overlay w-full h-full fixed inset-0 z-20 bg-black/30 hidden"></div>
