<?php
/**
 * @package Connect
 */
?>
<div class="side-left" id="side-left">

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