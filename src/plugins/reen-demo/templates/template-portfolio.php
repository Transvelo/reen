<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package front
 */

add_filter( 'reen_portfolio_view', array( 'Reen_Template_Loader', 'portfolio_view_loader' ), PHP_INT_MAX );
add_filter( 'reen_portfolio_grid_columns', array( 'Reen_Template_Loader', 'portfolio_grid_columns_loader' ), PHP_INT_MAX );
add_filter( 'reen_portfolio_page_title', array( 'Reen_Template_Loader', 'portfolio_page_title_loader' ), PHP_INT_MAX );
add_filter( 'reen_portfolio_posts_per_page', array( 'Reen_Template_Loader', 'portfolio_posts_per_page_loader' ), PHP_INT_MAX );

global $wp_query;

$_wp_query        = $wp_query;
$portfolio_view   = ( get_query_var( 'portfolio-view') ) ? get_query_var( 'portfolio-view' ) : 'grid';
$grid_columns = ( get_query_var( 'grid-columns') ) ? get_query_var( 'grid-columns' ) : '3';
$portfolio_page = ( get_query_var( 'portfolio-post-per-page') ) ? get_query_var( 'portfolio-post-per-page' ) : '16';
$portfolio_title = ( get_query_var( 'portfolio-title') ) ? get_query_var( 'portfolio-title' ) : '3 Columns details grid portfolio';
$portfolio_tag    = $portfolio_view;
$wp_query         = new WP_Query( array( 
    'post_type'        => 'jetpack-portfolio', 
    'paged'            => $paged, 
    'posts_per_page'   => $portfolio_page,
    'portfolio-view'   => $portfolio_view,
    'grid-columns'     => $grid_columns,
    'portfolio-title'  => $portfolio_title,

    'tax_query' => array(
    	array(
    		'taxonomy' => 'jetpack-portfolio-tag',
    		'field'    => 'slug',
    		'terms'    => array( $portfolio_tag )
    	)
    )
) );

get_template_part( 'archive-jetpack-portfolio' );

wp_reset_postdata();
$wp_query = $_wp_query;

remove_filter( 'reen_portfolio_view', array( 'Reen_Template_Loader', 'portfolio_view_loader' ), PHP_INT_MAX );
remove_filter( 'reen_portfolio_grid_columns', array( 'Reen_Template_Loader', 'portfolio_grid_columns_loader' ), PHP_INT_MAX );
remove_filter( 'reen_portfolio_page_title', array( 'Reen_Template_Loader', 'portfolio_page_title_loader' ), PHP_INT_MAX );
remove_filter( 'reen_portfolio_posts_per_page', array( 'Reen_Template_Loader', 'portfolio_posts_per_page_loader' ), PHP_INT_MAX );

