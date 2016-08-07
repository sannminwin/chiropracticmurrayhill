<?php 

$bg_color = theme_option(THEME_OPTIONS, 'notfound_bg_color');

get_header(); ?>
<div id="theme-page">
	<?php theme_class('page_introduce'); ?>
	<div class="theme-page-wrapper full-layout  mk-grid row-fluid">
		<div class="theme-content">
			<?php echo do_shortcode('[vc_tabbed_boxes container_bg_color="'.$bg_color.'"]
			[vc_tabbed_box title="Latest Posts"][mk_sitemap_posts][/vc_tabbed_box]
			[vc_tabbed_box title="Latest Portfolios"][mk_sitemap_portfolios][/vc_tabbed_box]
			[vc_tabbed_box title="Pages"][mk_sitemap_pages][/vc_tabbed_box]
			[vc_tabbed_box title="Categories"][mk_sitemap_categories][/vc_tabbed_box]
			[/vc_tabbed_boxes]'); ?>
		</div>

	<div class="clearboth"></div>	
	</div>
</div>
<?php get_footer(); ?>