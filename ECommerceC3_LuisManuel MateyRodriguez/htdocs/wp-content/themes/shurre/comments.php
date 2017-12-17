<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package materialized
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
 return;
}

// Edit the default comment structure

$commentargs = array(
  'id_form'           => 'commentform',
  'id_submit'         => 'submit',
  'class_submit'      => 'submit',
  'name_submit'       => 'submit',
  'title_reply'       => __( 'Comment on this:' ),
  'title_reply_to'    => __( 'Reply to %s' ),
  'cancel_reply_link' => __( 'Cancel Reply' ),
  'label_submit'      => __( 'Post Comment' ),
  'format'            => 'xhtml',
  'fields' =>
   apply_filters( 'comment_form_default_fields', array(
   'author' => '<div class="input-field col s12">' . '<i class="mdi-action-account-circle prefix"></i><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" /><label for="author">' . __( 'Name' ) . '</label></div>',
 'email'  => '<div class="input-field col s12">' . '<i class="mdi-communication-email prefix"></i><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" /><label for="email">' . __( 'Email' ) . '</label>'.'</div>',
 'url' => ''
 )),
  'comment_field' =>  '<div class="input-field col s12"><i class="mdi-editor-mode-edit prefix"></i><textarea id="comment" name="comment" class="materialize-textarea">' . '</textarea><label for="comment">' . _x( 'Comment', 'noun' ) . '</label></div>',
  'must_log_in' => '<p class="must-log-in">' .
    sprintf(
      __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
    ) . '</p>',

  'logged_in_as' => '<p class="logged-in-as">' .
    sprintf(
    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
      admin_url( 'profile.php' ),
      $user_identity,
      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
    ) . '</p>',
  'comment_notes_after' => '<div class="clear"></div><div class="card-panel green"><span class="white-text">' .
    sprintf(
      __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ),
      ' <code>' . allowed_tags() . '</code>'
    ) . '</span></div>
    <p><button type="submit" id="submit-new" class="btn waves-effect waves-light right"><span class="white-text">'.__('Post Comment').'<i class="mdi-content-send right"></i></span></button><div class="clear"></div></p>'

);

if (is_user_logged_in()) {
 $commtarget = '#comment';
} else {
 $commtarget = '#author';
}


$replyargs = array(
 'walker'            => null,
 'max_depth'         => '',
 'style'             => 'ol',
 'callback'          => 'materialized_comment',
 'end-callback'      => null,
 'type'              => 'all',
 'reply_text'        => 'Reply',
 'page'              => '',
 'per_page'          => '',
 'avatar_size'       => 90,
 'reverse_top_level' => null,
 'reverse_children'  => '',
 'format'            => 'html5', //or xhtml if no HTML5 theme support
 'short_ping'        => false,
  'echo'     => true // boolean, default is true
);

?>
<div class="card">
<div id="comments" class="comments-area">
 <?php if ( have_comments() ) : ?>
 <span class="card-title">
 <h2 class="comments-title">
 <a class="btn-floating btn-large waves-effect waves-light green right" href="<?php echo $commtarget; ?>"><i class="large mdi-editor-mode-edit"></i></a>
 <?php
 printf( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'materialized' ),
 number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
 ?>
 </h2>
 </span>
 <div class="card-content">
 <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
 <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
 <h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'materialized' ); ?></h2>
 <div class="nav-links">

 <div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'materialized' ) ); ?></div>
 <div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'materialized' ) ); ?></div>

 </div><!-- .nav-links -->
 </nav><!-- #comment-nav-above -->
 <?php endif; // check for comment navigation ?>

 <ol class="comment-list">
 <?php
 wp_list_comments($replyargs);
 ?>
 </ol><!-- .comment-list -->

 <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
 <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
 <h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'materialized' ); ?></h2>
 <div class="nav-links">

 <div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'materialized' ) ); ?></div>
 <div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'materialized' ) ); ?></div>

 </div><!-- .nav-links -->
 </nav><!-- #comment-nav-below -->
 <?php endif; // check for comment navigation ?>

 <?php endif; // have_comments() ?>

 <?php
 // If comments are closed and there are comments, let's leave a little note, shall we?
 if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
 ?>
 <p class="no-comments"><?php _e( 'Comments are closed.', 'materialized' ); ?></p>
 <?php endif; ?>
 </div>
 <?php comment_form($commentargs); ?>

</div><!-- #comments -->
