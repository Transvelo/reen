<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package REEN
 */

?>

	</div><!-- #content -->

	<footer class="dark-bg">
        <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
        <div class="container inner">
            <div class="row">
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                <div class="col-lg-3 col-md-6 inner">
            	<?php if (current_theme_supports('custom-logo') && has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
                <?php else : ?> 
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-white.svg" class="logo img-intext" alt="<?php bloginfo( 'name' ); ?>" height="40px" /></a>
                <?php endif; ?>
                <?php dynamic_sidebar( 'footer-1' ); ?>
                </div>
                <?php endif; ?>

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
        <?php endif; ?>
	<footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>