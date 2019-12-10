<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package REEN
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'reen' ); ?></a>

    <header>
        <div class="navbar">
             <div class="navbar-header">
                <div class="container">  
                <?php if ( apply_filters( 'reen_topbar_view', true ) ):             
                    if ( apply_filters( 'reen_topbar_left', true ) && has_nav_menu( 'topbar_left' ) ) {
                        wp_nav_menu( array(
                            'theme_location' => 'topbar_left',
                            'menu_id'        => 'top-left-menu',
                            'container'      => false,
                            'depth'          => 1,
                            'menu_class'     => 'info',
                            'walker'         => new Reen_Topbar_Walker(),
                        ) );
                    }
                    if ( apply_filters( 'reen_topbar_right', true ) && has_nav_menu( 'topbar_right' ) ) {
                        wp_nav_menu( array(
                            'theme_location' => 'topbar_right',
                            'menu_id'        => 'top-right-menu',
                            'container'    => false,
                            'menu_class'     => 'social',
                            'icon_class'   => array( 'btn-icon__inner' ),
                            'item_class'   => array( 'list-inline-item' ),
                            'depth'        => 0,
                            'walker'         => new Reen_SocialMedia_Walker(),
                        ) );
                    }
                 endif; 
                    if (current_theme_supports('custom-logo') && has_custom_logo() ) {
                           the_custom_logo(); 
                        } elseif ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
                            jetpack_the_site_logo();
                        } elseif ( apply_filters( 'reen_site_logo_svg', false ) ) { ?>
                           <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" class="logo animate" alt="<?php bloginfo( 'name' ); ?>" style="height: 40px" /></a><?php
                        } else {
                            echo '<span class="logo-text navbar-brand">';
                            ?>
                            <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                            <?php if ( '' != get_bloginfo( 'description' ) ) : ?>
                                <p class="site-description sr-only"><?php bloginfo( 'description' ); ?></p>
                            <?php endif;
                            echo '</span>';
                        }

                        if( apply_filters( 'reen_handheld_offcanvas_menu', true ) ) : ?>
                        <a class="navbar-toggler btn responsive-menu float-right" data-toggle="collapse" data-target=".navbar-collapse"><i class='<?php echo esc_attr( apply_filters( 'reen_handheld_offcanvas_menu_icon_class', 'icon-menu-1' ) ); ?>'></i></a>
               
                </div>
            </div>
            <?php endif ?>
            <div class="yamm">
                <div class="navbar-collapse collapse">
                   <div class="container">
                        <?php if (current_theme_supports('custom-logo') && has_custom_logo() ) {
                           the_custom_logo(); 
                        } elseif ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
                            jetpack_the_site_logo();
                        } elseif ( apply_filters( 'reen_site_logo_svg', false ) ) { ?>
                           <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" class="logo animate" alt="<?php bloginfo( 'name' ); ?>" style="height: 40px" /></a><?php
                        } else {
                            echo '<span class="logo-text navbar-brand">';
                            ?>
                            <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                            <?php if ( '' != get_bloginfo( 'description' ) ) : ?>
                                <p class="site-description sr-only"><?php bloginfo( 'description' ); ?></p>
                            <?php endif;
                            echo '</span>';
                        }

                        wp_nav_menu( array(
                            'theme_location'     => 'primary',
                            'depth'              => 0,
                            'container'          => false,
                            'menu_class'         => 'nav navbar-nav',
                            'fallback_cb'        => 'WP_Bootstrap_Navwalker::fallback',
                            'walker'             => new WP_Bootstrap_Navwalker(),
                        ) );
                       ?>
                    </div><!-- #site-navigation -->
                </div>
            </div>
        </div><!-- .site-branding -->
    </header><!-- #masthead -->