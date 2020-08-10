<?php
/**
 * Filter functions for Header of Theme Options
 */
if( ! function_exists( 'reen_redux_toggle_logo_svg' ) ) {
    function reen_redux_toggle_logo_svg() {
        global $reen_options;

        if( isset( $reen_options['logo_svg'] ) && $reen_options['logo_svg'] == '1' ) {
            $logo_svg = true;
        } else {
            $logo_svg = false;
        }

        return $logo_svg;
    }
}

if ( ! function_exists( 'reen_redux_toggle_topbar_view' ) ) {
    function reen_redux_toggle_topbar_view( $enable_topbar_view ) {
        global $reen_options;

        if ( isset( $reen_options['enable_topbar_view'] ) && $reen_options['enable_topbar_view'] ) {
            $enable_topbar_view = true;
        } else {
            $enable_topbar_view = false;
        }

        return $enable_topbar_view;
    }
}


if ( ! function_exists( 'reen_redux_toggle_topbar_left' ) ) {
    function reen_redux_toggle_topbar_left( $header_enable_topbar_left ) {
        global $reen_options;

        if ( isset( $reen_options['header_enable_topbar_left'] ) && $reen_options['header_enable_topbar_left'] ) {
            $header_enable_topbar_left = true;
        } else {
            $header_enable_topbar_left = false;
        }

        return $header_enable_topbar_left;
    }
}


if ( ! function_exists( 'reen_redux_toggle_topbar_right' ) ) {
    function reen_redux_toggle_topbar_right( $header_enable_topbar_right ) {
        global $reen_options;

        if ( isset( $reen_options['header_enable_topbar_right'] ) && $reen_options['header_enable_topbar_right'] ) {
            $header_enable_topbar_right = true;
        } else {
            $header_enable_topbar_right = false;
        }

        return $header_enable_topbar_right;
    }
}

if ( ! function_exists( 'reen_redux_toggle_sticky_header' ) ) {
    function reen_redux_toggle_sticky_header( $sticky_header ) {
        global $reen_options;

        if ( isset( $reen_options['sticky_header'] ) && $reen_options['sticky_header'] ) {
            $sticky_header = true;
        } else {
            $sticky_header = false;
        }

        return $sticky_header;
    }
}