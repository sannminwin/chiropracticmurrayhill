<?php get_header(); ?>
<section class="singlepage">
    <div class="leftside">
        <?php get_sidebar('mainmenu'); ?>
    </div>
    <div class="rightside">
        <?php ale_page_title('Error 404') ?>
        <section class="error">
            <p class="er404"><?php _e('404 - NOT FOUND', 'aletheme')?></p>
            <p><?php _e('Oops, This Page Could Not Be Found!', 'aletheme')?></p>
            <div class="buttons ta">
                <a href="javascript:history.go(-1)"><?php _e('Go Back', 'aletheme')?></a> -
                <a href="<?php echo home_url();?>"><?php _e('Homepage', 'aletheme')?></a>
                <?php $contact = ale_get_page('contact'); ?>
                <?php if ($contact) : ?>
                 - <a href="<?php echo get_permalink($contact->ID)?>"><?php _e('Contact Us', 'aletheme')?></a>
                <?php endif; ?>
            </div>
        </section>
    </div>
    <div class="cf"></div>
</section>
<?php get_footer(); ?>