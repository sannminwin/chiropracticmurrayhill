<?php get_header(); ?>
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
        <?php if(ale_get_option('topgallerybox')==1){ ?>
        <div class="postnavigation cf">
            <div class="categoriesbox">
                <div class="title"><?php _e('gallery CATEGORIES', 'aletheme')?>:</div>
                <ul class="categorieslist">
                    <?php
                    $gallery_cat = get_terms( 'gallery-category', array(
                        'orderby'    => 'count',
                        'hide_empty' => 1
                    ) );


                    echo '<li><a href="'.home_url().'/galleries/" >'.__('All').'</a></li>';
                    foreach($gallery_cat as $cat){
                        echo '<li><a href="'.get_term_link( $cat->slug, 'gallery-category').'">'.$cat->name.'</a></li>';
                    }
                    ?>
                    <li></li>
                </ul>
            </div>
        </div>
        <?php } else { echo "<br />"; } ?>
        <div id="post" class="content cf">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="post post-<?php echo $post->ID; ?> gallery type-gallery status-publish hentry" id="post-<?php echo $post->ID; ?>" data-post-id="<?php echo $post->ID; ?>">
                <div class="galleysingle">
                    <div class="thetitlegallery">
                        <h2 class="a"><?php the_title(); ?></h2>
                        <a href="javascript:history.go(-1)" class="goback"><?php _e('Go Back', 'aletheme')?></a>
                    </div>
                    <div class="gallerydata">
                        Category:
                        <?php
                        $current_category = wp_get_post_terms($post->ID, 'gallery-category', array("fields" => "all"));
                        foreach($current_category as $curcat){
                            echo $curcat->name.' ';
                        }
                        ?>

                        <?php if(ale_get_meta('location')){echo "/ ".__('Location').": ".ale_get_meta('location'); } ?>
                        <?php if(ale_get_meta('eventdate')){echo "/ ".__('Date').": ".date("d M-Y", strtotime(ale_get_meta('eventdate'))); } ?>
                    </div>
                    <?php if ( !post_password_required() ) { ?>
                    <div class="gallerybox">
                        <div class="galleryslider ta">
                            <ul class="slides">
                                <?php
                                $args = array(
                                    'post_type' => 'attachment',
                                    'numberposts' => -1,
                                    'post_status' => null,
                                    'order'				=> 'ASC',
                                    'orderby'			=> 'menu_order ID',
                                    'meta_query'		=> array(
                                        array(
                                            'key'		=> '_ale_hide_from_gallery',
                                            'value'		=> 0,
                                            'type'		=> 'DECIMAL',
                                        ),
                                    ),
                                    'post_parent' => $post->ID
                                );
                                $attachments = get_posts( $args );
                                if ( $attachments ) {
                                    foreach ( $attachments as $attachment ) {
                                        echo "<li>".wp_get_attachment_image( $attachment->ID, 'gallery-slider' )."</li>";
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="carousel">
                            <ul class="slides">
                                <?php
                                $args = array(
                                    'post_type' => 'attachment',
                                    'numberposts' => -1,
                                    'post_status' => null,
                                    'order'				=> 'ASC',
                                    'orderby'			=> 'menu_order ID',
                                    'meta_query'		=> array(
                                        array(
                                            'key'		=> '_ale_hide_from_gallery',
                                            'value'		=> 0,
                                            'type'		=> 'DECIMAL',
                                        ),
                                    ),
                                    'post_parent' => $post->ID
                                );
                                $attachments = get_posts( $args );
                                if ( $attachments ) {
                                    foreach ( $attachments as $attachment ) {
                                        echo "<li>".wp_get_attachment_image( $attachment->ID, 'gallery-minitumba' )."</li>";
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="soclikesline cf">
                        <div class="lefticons">
                            <div class="couintbox"><?php echo getPostLikeLink($post->ID); ?></div><div class="soctext"> &nbsp;<?php _e('likes', 'aletheme')?> </div>
                        </div>
                        <div class="righticons">
                            <?php if (ale_get_option('social_sharing')) : ?>
                            <div class="righticonstext">
                                <?php _e('Share this gallery', 'aletheme')?>:
                            </div>
                            <div class="righticonsbuttons">
                                <a href="<?php echo ale_get_share('fb'); ?>" class="fbicon" onclick="window.open(this.href, 'Share on Facebook', 'width=600,height=300'); return false">Facebook</a>
                                <a href="<?php echo ale_get_share('twi'); ?>" class="twiicon" onclick="window.open(this.href, 'Share on Twitter', 'width=600,height=300'); return false">Twitter</a>
                                <a href="<?php echo ale_get_share('goglp'); ?>" class="gooplus" onclick="window.open(this.href, 'Share on Google+', 'width=600,height=300'); return false">Google+</a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if(get_the_content()){ ?>
                        <div class="gallerycontent cf">
                            <?php the_content(); ?>
                        </div>
                    <?php } ?>

                    <?php if ( !post_password_required() ) { ?>
                    <section class="full">
                        <?php if(ale_get_option('commentongallery') == 1){ comments_template(); } ?>
                    </section>
                    <?php } ?>
                </div>
            </article>
            <?php endwhile; else: ?>
            <?php ale_part('notfound')?>
            <?php endif; ?>
        </div>
    </div>
    <div class="cf"></div>
</section>
<?php get_footer(); ?>