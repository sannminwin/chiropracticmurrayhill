<?php get_header(); ?>
<section class="singlepage">
    <div class="leftside">
        <?php get_sidebar('mainmenu'); ?>
        <?php get_sidebar(); ?>
    </div>
    <div class="rightside">
        <?php ale_page_title(sprintf(__('Tag Archives: %s', 'aletheme'),  single_tag_title( '', false ))) ?>
        <div class="blogpost content cf">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="itemblog">
                <figure>
                    <a href="<?php the_permalink(); ?>">
                        <?php echo get_the_post_thumbnail($post->ID, 'post-poster'); ?>
                    </a>
                    <figcaption>
                        <a href="<?php the_permalink(); ?>">
                                <span>
                                    <div class="black">
                                        <?php echo get_comments_number(); ?> <?php _e('comments', 'aletheme')?> / <?php if(get_post_meta($post->ID, "votes_count", true)==""){ echo "0";} else { echo get_post_meta($post->ID, "votes_count", true);};?> <?php _e('votes', 'aletheme')?>
                                    </div>
                                </span>
                        </a>
                    </figcaption>
                </figure>
                <div class="itemboxwhite">
                    <div class="titleline cf">
                        <div class="datebox">
                            <span class="day"><?php echo get_the_time('d') ?></span><br />
                            <span class="month"><?php echo get_the_time('M-Y') ?></span>
                        </div>
                        <div class="title cf">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
                            <div class="meta ta">
                                <span class="categories"><?php the_category(', '); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="theexcerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="bottomblogitem cf">
                        <div class="leftdatablog">
                            <?php echo get_comments_number(); ?> <?php _e('comments', 'aletheme')?> / <?php if(get_post_meta($post->ID, "votes_count", true)==""){ echo "0";} else { echo get_post_meta($post->ID, "votes_count", true);};?> <?php _e('votes', 'aletheme')?>
                        </div>
                        <div class="readmoreblog">
                            <a href="<?php the_permalink(); ?>"><?php _e('Read More', 'aletheme')?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; else: ?>
            <?php ale_part('notfound')?>
            <?php endif; ?>
        </div>
        <?php ale_part('archives'); ?>
    </div>
    <div class="cf"></div>
</section>
<?php get_footer(); ?>