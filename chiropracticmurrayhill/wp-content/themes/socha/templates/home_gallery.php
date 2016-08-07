<div class="recentgalleriesbox gallerygrid cf">
    <div class="galleriestitle">
        <?php _e('Recent Galleries', 'aletheme')?>
    </div>
    <div id="galcontainerhome" class="recentgaleriesitems cf">
        <?php
        if(ale_get_meta('showcathome')) {
            $termname = get_term(ale_get_meta('showcathome'),'gallery-category');
            $postscatshow = '&gallery-category='.$termname->name;} else {$postscatshow ='';}
        if(ale_get_meta('shownumpostshome')) { $postperpagenum = '&posts_per_page='.ale_get_meta('shownumpostshome');} else { $postperpagenum = '&posts_per_page=-1'; }
        query_posts('&post_type=gallery'.$postperpagenum.$postscatshow);
        if (have_posts()) : while (have_posts()) : the_post(); ?>

            <div class="element">

                <figure>
                    <a href="<?php the_permalink(); ?>">
                        <?php echo get_the_post_thumbnail($post->ID,'gallery-three'); ?>
                    </a>
                    <div class="titlegalleryfilter cf">
                        <div class="lefticon"></div>
                        <div class="titleitem">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        </div>
                    </div>
                    <figcaption>
                        <a href="<?php the_permalink(); ?>"><span>Show Images</span></a>
                    </figcaption>
                </figure>

            </div>

            <?php endwhile; else: ?>
            <?php ale_part('notfound')?>
            <?php endif; ?>
    </div>
</div>