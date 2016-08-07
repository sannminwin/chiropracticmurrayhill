<figure class="imageformat">
    <a href="<?php the_permalink(); ?>">
        <?php echo get_the_post_thumbnail($post->ID, 'post-poster'); ?>
    </a>
    <figcaption>
           <span><?php _e('Image', 'aletheme')?></span>
    </figcaption>
</figure>