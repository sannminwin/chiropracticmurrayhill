<?php
/**
 */

class WPBakeryShortCode_VC_Twitter extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {
        $el_class = $title = $twitter_name = $tweet_count = $el_position = $tweets_count = '';
        wp_enqueue_script( 'jquery-tweet' );
        //
        extract(shortcode_atts(array(
            'twitter_name' => 'twitter',
            'tweets_count' => 5,
            'el_position' => '',
            'width' => '1/1',
            'el_class' => ''
        ), $atts));
        $output = '';

        $el_class = $this->getExtraClass( $el_class );
        $id = mt_rand(99,999);
         $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $output .= '<div class="'.$width.' '.$el_position_css.'">';
        $output .= '<div class="mk-shortcode mk-twitter-feed-shortcode wpb_content_element '.$el_class.'">';
        $output .= '<div id="twitter_shortcode_'.$id.'"></div>';
        $output .= '</div></div>';

        $output .= '<script type="text/javascript">
                    jQuery(document).ready(function() {
                        jQuery("#twitter_shortcode_'.$id.'").tweet({
                            username: "'.$twitter_name.'",
                            count: '.$tweets_count.',
                            template: "{text}{join}{time}"
                        });
                    });
                    </script>';

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

class WPBakeryShortCode_VC_Facebook extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {
        $type = $url = '';
        extract(shortcode_atts(array(
            'type' => 'standard',//standard, button_count, box_count
            'url' => ''
        ), $atts));
        if ( $url == '') $url = get_permalink();
        $output = '<div style="margin-bottom:20px;" class="fb_like fb_type_'.$type.'"><iframe src="http://www.facebook.com/plugins/like.php?href='.$url.'&amp;layout='.$type.'&amp;show_faces=false&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div>'.$this->endBlockComment('fb_like')."<div class='clearboth'></div>\n";
        return $output;
    }
}

class WPBakeryShortCode_VC_TweetMeMe extends WPBakeryShortCode {

    protected function content($atts, $content = null) {
        $type = '';
        extract(shortcode_atts(array(
            'type' => 'horizontal'//horizontal, vertical, none
        ), $atts));
        $output = '<a style="margin-bottom:20px;" href="http://twitter.com/share" class="twitter-share-button" data-count="'.$type.'">'. __("Tweet", "js_composer") .'</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>'.$this->endBlockComment('tweetmeme')."<div class='clearboth'></div>\n";
        return $output;
    }
}

class WPBakeryShortCode_VC_GooglePlus extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {
        $type = $annotation = '';
        extract(shortcode_atts(array(
            'type' => '',
            'annotation' => ''
        ), $atts));
        wp_enqueue_script( 'jquery-googleplus', 'https://apis.google.com/js/plusone.js', array('jquery'), false);
        $params = '';
        $params .= ( $type != '' ) ? ' size="'.$type.'" ' : '';
        $params .= ( $annotation != '' ) ? ' annotation="'.$annotation.'"' : '';
        
        if ( $type == '' ) $type = 'standard';
        $output = '<div style="margin-bottom:20px;" class="wpb_googleplus wpb_googleplus_type_'.$type.'"><g:plusone href="<?php echo get_permalink(); ?>" '.$params.'></g:plusone></div><div class="clearboth"></div>';
        return $output;
    }
}

class WPBakeryShortCode_VC_Pinterest extends WPBakeryShortCode {

    protected function content($atts, $content = null) {
        $type = $annotation = '';
        extract(shortcode_atts(array(
            'type' => 'horizontal'
        ), $atts));

        $params = '';
        $params .= ( $type != '' ) ? ' size="'.$type.'" ' : '';
        $params .= ( $annotation != '' ) ? ' annotation="'.$annotation.'"' : '';

        $url = rawurlencode(get_permalink());
        if ( has_post_thumbnail() ) {
            $img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
            $media = ( is_array($img_url) ) ? '&amp;media='.rawurlencode($img_url[0]) : '';
        } else {
            $media = '';
        }
        $description = ( get_the_excerpt() != '' ) ? '&amp;description='.rawurlencode(strip_tags(get_the_excerpt())) : '';

        $output =  '<div style="margin-bottom:20px;" class="wpb_pinterest wpb_pinterest_type_'.$type.'">';
        $output .= '<a href="http://pinterest.com/pin/create/button/?url='.$url.$media.$description.'" class="pin-it-button" count-layout="'.$type.'"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>';
        $output .= '</div>'.$this->endBlockComment('wpb_pinterest')."\n";

        return $output;
    }
}

class WPBakeryShortCode_VC_flickr extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        extract(shortcode_atts(array(
            'el_position' => '',
            'el_class' => '',
            'flickr_id' => '95572727@N00',
            'count' => '6',
            'thumb_size' => 's',
            'type' => 'user',
            'display' => 'latest'
        ), $atts));

        $el_class = $this->getExtraClass( $el_class );

        $output = "\n\t".'<div class="mk-flickr-feeds-shortcode '.$el_class.'">';
        $output .= "\n\t\t\t".'<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='. $count . '&amp;display='. $display .'&amp;size='.$thumb_size.'&amp;layout=x&amp;source='. $type .'&amp;'. $type .'='. $flickr_id .'"></script>';
        $output .= "\n\t\t\t".'<div class="flickr_stream_wrap"></div>';
        $output .= "\n\t".'</div>';

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}



class WPBakeryShortCode_mk_big_numbers extends WPBakeryShortCode {

    protected function content($atts, $content = null) {
        extract(shortcode_atts(array(
            'width' => '1/1',
            'site' => 'facebook',
            'username' => '',
            'el_class' => '',
            'el_position' => ''
        ), $atts));

         $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }

        switch($site) {
        
            case "facebook" :           
            $output_number = mk_facebook_api_connect($username, "likes");
            $url = "http://facebook.com/".$username;
            break;

            case "twitter" :            
            $output_number = mk_twitter_api_connect($username, "followers_count");
            $url = "http://twitter.com/".$username;
            break;

            case "dribbble" :           
            $output_number = mk_dribbble_api_connect($username, "followers_count");
            $url = "http://dribbble.com/".$username;
            break;

        }

        $output = '<div class="'.$width.' '.$el_position_css.' widget_big_numbers '.$el_class.'">';
        $output .= '<a href="'.$url.'" rel="nofollow" class="big-numbers-item big-numbers-'.$site.'" target="_blank">
                    <span class="big-numbers-icon"><i class="mk-social-'.$site.'"></i></span>
                    <span class="big-numbers-count">';

        $output .=  $output_number;

        $output .= '</span></a></div>';
        return $output;
    }
}