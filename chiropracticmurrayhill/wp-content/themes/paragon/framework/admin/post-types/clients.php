<?php

/*-----------------------------------------------------------------------------------*/
/* Manage Employee's columns */
/*-----------------------------------------------------------------------------------*/

function edit_clients_columns($clients_columns) {
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		'title' => __('Client"s Name','theme_frontend'),
		"desc" => __('Description', 'theme_frontend' ),
		"thumbnail" => __('Thumbnail', 'theme_frontend' ),
	);

	return $columns;
}
add_filter('manage_edit-clients_columns', 'edit_clients_columns');

function manage_clients_columns($column) {
	global $post;
	
	if ($post->post_type == "clients") {
		switch($column){
			case "desc":
				echo get_post_meta($post->ID, '_desc', true);
				break;
			
			case 'thumbnail':
				echo the_post_thumbnail('thumbnail');
				break;
		}
	}
}
add_action('manage_posts_custom_column', 'manage_clients_columns', 10, 2);



/*-----------------------------------------------------------------------------------*/
/* Register Custom Post Types - Gallerys */
/*-----------------------------------------------------------------------------------*/
function register_clients_post_type(){
	register_post_type('clients', array(
		'labels' => array(
			'name' => __('Clients','theme_frontend'), __('post type general name','theme_frontend'),
			'singular_name' => __('Client','theme_frontend'), __('post type singular name','theme_frontend'),
			'add_new' => __('Add New Client','theme_frontend'), __('clients','theme_frontend'),
			'add_new_item' => __('Add New Client','theme_frontend'),
			'edit_item' => __('Edit Client','theme_frontend'),
			'new_item' => __('New Client','theme_frontend'),
			'view_item' => __('View Client','theme_frontend'),
			'search_items' => __('Search Clients','theme_frontend'),
			'not_found' =>  __('No Clients found','theme_frontend'),
			'not_found_in_trash' => __('No Clients found in Trash','theme_frontend'),
			'parent_item_colon' => '',
			
		),
		'singular_label' => 'clients',
		'public' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'menu_icon' => THEME_ADMIN_ASSETS_URI . '/images/clients-admin-icon.png',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => false,
		'menu_position' => 100,
		'query_var' => false,
		'show_in_nav_menus' => false,
		'supports' => array('title', 'thumbnail'),
	));
}
add_action('init','register_clients_post_type');

function clients_context_fixer() {
	if ( get_query_var( 'post_type' ) == 'clients' ) {
		global $wp_query;
		$wp_query->is_home = false;
		$wp_query->is_404 = true;
		$wp_query->is_single = false;
		$wp_query->is_singular = false;
	}
}
add_action( 'template_redirect', 'clients_context_fixer' );


