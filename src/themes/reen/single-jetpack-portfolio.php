<?php
/**
 * The template for displaying all single posts.
 *
 * @package reen
 */

get_header(); ?>
<div id="primary" class="content-area">
		<main id="main" class="site-main"><?php
	        do_action( 'reen_before_portfolio' );
	                
	        while ( have_posts() ) :
	            the_post();

	            do_action( 'reen_portfolio_single_post_before' );

	            $post_format     = 'video';

	            // $post_format     = get_post_format();
	            // $portfolio_style = get_post_meta( get_the_ID(), 'portfolio_style', true );
	            // $portfolio_style = empty( $portfolio_style ) ? 'image-2' : $portfolio_style ;
	            

	            if ( 'audio' === $post_format || 'video' === $post_format ) {
	                    get_template_part( 'templates/portfolio/content',  $post_format . '-portfolio-single' );

	            } elseif ( 'slider-1' === $portfolio_style || 'slider-2' === $portfolio_style || 'image-1' === $portfolio_style || 'image-2' === $portfolio_style) {
	                    get_template_part( 'templates/portfolio/content',  $portfolio_style . '-portfolio-single' );        
	            }

	            do_action( 'reen_portfolio_single_post_after' );

	        endwhile; // End of the loop.
	        do_action( 'reen_after_portfolio' );  ?>


<?php
get_footer();