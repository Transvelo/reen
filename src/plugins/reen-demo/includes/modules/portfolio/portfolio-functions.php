<?php
/**
 * Portfolio Functions used in Demo
 * 
 * @package reen-demo
 */  

if ( ! function_exists( 'reen_demo_override_posts_per_page' ) ) {
    function reen_demo_override_posts_per_page( $query ) {
        if ( is_tax( 'portfolio-tags', 'grid' ) ){
            $query->set( 'posts_per_page', 2 );  
        }
    }
}

