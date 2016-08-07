<section class="story cf">
    <div class="boxcontent cf">
	    <?php the_content(); ?>
    </div>
    <?php wp_link_pages(array(
        'before' => '<section class="story-pages"><p>' . __('Pages:', 'aletheme'),
        'after'	 => '</p></section>',
    )) ?>
</section>
