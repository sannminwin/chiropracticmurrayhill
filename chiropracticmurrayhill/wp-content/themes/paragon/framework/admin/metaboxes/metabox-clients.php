<?php
$config  = array(
	'title' => sprintf( '%s Clients Options', THEME_NAME ),
	'id' => 'mk-metaboxes-notab',
	'pages' => array(
		'clients'
	),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'core'
);
$options = array(


	array(
		"name" => __( "URL to Clients Website (optional)", "theme_backend" ),
		"desc" => __( "include http://", "theme_backend" ),
		"id" => "_url",
		"default" => "",
		"option_structure" => 'sub',
		"divider" => true,
		"size"=> 50,
		"type" => "text"
	),
	array(
		"name" => __( "Description", "theme_backend" ),
		"desc" => __( "", "theme_backend" ),
		"id" => "_desc",
		"default" => "",
		"option_structure" => 'sub',
		"divider" => false,
		"rows"=> 5,
		"type" => "textarea"
	),


array(
		"desc" => __( "Please Use the featured image metabox to upload your Clients Logo and then assign to the post. the image dimensions should be less than 165px X 165px.", "theme_backend" ),
		"type" => "info"
	),

);
new metaboxesGenerator( $config, $options );
