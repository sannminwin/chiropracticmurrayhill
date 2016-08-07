<?php
$config  = array(
  'title' => sprintf( '%s Posts Options', THEME_NAME ),
  'id' => 'mk-metaboxes-tabs',
  'pages' => array(
    'post'
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
      "post-type" => __( "Post Type", 'backend' ),
      "newspaper-style" => __( "Newspaper Style Options", 'backend' ),
      "single-post-options" => __( "Single Post Options", 'backend' ),
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
    "desc" => __( "Please choose this posts's layout. If default selected this option will be overrided from masterkey settings > blog > single post layout.", "theme_backend" ),
    "id" => "_single_layout",
    "default" => 'default',
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "0 30px 0 0",
    "options" => array(
      "left" => 'page-layout-left',
      "right" => 'page-layout-right',
      "full" => 'page-layout-full',
      "default" => 'page-layout-default',
    ),
    "type" => "visual_selector"
  ),


  array(
    "name" => "Custom Sidebar",
    "desc" => __( "You can create a custom sidebar, under Sidebar option then assign the custom sidebar here to this post.", "theme_backend" ),
    "id" => "_sidebar",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => get_sidebar_options(),
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
    "name" => __( "Post Options", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => "Post Type",
    "desc" => __( "", "theme_backend" ),
    "id" => "_single_post_type",
    "default" => 'image',
    "preview" => false,
    "options" => array(
      "image" => 'Image',
      "video" => 'Video',
      "audio" => 'Audio',
      "document" => "Document",
      "portfolio" => "Portfolio",
      //"dribbble" => 'Dribbble',
      //"instagram" => 'Instagram',
      //"twitter" => 'Twitter',
    ),
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "chosen_select"
  ),

  array(
    "name" => __( "Upload MP3 File", "theme_backend" ),
    "desc" => __( "Upload MP3 your file or paste the full URL for external files. This file formated needed for Safari, Internet Explorer, Chrome. ", "theme_backend" ),
    "id" => "_mp3_file",
    "preview" => false,
    "default" => "",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "upload"
  ),

  array(
    "name" => __( "Upload OGG File", "theme_backend" ),
    "desc" => __( "Upload OGG your file or paste the full URL for external files. This file formated needed for Firefox, Opera, Chrome. ", "theme_backend" ),
    "id" => "_ogg_file",
    "preview" => false,
    "default" => "",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "upload"
  ),

  array(
    "name" => __( "Video Site", "theme_backend" ),
    "id" => "_single_video_site",
    "default" => 'youtube',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "vimeo" => 'Vimeo',
      "youtube" => 'Youtube',
      "dailymotion" => 'Daily Motion',
      //"custom" => 'Custom Video',
    ),
    "type" => "select"
  ),

  array(
    "name" => __( "Video Id", "theme_backend" ),
    "desc" => __( "Please fill this option with the required ID. you can find the ID from the link parameters as examplified below:<br /> http://www.youtube.com/watch?v=<strong>ID</strong><br />https://vimeo.com/<strong>ID</strong><br />http://www.dailymotion.com/embed/video/<strong>ID</strong>", "theme_backend" ),
    "id" => "_single_video_id",
    "size" => 20,
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),

  array(
    "name" => __( "Disable Video Lightbox", "theme_backend" ),
    "desc" => __( "If you disable this option upon click on the video post image, it will go through single post instead of triggering a lightbox for an intend to open the video in pop up lightbox", "theme_backend" ),
    "id" => "_disable_video_lightbox",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),





  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/


  /* Sub Pane one : Newspaper Option */
  array(
    "type" => "start_sub_pane"
  ),

  array(
    "name" => __( "Newspaper Blog Loop Style", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => __( "Newspaper Style Image Height", "theme_backend" ),
    "desc" => __( "This option only works when you have blog loop newspaper style. since newspaper style is more interesting on random image heights, we thought it might be useful for some wesbites.", "theme_backend" ),
    "id" => "_post_newspaper_image_height",
    "min" => "300",
    "max" => "1200",
    "step" => "1",
    "unit" => 'px',
    "default" => "500",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => __( "Newspaper Style Title position", "theme_backend" ),
    "desc" => __( "In Image Post Type, some times your image height is that much low that title and/or post meta in hover just doesn't fit in the image box. you can use this option to place post title under image. please note that this is only for newspaper loop style.", "theme_backend" ),
    "id" => "_newspaper_title_position",
    "default" => 'top',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "top" => 'Inside Image',
      "bottom" => 'Below Image',
    ),
    "type" => "select"
  ),

  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/



  /* Sub Pane one : Post Single Option */
  array(
    "type" => "start_sub_pane"
  ),

  array(
    "name" => __( "Disable Title", "theme_backend" ),
    "id" => "_disable_title",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Meta Section", "theme_backend" ),
    "desc" => __( "Categories and post date is meta section.", "theme_backend" ),
    "id" => "_disable_meta",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Social Bookmarks", "theme_backend" ),
    "desc" => __( "Use this option to disable Social Bookmarks", "theme_backend" ),
    "id" => "_disable_social_share",
    "default" =>'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Tags", "theme_backend" ),
    "desc" => __( "Tags could be disabled using this option should you not want to include any tags", "theme_backend" ),
    "id" => "_disable_tags",
    "default" =>'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Similar Posts", "theme_backend" ),
    "desc" => __( "If you do not want to show related posts disable the post here", "theme_backend" ),
    "id" => "_disable_related_posts",
    "default" =>'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "About Author Box", "theme_backend" ),
    "desc" => __( "Disable the about author box here", "theme_backend" ),
    "id" => "_disable_about_author",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

    array(
    "name" => __( "Comments", "theme_backend" ),
    "desc" => __( "Disable Comments for this post", "theme_backend" ),
    "id" => "_disable_comments",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
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
