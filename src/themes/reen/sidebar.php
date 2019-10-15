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

$sidebar_class = 'blog-sidebar col-lg-3';
$blog_layout   = reen_get_blog_layout();

if ( $blog_layout === 'sidebar-left' ) {
    $sidebar_class .= ' order-lg-1';
}

if ( $blog_layout == 'sidebar-left' || $blog_layout == 'sidebar-right' ) :
?>
<aside id="secondary" class="widget-area <?php echo esc_attr( $sidebar_class ); ?>">
	<?php dynamic_sidebar( 'sidebar-blog' ); ?>
</aside><!-- #secondary -->
<?php endif; ?>
