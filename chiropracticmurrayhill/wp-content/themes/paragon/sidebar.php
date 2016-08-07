<aside id="mk-sidebar">
    <div class="sidebar-wrapper">
    <?php  if(isset($post)){theme_class('sidebar',$post->ID);}else{theme_class('sidebar');} ?>
    </div>
</aside>