//// preloader

$( window ).load(function() {
    $(".preloader").fadeOut('slow');
    $('body').on('click' , function(){
        $(".preloader").fadeOut('slow');
    });
});


jQuery(document).ready(function($) {

    //////// datepicker date

    $('#reservation_date input').on('click' , function(){
        $('#reservation_date ').data("DateTimePicker").show();
    });

     $('#reservation_time input').on('click' , function(){
        $('#reservation_time ').data("DateTimePicker").show();
    });

     if($('#reservation_date')){
        $('#reservation_date').datetimepicker({
            ignoreReadonly: true,
            locale: 'ru',
            icons: {
                previous: 'fa fa-caret-left',
                next: 'fa fa-caret-right',
            },
            format: 'DD/MM/YYYY'
        });
     }
     if($('#reservation_time')){
        ///////// datepicker time
        $('#reservation_time').datetimepicker({
            ignoreReadonly: true,
            format: 'LT',
            icons: {
                up: 'fa fa-caret-up',
                down: 'fa fa-caret-down',
                previous: 'fa fa-caret-left',
                next: 'fa fa-caret-right',
            },
        });

     }
    // $('body').scrollspy({ target: '#fixed-header' })

    /////////////shop slider

    $('.shop-grid.-slider').slick({
        arrows: true,
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        nextArrow: '<span class="arrow -next"><i class="fa fa-chevron-right"></i></span>',
        prevArrow: '<span class="arrow -prev"><i class="fa fa-chevron-left"></i></span>',
        responsive: [{
            breakpoint: 1400,
            settings: {
                arrows: true,
                dots: false,
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        }, {
            breakpoint: 991,
            settings: {
                arrows: true,
                dots: false,
                slidesToShow: 2,
                slidesToScroll: 1,
            }
        }, {
            breakpoint: 767,
            settings: {
                arrows: true,
                dots: false,
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        }],
    });


    ////////////// tabMenu slider

    $('.menu-slider').slick({
        arrows: true,
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: true,
        nextArrow: '<span class="arrow -next"><i class="fa fa-chevron-right"></i></span>',
        prevArrow: '<span class="arrow -prev"><i class="fa fa-chevron-left"></i></span>',
        responsive: [{
            breakpoint: 1400,
            settings: {
                arrows: true,
                dots: false,
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: true,
            }
        }, {
            breakpoint: 991,
            settings: {
                arrows: true,
                dots: false,
                slidesToShow: 2,
                slidesToScroll: 1,
                dots: true,
            }
        }, {
            breakpoint: 767,
            settings: {
                arrows: true,
                dots: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
            }
        }],
    });
    $('.tabMenu-slider').slick({
        arrows: false,
        dots: true,
        speed: 1000,
        draggable: false,
        adaptiveHeight: true
        //fade: true,
    });
    $('.tabMenu a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $('.tabMenu-slider').each(function() {
                $(this).slick("getSlick").refresh();
            });
        })
        // gallery slider 

    $('.gallery-content-slider').slick({
        dots: false,
        arrows: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        // fade: true,
        nextArrow: '<span class="arrow -next"><i class="fa fa-chevron-right"></i></span>',
        prevArrow: '<span class="arrow -prev"><i class="fa fa-chevron-left"></i></span>',
        responsive: [{
            breakpoint: 991,
            settings: {
                arrows: false,
                dots: false,
                slidesToShow: 2,
                slidesToScroll: 1,
            }
        }, {
            breakpoint: 767,
            settings: {
                arrows: false,
                dots: false,
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        }],
    });


    $('.gallery a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        $('.gallery-content-slider').each(function() {
            $(this).slick("getSlick").refresh();
        });
    })
    if($('.gallery-content-slider').length){
         $('.gallery-content-slider').slickLightbox({
            itemSelector: '.gallery-item'
        });

    }



    ///// reviews slider
    $('.review-slider.-single_circle').slick({
        infinite: true,
        centerMode: true,
        slidesToShow: 5,
        dots: false,
        arrows: true,

        nextArrow: '<span class="arrow -next"><i class="fa fa-chevron-right"></i></span>',
        prevArrow: '<span class="arrow -prev"><i class="fa fa-chevron-left"></i></span>',
        responsive: [{
            breakpoint: 1400,
            settings: {
                arrows: true,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 3
            }
        }, {
            breakpoint: 991,
            settings: {
                arrows: true,
                centerMode: true,
                centerPadding: '0px',
                slidesToShow: 1
            }
        }]
    });

    /////////// smooth scroll

    $('.fixed-header a[href*="#"]:not([href="#"])').on('click' , function(){
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if ($(window).width() <= 991) {
                if($('body').hasClass('drawer')){
                    $('body').drawer('close');
                }
            }
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });


    $('.header a[href*="#"]:not([href="#"])').on('click' , function(){
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if ($(window).width() <= 991) {
                $('.navbar-collapse').collapse('hide');
                if($('body').hasClass('drawer')){
                    $('body').drawer('close');
                }
            }
            if (target.length) {
                var topLineHeight = $('.header').outerHeight() - 1;
                $('html, body').animate({
                    scrollTop: target.offset().top - topLineHeight
                }, 1000);
                return false;
            }
        } 
    });
    //drawer 
    if ($('.drawer').length) {
        $('.drawer').drawer();
    }

    $('.review-slider.-single').slick({
        dots: false,
        arrows: true,
        fade: true,
        nextArrow: '<span class="arrow -next"><i class="fa fa-chevron-right"></i></span>',
        prevArrow: '<span class="arrow -prev"><i class="fa fa-chevron-left"></i></span>',
    });

    ///////// dropdown

    $('.dropdown').on('show.bs.dropdown', function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
    });

    // Add slideUp animation to Bootstrap dropdown when collapsing.
    $('.dropdown').on('hide.bs.dropdown', function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
    });

    ///// range slider
    if ($('#shop-filter_range-slider').length) {
        $("#shop-filter_range-slider").slider({
            range: true,
            min: 0,
            max: 500,
            values: [10, 300],
            slide: function(event, ui) {
                $("#shop-filter_range-amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
            }
        });
        $("#shop-filter_range-amount").val("$" + $("#shop-filter_range-slider").slider("values", 0) +
            " - $" + $("#shop-filter_range-slider").slider("values", 1));
    }

    //product-page slider

    $('.product-img_slider_for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        fade: true,
        asNavFor: '.product-img_slider_nav',
        // adaptiveHeight: true,
    });

    $('.product-img_slider_nav').slick({
        slidesToShow: 4,
        asNavFor: '.product-img_slider_for',
        dots: false,
        arrows: false,
        vertical: true,
        verticalSwiping: true,
        focusOnSelect: true,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 4,
                asNavFor: '.product-img_slider_for',
                dots: false,
                arrows: false,
                vertical: false,
                verticalSwiping: false,
                focusOnSelect: true,
            }
        }]
    });

    //////// parralax

    var headerFixed;
    $('.scroll_top').hide();
    
    $(window).on('scroll', function() {
        if ($(window).scrollTop() >= 50){
            $('.header.-scroll_white').addClass('-active');
            $('.scroll_top').fadeIn();
        } else {
            $('.header.-scroll_white').removeClass('-active');
            $('.scroll_top').fadeOut();
        }
        
    });

    $('.header .navbar-collapse').on('show.bs.collapse', function () {
        $('.header').addClass('-activeClick'); 
    })
    $('.header .navbar-collapse').on('hide.bs.collapse', function () {
        $('.header').removeClass('-activeClick'); 
    })

    if ($('#google-map').length) {

        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('google-map'), {
          zoom: 4,
          center: uluru,
           scrollwheel: false,
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
        
    }
    if($('.comment-form_rating').length){
        $(".comment-form_rating").starrr();

    }

    ///////// scroll top
    $('.scroll_top').on('click' , function(){
        $('html, body').animate({scrollTop : 0}, 1000);
        return false;
        
    });

    // HOME 8 =======================================

    // add class for left testimonial
    testimonialLeft();

    function testimonialLeft() {
        var windowWidth = $('.testimonials-modern-grid').width();
        var testimItemWidth = $('.testimonial-item').width();
        var countTestimQty = Math.round(windowWidth/testimItemWidth);
        var ItemCount = 1;

        $('.testimonial-item').removeClass('-left-testimonial');

        $('.testimonial-item').each(function(){
            if(ItemCount%countTestimQty == 0){
                $(this).addClass('-left-testimonial');
                $(this).prev().addClass('-left-testimonial');
            }
            ItemCount++;
        });
    }

    $( window ).resize(function() {
        testimonialLeft();
    });

    // fullPage initialization
    if($('#fullPageLanding').length){

        $('#fullPageLanding').fullpage({
            responsiveWidth: 1200,
            responsiveHeight: 620,
            anchors: ['section-home-anchor', 'section-our-story-anchor', 'section-our-gallery-anchor', 'section-menu-anchor', 'section-testimonials-anchor', 'section-shop-anchor', 'section-contact-us-anchor'],
            menu: '#myMenu',

            // add class to reservation btn
            onLeave: function(index, nextIndex, direction){
                var leavingSection = $(this);

                if(nextIndex !== 1){
                    $('.reservation-btn').addClass('btn-stylization');
                    $('.header--fixed').addClass('header--not-transparent');
                }

                else if(nextIndex == 1){
                    $('.reservation-btn').removeClass('btn-stylization');
                    $('.header--fixed').removeClass('header--not-transparent');
                }
            }
        });
    }

    // ARROW LINK SCROLL
    $('.full-page-landing .arrow-down-icon').click( function() {
        if ($(window).width() >= 1200) {
            $.fn.fullpage.moveSectionDown();
        }
    });

    // our story background change
    $( ".our-story-figure-wrap--top" ).hover(function() {
      $bgUrl = $(this).attr("data-bg");
      setTimeout(function(){
          $('.section-our-story').css("background-image", $bgUrl);
      }, 500)
    });

    $( ".our-story-figure-wrap--bottom" ).hover(function() {
      $bgUrl = $(this).attr("data-bg");
      setTimeout(function(){
        $('.section-our-story').css("background-image", $bgUrl);
      }, 500)
    });

    // our gallery slider
    $('.modern-slider-wrap').on('afterChange', function(event, slick, currentSlide, nextSlide){
      galleryAnimation();
    });

    // gallery fix for hover
    function galleryAnimation(){
            // gallery fix
        var itemWidth  =  $('.modern-slider-wrap .slick-active').width(),
            totalItems = $('.modern-slider-wrap .slick-active').length - 1,
            widthDiff =  itemWidth / totalItems ;

        $( window ).resize(function() {
          var itemWidth  =  $('.modern-slider-wrap .slick-active').width(),
              totalItems = $('.modern-slider-wrap .slick-active').length - 1,
              widthDiff =  itemWidth / totalItems ;
        });

        $('.modern-slider-wrap .slick-active').hover(function(){
            $('.modern-slider-wrap .slick-active').css({
                'width' : itemWidth - widthDiff,
            });
            $(this).css({
                'width' : itemWidth * 2,
            });
        } , function(){
            $('.modern-slider-wrap .slick-active').css({
                'width' : itemWidth,
            });
        });
    }

    // gallery filter
    coachFiltering();

    function coachFiltering() {
        var slider = $('.modern-slider-wrap'),
        filter = $('#articles-filter a');

        slider.slick({
           slidesToShow: 8,
           slidesToScroll: 1,
           draggable: false,
           responsive: [
               {
                 breakpoint: 991,
                 settings: {
                   slidesToShow: 6,
                 },
               },
               {
                 breakpoint: 767,
                 settings: {
                     slidesToShow: 3,
                     swipe: true,
                 }
               },
               {
                 breakpoint: 575,
                 settings: {
                     slidesToShow: 2,
                 }
               }
             ]
         });


        filter.on('click', function(e) {
            e.preventDefault();
            // window.location.hash = '';
            filter.removeClass('active');
            $(this).addClass('active');
            var href = $(this).attr('href').split('#')[1];
            slider.slick('slickUnfilter');
            console.log(href);
            if (href !== 'All') {
                slider.slick('slickFilter', '[data-filter=' + href + ']');
            }
            // gallery fix for hover
            galleryAnimation();
        });
    }

    // gallery fix for hover
    galleryAnimation();

    // our gallery pop-up
    if($('.modern-slider-wrap').length){
        $('.modern-slider-wrap').slickLightbox({
            itemSelector: '.modern-slider-item'
        });
    }

    // change img on tabs menu
    if($('#tabChange').length){
        $('.tabMenu').on('shown.bs.tab', function (e) {
            $activeTabe = $("#tabChange .active > a").attr("href");
            console.log($activeTabe);

            $activeTabeImg = $("#tabChange .active > a").attr("data-img-of-category");
            $('.tabMenu-long_bg > .resp_img').css("background-image", $activeTabeImg);
        })
    }

    // GOOGLE MAP =================================
    $(document).ready(function () {
        if($('#blackMap').length){

            var map;

            function initMap() {
                map = new google.maps.Map(document.getElementById('blackMap'), {
                    center: {lat: 40.710683, lng: -74.007180},
                    zoom: 12,
                    zoomControl: false,
                    disableDefaultUI: true,
                    zoomControlOptions: {
                        position: google.maps.ControlPosition.LEFT_CENTER
                    },
                    styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
                });
                var icon = {
                    url: "../img/map_marker.png",
                    anchor: new google.maps.Point(25,50),
                    scaledSize: new google.maps.Size(60,60)
                }
                var marker = new google.maps.Marker({
                    position: {lat: 40.710683, lng: -74.007180},
                    map: map,
                    title: 'Tattoo studio Ink Tattoo',
                    animation: google.maps.Animation.BOUNCE,
                    icon: icon,
                });
                // Keep the center centered on window resize
                google.maps.event.addDomListener(window, "resize", function() {
                    var center = map.getCenter();
                    google.maps.event.trigger(map, "resize");
                    map.setCenter(center);
                    });
            }
            initMap();
        }
    });

    // HOME 6 =======================================

    // ARROW LINK SCROLL
    $('.arrow-down-icon').click( function() {
        var scroll_el = $(this).attr('href');

        if ($(scroll_el).length != 0) {
        $('html, body').animate({ scrollTop: $(scroll_el).offset().top - 50 }, 1000);
        }
        return false;
    });

    // gallery
    if($('.gallery-content-wrap').length){
        $('.gallery-content-wrap').slickLightbox({
            itemSelector: '.our-gallery-photo-item'
        });
    }

    // add class to button reservation
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 1) {
            $(".reservation-btn--transparent").addClass("addColor");
        } else {
            $(".reservation-btn--transparent").removeClass("addColor");
        }
    });

    if($('.fullscreen-bg').length){

        // change BG
        var sectionWelcomeHeight = $('.video-landing .section-welcome').outerHeight(true);
        var sectionAboutScrollTo = $('.video-landing .our-story-section').position().top;
        var elemSelector = '.video_bg_overlay'
            , tStart = sectionWelcomeHeight / 2 // Start transition this many pixels from the top
            , tEnd = sectionAboutScrollTo   // End transition
            , cStart = [0, 0, 0, 0.3]  // Start color
            , cEnd = [0, 0, 0, 0.7]   // End color
            , cDiff = [
                cEnd[0] - cStart[0],
                cEnd[1] - cStart[1],
                cEnd[2] - cStart[2],
                cEnd[3] - cStart[3]
            ];

        scrollColor();
        function scrollColor() {
            var p = ($(this).scrollTop() - tStart) / (tEnd - tStart); // % of transition
            p = Math.min(1, Math.max(0, p)); // Clamp to [0, 1]
            var cBg = [
                Math.round(cStart[0] + cDiff[0] * p),
                Math.round(cStart[1] + cDiff[1] * p),
                Math.round(cStart[2] + cDiff[2] * p),
                Math.round((cStart[3] + cDiff[3] * p) * 100) / 100
            ];
            $(elemSelector).css('background-color', 'rgba(' + cBg.join(',') + ')');
        }
        $(document).scroll(function() {
            scrollColor();
        });
    }

    if($('.main-wrap-content').length){

        // Initialize Slidebars
        var controller = new slidebars();
        controller.init();

        // OPEN SIDE RESERVATION
        $( '.reservation-btn' ).on( 'click', function ( event ) {
          // Stop default action and bubbling
          event.stopPropagation();
          event.preventDefault();

          // open the Slidebar with id 'side-reservation'
          controller.open( 'side-reservation');
        });

        // CLOSE SIDE RESERVATION
        $( '.modal-close' ).on( 'click', function ( event ) {
          // Stop default action and bubbling
          event.stopPropagation();
          event.preventDefault();

          // close the Slidebar with id 'side-reservation'
          controller.close( 'side-reservation');
        });

        $( '.main-wrap-content, .reservation-btn_wrapper' ).on( 'click', function ( event ) {
            controller.close( 'side-reservation');
        });

        // FIX SCROLL
        // when sidebar opening
        $( controller.events ).on( 'opening', function ( event, id ) {
          //$('.video-landing').removeClass('add-scroll');
          $('.video-landing').addClass('no-scroll');
          $('.html-root').addClass('no-scroll');

          // hide reservation button
          $('.video-landing .reservation-btn').addClass('hide-reservation-btn');
          
          // disable scroll fullPage
          if($('.full-page-landing').length){
              $.fn.fullpage.setAllowScrolling(false);
              $.fn.fullpage.setKeyboardScrolling(false);
          }
        });

        // when sidebar opening
        $( controller.events ).on( 'closing', function ( event, id ) {
          //$('.video-landing').addClass('add-scroll');
          $('.video-landing').removeClass('no-scroll');
          $('.html-root').removeClass('no-scroll');

          // show reservation button
          $('.video-landing .reservation-btn').removeClass('hide-reservation-btn');

          // disable scroll fullPage
          if($('.full-page-landing').length){
              $.fn.fullpage.setAllowScrolling(true);
              $.fn.fullpage.setKeyboardScrolling(true);
          }
        });

    }

    $('.testimonials-3-items-slider').slick({
      infinite: false,
      slidesToShow: 3,
      slidesToScroll: 1,
      swipe: false,
      responsive: [
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 767,
            settings: {
                slidesToShow: 1,
                arrows: false,
                dots: true,
                swipe: true,
            }
          }
        ]
    });

    // HOME 7 =======================================

    // GALLERY
    if($('.gallery-filter-content').length){
        $('.gallery-filter-content').slickLightbox({
            itemSelector: '.shuffle-item--visible .gallery-link.wooden-border'
        });
    }

    // Modal close
    $('.modal-close').on('click' , function(){
        $('#reservationModal').modal('hide')
    });

    $('.testimonials-slider-wrap').slick({
      infinite: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      swipe: false,
      responsive: [
          {
            breakpoint: 800,
            settings: {
              arrows: false,
              dots: true,
              swipe: true,
            }
          }
        ]
    });

    // GOOGLE MAP =================================
    if($('#blackAndWhiteMap').length){

        var map;

        function initMap() {
            map = new google.maps.Map(document.getElementById('blackAndWhiteMap'), {
                center: {lat: 40.710683, lng: -74.007180},
                zoom: 12,
                zoomControl: false,
                disableDefaultUI: true,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.LEFT_CENTER
                },
                styles: [{"featureType":"administrative","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"saturation":-100},{"lightness":"50"},{"visibility":"simplified"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"lightness":"30"}]},{"featureType":"road.local","elementType":"all","stylers":[{"lightness":"40"}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]},{"featureType":"water","elementType":"labels","stylers":[{"lightness":-25},{"saturation":-100}]}]
            });
            var icon = {
                url: "../img/map_marker.png",
                anchor: new google.maps.Point(25,50),
                scaledSize: new google.maps.Size(60,60)
            }
            var marker = new google.maps.Marker({
                position: {lat: 40.710683, lng: -74.007180},
                map: map,
                title: 'Tattoo studio Ink Tattoo',
                animation: google.maps.Animation.BOUNCE,
                icon: icon,
            });
            // Keep the center centered on window resize
            google.maps.event.addDomListener(window, "resize", function() {
                var center = map.getCenter();
                google.maps.event.trigger(map, "resize");
                map.setCenter(center);
                });
        }
        initMap();
    }
});


//////// gallery

$( window ).on( "load", function() {
    if ($('#gallery-content').length) {
        var Shuffle = window.shuffle;

        var myShuffle = new Shuffle(document.getElementById('gallery-content'), {
            itemSelector: '.gallery-item',
            sizer: '.gallery-item',
            speed: 400,
            easing: 'ease',

        });

        myShuffle.update();

        $('#gallery-filter a').on('click' , function(){
            $('#gallery-filter a').removeClass('active');
            $(this).addClass('active');
            var catName = $(this).attr('data-group');

            myShuffle.filter(catName, shuffle);
            myShuffle.update();
        });

        if($('.gallery-section').length){
           var catName = $('.gallery-filter-nav a.active').attr('data-group');

            myShuffle.filter(catName, shuffle);
            myShuffle.update(); 
        }
            // Gallery modal

        $('.gallery-content').slickLightbox({
            itemSelector: '.gallery-item:not(.shuffle-item--hidden)'
          });
    }

    if ($(window).width() >= 992) {
        if ($('.rellax').length) {
            var rellax = new Rellax('.rellax');

        }     
    } 

    if ($('#menu-grid').length) {
        var Shuffle = window.shuffle;

        var myShuffle = new Shuffle(document.getElementById('menu-grid'), {
            itemSelector: '.menu-grid_item',
            sizer: '.menu-grid_item',
            speed: 400,
            easing: 'ease',

        });
        myShuffle.update();

        $('.menu-filter_menu a').on('click' , function(){
            $('.menu-filter_menu a').removeClass('active');
            $(this).addClass('active');
            var catName = $(this).attr('data-group');

            myShuffle.filter(catName, shuffle);
            myShuffle.update();
            
        });
    }
})