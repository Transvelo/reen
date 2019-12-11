<?php
/**
 * Plugin Name:     Reen Extensions
 * Plugin URI:      https://madrasthemes.com/reen
 * Description:     This selection of extensions compliment our lean and mean theme for WooCommerce, reen. Please note: they don’t work with any WordPress theme, just reen.
 * Author:          MadrasThemes
 * Author URI:      https://madrasthemes.com/
 * Version:         0.0.50
 * Text Domain:     Reen-extensions
 * Domain Path:     /languages
 * WC tested up to: 3.6.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( ! class_exists( 'Reen_Extensions' ) ) {
    /**
     * Main Reen_Extensions Class
     *
     * @class Reen_Extensions
     * @version 1.0.0
     * @since 1.0.0
     * @package reen
     * @author MadrasThemes
     */
    final class Reen_Extensions {
        /**
         * Reen_Extensions The single instance of Jobhunt_Extensions.
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
            //add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ),  30 );
        }

        /**
         * Main Reen_Extensions Instance
         *
         * Ensures only one instance of Reen_Extensions is loaded or can be loaded.
         *
         * @since 1.0.0
         * @static
         * @see Reen_Extensions()
         * @return Main reen instance
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

            // Modules File
            if ( ! defined( 'REEN_MODULES_DIR' ) ) {
                define( 'REEN_MODULES_DIR', REEN_EXTENSIONS_DIR . '/modules' );
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
            require REEN_EXTENSIONS_DIR . '/includes/function.php';
        }

        /**
         * Load the localisation file.
         * @access  public
         * @since   1.0.0
         * @return  reen
         */
        public function load_plugin_textdomain() {
            load_plugin_textdomain( 'reen-extensions', false, dirname( plugin_basename( REEN_EXTENSIONS_FILE ) ) . '/languages/' );
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