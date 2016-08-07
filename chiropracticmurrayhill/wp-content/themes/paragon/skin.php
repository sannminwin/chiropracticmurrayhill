<?php 
require_once( '../../../wp-load.php' );
header("Content-type: text/css; charset: UTF-8");
include(THEME_FUNCTIONS . "/generate-dynamic-styles.php");
echo <<<CSS

{$fontface_style_1}
{$fontface_style_2}
{$fontface_css_1}
{$fontface_css_2}

{$google_font_1}
{$google_font_2}

{$safefont_css_1}
{$safefont_css_2}



/*
*****************************
GENERAL SECTIONS ************
*****************************
*/


body{
	font-size: {$option['body_font_size']}px;
	color: {$option['body_text_color']};
	font-weight: {$option['body_weight']};
	line-height: 22px;
	{$safe_font}
	{$body_bg}
}

.mk-grid {
	max-width: {$option['container_width']}px;
}

#mk-boxed-layout {
  -webkit-box-shadow: 0 0 {$option['boxed_layout_shadow_size']}px rgba(0, 0, 0, {$option['boxed_layout_shadow_intensity']});
  -moz-box-shadow: 0 0 {$option['boxed_layout_shadow_size']}px rgba(0, 0, 0, {$option['boxed_layout_shadow_intensity']});
  box-shadow: 0 0 {$option['boxed_layout_shadow_size']}px rgba(0, 0, 0, {$option['boxed_layout_shadow_intensity']});
}

p {
	font-size: {$option['p_size']}px;
	color: {$option['p_color']};
	color: {$p_color};
}

a {
	color: {$option['a_color']};
	color: {$a_color};
}

#mk-header {
	{$header_bg}
}




#theme-page {
	{$page_bg}
}

#mk-footer {
	{$footer_bg}
}

#mk-footer #footer-slogan {
	background-image: url(images/patterns/default-pattern.png);
	background-color: {$option['footer_slogan_bg']};
	background-color: {$footer_slogan_bg};
}

#mk-footer #footer-slogan h4 {
	font-size: {$option['footer_slogan_text_size']}px;
	color: {$option['footer_slogan_text_color']};
	color: {$footer_slogan_text_color};
}

.homepage-tabbed-box {
	background-color: {$option['homepage_tabbed_box_color']};
	background-color: {$homepage_tabbed_box_color};
	
}


.blog-single-content-wrapper, .single-post-social-share, .mk-blog-single-page .single-postype-icons, .mk-single-permalink-icon, .mk-single-zoom-icon{
	background-color: {$option['blog_single_content_bg_color']};
	background-color: {$blog_single_content_bg_color};
}

.single-blog-wrapper {
	background-color: {$option['blog_single_container_bg_color']};
	background-color: {$blog_single_container_bg_color};
}


.mk-homepage-slideshow {
	{$homepage_slideshow}
}


/*
*****************************
TYPOGRAPHY ******************
*****************************
*/
 

#theme-page h1{
			font-size: {$option['h1_size']}px;
			color: {$option['h1_color']};
			color: {$h1_color};
			font-weight: {$option['h1_weight']};
	}

#theme-page h2{
			font-size: {$option['h2_size']}px;
			color: {$option['h2_color']};
			color: {$h2_color};
			font-weight: {$option['h2_weight']};
	}


#theme-page h3{
			font-size: {$option['h3_size']}px;
			color: {$option['h3_color']};
			color: {$h3_color};
			font-weight: {$option['h3_weight']};
	}

#theme-page h4{
			font-size: {$option['h4_size']}px;
			color: {$option['h4_color']};
			color: {$h4_color};
			font-weight: {$option['h4_weight']};
	}


#theme-page h5{
			font-size: {$option['h5_size']}px;
			color: {$option['h5_color']};
			color: {$h5_color};
			font-weight: {$option['h5_weight']};
	}


#theme-page h6{
			font-size: {$option['h6_size']}px;
			color: {$option['h6_color']};
			color: {$h6_color};
			font-weight: {$option['h6_weight']};
	}









/* Widgets : Sidebar */
#mk-sidebar, #mk-sidebar p{
			font-size: {$option['sidebar_text_size']}px;
			color: {$option['sidebar_text_color']};
			color: {$sidebar_text_color};
			font-weight: {$option['sidebar_text_weight']};
	}

#mk-sidebar .widgettitle {
			
			font-size: {$option['sidebar_title_size']}px;
			color: {$option['sidebar_title_color']};
			color: {$sidebar_title_color};
			font-weight: {$option['sidebar_title_weight']};
	}	
#mk-sidebar .widgettitle a {
			color: {$option['sidebar_title_color']};
			color: {$sidebar_title_color};
	}		

#mk-sidebar .widget a{
			color: {$option['sidebar_links_color']};
			color: {$sidebar_links_color};
	}

#mk-sidebar .widget a:hover{
			color: {$option['sidebar_links_color']};
			color: {$sidebar_links_color};
	}	








/* Widgets : Footer */
#mk-footer, #mk-footer p  {
			font-size: {$option['footer_text_size']}px;
			color: {$option['footer_text_color']};
			color: {$footer_text_color};
			font-weight: {$option['footer_text_weight']};
	}

#mk-footer .widgettitle {
			font-size: {$option['footer_title_size']}px;
			color: {$option['footer_title_color']};
			color: {$footer_title_color};
			font-weight: {$option['footer_title_weight']};
	}

#mk-footer .widgettitle a {
			color: {$option['footer_title_color']};
			color: {$footer_title_color};
}	

#mk-footer .widget a{
			color: {$option['footer_links_color']};
			color: {$footer_links_color};
	}

#mk-footer .widget a:hover{
			color: {$option['footer_links_color']};
			color: {$footer_links_color};
	}	

#sub-footer {
	background-color: {$option['sub_footer_bg_color']};
	background-color: {$sub_footer_bg_color};
}

#mk-footer-navigation ul li:last-child a, #mk-footer-navigation ul li a {
  border-color: {$option['body_color']};
  border-color: {$body_color};
}


@media handheld, only screen and (max-width: 960px) {	
	#mk-footer-navigation ul li a {
		border-bottom-color:{$option['body_color']};
		border-bottom-color:{$body_color};
	}	
}


/* Page Introduce Section */
#mk-page-introduce {
	{$introduce_bg}
}
.page-introduce-title {
	font-size: {$option['page_introduce_title_size']}px;
}

.introduce-fancy-title span {
	line-height:{$option['introduce_title_line_height']}px;
}



.page-introduce-subtitle {
	font-size: {$option['page_introduce_subtitle_size']}px;
	line-height: {$introduce_subtitle_size}px;
}

.page-introduce-subtitle span {
		background-color: {$option['page_subtitle_highlight_color']};
		background-color: {$page_subtitle_highlight_color};
		box-shadow: 15px 0 0 {$option['page_subtitle_highlight_color']}, -15px 0 0 {$option['page_subtitle_highlight_color']};
		box-shadow: 15px 0 0 {$page_subtitle_highlight_color}, -15px 0 0 {$page_subtitle_highlight_color};
		color: {$option['page_subtitle_color']};
		color: {$page_subtitle_color};
		font-size: {$option['page_introduce_subtitle_size']}px;
		line-height: {$option['page_introduce_subtitle_line_height']}px;
}

.page-introduce-desc {
	color: {$option['page_desc_color']};
	color: {$page_desc_color};
	font-size: {$option['page_desc_size']}px;
}	





/* Main Navigation */

#mk-main-navigation ul li a {
	color: {$option['main_nav_top_text_color']};
	color: {$main_nav_top_text_color};
	background-color: {$option['main_nav_top_bg_color']};
	background-color: {$main_nav_top_bg_color};
	font-size: {$option['main_nav_top_size']}px;
	font-weight: {$option['main_nav_top_weight']};
}

.mk-header-searchform .search-button {
	background-color: {$option['main_nav_top_bg_color']};
	background-color: {$main_nav_top_bg_color};
}

.mk-responsive .mk-header-right, .mk-nav-responsive-link{
	background-color: {$option['main_nav_top_bg_color']};
	background-color: {$main_nav_top_bg_color};
}

#mk-main-navigation ul li > a:hover,
#mk-main-navigation ul li:hover > a,
#mk-main-navigation ul li.current-menu-item > a,
#mk-main-navigation ul li.current-menu-ancestor > a,
.mk-nav-responsive-link:hover,
.mk-nav-responsive-link:focus {
	background-color: {$option['main_nav_top_bg_hover_color']};
	background-color: {$main_nav_top_bg_hover_color};
	color: {$option['main_nav_top_text_hover_color']};
	color: {$main_nav_top_text_hover_color};
}

#mk-main-navigation ul li ul li, #mk-main-navigation ul li ul li a {
	background-color: {$option['main_nav_sub_bg_color']};
	background-color: {$main_nav_sub_bg_color};
	color: {$option['main_nav_sub_text_color']};
	color: {$main_nav_sub_text_color};
}

#mk-main-navigation ul li ul li:hover .sf-sub-indicator {
	border-left-color: {$option['main_nav_sub_bg_color']};
	border-left-color: {$main_nav_sub_bg_color};
}

#mk-main-navigation ul li ul li a:hover,
#mk-main-navigation ul li ul li:hover > a,
#mk-main-navigation ul ul li a:hover,
#mk-main-navigation ul ul li:hover > a,
#mk-main-navigation ul ul li.current-menu-item > a {
	background-color:{$option['main_nav_sub_hover_bg_color']};
	background-color:{$main_nav_sub_hover_bg_color};
  	color: {$option['main_nav_sub_hover_text_color']};
  	color: {$main_nav_sub_hover_text_color};
}


/*
*****************************
SKINING *********************
*****************************
*/



/* Main Skin Color : Color Property */

.mk-blog-classic-item time a,
.mk-blog-classic-item .categories a,
.mk-blog-classic-item .categories,
.mk-blog-single-page time.post-date a, 
.mk-blog-single-page .categories a,
.mk-blog-single-page .categories,
.mk-commentlist .comment-author,
.mk-commentlist .comment-reply:hover > a,
.mk-newspaper-comments .comment-author a,
.mk-blog-newspaper-item .featured-image:hover > .the-title a,
.portfolio-brief-content h3,
.mk-tabs .mk-tabs-tabs li.current > a,
.mk-tabs.light .mk-tabs-tabs li.current > a,
.mk-accordion .mk-accordion-tab.current,
.mk-toggle .mk-toggle-title.active-toggle,
.introduce-simple-title,
.mk-clients-shortcode .client-title,
.rating-star .rated,
.portfolio-newspaper-image:hover .the-title.highlight span a,
.mk-newspaper-comments .comment-author,
.upsells.products h2,
.related.products h2,
.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .price .amount,
.single-postype-icons i,
.filter-portfolio ul li a
{
	color: {$option['skin_color']} !important;
	color: {$skin_color} !important;
}






/* Main Skin Color : Background-color Property */


.image-hover-overlay,
.mk-blog-classic-item.portfolio-post-type .portfolio-outer-wrapper,
.post-type-badge,
.metro-portfolio,
.newspaper-portfolio,
.about-author-name,
.single-post-tags a:hover,
.similar-posts-wrapper .post-thumbnail:hover > .overlay-pattern /* Should be !important if not working */,
.ls-paragonskin .ls-bottom-slidebuttons a.ls-nav-active,
.ls-paragonskin .ls-bottom-slidebuttons a:hover,
.flex-control-nav a:hover,
.flex-control-nav a.flex-active,
.portfolio-newspaper-image .excerpt-overlay,
.portfolio-logo-section,
.post-list-document .post-type-thumb:hover,
#wp-calendar td#today,
.metro-image,
.metro-video,
.metro-audio,
.metro-document,
.mk-clients-shortcode ul li:hover .clients-overlay,
.mk-pricing-price,
.mk-pricing-button .mk-button:hover,
#cboxTitle,
#cboxPrevious,
#cboxNext,
#cboxClose,
#mk-footer-navigation ul li a:hover,
div.jp-volume-bar-value,
.comment-form-button, 
.mk-button:hover,
input[type="submit"]:hover,
.widget_posts_lists ul li .post-list-thumb .posts-overlay,
.mk-single-audio-wrapper,
.widget-sub-navigation ul li.current_page_item a,
.widget-sub-navigation ul li a:hover,
.woocommerce .mk-onsale,
.filter-portfolio ul li a:hover,
.filter-portfolio ul li a.current

{
	background-color: {$option['skin_color']} !important;
	background-color: {$skin_color} !important;
}



/* Main Skin Color : Border-color Property */


.previouspostslink,
.nextpostslink

{
	border-color: {$option['skin_color']} !important;
	border-color: {$skin_color} !important;
}


.widget-sub-navigation ul li.current_page_item a {
	border-color: {$option['skin_color']};
	border-color: {$skin_color};
}


.mk-blockquote.style2:before, .mk-blockquote.style2:after {
	background-color: {$option['page_color']};
	background-color: {$page_color};
}


.the-title.highlight span, .introduce-fancy-title span, .mk-fancy-text span, .mk-woo-product-item .the-title span, .product_title.entry-title span {
	background-color: {$option['skin_color']};
	background-color: {$skin_color};
	box-shadow: 12px 0 0 {$skin_color}, -12px 0 0 {$skin_color};
	box-shadow: 12px 0 0 {$skin_color}, -12px 0 0 {$skin_color};
}





{$custom_css}

/****************************/

CSS;
?>