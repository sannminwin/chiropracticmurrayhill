<?php

/*-----------------------------------------------------------------------------------*/
/* Manage Employee's columns */
/*-----------------------------------------------------------------------------------*/

function edit_testimonial_columns( $testimonial_columns ) {
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		'title' => __( 'Testimonial Name', 'backend' ),
		"quote_author" => __( 'Author', 'theme_frontend' ),
		"desc" => __( 'Description', 'theme_frontend' ),
		"thumbnail" => __( 'Thumbnail', 'theme_frontend' ),
	);

	return $columns;
}
add_filter( 'manage_edit-testimonial_columns', 'edit_testimonial_columns' );

function manage_testimonials_columns( $column ) {
	global $post;

	if ( $post->post_type == "testimonial" ) {
		switch ( $column ) {
		case "quote_author":
			echo get_post_meta( $post->ID, '_author', true );
			break;
		case "desc":
			echo get_post_meta( $post->ID, '_desc', true );
			break;

		case 'thumbnail':
			echo the_post_thumbnail( 'thumbnail' );
			break;
		}
	}
}
add_action( 'manage_posts_custom_column', 'manage_testimonials_columns', 10, 2 );



/*-----------------------------------------------------------------------------------*/
/* Register Custom Post Types - Gallerys */
/*-----------------------------------------------------------------------------------*/
function register_testimonials_post_type() {
	register_post_type( 'testimonial', array(
			'labels' => array(
				'name' => __( 'Testimonials', 'theme_frontend' ), __( 'post type general name', 'theme_frontend' ),
				'singular_name' => __( 'Testimonial', 'theme_frontend' ), __( 'post type singular name', 'theme_frontend' ),
				'add_new' => __( 'Add New Testimonial', 'theme_frontend' ), __( 'Testimonials', 'theme_frontend' ),
				'add_new_item' => __( 'Add New Testimonial', 'backend' ),
				'edit_item' => __( 'Edit Testimonial', 'theme_frontend' ),
				'new_item' => __( 'New Testimonial', 'theme_frontend' ),
				'view_item' => __( 'View Testimonials', 'theme_frontend' ),
				'search_items' => __( 'Search Testimonials', 'theme_frontend' ),
				'not_found' =>  __( 'No Testimonials found', 'theme_frontend' ),
				'not_found_in_trash' => __( 'No Testimonials found in Trash', 'theme_frontend' ),
				'parent_item_colon' => '',

			),
			'singular_label' => 'Testimonials',
			'public' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'menu_icon' => THEME_ADMIN_ASSETS_URI . '/images/testimonials-admin-icon.png',
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => false,
			'menu_position' => 100,
			'query_var' => false,
			'show_in_nav_menus' => false,
			'supports' => array( 'title', 'thumbnail' ),
		) );
}
add_action( 'init', 'register_testimonials_post_type' );

function testimonials_context_fixer() {
	if ( get_query_var( 'post_type' ) == 'testimonial' ) {
		global $wp_query;
		$wp_query->is_home = false;
		$wp_query->is_404 = true;
		$wp_query->is_single = false;
		$wp_query->is_singular = false;
	}
}
add_action( 'template_redirect', 'testimonials_context_fixer' );
