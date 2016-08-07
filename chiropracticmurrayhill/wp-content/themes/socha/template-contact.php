<?php 
/**
 * Template Name: Template Contact
 */
// send contact
if (isset($_POST['contact'])) {
	$error = ale_send_contact($_POST['contact']);
}
get_header(); ?>
<section class="singlepage">
    <div class="leftside">
        <?php get_sidebar('mainmenu'); ?>
    </div>
    <div class="rightside">
        <?php ale_part('pagehead');?>
        <div class="content contactpage cf">
            <div class="leftcontactbox">
                <div class="formbox">
                    <div class="contactformtitle"><?php _e('contact form', 'aletheme')?></div>
                    <form method="post" action="<?php the_permalink();?>">
                        <?php if (isset($_GET['success'])) : ?>
                        <p class="success"><?php _e('Your email was sent successfully. Thank you for your message!', 'aletheme')?></p>
                        <?php endif; ?>
                        <?php if (isset($error) && isset($error['msg'])) : ?>
                        <p class="error"><?php echo $error['msg']?></p>
                        <?php endif; ?>
                        <p class="ta">
                            <input type="text" name="contact[name]" placeholder="<?php _e('Name', 'aletheme')?>*" value="<?php echo isset($_POST['contact']['name']) ? $_POST['contact']['name'] : ''?>" required="required" id="contact-form-name" />
                        </p>
                        <p class="ta">
                            <input type="email" name="contact[email]" placeholder="<?php _e('Email', 'aletheme')?>*" value="<?php echo isset($_POST['contact']['email']) ? $_POST['contact']['email'] : ''?>" required="required" id="contact-form-email" />
                        </p>
                        <p class="ta">
                            <input type="text" name="contact[phone]" placeholder="<?php _e('Phone', 'aletheme')?>" value="<?php echo isset($_POST['contact']['phone']) ? $_POST['contact']['phone'] : ''?>" id="contact-form-phone" />
                        </p>
                        <p class="ta">
                            <input type="text" name="contact[how]" placeholder="<?php _e('How did you find me?', 'aletheme')?>" value="<?php echo isset($_POST['contact']['how']) ? $_POST['contact']['how'] : ''?>" id="contact-form-how" />
                        </p>
                        <div class="commcont ta cf">
                            <div class="commenttextarea">
                                <textarea name="contact[message]" placeholder="<?php _e('Message', 'aletheme')?>*"  id="contact-form-message" cols="40" rows="5" required="required"><?php echo isset($_POST['contact']['message']) ? $_POST['contact']['message'] : ''?></textarea>
                            </div>
                            <div class="buttoncomment">
                                <input type="submit" class="submit" value="<?php _e('Send', 'aletheme')?>" />
                                <input name="reset" class="reset" type="reset" tabindex="5" value="<?php _e('Clear', 'aletheme')?>" />
                            </div>
                        </div>
                        <?php wp_nonce_field() ?>
                    </form>
                </div>
            </div>
            <div class="rightcontactbox">
                <figure>
                    <?php echo get_the_post_thumbnail(); ?>
                    <figcaption>
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <section class="contact cf">
                            <section class="story">
                                <?php the_content();?>
                            </section>
                        </section>
                        <?php endwhile; else: ?>
                        <?php ale_part('notfound')?>
                        <?php endif; ?>
                    </figcaption>
                </figure>
            </div>
            <div class="cf"></div>
            <?php if(ale_get_meta('mapcontact')){ ?>
                <div class="mapbox cf">
                    <header class="page-title"><h2 class="a"><?php _e('Map', 'aletheme')?></h2></header>
                    <?php echo ale_get_meta('mapcontact'); ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="cf"></div>
</section>
<?php get_footer(); ?>