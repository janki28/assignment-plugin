<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://janki1028.wordpress.com/
 * @since      1.0.0
 *
 * @package    Books
 * @subpackage Books/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Books
 * @subpackage Books/admin
 * @author     Janki 
 */

/**
 * includes
 */
// for rendering shortcode's front-end and custom option page
require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/books-admin-display.php' );
 
// for widget class
require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets.php' );

class Books_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
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
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Books_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Books_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/books-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Books_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Books_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/books-admin.js', array( 'jquery' ), $this->version, false );

	}
	/*
		=======================================================
	 			Create custom post type.
		=======================================================
	*/
	function post_type_book()
	{
		$labels = array(
			'name' 				=> __( 'Books', 'books' ),
			'singular_name' 	=> __( 'Book', 'books' ),
			'add_new' 			=> __( 'Add Book', 'books' ),
			'all_book' 			=> __( 'All Books', 'books' ),
			'add_new_book' 		=> __( 'Add Book', 'books' ),
			'edit_book' 		=> __( 'Edit Book', 'books' ),
			'new_book' 			=> __( 'New Book', 'books' ),
			'view_book' 		=> __( 'View Book', 'books' ),
			'search_book' 		=> __( 'Search Book', 'books' ),
			'not_found' 		=> __( 'No Books Found', 'books' ),
			'not_found_in_trash' 	=> __( 'No items found in Trash', 'books' ),
			'parent_item_colon' 	=> __( 'Parent Item', 'books' )
		);
		$args = array(
			'labels' 				=> $labels,
			'public' 				=> true,
			'has_archive' 			=> true,
			'menu_icon' 			=> 'dashicons-book',
			'publicly_available' 	=> true,
			'query_var' 			=> true,
			'rewrite' 				=> true,
			'capability_type' 		=> 'post',
			'hierarchical' 			=> false,
			'supports' 				=> array(
										'title',
										'editor',
										'excerpt',
										'thumbnail',
										'revisions',
										'comments',	
									),	
			'menu_position' 		=> 5,
			'exclude_from_search' 	=> false,
		);
		register_post_type( 'books', $args);
	}
	/*
		=======================================================
	 			Create custom hierarchical taxonomy.
		======================================================= 
	*/
	function taxonomy_book_category()
	{
		$labels = array(
		'name' 					=> __( 'Book Categories', 'books' ),
		'singular_name' 		=> __( 'Book Category', 'books' ),
		'search_items' 			=> __( 'Search Book Categories', 'books' ),
		'all_items' 			=> __( 'All Book Categories', 'books' ),
		'parent_item' 			=> __( 'Parent Book Categories', 'books' ),
		'parent_item_colon' 	=> __( 'Parent Book Categories:', 'books' ),
		'edit_item' 			=> __( 'Edit Book Categories', 'books' ),
		'update_item' 			=> __( 'Update Book Categories', 'books' ),
		'add_new_item' 			=> __( 'Add New Book Category', 'books' ),
		'new_item_name' 		=> __( 'New Book Categories Name', 'books' ),
		'menu_name' 			=> __( 'Book Category', 'books' ),
		);
		$args = array(
			'hierarchical' 			=> true,
			'labels' 				=> $labels,
			'show_ui' 				=> true,
			'show_admin_column' 	=> true,
			'query_var' 			=> true,
			'rewrite' 				=> array(
										'slug' => 'book-category' 
										) 
		);
		register_taxonomy('book-category', array('books'), $args);
	}
	/*
		=======================================================
	 			Create custom non-hierarchical taxonomy.
		======================================================= 
	*/
	function taxonomy_non_book_tag()
	{
		$labels = array(
			'name' 					=> __( 'Book Tags', 'books' ),
		 	'singular_name' 		=> __( 'Book Tag', 'books' ),
		 	'search_items' 			=> __( 'Search Book Tags', 'books' ),
		 	'all_items' 			=> __( 'All Book Tags', 'books' ),
		 	'parent_item' 			=> __( 'Parent Book Tag', 'books' ),
		 	'parent_item_colon' 	=> __( 'Parent Book Tag:', 'books' ),
		 	'edit_item' 			=> __( 'Edit Book Tag', 'books' ),
		 	'update_item' 			=> __( 'Update Book Tag', 'books' ),
		 	'add_new_item' 			=> __( 'Add New Book Tag', 'books' ),
		 	'new_item_name' 		=> __( 'New Book Tag Name', 'books' ),
		 	'menu_name' 			=> __( 'Book Tag', 'books' ),	
		);
		$args = array(
			'hierarchical' 			=> false,
			'labels' 				=> $labels,
			'show_ui' 				=> true,
			'show_admin_column' 	=> true,
			'query_var' 			=> true,
			'rewrite' 				=> array(
										'slug' => 'book-tag' 
										) 
		);
		register_taxonomy('book-tag', array('books'), $args);
	}
	/*
	===========================================================
 			Custom Meta Box.
	=========================================================== 
	*/
	public function book_add_meta_box()
	{
		add_meta_box( 'book_details', __( 'Book Details', 'books'), array( $this,'book_details_callback'), 'books');
	}
	public function book_details_callback( $post )
	{
		wp_nonce_field( 'book_save_details_data', 'book_details_meta_box_nonce' );

		$all_info = get_metadata( 'bookdetail', $post->ID, '_book_detail_key' )[0];
		
		return book_details_metadata( $all_info );

	}
	public function book_save_details_data( $post_id )
	{
		if( ! isset( $_POST['book_details_meta_box_nonce'] ) )
		{
			return;
		}

		if ( ! wp_verify_nonce( $_POST['book_details_meta_box_nonce'], 'book_save_details_data' ) )
		{
		 	return;
		}

		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		{
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) )
		{
		 	return;
		}

    	$author_name = sanitize_text_field( $_POST[ 'book_author_name' ] );
        $price       = sanitize_text_field( $_POST[ 'book_price' ] );
        $publisher   = sanitize_text_field( $_POST[ 'book_publisher' ] );
        $year        = sanitize_text_field( $_POST[ 'book_published_year' ] );
        $edition     = sanitize_text_field( $_POST[ 'book_edition' ] );
        $url         = sanitize_text_field( $_POST[ 'book_url' ] );
		
        $all_info = array(
            'author_name'	=> $author_name,
            'price'			=> $price,
            'publisher'		=> $publisher,
            'year'        	=> $year,
            'edition'     	=> $edition,
            'buyurl'		=> $url,
            
        );
        update_metadata( 'bookdetail', $post_id, '_book_detail_key', $all_info );
	}
	/*
	===========================================================
 			Custom Meta Table.
	===========================================================
	*/
	function book_detail_create_table()
	{
	    global $wpdb;
	    $charset_collate = $wpdb->get_charset_collate();
	    $table_name = $wpdb->prefix . "bookdetailmeta";
	    require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
	    
	    if ( $wpdb->get_var('SHOW TABLES LIKE "$table_name"' ) != $table_name) {
	        $sql = 'CREATE TABLE ' .$table_name.'(
	                meta_id bigint(20) NOT NULL AUTO_INCREMENT,
	                bookdetail_id bigint(20) NOT NULL DEFAULT "0",
	                meta_key varchar(255) DEFAULT NULL,
	                meta_value longtext,
	                PRIMARY KEY  (meta_id),
	                KEY bookdetail_id (bookdetail_id),
	                KEY meta_key (meta_key)
	        ) '. $charset_collate . ';';

	        dbDelta($sql);
    	}
	}
    public function book_register_custom_table() 
    {
        global $wpdb;

        $wpdb->bookdetailmeta = $wpdb->prefix . 'bookdetailmeta';
        $wpdb->tables[] = 'bookdetailmeta';
        
        return;
    }
    /*
	===========================================================
 			Custom Admin Settings Page.
	=========================================================== 
	*/
    function book_details_register_options_page() 
    {
		add_submenu_page('edit.php?post_type=books' ,__( 'Page Title', 'books' ), __( 'Book Settings', 'books' ), 'manage_options', 'book-setting', 'book_details_options_page');
	}
	function book_details_register_settings() 
	{
		register_setting( 'book_details_options_group', 'book_settings' );
		register_setting( 'book_widget_settings_group', 'book_widget' );
	}
	/*
	===========================================================
 			Short Code.
	=========================================================== 
	*/
	public function book_add_shortcode( $atts ) 
	{
		// Attributes
	 	$atts = shortcode_atts(
	 		array(
	 			'author_name'	=>	'',
	 			'publisher'		=>	'',
	 			'category'		=>	'',
	 			'year'			=> 	'',
	 			'tag'			=> 	'',
	 			'id'			=> 	'',
	 			'price'			=> 	'',
	 	 		),
	 		$atts,
	 	);
	 	$args = array(
	            'post_type'      => 'books',
	            'post_status'    => 'publish',
	            'posts_per_page'	=> $book_options[ 'page' ],
	        );

	 	return book_shortcode( $args );
	}
	function register_book_shortcode() 
	{
    	add_shortcode( 'book', array( $this, 'book_add_shortcode' ) );
    }
    /*
	===========================================================
 			Custom Category Widget.
	=========================================================== 
	*/
    function my_register_book_widget() 
	{
	    register_widget( 'Books_Widget' );
	}
	/*
	===========================================================
 			Register Custom Dashboard Widget.
	=========================================================== 
	*/
	function book_dashboard_widget() 
	{
    	wp_add_dashboard_widget( 'dashboard_widget',__( 'Top 5 Book Categories', 'books' ), 'dashboard_widget_function' );
	}
}