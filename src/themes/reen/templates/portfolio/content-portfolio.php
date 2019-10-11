<?php
/**
 * The template used for displaying projects on index view
 *
 * @package reen
 */
?>
<li id="portfolio-<?php the_ID(); ?>" <?php post_class( 'item thumb' ); ?>>
    <a href="<?php echo esc_url( get_permalink() ); ?>">
        <figure>
        	<?php 
            /**
             * Functions hooked into reen_loop_porfolio
             *
             */
            do_action( 'reen_loop_portfolio' );
            ?>
        </figure>
    </a>
</li>