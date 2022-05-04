<?php
/**
 * The template part for displaying Main menu in header.
 *
 * @package Netbiz
 */

$nav = new Netbiz_Menu_Walker( 'main-menu' );
?>

<nav class="hidden xl:block"><?php echo $nav->build_menu(); // phpcs:ignore ?></nav>
