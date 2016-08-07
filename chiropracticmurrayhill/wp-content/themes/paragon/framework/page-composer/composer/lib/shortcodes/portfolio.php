<?php

class WPBakeryShortCode_mk_portfolio extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'style' => 'grid',
				'column' => 5,
				'count'=> 10,
				'disable_excerpt' => 'false',
				'metro_grayscale' => 'true',
				"sortable" => 'true',
				'pagination' => 'true',
				'pagination_style' => '1',
				'height' => '',
				'cat' => '',
				'author' => '',
				'posts' => '',
				'offset' => 0,
				'order'=> 'DESC',
				'orderby'=> 'date',

			), $atts ) );


	global $wp_version;
	if ( is_front_page() && version_compare( $wp_version, "3.1", '>=' ) ) {
		$paged = ( get_query_var( 'paged' ) ) ?get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
	}else {
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	}

	$query = array(
		'post_type' => 'portfolio',
		'posts_per_page' => (int)$count,
		'paged' => $paged
	);
	if ( $offset ) {
		$query['offset'] = $offset;
	}
	if ( $cat != '' ) {
		global $wp_version;
		if ( version_compare( $wp_version, "3.1", '>=' ) ) {
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'portfolio_category',
					'field' => 'slug',
					'terms' => explode( ',', $cat )
				)
			);
		}else {
			$query['taxonomy'] = 'portfolio_category';
			$query['term'] = $cat;
		}
	}
	if ( $posts ) {
		$query['post__in'] = explode( ',', $posts );
	}
	if ( $orderby ) {
		$query['orderby'] = $orderby;
	}
	if ( $order ) {
		$query['order'] = $order;
	}

	$r = new WP_Query( $query );

	
	if ( is_page() ) {
			global $post;
			$layout = get_post_meta( $post->ID, '_layout', true );
		}
		else if ( is_home() ) {
				$layout = 'full';
		}
	$crop_images = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
	$retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;


	$atts = array(
		'column' => $column,
		'layout' => $layout,
		'height' => $height,
		'disable_excerpt' => $disable_excerpt,
		'metro_grayscale' => $metro_grayscale,
		'pagination' => $pagination,
		'retina_images' => $retina_images,
		'crop_images' => $crop_images
	);

	$paginaton_style_class = '';
	if ( $pagination_style == '2' ) {
		$paginaton_style_class = 'load-button-style';
		wp_enqueue_script( 'infinitescroll' );
	} 
	else if ( $pagination_style == '3' ) {
		$paginaton_style_class = 'scroll-load-style';
		wp_enqueue_script( 'infinitescroll' );
		} else {
		$paginaton_style_class = 'page-nav-style';
	}


	$id = mt_rand( 100, 999 );
	$output = '';
	if ( $sortable == 'true' ) {
		$output .= '<div class="clearboth"></div><header class="filter-portfolio"><ul>';
		$terms = array();
		if ( $cat != '' ) {
			foreach ( explode( ',', $cat ) as $term_slug ) {
				$terms[] = get_term_by( 'slug', $term_slug, 'portfolio_category' );
			}
		} else {
			$terms = get_terms( 'portfolio_category', 'hide_empty=1' );
		}
		foreach ( $terms as $term ) {
			$output .= '<li><a data-filter="' . '.'.$term->slug . '" href="#">' . $term->name . '</a></li>';
		}
	$output .= '<li><a class="current" data-filter="*" href="#">'.__( 'All', 'theme_frontend' ).'</a></li>';	
	$output .= '</ul></header><div class="clearboth"></div>';
	}	

	$output .= '<div class="clearboth"></div><section id="mk-portfolio-loop-'.$id.'" class="mk-portfolio-loop-container mk-theme-loop isotop-enabled mk-'.$style.'-wrapper '.$paginaton_style_class.' portfolio-layout-'.$layout.'" >' . "\n";


	switch ( $style ) {

	case 'newspaper' :
		$output .= portfolio_newspaper_style( $r, $atts, 1, $layout, $retina_images, $crop_images );
		break;

	case 'metro' :
		$output .= portfolio_metro_style( $r, $atts, 1, $layout, $retina_images, $crop_images );
		break;

	case 'grid' :
		$output .= portfolio_grid_style( $r, $atts, 1, $layout, $retina_images, $crop_images );
		break;

	default :
		$output .= portfolio_column_based_style( $r, $atts, 1, $layout, $retina_images, $crop_images );
	}
	$output .= '</section><div class="clearboth"></div>' . "\n\n";



	$output .= '<a class="mk-loadmore-button" href="#">LOAD MORE</a>';


	if ( $pagination == 'true' ) {
		ob_start();
		theme_blog_pagenavi( '', '', $r, $paged );
		$output .= ob_get_clean();
	}
	wp_reset_postdata();

	return $output;
}
}








/*
* Portfolio Newspaper Style
*/
function portfolio_newspaper_style( &$r, $atts, $current) {
	global $post;
	extract( $atts );
	wp_enqueue_script( 'jquery-isotope' );


	if($column > 4) {
		$column = 4;
	}

	switch ( $column ) {
	case 1:
		if($layout == 'full') {
			$container_width = theme_option( THEME_OPTIONS, 'container_width' );
			$width = !empty($container_width) ?  $container_width : '1100';
		} else {
			$width = 770;
		}
		$column_css = 'portfolio-one-column';
		break;
	case 2:
		if($layout == 'full') {
			$width = 528;
		} else {
			$width = 500;
		}
		$column_css = 'portfolio-two-column';
		break;
	case 3:
		$width = 500;
		$column_css = 'portfolio-three-column';
		break;

	case 4:
		$width = 500;
		$column_css = 'portfolio-four-column';
		break;	
	
	}

	if ( $layout == 'full' ) {
		$layout_class = 'portfolio-full-layout';
	} else {
		$layout_class = 'portfolio-with-sidebar';
	}

	


	$output = '';
	$i = 0;
	if ( $r->have_posts() ):
		while ( $r->have_posts() ) :
			$r->the_post();
	$i++;


	$terms = get_the_terms( get_the_id(), 'portfolio_category' );
	$terms_slug = array();
	$terms_name = array();
	if ( is_array( $terms ) ) {
		foreach ( $terms as $term ) {
			$terms_slug[] = $term->slug;
			$terms_name[] = $term->name;
		}
	}

	$height = get_post_meta( $post->ID, '_post_newspaper_image_height', true );
	$height = !empty($height) ? $height : 600;

	$post_type = get_post_meta( $post->ID, '_single_post_type', true );
	$post_type = !empty($post_type) ? $post_type : 'image';


	$output .='<article id="'.get_the_ID().'" class="mk-portfolio-newspaper-item mk-portfolio-isotop '.$column_css.' '.$layout_class.' portfolio-newspaper-'.$post_type.' ' . implode( ' ', $terms_slug ) . '">';



	// Image post type
	if ( $post_type == 'image' || $post_type == '' ) {

		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		$image_src  = theme_image_resize( $image_src_array[ 0 ], $width, $height , $crop_images, $retina_images );

		$output .='<div class="featured-image">';
		$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src($image_src['url']).'"  />';
		$output .='<div class="image-hover-overlay"></div>';

		$output .='<div class="portfolio-newspaper-meta-wrapper">';
		$output .='<a rel="portfolio-lightbox-group" title="'.get_the_title().'" class="zoom-badge mk-lightbox" href="'.$image_src_array[ 0 ].'"><i class="mk-icon-lightbox-expand"></i></a>';
		$output .='<a class="permalink-badge" href="'.get_permalink().'"><i class="mk-icon-container-permalink"></i></a>';
		$output .='<a class="post-type-badge image-icon" href="'.get_permalink().'"><i class="mk-icon-posttype-image"></i></a>';
		$output .= '<div class="time-cats-wrapper">';
		$output .='<div class="categories"><i class="mk-icon-play"></i> in '. implode( ' ', $terms_name ) .' </div>';
		$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
		$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
		$output .='</time>';
		$output .='<div class="clearboth"></div></div>';
		$output .='<div class="the-title highlight"><span><a href="'.get_permalink().'">'.get_the_title().'</a></span></div><div class="clearboth"></div>';
		if($disable_excerpt == 'true') {
		$output .='<div class="the-excerpt"><div class="excerpt-overlay"></div><div class="excerpt-content">'.get_the_excerpt().'</div></div>';
		}
		$output .='</div>';
		$output .='</div>';
	} 


	// Audio post type
	if ( $post_type == 'audio') {
		wp_enqueue_script( 'jquery-jplayer' );
		$audio_id = mt_rand( 99, 999 );
		$mp3_file  = get_post_meta( $post->ID, '_mp3_file', true );
		$ogg_file  = get_post_meta( $post->ID, '_ogg_file', true );
		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		$image_src  = theme_image_resize( $image_src_array[ 0 ], $width, $height , $crop_images, $retina_images );

		$output .='<div class="featured-image">';
		if ( has_post_thumbnail() ) {
			$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" />';
		}

		$output .='<div data-mp3='.$mp3_file.' data-ogg="'.$ogg_file.'" id="jquery_jplayer_'.$audio_id.'" class="jp-jplayer mk-blog-audio"></div>
			<div id="jp_container_'.$audio_id.'" class="jp-audio visuallyhidden">
			<div class="jp-type-single">
				<div class="jp-gui jp-interface">
					<div class="jp-time-holder">
						<div class="jp-current-time"></div>
						<div class="jp-duration"></div>
					</div>
					<ul class="jp-controls">
						<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
						<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
					</ul>
					<div class="jp-progress">
						<div class="jp-seek-bar">
							<div class="jp-play-bar"></div>
						</div>
					</div>
					<div class="jp-volume-bar">
						<div class="inner-value-adjust"><div class="jp-volume-bar-value"></div></div>
					</div>
				</div>
				<div class="jp-no-solution">
					<span>Update Required</span>
					To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
				</div>
			</div>
		</div>';

		
		$output .='<div class="image-hover-overlay"></div>';
		$output .='<a class="audio-play-icon" href="#"></a>';
		$output .='<div class="portfolio-newspaper-meta-wrapper">';
		$output .='<a class="permalink-badge" href="'.get_permalink().'"><i class="mk-icon-container-permalink"></i></a>';
		$output .= '<div class="time-cats-wrapper">';
		$output .='<div class="categories"><i class="mk-icon-play"></i> In '. implode( ' ', $terms_name ) .' </div>';
		$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
		$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
		$output .='</time>';
		$output .='</div>';
		$output .='</div>';
		$output .='<div class="clearboth"></div></div>';

		$output .='<div class="the-title highlight"><span><a href="'.get_permalink().'">'.get_the_title().'</a></span></div><div class="clearboth"></div>';
		if($disable_excerpt == 'true') {
		$output .='<div class="the-excerpt"><div class="excerpt-overlay"></div><div class="excerpt-content">'.get_the_excerpt().'</div></div>';
		}	
	} 

	// Audio post type
	if ( $post_type == 'video') {
		wp_enqueue_script( 'jquery-jplayer' );
		$video_id = get_post_meta( $post->ID, '_single_video_id', true );
		$video_site  = get_post_meta( $post->ID, '_single_video_site', true );
		$disable_video_lightbox  = get_post_meta( $post->ID, '_disable_video_lightbox', true );
		$video_lightbox_class = 'mk-lightbox-video';

		$video_url = '';
			// Vimeo Video post type
			if ( $video_site =='vimeo' ) {
				$video_url = 'http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0';
			// Youtube Video post type
			} elseif ( $video_site =='youtube' ) {
				$video_url = 'http://www.youtube.com/embed/'.$video_id.'?showinfo=0&amp;theme=light&amp;color=white';

			// dailymotion Video post type
			} elseif ( $video_site =='dailymotion' ) {
				$video_url = 'http://www.dailymotion.com/embed/video/'.$video_id.'?logo=0';
			}
		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		$image_src  = theme_image_resize( $image_src_array[ 0 ], $width, $height , $crop_images, $retina_images );


		if ( $disable_video_lightbox == 'false' ) {
				$video_url = get_permalink();
				$video_lightbox_class = '';
			}

		$output .='<div class="featured-image">';
		if ( has_post_thumbnail() ) {
			$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" />';
		}

		$output .='<div class="image-hover-overlay"></div>';
		$output .='<a rel="portfolio-lightbox-group" class="video-play-icon '.$video_lightbox_class.'" title="'.get_the_title().'" href="'.$video_url.'"></a>';
		$output .='<div class="portfolio-newspaper-meta-wrapper">';
		$output .='<a class="permalink-badge" href="'.get_permalink().'"><i class="mk-icon-container-permalink"></i></a>';
		$output .= '<div class="time-cats-wrapper">';
		$output .='<div class="categories"><i class="mk-icon-play"></i> In '. implode( ' ', $terms_name ) .' </div>';
		$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
		$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
		$output .='</time>';
		$output .='</div>';
		$output .='</div>';
		$output .='<div class="clearboth"></div></div>';

		$output .='<div class="the-title highlight"><span><a href="'.get_permalink().'">'.get_the_title(). '</a></span></div><div class="clearboth"></div>';
		if($disable_excerpt == 'true') {
		$output .='<div class="the-excerpt"><div class="excerpt-overlay"></div><div class="excerpt-content">'.get_the_excerpt().'</div></div>';
		}
	} 



	$output .='</article>' . "\n\n\n";


	

	endwhile;
	endif;

	return $output;

}
/*******************************************/













/*
* Portfolio Newspaper Style
*/
function portfolio_grid_style( &$r, $atts, $current) {
	global $post;
	extract( $atts );
	wp_enqueue_script( 'jquery-isotope' );


	if($column > 4) {
		$column = 4;
	}

	switch ( $column ) {
	case 1:
		if($layout == 'full') {
			$container_width = theme_option( THEME_OPTIONS, 'container_width' );
			$width = !empty($container_width) ?  $container_width : '1100';
			$height = !empty($height) ? $height : 450;
		} else {
			$width = 770;
			$height = !empty($height) ? $height : 350;
		}
		$column_css = 'portfolio-one-column';
		break;
	case 2:
		if($layout == 'full') {
			$width = 528;
			$height = !empty($height) ? $height : 528;
		} else {
			$width = 500;
			$height = !empty($height) ? $height : 500;
		}
		$column_css = 'portfolio-two-column';
		break;
	case 3:
		$width = 500;
		$height = !empty($height) ? $height : 500;
		$column_css = 'portfolio-three-column';
		break;

	case 4:
		$width = 500;
		$height = !empty($height) ? $height : 500;
		$column_css = 'portfolio-four-column';
		break;	
}
	if ( $layout == 'full' ) {
		$layout_class = 'portfolio-full-layout';
	} else {
		$layout_class = 'portfolio-with-sidebar';
	}

	


	$output = '';
	$i = 0;
	if ( $r->have_posts() ):
		while ( $r->have_posts() ) :
			$r->the_post();
	$i++;


	$terms = get_the_terms( get_the_id(), 'portfolio_category' );
	$terms_slug = array();
	$terms_name = array();
	if ( is_array( $terms ) ) {
		foreach ( $terms as $term ) {
			$terms_slug[] = $term->slug;
			$terms_name[] = $term->name;
		}
	}

	

	$post_type = get_post_meta( $post->ID, '_single_post_type', true );
	$post_type = !empty($post_type) ? $post_type : 'image';


	$output .='<article id="'.get_the_ID().'" class="mk-portfolio-grid-item mk-portfolio-isotop '.$column_css.' '.$layout_class.' portfolio-grid-'.$post_type.' ' . implode( ' ', $terms_slug ) . '">';



	// Image post type
	if ( $post_type == 'image' || $post_type == '' ) {

		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		$image_src  = theme_image_resize( $image_src_array[ 0 ], $width, $height , $crop_images, $retina_images );

		$output .='<div class="featured-image">';
		$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src($image_src['url']).'"  />';
		$output .='<div class="image-hover-overlay"></div>';
		$output .='<div class="the-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div><div class="clearboth"></div>';
		
		$output .='<div class="portfolio-grid-meta-wrapper">';
		$output .='<a rel="portfolio-lightbox-group" title="'.get_the_title().'" class="zoom-badge mk-lightbox" href="'.$image_src_array[ 0 ].'"><i class="mk-icon-lightbox-expand"></i></a>';
		$output .='<a class="permalink-badge" href="'.get_permalink().'"><i class="mk-icon-container-permalink"></i></a>';
		$output .='<a class="post-type-badge image-icon" href="'.get_permalink().'"><i class="mk-icon-posttype-image"></i></a>';
		$output .= '<div class="time-cats-wrapper">';
		$output .='<div class="categories"><i class="mk-icon-play"></i> In '. implode( ' ', $terms_name ) .' </div>';
		$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
		$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
		$output .='</time>';
		$output .='</div>';
		$output .='</div>';
		
		$output .='</div>';
	} 


	// Audio post type
	if ( $post_type == 'audio') {
		wp_enqueue_script( 'jquery-jplayer' );
		$audio_id = mt_rand( 99, 999 );
		$mp3_file  = get_post_meta( $post->ID, '_mp3_file', true );
		$ogg_file  = get_post_meta( $post->ID, '_ogg_file', true );
		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		$image_src  = theme_image_resize( $image_src_array[ 0 ], $width, $height , $crop_images, $retina_images );

		$output .='<div class="featured-image">';
		if ( has_post_thumbnail() ) {
			$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" />';
		}

		$output .='<div data-mp3='.$mp3_file.' data-ogg="'.$ogg_file.'" id="jquery_jplayer_'.$audio_id.'" class="jp-jplayer mk-blog-audio"></div>
			<div id="jp_container_'.$audio_id.'" class="jp-audio visuallyhidden">
			<div class="jp-type-single">
				<div class="jp-gui jp-interface">
					<div class="jp-time-holder">
						<div class="jp-current-time"></div>
						<div class="jp-duration"></div>
					</div>
					<ul class="jp-controls">
						<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
						<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
					</ul>
					<div class="jp-progress">
						<div class="jp-seek-bar">
							<div class="jp-play-bar"></div>
						</div>
					</div>
					<div class="jp-volume-bar">
						<div class="inner-value-adjust"><div class="jp-volume-bar-value"></div></div>
					</div>
				</div>
				<div class="jp-no-solution">
					<span>Update Required</span>
					To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
				</div>
			</div>
		</div>';

		
		$output .='<div class="image-hover-overlay"></div>';
		$output .='<div class="the-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div><div class="clearboth"></div>';
		$output .='<a class="audio-play-icon" href="#"></a>';
		$output .='<div class="portfolio-grid-meta-wrapper">';
		$output .='<a class="permalink-badge" href="'.get_permalink().'"><i class="mk-icon-container-permalink"></i></a>';
		$output .= '<div class="time-cats-wrapper">';
		$output .='<div class="categories"><i class="mk-icon-play"></i> In '. implode( ' ', $terms_name ) .' </div>';
		$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
		$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
		$output .='</time>';
		$output .='</div>';
		$output .='</div>';
		$output .='<div class="clearboth"></div></div>';
		
	} 

	// Audio post type
	if ( $post_type == 'video') {
		wp_enqueue_script( 'jquery-jplayer' );
		$video_id = get_post_meta( $post->ID, '_single_video_id', true );
		$video_site  = get_post_meta( $post->ID, '_single_video_site', true );
		$disable_video_lightbox  = get_post_meta( $post->ID, '_disable_video_lightbox', true );
		$video_lightbox_class = 'mk-lightbox-video';

		$video_url = '';
			// Vimeo Video post type
			if ( $video_site =='vimeo' ) {
				$video_url = 'http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0';
			// Youtube Video post type
			} elseif ( $video_site =='youtube' ) {
				$video_url = 'http://www.youtube.com/embed/'.$video_id.'?showinfo=0&amp;theme=light&amp;color=white';

			// dailymotion Video post type
			} elseif ( $video_site =='dailymotion' ) {
				$video_url = 'http://www.dailymotion.com/embed/video/'.$video_id.'?logo=0';
			}
		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		$image_src  = theme_image_resize( $image_src_array[ 0 ], $width, $height , $crop_images, $retina_images );
		if ( $disable_video_lightbox == 'false' ) {
				$video_url = get_permalink();
				$video_lightbox_class = '';
			}

		$output .='<div class="featured-image">';
		if ( has_post_thumbnail() ) {
			$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" />';
		}

		$output .='<div class="image-hover-overlay"></div>';
		$output .='<div class="the-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div><div class="clearboth"></div>';
		$output .='<a rel="portfolio-lightbox-group" class="video-play-icon '.$video_lightbox_class.'" title="'.get_the_title().'" href="'.$video_url.'"></a>';
		$output .='<div class="portfolio-grid-meta-wrapper">';
		$output .='<a class="permalink-badge" href="'.get_permalink().'"><i class="mk-icon-container-permalink"></i></a>';
		$output .= '<div class="time-cats-wrapper">';
		$output .='<div class="categories"><i class="mk-icon-play"></i> In '. implode( ' ', $terms_name ) .' </div>';
		$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
		$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
		$output .='</time>';
		$output .='</div>';
		$output .='</div>';
		$output .='</div>';

		
		
	} 



	$output .='</article>' . "\n\n\n";


	

	endwhile;
	endif;

	return $output;

}
/*******************************************/























/*
* Portfolio Newspaper Style
*/
function portfolio_metro_style( &$r, $atts, $current) {
	global $post;
	extract( $atts );
	wp_enqueue_script( 'jquery-isotope' );



	if ( $layout == 'full' ) {
		$layout_class = 'portfolio-metro-full-layout';
	} else {
		$layout_class = 'portfolio-metro-with-sidebar';
	}


	$output = '';
	$i = 0;
	if ( $r->have_posts() ):
		while ( $r->have_posts() ) :
			$r->the_post();
	$i++;


	$terms = get_the_terms( get_the_id(), 'portfolio_category' );
	$terms_slug = array();
	$terms_name = array();
	if ( is_array( $terms ) ) {
		foreach ( $terms as $term ) {
			$terms_slug[] = $term->slug;
			$terms_name[] = $term->name;
		}
	}

	$height = get_post_meta( $post->ID, '_post_newspaper_image_height', true );
	$height = !empty($height) ? $height : 600;

	$post_type = get_post_meta( $post->ID, '_single_post_type', true );
	$post_type = !empty($post_type) ? $post_type : 'image';
	$height = 320;
	$width = 640;

	if($metro_grayscale == 'true') {
		$metro_grayscale_css = 'metro-grascale-enabled';
	} else {
		$metro_grayscale_css = '';
	}

	$output .= '<article id="'.get_the_ID().'" class="mk-portfolio-metro-item mk-portfolio-isotop '.$metro_grayscale_css.' '.$layout_class.' portfolio-metro-'.$post_type.' ' . implode( ' ', $terms_slug ) . '">';



	// Image post type
	if ( $post_type == 'image' || $post_type == '' ) {

		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		$image_src  = theme_image_resize( $image_src_array[ 0 ], $width, $height , $crop_images, $retina_images );

		$output .='<div class="featured-image">';
		$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src($image_src['url']).'"  />';
		$output .='<div class="image-hover-overlay"></div>';
		$output .='<div class="metro-pattern-overlay"></div>';
		$output .='<div class="the-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div><div class="clearboth"></div>';
		$output .='<div class="portfolio-metro-meta-wrapper">';
		$output .='<a class="post-type-badge image-icon" href="'.get_permalink().'"><i class="mk-icon-posttype-image"></i></a>';
		$output .= '<div class="time-cats-wrapper">';
		$output .='<div class="categories"><i class="mk-icon-play"></i> In '. implode( ' ', $terms_name ) .' </div>';
		$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
		$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
		$output .='</time>';
		$output .='<div class="clearboth"></div></div>';
		
		$output .='</div>';
		$output .='</div>';
	} 


	// Audio post type
	if ( $post_type == 'audio') {
		wp_enqueue_script( 'jquery-jplayer' );
		$audio_id = mt_rand( 99, 999 );
		$mp3_file  = get_post_meta( $post->ID, '_mp3_file', true );
		$ogg_file  = get_post_meta( $post->ID, '_ogg_file', true );
		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		$image_src  = theme_image_resize( $image_src_array[ 0 ], $width, $height , $crop_images, $retina_images );

		$output .='<div class="featured-image">';
		if ( has_post_thumbnail() ) {
			$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" />';
		}

		$output .='<div data-mp3='.$mp3_file.' data-ogg="'.$ogg_file.'" id="jquery_jplayer_'.$audio_id.'" class="jp-jplayer mk-blog-audio"></div>
			<div id="jp_container_'.$audio_id.'" class="jp-audio visuallyhidden">
			<div class="jp-type-single">
				<div class="jp-gui jp-interface">
					<div class="jp-time-holder">
						<div class="jp-current-time"></div>
						<div class="jp-duration"></div>
					</div>
					<ul class="jp-controls">
						<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
						<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
					</ul>
					<div class="jp-progress">
						<div class="jp-seek-bar">
							<div class="jp-play-bar"></div>
						</div>
					</div>
					<div class="jp-volume-bar">
						<div class="inner-value-adjust"><div class="jp-volume-bar-value"></div></div>
					</div>
				</div>
				<div class="jp-no-solution">
					<span>Update Required</span>
					To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
				</div>
			</div>
		</div>';

		
		$output .='<div class="image-hover-overlay"></div>';
		$output .='<div class="metro-pattern-overlay"></div>';
		$output .='<div class="the-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div><div class="clearboth"></div>';
		$output .='<a class="audio-play-icon" href="#"></a>';
		$output .='<div class="portfolio-metro-meta-wrapper">';
		$output .= '<div class="time-cats-wrapper">';
		$output .='<div class="categories"><i class="mk-icon-play"></i> In '. implode( ' ', $terms_name ) .' </div>';
		$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
		$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
		$output .='</time>';
		$output .='</div>';
		$output .='</div>';
		$output .='<div class="clearboth"></div></div>';
		
	} 

	// Audio post type
	if ( $post_type == 'video') {
		wp_enqueue_script( 'jquery-jplayer' );
		$video_id = get_post_meta( $post->ID, '_single_video_id', true );
		$video_site  = get_post_meta( $post->ID, '_single_video_site', true );
		$disable_video_lightbox  = get_post_meta( $post->ID, '_disable_video_lightbox', true );
		$video_lightbox_class = 'mk-lightbox-video';

		$video_url = '';
			// Vimeo Video post type
			if ( $video_site =='vimeo' ) {
				$video_url = 'http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0';
			// Youtube Video post type
			} elseif ( $video_site =='youtube' ) {
				$video_url = 'http://www.youtube.com/embed/'.$video_id.'?showinfo=0&amp;theme=light&amp;color=white';

			// dailymotion Video post type
			} elseif ( $video_site =='dailymotion' ) {
				$video_url = 'http://www.dailymotion.com/embed/video/'.$video_id.'?logo=0';
			}
		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		$image_src  = theme_image_resize( $image_src_array[ 0 ], $width, $height , $crop_images, $retina_images );

		if ( $disable_video_lightbox == 'false' ) {
				$video_url = get_permalink();
				$video_lightbox_class = '';
			}

		$output .='<div class="featured-image">';
		if ( has_post_thumbnail() ) {
			$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" />';
		}

		$output .= '<div class="image-hover-overlay"></div>';
		$output .='<div class="metro-pattern-overlay"></div>';
		$output .='<div class="the-title"><a href="'.get_permalink().'">'.get_the_title(). '</a></div><div class="clearboth"></div>';
		$output .='<a rel="portfolio-lightbox-group" class="video-play-icon '.$video_lightbox_class.'" title="'.get_the_title().'" href="'.$video_url.'"></a><div class="clearboth"></div>';
		$output .='<div class="portfolio-metro-meta-wrapper">';
		$output .= '<div class="time-cats-wrapper">';
		$output .='<div class="categories"><i class="mk-icon-play"></i> In '. implode( ' ', $terms_name ) .' </div>';
		$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
		$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
		$output .='</time>';
		$output .='</div>';
		$output .='</div>';
		$output .='<div class="clearboth"></div></div>';

		$output .='<div class="the-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div><div class="clearboth"></div>';
		
	} 



	$output .='</article>' . "\n\n\n";


	

	endwhile;
	endif;

	return $output;

}
/*******************************************/



