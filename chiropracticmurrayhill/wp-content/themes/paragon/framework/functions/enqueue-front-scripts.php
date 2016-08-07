<?php
function theme_enqueue_scripts() {
	if(!is_admin()){
		$move_bottom = true;


		
		wp_enqueue_script( 'jquery-colorbox', THEME_JS .'/jquery.colorbox-min.js', array('jquery'), false, $move_bottom);


		/* Register Scripts */
		wp_register_script( 'jquery-isotope', THEME_JS .'/jquery.isotope.min.js', array('jquery'), false, $move_bottom);
		wp_register_script( 'jquery-tweet', THEME_JS .'/jquery.tweet.js', array('jquery'), false, $move_bottom);
		wp_enqueue_script( 'jquery-flexslider', THEME_JS .'/jquery.flexslider.min.js', array('jquery'), false, $move_bottom);
		wp_register_script( 'jquery-photostream', THEME_JS .'/jquery.photostream.js', array('jquery'), false, $move_bottom);
		wp_register_script( 'jquery-tools', THEME_JS .'/jquery.tabs.tools.min.js', array('jquery'), false, $move_bottom);
		wp_register_script( 'jquery-jplayer', THEME_JS .'/jquery.jplayer.min.js', array('jquery'), false, $move_bottom);
		wp_register_script( 'infinitescroll', THEME_JS .'/jquery.infinitescroll.min.js', array('jquery'), false, $move_bottom);
		wp_register_script('layerslider_js', THEME_PLUGINS_URI. '/layerslider/js/layerslider.kreaturamedia.jquery.js', array('jquery'), '3.5.0' );
		wp_register_style('layerslider_css', THEME_PLUGINS_URI. '/layerslider/css/layerslider.css', array(), '3.5.0' );
		

		wp_register_script('themepunch_revolution', THEME_PLUGINS_URI. '/revslider/rs-plugin/js/jquery.themepunch.revolution.min.js', array('jquery'), false);
		wp_register_script('themepunch_plugins', THEME_PLUGINS_URI. '/revslider/rs-plugin/js/jquery.themepunch.plugins.min.js', array('jquery'), false );
		wp_register_style('rs-captions', THEME_PLUGINS_URI. '/revslider/rs-plugin/css/captions.css', array(), '3.5.0' );
		wp_register_style('rs-settings', THEME_PLUGINS_URI. '/revslider/rs-plugin/css/settings.css', array(), '3.5.0' );
		
		wp_enqueue_script('jquery-scrollto', THEME_JS. '/jquery.scroll-to.js', array('jquery'), false, $move_bottom);

		if ( is_singular() ){
			wp_enqueue_script( 'comment-reply' );

		} 

		if(theme_option(THEME_OPTIONS, 'enable_nicescroll') == 'true') {
			wp_enqueue_script('jquery-nicescroll', THEME_JS. '/jquery.nicescroll.min.js', array('jquery'), false, $move_bottom);
		}

		if(theme_option(THEME_OPTIONS, 'enable_body_parallax') == 'true' || theme_option(THEME_OPTIONS, 'enable_homepage_slideshow_parallax') == 'true' || theme_option(THEME_OPTIONS, 'enable_page_parallax') == 'true') {
			wp_enqueue_script('jquery-parallax', THEME_JS. '/jquery.parallax.js', array('jquery'), false, $move_bottom);
		}


		wp_enqueue_script( 'theme-scripts', THEME_JS .'/theme-scripts.js', array('jquery'), false, $move_bottom);


	}
}
add_action('init', 'theme_enqueue_scripts');
add_action('wp_footer', 'theme_enqueue_scripts');





function mk_enqueue_styles() {
	wp_enqueue_style( 'mk-style', THEME_DIR_URI .'/style.css', false, false, 'all' );
	wp_enqueue_style( 'mk-skin', THEME_DIR_URI.'/skin.php', false, false, 'all' );

	if ( theme_option( THEME_OPTIONS, 'special_fonts_type_1' ) == 'google' ) {
		wp_enqueue_style( 'google-font-api-special-1', 'http://fonts.googleapis.com/css?family=' .theme_option( THEME_OPTIONS, 'special_fonts_list_1' ) , false, false, 'all' );		
	}
	if ( theme_option( THEME_OPTIONS, 'special_fonts_type_2' ) == 'google' ) {
		wp_enqueue_style( 'google-font-api-special-2', 'http://fonts.googleapis.com/css?family=' .theme_option( THEME_OPTIONS, 'special_fonts_list_2' ) , false, false, 'all' );		
	}
}
add_action( 'wp_print_styles', 'mk_enqueue_styles' );







