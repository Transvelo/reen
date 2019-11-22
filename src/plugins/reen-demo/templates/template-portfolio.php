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

global $wp_query;

$_wp_query        = $wp_query;
$portfolio_view   = ( get_query_var( 'portfolio-view') ) ? get_query_var( 'portfolio-view' ) : 'grid';
$portfolio_tag    = $portfolio_view;
$wp_query         = new WP_Query( array( 
    'post_type'        => 'jetpack-portfolio', 
    'paged'            => $paged, 
    'posts_per_page'   => 16,
    'portfolio-view'   => $portfolio_view,
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