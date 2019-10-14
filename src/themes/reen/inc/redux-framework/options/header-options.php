<?php

$header_options = apply_filters( 'reen_header_options_args', array(
    'title'  => esc_html__( 'Header', 'reen' ),
    'icon'      => 'far fa-arrow-alt-circle-up',
    'desc'   => esc_html__( 'Options available for your header', 'reen' ),
    'fields' => array(

        array(
            'title'     => esc_html__( 'Topbar', 'reen' ),
            'id'        => 'header_topbar_section_start',
            'type'      => 'section',
            'indent'    => true,
        ),

        array(
            'title'     => esc_html__( 'Enable Topbar', 'reen' ),
            'id'        => 'header_enable_topbar',
            'subtitle'  => esc_html__( 'Enable to display top bar in header', 'reen' ),
            'on'        => esc_html__('Yes', 'reen'),
            'off'       => esc_html__('No', 'reen'),
            'type'      => 'switch',
            'default'   => true,
        ),

        array(
            'title'     => esc_html__( 'Enable Topbar Left', 'reen' ),
            'id'        => 'header_enable_topbar_left',
            'subtitle'  => esc_html__( 'Enable to display top bar left in header', 'reen' ),
            'on'        => esc_html__('Yes', 'reen'),
            'off'       => esc_html__('No', 'reen'),
            'type'      => 'switch',
            'required'  => array( 'header_enable_topbar', 'equals', true ),
            'default'   => true,
        ),

        array(
            'title'     => esc_html__( 'Enable Topbar Right', 'reen' ),
            'id'        => 'header_enable_topbar_right',
            'subtitle'  => esc_html__( 'Enable to display top bar right in header', 'reen' ),
            'on'        => esc_html__('Yes', 'reen'),
            'off'       => esc_html__('No', 'reen'),
            'type'      => 'switch',
            'required'  => array( 'header_enable_topbar', 'equals', true ),
            'default'   => true,
        ),

        array(
            'id'        => 'header_topbar_section_end',
            'type'      => 'section',
            'indent'    => false,
        ),

        array(
            'title'     => esc_html__( 'Logo', 'reen' ),
            'id'        => 'header_logo_section_start',
            'type'      => 'section',
            'indent'    => true,
        ),

        array(
            'type'         => 'select',
            'id'           => 'header_logo_align',
            'title'        => esc_html__( 'Logo Align', 'reen' ),
            'options'      => array(
                'left'      => esc_html__( 'Left', 'reen' ),
                'center'    => esc_html__( 'Center', 'reen' ),
            ),
            'default'  => 'left'
        ),

        array(
            'type'         => 'select',
            'id'           => 'header_logo_align_breakpoint',
            'title'        => esc_html__( 'Logo Align Breakpoint', 'reen' ),
            'options'      => array(
                'all-screens'   => esc_html__( 'All Screens', 'reen' ),
                'sm'            => esc_html__( 'sm', 'reen' ),
                'md'            => esc_html__( 'md', 'reen' ),
                'lg'            => esc_html__( 'lg', 'reen' ),
                'xl'            => esc_html__( 'xl', 'reen' ),
            ),
            'required'  => array( 'header_logo_align', 'equals', 'center' ),
            'default'  => 'all-screens'
        ),

        array(
            'title'     => esc_html__( 'Upload scroll Logo', 'reen' ),
            'subtitle'  => esc_html__( 'Upload your header scroll logo image.', 'reen' ),
            'id'        => 'header_logo_scroll_image',
            'type'      => 'media',
            // 'required'  => array(
            //     array( 'header_show_hide_scroll_behavior', 'equals', 'changing-logo-on-scroll' ),
            //     array( 'header_sticky_scroll_behavior', 'equals', 'changing-logo-on-scroll' )
            // ),
        ),

        array(
            'id'        => 'header_logo_section_end',
            'type'      => 'section',
            'indent'    => false,
        ),

        array(
            'title'     => esc_html__( 'Navbar', 'reen' ),
            'id'        => 'header_navbar_section_start',
            'type'      => 'section',
            'indent'    => true,
        ),

        array(
            'type'         => 'select',
            'id'           => 'header_navbar_responsive_type',
            'title'        => esc_html__( 'Responsive Type', 'reen' ),
            'options'      => array(
                'none'          => esc_html__( 'None', 'reen' ),
                'collapse'      => esc_html__( 'Collapse', 'reen' ),
                'scroll'        => esc_html__( 'Scroll', 'reen' ),
            ),
            'default'  => 'collapse'
        ),

        array(
            'id'        => 'header_navbar_section_end',
            'type'      => 'section',
            'indent'    => false,
        ),
    )
) );