<?php get_header(); ?>
<section class="singlepage">
    <div class="leftside">
        <?php get_sidebar('mainmenu'); ?>
    </div>
    <div class="rightside">
        <div class="pagelayout cf">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php ale_part('pagehead');?>
            <section class="story cf">
                <?php the_content();?>
            </section>
            <?php endwhile; else: ?>
            <?php ale_part('notfound')?>
            <?php endif; ?>
        </div>
    </div>
    <div class="cf"></div>
</section>
<?php get_footer(); ?>