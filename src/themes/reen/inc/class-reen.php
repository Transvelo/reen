<?php
/**
 * Reen Class
 *
 * @since    1.0.0
 * @package  reen
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Reen' ) ) :

    /**
     * The main Reen class
     */
    class Reen {

        /**
         * Setup class.
         *
         * @since 1.0
         */
        public function __construct() {
            add_action( 'after_setup_theme', array( $this, 'setup' ) );
            add_action( 'after_setup_theme', array( $this, 'content_width' ), 0 );
            add_action( 'after_setup_theme', array( $this, 'reen_template_debug_mode' ) );
            add_action( 'widgets_init', array( $this, 'widgets_init' ) );
            add_action( 'enqueue_block_editor_assets',  array( $this, 'block_editor_assets' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 10 );
            add_action( 'wp_enqueue_scripts', array( $this, 'child_scripts' ), 30 ); // After WooCommerce.
        }

        /**
         * Sets up theme defaults and registers support for various WordPress features.
         *
         * Note that this function is hooked into the after_setup_theme hook, which
         * runs before the init hook. The init hook is too late for some features, such
         * as indicating support for post thumbnails.
         */
        public function setup() {
            /*
             * Load Localisation files.
             *
             * Note: the first-loaded translation file overrides any following ones if the same translation is present.
             */

            // Loads wp-content/themes/reen/languages/it_IT.mo.
            load_theme_textdomain( 'reen', get_template_directory() . '/languages' );

            /**
             * Add default posts and comments RSS feed links to head.
             */
            add_theme_support( 'automatic-feed-links' );

            /*
             * Enable support for Post Thumbnails on posts and pages.
             *
             * @link https://developer.wordpress.org/reference/functions/add_theme_support/#Post_Thumbnails
             */
            add_theme_support( 'post-thumbnails' );

            // Set up the WordPress core custom background feature.
            add_theme_support( 'custom-background', apply_filters( 'reen_custom_background_args', array(
                'default-color' => 'ffffff',
                'default-image' => '',
            ) ) );

            /**
             * Add support for core custom logo.
             *
             * @link https://codex.wordpress.org/Theme_Logo
             */

            add_theme_support(
                'custom-logo', apply_filters(
                    'reen_custom_logo_args', array(
                        'height'      => 250,
                        'width'       => 250,
                        'flex-width'  => true,
                        'flex-height' => true,
                    )
                )
            );


            /*
             * Enable support for Post Formats.
            */
            add_theme_support(
                'post-formats',
                array(
                    'aside',
                    'image',
                    'video',
                    'quote',
                    'link',
                    'gallery',
                    'status',
                    'audio',
                )
            );


            // Declare WooCommerce support.
            add_theme_support( 'woocommerce', apply_filters( 'reen_woocommerce_args', array(
                'product_grid'          => array(
                    'default_columns' => 3,
                    'default_rows'    => 4,
                    'min_columns'     => 1,
                    'max_columns'     => 6,
                    'min_rows'        => 1
                )
            ) ) );

            // Declare WooCommerce support.
            add_theme_support( 'woocommerce' );

     
            /**
             * Register menu locations.
             */

             // This theme uses wp_nav_menu() in one location.
            register_nav_menus(
                apply_filters(
                    'reen_register_nav_menus', array(
						'primary' => esc_html__( 'Primary', 'reen' ),
                        'topbar_right' => esc_html__( 'Tob Right Menu', 'reen' ),
                        'topbar_left' => esc_html__( 'Top Left Menu', 'reen' ),
                    )
                )
            );

            /*
             * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
             * to output valid HTML5.
             */
            add_theme_support(
                'html5', apply_filters(
                    'reen_html5_args', array(
                        'search-form',
                        'comment-form',
                        'comment-list',
                        'gallery',
                        'caption',
                        'widgets',
                    )
                )
            );

            /**
             * Declare support for title theme feature.
             */
            add_theme_support( 'title-tag' );

            /**
             * Declare support for selective refreshing of widgets.
             */
            add_theme_support( 'customize-selective-refresh-widgets' );

            /**
             * Declare support for editor styles.
             */
            add_theme_support( 'editor-styles' );

            /**
             * Enqueue editor styles.
             */
            add_editor_style( array( get_template_directory_uri() . '/assets/css/gutenberg-editor.css', get_template_directory_uri() . '/style.css', $this->google_fonts() ) );
        }

        /**
         * Set the content width in pixels, based on the theme's design and stylesheet.
         *
         * Priority 0 to make it available to lower priority callbacks.
         *
         * @global int $content_width Content width.
         */
        function content_width() {
            // This variable is intended to be overruled from themes.
            // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
            // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
            $GLOBALS['content_width'] = apply_filters( 'reen_content_width', 640 );
        }

        /**
         * Register widget area.
         *
         * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
         */
        public function widgets_init() {

            register_sidebar( array(
                'name'          => esc_html__( 'Sidebar', 'reen' ),
                'id'            => 'sidebar-1',
                'description'   => esc_html__( 'Add widgets here.', 'reen' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );            
        }

        /**
         * Get all Reen scripts.
         */
        // private static function get_theme_scripts() {
        //     $js_path = get_template_directory_uri() . '/assets/js/';
        //     $js_vendors = apply_filters( 'reen_js_vendors', array(
        //         'popper' => array( 
        //             'src' => $js_path . 'popper.min.js',
        //             'dep' => array( 'jquery' )
        //         ),
        //         'bootstrap' => array( 
        //             'src' => $js_path . 'bootstrap.min.js',
        //             'dep' => array( 'jquery', 'popper' )
        //         ),
        //         'jquery-form' => array(
        //             'src' => $js_path . 'jquery.form.js',
        //             'dep' => array( 'jquery' )
        //         ),
        //         'jquery-easing' => array(
        //             'src' => $js_path . 'jquery.easing.min.js',
        //             'dep' => array( 'jquery' )
        //         ),
        //         'jquery-validation' => array(
        //             'src' => $js_path . 'jquery.validate.min.js',
        //             'dep' => array( 'jquery' )
        //         ),
        //         'affix' => array(
        //             'src' => $js_path . 'affix.js',
        //             'dep' => array( 'jquery' )
        //         ),
        //         'aos' => array(
        //             'src' => $js_path . 'aos.js',
        //             'dep' => array( 'jquery' )
        //         ),
        //         'owl-carousel' => array(
        //             'src' => $js_path . 'owl.carousel.min.js',
        //             'dep' => array( 'jquery' )
        //         ),
        //         'jquery-isotope' => array(
        //             'src' => $js_path . 'jquery.isotope.min.js',
        //             'dep' => array( 'jquery' )
        //         ),
        //         'imagesloaded-pkgd' => array(
        //             'src' => $js_path . 'imagesloaded.pkgd.min.js',
        //             'dep' => array( 'jquery' )
        //         ),
        //         'jquery-easytabs' => array(
        //             'src' => $js_path . 'jquery.easytabs.min.js',
        //             'dep' => array( 'jquery' )
        //         ),
        //         'viewport-units-buggyfill' => array(
        //             'src' => $js_path . 'viewport-units-buggyfill.js',
        //             'dep' => array( 'jquery' )
        //         ),
        //         'selected-scroll' => array(
        //             'src' => $js_path . 'selected-scroll.js',
        //             'dep' => array( 'jquery' )
        //         ),
        //         'reen-scripts' => array(
        //             'src' => $js_path . 'scripts.js',
        //             'dep' => array( 'jquery' )
        //         ),
        //     ) );

        //     return $js_vendors;
        // }

        /**
         * Enqueue scripts and styles.
         *
         * @since  1.0.0
         */
        public function scripts() {
            global $reen_version;

            /**
             * Styles
             */
            $vendors = apply_filters( 'reen_vendor_styles', array(
                'animate'                    => 'animate.css/animate.min.css',
                'aos'                        => 'aos/aos.css',
                'bootstrap'                  => 'bootstrap/bootstrap.css',
                'owl-carousel'               => 'owl-carousel/owl.carousel.css',
            ) );

            foreach( $vendors as $key => $vendor ) {
                wp_enqueue_style( $key, get_template_directory_uri() . '/assets/vendor/' . $vendor, '', $reen_version );
            }

            wp_enqueue_style( 'reen-style', get_template_directory_uri() . '/style.css', '', $reen_version );
            wp_style_add_data( 'reen-style', 'rtl', 'replace' );


            wp_enqueue_style( 'reen-fontello', get_template_directory_uri() . '/assets/fonts/fontello.css', '', $reen_version );
            wp_style_add_data( 'reen-icons', 'rtl', 'replace' );

            /**
             * Fonts
             */

            wp_enqueue_style( 'reen-fonts', $this->google_fonts(), array(), null );

            /**
             * Scripts
             */
            $suffix = '.min';

            wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap' . $suffix . '.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'jquery-form', get_template_directory_uri() . '/assets/js/jquery.form.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/assets/js/jquery.easing' . $suffix . '.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'jquery.validate', get_template_directory_uri() . '/assets/js/jquery.validate' . $suffix . '.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper' . $suffix . '.js', array( 'jquery' ), '1.14.4', true );

            wp_enqueue_script( 'affix', get_template_directory_uri() . '/assets/js/affix.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'aos', get_template_directory_uri() . '/assets/js/aos.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel' . $suffix . '.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'jquery-isotope', get_template_directory_uri() . '/assets/js/jquery.isotope' . $suffix . '.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'imagesloaded-pkgd', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery-isotope' ), $reen_version, true );

            wp_enqueue_script( 'jquery-easytabs', get_template_directory_uri() . '/assets/js/jquery.easytabs' . $suffix . '.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'viewport-units-buggyfill', get_template_directory_uri() . '/assets/js/viewport-units-buggyfill' . $suffix . '.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'selected-scroll', get_template_directory_uri() . '/assets/js/selected-scroll' . $suffix . '.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'reen-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

            wp_enqueue_script( 'reen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }

             wp_enqueue_script( 'reen-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), $reen_version, true );

        }

        /**
         * Register Google fonts.
         *
         * @since 1.0.0
         * @return string Google fonts URL for the theme.
         */
        public function google_fonts() {

            $google_fonts = apply_filters(
                'reen_google_font_families', array(
                    'lato' => 'Lato:300,400,500,700,900',
                    'source-sans-pro'  => 'Source+Sans+Pro:400,700,400italic,700italic'
                )
            );

            $query_args = array(
                'family' => implode( '|', $google_fonts ),
                'subset' => rawurlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

            return $fonts_url;
        }

        /**
         * Enqueue supplemental block editor assets.
         *
         * @since 1.0.0
         */
        public function block_editor_assets() {
            global $reen_version;

            // Styles.
            $vendors = apply_filters( 'reen_editor_vendor_styles', array(
                'animate'                    => 'animate.css/animate.min.css',
                'aos'                        => 'aos/aos.css',
                'bootstrap'                  => 'bootstrap/bootstrap.css',
                'owl-carousel'               => 'owl-carousel/owl.carousel.css',
                'fontello'                   => 'fontello/css/fontello.css',
            ) );

            foreach( $vendors as $key => $vendor ) {
                wp_enqueue_style( $key, get_template_directory_uri() . '/assets/vendor/' . $vendor, '', $reen_version );
            }

            // Scripts
            // $theme_scripts = self::get_theme_scripts();
            // foreach ( $theme_scripts as $handle => $props ) {
            //     wp_enqueue_script( $handle, $props['src'], $props['dep'], $reen_version );
            // }
        }


        /**
         * Enqueue child theme stylesheet.
         * A separate function is required as the child theme css needs to be enqueued _after_ the parent theme
         * primary css and the separate WooCommerce css.
         *
         * @since  1.5.3
         */
        public function child_scripts() {
            if ( is_child_theme() ) {
                $child_theme = wp_get_theme( get_stylesheet() );
                wp_enqueue_style( 'reen-child-style', get_stylesheet_uri(), array(), $child_theme->get( 'Version' ) );
            }
        }


        /**
         * Enables template debug mode
         */
        public function reen_template_debug_mode() {
            if ( ! defined( 'REEN_TEMPLATE_DEBUG_MODE' ) ) {
                $status_options = get_option( 'woocommerce_status_options', array() );
                if ( ! empty( $status_options['template_debug_mode'] ) && current_user_can( 'manage_options' ) ) {
                    define( 'REEN_TEMPLATE_DEBUG_MODE', true );
                } else {
                    define( 'REEN_TEMPLATE_DEBUG_MODE', false );
                }
            }
        }
    }
endif;

return new Reen();