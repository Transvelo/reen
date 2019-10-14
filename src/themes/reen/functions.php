<?php
/**
 * REEN functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
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


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function reen_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'reen_content_width', 640 );
}
add_action( 'after_setup_theme', 'reen_content_width', 0 );

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

