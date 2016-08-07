<?php

$page_layout = theme_option( THEME_OPTIONS, 'search_page_layout' );
$loop_style = theme_option( THEME_OPTIONS, 'search_loop_style' );
$pagination_style = theme_option( THEME_OPTIONS, 'search_pagination_style' );
$column = theme_option( THEME_OPTIONS, 'search_loop_column' );


get_header(); ?>
<div id="theme-page">
	<?php theme_class( 'page_introduce' ); ?>
	<div class="theme-page-wrapper <?php echo $page_layout; ?>-layout  mk-grid  row-fluid">
		<div class="theme-content">
			<?php
				$exclude_cats = theme_option( THEME_OPTIONS, 'excluded_cats' );
				foreach ( $exclude_cats as $key => $value ) {
					$exclude_cats[$key] = -$value;
				}
				if ( stripos( $query_string, 'cat=' ) === false ) {
					query_posts( $query_string."&cat=".implode( ",", $exclude_cats ) );
				}else {
					query_posts( $query_string.implode( ",", $exclude_cats ) );
				}
				echo do_shortcode( '[mk_blog style="'.$loop_style.'" column="'.$column.'" pagination_style="'.$pagination_style.'"]' ); 
			?>
		</div>

	<?php if ( $page_layout != 'full' ) get_sidebar(); ?>
	<div class="clearboth"></div>
	</div>
</div>
<?php get_footer(); ?>
