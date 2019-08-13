//// preloader

$( window ).load(function() {
    $(".preloader").fadeOut('slow');
    $('body').click(function(){
        $(".preloader").fadeOut('slow');
    });
});


jQuery(document).ready(function($) {

    //////// datepicker date

    $('#reservation_date input').click(function(){
         $('#reservation_date ').data("DateTimePicker").show();
    });

     $('#reservation_time input').click(function(){
         $('#reservation_time ').data("DateTimePicker").show();
    });

    $('#reservation_date').datetimepicker({
        ignoreReadonly: true,
        locale: 'ru',
        icons: {
            previous: 'fa fa-caret-left',
            next: 'fa fa-caret-right',
        },
        format: 'DD/MM/YYYY'
    });
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

    /////// about -landing slider

    $('.about-slider-img').slick({
        arrows: false,
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 800,
        cssEase: 'cubic-bezier(.1,.43,.78,.08)'

    });
    $('.about-slider_text').slick({
        arrows: false,
        dots: false,
        speed: 800,
        cssEase: 'cubic-bezier(0.175, 0.885, 0.32, 1.05)',
        slidesToShow: 1,
        slidesToScroll: 1,

    });
    $('.slider-arrows.-about .arrow.-prev').click(function() {
        $('.about-slider-img').slick('slickPrev');
        $('.about-slider_text').slick('slickPrev');
    });
    
    $('.slider-arrows.-about .arrow.-next').click(function() {
        $('.about-slider-img').slick('slickNext');
        $('.about-slider_text').slick('slickNext');
    });

    ////////////// tabMenu slider

    $('.tabMenu-slider').slick({
        arrows: false,
        dots: true,
        fade: true,
    });
    $('.tabMenu a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $('.tabMenu-slider').each(function() {
                $(this).slick("getSlick").refresh();
            });
        })
        // gallery slider 

    if ($('.gallery-landing-slider').length) {
        $('.gallery-landing-slider').gridnav({
            navL: '#gallery-landing_prev',
            navR: '#gallery-landing_next',
            rows: 2,
            type: {
                mode: 'disperse', // use def | fade | seqfade | updown | sequpdown | showhide | disperse | rows
                speed: 500, // for fade, seqfade, updown, sequpdown, showhide, disperse, rows
                easing: '', // for fade, seqfade, updown, sequpdown, showhide, disperse, rows   
                factor: '', // for seqfade, sequpdown, rows
                reverse: '' // for sequpdown
            }
        });
    }

    $('.gallery-landing-slider a').click(function(){
        var imgShowedModal = $(this).find('.resp_img').css('background-image');
        var patt = /\"|\'|\)/g;
        var imgPath = '/img/' + imgShowedModal.split('/').pop().replace(patt, '');
        var insertImg = $('.gallery_modal_img').attr("src", imgPath);
        $('#gallery_modal').modal();
    });  

      $("#gallery_modal").on('show.bs.modal', function(event){
        if($('.gallery-landing-slider').length){
            var imgArray = [];
            imgArray = $('.gallery-landing-slider .tj_gallery .resp_img').map(function(){
                var cssImg = $(this).css('background-image');
                var patt = /\"|\'|\)/g;
                var imgPath = '/img/' + cssImg.split('/').pop().replace(patt, '');
                return imgPath;

            }).get();
        }
        console.log(imgArray);
        var showedImg = $('#gallery_modal').find('img').attr('src');
        var imgIndex = imgArray.indexOf(showedImg);

        var count = imgIndex;

        $('.gallery_modal-arrows .next').click(function(){
            if(count + 1 == imgArray.length){
                $('#gallery_modal img').attr('src' , imgArray[0]);
                count = -1;
            } else {
                $('#gallery_modal img').attr('src' , imgArray[count+1]);
            }
            count++;
        });

        $('.gallery_modal-arrows .prev').click(function(){
            if(count === 0){
                $('#gallery_modal').find('img').attr('src' , imgArray[imgArray.length - 1]);
                count = imgArray.length;
            } else {
                $('#gallery_modal').find('img').attr('src' , imgArray[count - 1]);
            }
            count--;
        });
      });
    ///// reviews slider
    $('.review-slider.-landing').slick({
        slidesToShow: 1,
        dots: false,
        arrows: true,
        fade: true,
        nextArrow: '<span class="arrow -next"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>',
        prevArrow: '<span class="arrow -prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>',
    });


    /////////// smooth scroll


    $('.header a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if ($(window).width() <= 991) {
                $('.navbar-toggle').click();
                $('.drawer-hamburger').click();
            }
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 75
                }, 1000);
                return false;
            }
        }
    });
    //drawer 
    if ($('.drawer').length) {
        $('.drawer').drawer();
    }




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


    if ($(window).width() >= 992) {
        if ($('.rellax').length) {
            var rellax = new Rellax('.rellax');

        }
        var headerHeight = $('.header.-landing').outerHeight();
        $(window).on('scroll', function() {
            var fixedHeader;
            if ($(window).scrollTop() >= 1200) {
                $('.header.-fixed').css('top', 0 + 'px');
                $('.header-cap').css('height', headerHeight + 'px');
                $('.header.-landing').addClass('-fixed');

            } else if ($(window).scrollTop() >= 1000){
                $('.header.-fixed').css('top', -100 + 'px');
            } else if($(window).scrollTop() <= 300){
                $('.header.-fixed').css('top', -100 + 'px');
                $('.header.-landing').removeClass('-fixed');
                $('.header-cap').css('height', 0 + 'px');

            }
        });
        
    } else {

        $('.header.-landing').addClass('drawer-nav');
        if ($('.drawer_landing').length){
            $('.drawer_landing').drawer();
        }
    }

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

    ///////// scroll top
    $('.scroll_top').click(function(){
        $('html, body').animate({scrollTop : 0}, 1000);
        return false;
    });


});
