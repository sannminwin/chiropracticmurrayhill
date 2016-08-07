<?php

/*-----------------------------------------------------------------------------------*/
/*	Column Shortcodes
/*-----------------------------------------------------------------------------------*/

if (!function_exists('ale_one_third')) {
	function ale_one_third( $atts, $content = null ) {
	   return '<div class="ale-one-third">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('ale_one_third', 'ale_one_third');
}

if (!function_exists('ale_one_third_last')) {
	function ale_one_third_last( $atts, $content = null ) {
	   return '<div class="ale-one-third ale-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('ale_one_third_last', 'ale_one_third_last');
}

if (!function_exists('ale_two_third')) {
	function ale_two_third( $atts, $content = null ) {
	   return '<div class="ale-two-third">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('ale_two_third', 'ale_two_third');
}

if (!function_exists('ale_two_third_last')) {
	function ale_two_third_last( $atts, $content = null ) {
	   return '<div class="ale-two-third ale-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('ale_two_third_last', 'ale_two_third_last');
}

if (!function_exists('ale_one_half')) {
	function ale_one_half( $atts, $content = null ) {
	   return '<div class="ale-one-half">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('ale_one_half', 'ale_one_half');
}

if (!function_exists('ale_one_half_last')) {
	function ale_one_half_last( $atts, $content = null ) {
	   return '<div class="ale-one-half ale-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('ale_one_half_last', 'ale_one_half_last');
}

if (!function_exists('ale_one_fourth')) {
	function ale_one_fourth( $atts, $content = null ) {
	   return '<div class="ale-one-fourth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('ale_one_fourth', 'ale_one_fourth');
}

if (!function_exists('ale_one_fourth_last')) {
	function ale_one_fourth_last( $atts, $content = null ) {
	   return '<div class="ale-one-fourth ale-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('ale_one_fourth_last', 'ale_one_fourth_last');
}

if (!function_exists('ale_three_fourth')) {
	function ale_three_fourth( $atts, $content = null ) {
	   return '<div class="ale-three-fourth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('ale_three_fourth', 'ale_three_fourth');
}

if (!function_exists('ale_three_fourth_last')) {
	function ale_three_fourth_last( $atts, $content = null ) {
	   return '<div class="ale-three-fourth ale-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('ale_three_fourth_last', 'ale_three_fourth_last');
}

if (!function_exists('ale_one_fifth')) {
	function ale_one_fifth( $atts, $content = null ) {
	   return '<div class="ale-one-fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('ale_one_fifth', 'ale_one_fifth');
}

if (!function_exists('ale_one_fifth_last')) {
	function ale_one_fifth_last( $atts, $content = null ) {
	   return '<div class="ale-one-fifth ale-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('ale_one_fifth_last', 'ale_one_fifth_last');
}

if (!function_exists('ale_two_fifth')) {
	function ale_two_fifth( $atts, $content = null ) {
	   return '<div class="ale-two-fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('ale_two_fifth', 'ale_two_fifth');
}

if (!function_exists('ale_two_fifth_last')) {
	function ale_two_fifth_last( $atts, $content = null ) {
	   return '<div class="ale-two-fifth ale-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('ale_two_fifth_last', 'ale_two_fifth_last');
}

if (!function_exists('ale_three_fifth')) {
	function ale_three_fifth( $atts, $content = null ) {
	   return '<div class="ale-three-fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('ale_three_fifth', 'ale_three_fifth');
}

if (!function_exists('ale_three_fifth_last')) {
	function ale_three_fifth_last( $atts, $content = null ) {
	   return '<div class="ale-three-fifth ale-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('ale_three_fifth_last', 'ale_three_fifth_last');
}

if (!function_exists('ale_four_fifth')) {
	function ale_four_fifth( $atts, $content = null ) {
	   return '<div class="ale-four-fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('ale_four_fifth', 'ale_four_fifth');
}

if (!function_exists('ale_four_fifth_last')) {
	function ale_four_fifth_last( $atts, $content = null ) {
	   return '<div class="ale-four-fifth ale-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('ale_four_fifth_last', 'ale_four_fifth_last');
}

if (!function_exists('ale_one_sixth')) {
	function ale_one_sixth( $atts, $content = null ) {
	   return '<div class="ale-one-sixth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('ale_one_sixth', 'ale_one_sixth');
}

if (!function_exists('ale_one_sixth_last')) {
	function ale_one_sixth_last( $atts, $content = null ) {
	   return '<div class="ale-one-sixth ale-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('ale_one_sixth_last', 'ale_one_sixth_last');
}

if (!function_exists('ale_five_sixth')) {
	function ale_five_sixth( $atts, $content = null ) {
	   return '<div class="ale-five-sixth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('ale_five_sixth', 'ale_five_sixth');
}

if (!function_exists('ale_five_sixth_last')) {
	function ale_five_sixth_last( $atts, $content = null ) {
	   return '<div class="ale-five-sixth ale-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('ale_five_sixth_last', 'ale_five_sixth_last');
}


/*-----------------------------------------------------------------------------------*/
/*	Buttons
/*-----------------------------------------------------------------------------------*/

if (!function_exists('ale_button')) {
	function ale_button( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'url' => '#',
			'target' => '_self',
			'style' => 'grey',
			'size' => 'small',
			'type' => 'round'
	    ), $atts));
		
	   return '<a target="'.$target.'" class="ale-button '.$size.' '.$style.' '. $type .'" href="'.$url.'">' . do_shortcode($content) . '</a>';
	}
	add_shortcode('ale_button', 'ale_button');
}


/*-----------------------------------------------------------------------------------*/
/*	Alerts
/*-----------------------------------------------------------------------------------*/

if (!function_exists('ale_alert')) {
	function ale_alert( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'style'   => 'white'
	    ), $atts));
		
	   return '<div class="ale-alert '.$style.'">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('ale_alert', 'ale_alert');
}


/*-----------------------------------------------------------------------------------*/
/*	Toggle Shortcodes
/*-----------------------------------------------------------------------------------*/

if (!function_exists('ale_toggle')) {
	function ale_toggle( $atts, $content = null ) {
	    extract(shortcode_atts(array(
			'title'    	 => 'Title goes here',
			'state'		 => 'open'
	    ), $atts));
	
		return "<div data-id='".$state."' class=\"ale-toggle\"><span class=\"ale-toggle-title\">". $title ."</span><div class=\"ale-toggle-inner\">". do_shortcode($content) ."</div></div>";
	}
	add_shortcode('ale_toggle', 'ale_toggle');
}


/*-----------------------------------------------------------------------------------*/
/*	Tabs Shortcodes
/*-----------------------------------------------------------------------------------*/

if (!function_exists('ale_tabs')) {
	function ale_tabs( $atts, $content = null ) {
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		
		STATIC $i = 0;
		$i++;

		// Extract the tab titles for use in the tab widget.
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		
		$output = '';
		
		if( count($tab_titles) ){
		    $output .= '<div id="ale-tabs-'. $i .'" class="ale-tabs"><div class="ale-tab-inner">';
			$output .= '<ul class="ale-nav ale-clearfix">';
			
			foreach( $tab_titles as $tab ){
				$output .= '<li><a href="#ale-tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
			}
		    
		    $output .= '</ul>';
		    $output .= do_shortcode( $content );
		    $output .= '</div></div>';
		} else {
			$output .= do_shortcode( $content );
		}
		
		return $output;
	}
	add_shortcode( 'ale_tabs', 'ale_tabs' );
}

if (!function_exists('ale_tab')) {
	function ale_tab( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );
		
		return '<div id="ale-tab-'. sanitize_title( $title ) .'" class="ale-tab">'. do_shortcode( $content ) .'</div>';
	}
	add_shortcode( 'ale_tab', 'ale_tab' );
}

?>