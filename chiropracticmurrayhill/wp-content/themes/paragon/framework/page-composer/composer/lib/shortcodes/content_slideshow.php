<?php
/**
 */
class WPBakeryShortCode_mk_slide_item extends WPBakeryShortCode {
    public function content( $atts, $content = null ) {
        $output = wpb_js_remove_wpautop($content);
        return $output;
    }

    public function contentAdmin($atts, $content) {
       $title = '';
        $defaults = array( 'title' => __('Slide Item', 'js_composer') );
        extract( shortcode_atts( $defaults, $atts ) );

        return '<div class="group">
        <h3><a href="#">Slide Item</a></h3>
        <div>
            <div class="row-fluid wpb_column_container  not-column-inherit wpb_sortable_container">
                '. do_shortcode($content) . WPBakeryVisualComposer::getInstance()->getLayout()->getContainerHelper() . '
            </div>
        </div>
        </div>';
    }
}

class WPBakeryShortCode_mk_content_slideshow extends WPBakeryShortCode {

    public function __construct($settings) {
        parent::__construct($settings);
        WPBakeryVisualComposer::getInstance()->addShortCode( array( 'base' => 'mk_slide_item' ) );
    }

    public function contentAdmin( $atts, $content ) {
        $width = $custom_markup = '';
        $shortcode_attributes = array('width' => '1/1');
        foreach ( $this->settings['params'] as $param ) {
            if ( $param['param_name'] != 'content' ) {
                if ( is_string($param['value']) ) {
                    $shortcode_attributes[$param['param_name']] = __($param['value'], "js_composer");
                } else {
                    $shortcode_attributes[$param['param_name']] = $param['value'];
                }
            } else if ( $param['param_name'] == 'content' && $content == NULL ) {
                $content = __($param['value'], "js_composer");
            }
        }
        extract(shortcode_atts(
            $shortcode_attributes
            , $atts));

        $output = '';

        $elem = $this->getElementHolder($width);

        $iner = '';
        foreach ($this->settings['params'] as $param) {
            $param_value = '';
            eval("\$param_value = \$".$param['param_name'].";");

            if ( is_array($param_value)) {
                // Get first element from the array
                reset($param_value);
                $first_key = key($param_value);
                $param_value = $param_value[$first_key];
            }
            $iner .= $this->singleParamHtmlHolder($param, $param_value);
        }
        //$elem = str_ireplace('%wpb_element_content%', $iner, $elem);
        $tmp = '';
        if ( isset($this->settings["custom_markup"]) && $this->settings["custom_markup"] != '' ) {
            if ( $content != '' ) {
                $custom_markup = str_ireplace("%content%", $tmp.$content, $this->settings["custom_markup"]);
            } else if ( $content == '' && isset($this->settings["default_content"]) && $this->settings["default_content"] != '' ) {
                $custom_markup = str_ireplace("%content%", $this->settings["default_content"], $this->settings["custom_markup"]);
            }
            //$output .= do_shortcode($this->settings["custom_markup"]);
            $iner .= do_shortcode($custom_markup);
        }
        $elem = str_ireplace('%wpb_element_content%', $iner, $elem);
        $output = $elem;

        return $output;
    }

    public function content( $atts, $content = null ) {
    extract( shortcode_atts( array(
                "effect" => 'fade',
                "animation_speed" => 700,
                "slideshow_speed" => 7000,
                "pause_on_hover" => "false",
                "smooth_height" => "true",
                "direction_nav" => "true",
                "bg_color" => "",
                "arrow_color" => "",
                "el_class"=> '',
                'width' => '1/1',
                'el_position' => '',
            ), $atts ) );


    wp_enqueue_scripts( 'jquery-flexslider' );
    $width = wpb_translateColumnWidthToSpan($width);
    $id = mt_rand( 99, 9999 );

    $arrow_color = !empty( $arrow_color ) ? $arrow_color : "#00c360";

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
                            border-left-color: '.(!empty($arrow_color) ? $arrow_color : '#7e7c79').';
                            }
                            #flexslider_'.$id.' .flex-direction-nav .flex-prev {
                            border-right-color: '.(!empty($arrow_color) ? $arrow_color : '#7e7c79').';
                            }
        </style>

';

    if ( !preg_match_all( "/(.?)\[(mk_slide_item)\b(.*?)(?:(\/))?\](?:(.+?)\[\/mk_slide_item\])?(.?)/s", $content, $matches ) ) {
        return do_shortcode( $content );
    }
    else {
        for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {
            $matches[ 3 ][ $i ] = shortcode_parse_atts( $matches[ 3 ][ $i ] );
        }

        $output = '';
        for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {


            $output .= '<li>';
            $output .= '<div style="background-color:'.$bg_color.';" class="mk-flex-content">
                    <div>'.do_shortcode( trim( $matches[ 5 ][ $i ] ) ).'<div class="clearboth"></div></div>
                    </div>';

            $output .= '</li>'. "\n\n";

        }
        $el_position_css = '';
            if($el_position != '') {
            $el_position_css = $el_position.'-column';
        }

        return '<div class="'.$width.' '.$el_position_css.'"><div class="mk-content-slideshow-shortcode mk-flexslider  '.$el_class.'" id="flexslider_'.$id.'"><ul class="mk-flex-slides">' . $output . '</ul></div></div>' . "\n\n\n\n" . $script_out;
    }
}
}