<?php
/**
 * The search form for our theme
 *
 * @package REEN
 */
?><form class="search form navbar-form navbar-form--search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="sr-only"><?php echo esc_html__( 'Search for:', 'reen' ); ?></label>
    <input type="search" class="form-control search-field" placeholder="<?php echo esc_attr__( 'Type to search', 'reen' ); ?>" value="<?php echo get_search_query(); ?>" name="s" >
    <input type="hidden" class="form-control" name="post_type" value="post">
    <button type="submit" class="btn btn-submit icon-right-open"></button>
</form>