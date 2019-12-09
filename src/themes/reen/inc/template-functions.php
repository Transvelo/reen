<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package REEN
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function reen_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-blog' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'reen_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function reen_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'reen_pingback_header' );

function reen_separate_linkmods_and_icons_from_classes( $classes, &$linkmod_classes, &$icon_classes, &$btn_classes, $depth ) {
    // Loop through $classes array to find linkmod or icon classes.
    foreach ( $classes as $key => $class ) {
        // If any special classes are found, store the class in it's
        // holder array and and unset the item from $classes.
        if ( preg_match( '/^disabled|^sr-only/i', $class ) ) {
            // Test for .disabled or .sr-only classes.
            $linkmod_classes[] = $class;
            unset( $classes[ $key ] );
        } elseif ( preg_match( '/^dropdown-header|^dropdown-divider|^dropdown-item-text/i', $class ) && $depth > 0 ) {
            // Test for .dropdown-header or .dropdown-divider and a
            // depth greater than 0 - IE inside a dropdown.
            $linkmod_classes[] = $class;
            unset( $classes[ $key ] );
        } elseif ( preg_match( '/^blue|^gray|^green|^navy|^orange|^pink|^purple|^red/i', $class ) ) {
            // Menu Color
            $linkmod_classes[] = $class;
            unset( $classes[ $key ] );
        } elseif ( preg_match( '/^fa-(\S*)?|^fa(s|r|l|b)?(\s?)?$/i', $class ) ) {
            // Font Awesome.
            $icon_classes[] = $class;
            unset( $classes[ $key ] );
        } elseif ( preg_match( '/^icon-(\S*)?$/i', $class )) {
            $icon_classes[] = $class;
            unset( $classes[ $key ] );
        } elseif ( preg_match( '/^glyphicon-(\S*)?|^glyphicon(\s?)$/i', $class ) ) {
            // Glyphicons.
            $icon_classes[] = $class;
            unset( $classes[ $key ] );
        } elseif ( preg_match( '/^transition-3d-hover|^btn|^btn-(\s?)$/i', $class ) ) {
            $btn_classes[] = $class;
            unset( $classes[ $key ] );
        }
    }

    return $classes;
}

if ( ! function_exists( 'reen_footer_bottom_copyright_bar' ) ) {
    function reen_footer_bottom_copyright_bar() {
        ?><div class="footer-bottom">
            <div class="container">
            <?php
            if ( apply_filters( 'reen_enable_footer_bottom_bar', true ) ): ?>
                <div class="footer-bottom__inner">
                    <?php reen_footer_bottom_bar(); ?>
                </div>
                </div>
            <?php endif; ?>
        </div><?php
    }
}

if ( ! function_exists( 'reen_footer_bottom_bar' ) ) {
    function reen_footer_bottom_bar() {
        $copyright_info = apply_filters( 'reen_footer_copyright_text', wp_kses_post( sprintf( __( '&copy;2019All Rights Reserved.', 'reen' ), get_bloginfo( 'name' ) ) ) );
        if( apply_filters( 'reen_footer_enable_copyright_info', true ) && ! empty( $copyright_info ) ) {
            ?>
                <?php echo wp_kses_post( $copyright_info ); ?>
            <?php
        }
    }
}

if ( ! function_exists( 'reen_footer_site_title' ) ) {
    function reen_footer_site_title() {
        $footer_site_title = apply_filters( 'reen_footer_site_title_info', wp_kses_post( sprintf( __( 'WHO WE ARE', 'reen' ), get_bloginfo( 'name' ) ) ) );
        if( apply_filters( 'reen_footer_enable_site_title', true ) && ! empty( $footer_site_title ) ) {
            ?>
                <?php echo wp_kses_post( $footer_site_title ); ?>
            <?php
        }
    }
}


if ( ! function_exists( 'reen_footer_logo' ) ) :
    /**
     * Displays Logo in Footer
     *
     */
    function reen_footer_logo() {
        $seperate_logo = apply_filters( 'reen_separate_footer_logo', '' );
        if( apply_filters( 'reen_enable_seperate_footer_logo', true ) && !empty( $seperate_logo ) ) {
            ?><a class="mb-3 d-inline-block" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php
                echo wp_get_attachment_image( $seperate_logo['id'], array( get_theme_support( 'custom-logo', 'width' ), get_theme_support( 'custom-logo', 'height' ) ) );
            ?></a><?php
        } elseif( has_custom_logo() ) {
            the_custom_logo();
        } elseif ( apply_filters( 'reen_use_footer_svg_logo', true ) ) {
            if ( apply_filters( 'reen_use_footer_svg_logo_with_site_title', true ) ) {
                ?>
                <?php the_custom_logo(); ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-white.svg" class="logo img-intext" alt="<?php bloginfo( 'name' ); ?>" style="height: 40px" /></a>
                <?php
            } 
        }
    }
endif;

if ( ! function_exists( 'reen_footer_site_description' ) ) {
    function reen_footer_site_description() {
        $footer_site_description = apply_filters( 'reen_footer_site_description_info', esc_html__( get_bloginfo( 'description' ), 'reen' ) );
        ?>
            <?php echo wp_kses_post( $footer_site_description ); ?>
        <?php
    }
}    

