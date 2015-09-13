<?php
/**
 * Template part for displaying single posts.
 *
 * @package connect
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-blog' ); ?>>
    <?php
    $bg_image = '';
    if ( has_post_thumbnail() ) {
        $image_url = wp_get_attachment_url( get_post_thumbnail_id() );
        $bg_image = 'background-image: url("' . $image_url . '");';
    }
    ?>
    <div class="entry-header" style="<?php echo esc_attr( $bg_image ); ?>">
        <div class="entry-time">
            <i class="fa fa-3x fa-bookmark-o"></i> <?php the_time(); ?>
        </div>
        <div class="entry-title-cont">
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <div class="entry-author"><?php the_author(); ?></div>
        </div>
    </div>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>

</article><!-- #post-## -->

