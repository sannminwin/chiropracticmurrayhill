<?php
$config  = array(
	'title' => sprintf( '%s Clients Options', THEME_NAME ),
	'id' => 'mk-metaboxes-notab',
	'pages' => array(
		'pricing'
	),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'core'
);
$options = array(


	array(
		"name" => __( "Plan Name", "theme_backend" ),
		"desc" => __( "", "theme_backend" ),
		"id" => "_plan",
		"default" => "",
		"option_structure" => 'sub',
		"divider" => true,
		"size"=> 50,
		"type" => "text"
	),
	array(
		"name" => __( "Price", "theme_backend" ),
		"desc" => __( "", "theme_backend" ),
		"id" => "_price",
		"default" => "",
		"option_structure" => 'sub',
		"divider" => true,
		"size"=> 50,
		"type" => "text"
	),
	array(
		"name" => __( "Features", "theme_backend" ),
		"desc" => __( 'You can learn more on documentation on how to make a sample pricing table list.', "theme_backend" ),
		"id" => "_features",
		"default" => "",
		"option_structure" => 'sub',
		"divider" => false,
		"rows"=> 15,
		"type" => "textarea"
	),
	array(
		"name" => __( "Button Text", "theme_backend" ),
		"desc" => __( "", "theme_backend" ),
		"id" => "_btn_text",
		"default" => "Purchase",
		"option_structure" => 'sub',
		"divider" => true,
		"size"=> 50,
		"type" => "text"
	),

	array(
		"name" => __( "Button URL", "theme_backend" ),
		"desc" => __( "", "theme_backend" ),
		"id" => "_btn_url",
		"default" => "",
		"option_structure" => 'sub',
		"divider" => true,
		"size"=> 50,
		"type" => "text"
	),



);
new metaboxesGenerator( $config, $options );
