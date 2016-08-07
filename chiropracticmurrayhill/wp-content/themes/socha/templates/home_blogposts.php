<div class="recentgalleriesbox gallerygrid cf">
    <div class="galleriestitle">
        <?php _e('Recent Posts', 'aletheme')?>
    </div>
    <div id="galcontainer" class="blogpost recentgaleriesitems cf">
        <?php
        if(ale_get_meta('showcathome')) { $postscatshow = '&cat='.ale_get_meta('showcathome');} else {$postscatshow ='';}
        if(ale_get_meta('shownumpostshome')) { $postperpagenum = '&posts_per_page='.ale_get_meta('shownumpostshome');} else { $postperpagenum = '&posts_per_page=-1'; }
        query_posts('&post_type=post'.$postperpagenum.$postscatshow);
        if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="itemblog">
                <?php
                if (has_post_format('gallery')){

                    include 'blog_gallery.php';

                } elseif(has_post_format('image')) {

                    include 'blog_image.php';

                } elseif(has_post_format('quote')) {

                    include 'blog_quote.php';

                } elseif(has_post_format('video')) {

                    include 'blog_video.php';

                } else {

                    include 'blog_standart.php';

                } ?>
            </div>
        <?php endwhile; else: ?>
            <?php ale_part('notfound')?>
        <?php endif; ?>
    </div>
</div>