<?php
/*-----------------------------------------------------------------------------------*/
/*  Featured Posts Widget Class
/*-----------------------------------------------------------------------------------*/
class REEN_Featured_Posts_Widget extends WP_Widget {

    public $defaults;

    public function __construct() {

        $widget_ops = array(
            'classname'     => 'reen_featured_posts_widget',
            'description'   => esc_html__( 'Display Featured Posts.', 'reen' )
        );

        parent::__construct( 'reen_featured_posts_widget', esc_html__( 'REEN Featured Posts', 'reen' ), $widget_ops );

        $defaults = apply_filters( 'reen_featured_posts_widget_default_args', array(
            'title'     => '',
            'number'    => 5,
            'show_date' => true
        ) );

        $this->defaults = $defaults;
    }

    public function widget( $args, $instance ) {

        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $instance = wp_parse_args( (array) $instance, $this->defaults );

        $featured_query = new WP_Query( array( 
            'post_type'           => 'post',
            'posts_per_page'      => $instance['number'],
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'post__in'            => get_option( 'sticky_posts' ),
            'ignore_sticky_posts' => 1,
        ));

        if ( ! $featured_query->have_posts() ) {
            return;
        }

        if ($featured_query->have_posts()) :

            echo wp_kses_post( $args['before_widget'] );

            if ( ! empty( $instance['title'] ) ) {
                echo wp_kses_post( $args['before_title'] . $instance['title'] . $args['after_title'] );
            }?>
            <?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?> 
                    <figure>
                        <div class="icon-overlay icn-link">    
                            <a href="<?php echo esc_url( get_the_permalink() ); ?>"><span class="icn-more"></span>
                                <?php if ( has_post_thumbnail() ) {
                                    the_post_thumbnail();
                                    } else { ?>
                                
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/art/work01.jpg" alt="" /> 
                                <?php } ?>   
                            </a>
                        </div>
                        <figcaption class="bordered no-top-border">
                            <div class="info">
                                <h4><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a></h4>
                                <?php $categories_list = get_the_category_list( esc_html__( ', ', 'reen' ) );
                                if ( $categories_list ) : ?>
                                    <span class="categories">
                                        <?php
                                        echo wp_kses_post( $categories_list );
                                        ?>
                                    </span>
                                <?php endif; // End if categories. ?>   
                            </div>
                        </figcaption>
                    </figure>                       
            <?php endwhile; ?>
            <?php
            echo wp_kses_post( $args['after_widget'] );
        endif;

            wp_reset_postdata();

    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title']          = strip_tags( $new_instance['title'] );
        $instance['number']         = strip_tags( $new_instance['number'] );

        return $instance;
    }

    public function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, $this->defaults );
        $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title', 'reen'); ?>:</label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'reen' ); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $instance['number'] ); ?>" size="3" />
        </p>
        <?php
        do_action( 'reen_random_posts_widget_add_opts', $this, $instance);
    }

}