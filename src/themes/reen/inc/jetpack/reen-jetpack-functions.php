<?php
/**
 * REEN functions.
 *
 * @package REEN
 */
/**
 * Checks if Portfolio Module is activated
 *
 */
function reen_jp_is_portfolio_activated() {
    if ( class_exists( 'Jetpack_Portfolio' ) ) {
        $setting = Jetpack_Options::get_option_and_ensure_autoload( Jetpack_Portfolio::OPTION_NAME, '0' );    
    } else {
        return false;
    }
    
    return ( ! empty( $setting ) );
}

/**
 * Checks if Testimonial Module is activated
 *
 */
function reen_jp_is_testimonial_activated() {
    if ( class_exists( 'Jetpack_Testimonial' ) ) {
        $setting = Jetpack_Options::get_option_and_ensure_autoload( Jetpack_Testimonial::OPTION_NAME, '0' );    
    } else {
        return false;
    }
    
    return ( ! empty( $setting ) );
}

function reen_get_portfolio_view() {
    return apply_filters( 'reen_portfolio_view', 'grid-detail' );
}

function reen_get_portfolio_columns() {
    return apply_filters( 'reen_portfolio_grid_columns', '3' );
}

function reen_get_project_types( $portfolio_id ) {
    return get_the_term_list( $portfolio_id, 'jetpack-portfolio-type', '', ',' );
}

function reen_show_jetpack_share() {
    if ( function_exists( 'sharing_display' ) ) {
        sharing_display( '', true );
    }  
}

function reen_show_jetpack_likes() {
    if ( class_exists( 'Jetpack_Likes' ) ) {
        $custom_likes = new Jetpack_Likes;
        echo wp_kses_post ( $custom_likes->post_likes( '' ) );
    }
}

function reen_portfolio_set_posts_per_page( $query ) {
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( reen_jp_is_portfolio_activated() && is_post_type_archive( Jetpack_Portfolio::CUSTOM_POST_TYPE ) ) {
        $query->set( 'posts_per_page', apply_filters( 'reen_portfolio_posts_per_page', 16 ) );
        return;
    }
}

// Static Content Jetpack Share Remove
function reen_mas_static_content_jetpack_sharing_remove_filters() {
    if( function_exists( 'sharing_display' ) ) {
        remove_filter( 'the_content', 'sharing_display', 19 );
    }

    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}

add_action( 'mas_static_content_before_shortcode_content', 'reen_mas_static_content_jetpack_sharing_remove_filters' );

function reen_mas_static_content_jetpack_sharing_add_filters() {
    if( function_exists( 'sharing_display' ) ) {
        add_filter( 'the_content', 'sharing_display', 19 );
    }

    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
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

        if ( class_exists( 'Jetpack_Likes' ) ) {
            remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
        }
    }
}

add_action( 'reen_portfolio_single_post', 'reen_jetpack_sharing_remove_filters', 5 );
add_action( 'reen_single_post_before', 'reen_jetpack_sharing_remove_filters', 5 );