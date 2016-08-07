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
        <div id="post" class="content">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="post post-<?php echo $post->ID; ?> press type-press status-publish hentry" id="post-<?php echo $post->ID; ?>" data-post-id="<?php echo $post->ID; ?>">
                <header class="page-title"><h2 class="a"><?php the_title(); ?></h2></header>
                <section class="full">
                    <?php ale_part('postcontent');?>
                    <?php if(ale_get_option('commentonpress') == 1){ comments_template(); } ?>
                </section>
            </article>
            <?php endwhile; else: ?>
            <?php ale_part('notfound')?>
            <?php endif; ?>

        </div>
    </div>
    <div class="cf"></div>
</section>
<?php get_footer(); ?>