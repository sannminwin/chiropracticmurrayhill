<figure class="galleryformat">
    <div class="gallerypost">
        <ul class="slides">
            <?php
            $args = array(
                'post_type' => 'attachment',
                'numberposts' => -1,
                'post_status' => null,
                'order'				=> 'ASC',
                'orderby'			=> 'menu_order ID',
                'meta_query'		=> array(
                    array(
                        'key'		=> '_ale_hide_from_gallery',
                        'value'		=> 0,
                        'type'		=> 'DECIMAL',
                    ),
                ),
                'post_parent' => $post->ID
            );
            $attachments = get_posts( $args );
            if ( $attachments ) {
                foreach ( $attachments as $attachment ) {
                    echo "<li>".wp_get_attachment_image( $attachment->ID, 'post-flex' )."</li>";
                }
            }
            ?>
        </ul>
    </div>
<figcaption><span><?php _e('Gallery', 'aletheme')?></span></figcaption>
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