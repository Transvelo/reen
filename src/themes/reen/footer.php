<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package reen
 */
?>

    <footer class="dark-bg site-footer">
        <div class="container inner">
            <div class="row">
                <div class="col-lg-3 col-md-6 inner">
                    <?php reen_footer_site_title(); ?>
                    <?php if( apply_filters( 'reen_footer_logo', true  ) ):
                        reen_footer_logo(); 
                     endif; ?>
                    <?php reen_footer_site_description(); ?>
                    <?php dynamic_sidebar( 'footer-1' ); ?>
                </div>

                <?php if ( is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
                    <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                        <div class="col-lg-3 col-md-6 inner">
                            <?php dynamic_sidebar( 'footer-2' ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                        <div class="col-lg-3 col-md-6 inner">
                            <?php dynamic_sidebar( 'footer-3' ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                        <div class="col-lg-3 col-md-6 inner">
                            <?php dynamic_sidebar( 'footer-4' ); ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container inner clearfix">
                <?php reen_footer_bottom_bar(); ?>
                <?php
                    wp_nav_menu( array(
                        'theme_location'     => 'footer_menu',
                        'depth'              => 0,
                        'container'          => false,
                        'menu_class'         => 'footer-menu float-right',
                        'fallback_cb'        => 'WP_Bootstrap_Navwalker::fallback',
                        'walker'             => new WP_Bootstrap_Navwalker(),
                    ) );
                ?>
            </div>
        </div>
    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>