<?php

/*
	TWITTER WIDGET
*/

class Artbees_Widget_Twitter extends WP_Widget {

	function Artbees_Widget_Twitter() {
		$widget_ops = array( 'classname' => 'widget_twitter', 'description' => 'Displays a list of twitter feeds' );
		$this->WP_Widget( 'twitter', THEME_SLUG.' - '.'Twitter Feeds', $widget_ops );

		if ( is_active_widget( false, false, $this->id_base ) ) {
			add_action( 'wp_print_scripts', array( &$this, 'add_tweet_script' ) );
		}

	}

	function add_tweet_script() {
		wp_enqueue_script( 'jquery-tweet' );
		wp_enqueue_script( 'jquery-flexslider' );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = $instance['title'];
		$username = $instance['username'];
		$count = isset( $instance['count'] ) ? (int)$instance['count'] : 1;

		if ( $count < 1 ) {
			$count = 1;
		}
		if ( $count > 30 ) {
			$count = 30;
		}


		if ( !empty( $username ) ) {
			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;

			$id = rand( 1, 1000 );

?>
	<div class="tweet-widget-flexslider mk-flexslider" id="twitter_wrap_<?php echo $id; ?>">


	</div>

	<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery("#twitter_wrap_<?php echo $id; ?>").tweet({
		username: "<?php echo $username; ?>",
		count: <?php echo $count; ?>,
		template: '{text}{join}{time}'
	});

jQuery(window).on('load',function () {
	jQuery('.tweet-widget-flexslider').flexslider({
		selector: ".mk-flex-slides > li",
		animation: "fade",              //String: Select your animation type, "fade" or "slide"
		smoothHeight: true,            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
		slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
		animationSpeed: 600,            //Integer: Set the speed of animations, in milliseconds
		pauseOnHover: true,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
		controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
		prevText: "",           //String: Set the text for the "previous" directionNav item
		nextText: ""               //String: Set the text for the "next" directionNav item
	});
});
});
</script>

	<div class="clearboth"></div>

		<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['count'] = (int) $new_instance['count'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$username = isset( $instance['username'] ) ? esc_attr( $instance['username'] ) : '';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 1;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'username' ); ?>">Username:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo $username; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'count' ); ?>">Count</label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>
<?php

	}
}
/***************************************************/
