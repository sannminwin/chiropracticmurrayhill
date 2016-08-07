<?php
$config  = array(
  'title' => sprintf( '%s Slideshow Options', THEME_NAME ),
  'id' => 'mk-metaboxes-slideshow',
  'pages' => array(
    'slideshow'
  ),
  'callback' => '',
  'context' => 'normal',
  'priority' => 'core'
);
$options = array(

  array(
    "name" => __( "Caption Title", "theme_backend" ),
    "id" => "_title",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => true,
    "size" => 100,
    "type" => "text"
  ),

  array(
    "name" => __( "Caption Description", "theme_backend" ),
    "id" => "_description",
    "default" => "",
    "rows" => "3",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "textarea"
  ),

  array(
    "name" => __( "Title Color", "theme_backend" ),
    "id" => "_title_color",
    "default" => '#5c5c5c',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "name" => __( "Description Color", "theme_backend" ),
    "id" => "_desc_color",
    "default" => '#fff',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

  array(
    "name" => __( "Link To (optional)", "theme_backend" ),
    "desc" => __( "The url that the slider item links to.", "theme_backend" ),
    "id" => "_link_to",
    "default" => "",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "superlink"
  ),




);
new metaboxesGenerator( $config, $options );
