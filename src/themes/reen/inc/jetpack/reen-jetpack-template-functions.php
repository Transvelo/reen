<?php
/**
 * REEN template functions.
 *
 * @package REEN
 */

/**
 * Portfolio Title.
 */

if ( ! function_exists( 'reen_portfolio_title' ) ) {
    function reen_portfolio_title( $before = '', $after = '' ) {
        $jetpack_portfolio_title = get_option( 'jetpack_portfolio_title' );
        $title = '';

        if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
            if ( isset( $jetpack_portfolio_title ) && '' != $jetpack_portfolio_title ) {
            $title = esc_html( $jetpack_portfolio_title );
            } else {
                $title = post_type_archive_title( '', false );
            }
        } elseif ( is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) {
            $title = single_term_title( '', false );
        }

        echo $before . $title . $after;
    }
}

/**
 * Portfolio Content.
 */

if ( ! function_exists( 'reen_portfolio_archive_content' ) ) {
    function reen_portfolio_archive_content( $before = '', $after = '' ) {
        $jetpack_portfolio_content = get_option( 'jetpack_portfolio_content' );

        if ( is_tax() && get_the_archive_description() ) {
            echo $before . get_the_archive_description() . $after;
        
        } else if ( isset( $jetpack_portfolio_content ) && '' != $jetpack_portfolio_content ){
                $content = convert_chars( convert_smilies( wptexturize( wp_kses_post( $jetpack_portfolio_content ) ) ) );
            echo $before . $content . $after;
        }
    }
}

/**
 * Portfolio Featured Image.
 */
if ( ! function_exists( 'reen_portfolio_thumbnail' ) ) {
    function reen_portfolio_thumbnail( $before = '', $after = '' ) {
        $jetpack_portfolio_featured_image = get_option( 'jetpack_portfolio_featured_image' );

        if ( isset( $jetpack_portfolio_featured_image ) && '' != $jetpack_portfolio_featured_image ) {
            $featured_image = wp_get_attachment_image( (int) $jetpack_portfolio_featured_image, 'reen-featured-image' );
            echo $before . $featured_image . $after;
        }
    }
}

if ( ! function_exists( 'reen_portfolio_header' ) ) {
    function reen_portfolio_header() {?>
    <div class="container inner">
        <div class="row">
            <div class="col-lg-8 col-md-9 mx-auto text-center">
                <header class="page-header">
                    <h1 class="page-title"><?php reen_portfolio_title();?></h1>
                    <p><?php reen_portfolio_archive_content(); ?></p>
                </header>
            </div>
        </div>
    </div><?php
    }
}

if ( ! function_exists( 'reen_loop_portfolio_wrap_start' ) ) {
    function reen_loop_portfolio_wrap_start() {
        $portfolio_view    = reen_get_portfolio_view();
        $portfolio_columns = reen_get_portfolio_columns();

        $wrapper_class     = 'isotope items';

        $portfolio_cats = array();        

        while ( have_posts() ) : 
            the_post(); 

            $portfolio_types = get_the_terms( get_the_ID(), 'jetpack-portfolio-type' );

            if ( ! $portfolio_types || is_wp_error( $portfolio_types ) ) {
                $portfolio_types = array();
            }

            $portfolio_types = array_values( $portfolio_types );

            foreach ( array_keys( $portfolio_types ) as $key ) {
               _make_cat_compat( $portfolio_types[ $key ] );           
            }

            foreach ( $portfolio_types as $portfolio_type ) {
                $portfolio_cats[ $portfolio_type->slug] = $portfolio_type->name;
            }

        endwhile;

        if ( $portfolio_view == 'fullscreen' ) {
            $wrapper_class .= ' fullscreen';
            $before = '<div class="portfolio">';
        } else {
            $wrapper_class .= ' col-' . $portfolio_columns . '-custom';
            $before = '
            <div class="container inner-bottom">
                <div class="row">
                    <div class="col-md-12 portfolio aos-init aos-animate">';
        }

        echo wp_kses_post( $before );
        ?><ul class="filter text-center">
            <li><a href="#" data-filter="*" class="active">All</a></li>
            <?php foreach ( $portfolio_cats as $slug => $portfolio_cat ) : ?>
            <li><a href="#" data-filter=".jetpack-portfolio-type-<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $portfolio_cat ); ?></a></li>
            <?php endforeach; ?>
        </ul><?php
        ?><ul class="<?php echo esc_attr( $wrapper_class ); ?>"><?php
    }
}

if ( ! function_exists( 'reen_portfolio_info' ) ) {
    function reen_portfolio_info() {

        $portfolio_view = reen_get_portfolio_view();

        if ( 'grid-detail' === $portfolio_view ) {
            $before = '<h4><a href="' . esc_url( get_permalink() ) . '">';
            $after  = '</a></h4>';
        } else {
            $before = '<h4>';
            $after  = '</h4>';
        }
        add_filter( 'term_links-jetpack-portfolio-type', 'reen_portfolio_type_strip_tags' );
        ?><div class="info">
            <?php the_title( $before, $after ); ?>
            <p><?php echo get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', '/' ); ?></p>
        </div><?php
        remove_filter( 'term_links-jetpack-portfolio-type', 'reen_portfolio_type_strip_tags' );
    }
}

if ( ! function_exists( 'reen_portfolio_icon_overlay' ) ) {
    function reen_portfolio_icon_overlay() {
        ?><div class="icon-overlay icn-link">
            <a href="<?php echo esc_url( get_permalink() ); ?>">
                <?php reen_portfolio_thumbnail(); ?>
            </a>
        </div><!-- /.icon-overlay --><?php
    }
}

if ( ! function_exists( 'reen_portfolio_detail_figcaption' ) ) {
    function reen_portfolio_detail_figcaption() {?>
        <figcaption class="bordered no-top-border">
            <?php reen_portfolio_info(); ?>    
        </figcaption>
        <?php
    }
}

if ( ! function_exists( 'reen_portfolio_figcaption' ) ) {
    function reen_portfolio_figcaption() {?>
        <figcaption class="text-overlay">
            <?php reen_portfolio_info(); ?>    
        </figcaption>
       <?php
    }   
}


if ( ! function_exists( 'reen_portfolio_type_strip_tags' ) ) {
    function reen_portfolio_type_strip_tags( $links ) {
        foreach ( $links as $key => $link ) {
            $links[$key] = wp_strip_all_tags( $link );
        }
        return $links;
    }
}

function reen_portfolio_thumbnail() {
    the_post_thumbnail( 'reen-portfolio-featured-image' );
}

if ( ! function_exists( 'reen_loop_portfolio_wrap_end' ) ) {
    function reen_loop_portfolio_wrap_end() {
        $portfolio_view    = reen_get_portfolio_view();

        if ( $portfolio_view === 'fullscreen' ) {
            $after = '</div><!-- /.portfolio -->';
        } else {
            $after = '
                    </div><!-- /.portfolio -->
                </div><!-- /.row -->
            </div><!-- /.container -->';
        }

        ?></ul><?php

        echo wp_kses_post( $after );
    }
}
