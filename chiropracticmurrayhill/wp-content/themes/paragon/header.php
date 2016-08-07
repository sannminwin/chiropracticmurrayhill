<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6"  <?php language_attributes(); ?>>
   <![endif]-->
<!--[if IE 7]>
   <html id="ie7" <?php language_attributes(); ?>>
      <![endif]-->
<!--[if IE 8]>
      <html id="ie8" <?php language_attributes(); ?>>
         <![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]>
         <html <?php language_attributes(); ?>>
            <![endif]-->
<html>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="Theme Version" content="<?php $theme_data = wp_get_theme(); echo $theme_data['Version']; ?>">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=0">
        <title>
            <?php bloginfo("name"); ?> <?php wp_title("|", true); ?>
        </title>
        <?php $custom_favicon = theme_option( THEME_OPTIONS, 'custom_favicon' ); if ( $custom_favicon ) : ?>
          <link rel="shortcut icon" href="<?php echo $custom_favicon ?>"  />
        <?php endif; ?>
        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url');?>">
        <link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url');?>">
        <link rel="pingback" href="<?php bloginfo('pingback_url');?>">
         <!--[if lt IE 9]>
         <script src="<?php echo THEME_JS;?>/html5shiv.js" type="text/javascript"></script>
         <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
         <![endif]-->
         <!--[if IE 7 ]>
               <link href="<?php echo THEME_STYLES;?>/ie7.css" media="screen" rel="stylesheet" type="text/css" />
               <![endif]-->
         <!--[if IE 8 ]>
               <link href="<?php echo THEME_STYLES;?>/ie8.css" media="screen" rel="stylesheet" type="text/css" />
         <![endif]-->   

         <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 
         <script type="text/javascript">
          var mk_images_dir = "<?php echo THEME_IMAGES; ?>",
          mk_fixed_header = "<?php echo theme_option(THEME_OPTIONS, 'fixed_header'); ?>",
          mk_body_parallax = "<?php echo theme_option(THEME_OPTIONS, 'enable_body_parallax'); ?>",
          mk_body_parallax_speed = "<?php echo theme_option(THEME_OPTIONS, 'body_parallax_speed'); ?>",
          mk_page_parallax = "<?php echo theme_option(THEME_OPTIONS, 'enable_page_parallax'); ?>",
          mk_page_parallax_speed = "<?php echo theme_option(THEME_OPTIONS, 'page_parallax_speed'); ?>",
          mk_homepage_slideshow_parallax = "<?php echo theme_option(THEME_OPTIONS, 'enable_homepage_slideshow_parallax'); ?>",
          mk_homepage_slideshow_speed = "<?php echo theme_option(THEME_OPTIONS, 'homepage_slideshow_speed'); ?>",
          mk_smooth_scroll = "<?php echo theme_option(THEME_OPTIONS, 'enable_nicescroll'); ?>",
          mk_page_scroll_speed = "<?php echo theme_option(THEME_OPTIONS, 'page_scroll_speed'); ?>",
          mk_theme_js_path = "<?php echo THEME_JS;  ?>";
         </script>
    <?php wp_head(); ?>     
    </head>
    <body <?php body_class(); ?>>
     <div id="mk-outer-wrap">
        <div id="mk-inner-wrap">
<?php if ( theme_option( THEME_OPTIONS, 'background_selector_orientation' ) == 'boxed_layout' ) { ?>
<div id="mk-boxed-layout">
<?php } ?>

<header id="mk-header">

<div class="header-wrapper  mk-grid">

 <div class="mk-header-right">
  <div class="mk-responsive-close"></div>

 

    <?php theme_class('mk_header_social');

    $mk_header_search = theme_option( THEME_OPTIONS, 'disable_header_search' );
     ?>
    <div class="mk-nav-search-wrapper <?php if($mk_header_search == 'false') : ?> mk-seach-disabled <?php endif; ?>">
      <?php if ($mk_header_search == 'true' ) : ?>
    <form class="mk-header-searchform" method="get" id="searchform" action="<?php echo home_url(); ?>">
      <span><input type="text" class="text-input visuallyhidden" value="" name="s" id="s" data-watermark="<?php _e('type your search query', 'theme_frontend'); ?>" /></span>
      <input value="" type="submit" class="search-button" type="submit" /> 
    </form>
  <?php endif; ?>
    <?php theme_class('primary_menu'); ?>
    </div>
</div>
<div class="mk-nav-responsive-link"></div>

<?php
    $custom_logo = theme_option( THEME_OPTIONS, 'logo' );
if ( theme_option( THEME_OPTIONS, 'display_logo' ) == 'true' ):
    if ( !empty( $custom_logo ) ) {
?>

<div class="header-logo">
    <a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>"><img alt="<?php bloginfo('name'); ?>" src="<?php echo $custom_logo; ?>" /></a>
</div>

<?php } else { ?>
<div class="header-logo">
    <a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>"><img alt="<?php bloginfo('name'); ?>" src="<?php echo THEME_IMAGES; ?>/paragon-logo.png" /></a>
</div>
<?php } ?>

<?php endif; ?>

<div class="clearboth"></div>
</div>


</header>      