<?php
/**
 * Options available for Styling sub menu of Theme Options
 *
 */

$custom_css_page_link = '<a href="' . esc_url( add_query_arg( array( 'page' => 'custom-primary-color-css-page' ) ), admin_url( 'themes.php' ) ) . '">' . esc_html__( 'Custom Primary CSS', 'reen' ) . '</a>';

$style_options 	= apply_filters( 'reen_style_options_args', array(
	'title'		=> esc_html__( 'Styling', 'reen' ),
	'icon'		=> 'fas fa-edit',
	'fields'	=> array(
		array(
			'id'		=> 'styling_general_info_start',
			'type'		=> 'section',
			'title'		=> esc_html__( 'General', 'reen' ),
			'subtitle'	=> esc_html__( 'General Theme Style Settings', 'reen' ),
			'indent'	=> TRUE,
		),

		array(
			'title'		=> esc_html__( 'Use a predefined color scheme', 'reen' ),
			'on'		=> esc_html__('Yes', 'reen'),
			'off'		=> esc_html__('No', 'reen'),
			'type'		=> 'switch',
			'default'	=> 1,
			'id'		=> 'use_predefined_color'
		),

		array(
			'title'		=> esc_html__( 'Main Theme Color', 'reen' ),
			'subtitle'	=> esc_html__( 'The main color of the site.', 'reen' ),
			'id'		=> 'main_color',
			'type'		=> 'select',
			'options'	=> array(
				'green'			=> esc_html__( 'Green', 'reen' ),
				'blue'			=> esc_html__( 'Blue', 'reen' ),
				'red'		    => esc_html__( 'Red', 'reen' ),
				'pink'			=> esc_html__( 'Pink', 'reen' ),
				'purple'	    => esc_html__( 'Purple', 'reen' ),
				'orange'		=> esc_html__( 'Orange', 'reen' ),
				'gray'			=> esc_html__( 'Gray', 'reen' ),
				'navy'			=> esc_html__( 'Navy', 'reen' ),
			),
			'default'	=> 'green',
			'required'	=> array( 'use_predefined_color', 'equals', 1 ),
		),

		array(
			'id'		  => 'custom_primary_color',
			'title'		  => esc_html__( 'Custom Primary Color', 'reen' ),
			'type'		  => 'color',
			'transparent' => false,
			'default'	  => '#1ABB9C',
			'required'	  => array( 'use_predefined_color', 'equals', 0 ),
		),
		array(
			'id'		  => 'include_custom_color',
			'title'		  => esc_html__( 'How to include custom color ?', 'reen' ),
			'type'		  => 'radio',
			'options'     => array(
				'1'  => esc_html__( 'Inline', 'reen' ),
				'2'  => esc_html__( 'External File', 'reen' )
			),
			'default'     => '1',
			'required'	  => array( 'use_predefined_color', 'equals', 0 ),
		),

		array(
			'id'		=> 'external_file_css',
			'type'      => 'raw',
			'title'		=> esc_html__( 'Custom Primary Color CSS', 'reen' ),
			'content'  	=> esc_html__( 'If you choose "External File", then please "Save Changes" and then click on ths link to get the custom color primary CSS: ', 'reen' ) . $custom_css_page_link,
			'required'	=> array( 'use_predefined_color', 'equals', 0 ),
		),

		array(
			'id'		=> 'styling_general_info_end',
			'type'		=> 'section',
			'indent'	=> FALSE,
		),
	)
) );
