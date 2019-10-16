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
            'id'        => 'footer_logo_section_start',
            'type'      => 'section',
            'title'     => esc_html__( 'Footer Logo', 'reen' ),
            'indent'    => true,
        ),

        array(
            'id'        => 'enable_separate_footer_logo',
            'type'      => 'switch',
            'title'     => esc_html__( 'Use separate logo for Footer', 'reen' ),
            'subtitle'  => esc_html__( 'Do you want to display a separate logo for footer ?', 'reen' ),
            'desc'      => esc_html__( 'By default the logo uploaded to Appearance > Customize > Site Identity > Site Logo is displayed in footer', 'reen' ),
            'on'        => esc_html__( 'Yes', 'reen' ),
            'off'       => esc_html__( 'No', 'reen' ),
            'default'   => 0,
        ),

        array(
            'id'        => 'separate_footer_logo',
            'type'      => 'media',
            'title'     => esc_html__( 'Footer Logo', 'reen' ),
            'subtitle'  => esc_html__( 'Upload an image file. Recommended Size : 150x57 pixels', 'reen' ),
            'desc'      => esc_html__( 'Upload a separate logo that you want to be displayed in footer', 'reen' ),
            'required'  => array( 'enable_separate_footer_logo', 'equals', true ),
        ),

        array(
            'id'        => 'footer_logo_section_end',
            'type'      => 'section',
            'indent'    => false,
        ),

        array(
            'type'         => 'text',
            'id'           => 'footer_site_title',
            'title'        => esc_html__( 'Footer Site Title', 'reen' ),
            'subtitle'     => esc_html__( 'Enter the footer site Title', 'reen' ),
        ),

        array(
            'type'         => 'textarea',
            'id'           => 'footer_site_description',
            'title'        => esc_html__( 'Footer Site Description', 'reen' ),
            'subtitle'     => esc_html__( 'Enter the footer site description', 'reen' ),
        ),

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