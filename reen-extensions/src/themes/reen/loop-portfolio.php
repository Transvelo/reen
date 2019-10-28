<?php
/**
 * The loop template file for post type jetpack-portfolio.
 *
 * Included on pages like index.php, archive.php and search.php to display a loop of posts
 * Learn more: https://codex.wordpress.org/The_Loop
 *
 * @package reen
 */
?>
<section id="portfolio">
    <?php

    do_action( 'reen_loop_portfolio_before' );

    while ( have_posts() ) :
        
        the_post();

        $portfolio_view = reen_get_portfolio_view();

        if ( $portfolio_view == 'grid-detail' ) {
            $slug = 'portfolio-detail';
        } else {
            $slug = 'portfolio';
        }

        /**
         * Include the Post-Format-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
         */

        get_template_part( 'templates/portfolio/content', $slug );

    endwhile;
    /**
     * Functions hooked in to reen_paging_nav action
     *
     * @hooked reen_paging_nav - 10
     */
    do_action( 'reen_loop_portfolio_after' );
    ?>
</section>