<?php if(theme_option(THEME_OPTIONS, 'disable_footer') == 'true') : ?>
<section id="mk-footer">
<div class="footer-wrapper mk-grid">



<?php if(theme_option(THEME_OPTIONS,'disable_footer_banner') != 'false' ) : ?>
	 <div id="footer-slogan">
	 	<h4><?php echo theme_option(THEME_OPTIONS,'footer_slogan'); ?></h4>
	 	<?php $footer_logo = theme_option(THEME_OPTIONS, 'footer_logo');
	 	if(!empty($footer_logo)) { ?>
	 		 <a href="<?php echo home_url( '/' ); ?>" class="footer-logo"><img src="<?php echo $footer_logo; ?>" alt="" title="" /></a>
	 	<?php } ?>	 
	 </div>
 <?php endif; ?>


<div class="footer-widgets <?php if(theme_option(THEME_OPTIONS,'disable_footer_banner') != 'true' ) : ?> mk-slogan-disabled<?php endif; ?>">
<?php
$footer_column = theme_option(THEME_OPTIONS,'footer_columns');
if(is_numeric($footer_column)):
	switch ( $footer_column ):
		case 1:
		$class = '';
			break;
		case 2:
			$class = 'mk-col-1-2';
			break;
		case 3:
			$class = 'mk-col-1-3';
			break;
		case 4:
			$class = 'mk-col-1-4';
			break;
		case 5:
			$class = 'mk-col-1-5';
			break;
		case 6:
			$class = 'mk-col-1-6';
			break;		
	endswitch;
	for( $i=1; $i<=$footer_column; $i++ ):
?>
<?php if($i == $footer_column): ?>
<div class="<?php echo $class; ?>"><?php theme_class('footer_sidebar'); ?></div>
<?php else:?>
			<div class="<?php echo $class; ?>"><?php theme_class('footer_sidebar'); ?></div>
<?php endif;		
endfor; 

else : 

switch($footer_column):
		case 'third_sub_third':
?>
		<div class="mk-col-1-3"><?php theme_class('footer_sidebar'); ?></div>
		<div class="mk-col-2-3">
			<div class="mk-col-1-3"><?php theme_class('footer_sidebar'); ?></div>
			<div class="mk-col-1-3"><?php theme_class('footer_sidebar'); ?></div>
			<div class="mk-col-1-3"><?php theme_class('footer_sidebar'); ?></div>
		</div>
<?php
			break;
		case 'sub_third_third':
?>
		<div class="mk-col-2-3">
			<div class="mk-col-1-3"><?php theme_class('footer_sidebar'); ?></div>
			<div class="mk-col-1-3"><?php theme_class('footer_sidebar'); ?></div>
			<div class="mk-col-1-3"><?php theme_class('footer_sidebar'); ?></div>
		</div>
		<div class="mk-col-1-3"><?php theme_class('footer_sidebar'); ?></div>
<?php
			break;
		case 'third_sub_fourth':
?>
		<div class="mk-col-1-3"><?php theme_class('footer_sidebar'); ?></div>
		<div class="mk-col-2-3 last">
			<div class="mk-col-1-4"><?php theme_class('footer_sidebar'); ?></div>
			<div class="mk-col-1-4"><?php theme_class('footer_sidebar'); ?></div>
			<div class="mk-col-1-4"><?php theme_class('footer_sidebar'); ?></div>
			<div class="mk-col-1-4"><?php theme_class('footer_sidebar'); ?></div>
		</div>
<?php
			break;
		case 'sub_fourth_third':
?>
		<div class="mk-col-2-3">
			<div class="mk-col-1-4"><?php theme_class('footer_sidebar'); ?></div>
			<div class="mk-col-1-4"><?php theme_class('footer_sidebar'); ?></div>
			<div class="mk-col-1-4"><?php theme_class('footer_sidebar'); ?></div>
			<div class="mk-col-1-4"><?php theme_class('footer_sidebar'); ?></div>
		</div>
		<div class="mk-col-1-3"><?php theme_class('footer_sidebar'); ?></div>
<?php
			break;
		case 'half_sub_half':
?>
		<div class="mk-col-1-2"><?php theme_class('footer_sidebar'); ?></div>
		<div class="mk-col-1-2">
			<div class="mk-col-1-2"><?php theme_class('footer_sidebar'); ?></div>
			<div class="mk-col-1-2"><?php theme_class('footer_sidebar'); ?></div>
		</div>
<?php
			break;
		case 'half_sub_third':
?>
		<div class="mk-col-1-2"><?php theme_class('footer_sidebar'); ?></div>
		<div class="mk-col-1-2">
			<div class="mk-col-1-3"><?php theme_class('footer_sidebar'); ?></div>
			<div class="mk-col-1-3"><?php theme_class('footer_sidebar'); ?></div>
			<div class="mk-col-1-3"><?php theme_class('footer_sidebar'); ?></div>
		</div>
<?php
			break;
		case 'sub_half_half':
?>
		<div class="mk-col-1-2">
			<div class="mk-col-1-2"><?php theme_class('footer_sidebar'); ?></div>
			<div class="mk-col-1-2"><?php theme_class('footer_sidebar'); ?></div>
		</div>
		<div class="mk-col-1-2"><?php theme_class('footer_sidebar'); ?></div>
<?php
			break;
		case 'sub_third_half':
?>
		<div class="mk-col-1-2">
			<div class="mk-col-1-3"><?php theme_class('footer_sidebar'); ?></div>
			<div class="mk-col-1-3"><?php theme_class('footer_sidebar'); ?></div>
			<div class="mk-col-1-3"><?php theme_class('footer_sidebar'); ?></div>
		</div>
		<div class="mk-col-1-2"><?php theme_class('footer_sidebar'); ?></div>
<?php
			break;
	endswitch;
endif;	






	?>

<div class="clearboth"></div>
</div>
  

<?php endif;?>

<div class="clearboth"></div>      
</div>

</section>

<?php if ( theme_option( THEME_OPTIONS, 'disable_sub_footer' ) == 'true' ) { ?>
<div id="sub-footer">
	<div class="mk-grid">
		 <?php theme_class('footer_menu'); ?>
    	<span class="mk-footer-copyright"><?php echo stripslashes(theme_option(THEME_OPTIONS, 'copyright')); ?></span>
	</div>
	<div class="clearboth"></div>
</div>
<?php } ?>







<?php 

	
	if(theme_option(THEME_OPTIONS,'custom_js')) : 
	?>
		<script type="text/javascript">
		
		<?php echo stripslashes(theme_option(THEME_OPTIONS,'custom_js')); ?>
		
		</script>
	
	
	<?php 
	endif;
	
	if(theme_option(THEME_OPTIONS,'analytics')){
		?>
		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', '<?php echo stripslashes(theme_option(THEME_OPTIONS,'analytics')); ?>']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
		<?php 

	}

?>

<?php if ( theme_option( THEME_OPTIONS, 'background_selector_orientation' ) == 'boxed_layout' ) { ?>
</div>
<?php } ?>
</div>
</div>
<?php wp_footer(); ?>
</body>


</html>




