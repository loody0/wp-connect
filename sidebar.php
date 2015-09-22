<?php
/**
 * Template: sidebar.php
 * 
 * @package Connect
 */
?>

<div class="site-sidebar" role="complementary">
    <?php
    if ( is_active_sidebar( 'sidebar-1' ) ) {
        dynamic_sidebar( 'sidebar-1' );
    }
    ?>
</div>
