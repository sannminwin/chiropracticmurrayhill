<?php




class WPBakeryShortCode_mk_blog extends WPBakeryShortCode {
	protected function content( $atts, $content = null ) {
		extract( shortcode_atts( array(
					'style' => 'metro',
					'column' => 1,
					'count' => 8,
					'offset' => 0,
					'cat' => '',
					'posts' => '',
					'author' => '',
					'image_height' => '300',
					'pagination' => 'true',
					'pagination_style' => '2', // 1(pagination), 2(button load), 3(scroll load)
					'orderby'=> 'date',
					'order'=> 'DESC',


				), $atts ) );

		$query = array(
			'posts_per_page' => (int)$count,
			'post_type'=>'post',
		);
		if ( $offset ) {
			$query['offset'] = $offset;
		}
		if ( $cat ) {
			$query['cat'] = $cat;
		}
		if ( $author ) {
			$query['author'] = $author;
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

		global $wp_version;
		if ( ( is_front_page() || is_home() ) && version_compare( $wp_version, "3.1", '>=' ) ) {//fix wordpress 3.1 paged query
			$paged = ( get_query_var( 'paged' ) ) ?get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
		}else {
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		}
		$query['paged'] = $paged;

		$r = new WP_Query( $query );


		if ( is_page() ) {
			global $post;
			$layout = get_post_meta( $post->ID, '_layout', true );
		}
		else if ( is_search() ) {
				$layout = theme_option( THEME_OPTIONS, 'search_page_layout' );
			}
		else if ( is_archive() ) {
				$layout = theme_option( THEME_OPTIONS, 'archive_page_layout' );
			}
		else if ( is_home() ) {
				$layout = 'full';
			}	

		$crop_images = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
		$retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;


		switch ( $column ) {
		case 1:
			$column_class = 'blog-one-column';
			break;
		case 2:
			$column_class = 'blog-two-column';
			break;
		case 3:
			$column_class = 'blog-three-column';
			break;
		case 4:
			$column_class = 'blog-four-column';
		}


		$atts = array(
			'column' => $column,
			'image_height' => $image_height,
			'layout' => $layout,
			'retina_images'=> $retina_images,
			'crop_images' => $crop_images,
		);







		wp_enqueue_script( 'jquery-jplayer' );
		wp_enqueue_script( 'jquery-isotope' );

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

		$output = '<div class="clearboth"></div><section id="mk-blog-loop-section-'.$id.'" class="mk-blog-loop-container mk-theme-loop isotop-enabled mk-'.$style.'-wrapper '.$paginaton_style_class.' '.$column_class.'" >' . "\n";

		if ( is_archive() || is_search() ) :
			if ( have_posts() ):
				while ( have_posts() ) :
					the_post();

				switch ( $style ) {

				case 'classic' :
					$output .= blog_classic_style( $atts, 1 );
					break;

				case 'newspaper' :
					$output .= blog_newspaper_style( $atts, 1 );
					break;

				case 'metro' :
					$output .= blog_metro_style( $atts, 1 );
					break;

				default :
					$output .= blog_classic_style( $atts, 1 );
				}
			endwhile;
		endif;
		else :

			if ( $r->have_posts() ):
				while ( $r->have_posts() ) :
					$r->the_post();

				switch ( $style ) {

				case 'classic' :
					$output .= blog_classic_style( $atts, 1 );
					break;

				case 'newspaper' :
					$output .= blog_newspaper_style( $atts, 1 );
					break;

				case 'metro' :
					$output .= blog_metro_style( $atts, 1 );
					break;

				default :
					$output .= blog_classic_style( $atts, 1 );
				}
			endwhile;
		endif;
		endif;


		$output .= '</section><div class="clearboth"></div>' . "\n\n";



		$output .= '<a class="mk-loadmore-button" href="#">LOAD MORE</a>';

		if ( $pagination == 'true'  ) {
			ob_start();
			theme_blog_pagenavi( '', '', $r, $paged );
			$output .= ob_get_clean();
		}
		wp_reset_postdata();

		return $output;
	}
}






/*
* Blog Classic Style
*/
function blog_classic_style( $atts, $current ) {
	global $post;
	extract( $atts );


	switch ( $column ) {
	case 1:
		$column_class = 'blog-item-1-1';
		$apis_image_dimension = 240;
		if ( $layout=='full' ) {
			$container_width = theme_option( THEME_OPTIONS, 'container_width' );
			$image_width = !empty($container_width) ?  $container_width : '1100';
		}else {
			$image_width = '760';
		}
		break;
	case 2:
		$column_class = 'blog-item-1-2';
		$apis_image_dimension = 240;
		if ( $layout=='full' ) {
			$image_width = '540';
		}else {
			$image_width = '370';
		}
		break;
	case 3:
		$column_class = 'blog-item-1-3';
		$apis_image_dimension = 180;
		if ( $layout=='full' ) {
			$image_width = '357';
		}else {
			$image_width = '246';
		}
		break;
	case 4:
		$column_class = 'blog-item-1-4';
		$apis_image_dimension = 120;
	default:
		if ( $layout=='full' ) {
			$image_width = '245';
		}else {
			$image_width = '223';
		}
	}

	$output = '';

	$empty_thumb = THEME_IMAGES . '/empty-thumb.png';

	$post_type = get_post_meta( $post->ID, '_single_post_type', true );
	$post_type = !empty($post_type) ? $post_type : 'image';


		$output .='<article id="'.get_the_ID().'" class="mk-blog-classic-item '.$post_type.'-post-type '.$column_class.'">' . "\n";
		$output .='<time datetime="'.get_the_time( 'F, j' ).'">';
		$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'F, j' ).'</a>';
		$output .='</time>';
		$output .='<div class="clearboth"></div>';

		$output .='<div class="the-title highlight"><span><a href="'.get_permalink().'">'.get_the_title().'</a></span></div>';
		$output .='<div class="clearboth"></div>';

		$output .='<div class="categories"><span>In '.get_the_category_list( ', ' ).'</span></div>';
		$output .='<div class="clearboth"></div>';







		// Image post type
		if ( $post_type == 'image' || $post_type == '' ) {
			$output .='<div class="featured-image">';
			if ( has_post_thumbnail() ) {
			$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
			$image_src  = theme_image_resize( $image_src_array[ 0 ], $image_width, $image_height , $crop_images, $retina_images );
			}else {
				$image_src_array[ 0 ] =  $empty_thumb;
				$image_src  = theme_image_resize( $empty_thumb, $image_width, $image_height  , $crop_images, $retina_images );
			}
			$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" />';
			$output .='<div class="image-hover-overlay"></div>';
			$output .='<a class="post-type-badge image-icon" href="'.get_permalink().'"><i class="mk-icon-posttype-image"></i></a>';
			$output .='<a class="permalink-badge" href="'.get_permalink().'"><i class="mk-icon-container-permalink"></i></a>';
			$output .='<a rel="blog-lightbox-group" title="'.get_the_title().'" class="zoom-badge mk-lightbox" href="'.$image_src_array[ 0 ].'"><i class="mk-icon-lightbox-expand"></i></a>';
			$output .='</div><div class="clearboth"></div>';
			$output .='<div class="the-excerpt">'.get_the_excerpt().'</div>';
		}








		// Document Post type
		if ( $post_type == 'document' ) {
			$output .='<div class="doc-post-type-icons">';
			$output .='<a class="post-type-badge doc-icon" href="'.get_permalink().'"><i class="mk-icon-posttype-document"></i></a>';
			$output .='<a class="permalink-badge" href="'.get_permalink().'"><i class="mk-icon-container-permalink"></i></a>';
			$output .='</div>';
			$output .='<div class="the-excerpt">'.get_the_excerpt().'</div>';
		}






		if ( $post_type == 'video' ) {

			$video_id = get_post_meta( $post->ID, '_single_video_id', true );
			$video_site  = get_post_meta( $post->ID, '_single_video_site', true );

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

			$output .='<div class="featured-image">';

			if ( has_post_thumbnail() ) {
			$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
			$image_src  = theme_image_resize( $image_src_array[ 0 ], $image_width, $image_height , $crop_images, $retina_images );
			}else {
				$image_src  = theme_image_resize( $empty_thumb, $image_width, $image_height  , $crop_images, $retina_images );
			}
			$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" />';
			$output .='<div class="image-hover-overlay"></div>';
			$output .='<a rel="blog-lightbox-group" class="video-play-icon mk-lightbox-video" title="'.get_the_title().'" href="'.$video_url.'"></a>';
			$output .='<a class="post-type-badge video-icon" title="'.get_the_title().'" href="'.get_permalink().'"><i class="mk-icon-posttype-video"></i></a>';
			$output .='<a class="permalink-badge" href="'.get_permalink().'"><i class="mk-icon-container-permalink"></i></a>';
			$output .='<a rel="blog-lightbox-group" title="'.get_the_title().'" alt="'.get_the_title().'" class="zoom-badge mk-lightbox-video" href="'.$video_url.'"><i class="mk-icon-lightbox-expand"></i></a>';
			$output .='</div><div class="clearboth"></div>';
			$output .='<div class="the-excerpt">'.get_the_excerpt().'</div>';


		}







		if ( $post_type == 'audio' ) {
			$output .='<div class="featured-image">';
			$audio_id = mt_rand( 99, 999 );
			$mp3_file  = get_post_meta( $post->ID, '_mp3_file', true );
			$ogg_file  = get_post_meta( $post->ID, '_ogg_file', true );

			if ( has_post_thumbnail() ) {
			$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
			$image_src  = theme_image_resize( $image_src_array[ 0 ], $image_width, $image_height , $crop_images, $retina_images );
			}else {
				$image_src  = theme_image_resize( $empty_thumb, $image_width, $image_height  , $crop_images, $retina_images );
			}
			
			$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" />';

			$output .='<div class="image-hover-overlay"></div>

		<div data-mp3='.$mp3_file.' data-ogg="'.$ogg_file.'" id="jquery_jplayer_'.$audio_id.'" class="jp-jplayer mk-blog-audio"></div>
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

			$output .='<a class="audio-play-icon" href="#"></a>';
			$output .='<a class="permalink-badge" href="'.get_permalink().'"><i class="mk-icon-container-permalink"></i></a>';
			$output .='</div><div class="clearboth"></div>';
			$output .='<div class="the-excerpt">'.get_the_excerpt().'</div>';

		}

		// Portfolio post type
		if ( $post_type == 'portfolio' ) {
			$output .='<div class="portfolio-outer-wrapper">';
			$output .='<div class="featured-image">';


			if ( has_post_thumbnail() ) {
			$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
			$image_src  = theme_image_resize( $image_src_array[ 0 ], $image_width, $image_height , $crop_images, $retina_images );
			}else {
				$image_src_array[ 0 ] =  $empty_thumb;
				$image_src  = theme_image_resize( $empty_thumb, $image_width, $image_height  , $crop_images, $retina_images );
			}
			$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" />';
			$output .='<div class="image-hover-overlay"></div>';

			$output .='<a class="post-type-badge portfolio-icon" href="'.get_permalink().'"><i class="mk-icon-posttype-portfolio"></i></a>';
			$output .='<a class="permalink-badge" href="'.get_permalink().'"><i class="mk-icon-container-permalink"></i></a>';
			$output .='<a rel="blog-lightbox-group" title="'.get_the_title().'" class="zoom-badge mk-lightbox" href="'.$image_src_array[ 0 ].'"><i class="mk-icon-lightbox-expand"></i></a>';
			$output .='</div><div class="clearboth"></div><div class="the-excerpt">'.get_the_excerpt().'</div>';
			$output .='<div class="clearboth"></div></div>';
		}

		$output .='</article>' . "\n\n\n";



	return $output;

}
/*******************************************/

















/*
* Blog Newspaper Style
*/
function blog_newspaper_style($atts, $current ) {
	global $post;
	extract( $atts );

	if($column > 4) {
		$column = 4;
	}

	switch ( $column ) {
	case 1:
		if($layout == 'full') {
			$container_width = theme_option( THEME_OPTIONS, 'container_width' );
			$image_width = !empty($container_width) ?  $container_width : '1100';
		} else {
			$image_width = 770;
		}
		$column_css = 'newspaper-one-column';
		break;
	case 2:
		if($layout == 'full') {
			$image_width = 528;
		} else {
			$image_width = 540;
		}
		$column_css = 'newspaper-two-column';
		break;
	case 3:
		$image_width = 540;
		$column_css = 'newspaper-three-column';
		break;

	case 4:
		$image_width = 540;
		$column_css = 'newspaper-four-column';
		break;	
	
	}


	if ( $layout == 'full' ) {
		$layout_class = 'newspaper-full-layout';
	} else {
		$layout_class = 'newspaper-with-sidebar';
	}


	$empty_thumb = THEME_IMAGES . '/empty-thumb.png';

	$output = '';
	$image_height = get_post_meta( $post->ID, '_post_newspaper_image_height', true );
	$image_height = !empty( $image_height ) ? $image_height : 600;

	$post_type = get_post_meta( $post->ID, '_single_post_type', true );
	$post_type = !empty($post_type) ? $post_type : 'image';
	$title_position = get_post_meta( $post->ID, '_newspaper_title_position', true );
	$title_position = !empty($title_position) ? $title_position : 'top';


	if ( $post_type == 'portfolio' ) {
		$output .='<article id="'.get_the_ID().'" class="mk-blog-newspaper-item '.$column_css.' '.$layout_class.' newspaper-'.$post_type.'">';
		if ( has_post_thumbnail() ) {
		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		$image_src  = theme_image_resize( $image_src_array[ 0 ], $image_width, $image_height , $crop_images, $retina_images );
		}else {
			$image_src_array[ 0 ] =  $empty_thumb;
			$image_src  = theme_image_resize( $empty_thumb, $image_width, $image_height , $crop_images, $retina_images );
		}
		$output .='<div class="featured-image">';
		$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" />';
		$output .='<div class="image-hover-overlay"></div>';
		$output .='<div class="newspaper-meta-wrapper">';
		$output .='<a class="permalink-badge" href="'.get_permalink().'"><i class="mk-icon-container-permalink"></i></a>';
		$output .='<a rel="blog-lightbox-group" title="'.get_the_title().'" class="zoom-badge mk-lightbox" href="'.$image_src_array[ 0 ].'"><i class="mk-icon-lightbox-expand"></i></a>';
		$output .='<div class="categories"><i class="mk-icon-play"></i> in '.get_the_category_list( ', ' ).' </div>';
		$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
		$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
		$output .='</time>';
		$output .='<div class="clearboth"></div></div>';
		$output .='</div>';
		$output .='<div class="the-title post-type-badge portfolio-icon"><i class="mk-icon-posttype-portfolio"></i><span><a href="'.get_permalink().'">'.get_the_title().'</span></a></div>';
		$output .='</article>' . "\n\n\n";
	}





	if ($post_type != 'portfolio' ) {

		$output .='<article id="'.get_the_ID().'" class="mk-blog-newspaper-item '.$column_css.' '.$layout_class.' newspaper-'.$post_type.'">';



		// Image post type
		if ( $post_type == 'image' || $post_type == '' ) {
			
			if ( has_post_thumbnail() ) {
			$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
			$image_src  = theme_image_resize( $image_src_array[ 0 ], $image_width, $image_height , $crop_images, $retina_images );
			}else {
				$image_src_array[ 0 ] =  $empty_thumb;
				$image_src  = theme_image_resize( $empty_thumb, $image_width, $image_height , $crop_images, $retina_images );
			}
			$output .='<div class="featured-image">';
			$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" />';
			$output .='<div class="image-hover-overlay"></div>';
			if ( $title_position == 'top') {
				$output .='<div class="the-title highlight"><span><a href="'.get_permalink().'">'.get_the_title().'</a></span></div>';
			}
			$output .='<div class="newspaper-meta-wrapper">';
			$output .='<a class="permalink-badge" href="'.get_permalink().'"><i class="mk-icon-container-permalink"></i></a>';
			$output .='<a rel="blog-lightbox-group" title="'.get_the_title().'" class="zoom-badge mk-lightbox" href="'.$image_src_array[ 0 ].'"><i class="mk-icon-lightbox-expand"></i></a>';
			$output .='<a class="post-type-badge image-icon" href="'.get_permalink().'"></a>';
			$output .='<div class="categories"><i class="mk-icon-play"></i> in '.get_the_category_list( ', ' ).' </div>';
			$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
			$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
			$output .='</time>';
			$output .='<div class="clearboth"></div></div>';
			$output .='</div>';

			if ( $title_position == 'bottom' ) {
				$output .='<div class="the-title highlight bottom-title"><span><a href="'.get_permalink().'">'.get_the_title().'</a></span></div>';
			}
		}

		// Document Post type
		if ( $post_type == 'document' ) {
			$output .='<div class="the-title highlight"><span><a href="'.get_permalink().'">'.get_the_title().'</a></span></div>';
			$output .='<div class="document-meta-wrapper">';
			$output .='<a class="post-type-badge doc-icon" href="'.get_permalink().'"><i class="mk-icon-posttype-document"></i></a>';
			$output .='<a class="permalink-badge" href="'.get_permalink().'"><i class="mk-icon-container-permalink"></i></a>';
			$output .='<div class="clearboth"></div>';
			$output .='<div class="categories"><i class="mk-icon-play"></i> in '.get_the_category_list( ', ' ).' </div>';
			$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
			$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
			$output .='</time>';
			$output .='</div><div class="clearboth"></div>';
		}

		if ( $post_type == 'video' ) {

			if ( has_post_thumbnail() ) {
			$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
			$image_src  = theme_image_resize( $image_src_array[ 0 ], $image_width, $image_height , $crop_images, $retina_images );
			}else {
				$image_src_array[ 0 ] =  $empty_thumb;
				$image_src  = theme_image_resize( $empty_thumb, $image_width, $image_height , $crop_images, $retina_images );
			}
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

			if ( $disable_video_lightbox == 'false' ) {
				$video_url = get_permalink();
				$video_lightbox_class = '';
			}


			$output .='<div class="featured-image">';
			$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" />';
			$output .='<div class="image-hover-overlay"></div>';
			$output .='<a rel="blog-lightbox-group" class="post-type-badge video-play-icon '.$video_lightbox_class.'" title="'.get_the_title().'" alt="'.get_the_title().'" href="'.$video_url.'"></a>';
			$output .='<div class="newspaper-meta-wrapper">';
			$output .='<div class="categories"><i class="mk-icon-play"></i> in '.get_the_category_list( ', ' ).' </div>';
			$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
			$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
			$output .='</time>';
			$output .='<div class="clearboth"></div></div>';
			$output .='</div>';
			$output .='<div class="the-title highlight"><span><a href="'.get_permalink().'">'.get_the_title().'</a></span></div>';
		}


		// audio post type
		if ( $post_type == 'audio' ) {

			$audio_id = mt_rand( 99, 999 );
			$mp3_file  = get_post_meta( $post->ID, '_mp3_file', true );
			$ogg_file  = get_post_meta( $post->ID, '_ogg_file', true );
			if ( has_post_thumbnail() ) {
			$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
			$image_src  = theme_image_resize( $image_src_array[ 0 ], $image_width, $image_height , $crop_images, $retina_images );
			}else {
				$image_src_array[ 0 ] =  $empty_thumb;
				$image_src  = theme_image_resize( $empty_thumb, $image_width, $image_height , $crop_images, $retina_images );
			}

			$output .='<div class="featured-image">';
			$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" />';
			$output .='<div class="image-hover-overlay"></div>';
			$output .='<a class="post-type-badge audio-play-icon" href="#"></a>';
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
			$output .='<div class="newspaper-meta-wrapper">';
			$output .='<a class="permalink-badge" href="'.get_permalink().'"><i class="mk-icon-container-permalink"></i></a>';
			$output .='<div class="categories"><i class="mk-icon-play"></i> in '.get_the_category_list( ', ' ).' </div>';
			$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
			$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
			$output .='</time>';
			$output .='<div class="clearboth"></div></div>';
			$output .='</div>';
			$output .='<div class="the-title highlight"><span><a href="'.get_permalink().'">'.get_the_title().'</a></span></div>';
		}




		$output .='<div class="the-excerpt">'.get_the_excerpt().'</div>';

		$c_args = array(
			'number' => '4',
			'post_id' => $post->ID
		);
		$comments = get_comments( $c_args );
		$output .= '<ul class="mk-newspaper-comments">';
		foreach ( $comments as $comment ) :
			$output .= '<li>';
		$output .=  get_avatar( $comment->comment_author_email, 35 );
		if(!empty($comment->comment_author_url)) {
			$output .= '<span class="comment-author"><a href="'.$comment->comment_author_url.'">' . $comment->comment_author . '</a></span>';
		} else {
			$output .= '<span class="comment-author">' . $comment->comment_author . '</span>';
		}
		
		$stripped_comment = strip_tags( $comment->comment_content );
		$output .= '<span class="comment-content">' . substr( $stripped_comment, 0, 60 ) . '...</span>';
		$output .= '<div class="clearboth"></div></li>';
		endforeach;
		$output .= '</ul>';
		$output .= '</article>' . "\n\n\n";

	}



	return $output;

}
/*******************************************/



















/*
* Blog Metro Style
*/
function blog_metro_style($atts, $current ) {
	global $post;
	extract( $atts );



	if ( $layout == 'full' ) {
		$layout_class = 'metro-full-layout';
	} else {
		$layout_class = 'metro-with-sidebar';
	}


	$output = '';

	$image_width = 165;
	$image_height = 165;

	$post_type = get_post_meta( $post->ID, '_single_post_type', true );
	$post_type = !empty($post_type) ? $post_type : 'image';
	$empty_thumb = THEME_IMAGES . '/empty-thumb.png';



	if ( $post_type == 'portfolio' ) {
		$output .='<article id="'.get_the_ID().'" class="mk-blog-metro-item '.$layout_class.' metro-'.$post_type.'">';
		if ( has_post_thumbnail() ) {
		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		$image_src  = theme_image_resize( $image_src_array[ 0 ], 640, 320, $crop_images, $retina_images );
		}else {
			$image_src_array[ 0 ] =  $empty_thumb;
			$image_src  = theme_image_resize( $empty_thumb, 640, 320 , $crop_images, $retina_images );
		}
		$output .='<div class="featured-image">';
		$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" />';
		$output .='<div class="image-hover-overlay"></div>';
		$output .='<div class="the-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
		$output .='<div class="metro-meta-wrapper">';
		$output .='<a class="post-type-badge portfolio-big-icon" href="'.get_permalink().'"><i class="mk-icon-posttype-portfolio"></i></a>';
		$output .='<time datetime="'.get_the_time( 'M, j' ).'">';
		$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
		$output .='</time>';
		$output .='<div class="clearboth"></div></div>';
		$output .='</div>';
		$output .='</article>' . "\n\n\n";
	}





	if ( $post_type != 'portfolio' ) {

		$output .='<article id="'.get_the_ID().'" class="mk-blog-metro-item '.$layout_class.' metro-'.$post_type.'">';



		// Image post type
		if ( $post_type == 'image' || $post_type == '' ) {
			if ( has_post_thumbnail() ) {
			$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
			$image_src  = theme_image_resize( $image_src_array[ 0 ], 165, 165, $crop_images, $retina_images );
			}else {
			$image_src_array[ 0 ] =  $empty_thumb;
			$image_src  = theme_image_resize( $empty_thumb, 165, 165 , $crop_images, $retina_images );
		}
			$output .='<div class="featured-image">';
			$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" />';
			$output .='<div class="metro-meta-wrapper">';
			$output .='<a class="post-type-badge image-icon" href="'.get_permalink().'"><i class="mk-icon-posttype-image"></i></a>';
			$output .='<div class="categories"><i class="mk-icon-play"></i> in '.get_the_category_list( ', ' ).' </div>';
			$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
			$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
			$output .='</time>';
			$output .='<div class="clearboth"></div></div>';
			$output .='</div>';
			$output .='<div class="the-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
			$output .= '</article>' . "\n\n\n";
		}

		// Document Post type
		if ( $post_type == 'document' ) {
			$output .='<div class="the-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
			$output .='<div class="the-excerpt">'.get_the_excerpt().'</div>';
			$output .='<div class="metro-meta-wrapper">';
			$output .='<a class="post-type-badge doc-icon" href="'.get_permalink().'"><i class="mk-icon-posttype-document"></i></a>';
			$output .='<div class="clearboth"></div>';
			$output .='<div class="categories"><i class="mk-icon-play"></i> in '.get_the_category_list( ', ' ).' </div>';
			$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
			$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
			$output .='</time>';
			$output .='</div><div class="clearboth"></div>';
			$output .= '</article>' . "\n\n\n";
		}

		if ( $post_type == 'video' ) {

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

			if ( $disable_video_lightbox == 'false' ) {
				$video_url = get_permalink();
				$video_lightbox_class = '';
			}

			if ( has_post_thumbnail() ) {
		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		$image_src  = theme_image_resize( $image_src_array[ 0 ], 640, 320, $crop_images, $retina_images );
		}else {
			$image_src_array[ 0 ] =  $empty_thumb;
			$image_src  = theme_image_resize( $empty_thumb, 640, 320 , $crop_images, $retina_images );
		}

			$output .='<div class="featured-image">';
			$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.get_image_src( $image_src['url'] ).'" />';
			$output .='<div class="image-hover-overlay"></div>';
			$output .='<a title="'.get_the_title().'" class="post-type-badge video-play-icon '.$video_lightbox_class.'" href="'.$video_url.'"></a>';
			$output .='<div class="metro-meta-wrapper">';
			$output .='<div class="categories"><i class="mk-icon-play"></i> in '.get_the_category_list( ', ' ).' </div>';
			$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
			$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
			$output .='</time>';
			$output .='<div class="clearboth"></div></div>';
			$output .='</div>';
			$output .='<div class="the-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
			$output .= '</article>' . "\n\n\n";
		}


		// audio post type
		if ( $post_type == 'audio' ) {

			$audio_id = mt_rand( 99, 999 );
			$mp3_file  = get_post_meta( $post->ID, '_mp3_file', true );
			$ogg_file  = get_post_meta( $post->ID, '_ogg_file', true );

			$output .='<div class="featured-image">';
			$output .='<div class="image-hover-overlay"></div>';
			$output .='<a class="post-type-badge audio-play-icon" href="#"></a>';
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
			$output .='<div class="metro-meta-wrapper">';
			$output .='<div class="categories"><i class="mk-icon-play"></i> in '.get_the_category_list( ', ' ).' </div>';
			$output .='<time datetime="'.get_the_time( 'M, j' ).'">on ';
			$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_time( 'M, j' ).'</a>';
			$output .='</time>';
			$output .='<div class="clearboth"></div></div>';
			$output .='</div>';
			$output .='<div class="the-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
			$output .= '</article>' . "\n\n\n";
		}






	}


	return $output;

}
/*******************************************/
