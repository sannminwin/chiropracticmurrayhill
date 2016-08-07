<?php

$theme = new Theme();
$theme->init(array(
    "theme_name" => "Paragon",
    "theme_slug" => "MK"
));


class Theme
{
    function init($options)
    {
        $this->constants($options);
        add_action('init', array(
            &$this,
            'language'
        ));
        
        $this->functions();
        $this->plugins();
        $this->admin();
        
        add_action('after_setup_theme', array(
            &$this,
            'supports'
        ));
        add_action('widgets_init', array(
            &$this,
            'widgets'
        ));
        
        @ini_set('pcre.backtrack_limit', 500000);

        if ( ! isset( $content_width ) ) {
            $content_width = 760;
        }
            
       if((int)@ini_get('memory_limit')<64){
            @ini_set('memory_limit', '64M');
        }
        
    }
    
    
    
    
    
    
    function constants($options)
    {
        define("THEME_DIR", get_template_directory());
        define("THEME_DIR_URI", get_template_directory_uri());
        define("THEME_NAME", $options["theme_name"]);
        if ( defined( "ICL_LANGUAGE_CODE" )) {$lang="_".ICL_LANGUAGE_CODE;} else {$lang = "";}
        define( "THEME_OPTIONS", $options["theme_name"] . '_options' . $lang );
        define("THEME_SLUG", $options["theme_slug"]);
        
        /* ------ */
        define("THEME_STYLES", THEME_DIR_URI . "/stylesheet/css");
        define("THEME_LESS", THEME_DIR_URI . "/less");
        define("THEME_IMAGES", THEME_DIR_URI . "/images");
        define("THEME_CACHE_DIR", THEME_DIR . "/cache");
        define("THEME_JS", THEME_DIR_URI . "/js");
        
        define('FONTFACE_DIR', THEME_DIR . '/fontface');
        define('FONTFACE_URI', THEME_DIR_URI . '/fontface');
        define("THEME_CACHE_URI", THEME_DIR_URI . "/cache");
        
        /* ------ */
        define("THEME_FRAMEWORK", THEME_DIR . "/framework");
        define("THEME_PLUGINS", THEME_FRAMEWORK . "/plugins");
        define("THEME_PLUGINS_URI", THEME_DIR_URI . "/framework/plugins" );
        define("THEME_SHORTCODES", THEME_FRAMEWORK . "/shortcodes");
        define("THEME_WIDGETS", THEME_FRAMEWORK . "/widgets");
        define("THEME_SLIDERS", THEME_FRAMEWORK . "/sliders");
        define("THEME_HELPERS", THEME_FRAMEWORK . "/helpers");
        define("THEME_FUNCTIONS", THEME_FRAMEWORK . "/functions");
        define("THEME_CLASSES", THEME_FRAMEWORK . "/classes");
        
        /* ------ */
        define('THEME_ADMIN', THEME_FRAMEWORK . '/admin');
        define('THEME_METABOXES', THEME_ADMIN . '/metaboxes');
        define('THEME_ADMIN_POST_TYPES', THEME_ADMIN . '/post-types');
        define('THEME_GENERATORS', THEME_ADMIN . '/generators');
        define('THEME_ADMIN_URI', THEME_DIR_URI . '/framework/admin');
        define('THEME_ADMIN_ASSETS_URI', THEME_DIR_URI . '/framework/admin/assets');
        
    }
    
    
    
    function widgets()
    {
        
        require_once(THEME_WIDGETS . "/widgets-advertisement.php");
        require_once(THEME_WIDGETS . "/widgets-contact-form.php");
        require_once(THEME_WIDGETS . "/widgets-contact-info.php");
        require_once(THEME_WIDGETS . "/widgets-gmap.php");
        require_once(THEME_WIDGETS . "/widgets-popular-posts.php");
        require_once(THEME_WIDGETS . "/widgets-related-posts.php");
        require_once(THEME_WIDGETS . "/widgets-recent-posts.php");
        require_once(THEME_WIDGETS . "/widgets-social-networks.php");
        require_once(THEME_WIDGETS . "/widgets-subnav.php");
        require_once(THEME_WIDGETS . "/widgets-testimonials.php");
        require_once(THEME_WIDGETS . "/widgets-twitter-feeds.php");
        require_once(THEME_WIDGETS . "/widgets-video.php");
        require_once(THEME_WIDGETS . "/widgets-flickr-feeds.php");
        require_once(THEME_WIDGETS . "/widgets-instagram-feeds.php");
        require_once(THEME_WIDGETS . "/widgets-dribbble-feeds.php");
        require_once(THEME_WIDGETS . "/widgets-pinterest-feeds.php");
        require_once(THEME_WIDGETS . "/widgets-big-numbers.php");


        register_widget("Artbees_Widget_Popular_Posts");
        register_widget("Artbees_Widget_Recent_Posts");		
        register_widget("Artbees_Widget_Related_Posts");
        register_widget("Artbees_Widget_Twitter");
        register_widget("Artbees_Widget_Advertisement");
        register_widget("Artbees_Widget_Contact_Form");	
        register_widget("Artbees_Widget_Contact_Info");		
        register_widget("Artbees_Widget_Social");
        register_widget("Artbees_Widget_Sub_Navigation");		
        register_widget("Artbees_Widget_Google_Map");		
        register_widget("Artbees_Widget_Testimonials");	
        register_widget("Artbees_Widget_video");
        register_widget("Artbees_Widget_Flickr_feeds");	
        register_widget("Artbees_Widget_instagram_feeds");
        register_widget("Artbees_Widget_dribbble_feeds");
        register_widget("Artbees_Widget_pinterest_feeds");
        register_widget("Artbees_Widget_big_numbers");
        
    }
    
    
    
    function plugins()
    {
        
        $layerslider = THEME_PLUGINS . "/layerslider/layerslider.php";
        if(file_exists($layerslider)) {
                include $layerslider;
         if(get_option('lucidpress_layerslider_activated', '0') == '0') {
                    layerslider_activation_scripts();
                update_option('lucidpress_layerslider_activated', '1');
             }
        } 

        $revslider = THEME_PLUGINS . "/revslider/revslider.php";
        if(file_exists($revslider)) {
                include $revslider;
         if(get_option('lucidpress_revslider_activated', '0') == '0') {
                    mk_create_revslider_tables();
                update_option('lucidpress_revslider_activated', '1');
             }
        } 
       
        require_once(THEME_FRAMEWORK . "/page-composer/js_composer.php");

    }
    
    






    function supports()
    {
        if (function_exists('add_theme_support')) {
            add_theme_support('menus');
            add_theme_support('automatic-feed-links');
            add_theme_support('editor-style');
            register_nav_menus(array(
                'primary-menu' => THEME_NAME . ' Main Navigation',
            ));
            register_nav_menus(array(
                'footer-menu' => THEME_NAME . ' Footer Navigation',
            ));

             add_theme_support('post-thumbnails', array(
                'post',
                'portfolio',
                'slideshow'
            ));
              

        }  
    }








    
    function functions()
    {
        $this->options();    
        require_once(THEME_FUNCTIONS . "/general-functions.php");
        require_once(THEME_FUNCTIONS . "/enqueue-front-scripts.php");
        require_once(THEME_CLASSES . "/theme-class.php");
        require_once(THEME_GENERATORS . '/sidebar-generator.php');
        require_once(THEME_FUNCTIONS . "/portfolio-types.php");
        require_once(THEME_FRAMEWORK . "/upgrade/init.php");
        
        if(theme_option( THEME_OPTIONS, 'enable_woocommerce' ) == 'true') {
            require_once(THEME_FUNCTIONS . "/mk-woocommerce.php");
        }
        

    }

    
    
    
    function language()
    {
        $locale = get_locale();
        if (is_admin()) {
            load_theme_textdomain('theme_backend', THEME_DIR . '/lang');
            $locale_file = THEME_ADMIN . "/lang/$locale.php";
        } else {
            load_theme_textdomain('theme_frontend', THEME_DIR . '/lang');
            $locale_file = THEME_DIR . "/lang/$locale.php";
        }
        
        
        if (is_readable($locale_file)) {
            require_once($locale_file);
        }
    }
    
    
    function options()
    {
        global $theme_options;
        $theme_options = array();
        $option_files  = array(
            'masterkey'
        );
        	foreach ($option_files as $file) {
            $page = include(THEME_ADMIN . "/admin-panel/" . $file . '.php');
            $theme_options[$page['name']] = array();
            foreach ($page['options'] as $option) {
                if (isset($option['default'])) {
                    $theme_options[$page['name']][$option['id']] = $option['default'];
                }
            }
            $theme_options[$page['name']] = array_merge((array) $theme_options[$page['name']], (array) get_option($page['name']));
        }
        
        
    }
    
    
    
    
    function admin()
    {
        if (is_admin()) {
            require_once(THEME_ADMIN . '/admin.php');
            $admin = new Theme_admin();
            $admin->init();
            
        }
    }
    
}


?>