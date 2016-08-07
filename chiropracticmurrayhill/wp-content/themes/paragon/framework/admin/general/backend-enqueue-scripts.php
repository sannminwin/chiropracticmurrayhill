<?php


/*
***** Theme backend scripts
*/
function theme_admin_add_script() {

	wp_enqueue_script( 'miniColors', THEME_ADMIN_ASSETS_URI . '/js/jquery.miniColors.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'rangeinput', THEME_ADMIN_ASSETS_URI . '/js/range-input.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'jquery-chosen', THEME_ADMIN_ASSETS_URI . '/js/chosen.jquery.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'bpopup', THEME_ADMIN_ASSETS_URI . '/js/bpopup.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'jquery-tools-tabs', THEME_ADMIN_ASSETS_URI . '/js/jquery.tabs.tools.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'outside-events', THEME_ADMIN_ASSETS_URI . '/js/jquery.outside-events.min.js', array( 'jquery' ), false, true );


	if(function_exists( 'wp_enqueue_media' )){
	   
	}else{
		wp_enqueue_script( 'theme-old-uploader', THEME_ADMIN_ASSETS_URI . '/js/mediaUploader-depricated.js', array( 'jquery' ), false, true );
	    wp_enqueue_script('media-upload');
	    wp_enqueue_script('thickbox');
	}


    /* theme custom script should always be the last to enqueue */
	wp_enqueue_script( 'admin-scripts', THEME_ADMIN_ASSETS_URI . '/js/admin-scripts.js', array( 'jquery' ), false, true );



	
}




/*
***** Theme backend scripts
*/
function theme_admin_add_style() {

	
	wp_enqueue_style( 'theme-style', THEME_ADMIN_ASSETS_URI . '/stylesheet/css/admin-styles.css' ); // Theme backend styles
	
	if(function_exists( 'wp_enqueue_media' )){

	}else{
	    wp_enqueue_style('thickbox');
	}

 
}

if(isset($_GET['page'])) {
	$masterkey_page = ($_GET['page']=='masterkey') ? true : false;
}

/*
***** Initialize theme scripts and styles
*/
if ((theme_is_options() && $masterkey_page == true) || theme_is_post_type()) {
	add_action( 'admin_init', 'theme_admin_add_script' );
	add_action( 'admin_init', 'theme_admin_add_style' );
	add_action('admin_head', 'add_script_to_head');	
}





if (theme_is_options() && $masterkey_page == true) {
	add_action( 'admin_init', 'mk_masterkey_specific_enqueue' );
}


function mk_masterkey_specific_enqueue() {
	if(function_exists( 'wp_enqueue_media' )){
	    wp_enqueue_media();
	    wp_enqueue_script( 'theme-new-uploader', THEME_ADMIN_ASSETS_URI . '/js/mediaUploader-3-5.js', array( 'jquery' ), false, true );
	}

}




function add_script_to_head() {

	echo '<script type="text/javascript">
		var mk_theme_admin_uri = "'.THEME_ADMIN_URI.'";
		var mk_theme_imges = "'.THEME_IMAGES.'";
	</script>';
	
}


add_action('admin_head', 'add_admin_general_style');	

function add_admin_general_style() {
	echo '<style>
		#toplevel_page_masterkey .wp-menu-image img,
		#toplevel_page_revslider .wp-menu-image img,
		#toplevel_page_layerslider .wp-menu-image img,
		#menu-posts-slideshow .wp-menu-image img,
		#menu-posts-slideshow .wp-menu-image img,
		#menu-posts-employees .wp-menu-image img,
		#menu-posts-portfolio .wp-menu-image img,
		#menu-posts-clients .wp-menu-image img,
		#menu-posts-pricing .wp-menu-image img,
		#menu-posts-testimonial .wp-menu-image img
		{
			  opacity: 1 !important;
			  filter: alpha(opacity=100) !important;
			  -webkit-opacity: 1 !important;
			  -moz-opacity: 1 !important;
			  -o-opacity: 1 !important;
		}
	</style>';


}



