<?php
/**
 * Plugin Name:     Reen Extensions
 * Plugin URI:      https://madrasthemes.com/reen
 * Description:     This selection of extensions compliment our lean and mean theme reen. Please note: they don’t work with any WordPress theme, just reen.
 * Author:          MadrasThemes
 * Author URI:      https://madrasthemes.com/
 * Version:         0.0.1
 * Text Domain:     reen-extensions
 * Domain Path:     /languages
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define FRONT_PLUGIN_FILE.
if ( ! defined( 'FRONT_PLUGIN_FILE' ) ) {
    define( 'FRONT_PLUGIN_FILE', __FILE__ );
}

if( ! class_exists( 'Reen_Extensions' ) ) {
    /**
     * Main Reen_Extensions Class
     *
     * @class Reen_Extensions
     * @version 1.0.0
     * @since 1.0.0
     * @package Reen
     * @author MadrasThemes
     */
    final class Reen_Extensions {

        /**
         * Reen_Extensions The single instance of Reen_Extensions.
         * @var     object
         * @access  private
         * @since   1.0.0
         */
        private static $_instance = null;

        /**
         * The token.
         * @var     string
         * @access  public
         * @since   1.0.0
         */
        public $token;

        /**
         * The version number.
         * @var     string
         * @access  public
         * @since   1.0.0
         */
        public $version;

        /**
         * Constructor function.
         * @access  public
         * @since   1.0.0
         * @return  void
         */
        public function __construct () {

            $this->token    = 'reen-extensions';
            $this->version  = '1.0.0';

            add_action( 'plugins_loaded', array( $this, 'setup_constants' ),        10 );
            add_action( 'plugins_loaded', array( $this, 'includes' ),               20 );
        }

        /**
         * Main Reen_Extensions Instance
         *
         * Ensures only one instance of Reen_Extensions is loaded or can be loaded.
         *
         * @since 1.0.0
         * @static
         * @see Reen_Extensions()
         * @return Main Reen instance
         */
        public static function instance () {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * Setup plugin constants
         *
         * @access public
         * @since  1.0.0
         * @return void
         */
        public function setup_constants() {

            // Plugin Folder Path
            if ( ! defined( 'REEN_EXTENSIONS_DIR' ) ) {
                define( 'REEN_EXTENSIONS_DIR', plugin_dir_path( __FILE__ ) );
            }

            // Plugin Folder URL
            if ( ! defined( 'REEN_EXTENSIONS_URL' ) ) {
                define( 'REEN_EXTENSIONS_URL', plugin_dir_url( __FILE__ ) );
            }

            // Plugin Root File
            if ( ! defined( 'REEN_EXTENSIONS_FILE' ) ) {
                define( 'REEN_EXTENSIONS_FILE', __FILE__ );
            }

            $this->define( 'REEN_ABSPATH', dirname( REEN_EXTENSIONS_FILE ) . '/' );
            $this->define( 'REEN_VERSION', $this->version );
        }

        /**
         * Define constant if not already set.
         *
         * @param string      $name  Constant name.
         * @param string|bool $value Constant value.
         */
        private function define( $name, $value ) {
            if ( ! defined( $name ) ) {
                define( $name, $value );
            }
        }

        /**
         * What type of request is this?
         *
         * @param  string $type admin, ajax, cron or frontend.
         * @return bool
         */
        private function is_request( $type ) {
            switch ( $type ) {
                case 'admin':
                    return is_admin();
                case 'ajax':
                    return defined( 'DOING_AJAX' );
                case 'cron':
                    return defined( 'DOING_CRON' );
                case 'frontend':
                    return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' ) && ! $this->is_rest_api_request();
            }
        }

        /**
         * Include required files
         *
         * @access public
         * @since  1.0.0
         * @return void
         */
        public function includes() {
            /**
             * Class autoloader.
             */
            //include_once REEN_EXTENSIONS_DIR . '/includes/class-front-autoloader.php';
            
            /**
             * Core classes.
             */
            //require REEN_EXTENSIONS_DIR . '/includes/functions.php';
            //require REEN_EXTENSIONS_DIR . '/includes/front-core-functions.php';

            /**
             * WP Job Manger.
             */
            //require_once REEN_EXTENSIONS_DIR . '/modules/wp-job-manager/class-front-wpjm-job-manager.php';

            if ( $this->is_request( 'admin' ) ) {
                include_once REEN_EXTENSIONS_DIR . '/includes/admin/class-reen-admin.php';
            }
        }


        /**
         * Get the plugin url.
         *
         * @return string
         */
        public function plugin_url() {
            return untrailingslashit( plugins_url( '/', REEN_PLUGIN_FILE ) );
        }

        /**
         * Cloning is forbidden.
         *
         * @since 1.0.0
         */
        public function __clone () {
            _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'reen-extensions' ), '1.0.0' );
        }

        /**
         * Unserializing instances of this class is forbidden.
         *
         * @since 1.0.0
         */
        public function __wakeup () {
            _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'reen-extensions' ), '1.0.0' );
        }
    }
}

/**
 * Returns the main instance of Reen_Extensions to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Reen_Extensions
 */
function Reen_Extensions() {
    return Reen_Extensions::instance();
}

/**
 * Initialise the plugin
 */
Reen_Extensions();
