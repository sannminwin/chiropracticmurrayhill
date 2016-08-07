/* Rounded Any Text */
/* -------------------------------------------------------------------- */
function is_touch_device() {
    return !!('ontouchstart' in window) || !!('onmsgesturechange' in window); 
}


/* Blog, Portfolio Audio */
/* -------------------------------------------------------------------- */

function loop_audio_init() {



    jQuery('.jp-jplayer.mk-blog-audio').each(function() {
        var css_selector_ancestor = "#" + jQuery(this).siblings('.jp-audio').attr('id');
        ogg_file = jQuery(this).attr('data-ogg');
        mp3_file = jQuery(this).attr('data-mp3');
        jQuery(this).jPlayer({
                    ready: function () {
                        jQuery(this).jPlayer("setMedia", {
                            mp3: mp3_file,
                            ogg: ogg_file
                        });
                    },
                    play: function() { // To avoid both jPlayers playing together.
                        jQuery(this).jPlayer("pauseOthers");
                    },
                    swfPath: mk_theme_js_path,
                    supplied: "mp3, ogg",
                    cssSelectorAncestor: css_selector_ancestor,
                    wmode: "window"
                });
    });






    jQuery('.audio-post-type .featured-image, .newspaper-audio .featured-image, .portfolio-newspaper-audio .featured-image, .portfolio-grid-audio .featured-image')
        .each(function () {

        jQuery(this)
            .find('.audio-play-icon')
            .on("click", function () {

            jQuery(this)
                .addClass('visuallyhidden');
            jQuery(this)
                .parents('.featured-image')
                .find('.jp-audio')
                .removeClass('visuallyhidden');
            jQuery(this)
                .parents('.featured-image')
                .find('.newspaper-meta-wrapper')
                .addClass('visuallyhidden');


            return false;
        });


    });

    jQuery('.metro-audio .featured-image')
        .each(function () {

        jQuery(this)
            .find('.audio-play-icon')
            .on("click", function () {

            jQuery(this)
                .parents('.featured-image')
                .find('.jp-audio')
                .removeClass('visuallyhidden');
            jQuery(this)
                .parents('.featured-image')
                .siblings('.the-title')
                .addClass('visuallyhidden');
            jQuery(this)
                .animate({
                'top': 25
            }, 'slow');
            jQuery(this)
                .parent('.featured-image')
                .children('.metro-meta-wrapper')
                .css('opacity', 1);

            return false;
        });


    });




    jQuery('.portfolio-metro-audio .featured-image').each(function () {

        jQuery(this)
            .find('.audio-play-icon')
            .on("click", function () {

            jQuery(this)
                .parent('.featured-image')
                .find('.jp-audio')
                .removeClass('visuallyhidden');
            jQuery(this)
                .parent('.featured-image')
                .find('.the-title')
                .fadeOut();
            jQuery(this)
                .parent('.featured-image')
                .children('.image-hover-overlay')
                .css('opacity', 1);
            jQuery(this)
                .parent('.featured-image')
                .children('.metro-pattern-overlay')
                .css('opacity', 0);

            return false;
        });


    });
}


jQuery(document).ready(function () {
    var timer;






    /* Tabs */
    /* -------------------------------------------------------------------- */


    

        function get_vertical_tabs_height() {

            jQuery(".mk-tabs.vertical").each(function () {
                jQuery(this).find('.inner-box').css('min-height', jQuery(this).find('ul.mk-tabs-tabs').innerHeight() - 60);

            });

        }


        if (jQuery('.mk-tabs').length > 0) {
                jQuery("ul.mk-tabs-tabs", this).tabs("div.mk-tabs-panes > div", {
                tabs: 'li',
                effect: 'default'
             });
            }


    if (jQuery('.tabbed-box-tabs').length > 0) {

        jQuery("ul.tabbed-box-tabs", this)
            .tabs("div.tabbed-box-panes > div", {
            tabs: 'li',
            effect: 'default'
        });
        get_vertical_tabs_height();
        jQuery(window).on("debouncedresize", function (event) {
                get_vertical_tabs_height();
            });

        
           
         jQuery('.tabbed-box-tabs')
            .find('a')
            .click(function () {
            setTimeout(function () {
                $container.isotope('reLayout');
            }, 1000);
        });

    }






    /* Accordions & Toggles */
    /* -------------------------------------------------------------------- */

    /* Accordions */

    if (jQuery('.mk-accordion')
        .length > 0) {
        jQuery.tools.tabs.addEffect("slide", function (i, done) {
            this.getPanes()
                .slideUp();
            this.getPanes()
                .eq(i)
                .slideDown(function () {
                done.call();
            });
        });
        jQuery(".mk-accordion")
            .each(function () {
            var $initialIndex = jQuery(this)
                .attr('data-initialIndex');
            if ($initialIndex === undefined) {
                $initialIndex = 0;
            }
            jQuery(this)
                .tabs("div.mk-accordion-pane", {
                tabs: '.mk-accordion-tab',
                effect: 'slide',
                initialIndex: $initialIndex,
                slideInSpeed: 400,
                slideOutSpeed: 400
            });
        });
    }


    /* Toggles */

    if (jQuery('.mk-toggle-title')
        .length > 0) {
        jQuery(".mk-toggle-title")
            .toggle(

        function () {
            jQuery(this)
                .addClass('active-toggle');
            jQuery(this)
                .siblings('.mk-toggle-pane')
                .slideDown("fast");
        },

        function () {
            jQuery(this)
                .removeClass('active-toggle');
            jQuery(this)
                .siblings('.mk-toggle-pane')
                .slideUp("fast");
        });
    }






    /* Responsive Fixes */
    /* -------------------------------------------------------------------- */


    function mk_responsive_fix() {

        if (jQuery(window).width() > 1100) {
            jQuery('.single-post-social-share').insertBefore('.about-author-name').removeClass('responsive');
            jQuery('body').removeClass('mk-responsive').addClass('mk-desktop');
            jQuery('.mk-header-right').insertAfter('#mk-header .header-logo');
            mk_main_navigation_init();
            mk_main_navigation();
        }

        

        if (jQuery(window)
            .width() < 1100) {
            jQuery('.mk-header-right').insertAfter('#mk-header');
            jQuery('body').removeClass('mk-desktop').addClass('mk-responsive');
        }

        if (jQuery(window).width() < 755) {

            jQuery('.single-post-social-share').insertBefore('.single-post-tags').addClass('responsive');

        }

    }

    jQuery(window)
        .load(function () {
        mk_responsive_fix();
    });

    jQuery(window)
        .on("debouncedresize", function (event) {
        mk_responsive_fix();
    });








    /* Initialize isiotop for newspaper style */
    /* -------------------------------------------------------------------- */
    function loops_iosotop_init() {
        if (jQuery('.mk-theme-loop')
            .hasClass('isotop-enabled')) {
            $container = jQuery('.mk-theme-loop');
            $container_item = '.mk-blog-newspaper-item, .mk-blog-classic-item, .mk-blog-metro-item, .mk-portfolio-isotop';

            $container.isotope({
                itemSelector: $container_item,
                animationEngine: "best-available",
                isFitWidth: true

            });
            setTimeout(function () {
                isotop_load_fix();

            }, 2000);


            jQuery('.filter-portfolio a')
                .click(function () {
                var $this = jQuery(this);
                if ($this.hasClass('.current')) {
                    return false;
                }
                var $optionSet = $this.parents('.filter-portfolio');
                $optionSet.find('.current')
                    .removeClass('current');
                $this.addClass('current');

                var selector = jQuery(this)
                    .attr('data-filter');
                $container.isotope({
                    filter: selector
                });



                return false;
            });

                jQuery('.mk-loadmore-button').css('visibility', 'visible');
            if (jQuery('.mk-theme-loop').hasClass('scroll-load-style') || jQuery('.mk-theme-loop')
                .hasClass('load-button-style')) {
                if (jQuery('.mk-pagination').length <= 0) {
                    jQuery('.mk-loadmore-button').hide();
                }
                jQuery('.mk-pagination').hide();
                $container.infinitescroll({
                    navSelector: '.mk-pagination',
                    nextSelector: '.mk-pagination a:first',
                    itemSelector: $container_item,
                    debug: false,
                    animate: true,
                    bufferPx: 70,
                    loading: {
                        finishedMsg: "No more pages to load.",
                        img: mk_images_dir + "/load-more-loading.gif",
                        msg: null,
                        msgText: "",
                        selector: '.mk-loadmore-button',
                        speed: 'fast',
                        start: undefined
                    },
                    errorCallback: function () {

                        jQuery('.mk-loadmore-button')
                            .html('No More Posts')
                            .delay(2000)
                            .fadeOut();

                    }

                },

                function (newElements) {
                    var $newElems = jQuery(newElements)
                        .hide(); // hide to begin with
                    // ensure that images load before adding to masonry layout
                    $newElems.imagesLoaded(function () {
                        $newElems.fadeIn(); // fade in when ready
                        $container.isotope('appended', $newElems);
                        enable_lightbox(document);
                        isotop_load_fix();
                        loop_audio_init();
                    });
                }

                );



                /* Loading elements based on scroll window */
                if (jQuery('.mk-theme-loop')
                    .hasClass('load-button-style')) {
                    jQuery(window)
                        .unbind('.infscr');
                    jQuery('.mk-loadmore-button')
                        .click(function () {

                        $container.infinitescroll('retrieve');

                        return false;

                    });
                }


            } else {
                jQuery('.mk-loadmore-button')
                    .hide();
            }

        }
    }









    /* reload elements on reload */
    /* -------------------------------------------------------------------- */

    if (jQuery('.mk-blog-loop-container')
        .length > 0 || jQuery('.mk-portfolio-loop-container')
        .length > 0) {
        jQuery(window)
            .load(function () {
            jQuery(window)
                .unbind('keydown');
            loops_iosotop_init();
            isotop_load_fix();
        });


        jQuery(window)
            .on("debouncedresize", function (event) {
            $container.isotope('reLayout');
        });

    }






    /* Fix isotop layout */
    /* -------------------------------------------------------------------- */
    function isotop_load_fix() {
        if (jQuery('.mk-blog-loop-container')
            .length > 0 || jQuery('.mk-portfolio-loop-container')
            .length > 0) {
            jQuery('.mk-blog-loop-container>article, .mk-portfolio-loop-container>article')
                .each(function (i) {
                jQuery(this)
                    .delay(i * 100)
                    .animate({
                    'opacity': 1
                }, 'fast');

            })
                .promise()
                .done(function () {
                setTimeout(function () {
                    //roundTitleLines(); 
                    $container.isotope('reLayout');
                }, 1000);
            });
            setTimeout(function () {
                //roundTitleLines(); 
                $container.isotope('reLayout');
            }, 2000);
        }

    }





    /* Sitemap Posts Isotop */
    /* -------------------------------------------------------------------- */

        function mk_sitemap_posts() {
            $container = jQuery('.mk-sitemap-posts');
            $container_item = '.mk-sitemap-posts-item';
            $container.isotope({
                itemSelector: $container_item
            });
        }

    if (jQuery('.mk-sitemap-posts').length > 0) {
        mk_sitemap_posts();

        jQuery(window)
            .load(function () {
            jQuery(window)
                .unbind('keydown');
            mk_sitemap_posts();
            setTimeout(function () {
             $container.isotope('reLayout');
             }, 2000);
        });


        jQuery(window)
            .on("debouncedresize", function (event) {
            $container.isotope('reLayout');
        });

    }




    if (jQuery('.not-found-page')
        .length > 0) {
        jQuery('.tabbed-box-tabs')
            .find('a')
            .click(function () {
            setTimeout(function () {
                $container.isotope('reLayout');

            }, 500);

        });
    }






    /* Divider Shortcode Fancy Style */
    /* -------------------------------------------------------------------- */

    function fancy_divider() {

        jQuery('.mk-fancy-divider')
            .each(function () {
            $text_width = jQuery(this)
                .find('.text')
                .outerWidth();
            jQuery(this)
                .find('.text')
                .css({
                'width': $text_width,
                'display': 'block'
            });

            $space_width = jQuery(this)
                .find('.extra-space')
                .outerWidth() + 20;
            jQuery(this)
                .find('.extra-space')
                .css({
                'width': $space_width,
                'display': 'block'
            });

        });
    }
    fancy_divider();





    /* Jplayer */
    /* -------------------------------------------------------------------- */

    loop_audio_init();





    /* jQuery Colorbox lightbox */
    /* -------------------------------------------------------------------- */
    var enable_lightbox = function (parent) {

        jQuery(".mk-lightbox")
            .each(function () {
            jQuery(this)
                .colorbox({
                opacity: 0.7,
                maxWidth: "95%",
                maxHeight: "90%",
                current: "",
                onComplete: function () {
                     if(!jQuery('#cboxTitle').html()) {
                        jQuery('#cboxTitle').css('display', 'none');
                    }
                },
                onCleanup: function () {
                    jQuery("#cboxLoadedContent")
                        .html('');
                }
            });
        });

        jQuery(".mk-lightbox-video")
            .each(function () {
            jQuery(this)
                .colorbox({
                opacity: 0.7,
                innerWidth: 640,
                innerHeight: 480,
                iframe: true,
                current: "",
                onComplete: function () {
                  if(!jQuery('#cboxTitle').html()) {
                        jQuery('#cboxTitle').css('display', 'none');
                    }
                },
                onCleanup: function () {
                    jQuery("#cboxLoadedContent")
                        .html('');
                }

            });

        });

    };
    enable_lightbox(document);









    /* Contact Form */
    /* -------------------------------------------------------------------- */


    if(jQuery.tools.validator != undefined){
        
       jQuery.tools.validator.addEffect("contact_form", function(errors, event) {
            jQuery.each(errors, function(index, error) {
                var input = error.input;
                
                input.addClass('mk-invalid');
            });
        }, function(inputs)  {
            inputs.removeClass('mk-invalid');
        });

       jQuery('.mk-contact-form .contact-form-button, .mk-contact-form .contact-widget-button').click(function() {
        $this = jQuery(this).parents('.mk-contact-form');
         if ($this.find('#contact_email').val() === $this.find('#contact_email').attr('data-watermark') 
            || $this.find('#contact_name').val() === $this.find('#contact_name').attr('data-watermark') 
            || $this.find('#contact_content').val() === $this.find('#contact_content').attr('data-watermark') ) {

           $this.find('#contact_content').val('').focus();
           $this.find('#contact_name').val('');
           $this.find('#contact_email').val('');

         }

       })
        
    
        jQuery('.mk-contact-form').validator({effect:'contact_form'}).submit(function(e) {
            var form = jQuery(this);
            if (!e.isDefaultPrevented()) {
                jQuery(this).find('.mk-contact-loading').fadeIn('slow');
                jQuery.post(this.action,{
                    'to':jQuery('input[name="contact_to"]').val().replace("*", "@"),
                    'name':jQuery('input[name="contact_name"]').val(),
                    'email':jQuery('input[name="contact_email"]').val(),
                    'content':jQuery('textarea[name="contact_content"]').val()
                },function(data){
                    form.fadeIn('fast', function() {
                      jQuery(this)
                        .find('.mk-contact-loading')
                        .fadeOut('slow');
                    jQuery(this)
                        .find('.mk-contact-success-icon')
                        .delay(2000)
                        .fadeIn('slow')
                        .delay(8000)
                        .fadeOut();
                    jQuery(this)
                        .find('input, textarea')
                        .val("");
                    });
                });
                e.preventDefault();
            }
        });

        
        
        
 
    }



    /* Employee Shortcode */
    /* -------------------------------------------------------------------- */

   

        function mk_employees_shortcode() {



            jQuery('.mk-employees-shortcode-modern')
                .find('.mk-employee-slides')
                .each(function () {

                jQuery(this)
                    .hover(function () {
                    jQuery(this)
                        .stop()
                        .animate({
                        'padding-right': 480,
                        'margin-right': 5
                    }, 'fast')
                        .find('.team-info-wrapper')
                        .animate({
                        'opacity': 1,
                        'left': 165
                    }, 'fast');
                }, function () {

                    jQuery(this)
                        .stop()
                        .animate({
                        'padding-right': 5,
                        'margin-right': 0
                    }, 'fast')
                        .find('.team-info-wrapper')
                        .animate({
                        'opacity': 0,
                        'left': 0
                    }, 'fast');

                });


            });

        }

   if (jQuery('.mk-employees-shortcode-modern').length > 0) {
        mk_employees_shortcode();

    }






    /* Dribbble Widget Widths */
    /* -------------------------------------------------------------------- */

    if (jQuery('.widget_dribbble').length > 0) {
        jQuery(window)
            .load(function () {
            function mk_dribbble_widget() {
                jQuery('#mk-sidebar .widget_dribbble')
                    .each(function () {
                    container_width = jQuery(this).width();
                    jQuery(this)
                        .find('li')
                        .css('width', (container_width - 20) / 2);


                });

            }
            mk_dribbble_widget();
        });


    }








    /* Clients Logo Hover Info */
    /* -------------------------------------------------------------------- */

    

        function mk_clients_shortcode() {

            jQuery('.mk-clients-shortcode')
                .find('li')
                .each(function () {

                jQuery(this)
                    .find('.client-info-icon')
                    .click(function () {
                    jQuery(this)
                        .siblings('.client-info-wrapper')
                        .animate({
                        'left': 0
                    }, 'fast');
                    jQuery(this)
                        .hide();
                    return false;
                });

                jQuery(this)
                    .find('.client-return-icon')
                    .click(function () {
                    jQuery(this)
                        .parent('.client-info-wrapper')
                        .animate({
                        'left': '-200px'
                    }, 'fast');
                    jQuery(this)
                        .parent()
                        .siblings('.client-info-icon')
                        .show();
                    return false;
                });

            });

        }

   if (jQuery('.mk-clients-shortcode').length > 0) {     
        mk_clients_shortcode();
    }



    /* Main Navigation */
    /* -------------------------------------------------------------------- */

    function mk_main_navigation_init() {
        jQuery("#mk-main-navigation ul")
            .supersubs({
            minWidth: 16,
            maxWidth: 30,
            extraWidth: 1
        })
            .superfish({
            delay: 100,
            speed: 100,
            animation: {
                opacity: 'show',
                height: 'show'
            }

        });
    }

    function mk_main_navigation() {
        var nav_height = jQuery('#mk-main-navigation')
            .height();
        jQuery('#mk-main-navigation ul li ul')
            .css('top', nav_height);
        jQuery('#mk-main-navigation ul li ul li ul')
            .css('top', 0);

    }





    function mk_responsive_nav() {

        jQuery('.mk-responsive-close').click(function () {
            jQuery('body').removeClass('mk-opened-nav').addClass('mk-closed-nav');
        });

        jQuery('.mk-nav-responsive-link').click(function () {
            if(jQuery('body').hasClass('mk-opened-nav')) {
                jQuery('body').removeClass('mk-opened-nav').addClass('mk-closed-nav');
            } else {
                 jQuery('body').removeClass('mk-closed-nav').addClass('mk-opened-nav');
            }
        });
    }
    mk_responsive_nav();



    /* Header Fixed */
    /* -------------------------------------------------------------------- */


    function fix_header_logo_vertical() {
        header_height = jQuery('#mk-header .header-wrapper')
            .height();
        logo_height = jQuery('#mk-header .header-logo')
            .find('img')
            .height();
        logo_width = jQuery('#mk-header .header-logo')
            .find('img')
            .width();

        if (header_height < logo_height) {
            jQuery('#mk-header .header-wrapper')
                .css('height', logo_height + 20);
            jQuery('#mk-header .mk-header-right')
                .css({
                'position': 'absolute',
                'right': '0',
                'bottom': 0
            });
        }


        jQuery('#mk-header .header-logo')
            .css('width', logo_width + 30).addClass('mk-add-pattern');
        jQuery('#mk-header .header-logo a')
            .css('margin-top', -logo_height / 2);
    }
    jQuery(window)
        .load(function () {
        fix_header_logo_vertical();
        fix_header_search_dimension();
    });



    var mk_header_height = jQuery('#mk-header')
        .height();

    var wp_admin_height = 0;
    if (jQuery("#wpadminbar")
        .length > 0) {
        wp_admin_height = jQuery("#wpadminbar")
            .height();
    }
    var mk_window_y = 0;
    mk_window_y = jQuery(window)
        .scrollTop();

    mk_limit_height = wp_admin_height + (mk_header_height) + 200;

    if (mk_window_y > mk_limit_height && !(is_touch_device()) && mk_fixed_header == 'true') {
        mk_fix_header();
    }

    function mk_fix_header() {
        mk_window_y = jQuery(window)
            .scrollTop();
        fix_header_search_dimension();
        if (mk_window_y > mk_limit_height) {
            if (!(jQuery("#mk-header").hasClass("mk-fixed"))) {
                jQuery("#mk-header-social").hide();
                jQuery("#theme-page").css("margin-top", mk_header_height);
                jQuery("#mk-header").addClass("mk-fixed").css("top", -wp_admin_height);
                jQuery("#mk-header").animate({"top": wp_admin_height});
            }

        } else {

            if ((jQuery("#mk-header").hasClass("mk-fixed"))) {
                jQuery("#mk-header-social").show();
                jQuery("#mk-header").removeClass("mk-fixed").css("top", 0);
                jQuery("#theme-page").css("margin-top", "");
            
            }
        }


    }



    jQuery(window)
        .scroll(function () {
        if (!(is_touch_device())  && mk_fixed_header == 'true') { mk_fix_header()
        mk_main_navigation();
        setTimeout(function () {
            mk_main_navigation();
        }, 1000);
    }
    });



    setTimeout(function () {
        fix_header_search_dimension();
    }, 3000);




    /* Parallax Backgrounds */
    /* -------------------------------------------------------------------- */

    if (mk_body_parallax === 'true') {
        jQuery('body')
            .parallax("50%", mk_body_parallax_speed);
    }

    if (mk_page_parallax === 'true') {
        jQuery('#theme-page')
            .parallax("50%", mk_page_parallax_speed);
    }
    if (mk_homepage_slideshow_parallax === 'true') {
        jQuery('.mk-homepage-slideshow')
            .parallax("50%", mk_homepage_slideshow_speed);
    }

    if (mk_smooth_scroll === 'true') {


    
      if(!is_touch_device()) {
        jQuery('html')
            .niceScroll({
            "cursorwidth": 8,
            //"mousescrollstep" : 30,
            "cursorcolor": "#999999",
            "bouncescroll": true,
            "cursorborder": 'none',
            "scrollspeed": mk_page_scroll_speed,
            "railpadding": {
                right: 10
            }
        });
        }
    }


    jQuery('.mk-scroll-top')
        .on('click', function () {
        jQuery('body')
            .ScrollTo({
            duration: 3000,
            easing: 'easeOutQuart',
            durationMode: 'all'
        });
    });





    /* Header Search Form */
    /* -------------------------------------------------------------------- */

    function fix_header_search_dimension() {
        main_nav_height = jQuery('#mk-main-navigation ul li a')
            .height();
        main_nav_width = jQuery('#mk-main-navigation')
            .outerWidth();

        //jQuery('#mk-main-navigation').css('margin-right', main_nav_height);
        jQuery('#mk-header .mk-header-searchform .text-input')
            .css({'width' :  main_nav_width - 3, 'visibility' : 'visible'});



        jQuery('#mk-header .mk-header-searchform .search-button')
            .on('click', function () {

            if (jQuery('#mk-header .mk-header-searchform .text-input')
                .hasClass('visuallyhidden')) {
                jQuery(this)
                    .addClass('search-button-hover');
                jQuery('#mk-header .mk-header-searchform .text-input')
                    .removeClass('visuallyhidden');
                return false;
            }


        });
    }

    jQuery("#mk-header .mk-header-searchform")
        .click(function (event) {
        if (event.stopPropagation) {
            event.stopPropagation();
        } else if (window.event) {
            window.event.cancelBubble = true;
        }
    });

    jQuery("html")
        .click(function () {
        jQuery(this)
            .find(".mk-header-searchform .text-input")
            .addClass('visuallyhidden');
        jQuery('#mk-header .search-button')
            .removeClass('search-button-hover');
    });




    /* Input Watermarks */
    /* --------------------------------------------------------------------*/

    jQuery(":input[data-watermark]")
        .each(function () {
        jQuery(this)
            .val(jQuery(this)
            .attr("data-watermark"));
        jQuery(this)
            .bind('focus', function () {
            if (jQuery(this).val() === jQuery(this).attr("data-watermark"))  {
                jQuery(this).val('').removeClass('mk-watermarked');
            }
        });
        jQuery(this)
            .bind('blur', function () {
            if (jQuery(this).val() === '') {
                    jQuery(this).val(jQuery(this).attr("data-watermark")).addClass('mk-watermarked');
               }     
        });
    });


    jQuery("textarea[data-watermark]")
        .each(function () {
        jQuery(this)
            .val(jQuery(this)
            .attr("data-watermark"));
        jQuery(this)
            .bind('focus', function () {
            if (jQuery(this).text() === jQuery(this).attr("data-watermark")) {
                jQuery(this).text('').removeClass('mk-watermarked');
            }
        });
        jQuery(this)
            .bind('blur', function () {
            if (jQuery(this).text() === '') { 
                    jQuery(this).text(jQuery(this).attr("data-watermark")).addClass('mk-watermarked');
                }    
        });
    });





    /* Comment Form Submit */
    /* -------------------------------------------------------------------- */

    jQuery('#commentform.mk-not-logged .comment-form-button').on('click', function () {

        if (jQuery('#commentform #author').val() === jQuery('#commentform #author').attr('data-watermark') || jQuery('#commentform #email').val() === jQuery('#commentform #email').attr('data-watermark')) {

            if (jQuery('#commentform #author').val() === jQuery('#commentform #author').attr('data-watermark')) {
                jQuery('#commentform #author').val('');
            }
            if (jQuery('#commentform #email').val() === jQuery('#commentform #email').attr('data-watermark')) {
                jQuery('#commentform #email').val('');
            }

            return false;

        } else {
            if (jQuery('#commentform #url')
                .val() === jQuery('#commentform #url')
                .attr('data-watermark')) {
                jQuery('#commentform #url')
                    .val('');
            }
            jQuery('#commentform')
                .submit();
            return false;
        }
    });
});

jQuery('#commentform.mk-logged .comment-form-button')
    .on('click', function () {
    jQuery('#commentform')
        .submit();
    return false;
});





/* Skill Meter initial start */
/* -------------------------------------------------------------------- */

function mk_skill_meter() {
    if (jQuery('.mk-skill-meter')
        .length > 0) {
        jQuery(".mk-skill-meter .mk-progress-bar > span")
            .each(function () {
            jQuery(this).data("origWidth", jQuery(this).width()).width(0).animate({
                width: jQuery(this)
                    .data("origWidth")
            }, 2000);
        });
    }
}
mk_skill_meter();





/*
 * debouncedresize: special jQuery event that happens once after a window resize
 *
 * latest version and complete README available on Github:
 * https://github.com/louisremi/jquery-smartresize
 *
 * Copyright 2012 @louis_remi
 * Licensed under the MIT license.
 *
 * This saved you an hour of work? 
 * Send me music http://www.amazon.co.uk/wishlist/HNTU0468LQON
 */
(function ($) {

    var $event = $.event,
        $special,
        resizeTimeout;

    $special = $event.special.debouncedresize = {
        setup: function () {
            $(this)
                .on("resize", $special.handler);
        },
        teardown: function () {
            $(this)
                .off("resize", $special.handler);
        },
        handler: function (event, execAsap) {
            // Save the context
            var context = this,
                args = arguments,
                dispatch = function () {
                    // set correct event type
                    event.type = "debouncedresize";
                    $event.dispatch.apply(context, args);
                };

            if (resizeTimeout) {
                clearTimeout(resizeTimeout);
            }

            execAsap ? dispatch() : resizeTimeout = setTimeout(dispatch, $special.threshold);
        },
        threshold: 150
    };

})(jQuery);






/*
 * Superfish v1.4.8 - jQuery menu widget
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 *  http://www.opensource.org/licenses/mit-license.php
 *  http://www.gnu.org/licenses/gpl.html
 *
 * CHANGELOG: http://users.tpg.com.au/j_birch/plugins/superfish/changelog.txt
 */


(function ($) {
    $.fn.superfish = function (op) {

        var sf = $.fn.superfish,
            c = sf.c,
            $arrow = $(['<span class="', c.arrowClass, '"></span>'].join('')),
            over = function () {
                var $$ = $(this),
                    menu = getMenu($$);
                clearTimeout(menu.sfTimer);
                $$.showSuperfishUl()
                    .siblings()
                    .hideSuperfishUl();
            },
            out = function () {
                var $$ = $(this),
                    menu = getMenu($$),
                    o = sf.op;
                clearTimeout(menu.sfTimer);
                menu.sfTimer = setTimeout(function () {
                    o.retainPath = ($.inArray($$[0], o.$path) > -1);
                    $$.hideSuperfishUl();
                    if (o.$path.length && $$.parents(['li.', o.hoverClass].join(''))
                        .length < 1) {
                        over.call(o.$path);
                    }
                }, o.delay);
            },
            getMenu = function ($menu) {
                var menu = $menu.parents(['ul.', c.menuClass, ':first'].join(''))[0];
                sf.op = sf.o[menu.serial];
                return menu;
            },
            addArrow = function ($a) {
                $a.addClass(c.anchorClass)
                    .append($arrow.clone());
            };

        return this.each(function () {
            var s = this.serial = sf.o.length;
            var o = $.extend({}, sf.defaults, op);
            o.$path = $('li.' + o.pathClass, this)
                .slice(0, o.pathLevels)
                .each(function () {
                $(this)
                    .addClass([o.hoverClass, c.bcClass].join(' '))
                    .filter('li:has(ul)')
                    .removeClass(o.pathClass);
            });
            sf.o[s] = sf.op = o;

            $('li:has(ul)', this)[($.fn.hoverIntent && !o.disableHI) ? 'hoverIntent' : 'hover'](over, out)
                .each(function () {
                if (o.autoArrows) {
                    addArrow($('>a:first-child', this));
            }
            })
                .not('.' + c.bcClass)
                .hideSuperfishUl();

            var $a = $('a', this);
            $a.each(function (i) {
                var $li = $a.eq(i)
                    .parents('li');
                $a.eq(i)
                    .focus(function () {
                    over.call($li);
                })
                    .blur(function () {
                    out.call($li);
                });
            });
            o.onInit.call(this);

        })
            .each(function () {
            var menuClasses = [c.menuClass];
            if (sf.op.dropShadows && !($.browser.msie && $.browser.version < 7)) {
                menuClasses.push(c.shadowClass);
                $(this).addClass(menuClasses.join(' '));
            }
        });
    };

    var sf = $.fn.superfish;
    sf.o = [];
    sf.op = {};
    sf.IE7fix = function () {
        var o = sf.op;
        if ($.browser.msie && $.browser.version > 6 && o.dropShadows && o.animation.opacity !== undefined) {
            this.toggleClass(sf.c.shadowClass + '-off');
        }
    };
    sf.c = {
        bcClass: 'sf-breadcrumb',
        menuClass: 'sf-js-enabled',
        anchorClass: 'sf-with-ul',
        arrowClass: 'sf-sub-indicator',
        shadowClass: 'sf-shadow'
    };
    sf.defaults = {
        hoverClass: 'sfHover',
        pathClass: 'overideThisToUse',
        pathLevels: 1,
        delay: 800,
        animation: {
            opacity: 'show'
        },
        speed: 'normal',
        autoArrows: true,
        dropShadows: true,
        disableHI: false, // true disables hoverIntent detection
        onInit: function () {}, // callback functions
        onBeforeShow: function () {},
        onShow: function () {},
        onHide: function () {}
    };
    $.fn.extend({
        hideSuperfishUl: function () {
            var o = sf.op,
                not = (o.retainPath === true) ? o.$path : '';
            o.retainPath = false;
            var $ul = $(['li.', o.hoverClass].join(''), this)
                .add(this)
                .not(not)
                .removeClass(o.hoverClass)
                .find('>ul')
                .hide()
                .css('visibility', 'hidden');
            o.onHide.call($ul);
            return this;
        },
        showSuperfishUl: function () {
            var o = sf.op,
                sh = sf.c.shadowClass + '-off',
                $ul = this.addClass(o.hoverClass)
                    .find('>ul:hidden')
                    .css('visibility', 'visible');
            sf.IE7fix.call($ul);
            o.onBeforeShow.call($ul);
            $ul.animate(o.animation, o.speed, function () {
                sf.IE7fix.call($ul);
                o.onShow.call($ul);
            });
            return this;
        }
    });

})(jQuery);




/*
 * hoverIntent - jQuery plugin
 * Copyright (c) by Brian Cherne
 *
 * Dual licensed under the MIT and GPL licenses:
 *  http://www.opensource.org/licenses/mit-license.php
 *  http://www.gnu.org/licenses/gpl.html
 *
 */

(function ($) {
    $.fn.hoverIntent = function (f, g) {
        // default configuration options
        var cfg = {
            sensitivity: 7,
            interval: 100,
            timeout: 0
        };
        // override configuration options with user supplied object
        cfg = $.extend(cfg, g ? {
            over: f,
            out: g
        } : f);

        // instantiate variables
        // cX, cY = current X and Y position of mouse, updated by mousemove event
        // pX, pY = previous X and Y position of mouse, set by mouseover and polling interval
        var cX, cY, pX, pY;

        // A private function for getting mouse position
        var track = function (ev) {
            cX = ev.pageX;
            cY = ev.pageY;
        };

        // A private function for comparing current and previous mouse position
        var compare = function (ev, ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            // compare mouse positions to see if they've crossed the threshold
            if ((Math.abs(pX - cX) + Math.abs(pY - cY)) < cfg.sensitivity) {
                $(ob)
                    .unbind("mousemove", track);
                // set hoverIntent state to true (so mouseOut can be called)
                ob.hoverIntent_s = 1;
                return cfg.over.apply(ob, [ev]);
            } else {
                // set previous coordinates for next time
                pX = cX;
                pY = cY;
                // use self-calling timeout, guarantees intervals are spaced out properly (avoids JavaScript timer bugs)
                ob.hoverIntent_t = setTimeout(function () {
                    compare(ev, ob);
                }, cfg.interval);
            }
        };

        // A private function for delaying the mouseOut function
        var delay = function (ev, ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            ob.hoverIntent_s = 0;
            return cfg.out.apply(ob, [ev]);
        };

        // A private function for handling mouse 'hovering'
        var handleHover = function (e) {
            // next three lines copied from jQuery.hover, ignore children onMouseOver/onMouseOut
            var p = (e.type === "mouseover" ? e.fromElement : e.toElement) || e.relatedTarget;
            while (p && p !== this) {
                try {
                    p = p.parentNode;
                } catch (e) {
                    p = this;
                }
            }
            if (p === this) {
                return false;
            }

            // copy objects to be passed into t (required for event object to be passed in IE)
            var ev = jQuery.extend({}, e);
            var ob = this;

            // cancel hoverIntent timer if it exists
            if (ob.hoverIntent_t) {
                ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            }

            // else e.type == "onmouseover"
            if (e.type === "mouseover") {
                // set "previous" X and Y position based on initial entry point
                pX = ev.pageX;
                pY = ev.pageY;
                // update "current" X and Y position based on mousemove
                $(ob)
                    .bind("mousemove", track);
                // start polling interval (self-calling timeout) to compare mouse coordinates over time
                if (ob.hoverIntent_s !== 1) {
                    ob.hoverIntent_t = setTimeout(function () {
                        compare(ev, ob);
                    }, cfg.interval);
                }

                // else e.type == "onmouseout"
            } else {
                // unbind expensive mousemove event
                $(ob)
                    .unbind("mousemove", track);
                // if hoverIntent state is true, then call the mouseOut function after the specified delay
                if (ob.hoverIntent_s === 1) {
                    ob.hoverIntent_t = setTimeout(function () {
                        delay(ev, ob);
                    }, cfg.timeout);
                }
            }
        };

        // bind the function to the two event listeners
        return this.mouseover(handleHover)
            .mouseout(handleHover);
    };

})(jQuery);









/*
 * Supersubs v0.2b - jQuery plugin
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 *  http://www.opensource.org/licenses/mit-license.php
 *  http://www.gnu.org/licenses/gpl.html
 *
 *
 * This plugin automatically adjusts submenu widths of suckerfish-style menus to that of
 * their longest list item children. If you use this, please expect bugs and report them
 * to the jQuery Google Group with the word 'Superfish' in the subject line.
 *
 */

(function ($) { // $ will refer to jQuery within this closure

    $.fn.supersubs = function (options) {
        var opts = $.extend({}, $.fn.supersubs.defaults, options);
        // return original object to support chaining
        return this.each(function () {
            // cache selections
            var $$ = $(this);
            // support metadata
            var o = $.meta ? $.extend({}, opts, $$.data()) : opts;
            // get the font size of menu.
            // .css('fontSize') returns various results cross-browser, so measure an em dash instead
            var fontsize = $('<li id="menu-fontsize">&#8212;</li>')
                .css({
                'padding': 0,
                'position': 'absolute',
                'top': '-999em',
                'width': 'auto'
            })
                .appendTo($$)
                .width(); //clientWidth is faster, but was incorrect here
            // remove em dash
            $('#menu-fontsize')
                .remove();
            // cache all ul elements
            $ULs = $$.find('ul');
            // loop through each ul in menu
            $ULs.each(function (i) {
                // cache this ul
                var $ul = $ULs.eq(i);
                // get all (li) children of this ul
                var $LIs = $ul.children();
                // get all anchor grand-children
                var $As = $LIs.children('a');
                // force content to one line and save current float property
                var liFloat = $LIs.css('white-space', 'nowrap')
                    .css('float');
                // remove width restrictions and floats so elements remain vertically stacked
                var emWidth = $ul.add($LIs)
                    .add($As)
                    .css({
                    'float': 'none',
                    'width': 'auto'
                })
                // this ul will now be shrink-wrapped to longest li due to position:absolute
                // so save its width as ems. Clientwidth is 2 times faster than .width() - thanks Dan Switzer
                .end()
                    .end()[0].clientWidth / fontsize;
                // add more width to ensure lines don't turn over at certain sizes in various browsers
                emWidth += o.extraWidth;
                // restrict to at least minWidth and at most maxWidth
                if (emWidth > o.maxWidth) {
                    emWidth = o.maxWidth;
                } else if (emWidth < o.minWidth) {
                    emWidth = o.minWidth;
                }
                emWidth += 'em';
                // set ul to width in ems
                $ul.css('width', emWidth);
                // restore li floats to avoid IE bugs
                // set li width to full width of this ul
                // revert white-space to normal
                $LIs.css({
                    'float': liFloat,
                    'width': '100%',
                    'white-space': 'normal'
                })
                // update offset position of descendant ul to reflect new width of parent
                .each(function () {
                    var $childUl = $('>ul', this);
                    var offsetDirection = $childUl.css('left') !== undefined ? 'left' : 'right';
                    $childUl.css(offsetDirection, emWidth);
                });
            });

        });
    };
    // expose defaults
    $.fn.supersubs.defaults = {
        minWidth: 9, // requires em unit.
        maxWidth: 25, // requires em unit.
        extraWidth: 0 // extra width can ensure lines don't sometimes turn over due to slight browser differences in how they round-off values
    };

})(jQuery); // plugin code ends









/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright Â© 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 */

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend(jQuery.easing, {
    def: 'easeOutQuad',
    swing: function (x, t, b, c, d) {
        //alert(jQuery.easing.default);
        return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
    },
    easeInQuad: function (x, t, b, c, d) {
        return c * (t /= d) * t + b;
    },
    easeOutQuad: function (x, t, b, c, d) {
        return -c * (t /= d) * (t - 2) + b;
    },
    easeInOutQuad: function (x, t, b, c, d) {
        if ((t /= d / 2) < 1) { return c / 2 * t * t + b; }
        return -c / 2 * ((--t) * (t - 2) - 1) + b;
    },
    easeInCubic: function (x, t, b, c, d) {
        return c * (t /= d) * t * t + b;
    },
    easeOutCubic: function (x, t, b, c, d) {
        return c * ((t = t / d - 1) * t * t + 1) + b;
    },
    easeInOutCubic: function (x, t, b, c, d) {
        if ((t /= d / 2) < 1) { return c / 2 * t * t * t + b; }
        return c / 2 * ((t -= 2) * t * t + 2) + b;
    },
    easeInQuart: function (x, t, b, c, d) {
        return c * (t /= d) * t * t * t + b;
    },
    easeOutQuart: function (x, t, b, c, d) {
        return -c * ((t = t / d - 1) * t * t * t - 1) + b;
    },
    easeInOutQuart: function (x, t, b, c, d) {
        if ((t /= d / 2) < 1) { return c / 2 * t * t * t * t + b; }
        return -c / 2 * ((t -= 2) * t * t * t - 2) + b;
    },
    easeInQuint: function (x, t, b, c, d) {
        return c * (t /= d) * t * t * t * t + b;
    },
    easeOutQuint: function (x, t, b, c, d) {
        return c * ((t = t / d - 1) * t * t * t * t + 1) + b;
    },
    easeInOutQuint: function (x, t, b, c, d) {
        if ((t /= d / 2) < 1) { return c / 2 * t * t * t * t * t + b; }
        return c / 2 * ((t -= 2) * t * t * t * t + 2) + b;
    },
    easeInSine: function (x, t, b, c, d) {
        return -c * Math.cos(t / d * (Math.PI / 2)) + c + b;
    },
    easeOutSine: function (x, t, b, c, d) {
        return c * Math.sin(t / d * (Math.PI / 2)) + b;
    },
    easeInOutSine: function (x, t, b, c, d) {
        return -c / 2 * (Math.cos(Math.PI * t / d) - 1) + b;
    },
    easeInExpo: function (x, t, b, c, d) {
        return (t === 0) ? b : c * Math.pow(2, 10 * (t / d - 1)) + b;
    },
    easeOutExpo: function (x, t, b, c, d) {
        return (t === d) ? b + c : c * (-Math.pow(2, -10 * t / d) + 1) + b;
    },
    easeInOutExpo: function (x, t, b, c, d) {
        if (t === 0) { return b; }
        if (t === d) return b + c;
        if ((t /= d / 2) < 1) { return c / 2 * Math.pow(2, 10 * (t - 1)) + b; }
        return c / 2 * (-Math.pow(2, -10 * --t) + 2) + b;
    },
    easeInCirc: function (x, t, b, c, d) {
        return -c * (Math.sqrt(1 - (t /= d) * t) - 1) + b;
    },
    easeOutCirc: function (x, t, b, c, d) {
        return c * Math.sqrt(1 - (t = t / d - 1) * t) + b;
    },
    easeInOutCirc: function (x, t, b, c, d) {
        if ((t /= d / 2) < 1) { return -c / 2 * (Math.sqrt(1 - t * t) - 1) + b; }
        return c / 2 * (Math.sqrt(1 - (t -= 2) * t) + 1) + b;
    },
    easeInElastic: function (x, t, b, c, d) {
        var s = 1.70158;
        var p = 0;
        var a = c;
        if (t === 0) {return b; }
        if ((t /= d) === 1) { return b + c; }
        if (!p) p = d * .3;
        if (a < Math.abs(c)) {
            a = c;
            var s = p / 4;
        } else { var s = p / (2 * Math.PI) * Math.asin(c / a);
        return -(a * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p)) + b;
    }
    },
    easeOutElastic: function (x, t, b, c, d) {
        var s = 1.70158;
        var p = 0;
        var a = c;
        if (t === 0) { return b; }
        if ((t /= d) === 1) return b + c;
        if (!p) p = d * .3;
        if (a < Math.abs(c)) {
            a = c;
            var s = p / 4;
        } else { var s = p / (2 * Math.PI) * Math.asin(c / a);
        return a * Math.pow(2, -10 * t) * Math.sin((t * d - s) * (2 * Math.PI) / p) + c + b;
    }
    },
    easeInOutElastic: function (x, t, b, c, d) {
        var s = 1.70158;
        var p = 0;
        var a = c;
        if (t == 0) return b;
        if ((t /= d / 2) == 2) return b + c;
        if (!p) p = d * (.3 * 1.5);
        if (a < Math.abs(c)) {
            a = c;
            var s = p / 4;
        } else { var s = p / (2 * Math.PI) * Math.asin(c / a); }
        if (t < 1) return -.5 * (a * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p)) + b;
        return a * Math.pow(2, -10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p) * .5 + c + b;
    },
    easeInBack: function (x, t, b, c, d, s) {
        if (s == undefined) s = 1.70158;
        return c * (t /= d) * t * ((s + 1) * t - s) + b;
    },
    easeOutBack: function (x, t, b, c, d, s) {
        if (s == undefined) s = 1.70158;
        return c * ((t = t / d - 1) * t * ((s + 1) * t + s) + 1) + b;
    },
    easeInOutBack: function (x, t, b, c, d, s) {
        if (s == undefined) s = 1.70158;
        if ((t /= d / 2) < 1) { return c / 2 * (t * t * (((s *= (1.525)) + 1) * t - s)) + b; }
        return c / 2 * ((t -= 2) * t * (((s *= (1.525)) + 1) * t + s) + 2) + b;
    },
    easeInBounce: function (x, t, b, c, d) {
        return c - jQuery.easing.easeOutBounce(x, d - t, 0, c, d) + b;
    },
    easeOutBounce: function (x, t, b, c, d) {
        if ((t /= d) < (1 / 2.75)) {
            return c * (7.5625 * t * t) + b;
        } else if (t < (2 / 2.75)) {
            return c * (7.5625 * (t -= (1.5 / 2.75)) * t + .75) + b;
        } else if (t < (2.5 / 2.75)) {
            return c * (7.5625 * (t -= (2.25 / 2.75)) * t + .9375) + b;
        } else {
            return c * (7.5625 * (t -= (2.625 / 2.75)) * t + .984375) + b;
        }
    },
    easeInOutBounce: function (x, t, b, c, d) {
        if (t < d / 2) return jQuery.easing.easeInBounce(x, t * 2, 0, c, d) * .5 + b;
        return jQuery.easing.easeOutBounce(x, t * 2 - d, 0, c, d) * .5 + c * .5 + b;
    }
});




/*
 
 jQuery Tools Validator 1.2.5 - HTML5 is here. Now use it.

 NO COPYRIGHTS OR LICENSES. DO WHAT YOU LIKE.

 http://flowplayer.org/tools/form/validator/

 Since: Mar 2010
 Date:    Wed Sep 22 06:02:10 2010 +0000 
*/
(function(e){function t(a,b,c){var k=a.offset().top,f=a.offset().left,l=c.position.split(/,?\s+/),p=l[0];l=l[1];k-=b.outerHeight()-c.offset[0];f+=a.outerWidth()+c.offset[1];if(/iPad/i.test(navigator.userAgent))k-=e(window).scrollTop();c=b.outerHeight()+a.outerHeight();if(p=="center")k+=c/2;if(p=="bottom")k+=c;a=a.outerWidth();if(l=="center")f-=(a+b.outerWidth())/2;if(l=="left")f-=a;return{top:k,left:f}}function y(a){function b(){return this.getAttribute("type")==a}b.key="[type="+a+"]";return b}function u(a,
b,c){function k(g,d,i){if(!(!c.grouped&&g.length)){var j;if(i===false||e.isArray(i)){j=h.messages[d.key||d]||h.messages["*"];j=j[c.lang]||h.messages["*"].en;(d=j.match(/\$\d/g))&&e.isArray(i)&&e.each(d,function(m){j=j.replace(this,i[m])})}else j=i[c.lang]||i;g.push(j)}}var f=this,l=b.add(f);a=a.not(":button, :image, :reset, :submit");e.extend(f,{getConf:function(){return c},getForm:function(){return b},getInputs:function(){return a},reflow:function(){a.each(function(){var g=e(this),d=g.data("msg.el");
if(d){g=t(g,d,c);d.css({top:g.top,left:g.left})}});return f},invalidate:function(g,d){if(!d){var i=[];e.each(g,function(j,m){j=a.filter("[name='"+j+"']");if(j.length){j.trigger("OI",[m]);i.push({input:j,messages:[m]})}});g=i;d=e.Event()}d.type="onFail";l.trigger(d,[g]);d.isDefaultPrevented()||q[c.effect][0].call(f,g,d);return f},reset:function(g){g=g||a;g.removeClass(c.errorClass).each(function(){var d=e(this).data("msg.el");if(d){d.remove();e(this).data("msg.el",null)}}).unbind(c.errorInputEvent||
"");return f},destroy:function(){b.unbind(c.formEvent+".V").unbind("reset.V");a.unbind(c.inputEvent+".V").unbind("change.V");return f.reset()},checkValidity:function(g,d){g=g||a;g=g.not(":disabled");if(!g.length)return true;d=d||e.Event();d.type="onBeforeValidate";l.trigger(d,[g]);if(d.isDefaultPrevented())return d.result;var i=[];g.not(":radio:not(:checked)").each(function(){var m=[],n=e(this).data("messages",m),v=r&&n.is(":date")?"onHide.v":c.errorInputEvent+".v";n.unbind(v);e.each(w,function(){var o=
this,s=o[0];if(n.filter(s).length){o=o[1].call(f,n,n.val());if(o!==true){d.type="onBeforeFail";l.trigger(d,[n,s]);if(d.isDefaultPrevented())return false;var x=n.attr(c.messageAttr);if(x){m=[x];return false}else k(m,s,o)}}});if(m.length){i.push({input:n,messages:m});n.trigger("OI",[m]);c.errorInputEvent&&n.bind(v,function(o){f.checkValidity(n,o)})}if(c.singleError&&i.length)return false});var j=q[c.effect];if(!j)throw'Validator: cannot find effect "'+c.effect+'"';if(i.length){f.invalidate(i,d);return false}else{j[1].call(f,
g,d);d.type="onSuccess";l.trigger(d,[g]);g.unbind(c.errorInputEvent+".v")}return true}});e.each("onBeforeValidate,onBeforeFail,onFail,onSuccess".split(","),function(g,d){e.isFunction(c[d])&&e(f).bind(d,c[d]);f[d]=function(i){i&&e(f).bind(d,i);return f}});c.formEvent&&b.bind(c.formEvent+".V",function(g){if(!f.checkValidity(null,g))return g.preventDefault()});b.bind("reset.V",function(){f.reset()});a[0]&&a[0].validity&&a.each(function(){this.oninvalid=function(){return false}});if(b[0])b[0].checkValidity=
f.checkValidity;c.inputEvent&&a.bind(c.inputEvent+".V",function(g){f.checkValidity(e(this),g)});a.filter(":checkbox, select").filter("[required]").bind("change.V",function(g){var d=e(this);if(this.checked||d.is("select")&&e(this).val())q[c.effect][1].call(f,d,g)});var p=a.filter(":radio").change(function(g){f.checkValidity(p,g)});e(window).resize(function(){f.reflow()})}e.tools=e.tools||{version:"1.2.5"};var z=/\[type=([a-z]+)\]/,A=/^-?[0-9]*(\.[0-9]+)?$/,r=e.tools.dateinput,B=/^([a-z0-9_\.\-\+]+)@([\da-z\.\-]+)\.([a-z\.]{2,6})$/i,
C=/^(https?:\/\/)?[\da-z\.\-]+\.[a-z\.]{2,6}[#&+_\?\/\w \.\-=]*$/i,h;h=e.tools.validator={conf:{grouped:false,effect:"default",errorClass:"invalid",inputEvent:null,errorInputEvent:"keyup",formEvent:"submit",lang:"en",message:"<div/>",messageAttr:"data-message",messageClass:"error",offset:[0,0],position:"center right",singleError:false,speed:"normal"},messages:{"*":{en:"Please correct this value"}},localize:function(a,b){e.each(b,function(c,k){h.messages[c]=h.messages[c]||{};h.messages[c][a]=k})},
localizeFn:function(a,b){h.messages[a]=h.messages[a]||{};e.extend(h.messages[a],b)},fn:function(a,b,c){if(e.isFunction(b))c=b;else{if(typeof b=="string")b={en:b};this.messages[a.key||a]=b}if(b=z.exec(a))a=y(b[1]);w.push([a,c])},addEffect:function(a,b,c){q[a]=[b,c]}};var w=[],q={"default":[function(a){var b=this.getConf();e.each(a,function(c,k){c=k.input;c.addClass(b.errorClass);var f=c.data("msg.el");if(!f){f=e(b.message).addClass(b.messageClass).appendTo(document.body);c.data("msg.el",f)}f.css({visibility:"hidden"}).find("p").remove();
e.each(k.messages,function(l,p){e("<p/>").html(p).appendTo(f)});f.outerWidth()==f.parent().width()&&f.add(f.find("p")).css({display:"inline"});k=t(c,f,b);f.css({visibility:"visible",position:"absolute",top:k.top,left:k.left}).fadeIn(b.speed)})},function(a){var b=this.getConf();a.removeClass(b.errorClass).each(function(){var c=e(this).data("msg.el");c&&c.css({visibility:"hidden"})})}]};e.each("email,url,number".split(","),function(a,b){e.expr[":"][b]=function(c){return c.getAttribute("type")===b}});
e.fn.oninvalid=function(a){return this[a?"bind":"trigger"]("OI",a)};h.fn(":email","Please enter a valid email address",function(a,b){return!b||B.test(b)});h.fn(":url","Please enter a valid URL",function(a,b){return!b||C.test(b)});h.fn(":number","Please enter a numeric value.",function(a,b){return A.test(b)});h.fn("[max]","Please enter a value smaller than $1",function(a,b){if(b===""||r&&a.is(":date"))return true;a=a.attr("max");return parseFloat(b)<=parseFloat(a)?true:[a]});h.fn("[min]","Please enter a value larger than $1",
function(a,b){if(b===""||r&&a.is(":date"))return true;a=a.attr("min");return parseFloat(b)>=parseFloat(a)?true:[a]});h.fn("[required]","Please complete this mandatory field.",function(a,b){if(a.is(":checkbox"))return a.is(":checked");return!!b});h.fn("[pattern]",function(a){var b=new RegExp("^"+a.attr("pattern")+"$");return b.test(a.val())});e.fn.validator=function(a){var b=this.data("validator");if(b){b.destroy();this.removeData("validator")}a=e.extend(true,{},h.conf,a);if(this.is("form"))return this.each(function(){var c=
e(this);b=new u(c.find(":input"),c,a);c.data("validator",b)});else{b=new u(this,this.eq(0).closest("form"),a);return this.data("validator",b)}}})(jQuery);