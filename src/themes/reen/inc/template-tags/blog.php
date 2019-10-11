<?php
/**
 * Template tags used in Blog Pages
 */

if ( ! function_exists( 'reen_loop_wrap_open' ) ) {
    function reen_loop_wrap_open() {
        ?><div class="classic-blog"><div class="posts sidemeta"><?php
    }
}

if ( ! function_exists( 'reen_loop_wrap_close' ) ) {
    function reen_loop_wrap_close() {
        ?></div></div><?php
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
            $time_string = '<time class="date entry-date published" datetime="%1$s"><span class="day">%2$s</span><span class="month">%3$s</span></time> <time class="updated" datetime="%4$s">%5$s</time>';
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

        $image_path = get_template_directory_uri() . '/assets/images/art/photograph04-lg.jpg';

        if ( has_post_thumbnail() ) {
            ?><div class="entry-featured-image"><?php
            $featured_image_size = 'medium';

            $post_thumbnail_url = get_the_post_thumbnail_url( $post->ID, $featured_image_size );
            ?><div class="post-image"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo the_post_thumbnail();?></a></div><?php
            ?>
            </div><?php

        } else {
            echo sprintf( '<figure class="icon-overlay icn-link post-media"><a href="%s" rel="bookmark"><span class="icn-more"></span><img src="%s" alt=""/></a></figure>', esc_url( get_permalink() ), esc_url( $image_path ) );

        }
    }
}

if ( ! function_exists( 'reen_post_title' ) ) {
    function reen_post_title() {
        the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
    }
}

if ( ! function_exists( 'reen_post_icon' ) ) {
    function reen_post_icon() {
        $post_format = get_post_format();
        switch( $post_format ) {
            case 'aside':
                $icon = 'fas fa-hand-point-left';
            break;
            case 'gallery':
                $icon = 'icon-picture';
            break;
            case 'link':
                $icon = 'icon-popup';
            break;
            case 'image':
                $icon = 'icon-picture-1';
            break;
            case 'quote':
                $icon = 'icon-quote';
            break;
            case 'status':
                $icon = 'far fa-comment-alt';
            break;
            case 'video':
                $icon = 'icon-video-1';
            break;
            case 'audio':
                $icon = 'icon-music-1';
            break;
            case 'chat':
                $icon = 'far fa-comments';
            break;
            default:
                $icon = 'icon-th';
        }

        $post_icon = apply_filters( 'reen_post_icon', $icon, $post_format );
        ?><div class="format-wrapper"><a href="#"><i class="<?php echo esc_attr( $post_icon ); ?>"></i></a></div><?php
    }
}
