<?php
/**
 * @package Connect
 */
?>
<div class="side-left " id="side-left">

    <div class="side-left-search">
        <form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
            <div class="input-group">
                <input type="text" class="form-control connect-input" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'connect' ) ?>" value="<?php echo get_search_query() ?>" name="s" >
                <span class="input-group-btn">
                    <button class="btn btn-default connect-btn connect-btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </form>
    </div>

    <?php
    if( is_user_logged_in() ) {
        echo '<ul class="nav navbar-nav side-left-user">';
        connect_user_nav();
        echo '</ul>';
    }
    ?>


    <?php
    wp_nav_menu( array(
        'menu' => 'primary',
        'theme_location' => 'primary',
        'depth' => 1,
        'menu_class' => 'side-menu',
        'container' => false
        )
    );
    ?>


</div>