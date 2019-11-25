<?php

function reen_redux_change_portfolio_view( $view ) {
    global $reen_options;

    if ( isset( $reen_options['portfolio_view'] ) ) {
        $view = $reen_options['portfolio_view'];
    }

    return $view;
}
function reen_redux_change_portfolio_grid_columns( $columns ) {
    global $reen_options;

    if ( isset( $reen_options['portfolio_grid_columns'] ) ) {
        $columns = $reen_options['portfolio_grid_columns'];
    }

    return $columns;
}

function reen_redux_change_portfolio_page_title( $title ) {
    global $reen_options;

    if ( isset( $reen_options['reen_portfolio_page_title'] ) ) {
        $title = $reen_options['reen_portfolio_page_title'];
    }

    return $title;
}

function reen_redux_change_portfolio_page_description( $description ) {
    global $reen_options;

    if ( isset( $reen_options['reen_portfolio_page_description'] ) ) {
        $description = $reen_options['reen_portfolio_page_description'];
    }

    return $description;
}

if ( ! function_exists( 'reen_redux_apply_portfolio_posts_per_page' ) ) {
    function reen_redux_apply_portfolio_posts_per_page( $posts_per_page ) {
        global $reen_options;

        if ( isset( $reen_options['reen_portfolio_posts_per_page'] ) ) {
            $posts_per_page = intval( $reen_options['reen_portfolio_posts_per_page'] );
        }

        return $posts_per_page;
    }
}