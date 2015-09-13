<?php
/**
 * Template: sidebar.php
 * 
 * @package Connect
 */
?>

<div class="site-sidebar" role="complementary">
    <div class="sidebar-2">
        <?php 
        if ( is_active_sidebar( 'sidebar-1' ) ) {
            dynamic_sidebar( 'sidebar-1' ); 
        }
        ?>
    </div>
</div>
