<?php

// Register widgets.
function reen_widgets_register() {
    if ( class_exists( 'REEN' ) ) {
        include_once REEN_EXTENSIONS_DIR . '/includes/widgets/class-reen-random-posts-widget.php';
        register_widget( 'REEN_Random_Posts_Widget' );
        include_once REEN_EXTENSIONS_DIR . '/includes/widgets/class-reen-featured-posts-widget.php';
        register_widget( 'REEN_Featured_Posts_Widget' );
    }
}

add_action( 'widgets_init', 'reen_widgets_register' );

// Static Content Jetpack Share Remove
function reen_mas_static_content_jetpack_sharing_remove_filters() {
    if( function_exists( 'sharing_display' ) ) {
        remove_filter( 'the_content', 'sharing_display', 19 );
    }
}

add_action( 'mas_static_content_before_shortcode_content', 'reen_mas_static_content_jetpack_sharing_remove_filters' );

function reen_mas_static_content_jetpack_sharing_add_filters() {
    if( function_exists( 'sharing_display' ) ) {
        add_filter( 'the_content', 'sharing_display', 19 );
    }
}

add_action( 'mas_static_content_after_shortcode_content', 'reen_mas_static_content_jetpack_sharing_add_filters' );

// Jetpack
if ( ! function_exists( 'reen_jetpack_sharing_remove_filters' ) ) {
    function reen_jetpack_sharing_remove_filters() {
        if( function_exists( 'sharing_display' ) ) {
            remove_filter( 'the_content', 'sharing_display', 19 );
            remove_filter( 'the_excerpt', 'sharing_display', 19 );
        }
    }
}

add_action( 'reen_portfolio_single_post', 'reen_jetpack_sharing_remove_filters', 5 );
add_action( 'reen_single_post_before', 'reen_jetpack_sharing_remove_filters', 5 );


