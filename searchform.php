<?php
/**
 * The template for displaying search form.
 *
 * @package RMS
 */

?>

<form id="searchform" class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" accept-charset="utf-8">
	<input type="text" class="search-input w-72 border-x-0 border-t-0 border-b-2 focus:outline-none focus:ring-0 focus:border-dark-section-text bg-transparent border-dark-section-text placeholder:text-dark-section-text text-dark-section-text p-0" name="s" autocomplete="off" placeholder="Search this site" value="<?php echo get_search_query(); ?>">
	<button class="search-submit ml-2" type="submit"><i class="far fa-search"></i></button>
</form>
