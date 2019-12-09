<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package REEN
 */

if ( ! is_active_sidebar( 'sidebar-blog' ) ) {
    return;
}

$blog_layout   = reen_get_blog_layout();

if ( $blog_layout == 'sidebar-left' || $blog_layout == 'sidebar-right' ) :
?>
<aside id="secondary" class="widget-area blog-sidebar col-lg-3 col-md-4">
	<?php dynamic_sidebar( 'sidebar-blog' ); ?>
</aside><!-- #secondary -->
<?php endif; ?>
