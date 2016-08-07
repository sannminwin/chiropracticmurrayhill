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
        <header class="page-title">
            <h2 class="a"><?php _e('Videos', 'aletheme')?></h2>
            <div class="toppagination">
                <div class="pagpages">
                    <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
                    <?php echo $paged; ?> of <?php echo $wp_query->max_num_pages; ?>
                </div>
                <div class="paglinks">
                    <?php posts_nav_link(' / ',__('NEWER'),__('OLDER')); ?>
                </div>
            </div>
        </header>
        <div class="blogpost content cf">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="itemblog">
                <?php if(get_the_post_thumbnail()){ ?>
                    <figure>
                        <a href="<?php the_permalink(); ?>">
                            <?php echo get_the_post_thumbnail($post->ID, 'press-poster'); ?>
                        </a>
                        <figcaption>
                            <a href="<?php the_permalink(); ?>">
                                    <span>
                                        <div class="black">
                                            <?php _e('VIDEO', 'aletheme')?>
                                        </div>
                                    </span>
                            </a>
                        </figcaption>
                    </figure>
                <?php } elseif(ale_get_meta('videopagelink')) { ?>
                    <figure class="videobox">
                        <?php echo wp_oembed_get(ale_get_meta('videopagelink'), array('width'=>320)); ?>
                    </figure>
                <?php } ?>

                <div class="itemboxwhite">
                    <div class="titleline cf">
                        <div class="datebox">
                            <span class="day"><?php echo get_the_time('d') ?></span><br />
                            <span class="month"><?php echo get_the_time('M-Y') ?></span>
                        </div>
                        <div class="title cf">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
                        </div>
                    </div>
                    <div class="theexcerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="bottomblogitem cf">
                        <div class="readmoreblog" style="text-align: center; float:none; font-size:12px;">
                            <a href="<?php the_permalink(); ?>"><?php _e('watch the video', 'aletheme')?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; else: ?>
            <?php ale_part('notfound')?>
            <?php endif; ?>
        </div>
    </div>
    <div class="cf"></div>
</section>
<?php get_footer(); ?>