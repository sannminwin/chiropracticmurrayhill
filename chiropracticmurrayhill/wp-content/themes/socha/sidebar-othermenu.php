<?php if(ale_get_option('righthomemenu') == 1) { ?>
<div class="rightothermenu">
    <div class="boxinrightside cf">
        <figure>
            <?php if(ale_get_option('right_first_link')) { echo '<a href="'.ale_get_option('right_first_link').'" >'; } ?>
                <?php if(ale_get_option('right_first_image')) { echo '<img src="'.ale_get_option('right_first_image').'" alt="'.ale_get_option('right_first_title').'" />'; } ?>
            <?php if(ale_get_option('right_first_link')) { echo '</a>'; } ?>
            <figcaption>
                <?php if(ale_get_option('right_first_link')) { echo '<a href="'.ale_get_option('right_first_link').'" ></a>'; } ?>
            </figcaption>
        </figure>
        <div class="inforight">
            <div class="rightboxtitle">
                <?php if(ale_get_option('right_first_link')) { echo '<a href="'.ale_get_option('right_first_link').'" >'; } ?>
                <?php echo ale_get_option('right_first_title'); ?>
                <?php if(ale_get_option('right_first_link')) { echo '</a>'; } ?>
            </div>
            <div class="rightboxdesc">
                <?php echo ale_get_option('right_first_desc'); ?>
            </div>
        </div>
    </div>
    <div class="boxinrightside cf">
        <figure>
            <?php if(ale_get_option('right_second_link')) { echo '<a href="'.ale_get_option('right_second_link').'" >'; } ?>
            <?php if(ale_get_option('right_second_image')) { echo '<img src="'.ale_get_option('right_second_image').'" alt="'.ale_get_option('right_second_title').'" />'; } ?>
            <?php if(ale_get_option('right_second_link')) { echo '</a>'; } ?>
            <figcaption>
                <?php if(ale_get_option('right_second_link')) { echo '<a href="'.ale_get_option('right_second_link').'" ></a>'; } ?>
            </figcaption>
        </figure>
        <div class="inforight">
            <div class="rightboxtitle">
                <?php if(ale_get_option('right_second_link')) { echo '<a href="'.ale_get_option('right_second_link').'" >'; } ?>
                <?php echo ale_get_option('right_second_title'); ?>
                <?php if(ale_get_option('right_second_link')) { echo '</a>'; } ?>
            </div>
            <div class="rightboxdesc">
                <?php echo ale_get_option('right_second_desc'); ?>
            </div>
        </div>
    </div>
    <div class="boxinrightside cf">
        <figure>
            <?php if(ale_get_option('right_third_link')) { echo '<a href="'.ale_get_option('right_third_link').'" >'; } ?>
            <?php if(ale_get_option('right_third_image')) { echo '<img src="'.ale_get_option('right_third_image').'" alt="'.ale_get_option('right_third_title').'" />'; } ?>
            <?php if(ale_get_option('right_third_link')) { echo '</a>'; } ?>
            <figcaption>
                <?php if(ale_get_option('right_third_link')) { echo '<a href="'.ale_get_option('right_third_link').'" ></a>'; } ?>
            </figcaption>
        </figure>
        <div class="inforight">
            <div class="rightboxtitle">
                <?php if(ale_get_option('right_third_link')) { echo '<a href="'.ale_get_option('right_third_link').'" >'; } ?>
                <?php echo ale_get_option('right_third_title'); ?>
                <?php if(ale_get_option('right_third_link')) { echo '</a>'; } ?>
            </div>
            <div class="rightboxdesc">
                <?php echo ale_get_option('right_third_desc'); ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>