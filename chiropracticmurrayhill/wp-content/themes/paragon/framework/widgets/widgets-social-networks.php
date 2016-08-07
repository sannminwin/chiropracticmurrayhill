<?php

/*
	SOCIAL NETWORKS ICON
*/
class Artbees_Widget_Social extends WP_Widget {

	var $sites = array(
'px',
'aim-alt',
'aim',
'amazon',
'android',
'app-stote',
'apple',
'arto',
'badoo',
'bandcamp',
'basecamp',
'bebo',
'behance',
'bing',
'blip',
'blogger',
'boxnet',
'brightkite',
'cinch',
'coroflot',
'dailybooth',
'dailyburn',
'dailymile',
'delicious',
'designbump',
'designfloat',
'designmoo',
'deviantart',
'digg-alt',
'digg',
'diigo',
'dribbble',
'dropbox',
'drupal',
'dzone',
'ebay',
'ember',
'envato',
'etsy',
'evernote',
'facebook-places',
'facebook',
'facto-me',
'feedburner',
'flickr',
'folkd',
'formspring',
'forrst',
'fotolog',
'foursquare',
'freshbooks',
'friendfeed',
'friendster',
'gdgt',
'gimmebar',
'github_alt',
'github',
'goodreads',
'google-buzz',
'google-talk',
'google',
'googleplay',
'google-plus',
'gowalla',
'grooveshark',
'hackernews',
'hi5',
'hypemachine',
'hyves',
'icloud',
'icq',
'identica',
'instapaper',
'itunes',
'kik',
'krop',
'last-fm',
'linkedin',
'live-journal',
'lovedsgn',
'meetup',
'metacafe',
'mixx-alt',
'mixx',
'myspace_alt',
'myspace',
'newsvine',
'ning',
'officialfm',
'openid',
'orkut',
'path',
'paypal',
'photobucket',
'picassa',
'pinboard',
'pinterest',
'playstation',
'plixi',
'plurk',
'podcast',
'posterous',
'purevolume',
'quik',
'quora',
'rdio',
'readernaut',
'reddit',
'retweet',
'rss',
'scribd',
'sharethis',
'simplenote',
'skype',
'slashdot',
'slideshare',
'smugmug',
'soundcloud',
'spotify',
'squarespace',
'squidoo',
'steam',
'stumble-upon',
'technorati',
'thefancy',
'tribe',
'tripit',
'tumblr',
'twitter-alt',
'twitter',
'vcard',
'viddler',
'vimeo',
'virb',
'w3',
'whatsapp',
'wikipedia',
'windows',
'wists',
'wp-alt',
'wordpress',
'yahoo-buzz',
'yahoo',
'yelp',
'youtube',
'zerply',
'zynga',
'youtube-alt',
'ymessanger',
	);
	var $size = array(

		'large' => array(
			'name'=>'Large',
			'path'=>'large',
		),

		'medium' => array(
			'name'=>'Medium',
			'path'=>'medium',
		),

		'small' => array(
			'name'=>'Small',
			'path'=>'small',
		),



	);


	function Artbees_Widget_Social() {
		$widget_ops = array( 'classname' => 'widget_social_networks', 'description' => 'Displays a list of Social Icon icons' );
		$this->WP_Widget( 'social', THEME_SLUG.' - '.'Social Networks', $widget_ops );

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
		$alt = isset( $instance['alt'] )?$instance['alt']:'';
		$size = $instance['size'];
		$custom_count = $instance['custom_count'];

		$output ='';
		if ( !empty( $instance['enable_sites'] ) ) {
			foreach ( $instance['enable_sites'] as $site ) {
				$path = $this->size[$size]['path'];
				$link = isset( $instance[strtolower( $site )] )?$instance[strtolower( $site )]:'#';
					$output .= '<a href="'.$link.'" rel="nofollow" class="mk-'.$site.' builtin-icons" target="_blank" alt="'.$alt.' '.$site.'" title="'.$alt.' '.$site.'"><i class="'.$path.' mk-social-'.$site.'"></i></a>';
	
			}
		}
		if ( $custom_count > 0 ) {
			for ( $i=1; $i<= $custom_count; $i++ ) {
				$name = isset( $instance['custom_'.$i.'_name'] )?$instance['custom_'.$i.'_name']:'';
				$icon = isset( $instance['custom_'.$i.'_icon'] )?$instance['custom_'.$i.'_icon']:'';
				$link = isset( $instance['custom_'.$i.'_url'] )?$instance['custom_'.$i.'_url']:'#';
				if ( !empty( $icon ) ) {
					$output .= '<a href="'.$link.'" rel="nofollow" target="_blank"><img src="'.$icon.'" alt="'.$alt.' '.$name.'" title="'.$alt.' '.$name.'"/></a>';
				}
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
		$instance['alt'] = strip_tags( $new_instance['alt'] );
		$instance['size'] = strip_tags( $new_instance['size'] );
		$instance['enable_sites'] = $new_instance['enable_sites'];
		$instance['custom_count'] = (int) $new_instance['custom_count'];
		if ( !empty( $instance['enable_sites'] ) ) {
			foreach ( $instance['enable_sites'] as $site ) {
				$instance[strtolower( $site )] = isset( $new_instance[strtolower( $site )] )?strip_tags( $new_instance[strtolower( $site )] ):'';
			}
		}
		for ( $i=1;$i<=$instance['custom_count'];$i++ ) {
			$instance['custom_'.$i.'_name'] = strip_tags( $new_instance['custom_'.$i.'_name'] );
			$instance['custom_'.$i.'_url'] = strip_tags( $new_instance['custom_'.$i.'_url'] );
			$instance['custom_'.$i.'_icon'] = strip_tags( $new_instance['custom_'.$i.'_icon'] );
		}
		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$alt = isset( $instance['alt'] ) ? esc_attr( $instance['alt'] ) : 'Follow Us on';
		$size = isset( $instance['size'] ) ? $instance['size'] : '';
		$enable_sites = isset( $instance['enable_sites'] ) ? $instance['enable_sites'] : array();
		foreach ( $this->sites as $site ) {
			$$site = isset( $instance[strtolower( $site )] ) ? esc_attr( $instance[strtolower( $site )] ) : '';
		}
		$custom_count = isset( $instance['custom_count'] ) ? absint( $instance['custom_count'] ) : 0;
		for ( $i=1;$i<=10;$i++ ) {
			$custom_name = 'custom_'.$i.'_name';
			$$custom_name = isset( $instance[$custom_name] ) ? $instance[$custom_name] : '';
			$custom_url = 'custom_'.$i.'_url';
			$$custom_url = isset( $instance[$custom_url] ) ? $instance[$custom_url] : '';
			$custom_icon = 'custom_'.$i.'_icon';
			$$custom_icon = isset( $instance[$custom_icon] ) ? $instance[$custom_icon] : '';
		}

		
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'alt' ); ?>">Icon Alt Title:</label> <input class="widefat" id="<?php echo $this->get_field_id( 'alt' ); ?>" name="<?php echo $this->get_field_name( 'alt' ); ?>" type="text" value="<?php echo $alt; ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id( 'size' ); ?>">Color:</label>
			<select name="<?php echo $this->get_field_name( 'size' ); ?>" id="<?php echo $this->get_field_id( 'size' ); ?>" class="widefat">
				<?php foreach ( $this->size as $name => $value ):?>
				<option value="<?php echo $name;?>"<?php selected( $size, $name );?>><?php echo $value['name'];?></option>
				<?php endforeach;?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'enable_sites' ); ?>">Enable Social Icon:</label>
			<select name="<?php echo $this->get_field_name( 'enable_sites' ); ?>[]" style="height:10em" id="<?php echo $this->get_field_id( 'enable_sites' ); ?>" class="social_icon_select_sites widefat" multiple="multiple">
				<?php foreach ( $this->sites as $site ):?>
				<option value="<?php echo strtolower( $site );?>"<?php echo in_array( strtolower( $site ), $enable_sites )? 'selected="selected"':'';?>><?php echo $site;?></option>
				<?php endforeach;?>
			</select>
		</p>

		<p>
			<em><?php "Note: Please input FULL URL <br/>(e.g. <code>http://www.facebook.com/username</code>)";?></em>
		</p>
		<div class="social_icon_wrap">
		<?php foreach ( $this->sites as $site ):?>
		<p class="social_icon_<?php echo strtolower( $site );?>" <?php if ( !in_array( strtolower( $site ), $enable_sites ) ):?>style="display:none"<?php endif;?>>
			<label for="<?php echo $this->get_field_id( strtolower( $site ) ); ?>"><?php echo $site.' '.'URL:'?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( strtolower( $site ) ); ?>" name="<?php echo $this->get_field_name( strtolower( $site ) ); ?>" type="text" value="<?php echo $$site; ?>" />
		</p>
		<?php endforeach;?>
		</div>

		<p><label for="<?php echo $this->get_field_id( 'custom_count' ); ?>">How many custom icons to add?</label>
		<input id="<?php echo $this->get_field_id( 'custom_count' ); ?>" class="social_icon_custom_count" name="<?php echo $this->get_field_name( 'custom_count' ); ?>" type="text" value="<?php echo $custom_count; ?>" size="3" /></p>

		<div class="social_custom_icon_wrap">
		<?php for ( $i=1;$i<=10;$i++ ): $custom_name='custom_'.$i.'_name';$custom_url='custom_'.$i.'_url'; $custom_icon='custom_'.$i.'_icon'; ?>
			<div class="social_icon_custom_<?php echo $i;?>" <?php if ( $i>$custom_count ):?>style="display:none"<?php endif;?>>
				<p><label for="<?php echo $this->get_field_id( $custom_name ); ?>"><?php printf( 'Custom %s Name:', $i );?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $custom_name ); ?>" name="<?php echo $this->get_field_name( $custom_name ); ?>" type="text" value="<?php echo $$custom_name; ?>" /></p>
				<p><label for="<?php echo $this->get_field_id( $custom_url ); ?>"><?php printf( 'Custom %s URL:', $i );?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $custom_url ); ?>" name="<?php echo $this->get_field_name( $custom_url ); ?>" type="text" value="<?php echo $$custom_url; ?>" /></p>
				<p><label for="<?php echo $this->get_field_id( $custom_icon ); ?>"><?php printf( 'Custom %s Icon:', $i );?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $custom_icon ); ?>" name="<?php echo $this->get_field_name( $custom_icon ); ?>" type="text" value="<?php echo $$custom_icon; ?>" /></p>
			</div>

		<?php endfor;?>
		</div>

		

<?php

	}
}
/***************************************************/
