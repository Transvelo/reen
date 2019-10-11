<?php
/**
 * Hooks used for Posts
 */

add_action( 'reen_loop_before', 'reen_loop_wrap_open',      10 );
add_action( 'reen_loop_after',  'reen_loop_wrap_close',     10 );

add_action( 'reen_loop_post', 	'reen_post_date_wrapper', 					10 );
add_action( 'reen_loop_post', 	'reen_post_icon', 							20 );

add_action( 'reen_loop_post', 	'reen_post_body_wrap_start', 				30 );
add_action( 'reen_loop_post', 	'reen_post_featured_image', 				40 );
add_action( 'reen_loop_post',   'reen_post_title',     					    50 );
add_action( 'reen_loop_post', 	'reen_post_body_wrap_end', 				    60 );
