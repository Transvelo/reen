<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Template Loader
 *reen_post_author_bio
 * @class       WC_Template
 * @version     1.0.0
 * @package     Reen
 * @category    Class
 * @author      MadrasThemes
 */

class Reen_Template_Loader {

    /**
     * Hook in methods.
     */
    public static function init() {
        add_filter( 'query_vars', array( __CLASS__, 'add_query_vars_filter' ) );
        //add_filter( 'template_include', array( __CLASS__, 'template_loader' ) );
        add_action( 'init', array( __CLASS__, 'rewrite_portfolio_rule' ), 10, 0 );
        add_action( 'init', array( __CLASS__, 'rewrite_blog_rule' ), 10, 0 );
        // add_filter( 'reen_portfolio_view', array( __CLASS__, 'portfolio_view_loader' ), PHP_INT_MAX );
        add_filter( 'reen_portfolio_grid_columns', array( __CLASS__, 'portfolio_grid_columns_loader' ), PHP_INT_MAX );
        add_filter( 'reen_portfolio_page_title', array( __CLASS__, 'portfolio_page_title_loader' ), PHP_INT_MAX );

        add_filter( 'reen_blog_style', array( __CLASS__, 'blog_style_loader' ), PHP_INT_MAX );
        add_filter( 'reen_blog_layout', array( __CLASS__, 'blog_layout_loader' ), PHP_INT_MAX );
        add_filter( 'reen_blog_grid_columns', array( __CLASS__, 'blog_grid_columns_loader' ), PHP_INT_MAX );
        add_filter( 'reen_single_post_layout', array( __CLASS__, 'single_post_layout_loader' ), PHP_INT_MAX );
        
    }

    public static function add_query_vars_filter( $vars ){
        $vars[] = "portfolio-view";
        $vars[] = "grid-columns";
        $vars[] = "portfolio-title";
        $vars[] = "blog_style";
        $vars[] = "blog_layout";
        $vars[] = "blog_grid_columns";
        $vars[] = "single_blog_layout";
        return $vars;
    }

    public static function rewrite_portfolio_rule() {
        add_rewrite_rule( '^portfolio/3-columns-grid-detail?', 'index.php?post_type=jetpack-portfolio&portfolio-view=grid-detail&grid-columns=3&portfolio-title=3 Columns details grid portfolio','top' );
        add_rewrite_rule( '^portfolio/4-columns-grid-detail?', 'index.php?post_type=jetpack-portfolio&portfolio-view=grid-detail&grid-columns=4&portfolio-title=4 Columns details grid portfolio','top' );
        add_rewrite_rule( '^portfolio/4-columns-grid?', 'index.php?post_type=jetpack-portfolio&portfolio-view=grid&grid-columns=4&portfolio-title=4 Columns grid portfolio','top' );
        add_rewrite_rule( '^portfolio/3-columns-grid?', 'index.php?post_type=jetpack-portfolio&portfolio-view=grid&grid-columns=3&portfolio-title=3 Columns grid portfolio','top' );
        add_rewrite_rule( '^portfolio/fullscreen?', 'index.php?post_type=jetpack-portfolio&portfolio-view=fullscreen&portfolio-title=Fullscreen grid portfolio','top' );
        
    }

    public static function rewrite_blog_rule() {
        
        add_rewrite_rule( '^blog/sidebar-right?', 'index.php?post_type=post&blog_style=classic-blog&blog_layout=sidebar-right','top' );
        add_rewrite_rule( '^blog/sidebar-left?', 'index.php?post_type=post&blog_style=classic-blog&blog_layout=sidebar-left','top' );
        add_rewrite_rule( '^blog/without-sidebar?', 'index.php?post_type=post&blog_style=classic-blog&blog_layout=no-sidebar','top' );
        add_rewrite_rule( '^blog/2-columns-grid-sidebar-right?', 'index.php?post_type=post&blog_style=grid-blog&blog_layout=sidebar-right&blog_grid_columns=2','top' );
        add_rewrite_rule( '^blog/2-columns-grid-sidebar-left?', 'index.php?post_type=post&blog_style=grid-blog&blog_layout=sidebar-left&blog_grid_columns=2','top' );
        add_rewrite_rule( '^blog/2-columns-grid-without-sidebar?', 'index.php?post_type=post&blog_style=grid-blog&blog_layout=no-sidebar&blog_grid_columns=2','top' );
        add_rewrite_rule( '^blog/3-columns-grid-without-sidebar?', 'index.php?post_type=post&blog_style=grid-blog&blog_layout=no-sidebar&blog_grid_columns=3','top' );

        add_rewrite_rule( '^blog/single-post-sidebar-right?', 'index.php?post_type=post&single_blog_layout=sidebar-right','top' );
        add_rewrite_rule( '^blog/single-post-sidebar-left?', 'index.php?post_type=post&single_blog_layout=sidebar-left','top' );
        add_rewrite_rule( '^blog/single-post-without-sidebar?', 'index.php?post_type=post&single_blog_layout=no-sidebar','top' );
        
    }

    public static function portfolio_view_loader( $view ) {

        $custom_view = isset( $_GET['portfolio-view'] ) ? sanitize_text_field( $_GET['portfolio-view'] ) : '';

        if ( empty( $custom_view ) ) {
            $custom_view = get_query_var( 'portfolio-view' );
        }

        switch( $custom_view ) {
            case 'grid':
            case 'grid-detail':
            case 'fullscreen':
                $view = $custom_view;
            break;
            default: 
                $view = $view;
        }

        return $view;
    }

     public static function template_loader( $template ) {
        if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
            $template = REEN_DEMO_DIR . '/templates/template-portfolio.php';
        }

        return $template;
    }

    public static function portfolio_grid_columns_loader ( $columns ) {
 
        $custom_columns = isset( $_GET['grid-columns'] ) ? sanitize_text_field( $_GET['grid-columns'] ) :'';

        if ( empty( $custom_columns ) ) {
            $custom_columns = get_query_var( 'grid-columns' );
        }

        switch( $custom_columns ) {
            case '3':
            case '4':
               $columns = $custom_columns;
          break;
            default: 
                $columns = $columns;
        }

        return $columns;
    }

    public static function portfolio_page_title_loader( $title ) {

        $custom_view = isset( $_GET['portfolio-title'] ) ? sanitize_text_field( $_GET['portfolio-title'] ) : '';

        if ( empty( $custom_title ) ) {
            $custom_title = get_query_var( 'portfolio-title' );
        }

        switch( $custom_title ) {
            case '3 Columns grid portfolio':
            case '3 Columns details grid portfolio':
            case '4 Columns grid portfolio':
            case '4 Columns details grid portfolio':
            case 'Fullscreen grid portfolio':
                $title = $custom_title;
            break;
            default: 
                $title = $title;
        }

        return $title;
    }

    public static function blog_style_loader( $style) {

        $custom_style = isset( $_GET['blog_style'] ) ? sanitize_text_field( $_GET['blog_style'] ) : '';

        if ( empty( $custom_style ) ) {
            $custom_style = get_query_var( 'blog_style' );
        }


        switch( $custom_style ) {
            case 'classic-blog':
            case 'grid-blog':
                $style = $custom_style;
            break;
            default: 
                $style = $style;
        }

        return $style;
    }

    public static function blog_layout_loader( $layout ) {
 
        $custom_layout = isset( $_GET['blog_layout'] ) ? sanitize_text_field( $_GET['blog_layout'] ) : '';

        if ( empty( $custom_layout ) ) {
            $custom_layout = get_query_var( 'blog_layout' );
        }

        switch( $custom_layout ) {
            case 'no-sidebar':
            case 'sidebar-right':
            case 'sidebar-left':
                $layout = $custom_layout;
            break;
            default: 
                $layout = $layout;
        }

        return $layout;
    }

    public static function blog_grid_columns_loader ( $columns ) {
 
        $custom_columns = isset( $_GET['blog_grid_columns'] ) ? sanitize_text_field( $_GET['blog_grid_columns'] ) :'';

        if ( empty( $custom_columns ) ) {
            $custom_columns = get_query_var( 'blog_grid_columns' );
        }

        switch( $custom_columns ) {
            case '2':
            case '3':
            case '1':
               $columns = $custom_columns;
          break;
            default: 
                $columns = $columns;
        }

        return $columns;
    }

    public static function single_post_layout_loader( $layout ) {
       
        if( is_singular( 'post' ) ) {
            $single_layout = isset( $_GET['single_blog_layout'] ) ? sanitize_text_field( $_GET['single_blog_layout'] ) : '';

            if ( empty( $single_layout ) ) {
                $single_layout = get_query_var( 'single_blog_layout' );
            }

            switch( $single_layout ) {
                case 'sidebar-left':
                case 'sidebar-right':
                case 'no-sidebar':
                    $layout = $single_layout;
                break;
                default: 
                    $layout = $layout;
            }
        }

        return $layout;
    } 

}

Reen_Template_Loader::init();