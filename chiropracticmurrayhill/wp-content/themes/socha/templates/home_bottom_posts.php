<div class="recentwork">
    <div class="boxtitle"><?php _e('Recent Work', 'aletheme')?></div>
    <div class="postbox">
        <?php
        $args = array( 'numberposts' => '1', 'post_status' => 'publish' );
        $recent_posts = wp_get_recent_posts( $args );
        foreach( $recent_posts as $recent ){
            echo '<figure><a href="' . get_permalink($recent["ID"]) . '">'.get_the_post_thumbnail($recent["ID"], 'post-tumba').'</a>
                                <figcaption><a href="' . get_permalink($recent["ID"]) . '"></a></figcaption>
                              </figure>';
            echo '<div class="whitebox"><div class="title"><a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' .substr($recent["post_title"], 0, 20).'...</a></div>';
            $categories = get_the_category( $recent["ID"] );
            echo '<div class="category">';
            foreach ($categories as $cat) {
                echo '<a href="'.get_category_link($cat->term_id ).'">'.$cat->cat_name.'</a> ';
            }
            echo '</div></div>';
        }
        ?>
    </div>
</div>
<div class="letsdiscus">
    <div class="boxtitle"><?php _e('Let\'s Discuss', 'aletheme')?></div>
    <div class="postbox">
        <?php
        $args = array( 'orderby' => 'comment_count', 'posts_per_page' => 1, 'ignore_sticky_posts' => 1, 'post_status' => 'publish' );
        $popular = new WP_Query($args); ?>
        <?php while ($popular->have_posts()) : $popular->the_post(); ?>
        <?php
        echo '<figure><a href="' . get_permalink($post->ID) . '">'.get_the_post_thumbnail($post->ID, 'post-tumba').'</a>
                                 <figcaption><a href="' . get_permalink($post->ID) . '"></a></figcaption>
                              </figure>';
        echo '<div class="whitebox"><div class="title"><a href="' . get_permalink($post->ID) . '" >' . substr(get_the_title($post->ID), 0, 20) .'...</a></div>';
        $categories = get_the_category( $post->ID );
        echo '<div class="category">';
        foreach ($categories as $cat) {
            echo '<a href="'.get_category_link($cat->term_id ).'">'.$cat->cat_name.'</a>';
        }
        echo '</div></div>';
        ?>
        <?php endwhile; ?>
    </div>
</div>
<div class="mostvoted">
    <div class="boxtitle"><?php _e('Most Voted Post', 'aletheme')?></div>
    <div class="postbox">
        <?php
        $args = array( 'meta_key' => 'votes_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'posts_per_page' => 1, 'ignore_sticky_posts' => 1, 'post_status' => 'publish' );
        $mostliked = new WP_Query($args); ?>
        <?php while ($mostliked->have_posts()) : $mostliked->the_post(); ?>
        <?php
        echo '<figure><a href="' . get_permalink($post->ID) . '">'.get_the_post_thumbnail($post->ID, 'post-tumba').'</a>
                                 <figcaption><a href="' . get_permalink($post->ID) . '"></a></figcaption>
                              </figure>';
        echo '<div class="whitebox"><div class="title"><a href="' . get_permalink($post->ID) . '" >' . substr(get_the_title($post->ID), 0, 20) .'...</a></div>';
        $categories = get_the_category( $post->ID );
        echo '<div class="category">';
        foreach ($categories as $cat) {
            echo '<a href="'.get_category_link($cat->term_id ).'">'.$cat->cat_name.'</a>';
        }
        echo '</div></div>';
        ?>
        <?php endwhile; ?>
    </div>
</div>