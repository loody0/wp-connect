<?php
/**
 * @package Connect
 */
get_header();
?>

<div class="site-main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-md-9 col-xl-8 col-main">
                <div class="site-content">
                    <?php if ( have_posts() ) : ?>

                    <?php if ( is_home() ) { ?>
                        <div class="row">
                        <?php } ?>

                        <?php while ( have_posts() ): the_post(); ?>
                            <?php if ( is_home() ) { // is blog archive ?>

                                <div class="col-xl-3 col-md-4 col-sm-6">
                                    <?php get_template_part( 'template-parts/content', 'blog' ); ?>
                                </div>

                                <?php if ( ( $wp_query->current_post + 1 ) % 4 == 0 ) { ?>
                                    <div class="hidden-lg hidden-md hidden-sm hidden-xs clearfix"></div>
                                <?php } // clearfix every 4 posts (extra large screen)?>
                                <?php if ( ( $wp_query->current_post + 1 ) % 3 == 0 ) { ?>
                                    <div class="hidden-xl hidden-sm hidden-xs clearfix"></div>
                                <?php } // clearfix every 3 posts (large and medium screen)?>
                                <?php if ( ( $wp_query->current_post + 1 ) % 2 == 0 ) { ?>
                                    <div class="hidden-xl hidden-lg hidden-md hidden-xs clearfix"></div>
                                <?php } // clearfix every 2 posts (small screen)?>

                                <?php
                            } else {
                                get_template_part( 'template-parts/content', get_post_format() );
                            }
                            ?>

                        <?php endwhile; ?>

                        <?php if ( is_home() ) { ?>
                        </div> <!-- .row -->
                    <?php } ?>

                    <?php connect_post_navigation(); ?>

                <?php else : ?>

                    <?php get_template_part( 'template-parts/content', 'none' ); ?>

                <?php endif; ?>
                </div>
            </div>
            
            <div class="col-sm-4 col-md-3 col-xl-4 col-side">
                <?php get_sidebar(); ?>
            </div>
            
        </div>
    </div>
</div>

<?php get_footer(); ?>
