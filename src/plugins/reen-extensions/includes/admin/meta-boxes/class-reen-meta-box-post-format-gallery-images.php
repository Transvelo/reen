<?php
/**
 * Post Format Images
 *
 * Display the post format images meta box.
 *
 * @author      MadrasThemes
 * @category    Admin
 * @package     Reen/Admin/Meta Boxes
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Reen_Meta_Box_Post_Format_Gallery_Images Class.
 */
class Reen_Meta_Box_Post_Format_Gallery_Images {

	/**
	 * Output the metabox.
	 *
	 * @param WP_Post $post
	 */
	public static function output( $post ) {
		global $thepostid;

		$thepostid      = $post->ID;
		wp_nonce_field( 'reen_save_data', 'reen_meta_nonce' );
		?>
		<div id="gallery_images_container">
			<ul class="gallery_images">
				<?php
				$post_format_image_gallery = explode( ',', get_post_meta( $post->ID, '_post_format_image_gallery', true ) );
				$attachments         = array_filter( $post_format_image_gallery );
				$update_meta         = false;
				$updated_gallery_ids = array();

				if ( ! empty( $attachments ) ) {
					foreach ( $attachments as $attachment_id ) {
						$attachment = wp_get_attachment_image( $attachment_id, 'thumbnail' );

						// if attachment is empty skip.
						if ( empty( $attachment ) ) {
							$update_meta = true;
							continue;
						}

						echo '<li class="image" data-attachment_id="' . esc_attr( $attachment_id ) . '">
								' . $attachment . '
								<ul class="actions">
									<li><a href="#" class="delete tips" data-tip="' . esc_attr__( 'Delete image', 'reen-extensions' ) . '">' . __( 'Delete', 'reen-extensions' ) . '</a></li>
								</ul>
							</li>';

						// rebuild ids to be saved.
						$updated_gallery_ids[] = $attachment_id;
					}

					// need to update portfolio meta to set new gallery ids
					if ( $update_meta ) {
						update_post_meta( $post->ID, '_post_format_image_gallery', implode( ',', $updated_gallery_ids ) );
					}
				}
				?>
			</ul>

			<input type="hidden" id="post_format_image_gallery" name="post_format_image_gallery" value="<?php echo esc_attr( implode( ',', $updated_gallery_ids ) ); ?>" />

		</div>
		<p class="add_gallery_images hide-if-no-js">
			<a href="#" data-choose="<?php esc_attr_e( 'Add images to post format gallery', 'reen-extensions' ); ?>" data-update="<?php esc_attr_e( 'Add to gallery', 'reen-extensions' ); ?>" data-delete="<?php esc_attr_e( 'Delete image', 'reen-extensions' ); ?>" data-text="<?php esc_attr_e( 'Delete', 'reen-extensions' ); ?>"><?php _e( 'Add post format gallery images', 'reen-extensions' ); ?></a>
		</p>
		<?php
	}

	/**
	 * Save meta box data.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 */
	public static function save( $post_id, $post ) {
		$attachment_ids = isset( $_POST['post_format_image_gallery'] ) ? array_filter( explode( ',', reen_clean( $_POST['post_format_image_gallery'] ) ) ) : array();
		$updated_gallery_ids = implode( ',', $attachment_ids );
		update_post_meta( $post->ID, '_post_format_image_gallery', $updated_gallery_ids );

	}
}
