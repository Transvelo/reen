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
            add_action( 'tgmpa_register', array( $this, 'register_required_plugins' ) );
            add_filter( 'body_class', array( $this, 'body_classes' ) );
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

            add_theme_support( 'custom-logo', apply_filters( 'reen_custom_logo_args', array(
                'height'      => 40,
                'width'       => 160,
                'flex-width'  => true,
            ) ) );


            /*
             * Enable support for Post Formats.
            */
            add_theme_support( 'post-formats', apply_filters( 'reen_post_format_supports', array(
                'aside',
                'image',
                'gallery',
                'video',
                'audio',
                'quote',
                'link',
                'status',
            ) ) );


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
            register_nav_menus( apply_filters( 'reen_register_nav_menus', array(
				'primary' => esc_html__( 'Primary', 'reen' ),
                'topbar_right' => esc_html__( 'Tob Right Menu', 'reen' ),
                'topbar_left' => esc_html__( 'Top Left Menu', 'reen' ),
                'footer_menu' => esc_html__( 'Footer Menu', 'reen' ),
            ) ) );

            /*
             * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
             * to output valid HTML5.
             */
            add_theme_support( 'html5', apply_filters( 'reen_html5_args', array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'widgets',
            ) ) );

            /**
             * Declare support for title theme feature.
             */
            add_theme_support( 'title-tag' );

            /**
             * Declare support for selective refreshing of widgets.
             */
            add_theme_support( 'customize-selective-refresh-widgets' );

            /**
             * Add support for full and wide align images.
             */
            add_theme_support( 'align-wide' );

            /**
             * Declare support for editor styles.
             */
            add_theme_support( 'editor-styles' );

            /**
             * Add support for disable editor custom colors.
             */
            add_theme_support( 'disable-custom-colors' );

            /**
             * Add support for editor color palette.
             */
            add_theme_support( 'editor-color-palette', apply_filters( 'reen_editor_color_palette_options', array(
                array(
                    'name'  => esc_html__( 'Green', 'reen' ),
                    'slug'  => 'green',
                    'color' => '#1abb9c',
                ),
                array(
                    'name'  => esc_html__( 'Blue', 'reen' ),
                    'slug'  => 'blue',
                    'color' => '#3f8dbf',
                ),
                array(
                    'name'  => esc_html__( 'Red', 'reen' ),
                    'slug'  => 'red',
                    'color' => '#fa6c65',
                ),
                array(
                    'name'  => esc_html__( 'Orange', 'reen' ),
                    'slug'  => 'orange',
                    'color' => '#f27a24',
                ),
                array(
                    'name'  => esc_html__( 'Purple', 'reen' ),
                    'slug'  => 'purple',
                    'color' => '#9b59b6',
                ),
                array(
                    'name'  => esc_html__( 'Pink', 'reen' ),
                    'slug'  => 'pink',
                    'color' => '#d487be',
                ),
                array(
                    'name'  => esc_html__( 'Navy', 'reen' ),
                    'slug'  => 'navy',
                    'color' => '#34495e',
                ),
                array(
                    'name'  => esc_html__( 'Gray', 'reen' ),
                    'slug'  => 'gray',
                    'color' => '#95a5a6',
                ),
            ) ) );

            /**
             * Enqueue editor styles.
             */
            $editor_styles = array(
                get_template_directory_uri() . '/assets/css/gutenberg-editor.css',
                get_template_directory_uri() . '/style.css', $this->google_fonts()
            );

            if ( apply_filters( 'reen_use_predefined_colors', true ) ) {
                $color_css_file = apply_filters( 'reen_primary_color', 'green' );
                $editor_styles[] = get_template_directory_uri() . '/assets/css/colors/' . $color_css_file . '.css';
            }
            add_editor_style( $editor_styles );

        }

         /**
         * Adds custom classes to the array of body classes.
         *
         * @param array $classes Classes for the body element.
         * @return array
         */
        public function body_classes( $classes ) {
            global $post;

            if ( is_page() && isset( $post->ID ) ) {
                $body_class_meta_values = get_post_meta( $post->ID, '_bodyClasses', true );

                if ( isset( $body_class_meta_values ) && $body_class_meta_values ) {
                    $classes[] = $body_class_meta_values;
                }
            }

            return $classes;
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
                'name'          => esc_html__( 'Blog Sidebar', 'reen' ),
                'id'            => 'sidebar-blog',
                'description'   => esc_html__( 'Add widgets here.', 'reen' ),
                'before_widget' => '<section id="%1$s" class="sidebox widget widget--blog %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h4 class="widget__title">',
                'after_title'   => '</h4>',
            ) );

            $rows    = intval( apply_filters( 'reen_footer_widget_rows', 1 ) );
            $regions = intval( apply_filters( 'reen_footer_widget_columns', 4 ) );

            for ( $row = 1; $row <= $rows; $row++ ) {
                for ( $region = 1; $region <= $regions; $region++ ) {
                    $footer_n = $region + $regions * ( $row - 1 ); // Defines footer sidebar ID.
                    $footer   = sprintf( 'footer_%d', $footer_n );

                    if ( 1 == $rows ) {
                        $footer_region_name = sprintf( esc_html__( 'Footer Column %1$d', 'reen' ), $region );
                        $footer_region_description = sprintf( esc_html__( 'Widgets added here will appear in column %1$d of the footer.', 'reen' ), $region );
                    } else {
                        $footer_region_name = sprintf( esc_html__( 'Footer Row %1$d - Column %2$d', 'reen' ), $row, $region );
                        $footer_region_description = sprintf( esc_html__( 'Widgets added here will appear in column %1$d of footer row %2$d.', 'reen' ), $region, $row );
                    }

                    $sidebar_args[ $footer ] = array(
                        'name'        => $footer_region_name,
                        'id'          => sprintf( 'footer-%d', $footer_n ),
                        'description' => $footer_region_description,
                    );
                }
            }

            $sidebar_args = apply_filters( 'reen_sidebar_args', $sidebar_args );

            foreach ( $sidebar_args as $sidebar => $args ) {
                $widget_tags = array(
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h4>',
                    'after_title'   => '</h4>',
                );

                /**
                 * Dynamically generated filter hooks. Allow changing widget wrapper and title tags. See the list below.
                 *
                 * 'reen_sidebar_widget_tags'
                 * 'reen_footer_1_widget_tags'
                 * 'reen_footer_2_widget_tags'
                 * 'reen_footer_3_widget_tags'
                 * 'reen_footer_4_widget_tags'
                 */
                $filter_hook = sprintf( 'reen_%s_widget_tags', $sidebar );
                $widget_tags = apply_filters( $filter_hook, $widget_tags );

                if ( is_array( $widget_tags ) ) {
                    register_sidebar( $args + $widget_tags );
                }
            }
        }

        /**
         * Get all Reen scripts.
         */
        private static function get_theme_scripts() {
            $reen_get_theme_script = apply_filters( 'reen_theme_script', array(
                'affix'             => array(
                    'src' => get_template_directory_uri() . '/assets/js/affix.js',
                    'dep' => array( 'jquery' )
                ),
                'aos'        => array(
                    'src' => get_template_directory_uri() . '/assets/js/aos.js',
                    'dep' => array( 'jquery' )
                ),
                'bootstrap-bundle'         => array(
                    'src' => get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js',
                    'dep' => array( 'jquery' )
                ),
                'jquery-easing' => array(
                    'src' => get_template_directory_uri() . '/assets/js/jquery.easing.min.js',
                    'dep' => array( 'jquery' )
                ),
                'jquery-easytabs'           => array(
                    'src' => get_template_directory_uri() . '/assets/js/jquery.easytabs.min.js',
                    'dep' => array( 'jquery' )
                ),
                'jquery-form'         => array(
                    'src' => get_template_directory_uri() . '/assets/js/jquery.form.js',
                    'dep' => array( 'jquery' )
                ),
                'jquery-isotope'  => array(
                    'src' => get_template_directory_uri() . '/assets/js/jquery.isotope.min.js',
                    'dep' => array( 'jquery' )
                ),
                'jquery-validate'           => array(
                    'src' => get_template_directory_uri() . '/assets/js/jquery.validate.min.js',
                    'dep' => array( 'jquery' )
                ),
                'owl-carousel'      => array(
                    'src' => get_template_directory_uri() . '/assets/js/owl.carousel.min.js',
                    'dep' => array( 'jquery' )
                ),
                'selected-scroll' => array(
                    'src' => get_template_directory_uri() . '/assets/js/selected-scroll.js',
                    'dep' => array( 'jquery' )
                ),
                'viewport-units-buggyfill'      => array(
                    'src' => get_template_directory_uri() . '/assets/js/viewport-units-buggyfill.js',
                    'dep' => array( 'jquery' )
                ),
                'custom'   => array(
                    'src' => get_template_directory_uri() . '/assets/js/custom.js',
                    'dep' => array( 'jquery' )
                ),
                'images-loaded'   => array(
                    'src' => get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js',
                    'dep' => array( 'jquery-isotope' )
                ),
                'reen-scripts'   => array(
                    'src' => get_template_directory_uri() . '/assets/js/scripts.js',
                    'dep' => array( 'jquery' )
                ),
                
            ) );
            return $reen_get_theme_script;

        }

        /**
         * Register all Reen scripts.
         */
        private static function register_scripts() {
            global $reen_version;

            $register_scripts = self::get_theme_scripts();
            foreach ( $register_scripts as $handle => $props ) {
                wp_register_script( $handle, $props['src'], $props['dep'], $reen_version );
            }

        }


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
                'fontawesome'             => 'font-awesome/css/fontawesome-all.min.css',
                'animate'                    => 'animate.css/animate.min.css',
                'aos'                        => 'aos/aos.css',
                'owl-carousel'               => 'owl-carousel/owl.carousel.css',
            ) );

            foreach( $vendors as $key => $vendor ) {
                wp_enqueue_style( $key, get_template_directory_uri() . '/assets/vendor/' . $vendor, '', $reen_version );
            }

            self::register_scripts();

            wp_enqueue_style( 'reen-style', get_template_directory_uri() . '/style.css', '', $reen_version );
            wp_style_add_data( 'reen-style', 'rtl', 'replace' );


            wp_enqueue_style( 'reen-fontello', get_template_directory_uri() . '/assets/fonts/fontello.css', '', $reen_version );
            wp_style_add_data( 'reen-icons', 'rtl', 'replace' );

            if ( apply_filters( 'reen_use_predefined_colors', true ) ) {
                $color_css_file = apply_filters( 'reen_primary_color', 'green' );
                wp_enqueue_style( 'reen-color', get_template_directory_uri() . '/assets/css/colors/' . $color_css_file . '.css', '', $reen_version );
            }

            /**
             * Fonts
             */

            wp_enqueue_style( 'reen-fonts', $this->google_fonts(), array(), null );

            /**
             * Scripts
             */
            $suffix = '.min';


            wp_enqueue_script( 'bootstrap-bundle', get_template_directory_uri() . '/assets/js/bootstrap.bundle' . $suffix . '.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/assets/js/jquery.easing' . $suffix . '.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'affix', get_template_directory_uri() . '/assets/js/affix.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'aos', get_template_directory_uri() . '/assets/js/aos.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel' . $suffix . '.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'jquery-isotope', get_template_directory_uri() . '/assets/js/jquery.isotope' . $suffix . '.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'imagesloaded-pkgd', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery-isotope' ), $reen_version, true );

            wp_enqueue_script( 'jquery-easytabs', get_template_directory_uri() . '/assets/js/jquery.easytabs' . $suffix . '.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'viewport-units-buggyfill', get_template_directory_uri() . '/assets/js/viewport-units-buggyfill' . $suffix . '.js', array( 'jquery' ), $reen_version, true );

            wp_enqueue_script( 'selected-scroll', get_template_directory_uri() . '/assets/js/selected-scroll.js', array( 'jquery' ), $reen_version, true );


            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }

            wp_enqueue_script( 'reen-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), $reen_version, true );

            $reen_js_options = apply_filters( 'reen_localize_script_data', array(
                'enableScrollUp'        => apply_filters( 'reen_enable_scrollup', false ),
                'enableStickyHeader'    => apply_filters( 'reen_enable_sticky_header', false ),
            ) );

            wp_localize_script( 'reen-scripts', 'reen_options', $reen_js_options );

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
                'family' => implode( '%7c', $google_fonts ),
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
                'fontawesome'                => 'font-awesome/css/fontawesome-all.min.css',
                'animate'                    => 'animate.css/animate.min.css',
                'aos'                        => 'aos/aos.css',
                'owl-carousel'               => 'owl-carousel/owl.carousel.css',
                'fontello'                   => 'fontello/css/fontello.css',
            ) );

            foreach( $vendors as $key => $vendor ) {
                wp_enqueue_style( $key, get_template_directory_uri() . '/assets/vendor/' . $vendor, '', $reen_version );
            }

            wp_enqueue_style( 'reen-fontello', get_template_directory_uri() . '/assets/fonts/fontello.css', '', $reen_version );


            wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/vendor/font-awesome/css/fontawesome-all.min.css', '', $reen_version );

            
            // Scripts
            $theme_scripts = self::get_theme_scripts();
            foreach ( $theme_scripts as $handle => $props ) {
                wp_enqueue_script( $handle, $props['src'], $props['dep'], $reen_version );
            }
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

        /**
         * Register the required plugins for this theme.
         *
         * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
         */
        public function register_required_plugins() {
            /*
             * Array of plugin arrays. Required keys are name and slug.
             * If the source is NOT from the .org repo, then source is also required.
             */
            global $reen_version;

            $plugins = array(

                array(
                    'name'                  => esc_html__( 'Envato Market', 'reen' ),
                    'slug'                  => 'envato-market',
                    'source'                => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
                    'required'              => false,
                    'version'               => '2.0.3',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),

                array(
                    'name'                  => esc_html__( 'Jetpack by WordPress.com', 'reen' ),
                    'slug'                  => 'jetpack',
                    'version'               => '8.0',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'required'              => false,
                ),

                array(
                    'name'                  => esc_html__( 'MAS Static Content', 'reen' ),
                    'slug'                  => 'mas-static-content',
                    'version'               => '1.0.1',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'required'              => true,
                ),

                array(
                    'name'                  => esc_html__( 'One Click Demo Import', 'reen' ),
                    'slug'                  => 'one-click-demo-import',
                    'version'               => '2.5.2',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'required'              => false,
                ),

                array(
                    'name'                  => esc_html__( 'Redux Framework', 'reen' ),
                    'slug'                  => 'redux-framework',
                    'version'               => '3.6.16',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'required'              => false,
                ),

                array(
                    'name'                  => esc_html__( 'Reen Extensions', 'reen' ),
                    'slug'                  => 'reen-extensions',
                    'source'                => 'https://transvelo.github.io/reen/assets/plugins/reen-extensions.zip',
                    'version'               => $reen_version,
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'required'              => true
                ),

                array(
                    'name'                  => esc_html__( 'Reen Gutenberg Blocks', 'reen' ),
                    'slug'                  => 'reen-gutenberg-blocks',
                    'source'                => 'https://transvelo.github.io/reen/assets/plugins/reen-gutenberg-blocks.zip',
                    // 'version'               => $reen_version,
                    'version'               => '0.0.245',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'required'              => true
                ),

                array(
                    'name'                  => esc_html__( 'WPForms Lite', 'reen' ),
                    'slug'                  => 'wpforms-lite',
                    'required'              => false,
                    'version'               => '1.5.6.2',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
            );

            $config = array(
                'id'           => 'reen',                 // Unique ID for hashing notices for multiple instances of TGMPA.
                'default_path' => '',                      // Default absolute path to bundled plugins.
                'menu'         => 'tgmpa-install-plugins', // Menu slug.
                'has_notices'  => true,                    // Show admin notices or not.
                'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
                'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
                'is_automatic' => false,                   // Automatically activate plugins after installation or not.
                'message'      => '',                      // Message to output right before the plugins table.
            );

            tgmpa( $plugins, $config );
        }
    }
endif;

return new Reen();