<?php
/**
 * Reen functions.
 *
 * @package front
 */

if ( ! function_exists( 'reen_is_jetpack_activated' ) ) {
    /**
     * Query JetPack activation
     */
    function reen_is_jetpack_activated() {
        return class_exists( 'Jetpack' ) ? true : false;
    }
}


if ( ! function_exists( 'reen_is_redux_activated' ) ) {
    function reen_is_redux_activated() {
        /**
         * Query Redux Framework activation
         */
        return class_exists( 'ReduxFramework' );
    }
}

/**
 * Determines if post thumbnail can be displayed.
 */
function reen_can_show_post_thumbnail() {
    return apply_filters( 'reen_can_show_post_thumbnail', ! post_password_required() && ! is_attachment() && has_post_thumbnail() );
}