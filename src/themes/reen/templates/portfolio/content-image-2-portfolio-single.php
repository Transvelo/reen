<?php
/**
 * Template used to display post content on single pages.
 *
 * @package reen
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'article' ); ?>>
    <?php do_action( 'reen_portfolio_single_post_image_2_before' );?>
    <section id="portfolio-post">
        <div class="container inner-top-md">
        <?php

        do_action( 'reen_portfolio_single_post_image_2_top' );
        /**
        * Functions hooked into reen_single_portfolio_image add_action
        *     
        * @hooked reen_portfolio_post_image-2 
        * @hooked reen_portfolio_post_image-2_content        
        */
        do_action( 'reen_portfolio_single_image_2' );

        /**
        * Functions hooked in to reen_single_post_bottom action
        * @hooked 
        */
        do_action( 'reen_portfolio_single_post_image_2_bottom' );
        ?>
        
        </div><?php
        do_action( 'reen_portfolio_single_post_image_2_after' );
        ?>
    </section>
</article>