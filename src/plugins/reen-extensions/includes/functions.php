<?php

// Register widgets.
function front_widgets_register() {

    if ( class_exists( 'Front' ) ) {
        include_once FRONT_EXTENSIONS_DIR . '/includes/widgets/class-front-random-posts-widget.php';
        register_widget( 'Front_Random_Posts_Widget' );
    }

    if ( class_exists( 'Front' ) && class_exists( 'WooCommerce' ) ) {
        include_once FRONT_EXTENSIONS_DIR . '/includes/widgets/class-front-widget-layered-nav.php';
        register_widget( 'Front_Layered_Nav_Widget' );
        include_once FRONT_EXTENSIONS_DIR . '/includes/widgets/class-front-widget-rating-filter.php';
        register_widget( 'Front_Widget_Rating_Filter' );
        include_once FRONT_EXTENSIONS_DIR . '/includes/widgets/class-front-widget-price-filter.php';
        register_widget( 'Front_Widget_Price_Filter' );
    }
}

add_action( 'widgets_init', 'front_widgets_register' );

function front_remove_sharedaddy_excerpt_sharing() {
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
}

add_action( 'single_job_listing_before', 'front_remove_sharedaddy_excerpt_sharing' );
add_action( 'single_company_before', 'front_remove_sharedaddy_excerpt_sharing' );

add_action( 'show_user_profile', 'front_add_author_byline_field', 10, 1 );
add_action( 'edit_user_profile', 'front_add_author_byline_field', 10, 1 );

function front_add_author_byline_field( $user ) {
    ?><h3><?php echo esc_html__( 'Additional Profile Information', 'front-extensions' ); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="user_byline"><?php echo esc_html__( 'Author Byline', 'front-extensions' ); ?></label></th>
            <td>
                <input type="text" name="user_byline" id="user_byline" value="<?php echo esc_attr( get_the_author_meta( 'user_byline', $user->ID ) ); ?>" class="regular-text" /><br />
                <p class="description"><?php echo esc_html__( 'Displayed below author name in Single Srticle Classic in Front Theme', 'front-extensions' ); ?></p>
            </td>
        </tr>
    </table><?php
}

add_action( 'personal_options_update',  'front_save_author_byline_field' );
add_action( 'edit_user_profile_update', 'front_save_author_byline_field' );

function front_save_author_byline_field( $user_id ) {

    if ( ! current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    $user_byline = filter_input( INPUT_POST, 'user_byline', FILTER_SANITIZE_STRING );
    update_user_meta( $user_id, 'user_byline', $user_byline );
}