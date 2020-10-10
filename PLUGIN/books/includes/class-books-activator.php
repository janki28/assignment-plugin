<?php

/**
 * Fired during plugin activation
 *
 * @link       https://janki1028.wordpress.com/
 * @since      1.0.0
 *
 * @package    Books
 * @subpackage Books/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Books
 * @subpackage Books/includes
 * @author     Janki <jankipatel1028@gmail.com>
 */
class Books_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		// flush rewrite rules on plugin activation
        /*flush_rewrite_rules();*/

        // create custom table on plugin activation
        $version = '1.0.0';

        if ( defined( 'BOOKS_VERSION' ) ) {
            $version = BOOKS_VERSION;
        }
        $books_admin = new Books_Admin( 'books', $version );
        $books_admin->book_detail_create_table();
    }
}
