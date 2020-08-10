<?php
/**
 * Menu related functions
 *
 * @package Reen
 * @since 1.0.0
 */

/**
 * Define new Walker edit
 *
 * @access      public
 * @since       1.0.0
 * @return      void
*/
function reen_edit_walker( $walker, $menu_id ) {
    return 'Reen_Walker_Nav_Menu_Edit';
}

// edit menu walker
add_filter( 'wp_edit_nav_menu_walker', 'reen_edit_walker', 10, 2 );

/**
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Reen_Walker_Nav_Menu_Edit extends Walker_Nav_Menu {
    /**
     * Starts the list before the elements are added.
     *
     * @see Walker_Nav_Menu::start_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   Not used.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {}

    /**
     * Ends the list of after the elements are added.
     *
     * @see Walker_Nav_Menu::end_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   Not used.
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {}

    /**
     * Start the element output.
     *
     * @see Walker_Nav_Menu::start_el()
     * @since 3.0.0
     *
     * @global int $_wp_nav_menu_max_depth
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   Not used.
     * @param int    $id     Not used.
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $_wp_nav_menu_max_depth;
        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

        ob_start();
        $item_id      = esc_attr( $item->ID );
        $removed_args = array(
            'action',
            'customlink-tab',
            'edit-menu-item',
            'menu-item',
            'page-tab',
            '_wpnonce',
        );

        $original_title = false;
        if ( 'taxonomy' == $item->type ) {
            $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
            if ( is_wp_error( $original_title ) ) {
                $original_title = false;
            }
        } elseif ( 'post_type' == $item->type ) {
            $original_object = get_post( $item->object_id );
            $original_title  = get_the_title( $original_object->ID );
        } elseif ( 'post_type_archive' == $item->type ) {
            $original_object = get_post_type_object( $item->object );
            if ( $original_object ) {
                $original_title = $original_object->labels->archives;
            }
        }

        $classes = array(
            'menu-item menu-item-depth-' . $depth,
            'menu-item-' . esc_attr( $item->object ),
            'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive' ),
        );

        $title = $item->title;

        if ( ! empty( $item->_invalid ) ) {
            $classes[] = 'menu-item-invalid';
            /* translators: %s: title of menu item which is invalid */
            $title = sprintf( __( '%s (Invalid)', 'reen' ), $item->title );
        } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
            $classes[] = 'pending';
            /* translators: %s: title of menu item in draft status */
            $title = sprintf( __( '%s (Pending)', 'reen' ), $item->title );
        }

        $title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

        $submenu_text = '';
        if ( 0 == $depth ) {
            $submenu_text = 'style="display: none;"';
        }

        ?>
        <li id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo implode( ' ', $classes ); ?>">
            <div class="menu-item-bar">
                <div class="menu-item-handle">
                    <span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo esc_html( $submenu_text ); ?>><?php _e( 'sub item', 'reen' ); ?></span></span>
                    <span class="item-controls">
                        <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                        <span class="item-order hide-if-js">
                            <a href="
                            <?php
                                echo wp_nonce_url(
                                    add_query_arg(
                                        array(
                                            'action'    => 'move-up-menu-item',
                                            'menu-item' => $item_id,
                                        ),
                                        remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
                                    ),
                                    'move-menu_item'
                                );
                            ?>
                            " class="item-move-up" aria-label="<?php esc_attr_e( 'Move up', 'reen' ); ?>">&#8593;</a>
                            |
                            <a href="
                            <?php
                                echo wp_nonce_url(
                                    add_query_arg(
                                        array(
                                            'action'    => 'move-down-menu-item',
                                            'menu-item' => $item_id,
                                        ),
                                        remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
                                    ),
                                    'move-menu_item'
                                );
                            ?>
                            " class="item-move-down" aria-label="<?php esc_attr_e( 'Move down', 'reen' ); ?>">&#8595;</a>
                        </span>
                        <a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>" href="
                                                                    <?php
                                                                    echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                                                                    ?>
                        " aria-label="<?php esc_attr_e( 'Edit menu item', 'reen' ); ?>"><span class="screen-reader-text"><?php esc_html_e( 'Edit', 'reen' ); ?></span></a>
                    </span>
                </div>
            </div>

            <div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
                <?php if ( 'custom' == $item->type ) : ?>
                    <p class="field-url description description-wide">
                        <label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
                            <?php esc_html_e( 'URL', 'reen' ); ?><br />
                            <input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                        </label>
                    </p>
                <?php endif; ?>
                <p class="description description-wide">
                    <label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Navigation Label', 'reen' ); ?><br />
                        <input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                    </label>
                </p>
                <p class="field-title-attribute field-attr-title description description-wide">
                    <label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Title Attribute', 'reen' ); ?><br />
                        <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                    </label>
                </p>
                <p class="field-link-target description">
                    <label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
                        <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
                        <?php esc_html_e( 'Open link in a new tab', 'reen' ); ?>
                    </label>
                </p>
                <p class="field-css-classes description description-thin">
                    <label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'CSS Classes (optional)', 'reen' ); ?><br />
                        <input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode( ' ', $item->classes ) ); ?>" />
                    </label>
                </p>
                <p class="field-xfn description description-thin">
                    <label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Link Relationship (XFN)', 'reen' ); ?><br />
                        <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                    </label>
                </p>
                <p class="field-description description description-wide">
                    <label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Description', 'reen' ); ?><br />
                        <textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                        <span class="description"><?php _e( 'The description will be displayed in the menu if the current theme supports it.', 'reen' ); ?></span>
                    </label>
                </p>

                <?php
                    // Add this directly after the description paragraph in the start_el() method
                    do_action( 'reen_wp_nav_menu_item_custom_settings', $item_id, $item, $depth, $args );
                    // end added section
                ?>

                <fieldset class="field-move hide-if-no-js description description-wide">
                    <span class="field-move-visual-label" aria-hidden="true"><?php _e( 'Move', 'reen' ); ?></span>
                    <button type="button" class="button-link menus-move menus-move-up" data-dir="up"><?php _e( 'Up one', 'reen' ); ?></button>
                    <button type="button" class="button-link menus-move menus-move-down" data-dir="down"><?php _e( 'Down one', 'reen' ); ?></button>
                    <button type="button" class="button-link menus-move menus-move-left" data-dir="left"></button>
                    <button type="button" class="button-link menus-move menus-move-right" data-dir="right"></button>
                    <button type="button" class="button-link menus-move menus-move-top" data-dir="top"><?php _e( 'To the top', 'reen' ); ?></button>
                </fieldset>

                <div class="menu-item-actions description-wide submitbox">
                    <?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
                        <p class="link-to-original">
                            <?php
                            /* translators: %s: original title */
                            printf( __( 'Original: %s', 'reen' ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' );
                            ?>
                        </p>
                    <?php endif; ?>
                    <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="
                                                                                        <?php
                                                                                        echo wp_nonce_url(
                                                                                            add_query_arg(
                                                                                                array(
                                                                                                    'action'    => 'delete-menu-item',
                                                                                                    'menu-item' => $item_id,
                                                                                                ),
                                                                                                admin_url( 'nav-menus.php' )
                                                                                            ),
                                                                                            'delete-menu_item_' . $item_id
                                                                                        );
                                                                                        ?>
                    "><?php esc_html_e( 'Remove', 'reen' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="
                    <?php
                    echo esc_url(
                        add_query_arg(
                            array(
                                'edit-menu-item' => $item_id,
                                'cancel'         => time(),
                            ),
                            admin_url( 'nav-menus.php' )
                        )
                    );
                    ?>
                        #menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php esc_html_e( 'Cancel', 'reen' ); ?></a>
                </div>

                <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
                <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
                <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
                <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
                <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
                <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
            </div><!-- .menu-item-settings-->
            <ul class="menu-item-transport"></ul>
        <?php
        $output .= ob_get_clean();
    }

} // reen_Walker_Nav_Menu_Edit

if ( ! function_exists( 'reen_wp_nav_menu_item_custom_fields' ) ) {
    function reen_wp_nav_menu_item_custom_fields( $item_id, $item, $depth, $args ) {
        ?>
        <p class="field-custom description description-thin">
            <label for="edit-menu-item-icon-<?php echo esc_attr( $item_id ); ?>">
                <?php esc_html_e( 'Icon Class', 'reen' ); ?><br />
                <input type="text" id="edit-menu-item-icon-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-custom" name="menu-item-icon[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->icon ); ?>" />
            </label>
        </p>
        <?php if( $depth === 0 ) : ?>
            <p class="field-custom description">
                <label for="edit-menu-item-has-megamenu-<?php echo esc_attr( $item_id ); ?>">
                    <input type="checkbox" id="edit-menu-item-has-megamenu-<?php echo esc_attr( $item_id ); ?>" value="yes" name="menu-item-has-megamenu[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->has_megamenu, 'yes' ); ?> />
                    <?php esc_html_e( 'Has Megamenu ?', 'reen' ); ?>
                </label>
            </p>
        <?php endif;
    }
}

// add custom menu fields to menu
add_action( 'reen_wp_nav_menu_item_custom_settings', 'reen_wp_nav_menu_item_custom_fields', 10, 4 );

/**
 * Save menu custom fields
 *
 * @access      public
 * @since       1.0.0
 * @return      void
 */
if ( ! function_exists( 'reen_update_custom_nav_fields' ) ) {
    function reen_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

        // Check if element is properly sent
        if ( isset( $_POST['menu-item-icon'] ) && is_array( $_POST['menu-item-icon'] ) && isset( $_POST['menu-item-icon'][$menu_item_db_id] ) ) {
            $icon = $_POST['menu-item-icon'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_icon', $icon );
        }

        if ( isset( $_POST['menu-item-has-megamenu'] ) && is_array( $_POST['menu-item-has-megamenu'] ) && isset( $_POST['menu-item-has-megamenu'][$menu_item_db_id] ) ) {
            $has_megamenu = $_POST['menu-item-has-megamenu'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_has_megamenu', $has_megamenu );
        } else {
            update_post_meta( $menu_item_db_id, '_menu_item_has_megamenu', false );
        }
    }
}

// save menu custom fields
add_action( 'wp_update_nav_menu_item', 'reen_update_custom_nav_fields', 10, 3 );

if ( ! function_exists( 'reen_add_custom_nav_fields' ) ) {
    function reen_add_custom_nav_fields( $menu_item ) {

        $menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
        $menu_item->has_megamenu = get_post_meta( $menu_item->ID, '_menu_item_has_megamenu', true );

        return $menu_item;
    }
}

// add custom menu fields to menu
add_filter( 'wp_setup_nav_menu_item', 'reen_add_custom_nav_fields' );

if ( ! function_exists( 'reen_nav_menu_icon' ) ) {
    function reen_nav_menu_icon( $title, $item, $args, $depth ) {

        if( ! empty( $item->icon ) ) {
            $icon  = '<i class="' . esc_attr( $item->icon ) . '"></i>';
            $title = $icon .'<span class="menu-text">' . $title . '</span>';
        }

        if( ! empty( $item->target ) ) {
            $title .= '<small class="fa fa-external-link-alt ml-2"></small>';
        }

        return $title;
    }
}

// display menu custom fields
add_filter( 'nav_menu_item_title', 'reen_nav_menu_icon', 10, 4 );