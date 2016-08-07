<style>
    .recentwork:first-child{
        margin-left: 18px!important;
    }
    .recentwork:last-child{
        margin-right: 0px!important;
    }
    .recentwork {
        margin: 0!important;
        margin-right: 35px!important;
    }

</style>

<div>
<?php
    $args = array( 'orderby' => 'comment_count', 'posts_per_page' => 3, 'ignore_sticky_posts' => 1, 'post_status' => 'publish' );
    $popular = new WP_Query($args); ?>
<?php while ($popular->have_posts()) : $popular->the_post(); ?>
    <div class="recentwork">
        <div class="boxtitle"><?php _e('Recent Work', 'aletheme')?></div>
        <div class="postbox">
            <figure><a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail($post->ID, 'post-tumba'); ?></a>
                <figcaption><a href="<?php the_permalink(); ?>"></a></figcaption>
            </figure>
            <div class="whitebox"><div class="title"><a href="<?php the_permalink(); ?>" ><?php echo substr(get_the_title($post->ID), 0, 20); ?></a></div>
                <div class="category">
                    <?php the_category(', '); ?>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>
</div>