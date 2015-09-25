<?php
/**
 * Template: page-member-login.php
 * 
 * @package Connect
 */
get_header( 'login' );
?>
<div class="site-main login-page" id="site-main">

    <div class="container">

        <div class="row">

            <div class="col-md-4 col-sm-6 col-md-push-7 col-sm-push-6">
                <div class="login-page-right">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <div class="login-top hidden-sm hidden-md hidden-lg hidden-xl">
                            <?php
                            // display header logo 
                            $connect_header_logo = connect_get_option( 'connect_header_logo' );
                            if ( $connect_header_logo && $connect_header_logo[ 'id' ] ) {
                                $connect_header_logo_url = wp_get_attachment_image_src( $connect_header_logo[ 'id' ], 'medium' );
                                $connect_header_logo_url = $connect_header_logo_url[ 0 ];
                                echo '<div class="site-logo"><img src="' . $connect_header_logo_url . '" /></div>';
                            } else {

                                // display blogname and description
                                $disable_tagline = connect_get_option( 'connect_disable_tagline' );
                                ?>
                                <div class="site-title-container<?php echo ( $disable_tagline ) ? '' : ' has-description'; ?>">
                                    <div class="site-title"><?php echo bloginfo( 'name' ); ?></div>
                                    <?php echo ( $disable_tagline ) ? '' : '<div class="site-description">' . get_bloginfo( 'description' ) . '</div>'; ?>
                                </div>

                                <?php
                            }
                            ?>
                        </div>
                    </a>
                    <?php echo do_shortcode( '[custom-login-form]' ); ?>
                </div>
            </div>

            <div class="col-md-7 col-sm-6 col-md-pull-4 col-sm-pull-6">
                <div class="login-page-left">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <div class="login-top hidden-xs">
                            <?php
                            // display header logo 
                            $connect_header_logo = connect_get_option( 'connect_header_logo' );
                            if ( $connect_header_logo && $connect_header_logo[ 'id' ] ) {
                                $connect_header_logo_url = wp_get_attachment_image_src( $connect_header_logo[ 'id' ], 'medium' );
                                $connect_header_logo_url = $connect_header_logo_url[ 0 ];
                                echo '<div class="site-logo"><img src="' . $connect_header_logo_url . '" /></div>';
                            } else {

                                // display blogname and description
                                $disable_tagline = connect_get_option( 'connect_disable_tagline' );
                                ?>
                                <div class="site-title-container<?php echo ( $disable_tagline ) ? '' : ' has-description'; ?>">
                                    <div class="site-title"><?php echo bloginfo( 'name' ); ?></div>
                                    <?php echo ( $disable_tagline ) ? '' : '<div class="site-description">' . get_bloginfo( 'description' ) . '</div>'; ?>
                                </div>

                                <?php
                            }
                            ?>
                        </div>
                    </a>
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php
                        the_content();
                        ?>

                    <?php endwhile; // End of the loop.  ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_footer( 'login' ); ?>