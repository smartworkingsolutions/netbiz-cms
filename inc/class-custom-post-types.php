<?php
/**
 * Register Custom Post Types
 *
 * @package Netbiz
 */

defined( 'WPINC' ) || exit;

/**
 * Main class of Custom Post Types
 */
class Custom_Post_Types {

	/**
	 * The Construct
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'careers_custom_post_type' ] );
		add_action( 'init', [ $this, 'case_study_custom_post_type' ] );
		add_action( 'init', [ $this, 'faqs_custom_post_type' ] );
		add_action( 'init', [ $this, 'glossary_custom_post_type' ] );
		add_action( 'init', [ $this, 'services_custom_post_type' ] );
		add_action( 'init', [ $this, 'team_custom_post_type' ] );
		add_action( 'init', [ $this, 'testimonials_custom_post_type' ] );
	}

	/**
	 * Careers CPT
	 */
	public function careers_custom_post_type() {

		// Set UI labels for Custom Post Type.
		$labels = [
			'name'               => _x( 'Careers', 'Post Type General Name', 'netbiz' ),
			'singular_name'      => _x( 'Career', 'Post Type Singular Name', 'netbiz' ),
			'menu_name'          => __( 'Careers', 'netbiz' ),
			'parent_item_colon'  => __( 'Parent Career', 'netbiz' ),
			'all_items'          => __( 'All Careers', 'netbiz' ),
			'view_item'          => __( 'View Career', 'netbiz' ),
			'add_new_item'       => __( 'Add New Career', 'netbiz' ),
			'add_new'            => __( 'Add New', 'netbiz' ),
			'edit_item'          => __( 'Edit Career', 'netbiz' ),
			'update_item'        => __( 'Update Career', 'netbiz' ),
			'search_items'       => __( 'Search Career', 'netbiz' ),
			'not_found'          => __( 'Not Found', 'netbiz' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'netbiz' ),
		];

		// Set other options for Custom Post Type.
		$args = [
			'label'               => __( 'Careers', 'netbiz' ),
			'menu_icon'           => 'dashicons-businessman',
			'description'         => __( 'Career posts', 'netbiz' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor.
			'supports'            => [ 'title', 'editor', 'custom-fields' ],
			/**
			 * A hierarchical CPT is like Pages and can have
			 * Parent and child items. A non-hierarchical CPT
			 * is like Posts.
			 */
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			// 'show_in_rest'        => true,

		];

		// Registering your Custom Post Type.
		register_post_type( 'career', $args );
	}

	/**
	 * Case Studies CPT
	 */
	public function case_study_custom_post_type() {

		// Set UI labels for Custom Post Type.
		$labels = [
			'name'               => _x( 'Case Studies', 'Post Type General Name', 'netbiz' ),
			'singular_name'      => _x( 'Case study', 'Post Type Singular Name', 'netbiz' ),
			'menu_name'          => __( 'Case Studies', 'netbiz' ),
			'parent_item_colon'  => __( 'Parent Case study', 'netbiz' ),
			'all_items'          => __( 'All Case Studies', 'netbiz' ),
			'view_item'          => __( 'View Case study', 'netbiz' ),
			'add_new_item'       => __( 'Add New Case study', 'netbiz' ),
			'add_new'            => __( 'Add New', 'netbiz' ),
			'edit_item'          => __( 'Edit Case study', 'netbiz' ),
			'update_item'        => __( 'Update Case study', 'netbiz' ),
			'search_items'       => __( 'Search Case study', 'netbiz' ),
			'not_found'          => __( 'Not Found', 'netbiz' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'netbiz' ),
		];

		// Set other options for Custom Post Type.
		$args = [
			'label'               => __( 'Case Studies', 'netbiz' ),
			'menu_icon'           => 'dashicons-welcome-view-site',
			'description'         => __( 'Case study posts', 'netbiz' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor.
			'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
			/**
			 * A hierarchical CPT is like Pages and can have
			 * Parent and child items. A non-hierarchical CPT
			 * is like Posts.
			 */
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			// 'show_in_rest'        => true,

		];

		// Registering your Custom Post Type.
		register_post_type( 'case-study', $args );
	}

	/**
	 * FAQs CPT
	 */
	public function faqs_custom_post_type() {

		// Set UI labels for Custom Post Type.
		$labels = [
			'name'               => _x( 'FAQs', 'Post Type General Name', 'netbiz' ),
			'singular_name'      => _x( 'FAQ', 'Post Type Singular Name', 'netbiz' ),
			'menu_name'          => __( 'FAQs', 'netbiz' ),
			'parent_item_colon'  => __( 'Parent FAQ', 'netbiz' ),
			'all_items'          => __( 'All FAQs', 'netbiz' ),
			'view_item'          => __( 'View FAQ', 'netbiz' ),
			'add_new_item'       => __( 'Add New FAQ', 'netbiz' ),
			'add_new'            => __( 'Add New', 'netbiz' ),
			'edit_item'          => __( 'Edit FAQ', 'netbiz' ),
			'update_item'        => __( 'Update FAQ', 'netbiz' ),
			'search_items'       => __( 'Search FAQ', 'netbiz' ),
			'not_found'          => __( 'Not Found', 'netbiz' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'netbiz' ),
		];

		// Set other options for Custom Post Type.
		$args = [
			'label'               => __( 'FAQs', 'netbiz' ),
			'menu_icon'           => 'dashicons-format-quote',
			'description'         => __( 'FAQ posts', 'netbiz' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor.
			'supports'            => [ 'title', 'editor', 'custom-fields' ],
			/**
			 * A hierarchical CPT is like Pages and can have
			 * Parent and child items. A non-hierarchical CPT
			 * is like Posts.
			 */
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			// 'show_in_rest'        => true,

		];

		// Registering your Custom Post Type.
		register_post_type( 'faqs', $args );
	}

	/**
	 * Glossary CPT
	 */
	public function glossary_custom_post_type() {

		// if ( is_array( $this->modules() ) && ! in_array( 'glossary', $this->modules(), true ) ) {
		// 	return;
		// }

		// Set UI labels for Custom Post Type.
		$labels = [
			'name'               => _x( 'Glossary', 'Post Type General Name', 'netbiz' ),
			'singular_name'      => _x( 'Glossary', 'Post Type Singular Name', 'netbiz' ),
			'menu_name'          => __( 'Glossary', 'netbiz' ),
			'parent_item_colon'  => __( 'Parent Glossary', 'netbiz' ),
			'all_items'          => __( 'All Glossary', 'netbiz' ),
			'view_item'          => __( 'View Glossary', 'netbiz' ),
			'add_new_item'       => __( 'Add New Glossary', 'netbiz' ),
			'add_new'            => __( 'Add New', 'netbiz' ),
			'edit_item'          => __( 'Edit Glossary', 'netbiz' ),
			'update_item'        => __( 'Update Glossary', 'netbiz' ),
			'search_items'       => __( 'Search Glossary', 'netbiz' ),
			'not_found'          => __( 'Not Found', 'netbiz' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'netbiz' ),
		];

		// Set other options for Custom Post Type.
		$args = [
			'label'               => __( 'Glossary', 'netbiz' ),
			'menu_icon'           => 'dashicons-format-aside',
			'description'         => __( 'Glossary posts', 'netbiz' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor.
			'supports'            => [ 'title', 'editor', 'custom-fields' ],
			/**
			 * A hierarchical CPT is like Pages and can have
			 * Parent and child items. A non-hierarchical CPT
			 * is like Posts.
			 */
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			// 'show_in_rest'        => true,

		];

		// Registering your Custom Post Type.
		register_post_type( 'glossary', $args );
	}

	/**
	 * Services CPT
	 */
	public function services_custom_post_type() {

		// Set UI labels for Custom Post Type.
		$labels = [
			'name'               => _x( 'Services', 'Post Type General Name', 'netbiz' ),
			'singular_name'      => _x( 'Service', 'Post Type Singular Name', 'netbiz' ),
			'menu_name'          => __( 'Services', 'netbiz' ),
			'parent_item_colon'  => __( 'Parent Service', 'netbiz' ),
			'all_items'          => __( 'All Services', 'netbiz' ),
			'view_item'          => __( 'View Service', 'netbiz' ),
			'add_new_item'       => __( 'Add New Service', 'netbiz' ),
			'add_new'            => __( 'Add New', 'netbiz' ),
			'edit_item'          => __( 'Edit Service', 'netbiz' ),
			'update_item'        => __( 'Update Service', 'netbiz' ),
			'search_items'       => __( 'Search Service', 'netbiz' ),
			'not_found'          => __( 'Not Found', 'netbiz' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'netbiz' ),
		];

		// Set other options for Custom Post Type.
		$args = [
			'label'               => __( 'Services', 'netbiz' ),
			'menu_icon'           => 'dashicons-admin-tools',
			'description'         => __( 'Service posts', 'netbiz' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor.
			'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
			/**
			 * A hierarchical CPT is like Pages and can have
			 * Parent and child items. A non-hierarchical CPT
			 * is like Posts.
			 */
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			// 'show_in_rest'        => true,

		];

		// Registering your Custom Post Type.
		register_post_type( 'services', $args );
	}

	/**
	 * Team CPT
	 */
	public function team_custom_post_type() {

		// Set UI labels for Custom Post Type.
		$labels = [
			'name'               => _x( 'Team', 'Post Type General Name', 'netbiz' ),
			'singular_name'      => _x( 'Team', 'Post Type Singular Name', 'netbiz' ),
			'menu_name'          => __( 'Team', 'netbiz' ),
			'parent_item_colon'  => __( 'Parent Team', 'netbiz' ),
			'all_items'          => __( 'All Team', 'netbiz' ),
			'view_item'          => __( 'View Team', 'netbiz' ),
			'add_new_item'       => __( 'Add New Team', 'netbiz' ),
			'add_new'            => __( 'Add New', 'netbiz' ),
			'edit_item'          => __( 'Edit Team', 'netbiz' ),
			'update_item'        => __( 'Update Team', 'netbiz' ),
			'search_items'       => __( 'Search Team', 'netbiz' ),
			'not_found'          => __( 'Not Found', 'netbiz' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'netbiz' ),
		];

		// Set other options for Custom Post Type.
		$args = [
			'label'               => __( 'Team', 'netbiz' ),
			'menu_icon'           => 'dashicons-groups',
			'description'         => __( 'Team posts', 'netbiz' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor.
			'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
			/**
			 * A hierarchical CPT is like Pages and can have
			 * Parent and child items. A non-hierarchical CPT
			 * is like Posts.
			 */
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			// 'show_in_rest'        => true,

		];

		// Registering your Custom Post Type.
		register_post_type( 'team', $args );
	}

	/**
	 * Testimonials CPT
	 */
	public function testimonials_custom_post_type() {

		// Set UI labels for Custom Post Type.
		$labels = [
			'name'               => _x( 'Testimonials', 'Post Type General Name', 'netbiz' ),
			'singular_name'      => _x( 'Testimonial', 'Post Type Singular Name', 'netbiz' ),
			'menu_name'          => __( 'Testimonials', 'netbiz' ),
			'parent_item_colon'  => __( 'Parent Testimonial', 'netbiz' ),
			'all_items'          => __( 'All Testimonials', 'netbiz' ),
			'view_item'          => __( 'View Testimonial', 'netbiz' ),
			'add_new_item'       => __( 'Add New Testimonial', 'netbiz' ),
			'add_new'            => __( 'Add New', 'netbiz' ),
			'edit_item'          => __( 'Edit Testimonial', 'netbiz' ),
			'update_item'        => __( 'Update Testimonial', 'netbiz' ),
			'search_items'       => __( 'Search Testimonial', 'netbiz' ),
			'not_found'          => __( 'Not Found', 'netbiz' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'netbiz' ),
		];

		// Set other options for Custom Post Type.
		$args = [
			'label'               => __( 'Testimonials', 'netbiz' ),
			'menu_icon'           => 'dashicons-testimonial',
			'description'         => __( 'Testimonial posts', 'netbiz' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor.
			'supports'            => [ 'title', 'editor', 'custom-fields' ],
			/**
			 * A hierarchical CPT is like Pages and can have
			 * Parent and child items. A non-hierarchical CPT
			 * is like Posts.
			 */
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			// 'show_in_rest'        => true,

		];

		// Registering your Custom Post Type.
		register_post_type( 'testimonials', $args );
	}

}

/**
 * Init
 */
new Custom_Post_Types();
