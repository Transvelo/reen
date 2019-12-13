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

function reen_ocdi_get_import_notice() {
    $instructions = esc_html__( 'Import process may take 3-5 minutes. If you facing any issues please contact our support.', 'reen' );

    $instructions .= '<strong class="reen-ocdi-install-plugin-instructions" style="color:red; display:none;"><br><br>' . esc_html__( 'Make sure all the required plugins are activated and check Testimonial & Portfolio enabled in Jetpack > Settings > Writing.', 'reen' ) . '</strong>';

    $instructions .= '<strong class="reen-ocdi-jetpack-module-instructions" style="display:none; color:red;"><br><br>' . esc_html__( 'Make sure Testimonial and Portfolio enabled in Jetpack > Settings > Writing.', 'reen' ) . '</strong>';

    return $instructions;
}

function reen_ocdi_admin_scripts() {
    $tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
    if( $tgmpa_instance->is_tgmpa_complete() != true ) {
        $script = "
            jQuery(document).ready( function($){
                $( '.ocdi__demo-import-notice' ).siblings( '.ocdi__button-container' ).children( '.js-ocdi-import-data' ).attr( 'disabled', 'disabled' );
                $( '.reen-ocdi-install-plugin-instructions' ).show();
                $( '.reen-ocdi-jetpack-module-instructions' ).hide();
            } );
        ";
        wp_add_inline_script( 'ocdi-main-js', $script );
    } elseif( !( function_exists( 'reen_jp_is_portfolio_activated' ) && function_exists( 'reen_jp_is_testimonial_activated' ) && reen_jp_is_portfolio_activated() && reen_jp_is_testimonial_activated() ) ) {

        $script = "
            jQuery(document).ready( function($){
                $( '.ocdi__demo-import-notice' ).siblings( '.ocdi__button-container' ).children( '.js-ocdi-import-data' ).attr( 'disabled', 'disabled' );
                $( '.reen-ocdi-install-plugin-instructions' ).hide();
                $( '.reen-ocdi-jetpack-module-instructions' ).show();
            } );
        ";
        wp_add_inline_script( 'ocdi-main-js', $script );
    } else {
         $script = "
            jQuery(document).ready( function($){
                $( '.reen-ocdi-install-plugin-instructions' ).hide();
                $( '.reen-ocdi-jetpack-module-instructions' ).hide();
            } );
        ";
        wp_add_inline_script( 'ocdi-main-js', $script );
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
            'import_notice'                => reen_ocdi_get_import_notice(),
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

    // Import WPForms
    reen_ocdi_import_wpforms();
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

function reen_ocdi_import_wpforms() {
    if ( ! function_exists( 'wpforms' ) ) {
        return;
    }

    $forms = [
        [
            'file' => 'wpforms-contact.json',
            'file' => 'wpforms-newsletter.json'
        ]
    ];

    foreach ( $forms as $form ) {
        $form_data = json_decode( reen_get_template( $form['file'], array(), 'assets/dummy-data/' ), true );

        if ( empty( $form_data[0] ) ) {
            continue;
        }
        $form_data = $form_data[0];
        // Create initial form to get the form ID.
        $form_id   = wpforms()->form->add( $form_data['settings']['form_title'] );

        if ( empty( $form_id ) ) {
            continue;
        }

        $form_data['id'] = $form_id;
        // Save the form data to the new form.
        wpforms()->form->update( $form_id, $form_data );
    }
}