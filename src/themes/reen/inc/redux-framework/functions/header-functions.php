<?php
/**
 * Filter functions for Header of Theme Options
 */

if ( ! function_exists( 'reen_redux_apply_header_args' ) ) {
    function reen_redux_apply_header_args( $args ) {

        global $reen_options;

        if ( isset( $reen_options['header_enable_topbar'] ) ) {
            $args['enableTopBar'] = $reen_options['header_enable_topbar'];

            if ( isset( $reen_options['header_enable_topbar_left'] ) ) {
                $args['enableTopBarLeft'] = $reen_options['header_enable_topbar_left'];
            }

            if ( isset( $reen_options['header_enable_topbar_right'] ) ) {
                $args['enableTopBarRight'] = $reen_options['header_enable_topbar_right'];
            }
        }

        if ( ! empty( $reen_options['header_logo_align'] ) ) {
            $args['logoAlign'] = $reen_options['header_logo_align'];

            if ( $reen_options['header_logo_align'] == 'center' && ! empty( $reen_options['header_logo_align_breakpoint'] ) ) {
                $args['logoAlignBreakpoint'] = $reen_options['header_logo_align_breakpoint'];
            }
        }

        if ( ! empty( $reen_options['
            '] ) ) {
            $args['navbarAlign'] = $reen_options['header_navbar_align'];
        }

        if ( ! empty( $reen_options['header_navbar_dropdown_trigger'] ) ) {
            $args['navbarDropdownTrigger'] = $reen_options['header_navbar_dropdown_trigger'];
        }

        return $args;
    }
}