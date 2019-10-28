<?php

if ( ! function_exists( 'reen_redux_change_blog_style' ) ) {
    function reen_redux_change_blog_style( $style ) {

        global $reen_options;  

        if ( isset( $reen_options['blog_style'] ) ) {
            $style = $reen_options['blog_style'];
        }

        return $style;
    }
}

if ( ! function_exists( 'reen_redux_change_blog_layout' ) ) {
    function reen_redux_change_blog_layout( $layout ) {

        global $reen_options;

        if ( isset( $reen_options['blog_layout'] ) ) {
            $layout = $reen_options['blog_layout'];
        }

        return $layout;
    }
}

if ( ! function_exists( 'reen_redux_change_grid_columns' ) ) {
    function reen_redux_change_grid_columns( $columns ) {

        global $reen_options;

        if ( isset( $reen_options['grid_columns'] ) ) {
            $columns = $reen_options['grid_columns'];
        }

        return $columns;
    }
} 

if ( ! function_exists( 'reen_redux_change_single_blog_layout' ) ) {
    function reen_redux_change_single_blog_layout( $layout ) {

        global $reen_options;

        if ( isset( $reen_options['single_blog_layout'] ) ) {
            $layout = $reen_options['single_blog_layout'];
        }

        return $layout;
    }
}

if ( ! function_exists( 'redux_toggle_related_posts' ) ) {
    function redux_toggle_related_posts( $enable ) {
        global $reen_options;

        if ( ! isset( $reen_options['enable_related_posts'] ) ) {
            $reen_options['enable_related_posts'] = true;
        }

        if ( $reen_options['enable_related_posts'] ) {
            $enable = true;
        } else {
            $enable = false;
        }
        
        return $enable;
    }
}

if ( ! function_exists( 'redux_toggle_author_info' ) ) {
    function redux_toggle_author_info( $enable ) {
        global $reen_options;

        if ( ! isset( $reen_options['show_blog_post_author_info'] ) ) {
            $reen_options['show_blog_post_author_info'] = true;
        }

        if ( $reen_options['show_blog_post_author_info'] ) {
            $enable = true;
        } else {
            $enable = false;
        }
        
        return $enable;
    }
}

if ( ! function_exists( 'redux_toggle_social_sharing' ) ) {
    function redux_toggle_social_sharing( $enable ) {
        global $reen_options;

        if ( ! isset( $reen_options['show_social_sharing'] ) ) {
            $reen_options['show_social_sharing'] = true;
        }

        if ( $reen_options['show_social_sharing'] ) {
            $enable = true;
        } else {
            $enable = false;
        }
        
        return $enable;
    }
}
  