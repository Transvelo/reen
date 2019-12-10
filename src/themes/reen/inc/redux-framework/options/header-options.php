<?php

$header_options = apply_filters( 'reen_header_options_args', array(
    'title'  => esc_html__( 'Header', 'reen' ),
    'icon'      => 'far fa-arrow-alt-circle-up',
    'desc'   => esc_html__( 'Options available for your header', 'reen' ),
    'fields' => array(

        array(
            'title'     => esc_html__( 'Logo', 'reen' ),
            'id'        => 'logo_start',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Site Logo', 'reen' ),
            'subtitle'  => esc_html__( 'Enable to display logo instead of site title.', 'reen' ),
            'desc'      => esc_html__( 'This will not work when you use site logo in customizer.', 'reen' ),
            'id'        => 'logo_svg',
            'type'      => 'switch',
            'on'        => esc_html__( 'Enabled', 'reen' ),
            'off'       => esc_html__( 'Disabled', 'reen' ),
            'default'   => 1,
        ),

        array(
            'id'        => 'logo_end',
            'type'      => 'section',
            'indent'    => false
        ),

        array(
            'title'     => esc_html__( 'Topbar', 'reen' ),
            'id'        => 'header_topbar_section_start',
            'type'      => 'section',
            'indent'    => true,
        ),

        array(
            'title'     => esc_html__( 'Enable Topbar', 'reen' ),
            'id'        => 'enable_topbar_view',
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
            'required'  => array( 'enable_topbar_view', 'equals', true ),
            'default'   => true,
        ),

        array(
            'title'     => esc_html__( 'Enable Topbar Right', 'reen' ),
            'id'        => 'header_enable_topbar_right',
            'subtitle'  => esc_html__( 'Enable to display top bar right in header', 'reen' ),
            'on'        => esc_html__('Yes', 'reen'),
            'off'       => esc_html__('No', 'reen'),
            'type'      => 'switch',
            'required'  => array( 'enable_topbar_view', 'equals', true ),
            'default'   => true,
        ),

        array(
            'id'        => 'header_topbar_section_end',
            'type'      => 'section',
            'indent'    => false,
        ),
    )
) );