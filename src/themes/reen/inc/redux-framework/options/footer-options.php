<?php
/**
 * Filter functions for Footer Section of Theme Options
 */

$footer_options = apply_filters( 'reen_footer_options_args', array(
    'title'     => esc_html__( 'Footer', 'REEN' ),
    'desc'      => esc_html__( 'Options related to the footer section. The Footer has : Brands Slider, Footer Widgets, Footer Newsletter Section,Footer Contact Info Section, Footer Contact Block, Footer Bottom Wigets', 'REEN' ),
    'icon'      => 'far fa-arrow-alt-circle-down',
    'fields'    => array(

        array(
            'id'        => 'footer_bottom_bar_start',
            'type'      => 'section',
            'indent'    => true,
            'title'     => esc_html__( 'Footer Bottom Bar', 'REEN' ),
            'subtitle'  => esc_html__( 'The Footer Bottom Bar is available bottom of Footer.', 'REEN' ),
        ),

        array(
            'id'        => 'footer_copyright_info_enable',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Footer Copyright', 'REEN' ),
            'default'   => 1,
        ),

        array(
            'id'        => 'footer_copyright_info',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Footer Copyright Text', 'REEN' ),
            'default'   => wp_kses_post( sprintf( __( '&copy; %s REEN. All Rights Reserved.', 'REEN' ), date('Y'), esc_url( home_url('/') ), get_bloginfo( 'name' ) ) ),
            'required'  => array( 'footer_copyright_info_enable', 'equals', 1 ),
        ),

        array(
            'id'        => 'footer_bottom_bar_end',
            'type'      => 'section',
            'indent'    => false
        ),
    )
) );