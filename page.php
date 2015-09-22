<?php
/**
 * Template: page.php
 * 
 * @package Connect
 */
get_header();
?>
<div class="site-main" id="site-main">

    <?php get_sidebar(); ?>

    <div class="site-content" id="site-content">
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
<?php get_footer(); ?>