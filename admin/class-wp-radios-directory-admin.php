<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Radios_Directory
 * @subpackage Wp_Radios_Directory/admin
 * @author     Dezodev <dezodev@gmail.com>
 */
class Wp_Radios_Directory_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.1
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-radios-directory-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-radios-directory-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register Custom Post Type.
	 *
	 * @since    0.0.1
	 */
	public function radios_dir_post_type() {

		$labels = array(
			'name'                  => _x( 'Radios', 'Post Type General Name', 'wp-radios-directory' ),
			'singular_name'         => _x( 'Radio', 'Post Type Singular Name', 'wp-radios-directory' ),
			'menu_name'             => __( 'Radios Directory', 'wp-radios-directory' ),
			'name_admin_bar'        => __( 'Radios Directory', 'wp-radios-directory' ),
			'archives'              => __( 'Radio Archives', 'wp-radios-directory' ),
			'attributes'            => __( 'Radio Attributes', 'wp-radios-directory' ),
			'parent_item_colon'     => __( 'Parent Radio:', 'wp-radios-directory' ),
			'all_items'             => __( 'All Radios', 'wp-radios-directory' ),
			'add_new_item'          => __( 'Add New Radio', 'wp-radios-directory' ),
			'add_new'               => __( 'Add New', 'wp-radios-directory' ),
			'new_item'              => __( 'New Radio', 'wp-radios-directory' ),
			'edit_item'             => __( 'Edit Radio', 'wp-radios-directory' ),
			'update_item'           => __( 'Update Radio', 'wp-radios-directory' ),
			'view_item'             => __( 'View Radio', 'wp-radios-directory' ),
			'view_items'            => __( 'View Radio', 'wp-radios-directory' ),
			'search_items'          => __( 'Search Radio', 'wp-radios-directory' ),
			'not_found'             => __( 'Not found', 'wp-radios-directory' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'wp-radios-directory' ),
			'featured_image'        => __( 'Featured Logo', 'wp-radios-directory' ),
			'set_featured_image'    => __( 'Set featured logo', 'wp-radios-directory' ),
			'remove_featured_image' => __( 'Remove featured logo', 'wp-radios-directory' ),
			'use_featured_image'    => __( 'Use as featured logo', 'wp-radios-directory' ),
			'insert_into_item'      => __( 'Insert into radio', 'wp-radios-directory' ),
			'uploaded_to_this_item' => __( 'Uploaded to this radio', 'wp-radios-directory' ),
			'items_list'            => __( 'Radios list', 'wp-radios-directory' ),
			'items_list_navigation' => __( 'Radios list navigation', 'wp-radios-directory' ),
			'filter_items_list'     => __( 'Filter radios list', 'wp-radios-directory' ),
		);
		$args = array(
			'label'                 => __( 'Radio', 'wp-radios-directory' ),
			'description'           => __( 'Radios Directory', 'wp-radios-directory' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions' ),
			'taxonomies'            => array( 'radios-type', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-album',
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
		);
		register_post_type( 'radios', $args );

	}

	/**
	 * Register Custom Taxonomy.
	 *
	 * @since    0.0.1
	 */
	public function radio_dir_taxonomy() {

		$labels = array(
			'name'                       => _x( 'Genres', 'Taxonomy General Name', 'wp-radios-directory' ),
			'singular_name'              => _x( 'Genre', 'Taxonomy Singular Name', 'wp-radios-directory' ),
			'menu_name'                  => __( 'Genre', 'wp-radios-directory' ),
			'all_items'                  => __( 'All Genres', 'wp-radios-directory' ),
			'parent_item'                => __( 'Parent Genre', 'wp-radios-directory' ),
			'parent_item_colon'          => __( 'Parent Genre:', 'wp-radios-directory' ),
			'new_item_name'              => __( 'New Genre Name', 'wp-radios-directory' ),
			'add_new_item'               => __( 'Add New Genre', 'wp-radios-directory' ),
			'edit_item'                  => __( 'Edit Genre', 'wp-radios-directory' ),
			'update_item'                => __( 'Update Genre', 'wp-radios-directory' ),
			'view_item'                  => __( 'View Genre', 'wp-radios-directory' ),
			'separate_items_with_commas' => __( 'Separate types with commas', 'wp-radios-directory' ),
			'add_or_remove_items'        => __( 'Add or remove types', 'wp-radios-directory' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'wp-radios-directory' ),
			'popular_items'              => __( 'Popular Genres', 'wp-radios-directory' ),
			'search_items'               => __( 'Search Genres', 'wp-radios-directory' ),
			'not_found'                  => __( 'Not Found', 'wp-radios-directory' ),
			'no_terms'                   => __( 'No items', 'wp-radios-directory' ),
			'items_list'                 => __( 'Genres list', 'wp-radios-directory' ),
			'items_list_navigation'      => __( 'Genres list navigation', 'wp-radios-directory' ),
		);
		$rewrite = array(
			'slug'                       => 'radios-type',
			'with_front'                 => true,
			'hierarchical'               => true,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'radio-type', array( 'radios' ), $args );

	}

}
