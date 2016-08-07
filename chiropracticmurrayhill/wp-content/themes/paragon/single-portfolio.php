<?php 

$image_height = theme_option(THEME_OPTIONS, 'Portfolio_single_image_height');
$image_width = 1140;

$terms = get_the_terms(get_the_id(), 'portfolio_category');
$terms_slug = array();
$terms_name = array();
if (is_array($terms)) {
	foreach($terms as $term) {
		$terms_name[] = $term->name;
			}
}

get_header(); ?>
<div id="theme-page">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
		global $post;
		$post_type = get_post_meta( get_the_id(), '_single_post_type', true );
		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		$image_src  = theme_image_resize( $image_src_array[ 0 ], $image_width, $image_height);
		if($post_type == '') {
			$post_type = 'image';
		}
	?>		

	<div class="theme-page-wrapper mk-blog-single-page mk-portfolio-single-page mk-single-<?php echo $post_type; ?> mk-grid row-fluid">

		<div class="blog-single-meta portfolio-single-meta">
				<time class="post-date" datetime="<?php the_time( 'F, j' ) ?>">
					<a href="<?php get_month_link( the_time( "Y" ), the_time( "m" ) ) ?>"><?php the_time( 'j, F Y' ) ?></a>
				</time>
				<div class="clearboth"></div>

				<div class="the-title highlight"><span><a href="<?php the_permalink() ?>"><?php the_title() ?></a></span></div>

				<div class="clearboth"></div>

				<div class="categories">In <?php echo implode(', ', $terms_name); ?></div>
				<div class="clearboth"></div>		
		</div>		

		<div class="single-blog-wrapper">
			<div class="theme-content">
	
					<article id="<?php the_ID(); ?>" class="mk-blog-single-article <?php echo $post_type; ?>-post-type">
						<nav class="mk-portfolio-single-pagination">
						   <div class="mk-previous"><?php previous_post_link( '%link', '<span></span> ' ); ?></div>
						   <div class="mk-next"><?php next_post_link( '%link', '<span></span>' ); ?></div>
						</nav>	

						<?php if($post_type == 'image') { ?>	
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


					 }  ?>

						<?php if(theme_option(THEME_OPTIONS, 'enable_portfolio_brief_info') != 'false') : ?>
						<section class="portfolio-brief-content">
							<a href="<?php the_permalink(); ?>" class="single-postype-icons portfolio-icon"><i class="mk-icon-posttype-portfolio"></i></a>
							<h3><?php echo get_post_meta(get_the_id(), '_breif_title', true ); ?></h3>
							<p><?php echo get_post_meta(get_the_id(), '_brief_desc', true ); ?></p>
							<div class="clearboth"></div>
						</section>
					<?php endif; ?>
						<?php 
						if(theme_option(THEME_OPTIONS, 'enable_portfolio_logo_box') != 'false') : 
						$company_logo_src = get_post_meta(get_the_id(), '_company_logo_src', true);
						if($company_logo_src != '') { ?>
						<section class="portfolio-logo-section">
							<?php 
							if(!empty($company_logo_src)) { ?>
							<a href="<?php echo get_post_meta(get_the_id(), '_company_url', true) ?>" class="portfolio-company-logo">
								<img src="<?php echo $company_logo_src ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>" />
							</a>
							<?php } ?>

							<ul class="portfolio-social">
								<?php $facebook = get_post_meta(get_the_id(), '_facebook', true );
								if(!empty($facebook)) { ?>
								<li><a class="mk-facebook" href="<?php echo $facebook; ?>"><i class="mk-social-facebook"></i></a></li>
								<?php } ?>

								<?php $twitter = get_post_meta(get_the_id(), '_twitter', true );
								if(!empty($twitter)) { ?>
								<li><a class="mk-twitter" href="<?php echo $twitter; ?>"><i class="mk-social-twitter"></i></a></li>
								<?php } ?>

								<?php $linkedin = get_post_meta(get_the_id(), '_linkedin', true );
								if(!empty($linkedin)) { ?>
								<li><a class="mk-linkedin" href="<?php echo $linkedin; ?>"><i class="mk-social-linkedin"></i></a></li>
								<?php } ?>

								<?php $googleplus = get_post_meta(get_the_id(), '_googleplus', true );
								if(!empty($googleplus)) { ?>
								<li><a class="mk-google-plus" href="<?php echo $googleplus; ?>"><i class="mk-social-google-plus"></i></a></li>
								<?php } ?>


							</ul>

						</section>
						<?php } endif; ?>
						<div class="clearboth"></div>
						<section class="portfolio-single-content">
								<?php the_content(); ?>
						</section>

						

						<?php 
					if(theme_option(THEME_OPTIONS, 'enable_portfolio_similar_posts') == 'true') :
						theme_class('portfolio_similar_posts'); 
					endif;
						?>

					
					</article>
					<?php 
					if(theme_option(THEME_OPTIONS, 'enable_portfolio_comment') == 'true') : 
						comments_template( '', true ); 
					endif;
					?>	





						<div class="clearboth"></div>
				
			</div>
			<?php endwhile; ?>	
			<div class="clearboth"></div>	
		</div>
	</div>
</div>
<?php get_footer(); ?>