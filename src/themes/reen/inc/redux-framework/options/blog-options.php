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

        array(
            'type'     => 'select',
            'id'       => 'single_blog_layout',
            'title'    => esc_html__( 'Single Blog Layout', 'reen' ),
            'subtitle' => esc_html__( 'Select from the three available layouts for your single blog', 'reen' ),
            'options'  => array(
                'sidebar-left'  => esc_html__( 'Left Sidebar', 'reen' ),
                'sidebar-right' => esc_html__( 'Right Sidebar', 'reen' ),
                'no-sidebar'    => esc_html__( 'Full Width', 'reen' )
            ),
                'default'       => 'sidebar-right'
        ),
        array(
            'title'     => esc_html__( 'Enable Popular Posts', 'reen' ),
            'subtitle'  => esc_html__( 'Choose if you want to enable popular posts section in blog page', 'reen' ),
            'id'        => 'enable_popular_posts',
            'on'        => esc_html__( 'Yes', 'reen' ),
            'off'       => esc_html__( 'No', 'reen' ),
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__( 'Blog Post Author Info', 'reen' ),
            'id'        => 'show_blog_post_author_info',
            'on'        => esc_html__('Yes', 'reen'),
            'off'       => esc_html__('No', 'reen'),
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__( 'Enable Post Navigation', 'reen' ),
            'id'        => 'show_post_nav',
            'on'        => esc_html__('Yes', 'reen'),
            'off'       => esc_html__('No', 'reen'),
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__( 'Blog Social Sharing', 'reen' ),
            'id'        => 'show_social_sharing',
            'on'        => esc_html__('Yes', 'reen'),
            'off'       => esc_html__('No', 'reen'),
            'type'      => 'switch',
            'default'   => false,
        ),
        array(
            'title'     => esc_html__( 'Enable Related Posts', 'reen' ),
            'subtitle'  => esc_html__( 'Choose if you want to enable related posts section in single blog post', 'reen' ),
            'id'        => 'enable_related_posts',
            'on'        => esc_html__( 'Yes', 'reen' ),
            'off'       => esc_html__( 'No', 'reen' ),
            'type'      => 'switch',
            'default'   => false,
        ),
    )
 ) );