<?php
/**
 * Filter functions for Footer of Theme Options
 */

if ( ! function_exists( 'reen_redux_toggle_separate_footer_logo' ) ) {
    function reen_redux_toggle_separate_footer_logo( $enable_separate_footer_logo ) {
        global $reen_options;

        if ( isset( $reen_options['enable_separate_footer_logo'] ) && $reen_options['enable_separate_footer_logo'] ) {
            $enable_separate_footer_logo = true;
        } else {
            $enable_separate_footer_logo = false;
        }

        return $enable_separate_footer_logo;
    }
}

if ( ! function_exists( 'reen_redux_apply_separate_footer_logo' ) ) {
    function reen_redux_apply_separate_footer_logo( $separate_footer_logo ) {
        global $reen_options;

        if ( isset( $reen_options['separate_footer_logo'] ) && is_array( $reen_options['separate_footer_logo'] ) && ! empty( $reen_options['separate_footer_logo']['id'] ) ) {
            $separate_footer_logo = $reen_options['separate_footer_logo'];
        }

        return $separate_footer_logo;
    }
}

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

if ( ! function_exists( 'reen_redux_apply_footer_site_title' ) ) {
    function reen_redux_apply_footer_site_title( $footer_site_title ) {
        global $reen_options;
        if ( isset( $reen_options['footer_site_title'] ) && ( ! empty( $reen_options['footer_site_title'] ) ) ) {
            $footer_site_title = $reen_options['footer_site_title'];
        }
        return $footer_site_title;
    }
}

if ( ! function_exists( 'reen_redux_apply_footer_site_description' ) ) {
    function reen_redux_apply_footer_site_description( $footer_site_description ) {
        global $reen_options;
        if ( isset( $reen_options['footer_site_description'] ) && ( ! empty( $reen_options['footer_site_description'] ) ) ) {
            $footer_site_description = $reen_options['footer_site_description'];
        }
        return $footer_site_description;
    }
}


if ( ! function_exists( 'redux_toggle_footer_site_title' ) ) {
    function redux_toggle_footer_site_title( $enable ) {
        global $reen_options;

        $reen_options['footer_footer_site_title_enable'] = isset( $reen_options['footer_footer_site_title_enable'] ) ? $reen_options['footer_footer_site_title_enable'] : true;

        if( $reen_options['footer_footer_site_title_enable'] ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}


if ( ! function_exists( 'redux_toggle_footer_site_description' ) ) {
    function redux_toggle_footer_site_description( $enable ) {
        global $reen_options;

        $reen_options['footer_footer_site_description_enable'] = isset( $reen_options['footer_footer_site_description_enable'] ) ? $reen_options['footer_footer_site_description_enable'] : true;

        if( $reen_options['footer_footer_site_description_enable'] ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}


