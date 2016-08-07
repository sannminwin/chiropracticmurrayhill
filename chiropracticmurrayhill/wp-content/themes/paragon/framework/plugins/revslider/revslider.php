<?php 
/*
Plugin Name: Revolution Slider
Plugin URI: http://www.themepunch.com/codecanyon/revolution_wp/
Description: Revolution Slider - Premium responsive slider
Author: ThemePunch
Version: 2.1.6
Author URI: http://themepunch.com
*/

$revSliderVersion = "2.1.6";
$currentFile = __FILE__;
$currentFolder = dirname($currentFile);

//include frameword files
require_once $currentFolder . '/inc_php/include_framework.php';

//include bases
require_once $folderIncludes . 'base.class.php';
require_once $folderIncludes . 'elements_base.class.php';
require_once $folderIncludes . 'base_admin.class.php';
require_once $folderIncludes . 'base_front.class.php';

//include product files
require_once $currentFolder . '/inc_php/revslider_settings_product.class.php';
require_once $currentFolder . '/inc_php/revslider_globals.class.php';
require_once $currentFolder . '/inc_php/revslider_operations.class.php';
require_once $currentFolder . '/inc_php/revslider_slider.class.php';
require_once $currentFolder . '/inc_php/revslider_output.class.php';
require_once $currentFolder . '/inc_php/revslider_slide.class.php';
require_once $currentFolder . '/inc_php/revslider_widget.class.php';


try{
	
	//register the kb slider widget	
	UniteFunctionsWPRev::registerWidget("RevSlider_Widget");
	
	//add shortcode
	function rev_slider_shortcode($args){
				
		$sliderAlias = UniteFunctionsRev::getVal($args,0);
		ob_start();
		$slider = RevSliderOutput::putSlider($sliderAlias);
		$content = ob_get_contents();
		ob_clean();
		ob_end_clean();
		
		//handle slider output types
		if(!empty($slider)){
			$outputType = $slider->getParam("output_type","");
			switch($outputType){
				case "compress":
					$content = str_replace("\n", "", $content);
					$content = str_replace("\r", "", $content);
					return($content);
				break;
				case "echo":
					echo $content;		//bypass the filters
				break;
				default:
					return($content);
				break;
			}
		}else
			return($content);		//normal output
			
	}
	
	add_shortcode( 'rev_slider', 'rev_slider_shortcode' );
	
	
	if(is_admin()){		//load admin part
		require_once $currentFolder."/revslider_admin.php";		
		
		$productAdmin = new RevSliderAdmin($currentFile);
		
	}else{		//load front part
		
		/**
		 * 
		 * put kb slider on the page.
		 * the data can be slider ID or slider alias.
		 */
		function putRevSlider($data,$putIn = ""){
			RevSliderOutput::putSlider($data,$putIn);
		}
		
		require_once $currentFolder."/revslider_front.php";
		$productFront = new RevSliderFront($currentFile);
	}

	
}catch(Exception $e){
	$message = $e->getMessage();
	$trace = $e->getTraceAsString();
	echo "KB Slider Error: <b>".$message."</b>";
}
	
/* Paragon Added section to create database */
function mk_create_revslider_tables(){
			global $wpdb;
				$slider_sql = "CREATE TABLE IF NOT EXISTS " .$wpdb->base_prefix.GlobalsRevSlider::TABLE_SLIDERS_NAME." (
							  id int(9) NOT NULL AUTO_INCREMENT,
							  title tinytext NOT NULL,
							  alias tinytext,
							  params text NOT NULL,
							  siteid int,
							  PRIMARY KEY (id)
							);";

				$slides_sql = "CREATE TABLE IF NOT EXISTS " .$wpdb->base_prefix.GlobalsRevSlider::TABLE_SLIDES_NAME." (
								  id int(9) NOT NULL AUTO_INCREMENT,
								  slider_id int(9) NOT NULL,
								  slide_order int not NULL,					  
								  params text NOT NULL,
								  layers text NOT NULL,
								  PRIMARY KEY (id)
								);";

			
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($slider_sql);
			dbDelta($slides_sql);
}	
