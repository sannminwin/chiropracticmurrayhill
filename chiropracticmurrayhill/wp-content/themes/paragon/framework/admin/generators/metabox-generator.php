<?php

class metaboxesGenerator {
    var $config;
    var $options;
    var $saved_options;

    /**
     * Constructor
     *
     * @param string  $name
     * @param array   $options
     */
    function metaboxesGenerator( $config, $options ) {
        $this->config = $config;
        $this->options = $options;

        add_action( 'admin_menu', array( &$this, 'create' ) );
        add_action( 'save_post', array( &$this, 'save' ) );
    }

    function create() {
        if ( function_exists( 'add_meta_box' ) ) {
            if ( ! empty( $this->config['callback'] ) && function_exists( $this->config['callback'] ) ) {
                $callback = $this->config['callback'];
            } else {
                $callback = array( &$this, 'render' );
            }
            foreach ( $this->config['pages'] as $page ) {
                add_meta_box( $this->config['id'], $this->config['title'], $callback, $page, $this->config['context'], $this->config['priority'] );
            }
        }
    }

    function save( $post_id ) {
        if ( ! isset( $_POST[$this->config['id'] . '_noncename'] ) ) {
            return $post_id;
        }

        if ( ! wp_verify_nonce( $_POST[$this->config['id'] . '_noncename'], plugin_basename( __FILE__ ) ) ) {
            return $post_id;
        }

        if ( 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
        add_post_meta( $post_id, 'textfalse', false, true );

        foreach ( $this->options as $option ) {
            if ( isset( $option['id'] ) && ! empty( $option['id'] ) ) {

                if ( isset( $_POST[$option['id']] ) ) {
                    if ( $option['type'] == 'multidropdown' ) {
                        $value = array_unique( explode( ',', $_POST[$option['id']] ) );
                    } else {
                        $value = $_POST[$option['id']];
                    }
                } else if ( $option['type'] == 'toggle' ) {
                        $value = - 1;
                    } else {
                    $value = false;
                }

                if ( get_post_meta( $post_id, $option['id'] ) == "" ) {
                    add_post_meta( $post_id, $option['id'], $value, true );
                } elseif ( $value != get_post_meta( $post_id, $option['id'], true ) ) {
                    update_post_meta( $post_id, $option['id'], $value );
                } elseif ( $value == "" ) {
                    delete_post_meta( $post_id, $option['id'], get_post_meta( $post_id, $option['id'], true ) );
                }
            }
        }
    }

    function render() {
        global $post;
        echo '<div class="masterkey-options-page mk-metabox-wrapper mk-resets">';
        foreach ( $this->options as $option ) {
            if ( method_exists( $this, $option['type'] ) ) {
                if ( isset( $option['id'] ) ) {
                    $default = get_post_meta( $post->ID, $option['id'], true );
                    if ( $default != "" ) {
                        $option['default'] = $default;
                    }
                }
                $this->$option['type']( $option );
            }
        }
        echo '<div class="clearboth"></div></div>';
        echo '<input type="hidden" name="' . $this->config['id'] . '_noncename" id="' . $this->config['id'] . '_noncename" value="' . wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';
    }




    function heading( $value ) {

        echo '<div class="mk-single-option no-divider">';
        echo '<span class="option-title-main">'.$value['name'] .'</span>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '</div>';
    }



    function start_sub( $value ) {

        echo '<ul class="mk-sub-navigator mk-metabox-tabs">';

        foreach ( $value['options'] as $key => $option ) {
            echo '<li class="mk-sub-'.$key.'"><a href="#">'.$option.'</a></li>';
        }

        echo'</ul>';
        echo'<div class="mk-sub-panes">';

    }



    function end_sub() {

        echo '</div>';

    }


    function start_sub_pane() {

        echo '<div class="mk-sub-pane">';

    }


    function end_sub_pane() {

        echo '</div>';

    }



    /*
**
**
** Type : Info
-------------------------------------------------------------*/

    function info( $value ) {
        echo '<div class="mk-single-option no-divider">';
        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '</div>';
    }



    /*
**
**
** Type : Text Box
-------------------------------------------------------------*/

    function text( $value ) {
        $size = isset( $value['size'] ) ? $value['size'] : '40';

        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.'">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" size="' . $size . '" value="' . ( isset( $value['default'] ) ?  $value['default'] : '' ) . '" />';

        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
        echo '</div>';
    }




    /*
**
**
** Type : Upload Image
-------------------------------------------------------------*/
    function upload( $value ) {
        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.' upload-option">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        if ( version_compare( get_bloginfo( 'version' ), '3.5.0', '>=' ) ) {
            echo '<input class="mk-upload-url" type="text" id="' . $value['id'] . '" name="' . $value['id'] . '" size="50"  value="'.$value['default'].'" /><a class="option-upload-button thickbox" id="' . $value['id'] . '_button" href="#">'.__( 'Upload', 'backend' ).'</a>';
        } else {
            echo '<input class="mk-upload-url" type="text" id="' . $value['id'] . '" name="' . $value['id'] . '" size="50"  value="'.$value['default'].'" /><a class="option-upload-button thickbox" id="' . $value['id'] . '" href="media-upload.php?&post_id=0&target=' . $value['id'] . '&option_image_upload=1&type=image&TB_iframe=1&width=640&height=644">'.__( 'Upload', 'backend' ).'</a>';
        }

        echo '<span id="'.$value['id'].'-preview" class="show-upload-image"><img src="'.$value['default'].'" title="" /></span>';

        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }

        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
        echo '</div>';

    }








    /*
**
**
** Type : Toggle Button
-------------------------------------------------------------*/
    function toggle( $value ) {


        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.'">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<span class="mk-toggle-button"><input type="hidden" value="' . $value['default'] . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/></span>';


        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }

        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
        echo '</div>';
    }













    /*
**
**
** Type : Color Picker
-------------------------------------------------------------*/

    function color( $value ) {

        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.'">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" size="8" type="minicolors" class="color-picker" value="'. $value['default'] .'" />';

        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
        echo '</div>';
    }



    /*
**
**
** Type : Range Input
-------------------------------------------------------------*/
    function range( $value ) {
        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<div class="mk-range-input"><input class="range-input-selector" name="' . $value['id'] . '" id="' . $value['id'] . '" type="range" value="';
        echo $value['default'];

        if ( isset( $value['min'] ) ) {
            echo '" min="' . $value['min'];
        }
        if ( isset( $value['max'] ) ) {
            echo '" max="' . $value['max'];
        }
        if ( isset( $value['step'] ) ) {
            echo '" step="' . $value['step'];
        }
        echo '" />';
        if ( isset( $value['unit'] ) ) {
            echo '<span class="unit">' . $value['unit'] . '</span>';
        }
        echo '</div>';



        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
        echo '</div>';

    }


    /*
**
**
** Type : Textarea
-------------------------------------------------------------*/
    function textarea( $value ) {
        $rows = isset( $value['rows'] ) ? $value['rows'] : '8';

        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<textarea id="' . $value['id'] . '" rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '" class="code">' . $value['default'] . '</textarea>';
        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
        echo '</div>';
    }







    /*
**
**
** Type : Textbox
-------------------------------------------------------------*/
    function checkbox( $value ) {
       if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }


        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<div class="mk-select-radio">';


        foreach ( $value['options'] as $key => $option ) {
            echo '<input type="checkbox" value="' . $key . '" id="' . $value['id'] . '-checkbox-' . $key . '" name="' . $value['id'] . '[]"';
            if ( isset( $this->saved_options[$value['id']] ) ) {
                    if ( stripslashes( $this->saved_options[$value['id']] ) == $key ) {
                        echo ' checked="checked"';
                    }
                }
                else if ( in_array( $key, $default )) {
                        echo ' checked="checked"';
                }
            echo '><label for="' . $value['id'] . '-checkbox-' . $key . '"><span></span>' . $option . '</label>';
        }
        echo '</div>';


        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
        echo '</div>';
    }




    /*
**
**
** Type : Radio Button
-------------------------------------------------------------*/
    function radio( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }


        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<div class="mk-select-radio">';


        foreach ( $value['options'] as $key => $option ) {
            echo '<input type="radio" value="' . $key . '" id="' . $value['id'] . '-radio-' . $key . '" name="' . $value['id'] . '[]"';

             if ( isset( $this->saved_options[$value['id']] ) ) {
                    if ( stripslashes( $this->saved_options[$value['id']] ) == $key ) {
                        echo ' checked="checked"';
                    }
                }
                else if ( in_array( $key, $default )) {
                        echo ' checked="checked"';
                }
            echo '><label for="' . $value['id'] . '-radio-' . $key . '"><span></span>' . $option . '</label>';
        }
        echo '</div>';


        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
        echo '</div>';
    }





    /*
**
**
** Type : Select Box
-------------------------------------------------------------*/
    function select( $value ) {

        $width = isset( $value['width'] ) ? $value['width'] : '300';
        $base = isset( $value['base'] ) ? $value['base'] : 'text';

        if ( isset( $value['target'] ) ) {
            if ( isset( $value['options'] ) ) {
                $value['options'] = $value['options'] + $this->get_select_target_options( $value['target'] );
            }
            else {
                $value['options'] = $this->get_select_target_options( $value['target'] );
            }
        }

        if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }

        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }


        echo '<div class="mk-fancy-selectbox '.$base.'-based" id="' . $value['id'] . '" style="width:'.$width.'px">';
        echo '<div class="mk-selector-heading">';
        if ( $base == 'color' ) {
            echo '<span class="selected_color"></span>';
        }
        if ( $base == 'color' ) {
            echo '<span class="selected_item"></span><span class="mk-selector-arrow"></span></div>';
        } else {
            $width = $width - 55;
            echo '<span class="selected_item" style="width:'.$width.'px"></span><span class="mk-selector-arrow"></span></div>';
        }
        echo '<div class="mk-select-options">';


        if ( $base == 'text' ) {
            echo '<span value="" class="mk-select-option">'.__( 'Select Option...', 'theme_frontend' ).'</span>';
            foreach ( $value['options'] as $key => $option ) {
                echo '<span value="' . $key . '" class="mk-select-option ';
                if ( isset( $this->saved_options[$value['id']] ) ) {
                    if ( stripslashes( $this->saved_options[$value['id']] ) == $key ) {
                        echo ' selected';
                    }
                }
                else if ( $key == $default ) {
                        echo ' selected';
                    }
                echo ' ">' . $option . '</span>';
            }
        } else {
            foreach ( $value['options'] as $key => $option ) {
                echo '<span value="' . str_replace( " ", "_", strtolower( $option ) ) . '" data-color="' . $key . '" class="mk-select-option';

                if ( isset( $this->saved_options[$value['id']] ) ) {
                    if ( stripslashes( $this->saved_options[$value['id']] ) == str_replace( " ", "_", strtolower( $option ) ) ) {
                        echo ' selected';
                    }
                }
                else if ( str_replace( " ", "_", strtolower( $option ) ) == $default ) {
                        echo ' selected';
                    }
                echo '"><span style="background-color:'.$key.'" class="mk-option-color"></span><b>' . $option . '</b></span>';
            }

        }

        echo '<input type="hidden" value="' .  $default . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
        echo '</div>';

        echo '</div>';

        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
        echo '</div>';

    }






/*
**
**
** Type : Multi Select
-------------------------------------------------------------*/
    function multiselect( $value ) {
        if ( isset( $value['target'] ) ) {
            if ( isset( $value['options'] ) ) {
                $value['options'] = $value['options'] + $this->get_select_target_options( $value['target'] );
            }
            else {
                $value['options'] = $this->get_select_target_options( $value['target'] );
            }
        }
        $width = isset( $value['width'] ) ? $value['width'] : '500';
        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<select class="mk-chosen" name="' . $value['id'] . '[]" id="' . $value['id'] . '" multiple="multiple" style="width:'.$width.'px;">';

        if ( !empty( $value['options'] ) && is_array( $value['options'] ) ) {
            foreach ( $value['options'] as $key => $option ) {
                echo '<option value="' . $key . '"';
                if ( in_array( $key, $value['default'] ) ) {
                    echo ' selected="selected"';
                }
                echo '>' . $option . '</option>';
            }
        }
        echo '</select>';

        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
        echo '</div>';
    }




/*
**
**
** Type : chosen Select
-------------------------------------------------------------*/
    function chosen_select( $value ) {
       if ( isset( $value['target'] ) ) {
            if ( isset( $value['options'] ) ) {
                $value['options'] = $value['options'] + $this->get_select_target_options( $value['target'] );
            }
            else {
                $value['options'] = $this->get_select_target_options( $value['target'] );
            }
        }

        if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }
        $width = isset( $value['width'] ) ? $value['width'] : '500';
        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<select class="mk-chosen" name="' . $value['id'] . '" id="' . $value['id'] . '" style="width:'.$width.'px;">';

        if ( !empty( $value['options'] ) && is_array( $value['options'] ) ) {
            foreach ( $value['options'] as $key => $option ) {
                echo '<option value="' . $key . '"';
                if ( isset( $this->saved_options[$value['id']] ) ) {
                    if ( stripslashes( $this->saved_options[$value['id']] ) == $key ) {
                        echo ' selected="selected"';
                    }
                }
                else if ( $key == $default ) {
                        echo ' selected="selected"';
                    }
                echo '>' . $option . '</option>';
            }
        }
        echo '</select>';

        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
        echo '</div>';
    }



    /*
**
**
** Type : Page Layout
-------------------------------------------------------------*/
    function visual_selector( $value ) {

        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        $item_padding = isset( $value['item_padding'] ) ? $value['item_padding'] : '20px 30px 0 0';
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }


        echo '<div id="' . $value['id'] . '_container" class="mk-visual-selector">';
        foreach ( $value['options'] as $key => $option ) {
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.$key.'"><img  src="' . THEME_ADMIN_ASSETS_URI . '/images/'.$option.'.png" /></a>';
        }
        echo '<input type="hidden" value="' . $value['default'] . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
        echo '</div>';



        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
        echo '</div>';
    }





    /*
**
**
** Type : Wrodpress Built-in Editor
-------------------------------------------------------------*/
    function editor( $value ) {
        $rows = isset( $value['rows'] ) ? $value['rows'] : '7';
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $value['default'] = stripslashes( $this->saved_options[$value['id']] );
        }
        if ( isset( $value['name'] ) ) {
            echo '<h3 style="margin-top:40px">' . $value['name'] . '</h3>';
        }

        wp_editor( $value['default'], $value['id'] );
        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }

    }



    /*
**
**
** Type : Random Height generator for posts used in newspaper style
-------------------------------------------------------------*/
    function random_height( $value ) {
        echo '<input type="hidden" value="' . $value ['fixed_data']. '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
    }


    /*
**
**
** Type : Super Links
-------------------------------------------------------------*/

    function superlink( $value ) {
        $target = '';
        if ( ! empty( $value['default'] ) ) {
            list( $target, $target_value ) = explode( '||', $value['default'] );
        }

        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        echo '<div class="mk-single-option '.$no_divider.'">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<input type="hidden" id="' . $value['id'] . '" name="' . $value['id'] . '" value="' . $value['default'] . '"/>';

        $method_options = array(
            'page' => 'Link to page',
            'cat' => 'Link to category',
            'post' => 'Link to post',
            'portfolio'=> 'Link to portfolio',
            'manually' => 'Link manually'
        );
        echo '<select name="' . $value['id'] . '_selector" id="' . $value['id'] . '_selector">';
        echo '<option value="">' . __( 'Select Linking method', 'theme_frontend' ) . '</option>';
        foreach ( $method_options as $key => $option ) {
            echo '<option value="' . $key . '"';
            if ( $key == $target ) {
                echo ' selected="selected"';
            }
            echo '>' . $option . '</option>';
        }
        echo '</select>';

        echo '<div style="margin-top:15px;" class="superlink-wrap">';

        //render page selector
        $hidden = ( $target != "page" ) ? 'class="hidden"' : '';
        echo '<select name="' . $value['id'] . '_page" id="' . $value['id'] . '_page" ' . $hidden . '>';
        echo '<option value="">' . __( 'Select Page', 'theme_frontend' ) . '</option>';
        foreach ( $this->get_select_target_options( 'page' ) as $key => $option ) {
            echo '<option value="' . $key . '"';
            if ( $target == "page" && $key == $target_value ) {
                echo ' selected="selected"';
            }
            echo '>' . $option . '</option>';
        }
        echo '</select>';

        //render portfolio selector
        $hidden = ( $target != "portfolio" ) ? 'class="hidden"' : '';
        echo '<select name="' . $value['id'] . '_page" id="' . $value['id'] . '_portfolio" ' . $hidden . '>';
        echo '<option value="">' . __( 'Select Portfolio', 'theme_frontend' ) . '</option>';
        foreach ( $this->get_select_target_options( 'portfolio' ) as $key => $option ) {
            echo '<option value="' . $key . '"';
            if ( $target == "portfolio" && $key == $target_value ) {
                echo ' selected="selected"';
            }
            echo '>' . $option . '</option>';
        }
        echo '</select>';

        //render category selector
        $hidden = ( $target != "cat" ) ? 'class="hidden"' : '';
        echo '<select name="' . $value['id'] . '_cat" id="' . $value['id'] . '_cat" ' . $hidden . '>';
        echo '<option value="">' . __( 'Select Category', 'theme_frontend' ) . '</option>';
        foreach ( $this->get_select_target_options( 'cat' ) as $key => $option ) {
            echo '<option value="' . $key . '"';
            if ( $target == "cat" && $key == $target_value ) {
                echo ' selected="selected"';
            }
            echo '>' . $option . '</option>';
        }
        echo '</select>';

        //render post selector
        $hidden = ( $target != "post" ) ? 'class="hidden"' : '';
        echo '<select name="' . $value['id'] . '_post" id="' . $value['id'] . '_post" ' . $hidden . '>';
        echo '<option value="">' . __( 'Select Post', 'theme_frontend' ) . '</option>';
        foreach ( $this->get_select_target_options( 'post' ) as $key => $option ) {
            echo '<option value="' . $key . '"';
            if ( $target == "post" && $key == $target_value ) {
                echo ' selected="selected"';
            }
            echo '>' . $option . '</option>';
        }
        echo '</select>';

        //render manually
        $hidden = ( $target != "manually" ) ? 'class="hidden"' : '';
        echo '<input name="' . $value['id'] . '_manually" id="' . $value['id'] . '_manually" type="text" value="';
        if ( $target == 'manually' ) {
            echo $target_value;
        }
        echo '" size="35" ' . $hidden . '/>';
        echo '</div>';

        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }

        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
    }









    function slider_texture( $value ) {


        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        $item_padding = isset( $value['item_padding'] ) ? $value['item_padding'] : '20px 30px 0 0';
        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '<div id="' . $value['id'] . '_container" class="mk-visual-selector slideshow-textures">';


        echo '<a style="margin:'.$item_padding.'" class="" rel="gradient.png"><img alt="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/gradient.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/1.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/texture_1.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/2.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/texture_2.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/3.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/texture_3.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/4.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/texture_4.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/5.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/texture_5.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/6.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/texture_6.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/7.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/texture_7.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/8.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/texture_8.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/9.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/texture_9.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/10.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/texture_10.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/11.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/texture_11.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/12.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/texture_12.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/13.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/texture_13.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/14.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/texture_14.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/15.jpg"><img alt="" title=""  src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/texture_15.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/16.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/texture_16.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/17.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/texture_17.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/1.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_1.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/2.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_2.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/3.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_3.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/4.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_4.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/5.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_5.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/6.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_6.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/7.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_7.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/8.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_8.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/9.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_9.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/10.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_10.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/11.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_11.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/12.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_12.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/13.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_13.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/14.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_14.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/15.png"><img alt="" title=""  src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_15.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/16.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_16.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/17.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_17.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/18.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_18.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/19.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_19.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/20.png"><img alt="" title=""  src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_20.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/21.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_21.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/22.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_22.jpg" /></a>';
        echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/23.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/pattern_23.jpg" /></a>';
        echo '<a class="" rel="none"><img alt="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/empty-thumb.png" /></a>';

        echo '<input type="hidden" value="' . $value['default'] . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
        echo '</div>';



        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
    }










    /*
Extract Array data from sources
*/
    function get_select_target_options( $type ) {
        $options = array();
        switch ( $type ) {
        case 'page':
            $entries = get_pages( 'title_li=&orderby=name' );
            foreach ( $entries as $key => $entry ) {
                $options[$entry->ID] = $entry->post_title;
            }
            break;
        case 'cat':
            $entries = get_categories( 'orderby=name&hide_empty=0' );
            foreach ( $entries as $key => $entry ) {
                $options[$entry->term_id] = $entry->name;
            }
            break;
        case 'author':
            global $wpdb;
            $order = 'user_id';
            $user_ids = $wpdb->get_col( $wpdb->prepare( "SELECT $wpdb->usermeta.user_id FROM $wpdb->usermeta where meta_key='wp_user_level' and meta_value>=1 ORDER BY %s ASC", $order ) );
            foreach ( $user_ids as $user_id ) :
                $user = get_userdata( $user_id );
            $options[$user_id] = $user->display_name;
            endforeach;
            break;
        case 'post':
            $entries = get_posts( 'orderby=title&numberposts=-1&order=ASC' );
            foreach ( $entries as $key => $entry ) {
                $options[$entry->ID] = $entry->post_title;
            }
            break;
        case 'portfolio':
            $entries = get_posts( 'post_type=portfolio&orderby=title&numberposts=-1&order=ASC' );
            foreach ( $entries as $key => $entry ) {
                $options[$entry->ID] = $entry->post_title;
            }
            break;
        case 'slideshow':
            $entries = get_posts( 'post_type=slideshow&orderby=title&numberposts=-1&order=ASC' );
            foreach ( $entries as $key => $entry ) {
                $options[$entry->ID] = $entry->post_title;
            }
            break;
        case 'portfolio_category':
            $entries = get_terms( 'portfolio_category', 'orderby=name&hide_empty=0' );
            foreach ( $entries as $key => $entry ) {
                $options[$entry->slug] = $entry->name;
            }
            break;
        case 'portfolio_category_id':
            $entries = get_terms( 'portfolio_category', 'orderby=name&hide_empty=0' );
            foreach ( $entries as $key => $entry ) {
                $options[$entry->term_id] = $entry->name;
            }
            break;
        case 'revolution_slider':
            $slider = new RevSlider();
            $arrSliders = $slider->getArrSlidersShort();
            foreach ( $arrSliders as $key => $entry ) {
                $options[$key] = $entry;
            }
            break;
        case 'layer_slider_source' :
            global $wpdb;

            // Table name
            $table_name = $wpdb->prefix . "layerslider";

            // Get sliders
            $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                                WHERE flag_hidden = '0' AND flag_deleted = '0'
                                                ORDER BY date_c ASC LIMIT 100" );

            if ( $sliders != null && !empty( $sliders ) ) {

                foreach ( $sliders as $item ) :
                    $options[$item->id] = $item->name;
                endforeach;

            }

        }
        return $options;
    }
}



function get_sidebar_options() {
    $sidebars = theme_option( THEME_OPTIONS, 'sidebars' );
    if ( !empty( $sidebars ) ) {
        $sidebars_array = explode( ',', $sidebars );
        $options        = array();
        foreach ( $sidebars_array as $sidebar ) {
            $options[$sidebar] = $sidebar;
        }
        return $options;
    }
    else {
        return array();
    }
}
