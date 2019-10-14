<?php
/**
 * REEN Jetpack Class
 *
 * @package  REEN
 * @since    1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'REEN_Jetpack' ) ) :

    /**
     * The REEN Jetpack integration class
     */
    class REEN_Jetpack {
        /**
         * Setup class
         *
         * @since 1.0
         */
        public function __construct() {
            add_action( 'wp_enqueue_scripts', array( $this, 'jetpack_scripts' ), 10 );

            add_post_type_support( 'jetpack-portfolio', 'post-formats');
            add_post_type_support( 'jetpack-portfolio', array('custom-fields'));

        }

        /**
         * Enqueue jetpack styles.
         *
         * @since  1.0.0
         */
        public function jetpack_scripts() {
            global $reen_version;

            wp_enqueue_style( 'reen-jetpack-style', get_template_directory_uri() . '/assets/css/jetpack/jetpack.css', '', $reen_version );
            wp_style_add_data( 'reen-jetpack-style', 'rtl', 'replace' );
        }
    }

endif;

return new REEN_Jetpack();