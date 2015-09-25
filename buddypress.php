<?php
/**
 * Template: buddypress.php
 * 
 * @package Connect
 */
get_header();
?>
<div class="site-main" id="site-main">

    <?php get_sidebar(); ?>

    <div class="site-content" id="site-content">
        <?php while ( have_posts() ) : the_post(); ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <div class="entry-content">
                    <?php the_content(); ?>

                </div><!-- .entry-content -->

            </div>
        <?php endwhile; // End of the loop. ?>

    </div>
</div>
<?php get_footer(); ?>