<?php

function reen_demo_color_styles() {
    $colors = array( 'blue', 'gray', 'green', 'navy', 'orange', 'pink', 'purple', 'red' );
    $demo_color = '';
    if( isset( $_GET['color'] ) ) {
        $demo_color = $_GET['color'];
        setcookie( 'reen_demo_color', $_GET['color'], time()+3600 );
    } elseif( isset( $_COOKIE['reen_demo_color'] ) ) {
        $demo_color = $_COOKIE['reen_demo_color'];
    }

    if( ! empty( $demo_color ) && in_array( $demo_color, $colors ) ) {
        wp_enqueue_style( 'reen-demo-color', get_template_directory_uri() . '/assets/css/colors/' . $demo_color . '.css' );
    }
}

add_action( 'wp_enqueue_scripts', 'reen_demo_color_styles', PHP_INT_MAX );