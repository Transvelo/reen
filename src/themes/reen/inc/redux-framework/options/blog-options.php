<?php
/**
 * Options available for Blog sub menu of Theme Options
 * 
 */

 $blog_options = apply_filters( 'reen_blog_options_args', array(
    'title'  => esc_html__( 'Blog', 'reen' ),
    'icon'   => 'far fa-list-alt',
    'desc'   => esc_html__( 'Options available for your Blog', 'reen' ),
    'fields' => array(
        array(
            'type'     => 'select',
            'id'       => 'blog_layout',
            'title'    => esc_html__( 'Blog Layout', 'reen' ),
            'subtitle' => esc_html__( 'Select from the three available layouts for your blog', 'reen' ),
            'options'  => array(
                'sidebar-left'  => esc_html__( 'Left Sidebar', 'reen' ),
                'sidebar-right' => esc_html__( 'Right Sidebar', 'reen' ),
                'no-sidebar'    => esc_html__( 'Full Width', 'reen' )
            ),
                'default'       => 'sidebar-right'
        ),

        array(
            'type'     => 'select',
            'id'       => 'blog_style',
            'title'    => esc_html__( 'Blog style', 'reen' ),
            'subtitle' => esc_html__( 'Select the style  for the  blog', 'reen' ),
            'options'  => array(
                'grid-blog'     => esc_html__( 'Grid', 'reen' ),
                'classic-blog'  => esc_html__( 'Classic', 'reen' ),
            ),
                'default'       => 'classic-blog'
        ),

        array(
            'type'     => 'spinner',
            'id'       => 'grid_columns',
            'title'    => esc_html__( 'Grid columns', 'reen' ),
            'subtitle' => esc_html__( 'Select the style  for the  grid', 'reen' ),
            'min'      => '2',
            'max'      => '3',
            'step'     => '1',
            'required' =>  array(
                array ('blog_layout' , 'equals' , 'no-sidebar'),
                array ('blog_style' , 'equals', 'grid-blog'),

            ), 
        ),
    )
 ) );