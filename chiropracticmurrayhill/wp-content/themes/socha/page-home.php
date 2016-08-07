<?php
/*
 * Template name: Default Home Page
 */

get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<section id="homepage">
		<div class="flexslider">
			<ul class="slides">
				<?php $slider = ale_sliders_get_slider(ale_get_option('sliderslug'));  ?>
                <?php if($slider):?>
                    <?php foreach ($slider['slides'] as $slide) : ?>
                    <li>
                        <figure>
                            <?php if ($slide['image']) : ?>
                                <?php if($slide['url']){ echo '<a href="'.$slide['url'].'">'; } ?><img src="<?php echo $slide['image'] ?>" alt="<?php echo $slide['title']; ?>" /><?php if($slide['url']){ echo '</a>'; } ?>
                            <?php endif; ?>
                            <?php if($slide['title'] or $slide['description'] or $slide['html']){ ?><figcaption>
                                <?php if($slide['title']){ echo '<div class="mainslidertitle">'.$slide['title'].'</div>'; } ?>
                                <div class="mainsliderdescription">
                                    <?php if($slide['description']){ echo $slide['description']; } ?>
                                    <?php if($slide['html'] and $slide['description']){ echo '<br />'; } ?>
                                    <?php if($slide['html']){ echo $slide['html']; } ?>
                                    <br />
                                    <?php if($slide['url']){ echo '<a href="'.$slide['url'].'" class="sliderlinkmore">'.__('Read More').'</a>'; } ?>
                                </div>
                            </figcaption><?php } ?>
                        </figure>
                    </li>
                    <?php endforeach; ?>
                <?php endif;?>
			</ul>
            <div class="leftbox">
                <?php get_sidebar('mainmenu'); ?>
            </div>
            <div class="rightbox">
                <?php get_sidebar('othermenu'); ?>
            </div>
		</div>
	</section>
<?php endwhile; else: ?>
	<?php ale_part('notfound')?>
<?php endif; ?>
    <section class="home-bottom cf">
        <div class="othermenuhomemobile">

            <?php  include 'templates/home_top_rightmenu.php'; ?>

        </div>
        <div class="aboutmainbox">
            <div class="title"><?php echo ale_get_option('mainpageabouttitle'); ?></div>
            <div class="scrollbox">
                <p>
                    <?php echo ale_get_option('mainpageabouttext'); ?>
                </p>
            </div>
        </div>
        <div class="threemainboxes">
        <?php if(ale_get_option('homepagebottom')=='blogposts') {

            include 'templates/home_bottom_posts.php';

        } elseif (ale_get_option('homepagebottom')=='customboxes') {

            include 'templates/home_bottom_boxes.php';

        } elseif (ale_get_option('homepagebottom')=='recentposts') {

            include 'templates/home_bottom_recent.php';

        } elseif(ale_get_option('homepagebottom') == 'customcontent'){
            echo '<div class="homecustomcontent">';
            the_content();
            echo '</div>';
        } ?>
        </div>
    </section>
    <div class="cf"></div>
        <div class="homeonebottomgal">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <?php if(ale_get_meta('showtypehome')=='gallery') {

                include 'templates/home_gallery.php';

            } elseif (ale_get_meta('showtypehome')=='post') {

                include 'templates/home_blogposts.php';

            } elseif (ale_get_meta('showtypehome')=='content') { ?>

                <div class="recentgalleriesbox gallerygrid cf">
                    <div class="galleriestitle">
                        <?php _e('Wellcome', 'aletheme')?>
                    </div>
                    <div class="homecustomcontent">
                        <?php the_content(); ?>
                    </div>
                </div>

            <?php } else {

                //include 'templates/home_gallery.php';

            } ?>
            <?php endwhile; endif; ?>
        </div>
<?php get_footer(); ?>