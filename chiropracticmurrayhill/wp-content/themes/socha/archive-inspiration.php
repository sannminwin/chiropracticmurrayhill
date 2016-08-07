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
        <header class="page-title">
            <h2 class="a"><?php _e('Inspiration', 'aletheme')?></h2>
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
        <div class="blogpost content inspirationblog cf">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="itemblog">
                <?php if(get_the_post_thumbnail()){ ?>
                <div class="view view-effect">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo get_the_post_thumbnail($post->ID, 'inspiration-poster'); ?>
                    </a>
                    <div class="mask">
                        <h2><?php the_title(); ?></h2>
                        <p>
                            <?php if(ale_get_meta('inspirationplace')){ echo '<strong>'.__('Place').':</strong> '. ale_get_meta('inspirationplace')."<br />"; } ?>
                            <?php if(ale_get_meta('inspirationdate')){ echo '<strong>'.__('Date').':</strong> '. date("d M-Y", strtotime(ale_get_meta('inspirationdate')))."<br />"; } ?>
                            <?php if(ale_get_meta('impress')){ echo '<strong>'.__('Impression & Feelings').':</strong> '. ale_get_meta('impress'); } ?>
                        </p>
                        <a href="<?php the_permalink(); ?>" class="info"><?php _e('Read More', 'aletheme')?></a>
                    </div>
                </div>
                <?php } else { ?>
                    <figure class="notumbinspiration cf">
                            <img src="<?php echo get_template_directory_uri(); ?>/css/images/blockbg.gif" />
                            <figcaption>
                                <h2><?php the_title(); ?></h2>
                                <p>
                                    <?php if(ale_get_meta('inspirationplace')){ echo '<strong>'.__('Place').':</strong> '. ale_get_meta('inspirationplace')."<br />"; } ?>
                                    <?php if(ale_get_meta('inspirationdate')){ echo '<strong>'.__('Date').':</strong> '. date("d M-Y", strtotime(ale_get_meta('inspirationdate')))."<br />"; } ?>
                                    <?php if(ale_get_meta('impress')){ echo '<strong>'.__('Impression & Feelings').':</strong> '. ale_get_meta('impress'); } ?>
                                </p>
                                <a href="<?php the_permalink(); ?>" class="info"><?php _e('Read More', 'aletheme')?></a>
                            </figcaption>
                    </figure>
                <?php } ?>
            </div>
            <?php endwhile; else: ?>
            <?php ale_part('notfound')?>
            <?php endif; ?>
        </div>
    </div>
    <div class="cf"></div>
</section>
<?php get_footer(); ?>