<?php

/*
	CONTACT FORM WIDGET
*/

class Artbees_Widget_Contact_Form extends WP_Widget {

	function Artbees_Widget_Contact_Form() {
		$widget_ops = array( 'classname' => 'widget_contact_form', 'description' => 'Displays a email contact form.' );
		$this->WP_Widget( 'contact_form', THEME_SLUG.' - '.'Contact Form', $widget_ops );
	}



	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Contact Us' : $instance['title'], $instance, $this->id_base );
		$email= $instance['email'];
		
		$id = mt_rand(99,999);        
	    $tabindex_1 = $id;
	    $tabindex_2 = $id + 1;
	    $tabindex_3 = $id + 2;
	    $tabindex_4 = $id + 3;

		echo $before_widget;


		if ( $title )
			echo $before_title . $title . $after_title;

?>

	<form class="mk-contact-form" action="<?php echo THEME_DIR_URI; ?>/sendmail.php" method="post" novalidate="novalidate">

			<textarea data-watermark="<?php _e( 'Please be short and descriptive!', 'theme_frontend' ); ?>" required="required" id="contact_content" name="contact_content" class="textarea" tabindex="<?php echo $tabindex_1; ?>"></textarea>
			<input type="text" data-watermark="<?php _e( 'Name', 'theme_frontend' ); ?>" required="required" id="contact_name" name="contact_name" class="text-input" value="" tabindex="<?php echo $tabindex_2; ?>" />
			<input type="email" required="required" data-watermark="<?php _e( 'Email', 'theme_frontend' ); ?>" id="contact_email" name="contact_email" class="text-input" value="" tabindex="<?php echo $tabindex_3; ?>"  />
			<div class="mk-form-row-widget">
       		<button type="submit" class="contact-widget-button" tabindex="<?php echo $tabindex_4; ?>"><?php _e( 'Submit', 'theme_frontend' ); ?></button>
			<div class="mk-contact-loading"></div>
        	<div class="mk-contact-success-icon small-icon"></div>	
       		</div>
			<input type="hidden" value="<?php echo $email; ?>" name="contact_to"/>
		</form>
<?php


		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['email'] = $new_instance['email'];
		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$email = isset( $instance['email'] ) ? $instance['email'] : get_bloginfo( 'admin_email' );
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'email' ); ?>">Email:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo $email; ?>" /></p>


<?php

	}

}
/***************************************************/