<?php
/**
 * Functions - general functions 
 * 
 * @package Connect
 */

/**
 * custom excerpt
 */
function connect_excerpt_length( $length ) {
    return 30;
}

add_filter( 'excerpt_length', 'connect_excerpt_length', 999 );

function connect_excerpt_more( $more ) {
    return '...';
}

add_filter( 'excerpt_more', 'connect_excerpt_more' );

/**
 * show post navigation
 */
function connect_post_navigation() {
    $paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;
    $posts_per_page = get_query_var( 'posts_per_page' );
    $total_post_count = wp_count_posts();
    $published_post_count = $total_post_count->publish;
    $total_pages = ceil( $published_post_count / $posts_per_page );
    if ( !is_singular() ) {
        ?>
        <div class="connect-paging">
            <label class="control-label">Page <?php echo $paged; ?> of <?php echo $total_pages; ?></label>
            <div class="btn-group" role="group">
                <?php previous_posts_link( '<span class="glyphicon glyphicon-menu-left"></span>' ); ?>
                <?php next_posts_link( '<span class="glyphicon glyphicon-menu-right"></span>' ); ?>
            </div>
        </div>
        <?php
    }
}

/**
 * add class to posts navigation link
 */
function connect_posts_navigation_link_attributes() {
    return 'class="btn btn-default connect-btn connect-btn-default"';
}

add_filter( 'next_posts_link_attributes', 'connect_posts_navigation_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'connect_posts_navigation_link_attributes' );

/**
 * get connect option. 
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * 
 * @param string $name option ID
 */
function connect_get_option( $name, $default = false ) {
    global $connect_opt;
    $options = $connect_opt;
    if ( isset( $options[ $name ] ) ) {
        return $options[ $name ];
    }
    return $default;
}
