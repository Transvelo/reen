<?php
/**
 * The template used for displaying projects on index view
 *
 * @package reen
 */
?>
<li id="portfolio-<?php the_ID(); ?>" <?php post_class( 'item thumb' ); ?>>
    <figure>
        <?php 
        /**
         * Functions hooked into reen_loop_porfolio
         *
         */
        do_action( 'reen_loop_portfolio_detail' );
        ?>
    </figure>
</li>