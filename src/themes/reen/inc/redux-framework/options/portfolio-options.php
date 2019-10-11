<?php
/**
 * Options available for portfolio Theme Options
 * portfolio
 */

 $portfolio_options = apply_filters( 'reen_portfolio_options_args', array(
    'title'  => esc_html__( 'Portfolio', 'reen' ),
    'icon'   => 'far fa-list-alt',
    'desc'   => esc_html__( 'Options available for your portfolio', 'reen' ),
    'fields' => array(
    array(

            'type'         => 'select',
            'id'           => 'portfolio_view',
            'title'        => esc_html__( 'Portfolio', 'reen' ),
            'subtitle'     => esc_html__( 'Select the view for portfolio', 'reen' ),
            'options'      => array(
            'grid'         => esc_html__( 'Grid', 'reen' ),
            'grid-detail'  => esc_html__( 'Grid Detail', 'reen' ),
            'fullscreen'   => esc_html__( 'Grid Fullscreen', 'reen' ),
            ),
            'default'      => 'grid-detail'
        ),

     array(
            'type'     => 'spinner',
            'id'       => 'portfolio_grid_columns',
            'title'    => esc_html__( 'Grid columns', 'reen' ),
            'subtitle' => esc_html__( 'Select the columns for the grid','reen' ),
            'min'      => '3',
            'max'      => '4',
            'step'     => '1',
            'required' =>  array(
                array('portfolio_view','not','fullscreen' ),
            ),
        ),
    )
 ) );