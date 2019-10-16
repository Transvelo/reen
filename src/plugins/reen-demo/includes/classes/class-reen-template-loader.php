<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Template Loader
 *front_post_author_bio
 * @class       WC_Template
 * @version     1.0.0
 * @package     Front
 * @category    Class
 * @author      MadrasThemes
 */

class Front_Template_Loader {

    /**
     * Hook in methods.
     */
    public static function init() {
        add_filter( 'query_vars', array( __CLASS__, 'add_query_vars_filter' ) );
        add_filter( 'template_include', array( __CLASS__, 'template_loader' ) );
        add_filter( 'front_single_post_layout', array( __CLASS__, 'single_post_layout_loader' ), PHP_INT_MAX );
        add_action( 'init', array( __CLASS__, 'rewrite_portfolio_tags' ), 10, 0 );
        add_action( 'init', array( __CLASS__, 'rewrite_portfolio_rule' ), 10, 0 );
        add_action( 'init', array( __CLASS__, 'rewrite_jobs_rule' ), 10, 0 );
        add_action( 'init', array( __CLASS__, 'rewrite_resumes_rule' ), 10, 0 );
        add_filter( 'front_get_wpjm_job_listing_style', array( __CLASS__, 'wpjm_job_listing_style_loader' ), PHP_INT_MAX );
        add_filter( 'front_get_wpjm_job_listing_layout', array( __CLASS__, 'wpjm_job_listing_layout_loader' ), PHP_INT_MAX );
        add_filter( 'front_get_wpjm_job_single_style', array( __CLASS__, 'wpjm_job_single_style_loader' ), PHP_INT_MAX );
        add_filter( 'front_get_wpjmr_resume_listing_style', array( __CLASS__, 'wpjmr_resume_listing_style_loader' ), PHP_INT_MAX );
        add_filter( 'front_get_wpjmr_resume_listing_layout', array( __CLASS__, 'wpjmr_resume_listing_layout_loader' ), PHP_INT_MAX );
        add_action( 'pre_get_posts', 'front_demo_override_posts_per_page', PHP_INT_MAX );
        add_filter( 'front_single_post_style', array( __CLASS__, 'post_style_loader' ) );
        add_filter( 'blog_startup_query_args', 'front_demo_override_startup_query_args', 10 );
        add_filter( 'blog_business_query_args', 'front_demo_override_business_query_args', 10 );
        add_filter( 'blog_agency_query_args', 'front_demo_override_agency_query_args', 10 );
    }


    public static function rewrite_portfolio_tags() {
        add_rewrite_tag( '%portfolio-view%', '([^&]+)' );
        add_rewrite_tag( '%portfolio-layout%', '([^&]+)' );
        add_rewrite_tag( '%blog-view%', '([^&]+)' );
        add_rewrite_tag( '%blog-layout%', '([^&]+)' );
    }

    public static function rewrite_portfolio_rule() {
        add_rewrite_rule( '^portfolio/boxed-classic?', 'index.php?post_type=jetpack-portfolio&portfolio-view=classic&portfolio-layout=boxed','top' );
        add_rewrite_rule( '^portfolio/boxed-grid?', 'index.php?post_type=jetpack-portfolio&portfolio-view=grid&portfolio-layout=boxed','top' );
        add_rewrite_rule( '^portfolio/boxed-masonry?', 'index.php?post_type=jetpack-portfolio&portfolio-view=masonry&portfolio-layout=boxed','top' );
        add_rewrite_rule( '^portfolio/boxed-modern?', 'index.php?post_type=jetpack-portfolio&portfolio-view=modern&portfolio-layout=boxed','top' );
        add_rewrite_rule( '^portfolio/fullwidth-classic?', 'index.php?post_type=jetpack-portfolio&portfolio-view=classic&portfolio-layout=fullwidth','top' );
        add_rewrite_rule( '^portfolio/fullwidth-grid?', 'index.php?post_type=jetpack-portfolio&portfolio-view=grid&portfolio-layout=fullwidth','top' );
        add_rewrite_rule( '^portfolio/fullwidth-masonry?', 'index.php?post_type=jetpack-portfolio&portfolio-view=masonry&portfolio-layout=fullwidth','top' );
        add_rewrite_rule( '^portfolio/fullwidth-modern?', 'index.php?post_type=jetpack-portfolio&portfolio-view=modern&portfolio-layout=fullwidth','top' );
        $categories = get_categories( array( 'slug' => array( 'blog-classic', 'blog-grid', 'blog-list', 'blog-modern', 'blog-masonry' ) ) );
        foreach ( $categories as $category ) {
            add_rewrite_rule( '^blog/' . str_replace( 'blog-', '', $category->slug ) .'-right-sidebar?', 'index.php?cat=' . $category->cat_ID . '&blog-layout=sidebar-right', 'top' );
            add_rewrite_rule( '^blog/' . str_replace( 'blog-', '', $category->slug ) .'-left-sidebar?', 'index.php?cat=' . $category->cat_ID . '&blog-layout=sidebar-left', 'top' );
            add_rewrite_rule( '^blog/' . str_replace( 'blog-', '', $category->slug ) .'-full-width?', 'index.php?cat=' . $category->cat_ID . '&blog-layout=full-width', 'top' );
        }
    }

    public static function rewrite_jobs_rule() {
        add_rewrite_rule( '^jobs/grid-sidebar?', 'index.php?post_type=job_listing&jobs-view=grid&jobs-layout=right-sidebar','top' );
        add_rewrite_rule( '^jobs/list-sidebar?', 'index.php?post_type=job_listing&jobs-view=list&jobs-layout=right-sidebar','top' );
        add_rewrite_rule( '^jobs/grid?', 'index.php?post_type=job_listing&jobs-view=grid&jobs-layout=fullwidth','top' );
        add_rewrite_rule( '^jobs/list?', 'index.php?post_type=job_listing&jobs-view=list&jobs-layout=fullwidth','top' );
    }

    public static function rewrite_resumes_rule() {
        add_rewrite_rule( '^resumes/grid-sidebar?', 'index.php?post_type=resume&resumes-view=grid&resumes-layout=right-sidebar','top' );
        add_rewrite_rule( '^resumes/list-sidebar?', 'index.php?post_type=resume&resumes-view=list&resumes-layout=right-sidebar','top' );
        add_rewrite_rule( '^resumes/grid?', 'index.php?post_type=resume&resumes-view=grid&resumes-layout=fullwidth','top' );
        add_rewrite_rule( '^resumes/list?', 'index.php?post_type=resume&resumes-view=list&resumes-layout=fullwidth','top' );
    }

    public static function template_loader( $template ) {
        if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
            $template = FRONT_DEMO_DIR . '/templates/template-portfolio.php';
        } elseif ( is_front_page() && is_home() ) {
            // Default homepage
            $template = FRONT_DEMO_DIR . '/templates/template-blog.php';
        } elseif ( is_front_page() ) {
            // static homepage
        } elseif ( is_home() ) {
            $template = FRONT_DEMO_DIR . '/templates/template-blog.php';
        } elseif( is_category( 'blog-classic' ) || is_category( 'blog-grid' ) || is_category( 'blog-list' ) || is_category( 'blog-masonry' ) || is_category( 'blog-modern' ) ) {
            $template = FRONT_DEMO_DIR . '/templates/template-blog.php';
        } else {
            //everything else
        }

        return $template;
    }

    public static function add_query_vars_filter( $vars ){
        $vars[] = 'portfolio-view';
        $vars[] = 'portfolio-layout';
        $vars[] = 'blog-view';
        $vars[] = 'blog-layout';
        $vars[] = 'single-post-layout';
        $vars[] = "shop_view";
        $vars[] = "jobs-layout";
        $vars[] = "jobs-view";
        $vars[] = "job-view";
        $vars[] = "resumes-layout";
        $vars[] = "resumes-view";
        
        return $vars;
    }

    public static function portfolio_view_loader( $view ) {

        $custom_view = isset( $_GET['portfolio-view'] ) ? sanitize_text_field( $_GET['portfolio-view'] ) : '';

        if ( empty( $custom_view ) ) {
            $custom_view = get_query_var( 'portfolio-view' );
        }

        switch( $custom_view ) {
            case 'classic':
            case 'grid':
            case 'masonry':
            case 'modern':
                $view = $custom_view;
            break;
            default: 
                $view = $view;
        }

        return $view;
    }

    public static function portfolio_layout_loader( $layout ) {
 
        $custom_layout = isset( $_GET['portfolio-layout'] ) ? sanitize_text_field( $_GET['portfolio-layout'] ) : '';

        if ( empty( $custom_layout ) ) {
            $custom_layout = get_query_var( 'portfolio-layout' );
        }

        switch( $custom_layout ) {
            case 'boxed':
            case 'fullwidth':
                $layout = $custom_layout;
            break;
            default: 
                $layout = $layout;
        }

        return $layout;
    }

    public static function portfolio_hero_title( $title ) {
        $view = front_get_portfolio_view();
        $view = isset( $_GET['portfolio-view'] ) ? sanitize_text_field( $_GET['portfolio-view'] ) : $view;

        switch ( $view ) {
            case 'grid':
                $title = sprintf( esc_html__( 'Portfolio %s grid %s', 'front' ), '<span class="font-weight-semi-bold">', '</span>' );
            break;
            case 'masonry':
                $title = sprintf( esc_html__( 'Portfolio %s masonry %s', 'front' ), '<span class="font-weight-semi-bold">', '</span>' );
            break;
            case 'modern':
                $title = sprintf( esc_html__( 'Portfolio %s modern %s', 'front' ), '<span class="font-weight-semi-bold">', '</span>' );
            break;
        }

        return $title;
    }

    public static function blog_view_loader( $view ) {

        $custom_view = isset( $_GET['blog-view'] ) ? sanitize_text_field( $_GET['blog-view'] ) : $view;

        if ( front_demo_is_blog_view_category() ) {
            $term = get_queried_object();
            $custom_view = str_replace( 'blog-', '', $term->slug );
        }

        switch( $custom_view ) {
            case 'classic':
            case 'grid':
            case 'masonry':
            case 'modern':
            case 'list':
                $view = $custom_view;
            break;
            default: 
                $view = $view;
        }

        return $view;
    }

    public static function post_style_loader( $style ) {

        $custom_style = isset( $_GET['post-style'] ) ? sanitize_text_field( $_GET['post-style'] ) : $style;

        if ( has_category( 'simple' ) ) {
            $custom_style = 'simple';
        } elseif ( has_category( 'classic' ) ) {
            $custom_style = 'classic';
        }

        switch( $custom_style ) {
            case 'classic':
            case 'simple':
                $style = $custom_style;
            break;
            default:
                $style = $style;
        }

        return $style;
    }
   
    public static function blog_layout_loader( $layout ) {
 
        $query_var_blog_layout = get_query_var( 'blog-layout' );

        if ( isset( $_GET['blog-layout'] ) ) {
            $custom_layout = sanitize_text_field( $_GET['blog-layout'] );
        } elseif( ! empty( $query_var_blog_layout ) ) {
            $custom_layout = $query_var_blog_layout;
        } else {
            $custom_layout = $layout;
        }

        switch( $custom_layout ) {
            case 'sidebar-right':
            case 'sidebar-left':
            case 'full-width':
                $layout = $custom_layout;
            break;
            default: 
                $layout = $layout;
        }

        return $layout;
    }

    public static function wpjm_job_listing_style_loader( $style ) {
        $query_var_jobs_view = get_query_var( 'jobs-view' );

        if ( isset( $_GET['jobs-view'] ) ) {
            $custom_style = sanitize_text_field( $_GET['jobs-view'] );
        } elseif( ! empty( $query_var_jobs_view ) ) {
            $custom_style = $query_var_jobs_view;
        } else {
            $custom_style = $style;
        }

        switch( $custom_style ) {
            case 'grid':
            case 'list':
                $style = $custom_style;
            break;
            default: 
                $style = $style;
        }

        return $style;
    }

    public static function wpjm_job_listing_layout_loader( $layout ) {
        $query_var_jobs_layout = get_query_var( 'jobs-layout' );

        if ( isset( $_GET['jobs-layout'] ) ) {
            $custom_layout = sanitize_text_field( $_GET['jobs-layout'] );
        } elseif( ! empty( $query_var_jobs_layout ) ) {
            $custom_layout = $query_var_jobs_layout;
        } else {
            $custom_layout = $layout;
        }

        switch( $custom_layout ) {
            case 'fullwidth':
            case 'right-sidebar':
                $layout = $custom_layout;
            break;
            default: 
                $layout = $layout;
        }

        return $layout;
    }

    public static function wpjm_job_single_style_loader( $style ) {
        $query_var_job_view = get_query_var( 'job-view' );

        if ( isset( $_GET['job-view'] ) ) {
            $custom_style = sanitize_text_field( $_GET['job-view'] );
        } elseif( ! empty( $query_var_job_view ) ) {
            $custom_style = $query_var_job_view;
        } else {
            $custom_style = $style;
        }

        switch( $custom_style ) {
            case 'style-1':
            case 'style-2':
                $style = $custom_style;
            break;
            default: 
                $style = $style;
        }

        return $style;
    }

    public static function wpjmr_resume_listing_style_loader( $style ) {
        $query_var_resumes_view = get_query_var( 'resumes-view' );

        if ( isset( $_GET['resumes-view'] ) ) {
            $custom_style = sanitize_text_field( $_GET['resumes-view'] );
        } elseif( ! empty( $query_var_resumes_view ) ) {
            $custom_style = $query_var_resumes_view;
        } else {
            $custom_style = $style;
        }

        switch( $custom_style ) {
            case 'grid':
            case 'list':
                $style = $custom_style;
            break;
            default: 
                $style = $style;
        }

        return $style;
    }

    public static function wpjmr_resume_listing_layout_loader( $layout ) {
        $query_var_resumes_layout = get_query_var( 'resumes-layout' );

        if ( isset( $_GET['resumes-layout'] ) ) {
            $custom_layout = sanitize_text_field( $_GET['resumes-layout'] );
        } elseif( ! empty( $query_var_resumes_layout ) ) {
            $custom_layout = $query_var_resumes_layout;
        } else {
            $custom_layout = $layout;
        }

        switch( $custom_layout ) {
            case 'fullwidth':
            case 'right-sidebar':
                $layout = $custom_layout;
            break;
            default: 
                $layout = $layout;
        }

        return $layout;
    }

}

Front_Template_Loader::init();