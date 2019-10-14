<?php
/**
 * Template used to display post content on single pages.
 *
 * @package reen
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'article' ); ?>>
    <?php
    do_action( 'reen_portfolio_single_post_audio_top' );

    /**
     * Functions hooked into reen_single_portfolio_post_audio_top action
     *
     * @hooked reen_portfolio_post_panel_open 
     * @hooked reen_portfolio_audio
     * @hooked reen_portfolio_post_panel_close
     */
    do_action( 'reen_portfolio_single_post_audio' );

    /**
     *
     * Functions hooked in to reen_single_portfolio_post_audio action
     *     
     */
    do_action( 'reen_portfolio_single_post_audio_bottom' );
    ?> 
</article>