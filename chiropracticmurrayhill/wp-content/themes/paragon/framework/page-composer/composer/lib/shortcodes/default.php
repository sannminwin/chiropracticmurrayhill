<?php
/**
 */


function mk_get_fontfamily( $element_name, $id, $font_family, $font_type ) {
    $output = '';
    if ( $font_type == 'google' ) {
        if ( !function_exists( "my_strstr" ) ) {
            function my_strstr( $haystack, $needle, $before_needle = false ) {
                if ( !$before_needle ) return strstr( $haystack, $needle );
                else return substr( $haystack, 0, strpos( $haystack, $needle ) );
            }
        }
       wp_enqueue_style( $font_family, 'http://fonts.googleapis.com/css?family=' .$font_family , false, false, 'all' );
        $format_name = strpos( $font_family, ':' );
        if ( $format_name !== false ) {
            $google_font =  my_strstr( str_replace( '+', ' ', $font_family ), ':', true );
        } else {
            $google_font = str_replace( '+', ' ', $font_family );
        }
        $output .= '<style>'.$element_name.$id.' {font-family: "'.$google_font.'"}</style>';

    } else if ( $font_type == 'fontface' ) {

            $stylesheet = FONTFACE_DIR.'/fontface_stylesheet.css';
            $font_dir = FONTFACE_URI;
            if ( file_exists( $stylesheet ) ) {
                $file_content = file_get_contents( $stylesheet );
                if ( preg_match( "/@font-face\s*{[^}]*?font-family\s*:\s*('|\")$font_family\\1.*?}/is", $file_content, $match ) ) {
                    $fontface_style = preg_replace( "/url\s*\(\s*['|\"]\s*/is", "\\0$font_dir/", $match[0] )."\n";
                }
                $output = "\n<style>" . $fontface_style ."\n";
                $output .= $element_name.$id.' {font-family: "'.$font_family.'"}</style>';
            }

        } else if ( $font_type == 'safefont' ) {
            $output .= '<style>'.$element_name.$id.' {font-family: '.$font_family.' !important}</style>';
        }

    return $output;
}






class WPBakeryShortCode_VC_Column_text extends WPBakeryShortCode {

    public function content( $atts, $content = null ) {

        $el_class = $width = $el_position = '';

        extract( shortcode_atts( array(
                    'el_class' => '',
                    'margin_bottom' => '40',
                    'width' => '1/1',
                    'text_size' => 16,
                    'image_src' => '',
                    'text_color' => '',
                    "font_family" => '',
                    "font_type" => '',
                    'el_position' => '',
                ), $atts ) );

        $output = '';
        $id = mt_rand( 99, 999 );
        $line_height = $text_size + 12;
        $output = '';
        $color_value = !empty( $text_color ) ? 'color: '.$text_color.';' : '';
        $output .= mk_get_fontfamily( "#mk-text-block-", $id, $font_family, $font_type );
        $output .= '<style type="text/css">
                    #mk-text-block-'.$id.', #mk-text-block-'.$id.' p {
                        font-size: '.$text_size.'px;
                        '.$color_value.'
                        line-height:'.$line_height.'px;
                    }
                </style>';
        $margin_style = '';
        if ( $margin_bottom != '' ) {
            $margin_style = ' margin-bottom:'.$margin_bottom.'px;';
        }

        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $output .= "\n\t".'<span id="mk-text-block-'.$id.'"  style="'.$margin_style.'" class="mk-text-block '.$el_class.' '.$el_position_css.' '.$width.'">';
        $output .= "\n\t\t\t".wpb_js_remove_wpautop( $content );
        $output .= "\n\t".'</span> ';

        return $output;
    }
}




class WPBakeryShortCode_mk_social_networks extends WPBakeryShortCode {

    public function content( $atts, $content = null ) {

        $el_class ='';

        extract( shortcode_atts( array(
                    'el_class' => '',
                    'size' => 'medium',
                    'width' => '1/1',
                    'icon_color' => 'rgba(0,0,0,0.3)',
                    'icon_hover_color' => 'rgba(0,0,0,0.6)',
                    'facebook' => "",
                    'twitter' => "",
                    'rss' => "",
                    'dribbble' => "",
                    'digg' => "",
                    'pinterest' => "",
                    'flickr' => "",
                    'google_plus' => "",
                    'linkedin' => "",
                    'blogger' => "",
                    'youtube' => "",
                    'last_fm' => "",
                    'live_journal' => "",
                    'stumble_upon' => "",
                    'tumblr' => "",
                    'vimeo' => "",
                    'wordpress' => "",
                    'yelp' => "",
                    'reddit' => "",
                    'technorati' => ""
                ), $atts ) );
        $id = mt_rand( 99, 999 );

        $output = '';
        $output .= '<div id="social-networks-'.$id.'" class="mk-social-network-shortcode mk-shortcode '.$el_class.'">';
        $output .= '<ul>';
        $output .= !empty( $facebook )  ? '<li><a href="'.$facebook.'"><i class="mk-social-facebook '.$size.'"></i></a></li>' : '';
        $output .= !empty( $twitter )  ? '<li><a href="'.$twitter.'"><i class="mk-social-twitter '.$size.'"></i></a></li>' : '';
        $output .= !empty( $rss )  ? '<li><a href="'.$rss.'"><i class="mk-social-rss '.$size.'"></i></a></li>' : '';
        $output .= !empty( $dribbble )  ? '<li><a href="'.$dribbble.'"><i class="mk-social-dribbble '.$size.'"></i></a></li>' : '';
        $output .= !empty( $digg )  ? '<li><a href="'.$digg.'"><i class="mk-social-digg '.$size.'"></i></a></li>' : '';
        $output .= !empty( $pinterest )  ? '<li><a href="'.$pinterest.'"><i class="mk-social-pinterest '.$size.'"></i></a></li>' : '';
        $output .= !empty( $flickr )  ? '<li><a href="'.$flickr.'"><i class="mk-social-flickr '.$size.'" ></i></a></li>' : '';
        $output .= !empty( $google_plus )  ? '<li><a href="'.$google_plus.'"><i class="mk-social-google-plus '.$size.'"></i></a></li>' : '';
        $output .= !empty( $linkedin )  ? '<li><a href="'.$linkedin.'"><i class="mk-social-linkedin '.$size.'"></i></a></li>' : '';
        $output .= !empty( $blogger )  ? '<li><a href="'.$blogger.'"><i class="mk-social-blogger '.$size.'"></i></a></li>' : '';
        $output .= !empty( $youtube )  ? '<li><a href="'.$youtube.'"><i class="mk-social-youtube '.$size.'"></i></a></li>' : '';
        $output .= !empty( $last_fm )  ? '<li><a href="'.$last_fm.'"><i class="mk-social-last-fm '.$size.'"></i></a></li>' : '';
        $output .= !empty( $live_journal )  ? '<li><a href="'.$live_journal.'"><i class="mk-social-live-journal '.$size.'"></i></a></li>' : '';
        $output .= !empty( $stumble_upon )  ? '<li><a href="'.$stumble_upon.'"><i class="mk-social-stumble-upon '.$size.'"></i></a></li>' : '';
        $output .= !empty( $tumblr )  ? '<li><a href="'.$tumblr.'"><i class="mk-social-tumblr '.$size.'"></i></a></li>' : '';
        $output .= !empty( $vimeo )  ? '<li><a href="'.$vimeo.'"><i class="mk-social-vimeo '.$size.'"></i></a></li>' : '';
        $output .= !empty( $wordpress )  ? '<li><a href="'.$wordpress.'"><i class="mk-social-wordpress '.$size.'" ></i></a></li>' : '';
        $output .= !empty( $yelp )  ? '<li><a href="'.$yelp.'"><i class="mk-social-yelp '.$size.'"></i></a></li>' : '';
        $output .= !empty( $reddit )  ? '<li><a href="'.$reddit.'"><i class="mk-social-reddit '.$size.'"></i></a></li>' : '';
        $output .= !empty( $technorati )  ? '<li><a href="'.$technorati.'"><i class="mk-social-technorati '.$size.'"></i></a></li>' : '';
        $output .= '</ul>';
        $output .= '</div>';

        $css_style = '<style type="text/css">
                    #social-networks-'.$id.' ul li a {background-color: '.$icon_color.';}
                    #social-networks-'.$id.' ul li a:hover {background-color: '.$icon_hover_color.';}
                  </style>';

        return $output . "\n\n\n" . $css_style ;
    }
}



class WPBakeryShortCode_mk_banner_text extends WPBakeryShortCode {

    public function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
                    'image_width' => 1100,
                    'image_height' => 250,
                    'width' => '1/1',
                    'text'=> '',
                    'text_size' => 16,
                    'line_height' => 24,
                    'image_src' => '',
                    'text_color' => '#fff',
                    'text_bg_color' => '#2a4a39',
                    "font_family" => '',
                    "font_type" => '',
                    'position' => '220',
                    'el_class' => '',
                    'el_position' => ''
                ), $atts ) );
        $id = mt_rand( 99, 999 );
        $output = '';
        $output .= mk_get_fontfamily( "#mk-banner-text-", $id, $font_family, $font_type );
        $caption_bg_color = !empty( $caption_bg_color ) ? $caption_bg_color : "#00c360";

        $crop_images = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
        $retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;
        $image_src  = theme_image_resize( $image_src, $image_width, $image_height, $crop_images, $retina_images );

        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $output .= '<div class="'.$width.' '.$el_position_css.'">';
        $output .= '<div class="mk-banner-text-shortcode mk-shortcode '.$el_class.'" style="max-width: '.$image_width.'px">';
        $output .= '<img alt="'.$text.'" title="'.$text.'" src="'.$image_src['url'].'" />';
        $output .= '<div id="mk-banner-text-'.$id.'" class="mk-banner-text-caption" style="left:'.$position.'px;background-color:'.$text_bg_color.'; "><span style="color:'.$text_color.';font-size:'.$text_size.'px; line-height: '.$line_height.'px">'.strip_tags( $text ).'</span></div>';
        $output .= '</div></div>';

        return $output;
    }
}



class WPBakeryShortCode_mk_lifetime_icons extends WPBakeryShortCode {

    public function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
                    'size' => 'medium',
                    'icon' => 'arrow',
                    'color' => 'green',
                    'padding' => 4,
                    'custom_color' => '',
                    'el_class' => '',
                ), $atts ) );

        $custom_color = !empty($custom_color) ? ('color:' . $custom_color .';') : '';

        $output = '<span class="mk-lifetime-icons mk-shortcode '.$el_class.'">';
        $output .= '<i style="'.$custom_color.'padding:'.$padding.'px" class="mk-icon-'.$icon.' mk-color-'.$color.' mk-size-'.$size.'"></i>';
        $output .= '</span>';

        return $output;
    }
}




class WPBakeryShortCode_mk_blockquote extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'el_class' => '',
                    "style" => 'style1', //style1, style2
                    'skin' => 'green',
                    'width' => '1/1',
                    'el_position' => '',
                    'text_color' => '#fff',
                    "text_size" => '20',
                    "align" => 'left',
                    "font_family" => '',
                    "font_type" => '',
                ), $atts ) );
        $id = mt_rand( 99, 999 );
        $output = '';
        $output .= mk_get_fontfamily( "#blockquote-", $id, $font_family, $font_type );
        $css_style = '<style type="text/css">
                    #blockquote-'.$id.'  {
                        font-size: '.$text_size.'px;
                        color: '.$text_color.';
                    }

                    #blockquote-'.$id.'.style2:before, #blockquote-'.$id.'.style2:after  {
                        background-image: url('.THEME_IMAGES.'/blockquote/'.$skin.'.png);
                        background-position: center bottom;
                        background-repeat: no-repeat;
                    }
                    #blockquote-'.$id.'.style2:after  {
                        background-position: center top;
                    }

                </style>';
        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $output .= '<div class="'.$width.' '.$el_position_css.'">';
        $output .= '<div id="blockquote-'.$id.'" class="mk-shortcode mk-blockquote '.$skin.' '.$style.' '.$el_class.'">' .wpb_js_remove_wpautop(strip_tags($content) ). '</div></div>';

        return $output . "\n\n\n\n" . $css_style;
    }
}


/*
DROP CAPS SHORTCODE
*/
class WPBakeryShortCode_mk_dropcaps extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'bg_color' => '',
                    'text_color' => '',
                    'text_size' => '16',
                    'el_class' => '',
                ), $atts ) );


        $bg_color = !empty( $bg_color ) ? $bg_color : theme_option( THEME_OPTIONS, 'skin_color' );
        $text_color = !empty( $text_color ) ? $text_color : "#fff";

        return '<span style="background-color:'.$bg_color.';color:'.$text_color.'; font-size:'.$text_size.'px;height:'.$text_size.'px;" class="mk-dropcaps mk-shortcode '.$el_class.'">'.wpb_js_remove_wpautop(strip_tags($content) ).'</span>';
    }
}
/*****************************************************/





/*
HIGHLIGHT SHORTCODE
*/
class WPBakeryShortCode_mk_highlight extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'bg_color' => '',
                    'text_color' => '',
                    'el_class' => '',
                ), $atts ) );


        $bg_color = !empty( $bg_color ) ? $bg_color : theme_option( THEME_OPTIONS, 'skin_color' );
        $text_color = !empty( $text_color ) ? $text_color : "#fff";

        return '<span style="background-color:'.$bg_color.';color:'.$text_color.'" class="mk-highlight mk-shortcode '.$el_class.'">'.wpb_js_remove_wpautop(strip_tags($content) ).'</span>';

    }
}
/*****************************************************/




/*
SKILL METER SHORTCODE
*/
class WPBakeryShortCode_mk_skill_meter extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'title' => '',
                    'color' => '',
                    'width' => '1/1',
                    'el_position' => '',
                    'percent' => 50,
                    'el_class' => '',
                ), $atts ) );


        $color = !empty( $color ) ? $color : theme_option( THEME_OPTIONS, 'skin_color' );
        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }

        return '<div class="'.$width.' '.$el_position_css.'"><div class="mk-skill-meter mk-shortcode '.$el_class.'">
                    <div class="mk-skill-meter-title">'.$title.'</div>
                    <div class="mk-progress-bar"><span style="background-color:'.$color.';width:'.$percent.'%"></span></div>
                    </div></div>';

    }
}
/*****************************************************/





/*
LIST ICON SHORTCODE
*/
class WPBakeryShortCode_mk_custom_list extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'el_class' => '',
                    'width' => '1/1',
                    'el_position' => '',
                    'style' => 'style1',
                    'color'=> 'color1'
                ), $atts ) );

        $id = mt_rand( 99, 999 );
        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $output = '';
        $output .= '<div class="'.$width.' '.$el_position_css.'">';
        $output .= '<div id="list-style-'.$id.'" class="mk-list-styles mk-shortcode '.$el_class.'">';

        $output .= wpb_js_remove_wpautop(strip_tags($content, '<ul><li><strong><i><u><b><a><small>') );
        $output .= '</div></div>';
        $output .= '<style type="text/css">
                    #list-style-'.$id.' ul li {
                    background-image: url('.THEME_IMAGES.'/list-styles/'.$color.'/'.$style.'.png);
                    }
                </style>';

        return $output;

    }
}

/*****************************************************/











/*
MESSAGE BOXES SHORTCODE
*/
class WPBakeryShortCode_mk_message_box extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'el_class' => '',
                    'width' => '1/1',
                    'el_position' => '',
                    'type' => 'confirm',
                    'style' => 'pattern', // pattern, solid
                    'bg_color'=> '#39ce82',
                    'txt_color' => '#fff',
                    'text_size' => '18',
                    "font_family" => '',
                    "font_type" => '',
                ), $atts ) );
        $id = mt_rand( 99, 999 );


        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }

        $output = '';
        $output .= mk_get_fontfamily( "#message-box-", $id, $font_family, $font_type );
        $width = wpb_translateColumnWidthToSpan( $width );

        $output .= '<div class="'.$width.' '.$el_position_css.'">';
        $output .= '<div id="message-box-'.$id.'" class="mk-message-box mk-shortcode '.$el_class.'" style="background-color:'.$bg_color.'">';
        $output .= '<span>'.wpb_js_remove_wpautop(strip_tags($content) ).'</span>';
        $output .= '<div class="clearboth"></div></div></div>';
        $output .= '<style type="text/css">
                    #message-box-'.$id.' {
                    background-image: url('.THEME_IMAGES.'/message-boxes/'.$type.'-'.$style.'.png);
                    font-size:'.$text_size.'px;
                    color: '.$txt_color.';
                    }
                </style>';

        return $output;

    }
}
/*****************************************************/














/*
DIVIDER SHORTCODE
*/
class WPBakeryShortCode_mk_divider extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'el_class' => '',
                    'el_position' => '',
                    'width' => '1/1',
                    'color' => '',
                    'style' => 'single',

                ), $atts ) );
        $border_color_css = '';
        if ( $style != 'pattern' ) {
            if ( $style != 'dotted' ) {
                $border_color_css = !empty( $color ) ? ' style="background-color:'.$color.'" ' : '';
            } else {
                $border_color_css = !empty( $color ) ? ' style="border-color:'.$color.'" ' : '';
            }
        }
        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        return '<div class="'.$width.' '.$el_position_css.'"><div '.$border_color_css.'class="mk-divider mk-shortcode '.$style.'-line '.$el_class.'"></div><div class="clearboth"></div></div>';

    }
}
/*****************************************************/













/*
FANCY DIVIDER SHORTCODE
*/
class WPBakeryShortCode_mk_fancy_divider extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'el_class' => '',
                    'width' => '1/1',
                    'el_position' => '',
                    'style' => 'solid', // solid color, pattern
                    'size' => 'medium',
                    'title_bg' => '#7a7975',
                    'divider_text' => 'Fancy Divider',
                    "font_family" => '',
                    "font_type" => '',
                ), $atts ) );
        $id = mt_rand( 99, 999 );
        $output = '';
        $output .= mk_get_fontfamily( "#mk-fancy-divider-", $id, $font_family, $font_type );

        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $output .= '<div class="'.$width.' '.$el_position_css.'">';

        $output .= '<div id="mk-fancy-divider-'.$id.'" class="mk-fancy-divider mk-shortcode '.$style.' '.$size.' '.$el_class.'">
                <div class="line"></div>
                <div class="extra-space"><div class="text" style="background-color:'.$title_bg.'">'.$divider_text.'</div></div>
            </div>
            <div class="clearboth"></div>
            </div>
            ';
        return $output;

    }
}
/*****************************************************/













/*
BUTTON SHORTCODE
*/
class WPBakeryShortCode_mk_button extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'el_class' => '',
                    'width' => '1/1',
                    'el_position' => '',
                    'id' => '',
                    'size' => 'medium',
                    'skin' => 'gray',
                    'text_color' => '',
                    'bg_color' => '',
                    'text_color' => '',
                    "url" => '#',
                    "target" => '',
                    "align" => '',
                ), $atts ) );
        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $style = ( !empty( $bg_color ) ? ( 'background-color:' . $bg_color . ';' ) : '' ) . ( !empty( $text_color ) ? ( 'color:' . $text_color . ';' ) : '' );
        $style_output = !empty( $style ) ? ( 'style="'.$style.'"' ) : '';
        $id = !empty( $id ) ? ( 'id="'.$id.'"' ) : '';
        $target = !empty( $target ) ? ( 'target="'.$target.'"' ) : '';

        $button = '<a href="'.$url.'" '.$target.' '.$id.' '.$style_output.' class="mk-button mk-shortcode '.$size.' '.$skin.' '.$el_class.'">'.wpb_js_remove_wpautop(strip_tags($content) ).'</a>';
        $output = ( !empty( $align ) ? '<div class="mk-button-align '.$align.'">' : '' ) . $button . ( !empty( $align ) ? '</div>' : '' );
        $grid_start = '<div class="'.$width.' '.$el_position_css.'">';
        $grid_end = '</div>';
        return $grid_start . $output .  $grid_end;

    }
}

/*****************************************************/















/*
BOX SHORTCODE
*/
class WPBakeryShortCode_mk_content_box extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'el_class' => '',
                    'width' => '1/1',
                    'el_position' => '',
                    'bg_color' => '',
                    'text_color' => '#fff',
                    "text_size" => 24,
                    "font_family" => '',
                    'align' => 'left',
                    "font_type" => '',
                ), $atts ) );
        $id = mt_rand( 99, 999 );
        $output = '';
        $output .= mk_get_fontfamily( "#mk-content-box-", $id, $font_family, $font_type );

        if ( $text_size <= 18 ) {
            $padding_css = 'padding:15px;';
        } else {
            $padding_css = 'padding:25px 35px;';
        }
        $width = wpb_translateColumnWidthToSpan( $width );
        $bg_color = !empty( $bg_color ) ? $bg_color : theme_option( THEME_OPTIONS, 'skin_color' );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $output .= '<div class="'.$width.' '.$el_position_css.'">';
        $output .= '<div id="mk-content-box-'.$id.'" class="mk-shortcode mk-content-box" style="text-align:'.$align.';background-color:'.$bg_color.'; color: '.$text_color.'; font-size:'.$text_size.'px; '.$padding_css.'">' .wpb_js_remove_wpautop(strip_tags($content, '<div><span><ul><li><a><strong><i><u>') ). '</div></div>';

        return $output;
    }
}
/*****************************************************/






/*
FANCY TEXT SHORTCODE
*/
class WPBakeryShortCode_mk_fancy_text extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'el_class' => '',
                    'el_position' => '',
                    'width' => '1/1',
                    'highlight_color' => '#816328',
                    'text_color' => '#fff',
                    "text_size" => '40',
                    'font_weight' => 'normal',
                    'line_height' => '50',
                    "align" => 'left',
                    "font_family" => '',
                    "font_type" => '',
                ), $atts ) );
        $id = mt_rand( 99, 999 );
        $output = '';
        $output .= mk_get_fontfamily( "#fancy-text-", $id, $font_family, $font_type );
        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';

        $style = '<style type="text/css">
                    #fancy-text-'.$id.' {
                        text-align:'.$align.';
                        display:block;
                    }
                    #fancy-text-'.$id.' span {
                        background-color: '.$highlight_color.';
                        color: '.$text_color.';
                        font-size: '.$text_size.'px;
                        line-height:'.$line_height.'px;
                        font-weight: '.$font_weight.';
                        box-shadow: 15px 0 0 '.$highlight_color.', -15px 0 0 '.$highlight_color.';
                    }
                </style>';


        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $output .= '<div class="'.$width.' '.$el_position_css.'">';
        $output .= '<div id="fancy-text-'.$id.'" class="mk-shortcode mk-fancy-text '.$el_class.'"><span>' .wpb_js_remove_wpautop(strip_tags($content) ). '</span><div class="clearboth"></div></div></div>';

        return $output . "\n\n\n\n" . $style;
    }
}
/*****************************************************/











class WPBakeryShortCode_mk_toggle extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'title' => false,
                    'width' => '1/1',
                    'el_position' => '',
                    "container_bg_color" => '#faf9f5',
                    "container_txt_color" => '',
                    "el_class" => '',
                ), $atts ) );

        $id = mt_rand( 99, 999 );
        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        return '<div class="'.$width.' '.$el_position_css.'"><div id="mk-toggle-'.$id.'" class="mk-toggle mk-shortcode '.$el_class.'"><span class="mk-toggle-title">' . $title . '</span><div class="mk-toggle-pane"><div class="inner-box">' . wpb_js_remove_wpautop(strip_tags($content) ) . '</div></div></div></div>
    <style type="text/css">
                #mk-toggle-'.$id.' .mk-toggle-pane .inner-box{
                    background-color: '.$container_bg_color.';
                    '.( !empty( $container_txt_color ) ? 'color: '.$container_txt_color.'; ' : '' ) .'
                }
    </style>';
    }
}
/*****************************************************/







/*
FANCY TITLE SHORTCODE
*/
class WPBakeryShortCode_mk_fancy_title extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'el_class' => '',
                    'width' => '1/1',
                    'el_position' => '',
                    'color' => '#3d3d3d',
                    'style' => 'simple',
                    "size" => '30',
                    'margin_bottom' => '40',
                    "align" => 'left',
                    "font_family" => '',
                    'tag_name' => 'h2',
                    "font_type" => '',
                ), $atts ) );
        $id = mt_rand( 99, 999 );
        $output = '';
        $divider_css = '';
        if ( $style == 'divider' ) {
            $divider_css = 'border-bottom:2px solid '.$color.';';
        }
        $output .= mk_get_fontfamily( "#fancy-title-", $id, $font_family, $font_type );
        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $output .= '<div class="'.$width.' '.$el_position_css.'">';
        $output .= '<'.$tag_name.' style="font-size: '.$size.'px;text-align:'.$align.';color: '.$color.';margin-bottom:'.$margin_bottom.'px; '.$divider_css.'" id="fancy-title-'.$id.'" class="mk-shortcode mk-fancy-title '.$style.'-title-style '.$el_class.'">' .wpb_js_remove_wpautop(strip_tags($content) ). '</'.$tag_name.'><div class="clearboth"></div></div>';

        return $output;
    }
}
/*****************************************************/









/*
IMAGE SHORTCODE
*/
class WPBakeryShortCode_mk_image extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'image_width' => 770,
                    'image_height' => 350,
                    'lightbox' => 'true',
                    'group' => '',
                    'width' => '1/1',
                    'el_position' => '',
                    "crop" => 'true',
                    'src' => '',
                    'link' => '',
                    'caption'=> '',
                    'caption_color' => '#fff',
                    'caption_bg_color' => '',
                    'caption_bg_opacity' => '0.6',
                    'el_class' => '',
                ), $atts ) );


        $caption_bg_color = !empty( $caption_bg_color ) ? $caption_bg_color : "#00c360";

        $crop_images = $crop === 'true'? true: false;
        $retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;
        $image_src  = theme_image_resize( $src, $image_width, $image_height, $crop_images, $retina_images );
        $width = wpb_translateColumnWidthToSpan( $width );

        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $output = '<div class="'.$width.' '.$el_position_css.'">';
        $output .= '<div class="mk-image-shortcode mk-shortcode '.$el_class.'" style="max-width: '.$image_width.'px">';
        $output .= '<img alt="'.$caption.'" title="'.$caption.'" src="'.$image_src['url'].'" />';
        if($lightbox == 'true') {
            $output .= '<div class="mk-image-overlay"></div>';
            $output .= '<a href="'.$src.'" rel="'.$group.'" alt="'.$caption.'" title="'.$caption.'" class="mk-lightbox mk-image-shortcode-lightbox"></a>';
            
        } 
        if ( $link ) {
            $output .= '<a href="'.$link.'" class="mk-image-shortcode-link"></a>';
        } 
        if ( $caption ) {
            $output .= '<div class="mk-image-caption">
                    <div style="background-color:'.$caption_bg_color.'; -webkit-opacity: '.$caption_bg_opacity.';-moz-opacity: '.$caption_bg_opacity.';-o-opacity: '.$caption_bg_opacity.';filter: alpha(opacity='.( $caption_bg_opacity * 100 ).');opacity: '.$caption_bg_opacity.';" class="color-mask"></div>
                    <span style="color:'.$caption_color.'">'.$caption.'</span>
                </div>';
        }
        $output .= '<div class="clearboth"></div></div></div>';


            return $output;
   

    }
}
/*****************************************************/











/*
PRICING TABLE SHORTCODE
*/
class WPBakeryShortCode_mk_pricing_table extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'width' => '1/1',
                    'offers_title' => 'Offers',
                    'offers' => '',
                    'table_number' => 4,
                    'tables' => '',
                    'orderby'=> 'date',
                    'order'=> 'DESC',
                    'skin' => 'light', // dark, light
                    'el_class' =>'',
                    'el_position' => '',
                ), $atts ) );


        $query = array(
            'post_type'=>'pricing',
            'showposts' => $table_number,
        );

        if ( $tables ) {
            $query['post__in'] = explode( ',', $tables );
        }
        if ( $orderby ) {
            $query['orderby'] = $orderby;
        }
        if ( $order ) {
            $query['order'] = $order;
        }


        if ( $table_number == 4 ) {
            $table_css = 'four-table';
        } else if ( $table_number == 3 ) {
                $table_css = 'three-table';
            } else if ( $table_number == 2 ) {
                $table_css = 'two-table';
            } else if ( $table_number == 1 ) {
                $table_css = 'one-table';
            }
        $width = wpb_translateColumnWidthToSpan( $width );

        $r = new WP_Query( $query );
        global $post;
        $pricing_offer_css = '';
        if(empty($offers)) {
            $pricing_offer_css = 'no-pricing-offer';
        }    
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $output = '<div class="'.$width.' '.$el_position_css.'">';
        $output .= '<div class="mk-shortcode mk-pricing-table '.$skin.' '.$el_class.' '.$pricing_offer_css.'">';
        if(!empty($offers)) {
        $output .= '<div class="mk-pricing-offer-grid">';
        $output .= '<div class="mk-offer-title"><span>'.$offers_title.'</span></div>';
        $output .= '<div class="mk-offers">'.strip_tags($offers, '<ul><li><strong><i><u><b><a><small>').'</div>';
        $output .= '</div>';
        }
        $output .= '<ul class="mk-pricing-cols">';
        while ( $r->have_posts() ) : $r->the_post();

        $output .= '<li class="mk-pricing-col '.$table_css.'">';
        $output .='<div class="mk-pricing-plan">'.get_post_meta( $post->ID, '_plan', true ).'</div>';
        $output .='<div class="mk-pricing-price"><span>'.get_post_meta( $post->ID, '_price', true ).'</span></div>';
        $output .='<div class="mk-pricing-features">'.get_post_meta( $post->ID, '_features', true ).'</div>';
        $output .='<div class="mk-pricing-button">
                        <a href="'.get_post_meta( $post->ID, '_btn_url', true ).'" class="mk-button medium">'.get_post_meta( $post->ID, '_btn_text', true ).'</a>
                  </div>';
        $output .='</li>';

        endwhile;
        $output .= '</ul></div></div>';

        wp_reset_postdata();
        return $output;
    }
}
/*****************************************************/













/*
Employees SHORTCODE
*/
class WPBakeryShortCode_mk_employees extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'width' => '1/1',
                    'el_position' => '',
                    'style' => 'classic',
                    'count'=> -1,
                    'employees' => '',
                    'info_bg_color' => 'rgba(0,0,0,0.4)',
                    'info_txt_color' => '#fff',
                    'arrow_skin' => 'dark',
                    'el_class' => '',
                    'orderby'=> 'date',
                    'order'=> 'DESC',
                ), $atts ) );

        wp_enqueue_script( 'jquery-flexslider' );
        $width = wpb_translateColumnWidthToSpan( $width );
        $id = mt_rand( 99, 9999 );
        $output = '';
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $output .= '<div class="'.$width.' '.$el_position_css.'">';
        if ( $style == 'modern' ) {
            $image_width = 165;
            $image_height = 165;
            $output .= '<div id="team_member_'.$id.'" class="mk-employees-shortcode-modern mk-'.$arrow_skin.'-arrow mk-flexslider mk-shortcode '.$el_class.'"><ul class="mk-flex-slides">';
        } else {
            $image_width = 255;
            $image_height = 255;
            $output .= '<div class="mk-employees-shortcode-classic mk-shortcode '.$el_class.'"><ul>';
        }

        $query = array(
            'post_type' => 'employees',
            'showposts' => $count,
        );

        if ( $employees ) {
            $query['post__in'] = explode( ',', $employees );
        }
        if ( $orderby ) {
            $query['orderby'] = $orderby;
        }
        if ( $order ) {
            $query['order'] = $order;
        }

        $loop = new WP_Query( $query );

        if(is_single()){ 
            global $post;
            $page_layout = get_post_meta( $post->ID, '_layout', true );
        } else {
            $page_layout = 'full';
        }
        $i = 0;
        while ( $loop->have_posts() ):
            $loop->the_post();
        $i++;

        $facebook = get_post_meta( get_the_ID(), '_facebook', true );
        $linkedin = get_post_meta( get_the_ID(), '_linkedin', true );
        $twitter = get_post_meta( get_the_ID(), '_twitter', true );
        $image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
        if ( $style == 'modern' ) {
            $image_src  = theme_image_resize( $image_src_array[ 0 ], $image_width, $image_height, true, false );
        } else {
            $image_src  = theme_image_resize( $image_src_array[ 0 ], $image_width, $image_height, true, false );
        }
        $output .= '<li class="mk-employee-slides">';
        $output .= '<div class="team-thumbnail"><img width="'.$image_width.'" height="'.$image_height.'" alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" /></div>';
        $output .= '<div class="team-info-wrapper">';
        $output .= '<span class="team-member-name">'.get_the_title().'</span>';
        $output .= '<span class="team-member-position">'.get_post_meta( get_the_ID(), '_position', true ).'</span>';
        $output .= '<ul class="mk-employeee-networks">';
        if ( !empty( $facebook ) ) {
            $output .= '<li><a href="'.$facebook.'" alt="Follow '.get_the_title().' in Facebook" title="Follow '.get_the_title().' in Facebook"><i class="mk-social-facebook"></i></a></li>';
        }
        if ( !empty( $twitter ) ) {
            $output .= '<li><a href="'.$twitter.'"  alt="Follow '.get_the_title().' in Twitter" title="Follow '.get_the_title().' in Twitter"><i class="mk-social-twitter"></i></a></li>';
        }
        if ( !empty( $linkedin ) ) {
            $output .= '<li><a href="'.$linkedin.'" alt="Follow '.get_the_title().' in Linked In" title="Follow '.get_the_title().' in Linked In" ><i class="mk-social-linkedin"></i></a></li>';
        }
        $output .= '</ul>';
        $output .= '<span class="team-member-desc">'.get_post_meta( get_the_ID(), '_desc', true ).'</span>';
        $output .= '</div>';
        $output .= '</li>';

        if ( $i%4 == 0 && $style == 'classic' ) {
            $output .= '<div class="clearboth"></div>';
        }
        endwhile;
        wp_reset_query();

        $output .= '</ul></div><div class="clearboth"></div></div>';
        if ( $style == 'modern' ) {
            $output .= '<script type="text/javascript">

        jQuery(document).ready(function() {
            jQuery(window).on("load",function () {
                mk_page_layout = "'.$page_layout.'-layout";
                mk_slides_count = jQuery("#team_member_'.$id.' li").size();
                if(mk_page_layout == "full-layout") {
                    if(mk_slides_count < 8) {
                    sliding_var_'.$id.' = false;
                     } else {
                    sliding_var_'.$id.' = true;
                    }
                } else {
                    if(mk_slides_count < 5) {
                    sliding_var_'.$id.' = false;
                     } else {
                    sliding_var_'.$id.' = true;
                    }
                }

                jQuery("#team_member_'.$id.'").flexslider({
                    selector: ".mk-flex-slides > li",
                   slideshow: sliding_var_'.$id.',
                    animation: "slide",              //String: Select your animation type, "fade" or "slide"
                    smoothHeight: true,            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
                    slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
                    animationSpeed: 400,            //Integer: Set the speed of animations, in milliseconds
                    pauseOnHover: true,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
                    controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
                    directionNav:sliding_var_'.$id.',
                    prevText: "",           //String: Set the text for the "previous" directionNav item
                    nextText: "",               //String: Set the text for the "next" directionNav item
                    itemWidth: 160,
                    itemMargin: 0,
                    maxItems: 7,
                    minItems: 2,
                    move: 2
                    
                });
            });
        });
        </script>

        <style type="text/css">
                #team_member_'.$id.' .team-info-wrapper {
                        background-color:'.$info_bg_color.';
                        color:'.$info_txt_color.';
                }
        </style>

        ';
        }

        return $output;
    }

}
/*****************************************************/









/*
CLIENTS SHORTCODE
*/
class WPBakeryShortCode_mk_clients extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'width' => '1/1',
                    'el_position' => '',
                    'count'=> 10,
                    'slide' => 'flase',
                    'bg_color' => 'rgba(0,0,0,0.2)',
                    'orderby'=> 'date',
                    'clients' => '',
                    'arrow_skin' => 'dark',
                    'order'=> 'DESC',
                    'el_class' => '',
                ), $atts ) );



        $query = array(
            'post_type' => 'clients',
            'showposts' => $count,
        );

        if ( $clients ) {
            $query['post__in'] = explode( ',', $clients );
        }
        if ( $orderby ) {
            $query['orderby'] = $orderby;
        }
        if ( $order ) {
            $query['order'] = $order;
        }

        $loop = new WP_Query( $query );
        $width = wpb_translateColumnWidthToSpan( $width );


        $id = mt_rand( 99, 999 );
        $output = '';
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $output .= '<div class="'.$width.' '.$el_position_css.'">';
        if ( $slide == 'true' ) {
            wp_enqueue_script( 'jquery-flexslider' );
            $output .= '<div id="clients-shortcode-'.$id.'" class="mk-clients-shortcode mk-'.$arrow_skin.'-arrow mk-flexslider mk-shortcode '.$el_class.'"><ul class="mk-flex-slides">';
        } else {
            $output .= '<div class="mk-clients-shortcode mk-shortcode clients-grid-style '.$el_class.'"><ul>';
        }
        while ( $loop->have_posts() ):
            $loop->the_post();
        $url = get_post_meta( get_the_ID(), '_url', true );
        $image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );

        $output .= '<li>';
        $output .= '<div style="background-color:'.$bg_color.'" class="clients-overlay"></div>';
        $output .= '<span class="client-info-icon"></span>';
        $output .= !empty( $url ) ? '<a href="'.$url.'">' : '';
        $output .= '<div title="'.get_the_title().'" class="client-logo" style="background:url('.get_image_src( $image_src_array[0] ).') center center no-repeat;"></div>';
        $output .= !empty( $url ) ? '</a>' : '';
        $output .= '<div class="client-info-wrapper">';
        $output .= '<span class="client-title">'.get_the_title().'</span>';
        $output .= '<span class="client-desc">'.get_post_meta( get_the_ID(), '_desc', true ).'</span>';
        $output .= '<span class="client-return-icon"></span>';
        $output .= '</div>';
        $output .= '</li>';

        endwhile;
        wp_reset_query();

        $output .= '</ul></div></div>';

        if ( $slide == 'true' ) {
            $output .= '<script type="text/javascript">

        jQuery(document).ready(function() {
            jQuery(window).on("load",function () {
                jQuery("#clients-shortcode-'.$id.'").flexslider({
                    selector: ".mk-flex-slides > li",
                    animationLoop: true,
                    animation: "slide",              //String: Select your animation type, "fade" or "slide"
                    smoothHeight: false,            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
                    slideshowSpeed: 4000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
                    animationSpeed: 400,            //Integer: Set the speed of animations, in milliseconds
                    pauseOnHover: true,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
                    controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
                    directionNav:true,
                    prevText: "",           //String: Set the text for the "previous" directionNav item
                    nextText: "",               //String: Set the text for the "next" directionNav item
                    itemWidth: 155,
                    itemMargin: 10,
                    minItems: 1,
                    move: 2,
                    maxItems: 6
                });
            });
        });
        </script>
        ';
        }


        return $output;

    }
}
/*****************************************************/










/*
CLIENTS SHORTCODE
*/
class WPBakeryShortCode_mk_testimonials extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'count'=> 10,
                    'orderby'=> 'date',
                    'testimonials' => '',
                    'order'=> 'DESC',
                    "effect" => 'fade',
                    "animation_speed" => 700,
                    "slideshow_speed" => 7000,
                    "pause_on_hover" => "false",
                    "smooth_height" => "true",
                    "direction_nav" => "true",
                    "skin" => "#00c360",
                    "el_class"=> '',
                    'el_position' => '',
                    'width' => '1/1',
                ), $atts ) );


        wp_enqueue_scripts( 'jquery-flexslider' );

        $id = mt_rand( 99, 9999 );

        $width = wpb_translateColumnWidthToSpan( $width );
        $script_out = '<script type="text/javascript">
        
        jQuery(document).ready(function() {
            jQuery(window).on("load",function () {
                jQuery("#testimonial_'.$id.'").flexslider({
                    selector: ".mk-flex-slides > li",
                    animation: "'.$effect.'",              //String: Select your animation type, "fade" or "slide"
                    smoothHeight: '.$smooth_height.',            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
                    slideshowSpeed: '.$slideshow_speed.',           //Integer: Set the speed of the slideshow cycling, in milliseconds
                    animationSpeed: '.$animation_speed.',            //Integer: Set the speed of animations, in milliseconds
                    pauseOnHover: '.$pause_on_hover.',            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
                    controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
                    directionNav:'.$direction_nav.',
                    prevText: "",           //String: Set the text for the "previous" directionNav item
                    nextText: ""               //String: Set the text for the "next" directionNav item
                });
            });
        });
        </script>
        <style type="text/css">
                            #testimonial_'.$id.' h4 {
                            background-color: '.$skin.';
                            }
                            #testimonial_'.$id.' h4:after {
                            border-bottom-color: '.$skin.';
                            }
                            #testimonial_'.$id.' .flex-direction-nav .flex-next {
                            border-left-color: '.( !empty( $skin ) ? $skin : '#00c360' ).';
                            }
                            #testimonial_'.$id.' .flex-direction-nav .flex-prev {
                            border-right-color: '.( !empty( $skin ) ? $skin : '#00c360' ).';
                            }</style>
';

        $query = array(
            'post_type' => 'testimonial',
            'showposts' => $count,
        );

        if ( $testimonials ) {
            $query['post__in'] = explode( ',', $testimonials );
        }
        if ( $orderby ) {
            $query['orderby'] = $orderby;
        }
        if ( $order ) {
            $query['order'] = $order;
        }

        $loop = new WP_Query( $query );
        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $output = '';
        while ( $loop->have_posts() ):
            $loop->the_post();
        $url = get_post_meta( get_the_ID(), '_url', true );
        $image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
        $image_cropping = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
        $retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;
        $image_src  = theme_image_resize( $image_src_array[ 0 ], 120, 120, $image_cropping, $retina_images );

        $output .= '<li>';
        $output .= '<div class="mk-testimonial-image"><img width="120" height="120" src="'.$image_src['url'].'" alt="" /></div>';
        $output .= '<div class="mk-testimonial-content">';
        $output .= '<h4>'.get_the_title().'</h4>';
        $output .= '<p class="mk-testimonial-quote">'. strip_tags(get_post_meta( get_the_ID(), '_desc', true ), '<p>').'</p>';
        $output .= '<a '.( !empty( $url ) ? ( 'href="'.$url.'"' ) : '' ).' class="mk-testimonial-author">'. strip_tags( get_post_meta( get_the_ID(), '_author', true ) ).'</a>';
        $output .= '</div>';
        $output .= '</li>'. "\n\n";
        endwhile;
        wp_reset_query();

        return '<div class="'.$width.' '.$el_position_css.'"><div class="mk-testimonial mk-flexslider '.$el_class.'" id="testimonial_'.$id.'"><ul class="mk-flex-slides">' . $output . '</ul></div></div>' . "\n\n\n\n" . $script_out;

       
    }
}
/*****************************************************/




/*
SITEMAP PAGES SHORTCODE
*/
class WPBakeryShortCode_mk_sitemap_pages extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'el_class' => '',
                    'width' => '1/1',
                    'el_position' => '',
                ), $atts ) );

        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        return '<div class="'.$width.' '.$el_position_css.'"><div class="mk-shortcode mk-sitemap-pages '.$el_class.'"><a class="mk-sitemap-homepage" href="'.home_url( '/' ).'">'.__( 'Home', 'theme_frontend' ).'</a><ul>'.wp_list_pages( 'sort_column=menu_order&echo=0&title_li=' ).'</ul></div></div>';
    }
}
/*****************************************************/




/*
SITEMAP CATEGOIES SHORTCODE
*/
class WPBakeryShortCode_mk_sitemap_categories extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'number' => '0',
                    'depth' => '0',
                    'width' => '1/1',
                    'el_position' => '',
                ), $atts ) );
        $width = wpb_translateColumnWidthToSpan( $width );

        $exclude_cats = theme_option( THEME_OPTIONS, 'excluded_cats' );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        return '<div class="'.$width.' '.$el_position_css.'"><div class="mk-shortcode mk-sitemap-categories">' . wp_list_categories( array( 'exclude'=> implode( ",", $exclude_cats ), 'style'=> 'none', 'feed' => false, 'show_count' => false, 'use_desc_for_title' => false, 'title_li' => '', 'echo' => 0 ) ) . '</div></div>';
    }
}
/*****************************************************/




/*
SITEMAP POSTS SHORTCODE
*/
class WPBakeryShortCode_mk_sitemap_posts extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'width' => '1/1',
                    'el_position' => '',
                    'number' => '0',
                    'cat' => '',
                    'posts' => '',
                    'author' => '',
                ), $atts ) );

        if ( $number == 0 ) {
            $number = 1000;
        }
        $width = wpb_translateColumnWidthToSpan( $width );
        wp_enqueue_script( 'jquery-isotope' );

        $query = array(
            'showposts' => (int)$number,
            'post_type'=>'post',
        );
        if ( $cat ) {
            $query['cat'] = $cat;
        }
        if ( $posts ) {
            $query['post__in'] = explode( ',', $posts );
        }
        if ( $author ) {
            $query['author'] = $author;
        }
        $r = new WP_Query( $query );
        if ( is_singular() ) {
            global $post;
            $layout = get_post_meta( $post->ID, '_layout', true );
        } else {
            $layout = 'full-layout-column';
        }
        if ( $layout == 'full' ) {
            $column_class = 'full-layout-column';
        } else {
            $column_class = 'sidebar-layout-column';
        }
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $output = '';
        $output .= '<div class="'.$width.' '.$el_position_css.'">';
        $output .= '<div class="mk-shortcode mk-sitemap-posts '.$column_class.'">';
        $output .= '<ul>';
        while ( $r->have_posts() ) : $r->the_post();

        $output .= '<li class="mk-sitemap-posts-item">';
        $output .='<time datetime="'.get_the_time( 'F, j' ).'">';
        $output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'F, j' ).'</a>';
        $output .='</time>';
        $output .='<div class="clearboth"></div>';

        $output .='<div class="the-title highlight"><span><a href="'.get_permalink().'">'.get_the_title().'</a></span></div>';
        $output .='<div class="clearboth"></div>';

        $output .='<div class="categories">In '.get_the_category_list( ', ' ).'</div>';
        $output .='<div class="clearboth"></div>';
        $output .='</li>';

        endwhile;
        $output .= '</ul></div></div>';

        wp_reset_postdata();
        return $output;
    }
}
/*****************************************************/











/*
SITEMAP PORTFOLIO SHORTCODE
*/
class WPBakeryShortCode_mk_sitemap_portfolios extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'width' => '1/1',
                    'el_position' => '',
                    'number' => '0',
                ), $atts ) );

        if ( $number == 0 ) {
            $number = 100;
        }

        wp_enqueue_script( 'jquery-isotope' );
        $width = wpb_translateColumnWidthToSpan( $width );
        $query = array(
            'showposts' => (int)$number,
            'post_type'=>'portfolio',

        );

        $p = new WP_Query( $query );

        global $post;
        $layout = get_post_meta( $post->ID, '_layout', true );

        if ( $layout == 'full' ) {
            $column_class = 'full-layout-column';
        } else {
            $column_class = 'sidebar-layout-column';
        }
        $output = '';
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $output .= '<div class="'.$width.' '.$el_position_css.'">';
        $output .= '<div class="mk-shortcode mk-sitemap-posts '.$column_class.'">';
        $output .= '<ul>';
        while ( $p -> have_posts() ) : $p -> the_post();

        $terms = get_the_terms( get_the_id(), 'portfolio_category' );
        $terms_slug = array();
        $terms_name = array();
        if ( is_array( $terms ) ) {
            foreach ( $terms as $term ) {
                $terms_slug[] = $term->slug;
                $terms_name[] = $term->name;
            }
        }

        $output .= '<li class="mk-sitemap-posts-item">';
        $output .='<time datetime="'.get_the_time( 'F, j' ).'">';
        $output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'F, j' ).'</a>';
        $output .='</time>';
        $output .='<div class="clearboth"></div>';

        $output .='<div class="the-title highlight"><span><a href="'.get_permalink().'">'.get_the_title().'</a></span></div>';
        $output .='<div class="clearboth"></div>';

        $output .='<div class="categories">In '.implode( ' ', $terms_name ).'</div>';
        $output .='<div class="clearboth"></div>';
        $output .='</li>';

        endwhile;
        $output .= '</ul></div></div>';

        wp_reset_postdata();

        return $output;

    }
}
/*****************************************************/












/*
SLIDESHOW SHORTCODE
*/
class WPBakeryShortCode_mk_flexslider extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                     'count'=> 10,
                    'orderby'=> 'date',
                    'slides' => '',
                    'order'=> 'DESC',
                    "image_width" => 770,
                    "image_height" => 350,
                    "effect" => 'fade',
                    "animation_speed" => 700,
                    "slideshow_speed" => 7000,
                    "pause_on_hover" => "false",
                    "smooth_height" => "true",
                    "direction_nav" => "true",
                    "caption_bg_color" => "",
                    "caption_color" => "#fff",
                    "caption_bg_opacity" => 0.8,
                    "el_class" => '',
                    'width' => '1/1',
                    'el_position' => '',
                ), $atts ) );


        wp_enqueue_scripts( 'jquery-flexslider' );

        $id = mt_rand( 99, 9999 );

        $width = wpb_translateColumnWidthToSpan( $width );

        $caption_bg_color = !empty( $caption_bg_color ) ? $caption_bg_color : theme_option( THEME_OPTIONS, 'skin_color' );

        $script_out = '<script type="text/javascript">

        jQuery(document).ready(function() {
            jQuery(window).on("load",function () {
                jQuery("#flexslider_'.$id.'").flexslider({
                    selector: ".mk-flex-slides > li",
                    animation: "'.$effect.'",              //String: Select your animation type, "fade" or "slide"
                    smoothHeight: '.$smooth_height.',            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
                    slideshowSpeed: '.$slideshow_speed.',           //Integer: Set the speed of the slideshow cycling, in milliseconds
                    animationSpeed: '.$animation_speed.',            //Integer: Set the speed of animations, in milliseconds
                    pauseOnHover: '.$pause_on_hover.',            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
                    controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
                    directionNav:'.$direction_nav.',
                    prevText: "",           //String: Set the text for the "previous" directionNav item
                    nextText: ""               //String: Set the text for the "next" directionNav item
                });
            });
        });
        </script>
        <style type="text/css">
                            #flexslider_'.$id.' .flex-direction-nav .flex-next {
                            border-left-color: '.( !empty( $caption_bg_color ) ? $caption_bg_color : '#7e7c79' ).';
                            }
                            #flexslider_'.$id.' .flex-direction-nav .flex-prev {
                            border-right-color: '.( !empty( $caption_bg_color ) ? $caption_bg_color : '#7e7c79' ).';
                            }
        </style>

';

       $query = array(
            'post_type' => 'slideshow',
            'showposts' => $count,
        );

        if ( $slides ) {
            $query['post__in'] = explode( ',', $slides );
        }
        if ( $orderby ) {
            $query['orderby'] = $orderby;
        }
        if ( $order ) {
            $query['order'] = $order;
        }

        $loop = new WP_Query( $query );

            $output = '';
            while ( $loop->have_posts() ):
            $loop->the_post();
            $url = get_post_meta( get_the_ID(), '_link_to', true );
            $caption = get_post_meta( get_the_ID(), '_title', true );
            $image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
                $image_cropping = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
                $retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;
                $image_src  = theme_image_resize( $image_src_array[0], $image_width, $image_height, $image_cropping, $retina_images );


                $output .= '<li>';
                $output .= !empty( $url ) ? '<a href="'.$url.'">' : '' ;
                $output .= '<img alt="" src="' . $image_src['url'] .'" />';
                $output .= !empty( $url ) ? '</a>' : '' ;
                $output .= !empty( $caption) ?  '<div class="mk-flex-caption">
                    <div style="background-color:'.$caption_bg_color.'; -webkit-opacity: '.$caption_bg_opacity.';-moz-opacity: '.$caption_bg_opacity.';-o-opacity: '.$caption_bg_opacity.';filter: alpha(opacity='.( $caption_bg_opacity * 100 ).');opacity: '.$caption_bg_opacity.';" class="color-mask"></div>
                    <span style="color:'.$caption_color.'">'.$caption.'</span>
                    </div>' : '';

                $output .= '</li>'. "\n\n";
        endwhile;
        wp_reset_postdata();
            $el_position_css = '';
            if ( $el_position != '' ) {
                $el_position_css = $el_position.'-column';
            }
            return '<div class="'.$width.' '.$el_position_css.'"><div style="max-width:' . $image_width . 'px;" class="mk-slideshow-shortcode mk-flexslider '.$el_class.'" id="flexslider_'.$id.'"><ul class="mk-flex-slides">' . $output . '</ul></div></div>' . "\n\n\n\n" . $script_out;
        }

}
/*****************************************************/





/*
SIMPLE SLIDESHOW SHORTCODE
*/
class WPBakeryShortCode_mk_image_slideshow extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
            "images" => '',
                    "image_width" => 770,
                    "image_height" => 350,
                    "effect" => 'fade',
                    "animation_speed" => 700,
                    "slideshow_speed" => 7000,
                    "pause_on_hover" => "false",
                    "smooth_height" => "true",
                    "direction_nav" => "true",
                    "el_class" => '',
                    'width' => '1/1',
                    'el_position' => '',
                ), $atts ) );


        wp_enqueue_scripts( 'jquery-flexslider' );
        if ( $images == '' ) return null;
        $id = mt_rand( 99, 9999 );

        $width = wpb_translateColumnWidthToSpan( $width );

        $caption_bg_color = !empty( $caption_bg_color ) ? $caption_bg_color : theme_option( THEME_OPTIONS, 'skin_color' );

        $script_out = '<script type="text/javascript">

        jQuery(document).ready(function() {
            jQuery(window).on("load",function () {
                jQuery("#flexslider_'.$id.'").flexslider({
                    selector: ".mk-flex-slides > li",
                    animation: "'.$effect.'",              //String: Select your animation type, "fade" or "slide"
                    smoothHeight: '.$smooth_height.',            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
                    slideshowSpeed: '.$slideshow_speed.',           //Integer: Set the speed of the slideshow cycling, in milliseconds
                    animationSpeed: '.$animation_speed.',            //Integer: Set the speed of animations, in milliseconds
                    pauseOnHover: '.$pause_on_hover.',            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
                    controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
                    directionNav:'.$direction_nav.',
                    prevText: "",           //String: Set the text for the "previous" directionNav item
                    nextText: ""               //String: Set the text for the "next" directionNav item
                });
            });
        });
        </script>
        <style type="text/css">
                            #flexslider_'.$id.' .flex-direction-nav .flex-next {
                            border-left-color: '.( !empty( $caption_bg_color ) ? $caption_bg_color : '#7e7c79' ).';
                            }
                            #flexslider_'.$id.' .flex-direction-nav .flex-prev {
                            border-right-color: '.( !empty( $caption_bg_color ) ? $caption_bg_color : '#7e7c79' ).';
                            }
        </style>

';

        

            $output = '';
            $images = explode( ',', $images);
        $i = -1;

        foreach ( $images as $attach_id ) {
                $i++;
                $image_cropping = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
                $retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;
                $image_src  = wpb_resize( $attach_id,'', $image_width, $image_height, true );


                $output .= '<li>';
                $output .= '<img alt="" src="' . $image_src['url'] .'" />';
                $output .= '</li>'. "\n\n";

            }
            $el_position_css = '';
            if ( $el_position != '' ) {
                $el_position_css = $el_position.'-column';
            }
            return '<div class="'.$width.' '.$el_position_css.'"><div style="max-width:' . $image_width . 'px;" class="mk-slideshow-shortcode mk-flexslider '.$el_class.'" id="flexslider_'.$id.'"><ul class="mk-flex-slides">' . $output . '</ul></div></div>' . "\n\n\n\n" . $script_out;
    }

}
/*****************************************************/








/*
GALLERY SHORTCODE
*/
class WPBakeryShortCode_mk_gallery extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    "images" => '',
                    'title' => '',
                    "height" => 300,
                    "column" => 4,
                    "el_class" => '',
                    'width' => '1/1',
                    'el_position' => '',
                ), $atts ) );


        if ( $images == '' ) return null;
        $id = mt_rand( 99, 9999 );

        if ( is_page() ) {
            global $post;
            $layout = get_post_meta( $post->ID, '_layout', true );
        }
        else if ( is_home() ) {
                $layout = 'full';
        }

 switch ( $column ) {
    case 1:
        if($layout == 'full') {
            $container_width = theme_option( THEME_OPTIONS, 'container_width' );
            $image_width = !empty($container_width) ?  $container_width : '1100';
            $height = !empty($height) ? $height : 450;
        } else {
            $image_width = 770;
            $height = !empty($height) ? $height : 350;
        }
        $column_css = 'gallery-one-column';
        break;
    case 2:
        if($layout == 'full') {
            $image_width = 528;
            $height = !empty($height) ? $height : 528;
        } else {
            $image_width = 500;
            $height = !empty($height) ? $height : 500;
        }
        $column_css = 'gallery-two-column';
        break;
    case 3:
        $image_width = 500;
        $height = !empty($height) ? $height : 500;
        $column_css = 'gallery-three-column';
        break;

    case 4:
        $image_width = 500;
        $height = !empty($height) ? $height : 500;
        $column_css = 'gallery-four-column';
        break;  
}

        $width = wpb_translateColumnWidthToSpan( $width );


            $output = '';
            $images = explode( ',', $images);
         $i = -1;

        foreach ( $images as $attach_id ) {
                $i++;
                $image_cropping = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
                $retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;
                $image_src_array = wp_get_attachment_image_src( $attach_id, 'full', true );
                $image_src  = wpb_resize( $attach_id,'', $image_width, $height, true );


                $output .= '<article class="'.$column_css.'">';
                $output .='<div class="image-hover-overlay"></div>';
                $output .='<a rel="gallery-lightbox-group-'.$id.'" title="'.$title.'" class="zoom-badge mk-lightbox" href="'.$image_src_array[ 0 ].'"><i class="mk-icon-lightbox-expand"></i></a>';
                $output .= '<img alt="" src="' . $image_src['url'] .'" />';
                $output .= '</article>'. "\n\n";

            }
            $el_position_css = '';
            if ( $el_position != '' ) {
                $el_position_css = $el_position.'-column';
            }
            return '<div class="'.$width.' '.$el_position_css.'"><div class="mk-gallery-shortcode mk-shortcode '.$el_class.'"><section>' . $output . '</section><div class="clearboth"></div></div></div>';
    }

}
/*****************************************************/







class WPBakeryShortCode_mk_custom_css extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        return '<style type="text/css">'.$content.'</style>';

    }
}
/*****************************************************/





class WPBakeryShortCode_mk_custom_js extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        return '<script type="text/javascript">'.$content.'</script>';

    }
}
/*****************************************************/








class WPBakeryShortCode_mk_padding_divider extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'size' => '30',
                    'el_class' => '',
                    'el_position' => '',
                    'width' => '1/1',
                ), $atts ) );
        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        return '<div class="'.$width.' '.$el_position_css.'"><div class="clearboth"></div><div class="mk-shortcode mk-padding-shortcode" style="height:'.$size.'px"></div><div class="clearboth"></div></div>';
    }
}
/*****************************************************/









class WPBakeryShortCode_mk_contact_form extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
                    'email' => get_bloginfo( 'admin_email' ),
                    'skin' => 'dark',
                    'btn_txt_color' => theme_option( THEME_OPTIONS, 'skin_color' ),
                    'btn_bg_color' => '#00c65d',
                    'el_class' => '',
                    'el_position' => '',
                    'width' => '1/1',
                ), $atts ) );


        $id = mt_rand( 99, 999 );
        $file_path = THEME_DIR_URI;
        $tabindex_1 = $id;
        $tabindex_2 = $id + 1;
        $tabindex_3 = $id + 2;
        $tabindex_4 = $id + 3;
        $name_str = __( 'Name', 'theme_frontend' );
        $email_str = __( 'Email', 'theme_frontend' );
        $submit_str = __( 'Submit', 'theme_frontend' );
        $content_str = __( 'Please be short and descriptive!', 'theme_frontend' );
        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }

        return <<<HTML
    <div class="{$width} {$el_position_css}">
<div class="mk-contact-form-shortcode mk-shortcode mk-contact-{$skin} {$el_class}">
    <form class="mk-contact-form" action="{$file_path}/sendmail.php" method="post" novalidate="novalidate">
        <div class="mk-form-row"><textarea required="required" data-watermark="{$content_str}" name="contact_content" id="contact_content" class="mk-textarea" tabindex="{$tabindex_1}"></textarea></div>
        <div class="mk-form-row">
        <div style="float:left" class="contact-form-spliter"><input data-watermark="{$name_str}" type="text" required="required" id="contact_name" name="contact_name" class="text-input watermark-input" value="" tabindex="{$tabindex_2}" /></div>
        <div style="float:right" class="contact-form-spliter"><input data-watermark="{$email_str}" type="email" required="required" id="contact_email" name="contact_email" class="text-input watermark-input" value="" tabindex="{$tabindex_3}" /></div>
        <div class="clearboth"></div>
        </div>

        <div class="mk-form-row"><button tabindex="{$tabindex_4}" type="submit" style="background-color:{$btn_bg_color}; color:{$btn_txt_color}" class="mk-button contact-form-button small">{$submit_str}</button>
        <div class="mk-contact-loading"></div>
        <div class="mk-contact-success-icon"></div>
        </div>
        <input type="hidden" value="{$email}" name="contact_to"/>
    </form>
    <div class="clearboth"></div>

</div>
</div>
HTML;

    }
}
/*****************************************************/















class WPBakeryShortCode_mk_contact_info extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
                    'name' => '',
                    'phone' => '',
                    'cellphone' => '',
                    'email' => '',
                    'general_address' => '',
                    'work_address' => '',
                    'home_address' => '',
                    'skype' => '',
                    'gtalk' => '',
                    'yahoo' => '',
                    'instagram' => '',
                    'width' => '1/1',
                    'el_position' => '',
                    'el_class' => ''
                ), $atts ) );
        $width = wpb_translateColumnWidthToSpan( $width );
        $output = '';
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $output .= '<div class="'.$width.' '.$el_position_css.'">';

        $output .= '<div class="widget_contact_info">';
        $output .= '<ul>';
        $output .= !empty( $name )  ? '<li class="mk-icon-list"><i class="mk-icon-user"></i>'.$name.'</li>' : '';
        $output .= !empty( $phone )  ? '<li class="mk-icon-list"><i class="mk-icon-phone"></i>'.$phone.'</li>' : '';
        $output .= !empty( $cellphone )  ? '<li class="mk-icon-list"><i class="mk-icon-mobile"></i>'.$cellphone.'</li>' : '';
        $output .= !empty( $email )  ? '<li class="mk-icon-list"><i class="mk-icon-message"></i>'.$email.'</li>' : '';
        $output .= !empty( $general_address )  ? '<li class="mk-icon-list"><i class="mk-icon-pin"></i>'.$general_address.'</li>' : '';
        $output .= !empty( $work_address ) ? '<li class="mk-icon-list"><i class="mk-icon-suitcase"></i>'.$work_address.'</li>' : '';
        $output .= !empty( $home_address )  ? '<li class="mk-icon-list"><i class="mk-icon-home"></i>'.$home_address.'</li>' : '';
        $output .= !empty( $skype )  ? '<li class="mk-icon-list"><i class="mk-icon-balloon"></i>'.$skype.'</li>' : '';
        $output .= !empty( $gtalk )  ? '<li class="mk-icon-list"><i class="mk-icon-balloon"></i>'.$gtalk.'</li>' : '';
        $output .= !empty( $yahoo )  ? '<li class="mk-icon-list"><i class="mk-icon-balloon"></i>'.$yahoo.'</li>' : '';
        $output .= !empty( $instagram )  ? '<li class="mk-icon-list"><i class="mk-icon-camera"></i>'.$instagram.'</li>' : '';
        $output .= '</ul>';
        $output .= '</div></div>';

        return $output;

    }
}
/*****************************************************/




function theme_shortcode_column( $atts, $content = null, $code ) {
    return '<div class="' . $code . '">' . wpautop( do_shortcode( trim( $content ) ) ) . '</div>';
}
function theme_shortcode_column_last( $atts, $content = null, $code ) {
    return '<div class="' . str_replace( '_last', '', $code ) . ' last">' . wpautop( do_shortcode( trim( $content ) ) ) . '</div><div class="clearboth"></div>';
}

add_shortcode( 'one_half', 'theme_shortcode_column' );
add_shortcode( 'one_third', 'theme_shortcode_column' );
add_shortcode( 'one_fourth', 'theme_shortcode_column' );
add_shortcode( 'one_fifth', 'theme_shortcode_column' );
add_shortcode( 'one_sixth', 'theme_shortcode_column' );

add_shortcode( 'two_third', 'theme_shortcode_column' );
add_shortcode( 'three_fourth', 'theme_shortcode_column' );
add_shortcode( 'two_fifth', 'theme_shortcode_column' );
add_shortcode( 'three_fifth', 'theme_shortcode_column' );
add_shortcode( 'four_fifth', 'theme_shortcode_column' );
add_shortcode( 'five_sixth', 'theme_shortcode_column' );

add_shortcode( 'one_half_last', 'theme_shortcode_column_last' );
add_shortcode( 'one_third_last', 'theme_shortcode_column_last' );
add_shortcode( 'one_fourth_last', 'theme_shortcode_column_last' );
add_shortcode( 'one_fifth_last', 'theme_shortcode_column_last' );
add_shortcode( 'one_sixth_last', 'theme_shortcode_column_last' );

add_shortcode( 'two_third_last', 'theme_shortcode_column_last' );
add_shortcode( 'three_fourth_last', 'theme_shortcode_column_last' );
add_shortcode( 'two_fifth_last', 'theme_shortcode_column_last' );
add_shortcode( 'three_fifth_last', 'theme_shortcode_column_last' );
add_shortcode( 'four_fifth_last', 'theme_shortcode_column_last' );
add_shortcode( 'five_sixth_last', 'theme_shortcode_column_last' );
/*****************************************************/
