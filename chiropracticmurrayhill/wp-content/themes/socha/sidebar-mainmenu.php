<div class="leftmenubox">
    <header id="leftheader" class="cf">
        <div class="logo">

            <?php if(ale_get_option('sitelogo')){ ?>
                <h1 class="customlogo">
                    <a href="<?php echo home_url(); ?>"><img src="<?php echo ale_get_option('sitelogo'); ?>" /></a>
                </h1>
            <?php } else { ?>
                <h1 class="image">
                    <a href="<?php echo home_url(); ?>" style="background: url(<?php echo get_template_directory_uri(); ?>/css/images/logo.png) 50% 50% no-repeat;"><?php echo bloginfo('title'); ?></a>
                </h1>
            <?php } ?>

        </div>
        <nav id="leftnav" role="navigation">
            <?php

            if ( has_nav_menu( 'header_menu' ) ) {
                wp_nav_menu(array(
                    'theme_location'=> 'header_menu',
                    'menu'			=> 'Header Menu',
                    'menu_class'	=> 'leftmenu cf',
                    'walker'		=> new Aletheme_Nav_Walker(),
                    'container'		=> '',
                ));
            }
            ?>
            <?php if(ale_get_option('showsocialicon')=='1'){ ?>
            <div class="social cf">
                <div class="followtitle"><?php _e('Follow', 'aletheme')?></div>
                <div class="socialslider">
                    <ul class="socialicons">
                        <?php if(ale_get_option('fb')){ echo '<li><a href="'.ale_get_option('fb').'" rel="external" class="fbicon" >Facebook</a></li>'; } ?>
                        <?php if(ale_get_option('twi')){ echo '<li><a href="http://twitter.com/#!/'.ale_get_option('twi').'" rel="external" class="twiicon" >Twitter</a></li>'; } ?>
                        <?php if(ale_get_option('gog')){ echo '<li><a href="'.ale_get_option('gog').'" rel="external" class="gogicon" >Google+</a></li>'; } ?>
                        <?php if(ale_get_option('pint')){ echo '<li><a href="'.ale_get_option('pint').'" rel="external" class="pinticon" >Pinterest</a></li>'; } ?>
                        <?php if(ale_get_option('youtube')){ echo '<li><a href="'.ale_get_option('youtube').'" rel="external" class="youtubeicon" >You Tube</a></li>'; } ?>
                        <?php if(ale_get_option('vim')){ echo '<li><a href="'.ale_get_option('vim').'" rel="external" class="vimicon" >Vimeo</a></li>'; } ?>
                        <?php if(ale_get_option('flickr')){ echo '<li><a href="'.ale_get_option('flickr').'" rel="external" class="flickricon" >Flickr</a></li>'; } ?>
                        <?php if(ale_get_option('dri')){ echo '<li><a href="'.ale_get_option('dri').'" rel="external" class="driicon" >Dribble</a></li>'; } ?>
                        <?php if(ale_get_option('inta')){ echo '<li><a href="'.ale_get_option('inta').'" rel="external" class="instaicon" >Instagram</a></li>'; } ?>
                        <?php if(ale_get_option('liin')){ echo '<li><a href="'.ale_get_option('liin').'" rel="external" class="liinicon" >Linked in</a></li>'; } ?>
                        <?php if(ale_get_option('pica')){ echo '<li><a href="'.ale_get_option('pica').'" rel="external" class="picaicon" >Picassa</a></li>'; } ?>
                        <?php if(ale_get_option('rssicon')){?><li><a href="<?php echo home_url(); ?>/feed" rel="external" class="rssicon">RSS</a></li><?php } ?>
                    </ul>
                </div>
            </div>
            <?php } ?>
        </nav>

        <nav id="mobilenav" role="navigation">
            <?php
            if ( has_nav_menu( 'header_menu' ) ) {
                wp_nav_menu(array(
                'theme_location'=> 'header_menu',
                'menu'   => 'Header Menu',
                'menu_class' => 'mobilemenu',
                'container'  => '',
                'items_wrap' => '<select id="%1$s" class="%2$s drop">%3$s</select>',
                'indent_string' => '&ndash;&nbsp;',
                'indent_after' => '',
                'walker' => new Aletheme_Dropdown_Nav_Walker(),
                ));
            } ?>
            <?php if(ale_get_option('showsocialicon')=='1'){ ?>
            <div class="social cf">
                <div class="followtitle"><?php _e('Follow', 'aletheme')?></div>
                <div class="socialslider">
                    <ul class="mobsocialicons">
                        <?php if(ale_get_option('fb')){ echo '<li><a href="'.ale_get_option('fb').'" rel="external" class="fbicon" >Facebook</a></li>'; } ?>
                        <?php if(ale_get_option('twi')){ echo '<li><a href="http://twitter.com/#!/'.ale_get_option('twi').'" rel="external" class="twiicon" >Twitter</a></li>'; } ?>
                        <?php if(ale_get_option('gog')){ echo '<li><a href="'.ale_get_option('gog').'" rel="external" class="gogicon" >Google+</a></li>'; } ?>
                        <?php if(ale_get_option('pint')){ echo '<li><a href="'.ale_get_option('pint').'" rel="external" class="pinticon" >Pinterest</a></li>'; } ?>
                        <?php if(ale_get_option('youtube')){ echo '<li><a href="'.ale_get_option('youtube').'" rel="external" class="youtubeicon" >You Tube</a></li>'; } ?>
                        <?php if(ale_get_option('vim')){ echo '<li><a href="'.ale_get_option('vim').'" rel="external" class="vimicon" >Vimeo</a></li>'; } ?>
                        <?php if(ale_get_option('flickr')){ echo '<li><a href="'.ale_get_option('flickr').'" rel="external" class="flickricon" >Flickr</a></li>'; } ?>
                        <?php if(ale_get_option('dri')){ echo '<li><a href="'.ale_get_option('dri').'" rel="external" class="driicon" >Dribble</a></li>'; } ?>
                        <?php if(ale_get_option('inta')){ echo '<li><a href="'.ale_get_option('inta').'" rel="external" class="instaicon" >Instagram</a></li>'; } ?>
                        <?php if(ale_get_option('liin')){ echo '<li><a href="'.ale_get_option('liin').'" rel="external" class="liinicon" >Linked in</a></li>'; } ?>
                        <?php if(ale_get_option('pica')){ echo '<li><a href="'.ale_get_option('pica').'" rel="external" class="picaicon" >Picassa</a></li>'; } ?>
                        <?php if(ale_get_option('rssicon')){?><li><a href="<?php echo home_url(); ?>/feed" rel="external" class="rssicon">RSS</a></li><?php } ?>
                    </ul>
                </div>
            </div>
            <?php } ?>
        </nav>
    </header>
</div>