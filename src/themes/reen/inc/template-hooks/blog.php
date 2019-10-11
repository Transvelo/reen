<?php
/**
 * Hooks used for Posts
 */

add_action( 'reen_loop_before', 'reen_loop_wrap_open',      10 );
add_action( 'reen_loop_after',  'reen_loop_wrap_close',     10 );

add_action( 'reen_loop_post', 	'reen_post_date_wrapper', 					10 );
add_action( 'reen_loop_post', 	'reen_post_body_wrap_start', 				20 );
add_action( 'reen_loop_post', 	'reen_post_featured_image', 				30 );
add_action( 'reen_loop_post', 	'reen_post_body_wrap_end', 				    50 );
//add_action( 'reen_loop_post', 	'reen_post_date_wrapper_end', 					10 );
// add_action( 'uneno_loop_post', 'uneno_post_attachment', 					10 );
// add_action( 'uneno_loop_post', 'uneno_post_header', 						20 );

// add_action( 'uneno_post_header', 'uneno_post_categories',     				 5 );
// add_action( 'uneno_post_header', 'uneno_post_title',     					10 );
// add_action( 'uneno_post_header', 'uneno_post_excerpt',     					20 );
// add_action( 'uneno_post_header', 'uneno_post_meta_wrapper_start',           30 );
// add_action( 'uneno_post_header', 'uneno_post_meta',             			40 );
// add_action( 'uneno_post_header', 'uneno_post_readmore',             		50 );
// add_action( 'uneno_post_header', 'uneno_post_meta_wrapper_end',             60 );