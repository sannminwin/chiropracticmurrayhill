<?php get_header(); ?>
<section class="singlepage">
    <div class="leftside">
        <?php get_sidebar('mainmenu'); ?>
        <?php get_sidebar(); ?>
    </div>
    <div class="rightside">
        <?php if(ale_get_option('topblogbox')==1){ ?>
        <div class="postnavigation cf">
            <div class="categoriesbox">
                <div class="title"><?php _e('BLOG CATEGORIES', 'aletheme')?>:</div>
                <div class="scrollcategory">
                    <ul class="categorieslist">
                        <?php
                        $catlist = get_categories();

                        echo '<li><a href="'.home_url().'/blog" >'.__('All', 'aletheme').'</a></li>';
                        foreach($catlist as $cat){
                            echo '<li><a href="'.get_category_link( $cat->term_id ).'">'.$cat->cat_name.'</a></li>';
                        }
                        ?>
                        <li></li>
                    </ul>
                </div>
            </div>
            <div class="reachsinglbox">
                <div class="title"><?php _e('SEARCH THE BLOG', 'aletheme')?>:</div>
                <div class="searchform">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
        <?php } ?>
        <div id="attachment">
            <?php ale_page_title(get_the_title($post->post_parent)) ?>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php ale_part('posthead');?>
            <header>
                <h3 style="text-align: center;"><?php the_title(); ?></h3>
            </header>
            <section class="full">
                <section class="story cf">
                    <p style="text-align: center;">
                        <a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'full' ); ?></a>
                    </p>
                    <?php the_content(); ?>
                    <footer>
                        <nav class="prev-next-links cf">
                            <span class="prev"><?php previous_image_link(false, __('Previous Image', 'aletheme')) ?></span> /
                            <span class="next"><?php next_image_link(false, __('Next Image', 'aletheme')) ?></span>
                        </nav>
                    </footer>
                </section>
            </section>

            <?php ale_part('postfooter');?>
            <?php endwhile; else: ?>
            <?php ale_part('notfound')?>
            <?php endif; ?>

        </div>
        <div class="smallsidebar">
            <?php get_sidebar('small'); ?>
        </div>
    </div>
    <div class="cf"></div>
</section>
<?php get_footer(); ?>