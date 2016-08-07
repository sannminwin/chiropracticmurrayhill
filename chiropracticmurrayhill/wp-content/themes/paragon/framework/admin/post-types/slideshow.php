<?php

/*-----------------------------------------------------------------------------------*/
/* Manage slideshow's columns */
/*-----------------------------------------------------------------------------------*/
function edit_slideshow_columns($slideshow_columns) {
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" =>__('Slider Item Title','theme_frontend'), 
		"thumbnail" => 'Thumbnail', 
		"date" => 'Date',
	);

	return $columns;
}
add_filter('manage_edit-slideshow_columns', 'edit_slideshow_columns');


function manage_slideshow_columns($column) {
	global $post;
	
	if ($post->post_type == "slideshow") {
		switch($column){
			case 'thumbnail':
				echo the_post_thumbnail('thumbnail');
				break;
		}
	}
}
add_action('manage_posts_custom_column', 'manage_slideshow_columns', 10, 2);
/*-----------------------------------------------------------------------------------*/
/* Add image size for slideshow */
/*-----------------------------------------------------------------------------------*/
if ((isset($_REQUEST['post_id']) && get_post_type($_REQUEST['post_id']) == 'slideshow') || 
	(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete')) {
	add_image_size('slideshow', 1920, 440, true);
}





/*-----------------------------------------------------------------------------------*/
/* Register Custom Post Types - Gallerys */
/*-----------------------------------------------------------------------------------*/
function register_slideshow_post_type(){
	register_post_type('slideshow', array(
		'labels' => array(
			'name' => __('Flexslider','theme_frontend'), __('post type general name','theme_frontend'),
			'singular_name' => __('Flexslider Item','theme_frontend'), __('post type singular name','theme_frontend'),
			'add_new' => __('Add New Slider','theme_frontend'), __('slideshow','theme_frontend'),
			'add_new_item' => __('Add New Slider Item', 'backend'),
			'edit_item' => __('Edit Slider Item','theme_frontend'),
			'new_item' => __('New Slider Item','theme_frontend'),
			'view_item' => __('View Slider Item','theme_frontend'),
			'search_items' => __('Search Slider Items','theme_frontend'),
			'not_found' =>  __('No slider item found','theme_frontend'),
			'not_found_in_trash' => __('No slider items found in Trash','theme_frontend'),
			'parent_item_colon' => '',
		),
		'singular_label' => 'slideshow',
		'public' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'menu_icon' => THEME_ADMIN_ASSETS_URI . '/images/flexslider-admin-icon.png',
		'menu_position' => 100,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => false,
		'query_var' => false,
		'show_in_nav_menus' => false,
		'supports' => array('title', 'thumbnail')
	));
}
add_action('init','register_slideshow_post_type');

function slideshow_context_fixer() {
	if ( get_query_var( 'post_type' ) == 'slideshow' ) {
		global $wp_query;
		$wp_query->is_home = false;
		$wp_query->is_404 = true;
		$wp_query->is_single = false;
		$wp_query->is_singular = false;
	}
}
add_action( 'template_redirect', 'slideshow_context_fixer' );


