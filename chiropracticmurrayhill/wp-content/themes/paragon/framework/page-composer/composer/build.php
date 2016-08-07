<?php
/**
 * WPBakery Visual Composer build plugin
 *
 * @package WPBakeryVisualComposer
 *
 */


if (!defined('ABSPATH')) die('-1');

class WPBakeryVisualComposerSetup extends WPBakeryVisualComposerAbstract {
    public static $version = '3.0.2'; //TODO: Is this used somewhere?
    protected $composer;

    public function __construct() {
    }

    public function init($settings) {

        parent::init($settings);

        $this->composer = WPBakeryVisualComposer::getInstance();

        $this->composer->createColumnShortCode(); // Refactored
        $this->addAction('init', 'setUp');
        
    }
    
    public function setUp() {
       
            $this->composer->setPlugin();
            $this->setUpPlugin();
            load_plugin_textdomain( 'js_composer', false,  self::$config['APP_DIR'].'locale/' );


        if ( function_exists( 'add_theme_support' ) ) {
        	add_theme_support( 'post-thumbnails');
        }
        
        add_post_type_support( 'page', 'excerpt' );	    
    }
    
    public function setUpPlugin() {
        register_activation_hook( __FILE__, Array( $this, 'activate' ) );
        if (!is_admin()) {
            $this->addFilter('the_content', 'fixPContent', 11); //If weight is higher then 11 it doesn work... why?
            $this->addFilter('body_class', 'jsComposerBodyClass');
        }
    }

    public function fixPContent($content = null) {
        //$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
        $s = array("<p><div class=\"row-fluid\"", "</div></p>");
        $r = array("<div class=\"row-fluid\"", "</div>");
        $content = str_ireplace($s, $r, $content);
        return $content;
    }


    /* Activation hook for plugin */
    public function activate() {
        add_option( 'wpb_js_composer_do_activation_redirect', true );
    }

    public function setUpTheme() {
           $this->setUpPlugin();
    }


    public function jsComposerBodyClass($classes) {
        $classes[] = 'wpb-js-composer js-comp-ver-'.WPB_VC_VERSION;
        return $classes;
    }
}

/* Setup for admin */

class WPBakeryVisualComposerSetupAdmin extends WPBakeryVisualComposerSetup {
    public function __construct() {
        parent::__construct();
    }

    /* Setup plugin composer */

    public function setUpPlugin() {
    	global $current_user;
    	get_currentuserinfo();
    	
        /** @var $settings - get use group access rules */
        $settings = WPBakeryVisualComposerSettings::get('groups_access_rules');

        parent::setUpPlugin();
        $show = true;
        foreach($current_user->roles as $role) {
	        if(isset($settings[$role]['show']) && $settings[$role]['show']==='no') {
		        $show = false;
		        break;
	        }
        }
        
        if ($show) {
            $this->composer->addAction( 'edit_post', 'saveMetaBoxes' );
            $this->composer->addAction( 'wp_ajax_wpb_get_element_backend_html', 'elementBackendHtmlJavascript_callback' );
            $this->composer->addAction( 'wp_ajax_wpb_shortcodes_to_visualComposer', 'shortCodesVisualComposerJavascript_callback' );
            $this->composer->addAction( 'wp_ajax_wpb_show_edit_form', 'showEditFormJavascript_callback' );
            $this->composer->addAction('wp_ajax_wpb_save_template', 'saveTemplateJavascript_callback');
            $this->composer->addAction('wp_ajax_wpb_load_template', 'loadTemplateJavascript_callback');
            $this->composer->addAction('wp_ajax_wpb_delete_template', 'deleteTemplateJavascript_callback');
            $this->addAction( 'admin_init', 'jsComposerEditPage', 5 );
        }
        // Add specific CSS class by filter
        $this->addFilter('body_class', 'jsComposerBodyClass');
        $this->addFilter( 'get_media_item_args', 'jsForceSend' );

        $this->addAction( 'admin_init', 'composerRedirect' );


        //$this->addAction( 'admin_init', 'registerCss' );
        $this->addAction( 'admin_init', 'registerJavascript' );

        $this->addAction( 'admin_menu','composerSettings' );

        $this->addAction( 'admin_print_scripts-post.php', 'editScreen_js' );
        $this->addAction( 'admin_print_scripts-post-new.php', 'editScreen_js' );

        /* Create Media tab for images */
        $this->composer->createImagesMediaTab();


    }

    /*
     * Set up theme filters and actions
     *
     */
    public function setUpTheme() {
        $this->setUpPlugin();
        $this->addAction('admin_init', 'themeScreen_js');
    }


    public function jsForceSend($args) {
        $args['send'] = true;
        return $args;
    }

    public function themeScreen_js() {
        wp_enqueue_script('wpb_js_theme_admin');
    }

    public function editScreen_js() {

        if(in_array(get_post_type(), $this->composer->getPostTypes())) {
           // wp_enqueue_style('bootstrap');
            //wp_enqueue_style('ui-custom-theme');
            wp_enqueue_style('js_composer');

            wp_enqueue_script('jquery-ui-tabs');
            wp_enqueue_script('jquery-ui-droppable');
            wp_enqueue_script('jquery-ui-draggable');
            wp_enqueue_script('jquery-ui-accordion');

            wp_enqueue_script('bootstrap-js');
            wp_enqueue_script('wpb_js_composer_js');
        }

    }

    public function registerJavascript() {
        wp_register_script('wpb_js_composer_js', $this->composer->assetURL( 'js_composer.js' ), array('jquery'), WPB_VC_VERSION, true);

        wp_localize_script( 'wpb_js_composer_js', 'i18nLocale', array(
            'add_remove_picture' => __( 'Add/remove picture', 'js_composer' ),
            'finish_adding_text' => __( 'Finish Adding Images', 'js_composer' ),
            'add_image' => __( 'Add Image', 'js_composer' ),
            'add_images' => __( 'Add Images', 'js_composer' ),
            'main_button_title' => __( 'Page Composer', 'js_composer' ),
            'main_button_title_revert' => __( 'Classic editor', 'js_composer' ),
            'please_enter_templates_name' => __('Please enter templates name', 'js_composer'),
            'confirm_deleting_template' => __('Confirm deleting "{template_name}" template, press Cancel to leave. This action cannot be undone.', 'js_composer'),
            'press_ok_to_delete_section' => __('Press OK to delete section, Cancel to leave', 'js_composer'),
            'press_ok_to_pop_section' => __('Press OK to pop (move) section to the top level, Cancel to leave', 'js_composer'),
            'drag_drop_me_in_column' => __('Drag and drop me in the column', 'js_composer'),
            'press_ok_to_delete_tab' => __('Press OK to delete "{tab_name}" tab, Cancel to leave', 'js_composer'),
            'slide' => __('Slide', 'js_composer'),
            'tab' => __('Tab', 'js_composer'),
            'please_enter_new_tab_title' => __('Please enter new tab title', 'js_composer'),
            'press_ok_delete_section' => __('Press OK to delete "{tab_name}" section, Cancel to leave', 'js_composer'),
            'section_default_title' => __('Section', 'js_composer'),
            'please_enter_section_title' => __('Please enter new section title', 'js_composer')
        ) );

        wp_register_script('bootstrap-js', $this->composer->assetURL( 'bootstrap/js/bootstrap.min.js' ), false, WPB_VC_VERSION, true);
        wp_register_script('wpb_js_theme_admin', $this->composer->assetURL( 'theme_admin.js' ), array('jquery'), WPB_VC_VERSION, true);

    }

    public function registerCss() {
       // wp_register_style( 'bootstrap', $this->composer->assetURL( 'bootstrap/css/bootstrap.css' ), false, WPB_VC_VERSION, false );
        //wp_register_style( 'ui-custom-theme', $this->composer->assetURL( 'ui-custom-theme/jquery-ui-' . WPB_JQUERY_UI_VERSION . '.custom.css' ), false, WPB_VC_VERSION, false );

    }
    /* Call to generate main template editor */

    public function jsComposerEditPage() {
        $pt_array = $this->composer->getPostTypes();
        foreach ($pt_array as $pt) {
            add_meta_box( 'wpb_visual_composer', __('Visual Composer', "js_composer"), Array($this->composer->getLayout(), 'output'), $pt, 'normal', 'high');
        }
    }

    /* Add option to Settings menu */
    public function composerSettings() {
        if ( current_user_can('manage_options') && $this->composer->isPlugin()) {
            // add_options_page(__("Visual Composer Settings", "js_composer"), __("Visual Composer", "js_composer"), 'install_plugins', "wpb_vc_settings", array($this, "composerSettingsMenuHTML"));
            $this->composer->settings = new WPBakeryVisualComposerSettings($this->composer);
            $this->composer->settings->init();
        } elseif($this->composer->isTheme() && current_user_can('edit_theme_options')) {
            $this->composer->settings = new WPBakeryVisualComposerSettings($this->composer);
            $this->composer->settings->init();
        }
    }

    /** Include plugin settings page
     *
     * @deprecated
     *
     * */

    public static function composerSettingsMenuHTML() {
        include_once( self::$config['COMPOSER'] . 'settings/' . 'js_composer_settings_menu.php' );
    }


    public function composerRedirect() {
        if ( get_option('wpb_js_composer_do_activation_redirect', false) ) {
            delete_option('wpb_js_composer_do_activation_redirect');
            wp_redirect(admin_url().'options-general.php?page=wpb_vc_settings');
        }
    }
}