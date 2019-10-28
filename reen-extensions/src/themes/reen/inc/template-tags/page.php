<?php
/**
 * REEN template functions.
 *
 * @package REEN
 */

if ( ! function_exists( 'reen_page_header' ) ) {
    function reen_page_header() {
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

if ( ! function_exists( 'reen_page_content' ) ) {
    function reen_page_content() { ?>
        <div class="container">
            <div class="col-lg-12 "> 
                <div class="page__content">
                    <?php the_content(); ?>
                </div><?php
                 if ( comments_open() || '0' != get_comments_number() ) :
                    comments_template();
            ?></div><?php   
            endif;
        ?></div><?php
    }
}