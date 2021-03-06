<?php
/**
 * REEN template functions.
 *
 * @package REEN
 */

/**
 * Portfolio Header.
 */
if ( ! function_exists( 'reen_portfolio_header' ) ) {
    function reen_portfolio_header() {?>
    <div class="container inner">
        <div class="row">
            <div class="col-lg-8 col-md-9 mx-auto text-center">
                <header class="page-header">
                    <h1 class="page-title"><?php echo wp_kses_post( apply_filters( 'reen_portfolio_page_title', 'Title' ) ); ?></h1>
                    <p><?php echo wp_kses_post( apply_filters( 'reen_portfolio_page_description', 'description' ) ); ?></p>
                </header>
            </div>
        </div>
    </div><?php
    }
}

/**
 * Portfolio Content.
 */
if ( ! function_exists( 'reen_loop_portfolio_wrap_start' ) ) {
    function reen_loop_portfolio_wrap_start() {
        $portfolio_view    = reen_get_portfolio_view();
        $portfolio_columns = reen_get_portfolio_columns();

        $wrapper_class     = 'isotop items ';

        if ( $portfolio_view === 'fullscreen' ) {
            $wrapper_class .= ' fullscreen';
            ?><div class="portfolio"><?php
        } else {
            $wrapper_class .= ' col-' . $portfolio_columns . '-custom';
            ?><div class="container inner-bottom">
                <div class="row">
                    <div class="col-md-12 portfolio"><?php
        }

        if ( ( $portfolio_view === 'grid-detail' &&  $portfolio_columns == 3 ) || ( $portfolio_view === 'grid-detail' &&  $portfolio_columns == 4 ) )  {
            $wrapper_class .= ' gap';
        }

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

        endwhile; ?>
        <?php if ($portfolio_view === 'fullscreen' ) { ?>
            <div class="container inner-bottom-xs">
        <?php } ?>
            <ul class="filter text-center">
                <li><a href="#" data-filter="*" class="active">All</a></li>
                <?php foreach ( $portfolio_cats as $slug => $portfolio_cat ) : ?>
                <li><a href="#" data-filter=".jetpack-portfolio-type-<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $portfolio_cat ); ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php if ($portfolio_view === 'fullscreen' ) { ?>
            </div>
        <?php } ?>
        <ul class="<?php echo esc_attr( $wrapper_class ); ?>"><?php
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
        ?><div class="info">
            <?php the_title( $before, $after ); ?>
            <p><?php echo wp_strip_all_tags( get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', '/' ), true)?></p>
        </div><?php
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

function reen_portfolio_thumbnail() {
    the_post_thumbnail( 'reen-portfolio-featured-image' );
}

if ( ! function_exists( 'reen_loop_portfolio_wrap_end' ) ) {
    function reen_loop_portfolio_wrap_end() {
        $portfolio_view    = reen_get_portfolio_view();
        ?></ul><?php
        if ( $portfolio_view === 'fullscreen' ) {
            ?></div><!-- /.portfolio --><?php
        } else {
                    ?></div><!-- /.portfolio -->
                </div><!-- /.row -->
            </div><!-- /.container --><?php
        }
    }
}

if ( ! function_exists( 'reen_portfolio_audio_post_content-open' ) ) {
    function reen_portfolio_audio_post_content_open() {?>
        <section id="portfolio-post">
            <div class="container inner-top-md">
                <div class="row"><?php
    }
}

if ( ! function_exists( 'reen_portfolio_audio_post_content' ) ) {
    function reen_portfolio_audio_post_content() {?>
            <div class="col-lg-4 inner-right-xs inner-bottom-xs">
                <header>
                    <?php the_title( '<h2>', '</h2>' );?>
                    <?php the_content(); ?>
                </header>
            </div>
        <?php
    }
}

if ( ! function_exists( 'reen_portfolio_post_audio' ) ) {
    /**
     * Displays post audio when applicable
     */
    function reen_portfolio_post_audio() {
        $embed_audio  = get_post_meta( get_the_ID(), '_portfolio_audio_field', true );

        if ( isset($embed_audio) && $embed_audio != '' ) {
            // Embed Audio

            if( !empty($embed_audio) ) {
                ?><div class="col-lg-8 inner-left-xs"><?php
                // run oEmbed for known sources to generate embed code from audio links
                // echo $GLOBALS['wp_embed']->autoembed( stripslashes( htmlspecialchars_decode( $embed_audio ) ) );
                echo apply_filters( 'the_content', $embed_audio ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound

                ?></div><?php
            }
        }
    }
}

if ( ! function_exists( 'reen_portfolio_audio_post_content-close' ) ) {
    function reen_portfolio_audio_post_content_close() {?>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><?php
    }
}

if ( ! function_exists( 'reen_portfolio_video_post_wrap_start' ) ) {
    function reen_portfolio_video_post_wrap_start() { ?>
        <section id="portfolio-post">
            <div class="container inner-top-xs inner-bottom"><?php
        }
    }

if ( ! function_exists( 'reen_portfolio_post_video' ) ) {
    /**
     * Displays post video when applicable
     */
    function reen_portfolio_post_video() {
        $embed_video  = get_post_meta( get_the_ID(), '_portfolio_video_field', true );

        if ( isset($embed_video) && $embed_video != '' ) {
            // Embed Audio

            if( !empty($embed_video) ) {
                ?><div class="row">
                    <div class="col-md-12">
                        <div class="video-container"><?php 
                            // run oEmbed for known sources to generate embed code from audio links
                            // echo $GLOBALS['wp_embed']->autoembed( stripslashes( htmlspecialchars_decode( $embed_video ) ) );
                            echo apply_filters( 'the_content', $embed_video ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
                        ?></div>
                    </div>
                </div><?php
            }
        }
    }
}

if ( ! function_exists( 'reen_portfolio_video_post_content_open' ) ) {
    function reen_portfolio_video_post_content_open() {?>
        <div class="row inner-top-xs reset-xs"><?php
    }
}

if ( ! function_exists( 'reen_portfolio_video_post_content_description' ) ) {
    function reen_portfolio_video_post_content_description() {?>
        <div class="col-md-7 inner-top-xs inner-right-xs">
            <header>
                <?php the_title( '<h2>', '</h2>' );?>
                <?php the_excerpt(); ?>
            </header>
        </div>
        <div class ="col-md-4 offset-md-1 outer-top-xs inner-left-xs border-left">
            <?php reen_portfolio_meta(); ?>
        </div><?php
    }
}

if ( ! function_exists( 'reen_portfolio_video_post_content_close' ) ) {
    function reen_portfolio_video_post_content_close() {?>
        </div><?php
    }
}

if ( ! function_exists( 'reen_portfolio_video_post_wrap_end' ) ) {
    function reen_portfolio_video_post_wrap_end() {?>
        </div><!-- /.container -->
        </section><?php
    }
}

if ( ! function_exists( 'reen_portfolio_post_slider_wrap_open' ) ) {
    function reen_portfolio_post_slider_wrap_open() {?>
        <div class="row"><?php
    }
}

if ( ! function_exists( 'reen_portfolio_post_slider_1' ) ) {
    function reen_portfolio_post_slider_1() {?>
        <div class="col-md-12"><?php

        $clean_post_format_gallery_meta_values = get_post_meta( get_the_ID(), '_portfolio_gallery_images', true );
        $attachments = json_decode( stripslashes( $clean_post_format_gallery_meta_values ), true );
            $owl_params = apply_filters( 'reen_owl_carousel_portfolio_post_gallery_params', array(
                'autoPlay'        => 5000,
                'slideSpeed'      => 200,
                'paginationSpeed' => 600,
                'rewindSpeed'     => 800,
                'stopOnHover'     => true,
                'nav'             => true,
                'dots'            => true,
                'rewindNav'       => true,
                'items'           => 1,
                'autoHeight'      => true,
                'rtl'             => is_rtl() ? true : false,
                'navText'         => is_rtl() ? array( '<i class="icon-right-open-mini"></i>', '<i class="icon-left-open-mini"></i>' ) : array( '<i class="icon-left-open-mini"></i>', '<i class="icon-right-open-mini"></i>' ),
            ) );

        if ( ! empty( $attachments ) ) :
       ?><div id="owl-work" data-ride="owl-carousel" data-owlparams="<?php echo esc_attr( json_encode( $owl_params ) ); ?>" class="owl-carousel owl-inner-pagination owl-outer-nav owl-ui-lg owl-theme portfolio-post-carousel"> 
            <?php foreach( $attachments as $attachment ) : ?>
                <div class="item">
                    <figure>
                        <?php echo wp_get_attachment_image( $attachment['id'], 'post-thumbnail' ); ?>
                    </figure>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        </div><?php
    }
}

if ( ! function_exists( 'reen_portfolio_post_slider_1_content' ) ) {
    function reen_portfolio_post_slider_1_content() {?>
        <div class="row">
            <div class="col-md-7 inner-top-xs inner-right-xs">
                <header>
                    <?php the_title( '<h2>', '</h2>' );?>
                    <?php the_content(); ?>
                </header>
            </div>
            <div class="col-md-4 offset-md-1 outer-top-xs inner-left-xs border-left">
                <?php reen_portfolio_meta(); ?>            
            </div>
        </div><?php
    }
}

if ( ! function_exists( 'reen_portfolio_post_slider_2' ) ) {
    function reen_portfolio_post_slider_2() {?>
        <div class="col-md-8"><?php

        $clean_post_format_gallery_meta_values = get_post_meta( get_the_ID(), '_portfolio_gallery_images', true );
        $attachments = json_decode( stripslashes( $clean_post_format_gallery_meta_values ), true );
        $owl_params = apply_filters( 'reen_owl_carousel_portfolio_post_gallery_params', array(
            'autoPlay'        => 5000,
            'slideSpeed'      => 200,
            'paginationSpeed' => 600,
            'rewindSpeed'     => 800,
            'stopOnHover'     => true,
            'nav'             => true,
            'dots'            => true,
            'rewindNav'       => true,
            'items'           => 1,
            'autoHeight'      => true,
            'rtl'             => is_rtl() ? true : false,
            'navText'         => is_rtl() ? array( '<i class="icon-right-open-mini"></i>', '<i class="icon-left-open-mini"></i>' ) : array( '<i class="icon-left-open-mini"></i>', '<i class="icon-right-open-mini"></i>' ),
        ) );

        if ( ! empty( $attachments ) ) :
        ?><div id="owl-work" data-ride="owl-carousel" data-owlparams="<?php echo esc_attr( json_encode( $owl_params ) ); ?>"   class="owl-carousel portfolio-post-carousel owl-inner-pagination owl-inner-nav owl-ui-md owl-theme">
            <?php foreach( $attachments as $attachment ) : ?>
                <div class="item">
                    <figure>
                        <?php echo wp_get_attachment_image( $attachment['id'], 'post-thumbnail' ); ?>
                    </figure>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        </div><?php
    }
}
          
if ( ! function_exists( 'reen_portfolio_post_slider_2_content' ) ) {
    function reen_portfolio_post_slider_2_content() {?>
        <div class="col-lg-4 inner-left-sm">
           <header>
                <?php the_title( '<h2>', '</h2>' );?>
                <?php the_content(); ?>
                <?php reen_portfolio_meta(); ?>
            </header>            
        </div><?php
    }
}

if ( ! function_exists( 'reen_portfolio_post_slider_wrap_close' ) ) {
    function reen_portfolio_post_slider_wrap_close() {?>
        </div><!-- /.row --><?php
    }
} 

if ( ! function_exists( 'reen_portfolio_post_image_1_title' ) ) {
    function reen_portfolio_post_image_1_title() {?>
        <div class="row">
            <div class="col-md-9 mx-auto text-center">
                <header>
                    <?php the_title( '<h1>', '</h1>' );?>
                    <?php the_excerpt('<p>', '</p>');?>
                </header>
            </div>
        </div><?php
        }
    }

if ( ! function_exists( 'reen_portfolio_post_image_1_meta' ) ) {
    function reen_portfolio_post_image_1_meta() {?>
        <div class="row inner-top-xs">
            <div class="col-md-10 col-11 mx-auto text-center inner-top-xs border-top">
                <?php reen_portfolio_meta(); ?>
            </div>
        </div>
        <?php the_content(); ?><?php
    }
}

if ( ! function_exists( 'reen_portfolio_post_image_2_content' ) ) {
    function reen_portfolio_post_image_2_content() { ?>
        <div class="row inner-top-xs reset-xs">
            <div class="col-md-7 inner-top-xs inner-right-xs">
                <header>
                    <?php the_title( '<h2>', '</h2>' );?>
                    <?php the_excerpt();?>
                </header>        
            </div>
            <div class="col-md-4 offset-md-1 outer-top-xs inner-left-xs border-left">
                <?php reen_portfolio_meta(); ?>
            </div>
        </div>
        <?php 
        the_content();
    }
}

if ( ! function_exists( 'reen_portfolio_post_image_2_media' ) ) {
    function reen_portfolio_post_image_2_media() { ?>
        <div class="row">
            <div class="col-md-12">
                <figure><?php the_post_thumbnail(); ?></figure>
            </div>
        </div><?php
    }
}

if ( ! function_exists( 'reen_portfolio_meta' ) ) :
    function reen_portfolio_meta() {
        $keys = apply_filters( 'reen_portfolio_meta_keys', array(
            'project-date'  => '', 
            'project-types' => 'reen_get_project_types',
            'client-name'   => '', 
            'project-url'   => '',
        ) );
        
        $li_html = '';
        $portfolio_id = get_the_ID();
        
        foreach ( $keys as $key => $callable ) {
            if ( ! empty( $callable ) ) {
                $value = call_user_func( $callable , $portfolio_id );
            } else {
                $value = get_post_meta( $portfolio_id, $key, true );
            }

            if ( empty( $value ) ) {
                continue;
            }
            
            $html = sprintf(
                    "<li class='%s'><span class='post-meta-key'>%s</span>%s</li>\n",
                
                    sanitize_title( $key ),
                    sprintf( _x( '%s:', 'Post custom field name', 'reen' ), $key ),
                    $key == 'project-url' ?  '<a href="'. esc_url( $value ) .'">' . $value . '</a>' : wp_strip_all_tags( $value, true )
            );
            $li_html .= apply_filters( 'reen_meta_key', $html, $key, $value );
        }

        if ( $li_html ) {
            echo "<ul class='post-meta'>\n{$li_html}</ul>\n";
        }
    }

endif;

if ( ! function_exists( 'reen_more_works' ) ) {
    function reen_more_works() {
        $more_works = new WP_Query( array( 'post_type' => 'jetpack-portfolio','post_per_page' => '16', 'post__not_in' => array( get_the_ID() ), 'orderby' => 'rand' ) );

        if ( $more_works->have_posts() ) {

            $portfolio_cats = array();        

            while ( $more_works->have_posts() ) : 

                $more_works->the_post(); 

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

            ?>
            <section id="more-works">
                <div class="container inner-top-sm inner-bottom">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="accordion" class="panel-group blank">
                                <div class="panel panel-default">              
                                    <div class="panel-heading text-center">
                                        <h4 class="panel-title">
                                            <a class="panel-toggle collapsed" href="#content-more-works" data-toggle="collapse">
                                                <span><?php echo esc_html__( 'More projects', 'reen' ); ?></span>
                                            </a>
                                        </h4>
                                    </div><!-- /.panel-heading -->
                                    <div id="content-more-works" class="panel-collapse collapse" data-parent="#accordion">
                                        <div class="panel-body"> 
                                            <div class="portfolio">
                                                <ul class="filter text-center">
                                                    <li><a href="#" data-filter="*" class="active">All</a></li>
                                                    <?php foreach ( $portfolio_cats as $slug => $portfolio_cat ) : ?>
                                                    <li><a href="#" data-filter=".jetpack-portfolio-type-<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $portfolio_cat ); ?></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                                <ul class="isotope items col-4-custom">
                                                    <?php while ( $more_works->have_posts() ) : $more_works->the_post(); ?>
                                                    <li <?php post_class( array( 'item', 'thumb' ) ); ?>>
                                                        <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                                                            <figure>
                                                                <figcaption class="text-overlay">
                                                                    <div class="info">
                                                                        <h4><?php the_title(); ?></h4>
                                                                        <p><?php echo wp_strip_all_tags( get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', '/' ), true)?></p>
                                                                    </div><!-- /.info -->
                                                                </figcaption>
                                                                    <?php the_post_thumbnail()?>
                                                            </figure>
                                                        </a>
                                                    </li><!-- /.item -->
                                                    <?php endwhile; ?>
                                                </ul><!-- /.items -->
                                            </div><!-- /.portfolio -->
                                        </div><!-- /.panel-body -->
                                    </div><!-- /.content -->        
                                </div><!-- /.panel -->
                            </div><!-- /.accordion -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </section>
            <?php
        }

        wp_reset_postdata();
    }
}

if ( ! function_exists( 'reen_portfolio_more_videos' ) ) {
    function reen_portfolio_more_videos() {
        $more_videos = new WP_Query( array(
            'post_type'         => 'jetpack-portfolio',
            'posts_per_page'    => '10',
            'post__not_in'      => array( get_the_ID() ),
            'tax_query'         => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'jetpack-portfolio-type',
                    'field'    => 'slug',
                    'terms'    => array( 'video' ),
                ),
                array(
                    'taxonomy' => 'post_format',
                    'field'    => 'slug',
                    'terms'    => array( 'post-format-video' ),
                ),
                array(
                    'taxonomy' => 'jetpack-portfolio-tag',
                    'field'    => 'slug',
                    'terms'    => array( 'video' ),
                ),
            ),
        ) );

        if ( $more_videos->have_posts() ) :
            ?>
            <section id="more-videos">
                <div class="container inner-top-md">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="accordion" class="panel-group">
                                <div class="panel panel-default">             
                                    <div class="panel-heading text-center">
                                        <h4 class="panel-title">
                                            <a class="panel-toggle collapsed" href="#content-more-videos" data-toggle="collapse">
                                                <span><?php echo esc_html__( 'More Videos', 'reen' ); ?></span>
                                            </a>
                                        </h4>
                                    </div><!-- /.panel-heading --> 
                                    <div id="content-more-videos" class="panel-collapse collapse" data-parent="#accordion">
                                        <div class="panel-body">
                                            <?php
                                                wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css' );
                                                wp_enqueue_style( 'owl-transitions', get_template_directory_uri() . '/assets/css/owl.transitions.css' );
                                                wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), true );

                                                $owl_params = apply_filters( 'reen_portfolio_owl-videos_params', array(
                                                    'autoplay'            => true,
                                                    'autoplayTimeout'     => 5000,
                                                    'autoplayHoverPause'  => true,
                                                    'smartSpeed'          => 200,
                                                    'rewind'              => true,
                                                    'nav'             => true,
                                                    'dots'            => true,
                                                    'items'           => 5,
                                                    'rtl'          => is_rtl() ? true : false,
                                                    'navText'      => is_rtl() ? array( '<i class="icon-right-open-mini"></i>', '<i class="icon-left-open-mini"></i>' ) : array( '<i class="icon-left-open-mini"></i>', '<i class="icon-right-open-mini"></i>' ),
                                                    'responsive'        => array(
                                                        '0'     => array( 'items'   => 1 ),
                                                        '480'   => array( 'items'   => 2 ),
                                                        '768'   => array( 'items'   => 2 ),
                                                        '992'   => array( 'items'   => 4 ),
                                                        '1200'  => array( 'items'   => 5 ),
                                                    )
                                                ) );
                                            ?>

                                            <div id="owl-videos" data-ride="owl-carousel" data-owlparams="<?php echo esc_attr( json_encode( $owl_params ) ); ?>"   class="owl-carousel owl-item-gap">
                                                <?php while ( $more_videos->have_posts() ) : $more_videos->the_post(); ?>
                                                    <div class="item">
                                                        <figure>
                                                            <div class="icon-overlay icn-link">
                                                                <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_post_thumbnail(); ?></a>
                                                            </div><!-- /.icon-overlay -->
                                                            
                                                            <figcaption class="bordered no-top-border">
                                                                <div class="info">
                                                                    <h4><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a></h4>
                                                                    <p><?php echo wp_strip_all_tags( get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', '/' ), true)?></p>
                                                                </div><!-- /.info -->
                                                            </figcaption>
                                                            
                                                        </figure>
                                                    </div><!-- /.item -->
                                                <?php endwhile; ?>
                                            </div><!-- /.owl-carousel -->
                                        </div><!-- /.panel-body -->
                                    </div><!-- /.content -->    
                                </div><!-- /.panel -->
                            </div><!-- /.accordion -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </section>
            <?php
        endif;

        wp_reset_postdata();
    }
}

if ( ! function_exists( 'reen_portfolio_more_audio' ) ) {
    function reen_portfolio_more_audio() {
        $more_audio = new WP_Query( array( 
            'post_type'      => 'jetpack-portfolio',
            'posts_per_page' => '10',
            'post__not_in'   => array( get_the_ID() ),
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'jetpack-portfolio-type',
                    'field'    => 'slug',
                    'terms'    => array( 'audio' ),
                ),
                array(
                    'taxonomy' => 'post_format',
                    'field'    => 'slug',
                    'terms'    => array( 'post-format-audio' ),
                ),
                array(
                    'taxonomy' => 'jetpack-portfolio-tag',
                    'field'    => 'slug',
                    'terms'    => array( 'audio' ),
                ),
            ),
        ) );

        if ( $more_audio->have_posts() ) :
            ?>
            <section id="more-audio">
                <div class="container inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="accordion" class="panel-group blank">
                                <div class="panel panel-default">             
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="panel-toggle collapsed" href="#content-more-audio" data-toggle="collapse">
                                                <span><?php echo esc_html__( 'More Audio', 'reen' ); ?></span>
                                            </a>
                                        </h4>
                                    </div><!-- /.panel-heading --> 
                                    <div id="content-more-audio" class="panel-collapse collapse" data-parent="#accordion">
                                        <div class="panel-body">
                                            <?php
                                                wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css' );
                                                wp_enqueue_style( 'owl-transitions', get_template_directory_uri() . '/assets/css/owl.transitions.css' );
                                                wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), true );

                                                $owl_params = apply_filters( 'reen_portfolio_owl-audio_params', array(
                                                    'autoplay'            => true,
                                                    'autoplayTimeout'     => 5000,
                                                    'autoplayHoverPause'  => true,
                                                    'smartSpeed'          => 200,
                                                    'rewind'              => true,
                                                    'nav'             => true,
                                                    'dots'            => true,
                                                    'items'           => 5,
                                                    'rtl'          => is_rtl() ? true : false,
                                                    'navText'      => is_rtl() ? array( '<i class="icon-right-open-mini"></i>', '<i class="icon-left-open-mini"></i>' ) : array( '<i class="icon-left-open-mini"></i>', '<i class="icon-right-open-mini"></i>' ),
                                                    'responsive'        => array(
                                                        '0'     => array( 'items'   => 1 ),
                                                        '480'   => array( 'items'   => 2 ),
                                                        '768'   => array( 'items'   => 2 ),
                                                        '992'   => array( 'items'   => 4 ),
                                                        '1200'  => array( 'items'   => 5 ),
                                                    )
                                                ) );
                                            ?>
                                            <div id="owl-audio" data-ride="owl-carousel" data-owlparams="<?php echo esc_attr( json_encode( $owl_params ) ); ?>"   class="owl-carousel owl-item-gap">
                                                <?php while ( $more_audio->have_posts() ) : $more_audio->the_post(); ?> 
                                                    <div class="item">
                                                        <figure>
                                                            <div class="icon-overlay icn-link">
                                                                <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_post_thumbnail(); ?></a>
                                                            </div><!-- /.icon-overlay -->
                                                            <figcaption class="bordered no-top-border">
                                                                <div class="info">
                                                                    <h4><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a></h4>
                                                                    <p><?php echo wp_strip_all_tags( get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', '/' ), true)?></p>
                                                                </div><!-- /.info -->
                                                            </figcaption>
                                                        </figure>
                                                    </div><!-- /.item -->
                                                <?php endwhile; ?>
                                            </div><!-- /.owl-carousel -->
                                        </div><!-- /.panel-body -->
                                    </div><!-- /.content -->    
                                </div><!-- /.panel -->
                            </div><!-- /.accordion -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </section>
            <?php
        endif;

        wp_reset_postdata();
    }
}
