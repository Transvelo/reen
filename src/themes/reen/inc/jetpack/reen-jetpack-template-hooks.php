<?php
/**
 * REEN hooks
 *
 * @package REEN
 */

/**
* Portfolio
*/
add_action( 'reen_loop_portfolio_before', 'reen_portfolio_header', 10 );
add_action( 'reen_loop_portfolio_before', 'reen_loop_portfolio_wrap_start', 40 );

add_action( 'reen_loop_portfolio', 'reen_portfolio_figcaption', 10 );
add_action( 'reen_loop_portfolio', 'reen_portfolio_thumbnail',  20 );


add_action( 'reen_loop_portfolio_detail', 'reen_portfolio_icon_overlay',        10 );
add_action( 'reen_loop_portfolio_detail', 'reen_portfolio_detail_figcaption',   10 );
add_action( 'reen_loop_portfolio_after',   'reen_loop_portfolio_wrap_end',      10 );
