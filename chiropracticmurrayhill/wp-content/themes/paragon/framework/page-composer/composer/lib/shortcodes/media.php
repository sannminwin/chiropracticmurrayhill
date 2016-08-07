<?php
/**
 */

class WPBakeryShortCode_VC_Video extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {
        $title = $link = $size = $el_position = $width = $el_class = '';
        extract(shortcode_atts(array(
            'link' => '',
            'video_width' => '700',
            'video_height' => '',
            'el_position' => '',
            'width' => '1/1',
            'el_class' => ''
        ), $atts));
        $output = '';

        if ( $link == '' ) { return null; }
        $el_class = $this->getExtraClass($el_class);
        $width = wpb_translateColumnWidthToSpan($width);
        

        global $wp_embed;
        $embed = $wp_embed->run_shortcode('[embed width="'.$video_width.'"]'.$link.'[/embed]');

        $output .= "\n\t".'<div class="wpb_video_widget '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper">';

        $output .= '<div class="video-container">' . $embed . '</div>';
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}
class WPBakeryShortCode_VC_Gmaps extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {

        $title = $link = $size = $zoom = $type = $el_position = $el_class = '';
        extract(shortcode_atts(array(
            'link' => '',
            'size' => 200,
            'zoom' => 14,
            'type' => 'm',
            'el_position' => '',
            'el_class' => ''
        ), $atts));
        $output = '';

        if ( $link == '' ) { return null; }

        $el_class = $this->getExtraClass($el_class);


        $size = str_replace(array( 'px', ' ' ), array( '', '' ), $size);

        $output .= "\n\t".'<div width="100%;" class="wpb_gmaps_widget wpb_content_element '.$el_class.'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper">';
        $output .= '<div class="wpb_map_wraper"><iframe width="100%" height="'.$size.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$link.'&amp;t='.$type.'&amp;z='.$zoom.'&amp;output=embed"></iframe></div>';

        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> ';

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}