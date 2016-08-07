function mk_composer_toggle() {
jQuery('.mk-composer-toggle').each(function(){

		default_value = jQuery(this).find('input').val();

		if(default_value === 'true'){
			jQuery(this).addClass('on');
		} else {
			jQuery(this).addClass('off');
		}

		jQuery(this).click(function() {
			if(jQuery(this).hasClass('on')) {											   
					jQuery(this).removeClass('on').addClass('off');
					jQuery(this).find('input').val('false');
			} else {
					jQuery(this).removeClass('off').addClass('on');
					jQuery(this).find('input').val('true');		
			}
		});
});
}


function mk_shortcode_fonts() {
	jQuery("#font_family").change(function () {								   
          jQuery("#font_family option:selected").each(function () {
			var type = jQuery(this).attr('data-type');										 
              jQuery("#font_type").val(type); 
              });
		
 	}).change(); 

}

jQuery(document).ready(function() {



/* 
**
** Toggle Button Option
-------------------------------------------------------------*/
jQuery('.mk-toggle-button').each(function(){

		default_value = jQuery(this).find('input').val();

		if(default_value === 'true'){
			jQuery(this).addClass('on');
		} else {
			jQuery(this).addClass('off');
		}

		jQuery(this).click(function() {
			if(jQuery(this).hasClass('on')) {											   											   
					jQuery(this).removeClass('on').addClass('off');
					jQuery(this).find('input').val('false');
			} else {
					jQuery(this).removeClass('off').addClass('on');
					jQuery(this).find('input').val('true');			
			}
		});
});



/* 
**
** Color Picker Plugin
-------------------------------------------------------------

*/

jQuery('.color-picker').on('change', function() {
				
	var input_id = jQuery(this).attr('id') + '_rgba';
	

	if(jQuery(this).attr('data-opacity') !== 1) {
			opacity = jQuery(this).attr('data-opacity');
			jQuery(this).parent().siblings('.rgba-value-console').text('Opacity: ' + opacity);
			jQuery('#' + input_id).val(opacity);
	}
				
});

jQuery('.color-picker, .specific-color-picker').each(function() {

		var input_id = jQuery(this).attr('id') + '_rgba';

		if(jQuery('#' + input_id).val() !== '1' || jQuery('#' + input_id).val() === '') {
			opacity = jQuery('#' + input_id).val();
			jQuery(this).attr('data-opacity', opacity);
			jQuery(this).parents('.mk-single-option').find('.rgba-value-console').text('Opacity: ' + opacity);
		}	

});




/* 
**
** Range Input Plugin
-------------------------------------------------------------*/
jQuery(".mk-range-input .range-input-selector").rangeinput();				



/* 
**
Chosen Plugin
-------------------------------------------------------------*/
jQuery(".mk-chosen").chosen();


/* 
**
** Non-safe fonts type change
-------------------------------------------------------------*/
jQuery("#special_fonts_list_1").change(function () {
												   
          jQuery("#special_fonts_list_1 option:selected").each(function () {
			var type = jQuery(this).attr('data-type');										 
              jQuery('#special_fonts_type_1').val(type); 
              });
		
 }).change();  
	
	
jQuery("#special_fonts_list_2").change(function () {
												   
          jQuery("#special_fonts_list_2 option:selected").each(function () {
			var type = jQuery(this).attr('data-type');										 
              jQuery('#special_fonts_type_2').val(type); 
              });
		
 }).change(); 




/* 
**
Custom Sidebar
-------------------------------------------------------------*/
jQuery("#add_sidebar_item").click(function(e) {
	 e.preventDefault();
			
				
				var clone_item = jQuery(this).parents('.custom-sidebar-wrapper').siblings('#selected-sidebar').find('.default-sidebar-item').clone(true);
				var clone_val = jQuery(this).siblings('#add_sidebar').val();
				if(clone_val === '') { return; }
				
				if(jQuery('#sidebars').val()){
				jQuery('#sidebars').val(jQuery('#sidebars').val()+','+jQuery("#add_sidebar").val());
				}else{
						jQuery('#sidebars').val(jQuery("#add_sidebar").val());
					}
				clone_item.removeClass('default-sidebar-item').addClass('sidebar-item');
				clone_item.find('.sidebar-item-value').attr('value', clone_val);
				clone_item.find('.slider-item-text').html(clone_val);
				jQuery("#selected-sidebar").append(clone_item);
				jQuery(".sidebar-item").fadeIn(300);
				jQuery("#add_sidebar").val("");
	
	});
	jQuery(".sidebar-item").css('display','block');
	
	jQuery(".delete-sidebar").click(function(e){
		e.preventDefault();
		jQuery(this).parent("#sidebar-item").slideUp(300,function(){
  			jQuery(this).remove();
  			jQuery('#sidebars').val('');
			jQuery(".sidebar-item-value").each(function(){
				if(jQuery('#sidebars').val()){
					jQuery('#sidebars').val(jQuery('#sidebars').val()+','+jQuery(this).val());
		
				}else{
					jQuery('#sidebars').val(jQuery(this).val());
					
				}
				
				
			});
 		});
		
	});	












/* 
**
Homepage Tabbed Content
-------------------------------------------------------------*/


jQuery("#add_tab_item").click(function(e) {
	 e.preventDefault();
			
				
				var clone_item = jQuery('#mk-current-tabs').find('.default-tab-item').clone(true);
				var clone_tab_val = jQuery('#add_tab').val();
				var clone_select_title = jQuery('#homepage_tabbed_box_pages_input').attr('data-title');
				var clone_select_value = jQuery('#homepage_tabbed_box_pages_input').val();
				if(clone_tab_val === '') { return; }
				
				if(jQuery('#homepage_tabs').val()){
				jQuery('#homepage_tabs').val(jQuery('#homepage_tabs').val()+','+jQuery("#add_tab").val());
				}else{
						jQuery('#homepage_tabs').val(jQuery("#add_tab").val());
				}

				if(jQuery('#homepage_tabs_page_id').val()){
				jQuery('#homepage_tabs_page_id').val(jQuery('#homepage_tabs_page_id').val()+','+jQuery("#homepage_tabbed_box_pages_input").val());
				}else{
					jQuery('#homepage_tabs_page_id').val(jQuery("#homepage_tabbed_box_pages_input").val());
				}

				if(jQuery('#homepage_tabs_page_title').val()){
				jQuery('#homepage_tabs_page_title').val(jQuery('#homepage_tabs_page_title').val()+','+jQuery("#homepage_tabbed_box_pages").find('.selected_item').text());
				}else{
					jQuery('#homepage_tabs_page_title').val(jQuery("#homepage_tabbed_box_pages").find('.selected_item').text());
				}

				clone_item.removeClass('default-tab-item').addClass('mk-tabbed-item');
				clone_item.find('.mk-tab-item-value').attr('value', clone_tab_val);
				clone_item.find('.mk-tab-item-page-id').attr('value', clone_select_value);
				clone_item.find('.mk-tab-item-page-title').attr('value', clone_select_title);
				clone_item.find('.tab-title-text').html(clone_tab_val);
				clone_item.find('.tab-content-pane').html(clone_select_title);
				jQuery("#mk-current-tabs").append(clone_item);
				jQuery(".mk-tabbed-item").fadeIn(300);
				jQuery("#add_tab").val("");
	
	});
	jQuery(".mk-tabbed-item").css('display','block');
	
	jQuery(".delete-tab-item").click(function(e){
		e.preventDefault();
		jQuery(this).parent(".mk-tabbed-item").slideUp(300,function(){
  			jQuery(this).remove();
  			jQuery('#homepage_tabs').val('');
  			jQuery('#homepage_tabs_page_id').val('');
  			jQuery('#homepage_tabs_page_title').val('');

			jQuery(".mk-tab-item-value").each(function(){
				if(jQuery('#homepage_tabs').val()){
					jQuery('#homepage_tabs').val(jQuery('#homepage_tabs').val()+','+jQuery(this).val());
		
				}else{
					jQuery('#homepage_tabs').val(jQuery(this).val());
					
				}
			});

			jQuery(".mk-tab-item-page-id").each(function(){
				if(jQuery('#homepage_tabs_page_id').val()){
					jQuery('#homepage_tabs_page_id').val(jQuery('#homepage_tabs_page_id').val()+','+jQuery(this).val());
		
				}else{
					jQuery('#homepage_tabs_page_id').val(jQuery(this).val());
					
				}
			});

			jQuery(".mk-tab-item-page-title").each(function(){
				if(jQuery('#homepage_tabs_page_title').val()){
					jQuery('#homepage_tabs_page_title').val(jQuery('#homepage_tabs_page_title').val()+','+jQuery(this).val());
		
				}else{
					jQuery('#homepage_tabs_page_title').val(jQuery(this).val());
					
				}
			});

 		});
		
	});		




















/* 
**
Header Social Netowrks 
-------------------------------------------------------------*/


jQuery("#add_header_social_item").click(function(e) {
	 e.preventDefault();
			
				
				var clone_item = jQuery('#mk-current-social').find('.default-social-item').clone(true);
				var clone_url_val = jQuery('#header_social_url').val();
				var clone_select_value = jQuery('#header_social_sites_select').val();
				if(clone_url_val === '') { return; }
				
				if(jQuery('#header_social_networks_site').val()){
				jQuery('#header_social_networks_site').val(jQuery('#header_social_networks_site').val()+','+jQuery("#header_social_sites_select").val());
				}else{
						jQuery('#header_social_networks_site').val(jQuery("#header_social_sites_select").val());
				}

				if(jQuery('#header_social_networks_url').val()){
				jQuery('#header_social_networks_url').val(jQuery('#header_social_networks_url').val()+','+jQuery("#header_social_url").val());
				}else{
					jQuery('#header_social_networks_url').val(jQuery("#header_social_url").val());
				}

				clone_item.removeClass('default-social-item').addClass('mk-social-item');
				clone_item.find('.mk-social-item-site').attr('value', clone_select_value);
				clone_item.find('.mk-social-item-url').attr('value', clone_url_val);

				clone_item.find('.social-item-url').html(clone_url_val);
				clone_item.find('.social-item-icon').html('<i class="mk-social-'+clone_select_value+'"></i>');
				jQuery("#mk-current-social").append(clone_item);
				jQuery(".mk-social-item").fadeIn(300);
				jQuery("#header_social_url").val("");
	
	});
	jQuery(".mk-social-item").css('display','block');
	
	jQuery(".delete-social-item").click(function(e){
		e.preventDefault();
		jQuery(this).parent(".mk-social-item").slideUp(200,function(){
  			jQuery(this).remove();
  			jQuery('#header_social_networks_url').val('');
  			jQuery('#header_social_networks_site').val('');

			jQuery(".mk-social-item-site").each(function(){
				if(jQuery('#header_social_networks_site').val()){
					jQuery('#header_social_networks_site').val(jQuery('#header_social_networks_site').val()+','+jQuery(this).val());
		
				}else{
					jQuery('#header_social_networks_site').val(jQuery(this).val());
					
				}
			});

			jQuery(".mk-social-item-url").each(function(){
				if(jQuery('#header_social_networks_url').val()){
					jQuery('#header_social_networks_url').val(jQuery('#header_social_networks_url').val()+','+jQuery(this).val());
		
				}else{
					jQuery('#header_social_networks_url').val(jQuery(this).val());
					
				}
			});

			

 		});
		
	});		





    		







/* 
**
Option : Super links
-------------------------------------------------------------*/
 function super_link() {
		var wrap = jQuery(".superlink-wrap");
		wrap.each(function(){
			var field = jQuery(this).siblings('input:hidden');
			var selector = jQuery(this).siblings('select');
			var name = field.attr('name');
			var items = jQuery(this).children();
			selector.change(function(){
				items.hide();
				jQuery("#"+name+"_"+jQuery(this).val()).show();
				field.val('');
			});
			items.change(function(){
				field.val(selector.val()+'||'+jQuery(this).val());
			});
		});
	}
super_link();



/* 
**
Visual Selector Option
-------------------------------------------------------------*/

jQuery('.mk-visual-selector').find('a').each(function() {

	default_value = jQuery(this).siblings('input').val();

	if(jQuery(this).attr('rel') === default_value){
			jQuery(this).addClass('current');
			jQuery(this).append('<div class="selector-tick"></div>');
		}

		jQuery(this).click(function(){

			jQuery(this).siblings('input').val(jQuery(this).attr('rel'));
			jQuery(this).parent('.mk-visual-selector').find('.current').removeClass('current');
			jQuery(this).parent('.mk-visual-selector').find('.selector-tick').remove();
			jQuery(this).addClass('current');
			jQuery(this).append('<div class="selector-tick"></div>');
			return false;
		});
});




/* 
**
Fancy Select Option
-------------------------------------------------------------*/

jQuery('.mk-fancy-selectbox').each(function(){
	
	var $this = jQuery(this);
	var select_heading = jQuery('.mk-selector-heading', this);
	var selector_width = jQuery('.mk-selector-heading', this).outerWidth();
	var select_options = jQuery('.mk-select-options', this);
	var selected_item_text = select_options.find('.selected').text();
	var selected_item_color = select_options.find('.selected').attr('data-color');


	select_options.css('width', selector_width-2);
	

		if($this.hasClass('color-based')) {
			if(selected_item_text !== '') {
				select_heading.find('.selected_item').text(selected_item_text);
				select_heading.find('.selected_color').css('background', selected_item_color);
			} else {
				select_heading.find('.selected_item').text('Select Color ...');
			}
		} else {
			if(selected_item_text !== '') {
				select_heading.find('.selected_item').text(selected_item_text);
			} else {
				select_heading.find('.selected_item').text('Select Option ...');
			}
		}

		select_options.addClass('hidden');

	select_heading.click(function(){
		if(select_options.hasClass('hidden')){
			$this.addClass('selectbox-focused');
			select_options.show().removeClass('hidden').addClass('visible');
		} else {
			select_options.hide().removeClass('visible').addClass('hidden');
			$this.removeClass('selectbox-focused');
		}
		
	});

	$this.bind('clickoutside', function (event) {
   			select_options.hide();
			select_options.removeClass('visible').addClass('hidden');
			$this.removeClass('selectbox-focused');
		});

	select_options_height = select_options.outerHeight();

	if(select_options_height > 300) {
		select_options.css({'height' : '300px', 'overflow' : 'scroll', 'overflow-x' : 'hidden'});
	}


		select_options.find('.mk-select-option').on('click', function(event) {
			event.stopPropagation();
			$select_option = jQuery(this);
			$select_option.siblings().removeClass('selected');
			$select_option.addClass('selected');
			$select_option.siblings('input').attr('value', $select_option.attr('value'));
			selected_item = $select_option.text();
			$select_option.parent('.mk-select-options').siblings('.mk-selector-heading').find('.selected_item').text(selected_item);
			$select_option.parent('.mk-select-options').hide().removeClass('visible').addClass('hidden');
			$select_option.parents('.mk-fancy-selectbox').removeClass('selectbox-focused');

			if($select_option.parents('.mk-fancy-selectbox').hasClass('color-based')){
				select_heading.find('.selected_color').css('background', $select_option.attr('data-color'));
			}


			if(select_options.parent().attr('id') === 'homepage_tabbed_box_pages') {
				$select_option.siblings('input').attr('data-title', $select_option.text());

			}


		});

});


/* 
**
Masterkey tabs
-------------------------------------------------------------*/

jQuery("ul.mk-sub-navigator",this).tabs("div.mk-sub-panes > div", {tabs:'li',effect: 'default'});
	
jQuery("ul.mk-main-navigator",this).tabs("div.mk-main-panes > div", {tabs:'li',effect: 'default'}); 

jQuery("ul.bg-image-preset-tabs",this).tabs("div.bg-image-preset-panes > div", {tabs:'li',effect: 'default'}); 


/* 
**
** Main Navigator Icons Transition
-------------------------------------------------------------*/
	jQuery(".mk-main-navigator li a")
	.hover(function() {
		
		jQuery(this).find('.active').stop(true, true).fadeIn(100);

	}, function() {
		if(jQuery(this).parent().hasClass('current')) {
		} else {
		jQuery(this).find('.active').stop(true, true).fadeOut(100);
			}
	});

	jQuery('.mk-main-navigator li').each(function(){

		if(jQuery(this).hasClass('current')) {
			jQuery(this).find('.active').show();
		}

		jQuery(this).click(function(){
			jQuery(".mk-main-navigator li ").find('.active').hide();
			jQuery(this).find('.active').show();
			
		});

	});






/* 
**
Page metabox slideshow options selections
-------------------------------------------------------------*/
function mk_page_metabox_slideshow() {
slideshow_choices = jQuery('#_slideshow_items_to_show_wrapper, #_layer_slider_source_wrapper, #_rev_slider_source_wrapper');
slideshow_choices.hide();
source_val = jQuery('#_slideshow_source').val();
	if(source_val === 'flexslider') {
		jQuery('#_slideshow_items_to_show_wrapper').show();
	} else if(source_val === 'revslider') {
		jQuery('#_rev_slider_source_wrapper').show();
	} else if(source_val === 'layerslider') {
		jQuery('#_layer_slider_source_wrapper').show();
	}

jQuery('#_slideshow_source').change(function() {
	this_val = jQuery(this).val();
	slideshow_choices.slideUp();
	if(this_val === 'flexslider') {
		jQuery('#_slideshow_items_to_show_wrapper').slideDown();
	} else if(this_val === 'revslider') {
		jQuery('#_rev_slider_source_wrapper').slideDown();
	} else if(this_val === 'layerslider') {
		jQuery('#_layer_slider_source_wrapper').slideDown();
	} 

}).change();

}
mk_page_metabox_slideshow();




/* 
**
Posts types metaboxes to show the selected items
-------------------------------------------------------------*/
function mk_posttype_metabox() {
post_choices = jQuery('#_mp3_file_wrapper, #_ogg_file_wrapper, #_single_video_site_wrapper, #_single_video_id_wrapper, #_disable_video_lightbox_wrapper');
post_choices.hide();
source_val = jQuery('#_single_post_type').val();
	if(source_val === 'video') {
		jQuery('#_single_video_site_wrapper, #_single_video_id_wrapper, #_disable_video_lightbox_wrapper').show();
	} else if(source_val === 'audio') {
		jQuery('#_mp3_file_wrapper, #_ogg_file_wrapper').show();
	}

jQuery('#_single_post_type').change(function() {
	this_val = jQuery(this).val();
	post_choices.slideUp();
	if(this_val === 'video') {
		jQuery('#_single_video_site_wrapper, #_single_video_id_wrapper, #_disable_video_lightbox_wrapper').slideDown();
	} else if(this_val === 'audio') {
		jQuery('#_mp3_file_wrapper, #_ogg_file_wrapper').slideDown();
	} 

}).change();

}
mk_posttype_metabox();





/* 
**
General Background Selector
-------------------------------------------------------------*/

mk_background_orientation = jQuery('#background_selector_orientation').val();



if(mk_background_orientation === 'full_width_layout') {
	jQuery('#boxed_layout_shadow_size_wrapper, #boxed_layout_shadow_intensity_wrapper').hide();
} else {
	jQuery('#boxed_layout_shadow_size_wrapper, #boxed_layout_shadow_intensity_wrapper').show();
}



/* update background viewer accordingly */
jQuery('.mk-general-bg-selector').addClass(jQuery('#background_selector_orientation').val());

jQuery('.background_selector_orientation a').click(function(){
	if(jQuery(this).attr('rel') === 'full_width_layout'){
		jQuery('.mk-general-bg-selector').removeClass('boxed_layout').addClass('full_width_layout');
		jQuery('#boxed_layout_shadow_size_wrapper, #boxed_layout_shadow_intensity_wrapper').hide();
	} else {
		jQuery('.mk-general-bg-selector').removeClass('full_width_layout').addClass('boxed_layout');
		body_section_width = jQuery('.mk-general-bg-selector .outer-wrapper').width();
		jQuery('.mk-general-bg-selector.boxed_layout .body-section').css('width', body_section_width);
		jQuery('#boxed_layout_shadow_size_wrapper, #boxed_layout_shadow_intensity_wrapper').show();
	}
	
});






/* Background selector Edit panel */
function select_current_element() {
	var options_parent_div = jQuery('.bg-repeat-option, .bg-attachment-option, .bg-position-option');

	options_parent_div.each(function() {
			jQuery(this).find('a').on('click', function(event){
					event.preventDefault();
					jQuery(this).siblings().removeClass('selected').end().addClass('selected');
			});
	});

			jQuery('.bg-image-preset-panes').find('a').on('click', function(event) {
				event.preventDefault();
				jQuery(this).parents('.bg-image-preset-panes').find('li').removeClass('selected').end().end().parent().addClass('selected');

			});
}
select_current_element();




/* Call background Edit panel */
function call_background_edit() {
	var sections = jQuery('.header-section, .page-section, .footer-section, .body-section');

	sections.each(function() {
			jQuery(this).on('click', function(event){
					event.preventDefault();
					this_panel = jQuery(this);		
					this_panel_rel = jQuery(this).attr('rel');
							
					jQuery('#mk-bg-edit-panel').fadeIn(200);

				// gets current section input IDs
				color_id = '#' + this_panel_rel + '_color';
				color_rgba_id = '#' + this_panel_rel + '_color_rgba';
				image_id = '#' + this_panel_rel + '_image';
				position_id = '#' + this_panel_rel + '_position';
				repeat_id = '#' + this_panel_rel + '_repeat';
				attachment_id = '#' + this_panel_rel + '_attachment';
				source_id = '#' + this_panel_rel + '_source';

				color_value = jQuery(color_id).val();
				color_rgba_value = jQuery(color_rgba_id).val();
				image_value = jQuery(image_id).val();
				position_value = jQuery(position_id).val();
				repeat_value = jQuery(repeat_id).val();
				attachment_value = jQuery(attachment_id).val();
				source_value = jQuery(source_id).val();



				

				jQuery('#bg_panel_color').attr('value', color_value);
				jQuery('#bg_panel_color').attr('data-opacity', color_rgba_value);
				jQuery('#mk-bg-edit-panel a[rel="' + position_value + '"]').siblings().removeClass('selected').end().addClass('selected');
				jQuery('#mk-bg-edit-panel a[rel="' + repeat_value + '"]').siblings().removeClass('selected').end().addClass('selected');
				jQuery('#mk-bg-edit-panel a[rel="' + attachment_value + '"]').siblings().removeClass('selected').end().addClass('selected');
				//jQuery('.bg-background-type-tabs a[rel="' + source_value + '"]').parent('li').siblings().removeClass('current').end().addClass('current');

				if(source_value === 'preset' && image_value !== ''){
					jQuery('#mk-bg-edit-panel a[rel="' + image_value + '"]').parent('li').siblings().removeClass('selected').end().addClass('selected');
				} else if(source_value === 'custom' && image_value !== ''){
					
					jQuery('#bg_panel_upload').attr('value', image_value);
					jQuery('.custom-image-preview-block img').attr('src', jQuery('#bg_panel_upload').val());
				}

					jQuery('#mk-bg-edit-panel').attr('rel', jQuery(this).attr('rel'));
					jQuery('#mk-bg-edit-panel').find('.mk-edit-panel-heading').text(jQuery(this).attr('rel'));
					
					jQuery('.bg-background-type-tabs').find('a[rel="'+source_value+'"]').parent().siblings().removeClass('current').end().addClass('current');		


					jQuery('#mk-bg-edit-panel').find('.bg-background-type-panes').children('.bg-background-type-pane').hide();
					if(source_value === 'preset') {

						jQuery('#mk-bg-edit-panel').find('.bg-background-type-pane.bg-image-preset').show();

					} else if(source_value === 'no-image') {

						jQuery('#mk-bg-edit-panel').find('.bg-background-type-pane.bg-no-image').show();

					} else if(source_value === 'custom') {

						jQuery('#mk-bg-edit-panel').find('.bg-background-type-pane.bg-edit-panel-upload').show();
					}





			jQuery('#mk-bg-edit-panel').find('.bg-background-type-tabs a').on('click', function(event){

					event.preventDefault();

					jQuery('#mk-bg-edit-panel').find('.bg-background-type-panes').children('.bg-background-type-pane').hide();

					jQuery(this).parent().siblings().removeClass('current').end().addClass('current');

					if(jQuery(this).attr('rel') === 'preset') {

						jQuery('#mk-bg-edit-panel').find('.bg-background-type-pane.bg-image-preset').show();

					} else if(jQuery(this).attr('rel') === 'no-image') {

						jQuery('#mk-bg-edit-panel').find('.bg-background-type-pane.bg-no-image').show();

					} else if(jQuery(this).attr('rel') === 'custom') {

						jQuery('#mk-bg-edit-panel').find('.bg-background-type-pane.bg-edit-panel-upload').show();
					}
				});
			});
	});

}
call_background_edit();


/* Background edit panel cancel and back buttons */
jQuery('#mk_cancel_bg_selector, .mk-bg-edit-panel-heading-cancel').on('click', function(event) {
	event.preventDefault();
	jQuery('#mk-bg-edit-panel').fadeOut(200);
});

/* Triggers cancel button for background panel when escape key is pressed */
jQuery(document).keyup(function(e) {
  if (e.keyCode === 27) { jQuery('#mk_cancel_bg_selector, .mk-bg-edit-panel-heading-cancel').click(); }
});

/* Triggers Apply button for background panel when enter key is pressed */
jQuery(document).keyup(function(e) {
  if (e.keyCode === 13) { jQuery('#mk_apply_bg_selector').click(); }
});

/* Sends Panel Modifications into inputs and updates preview panel background */
function update_panel_to_preview(){
	jQuery('#mk_apply_bg_selector').on('click', function(event){
		event.preventDefault();
		panel = jQuery('#mk-bg-edit-panel');
		panel_source = panel.attr('rel');
		section_preview_class = '.' + panel_source + '-section';
		color = panel.find('#bg_panel_color').val();
		color_rgba = panel.find('#bg_panel_color').attr('data-opacity');
		position = jQuery('.bg-position-option').find('.selected').attr('rel');
		repeat = jQuery('.bg-repeat-option').find('.selected').attr('rel');
		attachment = jQuery('.bg-attachment-option').find('.selected').attr('rel');


		image_source = jQuery('.bg-background-type-tabs').find('.current').children('a').attr('rel');
		if(image_source === 'preset') {
			image = jQuery('.bg-image-preset-panes').find('.selected').children('a').attr('rel');
		} else if(image_source === 'custom') {
			image = jQuery('#bg_panel_upload').val();
		} else if(image_source === 'no-image') {
			image = '';
		}


		// gets current section input IDs
		color_id = '#' + panel_source + '_color';
		color_rgba_id = '#' + panel_source + '_color_rgba';
		image_id = '#' + panel_source + '_image';
		position_id = '#' + panel_source + '_position';
		repeat_id = '#' + panel_source + '_repeat';
		attachment_id = '#' + panel_source + '_attachment';
		source_id = '#' + panel_source + '_source';

		// Updates Input values
		jQuery(color_id).attr('value', color);
		jQuery(color_rgba_id).attr('value', color_rgba);
		jQuery(image_id).attr('value', image);
		jQuery(position_id).attr('value', position);
		jQuery(repeat_id).attr('value', repeat);
		jQuery(attachment_id).attr('value', attachment);
		jQuery(source_id).attr('value', image_source);

		
		//update preview panel background
	if(image !== '') {
		jQuery(section_preview_class).find('.mk-bg-preview-layer').css('background-image' , 'url('+image+')');
	}

	if(image_source === 'no-image') {
		jQuery(section_preview_class).find('.mk-bg-preview-layer').css('background-image' , 'none');
	}
		
		jQuery(section_preview_class).find('.mk-bg-preview-layer').css({
			'background-color' : color,
			'background-position' : position,
			'background-repeat' : repeat,
			'background-attachment' : attachment
		});






	panel.fadeOut(200);

		panel.find('#bg_panel_color').val('');
		jQuery('.bg-position-option').find('.selected').removeClass('selected');
		jQuery('.bg-repeat-option').find('.selected').removeClass('selected');
		jQuery('.bg-attachment-option').find('.selected').removeClass('selected');
		jQuery('#bg_panel_upload').val('');
		jQuery('.bg-image-preset-panes').find('.selected').removeClass('selected');
		jQuery('.custom-image-preview-block img').attr('src', '');
	});

}
update_panel_to_preview();




/* Update the preview panel backgrounds on load */
function update_preview_on_load(){
		
	jQuery('.page-section, .body-section, .header-section, .footer-section').each(function(){

		this_panel = jQuery(this);
		this_panel_rel = this_panel.attr('rel');

		// gets current section input IDs
		color_id = '#' + this_panel_rel + '_color';
		image_id = '#' + this_panel_rel + '_image';
		position_id = '#' + this_panel_rel + '_position';
		repeat_id = '#' + this_panel_rel + '_repeat';
		attachment_id = '#' + this_panel_rel + '_attachment';

		color = jQuery(color_id).val();
		image = jQuery(image_id).val();
		position = jQuery(position_id).val();
		repeat = jQuery(repeat_id).val();
		attachment = jQuery(attachment_id).val();

		//update preview panel background
		if(image !== '') {
		jQuery(this_panel).find('.mk-bg-preview-layer').css({
			'background-image' : 'url('+image+')'
		});
		}

		jQuery(this_panel).find('.mk-bg-preview-layer').css({
			'background-color' : color,
			'background-position' : position,
			'background-repeat' : repeat,
			'background-attachment' : attachment
		});
	});
}

update_preview_on_load();




/* 
**
Specific Background Selector
-------------------------------------------------------------*/


function specific_background_selector() {

jQuery('.mk-specific-bg-selector').each(function() {

	

var this_section_id = '#' + jQuery(this).attr('id');


background_source_type = jQuery(this_section_id).find('.specific-image-source').val();

jQuery(this_section_id).find('.bg-background-type-tabs li a').each(function() {
	if(jQuery(this).attr('rel') === background_source_type) {
		jQuery(this).parent().addClass('current');
	}
});


	if(background_source_type === 'preset') {

		jQuery(this_section_id).find('.bg-background-type-pane.specific-image-preset').show();

	} else if(background_source_type === 'no-image') {

		jQuery(this_section_id).find('.bg-background-type-pane.specific-no-image').show();

	} else if(background_source_type === 'custom') {

		jQuery(this_section_id).find('.bg-background-type-pane.specific-edit-panel-upload').show();
	}


jQuery(this_section_id).find('.bg-background-type-tabs li a').on('click', function(event) {
	event.preventDefault();

	jQuery(this_section_id).find('.specific-image-source').val(jQuery(this).attr('rel'));

	jQuery(this_section_id).find('.bg-background-type-panes').children('.bg-background-type-pane').hide()

	jQuery(this).parent().siblings().removeClass('current').end().addClass('current');

	if(jQuery(this).attr('rel') === 'preset') {

		jQuery(this_section_id).find('.bg-background-type-pane.specific-image-preset').show();

	} else if(jQuery(this).attr('rel') === 'no-image') {

		jQuery(this_section_id).find('.bg-background-type-pane.specific-no-image').show();

	} else if(jQuery(this).attr('rel') === 'custom') {

		jQuery(this_section_id).find('.bg-background-type-pane.specific-edit-panel-upload').show();
	}

});


	jQuery(this_section_id).find('.mk-specific-edit-option-repeat').each(function(){
		saved_value = jQuery(this).find('input').val(); 
		jQuery(this).find('a[rel="' + saved_value + '"]').siblings().removeClass('selected').end().addClass('selected');
		repeat_saved_value = jQuery(this).find('input').val(); 

		jQuery(this).find('a').click(function() {

			this_rel = jQuery(this).attr('rel');
			jQuery(this).siblings('input').val(this_rel);
		});

	});



	jQuery(this_section_id).find('.mk-specific-edit-option-attachment').each(function(){
		saved_value = jQuery(this).find('input').val(); 
		jQuery(this).find('a[rel="' + saved_value + '"]').siblings().removeClass('selected').end().addClass('selected');
		attachment_saved_value = jQuery(this).find('input').val(); 
		jQuery(this).find('a').click(function() {

			this_rel = jQuery(this).attr('rel');
			jQuery(this).siblings('input').val(this_rel);
		});

	});




	jQuery(this_section_id).find('.mk-specific-edit-option-position').each(function(){
		saved_value = jQuery(this).find('input').val(); 
		jQuery(this).find('a[rel="' + saved_value + '"]').siblings().removeClass('selected').end().addClass('selected');

		jQuery(this).find('a').click(function() {

			this_rel = jQuery(this).attr('rel');
			jQuery(this).siblings('input').val(this_rel);
		});

	});


	jQuery(this_section_id).find('.mk-specific-edit-option-position').each(function(){
		saved_value = jQuery(this).find('input').val(); 
		jQuery(this).find('a[rel="' + saved_value + '"]').siblings().removeClass('selected').end().addClass('selected');

		jQuery(this).find('a').click(function() {

			this_rel = jQuery(this).attr('rel');
			jQuery(this).siblings('input').val(this_rel);
		});

	});



	jQuery(this_section_id).find('.specific-image-preset').each(function(){
		saved_value = jQuery(this).find('input').val(); 
		jQuery(this).find('a[rel="' + saved_value + '"]').parent().siblings().removeClass('selected').end().addClass('selected');

		jQuery(this).find('a').click(function() {

			this_rel = jQuery(this).attr('rel');
			jQuery(this).parents('.specific-image-preset').find('input').val(this_rel);
		});

	});



	



});


}

specific_background_selector();



});




/* 
**
Save Masterkey Options
-------------------------------------------------------------*/
jQuery(document).ready(function() {



    jQuery(".masterkey-options-page form").each(function (){
        var that = jQuery(this);
        jQuery("button", that).bind("click keypress", function (){
            that.data("callerid", this.id);
        });
    });



		jQuery('form#masterkey_settings').submit(function() {
			
 			var callerId = jQuery(this).data("callerid");


				  function newValues() {
					var serializedValues = jQuery('#masterkey_settings input, #masterkey_settings select, #masterkey_settings textarea[name!=theme_export_options]').serialize();
						return serializedValues;
					}
							
							jQuery(":hidden").change(newValues);
							jQuery("select").change(newValues);
							var serializedReturn = newValues();
				  		
							jQuery('#mk-saving-settings').bPopup({
					                    zIndex: 100,
					                    modalColor : '#fff'
					                });
				  
				  data = serializedReturn + '&button_clicked=' + callerId;

				  //alert(serializedReturn);
				  
				  jQuery.post(ajaxurl, data, function(response) {
				  	jQuery('#mk-saving-settings').bPopup().close();
					show_message(response);
				  });
				  
				  return false;
			  });





				/* Confirm Reset to default box */
				jQuery("#mk_reset_confirm").click(function() {
							jQuery('#mk-are-u-sure').bPopup({
			                    zIndex: 100,
			                    modalColor : '#fff'
							});						
							return false;
							});

				jQuery("#mk_reset_cancel").click(function() {
							jQuery('#mk-are-u-sure').bPopup().close();						
							return false;
							});

 				jQuery("#mk_reset_ok").click(function() {
							 jQuery('#mk-are-u-sure').bPopup().close();
							jQuery('#reset_theme_options').trigger('click');
							return false;
				});
 				/**************/	


		 		/* Disables enter key on masterkey options to prevent any unwilling submittions */		
				jQuery("#masterkey_settings input").keypress(function(event) {
				    if (event.which == 13) {
				        event.preventDefault();
				  
				    }
				});

});




/* Show Box Messages */
function show_message(n) {
		if(n == 1) {
					jQuery('#mk-success-save').bPopup({
			                    zIndex: 100,
			                    modalColor : '#fff',
					});
					setTimeout(function(){
	    		jQuery('#mk-success-save').bPopup().close();
  					},1500);
		
					
		} 
		if(n == 0){
					jQuery('#mk-not-saved').bPopup({
			                    zIndex: 100,
			                    modalColor : '#fff',
					});
					setTimeout(function(){
	    				jQuery('#mk-not-saved').bPopup().close();
  					},1500);
					
		} 
		if(n == 2) {
					jQuery('#mk-already-saved').bPopup({
			                    zIndex: 100,
			                    modalColor : '#fff',
					});
					setTimeout(function(){
	    				jQuery('#mk-already-saved').bPopup().close();
  					},1500);
					
		}
		if(n == 3) {
			jQuery('#mk-success-reset').bPopup({
			                    zIndex: 100,
			                    modalColor : '#fff',
					});
			setTimeout(function(){
	    				location.reload();
  					},2000);					
		}
		if(n == 4) {
			jQuery('#mk-success-import').bPopup({
			                    zIndex: 100,
			                    modalColor : '#fff',
					});
			setTimeout(function(){
	    				location.reload();
  					},2000);					
		}
		if(n == 5) {
			jQuery('#mk-fail-import').bPopup({
			                    zIndex: 100,
			                    modalColor : '#fff',
					});	
			setTimeout(function(){
	    				jQuery('#mk-fail-import').bPopup().close();
  					},1500);					
		}
	}
/*******************/




/* 
**
updates Body section width on window resize
-------------------------------------------------------------*/
var timer;
resize_body_section();
jQuery(window).resize(function(){
clearTimeout(timer);
setTimeout( resize_body_section, 100);
})  

function resize_body_section(){
		body_section_width = jQuery('.mk-general-bg-selector .outer-wrapper').width();
		jQuery('.mk-general-bg-selector.boxed_layout .body-section').css('width', body_section_width);
}














