<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package REEN
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( ); ?>>
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
