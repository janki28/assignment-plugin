<?php 
/*
    ===========================================================
            Custom Category Widget.
    =========================================================== 
*/
class Books_Widget extends WP_Widget 
{
    public function __construct() 
    {
        $options = array(
            'classname'     => 'custom_book_category_widget',
            'description'   => 'Custom Book Category',
        );
        parent::__construct(
            'category_widget', 'Book Category', $options
        );
    }
    
    public function widget( $args, $instance ) 
    {
        echo $args[ 'before_widget' ];
        $title = apply_filters( 'widget_title', $instance[ 'title' ] );
        // Define the widget
    ?>
        <h2 class="widget-title">
                <?php
                    if ( isset( $instance[ 'title' ] ) ) 
                    {
                        $title = $instance[ 'title' ];
                    } 
                    else 
                    {
                        $title = 'Book Category';
                    }
                    echo $title;
                ?>
        </h2>
        <?php
        if ( ! empty( $instance[ 'selected_categories' ] ) && is_array( $instance[ 'selected_categories' ] ) )
        { 
            
            $posts = get_posts( array( 
                'post_type'   => 'books',
                'post_status' => 'publish',
                'numberposts' => 5,
                'tax_query'   => array(
                                        array(
                                          'taxonomy' => 'book-category',
                                          'field'    => 'term_id', 
                                          'terms'    => $instance[ 'selected_categories' ],
                                        )
                                )
                    ) 
                );
                        
            ?>
            
            <ul>
                <?php foreach ( $posts as $post ) 
                    { ?>
                        <li>
                            <a href="<?php echo get_permalink( $post->ID ); ?>">
                                <?php echo $post->post_title; ?>
                            </a>
                        </li>       
              <?php } ?>
            </ul>
            <?php 
            
        }
        else
        {
            echo esc_html__( 'No categories selected!', 'text_domain' ); 
        }

        echo $args['after_widget'];
    }
    
    public function form( $instance ) 
    {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
            <br>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <?php
        $categories = get_terms( 
                                array(
                                'taxonomy'   => 'book-category',
                                'hide_empty' => false,
                                ) 
                            );
        ?>
        
        <p>
            <?php esc_html_e('Choose which categories to show', 'books' ); ?>: 
        </p>
        
        <?php
            if ( isset( $instance[ 'selected_categories' ] ) ) 
            {
                $selected_categories = $instance[ 'selected_categories' ];
            } 
            else 
            {
                $selected_categories = array();
            }
        ?>
    <ul>
    <?php foreach ( $categories as $category ) 
        { ?>

        <li>
            <input type="checkbox" id="<?php echo $this->get_field_id( 'selected_categories' ); ?>[<?php echo $category->term_id; ?>]" name="<?php echo esc_attr( $this->get_field_name( 'selected_categories' ) ); ?>[]" value="<?php echo $category->term_id; ?>" 
                <?php checked( ( in_array( $category->term_id, $selected_categories ) ) ? $category->term_id : '', $category->term_id ); ?> />
            
            <label for="<?php echo $this->get_field_id( 'selected_categories' ); ?>[<?php echo $category->term_id; ?>]">
                <?php echo $category->name; ?> (<?php echo $category->count; ?>)
            </label>
        </li>

    <?php } ?>
    </ul>
    <?php
    }
      
    public function update( $new_instance, $old_instance ) 
    {
        $instance = array();
        $instance['title'] = (! empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
            
        $selected_categories = (! empty( $new_instance[ 'selected_categories' ] ) ) ? (array) $new_instance['selected_categories'] : array();
        $instance[ 'selected_categories' ] = array_map( 'sanitize_text_field', $selected_categories );
    
        return $instance;
    }
}
?>