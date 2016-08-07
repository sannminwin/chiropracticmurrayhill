<?php

class theme_class {




/* Primary Navigation */
function primary_menu() {
	wp_nav_menu( array(
			'theme_location' => 'primary-menu',
			'container' => 'nav',
			'container_id' => 'mk-main-navigation',
			'container_class' => 'main_menu',
			'fallback_cb' => '',
		) );
}


/* Footer Navigation */
function footer_menu() {
	wp_nav_menu( array(
			'theme_location' => 'footer-menu',
			'container' => 'nav',
			'container_id' => 'mk-footer-navigation',
			'container_class' => 'footer_menu',
			'fallback_cb' => '',
		) );
}





/* Create Sidebar Widgets */
function sidebar( $post_id = NULL ) {
	sidebar_generator( 'get_sidebar', $post_id );
}










/* Create Footer Widgets */
function footer_sidebar() {
	sidebar_generator( 'get_footer_sidebar' );
}





/* Created Page Introduce section for all pages and templates. */
function page_introduce( $post_id = NULL ) {
	global $post;


	/* Loads Single Page Headings */
	if ( is_single() || is_page() ) {
				if(get_post_meta( $post_id, '_page_disable_title', true ) != 'false') {	
					$title = get_the_title( $post_id );
				}
				$subtitle = get_post_meta( $post_id, '_page_introduce_subtitle', true );
				$desc = get_post_meta( $post_id, '_page_introduce_desc', true );
		
		if(get_post_meta( $post_id, '_page_enable_fancy_title', true ) == 'true') {
			$fancy_text_css = 'introduce-fancy-title';
		} else {
			$fancy_text_css = 'introduce-simple-title';
		}		
	}



	/* Loads Archive Page Headings */	
	if ( is_archive() ) {
		$title = theme_option( THEME_OPTIONS, 'archive_page_title' );
		if ( is_category() ) {
			$subtitle = sprintf( __( 'Category Archive for: "%s"', 'theme_frontend' ), single_cat_title( '', false ) );
		}
		elseif ( is_tag() ) {
			$subtitle = sprintf( __( 'Tag Archives for: "%s"', 'theme_frontend' ), single_tag_title( '', false ) );
		}
		elseif ( is_day() ) {
			$subtitle = sprintf( __( 'Daily Archive for: "%s"', 'theme_frontend' ), get_the_time( 'F jS, Y' ) );
		}
		elseif ( is_month() ) {
			$subtitle = sprintf( __( 'Monthly Archive for: "%s"', 'theme_frontend' ), get_the_time( 'F, Y' ) );
		}
		elseif ( is_year() ) {
			$subtitle = sprintf( __( 'Yearly Archive for: "%s"', 'theme_frontend' ), get_the_time( 'Y' ) );
		}
		elseif ( is_author() ) {
			if ( get_query_var( 'author_name' ) ) {
				$curauth = get_user_by( 'slug', get_query_var( 'author_name' ) );
			}
			else {
				$curauth = get_userdata( get_query_var( 'author' ) );
			}
			$subtitle = sprintf( __( 'Author Archive for: "%s"' ), $curauth->nickname );
		}
		elseif ( is_tax() ) {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$subtitle = sprintf( __( 'Archives for: "%s"', 'theme_frontend' ), $term->name );
		}
		$desc = theme_option( THEME_OPTIONS, 'archive_page_desc' );
		if(theme_option( THEME_OPTIONS, 'archive_disable_subtitle' ) == 'false') {
			$subtitle = '';
		}

		if(theme_option( THEME_OPTIONS, 'archive_fancy_title' ) == 'true') {
			$fancy_text_css = 'introduce-fancy-title';
		} else {
			$fancy_text_css = 'introduce-simple-title';
		}	
	}


	/* Loads 404 Page Headings */
	if ( is_404() ) {
		$title = theme_option( THEME_OPTIONS, 'notfound_page_title' );
		$subtitle = theme_option( THEME_OPTIONS, 'notfound_page_subtitle' );
		$notfound_page_desc = theme_option( THEME_OPTIONS, 'notfound_page_desc' );	

		$fancy_text_css = 'introduce-simple-title';
	}


	/* Loads Search Page Headings */
	if ( is_search() ) {
		$title = theme_option( THEME_OPTIONS, 'search_page_title' );
		$subtitle  = sprintf( __( 'Search Results for: "%s"', 'theme_frontend' ), stripslashes( strip_tags( get_search_query() ) ) );
		$search_page_desc = theme_option( THEME_OPTIONS, 'search_page_desc' );
		if(theme_option( THEME_OPTIONS, 'search_disable_subtitle' ) == 'false') {
			$subtitle = '';
		}

		if(theme_option( THEME_OPTIONS, 'search_fancy_title' ) == 'true') {
			$fancy_text_css = 'introduce-fancy-title';
		} else {
			$fancy_text_css = 'introduce-simple-title';
		}	
	}

	if(!empty($title) || !empty($subtitle) || !empty($desc)) {
	echo '<section id="mk-page-introduce">';
	echo '<div class="mk-grid"><div class="mk-introduce-inner">';
	if ( !empty( $title ) ) {
		echo '<div class="page-introduce-title '.$fancy_text_css.'"><span>' . $title . '</span></div>';
	}
	if ( !empty( $subtitle ) ) {
		echo '<div class="page-introduce-subtitle"><span>';
		echo $subtitle;
		echo '</span></div>';
	}
	if ( !empty( $desc ) ) {
		echo '<span class="page-introduce-desc">';
		echo $desc;
		echo '</span>';
	}
	echo '</div></div></section>';
}


}








/*
Blog Similar posts.
*/
function blog_similar_posts() {
		global $single_layout;
		global $post;
		$backup             = $post;
		$tags               = wp_get_post_tags( $post->ID );
		$tagIDs             = array();
		$related_post_found = false;



		if ( $single_layout == 'full' ) {
			$showposts = 5;
			$width = 180;
			$responsive_width = 320;
			$responsive_height = 280;
		} else {
			$showposts = 4;
			$width = 175;
			$responsive_width = 320;
			$responsive_height = 280;
		}

		if ( $tags ) {
			$tagcount = count( $tags );
			for ( $i = 0; $i < $tagcount; $i++ ) {
				$tagIDs[ $i ] = $tags[ $i ]->term_id;
			}
			$related = new WP_Query( array(
					'tag__in' => $tagIDs,
					'post__not_in' => array(
						$post->ID
					),
					'showposts' => $showposts,
					'ignore_sticky_posts' => 1
				) );

			$output = '';
			if ( $related->have_posts() ) {
				$related_post_found = true;

				$output .= '<section class="similar-posts-wrapper">';

				$output .=  '<div class="mk-fancy-post-heading">
								<span class="fancy-heading-text">'.__( 'Similar Posts', 'theme_frontend' ).'</span>
								<div class="fancy-post-heading-divider"></div>
							</div>';

				$output .= '<ul>';
				while ( $related->have_posts() ) {
					$related->the_post();
					$output .= '<li>';
					$output .= '<a class="post-thumbnail" href="' . get_permalink() . '" title="' . get_the_title() . '"><div class="overlay-pattern"></div>';
					if ( has_post_thumbnail() ) {
						$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
						$enable_image_cropping = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
						$enable_retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;
						$image_src  = theme_image_resize( $image_src_array[ 0 ], $responsive_width, $responsive_height, $enable_image_cropping, $enable_retina_images );
						$output .= '<img style="width: '.$width.'px" src="' . get_image_src( $image_src['url'] ) . '" alt="' . get_the_title() . '" />';
					}
					$output .= '</a></li>';
				}
				$output .= '</ul>';
				$output .= '<div class="clearboth"></div></section>';
			}
			$post = $backup;
		}
		if ( !$related_post_found ) {
				$recent = new WP_Query( array(
						'showposts' => $showposts,
						'nopaging' => 0,
						'post_status' => 'publish',
						'ignore_sticky_posts' => 1
					) );

				$output = '';
			if ( $recent->have_posts() ) {
				$related_post_found = true;

				$output .= '<section class="similar-posts-wrapper">';

				$output .=  '<div class="mk-fancy-post-heading">
								<span class="fancy-heading-text">'.__( 'Similar Posts', 'theme_frontend' ).'</span>
								<div class="fancy-post-heading-divider"></div>
							</div>';

				$output .= '<ul>';
				while ( $recent->have_posts() ) {
					$recent->the_post();
					$output .= '<li>';
					$output .= '<a class="post-thumbnail" href="' . get_permalink() . '" title="' . get_the_title() . '"><div class="overlay-pattern"></div>';
					if ( has_post_thumbnail() ) {
						$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
						$enable_image_cropping = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
						$enable_retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;
						$image_src  = theme_image_resize( $image_src_array[ 0 ], $responsive_width, $responsive_height, $enable_image_cropping, $enable_retina_images );
						$output .= '<img style="width: '.$width.'px;" src="' . get_image_src( $image_src['url'] ) . '" alt="' . get_the_title() . '" />';
					}
					$output .= '</a></li>';
				}
				$output .= '</ul>';
				$output .= '<div class="clearboth"></div></section>';
			}
	

			}
			wp_reset_postdata();
			echo $output;
}
/*-----------------*/














/*
Portfolio Similar posts.
*/
function portfolio_similar_posts() {
		global $single_layout;
		global $post;
		$backup             = $post;
		$tags               = wp_get_post_tags( $post->ID );
		$tagIDs             = array();
		$related_post_found = false;
			$showposts = 5;
			$width = 200;
			$responsive_width = 500;
			$responsive_height = 400;

		if ( $tags ) {
			$tagcount = count( $tags );
			for ( $i = 0; $i < $tagcount; $i++ ) {
				$tagIDs[ $i ] = $tags[ $i ]->term_id;
			}
			$related = new WP_Query( array(
					'tag__in' => $tagIDs,
					'post_type' => 'portfolio',
					'post__not_in' => array(
						$post->ID
					),
					'showposts' => $showposts,
					'ignore_sticky_posts' => 1
				) );

			$output = '';
			if ( $related->have_posts() ) {
				$related_post_found = true;

				$output .= '<section class="similar-posts-wrapper portfolio-similar-posts">';
				$output .= '<div class="mk-fancy-post-heading">
								<span class="fancy-heading-text">'.__( 'Similar Posts', 'theme_frontend' ).'</span>
								<div class="fancy-post-heading-divider"></div>
							</div>';			

				$output .= '<ul>';
				while ( $related->have_posts() ) {
					$related->the_post();
					$output .= '<li>';
					$output .= '<a class="post-thumbnail" href="' . get_permalink() . '" title="' . get_the_title() . '"><div class="overlay-pattern"></div>';
					if ( has_post_thumbnail() ) {
						$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
						$enable_image_cropping = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
						$enable_retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;
						$image_src  = theme_image_resize( $image_src_array[ 0 ], $responsive_width, $responsive_height, $enable_image_cropping, $enable_retina_images );
						$output .= '<img style="width: '.$width.'px" src="' . get_image_src( $image_src['url'] ) . '" alt="' . get_the_title() . '" />';
					}
					$output .= '</a></li>';
				}
				$output .= '</ul>';
				$output .= '<div class="clearboth"></div></section>';
			}
			$post = $backup;
		}
		if ( !$related_post_found ) {
				$recent = new WP_Query( array(
						'post_type' => 'portfolio',
						'showposts' => $showposts,
						'nopaging' => 0,
						'post_status' => 'publish',
						'ignore_sticky_posts' => 1
					) );

				$output = '';
			if ( $recent->have_posts() ) {
				$related_post_found = true;

				$output .= '<section class="similar-posts-wrapper portfolio-similar-posts">';

				$output .= '<div class="mk-fancy-post-heading">
								<span class="fancy-heading-text">'.__( 'Similar Posts', 'theme_frontend' ).'</span>
								<div class="fancy-post-heading-divider"></div>
							</div>';	

				$output .= '<ul>';
				while ( $recent->have_posts() ) {
					$recent->the_post();
					$output .= '<li>';
					$output .= '<a class="post-thumbnail" href="' . get_permalink() . '" title="' . get_the_title() . '"><div class="overlay-pattern"></div>';
					if ( has_post_thumbnail() ) {
						$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
						$enable_image_cropping = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
						$enable_retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;
						$image_src  = theme_image_resize( $image_src_array[ 0 ], $responsive_width, $responsive_height, $enable_image_cropping, $enable_retina_images );
						$output .= '<img style="width: '.$width.'px;" src="' . get_image_src( $image_src['url'] ) . '" alt="' . get_the_title() . '" />';
					}
					$output .= '</a></li>';
				}
				$output .= '</ul>';
				$output .= '<div class="clearboth"></div></section>';
			}
	

			}
			wp_reset_postdata();
			echo $output;
}
/*-----------------*/










function mk_slideshow($post_id = NULL) {

	$disable_slideshow = theme_option( THEME_OPTIONS, 'disable_slideshow' );
	$disable_slideshow_for_single = get_post_meta( $post_id, '_enable_slidehsow_for_singular', true );

	if($disable_slideshow != 'true') {
		return false;
	}
	if ( is_singular() && $disable_slideshow_for_single != 'true' ) {
		return false;
	}


	if ( is_singular() ) {
			$slideshow_type = get_post_meta( $post_id, '_slideshow_source', true );
		} else {
			if ( isset( $_GET["slideshow_type"] ) ) {
				$slideshow_type = $_GET["slideshow_type"];
			} else {
				$slideshow_type = theme_option( THEME_OPTIONS, 'slideshow_source' );
			}
	}


	switch ( $slideshow_type ) {
		case 'layerslider' :
			$this->mk_layerslider( $post_id );
			break;
		case 'revslider' :
			$this->mk_revslider( $post_id );
			break;
		case 'flexslider' :
			$this->mk_flexslider( $post_id );
			break;		
	}


}








/* Layer Slider */
function mk_layerslider( $post_id = NULL ) {
		wp_print_scripts('layerslider_js');
		wp_print_styles('layerslider_css');

	// Add shortcode
	add_shortcode("layerslider","layerslider_init");
	if ( is_singular() ) {
		$source =  get_post_meta( $post_id, '_layer_slider_source', true );
	} else {
		$source = theme_option( THEME_OPTIONS, 'layer_slider_source' );
	}

	if ( !empty( $source ) ) {
		echo do_shortcode( '[layerslider id="'.$source.'"]' );
	}
}










/* Layer Slider */
function mk_revslider( $post_id = NULL ) {
		wp_print_scripts('themepunch_revolution');
		wp_print_scripts('themepunch_plugins' );
		wp_print_styles('rs-captions' );
		wp_print_styles('rs-settings');
	if ( is_singular() ) {
		$source =  get_post_meta( $post_id, '_rev_slider_source', true );
	} else {
		$source = theme_option( THEME_OPTIONS, 'rev_slider_source' );
	}

	if ( !empty( $source ) ) {
		echo do_shortcode( '[rev_slider '.$source.']' );
	}
}









function mk_flexslider_items( $size = array( 1920, 460 ), $post_id ) {
		global $post;
		if ( isset( $_GET["slideshow_type"] ) ) {
			$slideshow_type = $_GET["slideshow_type"];
		} else {
			$slideshow_type = theme_option( THEME_OPTIONS, 'slideshow_source' );
		}

		wp_enqueue_script( 'jquery-flexslider' );

		$number = theme_option( THEME_OPTIONS, 'slideshow_count' );
		$order = theme_option( THEME_OPTIONS, 'slideshow_order' );
		$orderby = theme_option( THEME_OPTIONS, 'slideshow_orderby' );

		if ( is_home() ) {
			$posts_in = theme_option( THEME_OPTIONS, 'flexslider_items' );
		}
		if ( is_singular() ) {
			$posts_in =  get_post_meta( $post_id, '_slideshow_items_to_show', true );
		}
		$query = array(
			'post_type' => 'slideshow',
		);

		if ( $number && is_home() ) {
			$query['showposts'] = $number;

		}
		if ( $order ) {
			$query['order'] = $order;
		}
		if ( $orderby ) {
			$query['orderby'] = $orderby;
		}
		if ( $posts_in ) {
			$query['post__in'] = $posts_in;
		}
		$loop   = new WP_Query( $query );

		$images = array();
		while ( $loop->have_posts() ):
			$loop->the_post();
		$link_to = get_post_meta( get_the_ID(), '_link_to', true );
		$link    = '';
		if ( !empty( $link_to ) ) {
			$link_array = explode( '||', $link_to );
			switch ( $link_array[ 0 ] ) {
			case 'page':
				$link = get_page_link( $link_array[ 1 ] );
				break;
			case 'cat':
				$link = get_category_link( $link_array[ 1 ] );
				break;
			case 'portfolio':
				$link = get_permalink( $link_array[ 1 ] );
				break;
			case 'post':
				$link = get_permalink( $link_array[ 1 ] );
				break;
			case 'manually':
				$link = $link_array[ 1 ];
				break;
			}
		}


		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		$images[ ] = array(
			'title' => get_post_meta( get_the_ID(), '_title', true ),
			'id'=> get_the_id(),
			'desc' => get_post_meta( get_the_ID(), '_description', true ),
			'title_color' => get_post_meta( get_the_ID(), '_title_color', true ),
			'desc_color' => get_post_meta( get_the_ID(), '_desc_color', true ),
			'src' => get_image_src( $image_src_array[0] ),
			'link' => $link
		);
		endwhile;
		wp_reset_postdata();

		return $images;

	}


/* FlexsliderSlider */
function mk_flexslider( $post_id = NULL ) {

	$number = theme_option( THEME_OPTIONS, 'slideshow_count' );
	$slideshow_height = theme_option( THEME_OPTIONS, 'flexslider_height' );
	$layout = theme_option( THEME_OPTIONS, 'flexslider_layout' );
	$animation = theme_option( THEME_OPTIONS, 'flexslider_animation' );
	$slideDirection = theme_option( THEME_OPTIONS, 'flexslider_slideDirection' );
	$slideshow = theme_option( THEME_OPTIONS, 'flexslider_slideshow' );
	$slideshowSpeed = theme_option( THEME_OPTIONS, 'flexslider_slideshowSpeed' );
	$animationDuration = theme_option( THEME_OPTIONS, 'flexslider_animationDuration' );
	$pauseOnHover = theme_option( THEME_OPTIONS, 'flexslider_pauseOnHover' );
	$disableCaption = theme_option( THEME_OPTIONS, 'flexslider_disableCaption' );
	$easing = theme_option( THEME_OPTIONS, 'flexslider_easing' );
	wp_enqueue_scripts( 'jquery-flexslider' );
	$random_id       = rand( 100, 9999 );

	if ( $layout == 'full_width' ) {
		$width = 1920;
		$image_width = 9999;
		$layout_css = 'flex-fullwidth';
	}
	elseif ( $layout == 'boxed_layout' ) {
		$width = 1140;
		$image_width = 1140;
		$layout_css = 'flex-boxed';
	}




$output = '<div class="mk-flexsldier-slideshow mk-flexslider '.$layout_css.'"><div id="flexslider_'.$random_id.'" style="max-width:' . $width . 'px;">';
$output .= '<ul class="mk-flex-slides">';


$images   = $this->mk_flexslider_items( 'full', $post_id );
foreach ( $images as $image ) {
	$slide_id = mt_rand(50,100);
	$title = $image[ 'title' ];
	$desc  = $image[ 'desc' ];
	$title_color = $image[ 'title_color' ];
	$desc_color  = $image[ 'desc_color' ];
	$link = $image['link'];

	$enable_image_cropping = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
	$enable_retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;
	$image_src  = theme_image_resize( $image[ 'src' ], $image_width, $slideshow_height, $enable_image_cropping, $enable_retina_images );


	$output .= '<li>';
	$output .= !empty( $link ) ? '<a href="'.$link.'">' : '';
	$output .= '<img alt="'.$title.'" src="' . get_image_src( $image_src['url'] ) . '"  />';
	if ((!empty( $title ) || !empty( $desc )) && $disableCaption != 'false') {
		$output .= '<div class="mk-flex-caption" id="mk-flex-caption-'.$slide_id.'">';
		$output .= !empty( $title ) ? '<div class="mk-fancy-text"><span>'.strip_tags($title).'</span></div>' : '';
		$output .= !empty( $desc ) ? '<p>'.$desc.'</p>' : '';
		$output .= '</div>';
	}
	$output .= !empty( $link ) ? '</a>' : '';
	$output .='</li>';

	$output .='<style type="text/css">
					#mk-flex-caption-'.$slide_id.' .mk-fancy-text span {background-color: '.$title_color.';box-shadow: 10px 0 0 '.$title_color.', -10px 0 0 '.$title_color.';}
					#mk-flex-caption-'.$slide_id.' p{color: '.$desc_color.';}		
			 </style>';
}



$output .= '</ul>';
$output .= '</div></div>';



	$output .= <<<HTML
<script type="text/javascript">
  jQuery(document).ready(function() {
  	jQuery(window).on("load",function () {
	    jQuery('#flexslider_{$random_id}').flexslider({
	    		selector: ".mk-flex-slides > li",
				animation: "{$animation}",
				smoothHeight: true, 
				direction:"horizental",
				slideDirection: "{$slideDirection}",
				slideshow: {$slideshow},
				slideshowSpeed: {$slideshowSpeed},
				animationDuration: {$animationDuration},
				pauseOnHover: {$pauseOnHover},
				controlNav: true,
				easing : "{$easing}",
				prevText: "",
				nextText: "",
				pauseText: '',
				playText: '',
				start: mk_complete,
				after: mk_complete

		});

	function mk_complete(args) {
			var caption = jQuery(args.container).find('.mk-flex-caption').attr('style', ''),
				thisCaption = jQuery('.mk-flexsldier-slideshow .mk-flex-slides > li.flex-active-slide').find('.mk-flex-caption');
				thisCaption.animate({top:20, opacity:1}, 500, 'easeOutQuint');
		}
	

	});
});

</script>
HTML;

	echo $output;
}










/* Homepage Tabbed Area */

function mk_tabbed_box() {
	wp_enqueue_script('jquery-tools');
	$tabs_titles = explode(",", theme_option( THEME_OPTIONS, 'homepage_tabs' ));
	$page_IDs = explode(",", theme_option( THEME_OPTIONS, 'homepage_tabs_page_id' ));
	

	$output = '';
	if($page_IDs['0'] != NULL) {
	$output = '<div class="homepage-tabbed-box mk-tabbed-box"><div class="inner-wrapper mk-grid row-fluid ">';
	$output .= '<ul class="tabbed-box-tabs">';
	foreach ($tabs_titles as $tabs) {
		$output .= '<li><a href="#">'.$tabs.'</a></li>';
	}
	$output .= '</ul>';

	$output .= '<div class="tabbed-box-panes">';

	foreach ($page_IDs as $id) {
		$get_page = &get_page($id);
		$content = $get_page->post_content;
		$output .= '<div class="tabbed-box-pane">';
		$output .= apply_filters( 'the_content', $content );
		$output .='</div>';
	}
	$output .= '<span class="clearboth"></span></div>';

	$output .= '</div></div>';
	}

	echo $output;
}




function mk_header_social() {
	if(theme_option( THEME_OPTIONS, 'disable_header_social_networks' ) == 'false') {
		return false;
	}
	$size = theme_option( THEME_OPTIONS, 'header_social_size' );
	$names = explode(",", theme_option( THEME_OPTIONS, 'header_social_networks_site' ));
	$urls = explode(",", theme_option( THEME_OPTIONS, 'header_social_networks_url' ));
	$output = '';
	if(strlen(implode('', $urls)) != 0) {
	$output = '<div id="mk-header-social">';
	$output .= '<ul>';
		foreach (array_combine($names, $urls) as $name => $url) {
			$output .= '<li><a href="'.$url.'" alt="Follow us in '.$name.'" title="Follow us in '.$name.'"><i class="mk-social-'.$name.' '.$size.'" ></i></a></li>';
		}
	$output .= '</ul>';

	$output .= '</div><div class="clearboth"></div>';
	}

	echo $output;

}

















function mk_google_maps($post_id = NULL) {
	global $post;
		if ( get_post_meta( $post_id, '_enable_page_gmap', true ) != 'true' ) {
			return false;
		}




			$id = rand( 100, 3000 );

			$latitude = get_post_meta( $post_id, '_page_gmap_latitude', true );
			$longitude = get_post_meta( $post_id, '_page_gmap_longitude', true );
			$zoom = get_post_meta( $post_id, '_page_gmap_zoom', true );
			$panControl = get_post_meta( $post_id, '_enable_panControl', true );
			$zoomControl = get_post_meta( $post_id, '_enable_zoomControl', true );
			$draggable = get_post_meta( $post_id, '_enable_draggable', true );
			$mapTypeControl = get_post_meta( $post_id, '_enable_mapTypeControl', true );
			$scaleControl = get_post_meta( $post_id, '_enable_scaleControl', true );
			$gmap_height = get_post_meta( $post_id, '_gmap_height', true );
			$scrollwheel = get_post_meta( $post_id, '_enable_scrollwheel', true );

			$gmap_disable_coloring = get_post_meta( $post_id, '_disable_coloring', true );
			$gmap_hue = get_post_meta( $post_id, '_gmap_hue', true );
			$gmap_gamma = get_post_meta( $post_id, '_gmap_gamma', true );
			$gmap_saturation = get_post_meta( $post_id, '_gmap_saturation', true );
			$gmap_lightness = get_post_meta( $post_id, '_gmap_lightness', true );


			if ( $zoom < 1 ) {
				$zoom = 1;
			}


?>

	<div id="gmap_page_<?php echo $id;?>" class="mk-header-gmap" style="height:<?php echo $gmap_height; ?>px; width:100%;"></div>
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
			<script type="text/javascript">
			jQuery(document).ready(function($) {
  var map;
var gmap_marker = <?php echo get_post_meta( $post_id, '_gmap_marker', true ); ?>;


  var myLatlng = new google.maps.LatLng(<?php echo $latitude;?>, <?php echo $longitude;?>)
      function initialize() {
        var mapOptions = {
          zoom: <?php echo $zoom;?>,
          center: myLatlng,
	      panControl: <?php echo empty( $panControl ) ? 'false' : $panControl;?>,
		  zoomControl: <?php echo empty( $zoomControl ) ? 'false' : $zoomControl?>,
		  mapTypeControl: <?php echo empty( $mapTypeControl ) ? 'false' :  $mapTypeControl;?>,
		  scaleControl: <?php echo empty( $scaleControl ) ? 'false' : $scaleControl;?>,
		  draggable : <?php echo empty( $draggable ) ? 'false' : $draggable;?>,
		  scrollwheel : <?php echo empty( $scrollwheel ) ? 'false' : $scrollwheel;?>,
	      mapTypeId: google.maps.MapTypeId.ROADMAP,
	      <?php if ( $gmap_disable_coloring == "true" ) { ?>
	      styles: [ { stylers: [
	      			 {hue: "<?php echo $gmap_hue; ?>"},
	      			 {saturation : <?php echo $gmap_saturation; ?> },
				     {lightness: <?php echo $gmap_lightness; ?> },
				     {gamma: <?php echo $gmap_gamma; ?> },
	      			 { featureType: "landscape.man_made", stylers: [ { visibility: "on" } ] }
	      		]
				} ]
		<?php } ?>
        };
        map = new google.maps.Map(document.getElementById('gmap_page_<?php echo $id;?>'), mapOptions);


if(gmap_marker == true) {
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map
        });
}

      }
 		google.maps.event.addDomListener(window, 'load', initialize);
			});
			</script>

			<div class="clearboth"></div>
	<?php


}




}

	function theme_class( $function ) {
		global $_theme_class;
		$_theme_class = new theme_class;
		$args   = array_slice( func_get_args(), 1 );
		return call_user_func_array( array(
				&$_theme_class,
				$function
			), $args );
	}



	
