<?php
	// Do not delete these lines for security reasons
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
		die ('Please do not load this page directly. Thanks!');
	}
?>
<?php if($post->post_type == "post"){ ?>
    <?php if (ale_get_option('comments_style') == 'off') : ?>
        <?php
            // comments are disabled
            return;
        ?>
    <?php elseif (ale_get_option('comments_style') == 'wp') : ?>
    <section class="commentform cf">
        <a name="comments"></a>
            <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
                <p class="comments-closed"><?php _e('Comments are closed.', 'aletheme'); ?></p>
            <?php endif; ?>
        <?php if (comments_open()) : ?>
        <section class="comments">
            <div class="scrollbox">
            <?php if (post_password_required()) : ?>
                <p class="comments-protected"><?php _e('This post is password protected. Enter the password to view comments.', 'aletheme'); ?></p>
            <?php
            return; endif; ?>
            <?php if (have_comments()) : ?>
                <ol class="commentlist">
                    <?php wp_list_comments(array('callback' => 'aletheme_comment', 'max_depth' => 2)); ?>
                </ol>
                <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>
                    <nav class="comments-nav" class="pager">
                        <div class="previous"><?php previous_comments_link(__('&larr; Older comments', 'aletheme')); ?></div>
                        <div class="next"><?php next_comments_link(__('Newer comments &rarr;', 'aletheme')); ?></div>
                    </nav>
                <?php endif; // check for comment navigation ?>
            <?php endif; ?>
            </div>
        </section>
        <section class="respond cf">
            <a name="respond"></a>

            <h3><?php _e('comment this post', 'aletheme')?></h3>

            <p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
            <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'aletheme'), wp_login_url(get_permalink())); ?></p>
            <?php else : ?>
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="comment-form">
                    <p class="error"></p>
                    <div class="area1 ta">
                        <?php if (is_user_logged_in()) : ?>
                            <p><?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'aletheme'), get_option('siteurl'), $user_identity); ?></p>
                            <p class="c"><a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'aletheme'); ?>"><?php _e('Log out &raquo;', 'aletheme'); ?></a></p>
                            <br /><br />
                        <?php else : ?>
                            <input type="text" placeholder="<?php _e('Name', 'aletheme'); if ($req) _e('*', 'aletheme'); ?>" class="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> required="required">
                            <input type="email" class="text" name="email" placeholder="<?php _e('Email', 'aletheme'); if ($req) _e('*', 'aletheme'); ?>" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> required="required" email="true">
                            <input type="url" placeholder="<?php _e('Website', 'aletheme'); ?>" class="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" >
                        <?php endif; ?>
                    </div>
                    <div class="area2 ta cf">
                        <div class="commenttextarea">
                            <textarea name="comment" placeholder="<?php _e('Comment', 'aletheme'); ?>*" id="comment" class="input-xlarge" tabindex="4" rows="5" cols="40" required="required"></textarea>
                            <br /><span><?php _e('Click on form to scroll', 'aletheme')?></span>
                        </div>
                        <div class="buttoncomment">
                            <input name="submit" class="submit" type="submit" tabindex="5" value="<?php _e('Submit', 'aletheme'); ?>" />
                            <input name="reset" class="reset" type="reset" tabindex="5" value="<?php _e('Clear', 'aletheme'); ?>" />
                        </div>
                    </div>


                    <div class="cf"></div>
                    <?php comment_id_fields(); ?>
                    <?php do_action('comment_form', $post->ID); ?>
                </form>
            <?php endif; // if registration required and not logged in ?>
        </section>
    </section>
        <?php endif; ?>
    <?php elseif(ale_get_option('comments_style') == 'fb') : ?>
        <section class="facebook-comments">
            <div id="fb-comments<?php the_ID()?>" class="fb-comments" data-href="<?php the_permalink()?>" data-num-posts="5"></div>
        </section>
    <?php elseif(ale_get_option('comments_style') == 'dq') : ?>
        <section class="disqus-comments">
            <?php _e('Please download the DISQUS plugin from Wordpress Repository and install it.', 'aletheme'); ?>
        </section>
    <?php elseif(ale_get_option('comments_style') == 'lf') : ?>
        <section class="disqus-comments">
            <?php _e('Please download the Livefyre Realtime Comments plugin from Wordpress Repository and install it.', 'aletheme'); ?>
        </section>
    <?php elseif(ale_get_option('comments_style') == 'ws') : ?>
        <section class="defaultwp">
            <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
                <p class="comments-closed"><?php _e('Comments are closed.', 'aletheme'); ?></p>
            <?php endif; ?>
            <div id="comments">
                <?php wp_list_comments() ?>

                <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
                <nav id="comment-nav-below" class="navigation" role="navigation">
                    <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'aletheme' ); ?></h1>
                    <div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'aletheme' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'aletheme' ) ); ?></div>
                </nav>
                <?php endif; // check for comment navigation ?>
            </div>
            <div class="respondbox">
                <?php comment_form(); ?>
            </div>
        </section>
    <?php endif; ?>


<?php } elseif($post->post_type == "press"){ ?>


    <?php if (ale_get_option('presscomments_style') == 'off') : ?>
        <?php
            // comments are disabled
            return;
            ?>
        <?php elseif (ale_get_option('presscomments_style') == 'wp') : ?>
    <section class="commentform cf">
        <a name="comments"></a>
            <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
                <p class="comments-closed"><?php _e('Comments are closed.', 'aletheme'); ?></p>
                <?php endif; ?>
            <?php if (comments_open()) : ?>
                <section class="comments">
                    <div class="scrollbox">
                        <?php if (post_password_required()) : ?>
                        <p class="comments-protected"><?php _e('This post is password protected. Enter the password to view comments.', 'aletheme'); ?></p>
                        <?php
                        return; endif; ?>
                        <?php if (have_comments()) : ?>
                        <ol class="commentlist">
                            <?php wp_list_comments(array('callback' => 'aletheme_comment', 'max_depth' => 2)); ?>
                        </ol>
                        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>
                            <nav class="comments-nav" class="pager">
                                <div class="previous"><?php previous_comments_link(__('&larr; Older comments', 'aletheme')); ?></div>
                                <div class="next"><?php next_comments_link(__('Newer comments &rarr;', 'aletheme')); ?></div>
                            </nav>
                            <?php endif; // check for comment navigation ?>
                        <?php endif; ?>
                    </div>
                </section>
                <section class="respond cf">
                    <a name="respond"></a>

                    <h3><?php _e('comment this post', 'aletheme')?></h3>

                    <p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
                    <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                    <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'aletheme'), wp_login_url(get_permalink())); ?></p>
                    <?php else : ?>
                    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="comment-form">
                        <p class="error"></p>
                        <div class="area1 ta">
                            <?php if (is_user_logged_in()) : ?>
                            <p><?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'aletheme'), get_option('siteurl'), $user_identity); ?></p>
                            <p class="c"><a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'aletheme'); ?>"><?php _e('Log out &raquo;', 'aletheme'); ?></a></p>
                            <br /><br />
                            <?php else : ?>
                            <input type="text" placeholder="<?php _e('Name', 'aletheme'); if ($req) _e('*', 'aletheme'); ?>" class="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> required="required">
                            <input type="email" class="text" name="email" placeholder="<?php _e('Email', 'aletheme'); if ($req) _e('*', 'aletheme'); ?>" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> required="required" email="true">
                            <input type="url" placeholder="<?php _e('Website', 'aletheme'); ?>" class="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" >
                            <?php endif; ?>
                        </div>
                        <div class="area2 ta cf">
                            <div class="commenttextarea">
                                <textarea name="comment" placeholder="<?php _e('Comment', 'aletheme'); ?>*" id="comment" class="input-xlarge" tabindex="4" rows="5" cols="40" required="required"></textarea>
                                <br /><span><?php _e('Click on form to scroll', 'aletheme')?></span>
                            </div>
                            <div class="buttoncomment">
                                <input name="submit" class="submit" type="submit" tabindex="5" value="<?php _e('Submit', 'aletheme'); ?>" />
                                <input name="reset" class="reset" type="reset" tabindex="5" value="<?php _e('Clear', 'aletheme'); ?>" />
                            </div>
                        </div>


                        <div class="cf"></div>
                        <?php comment_id_fields(); ?>
                        <?php do_action('comment_form', $post->ID); ?>
                    </form>
                    <?php endif; // if registration required and not logged in ?>
                </section>
    </section>
        <?php endif; ?>
        <?php elseif(ale_get_option('presscomments_style') == 'fb') : ?>
        <section class="facebook-comments">
            <div id="fb-comments<?php the_ID()?>" class="fb-comments" data-href="<?php the_permalink()?>" data-num-posts="5"></div>
        </section>
        <?php elseif(ale_get_option('presscomments_style') == 'dq') : ?>
        <section class="disqus-comments">
            <?php _e('Please download the DISQUS plugin from Wordpress Repository and install it.', 'aletheme'); ?>
        </section>
        <?php elseif(ale_get_option('presscomments_style') == 'lf') : ?>
        <section class="disqus-comments">
            <?php _e('Please download the Livefyre Realtime Comments plugin from Wordpress Repository and install it.', 'aletheme'); ?>
        </section>
        <?php elseif(ale_get_option('presscomments_style') == 'ws') : ?>
        <section class="defaultwp">
            <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
            <p class="comments-closed"><?php _e('Comments are closed.', 'aletheme'); ?></p>
            <?php endif; ?>
            <div id="comments">
                <?php wp_list_comments() ?>

                <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
                <nav id="comment-nav-below" class="navigation" role="navigation">
                    <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'aletheme' ); ?></h1>
                    <div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'aletheme' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'aletheme' ) ); ?></div>
                </nav>
                <?php endif; // check for comment navigation ?>
            </div>
            <div class="respondbox">
                <?php comment_form(); ?>
            </div>
        </section>
    <?php endif; ?>


<?php } elseif($post->post_type == "gallery"){ ?>


<?php if (ale_get_option('gallerycomments_style') == 'off') : ?>
    <?php
        // comments are disabled
        return;
        ?>
    <?php elseif (ale_get_option('gallerycomments_style') == 'wp') : ?>
    <section class="commentform cf">
        <a name="comments"></a>
        <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
            <p class="comments-closed"><?php _e('Comments are closed.', 'aletheme'); ?></p>
            <?php endif; ?>
        <?php if (comments_open()) : ?>
            <section class="comments">
                <div class="scrollbox">
                    <?php if (post_password_required()) : ?>
                    <p class="comments-protected"><?php _e('This post is password protected. Enter the password to view comments.', 'aletheme'); ?></p>
                    <?php
                    return; endif; ?>
                    <?php if (have_comments()) : ?>
                    <ol class="commentlist">
                        <?php wp_list_comments(array('callback' => 'aletheme_comment', 'max_depth' => 2)); ?>
                    </ol>
                    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>
                        <nav class="comments-nav" class="pager">
                            <div class="previous"><?php previous_comments_link(__('&larr; Older comments', 'aletheme')); ?></div>
                            <div class="next"><?php next_comments_link(__('Newer comments &rarr;', 'aletheme')); ?></div>
                        </nav>
                        <?php endif; // check for comment navigation ?>
                    <?php endif; ?>
                </div>
            </section>
            <section class="respond cf">
                <a name="respond"></a>

                <h3><?php _e('comment this post', 'aletheme')?></h3>

                <p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
                <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'aletheme'), wp_login_url(get_permalink())); ?></p>
                <?php else : ?>
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="comment-form">
                    <p class="error"></p>
                    <div class="area1 ta">
                        <?php if (is_user_logged_in()) : ?>
                        <p><?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'aletheme'), get_option('siteurl'), $user_identity); ?></p>
                        <p class="c"><a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'aletheme'); ?>"><?php _e('Log out &raquo;', 'aletheme'); ?></a></p>
                        <br /><br />
                        <?php else : ?>
                        <input type="text" placeholder="<?php _e('Name', 'aletheme'); if ($req) _e('*', 'aletheme'); ?>" class="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> required="required">
                        <input type="email" class="text" name="email" placeholder="<?php _e('Email', 'aletheme'); if ($req) _e('*', 'aletheme'); ?>" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> required="required" email="true">
                        <input type="url" placeholder="<?php _e('Website', 'aletheme'); ?>" class="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" >
                        <?php endif; ?>
                    </div>
                    <div class="area2 ta cf">
                        <div class="commenttextarea">
                            <textarea name="comment" placeholder="<?php _e('Comment', 'aletheme'); ?>*" id="comment" class="input-xlarge" tabindex="4" rows="5" cols="40" required="required"></textarea>
                            <br /><span><?php _e('Click on form to scroll', 'aletheme')?></span>
                        </div>
                        <div class="buttoncomment">
                            <input name="submit" class="submit" type="submit" tabindex="5" value="<?php _e('Submit', 'aletheme'); ?>" />
                            <input name="reset" class="reset" type="reset" tabindex="5" value="<?php _e('Clear', 'aletheme'); ?>" />
                        </div>
                    </div>


                    <div class="cf"></div>
                    <?php comment_id_fields(); ?>
                    <?php do_action('comment_form', $post->ID); ?>
                </form>
                <?php endif; // if registration required and not logged in ?>
            </section>
    </section>
        <?php endif; ?>
    <?php elseif(ale_get_option('gallerycomments_style') == 'fb') : ?>
    <section class="facebook-comments">
        <div id="fb-comments<?php the_ID()?>" class="fb-comments" data-href="<?php the_permalink()?>" data-num-posts="5"></div>
    </section>
    <?php elseif(ale_get_option('gallerycomments_style') == 'dq') : ?>
    <section class="disqus-comments">
        <?php _e('Please download the DISQUS plugin from Wordpress Repository and install it.', 'aletheme'); ?>
    </section>
    <?php elseif(ale_get_option('gallerycomments_style') == 'lf') : ?>
    <section class="disqus-comments">
        <?php _e('Please download the Livefyre Realtime Comments plugin from Wordpress Repository and install it.', 'aletheme'); ?>
    </section>
    <?php elseif(ale_get_option('gallerycomments_style') == 'ws') : ?>
    <section class="defaultwp">
        <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="comments-closed"><?php _e('Comments are closed.', 'aletheme'); ?></p>
        <?php endif; ?>
        <div id="comments">
            <?php wp_list_comments() ?>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav id="comment-nav-below" class="navigation" role="navigation">
                <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'aletheme' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'aletheme' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'aletheme' ) ); ?></div>
            </nav>
            <?php endif; // check for comment navigation ?>
        </div>
        <div class="respondbox">
            <?php comment_form(); ?>
        </div>
    </section>
    <?php endif; ?>


<?php } elseif($post->post_type == "inspiration"){ ?>


<?php if (ale_get_option('inspirationcomments_style') == 'off') : ?>
    <?php
        // comments are disabled
        return;
        ?>
    <?php elseif (ale_get_option('inspirationcomments_style') == 'wp') : ?>
    <section class="commentform cf">
        <a name="comments"></a>
        <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
            <p class="comments-closed"><?php _e('Comments are closed.', 'aletheme'); ?></p>
            <?php endif; ?>
        <?php if (comments_open()) : ?>
            <section class="comments">
                <div class="scrollbox">
                    <?php if (post_password_required()) : ?>
                    <p class="comments-protected"><?php _e('This post is password protected. Enter the password to view comments.', 'aletheme'); ?></p>
                    <?php
                    return; endif; ?>
                    <?php if (have_comments()) : ?>
                    <ol class="commentlist">
                        <?php wp_list_comments(array('callback' => 'aletheme_comment', 'max_depth' => 2)); ?>
                    </ol>
                    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>
                        <nav class="comments-nav" class="pager">
                            <div class="previous"><?php previous_comments_link(__('&larr; Older comments', 'aletheme')); ?></div>
                            <div class="next"><?php next_comments_link(__('Newer comments &rarr;', 'aletheme')); ?></div>
                        </nav>
                        <?php endif; // check for comment navigation ?>
                    <?php endif; ?>
                </div>
            </section>
            <section class="respond cf">
                <a name="respond"></a>

                <h3><?php _e('comment this post', 'aletheme')?></h3>

                <p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
                <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'aletheme'), wp_login_url(get_permalink())); ?></p>
                <?php else : ?>
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="comment-form">
                    <p class="error"></p>
                    <div class="area1 ta">
                        <?php if (is_user_logged_in()) : ?>
                        <p><?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'aletheme'), get_option('siteurl'), $user_identity); ?></p>
                        <p class="c"><a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'aletheme'); ?>"><?php _e('Log out &raquo;', 'aletheme'); ?></a></p>
                        <br /><br />
                        <?php else : ?>
                        <input type="text" placeholder="<?php _e('Name', 'aletheme'); if ($req) _e('*', 'aletheme'); ?>" class="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> required="required">
                        <input type="email" class="text" name="email" placeholder="<?php _e('Email', 'aletheme'); if ($req) _e('*', 'aletheme'); ?>" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> required="required" email="true">
                        <input type="url" placeholder="<?php _e('Website', 'aletheme'); ?>" class="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" >
                        <?php endif; ?>
                    </div>
                    <div class="area2 ta cf">
                        <div class="commenttextarea">
                            <textarea name="comment" placeholder="<?php _e('Comment', 'aletheme'); ?>*" id="comment" class="input-xlarge" tabindex="4" rows="5" cols="40" required="required"></textarea>
                            <br /><span><?php _e('Click on form to scroll', 'aletheme')?></span>
                        </div>
                        <div class="buttoncomment">
                            <input name="submit" class="submit" type="submit" tabindex="5" value="<?php _e('Submit', 'aletheme'); ?>" />
                            <input name="reset" class="reset" type="reset" tabindex="5" value="<?php _e('Clear', 'aletheme'); ?>" />
                        </div>
                    </div>


                    <div class="cf"></div>
                    <?php comment_id_fields(); ?>
                    <?php do_action('comment_form', $post->ID); ?>
                </form>
                <?php endif; // if registration required and not logged in ?>
            </section>
    </section>
        <?php endif; ?>
    <?php elseif(ale_get_option('inspirationcomments_style') == 'fb') : ?>
    <section class="facebook-comments">
        <div id="fb-comments<?php the_ID()?>" class="fb-comments" data-href="<?php the_permalink()?>" data-num-posts="5"></div>
    </section>
    <?php elseif(ale_get_option('inspirationcomments_style') == 'dq') : ?>
    <section class="disqus-comments">
        <?php _e('Please download the DISQUS plugin from Wordpress Repository and install it.', 'aletheme'); ?>
    </section>
    <?php elseif(ale_get_option('inspirationcomments_style') == 'lf') : ?>
    <section class="disqus-comments">
        <?php _e('Please download the Livefyre Realtime Comments plugin from Wordpress Repository and install it.', 'aletheme'); ?>
    </section>
    <?php elseif(ale_get_option('inspirationcomments_style') == 'ws') : ?>
    <section class="defaultwp">
        <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="comments-closed"><?php _e('Comments are closed.', 'aletheme'); ?></p>
        <?php endif; ?>
        <div id="comments">
            <?php wp_list_comments() ?>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav id="comment-nav-below" class="navigation" role="navigation">
                <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'aletheme' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'aletheme' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'aletheme' ) ); ?></div>
            </nav>
            <?php endif; // check for comment navigation ?>
        </div>
        <div class="respondbox">
            <?php comment_form(); ?>
        </div>
    </section>
    <?php endif; ?>


<?php } elseif($post->post_type == "video"){ ?>


<?php if (ale_get_option('videocomments_style') == 'off') : ?>
    <?php
        // comments are disabled
        return;
        ?>
    <?php elseif (ale_get_option('videocomments_style') == 'wp') : ?>
    <section class="commentform cf">
        <a name="comments"></a>
        <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
            <p class="comments-closed"><?php _e('Comments are closed.', 'aletheme'); ?></p>
            <?php endif; ?>
        <?php if (comments_open()) : ?>
            <section class="comments">
                <div class="scrollbox">
                    <?php if (post_password_required()) : ?>
                    <p class="comments-protected"><?php _e('This post is password protected. Enter the password to view comments.', 'aletheme'); ?></p>
                    <?php
                    return; endif; ?>
                    <?php if (have_comments()) : ?>
                    <ol class="commentlist">
                        <?php wp_list_comments(array('callback' => 'aletheme_comment', 'max_depth' => 2)); ?>
                    </ol>
                    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>
                        <nav class="comments-nav" class="pager">
                            <div class="previous"><?php previous_comments_link(__('&larr; Older comments', 'aletheme')); ?></div>
                            <div class="next"><?php next_comments_link(__('Newer comments &rarr;', 'aletheme')); ?></div>
                        </nav>
                        <?php endif; // check for comment navigation ?>
                    <?php endif; ?>
                </div>
            </section>
            <section class="respond cf">
                <a name="respond"></a>

                <h3><?php _e('comment this post', 'aletheme')?></h3>

                <p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
                <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'aletheme'), wp_login_url(get_permalink())); ?></p>
                <?php else : ?>
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="comment-form">
                    <p class="error"></p>
                    <div class="area1 ta">
                        <?php if (is_user_logged_in()) : ?>
                        <p><?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'aletheme'), get_option('siteurl'), $user_identity); ?></p>
                        <p class="c"><a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'aletheme'); ?>"><?php _e('Log out &raquo;', 'aletheme'); ?></a></p>
                        <br /><br />
                        <?php else : ?>
                        <input type="text" placeholder="<?php _e('Name', 'aletheme'); if ($req) _e('*', 'aletheme'); ?>" class="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> required="required">
                        <input type="email" class="text" name="email" placeholder="<?php _e('Email', 'aletheme'); if ($req) _e('*', 'aletheme'); ?>" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> required="required" email="true">
                        <input type="url" placeholder="<?php _e('Website', 'aletheme'); ?>" class="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" >
                        <?php endif; ?>
                    </div>
                    <div class="area2 ta cf">
                        <div class="commenttextarea">
                            <textarea name="comment" placeholder="<?php _e('Comment', 'aletheme'); ?>*" id="comment" class="input-xlarge" tabindex="4" rows="5" cols="40" required="required"></textarea>
                            <br /><span><?php _e('Click on form to scroll', 'aletheme')?></span>
                        </div>
                        <div class="buttoncomment">
                            <input name="submit" class="submit" type="submit" tabindex="5" value="<?php _e('Submit', 'aletheme'); ?>" />
                            <input name="reset" class="reset" type="reset" tabindex="5" value="<?php _e('Clear', 'aletheme'); ?>" />
                        </div>
                    </div>


                    <div class="cf"></div>
                    <?php comment_id_fields(); ?>
                    <?php do_action('comment_form', $post->ID); ?>
                </form>
                <?php endif; // if registration required and not logged in ?>
            </section>
    </section>
        <?php endif; ?>
    <?php elseif(ale_get_option('videocomments_style') == 'fb') : ?>
    <section class="facebook-comments">
        <div id="fb-comments<?php the_ID()?>" class="fb-comments" data-href="<?php the_permalink()?>" data-num-posts="5"></div>
    </section>
    <?php elseif(ale_get_option('videocomments_style') == 'dq') : ?>
    <section class="disqus-comments">
        <?php _e('Please download the DISQUS plugin from Wordpress Repository and install it.', 'aletheme'); ?>
    </section>
    <?php elseif(ale_get_option('videocomments_style') == 'lf') : ?>
    <section class="disqus-comments">
        <?php _e('Please download the Livefyre Realtime Comments plugin from Wordpress Repository and install it.', 'aletheme'); ?>
    </section>
    <?php elseif(ale_get_option('videocomments_style') == 'ws') : ?>
    <section class="defaultwp">
        <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="comments-closed"><?php _e('Comments are closed.', 'aletheme'); ?></p>
        <?php endif; ?>
        <div id="comments">
            <?php wp_list_comments() ?>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav id="comment-nav-below" class="navigation" role="navigation">
                <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'aletheme' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'aletheme' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'aletheme' ) ); ?></div>
            </nav>
            <?php endif; // check for comment navigation ?>
        </div>
        <div class="respondbox">
            <?php comment_form(); ?>
        </div>
    </section>
    <?php endif; ?>


<?php } ?>