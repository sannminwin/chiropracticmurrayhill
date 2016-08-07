<?php
$config  = array(
  'title' => sprintf( '%s Portfolio Options', THEME_NAME ),
  'id' => 'mk-metaboxes-tabs',
  'pages' => array(
    'portfolio'
  ),
  'callback' => '',
  'context' => 'normal',
  'priority' => 'core'
);
$options = array(


  array(
    "type" => "start_sub",
    "options" => array(
      "post-type" => __( "Post Type", 'backend' ),
      "newspaper-style" => __( "Newspaper Style Options", 'backend' ),
      "single-post-options" => __( "Single Post Options", 'backend' ),
    ),
  ),




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
    "type"=>"end_sub_pane"
  ),
  /*****************************/



  /* Sub Pane one : Post Single Option */
  array(
    "type" => "start_sub_pane"
  ),

  array(
    "name" => __( "Brief Introduction Heading", "theme_backend" ),
    "desc" => __( "This is the title under the image, on the breif content that you might need to give little expalanation about the work you have done to company or portfolio.", "theme_backend" ),
    "id" => "_breif_title",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => true,
    "size" => 60,
    "type" => "text"
  ),

  array(
    "name" => __( "Brief Introduction Description", "theme_backend" ),
    "desc" => __( "The content beneath the Title, this place is reserved for your briefed content. so try not to exceed more than 60-90 words.", "theme_backend" ),
    "id" => "_brief_desc",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => true,
    "size" => 100,
    "rows" => 4,
    "type" => "textarea"
  ),

  array(
    "name" => __( "Company Logo Image", "theme_backend" ),
    "desc" => __( "This logo will be placed on the single post under image. So if you have done this work to a company you can use its logo to as a reference.", "theme_backend" ),
    "id" => "_company_logo_src",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "upload"
  ),
  array(
    "name" => __( "Company Logo URL (optional)", "theme_backend" ),
    "desc" => __( "This URL will convert the logo a link to the company's website. include '<strong>http://</strong>'", "theme_backend" ),
    "id" => "_company_url",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),

  array(
    "name" => __( "Company Social Network - Facebook (optional)", "theme_backend" ),
    "desc" => __( "You can link the company's facebook URL which will be showed beneath logo. include '<strong>http://</strong>'", "theme_backend" ),
    "id" => "_facebook",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => false,
    "type" => "text"
  ),

  array(
    "name" => __( "Company Social Network - Twitter (optional)", "theme_backend" ),
    "desc" => __( "You can link the company's twitter URL which will be showed beneath logo. include '<strong>http://</strong>'", "theme_backend" ),
    "id" => "_twitter",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => false,
    "type" => "text"
  ),

  array(
    "name" => __( "Company Social Network - Linked In (optional)", "theme_backend" ),
    "desc" => __( "You can link the company's linked in URL which will be showed beneath logo. include '<strong>http://</strong>'", "theme_backend" ),
    "id" => "_linkedin",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => false,
    "type" => "text"
  ),

  array(
    "name" => __( "Company Social Network - Google Plus (optional)", "theme_backend" ),
    "desc" => __( "You can link the company's google plus URL which will be showed beneath logo. include '<strong>http://</strong>'", "theme_backend" ),
    "id" => "_googleplus",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
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
