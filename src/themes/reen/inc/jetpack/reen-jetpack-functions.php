<?php
/**
 * REEN functions.
 *
 * @package REEN
 */


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
     
    if ( class_exists( 'Jetpack_Likes' ) ) {
        $custom_likes = new Jetpack_Likes;
        echo wp_kses_post ( $custom_likes->post_likes( '' ) );
    }
}

