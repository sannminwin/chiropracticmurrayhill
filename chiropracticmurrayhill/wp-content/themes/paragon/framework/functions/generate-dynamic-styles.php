<?php error_reporting( NULL );
$option = theme_option( THEME_OPTIONS );
$custom_css = theme_option( THEME_OPTIONS, 'custom_css' );

function my_strstr( $haystack, $needle, $before_needle = false ) {
	if ( !$before_needle ) return strstr( $haystack, $needle );
	else return substr( $haystack, 0, strpos( $haystack, $needle ) );
}

/* fontface */
if ( theme_option( THEME_OPTIONS, 'special_fonts_type_1' ) == 'fontface' ) {
	$fontface_1 = theme_option( THEME_OPTIONS, 'special_fonts_list_1' );

	$stylesheet = FONTFACE_DIR.'/fontface_stylesheet.css';
	if ( file_exists( $stylesheet ) ) {
		$file_content = file_get_contents( $stylesheet );
		if ( preg_match( "/@font-face\s*{[^}]*?font-family\s*:\s*('|\")$fontface_1\\1.*?}/is", $file_content, $match ) ) {
			$fontface_style_1 = preg_replace( "/url\s*\(\s*['|\"]\s*/is", "\\0../fontface/", $match[0] )."\n";
		}

		if ( is_array( theme_option( THEME_OPTIONS, 'special_elements_1' ) ) ) {
			$special_elements_1 = implode( ', ', theme_option( THEME_OPTIONS, 'special_elements_1' ) );
		} else {
			$special_elements_1 = theme_option( THEME_OPTIONS, 'special_elements_1' );
		}

		if ( $special_elements_1 && $fontface_1 ) {
			$fontface_css_1 = $special_elements_1 . '{ font-family: "' . $fontface_1.'"}';
		}

	}
}

if ( theme_option( THEME_OPTIONS, 'special_fonts_type_2' ) == 'fontface' ) {
	$fontface_2 = theme_option( THEME_OPTIONS, 'special_fonts_list_2' );

	$stylesheet = FONTFACE_DIR.'/fontface_stylesheet.css';
	if ( file_exists( $stylesheet ) ) {
		$file_content = file_get_contents( $stylesheet );
		if ( preg_match( "/@font-face\s*{[^}]*?font-family\s*:\s*('|\")$fontface_2\\1.*?}/is", $file_content, $match ) ) {
			$fontface_style_2 = preg_replace( "/url\s*\(\s*['|\"]\s*/is", "\\0../fontface/", $match[0] )."\n";
		}

		if ( is_array( theme_option( THEME_OPTIONS, 'special_elements_2' ) ) ) {
			$special_elements_2 = implode( ', ', theme_option( THEME_OPTIONS, 'special_elements_2' ) );
		} else {
			$special_elements_2 = theme_option( THEME_OPTIONS, 'special_elements_2' );
		}

		if ( $special_elements_2 && $fontface_2 ) {
			$fontface_css_2 = $special_elements_2 . '{ font-family: "' . $fontface_2.'"}';
		}
	}
}




/**
 * Safe Fonts
 * */
if ( theme_option( THEME_OPTIONS, 'special_fonts_type_1' ) == 'safe_font' ) {
	$safefont_1 = theme_option( THEME_OPTIONS, 'special_fonts_list_1' );

	if ( is_array( theme_option( THEME_OPTIONS, 'special_elements_1' ) ) ) {
		$special_elements_1 = implode( ', ', theme_option( THEME_OPTIONS, 'special_elements_1' ) );
	} else {
		$special_elements_1 = theme_option( THEME_OPTIONS, 'special_elements_1' );
	}

	if ( $special_elements_1 && $safefont_1 ) {
		$safefont_css_1 = $special_elements_1 . '{ font-family: ' . $safefont_1.'}';
	}

}


if ( theme_option( THEME_OPTIONS, 'special_fonts_type_2' ) == 'safe_font' ) {
	$safefont_2 = theme_option( THEME_OPTIONS, 'special_fonts_list_2' );


	if ( is_array( theme_option( THEME_OPTIONS, 'special_elements_2' ) ) ) {
		$special_elements_2 = implode( ', ', theme_option( THEME_OPTIONS, 'special_elements_2' ) );
	} else {
		$special_elements_2 = theme_option( THEME_OPTIONS, 'special_elements_2' );
	}

	if ( $special_elements_2 && $safefont_2 ) {
		$safefont_css_2 = $special_elements_2 . '{ font-family: ' . $safefont_2.'}';
	}

}







/**
 * Google Fonts
 * */
if ( is_array( theme_option( THEME_OPTIONS, 'special_elements_1' ) ) ) {
	$special_elements_1 = implode( ', ', theme_option( THEME_OPTIONS, 'special_elements_1' ) );
} else {
	$special_elements_1 = theme_option( THEME_OPTIONS, 'special_elements_1' );
}

if ( is_array( theme_option( THEME_OPTIONS, 'special_elements_2' ) ) ) {
	$special_elements_2 = implode( ', ', theme_option( THEME_OPTIONS, 'special_elements_2' ) );
} else {
	$special_elements_2 = theme_option( THEME_OPTIONS, 'special_elements_2' );
}

if ( $special_elements_1 && theme_option( THEME_OPTIONS, 'special_fonts_type_1' ) == 'google' ) {

	$google_font_1 = $special_elements_1  . ' {font-family: ';

	$format_name1 = strpos( theme_option( THEME_OPTIONS, 'special_fonts_list_1' ), ':' );
	if ( $format_name1 !== false ) {
		$google_font_1 .=  my_strstr( str_replace( '+', ' ', theme_option( THEME_OPTIONS, 'special_fonts_list_1' ) ), ':', true );
	} else { $google_font_1 .= str_replace( '+', ' ', theme_option( THEME_OPTIONS, 'special_fonts_list_1' ) );


	}

	$google_font_1 .=' }';

}

if ( $special_elements_2 && theme_option( THEME_OPTIONS, 'special_fonts_type_2' ) == 'google' ) {
	$google_font_2 = $special_elements_2  . ' {font-family: ';

	$format_name2 = strpos( theme_option( THEME_OPTIONS, 'special_fonts_list_2' ), ':' );
	if ( $format_name2 !== false ) {
		$google_font_2 .=  my_strstr( str_replace( '+', ' ', theme_option( THEME_OPTIONS, 'special_fonts_list_2' ) ), ':', true );
	} else { $google_font_2 .= str_replace( '+', ' ', theme_option( THEME_OPTIONS, 'special_fonts_list_2' ) );


	}

	$google_font_2 .=' }';

}

$safe_font = theme_option( THEME_OPTIONS, 'font_family' ) ? 'font-family: ' . stripslashes( theme_option( THEME_OPTIONS, 'font_family' ) ) . ';' : '';




/**
 * Body background
 */
$body_bg  ='background: ' .  mk_color($option['body_color'], $option['body_color_rgba']);
$body_bg .= $option['body_image'] ? ' url(' . $option['body_image'] . ') ' : ' ';
$body_bg .= $option['body_repeat']  . ' ';
$body_bg .= $option['body_position'] . ' ';
$body_bg .= $option['body_attachment'] .' ;';


/**
 * Header background
 */
$header_bg  ='background: ' .  mk_color($option['header_color'], $option['header_color_rgba']);
$header_bg .= $option['header_image'] ? ' url(' . $option['header_image'] . ') ' : ' ';
$header_bg .= $option['header_repeat']  . ' ';
$header_bg .= $option['header_position'] . ' ';
$header_bg .= $option['header_attachment'] .' ;';




/**
 * Introduce Section background
 */
$homepage_slideshow  ='background: ' .  mk_color($option['slideshow_section_bg_color'], $option['slideshow_section_bg_color_rgba']);
if(theme_option( THEME_OPTIONS, 'slideshow_section_bg_image_source' ) == 'preset') {
$homepage_slideshow .=  theme_option( THEME_OPTIONS, 'slideshow_section_bg_preset_image' ) ? ' url(' . theme_option( THEME_OPTIONS, 'slideshow_section_bg_preset_image' ) . ') ' : ' ';
} else if(theme_option( THEME_OPTIONS, 'slideshow_section_bg_image_source' ) == 'custom') {
$homepage_slideshow .=  theme_option( THEME_OPTIONS, 'slideshow_section_bg_custom_image' ) ? ' url(' . theme_option( THEME_OPTIONS, 'slideshow_section_bg_custom_image' ) . ') ' : ' ';	
}
$homepage_slideshow .= $option['slideshow_section_bg_repeat']  . ' ';
$homepage_slideshow .= $option['slideshow_section_bg_position'] . ' ';
$homepage_slideshow .= $option['slideshow_section_bg_attachment'] .' ;';



/**
 * Page background
 */
$page_bg  ='background: ' .  mk_color($option['page_color'], $option['page_color_rgba']);
$page_bg .= $option['page_image'] ? ' url(' . $option['page_image'] . ') ' : ' ';
$page_bg .= $option['page_repeat']  . ' ';
$page_bg .= $option['page_position'] . ' ';
$page_bg .= $option['page_attachment'] .' ;';



/**
 * Footer background
 */
$footer_bg  ='background: ' .  mk_color($option['footer_color'], $option['footer_color_rgba']);
$footer_bg .= $option['footer_image'] ? ' url(' . $option['footer_image'] . ') ' : ' ';
$footer_bg .= $option['footer_repeat']  . ' ';
$footer_bg .= $option['footer_position'] . ' ';
$footer_bg .= $option['footer_attachment'] .' ;';



/**
 * Introduce Section background
 */
$introduce_bg  ='background: ' .  mk_color($option['introduce_bg_color'], $option['introduce_bg_color_rgba']);
if(theme_option( THEME_OPTIONS, 'introduce_bg_image_source' ) == 'preset') {
$introduce_bg .=  theme_option( THEME_OPTIONS, 'introduce_bg_preset_image' ) ? ' url(' . theme_option( THEME_OPTIONS, 'introduce_bg_preset_image' ) . ') ' : ' ';
} else if(theme_option( THEME_OPTIONS, 'introduce_bg_image_source' ) == 'custom') {
$introduce_bg .=  theme_option( THEME_OPTIONS, 'introduce_bg_custom_image' ) ? ' url(' . theme_option( THEME_OPTIONS, 'introduce_bg_custom_image' ) . ') ' : ' ';	
}
$introduce_bg .= $option['introduce_bg_repeat']  . ' ';
$introduce_bg .= $option['introduce_bg_position'] . ' ';
$introduce_bg .= $option['introduce_bg_attachment'] .' ;';



$introduce_title_size = theme_option( THEME_OPTIONS, 'page_introduce_title_size' ) + 13;
$introduce_subtitle_size = theme_option( THEME_OPTIONS, 'page_introduce_subtitle_size' ) + 13;



$h1_color = mk_color($option['h1_color'], $option['h1_color_rgba']);
$h2_color = mk_color($option['h2_color'], $option['h2_color_rgba']);
$h3_color = mk_color($option['h3_color'], $option['h3_color_rgba']);
$h4_color = mk_color($option['h4_color'], $option['h4_color_rgba']);
$h5_color = mk_color($option['h5_color'], $option['h5_color_rgba']);
$h6_color = mk_color($option['h6_color'], $option['h6_color_rgba']);


$sidebar_text_color = mk_color($option['sidebar_text_color'], $option['sidebar_text_color_rgba']);
$sidebar_title_color = mk_color($option['sidebar_title_color'], $option['sidebar_title_color_rgba']);
$sidebar_title_color = mk_color($option['sidebar_title_color'], $option['sidebar_title_color_rgba']);
$sidebar_links_color = mk_color($option['sidebar_links_color'], $option['sidebar_links_color_rgba']);
$sidebar_links_color = mk_color($option['sidebar_links_color'], $option['sidebar_links_color_rgba']);
$footer_text_color = mk_color($option['footer_text_color'], $option['footer_text_color_rgba']);
$footer_title_color = mk_color($option['footer_title_color'], $option['footer_title_color_rgba']);
$footer_title_color = mk_color($option['footer_title_color'], $option['footer_title_color_rgba']);
$footer_links_color = mk_color($option['footer_links_color'], $option['footer_links_color_rgba']);
$footer_links_color = mk_color($option['footer_links_color'], $option['footer_links_color_rgba']);
$sub_footer_bg_color = mk_color($option['sub_footer_bg_color'], $option['sub_footer_bg_color_rgba']);
$page_subtitle_highlight_color = mk_color($option['page_subtitle_highlight_color'], $option['page_subtitle_highlight_color_rgba']);
$page_subtitle_color = mk_color($option['page_subtitle_color'], $option['page_subtitle_color_rgba']);
$page_desc_color = mk_color($option['page_desc_color'], $option['page_desc_color_rgba']);

$main_nav_top_text_color = mk_color($option['main_nav_top_text_color'], $option['main_nav_top_text_color_rgba']);
$main_nav_top_bg_color = mk_color($option['main_nav_top_bg_color'], $option['main_nav_top_bg_color_rgba']);
$main_nav_top_bg_hover_color = mk_color($option['main_nav_top_bg_hover_color'], $option['main_nav_top_bg_hover_color_rgba']);
$main_nav_top_text_hover_color = mk_color($option['main_nav_top_text_hover_color'], $option['main_nav_top_text_hover_color_rgba']);
$main_nav_sub_bg_color = mk_color($option['main_nav_sub_bg_color'], $option['main_nav_sub_bg_color_rgba']);
$main_nav_sub_text_color = mk_color($option['main_nav_sub_text_color'], $option['main_nav_sub_text_color_rgba']);
$main_nav_sub_hover_bg_color = mk_color($option['main_nav_sub_hover_bg_color'], $option['main_nav_sub_hover_bg_color_rgba']);
$main_nav_sub_hover_text_color = mk_color($option['main_nav_sub_hover_text_color'], $option['main_nav_sub_hover_text_color_rgba']);

$blog_single_content_bg_color = mk_color($option['blog_single_content_bg_color'], $option['blog_single_content_bg_color_rgba']);
$blog_single_container_bg_color = mk_color($option['blog_single_container_bg_color'], $option['blog_single_container_bg_color_rgba']);


$skin_color = mk_color($option['skin_color'], $option['skin_color_rgba']);
$body_color = mk_color($option['body_color'], $option['body_color_rgba']);
$page_color = mk_color($option['page_color'], $option['page_color_rgba']);
$footer_slogan_bg = mk_color($option['footer_slogan_bg'], $option['footer_slogan_bg_rgba']);
$footer_slogan_text_color = mk_color($option['footer_slogan_text_color'], $option['footer_slogan_text_color_rgba']);
$homepage_tabbed_box_color = mk_color($option['homepage_tabbed_box_color'], $option['homepage_tabbed_box_color_rgba']);


$a_color = mk_color($option['a_color'], $option['a_color_rgba']);
$p_color = mk_color($option['p_color'], $option['p_color_rgba']);


