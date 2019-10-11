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
                    wp_nav_menu( array(
                        'theme_location' => 'topbar_left',
                        'menu_id'        => 'top-left-menu',
                        'menu_class'     => 'info',
                        'walker'         => new Reen_Topbar_Walker(),
                    ) );
                    ?>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'topbar_right',
                        'menu_id'        => 'top-right-menu',
                        'menu_class'     => 'social',
                        'walker'         => new Reen_SocialMedia_Walker(),
                    ) );
                    ?>
                </div>
            </div>
            <div class="site-branding navbar-collapse collapse animate affix-top">
               <div class="container">
                   <a class="navbar-brand" href="index.html"><img src="assets/images/logo.svg" class="logo animate" alt="" style="height: 40px;"></a>
                   <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'navbar-nav u-header__navbar-nav',
                        'walker'         => new WP_Bootstrap_Navwalker(),
                    ) );
                    ?>
               </div>
            </div><!-- .site-branding -->

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'reen' ); ?></button>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                ) );
                ?>
            </nav><!-- #site-navigation -->
        </div>
    </header><!-- #masthead -->

    <div id="content" class="site-content">
