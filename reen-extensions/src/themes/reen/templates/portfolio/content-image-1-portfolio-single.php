<?php
/**
 * Template used to display post content on single pages.
 *
 * @package reen
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'article' ); ?>>
    <section id="portfolio-post">
            <?php if ( has_post_thumbnail() ) : ?>
            <div class="img-bg height-sm border-bottom" style="background-image: url(<?php the_post_thumbnail_url(); ?>);" ></div>
            <?php endif; ?>
            <div class="container inner-top">
            <?php
            
            do_action( 'reen_portfolio_single_post_image_1_top' );
            
            /**
            * Functions hooked into reen_single_portfolio_image add_action
            *
            * @hooked reen_portfolio_post_image-1 
            * @hooked reen_portfolio_post_image-1_content        
            */
            do_action( 'reen_portfolio_single_image_1' );

            /**
            * Functions hooked in to reen_single_post_image action
            * @hooked 
            */
            do_action( 'reen_portfolio_single_post_image_1_bottom' );
            
            ?>
        </div>
    </section>
</article>