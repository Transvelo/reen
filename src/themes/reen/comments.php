<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package reen
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<?php if ( have_comments() || ( ! comments_open() && 0 !== intval( get_comments_number() ) && post_type_supports( get_post_type(), 'comments' ) ) ) : ?>

<section id="comments" class="comments-area" aria-label="<?php esc_attr_e( 'Post Comments', 'reen' ); ?>">


	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
            <?php
                printf( // WPCS: XSS OK.
                    /* translators: 1: number of comments, 2: post title */
                    esc_html( _nx( '%1$s comment %2$s', '%1$s comments %2$s', get_comments_number(), 'comments title', 'reen' ) ),
                    number_format_i18n( get_comments_number() ),
                    '<span class="screen-reader-text">on ' . get_the_title() . '</span>'
                );

            ?>
        </h2>

		<ol class="comment-list">
            <?php
                wp_list_comments(
                    array(
                        'style'      => 'ol',
                        'short_ping' => true,
                        'callback'   => 'reen_comment',
                    )
                );
            ?>
        </ol><!-- .comment-list -->

			<?php
		endif;

		if ( ! comments_open() && 0 !== intval( get_comments_number() ) && post_type_supports( get_post_type(), 'comments' ) ) :
        ?>
        <p class="alert alert-warning no-comments"><?php esc_html_e( 'Comments are closed.', 'reen' ); ?></p>
        <?php

	endif; // Check for have_comments().

	?>

</section><!-- #comments -->

<?php endif; ?>
<?php 
if ( have_comments() && get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through. ?>
    <nav id="comment-nav-below" class="comment-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Comment Navigation Below', 'reen' ); ?>">
        <span class="sr-only screen-reader-text"><?php esc_html_e( 'Comment navigation', 'reen' ); ?></span>
        <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'reen' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'reen' ) ); ?></div>
    </nav><!-- #comment-nav-below -->
        <?php
endif; // Check for comment navigation. ?>
<div class="comment-form-wrapper">
<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

$fields =  array(

  'author' =>
    '<div class="comment-form-author row"><div class="col-md-6 reen-form-group"><label class="sr-only" for="author">' . esc_html__( 'Name', 'reen' ) .
    ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
    '<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' placeholder="' . esc_attr__( 'Name', 'reen' ) . ( $req ? esc_attr__( ' (Required)', 'reen' ) : '' ) . '" /></div></div>',

  'email' =>
    '<div class="row comment-form-email"><div class="col-md-6 reen-form-group"><label class="sr-only" for="email">' . esc_html__( 'Email', 'reen' ) .
    ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
    '<input id="email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' placeholder="' . esc_attr__( 'Email', 'reen' ) . ( $req ? esc_attr__( ' (Required)', 'reen' ) : '' ) . '" /></div></div>',

  'url' =>
    '<div class="row comment-form-url"><div class="col-md-6 reen-form-group"><label class="sr-only" for="url">' . esc_html__( 'Website', 'reen' ) . '</label>' .
    '<input id="url" name="url" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" placeholder="' . esc_attr__( 'Website', 'reen' ) .'" /></div></div>',

);

$args = apply_filters(
    'reen_comment_form_args', array(
        'title_reply_before' => '<h2>',
        'title_reply_after'  => '</h2>',
        'class_form'         => 'forms comment-form',
        'class_submit'       => 'btn btn-submit submit',
        'fields'             => apply_filters( 'reen_comment_form_default_fields', $fields ),
        'submit_field'       => '<div class="form-submit">%1$s %2$s</div>',
        'comment_field'      => '<div class="row comment-form-comment"><div class="col-md-12 reen-form-group"><label class="sr-only" for="comment">' . _x( 'Comment', 'noun', 'reen' ) . '</label><textarea id="comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true" placeholder="' . esc_attr__( 'Enter your comment ...', 'reen' ) . '"></textarea></div></div>',
    )
);


comment_form( $args );
?></div><!-- /.comment-form-wrapper -->
