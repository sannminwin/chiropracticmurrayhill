<?php 
get_header();
global $post;
$page_layout = get_post_meta( $post->ID, '_layout', true );

if(empty($page_layout)) {
	$page_layout = 'right';
}

 ?>
<div id="theme-page">
	<?php theme_class('mk_slideshow',$post->ID); ?>
	<?php theme_class('mk_google_maps',$post->ID); ?>
	<?php theme_class('page_introduce',$post->ID); ?>
	<div class="theme-page-wrapper <?php echo $page_layout; ?>-layout  mk-grid row-fluid">
		<div class="theme-content">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php the_content();?>
					<div class="clearboth"></div>
			<?php endwhile; ?>
		</div>

	<?php if($page_layout != 'full') get_sidebar(); ?>	
	<div class="clearboth"></div>	
	</div>
</div>
<?php get_footer(); ?>