<?php
/**
 * Template part for displaying blog archive.
 *
 * @package connect
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="panel panel-default blog-panel">

        <div class="blog-top">
            <?php the_post_thumbnail( 'medium' ); ?>
            <h2 class="blog-title">
                <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h2>
        </div>

        <div class="panel-body">
            <div class="entry-content blog-content">
                <?php the_excerpt(); ?>
            </div>
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-primary connect-btn connect-btn-primary"><?php _e( 'Read More', 'connect' ); ?></a>
            <hr/>
            <div class="blog-footer clearfix">
                <div class="blog-time pull-left"><i class="fa fa-bookmark-o"></i> &nbsp;<?php the_time(); ?></div>
                <div class="blog-author pull-right"><i class="fa fa-user"></i> &nbsp;<?php the_author(); ?></div>
            </div>
        </div>

    </div>

</article><!-- #post-## -->
