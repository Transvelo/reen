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