<?php
$config  = array(
	'title' => sprintf( '%s Employees Options', THEME_NAME ),
	'id' => 'mk-metaboxes-notab',
	'pages' => array(
		'employees'
	),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'core'
);
$options = array(


	array(
		"name" => __( "Employee Position", "theme_backend" ),
		"desc" => __( "Please enter team member's Position in the company.", "theme_backend" ),
		"id" => "_position",
		"default" => "",
		"option_structure" => 'sub',
		"divider" => true,
		"size"=> 50,
		"type" => "text"
	),
	array(
		"name" => __( "About Member", "theme_backend" ),
		"desc" => __( "", "theme_backend" ),
		"id" => "_desc",
		"default" => "",
		"option_structure" => 'sub',
		"divider" => true,
		"rows"=> 5,
		"type" => "textarea"
	),
		array(
		"name" => __( "Social Network (Facebook)", "theme_backend" ),
		"desc" => __( "Please enter full URL of this social network(include http://).", "theme_backend" ),
		"id" => "_facebook",
		"default" => "",
		"option_structure" => 'sub',
		"divider" => true,
		"size"=> 50,
		"type" => "text"
	),

		array(
		"name" => __( "Social Network (Twitter)", "theme_backend" ),
		"desc" => __( "Please enter full URL of this social network(include http://).", "theme_backend" ),
		"id" => "_twitter",
		"default" => "",
		"option_structure" => 'sub',
		"divider" => true,
		"size"=> 50,
		"type" => "text"
	),

		array(
		"name" => __( "Social Network (Linked In)", "theme_backend" ),
		"desc" => __( "Please enter full URL of this social network(include http://).", "theme_backend" ),
		"id" => "_linkedin",
		"default" => "",
		"option_structure" => 'sub',
		"divider" => true,
		"size"=> 50,
		"type" => "text"
	),

	array(
		"desc" => __( "Please Use the featured image metabox to upload your employee photo and then assign to the post. the image dimensions must be exactly 165px X 165px.", "theme_backend" ),
		"type" => "info"
	),



);
new metaboxesGenerator( $config, $options );
