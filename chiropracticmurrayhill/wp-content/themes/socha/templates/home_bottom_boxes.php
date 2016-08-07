<div class="recentwork">
    <?php if(ale_get_option('firstbottomblocktitle')){ echo '<div class="boxtitle">'.ale_get_option('firstbottomblocktitle').'</div>'; }?>
    <div class="postbox">
        <figure>
            <?php if(ale_get_option('firstbottomitemlink')) { echo '<a href="'.ale_get_option('firstbottomitemlink').'">';} ?><img src="<?php echo ale_get_option('firstbottomitemimage'); ?>" /><?php if(ale_get_option('firstbottomitemlink')) { echo '</a>'; } ?>
            <figcaption><?php if(ale_get_option('firstbottomitemlink')) { echo '<a href="'.ale_get_option('firstbottomitemlink').'"></a>';} ?></figcaption>
        </figure>
        <div class="whitebox">
            <div class="title">
                <?php if(ale_get_option('firstbottomitemlink')) { echo '<a href="'.ale_get_option('firstbottomitemlink').'">';} ?><?php echo ale_get_option('firstbottomitemtitle'); ?><?php if(ale_get_option('firstbottomitemlink')) { echo '</a>'; } ?>
            </div>
            <div class="category">
                <?php echo ale_get_option('firstbottomitemcategory'); ?>
            </div>
        </div>
    </div>
</div>
<div class="letsdiscus">
    <?php if(ale_get_option('secondbottomblocktitle')){ echo '<div class="boxtitle">'.ale_get_option('secondbottomblocktitle').'</div>'; }?>
    <div class="postbox">
        <figure>
            <?php if(ale_get_option('secondbottomitemlink')) { echo '<a href="'.ale_get_option('secondbottomitemlink').'">';} ?><img src="<?php echo ale_get_option('secondbottomitemimage'); ?>" /><?php if(ale_get_option('secondbottomitemlink')) { echo '</a>'; } ?>
            <figcaption><?php if(ale_get_option('firstbottomitemlink')) { echo '<a href="'.ale_get_option('secondbottomitemlink').'"></a>';} ?></figcaption>
        </figure>
        <div class="whitebox">
            <div class="title">
                <?php if(ale_get_option('secondbottomitemlink')) { echo '<a href="'.ale_get_option('secondbottomitemlink').'">';} ?><?php echo ale_get_option('secondbottomitemtitle'); ?><?php if(ale_get_option('secondbottomitemlink')) { echo '</a>'; } ?>
            </div>
            <div class="category">
                <?php echo ale_get_option('secondbottomitemcategory'); ?>
            </div>
        </div>
    </div>
</div>
<div class="mostvoted">
    <?php if(ale_get_option('thirdbottomblocktitle')){ echo '<div class="boxtitle">'.ale_get_option('thirdbottomblocktitle').'</div>'; }?>
    <div class="postbox">
        <figure>
            <?php if(ale_get_option('thirdbottomitemlink')) { echo '<a href="'.ale_get_option('thirdbottomitemlink').'">';} ?><img src="<?php echo ale_get_option('thirdbottomitemimage'); ?>" /><?php if(ale_get_option('thirdbottomitemlink')) { echo '</a>'; } ?>
            <figcaption><?php if(ale_get_option('thirdbottomitemlink')) { echo '<a href="'.ale_get_option('thirdbottomitemlink').'"></a>';} ?></figcaption>
        </figure>
        <div class="whitebox">
            <div class="title">
                <?php if(ale_get_option('thirdbottomitemlink')) { echo '<a href="'.ale_get_option('thirdbottomitemlink').'">';} ?><?php echo ale_get_option('thirdbottomitemtitle'); ?><?php if(ale_get_option('thirdbottomitemlink')) { echo '</a>'; } ?>
            </div>
            <div class="category">
                <?php echo ale_get_option('thirdbottomitemcategory'); ?>
            </div>
        </div>
    </div>
</div>