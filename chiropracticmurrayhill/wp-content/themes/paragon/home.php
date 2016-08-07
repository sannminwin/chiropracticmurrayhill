<?php get_header();  ?>
<div id="theme-page">
<div class="mk-homepage-slideshow">
<?php theme_class('mk_slideshow'); ?>
<div class="clearboth"></div>
</div>
<?php 
if(theme_option(THEME_OPTIONS, 'disable_homepage_tabbed_box') == 'true') :
theme_class('mk_tabbed_box');
endif;
 ?>

<div class="theme-page-wrapper mk-grid row-fluid">

<?php
$content_id = theme_option( THEME_OPTIONS, 'homepage_content' );
if ( $content_id ) {
	$page_data = get_page( $content_id );
	$content = apply_filters( 'the_content', $page_data->post_content );
	echo apply_filters( 'the_content', stripslashes( $content ) );
}
?>

<div class="clearboth"></div>	
</div>
</div>
<?php get_footer(); ?>