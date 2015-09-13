<?php
/**
 * Template: page.php
 * 
 * @package Connect
 */
get_header();
?>
<div class="site-main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-md-9 col-xl-8">
                <div class="site-content">
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'template-parts/content', 'page' ); ?>

                        <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        ?>

                    <?php endwhile; // End of the loop. ?>
                </div>
            </div>
            <div class="col-sm-4 col-md-3 col-xl-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>