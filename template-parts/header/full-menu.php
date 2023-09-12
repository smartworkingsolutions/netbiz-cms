<?php
/**
 * The template part for displaying Full menu in header.
 *
 * @package Netbiz
 */

$nav = new Netbiz_Menu_Walker( 'full-menu' );

if ( ! $nav ) {
	return;
}
?>

<nav class="full-nav | bg-theme-color text-dark-section-text hidden xl:block">
	<div class="container">
        <?php echo $nav->build_menu( 'full' ); // phpcs:ignore ?>
	</div>
</nav>
