<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://janki1028.wordpress.com/
 * @since      1.0.0
 *
 * @package    Books
 * @subpackage Books/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Books
 * @subpackage Books/includes
 * @author     Janki <jankipatel1028@gmail.com>
 */
class Books_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		// flush the rewrite rules on deactivation
        flush_rewrite_rules();
	}
}
