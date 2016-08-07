

(function($) {
    $.log = function(text) {
        if(typeof(window['console'])!='undefined') console.log(text);
    };

    $.wpb_composer = {
        isMainContainerEmpty: function() {
            if(!jQuery('.wpb_main_sortable > div').length) {
                $('.metabox-composer-content').addClass('empty-composer');
            } else {
                $('.metabox-composer-content').removeClass('empty-composer');
            }
        },
        cloneSelectedImagesFromMediaTab: function(html, $ids) {
            var $button = $('.wpb_current_active_media_button_' + $('body').data('gallery_image_button_ident')).removeClass('.wpb_current_active_media_button_' + $('body').data('gallery_image_button_ident'));

            var attached_img_div = $button.next(),
                site_img_div     = $button.next().next();

            var hidden_ids = attached_img_div.prev().prev(),
                img_ul = attached_img_div.find('.gallery_widget_attached_images_list'),
                clear_button = img_ul.next();

            img_ul.html(html);

            clear_button.show();

            var hidden_ids_value = '';
            img_ul.find('li').each(function() {
                hidden_ids_value += (hidden_ids_value.length>0 ? ',' : '') + $(this).attr('media_id');
            });

            hidden_ids.val(hidden_ids_value);

            attachedImgSortable(img_ul);

            tb_remove();

        },
        galleryImagesControls: function() {
            $('.gallery_widget_add_images').live("click", function(e) {
                var ident = new Date().getTime();
                $(this).addClass('wpb_current_active_media_button_' + ident);
                $('body').data('gallery_image_button_ident', ident);

                e.preventDefault();
                var selected_ids = $(this).parent().find('.gallery_widget_attached_images_ids').val(),
                    post_id = $('#post_ID').is('input') ? $('#post_ID').val() : '';

                tb_show(i18nLocale.add_remove_picture, 'media-upload.php?type=image&post_id=' +  post_id +'&tab=composer_images&single_image=' + ($(this).attr('use-single')=='true' ? 'true' : 'false') + '&selected_ids=' + encodeURIComponent(selected_ids) + '&TB_iframe=true&height=343&width=800');

                return false;

                var attached_img_div = $(this).next(),
                    site_img_div     = $(this).next().next();

                if ( attached_img_div.css('display') == 'block' ) {
                    $(this).addClass('button-primary').text(i18nLocale.finish_adding_text);
                    //
                    attached_img_div.hide();
                    site_img_div.show();

                    hideEditFormSaveButton();
                }
                else {
                    $(this).removeClass('button-primary').text($(this).attr('use-single')=='true' ? i18nLocale.add_image : i18nLocale.add_images);
                    //
                    attached_img_div.show();        // $this->addAction('admin_head', 'header');.show();
                    site_img_div.hide();

                    cloneSelectedImages(site_img_div, attached_img_div);

                    showEditFormSaveButton();
                }
            });

            $('.gallery_widget_img_select li').live("click", function(e) {
                $(this).toggleClass('added');

                var hidden_ids = $(this).parent().parent().prev().prev().prev(),
                    ids_array = (hidden_ids.val().length > 0) ? hidden_ids.val().split(",") : new Array(),
                    img_rel = $(this).find("img").attr("rel"),
                    id_pos = $.inArray(img_rel, ids_array);

                /* if not found */
                if ( id_pos == -1 ) {
                    ids_array.push(img_rel);
                }
                else {
                    ids_array.splice(id_pos, 1);
                }

                hidden_ids.val(ids_array.join(","));

            });
        },
        initializeFormEditing: function(element) {

            // setup dependencies

            $('#visual_composer_edit_form').find('[data-dependency]').each(function(){

                var $this = $(this);
                $this.hide();
                var $element = $('[name=' + $this.attr('data-dependency') + ']:not(:hidden)');
                var callback_function = $this.attr('data-dependency-callback')!=undefined ?  $this.attr('data-dependency-callback') : false;
                $element.each(function(){
                    var $one_element = $(this);
                    if ($one_element.val().length >0  && ( $one_element.is(':not(:checkbox)') || $one_element.is(':checked') ) ) {
                        if($this.is('[data-dependency-not-empty=true]')) {
                            if(callback_function != false) window[callback_function]($one_element, $this);
                            $this.show();
                        } else if ($this.is('[data-dependency-value-' + $one_element.val() + '=' + $one_element.val() + ']')) {
                            if(callback_function != false)  window[callback_function]($one_element, $this);
                            $this.show();
                        }
                    }
                });

                $element.bind('change keyup', function(){

                    if($(this).data('depended_objects')==undefined) {
                        $depended_objects = $('#visual_composer_edit_form [data-dependency=' + $element.attr('name') +']');
                        $(this).data('depended_objects', $depended_objects);
                    } else {
                        $depended_objects = $(this).data('depended_objects');
                    }
                    if($(this).is(':checkbox')) {
                        $depended_objects.filter('[data-dependency-value-' + $(this).val() + '=' + $(this).val() + ']').hide();
                        if(callback_function != false) window[callback_function]($(this), $depended_objects);
                    } else {
                        $depended_objects.hide();
                    }

                    if( $(this).val().length>0 && ($(this).is(':not(:checkbox)') || $(this).is(':checked')) ) {
                        $depended_objects.filter('[data-dependency-not-empty=true]').show();
                        $depended_objects.filter('[data-dependency-value-' + $(this).val() + '=' + $(this).val() + ']').show();
                        if(callback_function != false) window[callback_function]($(this), $depended_objects);
                    }
                });
            });
            //
            $('#visual_composer_edit_form .wp-editor-wrap .textarea_html').each(function(index) {
                initTinyMce($(this));
            });

            $('#visual_composer_edit_form .gallery_widget_attached_images_list').each(function(index) {
                attachedImgSortable($(this));
            });


            // Get callback function name
            var cb = element.children(".wpb_vc_edit_callback");
            //
            if ( cb.length == 1 ) {
                var fn = window[cb.attr("value")];
                if ( typeof fn === 'function' ) {
                    var tmp_output = fn(element);
                }
            }

            $('.wpb_save_edit_form').unbind('click').click(function(e) {
                e.preventDefault();
                saveFormEditing(element);//(element);

            });

            $('#cancel-edit-options, #cancel-edit-options-heading').unbind('click').click(function(e){
                e.preventDefault();
                $('.wpb_main_sortable, #wpb_visual_composer-elements, .wpb_switch-to-composer').show();
                $('.visual_composer_tinymce').each(function(){
                    tinyMCE.execCommand("mceRemoveControl", true, $(this).attr('id'));
                });

                $('#visual_composer_edit_form').html('').hide();
                $('body, html').scrollTop(current_scroll_pos);
                $("#publish").show();

            });

        },
        onDragPlaceholder: function() {
            return $('<div id="drag_placeholder"></div>');
        },
        addLastClass: function(dom_tree) {
            var total_width, width, next_width;
            total_width = 0;
            width = 0;
            next_width = 0;
            $dom_tree = $(dom_tree);

            $dom_tree.children(".wpb_sortable").removeClass("wpb_first wpb_last");
            if ($dom_tree.hasClass("wpb_main_sortable")) {
                $dom_tree.find(".wpb_sortable .wpb_sortable").removeClass("sortable_1st_level");
                $dom_tree.children(".wpb_sortable").addClass("sortable_1st_level");
                $dom_tree.children(".wpb_sortable:eq(0)").addClass("wpb_first");
                $dom_tree.children(".wpb_sortable:last").addClass("wpb_last");
            }

            if ($dom_tree.hasClass("wpb_column_container")) {
                $dom_tree.children(".wpb_sortable:eq(0)").addClass("wpb_first");
                $dom_tree.children(".wpb_sortable:last").addClass("wpb_last");
            }

            $dom_tree.children(".wpb_sortable").each(function (index) {

                var cur_el = $(this);

                // Width of current element
                if (cur_el.hasClass("span12")
                    || cur_el.hasClass("wpb_widget")) {
                    width = 12;
                }
                else if (cur_el.hasClass("span10")) {
                    width = 10;
                }
                else if (cur_el.hasClass("span9")) {
                    width = 9;
                }
                else if (cur_el.hasClass("span8")) {
                    width = 8;
                }
                else if (cur_el.hasClass("span6")) {
                    width = 6;
                }
                else if (cur_el.hasClass("span4")) {
                    width = 4;
                }
                else if (cur_el.hasClass("span3")) {
                    width = 3;
                }
                else if (cur_el.hasClass("span2")) {
                    width = 2;
                }
                total_width += width;// + next_width;

                //console.log(next_width+" "+total_width);

                if (total_width > 10 && total_width <= 12) {
                    cur_el.addClass("wpb_last");
                    cur_el.next('.wpb_sortable').addClass("wpb_first");
                    total_width = 0;
                }
                if (total_width > 12) {
                    cur_el.addClass('wpb_first');
                    cur_el.prev('.wpb_sortable').addClass("wpb_last");
                    total_width = width;
                }

                if (cur_el.hasClass('wpb_vc_column') || cur_el.hasClass('wpb_vc_tabs') || cur_el.hasClass('wpb_vc_tabbed_boxes') || cur_el.hasClass('wpb_mk_content_slideshow') || cur_el.hasClass('wpb_vc_accordion')) {

                    if (cur_el.find('.wpb_element_wrapper .wpb_column_container').length > 0) {
                        cur_el.removeClass('empty_column');
                        cur_el.addClass('not_empty_column');
                        //addLastClass(cur_el.find('.wpb_element_wrapper .wpb_column_container'));
                        cur_el.find('.wpb_element_wrapper .wpb_column_container').each(function (index) {
                            $.wpb_composer.addLastClass($(this)); // Seems it does nothing

                            if($(this).find('div:not(.container-helper)').length==0) {
                                $(this).addClass('empty_column');
                                $(this).html($('#container-helper-block').html());
                            } else {
                                $(this).removeClass('empty_column');
                            }
                        });
                    }
                    else if (cur_el.find('.wpb_element_wrapper .wpb_column_container').length == 0) {
                        cur_el.removeClass('not_empty_column');
                        cur_el.addClass('empty_column');
                    }
                    else {
                        cur_el.removeClass('empty_column not_empty_column');
                    }
                }

                //if ( total_width == 0 ) {
                //  cur_el.next('.wpb_sortable').addClass("wpb_first");
                //}

                //total_width += width;

                /*
                 // If total_width > 0.95 and <= 1 then add 'last' class name to the column
                 if (total_width >= 0.95 && total_width <= 1) {
                 cur_el.addClass("last");
                 cur_el.next('.column').addClass("first");
                 total_width = 0;
                 }
                 // If total_width > 1 then add 'first' class name to the current column and
                 // 'last' to the previous. 'first' class name is needed to clear floats
                 if (total_width > 1) {
                 cur_el.addClass("first");
                 cur_el.prev(".column").addClass("last");
                 total_width = width;
                 }

                 // If current column have column elements inside, then go throw them too
                 //if (cur_el.children(".column").length > 1) {
                 if (cur_el.hasClass('wpb_vc_column')) {
                 if (cur_el.children(".column").length > 0) {
                 cur_el.removeClass('empty_column');
                 cur_el.addClass('not_empty_column');
                 jQuery.wpb_composer.addLastClass(cur_el);
                 }
                 else if (cur_el.children(".column").length == 0) {
                 cur_el.removeClass('not_empty_column');
                 cur_el.addClass('empty_column');
                 }
                 else {
                 cur_el.removeClass('empty_column not_empty_column');
                 }
                 }
                 */
            });
            //$(dom_tree).children(".column:first").addClass("first");
            //$(dom_tree).children(".column:last").addClass("last");
        }, // endjQuery.wpb_composer.addLastClass()
        save_composer_html: function() {
            this.addLastClass($(".wpb_main_sortable"));

            var shortcodes = generateShortcodesFromHtml($(".wpb_main_sortable"));
            //console.log(shortcodes);

            //console.log(tinyMCE.ed.isHidden());

            //if ( tinyMCE.activeEditor == null ) {

            //setActive(wpb_def_wp_editor.editorId);
            tinyMCE.get('content').setContent(shortcodes, {format : 'html'});
            /*
            if ( isTinyMceActive() != true ) {
                //tinyMCE.activeEditor.setContent(shortcodes, {format : 'html'});
                $('#content').val(shortcodes);
            } else {
                tinyMCE.get('content').setContent(shortcodes, {format : 'html'});
            }
            */



            /*var val = $.trim($(".wpb_main_sortable").html());
             $("#visual_composer_html_code_holder").val(val);

             var shortcodes = generateShortcodesFromHtml($(".wpb_main_sortable"));
             $("#visual_composer_code_holder").val(shortcodes);

             var tiny_val = switchEditors.wpautop(shortcodes);

             //[REVISE] Should determine what mode is currently on Visual/HTML
             tinyMCE.get('content').setContent(tiny_val, {format : 'raw'});

             /*try {
             tinyMCE.get('content').setContent(tiny_val, {format : 'raw'});
             }
             catch (err) {
             switchEditors.go('content', 'html');
             $('#content').val(shortcodes);
             }*/
        }
    }
})(jQuery);

jQuery(document).ready(function($) {
    /* On load initialize sortable and dragable elements
    ---------------------------------------------------------- */
    /*
    $('.wpb_main_sortable').sortable({
        forcePlaceholderSize: true,
        placeholder: "widgets-placeholder",
        // cursorAt: { left: 10, top : 20 },
        cursor: "move",
        items: "div.sortable_1st_level",//wpb_sortable
        update: function() {$.wpb_composer.save_composer_html(); }
    });
    */
    $( "#wpb_visual_composer .dropable_el, #wpb_visual_composer .dropable_column" ).draggable({
        helper: function() { return $('<div id="drag_placeholder"></div>').appendTo('body')},
        zIndex: 99999,
        // cursorAt: { left: 10, top : 20 },
        cursor: "move",
        // appendTo: "body",
        revert: "invalid",
        start: function(event, ui) { renderCorrectPlaceholder(event, ui);}
    });
    initDroppable();

     /* Make menu elements dropable */
    try {
        $('.dropdown-toggle').dropdown();
    } catch (err) { }
    /*$('.dropdown-toggle').hover(
        function () { $(this).trigger("click"); },
        function () { }
    );
    $('.dropdown-menu').hover(
        function () { }, //$(this).trigger("click"); },
        function () { $(this).parent().find('.dropdown-toggle').trigger("click"); }
    );

    $('#wpb_visual_composer-elements .nav').children('li').find('a').hover( function() { $('.dropdown-menu').hide(); } );
    */

    /* Add action for menu buttons with 'clickable_action' class name */
    $("#wpb_visual_composer-elements .clickable_action").click(function(e) {
        e.preventDefault();
        getElementMarkup($('.main_wrapper'), $(this), "initDroppable");
    });

    $("#wpb_visual_composer-elements .clickable_layout_action").click(function(e) {
        e.preventDefault();
        getElementMarkup($('.main_wrapper'), $(this), "initDroppable");
    });

    columnControls(); /* Set action for column sizes and delete buttons */


    if ( $("#wpb_visual_composer").length == 1 ) {
        if($('.wpb_js_composer_group_access_show_rule').val()!='only' && $('.wpb_js_composer_group_access_show_rule').val()!='no') $('div#titlediv').after('<p class="composer-switch"><a class="wpb_switch-to-composer mk-button dominant-color" href="#">' + i18nLocale.main_button_title +'</a></p>');

        var postdivrich = $('#postdivrich'),
            visualcomposer = $('#wpb_visual_composer');

        $('.wpb_switch-to-composer').click(function(e){
            e.preventDefault();
            if ( postdivrich.is(":visible") ) {

                // if (!isTinyMceActive()) {
                //    if(switchEditors!=undefined) switchEditors.switchto($('#content-tmce').get(0));
                // }
                    switchEditors.go('content', 'tmce');
                    postdivrich.hide();
                    visualcomposer.show();
                    $('#wpb_vc_js_status').val("true");
                    $(this).html('Classic editor');

                    wpb_shortcodesToVisualEditor();
                    wpb_navOnScroll();
                // } else {
                //  alert("Please switch default WordPress editor to 'Visual' mode first.");
                // }
            }
            else {
                postdivrich.show();
                visualcomposer.hide();
                $('#wpb_vc_js_status').val("false");
                $(this).html(i18nLocale.main_button_title);
            }
        });

        /* Decide what editor to show on load
        ---------------------------------------------------------- */
        if ( $('#wpb_vc_js_status').val() == 'true' && jQuery('#wp-content-wrap').hasClass('tmce-active') ) {
            //if ( isTinyMceActive() == true ) {
                postdivrich.hide();
                visualcomposer.show();
                $('.wpb_switch-to-composer').html(i18nLocale.main_button_title_revert);
            //} else {
            //  alert("Please switch default WordPress editor to 'Visual' mode first.");
            //}

            //wpb_shortcodesToVisualEditor();
        } else {
            postdivrich.show();
            visualcomposer.hide();
            $('.wpb_switch-to-composer').html(i18nLocale.main_button_title);
        }
    }
    jQuery(window).load(function() {
        if ($('.wpb_js_composer_group_access_show_rule').val()=='only') {
            postdivrich.hide();
            visualcomposer.show();
            $('.wpb_switch-to-composer').hide();
            window.setTimeout('wpb_shortcodesToVisualEditor()', 50);
            wpb_navOnScroll();
        } else if ( $('#wpb_vc_js_status').val() == 'true' && jQuery('#wp-content-wrap').hasClass('tmce-active') ) {
            //wpb_shortcodesToVisualEditor();
            window.setTimeout('wpb_shortcodesToVisualEditor()', 50);
            wpb_navOnScroll();
        }
    });

    /*** Toggle click (FAQ) ***/
    jQuery(".toggle_title").live("click", function(e) {
        if ( jQuery(this).hasClass('toggle_title_active') ) {
            jQuery(this).removeClass('toggle_title_active').next().hide();
        } else {
            jQuery(this).addClass('toggle_title_active').next().show();
        }
    });

    /*** Gallery Controls / Site attached images ***/
    $.wpb_composer.galleryImagesControls(); /* Actions for gallery images handling */
    /*jQuery('.gallery_widget_attached_images_list').each(function(index) {
        attachedImgSortable(jQuery(this));
    });*/

    /*** Template System ***/
    wpb_templateSystem();

    $('#wpb_visual_composer').on('click', '.add-text-block-to-content', function(e) {
        e.preventDefault();
        if($(this).attr('parent-container')) {
            getElementMarkup($($(this).attr('parent-container')), $('#vc_column_text'));
        } else {
            getElementMarkup($(this).parent().parent().parent(), $('#vc_column_text'));
        }
    });

}); // end jQuery(document).ready

function open_elements_dropdown() {
    jQuery('.wpb_content_elements:first').trigger('click');
}

function open_layouts_dropdown() {
    jQuery('.wpb_popular_layouts:first').trigger('click');
}

/**
 * WPBakery Composer class
 */

function wpb_templateSystem() {
    jQuery('#wpb_save_template').live("click", function(e) {
        e.preventDefault();

        var template_name = prompt(i18nLocale.please_enter_templates_namey, '');
        if ( template_name != null && template_name != "" ) {
            var template = generateShortcodesFromHtml(jQuery(".wpb_main_sortable"));
            var data = {
                action: 'wpb_save_template',
                template: template,
                template_name: template_name
            };

            jQuery.post(ajaxurl, data, function(response) {
                jQuery('.wpb_templates_ul').html(response);
            });
        } else {
            alert("Error. Please try again.");
        }
    });

    jQuery('.wpb_template_li a').live("click", function(e) {
        e.preventDefault();
        var data = {
            action: 'wpb_load_template',
            template_id: jQuery(this).attr('data-template_id')
        };

        jQuery.post(ajaxurl, data, function(response) {
            jQuery('.wpb_main_sortable').append(response).find(".wpb_vc_init_callback").each(function(index) {
                var fn = window[jQuery(this).attr("value")];
                if ( typeof fn === 'function' ) {
                    fn(jQuery(this).closest('.wpb_content_element'));
                }
            });
            //
            initDroppable();
            save_composer_html();
        });
    });

    jQuery('.wpb_remove_template').live("click", function(e) {
        e.preventDefault();
        var template_name = jQuery(this).closest('.wpb_template_li').find('a').text();
        var answer = confirm (i18nLocale.confirm_deleting_template.replace('{template_name}', template_name));
        if (answer) {
            //alert("delete");
            var data = {
                action: 'wpb_delete_template',
                template_id: jQuery(this).closest('.wpb_template_li').find('a').attr('data-template_id')
            };

            jQuery.post(ajaxurl, data, function(response) {
                jQuery('.wpb_templates_ul').html(response);
            });
        }
    });
}

// fix sub nav on scroll
var $win, $nav, navTop, isFixed = 0;
function wpb_navOnScroll() {
    $win = jQuery(window);
    $nav = jQuery('#wpb_visual_composer-elements');
    navTop = jQuery('#wpb_visual_composer-elements').length && jQuery('#wpb_visual_composer-elements').offset().top - 28;
    isFixed = 0;

    wpb_processScroll();
    $win.on('scroll', wpb_processScroll);
}
function wpb_processScroll() {
    var i,
        scrollTop = $win.scrollTop();

    if ( scrollTop >= navTop && !isFixed ) {
        isFixed = 1;
        $nav.addClass('subnav-fixed')
    } else if (scrollTop <= navTop && isFixed) {
        isFixed = 0;
        $nav.removeClass('subnav-fixed');
    }
}





function hideEditFormSaveButton() {
    jQuery('#visual_composer_edit_form .edit_form_actions').hide();
}
function showEditFormSaveButton() {
    jQuery('#visual_composer_edit_form .edit_form_actions').show();
}

/* Updates ids order in hidden input field, on drag-n-drop reorder */
function updateSelectedImagesOrderIds(img_ul) {
    var img_ids = new Array();

    jQuery(img_ul).find('.added img').each(function() {
        img_ids.push(jQuery(this).attr("rel"));
    });

    jQuery(img_ul).parent().prev().prev().val(img_ids.join(','));
}

/* Takes ids from hidden field and clone li's */
function cloneSelectedImages(site_img_div, attached_img_div) {
    var hidden_ids = jQuery(attached_img_div).prev().prev(),
        ids_array = (hidden_ids.val().length > 0) ? hidden_ids.val().split(",") : new Array(),
        img_ul = attached_img_div.find('.gallery_widget_attached_images_list');

    img_ul.html('');

    jQuery.each(ids_array, function(index, value) {
        jQuery(site_img_div).find('img[rel='+value+']').parent().clone().appendTo(img_ul);
    });
    attachedImgSortable(img_ul);
}

function attachedImgSortable(img_ul) {
    jQuery(img_ul).sortable({
        forcePlaceholderSize: true,
        placeholder: "widgets-placeholder",
        cursor: "move",
        items: "li",
        update: function() { updateSelectedImagesOrderIds(img_ul); }
    });
}



/* Get content from tinyMCE editor and convert it to Visual
   Composer
---------------------------------------------------------- */
function wpb_shortcodesToVisualEditor() {
    var content = wpb_getContentFromTinyMCE();

    var load_img = '<img src="'+mk_pc_loading + '/images/mk-loading.gif'+'" />';
    jQuery('.wpb_main_sortable').html(load_img + ' ' +jQuery('#wpb_vc_loading').val());

    var data = {
        action: 'wpb_shortcodes_to_visualComposer',
        content: content
    };

    jQuery.post(ajaxurl, data, function(response) {
        jQuery('.wpb_main_sortable').html(response);
        jQuery.wpb_composer.isMainContainerEmpty();
        //
        //console.log(response);
        jQuery.wpb_composer.addLastClass(jQuery(".wpb_main_sortable"));
        initDroppable();

        //Fire INIT callback if it is defined
        jQuery('.wpb_main_sortable').find(".wpb_vc_init_callback").each(function(index) {
            var fn = window[jQuery(this).attr("value")];
            if ( typeof fn === 'function' ) {
                fn(jQuery(this).closest('.wpb_sortable'));
            }
        });
    });
}

/* get content from tinyMCE editor
---------------------------------------------------------- */
function wpb_getContentFromTinyMCE() {
    var content = '';

    //if ( tinyMCE.activeEditor ) {
    // if ( isTinyMceActive() ) {
        var wpb_ed = tinyMCE.get('content'); // get editor instance
        content = wpb_ed.save();
    // }
    //PBPB: Patch for visual composer + tinymce + acf
    if(content == '')
    {
        content = jQuery('#content').val();
    }

    return content;
}


/* This makes layout elements droppable, so user can drag
   them from on column to another and sort them (re-order)
   within the current column
---------------------------------------------------------- */
function initDroppable() {
    jQuery('.wpb_sortable_container').sortable({
        forcePlaceholderSize: true,
        connectWith: ".wpb_sortable_container",
        placeholder: "widgets-placeholder",
        // cursorAt: { left: 10, top : 20 },
        cursor: "move",
        items: "div.wpb_sortable",//wpb_sortablee
        distance: 0.5,
        start: function() {
            jQuery('#visual_composer_content').addClass('sorting-started');
        },
        stop: function(event, ui) {
            jQuery('#visual_composer_content').removeClass('sorting-started');
        },
        update: function() {jQuery.wpb_composer.save_composer_html(); },
        over: function(event, ui) {
            ui.placeholder.css({maxWidth: ui.placeholder.parent().width()});
            ui.placeholder.removeClass('hidden-placeholder');
            if( ui.item.hasClass('not-column-inherit') && ui.placeholder.parent().hasClass('not-column-inherit')) {
                ui.placeholder.addClass('hidden-placeholder');
            }

        },
        beforeStop: function(event, ui) {
            if( ui.item.hasClass('not-column-inherit') && ui.placeholder.parent().hasClass('not-column-inherit')) {
                return false;
            }
        }
    });


/*
    jQuery('.wpb_column_container').sortable({
        connectWith: ".wpb_column_container, .wpb_main_sortable",
        //connectWith: ".sortable_1st_level.wpb_vc_column",
        forcePlaceholderSize: true,
        placeholder: "widgets-placeholder",
        // cursorAt: { left: 10, top : 20 },
        cursor: "move",
        items: "div.wpb_sortable:not(.wpb_vc_column)",
        update: function() { jQuery.wpb_composer.save_composer_html(); },
    });
*/
    jQuery('.wpb_main_sortable').droppable({
        greedy: true,
        accept: ".dropable_el, .dropable_column",
        hoverClass: "wpb_ui-state-active",
        drop: function( event, ui ) {
            //console.log(jQuery(this));
            getElementMarkup(jQuery(this), ui.draggable, "addLastClass");
        }
    });

    jQuery('.wpb_column_container').droppable({
        greedy: true,
        accept: function(dropable_el) {
            if ( dropable_el.hasClass('dropable_el') && jQuery(this).hasClass('ui-droppable') && dropable_el.hasClass('not_dropable_in_third_level_nav') ) {
                return false;
            } else if ( dropable_el.hasClass('dropable_el') == true ) {
                return true;
            }

            //".dropable_el",
        },
        hoverClass: "wpb_ui-state-active",
        over: function( event, ui ) {
            jQuery(this).parent().addClass("wpb_ui-state-active");
        },
        out: function( event, ui ) {
            jQuery(this).parent().removeClass("wpb_ui-state-active");
        },
        drop: function( event, ui ) {
            //console.log(jQuery(this));
            jQuery(this).parent().removeClass("wpb_ui-state-active");
            getElementMarkup(jQuery(this), ui.draggable, "addLastClass");
        }
    });



}

function mk_option_option() {
  var _custom_media = true,
      _orig_send_attachment = wp.media.editor.send.attachment;
  jQuery('.option-upload-button').click(function(e) {
    var send_attachment_bkp = wp.media.editor.send.attachment;
    var button = jQuery(this);
    var id = button.attr('id').replace('_button', '');
    _custom_media = true;
    wp.media.editor.send.attachment = function(props, attachment){
      if ( _custom_media ) {
        jQuery("#"+id).val(attachment.url);
        jQuery("#"+id+"-preview img").attr("src", attachment.url);
      } else {
        return _orig_send_attachment.apply( this, [props, attachment] );
      };
    }
    wp.media.editor.open(button);
    return false;
  });
  jQuery('.add_media').on('click', function(){
    _custom_media = false;
  });
}


function initDroppable2() {

    jQuery('.wpb_main_sortable').sortable({
        forcePlaceholderSize: true,
        connectWith: ".wpb_column_container",
        placeholder: "widgets-placeholder",
        // cursorAt: { left: 10, top : 20 },
        cursor: "move",
        items: "div.sortable_1st_level",//wpb_sortable
        update: function() {jQuery.wpb_composer.save_composer_html(); }
    });

    jQuery('.wpb_column_container').sortable({
        connectWith: ".wpb_column_container, .wpb_main_sortable",
        //connectWith: ".sortable_1st_level.wpb_vc_column",
        forcePlaceholderSize: false,
        placeholder: "widgets-placeholder",
        // cursorAt: { left: 10, top : 20 },
        cursor: "move",
        items: "div.wpb_sortable:not(.wpb_vc_column)",
        update: function() { jQuery.wpb_composer.save_composer_html(); }
    });

    jQuery('.wpb_main_sortable').droppable({
        greedy: true,
        accept: ".dropable_el, .dropable_column",
        hoverClass: "wpb_ui-state-active",
        drop: function( event, ui ) {
            //console.log(jQuery(this));
            getElementMarkup(jQuery(this), ui.draggable, "addLastClass");
        }
    });
    jQuery('.wpb_column_container').droppable({
        greedy: true,
        accept: function(dropable_el) {
            if ( dropable_el.hasClass('dropable_el') && jQuery(this).hasClass('ui-droppable') && dropable_el.hasClass('not_dropable_in_third_level_nav') ) {
                return false;
            } else if ( dropable_el.hasClass('dropable_el') == true ) {
                return true;
            }

            //".dropable_el",
        },
        hoverClass: "wpb_ui-state-active",
        over: function( event, ui ) {
            jQuery(this).parent().addClass("wpb_ui-state-active");
        },
        out: function( event, ui ) {
            jQuery(this).parent().removeClass("wpb_ui-state-active");
        },
        drop: function( event, ui ) {
            //console.log(jQuery(this));
            jQuery(this).parent().removeClass("wpb_ui-state-active");
            getElementMarkup(jQuery(this), ui.draggable, "addLastClass");
        }
    });



} // end initDroppable()


/* Get initial html markup for content element. This function
   use AJAX to run do_shortcode and then place output code into
   main content holder
---------------------------------------------------------- */
function getElementMarkup (target, element, action) {

    var data = {
        action: 'wpb_get_element_backend_html',
        //column_index: jQuery(".wpb_main_sortable .wpb_sortable").length + 1,
        element: element.attr('id'),
        data_element: element.attr('data-element'),
        data_width: element.attr('data-width')
    };

    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
    jQuery.post(ajaxurl, data, function(response) {
        //alert('Got this from the server: ' + response);
        //jQuery(target).append(response);

        //Fire INIT callback if it is defined
        //jQuery(response).find(".wpb_vc_init_callback").each(function(index) {
        target.removeClass('empty_column');
        jQuery(target).append(response).find(".wpb_vc_init_callback").each(function(index) {
            var fn = window[jQuery(this).attr("value")];
            if ( typeof fn === 'function' ) {
                fn(jQuery(this).closest('.wpb_content_element').removeClass('empty_column'));
            }
        });
        jQuery.wpb_composer.isMainContainerEmpty();
        ////


        //initTabs();
        //if (action == 'initDroppable') { initDroppable(); }
        initDroppable();
        save_composer_html();
    });

} // end getElementMarkup()



/* Set action for column size and delete buttons
---------------------------------------------------------- */
function columnControls() {
    jQuery(".column_delete").live("click", function(e) {
        e.preventDefault();
        var answer = confirm (i18nLocale.press_ok_to_delete_section);
        if (answer) {
            $parent = jQuery(this).closest(".wpb_sortable");
            jQuery(this).closest(".wpb_sortable").remove();
            $parent.addClass('empty_column');
            save_composer_html();
        }
    });
    jQuery(".column_clone").live("click", function(e) {
        e.preventDefault();
        var closest_el = jQuery(this).closest(".wpb_sortable"),
            cloned = closest_el.clone();

        cloned.insertAfter(closest_el).hide().fadeIn();

        //Fire INIT callback if it is defined
        cloned.find('.wpb_initialized').removeClass('wpb_initialized');
        cloned.find(".wpb_vc_init_callback").each(function(index) {
            var fn = window[jQuery(this).attr("value")];
            if ( typeof fn === 'function' ) {
                fn(cloned);
            }
        });

        //closest_el.clone().appendTo(jQuery(this).closest(".wpb_main_sortable, .wpb_column_container")).hide().fadeIn();
        save_composer_html();
    });

    jQuery(".wpb_sortable .wpb_sortable .column_popup").live("click", function(e) {
        e.preventDefault();
        var answer = confirm (i18nLocale.press_ok_to_pop_section);
        if (answer) {
            jQuery(this).closest(".wpb_sortable").appendTo('.wpb_main_sortable');//insertBefore('.wpb_main_sortable div.wpb_clear:last');
            initDroppable();
            save_composer_html();
        }
    });

    jQuery(".column_edit, .column_edit_trigger").live("click", function(e) {
        e.preventDefault();
        var element = jQuery(this).closest('.wpb_sortable');
        showEditForm(element);

    });



    jQuery(".column_increase").live("click", function(e) {
        e.preventDefault();
        var column = jQuery(this).closest(".wpb_sortable"),
            sizes = getColumnSize(column);
        if (sizes[1]) {
            column.removeClass(sizes[0]).addClass(sizes[1]);
            /* get updated column size */
            sizes = getColumnSize(column);
            jQuery(column).find(".column_size:first").html(sizes[3]);
            save_composer_html();
        }
    });

    jQuery(".column_decrease").live("click", function(e) {
        e.preventDefault();
        var column = jQuery(this).closest(".wpb_sortable"),
            sizes = getColumnSize(column);
        if (sizes[2]) {
            column.removeClass(sizes[0]).addClass(sizes[2]);
            /* get updated column size */
            sizes = getColumnSize(column);
            jQuery(column).find(".column_size:first").html(sizes[3]);
            save_composer_html();
        }
    });
} // end columnControls()


/* Show widget edit form
---------------------------------------------------------- */
var current_scroll_pos = 0;
function showEditForm(element) {
    current_scroll_pos = jQuery('body, html').scrollTop();
    //
    var element_shortcode = generateShortcodesFromHtml(element, true),
        element_type = element.attr("data-element_type");

    var load_img = '<img style="margin:0 30px;" src="'+mk_pc_loading + '/images/mk-loading.gif'+'" />';
    

    jQuery('#visual_composer_edit_form').html(load_img + ' ' +jQuery('#wpb_vc_loading').val()).show().css({"padding-top" : 60});
    jQuery("#publish").hide(); // hide main publish button
    jQuery('.wpb_main_sortable, #wpb_visual_composer-elements, .wpb_switch-to-composer').hide();

    var data = {
        action: 'wpb_show_edit_form',
        element: element_type,
        shortcode: element_shortcode
    };

    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#visual_composer_edit_form').html(response).css({"padding-top" : 0});

        jQuery.wpb_composer.initializeFormEditing(element);
        mk_composer_toggle();
        jQuery.minicolors.init();
        jQuery(".range-input-composer").rangeinput();
        
        mk_option_option();
        jQuery(".mk-chosen").each(function() {
            jQuery(this).chosen({disable_search_threshold: 10});
        });
        mk_shortcode_fonts();
    });

}



function saveFormEditing(element) {
    jQuery("#publish").show(); // show main publish button
    jQuery('.wpb_main_sortable, #wpb_visual_composer-elements, .wpb_switch-to-composer').show();

    //save data
    jQuery("#visual_composer_edit_form .wpb_vc_param_value").each(function(index) {

        var element_to_update = jQuery(this).attr("name"),
            new_value = '';
        // Textfield - input
        if ( jQuery(this).hasClass("textfield") ) {
            new_value = jQuery(this).val();
        }
        if ( jQuery(this).hasClass("hidden_input") ) {
            new_value = jQuery(this).val();
        }
        if ( jQuery(this).hasClass("color") ) {
            new_value = jQuery(this).val();
        }
        if ( jQuery(this).hasClass("range") ) {
            new_value = jQuery(this).val();
        }
        if ( jQuery(this).hasClass("toggle") ) {
            new_value = jQuery(this).val();
        }
        if ( jQuery(this).hasClass("upload") ) {
            new_value = jQuery(this).val();
        }
        // Dropdown - select
        else if ( jQuery(this).hasClass("wpb-select") ) {
            new_value = jQuery(this).val(); // get selected element

            var all_classes_ar = new Array(),
                all_classes = '';
            jQuery(this).find('option').each(function() {
                var val = jQuery(this).attr('value');
                all_classes_ar.push(val); //populate all posible dropdown values
            });

            all_classes = all_classes_ar.join(" "); // convert array to string

            //element.removeClass(all_classes).addClass(new_value); // remove all possible class names and add only selected one
            element.children('.wpb_element_wrapper').removeClass(all_classes).addClass(new_value); // remove all possible class names and add only selected one
        }

        // Dropdown - select
        else if ( jQuery(this).hasClass("wpb-multiselect") ) {
            new_value = jQuery(this).val(); // get selected element


        }

        // WYSIWYG field
        else if ( jQuery(this).hasClass("textarea_html") ) {
            new_value = getTinyMceHtml(jQuery(this));

        }
        // Check boxes
        else if ( jQuery(this).hasClass("wpb-checkboxes") ) {
            var posstypes_arr = new Array();
            jQuery(this).closest('.edit_form_line').find('input').each(function(index) {
                var self = jQuery(this);
                element_to_update = self.attr("name");
                if ( self.is(':checked') ) {
                    posstypes_arr.push(self.attr("value"));
                }
            });
            if ( posstypes_arr.length > 0 ) {
                new_value = posstypes_arr.join(',');
            }
        }
        // Exploded textarea
        else if ( jQuery(this).hasClass("exploded_textarea") ) {
            new_value = jQuery(this).val().replace(/\n/g, ",");
        }
        // Regular textarea
        else if ( jQuery(this).hasClass("textarea") ) {
            new_value = jQuery(this).val();
        }
        else if ( jQuery(this).hasClass("textarea_raw_html") ) {
            new_value = jQuery(this).val();
            element.find('[name='+element_to_update+'_code]').val(btoa(new_value));
            new_value = jQuery("<div/>").text(new_value).html();
        }
        // Attach images
        else if ( jQuery(this).hasClass("attach_images") ) {
            new_value = jQuery(this).val();
        }
        else if ( jQuery(this).hasClass("attach_image") ) {
            new_value = jQuery(this).val();
            /* KLUDGE: to change image */
            var $thumbnail = element.find('[name='+element_to_update+']').next('.attachment-thumbnail');

            $thumbnail.attr('src', jQuery(this).parent().find('li.added img').attr('src'));
            $thumbnail.next().addClass('image-exists');
        }

        element_to_update = element_to_update.replace('wpb_tinymce_', '');
        if ( element.children('.wpb_element_wrapper').children('.'+element_to_update).is('div, h1,h2,h3,h4,h5,h6, span, i, b, strong, button') ) {

            //element.find('.'+element_to_update).html(new_value);
            element.children('.wpb_element_wrapper').children('[name='+element_to_update+']').html(new_value);
        } else {
            //element.find('.'+element_to_update).val(new_value);
            element.children('.wpb_element_wrapper').children('[name='+element_to_update+']').val(new_value);
        }
    });

    // Get callback function name
    var cb = element.children(".wpb_vc_save_callback");
    //
    if ( cb.length == 1 ) {
        var fn = window[cb.attr("value")];
        if ( typeof fn === 'function' ) {
            var tmp_output = fn(element);
        }
    }

    save_composer_html();
    jQuery('#visual_composer_edit_form').html('').hide();

    jQuery('body, html').scrollTop(current_scroll_pos);
}

function getTinyMceHtml(obj) {

    var mce_id = obj.attr('id'),
        html_back;

    //html_back = tinyMCE.get(mce_id).getContent();

    //tinyMCE.execCommand('mceRemoveControl', false, mce_id);
    try {
        html_back = tinyMCE.get(mce_id).getContent();
        tinyMCE.execCommand('mceRemoveControl', false, mce_id);
    }
    catch (err) {
        html_back = switchEditors.wpautop(obj.val());
    }

    return html_back;
}

function initTinyMce(element) {
//  wpb_def_wp_editor = tinyMCE.activeEditor;

    var textfield_id = element.attr("id");
    tinyMCE.execCommand("mceAddControl", true, textfield_id);

    element.closest('.edit_form_line').find('.wp-switch-editor').removeAttr("onclick");
    element.closest('.edit_form_line').find('.switch-tmce').click(function() {
        element.closest('.edit_form_line').find('.wp-editor-wrap').removeClass('html-active').addClass('tmce-active');

        var val = switchEditors.wpautop( jQuery(this).closest('.edit_form_line').find("textarea.visual_composer_tinymce").val() );
        jQuery("textarea.visual_composer_tinymce").val(val);
        // Add tinymce
        tinyMCE.execCommand("mceAddControl", true, textfield_id);
    });
    element.closest('.edit_form_line').find('.switch-html').click(function() {
        element.closest('.edit_form_line').find('.wp-editor-wrap').removeClass('tmce-active').addClass('html-active');
        tinyMCE.execCommand("mceRemoveControl", true, textfield_id);
    });
}

function isTinyMceActive() {
    var rich = (typeof tinyMCE != "undefined") && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden();
    return rich;
}

/* This function helps when you need to determine current
   column size.

   Returns Array("current size", "larger size", "smaller size", "size string");
---------------------------------------------------------- */
function getColumnSize(column) {
    if (column.hasClass("span12")) //full-width
        return new Array("span12", "span2", "span10", "1/1");

    else if (column.hasClass("span10")) //three-fourth
        return new Array("span10", "span12", "span9", "5/6");

    else if (column.hasClass("span9")) //three-fourth
        return new Array("span9", "span10", "span8", "3/4");

    else if (column.hasClass("span8")) //two-third
        return new Array("span8", "span9", "span6", "2/3");

    else if (column.hasClass("span6")) //one-half
        return new Array("span6", "span8", "span4", "1/2");

    else if (column.hasClass("span4")) // one-third
        return new Array("span4", "span6", "span3", "1/3");

    else if (column.hasClass("span3")) // one-fourth
        return new Array("span3", "span4", "span2", "1/4");
    else if (column.hasClass("span2")) // one-fourth
        return new Array("span2", "span3", "span12", "1/6");
    else
        return false;
} // end getColumnSize()

/* This functions goes throw the dom tree and automatically
   adds 'last' class name to the columns elements.
---------------------------------------------------------- */
function addLastClass(dom_tree) {
    return jQuery.wpb_composer.addLastClass(dom_tree);
    //jQuery(dom_tree).children(".column:first").addClass("first");
    //jQuery(dom_tree).children(".column:last").addClass("last");
} // endjQuery.wpb_composer.addLastClass()

/* This functions copies html code into custom field and
   then on page reload/refresh it is used to build the
   initial layout.
---------------------------------------------------------- */
function save_composer_html() {
jQuery.wpb_composer.addLastClass(jQuery(".wpb_main_sortable"));

    var shortcodes = generateShortcodesFromHtml(jQuery(".wpb_main_sortable"));
    //console.log(shortcodes);

    //console.log(tinyMCE.ed.isHidden());

    //if ( tinyMCE.activeEditor == null ) {

    //setActive(wpb_def_wp_editor.editorId);
/*
    if ( isTinyMceActive() != true ) {
        //tinyMCE.activeEditor.setContent(shortcodes, {format : 'html'});
        jQuery('#content').val(shortcodes);
    } else {
*/
        tinyMCE.get('content').setContent(shortcodes, {format : 'html'});
//  }

    jQuery.wpb_composer.isMainContainerEmpty();

    /*var val = jQuery.trim(jQuery(".wpb_main_sortable").html());
    jQuery("#visual_composer_html_code_holder").val(val);

    var shortcodes = generateShortcodesFromHtml(jQuery(".wpb_main_sortable"));
    jQuery("#visual_composer_code_holder").val(shortcodes);

    var tiny_val = switchEditors.wpautop(shortcodes);

    //[REVISE] Should determine what mode is currently on Visual/HTML
    tinyMCE.get('content').setContent(tiny_val, {format : 'raw'});

    /*try {
        tinyMCE.get('content').setContent(tiny_val, {format : 'raw'});
    }
    catch (err) {
        switchEditors.go('content', 'html');
        jQuery('#content').val(shortcodes);
    }*/
}

/* Generates shortcode values
---------------------------------------------------------- */
var current_top_level = null;
function generateShortcodesFromHtml(dom_tree, single_element) {
    var output = '';
    if ( single_element ) {
        // this is used to generate shortcode for a single content element
        selector_to_go_throw = jQuery(dom_tree);
    } else {
        selector_to_go_throw = jQuery(dom_tree).children(".wpb_sortable");
    }

    selector_to_go_throw.each(function(index) {
    //jQuery(dom_tree.selector+" > .wpb_sortable").each(function(index) {
        var element = jQuery(this),
            current_top_level = element,
            sc_base = element.find('.wpb_vc_sc_base').val(),
            column_el_width = getColumnSize(element),
            params = '',
            sc_ending = ']';

            element.children('.wpb_element_wrapper').children('.wpb_vc_param_value').each(function(index) {
                var param_name = jQuery(this).attr("name"),
                    new_value = '';
                if ( jQuery(this).hasClass("textfield") ) {
                    if (jQuery(this).is('div, h1,h2,h3,h4,h5,h6, span, i, b, strong')) {
                        new_value = jQuery(this).html();
                    } else if ( jQuery(this).is('button') ) {
                        new_value = jQuery(this).text();
                    } else {
                        new_value = jQuery(this).val();
                    }
                }
                else if ( jQuery(this).hasClass("dropdown") ) {
                    new_value = jQuery(this).val();
                }
                else if ( jQuery(this).hasClass("hidden_input") ) {
                    new_value = jQuery(this).val();
                }
                else if ( jQuery(this).hasClass("fonts") ) {
                    new_value = jQuery(this).val();
                }
                else if ( jQuery(this).hasClass("multiselect") ) {
                    new_value = jQuery(this).val();
                }
                else if ( jQuery(this).hasClass("color") ) {
                    new_value = jQuery(this).val();
                }
                else if ( jQuery(this).hasClass("range") ) {
                    new_value = jQuery(this).val();
                }
                else if ( jQuery(this).hasClass("toggle") ) {
                    new_value = jQuery(this).val();
                }
                else if ( jQuery(this).hasClass("upload") ) {
                    new_value = jQuery(this).val();
                }
                else if ( jQuery(this).hasClass("textarea_raw_html") && element.children('.wpb_sortable').length == 0 ) {
                    content_value = jQuery(this).next('.' + param_name + '_code').val();
                    sc_ending = '] '+ content_value +' [/'+sc_base+']';
                }
                else if ( jQuery(this).hasClass("textarea_html") && element.children('.wpb_sortable').length == 0 ) {
                    content_value = jQuery(this).html();
                    sc_ending = '] '+content_value+' [/'+sc_base+']';
                }
                else if ( jQuery(this).hasClass("posttypes") ) {
                    new_value = jQuery(this).val();
                }
                else if ( jQuery(this).hasClass("taxomonies") ) {
                    new_value = jQuery(this).val();
                }
                else if ( jQuery(this).hasClass("exploded_textarea") ) {
                    new_value = jQuery(this).val();
                }
                else if ( jQuery(this).hasClass("textarea") ) {
                    if ( jQuery(this).is('div, h1,h2,h3,h4,h5,h6, span, i, b, strong') ) {
                        new_value = jQuery(this).html();
                    } else {
                        new_value = jQuery(this).val();
                    }
                }
                else if ( jQuery(this).hasClass("attach_images") ) {
                    new_value = jQuery(this).val();
                }
                else if ( jQuery(this).hasClass("attach_image") ) {
                    new_value = jQuery(this).val();
                }
                else if ( jQuery(this).hasClass("widgetised_sidebars") ) {
                    new_value = jQuery(this).val();
                }

                new_value = jQuery.trim(new_value);
                if (new_value != '') { params += ' '+param_name+'="'+new_value+'"'; }
            });


            params += ' width="'+column_el_width[3]+'"'

            if ( element.hasClass("wpb_first") || element.hasClass("wpb_last")) {
                var wpb_first = (element.hasClass("wpb_first")) ? 'first' : '';
                var wpb_last = (element.hasClass("wpb_last")) ? 'last' : '';
                var pos_space = (element.hasClass("wpb_last") && element.hasClass("wpb_first")) ? ' ' : '';
                params += ' el_position="'+wpb_first+pos_space+wpb_last+'"';
            }

            // Get callback function name
            var cb = element.children(".wpb_vc_shortcode_callback");
            //
            if ( cb.length == 1 ) {
                var fn = window[cb.attr("value")];
                if ( typeof fn === 'function' ) {
                    var tmp_output = fn(element);
                }
            }


            output += '['+sc_base+params+sc_ending+' ';

            //deeper
            //if ( element.children('.wpb_element_wrapper').children('.wpb_column_container').children('.wpb_sortable').length > 0 ) {
            if ( element.children('.wpb_element_wrapper').find('.wpb_column_container').length > 0 ) {
                //output += generateShortcodesFromHtml(element.children('.wpb_element_wrapper').children('.wpb_column_container'));

                // Get callback function name
                var cb = element.children(".wpb_vc_shortcode_callback"),
                    inner_element_count = 0;
                //
                element.children('.wpb_element_wrapper').find('.wpb_column_container').each(function(index) {
                    //output += '[aaa]'+generateShortcodesFromHtml(jQuery(this))+'[/aaa]';

                    var sc = generateShortcodesFromHtml(jQuery(this));
                    //Fire SHORTCODE GENERATION callback if it is defined
                    if ( cb.length == 1 ) {
                        var fn = window[cb.attr("value")];
                        if ( typeof fn === 'function' ) {
                            var tmp_output = fn(current_top_level, inner_element_count);
                        }
                        sc = " " + tmp_output.replace("%inner_shortcodes", sc) + " ";

                        //console.log(current_top_level[0]);


                        //var tmp_output = eval(cb.attr("value")+"("+current_top_level+")");
                        //var tmp_output = eval(cb.attr("value")+"('"+current_top_level+"', "+inner_element_count+")");
                        //sc = " " + tmp_output.replace("%inner_shortcodes", sc);
                        inner_element_count++;
                    }
                    //else {
                    //  output += sc;
                    //}
                    output += sc;
                });

                output += '[/'+sc_base+'] ';
            }
    });

    return output;
} // end generateShortcodesFromHtml()

/* This function adds a class name to the div#drag_placeholder,
   and this helps us to give a style to the draging placeholder
---------------------------------------------------------- */
function renderCorrectPlaceholder(event, ui) {
    jQuery("#drag_placeholder").addClass("column_placeholder").html(i18nLocale.drag_drop_me_in_column);
}


/* Custom Callbacks
---------------------------------------------------------- */



/* Accordion Callback
---------------------------------------------------------- */
function wpbAccordionInitCallBack(element) {
    element.find('.wpb_accordion_holder').not('.wpb_initialized').each(function(index) {
        jQuery(this).addClass('wpb_initialized');
        //var tab_counter = 4;
        //
        var $tabs,
            add_btn = jQuery(this).closest('.wpb_element_wrapper').find('.add_tab'),
            edit_btn = jQuery(this).closest('.wpb_element_wrapper').find('.edit_tab'),
            delete_btn = jQuery(this).closest('.wpb_element_wrapper').find('.delete_tab');
        //
        $tabs = jQuery(this).accordion({
            header: "> div > h3",
            autoHeight: false
        })
        .sortable({
            axis: "y",
            handle: "h3",
            stop: function( event, ui ) {
                // IE doesn't register the blur when sorting
                // so trigger focusout handlers to remove .ui-state-focus
                ui.item.children( "h3" ).triggerHandler( "focusout" );
                //
                save_composer_html();
            }
        });

        delete_btn.click( function(e) {
            e.preventDefault();

            var tab_name = $tabs.find('h3.ui-state-active a').text();

            var answer = confirm (i18nLocale.press_ok_delete_section.replace('{tab_name}', tab_name));
            if ( answer ) {
                $tabs.find('h3.ui-state-active a').closest('.group').remove();
                //
                save_composer_html();
            }
        });

        add_btn.click( function(e) {
            e.preventDefault();
            if(jQuery(this).hasClass('add_accordion_shortcode')) {
                var tab_title = i18nLocale.section_default_title;    
            } else if(jQuery(this).hasClass('add_tab_shortcode')) {
                var tab_title = i18nLocale.tab;
            }
            else if(jQuery(this).hasClass('add_slideshow_item')) {
                var tab_title = 'Slide Item';
            }
            
            var section_template = '<div class="group"><h3><a href="#">' + tab_title + '</a></h3><div class="row-fluid wpb_column_container wpb_sortable_container not-column-inherit"></div></div>';
            $tabs.append(section_template);
            $tabs.accordion( "destroy" )
            .accordion({
                header: "> div > h3",
                autoHeight: false
            })
            .sortable({
                axis: "y",
                handle: "h3",
                stop: function( event, ui ) {
                    // IE doesn't register the blur when sorting
                    // so trigger focusout handlers to remove .ui-state-focus
                    ui.item.children( "h3" ).triggerHandler( "focusout" );
                    //
                    save_composer_html();
                }
            });

            //$tabs.tabs( "add", "#tabs-" + tabs_count, tab_title );
            //tab_counter++;
            //
            initDroppable();
            save_composer_html();
        });

        edit_btn.click( function() {
            var tab_name = $tabs.find('h3.ui-state-active a').text();

            var tab_title = prompt(i18nLocale.please_enter_section_title, tab_name);
            if ( tab_title != null && tab_title != "" ) {
                $tabs.find('h3.ui-state-active a').text(tab_title);
                //
                save_composer_html();
            }
            return false;
        });
    });
    initDroppable();
}

function wpbAccordionGenerateShortcodeCallBack(current_top_level, inner_element_count) {
    var tab_title = current_top_level.find(".group:eq("+inner_element_count+") h3").text();
    output = '[vc_accordion_tab title="'+tab_title+'"] %inner_shortcodes [/vc_accordion_tab]';
    return output;
}

function wpbTabsGenerateShortcodeCallBack(current_top_level, inner_element_count) {
    var tab_title = current_top_level.find(".group:eq("+inner_element_count+") h3").text();
    output = '[vc_tab title="'+tab_title+'"] %inner_shortcodes [/vc_tab]';
    return output;
}

function wpbTabbedBoxGenerateShortcodeCallBack(current_top_level, inner_element_count) {
    var tab_title = current_top_level.find(".group:eq("+inner_element_count+") h3").text();
    output = '[vc_tabbed_box title="'+tab_title+'"] %inner_shortcodes [/vc_tabbed_box]';
    return output;
}

function wpbContentSlideshowGenerateShortcodeCallBack(current_top_level, inner_element_count) {
    output = '[mk_slide_item] %inner_shortcodes [/mk_slide_item]';
    return output;
}












/* Message box Callbacks
---------------------------------------------------------- */
function wpbMessageInitCallBack(element) {
    var el = element.find('.wpb_vc_param_value.color');
    var class_to_set = el.val();
    el.closest('.wpb_element_wrapper').addClass(class_to_set);
}

/* Text Separator Callbacks
---------------------------------------------------------- */
function wpbTextSeparatorInitCallBack(element) {
    var el = element.find('.wpb_vc_param_value.title_align');
    var class_to_set = el.val();
    el.closest('.wpb_element_wrapper').addClass(class_to_set);
}

/* Call to action Callbacks
---------------------------------------------------------- */
function wpbCallToActionInitCallBack(element) {
    var el = element.find('.wpb_vc_param_value.position');
    var class_to_set = el.val();
    el.closest('.wpb_element_wrapper').addClass(class_to_set);
}
function wpbCallToActionSaveCallBack(element) {
    var el_class = element.find('.wpb_vc_param_value.color').val() + " " + element.find('.wpb_vc_param_value.icon').val();
    //
    element.find('.wpb_element_wrapper').removeClass(el_class);
}

/* Button Callbacks
---------------------------------------------------------- */
function wpbButtonInitCallBack(element) {
    var el_class = element.find('.wpb_vc_param_value.color').val() + ' ' + element.find('.wpb_vc_param_value.size').val() + ' ' + element.find('.wpb_vc_param_value.icon').val();
    //
    element.find('button.title').attr({ "class" : "wpb_vc_param_value title textfield wpb_button " + el_class });

    var icon = element.find('.wpb_vc_param_value.icon').val();
    if ( icon != 'none' && element.find('button i.icon').length == 0  ) {
        element.find('button.title').append(' <i class="icon"></i>');
    }
}

function wpbButtonSaveCallBack(element) {
    var el_class = element.find('.wpb_vc_param_value.color').val() + ' ' + element.find('.wpb_vc_param_value.size').val() + ' ' + element.find('.wpb_vc_param_value.icon').val();
    //
    element.find('.wpb_element_wrapper').removeClass(el_class);
    element.find('button.title').attr({ "class" : "wpb_vc_param_value title textfield wpb_button " + el_class });

    var icon = element.find('.wpb_vc_param_value.icon').val();
    if ( icon != 'none' && element.find('button i.icon').length == 0 ) {
        element.find('button.title').append(' <i class="icon"></i>');
    } else {
        element.find('button.title i.icon').remove();
    }
}

/**
 * Taxomonies filter
 *
 * Show or hide taxomonies depending on selected post types
 *
 * @param $element - post type checkbox object
 * @param $object -
 */
function wpb_grid_post_types_for_taxomonies_handler($element, $object) {

    var $labels = $object.find('label[data-post-type]');
    $labels.hide();

    jQuery('.grid_posttypes:checkbox').change(function(){
        if(jQuery(this).is(':checked')) {
            $labels.filter('[data-post-type=' + jQuery(this).val() + ']').show();
        } else {
            $labels.filter('[data-post-type=' + jQuery(this).val() + ']').hide();
        }
    }).each(function(){
            if(jQuery(this).is(':checked')) $labels.filter('[data-post-type=' + jQuery(this).val() + ']').show();
    });
}


