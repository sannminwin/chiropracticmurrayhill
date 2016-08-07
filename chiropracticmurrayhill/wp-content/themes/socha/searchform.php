<form role="search" method="get" id="searchform" action="<?php echo site_url()?>" >
    <fieldset>
        <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php _e('Type here...', 'aletheme')?>" />
        <input type="submit" id="searchsubmit" value="<?php _e('Go', 'aletheme')?>" />
    </fieldset>
</form>