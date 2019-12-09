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
