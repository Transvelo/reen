<?php

function reen_ocdi_before_import_setup() {
    if ( class_exists( 'Jetpack_Options' ) ) {
        $current_modules = Jetpack_Options::get_option( 'active_modules', array() );
        $current_modules[] = 'custom-content-types';
        Jetpack_Options::update_option( 'active_modules', $current_modules );

        update_option( 'jetpack_portfolio', '1' ); //Enable Portfolio
        update_option( 'jetpack_testimonial', '1' ); //Enable Testimonial
    }

    // Update WPForms Settings
    if ( function_exists( 'wpforms' ) ) {
        $settings = get_option( 'wpforms_settings', array() );
        $settings['disable-css'] = '2';
        update_option( 'wpforms_settings', $settings );
    }
}

function reen_ocdi_import_files() {
    $dd_path = trailingslashit( get_template_directory() ) . 'assets/dummy-data/';
    return apply_filters( 'reen_ocdi_files_args', array(
        array(
            'import_file_name'             => 'Reen',
            'categories'                   => array( 'Reen' ),
            'local_import_file'            => $dd_path . 'dummy-data.xml',
            'local_import_widget_file'     => $dd_path . 'widgets.wie',
            'local_import_redux'           => array(
                array(
                    'file_path'   => $dd_path . 'redux-options.json',
                    'option_name' => 'reen_options',
                ),
            ),
            'import_notice'                => esc_html__( 'Import process may take 3-5 minutes. If you facing any issues please contact our support.', 'reen' ),
            'preview_url'                  => 'https://demo2.madrasthemes.com/reen/',
        ),
    ) );
}

function reen_ocdi_after_import_setup( $selected_import ) {
    
    // Assign menus to their locations.
    $primary        = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
    $topbar_left    = get_term_by( 'name', 'Top Bar Left', 'nav_menu' );
    $topbar_right   = get_term_by( 'name', 'Top Bar Right', 'nav_menu' );
    $footer_menu    = get_term_by( 'name', 'Footer Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
        'primary'               => $primary->term_id,
        'topbar_left'           => $topbar_left->term_id,
        'topbar_right'          => $topbar_right->term_id,
        'footer_menu'           => $footer_menu->term_id,
    ) );

    // Assign Pages
    $front_page_id      = get_page_by_title( 'Product Style' );
    $blog_page_id       = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );
}

function reen_ocdi_before_widgets_import() {

    $sidebars_widgets = get_option('sidebars_widgets');
    $all_widgets = array();

    array_walk_recursive( $sidebars_widgets, function ($item, $key) use ( &$all_widgets ) {
        if( ! isset( $all_widgets[$key] ) ) {
            $all_widgets[$key] = $item;
        } else {
            $all_widgets[] = $item;
        }
    } );

    if( isset( $all_widgets['array_version'] ) ) {
        $array_version = $all_widgets['array_version'];
        unset( $all_widgets['array_version'] );
    }

    $new_sidebars_widgets = array_fill_keys( array_keys( $sidebars_widgets ), array() );

    $new_sidebars_widgets['wp_inactive_widgets'] = $all_widgets;
    if( isset( $array_version ) ) {
        $new_sidebars_widgets['array_version'] = $array_version;
    }

    update_option( 'sidebars_widgets', $new_sidebars_widgets );
}

function reen_wp_import_post_data_processed( $postdata, $data ) {
    $theme_content_find_url = 'https://demo2.madrasthemes.com/reen/wp-content/themes/reen/';
    $theme_content_url = content_url( '/themes/reen/' );
    $postdata = str_replace( $theme_content_find_url, $theme_content_url, $postdata );

    if ( defined( 'REENGB_FILE' ) ) {
        $plugin_dist_find_url = 'https://demo2.madrasthemes.com/reen/wp-content/plugins/reen-gutenberg-blocks/';
        $plugin_dist_url = untrailingslashit( plugins_url( '/', REENGB_FILE ) ) . '/';
        $postdata = str_replace( $plugin_dist_find_url, $plugin_dist_url, $postdata );
    }

    $postdata = str_replace( 'https://demo2.madrasthemes.com/reen/', home_url('/'), $postdata );

    return wp_slash($postdata);
}