<?php
/**
 * Template used to display post content on single pages.
 *
 * @package reen
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'article' ); ?>>
    <div class="container inner-top-md"><?php

        do_action( 'reen_portfolio_single_post_top' );
    
        do_action( 'reen_portfolio_single_post' );

        do_action( 'reen_portfolio_single_post_bottom' );
        ?>
    </div>
</article>
