/**
  * Init Header
  * Full Screen
  * Retina Logos
  * Blog Isotope
  * Widget Testimonial
  * Logo Client
  * Roll Slider
  * Toggles
  * Gmap Setup
  * Progress Bar
  * Responsive Menu
  * AjaxSubscribe
  * Animation
  * Go Top
  * Twitter
  * Ajax Contact Form
  * Flickr Feed
  * Tabs
  * Testimonial
  * TestimonialSmall
  * Testimonial Quote
  * Slide Header
  * Slide Header Style 2
  * Slide Header Product
  * Slide Header Landing
  * Slide Header Landing Left
  * Slide Header Landing Right
  * Slide Single Page
  * Slide Header Mask
  * Header Video
  * Preloader
  * Parallax
  * DropList
  * Counter
  * Feature
  * Portfolio Image Small
  * Calendar
  * Skill User
  * Testimonial Services
  * Client Services
  * Order Items
  * Produc Details
  * Light Box
  * Product Color
  * Section Video
*/

;(function($) {

   'use strict'

   var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

   var init_header = function() {
      var largeScreen = matchMedia('only screen and (min-width: 992px)').matches;
      if ( largeScreen ) {
         if( $().sticky ){
            $('header.header-sticky').sticky();
         }
      }

      $(window).scroll( function() {
         if ( $( window).scrollTop() > 200 ) {
            $('header').addClass('float-header');
         } else {
            $('header').removeClass('float-header');
         }
      });

      $('.one-page .mainnav ul > li > a').on('click',function() {
         var anchor = $(this).attr('href').split('#')[1];

         if (anchor) {
            if ( $('#'+anchor).length > 0 ) {
               var headerHeight = 0;
               if ( $('.header-sticky').length > 0 && largeScreen ) {
                  headerHeight = $('#header').outerHeight();
               }
               var target = $('#'+anchor).offset().top - headerHeight;
               $('html,body').animate({scrollTop: target}, 1000, 'easeInOutExpo');
            }
         }
         return false;
      }); // click on one-page menu
      
      $('.one-page .mainnav > ul > li > a').on( 'click', function() {
         $( this ).addClass('active').parent().siblings().children().removeClass('active');
      });
   };

   var fullScreen = function() {
      (function() {
         function setupSlider() {
            if($('body')[0].className == 'full-screen') {
                //$('.top').css('background-color','transparent');
                $('.header').css({'background-color':'#011d27', 'border-bottom':'1px solid #fff'});

                var hTop = $('.top').outerHeight();
                var hHead = $('.header').outerHeight();
                var hWin = screen.height;
                var slide = $('.head-slide').data('slide');

                $('.head-slide').css({'height':hWin - hTop - hHead});
                $('.head-slide .' + slide).css({'height':hWin - hTop - hHead-55});
                $('.head-slide .' + slide + ' ul li').css({'height':hWin - hTop - hHead-55});
                $('.head-slide .' + slide + ' ul li img').css({'height':hWin - hTop - hHead-55});
            }
         }

         $(window).on("resize", setupSlider);
         $(document).on("ready", setupSlider);
      })(); // set fullscreen and vertical align for content

      (function() {
         var current = 1; 
         var height = $('.text-scroll').height(); 
         var numberDivs = $('.text-scroll').children().length; 
         var first = $('.text-scroll h1:nth-child(1)');

         setInterval(function() {
            var number = current * -height;
            first.css('margin-top', number + 'px');
            if ( current === numberDivs ) {
              first.css('margin-top', '0px');
              current = 1;
            } else current++;
         }, 2500);
      })(); // scroll divs

      (function() {
         $('.btn-top').on('click',function() {
            var anchor = $(this).attr('href').split('#')[1];
            if ( anchor ) {
               if ( $('#'+anchor).length > 0 ) {
                  var headerHeight = 0;
                  if ( $('.header-sticky').length > 0 ) {
                     headerHeight = $('#header').outerHeight();
                  }
                  var target = $('#'+anchor).offset().top - headerHeight;

                  $('html,body').animate({scrollTop: target}, 1000, 'easeInOutExpo');
               }
            }
            return false;
         });
      })(); // scroll target
   };

   var retinaLogos = function() {
      var retina = window.devicePixelRatio > 1 ? true : false;

      if(retina) {
         $('.header .logo').find('img').attr({src:'./images/logo@2x.png',width:'107',height:'19'});
         $('.single-page .header .logo').find('img').attr({src:'./images/logo_l@2x.png',width:'107',height:'19'});
      }
   };

   var blogIsotope = function() {
        if ( $().isotope ) {
            var $container = $('.blog-container');
            var col = $('.blog-container').data('col');

            $container.imagesLoaded(function(){
               $container.isotope({
                    itemSelector: col,
                    columnWidth: col,
                    transitionDuration: '1s'
               }); // end isotope
            });

            $('.class-filter li').on('click',function(){
                var selector = $(this).find("a").attr('data-filter');
                $('.blog-container').isotope({ filter: selector });
                $('.drop-wrap a')[0].innerText = $(this).find("a")[0].outerText;

                $('.dropdown').removeClass('show');
                return false;
            }); // on click
        }; // if isotope exists
   };

    var widgetTestimonial = function () {
        $('.widget-testimonial .testimonial-text').bxSlider({
            animation: "slide",
            pause: 2000,
            controls:true,
            pager : false,
            nextText: '<i class="icons-angle-right"></i>',
            prevText: '<i class="icons-angle-left"></i>'
        });
    };

    var logoClient = function () {
        var owl = $(".logoClient .logos");
        owl.owlCarousel({
            navigation:true,
            autoplay:true,
            autoplayTimeout:4000,
            loop: true,
            slideSpeed: 4000,
            responsive:{ 
                1200:{items:6, margin : 94},
                960:{items:5, margin : 94},
                678:{items:4, margin : 94},
                0:{items:1, margin: 0}
            }
        });
    };

   var rollSlider = function() {
      if ( $().flexslider ) {
         $('.or-slider').each(function() {
            var $this = $(this);
            var easing = ( $this.data('effect') == 'fade' ) ? 'linear' : 'easeInOutExpo';
            $this.find('.flexslider').flexslider({
               animation      :  $this.data('effect'),
               direction      :  $this.data('direction'), // vertical
               pauseOnHover   :  true,
               useCSS         :  false,
               animationSpeed :  800,
               slideshowSpeed :  5000,
               controlNav     :  false,
               directionNav   :  true,
               slideshow      :  $this.data('auto'),
               prevText    :  '<i class="icons-angle-left"></i>',
               nextText    :  '<i class="icons-angle-right"></i>',
               smoothHeight   :  true
            }); // flexslider
         }); // or-slider each
      }
   };

   var toggles = function() {
      var args = {easing : 'easeOutExpo', duration: 600};
      $('.toggle .toggle-title.active').siblings('.toggle-content').show();

      $('.toggle.toggle-enable .toggle-title').on('click',function() {
         $(this).closest('.toggle').find('.toggle-content').slideToggle(args);
         $(this).toggleClass('active');
      }); // toggle 

      $('.accordion .toggle-title').on('click',function() {
         if( !$(this).is('.active') ) {
            $(this).closest('.accordion').find('.toggle-title.active').toggleClass('active').next().slideToggle(args);
            $(this).toggleClass('active');
            $(this).next().slideToggle(args);
         } else {
            $(this).toggleClass('active');
            $(this).next().slideToggle(args);
         }     
      }); // accordion
   };

    var gmapSetup = function() {
        if ( $().goMap ) {
            $("#map").goMap({ // load map
                markers: [{  
                    address: '1003 N Harrison St Lexington, NE 68850 United States', 
                    title: 'My company',
                    icon: 'images/pin.svg'
                }],
                scrollwheel: false, 
                disableDoubleClickZoom: false,
                zoom: 16,
                maptype: 'ROADMAP'
            });
        }
    };

   var progressBar = function() {
      $('.progress-bar').on('on-appear', function() {
         $(this).each(function() {
            var percent = $(this).data('percent');

            $(this).find('.progress-animate').animate({
               "width": percent + '%'
            },1200);

            $(this).parent('.progress-single').find('.perc').addClass('show').animate({
               "width": percent + '%'
            },1200);
         });
      });
   }

   var ResponsiveMenu = {

      menuType: 'desktop',

      initial: function(winWidth) {
         ResponsiveMenu.menuWidthDetect(winWidth);
         ResponsiveMenu.menuBtnClick();
         ResponsiveMenu.parentMenuClick();
      },

      menuWidthDetect: function(winWidth) {
         var currMenuType = 'desktop';

         if (matchMedia('only screen and (max-width: 978px)').matches) {
            currMenuType = 'mobile';
         } // change menu type

         if ( currMenuType !== ResponsiveMenu.menuType ) {
            ResponsiveMenu.menuType = currMenuType;

            if ( currMenuType === 'mobile' ) {
               var $mobileMenu = $('#mainnav').attr('id', 'mainnav-mobi').hide();
               $('#header').find('.header-wrap').after($mobileMenu);
               var hasChildMenu = $('#mainnav-mobi').find('li:has(ul)');
               hasChildMenu.children('ul').hide();
               hasChildMenu.children('a').after('<span class="btn-submenu"></span>');
               $('.btn-menu').removeClass('active');
             } 
             else {
               var $desktopMenu = $('#mainnav-mobi').attr('id', 'mainnav').removeAttr('style');
               $desktopMenu.find('.sub-menu').removeAttr('style');
               $('#header').find('.span10').after($desktopMenu);
               $('.btn-submenu').remove();
             }
         } // clone and insert menu
      },

      menuBtnClick: function() {
         $('.btn-menu').on('click', function() {
            $('#mainnav-mobi').slideToggle(300);
            $(this).toggleClass('active close-menu');
         });
      }, // click on moblie button

      parentMenuClick: function() {
         $(document).on('click', '#mainnav-mobi li .btn-submenu', function(e) {
            if ( $(this).has('ul') ) {
               e.stopImmediatePropagation()
               $(this).next('ul').slideToggle(300);
               $(this).toggleClass('active');
            }
         });
      } // click on sub-menu button
   };

   
   var ajaxSubscribe = {
      obj: {
         subscribeEmail    : $('#subscribe-email'),
         subscribeButton   : $('#subscribe-button'),
         subscribeMsg      : $('#subscribe-msg'),
         subscribeContent  : $("#subscribe-content"),
         dataMailchimp     : $('#subscribe-form').attr('data-mailchimp'),
         success_message   : '<div class="notification_ok">Thank you for joining our mailing list. Please check your email for a confirmation link.</div>',
         failure_message   : '<div class="notification_error">There was a problem processing your submission.</div>',
         noticeError       : '<div class="notification_error">{msg}</div>',
         noticeInfo        : '<div class="notification_error">{msg}</div>',
         basicAction       : 'mail/subscribe.php',
         mailChimpAction   : 'mail/subscribe-mailchimp.php'
      },

      eventLoad: function() {
         var objUse = ajaxSubscribe.obj;

         $(objUse.subscribeButton).on('click', function() {
            if ( window.ajaxCalling ) return;
            var isMailchimp = objUse.dataMailchimp === 'true';

            if ( isMailchimp ) {
              ajaxSubscribe.ajaxCall(objUse.mailChimpAction);
            } else {
              ajaxSubscribe.ajaxCall(objUse.basicAction);
            }
         });
      },

      ajaxCall: function (action) {
         window.ajaxCalling = true;
         var objUse = ajaxSubscribe.obj;
         var messageDiv = objUse.subscribeMsg.html('').hide();
         $.ajax({
            url: action,
            type: 'POST',
            dataType: 'json',
            data: {
               subscribeEmail: objUse.subscribeEmail.val()
            },
            success: function (responseData, textStatus, jqXHR) {
               if ( responseData.status ) {
                  objUse.subscribeContent.fadeOut(500, function () {
                     messageDiv.html(objUse.success_message).fadeIn(500);
                  });
               } else {
                  switch (responseData.msg) {
                  case "email-required":
                     messageDiv.html(objUse.noticeError.replace('{msg}','Email is required.'));
                     break;
                  case "email-err":
                     messageDiv.html(objUse.noticeError.replace('{msg}','Email invalid.'));
                     break;
                  case "duplicate":
                     messageDiv.html(objUse.noticeError.replace('{msg}','Email is duplicate.'));
                     break;
                  case "filewrite":
                     messageDiv.html(objUse.noticeInfo.replace('{msg}','Mail list file is open.'));
                     break;
                  case "undefined":
                     messageDiv.html(objUse.noticeInfo.replace('{msg}','undefined error.'));
                     break;
                  case "api-error":
                     objUse.subscribeContent.fadeOut(500, function () {
                        messageDiv.html(objUse.failure_message);
                     });
                  }
                  messageDiv.fadeIn(500);
               }
            },
            error: function (jqXHR, textStatus, errorThrown) {
               alert('Connection error');
            },
            complete: function (data) {
               window.ajaxCalling = false;
            }
         });
      }
   };

   var orAnimation = function() {
      $('.roll-animation').each( function() {
            if( !isMobile.any() ) {
                var orElement = $(this),
                orAnimationClass = orElement.data('animation'),
                orAnimationDelay = orElement.data('animation-delay'),
                orAnimationOffset = orElement.data('animation-offset'),
                effect = orElement.data('portfolio-effect');

                orElement.css({
                    '-webkit-animation-delay':  orAnimationDelay,
                    '-moz-animation-delay':     orAnimationDelay,
                    'animation-delay':          orAnimationDelay
                });

                orElement.waypoint(function () {
                orElement.addClass('animated ' + effect ).addClass(orAnimationClass);
                },{
                   triggerOnce: true,
                   offset: orAnimationOffset
                });
            } else {
                $('.roll-animation').addClass('animated');
            }
        });
   };

   var goTop = function() {
      $(window).scroll(function() {
         if ( $(this).scrollTop() > 800 ) {
            $('.go-top').addClass('show');
         } else {
            $('.go-top').removeClass('show');
         }
      }); 
      
      $('.go-top').on('click',function() {
         $("html, body").animate({ scrollTop: 0 }, 1000 , 'easeInOutExpo');
         return false;
      });
   };

    var twitter = function () {
        if ( $().tweet ) {
            $('.list-tiwtter').each(function () {
                var $this = $(this);
                $this.tweet({
                    username: $this.data('username'),
                    join_text: "auto",
                    avatar_size: null,
                    count: $this.data('number'),
                    template: "{text} {time}",
                    loading_text: "loading tweets...",
                    modpath: $this.data('modpath')      
                }); // tweet
            }); // lastest-tweets each
        };
    };

   var ajaxContactForm = function() {
      // http://www.bitrepository.com/a-simple-ajax-contact-form-with-php-validation.html
      $('.contact-form').each(function() {
         var $this = $(this); 
         $this.submit(function() {
            var str = $this.serialize();
            $.ajax({
               type: "POST",
               url:  $this.attr('action'),
               data: str,
               success: function(msg) {
                  // Message Sent? Show the 'Thank You' message and hide the form
                  var result;
                  if(msg == 'OK') {
                     result = '<div class="notification_ok">Your message has been sent. Thank you!</div>';
                  } else {
                     result = msg;
                  }
                  result = '<div class="result">' + result + '</div>';
                  $this.find('.note').html(result);
               }
            });
            return false;
         }); // submit

      }); // each contactform
   }; 

   var flickrFeed = function() {
      if ( $().jflickrfeed ) {
         $('.flickr-photos').each( function() {
            var $this = $(this);
            $(this).jflickrfeed({
               limit: 6,
               qstrings: {
                  id: '92231417@N05' // Your Flickr Id
               },
               itemTemplate: '<li><a href="{{link}}" title="{{title}}" target="_blank"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
            });
         });
      }
   };

    var tabs = function() {
        $('.tabs').each(function() {
            $(this).children('.content-tab').children().hide();
            $(this).children('.content-tab').children().first().show();
            $(this).find('.menu-tab').children('li').on('click',function(e) {  
                var liActive = $(this).index();
                var contentActive = $(this).siblings().removeClass('active').parents('.tabs').children('.content-tab').children().eq(liActive);
                contentActive.addClass('active').fadeIn('slow');
                contentActive.siblings().removeClass('active');
                $(this).addClass('active').parents('.tabs').children('.content-tab').children().eq(liActive).siblings().hide();
                e.preventDefault();
            });
        });
    }

    var testimonial = function () {
        $('.widget-testimonial .testimonial-text').bxSlider({
            animation: "slide",
            pause: 2000,
            controls:true,
            pager : false,
            nextText: '<i class="icons-angle-right"></i>',
            prevText: '<i class="icons-angle-left"></i>'
        });
    };

    var testimonialSmall = function () {
        $('.roll-testimonial.testimonial-small .testimonial-text').bxSlider({
            controls:false,
            pager : false,
            animation: "slide",
            auto: true
        });
    };

    var slideHeader = function () {
        if($('.head-slider.default').find('.flexslider').length===1) 
            setupFlexslider('.head-slider.default .flexslider');
    }

    var setupFlexslider = function (tag) {
        var  count = $('.head-slider ul.image-bg li').length, length = 0;
        $(tag).flexslider({
            animationLoop: true,
            slideshow: true,
            slideshowSpeed: 4000,
            animationSpeed: 800,
            pauseOnHover: true, 
            pauseOnAction:true,
            controlNav: false,
            directionNav: true,
            prevText: '<i class="icon-left-open"></i>',
            nextText: '<i class="icon-right-open"></i>',
            controlsContainer: '.flex-container',
            start: function() {
                $($('.head-slider ul.image-bg li')[0]).addClass('active');
            },
            after: function() {

                length = $('.flexslider .slides > li').index(
                            $('.flexslider .slides > li.flex-active-slide'));
                if(length-1<0)
                    length = count;

                $($('.head-slider ul.image-bg li')[
                    length-1
                ]).removeClass('active');


                $($('.head-slider ul.image-bg li')[
                    $('.flexslider .slides > li').index(    
                        $('.flexslider .slides > li.flex-active-slide'))
                ]).addClass('active');
            }
        });
    }

    var slideHeader2 = function () {
        if($('.head-slider.slide-2').find('.flexslider').length===1)
            setupFlexslider('.head-slider.slide-2 .flexslider');
    }

    var slideHeaderProduct = function () {
        if($('.head-slider.slide-product').find('.flexslider').length===1) 
            setupFlexslider('.head-slider.slide-product .flexslider');
    }

    var slideHeaderLanding = function () {
        if($('.head-slider.slide-landing').find('.flexslider').length===1)
            setupFlexslider('.head-slider.slide-landing .flexslider');
    }

    var slideHeaderLandingLeft = function () {
        if($('.head-slider.slide-landing-left').find('.flexslider').length===1)
            setupFlexslider('.head-slider.slide-landing-left .flexslider');
    }

    var slideHeaderLandingRight = function () {
        if($('.head-slider.slide-landing-right').find('.flexslider').length===1) 
            setupFlexslider('.head-slider.slide-landing-right .flexslider');
    }

    var slideSinglePage = function () {
        if($('.head-slider.single').find('.flexslider').length===1) {
            var  count = $('.single-page > ul.image-bg li').length, length = 0;
            $('.head-slider.single .flexslider').flexslider({
                animationLoop: true,
                slideshow: true,
                slideshowSpeed: 4000,
                animationSpeed: 800,
                pauseOnHover: true, 
                pauseOnAction:true,
                controlNav: false,
                directionNav: true,
                prevText: '<i class="icon-left-open"></i>',
                nextText: '<i class="icon-right-open"></i>',
                controlsContainer: '.flex-container',
                start: function() {
                    $($('.single-page > ul.image-bg li')[
                        $('.flexslider .slides li').index(
                            $('.flexslider .slides li.flex-active-slide'))
                        ]).addClass('active');
                },
                after: function() {

                    length = $('.flexslider .slides > li').index(
                                $('.flexslider .slides li.flex-active-slide'));
                    if(length-1<0)
                        length = count;

                    $($('.single-page > ul.image-bg li')[
                        length-1
                    ]).removeClass('active');


                    $($('.single-page > ul.image-bg li')[
                        $('.flexslider .slides > li').index(
                                $('.flexslider .slides li.flex-active-slide'))
                    ]).addClass('active');
                }
            });
        }
    }

    var slideHeaderMask = function () {
        if($('.head-slider.slide-mask').find('.flexslider').length===1) {
            var  count = $('.head-mask ul.image-bg li').length, length = 0;
            $('.head-slider.slide-mask .flexslider').flexslider({
                animationLoop: true,
                slideshow: false,
                slideshowSpeed: 4000,
                animationSpeed: 800,
                pauseOnHover: true, 
                pauseOnAction:true,
                controlNav: false,
                directionNav: true,
                prevText: '<i class="icon-left-open"></i>',
                nextText: '<i class="icon-right-open"></i>',
                controlsContainer: '.flex-container',
                start: function() {
                    $($('.head-mask ul.image-bg li')[
                        $('.flexslider .slides li').index(
                            $('.flexslider .slides li.flex-active-slide'))
                        ]).addClass('active');
                },
                after: function() {

                    length = $('.flexslider .slides > li').index(
                                $('.flexslider .slides li.flex-active-slide'));
                    if(length-1<0)
                        length = count;

                    $($('.head-mask ul.image-bg li')[
                        length-1
                    ]).removeClass('active');


                    $($('.head-mask ul.image-bg li')[
                        $('.flexslider .slides > li').index(
                                $('.flexslider .slides li.flex-active-slide'))
                    ]).addClass('active');
                }
            });
        }
    }

    var headerVideo = function () {
        if($().YTPlayer) {
            $(".player").YTPlayer({
                onReady: function (player) {
                    $('.head-slider.video-bg .load-video').remove();
                    if($('.head-slider.video-bg').find('.flexslider').length===1) 
                        setupFlexslider('.head-slider.video-bg .flexslider');
                }
            });
        }
    }

    var removePreloader = function() {
        $('.loader').fadeOut('slow',function () {
            $(this).remove();
        });
    };

    var parallax = function() {
        $('.page-title .main-title.parallax').parallax("50%", 0.5);
        $('.roll-row.roll-stats.parallax').parallax("50%", 0.5);
        $('.roll-row.roll-parallax-image').parallax("50%", 0.5);
        $('.roll-row.roll-work.parallax').parallax("50%", 0.5);
        $('.roll-row.roll-services.parallax').parallax("50%", 0.5);
        $('.roll-row.roll-help.parallax').parallax("50%", 0.5);
        $('.roll-row.roll-skills.parallax').parallax("50%", 0.5);
        $('.head-slider.slide-2.parallax').parallax("50%", 0.5);
        $('.head-slider.default.parallax').parallax("50%", 0.5);
        $('.video-bg.parallax').parallax("50%", 0.5);
        $('.head-slider.slide-landing.parallax').parallax("50%", 0.5);
        $('.head-slider.slide-landing-2.parallax').parallax("50%", 0.5);
        $('.head-slider.single.parallax').parallax("50%", 0.5);
        $('.head-slider.slide-mask.parallax').parallax("50%", 0.5);
    };

    var dropList = function() {
        $('.drop-list').each(function() {
            var menuDrop = $(this).children('.nav-dropdown'),
                activeDrop = $(this).find('.drop-wrap');

            menuDrop.on('click',function() {
                var drop = $(this).children('.dropdown');

                if ( drop.is(".show") ) {
                    drop.removeClass('show');
                    activeDrop.removeClass('active');
                } else {
                    drop.addClass('show');
                    activeDrop.addClass('active');
                }

                return false;
            });

            $(document).on('click',function() {
                menuDrop.children('.dropdown').removeClass('show');
                activeDrop.removeClass('active');
            });
        });
    };

    var counter = function () {
        if($().animateNumber) {
            $('.roll-stats').appear(function() {
                $('.roll-stats-count .number').each(function() {
                    var $this = $(this);
                    var number = $this.data('to'),  speed = $this.data('speed');
                    $this.animateNumber({
                            number: number
                    }, speed);
                });
            });
        }
    }

    var feature = function () {
        $('.roll-feature .image a').on('click',function() {
            var $this = $(this);
            $('.roll-feature .main-image').empty().append('<img src="'+$this.data("image")+'" alt="image">');
            return false;
        })
    }

    var portfolioImageSmall = function () {
        $('.portfolio.details.small-image .image a').on('click',function() {
            var $this = $(this);
            $('.portfolio.details.small-image .main-image').empty().append('<img src="'+$this.data("image")+'" alt="image">');
            return false;
        })
    }

    var calendar = function () {
        if($().datepicker)
            $('#datepicker').datepicker({inline: true});
    }

    var skillUser = function () {
        var owl = $(".skill-user");
        var count=0, number=0, activeSlide = 0;
        owl.owlCarousel({
            navigation:true,
            autoplay:false,
            autoplayTimeout:4000,
            loop: true,
            slideSpeed: 4000,
            responsive:{ 
                1200:{items:2},
                960:{items:1},
                678:{items:1},
                480:{items:1},
                0:{items:1}
            }
        });

        $($('.skill-user .owl-item')[2]).animate({'opacity': '1'}, 1500, 'easeInOutExpo');

        owl.on('changed.owl.carousel',function(e){
            //active slide
            $('.skill-user .owl-item').css('opacity','0.2');
            activeSlide = e.relatedTarget.current();
            $($('.skill-user .owl-item')[activeSlide]).animate({'opacity': '1'}, 1500, 'easeInOutExpo');

            //process bar
            count++;
            if(count===$('.roll-teamskill .skill-bar .items').length) {
                count=0;
                $('.roll-teamskill .skill-bar .items').animate({'margin-left': '0'}, 1500, 'easeInOutExpo', 
                    function() {setupProcessBar($('.roll-teamskill .skill-bar .items')[number+1])});
                number = 0;
            }
            else {
                number = e.relatedTarget.current()-3;
                var $temp = $('.roll-teamskill .skill-bar .items')[number];
                $($temp).animate({'margin-left': '-100%'}, 1500, 'easeInOutExpo', function() {setupProcessBar($('.roll-teamskill .skill-bar .items')[number+1])});
            }
        });

        function setupProcessBar (temp) {
            $(temp).find('.progress-bar').each(function() {
                var percent = $(this).data('percent');

                $(this).find('.progress-animate').animate({
                   "width": percent + '%'
                },2000);

                $(this).parent('.progress-single').find('.perc').addClass('show').animate({
                   "width": percent + '%'
                },2000);
            });
        }
    }

    var testimonialServices = function () {
        var owl = $(".services-testimonial");
        owl.owlCarousel({
            navigation:true,
            items : 1,
            autoplay:true,
            autoplayTimeout:4000,
            loop: true,
            slideSpeed: 4000
        });
    }

    var clientServices = function () {
        var owl = $(".serclient.default");
        owl.owlCarousel({
            navigation:true,
            autoplay:true,
            autoplayTimeout:4000,
            loop: true,
            slideSpeed: 4000,
            responsive:{ 
                1200:{items:2,margin : 30},
                960:{items:2,margin : 30},
                678:{items:2,margin : 30},
                0:{items:1, margin: 0}
            }
        });

        var owlNav = $(".serclient.control-nav");
        owlNav.owlCarousel({
            nav:true,
            navText: [
              "<i class='icon-left-open'></i>",
              "<i class=' icon-right-open'></i>"
              ],
            autoplay:true,
            autoplayTimeout:4000,
            loop: true,
            slideSpeed: 4000,
            responsive:{ 
                1200:{items:2,margin : 115},
                960:{items:2,margin : 30},
                678:{items:2,margin : 30},
                0:{items:1, margin: 0}
            }
        });
    }

    var testimonialQuote = function () {
        var owl = $(".roll-testiquote");
        owl.owlCarousel({
            nav:true,
            items : 1,
            margin: 0,
            autoplay:true,
            autoplayTimeout:4000,
            loop: true,
            slideSpeed: 4000
        });
    }

    var orderItems = function () {
        var check = 0;
        $('.top-right .cart, .social.basket').on('click', function () {
            if(check===0) {
                $('.basket-items').css('visibility', 'visible').animate({opacity:1},300);
                check = 1;
            }
            else {
                check = 0;
                $('.basket-items').css('visibility', 'hidden').animate({opacity:0},300);
            }
        });
    };

    var producDetails = function () {
        $('.product-details .picture').on('click', function () {
            var image = $(this).data("image");
            $('.product-details .item-image .image').empty().append('<a class="zoom fancybox-buttons" data-fancybox-group="button" href="'+image+'"></a><img src="'+image+'" alt="image">');
        });
    }

    var lightBox = function () {
        if($().fancybox) {
            var checkAuto = 0;

            $('.fancybox-buttons').fancybox({
                openEffect  : 'none',
                closeEffect : 'none',

                prevEffect : 'none',
                nextEffect : 'none',

                padding : 0,

                closeBtn  : false,

                helpers : {
                  title : {
                    type : 'inside'
                  },
                  buttons : {}
                },

                afterLoad : function() {
                    this.title += '<span>' + (this.index + 1) + '/' + this.group.length +"</span>" + ($(this.element).data('caption') === undefined ? '&nbsp;' : $(this.element).data('caption'));

                    var F = $.fancybox;

                    //Add helper object
                    F.helpers.buttons = {
                        defaults : {
                            skipSingle : false, // disables if gallery contains single image
                            position   : 'top', // 'top' or 'bottom'
                            tpl        : '<div id="fancybox-buttons"><ul><li><a class="btnPlay" title="Start slideshow" href="javascript:;"></a></li><li><a class="btnPrev" title="Previous" href="javascript:;"></a></li><li><a class="btnNext" title="Next" href="javascript:;"></a></li><li><a class="btnToggle" title="Toggle size" href="javascript:;"></a></li><li><a class="btnClose" title="Close" href="javascript:;"></a></li></ul></div>'
                        },

                        list : null,
                        buttons: null,

                        beforeLoad: function (opts, obj) {
                            //Remove self if gallery do not have at least two items

                            if (opts.skipSingle && obj.group.length < 2) {
                                obj.helpers.buttons = false;
                                obj.closeBtn = true;

                                return;
                            }

                            //Increase top margin to give space for buttons
                            obj.margin[ opts.position === 'bottom' ? 2 : 0 ] += 30;
                        },

                        onPlayStart: function () {
                            if (this.buttons) {
                                this.buttons.play.attr('title', 'Pause slideshow').addClass('btnPlayOn');
                            }
                            checkAuto = 1;
                        },

                        onPlayEnd: function () {
                            if (this.buttons) {
                                this.buttons.play.attr('title', 'Start slideshow').removeClass('btnPlayOn');
                            }
                            checkAuto = 0;
                        },

                        afterShow: function (opts, obj) {
                            var buttons = this.buttons;

                            if (!buttons) {
                                this.list = $(opts.tpl).addClass(opts.position).appendTo($('.fancybox-skin'));

                                buttons = {
                                    prev   : this.list.find('.btnPrev').click( F.prev ),
                                    next   : this.list.find('.btnNext').click( F.next ),
                                    play   : this.list.find('.btnPlay').click( F.play ),
                                    toggle : this.list.find('.btnToggle').click( F.toggle ),
                                    close  : this.list.find('.btnClose').click( F.close )
                                }

                                if(checkAuto===1) {
                                    $('.btnPlay').addClass('btnPlayOn');
                                }
                            }

                            //Prev
                            if (obj.index > 0 || obj.loop) {
                                buttons.prev.removeClass('btnDisabled');
                            } else {
                                buttons.prev.addClass('btnDisabled');
                            }

                            //Next / Play
                            if (obj.loop || obj.index < obj.group.length - 1) {
                                buttons.next.removeClass('btnDisabled');
                                buttons.play.removeClass('btnDisabled');

                            } else {
                                buttons.next.addClass('btnDisabled');
                                buttons.play.addClass('btnDisabled');
                            }

                            this.buttons = buttons;

                            this.onUpdate(opts, obj);
                        },

                        onUpdate: function (opts, obj) {
                            var toggle;

                            if (!this.buttons) {
                                return;
                            }

                            toggle = this.buttons.toggle.removeClass('btnDisabled btnToggleOn');

                            //Size toggle button
                            if (obj.canShrink) {
                                toggle.addClass('btnToggleOn');

                            } else if (!obj.canExpand) {
                                toggle.addClass('btnDisabled');
                            }
                        },

                        beforeClose: function () {
                            if (this.list) {
                                this.list.remove();
                            }

                            this.list    = null;
                            this.buttons = null;
                        }
                    };
                }
            });
        }
    }

    var productColor = function () {
        try {
            var color = $('.proc-color').data('color').split(',');
            var html = "<ul>";
            for (var i = 0; i< color.length; i++)
                html += "<li style='background-color:"+color[i]+"'></li>";
            html += "</ul>";
            $('.proc-color ul').remove();
            $('.proc-color').append(html);
        }
        catch(err) {}
    }

    var sectionVideo = function () {
        if($().YTPlayer) {
            $(".video-section").YTPlayer();

            $(".roll-stats.video-bg").waypoint(function () {
                $(".roll-stats.video-bg").css('background','transparent');
            },{
                triggerOnce: true
            });
        }
    }

   // Dom Ready
   $(function() {
      fullScreen();
      dropList();
      counter();
      slideHeader();
      slideHeader2();
      slideHeaderProduct();
      slideHeaderLanding();
      slideHeaderLandingLeft();
      slideHeaderLandingRight();
      slideSinglePage();
      slideHeaderMask();
      sectionVideo();
      headerVideo();
      retinaLogos();
      blogIsotope();
      widgetTestimonial();
      testimonial();
      testimonialSmall();
      testimonialServices();
      testimonialQuote();
      clientServices();
      feature();
      lightBox();
      productColor();
      producDetails();
      orderItems();
      portfolioImageSmall();
      calendar();
      logoClient();
      rollSlider();
      toggles();
      skillUser();
      progressBar();
      orAnimation();
      goTop();
      ajaxContactForm();
      flickrFeed();
      ajaxSubscribe.eventLoad();
      tabs();
      removePreloader();
      gmapSetup();
      twitter();
      
      // Initialize responsive menu
      ResponsiveMenu.initial($(window).width());
      $(window).resize(function() {
         ResponsiveMenu.menuWidthDetect($(this).width());
      });

      // Detect elements into viewport
      $('[data-waypoint-active="yes"]').waypoint(function() {
         $(this).trigger('on-appear');
      }, { offset: '90%', triggerOnce: true });

      $(window).on('load', function() {
         setTimeout(function() {
            $.waypoints('refresh');
         }, 100);
      });
   });

})(jQuery);