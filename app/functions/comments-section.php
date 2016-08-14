<?php 
function mytheme_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
      <div class="comment-author-avatar">
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
      </div>
      <div class="comment-info">
        <?php printf( __( '<div class="fn"><div class="comment-author-link">%s</div>' ), get_comment_author_link() ); ?>
        <div class="comment-meta commentmetadata">
            <span>
            <?php
            /* translators: 1: date, 2: time */
            printf( __('<i class="fa fa-clock-o" aria-hidden="true"></i> %1$s'), timeAgo(time(),get_comment_time("U")));
            ?>
            </span>
            <?php if ( $comment->comment_approved == '0' ) : ?>
                 <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
                  <br />
            <?php endif; ?>
            <?php edit_comment_link( __( '(Edit)' ), '  ', '' );
            ?>
        </div>
        <?php echo '</div>';//end fn ?>
      </div>
      <div class="reply">
          <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div>
    </div>

    <div class="comment-text">
      <?php comment_text(); ?>
    </div>

    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php
}
 ?>