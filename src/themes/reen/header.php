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
                    <?php
                    if ( has_nav_menu( 'topbar_left' ) ) {
                        wp_nav_menu( array(
                            'theme_location' => 'topbar_left',
                            'menu_id'        => 'top-left-menu',
                            'container'      => false,
                            'depth'          => 1,
                            'menu_class'     => 'info',
                            'menu_id'        => 'jumpToDropdown',
                            'items_wrap'     => '<div id="%1$s" class="%2$s" aria-labelledby="jumpToDropdownInvoker">%3$s</div>',
                            'walker'         => new Reen_Topbar_Walker(),
                        ) );
                    }
                    ?>
                    <?php
                    if ( has_nav_menu( 'topbar_right' ) ) {
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
                    ?>
                </div>
            </div>
            <div class="site-branding navbar-collapse collapse animate affix-top">
               <div class="container">
                   <a class="navbar-brand" href="index.html"><img src="assets/images/logo.svg" class="logo animate" alt="" style="height: 40px;"></a>
                   <?php
                   wp_nav_menu( array(
                        'theme_location'     => 'primary',
                        'depth'              => 0,
                        'container'          => false,
                        'menu_class'         => 'nav navbar-nav',
                        'fallback_cb'        => 'WP_Bootstrap_Navwalker::fallback',
                        'walker'             => new WP_Bootstrap_Navwalker(),
                    ) );
                   ?>
               </div>
            </div><!-- .site-branding -->
        </div>
    </header><!-- #masthead -->

    <div id="content" class="site-content">
