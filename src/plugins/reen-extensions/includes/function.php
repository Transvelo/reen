<?php

// Register widgets.
function reen_widgets_register() {
    if ( class_exists( 'REEN' ) ) {
        include_once REEN_EXTENSIONS_DIR . '/includes/widgets/class-reen-random-posts-widget.php';
        register_widget( 'REEN_Random_Posts_Widget' );
        include_once REEN_EXTENSIONS_DIR . '/includes/widgets/class-reen-featured-posts-widget.php';
        register_widget( 'REEN_Featured_Posts_Widget' );
    }
}

add_action( 'widgets_init', 'reen_widgets_register' );
