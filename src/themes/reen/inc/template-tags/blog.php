<?php
/**
 * Template tags used in Blog Pages
 */

if ( ! function_exists( 'reen_loop_container_wrap_start' ) ) {
    function reen_loop_container_wrap_start() {
        $blog_layout = reen_get_blog_layout();
        $single_post_layout = reen_get_single_post_layout();
        $blog_style = reen_get_blog_style();

        if ( is_single() ) {
            $container_class = !empty( $single_post_layout ) ? $single_post_layout : 'no-sidebar';
        } elseif ( is_home() || ( 'post' == get_post_type() && ( is_category() || is_tag() || is_author() || is_date() || is_year() || is_month() || is_time() ) ) ) {
            $container_class = !empty( $blog_layout ) ? $blog_layout : 'no-sidebar';
        }

        if ('classic-blog' === $blog_style) {
            $container_class .= ' classic-blog';
        } else {
            $container_class .= ' grid-blog';
        }

        $container_class .= apply_filters( 'reen_blog_container_classes', ' inner-top-sm inner-bottom');
        

        ?><section id="blog" class="light-bg"><div class="container <?php echo esc_attr( $container_class ); ?>"><?php
    }
}

if ( ! function_exists( 'reen_loop_container_wrap_end' ) ) {
    function reen_loop_container_wrap_end() {
        ?></div></section><?php
    }
}

if ( ! function_exists( 'reen_format_filter' ) ) {
    /**
     * Displays format filter
     */
    function reen_format_filter() {
        if ( ! is_singular() ) :
        ?><div class="row inner-bottom-xs">
            <div class="col-md-12"> 
                <ul class="format-filter text-center">
                    <li><a class="active" href="#" data-filter="*" title="All" data-rel="tooltip" data-placement="top"><i class="icon-th"></i></a></li>
                        <?php 
                            $post_formats = get_theme_support( 'post-formats' );
                              if (isset($post_formats[0]) && is_array( $post_formats[0] ) ) {

                                   foreach ( $post_formats[0] as $post_format ) : 
                                    
                                        if( $post_format === 'image' ) {
                                            $post_icon = 'icon-picture-1';
                                        } elseif( $post_format === 'gallery' ){
                                            $post_icon = 'icon-picture';
                                        } elseif( $post_format === 'video' ){
                                            $post_icon = 'icon-video-1';
                                        } elseif( $post_format === 'audio' ){
                                            $post_icon = 'icon-music-1';
                                        } elseif( $post_format === 'quote' ){
                                            $post_icon = 'icon-quote';
                                        } elseif( $post_format === 'link' ){
                                            $post_icon = 'icon-popup';
                                        } else {
                                            $post_icon = 'icon-edit';
                                        }
                                        
                                        ?>
                                        <?php if ( ! has_post_format() ) : ?><li><a href="#" data-filter=".format-<?php echo esc_attr($post_format);?>" title="<?php echo esc_attr($post_format);?>" data-rel="tooltip" data-placement="top"><i class="<?php echo esc_html($post_icon);?>"></i></a></li><?php endif; ?>
                                    <?php endforeach; 
                        
                            }
                        ?>
                </ul><!-- /.format-filter -->
            </div><!-- /.col -->
        </div><!-- /.row --><?php
        endif;
    }
}


if ( ! function_exists( 'reen_loop_row_wrap_start' ) ) {
    function reen_loop_row_wrap_start() {
        $blog_layout = reen_get_blog_layout();
        $blog_style = reen_get_blog_style();

        if ( 'no-sidebar' === $blog_layout && 'classic-blog' ===  $blog_style ) {
            $blog_column_classes = 'col-lg-9 mx-auto';
        } elseif ( 'no-sidebar' === $blog_layout && 'grid-blog' ===  $blog_style ) {
            $blog_column_classes = 'col-md-12';

        } elseif ( 'sidebar-left' === $blog_layout ) {
            $blog_column_classes = 'col-lg-9 order-lg-2 inner-left-sm';
        } else  {
            $blog_column_classes = 'col-lg-9 inner-right-sm';
        } 

        ?><div class="row"><div class="<?php echo esc_attr( $blog_column_classes ); ?>"><?php
    }
}

if ( ! function_exists( 'reen_loop_row_wrap_end' ) ) {
    function reen_loop_row_wrap_end() {
        ?></div>
        <?php reen_get_sidebar();?>
        </div><?php
    }
}

if ( ! function_exists( 'reen_loop_posts_wrap_start' ) ) {
    /**
     * Open posts <div>
     */
    function reen_loop_posts_wrap_start() {
        $blog_style = reen_get_blog_style();
        $blog_layout = reen_get_blog_layout();

        $columns = apply_filters( 'reen_blog_grid_columns', 2 );
        $posts_wrap_class = apply_filters( 'reen_posts_wrap_class', 'sidemeta ' ); ?>
        <?php if ( 'grid-blog' == $blog_style && 'no-sidebar' == $blog_layout ) : ?><div class="grid-blog no-sidebar col-<?php echo esc_attr( $columns ); ?>-custom">
        <?php elseif ( 'grid-blog' == $blog_style ) : ?><div class="grid-blog  col-2-custom">
        <?php endif; ?>

            <div class="posts <?php echo esc_attr( $posts_wrap_class ); ?>"><?php
    }

}

if ( ! function_exists( 'reen_loop_posts_wrap_end' ) ) {
    /**
     * Close posts <div>
     */
    function reen_loop_posts_wrap_end() {

        $blog_style = reen_get_blog_style();
            ?></div><!-- /.articles -->
        <?php if ( 'grid-blog' == $blog_style ) : ?>
        </div><?php
        endif;
    }

}


if ( ! function_exists( 'reen_get_post_format_icon' ) ) {
    /**
     *
     */
    function reen_get_post_format_icon( $format = '' ) {
        $supported_post_formats = apply_filters( 'reen_supported_post_formats', array( 
            'image'   => 'icon-picture-1',
            'gallery' => 'icon-picture',
            'video'   => 'icon-video-1',
            'audio'   => 'icon-music-1',
            'quote'   => 'icon-quote',
            'link'    => 'icon-popup'
        ) );
        $format = empty( $format ) ? get_post_format() : $format ;
        $format_icon = isset( $supported_post_formats[ $format ] ) ? $supported_post_formats[ $format ] : 'icon-edit';
        return $format_icon;
    }
}

if ( ! function_exists( 'reen_post_date' ) ) {
    function reen_post_date() {
        reen_posted_on(); 
    }
}


if ( ! function_exists( 'reen_posted_on' ) ) {
    function reen_posted_on() {
        $time_string = '<time class="date entry-date published updated" datetime="%1$s"><span class="day">%2$s</span><span class="month">%3$s</span></time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="date entry-date published" datetime="%1$s"><span class="day">%2$s</span><span class="month">%3$s</span></time> <time class="updated" datetime="%4$s">%5$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c') ),
            esc_html( get_the_date('j') ),
            esc_html( get_the_date('M') ),
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html( get_the_modified_date() )
        );

        printf(
            '<div class="date-wrapper"><a class="article__date--link" href="%1$s">%2$s</a></div>',
            esc_url( get_permalink() ),
            $time_string
        ); 
    }
}

if ( ! function_exists( 'reen_post_content_start' ) ) {
    function reen_post_content_start() {
        ?><div class="post-content"><?php
    }
}

if ( ! function_exists( 'reen_post_content_end' ) ) {
    function reen_post_content_end() {
        ?></div><?php
    }
}

if ( ! function_exists( 'reen_post_title' ) ) {
    function reen_post_title() {
        if ( is_singular() ) :
            the_title( '<h1 class="post-title entry-title">', '</h1>' );
        else :
            the_title( sprintf( '<h2 class="post-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
        endif;
    }
}

if ( ! function_exists( 'reen_post_format' ) ) {
    function reen_post_format() {
        $post_format = get_post_format();
        switch( $post_format ) {
            case 'aside':
                $icon = 'fas fa-hand-point-left';
            break;
            case 'gallery':
                $icon = 'icon-picture';
            break;
            case 'link':
                $icon = 'icon-popup';
            break;
            case 'image':
                $icon = 'icon-picture-1';
            break;
            case 'quote':
                $icon = 'icon-quote';
            break;
            case 'status':
                $icon = 'far fa-comment-alt';
            break;
            case 'video':
                $icon = 'icon-video-1';
            break;
            case 'audio':
                $icon = 'icon-music-1';
            break;
            case 'chat':
                $icon = 'far fa-comments';
            break;
            default:
                $icon = 'icon-edit';
        }

        $post_icon = apply_filters( 'reen_post_icon', $icon, $post_format );
        ?><div class="format-wrapper"><a href="#"><i class="<?php echo esc_attr( $post_icon ); ?>"></i></a></div><?php
    }
}

if ( ! function_exists( 'reen_post_meta' ) ) {
    function reen_post_meta() {
        ?><ul class="meta"><?php 
            if ( apply_filters( 'reen_post_meta_show_cat', true ) ) : ?>
               <li class="categories"><?php echo reen_post_categories();?></li>
            <?php endif; 

            if ( apply_filters( 'reen_post_meta_show_comment', true ) ) : ?>
               <li class="comments"><?php echo reen_post_comments();?></li>
            <?php endif; ?>
            
        </ul><?php
    }
}

if ( ! function_exists( 'reen_post_summary' ) ) {
    function reen_post_summary() {
        do_action( 'reen_post_summary' ); ?>
        <?php
    }
}

if ( ! function_exists( 'reen_post_side_meta' ) ) {
    function reen_post_side_meta() {
        do_action( 'reen_post_side_meta' ); ?>
        <?php
    }
}


if ( ! function_exists( 'reen_post_categories' ) ) {
    function reen_post_categories() {
        $categories_list = get_the_category_list( esc_html__( ', ', 'reen' ) );
            if ( $categories_list ) : ?>
                <span class="article__cat-links">
                    <?php
                    echo wp_kses_post( $categories_list );
                    ?>
                </span>
            <?php endif; // End if categories. ?>
        <?php
    }
}

if ( ! function_exists( 'reen_post_comments' ) ) {
    function reen_post_comments() {
        if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
            <span class="comments-link"><?php comments_popup_link( esc_html__( 'Leave a comment', 'reen' ), esc_html__( '1 Comment', 'reen' ), esc_html__( '% Comments', 'reen' ) ); ?></span>
        <?php endif;
    }
}

if ( ! function_exists( 'reen_post_excerpt' ) ) {
    function reen_post_excerpt() {
        the_excerpt();
    }
}

if( ! function_exists( 'reen_post_readmore' ) ) {

    function reen_post_readmore() {
        ?>
        <a href="<?php the_permalink(); ?>" class="btn btn--post-readmore"><?php echo apply_filters( 'reen_blog_post_readmore_text', esc_html__( 'Read More', 'reen' ) ); ?></a>
        <?php
    }
}

if ( ! function_exists( 'reen_post_media' ) ) {
    /**
     *
     */
    function reen_post_media() {
        $post_format = get_post_format();

        if ( reen_can_show_post_thumbnail() ) {
            reen_has_post_thumbnail();
        } else {
            if ( 'video' === $post_format ) {
                reen_post_video();    
            } elseif ( 'audio' == $post_format ) {
                reen_post_audio();
            } elseif ( 'gallery' == $post_format ) {
                reen_post_gallery();
            }
        }
    }
}

if ( ! function_exists( 'reen_has_post_thumbnail' ) ) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function reen_has_post_thumbnail() {
        if ( ! reen_can_show_post_thumbnail() ) {
            return;
        }

        if ( is_singular() ) :
            ?>

            <figure class="post-thumbnail icon-overlay icn-link post-media">
                <?php the_post_thumbnail(); ?>
            </figure><!-- .post-thumbnail -->

            <?php
        else :
            ?>

        <figure class="post-thumbnail icon-overlay icn-link post-media">
            <a class="post-thumbnail-inner" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <span class="icn-more"></span>
                <?php the_post_thumbnail( 'post-thumbnail' ); ?>
            </a>
        </figure>

            <?php
        endif; // End is_singular().
    }
endif;

if ( ! function_exists( 'reen_post_the_content' ) ) {
    /**
     * Displays post content
     */
    function reen_post_the_content() {
        ?><div class="post__content-inner"><?php
        the_content(
            sprintf(
                wp_kses_post( __( 'Continue reading %s', 'reen' ) ),
                '<span class="screen-reader-text">' . get_the_title() . '</span>'
            )
        ); ?></div><!-- /.article__content-inner --><?php
    }
}

if ( ! function_exists( 'reen_post_gallery' ) ) {
    /**
     * Displays post gallery when applicable
     */
    function reen_post_gallery() {
        global $post;

        $clean_post_format_gallery_meta_values = get_post_meta( get_the_ID(), '_gallery_images', true );
        $attachments = json_decode( stripslashes( $clean_post_format_gallery_meta_values ), true );

        // if there is a gallery block do this
        // if ( has_block( 'gallery', $post->post_content ) ) {
        //     $post_blocks = parse_blocks( $post->post_content );
        //     if ( isset( $post_blocks[0]['attrs']['ids'] ) ) {
        //         $attachments = $post_blocks[0]['attrs']['ids'];    
        //     }
        // } 
        // // if there is not a gallery block do this
        // else {
        //     // gets the gallery info
        //     $gallery = get_post_gallery( $post->ID, false );
            
        //     if ( isset( $gallery['ids'] ) ) {
        //         // makes an array of image ids
        //         $attachments = explode ( ',', $gallery['ids'] );
        //     }
        // }

        if ( ! empty( $attachments ) ) :

            $owl_params = apply_filters( 'owl_carousel_post_gallery_params', array(
                'items'               => 1,
                'autoplay'            => true,
                'autoplayTimeout'     => 5000,
                'autoplayHoverPause'  => true,
                'smartSpeed'          => 200,
                'rewind'              => true,
                'nav'                 => true,
                'dots'                => true,
                'autoHeight'          => true,
                'navText'             => array( '<i class="icon-left-open-mini"></i>', '<i class="icon-right-open-mini"></i>' )
            ));

            ?><div id="owl-work" data-ride="owl-carousel" data-owlparams="<?php echo esc_attr( json_encode( $owl_params ) ); ?>" class="owl-carousel post-gallery-carousel owl-inner-pagination owl-inner-nav post-media"><?php 
            foreach( $attachments as $attachment ) : ?>

                <div class="item">
                    <figure>
                        <?php echo wp_get_attachment_image( $attachment['id'], 'post-thumbnail' ); ?>
                    </figure>
                </div><?php 
            endforeach; ?></div><?php
        endif;
    }
}

if ( ! function_exists( 'reen_post_audio' ) ) {
    /**
     * Displays post audio when applicable
     */
    function reen_post_audio() {
        $content = apply_filters( 'the_content', get_the_content() );
        $audio   = false;

        // Only get audio from the content if a playlist isn't present.
        if ( false === strpos( $content, 'wp-playlist-script' ) ) {
            $audio = get_media_embedded_in_content( $content, array( 'audio', 'object', 'embed', 'iframe' ) );
        }

        if ( ! empty( $audio ) ) {
            foreach ( $audio as $audio_html ) {
                ?><div class="article__media post-media article__attachment--audio"><?php 
                    echo ( $audio_html ); 
                ?></div><!-- .article__attachment--audio --><?php
            }
        }
    }
}

if ( ! function_exists( 'reen_post_video' ) ) {
    /**
     * Displays post video when applicable
     */
    function reen_post_video() {
        $content = apply_filters( 'the_content', get_the_content() );
        $video   = false;

        // Only get video from the content if a playlist isn't present.
        if ( false === strpos( $content, 'wp-playlist-script' ) ) {
            $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
        }

        if ( ! empty( $video ) ) {
            foreach ( $video as $video_html ) {
                ?><div class="video-container post-media article__media article__attachment--video"><?php 
                    echo ( $video_html ); 
                ?></div><!-- .article__attachment--video --><?php
            }
        }
    }
}

if ( ! function_exists( 'reen_paging_nav' ) ) {
    /**
     * Display navigation to next/previous set of posts when applicable.
     */
    function reen_paging_nav() {
        global $wp_query;
        
        $args = array(
            'type'      => 'list',
            'next_text' => _x( 'Next', 'Next post', 'reen' ),
            'prev_text' => _x( 'Prev', 'Previous post', 'reen' ),
        );
        
        the_posts_pagination( $args );
    }
}

if ( ! function_exists( 'reen_get_sidebar' ) ) {
    /**
     * Display reen sidebar
     *
     * @uses get_sidebar()
     */
    function reen_get_sidebar() {
        get_sidebar();
    }
}

if ( ! function_exists( 'reen_toggle_post_side_meta_hooks' ) ) {
    function reen_toggle_post_side_meta_hooks() {
        $blog_style = reen_get_blog_style();

        if ( 'grid-blog' == $blog_style ) {
            remove_action( 'reen_loop_post',           'reen_post_side_meta',              10 );
            remove_action( 'reen_loop_post_link',      'reen_post_side_meta',              10 );
            remove_action( 'reen_loop_post_quote',     'reen_post_side_meta',              10 );
        }
    }
}

if ( ! function_exists( 'reen_popular_posts' ) ) {
    function reen_popular_posts() { 
        global $post;

        $popular_posts_args = array(
            'posts_type' => 'page',
             'posts_per_page' => 8,
             //'meta_key' => 'custom_sort_order',
             'orderby' => 'comment_count',
             //'orderby' => 'meta_value meta_value_num',
             'order'=> 'DESC'
            );
        $popular_posts_loop = new WP_Query( $popular_posts_args );
             
        
        if ( $popular_posts_loop->have_posts() ) : ?>
            
            <section id="popular-posts" class="light-bg">
                <div class="container inner-top-md">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="accordion-popular-posts" class="panel-group">
                                <div class="panel panel-default">             
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="panel-toggle" href="#content-popular-posts" data-toggle="collapse">
                                                <span><?php echo esc_html__( 'Popular posts', 'reen' ); ?></span>
                                            </a>
                                        </h4>
                                    </div><!-- /.panel-heading -->
                                    <div id="content-popular-posts" class="panel-collapse collapse show" data-parent="#accordion-popular-posts">
                                    <div class="panel-body"><?php
                                        $owl_params = apply_filters( 'owl-popular-posts_params', array(
                                            'autoPlay'     => 5000,
                                            'stopOnHover'  => true,
                                            'rewindNav'    => true,
                                            'items'        => 5,
                                            'nav'          => true,
                                            'dots'         => true,
                                            'navText'  => array( '<i class="icon-left-open-mini"></i>', '<i class="icon-right-open-mini"></i>' )
                                        ) );

                                        ?><div id="owl-popular-posts" data-ride="owl-carousel" data-owlparams="<?php echo esc_attr( json_encode( $owl_params ) ); ?>" class="owl-carousel popular-posts-carousel owl-item-gap-sm owl-theme">
                                            <?php while( $popular_posts_loop->have_posts() ):
                                                 $popular_posts_loop->the_post(); ?>
                                                <div class="item">
                                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                                                        <figure>
                                                            <figcaption class="text-overlay">
                                                                <div class="info">
                                                                    <h4><?php the_title(); ?></h4>
                                                                    <p class="categories"><?php reen_post_categories(); ?></p>
                                                                </div><!-- /.info -->
                                                            </figcaption>
                                                            <?php if ( has_post_thumbnail() ) {
                                                            the_post_thumbnail();
                                                            } else { ?>
                                                        
                                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/art/work01.jpg" alt="" />
                                                            <?php } ?>
                                                        </figure>
                                                    </a>
                                                </div><!-- /.item -->
                                            <?php endwhile; ?>
                                            <?php wp_reset_postdata(); ?>
                                            </div><!-- /.owl-carousel -->
                                        </div><!-- /.panel-body -->
                                    </div><!-- /.content -->    
                                </div><!-- /.panel -->
                            </div><!-- /.panel-group -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </section><?php
            endif;
    }
}


/**
 * Template tags used in Single Blog Pages
 */

if ( ! function_exists( 'reen_post_wrap_open' ) ) {
    function reen_post_wrap_open() {
        ?><div class="sidemeta "><?php
    }
}

if ( ! function_exists( 'reen_post_wrap_close' ) ) {
    function reen_post_wrap_close() {
        ?></div><?php
    }
}

if ( ! function_exists( 'reen_single_post_author_name' ) ) {
    function reen_single_post_author_name() { 
        if( apply_filters( 'reen_show_author_name', true ) ) :
            $current_user_id = get_current_user_id(); 
            ?>
            <p class="author"><a href="#" title="" data-rel="tooltip" data-placement="left" rel="tooltip" data-original-title="Post author"><?php the_author_meta( 'display_name', $current_user_id ); ?></a></p>
        <?php
        endif;

    }
}

if ( ! function_exists( 'reen_post_author' ) ) {
    function reen_post_author() {
        if( apply_filters( 'reen_show_author_info', true ) ) :
            $current_user_id = get_current_user_id();
            $author_url = get_the_author_meta( 'user_url' ); 
            ?>
            <div class="post-author">
                <div class="reen-author-info">
                    <div class="author-image icon-overlay icn-link">
                        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><span class="icn-more"></span>
                            <?php echo get_avatar( get_the_author_meta( 'ID' ) , 120 ); ?>
                        </a>
                    </div>
                    <div class="author-details">
                        <h3><?php echo esc_html__( 'About the author', 'reen' ); ?></h3>
                        <p><a href="#"><?php the_author_meta( 'display_name', $current_user_id );?></a><span> <?php echo the_author_meta( 'description' );?></span></p>

                        <ul class="meta">
                            <li class="author-posts">
                                <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                                    <?php echo sprintf( esc_html__( 'All posts by %s', 'reen' ), esc_html( get_the_author() ) ); ?>
                                </a>
                            </li>
                            <?php if ( (bool) $author_url ) : ?>
                            <li class="url"><a href="<?php echo esc_url( $author_url ); ?>"><?php echo esc_html( $author_url ); ?></a></li>
                            <?php endif; ?>
                        </ul><!-- /.meta -->

                            <?php if ( apply_filters( 'enable_author_social_links', TRUE ) ) :

                                // if( empty( $post_id ) ) {
                                //     $post_id = get_the_ID();
                                // }

                            $twitter            = esc_attr( get_post_meta( get_the_ID(), '_twitter', true ) );
                            $facebook           = esc_attr( get_post_meta( get_the_ID(), '_facebook', true ) );
                            $google_plus        = esc_attr( get_post_meta( get_the_ID(), '_google_plus', true ) );
 

                            $social_icons = apply_filters( 'reen_author_social_links_icons_args', array(
                                'facebook'  => array( 
                                    'class'         => 'facebook', 
                                    'icon'          => 'icon-s-facebook', 
                                    'title'         => esc_html__( 'Add me on Facebook', 'reen' ),
                                    'social_link'   => $facebook 
                                ),

                                'google_plus'          => array( 
                                    'class'         => 'google_plus', 
                                    'icon'          => 'icon-s-gplus', 
                                    'title'         => esc_html__( 'Add me on Google Plus', 'reen' ),
                                    'social_link'   => $google_plus 
                                ),
                                'twitter'       => array( 
                                    'class'         => 'twitter', 
                                    'icon'          => 'icon-s-twitter', 
                                    'title'         => esc_html__( 'Follow me on Twitter', 'reen' ),
                                    'social_link'   => $twitter 
                                ),
                                    
                                )
                            );
                            ?>
                            <ul class="social">
                                <?php foreach ($social_icons as $social_icon) : ?>
                                    <?php if( !empty( $social_icon['social_link'] ) ) :?>
                                    <?php $url = !empty( $social_icon['link_prefix'] ) ? $social_icon['link_prefix'] . ':' . $social_icon['social_link'] : esc_url( $social_icon['social_link'] ); ?>
                                    <li>
                                        <a href="<?php echo esc_url( $url ); ?>"><i class="<?php echo esc_attr( $social_icon['icon'] ); ?>"></i></a>
                                    </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                            <?php
                        endif;?>
                    </div>

                    
            </div>
            </div>
            <?php
        endif;
    }
}