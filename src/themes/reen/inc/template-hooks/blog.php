<?php
/**
 * Hooks used for Posts
 */


add_action( 'reen_loop_before', 'reen_popular_posts',                      10 );
add_action( 'reen_loop_before', 'reen_loop_section_wrap_start',            15 );
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


add_action( 'reen_loop_post_content', 	'reen_post_side_meta', 						10 );
add_action( 'reen_loop_post_content', 	'reen_post_content_start', 				    20 );
add_action( 'reen_loop_post_content',   'reen_post_title',     					    30 );
add_action( 'reen_loop_post_content',   'reen_post_meta',     					    40 );
add_action( 'reen_loop_post_content',   'reen_post_excerpt',     			        50 );
add_action( 'reen_loop_post_content',   'reen_post_readmore',     			        60 );
add_action( 'reen_loop_post_content',   'reen_post_content_end', 				    70 );


/**
 * Sidebar
 */

 add_action( 'reen_sidebar', 'reen_get_sidebar',                         10 );

 /**
 * Single Post 
 */


add_action( 'reen_single_post_before',    'reen_popular_posts',   10 );
add_action( 'reen_single_post_before', 'reen_single_loop_section_wrap_start',     15 );
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

add_action( 'reen_single_post_after', 'reen_post_nav',              10 );
add_action( 'reen_single_post_after', 'reen_post_author',           20 );
add_action( 'reen_single_post_after', 'reen_post_social_sharing',   30 );
add_action( 'reen_single_post_after', 'reen_related_posts',         40 );
add_action( 'reen_single_post_after', 'reen_display_comments',         50 );

add_action( 'reen_single_post_after', 'reen_post_wrap_close', 60 );
add_action( 'reen_single_post_after', 'reen_loop_row_wrap_end',      	            70 );
add_action( 'reen_single_post_after', 'reen_loop_container_wrap_end',      	    80 );

/**
 * Filters
 */

add_filter( 'comment_form_fields', 'reen_move_comment_field_to_bottom', 10 );
//add_filter( 'comment_form_default_fields', 'comment_form_not_checked_cookies_consent', 20 );
add_filter( 'excerpt_length', 'reen_excerpt_length' );
add_filter( 'excerpt_more', 'reen_excerpt_more' );
/**
 * Protected Post Custom Password Form
 */
add_filter( 'the_password_form', 'reen_post_protected_password_form' );

