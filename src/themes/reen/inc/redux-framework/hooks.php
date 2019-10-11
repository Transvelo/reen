<?php
/**
 * Redux Framworks hooks
 *
 * @package REEN/ReduxFramework
 */

add_action( 'init',                            'reen_remove_demo_mode_link' );
add_action( 'redux/loaded',                    'reen_redux_disable_dev_mode_and_remove_admin_notices'                   );
add_action( 'redux/page/reen_options/enqueue', 'redux_queue_font_awesome'   );

/**
 * Portfolio Hooks
 */
add_filter( 'reen_portfolio_view', 'reen_redux_change_portfolio_view'      );
add_filter( 'reen_portfolio_grid_columns', 'reen_redux_change_portfolio_grid_columns'    );