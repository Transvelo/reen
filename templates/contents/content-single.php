<?php
/**
 * Template used to display post content on single pages.
 *
 * @package reen
 */

?>

<article <?php post_class( 'post post__single' ); ?> id="post-<?php the_ID(); ?>">

    <?php do_action( 'reen_single_post_top' );
    /**
    * Functions hooked into reen_single_post_before action
    */
    do_action( 'reen_single_post' );
    /**
    * Functions hooked in to reen_single_post_after action
    */
    do_action( 'reen_single_post_bottom' );?>
    
</article>