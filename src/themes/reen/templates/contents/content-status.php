<?php
/**
 * Template used to display post type status.
 *
 * @package reen
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'format-status' ); ?>>
    <?php
    /**
     * Functions hooked in to reen_loop_post_quote action.
     *
     * @hooked reen_post_the_content - 10
     */
    do_action( 'reen_loop_post_content' );
    ?>

</article><!-- #post-## -->