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

/**
*  Portfolio single post
*/

add_action( 'reen_portfolio_single_post_audio', 'reen_portfolio_audio_post_content_open',       20 );
add_action( 'reen_portfolio_single_post_audio', 'reen_portfolio_audio_post_content',            30 );
add_action( 'reen_portfolio_single_post_audio', 'reen_portfolio_post_audio',                    40 );
add_action( 'reen_portfolio_single_post_audio', 'reen_portfolio_audio_post_content_close',      50 );
add_action( 'reen_portfolio_single_post_audio_bottom', 'reen_portfolio_more_audio',      		60 );



add_action( 'reen_portfolio_single_post_video_top', 'reen_portfolio_more_videos',               10 );
add_action( 'reen_portfolio_single_post_video', 'reen_portfolio_video_post_wrap_start',         20 );
add_action( 'reen_portfolio_single_post_video', 'reen_portfolio_post_video',                    30 );
add_action( 'reen_portfolio_single_post_video', 'reen_portfolio_video_post_content_open',       40 );
add_action( 'reen_portfolio_single_post_video', 'reen_portfolio_video_post_content_description',50 );
add_action( 'reen_portfolio_single_post_video', 'reen_portfolio_video_post_content_close',      60 );
add_action( 'reen_portfolio_single_post_video', 'reen_portfolio_video_post_wrap_end',         	70 );


/**
*  Portfolio custom post
*/
add_action( 'reen_portfolio_single_slider_1', 'reen_portfolio_post_slider_wrap_open',           10 );
add_action( 'reen_portfolio_single_slider_1', 'reen_portfolio_post_slider_1',                   20 );
add_action( 'reen_portfolio_single_slider_1', 'reen_portfolio_post_slider_1_content',           30 );
add_action( 'reen_portfolio_single_slider_1', 'reen_portfolio_post_slider_wrap_close',          40 );
add_action( 'reen_portfolio_single_post_slider_1_bottom', 'reen_more_works'                        );

add_action( 'reen_portfolio_single_slider_2', 'reen_portfolio_post_slider_wrap_open',           10 );
add_action( 'reen_portfolio_single_slider_2', 'reen_portfolio_post_slider_2',                   20 );
add_action( 'reen_portfolio_single_slider_2', 'reen_portfolio_post_slider_2_content',           30 );
add_action( 'reen_portfolio_single_slider_2', 'reen_portfolio_post_slider_wrap_close',          40 );
add_action( 'reen_portfolio_single_post_slider_2_bottom', 'reen_more_works'                        );

add_action( 'reen_portfolio_single_image_1', 'reen_portfolio_post_image_1_title',               10 );
add_action( 'reen_portfolio_single_image_1', 'reen_portfolio_post_image_1_meta',                20 );

add_action( 'reen_portfolio_single_post_image_1_bottom', 'reen_more_works',                10 );


add_action( 'reen_portfolio_single_image_2', 'reen_portfolio_post_image_2_media',               10 );
add_action( 'reen_portfolio_single_image_2', 'reen_portfolio_post_image_2_content',             20 );

add_action( 'reen_portfolio_single_post_image_2_bottom', 'reen_more_works',                     10 );


/**
*  Portfolio page 
*/
add_filter( 'reen_site_content_page_title',    'reen_page_site_content_page_title'  );
add_filter( 'reen_site_content_page_subtitle', 'reen_site_content_page_subtitle'  );

add_action( 'reen_page', 'reen_page_header',           10 );
add_action( 'reen_page', 'reen_page_content',          20 );