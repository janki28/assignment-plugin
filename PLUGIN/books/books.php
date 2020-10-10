<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://janki1028.wordpress.com/
 * @since             1.0.0
 * @package           Books
 *
 * @wordpress-plugin
 * Plugin Name:       WP Book
 * Plugin URI:        http://localhost/mysite/wp-admin/edit.php?post_type=books
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Janki
 * Author URI:        https://janki1028.wordpress.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       books
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
define( 'BOOKS_VERSION', '1.0.0' );

/**
 * Global variables
 */
$default_setting = array(
    'currency' => 'INR (₹)',
    'page' => '10',
);
$book_options = get_option( 'book_settings', $default_setting );

if ( $book_options == '' ) {
    update_option( 'book_settings', $default_setting );
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-books-activator.php
 */
function activate_books() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-books-activator.php';
	Books_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-books-deactivator.php
 */
function deactivate_books() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-books-deactivator.php';
	Books_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_books' );
register_deactivation_hook( __FILE__, 'deactivate_books' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-books.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_books() {

	$plugin = new Books();
	$plugin->run();

}
run_books();
?>
