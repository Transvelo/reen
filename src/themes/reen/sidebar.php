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
$blog_style    = reen_get_blog_style();

if ( 'sidebar-left' === $blog_layout ) {
    if ('classic-blog' ===  $blog_style) {
        $blog_sidebar_column_classes = 'col-lg-3 order-lg-1';
    } else {
        $blog_sidebar_column_classes = 'col-lg-3 col-md-4 order-md-1';
    }
    
} elseif ( 'sidebar-right' === $blog_layout ) {
    if ('classic-blog' ===  $blog_style) {
        $blog_sidebar_column_classes = 'col-lg-3';
    } else {
        $blog_sidebar_column_classes = 'col-lg-3 col-md-4';
    }
    
}


if ( $blog_layout == 'sidebar-left' || $blog_layout == 'sidebar-right' ) :
?>
<aside id="secondary" class="widget-area blog-sidebar <?php echo esc_attr( $blog_sidebar_column_classes ); ?>">
	<?php dynamic_sidebar( 'sidebar-blog' ); ?>
</aside><!-- #secondary -->
<?php endif; ?>
