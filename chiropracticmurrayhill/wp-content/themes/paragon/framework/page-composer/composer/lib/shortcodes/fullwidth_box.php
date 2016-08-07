<?php
/**
 * WPBakery Visual Composer shortcodes
 *
 * @package WPBakeryVisualComposer
 *
 */

class WPBakeryShortCode_mk_fullwidth_box extends WPBakeryShortCode {

    public function __construct($settings) {
        parent::__construct($settings);
        $this->settings['controls'] = 'full';
        $this->settings['params'] = array(
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
                "heading" => __("Extra class name", "js_composer"),
                "param_name" => "el_class",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
            )
        );
    }

    public function content( $atts, $content = null ) {

        $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
            'el_class' => '',
            'bg_color' => '',
            'margin_bottom' => '10',
            'el_position' => '',
        ), $atts));

        $output = '';

        $el_class = $this->getExtraClass($el_class);

        global $post;
    $layout = get_post_meta( $post->ID, '_layout', true );  

    if($layout == 'full' || is_home()) {

       $output .= '</div></div>
            <div class="mk-fullwidth-boxed row-fluid mk-shortcode '.$el_class.'" style="background-color:'.$bg_color.'; margin-bottom:'.$margin_bottom.'px">
            <div class="mk-grid">'.wpb_js_remove_wpautop($content).'</div>
            </div><div class="clearboth"></div>
            <div class="theme-page-wrapper full-layout mk-grid row-fluid">
            <div class="theme-content">
        ';
   
        return $output;
      }  
          
    }

    public function contentAdmin($atts, $content = null) {
        $width = $el_class = '';
        extract(shortcode_atts(array(
            'el_class' => '',
            'bg_color' => '',
             'margin_bottom' => '10',
            'width' => 'column_12'
        ), $atts));

        $output = '';
        $width = 'span12';
        $column_controls = $this->getColumnControls('edit_popup_delete');


            $output .= '<div data-element_type="'.$this->settings["base"].'" class="wpb_vc_column wpb_content_element wpb_sortable wpb_droppable '.$width.' not-column-inherit">';
            $output .= '<input type="hidden" class="wpb_vc_sc_base" name="element_name-'.$this->shortcode.'" value="'.$this->settings["base"].'" />';
            $output .= $column_controls;
            $output .= '<div class="wpb_element_wrapper">';
            $output .= '<div class="row-fluid wpb_column_container wpb_sortable_container not-column-inherit">';
            $output .= do_shortcode( shortcode_unautop($content) );
            $output .= WPBakeryVisualComposer::getInstance()->getLayout()->getContainerHelper();
            $output .= '</div>';
            if ( isset($this->settings['params']) ) {
                $iner = '';
                foreach ($this->settings['params'] as $param) {
                    $param_value = $$param['param_name'];
                    //var_dump($param_value);
                    if ( is_array($param_value)) {
                        // Get first element from the array
                        reset($param_value);
                        $first_key = key($param_value);
                        $param_value = $param_value[$first_key];
                    }
                    $iner .= $this->singleParamHtmlHolder($param, $param_value);
                }
                $output .= $iner;
            }
            $output .= '</div>';
            $output .= '</div>';


        return $output;
    }
}


