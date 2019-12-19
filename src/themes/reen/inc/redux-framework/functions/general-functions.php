<?php
/**
 * Filter functions for General Section of Theme Options
 */

if( ! function_exists( 'redux_toggle_scrollup' ) ) {
    function redux_toggle_scrollup() {
        global $reen_options;

        if( isset( $reen_options['scrollup'] ) && $reen_options['scrollup'] == '1' ) {
            $scrollup = true;
        } else {
            $scrollup = false;
        }

        return $scrollup;
    }
}

