<?php
/**
 * Reen functions.
 *
 * @package Reen
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

/**
 * Get other templates (e.g. product attributes) passing attributes and including the file.
 *
 * @access public
 * @param string $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return void
 */
function reen_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
    if ( $args && is_array( $args ) ) {
        extract( $args );
    }

    $located = reen_locate_template( $template_name, $template_path, $default_path );

    if ( ! file_exists( $located ) ) {
        _doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '2.1' );
        return;
    }

    // Allow 3rd party plugin filter template file from their plugin
    $located = apply_filters( 'reen_get_template', $located, $template_name, $args, $template_path, $default_path );

    do_action( 'reen_before_template_part', $template_name, $template_path, $located, $args );

    include( $located );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *      yourtheme       /   $template_path  /   $template_name
 *      yourtheme       /   $template_name
 *      $default_path   /   $template_name
 *
 * @access public
 * @param string $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */
function reen_locate_template( $template_name, $template_path = '', $default_path = '' ) {
    if ( ! $template_path ) {
        $template_path = 'templates/';
    }

    if ( ! $default_path ) {
        $default_path = 'templates/';
    }

    // Look within passed path within the theme - this is priority
    $template = locate_template(
        array(
            trailingslashit( $template_path ) . $template_name,
            $template_name
        )
    );

    // Get default template
    if ( ! $template || REEN_TEMPLATE_DEBUG_MODE ) {
        $template = $default_path . $template_name;
    }

    // Return what we found
    return apply_filters( 'reen_locate_template', $template, $template_name, $template_path );
}
