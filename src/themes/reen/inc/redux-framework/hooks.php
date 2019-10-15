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

add_filter( 'reen_portfolio_page_title', 'reen_redux_change_portfolio_page_title'      );
add_filter( 'reen_portfolio_page_description', 'reen_redux_change_portfolio_page_description'    );

/**
 * Header Filters
 */
add_filter( 'reen_topbar_view', 'redux_toggle_topbar_view'      );
add_filter( 'reen_topbar_right', 'redux_toggle_topbar_right'    );
add_filter( 'reen_topbar_left', 'redux_toggle_topbar_left'      );
add_filter( 'reen_site_logo_svg',  'redux_toggle_logo_svg'      );