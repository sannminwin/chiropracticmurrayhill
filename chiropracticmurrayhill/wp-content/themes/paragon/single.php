<?php 

global $post;

$single_layout = get_post_meta( $post->ID, '_single_layout', true );

if($single_layout == 'default' || empty($single_layout)) {
	$single_layout = theme_option(THEME_OPTIONS, 'single_layout');
}


$image_height = theme_option(THEME_OPTIONS, 'single_featured_image_height');

$disable_title = get_post_meta( $post->ID, '_disable_title', true );
$disable_meta = get_post_meta( $post->ID, '_disable_meta', true );
$disable_social_share = get_post_meta( $post->ID, '_disable_social_share', true );
$disable_tags = get_post_meta( $post->ID, '_disable_tags', true );
$disable_related_posts = get_post_meta( $post->ID, '_disable_related_posts', true );
$disable_about_author = get_post_meta( $post->ID, '_disable_about_author', true );
$disable_comments = get_post_meta( $post->ID, '_disable_comments', true );



$single_layout = !empty($single_layout) ? $single_layout : 'full';
$image_height = !empty($image_height) ? $image_height : '350';

	if ( $single_layout=='full' ) {
		$image_width = 1140;
	} else {
		$image_width = 760;
	}


function social_networks_meta() {
	$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
	$output = '<meta property="og:image" content="'.get_image_src( $image_src_array[ 0 ] ).'"/>'. "\n";
	$output .= '<meta property="og:url" content="'.get_permalink().'"/>'. "\n";
	$output .= '<meta property="og:title" content="'.get_the_title().'"/>'. "\n";
	echo $output;
}
add_action('wp_head', 'social_networks_meta');

get_header(); ?>
<div id="theme-page">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 

		$post_type = get_post_meta( $post->ID, '_single_post_type', true );
		$post_type = !empty($post_type) ? $post_type : 'image';
		if ( has_post_thumbnail() ) {
		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		$image_src  = theme_image_resize( $image_src_array[ 0 ], $image_width, $image_height);
		}else {
			$empty_thumb = THEME_IMAGES . '/empty-thumb.png';
			$image_src_array[ 0 ] =  $empty_thumb;
			$image_src  = theme_image_resize( $empty_thumb, $image_width, $image_height);
		}

	?>		

	<div class="theme-page-wrapper <?php echo $single_layout; ?>-layout mk-blog-single-page mk-single-<?php echo $post_type; ?>  mk-grid row-fluid">

		<div class="blog-single-meta">
			<?php if($disable_meta != 'false') : ?>
				<time class="post-date" datetime="<?php the_time( 'F, j' ) ?>">
					<a href="<?php get_month_link( the_time( "Y" ), the_time( "m" ) ) ?>"><?php the_time( 'j, F Y' ) ?></a>
				</time>
				<div class="clearboth"></div>
				<?php endif;?>	
				<?php if($disable_title != 'false') : ?>
				<div class="the-title highlight"><span><a href="<?php the_permalink() ?>"><?php the_title() ?></a></span></div>
				<?php endif; ?>
				<div class="clearboth"></div>
				<?php if($disable_meta != 'false') : ?>
				<div class="categories">In <?php the_category( ', ' ) ?></div>
				<div class="clearboth"></div>
				<?php endif;?>
		</div>		

		<div class="single-blog-wrapper">
			<div class="theme-content">
	
					<article id="<?php the_ID(); ?>" class="mk-blog-single-article <?php echo $post_type; ?>-post-type">

			<?php if($post_type == 'image' || $post_type == 'portfolio') { ?>	
						<div class="single-featured-image">	
							<img alt="<?php the_title(); ?>" title="<?php the_title(); ?>" src="<?php echo get_image_src($image_src['url']); ?>" height="<?php echo $image_height; ?>" width="<?php echo $image_width; ?>" />
						</div>		
			<?php } elseif($post_type == 'video') { 
				$skin_color = theme_option(THEME_OPTIONS, 'skin_color' );	
				$video_id = get_post_meta( $post->ID, '_single_video_id', true );	
				$video_site  = get_post_meta( $post->ID, '_single_video_site', true );


				if($video_site =='vimeo') {
				echo '<div style="width:'.$image_width.'px;" class="mk-video-wrapper"><div class="mk-video-container"><iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0&amp;color='.str_replace("#", "", $skin_color).'" width="'.$image_width.'" height="'.$image_height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
				}


				if($video_site =='youtube') {
				echo '<div style="width:'.$image_width.'px;" class="mk-video-wrapper"><div class="mk-video-container"><iframe src="http://www.youtube.com/embed/'.$video_id.'?showinfo=0&amp;theme=light&amp;color=white" frameborder="0" width="'.$image_width.'" height="'.$image_height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
				}

				if($video_site =='dailymotion') {
				echo '<div style="width:'.$image_width.'px;" class="mk-video-wrapper"><div class="mk-video-container"><iframe src="http://www.dailymotion.com/embed/video/'.$video_id.'?logo=0" frameborder="0" width="'.$image_width.'" height="'.$image_height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
				}
	
		
		
			} elseif($post_type == 'audio') { 	
				$audio_id = mt_rand( 99, 999 );
				$mp3_file  = get_post_meta( $post->ID, '_mp3_file', true );
				$ogg_file  = get_post_meta( $post->ID, '_ogg_file', true );
				wp_enqueue_script( 'jquery-jplayer' );
			echo '<script type="">

		jQuery(document).ready(function($) {

				jQuery("#jquery_jplayer_'.$audio_id.'").jPlayer({
					ready: function () {
						$(this).jPlayer("setMedia", {';
			if ( $mp3_file ) {
				echo 'mp3: "'.$mp3_file.'",';
			}
			if ( $ogg_file ) {
				echo 'ogg: "'.$ogg_file.'",';
			}

			echo ' });
					},
					play: function() { // To avoid both jPlayers playing together.
						$(this).jPlayer("pauseOthers");
					},
					swfPath: "'.THEME_JS.'",
					supplied: "mp3, ogg",
					cssSelectorAncestor: "#jp_container_'.$audio_id.'",
					wmode: "window"
				});

		})

		</script>
		<div class="mk-single-audio-wrapper">
		<div id="jquery_jplayer_'.$audio_id.'" class="jp-jplayer"></div>
		<div id="jp_container_'.$audio_id.'" class="jp-audio">
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
		</div></div>';				


					 }  elseif($post_type == 'document') { ?>

					<?php } ?>

						<div class="blog-single-content-wrapper">
							<a href="<?php the_permalink(); ?>" class="single-postype-icons <?php echo $post_type; ?>-icon"><i class="mk-icon-posttype-<?php echo $post_type; ?>"></i></a>
							<a href="<?php the_permalink(); ?>" class="mk-single-permalink-icon"><i class="mk-icon-container-permalink"></i></a>
							<div class="clearboth"></div>
							<div class="blog-single-content">
								
								<?php the_content(); ?>
							<div class="clearboth"></div>
							</div>
						</div>
				<?php if(theme_option(THEME_OPTIONS, 'enable_blog_author') == 'true') :
						if($disable_about_author != 'false') :
				 ?>
						<div class="mk-about-author-wrapper">
							<div class="about-author-avatar-social-wrapper">
								<?php global $user; echo get_avatar( get_the_author_meta('email'), '120',false ,get_the_author_meta('display_name', $user['ID'])); ?>
								<?php if(get_the_author_meta( 'twitter' ) || get_the_author_meta( 'facebook' ) || get_the_author_meta( 'google_plus' ) || get_the_author_meta( 'linked_in' ))  { ?>
								<ul class="about-author-social">
									<?php 

									if(get_the_author_meta( 'twitter' )) {
										echo '<li><a class="twitter-icon" title="'.__('Follow me in Twitter','theme_frontend').'" href="'.get_the_author_meta( 'twitter' ).'"><i class="mk-social-twitter"></i></a></li>';
									}

									if(get_the_author_meta( 'facebook' )) {
										echo '<li><a class="facebook-icon" title="'.__('Follow me in Facebook','theme_frontend').'" href="'.get_the_author_meta( 'facebook' ).'"><i class="mk-social-facebook"></i></a></li>';
									}

									if(get_the_author_meta( 'google_plus' )) {
										echo '<li><a class="google_plus-icon" title="'.__('Follow me in Google Plus','theme_frontend').'" href="'.get_the_author_meta( 'google_plus' ).'"><i class="mk-social-google-plus"></i></a></li>';
									}

									if(get_the_author_meta( 'linked_in' )) {
										echo '<li><a class="linked_in-icon" title="'.__('Follow me in LinkedIn','theme_frontend').'" href="'.get_the_author_meta( 'linked_in' ).'"><i class="mk-social-linkedin"></i></a></li>';
									}

									?>																											

								</ul>
								<?php } ?>
							</div>
		<?php  endif;  endif;  if(theme_option(THEME_OPTIONS, 'enable_single_social') == 'true') : 
					if($disable_social_share != 'false') :
			?>
							<div class="single-post-social-share">

								<?php 

								wp_enqueue_script( 'jquery-twitter', 'http://platform.twitter.com/widgets.js', array('jquery'), false);
								wp_enqueue_script( 'jquery-facebook', 'http://connect.facebook.net/en_US/all.js#xfbml=1', array('jquery'), false);
								wp_enqueue_script( 'jquery-googleplus', 'https://apis.google.com/js/plusone.js', array('jquery'), false);
								wp_enqueue_script( 'jquery-pinterest', '//assets.pinterest.com/js/pinit.js', array('jquery'), false);

								?>								
					
								<span class="share_buttons"><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo get_permalink(); ?>"  data-text="<?php echo  get_the_title(); ?>" data-via="<?php echo theme_option(THEME_OPTIONS, 'twitter_username'); ?>" data-count="horizental">Tweet</a></span>

								<span class="share_buttons"><fb:like href="<?php echo get_permalink(); ?>" layout="button_count"></fb:like></span>

								<span class="share_buttons"><g:plusone size="medium" href="<?php echo get_permalink(); ?>"></g:plusone></span>

								<?php if($post_type == 'image'): ?>
								<span class="share_buttons"><a href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&amp;media=<?php echo get_image_src($image_src['url']); ?>&amp;description=<?php the_excerpt(); ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></span>
								<?php endif; ?>		
							</div>	
					<?php endif; 
				if(theme_option(THEME_OPTIONS, 'enable_blog_author') == 'true') :
						if($disable_about_author != 'false') :
			
					?>

								<a class="about-author-name" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a>

								<div class="about-author-time-wrapper">
									<time class="post-date" datetime="<?php the_time( 'F, j' ) ?>">
										<a href="<?php get_month_link( the_time( "Y" ), the_time( "m" ) ) ?>"><?php the_time( 'j, F Y' ) ?></a>
									</time>
								</div>	

								<div class="about-author-desc"><?php the_author_meta('description'); ?></div>



						<?php  endif;  endif; ?>
						<div class="clearboth"></div>		
						</div>
					<?php endif; ?>
						<div class="clearboth"></div>
						<?php if(theme_option(THEME_OPTIONS, 'diable_single_tags') == 'true') :

						 if($disable_tags != 'false') : ?>
						<div class="single-post-tags">
							<?php the_tags(' ',''); ?>
						</div>
					<?php endif; endif; ?>


						<?php 
					if(theme_option(THEME_OPTIONS, 'enable_single_related_posts') == 'true') :
						if($disable_related_posts != 'false') :
						theme_class('portfolio_similar_posts'); 
						endif;
						endif;
						?>
					</article>
					<?php 
					if(theme_option(THEME_OPTIONS, 'enable_blog_single_comments') == 'true') : 
						if($disable_comments != 'false') :
						comments_template( '', true ); 
						endif;
					endif;
					?>	






						<div class="clearboth"></div>
				
			</div>
				<?php endwhile; ?>
			<?php  if($single_layout != 'full') get_sidebar();  ?>	
			<div class="clearboth"></div>	
		</div>
	</div>
</div>
<?php get_footer(); ?>