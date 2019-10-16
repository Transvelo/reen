<?php if ( has_post_thumbnail() ) { ?>
    <img src="<?php the_post_thumbnail_url(); ?>"/>

    <?php } else {
        wc_placeholder_img_src();
    }
?>

<?php the_post_thumbnail()?>