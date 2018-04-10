<?php

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Radios_Directory
 * @subpackage Wp_Radios_Directory/public
 * @author     Dezodev <dezodev@gmail.com>
 */
class Wp_Radios_Directory_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . '/css/wp-radios-directory-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-plyr-player', 'https://cdnjs.cloudflare.com/ajax/libs/plyr/3.1.0/plyr.css', array(), null, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . '/js/wp-radios-directory-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-plyr-player', 'https://cdnjs.cloudflare.com/ajax/libs/plyr/3.1.0/plyr.min.js', array( 'jquery' ), null, false );

	}

	/**
	 * load the theme file for the playlist and show post types
	 *
	 * @since    0.0.1
	 */
	public function get_radios_template($single_template) {
		global $post;

		if ($post->post_type == 'radios') {
			$single_template = plugin_dir_path(dirname(__FILE__)) . '/templates/single-radios.php';
		}

		return $single_template;
	}

}
