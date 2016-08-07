<?php

/*
	SOCIAL NETWORKS ICON
*/
class Artbees_Widget_big_numbers extends WP_Widget {

	var $sites = array(
		'facebook',
		'twitter',
		'dribbble',
	);



	function Artbees_Widget_big_numbers() {
		$widget_ops = array( 'classname' => 'widget_big_numbers', 'description' => 'Displays Your social Networks Presence in sense of numbers of follower or subscribers' );
		$this->WP_Widget( 'big_numbers', THEME_SLUG.' - '.'Big Numbers', $widget_ops );

		if ( 'widgets.php' == basename( $_SERVER['PHP_SELF'] ) ) {
			add_action( 'admin_print_scripts', array( &$this, 'add_admin_script' ) );
		}
	}

	function add_admin_script() {
		wp_enqueue_script( 'social-icon-widget', THEME_ADMIN_ASSETS_URI . '/js/social-icon-widget.js', array( 'jquery' ) );
	}


	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$output ='';
		if ( !empty( $instance['enable_sites'] ) ) {
			foreach ( $instance['enable_sites'] as $site ) {

		$username = isset( $instance[strtolower( $site )] )?$instance[strtolower( $site )]:'#';
				

		switch($site) {
		
			case "facebook" :			
			$output_number = mk_facebook_api_connect($username, "likes");
			$url = "http://facebook.com/".$username;
			break;

			case "twitter" :			
			$output_number = mk_twitter_api_connect($username, "followers_count");
			$url = "http://twitter.com/".$username;
			break;

			case "dribbble" :			
			$output_number = mk_dribbble_api_connect($username, "followers_count");
			$url = "http://dribbble.com/".$username;
			break;

		}

		$output .= '<a href="'.$url.'" rel="nofollow" class="big-numbers-item big-numbers-'.$site.'" target="_blank">
					<span class="big-numbers-icon"><i class="mk-social-'.$site.'"></i></span>
					<span class="big-numbers-count">';

		$output .=	$output_number;

		$output .= '</span></a>';

			
			}

			
		}

		if ( !empty( $output ) ) {
			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;
				echo $output;
				echo $after_widget;

		}
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['enable_sites'] = $new_instance['enable_sites'];

		if ( !empty( $instance['enable_sites'] ) ) {
			foreach ( $instance['enable_sites'] as $site ) {
				$instance[strtolower( $site )] = isset( $new_instance[strtolower( $site )] )?strip_tags( $new_instance[strtolower( $site )] ):'';
			}
		}
		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		
		$enable_sites = isset( $instance['enable_sites'] ) ? $instance['enable_sites'] : array();
		foreach ( $this->sites as $site ) {
			$$site = isset( $instance[strtolower( $site )] ) ? esc_attr( $instance[strtolower( $site )] ) : '';
		}

?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'enable_sites' ); ?>">Enable Networks:</label>
			<select name="<?php echo $this->get_field_name( 'enable_sites' ); ?>[]" style="height:8em" id="<?php echo $this->get_field_id( 'enable_sites' ); ?>" class="social_icon_select_sites widefat" multiple="multiple">
				<?php foreach ( $this->sites as $site ):?>
				<option value="<?php echo strtolower( $site );?>"<?php echo in_array( strtolower( $site ), $enable_sites )? 'selected="selected"':'';?>><?php echo $site;?></option>
				<?php endforeach;?>
			</select>
		</p>

		<div class="social_icon_wrap">
		<?php foreach ( $this->sites as $site ):?>
		<p class="social_icon_<?php echo strtolower( $site );?>" <?php if ( !in_array( strtolower( $site ), $enable_sites ) ):?>style="display:none"<?php endif;?>>
			<label for="<?php echo $this->get_field_id( strtolower( $site ) ); ?>"><?php echo $site.' '.'Username:'?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( strtolower( $site ) ); ?>" name="<?php echo $this->get_field_name( strtolower( $site ) ); ?>" type="text" value="<?php echo $$site; ?>" />
		</p>
		<?php endforeach;?>
		</div>
		<p>
			Note: Numbers are being cached and flush every 60 minutes.
		</p>


<?php

	}
}
/***************************************************/
