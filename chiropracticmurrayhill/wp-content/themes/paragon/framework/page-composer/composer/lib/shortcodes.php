<?php
/**
 * WPBakery Visual Composer Shortcodes main
 *
 * @package WPBakeryVisualComposer
 *
 */

/*
This is were shortcodes for default content elements are
defined. Each element should have shortcode for frontend
display (on a website).

This will add shortcode that will be used in frontend site
*/

abstract class WPBakeryShortCode extends WPBakeryVisualComposerAbstract {

    protected $shortcode;

    protected $atts, $settings;

    public function __construct($settings) {
        $this->settings = $settings;
        $this->shortcode = $this->settings['base'];
        $this->addShortCode($this->shortcode, Array($this, 'output'));
    }

    public function shortcode($shortcode) {

    }

    abstract protected function content( $atts, $content = null );

    public function contentAdmin($atts, $content) {
        $element = $this->shortcode;
        $output = $custom_markup = $width = '';

        if ( $content != NULL ) { $content = wpautop(stripslashes($content)); }

        if ( isset($this->settings['params']) ) {
            $shortcode_attributes = array('width' => '1/1');
            foreach ( $this->settings['params'] as $param ) {
                if ( $param['param_name'] != 'content' ) {
                    //var_dump($param['value']);
                    if ( isset($param['value']) ) {
                        $shortcode_attributes[$param['param_name']] = is_string($param['value']) ? __($param['value'], "js_composer") : $param['value'];
                    } else {
                        $shortcode_attributes[$param['param_name']] = '';
                    }
                } else if ( $param['param_name'] == 'content' && $content == NULL ) {
                    $content = __($param['value'], "js_composer");
                }
            }
            extract(shortcode_atts(
                $shortcode_attributes
                , $atts));
            $elem = $this->getElementHolder($width);

            $iner = '';
            foreach ($this->settings['params'] as $param) {
                $param_value = $$param['param_name'];
                //var_dump($param_value);
                if ( is_array($param_value)) {
                    // Get first element from the array
                    reset($param_value);
                    $first_key = key($param_value);
                    $param_value = $param_value[$first_key];
                }
                $iner .= $this->singleParamHtmlHolder($param, $param_value);
            }
            $elem = str_ireplace('%wpb_element_content%', $iner, $elem);
            $output .= $elem;
        } else {
            //This is used for shortcodes without params (like simple divider)
            // $column_controls = $this->getColumnControls($this->settings['controls']);
            $width = '1/1';

            $elem = $this->getElementHolder($width);

            $iner = '';
            if ( isset($this->settings["custom_markup"]) && $this->settings["custom_markup"] != '' ) {
                if ( $content != '' ) {
                    $custom_markup = str_ireplace("%content%", $content, $this->settings["custom_markup"]);
                } else if ( $content == '' && isset($this->settings["default_content"]) && $this->settings["default_content"] != '' ) {
                    $custom_markup = str_ireplace("%content%", $this->settings["default_content"], $this->settings["custom_markup"]);
                }
                //$output .= do_shortcode($this->settings["custom_markup"]);
                $iner .= do_shortcode($custom_markup);
            }
            $elem = str_ireplace('%wpb_element_content%', $iner, $elem);
            $output .= $elem;
        }

        return $output;
    }
    public function output($atts, $content = null, $base = '') {
        remove_filter( 'the_content', 'wpautop' );
        $this->atts = $atts;
        $output = '';

        $content = empty($content) && !empty($atts['content']) ? $atts['content'] : $content;

        if( is_admin() ) $output .= $this->contentAdmin( $this->atts, $content );

        if( empty($output) ) $output .= $this->content( $this->atts, $content );
        
        return $output;
        add_filter( 'the_content', 'wpautop' , 12);
    }

    public function getExtraClass($el_class) {
        $output = '';
        if ( $el_class != '' ) {
            $output = " " . str_replace(".", "", $el_class);
        }
        return $output;
    }

    /**
     * Create HTML comment for blocks
     *
     * @param $string
     *
     * @return string
     */

    public function endBlockComment($string) {
        return ( !empty($_GET['wpb_debug']) &&  $_GET['wpb_debug']=='true' ? '<!-- END '.$string.' -->' : '' );
    }

    /**
     * Start row comment for html shortcode block
     *
     * @param $position - block position
     * @return string
     */

    public function startRow($position) {
        $output = '';
        if ( strpos($position, 'first') !== false ) {
            $output = ( !empty($_GET['wpb_debug']) &&  $_GET['wpb_debug']=='true' ? "\n" . '<!-- START row -->' ."\n" : '' );
        }
        return $output;
    }

    /**
     * End row comment for html shortcode block
     *
     * @param $position -block position
     * @return string
     */

    public function endRow($position) {
        $output = '';
        if ( strpos($position, 'last') !== false ) {
            $output = ( !empty($_GET['wpb_debug']) &&  $_GET['wpb_debug']=='true' ? "\n" .  '<!-- END row --> ' . "\n" : '' );
        }
        return $output;
    }

    public function settings($name) {
        return isset($this->settings[$name]) ? $this->settings[$name] : null;
    }
    function getElementHolder($width) {

        $output = '';
        $column_controls = $this->getColumnControls($this->settings('controls'));

        $output .= '<div data-element_type="'.$this->settings["base"].'" class="wpb_'.$this->settings["base"].' wpb_content_element wpb_sortable '.wpb_translateColumnWidthToSpan($width).' '.$this->settings["class"].'">';
        $output .= '<input type="hidden" class="wpb_vc_sc_base" name="element_name-'.$this->shortcode.'" value="'.$this->settings["base"].'" />';
        $output .= str_replace("%column_size%", wpb_translateColumnWidthToFractional($width), $column_controls);
        $output .= $this->getCallbacks($this->shortcode);
        
        $output .= '<div class="wpb_element_wrapper">';
        $output .= '<div class="mk-shortcode-param-name">'.$this->settings("name").'</div>';
        $output .= '%wpb_element_content%';

        $output .= '</div> <!-- end .wpb_element_wrapper -->';

        $output .= '</div> <!-- end #element-'.$this->shortcode.' -->';

        return $output;
    }

     /* This returs block controls
---------------------------------------------------------- */
    public function getColumnControls($controls) {
        $controls_start = '<div class="controls">';
        $controls_end = '</div>';

    
        $column_clone = '<a class="column_clone" href="#" title="'.__('Clone', 'js_composer').'"></a>';
        $column_size = '<span class="column_size">%column_size%</span>';

        $controls_column_size = ' <div class="column_size_wrapper"> <a class="column_decrease" href="#" title="'.__('Decrease width', 'js_composer').'"></a><a class="column_increase" href="#" title="'.__('Increase width', 'js_composer').'"></a> </div>';

        $controls_edit = ' <a class="column_edit" href="#" title="'.__('Edit', 'js_composer').'"></a>';
        $controls_popup = ' <a class="column_popup" href="#" title="'.__('Pop up', 'js_composer').'"></a>';
        $controls_delete = ' <a class="column_delete" href="#" title="'.__('Delete', 'js_composer').'"></a>';
        // $delete_edit_row = '<a class="row_delete" title="'.__('Delete %element%', "js_composer").'">'.__('Delete %element%', "js_composer").'</a>';

        $column_controls_full = $controls_start . $controls_delete . $controls_edit . $controls_popup  . $controls_column_size . $controls_end .  $column_clone . $column_size ;
        $column_controls_size_delete = $controls_start . $controls_delete . $controls_column_size . $controls_end .  $column_clone ;
        $column_controls_popup_delete = $controls_start . $controls_delete . $controls_popup   . $controls_end .  $column_clone;
        $column_controls_delete = $controls_start . $controls_delete . $controls_end ;
        $column_controls_edit_popup_delete = $controls_start . $controls_delete . $controls_edit . $controls_popup . $controls_end .   $column_clone;

        if ( $controls == 'popup_delete' ) {
            return $column_controls_popup_delete;
        }
        else if ( $controls == 'edit_popup_delete' ) {
            return $column_controls_edit_popup_delete;
        }
        else if ( $controls == 'size_delete' ) {
            return $column_controls_size_delete;
        }
        else if ( $controls == 'popup_delete' ) {
            return $column_controls_popup_delete;
        }
        else {
            return $column_controls_full;
        }
    }

    /* This will fire callbacks if they are defined in composer-options.php
   ---------------------------------------------------------- */
    public function getCallbacks($id) {
        $output = '';

        if (isset($this->settings['js_callback'])) {
            foreach ($this->settings['js_callback'] as $text_val => $val) {
                /* TODO: name explain */
                $output .= '<input type="hidden" class="wpb_vc_callback wpb_vc_'.$text_val.'_callback " name="'.$text_val.'" value="'.$val.'" />';
            }
        }

        return $output;
    }

    public function singleParamHtmlHolder($param, $value) {
        $output = '';
            // Compatibility fixes
        $old_names = array('yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange');
        $new_names = array('alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning');
        $value = str_ireplace($old_names, $new_names, $value);
            //$value = __($value, "js_composer");
            //
        $param_name = isset($param['param_name']) ? $param['param_name'] : '';
        $type = isset($param['type']) ? $param['type'] : '';
        $class = isset($param['class']) ? $param['class'] : '';

        if ( isset($param['holder']) == false || $param['holder'] == 'hidden' ) {
        $output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" />';
        }
        else {
            $output .= '<'.$param['holder'].' class="wpb_vc_param_value mk-value-holder-hidden ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">'.$value.'</'.$param['holder'].'>';
        }
        return $output;
    }
}

abstract class WPBakeryShortCode_UniversalAdmin extends WPBakeryShortCode {
    public function __construct($settings) {
        $this->settings = $settings;
        $this->addShortCode($this->settings['base'], Array($this, 'output'));
    }
    protected  function content( $atts, $content = null) {
        return '';
    }
    public function contentAdmin($atts,  $content) {

        $element = $this->settings['base'];
        $output = '';

        //if ( $content != NULL ) { $content = apply_filters('the_content', $content); }
        $content = '';
        if ( isset($this->settings['params']) ) {
            $shortcode_attributes = array();
            foreach ( $this->settings['params'] as $param ) {
                if ( $param['param_name'] != 'content' ) {
                    $shortcode_attributes[$param['param_name']] = $param['value'];
                } else if ( $param['param_name'] == 'content' && $content == NULL ) {
                    $content = $param['value'];
                }
            }
            extract(shortcode_atts(
                $shortcode_attributes
                , $atts));

            $output .= '<div class="wpb_edit_form_elements"><h2>'.__('Edit', 'js_composer').' ' .__($this->settings['name'], "js_composer").'</h2>';
             $output .= '<div class="wpb_edit_form_elements_wrapper">';    
            foreach ($this->settings['params'] as $param) {
                $param_value = '';
              eval("\$param_value = \$".$param['param_name'].";");

                if ( is_array($param_value) && $param['type'] != 'multiselect') {
                    // Get first element from the array
                    reset($param_value);
                    $first_key = key($param_value);
                    $param_value = $param_value[$first_key];
                }
                $output .= $this->singleParamEditHolder($param, $param_value);
            }

            $output .= '<div class="edit_form_actions"><a href="#" class="wpb_save_edit_form button-primary">'. __('Save', "js_composer") .'</a></div>';

            $output .= '</div></div>'; //close wpb_edit_form_elements
        }
        return $output;
    }

    protected function singleParamEditHolder($param, $param_value) {
        /**
         * @var $dependency - setup dependency settings for this field
         */
        $dependency = '';
        if( !empty($param['dependency']) && isset($param['dependency']['element']) ) {
            $dependency = ' data-dependency="' . $param['dependency']['element'] . '"';

            if(isset($param['dependency']['not_empty']) && $param['dependency']['not_empty']===true) {
                $dependency .= ' data-dependency-not-empty="true"';
            }

            if(isset($param['dependency']['value'])) {
                if(is_array($param['dependency']['value'])) {
                    foreach($param['dependency']['value'] as $val) {
                        $dependency .= ' data-dependency-value-'.$val.'="' . $val . '"';
                    }

                } else {
                    $dependency .= ' data-dependency-value-'.$param['dependency']['value'].'="' . $param['dependency']['value'] . '"';
                }
            }
            if(isset($param['dependency']['callback'])) {
                 $dependency .= ' data-dependency-callback="' . $param['dependency']['callback'] . '"';
            }
        }
        $output = '';
     if($param['type'] == 'hidden_input') {

        $output .= $this->singleParamEditForm($param, $param_value);

     } else {
        $output = '<div class="mk-single-option with-divider"' . $dependency . '>';
        $output .= '<div class="option-title-sub">'.__($param['heading'], "js_composer").'</div>';
        $output .= (isset($param['description'])) ? '<span class="option-desc">'.__($param['description'], "js_composer").'</span>' : '';

        $output .= $this->singleParamEditForm($param, $param_value);
        
        $output .= '</div>';
        $output .= '<div class="option-divider"></div>';
     }

        return $output;
    }

    protected function singleParamEditForm($param, $param_value) {
        $param_line = '';
        $dependency = '';
        $width = isset( $param['width'] ) ? $param['width'] : '500';
        if( !empty($param['dependency']) && isset($param['dependency']['element']) ) {
            $dependency = ' data-dependency-element="true"';
        }
        // Textfield - input
        if ( $param['type'] == 'textfield' ) {
            $value = __($param_value, "js_composer");
            $value = $param_value;
            $param_line .= '<input size="100" name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$param['param_name'].' '.$param['type'].'" type="text" value="'.$value.'" ' . $dependency . '/>';
        }

        // hidden_input - input
        if ( $param['type'] == 'hidden_input' ) {
            $value = __($param_value, "js_composer");
            $value = $param_value;
            $param_line .= '<input name="'.$param['param_name'].'" id="'.$param['param_name'].'" class="wpb_vc_param_value mk_shortcode_hidden '.$param['param_name'].' '.$param['type'].'" type="hidden" value="'.$value.'" ' . $dependency . '/>';
        }

        // Color - input
        if ( $param['type'] == 'color' ) {
            $value = __($param_value, "js_composer");
            $value = $param_value;
            $param_line .= '<input name="'.$param['param_name'].'" class="color-picker wpb_vc_param_value '.$param['param_name'].' '.$param['type'].'" type="minicolors" value="'.$value.'" ' . $dependency . '/>';
        }

        // Range - input
        if ( $param['type'] == 'range' ) {
            $value = __($param_value, "js_composer");
            $value = $param_value;
            $param_line .= '<div class="mk-range-option mk-range-input"><input name="'.$param['param_name'].'" min="'.$param['min'].'" max="'.$param['max'].'" step="'.$param['step'].'" class="range-input-selector range-input-composer wpb_vc_param_value '.$param['param_name'].' '.$param['type'].'" type="range" value="'.$value.'" ' . $dependency . '/><span class="unit">' . $param['unit'] . '</span></div>';
        }

        // Toggle - input
        if ( $param['type'] == 'toggle' ) {
            $value = __($param_value, "js_composer");
            $value = $param_value;
            $param_line .= '<span class="mk-toggle-button mk-composer-toggle"><input type="hidden" class="wpb_vc_param_value '.$param['param_name'].' '.$param['type'].'" value="'.$value.'" name="'.$param['param_name'].'"/></span>';
        }


         // Radio - input
        if ( $param['type'] == 'radio' ) {
            $value = __($param_value, "js_composer");
            $value = $param_value;
            $param_line .= '<div class="mk-select-radio">';

            $i = 0;
            foreach ( $value['options'] as $key => $option ) {
                $i++;
                $checked = '';
                if ( $key == $checked_key ) {
                    $checked = ' checked="checked"';
                }

                $param_line .= '<input type="radio" value="' . $key . '" ' . $checked . ' id="' . $value['id'] . '-radio-' . $key . '" name="' . $value['id'] . '"><label for="' . $value['id'] . '-radio-' . $key . '"><span></span>' . $option . '</label>';
            }
            $param_line .= '</div>';
        }

         // Upload - input
        if ( $param['type'] == 'upload' ) {
            $value = __($param_value, "js_composer");
            $value = $param_value;
            $param_line .= '<div class="upload-option">';
            
            if(version_compare(get_bloginfo('version'), '3.5.0', '>=')) {
                $param_line .= '<input class="mk-upload-url wpb_vc_param_value '.$param['param_name'].' '.$param['type'].'" type="text" id="' . $param['param_name']. '" name="' . $param['param_name'] . '" size="50"  value="'.$value.'" /><a class="option-upload-button thickbox" id="' . $param['param_name'] . '_button" href="#">'.__( 'Upload', 'backend' ).'</a>';
            } else {
                $param_line .= '<input class="mk-upload-url wpb_vc_param_value '.$param['param_name'].' '.$param['type'].'" type="text" id="' . $param['param_name'] . '" name="' . $param['param_name']. '" size="50"  value="'.$value.'" /><a class="option-upload-button thickbox" id="' . $param['param_name'] . '" href="media-upload.php?&post_id=0&target=' . $param['param_name'] . '&option_image_upload=1&type=image&TB_iframe=1&width=640&height=644">'.__( 'Upload', 'backend' ).'</a>';
            }

            $param_line .= '<span id="'.$param['param_name'].'-preview" class="show-upload-image" alt=""><img src="'.$value.'" title="" /></span></div>';
            }


        // Dropdown - select
        else if ( $param['type'] == 'dropdown' ) {
            $param_line .= '<select style="width:'.$width.'px" name="'.$param['param_name'].'" class="mk-chosen wpb-select wpb_vc_param_value '.$param['param_name'].' '.$param['type'].'"' . $dependency . '>';

            foreach ( $param['value'] as $text_val => $val ) {
                if ( is_numeric($text_val) && is_string($val) || is_numeric($text_val) && is_numeric($val) ) {
                    $text_val = $val;
                }
                $text_val = __($text_val, "js_composer");
                $val = strtolower(str_replace(array(" "), array("_"), $val));
                $selected = '';
                if ( $val == $param_value ) $selected = ' selected="selected"';
                $param_line .= '<option class="'.$val.'" value="'.$val.'"'.$selected.'>'.$text_val.'</option>';
            }
            $param_line .= '</select>';
        }

        // Fonts - select
        else if ( $param['type'] == 'fonts' ) {
            $param_line .= '<select style="width:'.$width.'px" name="'.$param['param_name'].'" id="'.$param['param_name'].'" class="mk-chosen mk-shortcode-fonts-list wpb-select wpb_vc_param_value '.$param['param_name'].' '.$param['type'].'"' . $dependency . '>';

            /*
            ** 600 Google Fonts List
            -------------------------------------------------------------*/
            $google_webfonts = array( 'Abel', 'Abril+Fatface', 'Acid', 'Aclonica', 'Acme', 'Actor', 'Adamina', 'Advent+Pro', 'Aguafina+Script', 'Aladin', 'Aldrich', 'Alegreya', 'Alegreya+SC', 'Alex+Brush', 'Alfa+Slab+One', 'Alice', 'Alike', 'Alike+Angular', 'Allan', 'Allan:bold', 'Allerta', 'Allerta+Stencil', 'Allura', 'Almendra', 'Almendra+SC', 'Amaranth', 'Amatic+SC', 'Amethysta', 'Andada', 'Andika', 'Annie+Use+Your+Telescope', 'Anonymous+Pro', 'Antic', 'Antic+Didone', 'Antic+Slab', 'Anton', 'Arapey', 'Arbutus', 'Architects+Daughter', 'Arimo', 'Arizonia', 'Armata', 'Artifika', 'Arvo', 'Asap', 'Asset', 'Astloch', 'Asul', 'Atomic+Age', 'Aubrey', 'Audiowide', 'Average', 'Averia+Gruesa+Libre', 'Averia+Libre', 'Averia+Sans+Libre', 'Averia+Serif+Libre', 'Bad+Script', 'Balthazar', 'Bangers', 'Basic', 'Baumans', 'Belgrano', 'Belleza', 'Bentham', 'Berkshire+Swash', 'Bevan', 'Bigshot+One', 'Bilbo', 'Bilbo+Swash+Caps', 'Bitter', 'Black+Ops+One', 'Bonbon', 'Boogaloo', 'Bowlby+One', 'Bowlby+One+SC', 'Brawler', 'Bree+Serif', 'Bubblegum+Sans', 'Buda', 'Buda:light', 'Buenard', 'Butcherman', 'Butcherman+Caps', 'Butterfly+Kids', 'Cabin', 'Cabin+Condensed', 'Cabin+Sketch', 'Cabin+Sketch:bold', 'Cabin:bold', 'Caesar+Dressing', 'Cagliostro', 'Calligraffitti', 'Cambo', 'Candal', 'Cantarell', 'Cantata+One', 'Cardo', 'Carme', 'Carter+One', 'Caudex', 'Cedarville+Cursive', 'Ceviche+One', 'Changa+One', 'Chango', 'Chau+Philomene+One', 'Chelsea+Market', 'Cherry+Cream+Soda', 'Chewy', 'Chicle', 'Chivo', 'Coda', 'Coda:800', 'Codystar', 'Comfortaa', 'Coming+Soon', 'Concert+One', 'Condiment', 'Contrail+One', 'Convergence', 'Cookie', 'Copse', 'Corben', 'Corben:bold', 'Cousine', 'Coustard', 'Covered+By+Your+Grace', 'Crafty+Girls', 'Creepster', 'Creepster+Caps', 'Crete+Round', 'Crimson', 'Crushed', 'Cuprum', 'Cutive', 'Damion', 'Dancing+Script', 'Dawning+of+a+New+Day', 'Days+One', 'Delius', 'Delius+Swash+Caps', 'Delius+Unicase', 'Della+Respira', 'Devonshire', 'Didact+Gothic', 'Diplomata', 'Diplomata+SC', 'Doppio+One', 'Dorsa', 'Dosis', 'Dr+Sugiyama', 'Droid+Sans', 'Droid+Sans+Mono', 'Droid+Serif', 'Duru+Sans', 'Dynalight', 'EB+Garamond', 'Eater', 'Eater+Caps', 'Economica', 'Electrolize', 'Emblema+One', 'Emilys+Candy', 'Engagement', 'Enriqueta', 'Erica+One', 'Esteban', 'Euphoria+Script', 'Ewert', 'Exo', 'Expletus+Sans', 'Fanwood+Text', 'Fascinate', 'Fascinate+Inline', 'Federant', 'Federo', 'Felipa', 'Fjord+One', 'Flamenco', 'Flavors', 'Fondamento', 'Fontdiner+Swanky', 'Forum', 'Francois+One', 'Fredericka+the+Great', 'Fredoka+One', 'Fresca', 'Frijole', 'Fugaz+One', 'Galdeano', 'Gentium+Basic', 'Gentium+Book+Basic', 'Geo', 'Geostar', 'Geostar+Fill', 'Germania+One', 'Give+You+Glory', 'Glass+Antiqua', 'Glegoo', 'Gloria+Hallelujah', 'Goblin+One', 'Gochi+Hand', 'Gorditas', 'Goudy+Bookletter+1911', 'Graduate', 'Gravitas+One', 'Great+Vibes', 'Gruppo', 'Gudea', 'Habibi', 'Hammersmith+One', 'Handlee', 'Happy+Monkey', 'Henny+Penny', 'Herr+Von+Muellerhoff', 'Holtwood+One+SC', 'Homemade+Apple', 'Homenaje', 'IM+Fell', 'Iceberg', 'Iceland', 'Imprima', 'Inconsolata', 'Inder', 'Indie+Flower', 'Inika', 'Irish+Grover', 'Irish+Growler', 'Istok+Web', 'Italiana', 'Italianno', 'Jim+Nightshade', 'Jockey+One', 'Jolly+Lodger', 'Josefin+Sans', 'Josefin+Slab', 'Judson', 'Julee', 'Junge', 'Jura', 'Just+Another+Hand', 'Just+Me+Again+Down+Here', 'Kameron', 'Karla', 'Kaushan+Script', 'Kelly+Slab', 'Kenia', 'Knewave', 'Kotta+One', 'Kranky', 'Kreon', 'Kristi', 'Krona+One', 'La+Belle+Aurore', 'Lancelot', 'Lato', 'League+Script', 'Leckerli+One', 'Ledger', 'Lekton', 'Lemon', 'Lilita+One', 'Limelight', 'Linden+Hill', 'Lobster', 'Lobster+Two', 'Londrina+Shadow', 'Londrina+Sketch', 'Londrina+Solid', 'LondrinaOutline', 'Lora', 'Love+Ya+Like+A+Sister', 'Loved+by+the+King', 'Lovers+Quarrel', 'Luckiest+Guy', 'Lusitana', 'Lustria', 'Macondo', 'Macondo+Swash+Caps', 'Magra', 'Maiden+Orange', 'Mako', 'Marck+Script', 'Marko+One', 'Marmelad', 'Marvel', 'Mate', 'Mate+SC', 'Maven+Pro', 'Meddon', 'MedievalSharp', 'Medula+One', 'Megrim', 'Merienda+One', 'Merriweather', 'Metamorphous', 'Metrophobic', 'Michroma', 'Miltonian', 'Miltonian+Tattoo', 'Miniver', 'Miss+Fajardose', 'Miss+Saint+Delafield', 'Modern+Antiqua', 'Molengo', 'Monofett', 'Monoton', 'Monsieur+La+Doulaise', 'Montaga', 'Montez', 'Montserrat', 'Mountains+of+Christmas', 'Mr+Bedford', 'Mr+Bedfort', 'Mr+Dafoe', 'Mr+De+Haviland', 'Mrs+Saint+Delafield', 'Mrs+Sheppards', 'Muli', 'Mystery+Quest', 'Neucha', 'Neuton', 'News+Cycle', 'Niconne', 'Nixie+One', 'Nobile:400,700', 'Norican', 'Nosifer', 'Nosifer+Caps', 'Noticia+Text:400,700', 'Nova+Flat', 'Nova+Mono', 'Nova+Oval', 'Nova+Round', 'Nova+Script', 'Nova+Slim', 'Numans', 'Nunito', 'Old+Standard+TT', 'Oldenburg', 'Oleo+Script', 'Open+Sans:400,600,700,800', 'Orbitron', 'Original+Surfer', 'Oswald', 'Over+the+Rainbow', 'Overlock', 'Overlock+SC', 'Ovo', 'Oxygen', 'PT+Mono', 'PT+Sans:400,700', 'PT+Sans+Narrow', 'PT+Serif', 'PT+Serif+Caption', 'Pacifico', 'Parisienne', 'Passero+One', 'Passion+One', 'Patrick+Hand', 'Patua+One', 'Paytone+One', 'Permanent+Marker', 'Petrona', 'Philosopher', 'Piedra', 'Pinyon+Script', 'Plaster', 'Play', 'Playball', 'Playfair+Display', 'Podkova', 'Poiret+One', 'Poller+One', 'Poly', 'Pompiere', 'Pontano+Sans', 'Port+Lligat+Sans', 'Port+Lligat+Slab', 'Prata', 'Press+Start+2P', 'Princess+Sofia', 'Prociono', 'Prosto+One', 'Puritan', 'Quantico', 'Quattrocento', 'Quattrocento+Sans', 'Questrial', 'Quicksand:300,400,700', 'Qwigley', 'Radley', 'Raleway', 'Raleway:100', 'Rammetto+One', 'Rancho', 'Rationale', 'Redressed', 'Reenie+Beanie', 'Revalia', 'Ribeye', 'Ribeye+Marrow', 'Righteous', 'Rochester', 'Rock+Salt', 'Rokkitt', 'Ropa+Sans', 'Rosario', 'Rosarivo', 'Rouge+Script', 'Ruda', 'Ruge+Boogie', 'Ruluko', 'Ruslan+Display', 'Russo One', 'Ruthie', 'Sail', 'Salsa', 'Sancreek', 'Sansita+One', 'Sarina', 'Satisfy', 'Schoolbell', 'Seaweed+Script', 'Sevillana', 'Shadows+Into+Light', 'Shadows+Into+Light+Two', 'Shanti', 'Share', 'Shojumaru', 'Short+Stack', 'Sigmar+One', 'Signika', 'Signika+Negative', 'Simonetta', 'Sirin+Stencil', 'Six+Caps', 'Slackey', 'Smokum', 'Smythe', 'Sniglet', 'Sniglet:800', 'Snippet', 'Sofia', 'Sonsie+One', 'Sorts+Mill+Goudy', 'Special+Elite', 'Spicy+Rice', 'Spinnaker', 'Spirax', 'Squada+One', 'Stardos+Stencil', 'Stint+Ultra+Condensed', 'Stint+Ultra+Expanded', 'Stoke', 'Sue+Ellen+Francisco', 'Sunshiney', 'Supermercado+One', 'Swanky+and+Moo+Moo', 'Syncopate', 'Tangerine', 'Telex', 'Tenor+Sans', 'Terminal+Dosis', 'Terminal+Dosis+Light', 'The+Girl+Next+Door', 'Tienne', 'Tinos', 'Titillium+Web:400,300,600,700,900', 'Titan+One', 'Trade+Winds', 'Trocchi', 'Trochut', 'Trykker', 'Tulpen+One', 'Ubuntu', 'Ubuntu+Condensed', 'Ubuntu+Mono', 'Ultra', 'Uncial+Antiqua', 'UnifrakturCook', 'UnifrakturCook:bold', 'UnifrakturMaguntia', 'Unkempt', 'Unlock', 'Unna', 'VT323', 'Varela', 'Varela+Round', 'Vast+Shadow', 'Vibur', 'Vidaloka', 'Viga', 'Voces', 'Volkhov', 'Vollkorn', 'Voltaire', 'Waiting+for+the+Sunrise', 'Wallpoet', 'Walter+Turncoat', 'Wellfleet', 'Wire+One', 'Yanone+Kaffeesatz', 'Yellowtail', 'Yeseva+One', 'Yesteryear', 'Zeyada' );


            /*
            ** Safe Fonts List
            -------------------------------------------------------------*/
            $safe_fonts = array( 'Arial, Helvetica, sans-serif', 'Arial Black, Gadget, sans-serif', 'Bookman Old Style, serif', 'Comic Sans MS, cursive', 'Courier, monospace', 'Courier New, Courier, monospace', 'Garamond, serif', 'Georgia, serif', 'Impact, Charcoal, sans-serif', 'Lucida Console, Monaco, monospace', 'Lucida Grande, Lucida Sans Unicode, sans-serif', 'MS Sans Serif, Geneva, sans-serif', 'MS Serif, New York, sans-serif', 'Palatino Linotype, Book Antiqua, Palatino, serif', 'Tahoma, Geneva, sans-serif', 'Times New Roman, Times, serif', 'Trebuchet MS, Helvetica, sans-serif', 'Verdana, Geneva, sans-serif' );

            $param_line .= '<option data-type="" value="none">Select Font</option>';
            /* List Safe Fonts */
        foreach ( $safe_fonts as $safe_font ) {

            $param_line .= '<option data-type="safefont" ';
            if ( $param_value == $safe_font ) {
                $param_line .= ' selected="selected"';
            }
            $param_line .= " value='" . $safe_font . "' >- Safe Font - " . $safe_font . "</option>";
        }

        /* List Google Fonts */
        foreach ( $google_webfonts as $google_webfont ) {

            $param_line .= '<option data-type="google" ';
            if ( $param_value == $google_webfont ) {
                $param_line .= ' selected="selected"';
            }
            $param_line .= 'value="' . $google_webfont . '" >- Google Fonts - ' . str_replace( '+', ' ', $google_webfont ) . '</option>';
        }

        $fontface = array();
        $stylesheet = FONTFACE_DIR.'/fontface_stylesheet.css';
        if ( file_exists( $stylesheet ) ) {
            $file_content = file_get_contents( $stylesheet );
            if ( preg_match_all( "/@font-face\s*{.*?font-family\s*:\s*('|\")(.*?)\\1.*?}/is", $file_content, $matchs ) ) {
                foreach ( $matchs[0] as $index => $css ) {
                    $fontface[$matchs[2][$index]] = array(
                        'name' => $matchs[2][$index],
                        'css' => $css,
                    );
                }

            }
        }

        $count = 1;
        foreach ( $fontface as $value => $font ) {
            $param_line .=  '<option data-type="fontface" ';
            if ( $param_value == $value ) {
                $param_line .= ' selected="selected"';
            }
            $param_line .=  ' value="' . $value . '" >- Fontface - ' . $font['name'] . '</option>';
            $count++;
        }

            $param_line .= '</select>';
        }



           // Dropdown - select
        else if ( $param['type'] == 'multiselect' ) {
            $param_line .= '<select multiple="multiple" style="width:'.$width.'px" name="'.$param['param_name'].'" class="mk-chosen wpb-multiselect wpb_vc_param_value '.$param['param_name'].' '.$param['type'].'"' . $dependency . '>';
            if($param['options'] != null && !empty( $param['options'] ) ) {
            foreach ( $param['options'] as $key => $value ) {
                $selected = '';
                if( in_array($key, explode(',', $param_value) ) ) { $selected = ' selected="selected"'; }
                $param_line .= '<option class="'.$key.'" value="'.$key.'"'.$selected.'>'.$value.'</option>';
                 }
            }     
            $param_line .= '</select>';
        }


        // WYSIWYG field
        else if ( $param['type'] == 'textarea_html' ) {
            $rows = isset( $param['rows'] ) ? $param['rows'] : '20';
            $param_line .= '<textarea name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-textarea_raw_html '.$param['param_name'].' '.$param['type'].'" rows="'.$rows.'"' . $dependency . '>' . $param_value . '</textarea>';
            //$param_line .= $this->getTinyHtmlTextArea($param, $param_value);
        }
        // Checkboxes with post types
        else if ( $param['type'] == 'posttypes' ) {
            $param_line .= '<input class="wpb_vc_param_value wpb-checkboxes" type="hidden" value="" name="" ' . $dependency . '/>';
            $args = array(
                'public'   => true
            );
            $post_types = get_post_types($args);
            foreach ( $post_types as $post_type ) {
                $checked = "";
                if ( $post_type != 'attachment' ) {
                    if ( in_array($post_type, explode(",", $param_value)) ) $checked = ' checked="checked"';
                    $param_line .= ' <input id="'. $param['param_name'] . '-' . $post_type .'" value="' . $post_type . '" class="'.$param['param_name'].' '.$param['type'].'" type="checkbox" name="'.$param['param_name'].'"'.$checked.'' . $dependency . '> ' . $post_type;
                }
            }
        }
        else if ( $param['type'] == 'taxomonies' ) {
            $param_line .= '<input class="wpb_vc_param_value wpb-checkboxes" type="hidden" value="" name="" ' . $dependency . '/>';
            $post_types = get_post_types(array('public' => false, 'name' => 'attachment'), 'names', 'NOT');
            foreach($post_types as $type) {
                $taxonomies = get_object_taxonomies($type , '');

                foreach ( $taxonomies as $tax ) {
                    $checked = "";
                    if ( in_array($tax->name, explode(",", $param_value)) ) $checked = ' checked="checked"';
                    $param_line .= ' <label data-post-type="' . $type . '"><input id="'. $param['param_name'] . '-' . $tax->name .'" value="' . $tax->name . '" data-post-type="' . $type . '" class="'.$param['param_name'].' '.$param['type'].'" type="checkbox" name="'.$param['param_name'].'"'.$checked.'' . $dependency . '> ' . $tax->label. '</label>';
                }
            }
        }
        // Exploded textarea
        else if ( $param['type'] == 'exploded_textarea' ) {
            $param_value = str_replace(",", "\n", $param_value);
            $param_line .= '<textarea name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-textarea '.$param['param_name'].' '.$param['type'].'"' . $dependency . '>'.$param_value.'</textarea>';
        }
        // Big Regular textarea
        else if ( $param['type'] == 'textarea_raw_html' ) {
            // $param_value = __($param_value, "js_composer");
            $param_line .= '<textarea name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-textarea_raw_html '.$param['param_name'].' '.$param['type'].'" rows="16"' . $dependency . '>' . base64_decode($param_value) . '</textarea>';
        }
        // Regular textarea
        else if ( $param['type'] == 'textarea' ) {
            $param_value = __($param_value, "js_composer");
            $rows = isset( $param['rows'] ) ? $param['rows'] : '10';
            $param_line .= '<textarea name="'.$param['param_name'].'" rows="'.$rows.'" class="wpb_vc_param_value wpb-textarea '.$param['param_name'].' '.$param['type'].'"' . $dependency . '>'.$param_value.'</textarea>';
        }
        // Attach images
        else if ( $param['type'] == 'attach_images' ) {
            // TODO: More native way
            $param_value = wpb_removeNotExistingImgIDs($param_value);
            $param_line .= '<input type="hidden" class="wpb_vc_param_value gallery_widget_attached_images_ids '.$param['param_name'].' '.$param['type'].'" name="'.$param['param_name'].'" value="'.$param_value.'" ' . $dependency . '/>';
            $param_line .= '<a class="button gallery_widget_add_images" href="#" title="'.__('Add images', "js_composer").'">'.__('Add images', "js_composer").'</a>';
            $param_line .= '<div class="gallery_widget_attached_images">';
            $param_line .= '<ul class="gallery_widget_attached_images_list">';
            $param_line .= ($param_value != '') ? fieldAttachedImages(explode(",", $param_value)) : '';
            $param_line .= '</ul>';
            $param_line .= '</div>';
            $param_line .= '<div class="gallery_widget_site_images">';
            // $param_line .= siteAttachedImages(explode(",", $param_value));
            $param_line .= '<div class="clearboth"></div></div>';
            $param_line .= '<div class="clearboth"></div>';
        }
        else if ( $param['type'] == 'attach_image' ) {
            $param_value = wpb_removeNotExistingImgIDs(preg_replace('/[^\d]/', '', $param_value));
            $param_line .= '<input type="hidden" class="wpb_vc_param_value gallery_widget_attached_images_ids '.$param['param_name'].' '.$param['type'].'" name="'.$param['param_name'].'" value="'.$param_value.'" ' . $dependency . '/>';
            $param_line .= '<a class="button gallery_widget_add_images" href="#" use-single="true" title="'.__('Add image', "js_composer").'">'.__('Add image', "js_composer").'</a>';
            $param_line .= '<div class="gallery_widget_attached_images">';
            $param_line .= '<ul class="gallery_widget_attached_images_list">';
            $param_line .= ($param_value != '') ? fieldAttachedImages(explode(",", $param_value)) : '';
            $param_line .= '</ul>';
            $param_line .= '</div>';
            $param_line .= '<div class="gallery_widget_site_images">';
            // $param_line .= siteAttachedImages(explode(",", $param_value));
            $param_line .= '<div class="clearboth"></div></div>';
            $param_line .= '<div class="clearboth"></div>';
        }       //
        else if ( $param['type'] == 'widgetised_sidebars' ) {
            $wpb_sidebar_ids = Array();
            $sidebars = $GLOBALS['wp_registered_sidebars'];

            $param_line .= '<select name="'.$param['param_name'].'" class="wpb_vc_param_value dropdown wpb-input wpb-select '.$param['param_name'].' '.$param['type'].'"' . $dependency . '>';
            foreach ( $sidebars as $sidebar ) {
                $selected = '';
                if ( $sidebar["id"] == $param_value ) $selected = ' selected="selected"';
                $sidebar_name = __($sidebar["name"], "js_composer");
                $param_line .= '<option value="'.$sidebar["id"].'"'.$selected.'>'.$sidebar_name.'</option>';
            }
            $param_line .= '</select>';
        }


        return $param_line;
    }

    protected function getTinyHtmlTextArea($param = array(), $param_value) {
        $param_line = '';

        //$upload_media_btns = '<div class="wpb_media-buttons hide-if-no-js"> '.__('Upload/Insert').' <a title="'.__('Add an Image').'" class="wpb_insert-image" href="#"><img alt="'.__('Add an Image').'" src="'.home_url().'/wp-admin/images/media-button-image.gif"></a> <a class="wpb_switch-editors" title="'.__('Switch Editors').'" href="#">HTML mode</a></div>';

        if ( function_exists('wp_editor') ) {
            $default_content = __($param_value, "js_composer");
            $output_value = '';
            // WP 3.3+
            ob_start();
            wp_editor($default_content, 'wpb_tinymce_'.$param['param_name'], array('editor_class' => 'wpb_vc_param_value wpb-textarea visual_composer_tinymce '.$param['param_name'].' '.$param['type'], 'media_buttons' => false ) );
            $output_value = ob_get_contents();
            ob_end_clean();
            $param_line .= $output_value;
        }
        return $param_line;
    }
}


class WPBakeryShortCode_Settings extends WPBakeryShortCode_UniversalAdmin {

    public function content( $atts, $content = null ) {
        return '';
    }

    public function contentAdmin($atts, $content) {

        $output = '';

        //if ( $content != NULL ) { $content = apply_filters('the_content', $content); }
        if ( isset($this->settings['params']) ) {
            $shortcode_attributes = array();
            foreach ( $this->settings['params'] as $param ) {
                if ( $param['param_name'] != 'content' ) {
                    $shortcode_attributes[$param['param_name']] = isset($param['value']) ? $param['value'] : null;
                } else if ( $param['param_name'] == 'content' && $content == NULL ) {
                    $content = $param['value'];
                }
            }
            extract(shortcode_atts(
                $shortcode_attributes
                , $atts));

            $output .= '<div class="wpb_edit_form_elements"><h2 class="wpb_edit_form_heading"><a href="#" id="cancel-edit-options-heading" class="wpb_heading_cancel"></a>'.__('Edit', 'js_composer').' ' .__($this->settings['name'], "js_composer").'</h2>';
            $output .= '<div class="wpb_edit_form_elements_wrapper">';
            foreach ($this->settings['params'] as $param) {
                $param_value = '';
                eval("\$param_value = \$".$param['param_name'].";");

                if ( is_array($param_value)) {
                    // Get first element from the array
                    reset($param_value);
                    $first_key = key($param_value);
                    $param_value = $param_value[$first_key];
                }
                $output .= $this->singleParamEditHolder($param, $param_value);
            }

            $output .= '<div class="edit_form_actions"><a href="#" id="cancel-edit-options" class="mk-button highlight-color" >' . __('Cancel', 'js_composer') . '</a><a href="#" class="wpb_save_edit_form mk-button dominant-color">'. __('Save', "js_composer") .'</a></div>';

            $output .= '</div></div>'; //close wpb_edit_form_elements
        }

        return $output;
    }
}