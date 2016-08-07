<?php
include THEME_ADMIN . '/admin-panel/masterkey-includes.php';

$options = array(


  array(
    "type" => "start",
    "options" => array(
      "general" => __( "General", 'backend' ),
      "homepage" => __( "Homepage", 'backend' ),
      "skining" => __( "Styling & <br /> Coloring", 'backend' ),
      "typography" => __( "Typography", "backend" ),
      "slideshow" => __( "Slideshow", 'backend' ),
      "portfolio" => __( "Portfolio", 'backend' ),
      "blog" => __( "Blog", 'backend' ),
      //"forms" => __( "Forms", 'backend' ),
      "advanced" => __( "Advanced", 'backend' ),
    ),
  ),


  /*
**
**
** Main Pane : General
-------------------------------------------------------------*/
  array(
    "type"=>"start_main_pane"
  ),




  array(
    "type" => "start_sub",
    "options" => array(
      "global_general" => __( "General Settings", 'backend' ),
      "navigations" => __( "Navigations", 'backend' ),
      "social_network" => __( "Social Networks", 'backend' ),
      "sidebar" => __( "Custom Sidebars", 'backend' ),
      "footer" => __( "Footer", 'backend' ),
      "smooth_scroll" => __( "Page Smooth Scroll", 'backend' ),
      "image_cropping" => __( "Theme Images", 'backend' ),

    ),
  ),



  /* Sub Pane one : General Settings */
  array(
    "type" => "start_sub_pane"
  ),



  array(
    "name" => "General / Logo & General Settings",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),



  array(
    "name" => __( "Custom Favicon", "theme_backend" ),
    "desc" => __( "Using this option, You can upload  your very own custom favicon. To do so, hit the upload button, select your favicon and click 'Use This'." , "theme_backend" ),
    "id" => "custom_favicon",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => 'upload'
  ),
  array(
    "name" => __( "Custom Logo", "theme_backend" ),
    "desc" => __( "Using this option you can upload your own custom logo. Do so by enabling this option first then upload using the option below.", "theme_backend" ),
    "id" => "display_logo",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Upload Custom Logo", "theme_backend" ),
    "id" => "logo",
    "default" => "",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "upload"
  ),

  array(
    "name" => __( "Fixed Header", "theme_backend" ),
    "desc" => __( "If you dont want to fix header on top while scrolling page disable this option.", "theme_backend" ),
    "id" => "fixed_header",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Header Search From", "theme_backend" ),
    "desc" => __( "Using this option you can disable/enable header search form.", "theme_backend" ),
    "id" => "disable_header_search",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),



  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/












  /* Sub Pane one : Navigations */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "General / Navigations",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => __( "Main Navigation", "theme_backend" ),
    "desc" => __( "Main navigation can be enabled or disabled using this option. If you enable this option,  you can set Navigation Items under Appearance > Menu.", "theme_backend" ),
    "id" => "enable_main_nav",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),






  array(
    "name" => "Footer Toolbar Navigation",
    "desc" => __( "This option allows you to enable a custom navigation on the left section of custom footer.", "theme_backend" ),
    "id" => "enable_footer_nav",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/












  /* Sub Pane one : Social Networks */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "General / Social Networks",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => __( "Header Social Networks", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "disable_header_social_networks",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Header Social Netowrk's Size", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "header_social_size",
    "default" => 'small',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "small" => 'Small',
      "medium" => 'Medium',
      "large" => 'Large'
    ),
    "type" => "radio"
  ),


  array(
    "name" => __( "Add New Network", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "header_social_networks_site",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => true,

    "type" => 'header_social_networks'
  ),

  array(
    "id"=>"header_social_networks_url",
    "default"=> "",
    "type"=> 'hidden_input',
  ),

 

  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/












  /* Sub Pane one : Custom Sidebars */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "General / Custom Sidebar",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),
  array(
    "name" => __( "Create a new sidebar", "theme_backend" ),
    "desc" => __( "Enter a name for new sidebar. It must be a valid name which starts with a letter, followed by letters, numbers, spaces, or underscores", "theme_backend" ),
    "id" => "sidebars",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => true,

    "type" => 'custom_sidebar'
  ),


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/














  /* Sub Pane one : Footer */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "General / Footer",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => __( "Footer", "theme_backend" ),
    "desc" => __( "You can enable or disable footer section using this option.", "theme_backend" ),
    "id" => "disable_footer",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Sub Footer", "theme_backend" ),
    "desc" => __( "Use this option to enable or disable the sub-footer.", "theme_backend" ),
    "id" => "disable_sub_footer",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Footer Logo", "theme_backend" ),
    "desc" => __( "This will appear in the sub-footer section. Your image shouldn't not exceed 150 * 60 pixels.", "theme_backend" ),
    "id" => "footer_logo",
    "default" => THEME_IMAGES . "/footer-logo.png",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "upload"
  ),


  array(
    "name" => __( "Footer Column layout", "theme_backend" ),
    "id" => "footer_columns",
    "function" => "footer_culumns",
    "default" => "4",
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "30px 30px 0 0",
    "options" => array(
      "1" => 'column_1',
      "2" => 'column_2',
      "3" => 'column_3',
      "4" => 'column_4',
      "5" => 'column_5',
      "6" => 'column_6',
      "half_sub_half" => 'column_half_sub_half',
      "half_sub_third" => 'column_half_sub_third',
      "third_sub_third" => 'column_third_sub_third',
      "third_sub_fourth" => 'column_third_sub_fourth',
      "sub_half_half" => 'column_sub_half_half',
      "sub_third_half" => 'column_sub_third_half',
      "sub_third_third" => 'column_sub_third_third',
      "sub_fourth_third" => 'column_sub_fourth_third',
      //"two_row" => 'column_half_half',
    ),
    "type" => "visual_selector"
  ),

  array(
    "name" => "Footer Slogan",
    "desc" => __( "Footer slogan could be disabled here", "theme_backend" ),
    "id" => "disable_footer_banner",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),


  array(
    "name" => __( "Footer Slogan", "theme_backend" ),
    "desc" => "",
    "id" => "footer_slogan",
    "default" => 'ARTFUL<br />CREATIVE<br />EMMINENT',
    "rows" => 3,
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "textarea"
  ),

  array(
    "name" => __( "Copyright Text", "theme_backend" ),
    "desc" => "",
    "id" => "copyright",
    "default" => 'Copyright All Rights Reserved &copy; 2012',
    "rows" => 3,
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "textarea"
  ),
  array(
    "type" => "end_pane"
  ),


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/





  /* Sub Pane one : Theme Images */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "General / Page Smooth Scroll",
    "desc" => __( "In this section you can change page scroll bahavior. It will change the default browser scroll bar with a custom look close to Mac OS.", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => __( "Smooth Page Scroll", "theme_backend" ),
    "desc" => __( "You can enable/disable page vertical scroll smoothness which gives an smooth easing. ", "theme_backend" ),
    "id" => "enable_nicescroll",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),


  array(
    "name" => __( "Scroll Speed", "theme_backend" ),
    "desc" => __( "You can set how fast the page to scroll ", "theme_backend" ),
    "id" => "page_scroll_speed",
    "option_structure" => 'sub',
    "divider" => true,
    "min" => "0",
    "max" => "500",
    "step" => "1",
    "unit" => 'ms',
    "default" => "100",
    "type" => "range"
  ),


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/



  /* Sub Pane one : Theme Images */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "General / Theme Images",
    "desc" => __( "In this section you can set your images cropping, resizing, retina enabled options. please note that this options will alter all images including post thumbnail, portfolio post thumbnail, image shortcodes and so on.", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => __( "Image cropping", "theme_backend" ),
    "desc" => __( "This option will crop images to fit the dimension, so some parts of images will be cropped out. if you dont want to crop images disable this option", "theme_backend" ),
    "id" => "disable_image_cropping",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),


  array(
    "name" => __( "Retina compatible images", "theme_backend" ),
    "desc" => __( "This option will double the dimension of images, though since all images are blocked with its original sizes, they will not look large, the difference will be visible only in retina displays. if you use this theme for the purpose of displaying your images, its recomeneded to enable this option.", "theme_backend" ),
    "id" => "enable_retina_images",
    "default" => 'false',
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

  array(
    "type"=>"end_main_pane"
  ),
  /* End Main Pane */
























  /*
**
**
** Main Pane : Homepage
-------------------------------------------------------------*/
  array(
    "type"=>"start_main_pane"
  ),




  array(
    "type" => "start_sub",
    "options" => array(
      "homepage_general" => __( "General Layout", 'backend' ),
      "homepage_tabbed_box" => __( "Homepage Tabbed Box", 'backend' )
    ),
  ),



  /* Sub Pane one : General Layout */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Homepage / General Layout",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),



  array(
    "name" => __( "Homepage Content", "theme_backend" ),
    "desc" => __( "Using this option, you can set which Page to be the content of your homepage.", "theme_backend" ),
    "id" => "homepage_content",
    "target" => 'page',
    "default" => "",
    "option_structure" => 'sub',
    "divider" => true,
    "prompt" => __( "Choose page..", "theme_backend" ),
    "type" => "select"
  ),


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/





  /* Sub Pane one : Homepage Tabbed Box */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Homepage / Homepage Tabbed Box",
    "desc" => __( "This section is resurved a place under slideshow to add your desired tabs which are getting feeds from pages, so you can add as many tabs you like.", "theme_backend" ),
    "type" => "heading"
  ),

      array(
    "name" => __( "Homepage Tabbed Box", "theme_backend" ),
    "desc" => __( "You can use this option to disable/enable homepage tabbed box.", "theme_backend" ),
    "id" => "disable_homepage_tabbed_box",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Create a new Tab", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "homepage_tabs",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => true,

    "type" => 'homepage_tabbed_box'
  ),

  array(
    "id"=>"homepage_tabs_page_id",
    "default"=> "",
    "type"=> 'hidden_input',
  ),

   array(
    "id"=>"homepage_tabs_page_title",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/

















  array(
    "type"=>"end_sub"
  ),

  array(
    "type"=>"end_main_pane"
  ),
  /* End Main Pane */














  /*
**
**
** Main Pane : Styling & Coloring
-------------------------------------------------------------*/
  array(
    "type"=>"start_main_pane"
  ),




  array(
    "type" => "start_sub",
    "options" => array(
      "backgrounds_skin" => __( "Backgrounds", 'backend' ),
      "backgrounds_3d_effect_skin" => __( "3D Backgrounds", 'backend' ),
      "general_skin" => __( "General Coloring", 'backend' ),
      "skin_main_navigation_skin" => __( "Main Navigation", 'backend' ),
      "homepage_skin" => __( "Homepage", 'backend' ),
      "page_introduce_skin" => __( "Page Introduce", 'backend' ),
      "blog_skin" => __( "Blog", 'backend' ),
      "sidebar_skin" => __( "Sidebar", 'backend' ),
      "footer_skin" => __( "Footer Section", 'backend' ),
      "misc_skin" => __( "Miscellaneous", 'backend' ),

    ),
  ),







  /* Sub Pane one : Backgrounds */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Styling & Coloring / Backgrounds",
    "desc" => __( "In this section you can modify all the backgrounds of your site including header, page, body, footer. Here, you can set the layout you would like your site to look like, then click on different layout sections to add/create differnt backgrounds.", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => __( "Choose between boxed and full width layout", 'theme_backend' ),
    "desc" => __( "Choose between a full or a boxed layout to set how your website's layout will look like.", 'theme_backend' ),
    "id" => "background_selector_orientation",
    "default" => "full_width_layout",
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "0px 30px 20px 0",
    "options" => array(
      "boxed_layout" => 'boxed-layout',
      "full_width_layout" => 'full-width-layout',
    ),
    "type" => "visual_selector"
  ),



  array(
    "name" => __( "Boxed Layout Outer Shadow Size", "theme_backend" ),
    "desc" => __( "You can have a outer shadow around the box. using this option you in can modify its range size", "theme_backend" ),
    "id" => "boxed_layout_shadow_size",
    "default" => "0",
    "option_structure" => 'sub',
    "divider" => true,
    "min" => "0",
    "max" => "60",
    "step" => "1",
    "unit" => 'px',
    "type" => "range"
  ),

    array(
    "name" => __( "Boxed Layout Outer Shadow Intensity", "theme_backend" ),
    "desc" => __( "determines how darker the shadow to be.", "theme_backend" ),
    "id" => "boxed_layout_shadow_intensity",
    "default" => "0",
    "option_structure" => 'sub',
    "divider" => true,
    "min" => "0",
    "max" => "1",
    "step" => "0.01",
    "unit" => 'alpha',
    "type" => "range"
  ),

  array(
    "name" => __( "Background color & texture", 'theme_backend' ),
    "desc" => __( "Please click on the different sections to modify their backgrounds.", 'theme_backend' ),
    "id"=> 'general_backgounds',
    "option_structure" => 'sub',
    "option_structure" => 'main',
    "divider" => true,
    "type" => "general_background_selector"
  ),


  array(
    "id"=>"body_color",
    "default"=> "#f7f4ee",
    "type"=> 'hidden_input',
  ),
       array(
    "id"=>"body_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"body_image",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"body_position",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"body_attachment",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"body_repeat",
    "default"=> "",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"body_source",
    "default"=> "no-image",
    "type"=> 'hidden_input',
  ),







  array(
    "id"=>"page_color",
    "default"=> "",
    "type"=> 'hidden_input',
  ),
       array(
    "id"=>"page_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"page_image",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"page_position",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"page_attachment",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"page_repeat",
    "default"=> "",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"page_source",
    "default"=> "no-image",
    "type"=> 'hidden_input',
  ),










  array(
    "id"=>"header_color",
    "default"=> "#f7f4ee",
    "type"=> 'hidden_input',
  ),
     array(
    "id"=>"header_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"header_image",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"header_position",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"header_attachment",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"header_repeat",
    "default"=> "",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"header_source",
    "default"=> "no-image",
    "type"=> 'hidden_input',
  ),











  array(
    "id"=>"footer_color",
    "default"=> "#4a463d",
    "type"=> 'hidden_input',
  ),
    array(
    "id"=>"footer_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"footer_image",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"footer_position",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"footer_attachment",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"footer_repeat",
    "default"=> "",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"footer_source",
    "default"=> "no-image",
    "type"=> 'hidden_input',
  ),



  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/







  /* Sub Pane : 3D Backgrounds Section */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Styling & Coloring / 3D Backgrounds",
    "desc" => __( "This section gives your the ability to implement 3D effect on your Body and Page section backgrounds. 3D will give your backgroudns a sense of 3D effect, it means they will move slower or faster than your page scroll.", "theme_backend" ),
    "type" => "heading"
  ),


  array(
    "name" => __( "Body Section", "theme_backend" ),
    "desc" => __( "Enable this option if you would like to have 3D effect on your body background image", "theme_backend" ),
    "id" => "enable_body_parallax",
    "default" => "false",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Body Section Speed Factor", "theme_backend" ),
    "desc" => __( "This speed will determine how fast your background moves along the scroll page", "theme_backend" ),
    "id" => "body_parallax_speed",
    "default" => "false",
    "option_structure" => 'sub',
    "divider" => true,
    "min" => "-10",
    "max" => "10",
    "step" => "0.1",
    "unit" => 'factor',
    "default" => "4",
    "type" => "range"
  ),



  array(
    "name" => __( "Page Section", "theme_backend" ),
    "desc" => __( "Enable this option if you would like to have 3D effect on your body background image", "theme_backend" ),
    "id" => "enable_page_parallax",
    "default" => "false",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Page Section Speed Factor", "theme_backend" ),
    "desc" => __( "This speed will determine how fast your background moves along the scroll page", "theme_backend" ),
    "id" => "page_parallax_speed",
    "default" => "false",
    "option_structure" => 'sub',
    "divider" => true,
    "min" => "-10",
    "max" => "10",
    "step" => "0.1",
    "unit" => 'factor',
    "default" => "4",
    "type" => "range"
  ),




  array(
    "name" => __( "Homepage Slideshow Section", "theme_backend" ),
    "desc" => __( "Enable this option if you would like to have 3D effect on your body background image", "theme_backend" ),
    "id" => "enable_homepage_slideshow_parallax",
    "default" => "false",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Homepage Slideshow Section Speed Factor", "theme_backend" ),
    "desc" => __( "This speed will determine how fast your background moves along the scroll page", "theme_backend" ),
    "id" => "homepage_slideshow_speed",
    "default" => "false",
    "option_structure" => 'sub',
    "divider" => true,
    "min" => "-10",
    "max" => "10",
    "step" => "0.1",
    "unit" => 'factor',
    "default" => "4",
    "type" => "range"
  ),




  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/




  /* Sub Pane one : General Settings */
  array(
    "type" => "start_sub_pane"
  ),


  array(
    "name" => "Styling & Coloring / General Skin Colors",
    "desc" => __( "These options defines your site's general colors. Main Color should be dominant and vivid color (for eg. orange, green or light blue). Supporting color is site's neutral color and dark color (for eg. dark brown or dark gray.)", "theme_backend" ),
    "type" => "heading"
  ),



  array(
    "name" => 'Theme Skin Color',
    "id" => "skin_color",
    "default" => "#00c760",
    "option_structure" => 'sub',
    "divider" => false,
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"skin_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),



  array(
    "name" => 'Body Text Color',
    "id" => "body_text_color",
    "default" => "#666666",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"body_text_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),



  array(
    "name" => 'Heading 1 (h1) Color',
    "id" => "h1_color",
    "default" => "#393836",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"h1_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),


  array(
    "name" => 'Heading 2 (h2) Color',
    "id" => "h2_color",
    "default" => "#393836",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"h2_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),


  array(
    "name" => 'Heading 3 (h3) Color',
    "id" => "h3_color",
    "default" => "#393836",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"h3_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),


  array(
    "name" => 'Heading 4 (h4) Color',
    "id" => "h4_color",
    "default" => "#393836",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"h4_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),


  array(
    "name" => 'Heading 5 (h5 Color',
    "id" => "h5_color",
    "default" => "#393836",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"h5_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),



  array(
    "name" => 'Heading 6 (h6) Color',
    "id" => "h6_color",
    "default" => "#393836",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"h6_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),



array(
    "name" => 'Paragraph (p) Color',
    "id" => "p_color",
    "default" => "#666666",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"p_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),

  

  array(
    "name" => 'Body Links Color',
    "id" => "a_color",
    "default" => "#333333",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"a_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),







  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/









  /* Sub Pane one : Main Navigation */
  array(
    "type" => "start_sub_pane"
  ),

  array(
    "name" => "Styling & Coloring / Main Navigation",
    "desc" => __( "In this section you can modify the coloring of Main Navigation Section.", "theme_backend" ),
    "type" => "heading"
  ),

    array(
    "name" => 'Menu Top Level Background Color',
    "id" => "main_nav_top_bg_color",
    "default" => "#15ac5d",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"main_nav_top_bg_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),



   array(
    "name" => 'Menu Top Level Text Color',
    "id" => "main_nav_top_text_color",
    "default" => "#fff",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"main_nav_top_text_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),



       array(
    "name" => 'Menu Top Level Hover Background Color',
    "id" => "main_nav_top_bg_hover_color",
    "default" => "#15ac5d",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"main_nav_top_bg_hover_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),


 array(
    "name" => 'Menu Top Level Hover Text Color',
    "id" => "main_nav_top_text_hover_color",
    "default" => "#fff",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"main_nav_top_text_hover_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),




   array(
    "name" => 'Menu Sub Bakcground Color',
    "id" => "main_nav_sub_bg_color",
    "default" => "#16ad5e",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"main_nav_sub_bg_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),



      array(
    "name" => 'Menu Sub Text Color',
    "id" => "main_nav_sub_text_color",
    "default" => "#fff",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"main_nav_sub_text_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),




   array(
    "name" => 'Menu Sub Hover Bakcground Color',
    "id" => "main_nav_sub_hover_bg_color",
    "default" => "#fff",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"main_nav_sub_hover_bg_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),



      array(
    "name" => 'Menu Sub Hover Text Color',
    "id" => "main_nav_sub_hover_text_color",
    "default" => "#16ad5e",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

  array(
    "id"=>"main_nav_sub_hover_text_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),      


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/





/* Sub Pane one : Skin Homepage Section */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Styling & Coloring / Homepage",
    "desc" => __( "In this section you can modify the coloring of the Homepage Section elements.", "theme_backend" ),
    "type" => "heading"
  ),


array(
    "name" => __( "Slideshow section Background", 'theme_backend' ),
    "option_structure" => 'sub',
    "id"=> 'slideshow_section_background',
    "option_structure" => 'main',
    "divider" => true,
    "type" => "specific_background_selector_start"
  ),

  array(
    "id"=>"slideshow_section_bg_color",
    "default"=> "",
    "type"=> 'specific_background_selector_color',
  ),
  array(
    "id"=>"slideshow_section_bg_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),     

  array(
    "id"=>"slideshow_section_bg_repeat",
    "default"=> "",
    "type"=> 'specific_background_selector_repeat',
  ),

  array(
    "id"=>"slideshow_section_bg_attachment",
    "default"=> "",
    "type"=> 'specific_background_selector_attachment',
  ),


  array(
    "id"=>"slideshow_section_bg_position",
    "default"=> "",
    "type"=> 'specific_background_selector_position',
  ),


  array(
    "id"=>"slideshow_section_bg_preset_image",
    "default"=> "",
    "type"=> 'specific_background_selector_image',
  ),

  array(
    "id"=>"slideshow_section_bg_custom_image",
    "default"=> "",
    "type"=> 'specific_background_selector_custom_image',
  ),

  array(
    "id"=>"slideshow_section_bg_image_source",
    "default"=> "no-image",
    "type"=> 'specific_background_selector_source',
  ),

  array(
    "divider" => true,
    "type" => "specific_background_selector_end"
  ),




  array(
    "name" => 'Homepage Tabbed Box',
    "id" => "homepage_tabbed_box_color",
    "default" => "#4a453c",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"homepage_tabbed_box_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),   




  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/


  /* Sub Pane one : Page Introduce */
  array(
    "type" => "start_sub_pane"
  ),

  array(
    "name" => "Styling & Coloring / Page Introduce",
    "desc" => __( "In this section you can modify coloring & Background of Page Introduce Section. Its located in all pages and posts which contains page title and description.", "theme_backend" ),
    "type" => "heading"
  ),


  array(
    "name" => __( "Background", 'theme_backend' ),
    "option_structure" => 'sub',
    "id"=> 'introduce_background',
    "option_structure" => 'main',
    "divider" => true,
    "type" => "specific_background_selector_start"
  ),

  array(
    "id"=>"introduce_bg_color",
    "default"=> "",
    "type"=> 'specific_background_selector_color',
  ),
  array(
    "id"=>"introduce_bg_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),     

  array(
    "id"=>"introduce_bg_repeat",
    "default"=> "",
    "type"=> 'specific_background_selector_repeat',
  ),

  array(
    "id"=>"introduce_bg_attachment",
    "default"=> "",
    "type"=> 'specific_background_selector_attachment',
  ),


  array(
    "id"=>"introduce_bg_position",
    "default"=> "",
    "type"=> 'specific_background_selector_position',
  ),


  array(
    "id"=>"introduce_bg_preset_image",
    "default"=> "",
    "type"=> 'specific_background_selector_image',
  ),

  array(
    "id"=>"introduce_bg_custom_image",
    "default"=> "",
    "type"=> 'specific_background_selector_custom_image',
  ),

  array(
    "id"=>"introduce_bg_image_source",
    "default"=> "no-image",
    "type"=> 'specific_background_selector_source',
  ),

  array(
    "divider" => true,
    "type" => "specific_background_selector_end"
  ),



  array(
    "name" => __( 'Page Introduce Subtitle', 'theme_backend' ),
    "desc" => __( "", "theme_backend" ),
    "id" => "page_subtitle_color",
    "default" => "#00c65d",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"page_subtitle_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),     

  array(
    "name" => __( 'Page Introduce Subtitle Highlight', 'theme_backend' ),
    "desc" => __( "", "theme_backend" ),
    "id" => "page_subtitle_highlight_color",
    "default" => "#fff",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"page_subtitle_highlight_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),   


    array(
    "name" => __( 'Page Introduce Description', 'theme_backend' ),
    "id" => "page_desc_color",
    "default" => "#4a453c",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
      array(
    "id"=>"page_desc_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),   


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/






/* Sub Pane one : Page Introduce */
  array(
    "type" => "start_sub_pane"
  ),

  array(
    "name" => "Styling & Coloring / Blog Section",
    "desc" => __( "In this section you can modify coloring & Background of Bolg Section.", "theme_backend" ),
    "type" => "heading"
  ),


array(
    "name" => __( 'Blog Single Post Main Container Background Color', 'theme_backend' ),
    "desc" => __( "", "theme_backend" ),
    "id" => "blog_single_container_bg_color",
    "default" => "#fff",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"blog_single_container_bg_color_rgba",
    "default"=> "0.6",
    "type"=> 'hidden_input',
  ),    


array(
    "name" => __( 'Blog Single Post Content Background Color', 'theme_backend' ),
    "desc" => __( "", "theme_backend" ),
    "id" => "blog_single_content_bg_color",
    "default" => "#fff",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "id"=>"blog_single_content_bg_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),    



  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/



  /* Sub Pane one : Siebar */
  array(
    "type" => "start_sub_pane"
  ),

  array(
    "name" => "Styling & Coloring / Sidebar",
    "desc" => __( "This section allows you to modify the coloring of sidebar elements.", "theme_backend" ),
    "type" => "heading"
  ),
  array(
    "name" => 'Sidebar Title Color',
    "id" => "sidebar_title_color",
    "default" => "#00c760",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
      array(
    "id"=>"sidebar_title_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),   



  array(
    "name" => 'Sidebar Text Color',
    "id" => "sidebar_text_color",
    "default" => "#4d4d4d",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

      array(
    "id"=>"sidebar_text_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),     

  array(
    "name" => 'Sidebar Links',
    "id" => "sidebar_links_color",
    "default" => "#666666",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
      array(
    "id"=>"sidebar_links_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),   


  array(
    "name" => 'Sidebar Links Hover',
    "id" => "sidebar_links_hover",
    "default" => "#4a4a4a",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
        array(
    "id"=>"sidebar_links_hover_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),   

  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/





  /* Sub Pane one : Footer Section */
  array(
    "type" => "start_sub_pane"
  ),

  array(
    "name" => "Styling & Coloring / Footer",
    "desc" => __( "Here, you can modify coloring of Footer section.", "theme_backend" ),
    "type" => "heading"
  ),

  


  array(
    "name" => 'Footer Title Color',
    "id" => "footer_title_color",
    "default" => "#00c65d",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
          array(
    "id"=>"footer_title_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),  

  array(
    "name" => 'Footer Text Color',
    "id" => "footer_text_color",
    "default" => "#e6dfcf",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

          array(
    "id"=>"footer_text_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),  


  array(
    "name" => 'Footer Links Color',
    "id" => "footer_links_color",
    "default" => "#e6dfcf",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
        array(
    "id"=>"footer_links_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),  


  array(
    "name" => 'Footer Links Hover Color',
    "id" => "footer_links_color_hover",
    "default" => "#e6dfcf",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

          array(
    "id"=>"footer_links_color_hover_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),  

  array(
    "name" => 'Footer Slogan Background Color',
    "id" => "footer_slogan_bg",
    "default" => "#2e281f",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

          array(
    "id"=>"footer_slogan_bg_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),  

    array(
    "name" => 'Footer Slogan Text Color',
    "id" => "footer_slogan_text_color",
    "default" => "#ddcfb5",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
        array(
    "id"=>"footer_slogan_text_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),  


     array(
    "name" => 'Sub Footer Background Color',
    "id" => "sub_footer_bg_color",
    "default" => "#7d7970",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),   
        array(
    "id"=>"sub_footer_bg_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),  
 

  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/







  /* Sub Pane one : MISC */
  array(
    "type" => "start_sub_pane"
  ),

  array(
    "name" => "Styling & Coloring / Miscellaneous",
    "type" => "heading"
  ),

  array(
    "name" => '404 Page Tabbed Box Background Color',
    "id" => "notfound_bg_color",
    "default" => "#36604a",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
        array(
    "id"=>"notfound_bg_color_rgba",
    "default"=> "1",
    "type"=> 'hidden_input',
  ),


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/








  array(
    "type"=>"end_sub"
  ),

  array(
    "type"=>"end_main_pane"
  ),
  /* End Main Pane */

























  /*
**
**
** Main Pane : Typography
-------------------------------------------------------------*/
  array(
    "type"=>"start_main_pane"
  ),




  array(
    "type" => "start_sub",
    "options" => array(
      "fonts" => __( "Fonts", 'backend' ),
      "general_typography" => __( "General Typography", 'backend' ),
      "main_navigation_typography" => __( "Main Navigation", 'backend' ),
      "page_introduce_typography" => __( "Page Introduce", 'backend' ),
      "sidebar_typography" => __( "Sidebar", 'backend' ),
      "footer_typography" => __( "Footer Section", 'backend' ),

    ),
  ),



  /* Sub Pane one : Fonts */
  array(
    "type" => "start_sub_pane"
  ),

  array(
    "name" => "Typography / Fonts",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => 'Body Font-Family',
    "id" => "font_family",
    "default" => 'Lucida Sans, Lucida Grande, Lucida Sans Unicode, sans-serif',
    "option_structure" => 'sub',
    "width"=> 430,
    "divider" => true,
    "options" => array(
      'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
      'Arial Black, Gadget, sans-serif' => 'Arial Black, Gadget, sans-serif',
      'Bookman Old Style, serif' => 'Bookman Old Style, serif',
      'Comic Sans MS, cursive' => 'Comic Sans MS, cursive',
      'Courier, monospace' => 'Courier, monospace',
      'Courier New, Courier, monospace' => 'Courier New, Courier, monospace',
      'Garamond, serif' => 'Garamond, serif',
      'Georgia, serif' => 'Georgia, serif',
      'Impact, Charcoal, sans-serif' => 'Impact, Charcoal, sans-serif',
      'Lucida Console, Monaco, monospace' => 'Lucida Console, Monaco, monospace',
      'Lucida Sans, Lucida Grande, Lucida Sans Unicode, sans-serif' => ' Lucida Sans, Lucida Grande, Lucida Sans Unicode, sans-serif',
      'MS Sans Serif, Geneva, sans-serif' => 'MS Sans Serif, Geneva, sans-serif',
      'MS Serif, New York, sans-serif' => 'MS Serif, New York, sans-serif',
      'Palatino Linotype, Book Antiqua, Palatino, serif' => 'Palatino Linotype, Book Antiqua, Palatino, serif',
      'Tahoma, Geneva, sans-serif' => 'Tahoma, Geneva, sans-serif',
      'Times New Roman, Times, serif' => 'Times New Roman, Times, serif',
      'Trebuchet MS, Helvetica, sans-serif' => 'Trebuchet MS, Helvetica, sans-serif',
      'Verdana, Geneva, sans-serif' => 'Verdana, Geneva, sans-serif'
    ),
    "type" => "select"
  ),

  array(
    "name" => "1. Choose a font",
    "id" => "special_fonts_list_1",
    "default" => 'TitilliumText22LRegular',
    "function" => 'fonts_list',
    "type" => "custom"
  ),
  array(
    "id" => "special_fonts_type_1",
    "default" => 'fontface',
    "type" => "special_font"
  ),

  array(
    "name" => "2. Specify which sections use the above font ",
    "id" => "special_elements_1",
    "option_structure" => 'sub',
    "divider" => true,
    "default" => array(
    'h1',
    'h2',
    'h3',
    'h4',
    'h5',
    'h6',
    '.mk-content-box',
    ".the-title",
    ".filter-portfolio a",
    '.mk-fancy-text',
    '#mk-page-introduce',
    '#mk-main-navigation ul li a',
    '#mk-header .mk-searchform .text-input',
    ".mk-button",
    ".mk-blockquote",
    '.mk-pricing-table .mk-offer-title, .mk-pricing-table .mk-pricing-plan, .mk-pricing-table .mk-pricing-price',
    'textarea, input[type=text], input[type=password], input[type=email], select',
    '.mk-skill-meter-title',
    '.client-title',
    '.mk-banner-text-caption',
    '.mk-tabs-tabs a',
    '.mk-accordion-tab',
    '.mk-toggle-title',
    '#cboxTitle',
    '#mk-footer-navigation ul li a',
    '.mk-footer-copyright',
    '.mk-slideshow-shortcode .mk-flex-caption',
    '.team-member-name, .team-member-position',
    '.mk-fancy-divider',
    '.mk-dropcaps',
    '.big-numbers-count' ,
    '.widget-sub-navigation ul li a',
    '.pinterest-widget-title',
    '.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price',
    '.woocommerce .mk-onsale'
    ),
    "options" => $font_replacement_objects,
    "type" => "multiselect"
  ),
  
  array(
    "id" => "special_fonts_type_2",
    "default" => 'fontface',
    "type" => "special_font"
  ),
  array(
    "name" => "1. Choose a font",
    "id" => "special_fonts_list_2",
    "default" => '',
    "function" => 'fonts_list',
    "type" => "custom"
  ),
  array(
    "name" => "2. Specify which sections use the above font ",
    "id" => "special_elements_2",
    "divider" => true,
    "default" => array(),
    "options" => $font_replacement_objects,
    "type" => "multiselect"
  ),



  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/












  /* Sub Pane one : General Typography */
  array(
    "type" => "start_sub_pane"
  ),

  array(
    "name" => "Typography / General Typography",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => 'Body Text Size',
    "id" => "body_font_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "12",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Body Text Weight',
    "id" => "body_weight",
    "default" => 'normal',
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "option_structure" => 'sub',
    "divider" => true,
    "width"=>180,
    "type" => "select"
  ),


  array(
    "name" => 'Pragraph (p) Text Size',
    "id" => "p_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "12",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => 'Heading 1 (h1) Size',
    "id" => "h1_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "36",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Heading 1 (h1) Weight',
    "id" => "h1_weight",
    "default" => 'bold',
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "option_structure" => 'sub',
    "divider" => true,
    "width"=>180,
    "type" => "select"
  ),

  array(
    "name" => 'Heading 2 (h2) Size',
    "id" => "h2_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "30",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Heading 2 (h2) Weight',
    "id" => "h2_weight",
    "default" => 'bold',
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "option_structure" => 'sub',
    "divider" => true,
    "width"=>180,
    "type" => "select"
  ),


  array(
    "name" => 'Heading 3 (h3) Size',
    "id" => "h3_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "24",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Heading 3 (h3) Weight',
    "id" => "h3_weight",
    "default" => 'bold',
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "option_structure" => 'sub',
    "divider" => true,
    "width"=>180,
    "type" => "select"
  ),






  array(
    "name" => 'Heading 4 (h4) Size',
    "id" => "h4_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "18",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Heading 4 (h4) Weight',
    "id" => "h4_weight",
    "default" => 'bold',
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "option_structure" => 'sub',
    "divider" => true,
    "width"=>180,
    "type" => "select"
  ),



  array(
    "name" => 'Heading 5 (h5) Size',
    "id" => "h5_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "16",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Heading 5 (h5) Weight',
    "id" => "h5_weight",
    "default" => 'bold',
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "option_structure" => 'sub',
    "divider" => true,
    "width"=>180,
    "type" => "select"
  ),



  array(
    "name" => 'Heading 6 (h6) Size',
    "id" => "h6_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "14",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Heading 6 (h6) Weight',
    "id" => "h6_weight",
    "default" => 'normal',
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "option_structure" => 'sub',
    "divider" => true,
    "width"=>180,
    "type" => "select"
  ),



  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/















  /* Sub Pane one : Typography Main Navigation */
  array(
    "type" => "start_sub_pane"
  ),


  array(
    "name" => "Typography / Main Navigation",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => 'Menu Top Level Text Size',
    "id" => "main_nav_top_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "13",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Menu Top Level Text Weight',
    "id" => "main_nav_top_weight",
    "default" => 'bold',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/












  /* Sub Pane one : Typography Page Introduce */
  array(
    "type" => "start_sub_pane"
  ),

  array(
    "name" => "Typography / Page Introduce",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => __( 'Page Introduce Title Size', 'theme_backend' ),
    "id" => "page_introduce_title_size",
    "min" => "10",
    "max" => "120",
    "step" => "1",
    "unit" => 'px',
    "default" => "44",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),


  array(
    "name" => __( 'Page Introduce Title Line Height', 'theme_backend' ),
    "id" => "introduce_title_line_height",
    "min" => "10",
    "max" => "120",
    "step" => "1",
    "unit" => 'px',
    "default" => "68",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => __( 'Page Introduce Title Weight', 'theme_backend' ),
    "id" => "page_introduce_weight",
    "default" => 'bold',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),

  array(
    "name" => __( 'Page Introduce Subtitle Size', 'theme_backend' ),
    "id" => "page_introduce_subtitle_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "20",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => __( 'Page Introduce Subtitle Line Height', 'theme_backend' ),
    "id" => "page_introduce_subtitle_line_height",
    "min" => "10",
    "max" => "150",
    "step" => "1",
    "unit" => 'px',
    "default" => "40",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => __( 'Page Introduce Description Size', 'theme_backend' ),
    "id" => "page_desc_size",
    "min" => "10",
    "max" => "30",
    "step" => "1",
    "unit" => 'px',
    "default" => "14",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/










  /* Sub Pane one : Typography Siebar */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Typography / Sidebar",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => 'Sidebar Title Size',
    "id" => "sidebar_title_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "18",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Sidebar Title Weight',
    "id" => "sidebar_title_weight",
    "default" => 'bold',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),

  array(
    "name" => 'Sidebar Text Size',
    "id" => "sidebar_text_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "12",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Sidebar Text Weight',
    "id" => "sidebar_text_weight",
    "default" => 'normal',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),




  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/












  /* Sub Pane one : Typography Footer */
  array(
    "type" => "start_sub_pane"
  ),


  array(
    "name" => "Typography / Footer",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),


  array(
    "name" => 'Footer Title Size',
    "id" => "footer_title_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "16",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Footer Title Weight',
    "id" => "footer_title_weight",
    "default" => 'normal',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),


  array(
    "name" => 'Footer Text Size',
    "id" => "footer_text_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "11",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Footer Text Weight',
    "id" => "footer_text_weight",
    "default" => 'normal',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),



  array(
    "name" => 'Footer Slogan Size',
    "id" => "footer_slogan_text_size",
    "min" => "10",
    "max" => "70",
    "step" => "1",
    "unit" => 'px',
    "default" => "22",
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

  array(
    "type"=>"end_main_pane"
  ),
  /* End Main Pane */

















  /*
**
**
** Main Pane : Slideshow
-------------------------------------------------------------*/
  array(
    "type"=>"start_main_pane"
  ),




  array(
    "type" => "start_sub",
    "options" => array(
      "general_slideshow" => __( "General Settings", 'backend' ),
      "layer_slider" => __( "Layer Slider", 'backend' ),
      "revolution_slider" => __( "Revolution Slider", 'backend' ),
      "flexslider" => __( "Flexslider", 'backend' ),

    ),
  ),



  /* Sub Pane one : Slideshow General Settings */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Slideshow / General Settings",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => "Slideshow",
    "desc" => __( "", "theme_backend" ),
    "id" => "disable_slideshow",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Select Your Slideshow", "theme_backend" ),
    "desc" => __( "Select which sort of slideshow you would like to include in your website", "theme_backend" ),
    "id" => "slideshow_source",
    "default" => 'flexslider',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "layerslider" => 'Layer Slider',
      "revslider" => 'Revolution Slider',
      "flexslider" => 'Flexslider',
    ),
    "type" => "radio"
  ),

 
  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/












  /* Sub Pane one : Layer Slider */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Slideshow / Layer Slider",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => __( "Select Slider", 'theme_backend' ),
    "desc" => __( "Select which slider you would like to show on your homepage.", 'theme_backend' ),
    "id" => "layer_slider_source",
    "default" => '1',
    "target" => 'layer_slider_source',
    "option_structure" => 'sub',
    "divider" => true,
    "width"=> 200,
    "type" => "select"
  ),



  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/












  /* Sub Pane one : Anything Slider */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Slideshow / Revolution Slider",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),
 

   array(
    "name" => __( "Select Slider", 'theme_backend' ),
    "desc" => __( "Select which slider you would like to show on your homepage.", 'theme_backend' ),
    "id" => "rev_slider_source",
    "default" => '',
    "target" => 'revolution_slider',
    "option_structure" => 'sub',
    "divider" => true,
    "width"=> 200,
    "type" => "select"
  ),

  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/












  /* Sub Pane one : Flexslider */
  array(
    "type" => "start_sub_pane"
  ),

  array(
    "name" => "Slideshow / Flexslider",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),


  array(
    "name" => __( "Layout", "theme_backend" ),
    "desc" => __( "If you choose full width layout, then you should upload 1920px width images to fit the large screens.", "theme_backend" ),
    "id" => "flexslider_layout",
    "option_structure" => 'sub',
    "divider" => true,
    "default" => 'boxed_layout',
    "options" => array(
      "boxed_layout" => 'Boxed',
      "full_width" => 'Full Width',
    ),
    "type" => "radio"
  ),

  array(
    "name" => __( "Slideshow Items to show (Optional)", "theme_backend" ),
    "desc" => __( "You may choose which items to be shown on this slideshow. This is fully optional. In case you leave this field empty, all items will be shown", "theme_backend" ),
    "id" => "flexslider_items",
    "option_structure" => 'sub',
    "divider" => true,
    "default" => array(),
    "target" => 'slideshow',
    "type" => "multiselect"
  ),

  array(
    "name" => __( "Slideshow Height", "theme_backend" ),
    "desc" => __( "Adjust your slideshow's height here", "theme_backend" ),
    "id" => "flexslider_height",
    "option_structure" => 'sub',
    "divider" => true,
    "min" => "100",
    "max" => "1000",
    "step" => "10",
    "unit" => 'px',
    "default" => "400",
    "type" => "range"
  ),
  array(
    "name" => __( "Effect", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "flexslider_animation",
    "option_structure" => 'sub',
    "divider" => true,
    "default" => 'slide',
    "options" => array(
      "fade" => 'Fade',
      "slide" => 'Slide',
    ),
    "type" => "radio"
  ),


array(
    "name" => __( "Number of Slides", "theme_backend" ),
    "desc" => __( "Set how many Slides to be shown on your slider.", "theme_backend" ),
    "id" => "slideshow_count",
    "min" => "1",
    "max" => "30",
    "step" => "1",
    "default" => "10",
    "unit" => 'Slides',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => __( "Caption", "theme_backend" ),
    "desc" => __( "If this option is disabled, the title, description,  read-more button will be disabled.", "theme_backend" ),
    "id" => "flexslider_disableCaption",
    "default" => "true",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Orderby", 'theme_backend' ),
    "desc" => __( "Sort retrieved Slideshow items by parameter.", 'theme_backend' ),
    "id" => "slideshow_orderby",
    "default" => 'menu_order',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "none" => __( "No order", 'theme_backend' ),
      "id" => __( "Order by post id", 'theme_backend' ),
      "title" => __( "Order by title", 'theme_backend' ),
      "date" => __( "Order by date", 'theme_backend' ),
      "rand" => __( "Random order", 'theme_backend' ),
    ),
    "type" => "select"
  ),
  array(
    "name" => __( "Order", 'theme_backend' ),
    "desc" => __( "Designates the ascending or descending order of the 'orderby' parameter.", 'theme_backend' ),
    "id" => "slideshow_order",
    "default" => 'ASC',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "ASC" => __( "ASC (ascending order)", 'theme_backend' ),
      "DESC" => __( "DESC (descending order)", 'theme_backend' )
    ),
    "type" => "radio"
  ),

  array(
    "name" => __( "Autoplay", "theme_backend" ),
    "desc" => __( "Enable this option if you would like slider to autoplay.", "theme_backend" ),
    "id" => "flexslider_slideshow",
    "default" => "true",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
    array(
    "name" => __( "Pause on Hover", "theme_backend" ),
    "desc" => __( "If true & the slideshow is active, the slideshow will pause on hover.", "theme_backend" ),
    "id" => "flexslider_pauseOnHover",
    "default" => "true",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Slideshow Speed", "theme_backend" ),
    "desc" => __( "Time elapsed between each autoplay sliding case.", "theme_backend" ),
    "id" => "flexslider_slideshowSpeed",
    "min" => "2000",
    "max" => "20000",
    "step" => "100",
    "unit" => 'ms',
    "default" => "5000",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => __( "Animation Duration", "theme_backend" ),
    "desc" => __( "Speed of animation", "theme_backend" ),
    "id" => "flexslider_animationDuration",
    "min" => "200",
    "max" => "10000",
    "step" => "100",
    "unit" => 'ms',
    "default" => "600",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => __( "Slider Easing", "theme_backend" ),
    "desc" => __( "Set the easing of the sliding animation.", "theme_backend" ),
    "id" => "flexslider_easing",
    "default" => 'easeOutCubic',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "" => 'none',
      "linear" => 'linear',
      "swing" => 'swing',
      "easeInQuad" => 'easeInQuad',
      "easeOutQuad" => 'easeOutQuad',
      "easeInOutQuad" => 'easeInOutQuad',
      "easeInCubic" => 'easeInCubic',
      "easeOutCubic" => 'easeOutCubic',
      "easeInOutCubic" => 'easeInOutCubic',
      "easeInQuart" => 'easeInQuart',
      "easeOutQuart" => 'easeOutQuart',
      "easeInOutQuart" => 'easeInOutQuart',
      "easeInQuint" => 'easeInQuint',
      "easeOutQuint" => 'easeOutQuint',
      "easeInOutQuint" => 'easeInOutQuint',
      "easeInSine" => 'easeInSine',
      "easeOutSine" => 'easeOutSine',
      "easeInOutSine" => 'easeInOutSine',
      "easeInExpo" => 'easeInExpo',
      "easeOutExpo" => 'easeOutExpo',
      "easeInOutExpo" => 'easeInOutExpo',
      "easeInCirc" => 'easeInCirc',
      "easeOutCirc" => 'easeOutCirc',
      "easeInOutCirc" => 'easeInOutCirc',
      "easeInElastic" => 'easeInElastic',
      "easeOutElastic" => 'easeOutElastic',
      "easeInOutElastic" => 'easeInOutElastic',
      "easeInBack" => 'easeInBack',
      "easeOutBack" => 'easeOutBack',
      "easeInOutBack" => 'easeInOutBack',
      "easeInBounce" => 'easeInBounce',
      "easeOutBounce" => 'easeOutBounce',
      "easeInOutBounce" => 'easeInOutBounce'
    ),
    "type" => "select"
  ),




  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/








  array(
    "type"=>"end_sub"
  ),

  array(
    "type"=>"end_main_pane"
  ),
  /* End Main Pane */















  /*
**
**
** Main Pane : Portfolio
-------------------------------------------------------------*/
  array(
    "type"=>"start_main_pane"
  ),




  array(
    "type" => "start_sub",
    "options" => array(
      "portfolio_general" => __( "General Settings", 'backend' ),
      "portfolio_single" => __( "Portfolio Single Post", 'backend' ),

    ),
  ),



  /* Sub Pane one : Portfolio General Settings */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Portfolio / General Settings",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => "Portfolio Slug",
    "desc" => __( "Portfolio Slug is the text that is displyed in the URL (e.g. www.domain.com/<strong>portfolio</strong>/morbi-et-diam-massa/). As shown in the example, it is set to 'portfolio' by default but you can change it to anything to suite your preference. Upon changing this option save settings. then go to settings > permalink, return its setting to the first default option, save settings. then return back permalink format option to your prevsiouly defined format and then save settings. this action will flush the permalink settings and only then the portfolio slug will be changed.", "theme_backend" ),
    "id" => "portfolio_slug",
    "default" => 'portfolio',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/












  /* Sub Pane one : Portfolio Single Post */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Portfolio / Single Post",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),



  array(
    "name" => __( "Post Featured Image Height", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "Portfolio_single_image_height",
    "min" => "100",
    "max" => "1000",
    "step" => "1",
    "default" => "400",
    "unit" => 'px',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

    array(
    "name" => __( "Brief Info Section", "theme_backend" ),
    "desc" => __( "This option allows you to enable or disable the Brief Info Box. You can fill its content while adding a new portfolio post > Paragon Portfolio Options Metabox > Single Post Options. you may disable this option if you dont want this box to be appeared beneath Featured Image.", "theme_backend" ),
    "id" => "enable_portfolio_brief_info",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),


    array(
    "name" => __( "Client Logo Section", "theme_backend" ),
    "desc" => __( "This option allows you to enable or disable the company or client logo section. You can fill its content while adding a new portfolio post > Paragon Portfolio Options Metabox > Single Post Options. you may disable this option if you dont want this box to be appeared beneath Featured Image right side.", "theme_backend" ),
    "id" => "enable_portfolio_logo_box",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),


      array(
    "name" => __( "Similar Posts Section", "theme_backend" ),
    "desc" => __( "This option allows you to enable or disable the similar posts section.", "theme_backend" ),
    "id" => "enable_portfolio_similar_posts",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),  

  array(
    "name" => __( "Comment", "theme_backend" ),
    "desc" => __( "This option allows you to enable or disable the comment section on your single portfolio page.", "theme_backend" ),
    "id" => "enable_portfolio_comment",
    "default" => 'false',
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

  array(
    "type"=>"end_main_pane"
  ),
  /* End Main Pane */































  /*
**
**
** Main Pane : Blog
-------------------------------------------------------------*/
  array(
    "type"=>"start_main_pane"
  ),




  array(
    "type" => "start_sub",
    "options" => array(
      "blog_general" => __( "General Settings", 'backend' ),
      "blog_single_post" => __( "Blog Single Post", 'backend' ),
      "archive_posts" => __( "Archive", 'backend' ),
      "search_posts" => __( "Search", 'backend' ),
      "404" => __( "404", 'backend' ),

    ),
  ),



  /* Sub Pane one : General Settings */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Blog / General Settings",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

 
  array(
    "name" => __( "Exclude Categories", "theme_backend" ),
    "desc" => __( "The option allows you to exclude as many categories as you like from your blog loop.", "theme_backend" ),
    "id" => "excluded_cats",
    "default" => array(),
    "target" => "cat",
    "option_structure" => 'sub',
    "divider" => true,
    "prompt" => "Choose category..",
    "type" => "multiselect"
  ),

  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/












  /* Sub Pane one : Blog Single Post */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Blog / Single Post",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),
  array(
    "name" => __( "Single Layout", "theme_backend" ),
    "desc" => __( "This option allows you to define the page layout of Blog Single page as full width without sidebar, left sidebar or right sidebar.", "theme_backend" ),
    "id" => "single_layout",
    "default" => "full",
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "20px 30px 0 0",
    "options" => array(
      "left" => 'page-layout-left',
      "right" => 'page-layout-right',
      "full" => 'page-layout-full',
    ),
    "type" => "visual_selector"
  ),
  array(
    "name" => __( "Featured Image Height", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "single_featured_image_height",
    "min" => "100",
    "max" => "1000",
    "step" => "1",
    "default" => "300",
    "unit" => 'px',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => __( "About Author Box", "theme_backend" ),
    "desc" => __( "You can enable or disable the about author box from here. You can modify about author information from your profile settings. Besides, if you add your website URL, your email address and twitter account from extra profile information they will be displayed as an icon link.", "theme_backend" ),
    "id" => "enable_blog_author",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Social Share", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "enable_single_social",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
    array(
    "name" => __( "Meta Tags", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "diable_single_tags",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Similar Posts", "theme_backend" ),
    "desc" => __( "If you do not want to display similar posts on the bottom of the blog single page then you can disable the option.", "theme_backend" ),
    "id" => "enable_single_related_posts",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Blog Posts Comments", "theme_backend" ),
    "desc" => __( "", "theme_backend" ),
    "id" => "enable_blog_single_comments",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/












  /* Sub Pane one : Archive */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Blog / Archive",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),
  array(
    "name" => __( "Archive Layout", "theme_backend" ),
    "id" => "archive_page_layout",
    "default" => "right",
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "20px 30px 0 0",
    "options" => array(
      "left" => 'page-layout-left',
      "right" => 'page-layout-right',
      "full" => 'page-layout-full',
    ),
    "type" => "visual_selector"
  ),


  array(
    "name" => __( "Archive Page Title", "theme_backend" ),
    "desc" => __( "Using this option you can add a title to archive page.", "theme_backend" ),
    "id" => "archive_page_title",
    "default" => __( "Archives", "theme_backend" ),
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),

    array(
    "name" => __( "Fancy Archive Title?", "theme_backend" ),
    "desc" => __( "If you would like to place the Title into fancy rounded highlight enable this options.", "theme_backend" ),
    "id" => "archive_fancy_title",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),


  array(
    "name" => __( "Archive Page Subtitle", "theme_backend" ),
    "desc" => __( "You can disable or enable Archive page Subtitle.", "theme_backend" ),
    "id" => "archive_disable_subtitle",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Archive Page Description", "theme_backend" ),
    "desc" => __( "Using this option you can add a Page description to archive page.", "theme_backend" ),
    "id" => "archive_page_desc",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),



  array(
    "name" => __( "Archive Loop Style", "theme_backend" ),
    "id" => "archive_loop_style",
    "default" => 'classic',
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "30px 40px 20px 0",
    "options" => array(
      "classic" => 'blog-loop-classic',
      "classic_thumb" => 'blog-loop-classic-thumbnail',
      "newspaper" => 'blog-loop-newspaper',
      'metro' => 'blog-loop-metro'
    ),
    "type" => "visual_selector"
  ),


  array(
    "name" => __( "Pagination Style", "theme_backend" ),
    "id" => "archive_pagination_style",
    "default" => '1',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "1" => 'Pagination Nav',
      "2" => 'Load More Button',
      "3" => 'Load on Scroll Page',

    ),
    "type" => "radio"
  ), 


    array(
    "name" => __( "Column", "theme_backend" ),
    "id" => "archive_loop_column",
    "default" => '1',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "1" => '1 Column',
      "2" => '2 Column',
      "3" => '3 Column',
      "4" => '4 Column',
    ),
    "type" => "Select"
  ),




  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/












  /* Sub Pane one : Search */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Blog / Search",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => __( "Search Layout", "theme_backend" ),
    "id" => "search_page_layout",
    "default" => "right",
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "20px 30px 0 0",
    "options" => array(
      "left" => 'page-layout-left',
      "right" => 'page-layout-right',
      "full" => 'page-layout-full',
    ),
    "type" => "visual_selector"
  ),


 
  array(
    "name" => __( "Search Page Title", "theme_backend" ),
    "desc" => __( "Using this option you can add a subtitle to Search page.", "theme_backend" ),
    "id" => "search_page_title",
    "default" => __( "Search", "theme_backend" ),
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),

    array(
    "name" => __( "Fancy Search Title?", "theme_backend" ),
    "desc" => __( "If you would like to place the Title into fancy rounded highlight enable this options.", "theme_backend" ),
    "id" => "search_fancy_title",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Search Page subtitle", "theme_backend" ),
    "desc" => __( "You can disable or enable Search page subtitle.", "theme_backend" ),
    "id" => "search_disable_subtitle",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Search Page Description", "theme_backend" ),
    "desc" => __( "Using this option you can add a Page description to Search page.", "theme_backend" ),
    "id" => "search_page_desc",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),




  array(
    "name" => __( "Search Loop Style", "theme_backend" ),
    "id" => "search_loop_style",
    "default" => 'classic',
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "30px 40px 20px 0",
    "options" => array(
      "classic" => 'blog-loop-classic',
      "classic_thumb" => 'blog-loop-classic-thumbnail',
      "newspaper" => 'blog-loop-newspaper',
      'metro' => 'blog-loop-metro'
    ),
    "type" => "visual_selector"
  ),


  array(
    "name" => __( "Pagination Style", "theme_backend" ),
    "id" => "search_pagination_style",
    "default" => '1',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "1" => 'Pagination Nav',
      "2" => 'Load More Button',
      "3" => 'Load on Scroll Page',

    ),
    "type" => "radio"
  ), 


    array(
    "name" => __( "Column", "theme_backend" ),
    "id" => "search_loop_column",
    "default" => '1',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "1" => '1 Column',
      "2" => '2 Column',
      "3" => '3 Column',
      "4" => '4 Column',
    ),
    "type" => "Select"
  ),
  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/



/* Sub Pane one : Search */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Blog / 404",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),



    array(
    "name" => __( "404 Page Title", "theme_backend" ),
    "desc" => __( "Using this option you can modify Title in 404 page.", "theme_backend" ),
    "id" => "notfound_page_title",
    "default" => '404 - Not Found',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),

  array(
    "name" => __( "404 Page Subtitle", "theme_backend" ),
    "desc" => __( "Using this option you can modify subtitle in 404 page.", "theme_backend" ),
    "id" => "notfound_page_subtitle",
    "default" => 'Apologies, but the page you requested could not be found. Try using sitemap below.',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),

  array(
    "name" => __( "404 Page Description", "theme_backend" ),
    "desc" => __( "Using this option you can add a Page description to 404 page.", "theme_backend" ),
    "id" => "notfound_page_desc",
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

  array(
    "type"=>"end_main_pane"
  ),
  /* End Main Pane */















  /*
**
**
** Main Pane : Advanced
-------------------------------------------------------------*/
  array(
    "type"=>"start_main_pane"
  ),




  array(
    "type" => "start_sub",
    "options" => array(
      "seo" => __( "SEO", 'backend' ),
      "custom_js" => __( "Custom JS", 'backend' ),
      "custom_css" => __( "Custom CSS", 'backend' ),
      "woocommrce" => __( "Woocommerce", 'backend' ),
      "export_options" => __( "Export Options", 'backend' ),
      "import_options" => __( "Import Options", 'backend' ),
      "container_width" => __( "Container Width", 'backend' ),

    ),
  ),



  /* Sub Pane one : SEO */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Advanced / SEO",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),


  array(
    "name" => "Google Analytics ID",
    "desc" => __( "Enter your Google Analytics ID here to track your site with Google Analytics.", "theme_backend" ),
    "id" => "analytics",
    "default" => "",
    "size" => 70,
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),
  
  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/












  /* Sub Pane one : Custom JS */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Advanced / Custom JS",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => __( "Custom JS", "theme_backend" ),
    "desc" => __( "You can write your own custom Javascript here in texarea. So you wont need to modify theme files.", "theme_backend" ),
    "id" => "custom_js",
    "default" => '',
    "rows" => 30,
    "type" => "textarea"
  ),

  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/












  /* Sub Pane one : Custom CSS */
  array(
    "type" => "start_sub_pane"
  ),


  array(
    "name" => "Advanced / Custom CSS",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => __( "Custom CSS", "theme_backend" ),
    "desc" => __( "You can write your own custom css, this way you wont need to modify Theme CSS files.", "theme_backend" ),
    "id" => "custom_css",
    "default" => '',
    "rows" => 30,
    "type" => "textarea"
  ),


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/


 



  /* Sub Pane one : SEO */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Advanced / Woocommerce",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),


array(
    "name" => __( "Enable Woocommerce", "theme_backend" ),
    "desc" => __( "After you have installed Woocommerce, you will need to enable this option.", "theme_backend" ),
    "id" => "enable_woocommerce",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),



  array(
    "name" => __( "Woocommerce Page Layout", "theme_backend" ),
    "id" => "woocommerce_layout",
    "default" => "full",
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "20px 30px 30px 0",
    "options" => array(
      "left" => 'page-layout-left',
      "right" => 'page-layout-right',
      "full" => 'page-layout-full',
    ),
    "type" => "visual_selector"
  ),


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/






  /* Sub Pane one : Export Options */
  array(
    "type" => "start_sub_pane"
  ),

  array(
    "name" => "Advanced / Export Options",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => "Export Options",
    "desc" => __( "", "theme_backend" ),
    "id" => "theme_export_options",
    "default" => '',
    "rows"=> 30,
    "option_structure" => 'main',
    "divider" => false,
    "type" => "export"
  ),


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/





  /* Sub Pane one : Import Options */
  array(
    "type" => "start_sub_pane"
  ),
  array(
    "name" => "Advanced / Import Options",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => "Import Options",
    "desc" => __( "", "theme_backend" ),
    "id" => "theme_import_options",
    "default" => '',
    "rows"=> 30,
    "option_structure" => 'main',
    "divider" => false,
    "type" => "import"
  ),


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/



  /* Sub Pane one : Custom CSS */
  array(
    "type" => "start_sub_pane"
  ),


  array(
    "name" => "Advanced / Container Width",
    "desc" => __( "", "theme_backend" ),
    "type" => "heading"
  ),

 array(
    "name" => __( "Main Container Width", "theme_backend" ),
    "desc" => __( "Currently This theme's container width is 1140px, You can change its value any range between 1000 and 1300. please change this option if you know what you are doing.", "theme_backend" ),
    "id" => "container_width",
    "option_structure" => 'sub',
    "divider" => true,
    "min" => "1000",
    "max" => "1300",
    "step" => "1",
    "unit" => 'px',
    "default" => "1140",
    "type" => "range"
),


  array(
    "type"=>"end_sub_pane"
  ),
  /*****************************/




  array(
    "type"=>"end_sub"
  ),

  array(
    "type"=>"end_main_pane"
  ),
  /* End Main Pane */





  /***************************/
  array(
    "type"=>"end"
  )



);
return array(
  'auto' => true,
  'name' => THEME_OPTIONS,
  'options' => $options
);
