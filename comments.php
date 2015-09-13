<?php
/**
 * The template for displaying comments.
 *
 * @package connect
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php // You can start editing here -- including this comment!  ?>

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            printf( // WPCS: XSS OK.
                    esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'connect' ) ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>'
            );
            ?>
        </h2>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'connect' ); ?></h2>
                <div class="nav-links">

                    <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'connect' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'connect' ) ); ?></div>

                </div><!-- .nav-links -->
            </nav><!-- #comment-nav-above -->
        <?php endif; // Check for comment navigation.  ?>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style' => 'ol',
                'short_ping' => true,
            ) );
            ?>
        </ol><!-- .comment-list -->

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'connect' ); ?></h2>
                <div class="nav-links">

                    <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'connect' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'connect' ) ); ?></div>

                </div><!-- .nav-links -->
            </nav><!-- #comment-nav-below -->
        <?php endif; // Check for comment navigation.  ?>

    <?php endif; // Check for have_comments().  ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( !comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
        ?>
    <?php endif; ?>

    <?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $fields = array(
        'author' =>
        '<p class="comment-form-author"> ' .
        '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter[ 'comment_author' ] ) .
        '" ' . $aria_req . ' placeholder="' . esc_attr_x( 'Name', 'placeholder', 'connect' ) . '" /></p>',
        'email' =>
        '<p class="comment-form-email"> ' .
        '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr( $commenter[ 'comment_author_email' ] ) .
        '" ' . $aria_req . ' placeholder="' . esc_attr_x( 'Email', 'placeholder', 'connect' ) . '" /></p>',
        'url' =>
        '<p class="comment-form-url">' .
        '<input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter[ 'comment_author_url' ] ) .
        '" placeholder="' . esc_attr_x( 'Website', 'placeholder', 'connect' ) . '" /></p>',
    );
    $args = array(
        'comment_field' => '<p class="comment-form-comment">' .
        '<textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . esc_attr_x( 'Comment', 'placeholder', 'connect' ) . '"></textarea></p>',
        'fields' => apply_filters( 'comment_form_default_fields', $fields ),
    );
    ?>

    <?php comment_form( $args ); ?>

</div><!-- #comments -->
