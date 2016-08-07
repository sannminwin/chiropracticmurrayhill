<?php
/**
 * Most Commented Widget
 */
class Aletheme_Mostcommented_Widget extends WP_Widget
{
    /**
     * General Setup
     */
    public function __construct() {

        /* Widget settings. */
        $widget_ops = array(
            'classname' => 'ale_mostcommented_widget',
            'description' => 'A widget that displays your most commented posts'
        );

        /* Widget control settings. */
        $control_ops = array(
            'width'		=> 300,
            'height'	=> 350,
            'id_base'	=> 'ale_mostcommented_widget'
        );

        /* Create the widget. */
        $this->WP_Widget( 'ale_mostcommented_widget', 'Aletheme Most Commented Posts', $widget_ops, $control_ops );
    }

    /**
     * Display Widget
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance )
    {
        extract( $args );

        $title = apply_filters('widget_title', $instance['title'] );

        /* Our variables from the widget settings. */
        $number = $instance['number'];

        /* Before widget (defined by themes). */
        echo $before_widget;

        // Display Widget
        ?>
    <?php /* Display the widget title if one was input (before and after defined by themes). */
        if ( $title )
            echo $before_title . $title . $after_title;
        ?>
    <div class="aletheme-mostcommented-widget">
        <ul class="cf">

            <?php
            $query = new WP_Query(array(
                'posts_per_page'		=> $number,
                'ignore_sticky_posts'	=> 1,
                'orderby'               => 'comment_count',
            ));
            ?>
            <?php global $post; if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
            <?php  if (get_the_post_thumbnail($post->ID)) :  ?>
						<li class="cf mostcommentedpost">
							<figure>
                                <a class="whitelink" href="<?php the_permalink(); ?>">
                                    <?php echo get_the_post_thumbnail($post->ID,'post-mostcommented') ?>
                                </a>
                                <figcaption>
                                    <a class="whitelink" href="<?php the_permalink(); ?>">
                                        <span class="title"><?php echo substr(get_the_title(), 0, 12)."..."; ?></span>
                                    </a>
                                    <span class="category"><?php the_category(', '); ?></span>
                                    <div class="commentnum">
                                        <?php printf(_n('One comment', '%1$s Comments', get_comments_number(), 'aletheme'), number_format_i18n(get_comments_number())); ?>
                                    </div>
                                </figcaption>
                        </figure>
                <?php else: ?>
					    <li class="cf no-thumb">
                        <figure>
                            &nbsp;
                            <figcaption>
                                <a class="whitelink" href="<?php the_permalink(); ?>">
                                    <span class="title"><?php echo substr(get_the_title(), 0, 12)."..."; ?></span>
                                </a>
                                <span class="category"><?php the_category(', '); ?></span>
                                <div class="commentnum">
                                    <?php printf(_n('One comment', '%1$s Comments', get_comments_number(), 'aletheme'), number_format_i18n(get_comments_number())); ?>
                                </div>
                            </figcaption>
                        </figure>
				<?php endif; ?>
						</li>
                    <?php endwhile; endif; ?>

            <?php wp_reset_query(); ?>

        </ul>

    </div><!--blog_widget-->

    <?php

        /* After widget (defined by themes). */
        echo $after_widget;
    }

    /**
     * Update Widget
     * @param array $new_instance
     * @param array $old_instance
     * @return array
     */
    public function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['number'] = strip_tags( $new_instance['number'] );

        return $instance;
    }

    /**
     * Widget Settings
     * @param array $instance
     */
    public function form( $instance )
    {
        //default widget settings.
        $defaults = array(
            'title' => __('Most Commented', 'aletheme'),
            'number' => 3
        );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'aletheme') ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Posts to show:', 'aletheme') ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
    </p>
    <?php
    }
}