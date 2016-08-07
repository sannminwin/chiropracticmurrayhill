<?php
/**
 * Template Name: Template About Two
 */
get_header(); ?>
<section class="singlepage">
    <div class="leftside">
        <?php get_sidebar('mainmenu'); ?>
    </div>
    <div class="rightside">
        <?php ale_part('pagehead');?>
        <div class="content aboutpage cf">

            <div class="contentaboutbox abouttwo">
                <div class="abouttwoleft">
                    <div class="whiteaboutbox">
                        <div class="paddingabouttwo">
                            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <?php the_content(); ?>
                            <?php endwhile; else: ?>
                                <?php ale_part('notfound')?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="abouttworight">
                    <div class="ourskill">
                        <h2><?php echo ale_get_meta('abouttwoskills'); ?></h2>
                        <ul class="skillul">
                            <?php if(ale_get_meta('firstskill')){ echo '<li><span class="title">'.ale_get_meta('firstskill').' ( '.ale_get_meta('firstskillper').'% )</span><div class="skillline"><div class="countline" style="width:'.ale_get_meta('firstskillper').'%"></div></div></li>'; } ?>
                            <?php if(ale_get_meta('secondskill')){ echo '<li><span class="title">'.ale_get_meta('secondskill').' ( '.ale_get_meta('secondskillper').'% )</span><div class="skillline"><div class="countline" style="width:'.ale_get_meta('secondskillper').'%"></div></div></li>'; } ?>
                            <?php if(ale_get_meta('thirdskill')){ echo '<li><span class="title">'.ale_get_meta('thirdskill').' ( '.ale_get_meta('thirdskillper').'% )</span><div class="skillline"><div class="countline" style="width:'.ale_get_meta('thirdskillper').'%"></div></div></li>'; } ?>
                            <?php if(ale_get_meta('fourthskill')){ echo '<li><span class="title">'.ale_get_meta('fourthskill').' ( '.ale_get_meta('fourthskillper').'% )</span><div class="skillline"><div class="countline" style="width:'.ale_get_meta('fourthskillper').'%"></div></div></li>'; } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="cf"></div>
        </div>
        <?php ale_part('pagefooter');?>
        <header class="page-title" style="margin-top: 40px;"><h2 class="a"><?php echo ale_get_meta('meetteamtitle'); ?></h2></header>
        <div class="ourteambox cf">
            <?php if(ale_get_meta('firstphotoperson')){ ?>
                <div class="itemteam">
                    <figure>
                        <img src="<?php echo ale_get_meta('firstphotoperson'); ?>" />
                        <figcaption class="cf">
                            <div class="name"><?php echo ale_get_meta('firstnameperson'); ?></div>
                            <div class="profession"><?php echo ale_get_meta('firstprofperson'); ?></div>
                            <div class="socsites">
                                <?php if(ale_get_meta('firstfbperson')){ echo '<a href="'.ale_get_meta('firstfbperson').'">Facebook</a>';} ?> |
                                <?php if(ale_get_meta('firsttwiperson')){ echo '<a href="'.ale_get_meta('firsttwiperson').'">Twitter</a>'; } ?>
                            </div>
                            <div class="email">
                                <?php if(ale_get_meta('firstemailperson')){ echo '<a href="mailto:'.ale_get_meta('firstemailperson').'">'.ale_get_meta('firstemailperson').'</a>'; } ?>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            <?php } ?>
            <?php if(ale_get_meta('secondphotoperson')){ ?>
                <div class="itemteam">
                    <figure>
                        <img src="<?php echo ale_get_meta('secondphotoperson'); ?>" />
                        <figcaption class="cf">
                            <div class="name"><?php echo ale_get_meta('secondnameperson'); ?></div>
                            <div class="profession"><?php echo ale_get_meta('secondprofperson'); ?></div>
                            <div class="socsites">
                                <?php if(ale_get_meta('secondfbperson')){ echo '<a href="'.ale_get_meta('secondfbperson').'">Facebook</a>';} ?> |
                                <?php if(ale_get_meta('secondtwiperson')){ echo '<a href="'.ale_get_meta('secondtwiperson').'">Twitter</a>'; } ?>
                            </div>
                            <div class="email">
                                <?php if(ale_get_meta('secondemailperson')){ echo '<a href="mailto:'.ale_get_meta('secondemailperson').'">'.ale_get_meta('secondemailperson').'</a>'; } ?>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            <?php } ?>
            <?php if(ale_get_meta('thirdphotoperson')){ ?>
                <div class="itemteam">
                    <figure>
                        <img src="<?php echo ale_get_meta('thirdphotoperson'); ?>" />
                        <figcaption class="cf">
                            <div class="name"><?php echo ale_get_meta('thirdnameperson'); ?></div>
                            <div class="profession"><?php echo ale_get_meta('thirdprofperson'); ?></div>
                            <div class="socsites">
                                <?php if(ale_get_meta('thirdfbperson')){ echo '<a href="'.ale_get_meta('thirdfbperson').'">Facebook</a>';} ?> |
                                <?php if(ale_get_meta('thirdtwiperson')){ echo '<a href="'.ale_get_meta('thirdtwiperson').'">Twitter</a>'; } ?>
                            </div>
                            <div class="email">
                                <?php if(ale_get_meta('thirdemailperson')){ echo '<a href="mailto:'.ale_get_meta('thirdemailperson').'">'.ale_get_meta('thirdemailperson').'</a>'; } ?>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="cf"></div>
</section>
<?php get_footer(); ?>