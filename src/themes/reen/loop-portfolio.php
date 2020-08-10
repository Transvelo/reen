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

        $reen_portfolio_view = reen_get_portfolio_view();

        if ( $reen_portfolio_view == 'grid-detail' ) {
            $reen_slug = 'portfolio-detail';
        } else {
            $reen_slug = 'portfolio';
        }

        /**
         * Include the Post-Format-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
         */

        get_template_part( 'templates/portfolio/content', $reen_slug );

    endwhile;
    /**
     * Functions hooked in to reen_paging_nav action
     *
     * @hooked reen_paging_nav - 10
     */
    do_action( 'reen_loop_portfolio_after' );
    ?>
</section>