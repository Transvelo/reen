<?php
/**
 * Blog Functions used in Demo
 *
 * @package reen-demo
 */
if ( ! function_exists( 'reen_demo_override_random_posts_widget_query_args' ) ) {
    function reen_demo_override_random_posts_widget_query_args( $args ) {
        $args['post__in'] = array(32, 25, 22, 9, 59, 7 );
        //$args['post__in'] = array(1899, 1893 );
        return $args;
    }
}