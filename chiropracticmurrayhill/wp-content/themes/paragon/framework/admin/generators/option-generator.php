<?php




class optionGenerator {
    var $name;
    var $options;
    var $saved_options;
    function optionGenerator( $name, $options ) {
        $this->__construct( $name, $options );
    }
    function __construct( $name, $options ) {
        $this->name = $name;
        $this->options = $options;
        $this->render();
    }



    function render() {
        $theme_data = wp_get_theme();
        $this->saved_options = get_option( THEME_OPTIONS );

?>
        <div class="masterkey-options-page  mk-resets">
        <form action="" type="post" name="masterkey_settings" id="masterkey_settings">

        <div id="mk-are-u-sure" class="mk-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/warning-icon.png" alt="" class="mk-loading-gif" />
        <span style="padding-bottom:20px;" class="mk-message-text"><?php _e( 'Are you sure you want to reset to default? Please Note all masterkey settings will be restored to defaults.', 'backend' ); ?></span>
        <a href="#" class="mk-button dominant-color mk-secondary mk_reset_ok" id="mk_reset_ok">OK</a>
        <a href="#" class="mk-button highlight-color mk-secondary mk_reset_cancel" id="mk_reset_cancel">Cancel</a>
        </div>


        <div id="mk-saving-settings" class="mk-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/mk-loading.gif" alt="" class="mk-loading-gif" />
        <span class="mk-message-text"><?php _e( 'Saving changes...', 'backend' ); ?></span>
        </div>

        <div id="mk-success-save" class="mk-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/mk-success-icon.png" alt="" class="mk-loading-gif" />
        <span class="mk-message-text"><?php _e( 'The changes were saved successfully', 'backend' ); ?></span>
        </div>

        <div id="mk-success-reset" class="mk-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/mk-success-icon.png" alt="" class="mk-loading-gif" />
        <span class="mk-message-text"><?php _e( 'All options restored to defaults', 'backend' ); ?></span>
        </div>

        <div id="mk-success-import" class="mk-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/mk-success-icon.png" alt="" class="mk-loading-gif" />
        <span class="mk-message-text"><?php _e( 'All options have been imported successfully', 'backend' ); ?></span>
        </div>


        <div id="mk-already-saved" class="mk-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/warning-icon.png" alt="" class="mk-loading-gif" />
        <span class="mk-message-text"><?php _e( 'You have already saved the changes', 'backend' ); ?></span>
        </div>

        <div id="mk-fail-import" class="mk-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/warning-icon.png" alt="" class="mk-loading-gif" />
        <span class="mk-message-text"><?php _e( 'Nothing has been imported...', 'backend' ); ?></span>
        </div>


        <div id="mk-not-saved" class="mk-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/warning-icon.png" alt="" class="mk-loading-gif" />
        <span class="mk-message-text"><?php _e( 'The changes could not be saved', 'backend' ); ?></span>
        </div>






<!-- Masterkey Header Section -->
        <div id="masterkey-header">
            <a href="#" alt="" title="" class="mk-logo"></a>
            <span class="mk-theme-version"><?php echo $theme_data['Version']; ?></span>

            <ul class="mk-help-links">
                <li class="mk-support"><a href="#"><?php _e( 'Help Desk', 'backend' ); ?></a></li>
                <li class="mk-docs"><a href=""><?php _e( 'Documentation', 'backend' ); ?></a></li>
            </ul>
            <div class="clearboth"></div>
        </div>
<!-- ************** -->



<div class="mk-options-container">

<?php
        foreach ( $this->options as $option ) {
            if ( method_exists( $this, $option['type'] ) ) {
                $this->$option['type']( $option );
            }
        }
?>
<div class="mk-footer-buttons">
<a type="submit" id="mk_reset_confirm" href="#" class="mk-button highlight-color"><span><?php _e( 'Restore Defaults', 'backend' ); ?></span></a>
<button type="submit" id="reset_theme_options" name="reset_theme_options" class="visuallyhidden">/button>

<button type="submit" id="save_theme_options" name="save_theme_options" class="mk-button dominant-color"><span><?php _e( 'Save Settings', 'backend' ); ?></span></button>


</div>
<input type="hidden" name="action" value="theme_data_save" />
<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'theme-data' ); ?>" />
<input type="hidden" name="option_storage" value="<?php echo THEME_OPTIONS; ?>" />
<div class="clearboth"></div>
</div>


       </form>
   </div>

<?php
    }




    function start( $value ) {
        echo '<ul class="mk-main-navigator">';

        foreach ( $value['options'] as $key => $option ) {
            echo '<li class="mk-main-'.$key.'"><a href="#"><span class="gray-scale"><span class="active"></span></span>'.$option.'</a></li>';
        }

        echo '</ul>';
        echo '<div class="mk-main-panes">';
    }


    function heading( $value ) {

        echo '<div class="mk-single-option no-divider">';
        echo '<span class="option-title-main">'.$value['name'] .'</span>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '</div>';
    }


    function end() {

        echo '</div>';
    }


    function start_main_pane() {

        echo '<div class="mk-main-pane">';

    }


    function end_main_pane() {

        echo '</div>';

    }


    function start_sub( $value ) {

        echo '<ul class="mk-sub-navigator">';

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
** Type : Text Box
-------------------------------------------------------------*/

    function text( $value ) {
        $size = isset( $value['size'] ) ? $value['size'] : '40';
        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.'">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" size="' . $size . '" value="';
        if ( isset( $this->saved_options[$value['id']] ) ) {
            echo stripslashes( $this->saved_options[$value['id']] );
        }
        else {
            echo $value['default'];
        }
        echo '" />';

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

        if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }
        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.' upload-option">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        if ( version_compare( get_bloginfo( 'version' ), '3.5.0', '>=' ) ) {
            echo '<input class="mk-upload-url" type="text" id="' . $value['id'] . '" name="' . $value['id'] . '" size="50"  value="';

            echo $default;

            echo '" /><a class="option-upload-button thickbox" id="' . $value['id'] . '_button" href="#">'.__( 'Upload', 'backend' ).'</a>';
        } else {
            echo '<input class="mk-upload-url" type="text" id="' . $value['id'] . '" name="' . $value['id'] . '" size="50"  value="';

            echo $default;

            echo '" /><a class="option-upload-button thickbox" id="' . $value['id'] . '" href="media-upload.php?&post_id=0&target=' . $value['id'] . '&option_image_upload=1&type=image&TB_iframe=1&width=640&height=644">'.__( 'Upload', 'backend' ).'</a>';
        }

        echo '<span id="'.$value['id'].'-preview" class="show-upload-image" alt="'.$value['name'] .'"><img src="'.$default.'" title="" /></span>';

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
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.'">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<span class="mk-toggle-button"><input type="hidden" value="' . $default . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/></span>';


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

        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.'">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" size="8" data-opacity="1" type="minicolors" class="color-picker" value="';
        if ( isset( $this->saved_options[$value['id']] ) ) {
            echo stripslashes( $this->saved_options[$value['id']] );
        }
        else {
            echo $value['default'];
        }
        echo '" /><div class="rgba-value-console"></div>';

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
        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.' mk-range-option">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<div class="mk-range-input"><input class="range-input-selector" name="' . $value['id'] . '" id="' . $value['id'] . '" type="range" value="';
        if ( isset( $this->saved_options[$value['id']] ) ) {
            echo stripslashes( $this->saved_options[$value['id']] );
        }
        else {
            echo $value['default'];
        }
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

        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<textarea id="' . $value['id'] . '" rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '" class="code">';
        if ( isset( $this->saved_options[$value['id']] ) ) {
            echo stripslashes( $this->saved_options[$value['id']] );
        }
        else {
            if ( isset( $value['default'] ) ) {
                echo $value['default'];
            }

        }
        echo '</textarea>';
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

        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<div class="mk-select-radio">';

        $i = 0;
        foreach ( $value['options'] as $key => $option ) {
            $i++;
            $checked = '';
            if ( isset( $this->saved_options[$value['id']] ) ) {
                if ( is_array( $this->saved_options[$value['id']] ) ) {
                    if ( in_array( $key, $this->saved_options[$value['id']] ) ) {
                        $checked = ' checked="checked"';
                    }
                }
            } else if ( in_array( $key, $value['default'] ) ) {
                    $checked = ' checked="checked"';
                }

            echo '<input type="checkbox" value="' . $key . '" id="' . $value['id'] . '-checkbox-' . $key . '" name="' . $value['id'] . '[]" ' . $checked . ' /><label for="' . $value['id'] . '-checkbox-' . $key . '"><span></span>' . $option . '</label>';
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
            $checked_key = $this->saved_options[$value['id']];
        } else {
            $checked_key = $value['default'];
        }

        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<div class="mk-select-radio">';

        $i = 0;
        foreach ( $value['options'] as $key => $option ) {
            $i++;
            $checked = '';
            if ( $key == $checked_key ) {
                $checked = ' checked="checked"';
            }

            echo '<input type="radio" value="' . $key . '" ' . $checked . ' id="' . $value['id'] . '-radio-' . $key . '" name="' . $value['id'] . '"><label for="' . $value['id'] . '-radio-' . $key . '"><span></span>' . $option . '</label>';
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
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
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
                else if ( $key == $value['default'] ) {
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
                else if ( str_replace( " ", "_", strtolower( $option ) ) == $value['default'] ) {
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
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<select class="mk-chosen" name="' . $value['id'] . '[]" id="' . $value['id'] . '" multiple="multiple" style="width:'.$width.'px;">';

        if ( !empty( $value['options'] ) && is_array( $value['options'] ) ) {
            foreach ( $value['options'] as $key => $option ) {
                echo '<option value="' . $key . '"';
                if ( isset( $this->saved_options[$value['id']] ) ) {
                    if ( is_array( $this->saved_options[$value['id']] ) ) {
                        if ( in_array( $key, $this->saved_options[$value['id']] ) ) {
                            echo ' selected="selected"';
                        }
                    }
                }
                else if ( in_array( $key, $value['default'] ) ) {
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
** Type : Visual Selector
-------------------------------------------------------------*/
    function visual_selector( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';

        $item_padding = isset( $value['item_padding'] ) ? $value['item_padding'] : '20px 30px 0 0';
        echo '<div id="' . $value['id'] . '_wrapper" class="mk-single-option-wrapper">';
        echo '<div class="mk-single-option '.$no_divider.' '.$value['id'].'">';

        echo '<label><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }


        echo '<div class="mk-visual-selector">';
        foreach ( $value['options'] as $key => $option ) {
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.$key.'"><img  src="' . THEME_ADMIN_ASSETS_URI . '/images/'.$option.'.png" /></a>';
        }
        echo '<input type="hidden" value="' .  $default . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
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
        echo '</div>';
    }











    /*
**
**
** Type : HomePage Tabbed Content
-------------------------------------------------------------*/
    function homepage_tabbed_box( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }

        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        $entries = get_pages( 'title_li=&orderby=name' );


        if ( !empty( $default ) ) {
            $tabs = explode( ',', $default );
        }
        else {
            $tabs = array();
        }

        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label for="add_tab"><span class="option-title-main">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<div class="homepage-tabbed-wrapper">';
        echo '<span class="tabbed-option-row"><span class="tabbed-option-label">Enter a title for new Tab</span><input type="text" id="add_tab" name="add_tab" size="40" /></span>';

        echo '<span class="tabbed-option-row"><span class="tabbed-option-label">Select a page which will feed new Tab</span><div class="mk-fancy-selectbox text-based" id="homepage_tabbed_box_pages" style="width:300px">';
        echo '<div class="mk-selector-heading">';
        echo '<span class="selected_item" style="width:245px"></span><span class="mk-selector-arrow"></span></div>';
        echo '<div class="mk-select-options">';
        echo '<span value="" class="mk-select-option">'.__( 'Select Option...', 'theme_frontend' ).'</span>';
        foreach ( $entries as $key => $entry ) {
            echo '<span value="' . $entry->ID . '" class="mk-select-option ">' . $entry->post_title. '</span>';
        }
        echo '<input type="hidden" value="" data-title="" name="homepage_tabbed_box_pages_input" id="homepage_tabbed_box_pages_input"/>';
        echo '</div></div></span>';
        echo '<a href="#" class="mk-button highlight-color mk-secondary" id="add_tab_item">'.__( 'Add New', 'backend' ).'</a></div>';


        echo '<span class="option-title-sub" style="margin-bottom:20px;">'.__( 'Current Tabs', 'backend' ) .'</span>';
        echo '<div id="mk-current-tabs" class="mk-current-tabs">';

        echo '<div class="default-tab-item">
                            <div class="tab-title-text"></div>
                            <div class="tab-content-pane"></div>
                            <a href="#" class="delete-tab-item"></a>
                            <input type="hidden" class="mk-tab-item-value" value=""/>
                            <input type="hidden" class="mk-tab-item-page-id" value=""/>
                            <input type="hidden" class="mk-tab-item-page-title" value=""/>
                     </div>';

        if ( !empty( $tabs ) ) {
            foreach ( $tabs as $tab ) {
                echo '<div class="mk-tabbed-item added-item">
                            <div class="tab-title-text">'.$tab.'</div>
                            <div class="tab-content-pane"></div>
                            <a href="#" class="delete-tab-item"></a>
                            <input type="hidden" class="mk-tab-item-value" value="' . $tab . '"/>
                            <input type="hidden" class="mk-tab-item-page-id" value=""/>
                            <input type="hidden" class="mk-tab-item-page-title" value=""/>
                     </div>';
            }
        }

        echo '</div>';
        echo '<input type="hidden" value="' . $default . '" name="homepage_tabs" id="homepage_tabs"/>';

        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
        echo "
        <script type='text/javascript'>
        jQuery(document).ready(function() {
            var mk_tabbed_box_page_id = jQuery('#homepage_tabs_page_id').val().split(',');
            var mk_tabbed_box_page_title = jQuery('#homepage_tabs_page_title').val().split(',');

            jQuery('.mk-tabbed-item.added-item').each(function(i) {

                jQuery(this).find('.mk-tab-item-page-id').attr('value', mk_tabbed_box_page_id[i]);
            })

            jQuery('.mk-tabbed-item.added-item').each(function(i) {
                jQuery(this).find('.mk-tab-item-page-title').attr('value', mk_tabbed_box_page_title[i]);
                jQuery(this).find('.tab-content-pane').text(mk_tabbed_box_page_title[i]);
            })
        })
    </script>
";
    }








    /*
**
**
** Type : HomePage Tabbed Content
-------------------------------------------------------------*/
    function header_social_networks( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }

        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        $sites_names = array(
'px',
'aim-alt',
'aim',
'amazon',
'android',
'app-stote',
'apple',
'arto',
'badoo',
'bandcamp',
'basecamp',
'bebo',
'behance',
'bing',
'blip',
'blogger',
'boxnet',
'brightkite',
'cinch',
'coroflot',
'dailybooth',
'dailyburn',
'dailymile',
'delicious',
'designbump',
'designfloat',
'designmoo',
'deviantart',
'digg-alt',
'digg',
'diigo',
'dribbble',
'dropbox',
'drupal',
'dzone',
'ebay',
'ember',
'envato',
'etsy',
'evernote',
'facebook-places',
'facebook',
'facto-me',
'feedburner',
'flickr',
'folkd',
'formspring',
'forrst',
'fotolog',
'foursquare',
'freshbooks',
'friendfeed',
'friendster',
'gdgt',
'gimmebar',
'github_alt',
'github',
'goodreads',
'google-buzz',
'google-talk',
'google',
'googleplay',
'google-plus',
'gowalla',
'grooveshark',
'hackernews',
'hi5',
'hypemachine',
'hyves',
'icloud',
'icq',
'identica',
'instapaper',
'itunes',
'kik',
'krop',
'last-fm',
'linkedin',
'live-journal',
'lovedsgn',
'meetup',
'metacafe',
'mixx-alt',
'mixx',
'myspace_alt',
'myspace',
'newsvine',
'ning',
'officialfm',
'openid',
'orkut',
'path',
'paypal',
'photobucket',
'picassa',
'pinboard',
'pinterest',
'playstation',
'plixi',
'plurk',
'podcast',
'posterous',
'purevolume',
'quik',
'quora',
'rdio',
'readernaut',
'reddit',
'retweet',
'rss',
'scribd',
'sharethis',
'simplenote',
'skype',
'slashdot',
'slideshare',
'smugmug',
'soundcloud',
'spotify',
'squarespace',
'squidoo',
'steam',
'stumble-upon',
'technorati',
'thefancy',
'tribe',
'tripit',
'tumblr',
'twitter-alt',
'twitter',
'vcard',
'viddler',
'vimeo',
'virb',
'w3',
'whatsapp',
'wikipedia',
'windows',
'wists',
'wp-alt',
'wordpress',
'yahoo-buzz',
'yahoo',
'yelp',
'youtube',
'zerply',
'zynga',
'youtube-alt',
'ymessanger',
        );







        if ( !empty( $default ) ) {
            $sites = explode( ',', $default );
        }
        else {
            $sites = array();
        }

        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label for="add_tab"><span class="option-title-main">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<div class="header-social-wrapper">';
        echo '<span class="header-social-option-row"><span class="header-social-option-label">Select a Site</span><div class="mk-fancy-selectbox text-based" id="header_social_sites" style="width:300px">';

        echo '<div class="mk-selector-heading">';
        echo '<span class="selected_item" style="width:245px"></span><span class="mk-selector-arrow"></span></div>';
        echo '<div class="mk-select-options">';
        echo '<span value="" class="mk-select-option">'.__( 'Select Option...', 'theme_frontend' ).'</span>';
        foreach ( $sites_names as $key ) {
            echo '<span value="' . $key . '" class="mk-select-option ">' . str_replace('-', '', $key). '</span>';
        }
        echo '<input type="hidden" value="" name="header_social_sites_select" id="header_social_sites_select"/>';
        echo '</div></div></span>';

        echo '<span class="header-social-option-row"><span class="header-social-option-label">Enter Full URL</span><input type="text" id="header_social_url" name="header_social_url" size="40" /></span>';

        echo '<a href="#" class="mk-button highlight-color mk-secondary" id="add_header_social_item">'.__( 'Add New', 'backend' ).'</a></div>';


        echo '<span class="option-title-sub" style="margin-bottom:20px;">'.__( 'Current Social Networks', 'backend' ) .'</span>';
        echo '<div id="mk-current-social" class="mk-current-social">';

        echo '<div class="default-social-item">
                            <div class="social-item-icon"></div>
                            <div class="social-item-url"></div>
                            <a href="#" class="delete-social-item"></a>
                            <input type="hidden" class="mk-social-item-site" value=""/>
                            <input type="hidden" class="mk-social-item-url" value=""/>
                     </div>';

        if ( !empty( $sites ) ) {
            foreach ( $sites as $site ) {
                echo '<div class="mk-social-item added-item">
                            <div class="social-item-icon"><i class="mk-social-'.$site.'"></i></div>
                            <div class="social-item-url"></div>
                            <a href="#" class="delete-social-item"></a>
                            <input type="hidden" class="mk-social-item-site" value="' . $site . '"/>
                            <input type="hidden" class="mk-social-item-url" value=""/>
                     </div>';
            }
        }

        echo '</div>';
        echo '<input type="hidden" value="' . $default . '" name="header_social_networks_site" id="header_social_networks_site"/>';

        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
        echo "
        <script type='text/javascript'>
        jQuery(document).ready(function() {
          var mk_social_site_url = jQuery('#header_social_networks_url').val().split(',');

            jQuery('.mk-social-item.added-item').each(function(i) {

                jQuery(this).find('.mk-social-item-url').attr('value', mk_social_site_url[i]);
                jQuery(this).find('.social-item-url').text(mk_social_site_url[i]);
            })
        })
    </script>
";
    }





    /*
**
**
** Type : Custom Sidebar
-------------------------------------------------------------*/
    function custom_sidebar( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }

        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';

        if ( !empty( $default ) ) {
            $sidebars = explode( ',', $default );
        }
        else {
            $sidebars = array();
        }

        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label for="add_sidebar"><span class="option-title-main">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<div class="custom-sidebar-wrapper">';
        echo '<input type="text" id="add_sidebar" name="add_sidebar" size="50" /><a href="#" class="mk-button highlight-color mk-secondary" id="add_sidebar_item">'.__( 'Create', 'backend' ).'</a>';
        echo '</div>';

        echo '<span class="option-title-sub" style="margin-bottom:20px;">'.__( 'Current sidebars', 'backend' ) .'</span>';

        echo '<div id="selected-sidebar" class="selected-sidebar">';
        echo '<div id="sidebar-item" class="default-sidebar-item"><div class="slider-item-text"></div><a href="#" class="delete-sidebar"></a><input type="hidden" class="sidebar-item-value" /></div>';
        if ( !empty( $sidebars ) ) {
            foreach ( $sidebars as $sidebar ) {
                echo '<div id="sidebar-item" class="sidebar-item"><div class="slider-item-text">' . $sidebar . '</div><a href="#" class="delete-sidebar"></a><input type="hidden" class="sidebar-item-value" value="' . $sidebar . '"/></div>';
            }
        }
        echo '</div>';
        echo '<input type="hidden" value="' . $default . '" name="' . $value['id'] . '" id="sidebars"/>';

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
** Type : Import
-------------------------------------------------------------*/

    function import( $value ) {
        $rows = isset( $value['rows'] ) ? $value['rows'] : '8';

        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<textarea id="' . $value['id'] . '" rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '" class="code">';
        echo $value['default'];
        echo '</textarea>';

        echo '<button style="float:right; margin-bottom:20px;" type="submit" id="import_theme_options" name="import_theme_options" class="mk-button dominant-color"><span>'. __( 'Import', 'backend' ).'</span></button>';
        echo '<div class="clearboth"></div>';
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
** Type : Export
-------------------------------------------------------------*/

    function export( $value ) {
        $rows = isset( $value['rows'] ) ? $value['rows'] : '8';

        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div class="mk-single-option '.$no_divider.' ">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<textarea id="' . $value['id'] . '" rows="' . $rows . '" onclick="this.focus();this.select()" readonly="readonly" name="' . $value['id'] . '" type="' . $value['type'] . '" class="code">';
        echo base64_encode( serialize( get_option( THEME_OPTIONS ) ) );
        echo '</textarea>';
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
** Type : General Background Selector
-------------------------------------------------------------*/
    function general_background_selector( $value ) {

        $item_padding = isset( $value['item_padding'] ) ? $value['item_padding'] : '20px 30px 0 0';
        echo '<div class="mk-single-option ">';

        echo '<label><span class="option-title-main">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
?>

<div class="mk-general-bg-selector">
<div class="outer-wrapper">
  <div rel="body" class="body-section"><span class="hover-state-body"><span class="section-indicator">
    <?php _e( 'Body', 'backend' ) ?>
    </span></span><div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
  <div class="main-sections-wrapper">
    <div rel="header" class="header-section"><span class="hover-state"><span class="section-indicator">
      <?php _e( 'Header', 'backend' ) ?>
      </span></span><div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
    <div rel="page" class="page-section"><span class="hover-state"><span class="section-indicator">
      <?php _e( 'Page', 'backend' ) ?>
      </span></span><div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
    <div rel="footer" class="footer-section"><span class="hover-state"><span class="section-indicator">
      <?php _e( 'Footer', 'backend' ) ?>
      </span></span><div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
  </div>
</div>
<div id="mk-bg-edit-panel" class="mk-bg-edit-panel">
  <div class="mk-bg-panel-heading"> <a class="mk-bg-edit-panel-heading-cancel" href="#"></a> <span class="mk-bg-edit-panel-heading-text">Edit color & texture - <span class="mk-edit-panel-heading"></span></span> </div>
  <div style="border-bottom:1px solid #ccc;">
    <div class="mk-bg-edit-right">
      <div class="mk-bg-edit-option"> <span class="mk-bg-edit-label">
        <?php  _e( 'Background Image', 'backend' )  ?>
        </span>
        <ul class="bg-background-type-tabs">
          <li><a rel="no-image" href="#" class="mk-bg-edit-option-no-image-button mk-button highlight-color bg-image-buttons">
            <?php  _e( 'No Image', 'backend' )  ?>
            </a></li>
          <li><a rel="preset" href="#" class="mk-bg-edit-option-preset-button mk-button highlight-color bg-image-buttons">
            <?php  _e( 'Presets', 'backend' )  ?>
            </a></li>
          <li><a rel="custom" href="#" class="mk-bg-edit-option-upload-button mk-button highlight-color bg-image-buttons">
            <?php  _e( 'Custom', 'backend' )  ?>
            </a></li>
        </ul>
        <div class="clearboth"></div>

      <div class="bg-background-type-panes">
        <div class="bg-background-type-pane bg-no-image"> </div>
        <div class="bg-background-type-pane bg-image-preset">
          <div class="bg-image-preset-wrapper">
            <ul class="bg-image-preset-tabs">
              <li><a href="#" class="">Patterns</a></li>
              <li><a href="#" class="">Textures</a></li>
            </ul>
            <div class="bg-image-preset-panes">
              <div class="bg-image-preset-pane">
                <ul class="bg-image-preset-thumbs patterns-list">
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/1.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_1.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/2.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_2.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/3.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_3.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/4.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_4.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/5.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_5.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/6.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_6.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/7.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_7.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/8.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_8.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/9.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_9.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/10.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_10.jpg" /></a></li>
                </ul>
              </div>
              <div class="bg-image-preset-pane">
                <ul class="bg-image-preset-thumbs">
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/1.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/1.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/2.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/2.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/3.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/3.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/4.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/4.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/5.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/5.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/6.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/6.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/7.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/7.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/8.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/8.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/9.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/9.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/10.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/10.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/11.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/11.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/12.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/12.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/13.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/13.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/14.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/14.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/15.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/15.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/16.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/16.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/17.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/17.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/18.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/18.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/19.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/19.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/20.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/20.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/21.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/21.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/22.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/22.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/23.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/23.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/24.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/24.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/25.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/25.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/26.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/26.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/27.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/27.jpg" /></a></li>

                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-background-type-pane bg-edit-panel-upload" style="padding-top:60px;">
          <div class="upload-option">
            <div id="bg_panel_upload-preview" class="custom-image-preview-block show-upload-image"><img src="" title="" /></div>
            <span class="bg-edit-panel-upload-title">
            <?php  _e( 'Upload a new custom image', 'backend' )  ?>
            </span>


         <?php if ( version_compare( get_bloginfo( 'version' ), '3.5.0', '>=' ) ) {
            echo '<input class="mk-upload-url" type="text" id="bg_panel_upload" name="bg_panel_upload" size="40"  value="" /><a class="option-upload-button thickbox" id="bg_panel_upload_button" href="#">'.__( 'Upload', 'backend' ).'</a>';
        } else {
            echo '<input class="mk-upload-url" type="text" id="bg_panel_upload" name="bg_panel_upload" size="40"  value="" /><a class="option-upload-button thickbox" id="bg_panel_upload_button" href="media-upload.php?&post_id=0&target=bg_panel_upload&option_image_upload=1&type=image&TB_iframe=1&width=640&height=644">'.__( 'Upload', 'backend' ).'</a>';
        }
?>
</div>
        </div>
      </div>
      <div class="clearboth"></div>
    </div>
</div>
    <div class="mk-bg-edit-left">
      <div class="mk-bg-edit-option mk-bg-edit-bg-color"> <span class="mk-bg-edit-label">
        <?php  _e( 'Background color', 'backend' ) ?>
        </span>
        <div class="bg-edit-panel-color">
          <input name="bg_panel_color" id="bg_panel_color" size="8" type="minicolors" data-opacity="1" class="color-picker" value="" />
        </div>
        <div class="clearboth"></div>
      </div>
      <div class="mk-bg-edit-option mk-bg-edit-option-repeat"> <span class="mk-bg-edit-label">
        <?php  _e( 'Background Repeat', 'backend' )  ?>
        </span>
        <div class="bg-repeat-option"><a style="border:none" class="no-repeat" href="#" rel="no-repeat" title="no-repeat"></a><a href="#" rel="repeat" class="repeat" title="repeat"></a><a href="#" rel="repeat-x" class="repeat-x" title="repeat-x"></a><a href="#" rel="repeat-y" class="repeat-y" title="repeat-y"></a></div>
        <div class="clearboth"></div>
      </div>
      <div class="mk-bg-edit-option mk-bg-edit-option-attachment"> <span class="mk-bg-edit-label">
        <?php  _e( 'Background Attachment', 'backend' )  ?>
        </span>
        <div class="bg-attachment-option"> <a style="border:none" href="#" rel="fixed" class="fixed" title="fixed"></a><a href="#" rel="scroll" class="scroll" title="scroll"></a></div>
        <div class="clearboth"></div>
      </div>
      <div class="mk-bg-edit-option mk-bg-edit-option-position"> <span class="mk-bg-edit-label"><?php  _e( 'Background Position', 'backend' )  ?></span>
        <div class="bg-position-option">
            <a style="border-left:none" href="#" rel="left top" class="left-top" title="left top"></a><a href="#" rel="center top" class="center-top" title="center top"></a><a href="#" rel="right top" class="right-top" title="right top"></a>
          <div class="clearboth"></div>
          <a style="border-left:none" href="#" rel="left center" class="left-center" title="left center"></a><a href="#" rel="center center" class="center-center" title="center center"></a><a href="#" rel="right center" class="right-center" title="right center"></a>
          <div class="clearboth"></div>
          <a style="border-left:none; border-bottom:none;" href="#" rel="left bottom" class="left-bottom" title="left bottom"></a><a style="border-bottom:none;" href="#" rel="center bottom" class="center-bottom" title="center bottom"></a><a style="border-bottom:none;" href="#" rel="right bottom" class="right-bottom" title="right bottom"></a>
      </div>
        <div class="clearboth"></div>
      </div>
      <div class="clearboth"></div>
    </div>
    <div class="clearboth"></div>
  </div>
  <div class="mk-bg-edit-buttons"> <a id="mk_cancel_bg_selector" href="#" class="mk-button highlight-color"><span>
    <?php _e( 'Cancel', 'backend' ) ?>
    </span></a> <a id="mk_apply_bg_selector" href="#" class="mk-button dominant-color"><span>
    <?php _e( 'Apply', 'backend' ) ?>
    </span></a> </div>
</div>


<?php


        echo'</div>';


        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';


    }


    function hidden_input( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }

        echo '<input class="hidden-input-'. $value['id'] .'" type="hidden" value="'.$default.'" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
    }










    /*
**
**
** Type : Specific Background Selector
-------------------------------------------------------------*/
    function specific_background_selector_start( $value ) {

        $item_padding = isset( $value['item_padding'] ) ? $value['item_padding'] : '20px 30px 0 0';
        echo '<div class="mk-single-option ">';

        echo '<label><span class="option-title-main">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
?>

<div class="mk-specific-bg-selector" id="<?php echo $value['id']; ?>">
    <div class="mk-specific-bg-selector-left">
  <div class="mk-bg-edit-option mk-specific-edit-bg-color">

<?php

    }



    /*
**
**
** Type : Specific Background Selector Color
-------------------------------------------------------------*/
    function specific_background_selector_color( $value ) {

        if ( isset( $this->saved_options[$value['id']] ) ) {
            $color = $this->saved_options[$value['id']];
        }
        else {
            $color = $value['default'];
        }

?>
<span class="mk-bg-edit-label">
        <?php  _e( 'Background color', 'backend' ) ?>
        </span>
        <div class="bg-edit-panel-color">

          <input name="<?php echo $value['id'] ?>" id="<?php echo $value['id'] ?>" size="8" type="minicolors" data-opacity="1" class="color-picker" value="<?php echo $color; ?>" />

        </div>
        <div class="clearboth"></div>
   </div>


<?php
    }






    /*
**
**
** Type : Specific Background Selector Repeat
-------------------------------------------------------------*/
    function specific_background_selector_repeat( $value ) {

        if ( isset( $this->saved_options[$value['id']] ) ) {
            $repeat = $this->saved_options[$value['id']];
        }
        else {
            $repeat = $value['default'];
        }

?>
   <div class="mk-bg-edit-option mk-specific-edit-option-repeat"> <span class="mk-bg-edit-label">
        <?php  _e( 'Background Repeat', 'backend' )  ?>
        </span>
        <div class="bg-repeat-option"><a style="border:none" class="no-repeat" href="#" rel="no-repeat" title="no-repeat"></a><a href="#" rel="repeat" class="repeat" title="repeat"></a><a href="#" rel="repeat-x" class="repeat-x" title="repeat-x"></a><a href="#" rel="repeat-y" class="repeat-y" title="repeat-y"></a>
            <input class="specific-input-repeat" type="hidden" value="<?php echo $repeat; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"/>
        </div>
        <div class="clearboth"></div>

    </div>

<?php
    }





    /*
**
**
** Type : Specific Background Selector Attachment
-------------------------------------------------------------*/
    function specific_background_selector_attachment( $value ) {

        if ( isset( $this->saved_options[$value['id']] ) ) {
            $attachment = $this->saved_options[$value['id']];
        }
        else {
            $attachment = $value['default'];
        }

?>
      <div class="mk-bg-edit-option mk-specific-edit-option-attachment"> <span class="mk-bg-edit-label">
        <?php  _e( 'Background Attachment', 'backend' )  ?>
        </span>
        <div class="bg-attachment-option"> <a style="border:none" href="#" rel="fixed" class="fixed" title="fixed"></a><a href="#" rel="scroll" class="scroll" title="scroll"></a>
        <input class="specific-input-attachment" type="hidden" value="<?php echo $attachment; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"/>
        </div>
        <div class="clearboth"></div>
      </div>

<?php
    }









    /*
**
**
** Type : Specific Background Selector Position
-------------------------------------------------------------*/
    function specific_background_selector_position( $value ) {

        if ( isset( $this->saved_options[$value['id']] ) ) {
            $position = $this->saved_options[$value['id']];
        }
        else {
            $position = $value['default'];
        }

?>
      <div class="mk-bg-edit-option mk-specific-edit-option-position"> <span class="mk-bg-edit-label"><?php  _e( 'Background Position', 'backend' )  ?></span>
        <div class="bg-position-option">
            <a style="border-left:none" href="#" rel="left top" class="left-top" title="left top"></a><a href="#" rel="center top" class="center-top" title="center top"></a><a href="#" rel="right top" class="right-top" title="right top"></a>
          <div class="clearboth"></div>
          <a style="border-left:none" href="#" rel="left center" class="left-center" title="left center"></a><a href="#" rel="center center" class="center-center" title="center center"></a><a href="#" rel="right center" class="right-center" title="right center"></a>
          <div class="clearboth"></div>
          <a style="border-left:none; border-bottom:none;" href="#" rel="left bottom" class="left-bottom" title="left bottom"></a><a style="border-bottom:none;" href="#" rel="center bottom" class="center-bottom" title="center bottom"></a><a style="border-bottom:none;" href="#" rel="right bottom" class="right-bottom" title="right bottom"></a>
          <input class="specific-input-position" type="hidden" value="<?php echo $position; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"/>
      </div>
 <div class="clearboth"></div>
    </div>

<div class="clearboth"></div></div>
<?php
    }
















    /*
**
**
** Type : Specific Background Selector Source
-------------------------------------------------------------*/
    function specific_background_selector_source( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $image_source = $this->saved_options[$value['id']];
        }
        else {
            $image_source = $value['default'];
        }
?>

      <div class="clearboth"></div>
      <input class="specific-image-source" type="hidden" value="<?php echo $image_source; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"/>
 </div>

</div>

<div class="clearboth"></div>
</div>







<?php



    }






    /*
**
**
** Type : Specific Background Selector Image
-------------------------------------------------------------*/
    function specific_background_selector_image( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $preset_image = $this->saved_options[$value['id']];
        }
        else {
            $preset_image = $value['default'];
        }
?>
<div class="mk-specific-bg-selector-right">
      <div class="mk-bg-edit-option specific-background-image"> <span class="mk-bg-edit-label">
        <?php  _e( 'Background Image', 'backend' )  ?>
        </span>
        <div class="clearboth"></div>
        <ul class="bg-background-type-tabs">
          <li><a rel="no-image" href="#" class="mk-specific-edit-option-no-image-button mk-button highlight-color bg-image-buttons">
            <?php  _e( 'No Image', 'backend' )  ?>
            </a></li>
          <li><a rel="preset" href="#" class="mk-specific-edit-option-preset-button mk-button highlight-color bg-image-buttons">
            <?php  _e( 'Presets', 'backend' )  ?>
            </a></li>
          <li><a rel="custom" href="#" class="mk-specific-edit-option-upload-button mk-button highlight-color bg-image-buttons">
            <?php  _e( 'Custom', 'backend' )  ?>
            </a></li>
        </ul>
        <div class="clearboth"></div>

      <div class="bg-background-type-panes">
        <div class="bg-background-type-pane specific-no-image"> </div>



        <div class="bg-background-type-pane specific-image-preset">
          <div class="bg-image-preset-wrapper">
            <ul class="bg-image-preset-tabs">
              <li><a href="#" class="">Patterns</a></li>
              <li><a href="#" class="">Textures</a></li>
            </ul>
            <div class="bg-image-preset-panes">
              <div class="bg-image-preset-pane">
                 <ul class="bg-image-preset-thumbs patterns-list">
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/1.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_1.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/2.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_2.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/3.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_3.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/4.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_4.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/5.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_5.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/6.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_6.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/7.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_7.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/8.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_8.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/9.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_9.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/10.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/pattern_10.jpg" /></a></li>
                </ul>
              </div>
              <div class="bg-image-preset-pane">
                <ul class="bg-image-preset-thumbs">
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/1.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/1.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/2.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/2.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/3.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/3.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/4.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/4.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/5.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/5.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/6.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/6.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/7.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/7.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/8.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/8.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/9.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/9.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/10.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/10.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/11.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/11.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/12.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/12.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/13.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/13.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/14.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/14.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/15.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/15.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/16.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/16.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/17.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/17.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/18.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/18.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/19.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/19.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/20.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/20.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/21.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/21.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/22.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/22.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/23.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/23.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/24.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/24.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/25.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/25.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/26.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/26.jpg" /></a></li>
                    <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/27.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/27.jpg" /></a></li>

                </ul>
              </div>
            </div>
          </div>
                <input class="specific-preset-image-url" type="hidden" value="<?php echo $preset_image; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"/>
        </div>


<?php


    }



    /*
**
**
** Type : Specific Background Selector Custom Image
-------------------------------------------------------------*/
    function specific_background_selector_custom_image( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $custom_image = $this->saved_options[$value['id']];
        }
        else {
            $custom_image = $value['default'];
        }
?>

        <div class="bg-background-type-pane specific-edit-panel-upload">
              <div class="upload-option">

                        <span class="bg-edit-panel-upload-title">
                        <?php  _e( 'Upload a new custom image', 'backend' )  ?>
                        </span>

            <input class="mk-upload-url" type="text" id="<?php echo $value['id'] ?>" name="<?php echo $value['id'] ?>" size="40"  value="<?php echo $custom_image; ?>" />
            <a class="option-upload-button thickbox" id="<?php echo $value['id'] ?>_button" href="#"><?php _e( 'Upload', 'backend' ) ?></a>
            <span id="<?php echo $value['id']; ?>-preview" class="show-upload-image" alt="<?php echo $value['name']; ?>"><img src="<?php echo $custom_image; ?>" title="" />
            </div>
        </div>

<?php


    }




    /*
**
**
** Type : Specific Background Selector End
-------------------------------------------------------------*/
    function specific_background_selector_end( $value ) {



        if ( isset( $value['more_help'] ) ) {

            echo '<div class="option-more-help"><a target="_blank" href="'.$value['more_help'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '<div class="clearboth"></div></div></div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }


    }









    /*
**
**
** Type : Custom
-------------------------------------------------------------*/
    function custom( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }

        $value['function']( $value, $default );


    }



    /*
**
**
** Type : Special Font
-------------------------------------------------------------*/
    function special_font( $value ) {

        echo '<input type="hidden" id="'. $value['id']. '" name="' . $value['id'] .'"  value="';

        if ( isset( $this->saved_options[$value['id']] ) ) {
            echo $this->saved_options[$value['id']];
        }
        else {
            echo $value['default'];
        }

        echo '"/>';

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
