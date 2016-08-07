<?php get_header(); ?>
<section class="singlepage">
    <div class="leftside">
        <?php get_sidebar('mainmenu'); ?>
        <?php if(ale_get_option('leftsidebarinspiration')==1){ include 'templates/sidebar-inspiration.php'; } ?>
    </div>
    <?php if(ale_get_option('rightsidebarinspiration')==1){ ?>
        <div class="rightsidebar">
            <?php include 'templates/sidebar-right-inspiration.php'; ?>
        </div>
    <?php } ?>
    <div class="rightside <?php if(ale_get_option('rightsidebarinspiration')==1){ echo 'centerside'; } ?>">

        <div id="post" class="content inspirationbox">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="post post-<?php echo $post->ID; ?> inspiration type-inspiration status-publish hentry" id="post-<?php echo $post->ID; ?>" data-post-id="<?php echo $post->ID; ?>">
            <header class="page-title"><h2 class="a"><?php the_title(); ?></h2><a href="javascript:history.go(-1)" class="goback"><?php _e('Go Back', 'aletheme')?></a></header>

            <div class="topinspiration cf">

                    <div id="inspirationslider">
                        <div class="items">
                            <?php
                            $args = array(
                                'post_type' => 'attachment',
                                'numberposts' => -1,
                                'post_status' => null,
                                'order'				=> 'ASC',
                                'orderby'			=> 'menu_order ID',
                                'meta_query'		=> array(
                                    array(
                                        'key'		=> '_ale_hide_from_gallery',
                                        'value'		=> 0,
                                        'type'		=> 'DECIMAL',
                                    ),
                                ),
                                'post_parent' => $post->ID
                            );
                            $attachments = get_posts( $args );
                            if ( $attachments ) {
                                foreach ( $attachments as $attachment ) {
                                    echo "<div>".wp_get_attachment_image( $attachment->ID, 'inspiration-slider' )."</div>";
                                }
                            }
                            ?>
                        </div>
                        <a class="prev browse left"><?php _e('prev', 'aletheme')?></a><a class="next browse right"><?php _e('next', 'aletheme')?></a>
                    </div>
                    <div class="soclikesline cf">
                        <div class="lefticons">
                            <a class="prev browse left"><?php _e('prev', 'aletheme')?></a><a class="next browse right"><?php _e('next', 'aletheme')?></a>
                        </div>
                        <div class="righticons">
                            <div class="righticonstext">
                                <?php _e('Share this post', 'aletheme')?>:
                            </div>
                            <div class="righticonsbuttons">
                                <a href="<?php echo ale_get_share('fb'); ?>" class="fbicon" onclick="window.open(this.href, 'Share on Facebook', 'width=600,height=300'); return false">Facebook</a>
                                <a href="<?php echo ale_get_share('twi'); ?>" class="twiicon" onclick="window.open(this.href, 'Share on Twitter', 'width=600,height=300'); return false">Twitter</a>
                                <a href="<?php echo ale_get_share('goglp'); ?>" class="gooplus" onclick="window.open(this.href, 'Share on Google+', 'width=600,height=300'); return false">Google+</a>
                            </div>
                        </div>
                    </div>

            </div>

                <section class="full">
                    <section class="story cf">
                        <div class="boxcontent cf">
                            <?php the_content(); ?>
                            <blockquote class="inspiration">
                                <?php if(ale_get_meta('inspirationplace')){ echo '<strong>'.__('Place').':</strong> '. ale_get_meta('inspirationplace')."<br />"; } ?>
                                <?php if(ale_get_meta('inspirationdate')){ echo '<strong>'.__('Date').':</strong> '. date("d M-Y", strtotime(ale_get_meta('inspirationdate')))."<br />"; } ?>
                                <?php if(ale_get_meta('impress')){ echo '<strong>'.__('Impression & Feelings').':</strong> '. ale_get_meta('impress'); } ?>
                            </blockquote>
                        </div>
                        <?php wp_link_pages(array(
                        'before' => '<section class="story-pages"><p>' . __('Pages:', 'aletheme'),
                        'after'	 => '</p></section>',
                    )) ?>
                    </section>
                    <?php if(ale_get_option('commentoninspiration') == 1){ comments_template(); } ?>
                </section>
            </article>
            <?php endwhile; else: ?>
            <?php ale_part('notfound')?>
            <?php endif; ?>
        </div>
    </div>
    <div class="cf"></div>
</section>
<?php get_footer(); ?>