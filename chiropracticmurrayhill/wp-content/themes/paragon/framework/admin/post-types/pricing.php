<?php

/*-----------------------------------------------------------------------------------*/
/* Manage Employee's columns */
/*-----------------------------------------------------------------------------------*/

function edit_pricing_columns($pricing_columns) {
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		'title' => __('Pricing Name', 'backend'),
	);

	return $columns;
}
add_filter('manage_edit-pricing_columns', 'edit_pricing_columns');





/*-----------------------------------------------------------------------------------*/
/* Register Custom Post Types - Gallerys */
/*-----------------------------------------------------------------------------------*/
function register_pricing_post_type(){
	register_post_type('pricing', array(
		'labels' => array(
			'name' => __('Pricing Tables','theme_frontend'), __('post type general name','theme_frontend'),
			'singular_name' => __('Pricing Item','theme_frontend'), __('post type singular name','theme_frontend'),
			'add_new' => __('Add New Pricing Item','theme_frontend'), __('pricing','theme_frontend'),
			'add_new_item' => __('Add New Pricing Item', 'backend'),
			'edit_item' => __('Edit Pricing Item','theme_frontend'),
			'new_item' => __('New Pricing Item','theme_frontend'),
			'view_item' => __('View Pricing Item','theme_frontend'),
			'search_items' => __('Search Pricing Item','theme_frontend'),
			'not_found' =>  __('No Pricing Item found','theme_frontend'),
			'not_found_in_trash' => __('No Pricing Item found in Trash','theme_frontend'),
			'parent_item_colon' => '',
			
		),
		'singular_label' => 'pricing',
		'public' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'menu_icon' => THEME_ADMIN_ASSETS_URI . '/images/pricing-admin-icon.png',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => false,
		'menu_position' => 100,
		'query_var' => false,
		'show_in_nav_menus' => false,
		'supports' => array('title', 'page-attributes'),
	));
}
add_action('init','register_pricing_post_type');

function pricing_context_fixer() {
	if ( get_query_var( 'post_type' ) == 'pricing' ) {
		global $wp_query;
		$wp_query->is_home = false;
		$wp_query->is_404 = true;
		$wp_query->is_single = false;
		$wp_query->is_singular = false;
	}
}
add_action( 'template_redirect', 'pricing_context_fixer' );


