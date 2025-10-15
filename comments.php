<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
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

    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) :
        ?>
        <!-- Comments List Section -->
        <div class="comments-section">
            <!-- Header with Comments Count -->
            <div class="post-list-header">
                <div class="header-content">
                    <div class="header-text">
                        <h3 class="post-list-title fw-bold pe-5 pe-lg-4">
                            <?php
                            $asrepoya_comment_count = get_comments_number();
                            if ( '1' === $asrepoya_comment_count ) {
                                printf(
                                    /* translators: 1: title. */
                                    esc_html__( 'یک دیدگاه برای &ldquo;%1$s&rdquo;', 'asrepoya' ),
                                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                                );
                            } else {
                                printf(
                                    /* translators: 1: comment count number, 2: title. */
                                    esc_html( _nx( '%1$s دیدگاه برای &ldquo;%2$s&rdquo;', '%1$s دیدگاه برای &ldquo;%2$s&rdquo;', $asrepoya_comment_count, 'comments title', 'asrepoya' ) ),
                                    number_format_i18n( $asrepoya_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                                );
                            }
                            ?>
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Comments List -->
            <div class="comments-list">
                <?php
                wp_list_comments(
                    array(
                        'style'      => 'div',
                        'short_ping' => true,
                        'callback'   => 'asrepoya_comment_callback',
                    )
                );
                ?>
            </div>

            <?php
            the_comments_navigation();

            // If comments are closed and there are comments, let's leave a little note, shall we?
            if ( ! comments_open() ) :
                ?>
                <p class="no-comments"><?php esc_html_e( 'امکان ارسال دیدگاه وجود ندارد.', 'asrepoya' ); ?></p>
                <?php
            endif;

        endif; // Check for have_comments().
        ?>

    <?php
    // Comment form
    if ( comments_open() || get_comments_number() ) :
        ?>
        <!-- Comment Form Section -->
        <div class="comment-form-section">
            <!-- Header -->
            <div class="post-list-header">
                <div class="header-content">
                    <div class="header-text">
                        <h3 class="post-list-title fw-bold pe-5 pe-lg-4">ارسال دیدگاه</h3>
                    </div>
                </div>
            </div>

            <!-- Custom Comment Form -->
            <div class="custom-comment-form">
                <?php
                $asrepoya_commenter = wp_get_current_commenter();
                $asrepoya_req = get_option( 'require_name_email' );
                $asrepoya_aria_req = ( $asrepoya_req ? " aria-required='true'" : '' );
                $asrepoya_html_req = ( $asrepoya_req ? " required='required'" : '' );

                $asrepoya_fields = array(
                    'author' => '<div class="form-group">
                                    <input id="author" name="author" type="text" value="' . esc_attr( $asrepoya_commenter['comment_author'] ) . '" size="30" maxlength="245"' . $asrepoya_aria_req . $asrepoya_html_req . ' class="form-control" placeholder="' . __( 'نام', 'asrepoya' ) . ( $asrepoya_req ? ' *' : '' ) . '" />
                                </div>',
                    'email'  => '<div class="form-group">
                                    <input id="email" name="email" type="email" value="' . esc_attr( $asrepoya_commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $asrepoya_aria_req . $asrepoya_html_req . ' class="form-control" placeholder="' . __( 'ایمیل', 'asrepoya' ) . ( $asrepoya_req ? ' *' : '' ) . '" />
                                </div>
                                <div class="form-group submit-group">
                                    <input name="submit" type="submit" id="submit" class="btn btn-secondary submit-comment" value="' . esc_attr__( 'ارسال دیدگاه', 'asrepoya' ) . '" />
                                </div>',
                );

                $asrepoya_comments_args = array(
                    'fields'               => $asrepoya_fields,
                    'class_form'           => 'comment-form-custom',
                    'comment_field'        => '<div class="form-group comment-textarea-group">
                                                <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" class="form-control" placeholder="' . _x( 'شرح دیدگاه', 'noun', 'asrepoya' ) . ' *"></textarea>
                                              </div>',
                    'submit_button'        => '',
                    'comment_notes_before' => '',
                    'comment_notes_after'  => '',
                    'title_reply'          => '',
                    'title_reply_to'       => __( 'پاسخ به %s', 'asrepoya' ),
                    'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
                    'title_reply_after'    => '</h3>',
                );

                comment_form( $asrepoya_comments_args );
                ?>
            </div>
        </div>
        <?php
    endif;
    ?>

</div><!-- #comments -->

<?php
/**
 * Custom comment callback function
 */
function asrepoya_comment_callback( $comment, $args, $depth ) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>">
        <?php if ( 'div' != $args['style'] ) : ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
        <?php endif; ?>
        
        <div class="comment-item">
            <div class="comment-avatar">
                <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 60 ); ?>
            </div>
            
            <div class="comment-content">
                <div class="comment-meta">
                    <div class="comment-author">
                        <?php printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ); ?>
                    </div>
                    <div class="comment-date">
                        <i class="fas fa-clock"></i>
                        <?php
                        printf(
                            __( '%1$s در %2$s' ),
                            get_comment_date('j F Y'),
                            get_comment_time('H:i')
                        );
                        ?>
                    </div>
                    <div class="reply-link">
                        <?php 
                        if ( $comment->comment_approved == '0' ) : ?>
                            <em class="comment-awaiting-moderation"><?php _e( 'دیدگاه شما در انتظار تأیید است.', 'asrepoya' ); ?></em>
                        <?php else:
                            comment_reply_link( array_merge( $args, array( 
                                'add_below' => $add_below, 
                                'depth' => $depth, 
                                'max_depth' => $args['max_depth'],
                                'before' => '<span data-commentid="' . get_comment_ID() . '" data-postid="' . get_the_ID() . '" data-belowelement="' . $add_below . '">',
                                'after' => '</span>'
                            ) ) ); 
                        endif; ?>
                    </div>
                </div>
                
                <div class="comment-text">
                    <?php comment_text(); ?>
                </div>
            </div>
        </div>
        
        <!-- Inline Reply Form Container -->
        <div id="reply-form-<?php comment_ID(); ?>" class="inline-reply-form" style="display: none;">
            <!-- Reply form will be moved here by JavaScript -->
        </div>
        
        <?php if ( 'div' != $args['style'] ) : ?>
            </div>
        <?php endif; ?>
    <?php
}
?>