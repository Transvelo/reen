<?php
/**
 * Filter functions for Footer of Theme Options
 */

if ( ! function_exists( 'redux_toggle_footer_copyright_info' ) ) {
    function redux_toggle_footer_copyright_info( $enable ) {
        global $reen_options;

        $reen_options['footer_copyright_info_enable'] = isset( $reen_options['footer_copyright_info_enable'] ) ? $reen_options['footer_copyright_info_enable'] : true;

        if( $reen_options['footer_copyright_info_enable'] ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if ( ! function_exists( 'redux_apply_footer_copyright_text' ) ) {
    function redux_apply_footer_copyright_text( $text ) {
        global $reen_options;

        if( isset( $reen_options['footer_copyright_info'] ) ) {
            $text = $reen_options['footer_copyright_info'];
        }

        return $text;
    }
}
