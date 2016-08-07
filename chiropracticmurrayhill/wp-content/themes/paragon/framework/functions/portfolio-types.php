<?php

function register_portfolio_post_type(){
	register_post_type('portfolio', array(
		'labels' => array(
			'name' => __('Portfolios', 'post type general name', 'theme_frontend' ),
			'singular_name' => __('Portfolio', 'post type singular name', 'theme_frontend' ),
			'add_new' => __('Add New', 'portfolio', 'theme_frontend' ),
			'add_new_item' => __('Add New Portfolio', 'theme_frontend' ),
			'edit_item' => __('Edit Portfolio', 'theme_frontend' ),
			'new_item' => __('New Portfolio', 'theme_frontend' ),
			'view_item' => __('View Portfolio', 'theme_frontend' ),
			'search_items' => __('Search Portfolios', 'theme_frontend' ),
			'not_found' =>  __('No portfolios found', 'theme_frontend' ),
			'not_found_in_trash' => __('No portfolios found in Trash', 'theme_frontend' ), 
			'parent_item_colon' => '',
		),
		'singular_label' => __('portfolio', 'theme_frontend' ),
		'public' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'menu_icon' => THEME_ADMIN_ASSETS_URI . '/images/portfolio-admin-icon.png',
		'capability_type' => 'post',
		'menu_position' => 100,
		'hierarchical' => false,
		'rewrite' => array('slug' => theme_option(THEME_OPTIONS, 'portfolio_slug' )),
		'query_var' => false,
		'show_in_nav_menus' => false,
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments')
	));

	//register taxonomy for portfolio
	register_taxonomy('portfolio_category','portfolio',array(
		'hierarchical' => true,
		'labels' => array(
			'name' => __( 'Portfolio Categories', 'taxonomy general name', 'theme_frontend' ),
			'singular_name' => __( 'Portfolio Category', 'taxonomy singular name', 'theme_frontend' ),
			'search_items' =>  __( 'Search Categories', 'theme_frontend' ),
			'popular_items' => __( 'Popular Categories', 'theme_frontend' ),
			'all_items' => __( 'All Categories', 'theme_frontend' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Portfolio Category', 'theme_frontend' ), 
			'update_item' => __( 'Update Portfolio Category', 'theme_frontend' ),
			'add_new_item' => __( 'Add New Portfolio Category', 'theme_frontend' ),
			'new_item_name' => __( 'New Portfolio Category Name', 'theme_frontend' ),
			'separate_items_with_commas' => __( 'Separate Portfolio category with commas', 'theme_frontend' ),
			'add_or_remove_items' => __( 'Add or remove portfolio category', 'theme_frontend' ),
			'choose_from_most_used' => __( 'Choose from the most used portfolio category', 'theme_frontend' ),
			
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => false,
		'show_in_nav_menus' => false,
	));
}
add_action('init','register_portfolio_post_type');

function portfolio_context_fixer() {
	if ( get_query_var( 'post_type' ) == 'portfolio' ) {
		global $wp_query;
		$wp_query->is_home = false;
	}
	if ( get_query_var( 'taxonomy' ) == 'portfolio_category' ) {
		global $wp_query;
		$wp_query->is_404 = true;
		$wp_query->is_tax = false;
		$wp_query->is_archive = false;
	}
}
add_action( 'template_redirect', 'portfolio_context_fixer' );