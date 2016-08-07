<?php
/**
 * Template name: Blog Archive
 */

get_header();
//Set the page ID
$blog_page_id = $post->ID;
?>
<section class="singlepage">
    <div class="leftside">
        <?php get_sidebar('mainmenu'); ?>
        <?php if(ale_get_option('leftsidebarblog')==1){ get_sidebar(); } ?>
    </div>
    <?php if(ale_get_option('rightsidebarblog')==1){ ?>
        <div class="rightsidebar">
            <?php include 'templates/sidebar-right-blog.php'; ?>
        </div>
    <?php } ?>
    <div class="rightside <?php if(ale_get_option('rightsidebarblog')==1){ echo 'centerside'; } ?>">
        <div class="pagelayout gallerygrid cf">

            <?php
            if(ale_get_meta('itemblogcategory')){ $showcategoriesitems = '&cat='.ale_get_meta('itemblogcategory'); } else { $showcategoriesitems =''; }
            query_posts('&post_type=post'.$showcategoriesitems.'&posts_per_page='.ale_get_meta('itemblogpage','true',$blog_page_id).'&paged='.$paged); ?>
            <header class="page-title">
                <h2 class="a"><?php the_title(); ?></h2>
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

            <div class="blogpost <?php if(ale_get_meta('blogcolumnsnumpag','true',$blog_page_id)=='fullwidth') { echo 'fullwidth';} elseif(ale_get_meta('blogcolumnsnumpag','true',$blog_page_id)=='twocol'){ echo 'twocol';} elseif(ale_get_meta('blogcolumnsnumpag','true',$blog_page_id)=='threecol') {echo 'threecol';} ?> cf">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="itemblog">
                        <?php if(get_the_post_thumbnail($post->ID)){?>
                            <figure>
                                <a href="<?php the_permalink(); ?>">

                                    <?php
                                    if(ale_get_meta('tumbsblogstylepag','true',$blog_page_id)=='standtumbs'){
                                        if(ale_get_meta('blogcolumnsnumpag','true',$blog_page_id)=='twocol') {
                                            echo get_the_post_thumbnail($post->ID,'post-two');
                                        } elseif(ale_get_meta('blogcolumnsnumpag','true',$blog_page_id)=='threecol'){
                                            echo get_the_post_thumbnail($post->ID,'post-flex');
                                        } elseif(ale_get_meta('blogcolumnsnumpag','true',$blog_page_id)=='fullwidth') {
                                            echo get_the_post_thumbnail($post->ID,'post-fullwidth');
                                        }
                                    } elseif(ale_get_meta('tumbsblogstylepag','true',$blog_page_id)=='masontumbs'){
                                        if(ale_get_meta('blogcolumnsnumpag','true',$blog_page_id)=='twocol') {
                                            echo get_the_post_thumbnail($post->ID,'post-two-mason');
                                        } elseif(ale_get_meta('blogcolumnsnumpag','true',$blog_page_id)=='threecol'){
                                            echo get_the_post_thumbnail($post->ID,'post-poster');
                                        } elseif(ale_get_meta('blogcolumnsnumpag','true',$blog_page_id)=='fullwidth') {
                                            echo get_the_post_thumbnail($post->ID,'post-fullwidth');
                                        }
                                    }

                                    ?>

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
                        <?php } ?>
                        <div class="itemboxwhite cf">
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
        </div>
    </div>
    <div class="cf"></div>
</section>

<?php get_footer(); ?>