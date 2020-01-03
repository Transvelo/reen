<?php
/**
 * Template part for displaying posts
 *
 *
 * @package reen
 */
$additional_class = '';
if ( is_search() ) {
    $additional_class = 'post';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $additional_class ); ?>>
    <?php
    /**
     * Functions hooked in to reen_loop_post action.
     *
     * @hooked reen_post_header          - 10
     * @hooked reen_post_meta            - 20
     * @hooked reen_post_content         - 30
     */
    do_action( 'reen_loop_post' );
    ?>

</article><!-- #post-## -->
