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

            add_post_type_support( 'jetpack-portfolio', 'post-formats');
            add_post_type_support( 'jetpack-portfolio', array('custom-fields'));

        }
    }

endif;

return new REEN_Jetpack();