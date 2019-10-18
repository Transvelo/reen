<?php
/**
 * Hooks used for Posts
 */
add_action( 'reen_loop_before', 'reen_popular_posts',                      10 );

add_action( 'reen_loop_before', 'reen_loop_container_wrap_start',          20 );
add_action( 'reen_loop_before', 'reen_format_filter',      	 		       30 );
add_action( 'reen_loop_before', 'reen_loop_row_wrap_start',      	       40 );
add_action( 'reen_loop_before', 'reen_loop_posts_wrap_start',      	       50 );
add_action( 'reen_loop_before', 'reen_toggle_post_side_meta_hooks',        60 );

add_action( 'reen_loop_post', 	'reen_post_side_meta', 						10 );
add_action( 'reen_loop_post', 	'reen_post_content_start', 				    20 );
add_action( 'reen_loop_post', 	'reen_post_summary', 						30 );
add_action( 'reen_loop_post',   'reen_post_content_end', 				    40 );

add_action( 'reen_post_side_meta', 	'reen_post_date', 					    10 );
add_action( 'reen_post_side_meta', 	'reen_post_format', 					20 );

add_action( 'reen_post_summary',   'reen_post_media',     					10 );
add_action( 'reen_post_summary',   'reen_post_title',     					20 );
add_action( 'reen_post_summary',   'reen_post_meta',     					30 );
add_action( 'reen_post_summary',   'reen_post_excerpt',     			    40 );
add_action( 'reen_post_summary',   'reen_post_readmore',     			    50 );

add_action( 'reen_loop_after', 'reen_loop_posts_wrap_end',                  10 );
add_action( 'reen_loop_after', 'reen_paging_nav',                           20 );
add_action( 'reen_loop_after', 'reen_loop_row_wrap_end',      	            40 );
add_action( 'reen_loop_after', 'reen_loop_container_wrap_end',      	    50 );


/**
 * Post Formats
 */

add_action( 'reen_loop_post_link', 	    'reen_post_side_meta', 						10 );
add_action( 'reen_loop_post_link', 	    'reen_post_content_start', 				    20 );
add_action( 'reen_loop_post_link',      'reen_post_title',     					    30 );
add_action( 'reen_loop_post_link',      'reen_post_the_content',     				40 );
add_action( 'reen_loop_post_link',      'reen_post_content_end', 				    50 );

add_action( 'reen_loop_post_quote',      'reen_post_side_meta',          			10 );
add_action( 'reen_loop_post_quote', 	 'reen_post_content_start', 				20 );
add_action( 'reen_loop_post_quote',      'reen_post_the_content',     				30 );
add_action( 'reen_loop_post_quote',      'reen_post_content_end', 				    40 );

/**
 * Sidebar
 */

 add_action( 'reen_sidebar', 'reen_get_sidebar',                         10 );

 /**
 * Single Post 
 */


add_action( 'reen_single_post_before',    'reen_popular_posts',   10 );
add_action( 'reen_single_post_before', 'reen_loop_container_wrap_start',          20 );
add_action( 'reen_single_post_before', 'reen_loop_row_wrap_start',      	       40 );
add_action( 'reen_single_post_before', 'reen_toggle_post_side_meta_hooks',        60 );
add_action( 'reen_single_post_before', 'reen_post_wrap_open', 70 );

add_action( 'reen_single_post', 'reen_post_side_meta',                   10 );
add_action( 'reen_single_post', 'reen_post_content_start',               20 );
add_action( 'reen_single_post', 'reen_post_media',                       30 );
add_action( 'reen_single_post', 'reen_single_post_author_name',          40 );
add_action( 'reen_single_post', 'reen_post_title',            50 );
add_action( 'reen_single_post', 'reen_post_meta',             60 );
add_action( 'reen_single_post', 'reen_post_the_content',      70 );
add_action( 'reen_single_post', 'reen_post_content_end',      80 );

add_action( 'reen_single_post_after', 'reen_post_author',           10 );

add_action( 'reen_single_post_after', 'reen_post_wrap_close', 20 );
add_action( 'reen_single_post_after', 'reen_loop_row_wrap_end',      	            30 );
add_action( 'reen_single_post_after', 'reen_loop_container_wrap_end',      	    40 );

