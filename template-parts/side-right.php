<?php
/**
 * @package Connect
 */
?>
<div class="side-right" id="side-right">

        <?php
        if( is_active_sidebar( 'sidebar-1' ) ) {
            dynamic_sidebar( 'sidebar-1' );
        }
        ?>

</div>