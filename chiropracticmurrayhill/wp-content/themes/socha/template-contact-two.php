<?php
/**
 * Template Name: Template Contact Two
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

            <?php if(ale_get_meta('mapcontacttwo')){ ?>
            <div class="mapbox cf" style="margin-top: 0px;">
                <?php echo ale_get_meta('mapcontacttwo'); ?>
            </div>
            <?php } ?>


            <div class="contactformtwo cf">
                <div class="formbox cf">
                    <form method="post" action="<?php the_permalink();?>">
                        <?php if (isset($_GET['success'])) : ?>
                        <p class="success"><?php _e('Your email was sent successfully. Thank you for your message!', 'aletheme')?></p>
                        <?php endif; ?>
                        <?php if (isset($error) && isset($error['msg'])) : ?>
                        <p class="error"><?php echo $error['msg']?></p>
                        <?php endif; ?>
                        <p class="ta nametwo">
                            <label for="contact-form-name"><?php _e('Name', 'aletheme')?><span>*</span></label>
                            <input type="text" name="contact[name]" value="<?php echo isset($_POST['contact']['name']) ? $_POST['contact']['name'] : ''?>" required="required" id="contact-form-name" />
                        </p>
                        <p class="ta emailtwo">
                            <label for="contact-form-email"><?php _e('Email', 'aletheme')?><span>*</span></label>
                            <input type="email" name="contact[email]" value="<?php echo isset($_POST['contact']['email']) ? $_POST['contact']['email'] : ''?>" required="required" id="contact-form-email" />
                        </p>
                        <p class="ta phonetwo">
                            <label for="contact-form-phone"><?php _e('Phone', 'aletheme')?></label>
                            <input type="text" name="contact[phone]" value="<?php echo isset($_POST['contact']['phone']) ? $_POST['contact']['phone'] : ''?>" id="contact-form-phone" />
                        </p>
                        <div class="cf"></div>
                        <div class="commenttextarea">
                            <label for="contact-form-message"><?php _e('Message', 'aletheme')?><span>*</span></label>
                            <textarea name="contact[message]" id="contact-form-message" cols="40" rows="5" required="required"><?php echo isset($_POST['contact']['message']) ? $_POST['contact']['message'] : ''?></textarea>
                        </div>
                        <div class="buttoncomment">
                            <input type="submit" class="submit" value="<?php _e('Send', 'aletheme')?>" />
                            <input name="reset" class="reset" type="reset" tabindex="5" value="<?php _e('Clear', 'aletheme')?>" />
                        </div>
                        <?php wp_nonce_field() ?>
                    </form>
                </div>
            </div>
            <div class="threeboxescontact cf">
                <div class="boxcontwo">
                    <div class="title">
                        <?php _e('Our address', 'aletheme')?>:
                    </div>
                    <div class="adressbox">
                        <?php echo ale_get_meta('adresstwo'); ?>
                    </div>
                </div>
                <div class="boxcontwo">
                    <div class="title">
                        <?php _e('Contact details', 'aletheme')?>:
                    </div>
                    <div class="contactdetails">
                        <?php if(ale_get_meta('conemailtwo')) { ?><span class="pmico"><a href="mailto:<?php echo ale_get_meta('conemailtwo'); ?>"><?php echo ale_get_meta('conemailtwo'); ?></a></span><?php } ?>
                        <?php if(ale_get_option('twi')){ ?><span class="twiico"><a href="http://twitter.com/#!/<?php echo ale_get_option('twi'); ?>"><?php echo ale_get_option('twi'); ?></a></span><?php } ?>
                    </div>
                </div>
                <div class="boxcontwo">
                    <div class="title">
                        <?php _e('Phone number', 'aletheme')?>:
                    </div>
                    <div class="phoneconsbox">
                        <?php if(ale_get_meta('conphonetwo')) { ?></php><span class="phoico"><?php echo ale_get_meta('conphonetwo'); ?></span><?php } ?>
                    </div>
                </div>
            </div>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <section class="contact cf">
                    <section class="story contacttwostory">
                        <?php the_content();?>
                    </section>
                </section>
            <?php endwhile; else: ?>
                 <?php ale_part('notfound')?>
            <?php endif; ?>

            <div class="cf"></div>

        </div>
    </div>
    <div class="cf"></div>
</section>
<?php get_footer(); ?>