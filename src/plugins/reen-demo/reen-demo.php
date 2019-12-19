<?php
/**
 * Plugin Name:     Reen Demo
 * Plugin URI:      https://madrasthemes.com/reen
 * Description:     This selection of demo compliment our lean and mean theme for WooCommerce, Reen. Please note: they don’t work with any WordPress theme, just Reen.
 * Author:          MadrasThemes
 * Author URI:      https://madrasthemes.com/
 * Version:         0.0.60
 * Text Domain:     reen-demo
 * Domain Path:     /languages
 * WC tested up to: 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( ! class_exists( 'Reen_Demo' ) ) {
    /**
     * Main Reen_Demo Class
     *
     * @class Reen_Demo
     * @version 1.0.0
     * @since 1.0.0
     * @package Kudos
     * @author Ibrahim
     */
    final class Reen_Demo {
        /**
         * Reen_Demo The single instance of Reen_Demo.
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
         * The array of templates that this plugin tracks.
         *
         */
        protected $templates;

        
        /**
         * The cache key to used to retrieve page templates
         *
         */
        protected $cache_key;

        /**
         * Constructor function.
         * @access  public
         * @since   1.0.0
         * @return  Reen
         */
        public function __construct () {
            
            $this->token    = 'reen-demo';
            $this->version  = '1.0.4';
            
            add_action( 'plugins_loaded', array( $this, 'setup_constants' ),        10 );
            add_action( 'plugins_loaded', array( $this, 'includes' ),               20 );
            add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ), 30 );
            add_action( 'plugins_loaded', array( $this, 'page_templates_init' ),    40 );
        }

        /**
         * Main Reen_Demo Instance
         *
         * Ensures only one instance of Reen_Demo is loaded or can be loaded.
         *
         * @since 1.0.0
         * @static
         * @see Reen_Demo()
         * @return Main Kudos instance
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
         * @return reen
         */
        public function setup_constants() {

            // Plugin Folder Path
            if ( ! defined( 'REEN_DEMO_DIR' ) ) {
                define( 'REEN_DEMO_DIR', plugin_dir_path( __FILE__ ) );
            }

            // Plugin Folder URL
            if ( ! defined( 'REEN_DEMO_URL' ) ) {
                define( 'REEN_DEMO_URL', plugin_dir_url( __FILE__ ) );
            }

            // Plugin Root File
            if ( ! defined( 'REEN_DEMO_FILE' ) ) {
                define( 'REEN_DEMO_FILE', __FILE__ );
            }
        }

        /**
         * Include required files
         *
         * @access public
         * @since  1.0.0
         * @return reen
         */
        public function includes() {
            require_once REEN_DEMO_DIR . 'includes/classes/class-reen-template-loader.php';
            require_once REEN_DEMO_DIR . 'includes/modules/blog/blog-functions.php';
            require_once REEN_DEMO_DIR . 'functions/reen-demo-functions.php';
        }

        /**
         * Load the localisation file.
         * @access  public
         * @since   1.0.0
         * @return  reen
         */
        public function load_plugin_textdomain() {
            load_plugin_textdomain( 'reen-demo', false, dirname( plugin_basename( REEN_DEMO_FILE ) ) . '/languages/' );
        }

        /**
         * Include page templates settings init
         *
         * @access public
         * @since  1.0.0

         * @return reen
         */
        public function page_templates_init() {

            $this->templates = array();

            // Add a filter to the page attributes metabox to inject our template into the page template cache.
            if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {
                add_filter('page_attributes_dropdown_pages_args', array( $this, 'register_page_templates' ) );
            } else {
                add_filter('theme_page_templates', array( $this, 'add_new_page_template' ) );
            }

            // Add a filter to the save post in order to inject out template into the page cache
            add_filter('wp_insert_post_data', array( $this, 'register_page_templates' ) );

            // Add a filter to the template include in order to determine if the page has our template assigned and return it's path
            add_filter('template_include', array( $this, 'view_page_templates') );

            // Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
            register_deactivation_hook( REEN_DEMO_FILE, array( $this, 'deactivate' ) );

            // Add your templates to this array.
            $this->templates = array(
                'template-portfolio.php'      => esc_html__( 'Portfolio-Demo', 'portfolio-demo' ),
            );

            // adding support for theme templates to be merged and shown in dropdown
            $templates = wp_get_theme()->get_page_templates();
            $templates = array_merge( $templates, $this->templates );
        }

        /**
         * Adds our template to the pages cache in order to trick WordPress
         * into thinking the template file exists where it doens't really exist.
         *
         * @param   array    $atts    The attributes for the page attributes dropdown
         * @return  array    $atts    The attributes for the page attributes dropdown
         * @verison 1.0.0
         * @since   1.0.0
         */
        public function register_page_templates( $atts ) {

            // Create the key used for the themes cache
            $this->cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

            // Retrieve the cache list. If it doesn't exist, or it's empty prepare an array
            $templates = wp_cache_get( $this->cache_key, 'themes' );
            if ( empty( $templates ) ) {
                $templates = array();
            } // end if

            // Since we've updated the cache, we need to delete the old cache
            wp_cache_delete( $this->cache_key , 'themes');

            // Now add our template to the list of templates by merging our templates
            // with the existing templates array from the cache.
            $templates = array_merge( $templates, $this->templates );

            // Add the modified cache to allow WordPress to pick it up for listing
            // available templates
            wp_cache_add( $this->cache_key, $templates, 'themes', 1800 );

            return $atts;

        } // end register_page_templates

        /**
        * Adds our template to the page dropdown for v4.7+
        *
        */
        public function add_new_page_template( $posts_templates ) {
            $posts_templates = array_merge( $posts_templates, $this->templates );
            return $posts_templates;
        }

        /**
         * Checks if the template is assigned to the page
         *
         * @version 1.0.0
         * @since   1.0.0
         */
        public function view_page_templates( $template ) {

            global $post;

            // If no posts found, return to
            // areen "Trying to get property of non-object" error
            if ( !isset( $post ) ) return $template;

            if ( ! isset( $this->templates[ get_post_meta( $post->ID, '_wp_page_template', true ) ] ) ) {
                return $template;
            } // end if

            $file = REEN_DEMO_DIR . 'templates/' . get_post_meta( $post->ID, '_wp_page_template', true );
            // Just to be safe, we check if the file exist first
            if( file_exists( $file ) ) {
                return $file;
            } // end if

            return $template;

        } // end view_page_templates

        /*--------------------------------------------*
         * deactivate the plugin
         *---------------------------------------------*/
        static function deactivate( $network_wide ) {
            foreach( $this as $value ) {
                Reen_Demo::delete_template( $value );
            }
            
        } // end deactivate

         /*--------------------------------------------*
         * Delete Templates from Theme
         *---------------------------------------------*/
            public function delete_template( $filename ){
                $theme_path = get_template_directory();
                $template_path = $theme_path . '/' . $filename;  
                if( file_exists( $template_path ) ) {
                    unlink( $template_path );
                }

                // we should probably delete the old cache
                wp_cache_delete( $this->cache_key , 'themes');
        }


        /**
         * Cloning is forbidden.
         *
         * @since 1.0.0
         */
        public function __clone () {
            _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'reen-demo' ), '1.0.4' );
        }

        /**
         * Unserializing instances of this class is forbidden.
         *
         * @since 1.0.0
         */
        public function __wakeup () {
            _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'reen-demo' ), '1.0.4' );
        }
    }
}

    /**
     * Returns the main instance of Reen_Demo to prevent the need to use globals.
     *
     * @since  1.0.0
     * @return object Reen_Demo
     */
    function Reen_Demo() {
        return Reen_Demo::instance();
    }

    /**
     * Initialise the plugin
     */
Reen_Demo();