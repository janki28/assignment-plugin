<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://janki1028.wordpress.com/
 * @since      1.0.0
 *
 * @package    Books
 * @subpackage Books/admin/partials
 */
?>
<?php
/*
	===========================================================
 			Custom Meta Box.
	=========================================================== 
*/
function book_details_metadata( $all_info )
{
	global $book_options;
	?>
	<div class="book_meta">
	    <p class="meta-options book_field">
	        <label for="book_author_name">
	        	<?php esc_html_e( 'Author', 'books' ); ?>
	        </label>
	        <input id="book_author_name" type="text" name="book_author_name" value="<?php echo esc_attr( $all_info[ 'author_name' ] ); ?>" />
	    </p>
	    
	    <p class="meta-options book_field">
	        <label for="book_price">
	        	<?php esc_html_e( 'Price', 'books' ); ?> ( <?php echo esc_attr( $book_options[ 'currency' ] )?> )
	        </label>
	        <input id="book_price" type="number" name="book_price" value="<?php echo esc_attr( $all_info[ 'price' ] ); ?>" />
	    </p>

	    <p class="meta-options book_field">
	        <label for="book_publisher">
	        	<?php esc_html_e( 'Publisher', 'books' ); ?>
	        </label>
	        <input id="book_publisher" type="text" name="book_publisher"  value="<?php echo esc_attr( $all_info[ 'publisher' ] ); ?>" />
	    </p>

	    <p class="meta-options book_field">
	        <label for="book_published_year">
	        	<?php esc_html_e( 'Published Year', 'books' ); ?>
	        </label>
	        <input id="book_published_year" type="number" min="1000" max="2099" step="1" name="book_published_year"  value="<?php echo esc_attr( $all_info[ 'year' ] ); ?>"  />
	    </p>

	    <p class="meta-options book_field">
	        <label for="book_edition">
	        	<?php esc_html_e( 'Edition', 'books' ); ?>
	        </label>
	        <input id="book_edition" type="number"  name="book_edition"  value="<?php echo esc_attr( $all_info[ 'edition' ] ); ?>"  />
	    </p>

		<p class="meta-options book_field">
	        <label for="book_url">
	        	<?php esc_html_e( 'Buy Book', 'books' ); ?>
	        </label>
	        <input id="book_url" type="url"  name="book_url"  value=" <?php echo esc_attr( $all_info[ 'buyurl' ] ); ?>" />
	    </p>
	</div>
<?php
}
?>
<?php 
/*
	===========================================================
 			Custom Admin Settings Page.
	=========================================================== 
*/
function book_details_options_page()
{ 
	global $book_options;
	$currencies = array('INR (₹)', 'USD ($)', 'EUR (€)', 'JPY (¥)'); ?>
	<div>
	<h2>
		<?php esc_html_e( 'Book Details Settings', 'books' ); ?>
	</h2>
	<?php  settings_errors(); ?>
	<form method="post" action="options.php">
	<?php settings_fields( 'book_details_options_group' ); ?>
	<table>
		<tr align="left">
			<th>
	  			<label for="book_settings[currency]"><?php esc_html_e( 'Currency', 'books' ); ?>:</label>
	  		</th>
	  		<td>
				<select name="book_settings[currency]" id="book_settings[currency]">
					<?php 
					 $selected_currency = esc_attr( $book_options[ 'currency' ] );
					foreach ($currencies as $currency) 
			  		{
			  				if ( $selected_currency != $currency )
			  				{
			  					echo '<option value="' . $currency . '">' . $currency . '</option>'; 
			  				}
			  				else
			  				{
			  					echo '<option selected value="' . $currency . '">' . $currency . '</option>';
			  				}
			  				
			   		} ?>
				</select>	
			</td>
	  	</tr>

	  	<tr align="left">
  			<th>
  				<label for="book_settings[page]">
  					<?php esc_html_e( 'Display', 'books' ); ?></label>
  			</th>
  			<td>	
  				<?php $page =  esc_attr( $book_options['page'] ) ; ?>
  				<input id="book_settings[page]" type="number" name="book_settings[page]" min="1" max="50" step="1" value= "<?php echo $page; ?>"/>
  				<?php esc_html_e( 'Books per page', 'books' ); 
  				?>
  			</td>
  		</tr>
	</table>
	<p class="submit">
		<input type="submit" name="submit" class="button-primary" value="<?php _e('Save','setting_domain') ?>"/>
	</p>
	</form>
</div>	
<?php 
} 
/*
	===========================================================
 			Limit Posts per page.
	=========================================================== 
*/
function limit_posts_per_archive_page() 
{
	global $book_options;
	if ( is_archive () && !is_admin() )
		$limit = $book_options['page'];
	elseif ( is_admin() )
	 	$limit = get_option( 'per_page' );
	else		
	 	$limit = get_option('posts_per_page');
	set_query_var('posts_per_archive_page', $limit);
}
add_filter('pre_get_posts', 'limit_posts_per_archive_page');
?>
<?php
/*
	===========================================================
 			Short Code.
	=========================================================== 
*/
function book_shortcode( $args ) 
{
	global $book_options;
	$the_query = new WP_Query( $args );
	 	$all_info = get_metadata( 'bookdetail', get_the_id(), '_book_detail_key' )[0];
	 	$id = get_the_ID();
	 	$category = wor_get_terms( get_the_ID(), 'book-category' );
		$tag = wor_get_terms( get_the_ID(), 'book-tag' );
		return 	'<p>
		 	<b>ID</b> : ' . $id . '<br>
		 	<b>Author</b> : ' . $all_info[ 'author_name' ] . '<br>
		 	<b>Publisher</b> : ' . $all_info[ 'publisher' ] . '<br>
		 	<b>Year</b> : ' . $all_info[ 'year' ] . '<br>
		 	<b>Price</b> : ' . $all_info[ 'price' ] . ' ' . $book_options[ 'currency' ] . '<br>
		 	<b>Category</b> : ' . $category . '<br>
 			<b>Tag</b> : ' . $tag . ' <br>
		 	<b>Buy</b> : ' . '<a href="' . $all_info[ 'buyurl' ] . '">' . 'Go to Shop' . '</a> <br> 
		 	 
		  	</p>';
}
function wor_get_terms( $postID, $term )
{
	$terms_list = wp_get_post_terms($postID, $term);
	$output = '';
	$i = 0;
	foreach( $terms_list as $term )
	{
		$i++;
		if( $i > 1)
		{
			$output .= ' | ';
		}
		$output .= '<a href="'. get_term_link( $term ) . '">'. $term->name .'</a>';
	}
	return $output;
}
?>
<?php
/*
	===========================================================
 			Render Custom Dashboard Widget.
	=========================================================== 
*/
function dashboard_widget_function() 
{ 
	$categories = get_terms( array(
    	'taxonomy'	=> 'book-category',
        'orderby'	=> 'count',
        'order' 	=> 'DES',
        'hide_empty' => false,
        'number' 	=> 5,
    ) );

	if ( ! empty( $categories ) ) : ?>
        <p class="book_dashboard">
            <span>
            	<b>
            		<?php esc_html_e( 'Category Name', 'books' ); ?>
            	</b>
            </span>
            <span>
            	<b>
            		<?php esc_html_e( 'Count', 'books' ); ?>
           		</b>
           	</span>
        </p>
        
        <ul class="book_dashboard_list">
	        <?php
	        foreach ( $categories as $category ) 
	        	{ 
	        		?>
	            <li>
	            	<a href="<?php echo get_category_link( $category->term_id ); ?>" 
	                alt="<?php echo $category->name; ?>">
	                	<?php echo $category->name; ?>
	                </a>
	                <span>
	                	<?php echo $category->count; ?>
	                </span>
	            </li>
	      <?php } ?>
        </ul>
    
	<?php else :  ?>
        <p>
        	<?php esc_html_e( 'To see your Top 5 Book Categories add a category to your book!', 'books' ); ?>
       	</p>
    <?php endif;
}