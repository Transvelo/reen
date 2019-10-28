<?php
/**
 * The template for displaying the Portfolio archive page.
 *
 * @package front
 */
get_header();
?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main"><?php

            do_action( 'reen_before_portfolio' );
            
            if ( have_posts() ) {
            
                get_template_part( 'loop', 'portfolio' );

            } else {
                
                get_template_part( 'content', 'none' );
            
            }

            do_action( 'reen_after_portfolio' ); ?>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();