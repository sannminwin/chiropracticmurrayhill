<?php get_header(); ?>
<section class="singlepage">
    <div class="leftside">
        <?php get_sidebar('mainmenu'); ?>
        <?php if(ale_get_option('leftsidebartestimonial')==1){ include 'templates/sidebar-testimonial.php'; } ?>
    </div>
    <?php if(ale_get_option('rightsidebartestimonial')==1){ ?>
    <div class="rightsidebar">
        <?php include 'templates/sidebar-right-testimonial.php'; ?>
    </div>
    <?php } ?>
    <div class="rightside <?php if(ale_get_option('rightsidebartestimonial')==1){ echo 'centerside'; } ?>">
        <header class="page-title">
            <h2 class="a"><?php _e('Testimonials', 'aletheme')?></h2>
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
        <div class="blogpost content testimonialblog cf">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="itemblog">
                <?php if(get_the_post_thumbnail()){ ?>
                <div class="view view-first">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo get_the_post_thumbnail($post->ID, 'testimonials-avatar'); ?>
                    </a>
                    <div class="mask">
                        <h2><?php echo ale_get_meta('testimauthor'); ?></h2>
                        <div class="textup">
                            <strong><?php the_title(); ?></strong><br />
                            <span><?php echo ale_truncate(get_the_excerpt(),210); ?></span>
                        </div>

                    </div>
                </div>
                <?php } else { ?>
                <figure class="notumbtestimonial cf">
                    <img src="<?php echo get_template_directory_uri(); ?>/css/images/blockbg.gif" />
                    <figcaption>
                        <h2><?php echo ale_get_meta('testimauthor'); ?></h2>
                        <div class="textup">
                          <strong><?php the_title(); ?></strong>
                          <span><?php echo ale_truncate(get_the_excerpt(),210); ?></span>
                        </div>

                    </figcaption>
                </figure>
                <?php } ?>
            </div>
            <?php endwhile; else: ?>
            <?php ale_part('notfound')?>
            <?php endif; ?>
            <div class="cf"></div>
        </div>
    </div>
    <div class="cf"></div>
</section>
<?php get_footer(); ?>