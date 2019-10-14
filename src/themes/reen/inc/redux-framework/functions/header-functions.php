<?php
/**
 * Filter functions for Header of Theme Options
 */
if ( ! function_exists( 'redux_toggle_topbar_view' ) ) {
    function redux_toggle_topbar_view( $enable_topbar_view ) {
        global $reen_options;

        if ( isset( $reen_options['enable_topbar_view'] ) && $reen_options['enable_topbar_view'] ) {
            $enable_topbar_view = true;
        } else {
            $enable_topbar_view = false;
        }

        return $enable_topbar_view;
    }
}


if ( ! function_exists( 'redux_toggle_topbar_left' ) ) {
    function redux_toggle_topbar_left( $header_enable_topbar_left ) {
        global $reen_options;

        if ( isset( $reen_options['header_enable_topbar_left'] ) && $reen_options['header_enable_topbar_left'] ) {
            $header_enable_topbar_left = true;
        } else {
            $header_enable_topbar_left = false;
        }

        return $header_enable_topbar_left;
    }
}


if ( ! function_exists( 'redux_toggle_topbar_right' ) ) {
    function redux_toggle_topbar_right( $header_enable_topbar_right ) {
        global $reen_options;

        if ( isset( $reen_options['header_enable_topbar_right'] ) && $reen_options['header_enable_topbar_right'] ) {
            $header_enable_topbar_right = true;
        } else {
            $header_enable_topbar_right = false;
        }

        return $header_enable_topbar_right;
    }
}


if( ! function_exists( 'redux_toggle_logo_svg' ) ) {
    function redux_toggle_logo_svg() {
        global $reen_options;

        if( isset( $reen_options['reen_site_logo_svg'] ) && $reen_options['reen_site_logo_svg'] == '1' ) {
            $reen_site_logo_svg = true;
        } else {
            $reen_site_logo_svg = false;
        }

        return $reen_site_logo_svg;
    }
}