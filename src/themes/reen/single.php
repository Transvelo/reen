<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package REEN
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			do_action( 'reen_single_post_before' );

			get_template_part( 'templates/contents/content', 'single' );

			do_action( 'reen_single_post_after' );
		endwhile; // End of the loop.
		?>
    

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
