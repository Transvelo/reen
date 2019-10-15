<?php
/**
 * Reen functions.
 *
 * @package front
 */

if ( ! function_exists( 'reen_is_jetpack_activated' ) ) {
    /**
     * Query JetPack activation
     */
    function reen_is_jetpack_activated() {
        return class_exists( 'Jetpack' ) ? true : false;
    }
}


if ( ! function_exists( 'reen_is_redux_activated' ) ) {
    function reen_is_redux_activated() {
        /**
         * Query Redux Framework activation
         */
        return class_exists( 'ReduxFramework' );
    }
}

/**
 * Determines if post thumbnail can be displayed.
 */
function reen_can_show_post_thumbnail() {
    return apply_filters( 'reen_can_show_post_thumbnail', ! post_password_required() && ! is_attachment() && has_post_thumbnail() );
}

if ( ! function_exists( 'reen_get_single_post_layout' ) ) {
    function reen_get_single_post_layout() {
        $available_layouts = array( 'sidebar-left', 'sidebar-right', 'no-sidebar' );
        $default_single_post_layout = 'sidebar-right';
        $single_post_layout         = apply_filters( 'reen_single_post_layout', $default_single_post_layout );

        if ( ! in_array( $single_post_layout, $available_layouts ) ) {
            $single_post_layout = $default_single_post_layout;
        }

        return $single_post_layout;
    }
}

if ( ! function_exists( 'reen_get_blog_style' ) ) {
    /**
     * Classic or Grid
     */
    function reen_get_blog_style() {
        $default_blog_style = 'classic-blog';
        $available_styles = array( 'classic-blog', 'grid-blog' );
        
        if ( is_single() ) {
            $blog_style = 'classic-blog';
        } else {
            $blog_style = apply_filters( 'reen_blog_style', $default_blog_style );
        }

        if ( ! in_array( $blog_style, $available_styles ) ) {
            $blog_style = $default_blog_style;
        } 

        return $blog_style;
    }
}

if ( ! function_exists( 'reen_get_blog_layout' ) ) {
    /**
     * Gets Blog Layout
     */
    function reen_get_blog_layout() {
        $available_layouts = array( 'sidebar-left', 'sidebar-right', 'no-sidebar' );
        $default_blog_layout = 'sidebar-right';

        if ( ! is_active_sidebar( 'sidebar-blog' ) ) {
            $blog_layout = 'no-sidebar';
        } elseif ( is_single() ) {
            $blog_layout = reen_get_single_post_layout();
        } else {
            $blog_layout = apply_filters( 'reen_blog_layout', $default_blog_layout );
        }

        if ( ! in_array( $blog_layout, $available_layouts ) ) {
            $blog_layout = $default_blog_layout;
        }

        return $blog_layout;
    }
}

