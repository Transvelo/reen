<?php
/**
 * Filter functions for Styling Section of Theme Options
 */

if ( ! function_exists( 'redux_toggle_use_predefined_colors' ) ) {
	function redux_toggle_use_predefined_colors( $enable ) {
		global $reen_options;

		if ( isset( $reen_options['use_predefined_color'] ) && $reen_options['use_predefined_color'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if( ! function_exists( 'redux_apply_primary_color' ) ) {
	function redux_apply_primary_color( $color ) {
		global $reen_options;

		if ( isset( $reen_options['main_color'] ) ) {
			$color = $reen_options['main_color'];
		}

		return $color;
	}
}

if ( ! function_exists( 'sass_darken' ) ) {
	function sass_darken( $hex, $percent ) {
		preg_match( '/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors );
		str_replace( '%', '', $percent );
		$percent = (int) $percent;
		$color = "#";
		for( $i = 1; $i <= 3; $i++ ) {
			$primary_colors[$i] = hexdec( $primary_colors[$i] );
			if ( $percent > 50 ) $percent = 50;
			$dv = 100 - ( $percent * 2 );
			$primary_colors[$i] = round( $primary_colors[$i] * ( $dv ) / 100 );
			$color .= str_pad( dechex( $primary_colors[$i] ), 2, '0', STR_PAD_LEFT );
		}
		return $color;
	}
}

if ( ! function_exists( 'redux_apply_custom_color_css' ) ) {
	function redux_apply_custom_color_css() {
		global $reen_options;

		if ( isset( $reen_options['use_predefined_color'] ) && $reen_options['use_predefined_color'] ) {
			return;
		}

		$how_to_include = isset( $reen_options['include_custom_color'] ) ? $reen_options['include_custom_color'] : '1';

		if ( $how_to_include != '1' ) {
			return;
		}

		?><style type="text/css"><?php echo redux_get_custom_color_css(); ?></style><?php
	}
}

if ( ! function_exists( 'redux_get_custom_color_css' ) ) {
	function redux_get_custom_color_css() {
		global $reen_options;

		$primary_color      = isset( $reen_options['custom_primary_color'] ) ? $reen_options['custom_primary_color'] : '#0787ea';
		$primary_text_color = isset( $reen_options['custom_primary_text_color'] ) ? $reen_options['custom_primary_text_color'] : '#fff';
		$color_body         = '#333e48';

		$active_background  = sass_darken( $primary_color, '100%' );
		$active_border      = sass_darken( $primary_color, '100%' );

		$styles 	        = '
		 a:hover,
		 a:focus,
		.bordered .info h3 a:hover,
		.bordered .info h4 a:hover,
		.icon i.icn,
		.meta a:hover,
		.meta li.categories:hover:before,
		.more:hover,
		.navbar.basic .nav > li > a:hover,
		.navbar.basic .nav > li > a:focus,
		.navbar.basic .nav .open > a,
		.navbar.basic .nav .open > a:hover,
		.navbar.basic .nav .open > a:focus,
		.navbar .dropdown-menu:not(.yamm-dropdown-menu) li a:hover,
		.navbar .dropdown-menu:not(.yamm-dropdown-menu) li a.active,
		.navbar-header .info a:hover,
		.nav > li > a:hover,
		.nav > li > a:focus,
		.owl-carousel:hover .owl-next:hover,
		.owl-carousel:hover .owl-prev:hover,
		.panel-title > a:hover,
		#scrollUp:hover,
		.sidemeta .format-wrapper a,
		.tabs-side .tab.active a,
		.tabs-top .tab.active a,
		.text-center .panel-title > a:hover span:after,
		ul.arrowed li:before,
		ul.circled li:before,
		.yamm .yamm-content a:hover,
		ul.circled li:before, .sidebox .widget__title + ul li:before, 
		.sidebox .menu li:before,
		.popular-posts-carousel.owl-carousel:hover .owl-prev:hover, 
		.popular-posts-carousel.owl-carousel:hover .owl-next:hover, 
		.related-post-carousel.owl-carousel:hover .owl-prev:hover, 
		.related-post-carousel.owl-carousel:hover .owl-next:hover,
		nav > li.active > a {
			color: ' . $primary_color . ';
		}

		.tint-bg .btn,
		.tint-color {
			color: ' . $primary_color . ' !important;
		}

		.header-logo svg ellipse,
		.footer-logo svg ellipse{
			fill:' . $primary_color . ';
		}

		.btn,
		.classic-blog .post .date,
		.navbar .dropdown-menu:not(.yamm-dropdown-menu) > .active > a,
		.navbar .dropdown-menu:not(.yamm-dropdown-menu) > .active > a:focus,
		.navbar .dropdown-menu:not(.yamm-dropdown-menu) > .active > a:hover,
		.navbar .dropdown-menu:not(.yamm-dropdown-menu) > li > a:focus,
		.navbar .dropdown-menu:not(.yamm-dropdown-menu) > li > a:hover,
		.navbar .dropdown-submenu:focus > a,
		.navbar .dropdown-submenu:hover > a,
		.owl-pagination .owl-page.active span,
		.owl-pagination .owl-page:hover span,
		#owl-main .caption h1 span.tint-bg,
		#owl-main .caption p span.tint-bg,
		.pagination > li > a,
		.pagination > li > span,
		.post.format-quote,
		.sidemeta .format-wrapper a:hover,
		.sidenav li a:hover,
		.tabs-circle-top .tab.active a,
		.tabs-side .tab a:hover,
		.tabs-top .tab a:hover,
		.tint-bg,
		.tint-bg.img-bg-soft:before,
		.tint-bg.img-bg-softer:before,
		.tooltip-inner,
		ul.page-numbers > li > a.current, ul.page-numbers > li > span.current,
		ul.page-numbers > li > a.current:hover, ul.page-numbers > li > span.current:hover, 
		ul.page-numbers > li > a:hover, ul.page-numbers > li > a:focus, 
		.post-page-numbers.current .page-link, .page-link:hover, 
		ul.page-numbers > li > a:hover, ul.page-numbers > li > span:hover,
		ul.page-numbers > li > a, ul.page-numbers > li > span, 
		.page-links-inner .page-link,
		.owl-dots .owl-dot.active span, 
		.owl-dots .owl-dot:hover span,
		.wp-block-button:not(.is-style-outline) .wp-block-button__link  {
			background-color: ' . $primary_color . ';
		}

		ul.page-numbers > li > a.current,
		ul.page-numbers > li > span.current,
		ul.page-numbers > li > a.current:hover,
		ul.page-numbers > li > span.current:hover,
		ul.page-numbers > li > a:hover,
		ul.page-numbers > li > a:focus,
		.post-page-numbers.current .page-link,
		.page-link:hover,
		 ul.page-numbers > li > a:hover, 
		 ul.page-numbers > li > span:hover,
		.btn:hover,
		.btn:focus,
		.btn:active,
		.btn.active,
		.pagination > .active > a,
		.pagination > .active > span,
		.pagination > .active > a:hover,
		.pagination > .active > span:hover,
		.pagination > li > a:hover,
		.pagination > li > a:focus,
		.wp-block-button .wp-block-button__link:hover,
		.wp-block-button .wp-block-button__link:focus,
		.wp-block-button .wp-block-button__link:active {
			background-color: ' . sass_darken( $primary_color, '5%' ) . ';
		}

		.icon-overlay a .icn-more,
		.items li .text-overlay,
		.owl-carousel .item .text-overlay,
		.thumbs .thumb .text-overlay {
			background-color:' . $primary_color . 'e6;
		}

		.classic-blog .post .date,
		.icon.circle,
		.sidemeta .format-wrapper a,
		.tabs-circle-top .tab.active a,
		.tabs-circle-top .tab a:hover,
		.tabs-side .tab a:hover,
		.tabs-top .tab a:hover,
		.wp-block-button.is-style-outline .wp-block-button__link {
			border-color: ' . $primary_color . ';
		}

		.bs-tooltip-auto[x-placement^=bottom] .arrow::before,
		.bs-tooltip-bottom .arrow::before {
		     border-bottom-color: ' . $primary_color . ';
		}

		.bs-tooltip-auto[x-placement^=top] .arrow::before,
		.bs-tooltip-top .arrow::before {
		     border-top-color: ' . $primary_color . ';
		}
		.bs-tooltip-auto[x-placement^=left] .arrow::before,
        .bs-tooltip-left .arrow::before {
		     border-left-color: ' . $primary_color . ';
		}
		.bs-tooltip-auto[x-placement^=right] .arrow::before,
		.bs-tooltip-right .arrow::before{
		     border-right-color: ' . $primary_color . ';
		}';

		return $styles;
	}
}

function redux_load_external_custom_css() {
	global $reen_options;

	if ( isset( $reen_options['use_predefined_color'] ) && $reen_options['use_predefined_color'] ) {
		return;
	}

	$how_to_include = isset( $reen_options['include_custom_color'] ) ? $reen_options['include_custom_color'] : '1';

	if ( $how_to_include == '1' ) {
		return;
	}

	$custom_color_file = get_stylesheet_directory() . '/custom-color.css';

	if ( file_exists( $custom_color_file ) ) {
		wp_enqueue_style( 'reen-custom-color', get_stylesheet_directory_uri() . '/custom-color.css' );
	}
}

function redux_toggle_custom_css_page() {
	global $reen_options;

	if ( isset( $reen_options['use_predefined_color'] ) && $reen_options['use_predefined_color'] ) {
		$should_add = false;
	} else {
		if ( !isset( $reen_options['include_custom_color'] ) ) {
			$reen_options['include_custom_color'] = '1';
		}

		if ( $reen_options['include_custom_color'] == '2' ) {
			$should_add = true;
		} else {
			$should_add = false;
		}
	}

	return $should_add;
}


