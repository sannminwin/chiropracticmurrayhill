<?php get_header(); ?>
<section class="singlepage">
    <div class="leftside">
        <?php get_sidebar('mainmenu'); ?>
        <?php if(ale_get_option('leftsidebarpress')==1){ include 'templates/sidebar-press.php'; } ?>
    </div>
    <?php if(ale_get_option('rightsidebarpress')==1){ ?>
        <div class="rightsidebar">
            <?php include 'templates/sidebar-right-press.php'; ?>
        </div>
    <?php } ?>
    <div class="rightside <?php if(ale_get_option('rightsidebarpress')==1){ echo 'centerside'; } ?>">
        <header class="page-title">
            <h2 class="a"><?php _e('Press', 'aletheme')?></h2>
            <div class="toppagination">
                <div class="pagpages">
                    <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
                    <?php echo $paged; ?> of <?php echo $wp_query->max_num_pages; ?>
                </div>
                <div class="paglinks">
                    <?php posts_nav_link(' / ',__('NEWER', 'aletheme'),__('OLDER', 'aletheme')); ?>
                </div>
            </div>
        </header>
        <div class="pressarchive content cf">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="pressstyle">
                    <div class="image">
                        <figure>
                            <?php if(ale_get_meta('pressexternallink')) { ?>
                                <a href="<?php echo ale_get_meta('pressexternallink'); ?>" target="_blank"><?php echo get_the_post_thumbnail($post->ID,'press-online'); ?></a>
                            <?php } else { ?>
                                <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail($post->ID,'press-online'); ?></a>
                            <?php } ?>
                            <figcaption>

                                <?php if(ale_get_meta('pressexternallink')) { ?>
                                    <a href="<?php echo ale_get_meta('pressexternallink'); ?>" target="_blank">
                                        <span><?php _e('OPEN SITE', 'aletheme')?></span>
                                    </a>
                                <?php } else { ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <span><?php _e('READ MORE', 'aletheme')?></span>
                                    </a>
                                <?php } ?>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="rightbox">
                        <div class="titleline cf">
                            <div class="datebox">
                                <span class="day"><?php echo get_the_time('d') ?></span><br />
                                <span class="month"><?php echo get_the_time('M-Y') ?></span>
                            </div>
                            <div class="title cf">
                                <h2><?php if(ale_get_meta('pressexternallink')) { ?>
                                    <a href="<?php echo ale_get_meta('pressexternallink'); ?>" target="_blank"><?php the_title(); ?></a>
                                    <?php } else { ?>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    <?php } ?></h2>
                                <div class="meta ta">
                                    <span class="categories"><?php if(ale_get_meta('pressexternallink')){echo __('ONLINE', 'aletheme');} else {echo __('PRINT', 'aletheme');} ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="excerptpress">
                            <?php echo ale_truncate(get_the_excerpt(),200); ?>
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