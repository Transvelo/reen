<?php
/**
 * Portfolio Functions used in Demo
 * 
 * @package reen-demo
 */  

if ( ! function_exists( 'reen_demo_override_posts_per_page' ) ) {
    function reen_demo_override_posts_per_page( $query ) {
        if ( get_term_by( 'name', 'grid' ); ) {
            $query->set( 'posts_per_page', 2 );  
        }

        if ( in_the_loop() && is_category( 'blog-modern' ) ) {
            $query->set( 'posts_per_page', 11 );
        }
    }
}