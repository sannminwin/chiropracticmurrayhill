<?php
/**
 * Get current theme options
 * 
 * @return array
 */
function aletheme_get_options() {
	$comments_style = array(
		'wp'  => 'Socha Comments',
		'fb'  => 'Facebook Comments',
		'dq'  => 'DISQUS',
		'lf'  => 'Livefyre',
        'ws'  => 'WordPress Default',
		'off' => 'Disable All Comments',
	);

    $color_style = array(
        'orange' => 'Orange Color',
        'green' => 'Green Color',
        'black' => 'Black Color',
        'red' => 'Red Color',
        'blue' => 'Blue Color',
        'purple' => 'Purple Color'
    );

    $home_bottom = array(
        'blogposts' => 'Blog Posts',
        'recentposts' => '3 Recent Blog Posts',
        'customboxes' => 'Custom Boxes',
        'customcontent' => 'Page Content',
        'hideboxes' => 'Hide Blocks'
    );

	
	$imagepath =  ALETHEME_URL . '/assets/images/';
	
	$options = array();
		
	$options[] = array("name" => "Theme",
						"type" => "heading");

    $options[] = array( "name" => "Site Logo",
                        "desc" => "Upload or put the site logo link (Default logo size: 158-101px)",
                        "id" => "ale_sitelogo",
                        "std" => "",
                        "type" => "upload");

    $options[] = array( "name" => "Color Style",
                        "desc" => "Select color:",
                        "id" => "ale_site_color",
                        "std" => "wp",
                        "type" => "select",
                        "options" => $color_style);

    $options[] = array( "name" => "Uplaod a custom background",
                        "desc" => "For example you can take backgrounds here - <a href=\"http://subtlepatterns.com/\">http://subtlepatterns.com/</a>",
                        "id" => "ale_background",
                        "std" => "",
                        "type" => "upload");

    $options[] = array( "name" => "Uplaod a favicon icon",
                        "desc" => "Upload or put the link of your favicon icon",
                        "id" => "ale_favicon",
                        "std" => "",
                        "type" => "upload");

	$options[] = array( "name" => "Comments Style",
						"desc" => "Choose your comments style. If you want to use DISQUS comments please install and activate this plugin from <a href=\"" . admin_url('plugin-install.php?tab=search&type=term&s=Disqus+Comment+System&plugin-search-input=Search+Plugins') . "\">Wordpress Repository</a>.  If you want to use Livefyre Realtime Comments comments please install and activate this plugin from <a href=\"" . admin_url('plugin-install.php?tab=search&type=term&s=Livefyre+Realtime+Comments&plugin-search-input=Search+Plugins') . "\">Wordpress Repository</a>.",
						"id" => "ale_comments_style",
						"std" => "wp",
						"type" => "select",
						"options" => $comments_style);

	$options[] = array( "name" => "AJAX Comments",
						"desc" => "Use AJAX on comments posting (works only with Socha Comments selected).",
						"id" => "ale_ajax_comments",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Social Sharing",
						"desc" => "Enable social sharing for posts.",
						"id" => "ale_social_sharing",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Copyrights",
						"desc" => "Your copyright message.",
						"id" => "ale_copyrights",
						"std" => "",
						"type" => "editor");

    $options[] = array( "name" => "Google Font for Titles and Headings",
                        "desc" => "Get the font from <a href=\"http://www.google.com/fonts\">http://www.google.com/fonts</a>. Ex: Oswald:400,300",
                        "id" => "ale_fontlink",
                        "std" => "Oswald:400,300",
                        "type" => "text");

    $options[] = array( "name" => "Font-family for Titles and Headings",
                        "desc" => "Get the font from <a href=\"http://www.google.com/fonts\">http://www.google.com/fonts</a>. Ex: 'Oswald', sans-serif",
                        "id" => "ale_titlefontfamily",
                        "std" => "'Oswald', sans-serif",
                        "type" => "text");

    $options[] = array( "name" => "Home",
                        "type" => "heading");

    $options[] = array( "name" => "Home Page Right Menu",
                        "desc" => "Enable right box menu on Home Page",
                        "id" => "ale_righthomemenu",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Right menu Image #1",
                        "desc" => "Upload or insert image URL (first item) - size: 225px-92px.",
                        "id" => "ale_right_first_image",
                        "class" => "hidden",
                        "type" => "upload");

    $options[] = array( "name" => "Right menu Title #1",
                        "desc" => "Insert the title (first item)",
                        "id" => "ale_right_first_title",
                        "class" => "hidden",
                        "type" => "text");

    $options[] = array( "name" => "Right menu Description #1",
                        "desc" => "Insert the description (first item)",
                        "id" => "ale_right_first_desc",
                        "class" => "hidden",
                        "type" => "text");

    $options[] = array( "name" => "Right menu Link #1",
                        "desc" => "Insert the link (first item)",
                        "id" => "ale_right_first_link",
                        "class" => "hidden",
                        "type" => "text");

    $options[] = array( "name" => "Right menu Image #2",
                        "desc" => "Upload or insert image URL (second item) - size: 225px-92px.",
                        "id" => "ale_right_second_image",
                        "class" => "hidden",
                        "type" => "upload");

    $options[] = array( "name" => "Right menu Title #2",
                        "desc" => "Insert the title (second item)",
                        "id" => "ale_right_second_title",
                        "class" => "hidden",
                        "type" => "text");

    $options[] = array( "name" => "Right menu Description #2",
                        "desc" => "Insert the description (second item)",
                        "id" => "ale_right_second_desc",
                        "class" => "hidden",
                        "type" => "text");

    $options[] = array( "name" => "Right menu Link #2",
                        "desc" => "Insert the link (second item)",
                        "id" => "ale_right_second_link",
                        "class" => "hidden",
                        "type" => "text");

    $options[] = array( "name" => "Right menu Image #3",
                        "desc" => "Upload or insert image URL (third item) - size: 225px-92px.",
                        "id" => "ale_right_third_image",
                        "class" => "hidden",
                        "type" => "upload");

    $options[] = array( "name" => "Right menu Title #3",
                        "desc" => "Insert the title (third item)",
                        "id" => "ale_right_third_title",
                        "class" => "hidden",
                        "type" => "text");

    $options[] = array( "name" => "Right menu Description #3",
                        "desc" => "Insert the description (third item)",
                        "id" => "ale_right_third_desc",
                        "class" => "hidden",
                        "type" => "text");

    $options[] = array( "name" => "Right menu Link #3",
                        "desc" => "Insert the link (third item)",
                        "id" => "ale_right_third_link",
                        "class" => "hidden",
                        "type" => "text");

    $options[] = array( "name" => "About title (box on main page)",
                        "desc" => "Insert the title",
                        "id" => "ale_mainpageabouttitle",
                        "type" => "text");

    $options[] = array( "name" => "About text (box on main page)",
                        "desc" => "Insert the text",
                        "id" => "ale_mainpageabouttext",
                        "type" => "editor");

	$options[] = array( "name" => "Social",
						"type" => "heading");

    $options[] = array( "name" => "Show Social Profiles",
                        "desc" => "Check if you want to show the social icons profiles on your site",
                        "id" => "ale_showsocialicon",
                        "std" => "1",
                        "type" => "checkbox");
	
	$options[] = array( "name" => "Facebook",
						"desc" => "Your facebook profile URL.",
						"id" => "ale_fb",
						"std" => "",
						"type" => "text");
    $options[] = array( "name" => "Twitter",
                        "desc" => "Your twitter username.",
                        "id" => "ale_twi",
                        "std" => "",
                        "type" => "text");
    $options[] = array( "name" => "Google+",
                        "desc" => "Your google+ profile URL.",
                        "id" => "ale_gog",
                        "std" => "",
                        "type" => "text");
    $options[] = array( "name" => "Pinterest",
                        "desc" => "Your pinterest profile URL.",
                        "id" => "ale_pint",
                        "std" => "",
                        "type" => "text");
    $options[] = array( "name" => "You Tube",
                        "desc" => "Your youtube profile URL.",
                        "id" => "ale_youtube",
                        "std" => "",
                        "type" => "text");
    $options[] = array( "name" => "Vimeo",
                        "desc" => "Your vimeo profile URL.",
                        "id" => "ale_vim",
                        "std" => "",
                        "type" => "text");
    $options[] = array( "name" => "Flickr",
                        "desc" => "Your flickr profile URL.",
                        "id" => "ale_flickr",
                        "std" => "",
                        "type" => "text");
    $options[] = array( "name" => "Dribble",
                        "desc" => "Your dribble profile URL.",
                        "id" => "ale_dri",
                        "std" => "",
                        "type" => "text");
    $options[] = array( "name" => "Instagram",
                        "desc" => "Your instagram profile URL.",
                        "id" => "ale_inta",
                        "std" => "",
                        "type" => "text");
    $options[] = array( "name" => "Linked in",
                        "desc" => "Your linked in profile URL.",
                        "id" => "ale_liin",
                        "std" => "",
                        "type" => "text");
    $options[] = array( "name" => "Picassa",
                        "desc" => "Your picassa profile URL.",
                        "id" => "ale_pica",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Show RSS",
                        "desc" => "Check if you want to show the RSS icon on your site",
                        "id" => "ale_rssicon",
                        "std" => "1",
                        "type" => "checkbox");

	
	$options[] = array( "name" => "Facebook Application ID",
						"desc" => "If you have Application ID you can connect the blog to your Facebook Profile and monitor statistics there.",
						"id" => "ale_fb_id",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Enable Open Graph",
						"desc" => "The <a href=\"http://www.ogp.me/\">Open Graph</a> protocol enables any web page to become a rich object in a social graph.",
						"id" => "ale_og_enabled",
						"std" => "",
						"type" => "checkbox");


	
	$options[] = array( "name" => "Advanced Settings",
						"type" => "heading");

    $options[] = array( "name" => "Show Top Box (Category and Search) on Blog pages",
                        "desc" => "Check if you want to show the top box.",
                        "id" => "ale_topblogbox",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Show Top Box (Category) on Gallery pages",
                        "desc" => "Check if you want to show the top box.",
                        "id" => "ale_topgallerybox",
                        "std" => "1",
                        "type" => "checkbox");
	
	$options[] = array( "name" => "Google Analytics",
						"desc" => "Please insert your Google Analytics code here. Example: <strong>UA-22231623-1</strong>",
						"id" => "ale_ga",
						"std" => "",
						"type" => "text");

    $options[] = array( "name" => "Home page Slider slug",
                        "desc" => "If you delete the default slider Sneak Peek, and create other, insert here the new slug. The slug you can get in \"Edit Slider\"",
                        "id" => "ale_sliderslug",
                        "std" => "sneak-peek",
                        "type" => "text");
	
	$options[] = array( "name" => "Footer Code",
						"desc" => "If you have anything else to add in the footer - please add it here.",
						"id" => "ale_footer_info",
						"std" => "",
						"type" => "textarea");

    $options[] = array( "name" => "Custom CSS Styles",
                        "desc" => "You can add here your styles. ex. .boxclass { padding:10px; }",
                        "id" => "ale_customcsscode",
                        "std" => "",
                        "type" => "textarea");

    $options[] = array( "name" => "Site PreLoader",
                        "desc" => "Check if you want to enable the site preloader. (We recommend to enable this option. All scripts will be loaded, and only after this, the site will appear and all options would working well.)",
                        "id" => "ale_preloader",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Comments form on Press Blog",
                        "desc" => "Check if you want to show the comments form on Press Blog pages.",
                        "id" => "ale_commentonpress",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Comments Style on Press page",
                        "desc" => "Choose your comments style. If you want to use DISQUS comments please install and activate this plugin from <a href=\"" . admin_url('plugin-install.php?tab=search&type=term&s=Disqus+Comment+System&plugin-search-input=Search+Plugins') . "\">Wordpress Repository</a>.  If you want to use Livefyre Realtime Comments comments please install and activate this plugin from <a href=\"" . admin_url('plugin-install.php?tab=search&type=term&s=Livefyre+Realtime+Comments&plugin-search-input=Search+Plugins') . "\">Wordpress Repository</a>.",
                        "id" => "ale_presscomments_style",
                        "std" => "wp",
                        "class" => "hidden",
                        "type" => "select",
                        "options" => $comments_style);

    $options[] = array( "name" => "Comments form on Gallery Blog",
                        "desc" => "Check if you want to show the comments form on Gallery Blog pages.",
                        "id" => "ale_commentongallery",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Comments Style on Gallery page",
                        "desc" => "Choose your comments style. If you want to use DISQUS comments please install and activate this plugin from <a href=\"" . admin_url('plugin-install.php?tab=search&type=term&s=Disqus+Comment+System&plugin-search-input=Search+Plugins') . "\">Wordpress Repository</a>.  If you want to use Livefyre Realtime Comments comments please install and activate this plugin from <a href=\"" . admin_url('plugin-install.php?tab=search&type=term&s=Livefyre+Realtime+Comments&plugin-search-input=Search+Plugins') . "\">Wordpress Repository</a>.",
                        "id" => "ale_gallerycomments_style",
                        "std" => "wp",
                        "class" => "hidden",
                        "type" => "select",
                        "options" => $comments_style);

    $options[] = array( "name" => "Comments form on Video Blog",
                        "desc" => "Check if you want to show the comments form on Video Blog pages.",
                        "id" => "ale_commentonvideo",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Comments Style on Video Blog",
                        "desc" => "Choose your comments style. If you want to use DISQUS comments please install and activate this plugin from <a href=\"" . admin_url('plugin-install.php?tab=search&type=term&s=Disqus+Comment+System&plugin-search-input=Search+Plugins') . "\">Wordpress Repository</a>.  If you want to use Livefyre Realtime Comments comments please install and activate this plugin from <a href=\"" . admin_url('plugin-install.php?tab=search&type=term&s=Livefyre+Realtime+Comments&plugin-search-input=Search+Plugins') . "\">Wordpress Repository</a>.",
                        "id" => "ale_videocomments_style",
                        "std" => "wp",
                        "class" => "hidden",
                        "type" => "select",
                        "options" => $comments_style);

    $options[] = array( "name" => "Comments form on Inspiration Blog",
                        "desc" => "Check if you want to show the comments form on Inspiration Blog pages.",
                        "id" => "ale_commentoninspiration",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Comments Style on Inspiration page",
                        "desc" => "Choose your comments style. If you want to use DISQUS comments please install and activate this plugin from <a href=\"" . admin_url('plugin-install.php?tab=search&type=term&s=Disqus+Comment+System&plugin-search-input=Search+Plugins') . "\">Wordpress Repository</a>.  If you want to use Livefyre Realtime Comments comments please install and activate this plugin from <a href=\"" . admin_url('plugin-install.php?tab=search&type=term&s=Livefyre+Realtime+Comments&plugin-search-input=Search+Plugins') . "\">Wordpress Repository</a>.",
                        "id" => "ale_inspirationcomments_style",
                        "std" => "wp",
                        "class" => "hidden",
                        "type" => "select",
                        "options" => $comments_style);

    $options[] = array( "name" => "Choose Home Page Bottom",
                        "desc" => "If you want to show 3 posts from blog (RECENT WORK, LET'S DISCUSS, MOST VOTED POST) choose the option Blog Posts, else if you want to make three custom boxes, choose the option Custom Boxes.",
                        "id" => "ale_homepagebottom",
                        "std" => "blogposts",
                        "type" => "select",
                        "options" => $home_bottom);

    $options[] = array( "name" => "First Block Title",
                        "desc" => "The block title. ex. Recent Post",
                        "id" => "ale_firstbottomblocktitle",
                        "class" => "hidden",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Second Block Title",
                        "desc" => "The block title. ex. Let's Discuss",
                        "id" => "ale_secondbottomblocktitle",
                        "class" => "hidden",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Third Block Title",
                        "desc" => "The block title. ex. Most Voted",
                        "id" => "ale_thirdbottomblocktitle",
                        "class" => "hidden",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "First Item Title",
                        "desc" => "The item title.",
                        "id" => "ale_firstbottomitemtitle",
                        "class" => "hidden",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Second Item Title",
                        "desc" => "The item title.",
                        "id" => "ale_secondbottomitemtitle",
                        "class" => "hidden",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Third Item Title",
                        "desc" => "The item title.",
                        "id" => "ale_thirdbottomitemtitle",
                        "class" => "hidden",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "First Item Image",
                        "desc" => "Upload or insert the link (Size 320-220px)",
                        "id" => "ale_firstbottomitemimage",
                        "class" => "hidden",
                        "std" => "",
                        "type" => "upload");

    $options[] = array( "name" => "Second Item Image",
                        "desc" => "Upload or insert the link (Size 320-220px)",
                        "id" => "ale_secondbottomitemimage",
                        "class" => "hidden",
                        "std" => "",
                        "type" => "upload");

    $options[] = array( "name" => "Third Item image",
                        "desc" => "Upload or insert the link (Size 320-220px)",
                        "id" => "ale_thirdbottomitemimage",
                        "class" => "hidden",
                        "std" => "",
                        "type" => "upload");

    $options[] = array( "name" => "First Item Link",
                        "desc" => "Insert the link",
                        "id" => "ale_firstbottomitemlink",
                        "class" => "hidden",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Second Item Link",
                        "desc" => "Insert the link",
                        "id" => "ale_secondbottomitemlink",
                        "class" => "hidden",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Third Item Link",
                        "desc" => "Insert the link",
                        "id" => "ale_thirdbottomitemlink",
                        "class" => "hidden",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "First Item Category",
                        "desc" => "Insert the category",
                        "id" => "ale_firstbottomitemcategory",
                        "class" => "hidden",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Second Item Category",
                        "desc" => "Insert the category",
                        "id" => "ale_secondbottomitemcategory",
                        "class" => "hidden",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Third Item Category",
                        "desc" => "Insert the category",
                        "id" => "ale_thirdbottomitemcategory",
                        "class" => "hidden",
                        "std" => "",
                        "type" => "text");
    $options[] = array( "name" => "Show Color Select Preview",
                        "desc" => "Check if you want to show the color select preview",
                        "id" => "ale_siteselectcolorpreview",
                        "type" => "checkbox");

    $options[] = array( "name" => "Sidebars",
                        "type" => "heading");

    $options[] = array( "name" => "Show Left Sidebar on Blog Pages",
                        "desc" => "Check if you want to show the Left Sidebar on the Blog pages.",
                        "id" => "ale_leftsidebarblog",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Show Left Sidebar on Gallery Pages",
                        "desc" => "Check if you want to show the Left Sidebar on the Gallery pages.",
                        "id" => "ale_leftsidebargallery",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Show Left Sidebar on Video Pages",
                        "desc" => "Check if you want to show the Left Sidebar on the Video pages.",
                        "id" => "ale_leftsidebarvideo",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Show Left Sidebar on Press Pages",
                        "desc" => "Check if you want to show the Left Sidebar on the Press pages.",
                        "id" => "ale_leftsidebarpress",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Show Left Sidebar on Inspiration Pages",
                        "desc" => "Check if you want to show the Left Sidebar on the Inspiration pages.",
                        "id" => "ale_leftsidebarinspiration",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Show Left Sidebar on Testimonial Pages",
                        "desc" => "Check if you want to show the Left Sidebar on the Testimonial pages.",
                        "id" => "ale_leftsidebartestimonial",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Show Right Sidebar on Blog Pages",
                        "desc" => "Check if you want to show the Right Sidebar on the blog pages.",
                        "id" => "ale_rightsidebarblog",
                        "std" => "0",
                        "type" => "checkbox");

    $options[] = array( "name" => "Show Right Sidebar on Gallery Pages",
                        "desc" => "Check if you want to show the Right Sidebar on the gallery pages.",
                        "id" => "ale_rightsidebargallery",
                        "std" => "0",
                        "type" => "checkbox");

    $options[] = array( "name" => "Show Right Sidebar on Video Pages",
                        "desc" => "Check if you want to show the Right Sidebar on the video pages.",
                        "id" => "ale_rightsidebarvideo",
                        "std" => "0",
                        "type" => "checkbox");

    $options[] = array( "name" => "Show Right Sidebar on Press Pages",
                        "desc" => "Check if you want to show the Right Sidebar on the press pages.",
                        "id" => "ale_rightsidebarpress",
                        "std" => "0",
                        "type" => "checkbox");

    $options[] = array( "name" => "Show Right Sidebar on Inspiration Pages",
                        "desc" => "Check if you want to show the Right Sidebar on the inspiration pages.",
                        "id" => "ale_rightsidebarinspiration",
                        "std" => "0",
                        "type" => "checkbox");

    $options[] = array( "name" => "Show Right Sidebar on Testimonial Pages",
                        "desc" => "Check if you want to show the Right Sidebar on the testimonial pages.",
                        "id" => "ale_rightsidebartestimonial",
                        "std" => "0",
                        "type" => "checkbox");
	
	return $options;
}

/**
 * Add custom scripts to Options Page
 */
function aletheme_options_custom_scripts() {
 ?>

<script type="text/javascript">
jQuery(document).ready(function() {

    jQuery('#ale_homepagebottom').change(function(){
        if(jQuery('#ale_homepagebottom option:selected').val() == 'customboxes') {
            jQuery('#section-ale_firstbottomblocktitle').show();
            jQuery('#section-ale_secondbottomblocktitle').show();
            jQuery('#section-ale_thirdbottomblocktitle').show();
            jQuery('#section-ale_thirdbottomitemtitle').show();
            jQuery('#section-ale_secondbottomitemimage').show();
            jQuery('#section-ale_firstbottomitemimage').show();
            jQuery('#section-ale_thirdbottomitemimage').show();
            jQuery('#section-ale_secondbottomitemtitle').show();
            jQuery('#section-ale_firstbottomitemtitle').show();
            jQuery('#section-ale_firstbottomitemcategory').show();
            jQuery('#section-ale_secondbottomitemcategory').show();
            jQuery('#section-ale_thirdbottomitemcategory').show();
            jQuery('#section-ale_firstbottomitemlink').show();
            jQuery('#section-ale_secondbottomitemlink').show();
            jQuery('#section-ale_thirdbottomitemlink').show();
        } else {
            jQuery('#section-ale_firstbottomblocktitle').hide();
            jQuery('#section-ale_secondbottomblocktitle').hide();
            jQuery('#section-ale_thirdbottomblocktitle').hide();
            jQuery('#section-ale_thirdbottomitemtitle').hide();
            jQuery('#section-ale_secondbottomitemimage').hide();
            jQuery('#section-ale_firstbottomitemimage').hide();
            jQuery('#section-ale_thirdbottomitemimage').hide();
            jQuery('#section-ale_secondbottomitemtitle').hide();
            jQuery('#section-ale_firstbottomitemtitle').hide();
            jQuery('#section-ale_firstbottomitemcategory').hide();
            jQuery('#section-ale_secondbottomitemcategory').hide();
            jQuery('#section-ale_thirdbottomitemcategory').hide();
            jQuery('#section-ale_firstbottomitemlink').hide();
            jQuery('#section-ale_secondbottomitemlink').hide();
            jQuery('#section-ale_thirdbottomitemlink').hide();
        }
    });

    if(jQuery('#ale_homepagebottom option:selected').val() == 'customboxes'){
        jQuery('#section-ale_firstbottomblocktitle').show();
        jQuery('#section-ale_secondbottomblocktitle').show();
        jQuery('#section-ale_thirdbottomblocktitle').show();
        jQuery('#section-ale_thirdbottomitemtitle').show();
        jQuery('#section-ale_secondbottomitemimage').show();
        jQuery('#section-ale_firstbottomitemimage').show();
        jQuery('#section-ale_thirdbottomitemimage').show();
        jQuery('#section-ale_secondbottomitemtitle').show();
        jQuery('#section-ale_firstbottomitemtitle').show();
        jQuery('#section-ale_firstbottomitemcategory').show();
        jQuery('#section-ale_secondbottomitemcategory').show();
        jQuery('#section-ale_thirdbottomitemcategory').show();
        jQuery('#section-ale_firstbottomitemlink').show();
        jQuery('#section-ale_secondbottomitemlink').show();
        jQuery('#section-ale_thirdbottomitemlink').show();
    }

	jQuery('#ale_righthomemenu').click(function() {
  		jQuery('#section-ale_right_first_image').fadeToggle(400);
		jQuery('#section-ale_right_first_title').fadeToggle(400);
        jQuery('#section-ale_right_first_desc').fadeToggle(400);
        jQuery('#section-ale_right_first_link').fadeToggle(400);
        jQuery('#section-ale_right_second_image').fadeToggle(400);
        jQuery('#section-ale_right_second_title').fadeToggle(400);
        jQuery('#section-ale_right_second_desc').fadeToggle(400);
        jQuery('#section-ale_right_second_link').fadeToggle(400);
        jQuery('#section-ale_right_third_image').fadeToggle(400);
        jQuery('#section-ale_right_third_title').fadeToggle(400);
        jQuery('#section-ale_right_third_desc').fadeToggle(400);
        jQuery('#section-ale_right_third_link').fadeToggle(400);
	});
	
	if (jQuery('#ale_righthomemenu:checked').val() !== undefined) {
        jQuery('#section-ale_right_first_image').show();
        jQuery('#section-ale_right_first_title').show();
        jQuery('#section-ale_right_first_desc').show();
        jQuery('#section-ale_right_first_link').show();
        jQuery('#section-ale_right_second_image').show();
        jQuery('#section-ale_right_second_title').show();
        jQuery('#section-ale_right_second_desc').show();
        jQuery('#section-ale_right_second_link').show();
        jQuery('#section-ale_right_third_image').show();
        jQuery('#section-ale_right_third_title').show();
        jQuery('#section-ale_right_third_desc').show();
        jQuery('#section-ale_right_third_link').show();
	}

    jQuery('#ale_commentonpress').click(function() {
        jQuery('#section-ale_presscomments_style').fadeToggle(400);
    });
    if (jQuery('#ale_commentonpress:checked').val() !== undefined) {
        jQuery('#section-ale_presscomments_style').show();
    }

    jQuery('#ale_commentongallery').click(function() {
        jQuery('#section-ale_gallerycomments_style').fadeToggle(400);
    });
    if (jQuery('#ale_commentongallery:checked').val() !== undefined) {
        jQuery('#section-ale_gallerycomments_style').show();
    }

    jQuery('#ale_commentonvideo').click(function() {
        jQuery('#section-ale_videocomments_style').fadeToggle(400);
    });
    if (jQuery('#ale_commentonvideo:checked').val() !== undefined) {
        jQuery('#section-ale_videocomments_style').show();
    }

    jQuery('#ale_commentoninspiration').click(function() {
        jQuery('#section-ale_inspirationcomments_style').fadeToggle(400);
    });
    if (jQuery('#ale_commentoninspiration:checked').val() !== undefined) {
        jQuery('#section-ale_inspirationcomments_style').show();
    }
});
</script>

<?php
}

/**
 * Add Metaboxes
 * @param array $meta_boxes
 * @return array 
 */
function aletheme_metaboxes($meta_boxes) {
	
	$meta_boxes = array();

    $prefix = "ale_";

    $meta_boxes[] = array(
        'id'         => 'gallery_page_metabox',
        'title'      => 'Gallery Metabox',
        'pages'      => array( 'gallery', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => 'Location',
                'desc' => 'Insert the Location',
                'id'   => $prefix . 'location',
                'type' => 'text',
            ),
            array(
                'name' => 'Event Date',
                'desc' => 'Insert the Date',
                'id'   => $prefix . 'eventdate',
                'type' => 'text_date',
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'video_page_metabox',
        'title'      => 'Video Metabox',
        'pages'      => array( 'video', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => 'Video Link',
                'desc' => 'Insert the video link',
                'id'   => $prefix . 'videopagelink',
                'type' => 'text',
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'custompage_page_metabox',
        'title'      => 'Custom background',
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => 'Custom background',
                'desc' => 'Upload your custom background',
                'id'   => $prefix . 'custompagebackground',
                'type' => 'file',
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'contact_page_metabox',
        'title'      => 'Contact Metabox',
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'show_on'    => array( 'key' => 'page-template', 'value' => array('template-contact.php'), ), // Specific post templates to display this metabox
        'fields' => array(
            array(
                'name' => 'Map Code',
                'desc' => 'Insert your Google Map Code or other...',
                'id'   => $prefix . 'mapcontact',
                'type' => 'textarea_code',
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'contacttwo_page_metabox',
        'title'      => 'Contact Metabox',
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'show_on'    => array( 'key' => 'page-template', 'value' => array('template-contact-two.php'), ), // Specific post templates to display this metabox
        'fields' => array(

            array(
                'name' => 'Adress',
                'desc' => 'Insert your Adress',
                'id'   => $prefix . 'adresstwo',
                'type'    => 'wysiwyg',
                'options' => array(    'textarea_rows' => 5, ),
            ),
            array(
                'name' => 'Email',
                'desc' => 'Insert your email...',
                'id'   => $prefix . 'conemailtwo',
                'type' => 'text',
            ),
            array(
                'name' => 'Phone',
                'desc' => 'Insert your phone number...',
                'id'   => $prefix . 'conphonetwo',
                'type' => 'text',
            ),
            array(
                'name' => 'Map Code',
                'desc' => 'Insert your Google Map Code or other...',
                'id'   => $prefix . 'mapcontacttwo',
                'type' => 'textarea_code',
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'about_page_metabox',
        'title'      => 'About Metabox',
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'show_on'    => array( 'key' => 'page-template', 'value' => array('template-about.php'), ), // Specific post templates to display this metabox
        'fields' => array(
            array(
                'name' => 'Second column',
                'desc' => 'Insert your info...',
                'id'   => $prefix . 'aboutinfo',
                'type'    => 'wysiwyg',
                'options' => array(    'textarea_rows' => 5, ),
            ),

            array(
                'name' => 'Quote info',
                'desc' => 'Insert your info...',
                'id'   => $prefix . 'aboutquote',
                'type'    => 'wysiwyg',
                'options' => array(    'textarea_rows' => 5, ),
            ),

            array(
                'name' => 'Video',
                'desc' => 'Insert your video link...',
                'id'   => $prefix . 'aboutvideo',
                'type'    => 'text',
            ),
            array(
                'name' => 'Close or Open Video Toogle box',
                'desc' => 'Select an option',
                'id'   => $prefix . 'aboutvideotog',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Close', 'value' => 'close', ),
                    array( 'name' => 'Open', 'value' => 'open', ),
                ),
            ),
            array(
                'name' => 'Enable or Disable Slider',
                'desc' => 'To show the slider, enable it and upload images as page attachments, default WordPress images upload.',
                'id'   => $prefix . 'aboutslideon',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Enable', 'value' => 'on', ),
                    array( 'name' => 'Disable', 'value' => 'off', ),
                ),
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'abouttwo_page_metabox',
        'title'      => 'About Metabox',
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'show_on'    => array( 'key' => 'page-template', 'value' => array('template-about-two.php'), ), // Specific post templates to display this metabox
        'fields' => array(
            array(
                'name' => 'Skills box Title',
                'desc' => 'Insert your box title...',
                'id'   => $prefix . 'abouttwoskills',
                'type'    => 'text',
            ),
            array(
                'name' => 'Skill One Title',
                'desc' => 'Insert your first skill title...',
                'id'   => $prefix . 'firstskill',
                'type'    => 'text',
            ),
            array(
                'name' => 'Skill One Percent',
                'desc' => 'Insert your first skill procent... ex. 80',
                'id'   => $prefix . 'firstskillper',
                'type'    => 'text',
            ),
            array(
                'name' => 'Skill Two Title',
                'desc' => 'Insert your second skill title...',
                'id'   => $prefix . 'secondskill',
                'type'    => 'text',
            ),
            array(
                'name' => 'Skill Two Percent',
                'desc' => 'Insert your second skill procent... ex. 80',
                'id'   => $prefix . 'secondskillper',
                'type'    => 'text',
            ),
            array(
                'name' => 'Skill Three Title',
                'desc' => 'Insert your third skill title...',
                'id'   => $prefix . 'thirdskill',
                'type'    => 'text',
            ),
            array(
                'name' => 'Skill Three Percent',
                'desc' => 'Insert your third skill procent... ex. 80',
                'id'   => $prefix . 'thirdskillper',
                'type'    => 'text',
            ),
            array(
                'name' => 'Skill Four Title',
                'desc' => 'Insert your fourth skill title...',
                'id'   => $prefix . 'fourthskill',
                'type'    => 'text',
            ),
            array(
                'name' => 'Skill Four Percent',
                'desc' => 'Insert your fourth skill procent... ex. 80',
                'id'   => $prefix . 'fourthskillper',
                'type'    => 'text',
            ),
            array(
                'name' => 'Team box title',
                'desc' => 'Insert your team box title',
                'id'   => $prefix . 'meetteamtitle',
                'type'    => 'text',
            ),
            array(
                'name' => 'First Person Photo',
                'desc' => 'Upload first photo',
                'id'   => $prefix . 'firstphotoperson',
                'type'    => 'file',
            ),
            array(
                'name' => 'First Person Name',
                'desc' => 'Insert first person name',
                'id'   => $prefix . 'firstnameperson',
                'type'    => 'text',
            ),
            array(
                'name' => 'First Person Profession',
                'desc' => 'Insert first person profession',
                'id'   => $prefix . 'firstprofperson',
                'type'    => 'text',
            ),
            array(
                'name' => 'First Person Facebook link',
                'desc' => 'Insert first person Facebook link',
                'id'   => $prefix . 'firstfbperson',
                'type'    => 'text',
            ),
            array(
                'name' => 'First Person Twitter link',
                'desc' => 'Insert first person Twitter link',
                'id'   => $prefix . 'firsttwiperson',
                'type'    => 'text',
            ),
            array(
                'name' => 'First Person Email',
                'desc' => 'Insert first person email',
                'id'   => $prefix . 'firstemailperson',
                'type'    => 'text',
            ),
            array(
                'name' => 'Second Person Photo',
                'desc' => 'Upload second photo',
                'id'   => $prefix . 'secondphotoperson',
                'type'    => 'file',
            ),
            array(
                'name' => 'Second Person Name',
                'desc' => 'Insert second person name',
                'id'   => $prefix . 'secondnameperson',
                'type'    => 'text',
            ),
            array(
                'name' => 'Second Person Profession',
                'desc' => 'Insert second person profession',
                'id'   => $prefix . 'secondprofperson',
                'type'    => 'text',
            ),
            array(
                'name' => 'Second Person Facebook link',
                'desc' => 'Insert second person Facebook link',
                'id'   => $prefix . 'secondfbperson',
                'type'    => 'text',
            ),
            array(
                'name' => 'Second Person Twitter link',
                'desc' => 'Insert second person Twitter link',
                'id'   => $prefix . 'secondtwiperson',
                'type'    => 'text',
            ),
            array(
                'name' => 'Second Person Email',
                'desc' => 'Insert second person email',
                'id'   => $prefix . 'secondemailperson',
                'type'    => 'text',
            ),
            array(
                'name' => 'Third Person Photo',
                'desc' => 'Upload third photo',
                'id'   => $prefix . 'thirdphotoperson',
                'type'    => 'file',
            ),
            array(
                'name' => 'Third Person Name',
                'desc' => 'Insert third person name',
                'id'   => $prefix . 'thirdnameperson',
                'type'    => 'text',
            ),
            array(
                'name' => 'Third Person Profession',
                'desc' => 'Insert third person profession',
                'id'   => $prefix . 'thirdprofperson',
                'type'    => 'text',
            ),
            array(
                'name' => 'Third Person Facebook link',
                'desc' => 'Insert third person Facebook link',
                'id'   => $prefix . 'thirdfbperson',
                'type'    => 'text',
            ),
            array(
                'name' => 'third Person Twitter link',
                'desc' => 'Insert third person Twitter link',
                'id'   => $prefix . 'thirdtwiperson',
                'type'    => 'text',
            ),
            array(
                'name' => 'Third Person Email',
                'desc' => 'Insert third person email',
                'id'   => $prefix . 'thirdemailperson',
                'type'    => 'text',
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'oneblog_page_metabox',
        'title'      => 'Blog Options',
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'show_on'    => array( 'key' => 'page-template', 'value' => array('template-blog.php'), ), // Specific post templates to display this metabox
        'fields' => array(
            array(
                'name' => 'Select Grid Style',
                'desc' => 'Select Grid Style',
                'id'   => $prefix . 'tumbsblogstylepag',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Standard Thumbnails', 'value' => 'standtumbs', ),
                    array( 'name' => 'Masonry Thumbnails', 'value' => 'masontumbs', ),
                ),
            ),

            array(
                'name' => 'Select Numbers of Columns',
                'desc' => 'Select Columns',
                'id'   => $prefix . 'blogcolumnsnumpag',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Full Width', 'value' => 'fullwidth', ),
                    array( 'name' => 'Two Columns', 'value' => 'twocol', ),
                    array( 'name' => 'Three Columns', 'value' => 'threecol', ),
                ),
            ),

            array(
                'name' => 'Items per page',
                'desc' => 'Type the numbers of items per page',
                'id'   => $prefix . 'itemblogpage',
                'std'   => '9',
                'type'    => 'text',
            ),

            array(
                'name' => 'Show one category',
                'desc' => 'Insert the ID of the category you want to show. Empty field will show all categories.',
                'id'   => $prefix . 'itemblogcategory',
                'type'    => 'text',
            ),
        )
    );


    $meta_boxes[] = array(
        'id'         => 'onegallery_page_metabox',
        'title'      => 'Gallery Options',
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'show_on'    => array( 'key' => 'page-template', 'value' => array('template-gallery-pagination.php'), ), // Specific post templates to display this metabox
        'fields' => array(
            array(
                'name' => 'Select Grid Style',
                'desc' => 'Select Grid Style',
                'id'   => $prefix . 'tumbsgallerystylepag',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Standard Thumbnails', 'value' => 'standtumbs', ),
                    array( 'name' => 'Masonry Thumbnails', 'value' => 'masontumbs', ),
                ),
            ),

            array(
                'name' => 'Select Numbers of Columns',
                'desc' => 'Select Columns',
                'id'   => $prefix . 'galcolumnsnumpag',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Two Columns', 'value' => 'twocol', ),
                    array( 'name' => 'Three Columns', 'value' => 'threecol', ),
                    array( 'name' => 'Four Columns', 'value' => 'fourcol', ),
                ),
            ),

            array(
                'name' => 'Items per page',
                'desc' => 'Type the numbers of items per page',
                'id'   => $prefix . 'itemgalpage',
                'std'   => '9',
                'type'    => 'text',
            ),

            array(
                'name' => 'Show one category',
                'desc' => 'Insert the ID of the category you want to show. Empty field will show all categories.',
                'id'   => $prefix . 'itemgalcategory',
                'type'    => 'text',
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'twogallery_page_metabox',
        'title'      => 'Gallery Options',
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'show_on'    => array( 'key' => 'page-template', 'value' => array('template-gallery-filter.php'), ), // Specific post templates to display this metabox
        'fields' => array(
            array(
                'name' => 'Select Grid Style',
                'desc' => 'Select Grid Style',
                'id'   => $prefix . 'tumbsgallerystyle',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Standard Thumbnails', 'value' => 'standtumbs', ),
                    array( 'name' => 'Masonry Thumbnails', 'value' => 'masontumbs', ),
                ),
            ),

            array(
                'name' => 'Select Numbers of Columns',
                'desc' => 'Select Columns',
                'id'   => $prefix . 'galcolumnsnum',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Two Columns', 'value' => 'twocol', ),
                    array( 'name' => 'Three Columns', 'value' => 'threecol', ),
                    array( 'name' => 'Four Columns', 'value' => 'fourcol', ),
                ),
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'homeone_page_metabox',
        'title'      => 'Home page Options',
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'show_on'    => array( 'key' => 'page-template', 'value' => array('template-home-one.php'), ), // Specific post templates to display this metabox
        'fields' => array(
            array(
                'name' => 'Slider effect',
                'desc' => 'Select the slider effect',
                'id'   => $prefix . 'slidereffect',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'sliceDown', 'value' => 'sliceDown', ),
                    array( 'name' => 'sliceDownLeft', 'value' => 'sliceDownLeft', ),
                    array( 'name' => 'sliceUp', 'value' => 'sliceUp', ),
                    array( 'name' => 'sliceUpLeft', 'value' => 'sliceUpLeft', ),
                    array( 'name' => 'sliceUpDown', 'value' => 'sliceUpDown', ),
                    array( 'name' => 'sliceUpDownLeft', 'value' => 'sliceUpDownLeft', ),
                    array( 'name' => 'fold', 'value' => 'fold', ),
                    array( 'name' => 'fade', 'value' => 'fade', ),
                    array( 'name' => 'random', 'value' => 'random', ),
                    array( 'name' => 'slideInRight', 'value' => 'slideInRight', ),
                    array( 'name' => 'slideInLeft', 'value' => 'slideInLeft', ),
                    array( 'name' => 'boxRandom', 'value' => 'boxRandom', ),
                    array( 'name' => 'boxRain', 'value' => 'boxRain', ),
                    array( 'name' => 'boxRainReverse', 'value' => 'boxRainReverse', ),
                    array( 'name' => 'boxRainGrow', 'value' => 'boxRainGrow', ),
                    array( 'name' => 'boxRainGrowReverse', 'value' => 'boxRainGrowReverse', ),
                ),
            ),
            array(
                'name' => 'Show Blog Posts or Gallery',
                'desc' => 'Select what you want to show on home page',
                'id'   => $prefix . 'showtypehome',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Gallery', 'value' => 'gallery', ),
                    array( 'name' => 'Blog Posts', 'value' => 'post', ),
                    array( 'name' => 'Show Content', 'value' => 'content', ),
                ),
            ),

            array(
                'name' => 'Show only one category',
                'desc' => 'Insert the ID of the category',
                'id'   => $prefix . 'showcathome',
                'type'    => 'text',

            ),

            array(
                'name' => 'Posts per page',
                'desc' => 'Insert the number of posts per page. Empty Field will show all posts.',
                'id'   => $prefix . 'shownumpostshome',
                'type'    => 'text',
            ),

        )
    );

    $meta_boxes[] = array(
        'id'         => 'home_page_metabox',
        'title'      => 'Home Options',
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'show_on'    => array( 'key' => 'page-template', 'value' => array('page-home.php'), ), // Specific post templates to display this metabox
        'fields' => array(
            array(
                'name' => 'Show Blog Posts or Gallery',
                'desc' => 'Select what you want to show on home page',
                'id'   => $prefix . 'showtypehome',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Gallery', 'value' => 'gallery', ),
                    array( 'name' => 'Blog Posts', 'value' => 'post', ),
                    array( 'name' => 'Show Content', 'value' => 'content', ),
                    array( 'name' => 'Close', 'value' => 'close', ),
                ),
            ),

            array(
                'name' => 'Show only one category',
                'desc' => 'Insert the ID of the category',
                'id'   => $prefix . 'showcathome',
                'type'    => 'text',

            ),

            array(
                'name' => 'Posts per page',
                'desc' => 'Insert the number of posts per page. Empty Field will show all posts.',
                'id'   => $prefix . 'shownumpostshome',
                'type'    => 'text',
            ),

        )
    );

    $meta_boxes[] = array(
        'id'         => 'inspiration_page_metabox',
        'title'      => 'Inspiration Metabox',
        'pages'      => array( 'inspiration', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => 'Place',
                'desc' => 'Inspiration place',
                'id'   => $prefix . 'inspirationplace',
                'type'    => 'text',
            ),

            array(
                'name' => 'Date',
                'desc' => 'Insert the date',
                'id'   => $prefix . 'inspirationdate',
                'type'    => 'text_date',
            ),

            array(
                'name' => 'Impression & Feelings',
                'desc' => 'Insert a few words',
                'id'   => $prefix . 'impress',
                'type'    => 'text',
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'testimonials_page_metabox',
        'title'      => 'Testimonials Metabox',
        'pages'      => array( 'testimonials', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => 'Testimonial Author',
                'desc' => 'The author',
                'id'   => $prefix . 'testimauthor',
                'type'    => 'text',
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'post_page_metabox',
        'title'      => 'Post Data',
        'pages'      => array( 'post', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => 'Video Link',
                'desc' => 'You can put here the links from youtube.com, vimeo.com, blip.tv, dailymotion.com, flickr.com, smugmug.com, hulu.com, viddler.com, qik.com, revision3.com, photobucket.com, scribd.com, wordpress.tv, polldaddy.com, funnyordie.com, twitter.com, soundcloud.com, slideshare.net, instagram.com',
                'id'   => $prefix . 'videopostlink',
                'type'    => 'text',
            ),
            array(
                'name' => 'Enable or Disable Featured image on Single post page. (Only Standard or Quote Type Post)',
                'desc' => 'Check if you want to show the Featured image on Single post.',
                'id'   => $prefix . 'featuredonsigle',
                'type'    => 'checkbox',
            ),
        )
    );


    $meta_boxes[] = array(
        'id'         => 'press_page_metabox',
        'title'      => 'Press Options',
        'pages'      => array( 'press', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => 'Online Press Link',
                'desc' => 'Is the Press is Online, put here the External Link',
                'id'   => $prefix . 'pressexternallink',
                'type'    => 'text',
            ),
        )
    );
	
	return $meta_boxes;
}

/**
 * Get image sizes for images
 * 
 * @return array
 */
function aletheme_get_images_sizes() {
	return array(

        'page' => array(
            array(
                'name'        => 'page-slider',
                'width'        => 460,
                'height'    => 205,
                'crop'        => true,
            ),
        ),

        'press' => array(
            array(
                'name'        => 'press-poster',
                'width'        => 320,
                'height'    => 9999,
                'crop'        => false,
            ),
            array(
                'name'        => 'press-online',
                'width'        => 230,
                'height'    => 185,
                'crop'        => true,
            ),
        ),

        'inspiration' => array(
            array(
                'name'        => 'inspiration-poster',
                'width'        => 330,
                'height'    => 212,
                'crop'        => true,
            ),
            array(
                'name'        => 'inspiration-slider',
                'width'        => 9999,
                'height'    => 370,
                'crop'        => false,
            ),
        ),

        'video' => array(
            array(
                'name'        => 'video-poster',
                'width'        => 320,
                'height'    => 9999,
                'crop'        => false,
            ),
        ),

        'testimonials' => array(
            array(
                'name'        => 'testimonials-avatar',
                'width'        => 330,
                'height'    => 212,
                'crop'        => true,
            ),
        ),

        'gallery' => array(
            array(
                'name'        => 'gallery-slider',
                'width'        => 1000,
                'height'    => 9999,
                'crop'        => false,
            ),
            array(
                'name'        => 'gallery-tumba',
                'width'        => 320,
                'height'    => 9999,
                'crop'        => false,
            ),

            array(
                'name'        => 'gallery-three',
                'width'        => 330,
                'height'    => 212,
                'crop'        => true,
            ),

            array(
                'name'        => 'gallery-two',
                'width'        => 500,
                'height'    => 320,
                'crop'        => true,
            ),

            array(
                'name'        => 'gallery-four',
                'width'        => 245,
                'height'    => 160,
                'crop'        => true,
            ),

            array(
                'name'        => 'gallery-three-mason',
                'width'        => 330,
                'height'    => 9999,
                'crop'        => false,
            ),

            array(
                'name'        => 'gallery-two-mason',
                'width'        => 500,
                'height'    => 9999,
                'crop'        => false,
            ),

            array(
                'name'        => 'gallery-four-mason',
                'width'        => 245,
                'height'    => 9999,
                'crop'        => false,
            ),

            array(
                'name'        => 'gallery-minitumba',
                'width'        => 150,
                'height'    => 110,
                'crop'        => true,
            ),
        ),

        'post' => array(
            array(
                'name'        => 'post-mostcommented',
                'width'        => 200,
                'height'    => 145,
                'crop'        => true,
            ),
            array(
                'name'        => 'post-tumba',
                'width'        => 320,
                'height'    => 220,
                'crop'        => true,
            ),
            array(
                'name'        => 'post-poster',
                'width'        => 320,
                'height'    => 9999,
                'crop'        => false,
            ),
            array(
                'name'        => 'post-flex',
                'width'        => 320,
                'height'    => 210,
                'crop'        => true,
            ),
            array(
                'name'        => 'post-paper',
                'width'        => 1000,
                'height'    => 9999,
                'crop'        => false,
            ),
            array(
                'name'        => 'post-fullwidth',
                'width'        => 1000,
                'height'    => 400,
                'crop'        => true,
            ),
            array(
                'name'        => 'post-two',
                'width'        => 500,
                'height'    => 320,
                'crop'        => true,
            ),
            array(
                'name'        => 'post-two-mason',
                'width'        => 500,
                'height'    => 9999,
                'crop'        => false,
            ),
        ),
    );
}

/**
 * Add post types that are used in the theme 
 * 
 * @return array
 */
function aletheme_get_post_types() {
	return array(
        'gallery' => array(
            'config' => array(
                'public' => true,
                'exclude_from_search' => true,
                'menu_position' => 20,
                'has_archive'   => true,
                'rewrite' => array('slug' => 'galleries'),
                'supports'=> array(
                    'title',
                    'comments',
                    'editor',
                    'thumbnail',
                    'page-attributes',
                ),
                'show_in_nav_menus'=> true,
            ),
            'singular' => 'Gallery',
            'multiple' => 'Galleries',
            'columns'    => array(
                'first_image',
            )
        ),

        'inspiration' => array(
            'config' => array(
                'public' => true,
                'exclude_from_search' => true,
                'menu_position' => 20,
                'has_archive'   => true,
                'supports'=> array(
                    'title',
                    'comments',
                    'editor',
                    'thumbnail',
                    'page-attributes',
                ),
                'show_in_nav_menus'=> true,
            ),
            'singular' => 'Inspiration',
            'multiple' => 'Inspirations',
            'columns'    => array(
                'first_image',
            )
        ),

        'press' => array(
            'config' => array(
                'public' => true,
                'exclude_from_search' => true,
                'menu_position' => 20,
                'has_archive'   => true,
                'supports'=> array(
                    'title',
                    'comments',
                    'editor',
                    'thumbnail',
                    'page-attributes',
                ),
                'show_in_nav_menus'=> true,
            ),
            'singular' => 'Press',
            'multiple' => 'Press',
        ),

        'video' => array(
            'config' => array(
                'public' => true,
                'exclude_from_search' => true,
                'menu_position' => 20,
                'has_archive'   => true,
                'supports'=> array(
                    'title',
                    'comments',
                    'editor',
                    'thumbnail',
                    'page-attributes',
                ),
                'show_in_nav_menus'=> true,
            ),
            'singular' => 'Video',
            'multiple' => 'Videos',
        ),

        'testimonials' => array(
            'config' => array(
                'public' => true,
                'exclude_from_search' => true,
                'menu_position' => 20,
                'has_archive'   => true,
                'supports'=> array(
                    'title',
                    'comments',
                    'editor',
                    'thumbnail',
                    'page-attributes',
                ),
                'show_in_nav_menus'=> true,
            ),
            'singular' => 'Testimonial',
            'multiple' => 'Testimonials',
        ),
    );
}

/**
 * Add taxonomies that are used in theme
 * 
 * @return array
 */
function aletheme_get_taxonomies() {
	return array(

        'gallery-category'    => array(
            'for'        => array('gallery'),
            'config'    => array(
                'sort'        => true,
                'args'        => array('orderby' => 'term_order'),
                'hierarchical' => true,
            ),
            'singular'    => 'Gallery Category',
            'multiple'    => 'Gallery Categories',
        ),
    );
}

/**
 * Add post formats that are used in theme
 * 
 * @return array
 */
function aletheme_get_post_formats() {
	return array(
        'gallery','image','video','quote'
    );
}

/**
 * Get sidebars list
 * 
 * @return array
 */
function aletheme_get_sidebars() {
	$sidebars = array();
	return $sidebars;
}

/**
 * Predefine custom sliders
 * @return array
 */
function aletheme_get_sliders() {
	return array(
		'sneak-peek' => array(
			'title'		=> 'Sneak Peek',
		),
	);
}

/**
 * Post types where metaboxes should show
 * 
 * @return array
 */
function aletheme_get_post_types_with_gallery() {
	return array('post','gallery','inspiration');
}

/**
 * Add custom fields for media attachments
 * @return array
 */
function aletheme_media_custom_fields() {
	return array();
}