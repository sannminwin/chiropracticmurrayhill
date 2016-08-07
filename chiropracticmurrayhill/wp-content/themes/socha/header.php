<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
	<?php wp_head(); ?>
    <?php if(ale_get_option('fontlink')){ echo "<link href='http://fonts.googleapis.com/css?family=".ale_get_option('fontlink')."' rel='stylesheet' type='text/css'>"; } else { echo "<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>"; } ?>
    <style type='text/css'>
        h1,h2,h3,h4,h5,h6,input[type="submit"],input[type="button"],#footer-main,.galleriestitle,.rightboxtitle,.followtitle,ul.leftmenu,.mainslidertitle,.sliderlinkmore,.title,.boxtitle,figure.imageformat span,figure.galleryformat span,.leftdatablog,.readmoreblog,span.day,span.month,div.black,header.comment-author,cite.fn,.commenttextarea textarea,input.submit,input.reset,.area1 input,a.prev,a.next,.righticonstext,span.count,.soctext,.rightblogpagination,.postprevtop,.year,.months,span.title,span.category,.thetitlegallery,.goback,.gallerydata,.righticonstext,.notumbinspiration figcaption a,.view a.info,.videotitle .text,.videotitle .plus,header.page-title,.toppagination,.formbox input,.formbox,.contactformtitle,.pressstyle figcaption span,p.er404,.error a,p.comment-form-author,p.comment-form-url,p.comment-form-email,p.comment-form-comment,h3#reply-title,.comment-author,.story-pages p,dl.gallery-item dt,nav.prev-next-links,.filtertitle,.element figcaption span,.titleitem,figcaption .name,figcaption .profession,nav#mobilenav select {
            font-family: <?php  if(ale_get_option('titlefontfamily')){ echo ale_get_option('titlefontfamily'); } else { echo "'Oswald', sans-serif";} ?>;
        }
    </style>
    <?php if(ale_get_option('customcsscode')){ echo '<style type="text/css">'.ale_get_option('customcsscode').'</style>';} ?>
</head>
<body <?php body_class(); if(ale_get_option('background')){echo 'style="background:url('.ale_get_option('background').')"'; } if(ale_get_meta('custompagebackground')){echo 'style="background:url('.ale_get_meta('custompagebackground').')"'; }?> >
<?php if(ale_get_option('preloader')){ ?><div id="pageloader"></div><?php } ?>
<?php if(ale_get_option('siteselectcolorpreview')==1){ ?>
    <div class="colorselector cf">
        <div class="colorsboxes cf">
            <div class="selcoltitle"><?php _e('select color', 'aletheme')?></div>
            <div class="orangecol"></div>
            <div class="redcol"></div>
            <div class="blackcol"></div>
            <div class="bluecol"></div>
            <div class="greencol"></div>
            <div class="purplecol"></div>
        </div>
        <div class="colsel">

        </div>
    </div>
<?php } ?>

    <div class="topline"><a id="rel-top"></a></div>
        <div id="content-main" role="main">