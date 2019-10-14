<?php
/**
 * Template used to display post content on single pages.
 *
 * @package reen
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'article' ); ?>>
    <section id="portfolio-post">
    <div class="container inner-top-md"><?php

        do_action( 'reen_portfolio_single_post_slider_1_top' );
        /**
         * Functions hooked into reen_single_portfolio_top add_action
         *
         * @hooked reen_portfolio_post_slider_row_open          
         * @hooked reen_portfolio_post_slider 
         * @hooked reen_portfolio_post_slider_content        
         * @hooked reen_portfolio_post_slider_row_close
         */
        do_action( 'reen_portfolio_single_slider_1' );

        /**
         * Functions hooked in to reen_single_post_bottom action
         * @hooked 
         */
        do_action( 'reen_portfolio_single_post_slider_1_bottom' );
        ?>
    </div>
</section>
</article>