<?php
/**
 * Options available for portfolio Theme Options
 * portfolio
 */

 $reen_portfolio_options = apply_filters( 'reen_portfolio_options_args', array(
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

     array(
            'id'        => 'reen_portfolio_posts_per_page',
            'type'      => 'slider',
            'title'     => esc_html__( 'Projects per page', 'reen' ),
            'subtitle'  => esc_html__( 'How many projects should be shown per page?', 'reen' ),
            'min'       => 4,
            'max'       => 32,
            'default'   => '16'
        ),

     array(

            'type'         => 'text',
            'id'           => 'reen_portfolio_page_title',
            'title'        => esc_html__( 'Portfolio Page Title', 'reen' ),
            'subtitle'     => esc_html__( 'Title for portfolio page', 'reen' ),
            'default'      => '3 Columns grid portfolio'
        ),

     array(

            'type'         => 'text',
            'id'           => 'reen_portfolio_page_description',
            'title'        => esc_html__( 'Portfolio Page Description', 'reen' ),
            'subtitle'     => esc_html__( 'Description for portfolio page', 'reen' ),
            'default'      => 'Magnis modipsae voloratati andigen daepeditem quiate re porem que aut labor. Laceaque eictemperum quiae sitiorem rest non restibusaes.'
        ),
    )
 ) );