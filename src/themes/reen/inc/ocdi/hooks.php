<?php
add_action( 'pt-ocdi/before_content_import', 'reen_ocdi_before_import_setup' );

add_filter( 'pt-ocdi/import_files', 'reen_ocdi_import_files' );

add_action( 'pt-ocdi/after_import', 'reen_ocdi_after_import_setup' );

add_action( 'pt-ocdi/before_widgets_import', 'reen_ocdi_before_widgets_import' );

add_action( 'admin_enqueue_scripts', 'reen_ocdi_admin_scripts' );

add_filter( 'wp_import_post_data_processed', 'reen_wp_import_post_data_processed', 99, 2 );