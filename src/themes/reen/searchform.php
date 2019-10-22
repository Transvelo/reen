<?php
/**
 * The search form for our theme
 *
 * @package REEN
 */
?><form id="search" class="search form navbar-form navbar-form--search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="sr-only"><?php echo esc_html__( 'Search for:', 'reen' ); ?></label>
    <input type="search" class="form-control search-field" placeholder="<?php echo esc_attr_x( 'Type to search', 'reen' ); ?>" autocomplete="off" value="<?php echo get_search_query(); ?>" name="s" >
    <button type="submit" class="btn btn-submit icon-right-open"></button>
</form>