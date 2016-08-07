<?php get_header(); ?>
<section class="singlepage">
    <div class="leftside">
        <?php get_sidebar('mainmenu'); ?>
        <?php if(ale_get_option('leftsidebarvideo')==1){ include 'templates/sidebar-video.php'; } ?>
    </div>
    <?php if(ale_get_option('rightsidebarvideo')==1){ ?>
        <div class="rightsidebar">
            <?php include 'templates/sidebar-right-video.php'; ?>
        </div>
    <?php } ?>
    <div class="rightside <?php if(ale_get_option('rightsidebarvideo')==1){ echo 'centerside'; } ?>">

        <div id="post" class="content">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="post post-<?php echo $post->ID; ?> video type-video status-publish hentry" id="post-<?php echo $post->ID; ?>" data-post-id="<?php echo $post->ID; ?>">
                <header class="page-title"><h2 class="a"><?php the_title(); ?></h2><a href="javascript:history.go(-1)" class="goback"><?php _e('Go Back', 'aletheme')?></a></header>
                <div class="videopagevide">
                    <?php echo wp_oembed_get(ale_get_meta('videopagelink'), array('width'=>1000)); ?>
                </div>
                <div class="soclikesline cf">
                    <div class="lefticons">
                        <div class="couintbox"><?php echo getPostLikeLink($post->ID); ?></div><div class="soctext"> &nbsp;<?php _e('likes', 'aletheme')?> </div>
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
                <section class="full">
                    <?php ale_part('postcontent');?>
                    <?php if(ale_get_option('commentonvideo') == 1){ comments_template(); } ?>
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