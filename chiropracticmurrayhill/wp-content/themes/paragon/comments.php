<?php
function theme_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
     <?php $comment_time_format = theme_option( THEME_OPTIONS, 'comment_time_format' ); ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-wrap">
			<div class="gravatar"><?php echo get_avatar( $comment, $size='70', $default='' ); ?></div>
			<div class="comment-content">

				<div class="comment-meta">
					<?php printf( '<span class="comment-author">%s</span>', get_comment_author_link() ) ?>
					
                    <?php edit_comment_link( '', '', '' ) ?>
                    <time class="comment-time"><?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago';  ?></time>
				</div>
				<div class="comment-data">
					<?php comment_text() ?>

<?php if ( $comment->comment_approved == '0' ) : ?>
					<span class="unapproved"><?php _e( 'Your comment is awaiting moderation.', 'theme_frontend' );?></span>
<?php endif; ?>
				</div>
				<div class="clearboth"></div>
			</div>

		</div>
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
		</div>		
<?php
}

function list_pings( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-wrap comments-pings">

			<div class="comment-content">

				<div class="comment-meta">

					<?php printf( '<span class="comment_author"><b>%s</b></span>', get_comment_author_link() ) ?>

				</div>
				<div class="comment-data">
					<?php comment_text() ?>

								<time class="comment-time"><?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago'; ?></time>
<?php if ( $comment->comment_approved == '0' ) : ?>
					<span class="unapproved">Your comment is awaiting moderation.</span>
<?php endif; ?>
				</div>
                <div class="clearboth"></div>
	</div>





<?php } ?>

<section id="comments">
<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'theme_frontend' );?></p>
</section><!-- #comments -->
<?php
return;
endif;

if ( have_comments() ) : ?>
	<div class="mk-fancy-post-heading">
								<span class="fancy-heading-text"><?php _e( 'Comments', 'theme_frontend' ); ?></span>
								<div class="fancy-post-heading-divider"></div>
	</div>
	<ul class="mk-commentlist">
		<?php
wp_list_comments( 'callback=theme_comments&type=comment' );
?>
	</ul>





<?php
if ( have_comments() ) : ?>
<?php if ( ! empty( $comments_by_type['pings'] ) ) : ?>
<div class="mk-fancy-post-heading">
	<span class="fancy-heading-text"><?php _e( 'pingbacks / trackbacks', 'theme_frontend' ); ?></span>
	<div class="fancy-post-heading-divider"></div>
</div>

<ul class="mk-commentlist">
<?php wp_list_comments( 'callback=list_pings&type=pings' ); ?>
</ul>
<?php endif; endif; ?>

<?php else :
	if ( ! comments_open() ) :
		endif;
	endif;
?>

 <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav class="comments-navigation">
		<div class="comments-previous"><?php previous_comments_link(); ?></div>
		<div class="comments-next"><?php next_comments_link(); ?></div>
	</nav>
<?php endif;?>

<?php if ( comments_open() ) : ?>
<div class="mk-divider mk-shortcode pattern-line"></div><div class="clearboth"></div>
	<div id="respond">
		<div class="mk-divider-shortcode pattern-line"></div>

		
    	<div class="cancel-comment-reply">
        	<?php cancel_comment_reply_link(); ?>
		</div>
<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
		<div class="comment-form-info"><?php printf( __( 'You must be <a href="%s">logged in</a> to post a comment', 'theme_frontend' ), wp_login_url( get_permalink() ) ); ?></div>
<?php else : ?>
	<?php if ( is_user_logged_in() ) : ?>
			<div class="comment-form-info"><?php printf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'theme_frontend' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( get_permalink()  ) )?></div>
	<?php endif; ?>		
   		<form class="<?php if(! is_user_logged_in()) { ?> mk-not-logged <?php } else { ?> mk-logged <?php } ?>" action="<?php echo get_option( 'siteurl' ); ?>/wp-comments-post.php" method="post" id="commentform">
   					<div class="comment-textarea">
            <textarea class="textarea" name="comment" rows="8" id="comment" tabindex="53"></textarea>
        </div>

<?php if ( ! is_user_logged_in() ) : ?>
			<div class="comment-form-name comment-form-row">
            <input type="text" name="author" class="text_input" id="author" value="<?php if($comment_author) {echo $comment_author; } ?>" tabindex="54" data-watermark="<?php _e('Name (Required)', 'theme_frontend'); ?>"  />
			</div>

			<div class="comment-form-email comment-form-row">
    <input type="text" name="email" class="text_input" id="email" value="<?php if($comment_author_email) {echo $comment_author_email; } ?>" tabindex="56" data-watermark="<?php _e('Email (Required)', 'theme_frontend'); ?>" />
			</div>

			<div class="comment-form-website comment-form-row">
    <input type="text" name="url" class="text_input" id="url" value="<?php if($comment_author_url) {echo $comment_author_url; } ?>"  tabindex="57" data-watermark="<?php _e('Website', 'theme_frontend'); ?>" />
			</div>

<?php endif; ?>



	<a class="mk-button comment-form-button medium" href="#"><?php _e( 'POST COMMENT', 'theme_frontend' )?></a>
	<div class="clearboth"></div>
	<?php comment_id_fields(); ?>
			<?php do_action( 'comment_form', $post->ID ); ?>
		</form>
<?php endif; ?>
	</div><!--/respond-->

<?php endif; ?>

</section>
