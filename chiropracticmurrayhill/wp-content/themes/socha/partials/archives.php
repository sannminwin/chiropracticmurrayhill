<div id="archives" class="cf">
	<?php ale_archives(false); ?>
    <?php if(is_single()){ ?>
        <div class="postprevtop">
            <?php previous_post_link('%link', __('Prev Post', 'aletheme')); ?>
             /
            <?php next_post_link('%link', __('Next Post', 'aletheme'));
            ?>
        </div>
    <?php } else { ?>
        <div class="rightblogpagination">
            <?php posts_nav_link(' / ',__('NEWER', 'aletheme'),__('OLDER', 'aletheme')); ?>
        </div>
    <?php } ?>

</div>