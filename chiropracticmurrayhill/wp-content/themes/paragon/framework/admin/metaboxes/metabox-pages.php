<?php
$config  = array(
  'title' => sprintf( '%s Page Options', THEME_NAME ),
  'id' => 'mk-metaboxes-tabs',
  'pages' => array(
    'page'
  ),
  'callback' => '',
  'context' => 'normal',
  'priority' => 'core'
);
$options = array(
  array(
    "type" => "start_sub",
    "options" => array(
      "general" => __( "General Settings", 'backend' ),
      "slideshow" => __( "Slideshow", 'backend' ),
      "google_maps" => __( "Google Maps", 'backend' ),
    ),
  ),



  /* Sub Pane one : General Option */
  array(
    "type" => "start_sub_pane"
  ),

  array(
    "name" => "General Settings",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),
  array(
    "name" => __( "Layout", "theme_backend" ),
    "desc" => __( "Please choose this page's layout.", "theme_backend" ),
    "id" => "_layout",
    "default" => 'right',
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "0 30px 0 0",
    "options" => array(
      "left" => 'page-layout-left',
      "right" => 'page-layout-right',
      "full" => 'page-layout-full',
    ),
    "type" => "visual_selector"
  ),
  array(
    "name" => __( "Disable Page Title", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "_page_disable_title",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
    array(
    "name" => __( "Fancy Title?", "theme_backend" ),
    "desc" => __( "If you would like to use fancy titles which will be inside a fancy rounded highlights enable this option. ", "theme_backend" ),
    "id" => "_page_enable_fancy_title",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Page Heading Subtitle", "theme_backend" ),
    "id" => "_page_introduce_subtitle",
    "size" => 70,
    "default" => "",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),

  array(
    "name" => __( "Page Heading Description", "theme_backend" ),
    "id" => "_page_introduce_desc",
    "rows" => "3",
    "default" => "",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "textarea"
  ),
  array(
    "name" => "Custom Sidebar",
    "desc" => __( "You can create a custom sidebar, under Sidebar option and then assign the custom sidebar here to this post. later on you can customize which widgets to show up.", "theme_backend" ),
    "id" => "_sidebar",
    "default" => '',
    "options" => get_sidebar_options(),
    "option_structure" => 'sub',
    "divider" => false,
    "type" => "select"
  ),


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/





  /* Sub Pane one : Logo Option */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Slideshow Settings",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),
  array(
    "name" => __( "Enable Slidehsow For this page", "theme_backend" ),
    "desc" => __( "You can enable slideshow for this Post and choose which items to slide. You can also use one item which will give one static image.", "theme_backend" ),
    "id" => "_enable_slidehsow_for_singular",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Select Your Slideshow", "theme_backend" ),
    "desc" => __( "Select your preferable slide show here", "theme_backend" ),
    "id" => "_slideshow_source",
    "default" => 'layerslider',
    "option_structure" => 'sub',
    "width" => 300,
    "divider" => true,
    "options" => array(
      "layerslider" => "Layer Slider",
      "revslider" => 'Revolution Slider',
      "flexslider" => 'Flexslider',

    ),
    "type" => "chosen_select"
  ),
  array(
    "name" => __( "Choose your Slides", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "_slideshow_items_to_show",
    "default" => array(),
    "target" => 'slideshow',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "multiselect"
  ),

  array(
    "name" => __( "Select Slideshow", 'theme_backend' ),
    "desc" => __( "", 'theme_backend' ),
    "id" => "_layer_slider_source",
    "default" => '1',
    "target" => 'layer_slider_source',
    "width" => 500,
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "select"
  ),

  array(
    "name" => __( "Select Slideshow", 'theme_backend' ),
    "desc" => __( "", 'theme_backend' ),
    "id" => "_rev_slider_source",
    "default" => '1',
    "target" => 'revolution_slider',
    "width" => 500,
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "select"
  ),

  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/






  /* Sub Pane one : Logo Option */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => __( "Enable Google Map for This Page", "theme_backend" ),
    "desc" => __( "If you would like to display google map in this page's header enable this option. Dont forget to set your Latitude and Longitude. The rest are optional.", "theme_backend" ),
    "id" => "_enable_page_gmap",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Map Height", "theme_backend" ),
    "desc" => __( "Set your Maps' height here", "theme_backend" ),
    "id" => "_gmap_height",
    "min" => "100",
    "max" => "800",
    "step" => "1",
    "unit" => '',
    "default" => "400",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => __( "Latitude", "theme_backend" ),
    "default" => "",
    "size" => 40,
    "id" => "_page_gmap_latitude",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),

  array(
    "name" => __( "Longitude", "theme_backend" ),
    "default" => "",
    "size" => 40,
    "id" => "_page_gmap_longitude",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),

  array(
    "name" => __( "Zoom", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "_page_gmap_zoom",
    "min" => "1",
    "max" => "19",
    "step" => "1",
    "unit" => '',
    "default" => "14",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => __( "Enable Pan Control", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "_enable_panControl",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
    array(
    "name" => __( "Enable Draggable", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "_enable_draggable",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
    array(
    "name" => __( "Enable Scroll Wheel", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "_enable_scrollwheel",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Enable Zoom Control", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "_enable_zoomControl",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Enable Map Type Control", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "_enable_mapTypeControl",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Enable Scale Control", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "_enable_scaleControl",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Enable Marker", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "_gmap_marker",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
    array(
    "name" => __( "Enable Google Maps Hue, Saturation, Lightness, Gamma", "theme_backend" ),
    "desc" => __( "If you dont want to change maps coloring, brightness and so on, disable this option.", "theme_backend" ),
    "id" => "_disable_coloring",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Hue", "theme_backend" ),
    "desc" => __( "Sets the hue of the feature to match the hue of the color supplied. Note that the saturation and lightness of the feature is conserved, which means, the feature will not perfectly match the color supplied .", "theme_backend" ),
    "id" => "_gmap_hue",
    "default" => '#00c360',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),


  array(
    "name" => __( "Saturation", "theme_backend" ),
    "desc" => __( "Shifts the saturation of colors by a percentage of the original value if decreasing and a percentage of the remaining value if increasing. Valid values: [-100, 100].", "theme_backend" ),
    "id" => "_gmap_saturation",
    "min" => "-100",
    "max" => "100",
    "step" => "1",
    "unit" => '',
    "default" => "1",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => __( "Lightness", "theme_backend" ),
    "desc" => __( "Shifts lightness of colors by a percentage of the original value if decreasing and a percentage of the remaining value if increasing. Valid values: [-100, 100].", "theme_backend" ),
    "id" => "_gmap_lightness",
    "min" => "-100",
    "max" => "100",
    "step" => "1",
    "unit" => '',
    "default" => "1",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => __( "Gamma", "theme_backend" ),
    "desc" => __( "Modifies the gamma by raising the lightness to the given power. ", "theme_backend" ),
    "id" => "_gmap_gamma",
    "min" => "0.01",
    "max" => "9.99",
    "step" => "0.01",
    "unit" => '',
    "default" => "1",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/











  array(
    "type"=>"end_sub"
  ),
);
new metaboxesGenerator( $config, $options );
