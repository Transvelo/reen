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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

