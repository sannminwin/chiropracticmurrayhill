<?php

/*
	TESTIMONIAL WIDGET
*/

class Artbees_Widget_Testimonials extends WP_Widget {

	function Artbees_Widget_Testimonials() {
		$widget_ops = array( 'classname' => 'widget_testimonials', 'description' => 'Displays a testimonail slider.' );
		$this->WP_Widget( 'testimonial_widget', THEME_SLUG.' - '.'Testimonial', $widget_ops );

		if ( is_active_widget( false, false, $this->id_base ) ) {
			add_action( 'wp_enqueue_scripts', array( &$this, 'add_slide_script' ) );
		}

	}

	function add_slide_script() {
		wp_enqueue_script( 'jquery-flexslider' );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Testimonial' : $instance['title'], $instance, $this->id_base );
		$count = (int)$instance["count"];
		$random = rand( 0, 999999 );
		$output = '<div class="testimonial-slider mk-flexslider" id="testimonial_slider_' . $random . '"><ul class="mk-flex-slides">';
		if ( $count > 0 ) {

			for ( $i=1; $i<=$count; $i++ ) {
				$quote =  isset( $instance["quote_".$i] ) ? $instance["quote_".$i] : '';
				$company =  isset( $instance["company_".$i] ) ? $instance["company_".$i]:'';
				$url =  isset( $instance["url_".$i] ) ? $instance["url_".$i]:'';

				$output .= '<li><div class="testimonial-quote"><div class="testimonial-triangle"></div><span>' . $quote . '</span></div><a class="testimonial-author" href="' . $url .'">' . $company  . '</a></li>';

			}
		}

		$output .= "</ul></div>";

		if ( !empty( $output ) ) {
			echo $before_widget;

?>

<script type="text/javascript">

		jQuery(document).ready(function() {
			
		jQuery('.testimonial-slider').flexslider({
			selector: ".mk-flex-slides > li",
			animation: "fade",              //String: Select your animation type, "fade" or "slide"
			smoothHeight: true,            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
			slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
			animationSpeed: 600,            //Integer: Set the speed of animations, in milliseconds
			pauseOnHover: true,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
			controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
			prevText: "",           //String: Set the text for the "previous" directionNav item
			nextText: ""              //String: Set the text for the "next" directionNav item
	});

		});
</script>
            <?php

			if ( $title )
				echo $before_title . $title . $after_title;

			echo $output;
			echo $after_widget;

		}

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['count'] = (int)$new_instance['count'];
		for ( $i=1;$i<=$instance['count'];$i++ ) {
			$instance["quote_".$i] = isset( $new_instance['quote_'.$i] ) ? strip_tags( $new_instance['quote_'.$i] ) : ' ';
			$instance["company_".$i] =  isset( $new_instance['company_'.$i] ) ? strip_tags( $new_instance['company_'.$i] ) : '';
			$instance["url_".$i] = isset( $new_instance['url_'.$i] ) ? strip_tags( $new_instance['url_'.$i] ) : '';
		}

		return $instance;
	}


	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 3;
		for ( $i=1;$i<=10;$i++ ) {


			$quote = 'quote_'.$i;
			$$quote = isset( $instance[$quote] ) ? $instance[$quote] : '';
			$company = 'company_'.$i;
			$$company = isset( $instance[$company] ) ? $instance[$company] : '';
			$url = 'url_'.$i;
			$$url = isset( $instance[$url] ) ? $instance[$url] : '';
		}


?>

		<p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        	<p><label for="<?php echo $this->get_field_id( 'count' ); ?>">Number of Testimonials</label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>"  name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>


<div class="testimonail_wrap">
<?php for ( $i=1;$i<=10;$i++ ): $quote = 'quote_'.$i; $company = 'company_'.$i; $url = 'url_'.$i; ?>
<div class="testimonial_<?php echo $i;?>" <?php if ( $i>$count ):?>style="display:none;"<?php endif;?> style="padding-bottom:30px">


<p>
<label for="<?php echo $this->get_field_id( $quote ); ?>"><?php printf( '#%s Quote:', $i );?></label>
<textarea style="width:98%" rows="6" id="<?php echo $this->get_field_id( $quote ); ?>" name="<?php echo $this->get_field_name( $quote ); ?>" ><?php echo $$quote; ?></textarea>
</p>

<p>
<label for="<?php echo $this->get_field_id( $company ); ?>"><?php printf( '#%s Company:', $i );?></label>
<input class="widefat" id="<?php echo $this->get_field_id( $company ); ?>" name="<?php echo $this->get_field_name( $company ); ?>" type="text" value="<?php echo $$company; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( $url ); ?>"><?php printf( '#%s URL:', $i );?></label>
<input class="widefat" id="<?php echo $this->get_field_id( $url ); ?>" name="<?php echo $this->get_field_name( $url ); ?>" type="text" value="<?php echo $$url; ?>" />
</p>
			</div>

		<?php endfor;?>
		</div>



	<?php
	}
}
/***************************************************/
