<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package REEN
 */
$additional_class = '';
$additional_class .= ' article__page inner-bottom';

?>

 <article id="post-<?php the_ID(); ?>" <?php post_class( $additional_class ); ?>>
    <?php
    /**
     * Functions hooked in to reen_page add_action
     * @hooked reen_page_title              - 10
     * @hooked reen_page_subtitle           - 20
     */
    do_action( 'reen_page' );
    ?>
</article>
