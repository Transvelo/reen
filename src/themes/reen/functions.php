<?php
/**
 * REEN functions and definitions
 *
 *
 * @package REEN
 */


/**
 * Assign the Reen version to a var
 */
$theme         = wp_get_theme( 'reen' );
$reen_version = $theme['Version'];


$reen = (object) array(
    'version'    => $reen_version,

    /**
     * Initialize all the things.
     */
    'main'       => require get_template_directory() . '/inc/class-reen.php',
);


require_once get_template_directory() . '/inc/reen-template-functions.php';
require_once get_template_directory() . '/inc/reen-template-hooks.php';
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Functions used in Front
 */
require get_template_directory() . '/inc/reen-functions.php';
 
require get_template_directory() . '/classes/class-reen-social-media-walker.php';

/**
 * Topbar Navwalker
 */
require get_template_directory() . '/classes/class-reen-topbar-walker.php';

/**
 * Nav Bar Navwalker
 */
require get_template_directory() . '/classes/class-reen-wp-bootstrap-navwalker.php';

/**
 * Nav Menu related functions.
 */
require get_template_directory() . '/inc/reen-menu-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/inc/jetpack.php';
}

if ( reen_is_jetpack_activated() ) {
    $reen->jetpack = require_once get_template_directory() . '/inc/jetpack/reen-jetpack-functions.php';
    require_once get_template_directory() . '/inc/jetpack/reen-jetpack-template-functions.php';
    require_once get_template_directory() . '/inc/jetpack/reen-jetpack-template-hooks.php';
}

if ( reen_is_redux_activated() ) {
    require_once get_template_directory() . '/inc/redux-framework/reen-options.php';
    require_once get_template_directory() . '/inc/redux-framework/functions.php';
    require_once get_template_directory() . '/inc/redux-framework/hooks.php';
}
