<?php
$config  = array(
	'title' => sprintf( '%s Testimonials Options', THEME_NAME ),
	'id' => 'mk-metaboxes-notab',
	'pages' => array(
		'testimonial'
	),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'core'
);
$options = array(
array(
		"name" => __( "Testimonial Author Name", "theme_backend" ),
		"desc" => __( "", "theme_backend" ),
		"id" => "_author",
		"default" => "",
		"option_structure" => 'sub',
		"divider" => true,
		"size"=> 50,
		"type" => "text"
	),

	array(
		"name" => __( "URL to Testimonial Author's Website (optional)", "theme_backend" ),
		"desc" => __( "include http://", "theme_backend" ),
		"id" => "_url",
		"default" => "",
		"option_structure" => 'sub',
		"divider" => true,
		"size"=> 50,
		"type" => "text"
	),
	array(
		"name" => __( "Quote", "theme_backend" ),
		"desc" => __( "Please fill below area with the quote", "theme_backend" ),
		"id" => "_desc",
		"default" => "",
		"option_structure" => 'sub',
		"divider" => false,
		"rows"=> 5,
		"type" => "textarea"
	),


array(
		"desc" => __( "Please Use the featured image metabox to upload testimonial author's portraite and then assign to the post. This image will be dynamically resized and cropped, therefore in order to have the perfect image quality, dimensions should be exactly 120px X 120px.", "theme_backend" ),
		"type" => "info"
	),

);
new metaboxesGenerator( $config, $options );
