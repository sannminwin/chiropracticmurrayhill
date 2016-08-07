<?php
/**
 * Template Name: Gallery Pagination
 */
get_header();
//Set the page ID
$gallery_page_id = $post->ID;
?>
<style>
    .isotope-item {
        z-index: 2;
    }

    .isotope-hidden.isotope-item {
        pointer-events: none;
        z-index: 1;
    }
</style>
<section class="singlepage">
    <div class="leftside">
        <?php get_sidebar('mainmenu'); ?>
        <?php if(ale_get_option('leftsidebargallery')==1){ include 'templates/sidebar-gallery.php'; } ?>
    </div>
    <?php if(ale_get_option('rightsidebargallery')==1){ ?>
        <div class="rightsidebar">
            <?php include 'templates/sidebar-right-gallery.php'; ?>
        </div>
    <?php } ?>
    <div class="rightside <?php if(ale_get_option('rightsidebargallery')==1){ echo 'centerside'; } ?>">
        <div class="pagelayout gallerygrid <?php if(ale_get_meta('galcolumnsnumpag','true',$gallery_page_id)=='twocol') { echo 'gallerytwo';} elseif(ale_get_meta('galcolumnsnumpag','true',$gallery_page_id)=='threecol'){ echo 'gallerythree';} elseif(ale_get_meta('galcolumnsnumpag','true',$gallery_page_id)=='fourcol') { echo 'galleryfour';}?> cf">

            <?php
            if(ale_get_meta('itemgalcategory')){
                $termname = get_term(ale_get_meta('itemgalcategory'),'gallery-category');
                $postscatshow = '&gallery-category='.$termname->name;
            } else { $postscatshow =''; }

            query_posts('&post_type=gallery'.$postscatshow.'&posts_per_page='.ale_get_meta('itemgalpage','true',$gallery_page_id).'&paged='.$paged); ?>
            <header class="page-title">
                <h2 class="a"><?php the_title(); ?></h2>
                <div class="toppagination">
                    <div class="pagpages">
                        <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
                        <?php echo $paged; ?> of <?php echo $wp_query->max_num_pages; ?>
                    </div>
                    <div class="paglinks">
                        <?php posts_nav_link(' / ',__('NEWER'),__('OLDER')); ?>
                    </div>
                </div>
            </header>

            <div id="galcontainer" class="cf">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>



                    <div class="element <?php $terms = get_the_terms($post->id, 'gallery-category'); foreach($terms as $itcat) { echo $itcat->slug.' ';} ?>">

                        <figure>
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                if(ale_get_meta('tumbsgallerystylepag','true',$gallery_page_id)=='standtumbs'){
                                    if(ale_get_meta('galcolumnsnumpag','true',$gallery_page_id)=='twocol') {
                                        echo get_the_post_thumbnail($post->ID,'gallery-two');
                                    } elseif(ale_get_meta('galcolumnsnumpag','true',$gallery_page_id)=='threecol'){
                                        echo get_the_post_thumbnail($post->ID,'gallery-three');
                                    } elseif(ale_get_meta('galcolumnsnumpag','true',$gallery_page_id)=='fourcol') {
                                        echo get_the_post_thumbnail($post->ID,'gallery-four');
                                    }
                                } elseif(ale_get_meta('tumbsgallerystylepag','true',$gallery_page_id)=='masontumbs'){
                                    if(ale_get_meta('galcolumnsnumpag','true',$gallery_page_id)=='twocol') {
                                        echo get_the_post_thumbnail($post->ID,'gallery-two-mason');
                                    } elseif(ale_get_meta('galcolumnsnumpag','true',$gallery_page_id)=='threecol'){
                                        echo get_the_post_thumbnail($post->ID,'gallery-three-mason');
                                    } elseif(ale_get_meta('galcolumnsnumpag','true',$gallery_page_id)=='fourcol') {
                                        echo get_the_post_thumbnail($post->ID,'gallery-four-mason');
                                    }
                                }

                                ?>
                            </a>
                            <div class="titlegalleryfilter cf">
                                <div class="lefticon"></div>
                                <div class="titleitem">
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                </div>
                            </div>
                            <figcaption>
                                <a href="<?php the_permalink(); ?>"><span><?php _e('Show Images', 'aletheme')?></span></a>
                            </figcaption>
                        </figure>

                    </div>

                    <?php endwhile; else: ?>
                    <?php ale_part('notfound')?>
                    <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="cf"></div>
</section>

<?php get_footer(); ?>