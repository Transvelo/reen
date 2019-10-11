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
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() ),
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
            'a'    => array(
                'href'  => array(),
                'title' => array(),
                'rel'   => array(),
            ),
            'time' => array(
                'datetime' => array(),
                'class'    => array(),
            ),
        ) );
    }
}
