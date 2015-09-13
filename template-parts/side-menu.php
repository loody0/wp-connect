<?php 
/**
 * @package Connect
 */
?>

<div class="side-menu-wrap" id="side-menu-wrap">
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

