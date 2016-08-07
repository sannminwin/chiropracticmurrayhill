<?php
/**
 * Template name: Home Page Style Two
 */

get_header(); ?>
<section class="singlepage">
    <div class="leftside">
        <?php get_sidebar('mainmenu'); ?>
    </div>
    <div class="rightside">
        <div class="slider-wrapper theme-default">
            <?php $slider = ale_sliders_get_slider(ale_get_option('sliderslug'));  ?>
            <?php if($slider):?>
            <div id="slider" class="nivoSlider">
                <?php $i=0; ?>
                <?php foreach ($slider['slides'] as $slide) : ?>
                    <?php if($slide['url']){ echo '<a href="'.$slide['url'].'">'; } ?><img src="<?php echo $slide['image'] ?>" data-thumb="<?php echo $slide['image'] ?>" data-transition="<?php echo ale_get_meta('slidereffect'); ?>" alt="<?php echo $slide['title']; ?>" title="<?php if($slide['title']){ echo '#'.$i; }?>" /><?php if($slide['url']){ echo '</a>'; } ?>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </div>
            <?php $j=0; ?>
                <?php foreach ($slider['slides'] as $slide) : ?>
                    <?php if($slide['title']){ ?>
                        <div id="<?php echo $j; ?>" class="nivo-html-caption">
                            <?php if($slide['title']){ ?><div class="mainslidertitle"><?php echo $slide['title']; ?></div><?php } ?>
                            <div class="mainsliderdescription">
                                <?php if($slide['description']){ echo $slide['description']; } ?>
                                <?php if($slide['html'] and $slide['description']){ echo '<br />'; } ?>
                                <?php if($slide['html']){ echo $slide['html']; } ?>
                                <br />
                                <?php if($slide['url']){ echo '<a href="'.$slide['url'].'" class="sliderlinkmore">'.__('Read More').'</a>'; } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php $j++;?>
                <?php endforeach; ?>
            <?php endif;?>
        </div>
        <div class="cf"></div>
    </div>
    <div class="cf"></div>
    <?php if(ale_get_meta('showtypehome')=='gallery') {

        include 'templates/home_gallery.php';

    } elseif (ale_get_meta('showtypehome')=='post') {

        include 'templates/home_blogposts.php';

    } elseif (ale_get_meta('showtypehome')=='content') {

        include 'templates/home_customcontent.php';

    } else {

        include 'templates/home_gallery.php';

    } ?>
</section>

<?php get_footer(); ?>