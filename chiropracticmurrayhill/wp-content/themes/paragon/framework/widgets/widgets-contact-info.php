<?php 
/*
	CONTACT INFORMATION WIDGET
*/
class Artbees_Widget_Contact_Info extends WP_Widget {

	function Artbees_Widget_Contact_Info() {
		$widget_ops = array( 'classname' => 'widget_contact_info', 'description' => 'Displays a list of contact info.' );
		$this->WP_Widget( 'contact_info', THEME_SLUG.' - '. 'Contact Info', $widget_ops );

	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$name = $instance['name'];
		$phone = $instance['phone'];
		$cellphone = $instance['cellphone'];
		$email= $instance['email'];
		$general_address = $instance['general_address'];
		$work_address = $instance['work_address'];
		$home_address = $instance['home_address'];
		$skype = $instance['skype'];
		$gtalk = $instance['gtalk'];
		$yahoo = $instance['yahoo'];
		$instagram = $instance['instagram'];



		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

?>
			<ul>

			<?php if ( !empty( $name ) ):?><li class="mk-icon-list"><i class="mk-icon-user"></i><?php echo $name;?></li><?php endif;?>
			<?php if ( !empty( $phone ) ):?><li class="mk-icon-list"><i class="mk-icon-phone"></i><?php echo $phone;?></li><?php endif;?>
			<?php if ( !empty( $cellphone ) ):?><li class="mk-icon-list"><i class="mk-icon-mobile"></i><?php echo $cellphone;?></li><?php endif;?>
			<?php if ( !empty( $email ) ):?><li class="mk-icon-list"><i class="mk-icon-message"></i><?php echo $email;?></li><?php endif;?>
			<?php if ( !empty( $general_address ) ):?><li class="mk-icon-list"><i class="mk-icon-pin"></i><?php echo $general_address;?></li><?php endif;?>
			<?php if ( !empty( $work_address ) ):?><li class="mk-icon-list"><i class="mk-icon-suitcase"></i><?php echo $work_address;?></li><?php endif;?>
			<?php if ( !empty( $home_address ) ):?><li class="mk-icon-list"><i class="mk-icon-home"></i><?php echo $home_address;?></li><?php endif;?>
			<?php if ( !empty( $skype ) ):?><li class="mk-icon-list"><i class="mk-icon-balloon"></i><?php echo $skype;?></li><?php endif;?>
			<?php if ( !empty( $gtalk ) ):?><li class="mk-icon-list"><i class="mk-icon-balloon"></i><?php echo $gtalk;?></li><?php endif;?>
			<?php if ( !empty( $yahoo ) ):?><li class="mk-icon-list"><i class="mk-icon-balloon"></i><?php echo $yahoo;?></li><?php endif;?>
			<?php if ( !empty( $instagram ) ):?><li class="mk-icon-list"><i class="mk-icon-camera"></i><?php echo $instagram;?></li><?php endif;?>
			
			</ul>
		<?php
		echo $after_widget; 

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['phone'] = strip_tags( $new_instance['phone'] );
		$instance['cellphone'] = strip_tags( $new_instance['cellphone'] );
		$instance['email'] = strip_tags( $new_instance['email'] );
		$instance['general_address'] = strip_tags( $new_instance['general_address'] );
		$instance['work_address'] = strip_tags( $new_instance['work_address'] );
		$instance['home_address'] = strip_tags( $new_instance['home_address'] );
		$instance['skype'] = strip_tags( $new_instance['skype'] );
		$instance['gtalk'] = strip_tags( $new_instance['gtalk'] );
		$instance['yahoo'] = strip_tags( $new_instance['yahoo'] );
		$instance['instagram'] = strip_tags( $new_instance['instagram'] );


		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$name = isset( $instance['name'] ) ? esc_attr( $instance['name'] ) : '';
		$phone = isset( $instance['phone'] ) ? esc_attr( $instance['phone'] ) : '';
		$cellphone = isset( $instance['cellphone'] ) ? esc_attr( $instance['cellphone'] ) : '';
		$email = isset( $instance['email'] ) ? esc_attr( $instance['email'] ) : '';
		$general_address = isset( $instance['general_address'] ) ? esc_attr( $instance['general_address'] ) : '';
		$work_address = isset( $instance['work_address'] ) ? esc_attr( $instance['work_address'] ) : '';
		$home_address = isset( $instance['home_address'] ) ? esc_attr( $instance['home_address'] ) : '';
		$skype = isset( $instance['skype'] ) ? esc_attr( $instance['skype'] ) : '';
		$gtalk = isset( $instance['gtalk'] ) ? esc_attr( $instance['gtalk'] ) : '';
		$yahoo = isset( $instance['yahoo'] ) ? esc_attr( $instance['yahoo'] ) : '';
		$instagram = isset( $instance['instagram'] ) ? esc_attr( $instance['instagram'] ) : '';

?>












		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'name' ); ?>">Name:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo $name; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'phone' ); ?>">Phone:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo $phone; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'cellphone' ); ?>">Cell phone:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'cellphone' ); ?>" name="<?php echo $this->get_field_name( 'cellphone' ); ?>" type="text" value="<?php echo $cellphone; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'email' ); ?>">Email:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo $email; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'general_address' ); ?>">Genral Address:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'general_address' ); ?>" name="<?php echo $this->get_field_name( 'general_address' ); ?>" type="text" value="<?php echo $general_address; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'work_address' ); ?>">Office Address:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'work_address' ); ?>" name="<?php echo $this->get_field_name( 'work_address' ); ?>" type="text" value="<?php echo $work_address; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'home_address' ); ?>">Home Address:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'home_address' ); ?>" name="<?php echo $this->get_field_name( 'home_address' ); ?>" type="text" value="<?php echo $home_address; ?>" /></p>


		<p><label for="<?php echo $this->get_field_id( 'skype' ); ?>">Skype Username:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'skype' ); ?>" name="<?php echo $this->get_field_name( 'skype' ); ?>" type="text" value="<?php echo $skype; ?>" /></p>


		<p><label for="<?php echo $this->get_field_id( 'gtalk' ); ?>">Google talk Username:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'gtalk' ); ?>" name="<?php echo $this->get_field_name( 'gtalk' ); ?>" type="text" value="<?php echo $gtalk; ?>" /></p>


		<p><label for="<?php echo $this->get_field_id( 'yahoo' ); ?>">Yahoo Username:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'yahoo' ); ?>" name="<?php echo $this->get_field_name( 'yahoo' ); ?>" type="text" value="<?php echo $yahoo; ?>" /></p>


		<p><label for="<?php echo $this->get_field_id( 'instagram' ); ?>">Instagram Username:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" type="text" value="<?php echo $instagram; ?>" /></p>



		

<?php
	}

}
/***************************************************/