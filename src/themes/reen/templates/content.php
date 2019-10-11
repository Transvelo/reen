<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package REEN
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-ren' ); ?>>
    <?php
    /**
     * Functions hooked in to front_loop_post action.
     *
     * @hooked front_post_header          - 10
     * @hooked front_post_meta            - 20
     * @hooked front_post_content         - 30
     */
    do_action( 'reen_loop_post' );
    ?>

</article><!-- #post-## -->
