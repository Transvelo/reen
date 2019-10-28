<?php
/**
 * Template used to display post type quote.
 *
 * @package reen
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'format-quote' ); ?>>
    <?php
    /**
     * Functions hooked in to reen_loop_post_quote action.
     *
     * @hooked reen_post_the_content - 10
     */
    do_action( 'reen_loop_post_quote' );
    ?>

</article><!-- #post-## -->