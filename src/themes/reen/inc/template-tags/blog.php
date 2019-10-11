<?php
/**
 * Template tags used in Blog Pages
 */

if ( ! function_exists( 'reen_loop_wrap_open' ) ) {
    function reen_loop_wrap_open() {
        ?><div class="posts"><?php
    }
}

if ( ! function_exists( 'reen_loop_wrap_close' ) ) {
    function reen_loop_wrap_close() {
        ?></div><?php
    }
}

if ( ! function_exists( 'reen_post_date_wrapper' ) ) {
    function reen_post_date_wrapper() {
        ?><div class="date-wrapper">
        <?php reen_posted_on(); ?>
        </div><?php
    }
}


if ( ! function_exists( 'reen_posted_on' ) ) {
    function reen_posted_on() {
        $time_string = '<time class="date entry-date published updated" datetime="%1$s"><span class="day">%2$s</span><span class="month">%3$s</span></time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'j, F') ),
            esc_html( get_the_date('j') ),
            esc_html( get_the_date('F') ),
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html( get_the_modified_date() )
        );

        $posted_on = sprintf(
            _x( '%s', 'post date', 'reen' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo wp_kses( apply_filters( 'reen_posted_on_html', '<div class="date">' . $posted_on . '</div>', $posted_on ), array(
            'span' => array(
                'class'  => array(),
            ),
            // 'a'    => array(
            //     'href'  => array(),
            //     'title' => array(),
            //     'rel'   => array(),
            // ),
            'time' => array(
                'datetime' => array(),
                'class'    => array(),
            ),
        ) );
    }
}

if ( ! function_exists( 'reen_post_body_wrap_start' ) ) {
    function reen_post_body_wrap_start() {
    	?><div class="post-content"><?php
	}
}

if ( ! function_exists( 'reen_post_body_wrap_end' ) ) {
    function reen_post_body_wrap_end() {
    	?></div><?php
	}
}

if ( ! function_exists( 'reen_post_featured_image' ) ) {
    function reen_post_featured_image() {
        global $post;

        if ( has_post_thumbnail() ) {
            ?><div class="entry-featured-image"><?php
            $featured_image_size = 'medium';

            $post_thumbnail_url = get_the_post_thumbnail_url( $post->ID, $featured_image_size );
            ?><div class="post-image" style="background-image:url(<?php echo esc_attr( $post_thumbnail_url ); ?>);"><a href="<?php echo esc_url( get_permalink() ); ?>"></a></div><?php
            ?>
            </div><?php

        } elseif( apply_filters( 'reen_enable_post_icon_placeholder', false ) ) {
            echo sprintf( '<a class="post-icon-link" href="%s" rel="bookmark">', esc_url( get_permalink() ) );

            reen_post_icon();

            echo wp_kses_post( '</a>' );
        }
    }
}
