<div class="recentgalleriesbox gallerygrid cf">
    <div class="galleriestitle">
        <?php _e('Wellcome', 'aletheme')?>
    </div>
    <div class="homecustomcontent">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php the_content(); ?>

        <?php endwhile; else: ?>
            <?php ale_part('notfound')?>
        <?php endif; ?>
    </div>
</div>