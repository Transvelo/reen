<?php
/**
 * Template used to display post type link.
 *
 * @package reen
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'format-link' ); ?>>
    <?php
    /**
     * Functions hooked in to reen_loop_post_link action.
     *
     * @hooked reen_post_the_content - 10
     */
    do_action( 'reen_loop_post_link' );
    ?>

</article><!-- #post-## -->