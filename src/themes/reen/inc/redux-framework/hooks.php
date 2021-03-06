<?php
/**
 * Redux Framworks hooks
 *
 * @package REEN/ReduxFramework
 */

add_action( 'init',                            'reen_remove_demo_mode_link' );
add_action( 'redux/loaded',                    'reen_redux_disable_dev_mode_and_remove_admin_notices' );
add_action( 'redux/page/reen_options/enqueue', 'reen_redux_queue_font_awesome' );

/**
 * General Hooks
 */
add_filter( 'reen_enable_scrollup',             'reen_redux_toggle_scrollup' );

/**
 * Portfolio Hooks
 */
add_filter( 'reen_portfolio_view',              'reen_redux_change_portfolio_view' );
add_filter( 'reen_portfolio_grid_columns',      'reen_redux_change_portfolio_grid_columns' );

add_filter( 'reen_portfolio_page_title',        'reen_redux_change_portfolio_page_title' );
add_filter( 'reen_portfolio_page_description',  'reen_redux_change_portfolio_page_description' );
add_filter( 'reen_portfolio_posts_per_page',    'reen_redux_apply_portfolio_posts_per_page', 10 );


/**
 * Blog Hooks
 */
add_filter( 'reen_blog_style',              'reen_redux_change_blog_style' );
add_filter( 'reen_blog_layout',             'reen_redux_change_blog_layout' );
add_filter( 'reen_blog_grid_columns',       'reen_redux_change_grid_columns' );
add_filter( 'reen_single_post_layout',      'reen_redux_change_single_blog_layout' );
add_filter( 'reen_enable_popular_posts',    'reen_redux_toggle_popular_posts' );
add_filter( 'reen_show_author_info',        'reen_redux_toggle_author_info' );
add_filter( 'reen_show_post_nav',           'reen_redux_toggle_post_nav' );
add_filter( 'reen_show_social_sharing',     'reen_redux_toggle_social_sharing' );
add_filter( 'reen_enable_related_posts',    'reen_redux_toggle_related_posts' );

/**
 * Header Filters
 */
add_filter( 'reen_topbar_view',             'reen_redux_toggle_topbar_view' );
add_filter( 'reen_topbar_right',            'reen_redux_toggle_topbar_right' );
add_filter( 'reen_topbar_left',             'reen_redux_toggle_topbar_left' );
add_filter( 'reen_site_logo_svg',           'reen_redux_toggle_logo_svg' );
add_filter( 'reen_enable_sticky_header',    'reen_redux_toggle_sticky_header' );

// Footer Filters
add_filter( 'reen_footer_enable_copyright_info',    'reen_redux_toggle_footer_copyright_info' );
add_filter( 'reen_footer_copyright_text',           'reen_redux_apply_footer_copyright_text' );

add_filter( 'reen_enable_seperate_footer_logo',     'reen_redux_toggle_separate_footer_logo' );
add_filter( 'reen_separate_footer_logo',            'reen_redux_apply_separate_footer_logo' );

add_filter( 'reen_footer_site_title_info',          'reen_redux_apply_footer_site_title' );
add_filter( 'reen_footer_site_description_info',    'reen_redux_apply_footer_site_description' );

add_filter( 'reen_footer_enable_site_title',        'reen_redux_toggle_footer_site_title' );
add_filter( 'reen_footer_enable_site_description',  'reen_redux_toggle_footer_site_description' );

// Style Filters
add_filter( 'reen_use_predefined_colors',           'reen_redux_toggle_use_predefined_colors' );
add_action( 'reen_primary_color',                   'reen_redux_apply_primary_color' );
add_action( 'wp_head',                              'reen_redux_apply_custom_color_css', 100 );
add_action( 'wp_enqueue_scripts',                   'reen_redux_load_external_custom_css', 20 );
//add_action( 'enqueue_block_editor_assets',        'reen_redux_apply_custom_color_css', 100 );
add_action( 'enqueue_block_editor_assets',          'reen_redux_load_external_custom_css', 20 );
add_filter( 'reen_should_add_custom_css_page',      'reen_redux_toggle_custom_css_page', 10 );
