<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://dezodev.tk
 * @since             0.0.1
 * @package           Wp_Radios_Directory
 *
 * @wordpress-plugin
 * Plugin Name:       WP Radios Directory
 * Plugin URI:        https://github.com/Dezodev/wp-radios-directory
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           0.0.1
 * Author:            Dezodev
 * Author URI:        http://dezodev.tk
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-radios-directory
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_RADIOS_DIR_VERSION', '0.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-radios-directory-activator.php
 */
function activate_wp_radios_directory() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-radios-directory-activator.php';
	Wp_Radios_Directory_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-radios-directory-deactivator.php
 */
function deactivate_wp_radios_directory() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-radios-directory-deactivator.php';
	Wp_Radios_Directory_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_radios_directory' );
register_deactivation_hook( __FILE__, 'deactivate_wp_radios_directory' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-radios-directory.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.0.1
 */
function run_wp_radios_directory() {

	$plugin = new Wp_Radios_Directory();
	$plugin->run();

}
run_wp_radios_directory();
