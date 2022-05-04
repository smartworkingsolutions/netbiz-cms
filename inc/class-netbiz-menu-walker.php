<?php
/**
 * Menu Walker.
 *
 * @package Netbiz
 */

defined( 'WPINC' ) || exit;

/**
 * Main class
 */
class Netbiz_Menu_Walker {

	/**
	 * Menu id
	 *
	 * @var $menu_id
	 */
	public $menu_id = '';

	/**
	 * Menu data
	 *
	 * @var $data
	 */
	public $data = [];

	/**
	 * Default constructor.
	 *
	 * @param string $menu_id menu id.
	 */
	public function __construct( $menu_id ) {
		$this->menu_id = $menu_id;
		$cache         = new get_menu_cache( $this->menu_id );
		$this->data    = $cache->data;
	}

	/**
	 * Build the mega menu with one tier drop downs
	 * Needs to be wrapped in a container/nav tag when
	 * output in template
	 *
	 * @param string $loc menu location.
	 *
	 * @return $html
	 */
	public function build_menu( $loc = '' ) {

		global $options;
		global $wp;
		$current_url = home_url( add_query_arg( [], $wp->request ) ) . '/';

		$menu_html = '<ul class="parent flex items-center text-xl xl:space-x-8 2xl:space-x-10">';

		if ( 'mobile' === $loc ) {
			$menu_html = '<ul class="flex flex-col text-xl font-bold text-right space-y-8">';
		}

		foreach ( $this->data as $link ) {

			$current        = ( $current_url === $link['url'] ) ? true : false;
			$mobile_submenu = 'sub-menu w-60 bg-theme-color p-5 text-dark-color space-y-4 absolute top-[72px] -left-5 hidden group-hover:block shadow-md';
			$caret          = '';

			if ( $current && 'mobile' !== $loc ) {
				$classes = 'flex items-center hover:text-theme-color font-bold border-b-2 border-dark-color';
			}
			if ( ! $current ) {
				$classes = 'flex items-center hover:text-theme-color';
			}
			if ( 'mobile' === $loc ) {
				$classes        = 'block';
				$mobile_submenu = $classes;
			}
			if ( ! empty( $link['children'] ) && is_array( $link['children'] ) && 'mobile' !== $loc ) {
				$caret = '<span class="text-3xl ml-1"> <i class="fal fa-angle-down"></i></span>';
			}

			$target = '';
			if ( '' !== $link['target'] ) {
				$target = ' target="' . $link['target'] . '" ';
			}

			$menu_html .= '<li class="group relative">';

			$menu_html .= sprintf(
				'<a href="%s" %s class="%s">%s%s</a>',
				$link['url'],
				$target,
				$classes,
				$link['title'],
				$caret
			);

			if ( ! empty( $link['children'] ) && is_array( $link['children'] ) ) {
				$menu_html .= '<ul class="' . $mobile_submenu . '">';
			}

			foreach ( $link['children'] as $child ) {

				$menu_html .= '<li class="group relative">';

				if ( empty( $child['children'] ) ) {
					$menu_html .= sprintf(
						'<a href="%s" %s class="text-dark-section-text hover:text-white">%s</a>',
						$child['url'],
						$target,
						$child['title']
					);
				}

				$menu_html .= '</li>';

			}

			if ( ! empty( $link['children'] ) && is_array( $link['children'] ) ) {
				$menu_html .= '</ul>';
			}

			$menu_html .= '</li>';

		}

		$menu_html .= '</ul>';

		return $menu_html;

	}

}
