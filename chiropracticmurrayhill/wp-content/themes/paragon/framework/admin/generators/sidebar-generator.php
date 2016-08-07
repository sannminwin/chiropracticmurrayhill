<?php
class sidebarGenerator {
	var $sidebar_names = array();
	var $footer_sidebar_count = 0;
	var $footer_sidebar_names = array();
	
	function sidebarGenerator(){
		$this->sidebar_names = array(
			'page'=>__('Page Widget Area','theme_frontend'),
			'single'=>__('Single Post Widget Area','theme_frontend'),
			'search'=>__('Search Widget Area','theme_frontend'),
			'archive'=>__('Archive Widget Area','theme_frontend'),
			'404'=>__('404 Widget Area','theme_frontend'),
		);
		$this->footer_sidebar_names = array(
			__('First Footer Widget Area','theme_frontend'),
			__('Second Footer Widget Area','theme_frontend'),
			__('Third Footer Widget Area','theme_frontend'),
			__('Fourth Footer Widget Area','theme_frontend'),
			__('Fifth Footer Widget Area','theme_frontend'),
			__('Sixth Footer Widget Area','theme_frontend'),
		);

	}

	function register_sidebar(){
		foreach ($this->sidebar_names as $name){
			register_sidebar(array(
				'name' => $name,
				'description' => $name,
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="widgettitle">',
				'after_title' => '</h3>',
			));
		}	
		foreach ($this->footer_sidebar_names as $name){
			register_sidebar(array(
				'name' =>  $name,
				'description' => $name,
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="widgettitle">',
				'after_title' => '</h3>',
			));
		}
		
	
		
		//register custom sidebars
	$custom_sidebars = theme_option(THEME_OPTIONS,'sidebars');
		if(!empty($custom_sidebars)){
			$custom_sidebar_names = explode(',',$custom_sidebars);
			foreach ($custom_sidebar_names as $name){
				register_sidebar(array(
					'name' =>  $name,
					'description' => $name,
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget' => '</section>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '</h3>',
				));
			}
		}
		
	}
	
	function get_sidebar($post_id){
		
		if(is_page()){
			$sidebar = $this->sidebar_names['page'];
		}
		if(is_search()) {
		$sidebar = $this->sidebar_names["search"];
		}
		if(is_404()) {
		$sidebar = $this->sidebar_names["404"];
		}
		if(is_archive()) {
		$sidebar = $this->sidebar_names["archive"];
		}		
		if(is_singular('post')){
			$sidebar = $this->sidebar_names['single'];
		}
		if(is_archive()){
			$sidebar = $this->sidebar_names["archive"];
		}
		
		if(!empty($post_id)){
			$custom = get_post_meta($post_id, '_sidebar', true);
			if(!empty($custom)){
				$sidebar = $custom;
			}
		}
		if(isset($sidebar)){
			dynamic_sidebar($sidebar);
		}
	}
	function get_footer_sidebar(){
		dynamic_sidebar($this->footer_sidebar_names[$this->footer_sidebar_count]);
		$this->footer_sidebar_count++;
	}

}
global $_sidebarGenerator;
$_sidebarGenerator = new sidebarGenerator;

add_action('widgets_init', array($_sidebarGenerator,'register_sidebar'));

function sidebar_generator($function){
	global $_sidebarGenerator;
	$args = array_slice( func_get_args(), 1 );
	return call_user_func_array(array( &$_sidebarGenerator, $function ), $args );
}


