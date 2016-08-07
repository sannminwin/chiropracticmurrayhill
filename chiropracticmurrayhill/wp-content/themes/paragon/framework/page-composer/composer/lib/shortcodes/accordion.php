<?php
/**
 * WPBakery Visual Composer shortcodes
 *
 * @package WPBakeryVisualComposer
 *
 */

class WPBakeryShortCode_VC_Accordion_tab extends WPBakeryShortCode {


    protected function content( $atts, $content = null ) {
        $title = '';

        extract(shortcode_atts(array(
            'title' => __("Section", "js_composer")
        ), $atts));

        $output = '';

        $output .= "\n\t\t\t\t" . '<div class="mk-accordion-tab">'.$title.'</div>';
        $output .= "\n\t\t\t\t" . '<div class="mk-accordion-pane"><div class="inner-box">';
        $output .= "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '<div class="clearboth"></div></div></div>';

        return $output;
    }

    public function contentAdmin( $atts, $content = null ) {
        $title = '';
        $defaults = array( 'title' => __('Section', 'js_composer') );
        extract( shortcode_atts( $defaults, $atts ) );

        return '<div class="group">
		<h3><a href="#">'.$title.'</a></h3>
		<div>
			<div class="row-fluid wpb_column_container not-column-inherit wpb_sortable_container">
				'. do_shortcode($content) . WPBakeryVisualComposer::getInstance()->getLayout()->getContainerHelper() . '
			</div>
		</div>
	    </div>';
    }
}

class WPBakeryShortCode_VC_Accordion extends WPBakeryShortCode {

    public function __construct($settings) {
        parent::__construct($settings);
        WPBakeryVisualComposer::getInstance()->addShortCode( array( 'base' => 'vc_accordion_tab' ) );
    }

    protected function content( $atts, $content = null ) {
        wp_enqueue_style( 'ui-custom-theme' );
        wp_enqueue_script('jquery-ui-accordion');
        $title = $interval = $width = $el_position = $el_class = '';
        //
        extract(shortcode_atts(array(
            'title' => '',
            'interval' => 0,
            'container_bg_color' => '',
            'container_txt_color' => '',
            'el_position' => '',
            'width' => '1/1',
            'el_position' => '',
            'el_class' => ''
        ), $atts));
        $output = '';
        $width = wpb_translateColumnWidthToSpan($width);
        wp_enqueue_script('jquery-tools');
        $id = mt_rand(99,999);
        $el_class = $this->getExtraClass($el_class);
        $el_position_css = '';
            if($el_position != '') {
            $el_position_css = $el_position.'-column';
        }
        $output .= '<div class="'.$width.' '.$el_position_css.'">';
        $output .= '<div id="mk-accordion-'.$id.'" class="mk-accordion mk-shortcode '.$el_class.'">';
        $output .= wpb_js_remove_wpautop($content);
        $output .= '</div></div>';
        $output .= '<style type="text/css">
                     #mk-accordion-'.$id.' .mk-accordion-pane .inner-box{
                        background-color: '.$container_bg_color.';
                         '.(!empty($container_txt_color) ? 'color: '.$container_txt_color.'; ' : '') .'
                    }
                    </style>';


        return $output;
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
}