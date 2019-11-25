<?php
/**
 * REEN template functions.
 *
 * @package REEN
 */

if ( ! function_exists( 'reen_page_header' ) ) {
    function reen_page_header() {
        

        global $post;
        $hide_page_header = false;

        if ( isset( $post->ID ) ) {
            $page_header_meta_values = get_post_meta( $post->ID, '_hidePageHeader', true );
            if ( isset( $page_header_meta_values ) && $page_header_meta_values ) {
                $hide_page_header = $page_header_meta_values;
            }
        }

        if( ! $hide_page_header ) {
            if ( is_page() && apply_filters( 'reen_show_site_content_page_header', true ) ) : ?>
            <?php if ( apply_filters( 'reen_show_site_content_page_title', true ) ) : ?>
            <div class="container inner">
                <div class="row">
                    <div class="col-lg-8 col-md-9 mx-auto text-center">       
                        <header>
                            <h1><?php echo esc_html( apply_filters( 'reen_site_content_page_title', get_the_title() ) ); ?></h1>
                            <p><?php echo esc_html( apply_filters( 'reen_site_content_page_subtitle', get_the_title() ) );?></p>
                        </header>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endif;
        }
    }
}

if ( ! function_exists( 'reen_page_content' ) ) {
    function reen_page_content() { 

        global $post;

        $page_meta_values = get_post_meta( $post->ID, '_disableContainer', true );

        $article_content_additional_class = '';

        if ( ! ( isset( $page_meta_values ) && $page_meta_values) ) {
            $article_content_additional_class .= ' container';
        }

        ?>
        <div class="article__content article__content--page<?php echo esc_attr( $article_content_additional_class ); ?>">
            <div class="page__content">
                <?php the_content(); ?>
            </div>
            <?php
                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'reen' ),
                        'after'  => '</div>',
                    )
                );
            ?>
        </div><!-- .entry-content --><?php
    }
}