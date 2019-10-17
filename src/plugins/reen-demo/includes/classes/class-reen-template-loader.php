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
        add_action( 'init', array( __CLASS__, 'rewrite_portfolio_rule' ), 10, 0 );
        add_filter( 'reen_portfolio_view', array( __CLASS__, 'portfolio_view_loader' ), PHP_INT_MAX );
        add_filter( 'reen_portfolio_grid_columns', array( __CLASS__, 'portfolio_grid_columns_loader' ), PHP_INT_MAX );
        add_filter( 'reen_portfolio_page_title', array( __CLASS__, 'portfolio_page_title_loader' ), PHP_INT_MAX );
    }

    public static function rewrite_portfolio_rule() {
        add_rewrite_rule( '^portfolio/3-columns-grid-detail?', 'index.php?post_type=jetpack-portfolio&portfolio-view=grid-detail&grid-columns=3&portfolio-title=3 Columns details grid portfolio','top' );
        add_rewrite_rule( '^portfolio/4-columns-grid-detail?', 'index.php?post_type=jetpack-portfolio&portfolio-view=grid-detail&grid-columns=4&portfolio-title=4 Columns details grid portfolio','top' );
        add_rewrite_rule( '^portfolio/4-columns-grid?', 'index.php?post_type=jetpack-portfolio&portfolio-view=grid&grid-columns=4&portfolio-title=4 Columns grid portfolio','top' );
        add_rewrite_rule( '^portfolio/3-columns-grid?', 'index.php?post_type=jetpack-portfolio&portfolio-view=grid&grid-columns=3&portfolio-title=3 Columns grid portfolio','top' );
        add_rewrite_rule( '^portfolio/fullscreen?', 'index.php?post_type=jetpack-portfolio&portfolio-view=fullscreen&portfolio-title=Fullscreen grid portfolio','top' );
        
    }

    public static function add_query_vars_filter( $vars ){
        $vars[] = "portfolio-view";
        $vars[] = "grid-columns";
        $vars[] = "portfolio-title";
        return $vars;
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

}

Reen_Template_Loader::init();