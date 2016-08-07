<?php

/*
	FLICKR WIDGET
*/
class Artbees_Widget_Flickr_feeds extends WP_Widget {

	function Artbees_Widget_Flickr_feeds() {
		$widget_ops = array( 'classname' => 'widget_flickr', 'description' => 'Displays photos from a Flickr ID' );
		$this->WP_Widget( 'flickr', THEME_SLUG.' - '.'Flickr', $widget_ops );
		if ( is_active_widget( false, false, $this->id_base ) ) {
			add_action( 'wp_enqueue_scripts', array( &$this, 'add_slide_script' ) );
		}

	}

	function add_slide_script() {
		wp_enqueue_script( 'jquery-photostream' );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Photos on flickr' : $instance['title'], $instance, $this->id_base );
		$flickr_id = $instance['flickr_id'];
		$count = (int)$instance['count'];

		if ( $count < 1 ) {
			$count = 1;
		}

		if ( !empty( $flickr_id ) ) {
			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;

	$id = mt_rand(99, 999);			
?>


	<script type="text/javascript">


		jQuery(document).ready(function(){

		  jQuery("#flickr_feed_<?php echo $id; ?>").photostream_widget({
		  	user: "<?php echo $flickr_id; ?>",
		  	limit:<?php echo $count; ?>,
		  	social_network: "flickr"
		  });


		})
		</script>

		<div id="flickr_feed_<?php echo $id; ?>" class="flickr-widget-wrapper">
		
		</div>
		<div class="clearboth"></div>
		<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickr_id'] = strip_tags( $new_instance['flickr_id'] );
		$instance['count'] = (int) $new_instance['count'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$flickr_id = isset( $instance['flickr_id'] ) ? esc_attr( $instance['flickr_id'] ) : '';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 3;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title :</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'flickr_id' ); ?>">Flickr User id : (<a href="http://idgettr.com/" target="_blank">Get Your ID</a>)</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'flickr_id' ); ?>" name="<?php echo $this->get_field_name( 'flickr_id' ); ?>" type="text" value="<?php echo $flickr_id; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'count' ); ?>">Number of photo to show :</label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>

<?php
	}
}
/***************************************************/