<?php
/**
 * WPBakery Visual Composer Shortcodes settings
 *
 * @package VPBakeryVisualComposer
 *
 */

$target_arr = array( __( "Same window", "js_composer" ) => "_self", __( "New window", "js_composer" ) => "_blank" );

$pricing_entries = get_posts( 'post_type=pricing&orderby=title&numberposts=-1&order=ASC' );
$pricing = '';
foreach ( $pricing_entries as $key => $entry ) {
    $pricing[$entry->ID] = $entry->post_title;
}


$employees_entries = get_posts( 'post_type=employees&orderby=title&numberposts=-1&order=ASC' );
$employees = '';
foreach ( $employees_entries as $key => $entry ) {
    $employees[$entry->ID] = $entry->post_title;
}


$flexslider_entries = get_posts( 'post_type=slideshow&orderby=title&numberposts=-1&order=ASC' );
$flexslider = '';
foreach ( $flexslider_entries as $key => $entry ) {
    $flexslider[$entry->ID] = $entry->post_title;
}

$portfolio_entries = get_posts( 'post_type=portfolio&orderby=title&numberposts=-1&order=ASC' );
$portfolio_posts = '';
foreach ( $portfolio_entries as $key => $entry ) {
    $portfolio_posts[$entry->ID] = $entry->post_title;
}


$clients_entries = get_posts( 'post_type=clients&orderby=title&numberposts=-1&order=ASC' );
$clients = '';
foreach ( $clients_entries as $key => $entry ) {
    $clients[$entry->ID] = $entry->post_title;
}

$testimonials_entries = get_posts( 'post_type=testimonial&orderby=title&numberposts=-1&order=ASC' );
$testimonials = '';
foreach ( $testimonials_entries as $key => $entry ) {
    $testimonials[$entry->ID] = $entry->post_title;
}


$page_entries = get_pages( 'title_li=&orderby=name' );
$pages = '';
foreach ( $page_entries as $key => $entry ) {
    $pages[$entry->ID] = $entry->post_title;
}


$cats_entries = get_categories( 'orderby=name&hide_empty=0' );
$categories = '';
foreach ( $cats_entries as $key => $entry ) {
    $categories[$entry->term_id] = $entry->name;
}


global $wpdb;
$order = 'user_id';
$authors = '';
$user_ids = $wpdb->get_col( $wpdb->prepare( "SELECT $wpdb->usermeta.user_id FROM $wpdb->usermeta where meta_key='wp_user_level' and meta_value>=1 ORDER BY %s ASC", $order ) );
foreach ( $user_ids as $user_id ) :
    $user = get_userdata( $user_id );
$authors[$user_id] = $user->display_name;
endforeach;



$posts_entries = get_posts( 'orderby=title&numberposts=-1&order=ASC' );
$posts = '';
foreach ( $posts_entries as $key => $entry ) {
    $posts[$entry->ID] = $entry->post_title;
}





$color_list = array(
    "Red" => "red",
    "Blue" => "blue",
    "Teal" => "teal",
    "Pink" => "pink",
    "Black" => "black",
    "White" => "white",
    "Green" => "green",
    "Aqua" => "aqua",
    "Purple" => "purple",
    "Orange" => "orange",
    "Gray" => "gray"
);


wpb_map( array(
        "name"      => __( "Text block", "js_composer" ),
        "base"      => "vc_column_text",
        "class"     => "mk-text-block-class",
        "icon"      => "mk-shortcode-icon-text-block",

        "params"    => array(
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => __( "Text", "js_composer" ),
                "param_name" => "content",
                "value" => __( "", "js_composer" ),
                "description" => __( "Enter your content.", "js_composer" )
            ),

            array(
                "type" => "range",
                "heading" => __( "Margin Bottom", "js_composer" ),
                "param_name" => "margin_bottom",
                "value" => "0",
                "min" => "0",
                "max" => "200",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Text Color", "js_composer" ),
                "param_name" => "text_color",
                "value" => "",
                "description" => __( "Optionally you can choose text color, defualt is your global body text color", "js_composer" )
            ),
            array(
                "type" => "fonts",
                "heading" => __( "Font Family", "js_composer" ),
                "param_name" => "font_family",
                "value" => "",
                "description" => __( "You can choose a font for this shortcode, however using non-safe fonts can affect page load and performance.", "js_composer" )
            ),
            array(
                "type" => "hidden_input",
                "param_name" => "font_type",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Text Size", "js_composer" ),
                "param_name" => "text_size",
                "value" => "12",
                "min" => "12",
                "max" => "50",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "You can set  text block size from the below option.", "js_composer" )
            ),

            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
            ),
        )
    ) );



wpb_map( array(
        "name"      => __( "Blockquote", "js_composer" ),
        "base"      => "mk_blockquote",
        "class"     => "mk-blockquote-class",
        "icon"      => "mk-shortcode-icon-blockquote",
        "params"    => array(

            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __( "Blockquote Message", "js_composer" ),
                "param_name" => "content",
                "value" => __( "", "js_composer" ),
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Style", "js_composer" ),
                "param_name" => "style",
                "width" => 150,
                "value" => array( __( 'Tootltip Version', "js_composer" ) => "style1", __( 'Boxed Version', "js_composer" ) => "style2" ),
                "description" => __( "Using this option you can choose blockquote style.", "js_composer" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Skin", "js_composer" ),
                "param_name" => "skin",
                "width" => 200,
                "value" => $color_list,
                "description" => __( "we offer a limited number of colors to be applied to this shortcode. please choose your prefered color from the list below", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Text Color", "js_composer" ),
                "param_name" => "text_color",
                "value" => "#fff",
                "description" => __( "Optionally you can choose text color, defualt is white", "js_composer" )
            ),
            array(
                "type" => "fonts",
                "heading" => __( "Font Family", "js_composer" ),
                "param_name" => "font_family",
                "value" => "",
                "description" => __( "You can choose a font for this shortcode, however using non-safe fonts can affect page load and performance.", "js_composer" )
            ),
            array(
                "type" => "hidden_input",
                "param_name" => "font_type",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Text Size", "js_composer" ),
                "param_name" => "text_size",
                "value" => "20",
                "min" => "12",
                "max" => "50",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "You can set blockquote text size from the below option.", "js_composer" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Align", "js_composer" ),
                "param_name" => "align",
                "width" => 150,
                "value" => array( __( 'Left', "js_composer" ) => "left", __( 'Right', "js_composer" ) => "right", __( 'Center', "js_composer" ) => "center" ),
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);













wpb_map( array(
        "name"      => __( "Dropcaps", "js_composer" ),
        "base"      => "mk_dropcaps",
        "class"     => "mk-dropcaps-class",
        "icon"      => "mk-shortcode-icon-dropcaps",
        "controls"  => "edit_popup_delete",
        "params"    => array(

            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __( "Dropcaps Character", "js_composer" ),
                "param_name" => "content",
                "value" => __( "", "js_composer" ),
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "color",
                "heading" => __( "Text Color", "js_composer" ),
                "param_name" => "text_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "color",
                "heading" => __( "Background Color", "js_composer" ),
                "param_name" => "bg_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Text Size", "js_composer" ),
                "param_name" => "text_size",
                "value" => "16",
                "min" => "12",
                "max" => "50",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "You can set Dropcaps text size from the below option.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);


















wpb_map( array(
        "name"      => __( "Highlight Text", "js_composer" ),
        "base"      => "mk_highlight",
        "class"     => "mk-highlight-class",
        "icon"      => "mk-shortcode-icon-highlight",
        "controls"  => "edit_popup_delete",
        "params"    => array(

            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __( "Highlight Message", "js_composer" ),
                "param_name" => "content",
                "value" => __( "", "js_composer" ),
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "color",
                "heading" => __( "Text Color", "js_composer" ),
                "param_name" => "text_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "color",
                "heading" => __( "Background Color", "js_composer" ),
                "param_name" => "bg_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "fonts",
                "heading" => __( "Font Family", "js_composer" ),
                "param_name" => "font_family",
                "value" => "",
                "description" => __( "You can choose a font for this shortcode, however using non-safe fonts can affect page load and performance.", "js_composer" )
            ),
            array(
                "type" => "hidden_input",
                "param_name" => "font_type",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);














wpb_map( array(
        "name"      => __( "Custom List", "js_composer" ),
        "base"      => "mk_custom_list",
        "class"     => "mk-list-styles-class",
        "icon"      => "mk-shortcode-icon-list-styles",
        "params"    => array(

            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __( "Add your unordred list into this textarea. <pre><ul><li></li></pre>", "js_composer" ),
                "param_name" => "content",
                "value" => __( "", "js_composer" ),
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Icon Style", "js_composer" ),
                "param_name" => "style",
                "value" => array(
                    "Arrow" => "style1",
                    "Square" => "style2",
                    "Tick" => "style3",
                    "Four Square" => "style4",
                    "Cross" => "style5",
                    "Plus" => "style6",
                    "Minus" => "style7",
                    "Star" => "style8",
                    "Exclamation" => "style9",
                    "Tooltip" => "style10",
                ),
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Icon Color", "js_composer" ),
                "param_name" => "color",
                "value" => array(
                    "Black" => "color1",
                    "White" => "color2",
                    "Cerulean" => "color3",
                    "Green" => "color4",
                    "Light Brown" => "color5",
                    "Red" => "color6",
                ),
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);




wpb_map( array(
        "name"      => __( "Lifetime icons", "js_composer" ),
        "base"      => "mk_lifetime_icons",
        "class"     => "mk-lifetime-icons-class",
        "icon"      => "mk-shortcode-icon-lifetime-icons",
        "controls"  => "edit_popup_delete",
        "params"    => array(

            array(
                "type" => "dropdown",
                "heading" => __( "Icons", "js_composer" ),
                "param_name" => "icon",
                "value" => array(
                    "alarm" => "alarm",
                    "apps" => "apps",
                    "arrow" => "arrow",
                    "attach" => "attach",
                    "balloon" => "balloon",
                    "Calculator" => "calc",
                    "calendar" => "calendar",
                    "camera" => "camera",
                    "reject" => "reject",
                    "cardio" => "cardio",
                    "cloud" => "cloud",
                    "cloud out" => "cloud_out",
                    "compass" => "compass",
                    "cup" => "cup",
                    "document" => "document",
                    "dollar" => "dollar",
                    "drop" => "drop",
                    "fire" => "fire",
                    "flag" => "flag",
                    "food" => "food",
                    "forbidden" => "forbidden",
                    "game" => "game",
                    "settings" => "settings",
                    "guard" => "guard",
                    "hand" => "hand",
                   // "headphone" => "headphone",
                    "headquarters" => "headquarters",
                    "heart" => "heart",
                    "home" => "home",
                    "pin" => "pin",
                    "ipod" => "ipod",
                    "key" => "key",
                    "lamp" => "lamp",
                    "like" => "like",
                    "location" => "location",
                    "lock" => "lock",
                    "message" => "message",
                    "mobile" => "mobile",
                    "monitor" => "monitor",
                    "music" => "music",
                    "navigation" => "navigation",
                    "news" => "news",
                    "sitemap" => "sitemap",
                    "oldmac" => "oldmac",
                    "phone" => "phone",
                    "picture" => "picture",
                    "piechart" => "piechart",
                    "pin" => "pin",
                    "play" => "play",
                    "plug" => "plug",
                    "print" => "print",
                    "quotation" => "quotation",
                    "refresh" => "refresh",
                    "ribbon" => "ribbon",
                    "search" => "search",
                    "settings" => "settings",
                    "shopping" => "shopping",
                    "shout" => "shout",
                    "shutdown" => "shutdown",
                    "navigation" => "navigation",
                    "sound" => "sound",
                    "star" => "star",
                    "statistics" => "stat",
                    "stop" => "stop",
                    "suitcase" => "suitcase",
                    "support" => "support",
                    "tag" => "tag",
                    "tick" => "tick",
                    "time" => "time",
                    "tree" => "tree",
                    "twitter" => "twitter",
                    //"umbrella" => "umbrella",
                    "upload" => "upload",
                    "user" => "user",
                    "wifi" => "wifi",
                    "wrench" => "wrench",
                    "write" => "write",

                ),
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Icon Color", "js_composer" ),
                "param_name" => "color",
                "value" => array(
                    "Gray" => "gray",
                    "White" => "white",
                    "blue" => "blue",
                    "Green" => "green",
                    "Yellow" => "yellow",
                    "Red" => "red",
                ),
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Icon Size", "js_composer" ),
                "param_name" => "size",
                "value" => array(
                    "16px" => "small",
                    "32px" => "medium",
                    "48px" => "large",
                    "64px" => "x-large",
                    "128px" => "xx-large",
                    "256px" => "xxx-large",
                    
                ),
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "color",
                "heading" => __( "Custom Color", "js_composer" ),
                "param_name" => "custom_color",
                "value" => "",
                "description" => __( "You can set a differnt color other than pre-defined colors", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Padding", "js_composer" ),
                "param_name" => "padding",
                "value" => "3",
                "min" => "0",
                "max" => "50",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "You can give padding to the icon. this padding will be applied to each side.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);















wpb_map( array(
        "name"      => __( "Message Box", "js_composer" ),
        "base"      => "mk_message_box",
        "class"     => "mk-message-box-class",
        "icon"      => "mk-shortcode-icon-message-box",
        "params"    => array(

            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __( "Write your message in this texarea.", "js_composer" ),
                "param_name" => "content",
                "value" => __( "", "js_composer" ),
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Type", "js_composer" ),
                "param_name" => "type",
                "value" => array(
                    "Alert" => "alert",
                    "Cancel" => "cancel",
                    "Confrim" => "confirm",
                    "Fact" => "fact",
                    "Help" => "help",
                    "Hint" => "hint",
                    "Info" => "info",
                    "Star" => "star",
                ),
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Style", "js_composer" ),
                "param_name" => "style",
                "value" => array(
                    "Pattern" => "pattern",
                    "Solid" => "solid",
                ),
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Box Background Color", "js_composer" ),
                "param_name" => "bg_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Box Text Color", "js_composer" ),
                "param_name" => "txt_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "fonts",
                "heading" => __( "Font Family", "js_composer" ),
                "param_name" => "font_family",
                "value" => "",
                "description" => __( "You can choose a font for this shortcode, however using non-safe fonts can affect page load and performance.", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Text Size (optional)", "js_composer" ),
                "param_name" => "text_size",
                "value" => "18",
                "min" => "12",
                "max" => "50",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "You can set Messagebox text size from this option.", "js_composer" )
            ),
            array(
                "type" => "hidden_input",
                "param_name" => "font_type",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);




wpb_map( array(
        "name"      => __( "Content Box", "js_composer" ),
        "base"      => "mk_content_box",
        "class"     => "mk-content-box-class",
        "icon"      => "mk-shortcode-icon-content-box",
        "params"    => array(

            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __( "Content.", "js_composer" ),
                "param_name" => "content",
                "value" => __( "", "js_composer" ),
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "fonts",
                "heading" => __( "Font Family", "js_composer" ),
                "param_name" => "font_family",
                "value" => "",
                "description" => __( "You can choose a font for this shortcode, however using non-safe fonts can affect page load and performance.", "js_composer" )
            ),
            array(
                "type" => "hidden_input",
                "param_name" => "font_type",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Box Background Color", "js_composer" ),
                "param_name" => "bg_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "color",
                "heading" => __( "Box Text Color", "js_composer" ),
                "param_name" => "text_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Font Size", "js_composer" ),
                "param_name" => "text_size",
                "value" => "24",
                "min" => "12",
                "max" => "100",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Align", "js_composer" ),
                "param_name" => "align",
                "width" => 150,
                "value" => array( __( 'Left', "js_composer" ) => "left", __( 'Right', "js_composer" ) => "right", __( 'Center', "js_composer" ) => "center" ),
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);



wpb_map( array(
        "name"      => __( "Fancy Text", "js_composer" ),
        "base"      => "mk_fancy_text",
        "class"     => "mk-fancy-texts-class",
        "icon"      => "mk-shortcode-icon-fancy-texts",
        "params"    => array(

            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __( "Content.", "js_composer" ),
                "param_name" => "content",
                "value" => __( "", "js_composer" ),
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "color",
                "heading" => __( "Highlight Background Color", "js_composer" ),
                "param_name" => "highlight_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Text Color", "js_composer" ),
                "param_name" => "text_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "fonts",
                "heading" => __( "Font Family", "js_composer" ),
                "param_name" => "font_family",
                "value" => "",
                "description" => __( "You can choose a font for this shortcode, however using non-safe fonts can affect page load and performance.", "js_composer" )
            ),
             array(
                "type" => "dropdown",
                "heading" => __( "Font Weight", "js_composer" ),
                "param_name" => "font_weight",
                "width" => 150,
                "value" => array( __( 'Light', "js_composer" ) => "300", __( 'Normal', "js_composer" ) => "normal", __( 'Bold', "js_composer" ) => "bold", __( 'Bolder', "js_composer" ) => "bolder" ),
                "description" => __( "", "js_composer" )
            ),
 
            array(
                "type" => "hidden_input",
                "param_name" => "font_type",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Font Size", "js_composer" ),
                "param_name" => "text_size",
                "value" => "40",
                "min" => "12",
                "max" => "100",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "range",
                "heading" => __( "Line Height", "js_composer" ),
                "param_name" => "line_height",
                "value" => "72",
                "min" => "12",
                "max" => "150",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "Since not all fonts are standard and they have differnt line heights, so please set its height manually. generally line height should be larger than font size. with few tries you can get the desired results.", "js_composer" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Align", "js_composer" ),
                "param_name" => "align",
                "width" => 150,
                "value" => array( __( 'Left', "js_composer" ) => "left", __( 'Right', "js_composer" ) => "right", __( 'Center', "js_composer" ) => "center" ),
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);




wpb_map( array(
        "name"      => __( "Fancy Title", "js_composer" ),
        "base"      => "mk_fancy_title",
        "class"     => "mk-fancy-title-class",
        "icon"      => "mk-shortcode-icon-fancy-title",
        "params"    => array(

            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __( "Content.", "js_composer" ),
                "param_name" => "content",
                "value" => __( "", "js_composer" ),
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Tag Name", "js_composer" ),
                "param_name" => "tag_name",
                "value" => array(
                    "h1" => "h1",
                    "h2" => "h2",
                    "h3" => "h3",
                    "h4" => "h4",
                    "h5" => "h5",
                    "h6" => "h6",
                ),
                "description" => __( "For SEO reasons you might need to define your titles tag names according to priority. For example if this title is the important select h1 or h2.", "js_composer" )
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Style", "js_composer" ),
                "param_name" => "style",
                "value" => array(
                    "Simple" => "simple",
                    "Pattern" => "pattern",
                    "Divider" => "divider",
                ),
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Text Color", "js_composer" ),
                "param_name" => "color",
                "value" => "#393836",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Font Size", "js_composer" ),
                "param_name" => "size",
                "value" => "30",
                "min" => "12",
                "max" => "70",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Margin Button", "js_composer" ),
                "param_name" => "margin_bottom",
                "value" => "40",
                "min" => "0",
                "max" => "500",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "fonts",
                "heading" => __( "Font Family", "js_composer" ),
                "param_name" => "font_family",
                "value" => "",
                "description" => __( "You can choose a font for this shortcode, however using non-safe fonts can affect page load and performance.", "js_composer" )
            ),
            array(
                "type" => "hidden_input",
                "param_name" => "font_type",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),


            array(
                "type" => "dropdown",
                "heading" => __( "Align", "js_composer" ),
                "param_name" => "align",
                "width" => 150,
                "value" => array( __( 'Left', "js_composer" ) => "left", __( 'Right', "js_composer" ) => "right", __( 'Center', "js_composer" ) => "center" ),
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);




wpb_map( array(
        "name"      => __( "Toggle", "js_composer" ),
        "base"      => "mk_toggle",
        "class"     => "mk-accordion-class",
        "icon"      => "mk-shortcode-icon-accordion",
        "params"    => array(

            array(
                "type" => "textfield",
                "heading" => __( "Toggle Title", "js_composer" ),
                "param_name" => "title",
                "value" => "",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __( "Toggle Content.", "js_composer" ),
                "param_name" => "content",
                "value" => __( "", "js_composer" ),
            ),

            array(
                "type" => "color",
                "heading" => __( "Container Background Color", "js_composer" ),
                "param_name" => "container_bg_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "color",
                "heading" => __( "Container Text Color", "js_composer" ),
                "param_name" => "container_txt_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);



wpb_map( array(
        "name"      => __( "Accordion", "js_composer" ),
        "base"      => "vc_accordion",
        "class"     => "wpb_accordion mk-accordion-class",
        "icon"      => "mk-shortcode-icon-accordion",
        "params"    => array(
            array(
                "type" => "color",
                "heading" => __( "Container Background Color", "js_composer" ),
                "param_name" => "container_bg_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "color",
                "heading" => __( "Container Text Color", "js_composer" ),
                "param_name" => "container_txt_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
            )
        ),
        "custom_markup" => '
    <div class="tab_controls">
        <a href="#" class="add_tab add_accordion_shortcode mk-button mk-ancilary highlight-color">'.__( "Add section", "js_composer" ).'</a>
        <a href="#" class="edit_tab mk-button mk-ancilary highlight-color">'.__( "Edit current section title", "js_composer" ).'</a>
        <a href="#" class="delete_tab mk-button mk-ancilary highlight-color">'.__( "Delete current section", "js_composer" ).'</a>
    </div>

    <div class="wpb_accordion_holder clearfix">
        %content%
    </div>',
        'default_content' => '
    <div class="group">
        <h3><a href="#">'.__( 'Section 1', 'js_composer' ).'</a></h3>
        <div>
            <div class="row-fluid wpb_column_container wpb_sortable_container not-column-inherit">
                [vc_column_text width="1/1"] '.__( 'I am text block. Click edit button to change this text.', 'js_composer' ).' [/vc_column_text]
            </div>
        </div>
    </div>
    <div class="group">
        <h3><a href="#">'.__( 'Section 2', 'js_composer' ).'</a></h3>
        <div>
            <div class="row-fluid wpb_column_container wpb_sortable_container not-column-inherit">
                [vc_column_text width="1/1"] '.__( 'I am text block. Click edit button to change this text.', 'js_composer' ).' [/vc_column_text]
            </div>
        </div>
    </div>',
        "js_callback" => array( "init" => "wpbAccordionInitCallBack", "shortcode" => "wpbAccordionGenerateShortcodeCallBack" )
    ) );



wpb_map( array(
        "name"      => __( "Tabs", "js_composer" ),
        "base"      => "vc_tabs",
        "class"     => "wpb_accordion mk-tabs-class ",
        "icon"      => "mk-shortcode-icon-tabs",
        "params"    => array(
            array(
                "type" => "dropdown",
                "heading" => __( "Orientation", "js_composer" ),
                "param_name" => "orientation",
                "value" => array(
                    "Horizental" => "horizental",
                    "Vertical" => "vertical",

                ),
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Container Background Color", "js_composer" ),
                "param_name" => "container_bg_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
            )
        ),
        "custom_markup" => '
    <div class="tab_controls">
        <a href="#" class="add_tab add_tab_shortcode mk-button mk-ancilary highlight-color">'.__( "Add Tab", "js_composer" ).'</a>
        <a href="#" class="edit_tab mk-button mk-ancilary highlight-color">'.__( "Edit current Tab title", "js_composer" ).'</a>
        <a href="#" class="delete_tab mk-button mk-ancilary highlight-color">'.__( "Delete current Tab", "js_composer" ).'</a>
    </div>

    <div class="wpb_accordion_holder clearfix">
        %content%
    </div>',
        'default_content' => '
    <div class="group">
        <h3><a href="#">'.__( 'Tab 1', 'js_composer' ).'</a></h3>
        <div>
            <div class="row-fluid wpb_column_container wpb_sortable_container not-column-inherit">
                [vc_column_text width="1/1"] '.__( 'I am text block. Click edit button to change this text.', 'js_composer' ).' [/vc_column_text]
            </div>
        </div>
    </div>
    <div class="group">
        <h3><a href="#">'.__( 'Tab 2', 'js_composer' ).'</a></h3>
        <div>
            <div class="row-fluid wpb_column_container wpb_sortable_container not-column-inherit">
                [vc_column_text width="1/1"] '.__( 'I am text block. Click edit button to change this text.', 'js_composer' ).' [/vc_column_text]
            </div>
        </div>
    </div>',
        "js_callback" => array( "init" => "wpbAccordionInitCallBack", "shortcode" => "wpbTabsGenerateShortcodeCallBack" )
    ) );





wpb_map( array(
        "name"      => __( "Content Slideshow", "js_composer" ),
        "base"      => "mk_content_slideshow",
        "class"     => "wpb_accordion mk-content-slider-class",
        "icon"      => "mk-shortcode-icon-content-slider",
        "params"    => array(
            array(
                "heading" => __( "Animation Effect", 'theme_frontend' ),
                "description" => __( "", 'theme_frontend' ),
                "param_name" => "effect",
                "value" => array(
                    __( "Fade", 'theme_frontend' )  =>  "fade",
                    __( "Slide", 'theme_frontend' ) =>  "slide",
                ),
                "type" => "dropdown"
            ),

            array(
                "type" => "range",
                "heading" => __( "Animation Speed", "js_composer" ),
                "param_name" => "animation_speed",
                "value" => "700",
                "min" => "100",
                "max" => "3000",
                "step" => "1",
                "unit" => 'posts',
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Slideshow Speed", "js_composer" ),
                "param_name" => "slideshow_speed",
                "value" => "7000",
                "min" => "1000",
                "max" => "20000",
                "step" => "1",
                "unit" => 'posts',
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Pause on Hover", "js_composer" ),
                "param_name" => "pause_on_hover",
                "value" => "false",
                "description" => __( "Pause the slideshow when hovering over slider, then resume when no longer hovering", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Smooth Height", "js_composer" ),
                "param_name" => "smooth_height",
                "value" => "true",
                "description" => __( "Allow height of the slider to animate smoothly in horizontal mode", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Direction Nav", "js_composer" ),
                "param_name" => "direction_nav",
                "value" => "true",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Content Background Color", "js_composer" ),
                "param_name" => "bg_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "color",
                "heading" => __( "Direction Navigation Arrows Color", "js_composer" ),
                "param_name" => "arrow_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
            )
        ),
        "custom_markup" => '
    <div class="tab_controls">
        <a href="#" class="add_tab add_slideshow_item mk-button mk-ancilary highlight-color">'.__( "Add Slide", "js_composer" ).'</a>
        <a href="#" class="delete_tab mk-button mk-ancilary highlight-color">'.__( "Delete current Tab", "js_composer" ).'</a>
    </div>

    <div class="wpb_accordion_holder clearfix">
        %content%
    </div>',
        'default_content' => '
    <div class="group">
        <h3><a href="#">'.__( 'Slide Item', 'js_composer' ).'</a></h3>
        <div>
            <div class="row-fluid wpb_column_container wpb_sortable_container not-column-inherit">
                [vc_column_text width="1/1"] '.__( 'I am text block. Click edit button to change this text.', 'js_composer' ).' [/vc_column_text]
            </div>
        </div>
    </div>
    <div class="group">
        <h3><a href="#">'.__( 'Slide Item', 'js_composer' ).'</a></h3>
        <div>
            <div class="row-fluid wpb_column_container wpb_sortable_container not-column-inherit">
                [vc_column_text width="1/1"] '.__( 'I am text block. Click edit button to change this text.', 'js_composer' ).' [/vc_column_text]
            </div>
        </div>
    </div>',
        "js_callback" => array( "init" => "wpbAccordionInitCallBack", "shortcode" => "wpbContentSlideshowGenerateShortcodeCallBack" )
    ) );




wpb_map( array(
        "name"      => __( "Tabbed Box", "js_composer" ),
        "base"      => "vc_tabbed_boxes",
        "controls"  => "edit_popup_delete",
        "class"     => "wpb_accordion mk-tabs-class ",
        "icon"      => "mk-shortcode-icon-tabs",
        "params"    => array(
            array(
                "type" => "color",
                "heading" => __( "Container Background Color", "js_composer" ),
                "param_name" => "container_bg_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
            )
        ),
        "custom_markup" => '
    <div class="tab_controls">
        <a href="#" class="add_tab add_tab_shortcode mk-button mk-ancilary highlight-color">'.__( "Add Tab", "js_composer" ).'</a>
        <a href="#" class="edit_tab mk-button mk-ancilary highlight-color">'.__( "Edit current Tab title", "js_composer" ).'</a>
        <a href="#" class="delete_tab mk-button mk-ancilary highlight-color">'.__( "Delete current Tab", "js_composer" ).'</a>
    </div>

    <div class="wpb_accordion_holder clearfix">
        %content%
    </div>',
        'default_content' => '
    <div class="group">
        <h3><a href="#">'.__( 'Tab 1', 'js_composer' ).'</a></h3>
        <div>
            <div class="row-fluid wpb_column_container wpb_sortable_container not-column-inherit">
                [vc_column_text width="1/1"] '.__( 'I am text block. Click edit button to change this text.', 'js_composer' ).' [/vc_column_text]
            </div>
        </div>
    </div>
    <div class="group">
        <h3><a href="#">'.__( 'Tab 2', 'js_composer' ).'</a></h3>
        <div>
            <div class="row-fluid wpb_column_container wpb_sortable_container not-column-inherit">
                [vc_column_text width="1/1"] '.__( 'I am text block. Click edit button to change this text.', 'js_composer' ).' [/vc_column_text]
            </div>
        </div>
    </div>',
        "js_callback" => array( "init" => "wpbAccordionInitCallBack", "shortcode" => "wpbTabbedBoxGenerateShortcodeCallBack" )
    ) );






wpb_map( array(
        "name"      => __( "Divider", "js_composer" ),
        "base"      => "mk_divider",
        "class"     => "mk-divider-class",
        "icon"      => "mk-shortcode-icon-divider",
        "params"    => array(

            array(
                "type" => "dropdown",
                "heading" => __( "Style", "js_composer" ),
                "param_name" => "style",
                "value" => array(
                    "Single" => "single",
                    "Dotted" => "dotted",
                    "Bold" => "bold",
                    "Pattern" => "pattern",
                ),
                "description" => __( "Please Choose the style of the line of divider.", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Divider Color", "js_composer" ),
                "param_name" => "color",
                "value" => "",
                "description" => __( "Except Pattern style you can give your own color to the divider.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);









wpb_map( array(
        "name"      => __( "Social Networks", "js_composer" ),
        "base"      => "mk_social_networks",
        "class"     => "mk-social-networks-class",
        "icon"      => "mk-shortcode-icon-social-networks",
        "controls"  => "edit_popup_delete",
        "params"    => array(
            array(
                "type" => "dropdown",
                "heading" => __( "Size", "js_composer" ),
                "param_name" => "size",
                "value" => array(
                    "Large" => "large",
                    "Medium" => "medium",
                    "Small" => "small",
                ),
            ),
            array(
                "type" => "color",
                "heading" => __( "Icons Background Color", "js_composer" ),
                "param_name" => "icon_color",
                "value" => "",
                "description" => __( "Choose which color would you like on icons normal state. default: rgba(0,0,0,0.3)", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Icons Hover Background Color", "js_composer" ),
                "param_name" => "icon_hover_color",
                "value" => "",
                "description" => __( "This options defines icons hover state backgournd color. default : rgba(0,0,0,0.6)", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Facebook URL", "js_composer" ),
                "param_name" => "facebook",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Twitter URL", "js_composer" ),
                "param_name" => "twitter",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "RSS URL", "js_composer" ),
                "param_name" => "rss",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Dribbble URL", "js_composer" ),
                "param_name" => "dribbble",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Digg URL", "js_composer" ),
                "param_name" => "digg",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Pinterest URL", "js_composer" ),
                "param_name" => "pinterest",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Flickr URL", "js_composer" ),
                "param_name" => "flickr",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Google Plus URL", "js_composer" ),
                "param_name" => "google_plus",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Linkedin URL", "js_composer" ),
                "param_name" => "linkedin",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Blogger URL", "js_composer" ),
                "param_name" => "blogger",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Youtube URL", "js_composer" ),
                "param_name" => "youtube",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Last-fm URL", "js_composer" ),
                "param_name" => "last_fm",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Live Journal URL", "js_composer" ),
                "param_name" => "live_journal",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Stumble-upon URL", "js_composer" ),
                "param_name" => "stumble_upon",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Tumblr URL", "js_composer" ),
                "param_name" => "tumblr",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Vimeo URL", "js_composer" ),
                "param_name" => "vimeo",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Wordpress URL", "js_composer" ),
                "param_name" => "wordpress",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Yelp URL", "js_composer" ),
                "param_name" => "yelp",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Reddit URL", "js_composer" ),
                "param_name" => "reddit",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Technorati URL", "js_composer" ),
                "param_name" => "technorati",
                "value" => "",
                "description" => __( "Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);






wpb_map( array(
        "name"      => __( "Fancy Divider", "js_composer" ),
        "base"      => "mk_fancy_divider",
        "class"     => "mk-fancy-divider-class",
        "icon"      => "mk-shortcode-icon-fancy-divider",
        "params"    => array(

            array(
                "type" => "textfield",
                "heading" => __( "Divider Title", "js_composer" ),
                "param_name" => "divider_text",
                "value" => "Fancy Divider",
                "description" => __( "Please write your fancy divider title here.", "js_composer" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Style", "js_composer" ),
                "param_name" => "style",
                "value" => array(
                    "Solid Color" => "solid",
                    "Pattern" => "pattern",

                ),
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Size", "js_composer" ),
                "param_name" => "size",
                "value" => array(
                    "Small" => "small",
                    "Medium" => "medium",
                    "Large" => "large",
                ),
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "fonts",
                "heading" => __( "Font Family", "js_composer" ),
                "param_name" => "font_family",
                "value" => "",
                "description" => __( "You can choose a font for this shortcode, however using non-safe fonts can affect page load and performance.", "js_composer" )
            ),
            array(
                "type" => "hidden_input",
                "param_name" => "font_type",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Title Background Color", "js_composer" ),
                "param_name" => "title_bg",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);





wpb_map( array(
        "name"      => __( "Skill Meter", "js_composer" ),
        "base"      => "mk_skill_meter",
        "class"     => "mk-skill-meter-class",
        "icon"      => "mk-shortcode-icon-skill-meter",
        "params"    => array(

            array(
                "type" => "textfield",
                "heading" => __( "Title", "js_composer" ),
                "param_name" => "title",
                "value" => "",
                "description" => __( "What skill are you demonstrating?", "js_composer" )
            ),

            array(
                "type" => "range",
                "heading" => __( "Percent", "js_composer" ),
                "param_name" => "percent",
                "value" => "50",
                "min" => "0",
                "max" => "100",
                "step" => "1",
                "unit" => '%',
                "description" => __( "How many percent would you like to show from this skill?", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Progress Bar Background Color", "js_composer" ),
                "param_name" => "color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);





wpb_map( array(
        "name"      => __( "Image", "js_composer" ),
        "base"      => "mk_image",
        "class"     => "mk-image-class",
        "icon"      => "mk-shortcode-icon-image",
        "params"    => array(

            array(
                "type" => "upload",
                "heading" => __( "Uplaod Your image", "js_composer" ),
                "param_name" => "src",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "range",
                "heading" => __( "Image Width", "js_composer" ),
                "param_name" => "image_width",
                "value" => "770",
                "min" => "50",
                "max" => "1300",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Image Height", "js_composer" ),
                "param_name" => "image_height",
                "value" => "350",
                "min" => "50",
                "max" => "3000",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Enable Lightbox", "js_composer" ),
                "param_name" => "lightbox",
                "value" => "false",
                "description" => __( "If you would like to have lightbox (image zoom in a frame) enable this option.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Lightbox Group rel", "js_composer" ),
                "param_name" => "group",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Crop Image", "js_composer" ),
                "param_name" => "crop",
                "value" => "true",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "textfield",
                "heading" => __( "Image Link", "js_composer" ),
                "param_name" => "link",
                "value" => "",
                "description" => __( "Optionally you can link your image.", "js_composer" )
            ),

            array(
                "type" => "textfield",
                "heading" => __( "Image Caption", "js_composer" ),
                "param_name" => "caption",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "color",
                "heading" => __( "Caption Background Color", "js_composer" ),
                "param_name" => "caption_bg_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Caption Text Color", "js_composer" ),
                "param_name" => "caption_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "range",
                "heading" => __( "Caption Opacity", "js_composer" ),
                "param_name" => "caption_bg_opacity",
                "value" => "0.6",
                "min" => "0.1",
                "max" => "1",
                "step" => "0.1",
                "unit" => 'alpha',
                "description" => __( "You can change caption conatiner's opacity to give it an overlay effect over image.", "js_composer" )
            ),

            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
            ),



        )
    )
);



wpb_map( array(
        "name"      => __( "Gallery", "js_composer" ),
        "base"      => "mk_gallery",
        "class"     => "mk-image-class",
        "icon"      => "mk-shortcode-icon-image",
        "params"    => array(

            array(
                "type" => "attach_images",
                "heading" => __( "Attach Your images", "js_composer" ),
                "param_name" => "images",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),

         array(
                "type" => "range",
                "heading" => __( "How many Column?", "js_composer" ),
                "param_name" => "column",
                "value" => "4",
                "min" => "1",
                "max" => "4",
                "step" => "1",
                "unit" => 'column',
                "description" => __( "How many columns would you like to appeare in one row?", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Image Heights", "js_composer" ),
                "param_name" => "height",
                "value" => "300",
                "min" => "100",
                "max" => "1000",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "You can define you gallery image's height from this option.", "js_composer" )
            ),

             array(
                "type" => "textfield",
                "heading" => __( "Collection Title", "js_composer" ),
                "param_name" => "title",
                "value" => "",
                "description" => __( "This title will be appeared in lightbox.", "js_composer" )
            ),

            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
            ),



        )
    )
);




wpb_map( array(
        "name"      => __( "Banner Text", "js_composer" ),
        "base"      => "mk_banner_text",
        "class"     => "mk-banner-text-class",
        "icon"      => "mk-shortcode-icon-banner-text",
        "params"    => array(

            array(
                "type" => "upload",
                "heading" => __( "Uplaod Your Banner Image", "js_composer" ),
                "param_name" => "image_src",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "range",
                "heading" => __( "Image Width", "js_composer" ),
                "param_name" => "image_width",
                "value" => "770",
                "min" => "50",
                "max" => "1140",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Image Height", "js_composer" ),
                "param_name" => "image_height",
                "value" => "350",
                "min" => "50",
                "max" => "3000",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "textfield",
                "heading" => __( "Text", "js_composer" ),
                "param_name" => "text",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "fonts",
                "heading" => __( "Font Family", "js_composer" ),
                "param_name" => "font_family",
                "value" => "",
                "description" => __( "You can choose a font for this shortcode, however using non-safe fonts can affect page load and performance.", "js_composer" )
            ),
            array(
                "type" => "hidden_input",
                "param_name" => "font_type",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Text Size", "js_composer" ),
                "param_name" => "text_size",
                "value" => "16",
                "min" => "12",
                "max" => "70",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Text Line Height", "js_composer" ),
                "param_name" => "line_height",
                "value" => "24",
                "min" => "12",
                "max" => "70",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Text Color", "js_composer" ),
                "param_name" => "text_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Text Background Color", "js_composer" ),
                "param_name" => "text_bg_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "range",
                "heading" => __( "Distance From Left", "js_composer" ),
                "param_name" => "position",
                "value" => "200",
                "min" => "0",
                "max" => "1300",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "Where you would like to put the text relative to the left?", "js_composer" )
            ),

            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
            ),



        )
    )
);














wpb_map( array(
        "name"      => __( "Button", "js_composer" ),
        "base"      => "mk_button",
        "class"     => "mk-button-class",
        "icon"      => "mk-shortcode-icon-button",
        "params"    => array(

            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __( "Button Text", "js_composer" ),
                "param_name" => "content",
                "rows" => 2,
                "value" => "",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Size", "js_composer" ),
                "param_name" => "size",
                "value" => array(
                    "Small" => "small",
                    "Medium" => "medium",
                    "Large" => "large",
                ),
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Skin", "js_composer" ),
                "param_name" => "skin",
                "width" => 200,
                "value" => $color_list,
                "description" => __( "we offer a limited number of colors to be applied to this shortcode. please choose your prefered color from the list below", "js_composer" )
            ),

            array(
                "type" => "color",
                "heading" => __( "Custom Background Color", "js_composer" ),
                "param_name" => "bg_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Custom Text Color", "js_composer" ),
                "param_name" => "text_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Target", "js_composer" ),
                "param_name" => "target",
                "width" => 200,
                "value" => $target_arr,
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Align", "js_composer" ),
                "param_name" => "align",
                "width" => 150,
                "value" => array( __( 'Left', "js_composer" ) => "left", __( 'Right', "js_composer" ) => "right", __( 'Center', "js_composer" ) => "center" ),
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "textfield",
                "heading" => __( "Button ID", "js_composer" ),
                "param_name" => "id",
                "value" => "",
                "description" => __( "If your want to use id for this button to refer it in your custom JS, fill this textbox.", "js_composer" )
            ),

            array(
                "type" => "textfield",
                "heading" => __( "Button URL", "js_composer" ),
                "param_name" => "url",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);





wpb_map( array(
        "name"      => __( "Pricing Table", "js_composer" ),
        "base"      => "mk_pricing_table",
        "class"     => "mk-pricing-tables-class",
        "icon"      => "mk-shortcode-icon-pricing-tables",
        "params"    => array(

            array(
                "type" => "textfield",
                "heading" => __( "Offer Title", "js_composer" ),
                "param_name" => "offers_title",
                "value" => "Offers",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "textarea",
                "heading" => __( "Offers", "js_composer" ),
                "param_name" => "offers",
                "rows" => 15,
                "value" => "",
                "description" => __( "Please add your offers text. be infomed list of offers should be as unordered list.", "js_composer" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Skin", "js_composer" ),
                "param_name" => "skin",
                "value" => array(
                    "Light" => "light",
                    "Dark" => "dark",
                ),
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "How Many Tables?", "js_composer" ),
                "param_name" => "table_number",
                "value" => "4",
                "min" => "1",
                "max" => "4",
                "step" => "1",
                "unit" => 'table',
                "description" => __( "How many pricing tables would you like to view?", "js_composer" )
            ),
            array(
                "type" => "multiselect",
                "heading" => __( "Tables", "js_composer" ),
                "param_name" => "tables",
                "value" => '',
                "options" => $pricing,
                "description" => __( "", "js_composer" )
            ),

            array(
                "heading" => __( "Order", 'theme_frontend' ),
                "description" => __( "Designates the ascending or descending order of the 'orderby' parameter.", 'theme_frontend' ),
                "param_name" => "order",
                "value" => array(
                    __( "ASC (ascending order)", 'theme_frontend' ) => "ASC",
                    __( "DESC (descending order)", 'theme_frontend' ) => "DESC"
                ),
                "type" => "dropdown"
            ),
            array(
                "heading" => __( "Orderby", 'theme_frontend' ),
                "description" => __( "Sort retrieved pricing items by parameter.", 'theme_frontend' ),
                "param_name" => "orderby",
                "value" => array(
                    __( "No order", 'theme_frontend' )  =>  "none",
                    __( "Order by post id", 'theme_frontend' ) =>  "id",
                    __( "Order by title", 'theme_frontend' ) =>  "title",
                    __( "Order by date", 'theme_frontend' ) => "date",
                ),
                "type" => "dropdown"
            ),

            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);











wpb_map( array(
        "name"      => __( "Employees", "js_composer" ),
        "base"      => "mk_employees",
        "class"     => "mk-employees-class",
        "icon"      => "mk-shortcode-icon-employees",
        "params"    => array(
            array(
                "heading" => __( "Style", 'theme_frontend' ),
                "description" => __( "", 'theme_frontend' ),
                "param_name" => "style",
                "value" => array(
                    __( "Classic (list of Thumbnails)", 'theme_frontend' ) => "classic",
                    __( "modern (Sliding Carousel)", 'theme_frontend' ) => "modern"
                ),
                "type" => "dropdown"
            ),

            array(
                "type" => "range",
                "heading" => __( "Count", "js_composer" ),
                "param_name" => "count",
                "value" => "-1",
                "min" => "-1",
                "max" => "50",
                "step" => "1",
                "unit" => 'employee',
                "description" => __( "How many Employees you would like to show? (-1 means unlimited)", "js_composer" )
            ),
            array(
                "type" => "multiselect",
                "heading" => __( "Select specific Employees", "js_composer" ),
                "param_name" => "employees",
                "value" => '',
                "options" =>$employees,
                "description" => __( "", "js_composer" )
            ),

            array(
                "heading" => __( "Order", 'theme_frontend' ),
                "description" => __( "Designates the ascending or descending order of the 'orderby' parameter.", 'theme_frontend' ),
                "param_name" => "order",
                "value" => array(
                    __( "ASC (ascending order)", 'theme_frontend' ) => "ASC",
                    __( "DESC (descending order)", 'theme_frontend' ) => "DESC"
                ),
                "type" => "dropdown"
            ),
            array(
                "heading" => __( "Orderby", 'theme_frontend' ),
                "description" => __( "Sort retrieved employee items by parameter.", 'theme_frontend' ),
                "param_name" => "orderby",
                "value" => array(
                    __( "No order", 'theme_frontend' )  =>  "none",
                    __( "Order by post id", 'theme_frontend' ) =>  "id",
                    __( "Order by title", 'theme_frontend' ) =>  "title",
                    __( "Order by date", 'theme_frontend' ) => "date",
                ),
                "type" => "dropdown"
            ),
            array(
                "type" => "color",
                "heading" => __( "Info Box Background Color", "js_composer" ),
                "param_name" => "info_bg_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Info Box Text Color", "js_composer" ),
                "param_name" => "info_txt_color",
                "value" => "",
                "description" => __( "This Option only works for modern style", "js_composer" )
            ),
            array(
                "heading" => __( "Sliding Arrow Skin", 'theme_frontend' ),
                "description" => __( "This Option only works for modern style", 'theme_frontend' ),
                "param_name" => "arrow_skin",
                "value" => array(
                    __( "Dark", 'js_composer' ) => "dark",
                    __( "Light", 'js_composer' ) => "light"
                ),
                "type" => "dropdown"
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);














wpb_map( array(
        "name"      => __( "Clients", "js_composer" ),
        "base"      => "mk_clients",
        "class"     => "mk-clients-class",
        "icon"      => "mk-shortcode-icon-clients",
        "params"    => array(


            array(
                "type" => "range",
                "heading" => __( "Count", "js_composer" ),
                "param_name" => "count",
                "value" => "-1",
                "min" => "-1",
                "max" => "50",
                "step" => "1",
                "unit" => 'clients',
                "description" => __( "How many Clients you would like to show? (-1 means unlimited)", "js_composer" )
            ),
            array(
                "type" => "multiselect",
                "heading" => __( "Select specific Clients", "js_composer" ),
                "param_name" => "clients",
                "value" => '',
                "options" => $clients,
                "description" => __( "", "js_composer" )
            ),

            array(
                "heading" => __( "Order", 'theme_frontend' ),
                "description" => __( "Designates the ascending or descending order of the 'orderby' parameter.", 'theme_frontend' ),
                "param_name" => "order",
                "value" => array(
                    __( "ASC (ascending order)", 'theme_frontend' ) => "ASC",
                    __( "DESC (descending order)", 'theme_frontend' ) => "DESC"
                ),
                "type" => "dropdown"
            ),
            array(
                "heading" => __( "Orderby", 'theme_frontend' ),
                "description" => __( "Sort retrieved client items by parameter.", 'theme_frontend' ),
                "param_name" => "orderby",
                "value" => array(
                    __( "No order", 'theme_frontend' )  =>  "none",
                    __( "Order by post id", 'theme_frontend' ) =>  "id",
                    __( "Order by title", 'theme_frontend' ) =>  "title",
                    __( "Order by date", 'theme_frontend' ) => "date",
                ),
                "type" => "dropdown"
            ),
            array(
                "type" => "toggle",
                "heading" => __( "Slide?", "js_composer" ),
                "param_name" => "slide",
                "value" => "false",
                "description" => __( "If you enable this option the clisnts will be horizentally slide.", "js_composer" )
            ),
            array(
                "heading" => __( "Carousel Sliding Arrow Skin", 'theme_frontend' ),
                "description" => __( "If list is sliding, then you can define left/right navigtion arrows skin to adopt for your background.", 'theme_frontend' ),
                "param_name" => "arrow_skin",
                "value" => array(
                    __( "Dark", 'js_composer' ) => "dark",
                    __( "Light", 'js_composer' ) => "light"
                ),
                "type" => "dropdown"
            ),
            array(
                "type" => "color",
                "heading" => __( "Item Background Color", "js_composer" ),
                "param_name" => "bg_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),


            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);




wpb_map( array(
        "name"      => __( "Testimonial Slideshow", "js_composer" ),
        "base"      => "mk_testimonials",
        "class"     => "mk-testimonial-slider-class",
        "icon"      => "mk-shortcode-icon-testimonial-slider",
        "params"    => array(


            array(
                "type" => "range",
                "heading" => __( "Count", "js_composer" ),
                "param_name" => "count",
                "value" => "-1",
                "min" => "-1",
                "max" => "50",
                "step" => "1",
                "unit" => 'clients',
                "description" => __( "How many Clients you would like to show? (-1 means unlimited)", "js_composer" )
            ),
            array(
                "type" => "multiselect",
                "heading" => __( "Select specific Clients", "js_composer" ),
                "param_name" => "testimonials",
                "value" => '',
                "options" => $testimonials,
                "description" => __( "", "js_composer" )
            ),

            array(
                "heading" => __( "Order", 'theme_frontend' ),
                "description" => __( "Designates the ascending or descending order of the 'orderby' parameter.", 'theme_frontend' ),
                "param_name" => "order",
                "value" => array(
                    __( "ASC (ascending order)", 'theme_frontend' ) => "ASC",
                    __( "DESC (descending order)", 'theme_frontend' ) => "DESC"
                ),
                "type" => "dropdown"
            ),
            array(
                "heading" => __( "Orderby", 'theme_frontend' ),
                "description" => __( "Sort retrieved client items by parameter.", 'theme_frontend' ),
                "param_name" => "orderby",
                "value" => array(
                    __( "No order", 'theme_frontend' )  =>  "none",
                    __( "Order by post id", 'theme_frontend' ) =>  "id",
                    __( "Order by title", 'theme_frontend' ) =>  "title",
                    __( "Order by date", 'theme_frontend' ) => "date",
                ),
                "type" => "dropdown"
            ),


            array(
                "type" => "color",
                "heading" => __( "Skin", "js_composer" ),
                "param_name" => "skin",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "heading" => __( "Animation Effect", 'theme_frontend' ),
                "description" => __( "", 'theme_frontend' ),
                "param_name" => "effect",
                "value" => array(
                    __( "Fade", 'theme_frontend' )  =>  "fade",
                    __( "Slide", 'theme_frontend' ) =>  "slide",
                ),
                "type" => "dropdown"
            ),

            array(
                "type" => "range",
                "heading" => __( "Animation Speed", "js_composer" ),
                "param_name" => "animation_speed",
                "value" => "700",
                "min" => "100",
                "max" => "3000",
                "step" => "1",
                "unit" => 'posts',
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Slideshow Speed", "js_composer" ),
                "param_name" => "slideshow_speed",
                "value" => "7000",
                "min" => "1000",
                "max" => "20000",
                "step" => "1",
                "unit" => 'posts',
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Pause on Hover", "js_composer" ),
                "param_name" => "pause_on_hover",
                "value" => "false",
                "description" => __( "Pause the slideshow when hovering over slider, then resume when no longer hovering", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Smooth Height", "js_composer" ),
                "param_name" => "smooth_height",
                "value" => "true",
                "description" => __( "Allow height of the slider to animate smoothly in horizontal mode", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Direction Nav", "js_composer" ),
                "param_name" => "direction_nav",
                "value" => "true",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);




wpb_map( array(
        "name"      => __( "Sitemap Pages", "js_composer" ),
        "base"      => "mk_sitemap_pages",
        "class"     => "mk-site-map-class",
        "icon"      => "mk-shortcode-icon-site-map",
        "params"    => array(


            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )
        )
    )
);










wpb_map( array(
        "name"      => __( "Sitemap Categories", "js_composer" ),
        "base"      => "mk_sitemap_categories",
        "class"     => "mk-site-map-class",
        "icon"      => "mk-shortcode-icon-site-map",
        "params"    => array(


            array(
                "type" => "range",
                "heading" => __( "How many Categories?", "js_composer" ),
                "param_name" => "number",
                "value" => "-1",
                "min" => "-1",
                "max" => "50",
                "step" => "1",
                "unit" => 'categories',
                "description" => __( "How many Categories you would like to show? (-1 means unlimited)", "js_composer" )
            ),


            array(
                "type" => "range",
                "heading" => __( "Depth", "js_composer" ),
                "param_name" => "depth",
                "value" => "0",
                "min" => "0",
                "max" => "5",
                "step" => "1",
                "unit" => 'step',
                "description" => __( "defines how deep view the childern of a parent element", "js_composer" )
            ),

        )
    )
);














wpb_map( array(
        "name"      => __( "Sitemap Posts", "js_composer" ),
        "base"      => "mk_sitemap_posts",
        "class"     => "mk-site-map-class",
        "icon"      => "mk-shortcode-icon-site-map",
        "params"    => array(


            array(
                "type" => "range",
                "heading" => __( "How many Posts?", "js_composer" ),
                "param_name" => "number",
                "value" => "-1",
                "min" => "-1",
                "max" => "50",
                "step" => "1",
                "unit" => 'posts',
                "description" => __( "How many Posts you would like to show? (-1 means unlimited)", "js_composer" )
            ),

            array(
                "type" => "multiselect",
                "heading" => __( "Select specific Categories", "js_composer" ),
                "param_name" => "cat",
                "options" => $categories,
                "value" => '',
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "multiselect",
                "heading" => __( "Select specific Posts", "js_composer" ),
                "param_name" => "posts",
                "options" => $posts,
                "value" => '',
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "multiselect",
                "heading" => __( "Select specific Authors", "js_composer" ),
                "param_name" => "author",
                "options" => $authors,
                "value" => '',
                "description" => __( "", "js_composer" )
            ),


        )
    )
);





wpb_map( array(
        "name"      => __( "Sitemap Portfolios", "js_composer" ),
        "base"      => "mk_sitemap_portfolios",
        "class"     => "mk-site-map-class",
        "icon"      => "mk-shortcode-icon-site-map",
        "params"    => array(


            array(
                "type" => "range",
                "heading" => __( "How many Posts?", "js_composer" ),
                "param_name" => "number",
                "value" => "-1",
                "min" => "-1",
                "max" => "50",
                "step" => "1",
                "unit" => 'posts',
                "description" => __( "How many Posts you would like to show? (-1 means unlimited)", "js_composer" )
            ),




        )
    )
);









wpb_map( array(
        "name"      => __( "Blog Loop", "js_composer" ),
        "base"      => "mk_blog",
        "class"     => "mk-blog-loop-class",
        "icon"      => "mk-shortcode-icon-blog-loop",
        "controls"  => "edit_popup_delete",
        "params"    => array(

            array(
                "heading" => __( "Style", 'theme_frontend' ),
                "description" => __( "please select which blog loop style you would like to use.", 'theme_frontend' ),
                "param_name" => "style",
                "value" => array(
                    __( "Metro", 'theme_frontend' )  =>  "metro",
                    __( "Classic", 'theme_frontend' ) =>  "classic",
                    __( "Newspaper", 'theme_frontend' ) =>  "newspaper",
                ),
                "type" => "dropdown"
            ),
            array(
                "type" => "range",
                "heading" => __( "How many Columns?", "js_composer" ),
                "param_name" => "column",
                "value" => "3",
                "min" => "1",
                "max" => "4",
                "step" => "1",
                "unit" => 'columns',
                "description" => __( "How many columns you would like to have in one row? please be informed this option only works for classic style.", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "How many Posts?", "js_composer" ),
                "param_name" => "count",
                "value" => "-1",
                "min" => "-1",
                "max" => "50",
                "step" => "1",
                "unit" => 'posts',
                "description" => __( "How many Posts you would like to show? (-1 means unlimited)", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Offset", "js_composer" ),
                "param_name" => "offset",
                "value" => "0",
                "min" => "0",
                "max" => "50",
                "step" => "1",
                "unit" => 'posts',
                "description" => __( "Number of post to displace or pass over, it means based on your order of the loop, this number will define how many posts to pass over and start from the nth number of the offset.", "js_composer" )
            ),
            array(
                "type" => "multiselect",
                "heading" => __( "Select specific Categories", "js_composer" ),
                "param_name" => "cat",
                "options" => $categories,
                "value" => '',
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "multiselect",
                "heading" => __( "Select specific Posts", "js_composer" ),
                "param_name" => "posts",
                "options" => $posts,
                "value" => '',
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "multiselect",
                "heading" => __( "Select specific Authors", "js_composer" ),
                "param_name" => "author",
                "options" => $authors,
                "value" => '',
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "range",
                "heading" => __( "Classic Style Image Height", "js_composer" ),
                "param_name" => "image_height",
                "value" => "300",
                "min" => "100",
                "max" => "1000",
                "step" => "1",
                "unit" => 'posts',
                "description" => __( "Please note that this option only works for classic loop style. ", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Disable Pagination?", "js_composer" ),
                "param_name" => "pagination",
                "value" => "true",
                "description" => __( "If you dont want to have pagination for this loop disable this option.", "js_composer" )
            ),

            array(
                "heading" => __( "Pagination Style", 'theme_frontend' ),
                "description" => __( "please select which pagination style you would like to use on this loop.", 'theme_frontend' ),
                "param_name" => "pagination_style",
                "value" => array(
                    __( "Classic Pagination Navigation", 'theme_frontend' )  =>  "1",
                    __( "Load more button", 'theme_frontend' ) =>  "2",
                    __( "Load more on page scroll", 'theme_frontend' ) =>  "3",
                ),
                "type" => "dropdown"
            ),

            array(
                "heading" => __( "Order", 'theme_frontend' ),
                "description" => __( "Designates the ascending or descending order of the 'orderby' parameter.", 'theme_frontend' ),
                "param_name" => "order",
                "value" => array(
                    __( "ASC (ascending order)", 'theme_frontend' ) => "ASC",
                    __( "DESC (descending order)", 'theme_frontend' ) => "DESC"
                ),
                "type" => "dropdown"
            ),
            array(
                "heading" => __( "Orderby", 'theme_frontend' ),
                "description" => __( "Sort retrieved Blog items by parameter.", 'theme_frontend' ),
                "param_name" => "orderby",
                "value" => array(
                    __( "No order", 'theme_frontend' )  =>  "none",
                    __( "Order by post id", 'theme_frontend' ) =>  "id",
                    __( "Order by title", 'theme_frontend' ) =>  "title",
                    __( "Order by date", 'theme_frontend' ) => "date",
                ),
                "type" => "dropdown"
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);






















wpb_map( array(
        "name"      => __( "Portfolio Loop", "js_composer" ),
        "base"      => "mk_portfolio",
        "class"     => "mk-portfolio-loop-class",
        "icon"      => "mk-shortcode-icon-portfolio-loop",
        "controls"  => "edit_popup_delete",
        "params"    => array(

            array(
                "heading" => __( "Style", 'theme_frontend' ),
                "description" => __( "please select which blog loop style you would like to use.", 'theme_frontend' ),
                "param_name" => "style",
                "value" => array(
                    __( "Metro", 'theme_frontend' )  =>  "metro",
                    __( "Grid", 'theme_frontend' ) =>  "grid",
                    __( "Newspaper", 'theme_frontend' ) =>  "newspaper",
                ),
                "type" => "dropdown"
            ),
            array(
                "type" => "range",
                "heading" => __( "How many Columns?", "js_composer" ),
                "param_name" => "column",
                "value" => "3",
                "min" => "1",
                "max" => "5",
                "step" => "1",
                "unit" => 'columns',
                "description" => __( "How many columns you would like to have in one row? please be informed this option only works for grid and newspaper style.", "js_composer" )
            ),
            array(
                "type" => "toggle",
                "heading" => __( "Disable Excerpt?", "js_composer" ),
                "param_name" => "disable_excerpt",
                "value" => "true",
                "description" => __( "If you dont want excerpt to be viewed in Portfolio newspaper style loop disable this option.", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "How many Posts?", "js_composer" ),
                "param_name" => "count",
                "value" => "-1",
                "min" => "-1",
                "max" => "50",
                "step" => "1",
                "unit" => 'posts',
                "description" => __( "How many Posts you would like to show? (-1 means unlimited)", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Disable Sortable?", "js_composer" ),
                "param_name" => "sortable",
                "value" => "true",
                "description" => __( "If you dont want sortable filter navigation disable this option.", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Disable Metro Layout Grayscal and patterns?", "js_composer" ),
                "param_name" => "metro_grayscale",
                "value" => "true",
                "description" => __( "You can disbale metro style portfolio loop grayscall and pattern which covers the images.", "js_composer" )
            ),

            array(
                "type" => "range",
                "heading" => __( "Offset", "js_composer" ),
                "param_name" => "offset",
                "value" => "0",
                "min" => "0",
                "max" => "50",
                "step" => "1",
                "unit" => 'posts',
                "description" => __( "Number of post to displace or pass over, it means based on your order of the loop, this number will define how many posts to pass over and start from the nth number of the offset.", "js_composer" )
            ),
            array(
                "type" => "multiselect",
                "heading" => __( "Select specific Posts", "js_composer" ),
                "param_name" => "posts",
                "options" => $portfolio_posts,
                "value" => '',
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "multiselect",
                "heading" => __( "Select specific Authors", "js_composer" ),
                "param_name" => "author",
                "options" => $authors,
                "value" => '',
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "range",
                "heading" => __( "Image Height", "js_composer" ),
                "param_name" => "height",
                "value" => "300",
                "min" => "100",
                "max" => "1000",
                "step" => "1",
                "unit" => 'posts',
                "description" => __( "Please note that this option only works for grid style.", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Disable Pagination?", "js_composer" ),
                "param_name" => "pagination",
                "value" => "true",
                "description" => __( "If you dont want to have pagination for this loop disable this option.", "js_composer" )
            ),

            array(
                "heading" => __( "Pagination Style", 'theme_frontend' ),
                "description" => __( "please select which pagination style you would like to use on this loop.", 'theme_frontend' ),
                "param_name" => "pagination_style",
                "value" => array(
                    __( "Classic Pagination Navigation", 'theme_frontend' )  =>  "1",
                    __( "Load more button", 'theme_frontend' ) =>  "2",
                    __( "Load more on page scroll", 'theme_frontend' ) =>  "3",
                ),
                "type" => "dropdown"
            ),

            array(
                "heading" => __( "Order", 'theme_frontend' ),
                "description" => __( "Designates the ascending or descending order of the 'orderby' parameter.", 'theme_frontend' ),
                "param_name" => "order",
                "value" => array(
                    __( "ASC (ascending order)", 'theme_frontend' ) => "ASC",
                    __( "DESC (descending order)", 'theme_frontend' ) => "DESC"
                ),
                "type" => "dropdown"
            ),
            array(
                "heading" => __( "Orderby", 'theme_frontend' ),
                "description" => __( "Sort retrieved Blog items by parameter.", 'theme_frontend' ),
                "param_name" => "orderby",
                "value" => array(
                    __( "No order", 'theme_frontend' )  =>  "none",
                    __( "Order by post id", 'theme_frontend' ) =>  "id",
                    __( "Order by title", 'theme_frontend' ) =>  "title",
                    __( "Order by date", 'theme_frontend' ) => "date",
                ),
                "type" => "dropdown"
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )
        )
    )
);










wpb_map( array(
        "name"      => __( "Image Slideshow", "js_composer" ),
        "base"      => "mk_image_slideshow",
        "class"     => "mk-image-slider-class",
        "icon"      => "mk-shortcode-icon-image-slider",
        "params"    => array(
            array(
                "type" => "attach_images",
                "heading" => __( "Add Images", "js_composer" ),
                "param_name" => "images",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),


            array(
                "type" => "range",
                "heading" => __( "Width", "js_composer" ),
                "param_name" => "image_width",
                "value" => "770",
                "min" => "100",
                "max" => "1140",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Height", "js_composer" ),
                "param_name" => "image_height",
                "value" => "350",
                "min" => "100",
                "max" => "1000",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "", "js_composer" )
            ),

            array(
                "heading" => __( "Animation Effect", 'theme_frontend' ),
                "description" => __( "", 'theme_frontend' ),
                "param_name" => "effect",
                "value" => array(
                    __( "Fade", 'theme_frontend' )  =>  "fade",
                    __( "Slide", 'theme_frontend' ) =>  "slide",
                ),
                "type" => "dropdown"
            ),

            array(
                "type" => "range",
                "heading" => __( "Animation Speed", "js_composer" ),
                "param_name" => "animation_speed",
                "value" => "700",
                "min" => "100",
                "max" => "3000",
                "step" => "1",
                "unit" => 'posts',
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Slideshow Speed", "js_composer" ),
                "param_name" => "slideshow_speed",
                "value" => "7000",
                "min" => "1000",
                "max" => "20000",
                "step" => "1",
                "unit" => 'posts',
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Pause on Hover", "js_composer" ),
                "param_name" => "pause_on_hover",
                "value" => "false",
                "description" => __( "Pause the slideshow when hovering over slider, then resume when no longer hovering", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Smooth Height", "js_composer" ),
                "param_name" => "smooth_height",
                "value" => "true",
                "description" => __( "Allow height of the slider to animate smoothly in horizontal mode", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Direction Nav", "js_composer" ),
                "param_name" => "direction_nav",
                "value" => "true",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);





wpb_map( array(
        "name"      => __( "Flexslider", "js_composer" ),
        "base"      => "mk_flexslider",
        "class"     => "mk-flexslider-class",
        "icon"      => "mk-shortcode-icon-flexslider",
        "params"    => array(
            array(
                "type" => "range",
                "heading" => __( "Count", "js_composer" ),
                "param_name" => "count",
                "value" => "-1",
                "min" => "-1",
                "max" => "50",
                "step" => "1",
                "unit" => 'clients',
                "description" => __( "How many Clients you would like to show? (-1 means unlimited)", "js_composer" )
            ),
            array(
                "type" => "multiselect",
                "heading" => __( "Select specific Clients", "js_composer" ),
                "param_name" => "slides",
                "value" => '',
                "options" => $flexslider,
                "description" => __( "", "js_composer" )
            ),

            array(
                "heading" => __( "Order", 'theme_frontend' ),
                "description" => __( "Designates the ascending or descending order of the 'orderby' parameter.", 'theme_frontend' ),
                "param_name" => "order",
                "value" => array(
                    __( "ASC (ascending order)", 'theme_frontend' ) => "ASC",
                    __( "DESC (descending order)", 'theme_frontend' ) => "DESC"
                ),
                "type" => "dropdown"
            ),
            array(
                "heading" => __( "Orderby", 'theme_frontend' ),
                "description" => __( "Sort retrieved client items by parameter.", 'theme_frontend' ),
                "param_name" => "orderby",
                "value" => array(
                    __( "No order", 'theme_frontend' )  =>  "none",
                    __( "Order by post id", 'theme_frontend' ) =>  "id",
                    __( "Order by title", 'theme_frontend' ) =>  "title",
                    __( "Order by date", 'theme_frontend' ) => "date",
                ),
                "type" => "dropdown"
            ),
            array(
                "type" => "range",
                "heading" => __( "Height", "js_composer" ),
                "param_name" => "image_height",
                "value" => "350",
                "min" => "100",
                "max" => "1000",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "range",
                "heading" => __( "Width", "js_composer" ),
                "param_name" => "image_width",
                "value" => "770",
                "min" => "100",
                "max" => "1140",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "", "js_composer" )
            ),

            array(
                "heading" => __( "Animation Effect", 'theme_frontend' ),
                "description" => __( "", 'theme_frontend' ),
                "param_name" => "effect",
                "value" => array(
                    __( "Fade", 'theme_frontend' )  =>  "fade",
                    __( "Slide", 'theme_frontend' ) =>  "slide",
                ),
                "type" => "dropdown"
            ),

            array(
                "type" => "range",
                "heading" => __( "Animation Speed", "js_composer" ),
                "param_name" => "animation_speed",
                "value" => "700",
                "min" => "100",
                "max" => "3000",
                "step" => "1",
                "unit" => 'posts',
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Slideshow Speed", "js_composer" ),
                "param_name" => "slideshow_speed",
                "value" => "7000",
                "min" => "1000",
                "max" => "20000",
                "step" => "1",
                "unit" => 'posts',
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Pause on Hover", "js_composer" ),
                "param_name" => "pause_on_hover",
                "value" => "false",
                "description" => __( "Pause the slideshow when hovering over slider, then resume when no longer hovering", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Smooth Height", "js_composer" ),
                "param_name" => "smooth_height",
                "value" => "true",
                "description" => __( "Allow height of the slider to animate smoothly in horizontal mode", "js_composer" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Direction Nav", "js_composer" ),
                "param_name" => "direction_nav",
                "value" => "true",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Caption Background Color", "js_composer" ),
                "param_name" => "caption_bg_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Caption Text Color", "js_composer" ),
                "param_name" => "caption_color",
                "value" => "#fff",
                "description" => __( "", "js_composer" )
            ),

            array(
                "type" => "range",
                "heading" => __( "Caption Opacity", "js_composer" ),
                "param_name" => "caption_bg_opacity",
                "value" => "0.6",
                "min" => "0.1",
                "max" => "1",
                "step" => "0.1",
                "unit" => 'alpha',
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
            )

        )
    )
);




wpb_map( array(
        "name"      => __( "Custom CSS", "js_composer" ),
        "base"      => "mk_custom_css",
        "class"     => "mk-custom-css-class",
        "icon"      => "mk-shortcode-icon-custom-css",
        "controls"  => "edit_popup_delete",
        "params"    => array(

            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __( "Your Custom CSS", "js_composer" ),
                "param_name" => "content",
                "value" => "",
                "description" => __( "please insert your styles into this textarea.", "js_composer" )
            ),
        )
    )
);



wpb_map( array(
        "name"      => __( "Custom JS", "js_composer" ),
        "base"      => "mk_custom_js",
        "class"     => "mk-custom-js-class",
        "icon"      => "mk-shortcode-icon-custom-js",
        "controls"  => "edit_popup_delete",
        "params"    => array(

            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __( "Your Custom JS", "js_composer" ),
                "param_name" => "content",
                "value" => "",
                "description" => __( "please insert your Scripts into this textarea.", "js_composer" )
            ),
        )
    )
);



/* Latest tweets
---------------------------------------------------------- */
wpb_map( array(
        "name"      => __( "Twitter Feeds", "js_composer" ),
        "base"      => "vc_twitter",
        "class"     => "mk-twitter-feeds-class",
        "icon"      => "mk-shortcode-icon-twitter-feeds",
        "params"    => array(
            array(
                "type" => "textfield",
                "heading" => __( "Twitter name", "js_composer" ),
                "param_name" => "twitter_name",
                "value" => "",
                "description" => __( "Type in twitter profile name from which load tweets.", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Tweets count", "js_composer" ),
                "param_name" => "tweets_count",
                "value" => "5",
                "min" => "1",
                "max" => "30",
                "step" => "1",
                "unit" => 'tweets',
                "description" => __( "How many recent tweets to load.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
            )
        )
    ) );


/* Latest tweets
---------------------------------------------------------- */
wpb_map( array(
        "name"      => __( "Big Numbers", "js_composer" ),
        "base"      => "mk_big_numbers",
        "class"     => "mk-social-networks-class",
        "icon"      => "mk-shortcode-icon-social-networks",
        "params"    => array(
            array(
                "type" => "dropdown",
                "heading" => __( "Website", "js_composer" ),
                "param_name" => "site",
                "value" => array( __( "Facebook", "js_composer" ) => "facebook", __( "Twitter", "js_composer" ) => "twitter", __( "Dribbble", "js_composer" ) => "dribbble" ),
                "description" => __( "Type in twitter profile name from which load tweets.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Username", "js_composer" ),
                "param_name" => "username",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
            )
        )
    ) );


/* Facebook like button
---------------------------------------------------------- */
wpb_map( array(
        "name"      => __( "Facebook like", "js_composer" ),
        "base"      => "vc_facebook",
        "class"     => "mk-facebook-like-class",
        "icon"      => "mk-shortcode-icon-facebook-like",
        "controls"  => "edit_popup_delete",
        "params"    => array(
            array(
                "type" => "dropdown",
                "heading" => __( "Button type", "js_composer" ),
                "param_name" => "type",
                "value" => array( __( "Standard", "js_composer" ) => "standard", __( "Button count", "js_composer" ) => "button_count", __( "Box count", "js_composer" ) => "box_count" ),
                "description" => __( "Select button type.", "js_composer" )
            )
        )
    ) );

/* Tweetmeme button
---------------------------------------------------------- */
wpb_map( array(
        "name"      => __( "Tweetmeme button", "js_composer" ),
        "base"      => "vc_tweetmeme",
        "class"     => "mk-tweet-me-class",
        "icon"      => "mk-shortcode-icon-tweet-me",
        "controls"  => "edit_popup_delete",
        "params"    => array(
            array(
                "type" => "dropdown",
                "heading" => __( "Button type", "js_composer" ),
                "param_name" => "type",
                "value" => array( __( "Horizontal", "js_composer" ) => "horizontal", __( "Vertical", "js_composer" ) => "vertical", __( "None", "js_composer" ) => "none" ),
                "description" => __( "Select button type.", "js_composer" )
            )
        )
    ) );

/* Google+ button
---------------------------------------------------------- */
wpb_map( array(
        "name"      => __( "Google+ button", "js_composer" ),
        "base"      => "vc_googleplus",
        "class"     => "mk-google-plus-share-class",
        "icon"      => "mk-shortcode-icon-google-plus-share",
        "controls"  => "edit_popup_delete",
        "params"    => array(
            array(
                "type" => "dropdown",
                "heading" => __( "Button size", "js_composer" ),
                "param_name" => "type",
                "value" => array( __( "Standard", "js_composer" ) => "", __( "Small", "js_composer" ) => "small", __( "Medium", "js_composer" ) => "medium", __( "Tall", "js_composer" ) => "tall" ),
                "description" => __( "Select button type.", "js_composer" )
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Annotation", "js_composer" ),
                "param_name" => "annotation",
                "value" => array( __( "Inline", "js_composer" ) => "inline", __( "Bubble", "js_composer" ) => "", __( "None", "js_composer" ) => "none" ),
                "description" => __( "Select annotation type.", "js_composer" )
            )
        )
    ) );

/* Pinterest button
---------------------------------------------------------- */
wpb_map( array(
        "name"      => __( "Pinterest button", "js_composer" ),
        "base"      => "vc_pinterest",
        "class"     => "mk-pinterest-feed-class",
        "icon"      => "mk-shortcode-icon-pinterest-feed",
        "controls"  => "edit_popup_delete",
        "params"    => array(
            array(
                "type" => "dropdown",
                "heading" => __( "Button layout", "js_composer" ),
                "param_name" => "type",
                "value" => array( __( "Horizontal", "js_composer" ) => "", __( "Vertical", "js_composer" ) => "vertical", __( "No count", "js_composer" ) => "none" ),
                "description" => __( "Select button type.", "js_composer" )
            )
        )
    ) );




wpb_map( array(
        "name"      => __( "Full Width Box", "js_composer" ),
        "base"      => "mk_fullwidth_box",
        "class"     => "mk-full-width-class",
        "icon"      => "mk-shortcode-icon-full-width",
        "params"    => array(
            array(
                "type" => "color",
                "heading" => __( "Box Background Color", "js_composer" ),
                "param_name" => "bg_color",
                "value" => "",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Margin Bottom", "js_composer" ),
                "param_name" => "margin_bottom",
                "value" => "10",
                "min" => "0",
                "max" => "200",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
            )
        )
    ) );


wpb_map( array(
        "name"      => __( "Padding Divider", "js_composer" ),
        "base"      => "mk_padding_divider",
        "class"     => "mk-padding-divider-class",
        "icon"      => "mk-shortcode-icon-padding-divider",
        "controls"  => "full",
        "params"    => array(
            array(
                "type" => "range",
                "heading" => __( "Padding Size (Px)", "js_composer" ),
                "param_name" => "size",
                "value" => "40",
                "min" => "10",
                "max" => "500",
                "step" => "1",
                "unit" => 'px',
                "description" => __( "How much space would you like to drop in this specific padding shortcode?", "js_composer" )
            ),
        )
    ) );


/* Video element
---------------------------------------------------------- */
wpb_map( array(
        "name"      => __( "Video player", "js_composer" ),
        "base"      => "vc_video",
        "class"     => "mk-video-player-class",
        "icon"      => "mk-shortcode-icon-video-player",
        "params"    => array(

            array(
                "type" => "textfield",
                "heading" => __( "Video link", "js_composer" ),
                "param_name" => "link",
                "value" => "",
                "description" => __( 'Link to the video. More about supported formats at <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>.', "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Video Width", "js_composer" ),
                "param_name" => "video_width",
                "value" => "700",
                "min" => "1",
                "max" => "1300",
                "step" => "1",
                "unit" => 'px',
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
            )
        )
    ) );

/* Google maps element
---------------------------------------------------------- */
wpb_map( array(
        "name"      => __( "Google maps", "js_composer" ),
        "base"      => "vc_gmaps",
        "class"     => "mk-google-maps-class",
        "icon"      => "mk-shortcode-icon-google-maps",
        "params"    => array(

            array(
                "type" => "textfield",
                "heading" => __( "Google map link", "js_composer" ),
                "param_name" => "link",
                "value" => "",
                "description" => __( 'Link to your map. Visit <a href="http://maps.google.com" target="_blank">Google maps</a> find your address and then click "Link" button to obtain your map link.', "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Map height", "js_composer" ),
                "param_name" => "size",
                "value" => "300",
                "min" => "1",
                "max" => "1000",
                "step" => "1",
                "unit" => 'px',
                "description" => __( 'Enter map height in pixels. Example: 200).', "js_composer" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Map type", "js_composer" ),
                "param_name" => "type",
                "value" => array( __( "Map", "js_composer" ) => "m", __( "Satellite", "js_composer" ) => "k", __( "Map + Terrain", "js_composer" ) => "p" ),
                "description" => __( "Select button alignment.", "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Map Zoom", "js_composer" ),
                "param_name" => "zoom",
                "value" => "14",
                "min" => "1",
                "max" => "20",
                "step" => "1",
                "unit" => 'zoom',

            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
            )
        )
    ) );



wpb_map( array(
        "base"      => "vc_flickr",
        "name"      => __( "Flickr Feeds", "js_composer" ),
        "class"     => "mk-flickr-feeds-class",
        "icon"      => "mk-shortcode-icon-flickr-feeds",
        "params"    => array(

            array(
                "type" => "textfield",
                "heading" => __( "Flickr ID", "js_composer" ),
                "param_name" => "flickr_id",
                "value" => "",
                "description" => __( 'To find your flickID visit <a href="http://idgettr.com/" target="_blank">idGettr</a>', "js_composer" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Number of photos", "js_composer" ),
                "param_name" => "count",
                "value" => "6",
                "min" => "1",
                "max" => "30",
                "step" => "1",
                "unit" => 'photos',
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Thumbnail Size", "js_composer" ),
                "param_name" => "thumb_size",
                "value" => array( __( "Small", "js_composer" ) => "s", __( "Medium", "js_composer" ) => "m", __( "Thumbnail", "js_composer" ) => "t" ),
                "description" => __( "Photo order", "js_composer" )
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Type", "js_composer" ),
                "param_name" => "type",
                "value" => array( __( "User", "js_composer" ) => "user", __( "Group", "js_composer" ) => "group" ),
                "description" => __( "Photo stream type", "js_composer" )
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Display", "js_composer" ),
                "param_name" => "display",
                "value" => array( __( "Latest", "js_composer" ) => "latest", __( "Random", "js_composer" ) => "random" ),
                "description" => __( "Photo order", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
            )
        )
    ) );


wpb_map( array(
        "base"      => "mk_contact_form",
        "name"      => __( "Contact Form", "js_composer" ),
        "class"     => "mk-contact-form-class",
        "icon"      => "mk-shortcode-icon-contact-form",
        "params"    => array(

            array(
                "type" => "textfield",
                "heading" => __( "Email", "js_composer" ),
                "param_name" => "email",
                "value" => "",
                "description" => sprintf( __( 'Which email would you like the contacts to be sent, if left empty emails will be sent to admin email : "%s"', 'js_composer' ), get_bloginfo( 'admin_email' ) ),

            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Skin", "js_composer" ),
                "param_name" => "skin",
                "value" => array( __( "Dark", "js_composer" ) => "dark", __( "Light", "js_composer" ) => "light" ),
                "description" => __( "If the background you are inserting this shortcode is dark choose light, otherwise choose dark.", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Button Text Color", "js_composer" ),
                "param_name" => "btn_txt_color",
                "value" => "#fff",
                "description" => __( "", "js_composer" )
            ),
            array(
                "type" => "color",
                "heading" => __( "Button Background Color", "js_composer" ),
                "param_name" => "btn_bg_color",
                "value" => "",
                "description" => __( "If you leave this option empty theme skin color(that you define in masterkey settings > styling & coloring > General Coloring) will be taken as the value.", "js_composer" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
            )
        )
    ) );




wpb_map( array(
        "base"      => "mk_contact_info",
        "name"      => __( "Contact Info", "js_composer" ),
        "class"     => "mk-contact-info-class",
        "icon"      => "mk-shortcode-icon-contact-info",
        "params"    => array(

            array(
                "type" => "textfield",
                "heading" => __( "Name", "js_composer" ),
                "param_name" => "name",
                "value" => ""
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Phone", "js_composer" ),
                "param_name" => "phone",
                "value" => ""
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Cellphone", "js_composer" ),
                "param_name" => "cellphone",
                "value" => ""
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Email", "js_composer" ),
                "param_name" => "email",
                "value" => ""
            ),
            array(
                "type" => "textfield",
                "heading" => __( "General Address", "js_composer" ),
                "param_name" => "general_address",
                "value" => ""
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Work Address", "js_composer" ),
                "param_name" => "work_address",
                "value" => ""
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Home Address", "js_composer" ),
                "param_name" => "home_address",
                "value" => ""
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Skype", "js_composer" ),
                "param_name" => "skype",
                "value" => ""
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Google Talk", "js_composer" ),
                "param_name" => "gtalk",
                "value" => ""
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Yahoo", "js_composer" ),
                "param_name" => "yahoo",
                "value" => ""
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Instagram", "js_composer" ),
                "param_name" => "instagram",
                "value" => ""
            ),

            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "js_composer" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
            )
        )
    ) );

WPBMap::layout( array( 'id'=>'column_12', 'title'=>'1/2' ) );
WPBMap::layout( array( 'id'=>'column_12-12', 'title'=>'1/2 + 1/2' ) );
WPBMap::layout( array( 'id'=>'column_13', 'title'=>'1/3' ) );
WPBMap::layout( array( 'id'=>'column_13-13-13', 'title'=>'1/3 + 1/3 + 1/3' ) );
WPBMap::layout( array( 'id'=>'column_13-23', 'title'=>'1/3 + 2/3' ) );
WPBMap::layout( array( 'id'=>'column_14', 'title'=>'1/4' ) );
WPBMap::layout( array( 'id'=>'column_14-14-14-14', 'title'=>'1/4 + 1/4 + 1/4 + 1/4' ) );
WPBMap::layout( array( 'id'=>'column_16', 'title'=>'1/6' ) );
WPBMap::layout( array( 'id'=>'column_11', 'title'=>'1/1' ) );
