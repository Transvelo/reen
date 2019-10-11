<?php
/**
 * Redux Framework functions
 *
 * @package REEN/ReduxFramework
 */

/**
 * Setup functions for theme options
 */

function reen_remove_demo_mode_link() {
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}

function reen_redux_disable_dev_mode_and_remove_admin_notices( $redux ) {
    remove_action( 'admin_notices', array( $redux, '_admin_notices' ), 99 );
    $redux->args['dev_mode'] = false;
    $redux->args['forced_dev_mode_off'] = false;
}

/**s
 * Enqueues font awesome for Redux Theme Options
 * 
 * @return void
 */
function redux_queue_font_awesome() {
    wp_register_style( 'redux-fontawesome', get_template_directory_uri() . '/assets/css/fontawesome-all.min.css', array(), time(), 'all' );
    wp_enqueue_style( 'redux-fontawesome' );
}

require_once get_template_directory() . '/inc/redux-framework/functions/portfolio-functions.php';