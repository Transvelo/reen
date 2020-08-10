<?php
/**
 * General Theme Options
 *
 */

$reen_general_options = apply_filters( 'reen_general_options_args', array(
    'title'     => esc_html__( 'General', 'reen' ),
    'icon'      => 'far fa-dot-circle',
    'fields'    => array(
        array(
            'title'     => esc_html__( 'Scroll To Top', 'reen' ),
            'id'        => 'scrollup',
            'type'      => 'switch',
            'on'        => esc_html__('Enabled', 'reen'),
            'off'       => esc_html__('Disabled', 'reen'),
            'default'   => 1,
        ),
    )
) );
