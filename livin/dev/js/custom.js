jQuery(function ($) {
    if (typeof $.fn.slick === "function") {
        $(".js-simple-slider").slick({
            slidesToShow: 1,
            dots: true,
            arrows: false,
            fade: true,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        adaptiveHeight: true,
                    }
                },
            ]
        });
        $(".js-partners-list").slick({
            arrows: false,
            slidesToShow: 5,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 5,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1,
                        variableWidth: true,
                        centerMode: true,
                        centerPadding: '20%'
                    }
                },
            ]
        });
        $(".js-partners-list-options").slick({
            arrows: false,
            slidesToShow: 5,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1,
                        variableWidth: true,
                        centerMode: true,
                        centerPadding: '20%'
                    }
                },
            ]
        });
        $(".js-cards-slider").slick({
            arrows: false,
            slidesToShow: 5,
            slidesToScroll: 2,
            infinite: true,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 4,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1,
                        centerMode: true,
                        centerPadding: '30px'
                    }
                },
            ]
        });
        $(".js-cards-post-slider").slick({
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 2,
            infinite: true,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 4,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1,
                        centerMode: true,
                        centerPadding: '30px'
                    }
                },
            ]
        });
        $(".js-info-groups-list").slick({
            arrows: false,
            slidesToShow: 3,
            dots: true,
            slidesToScroll: 2,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        centerMode: true,
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        centerMode: true
                    }
                },
            ]
        });
        $(".js-review-slider").slick({
            arrows: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        dots: true
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        dots: true
                    }
                },
            ]
        });
        $(".js-donate-boxes").slick({
            arrows: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            /* autoplay: true,*/
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 1,
                        dots: true,
                        centerMode: true,
                        centerPadding: "20%"
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        dots: true,
                        centerMode: true,
                        centerPadding: "10%"
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1,
                        dots: true,
                        centerMode: true,
                        centerPadding: "20px"
                    }
                },
            ]
        });

        $(".js-contentreview-boxes").slick({
            arrows: true,
            prevArrow:"<button type='button' class='btn-review-slider slick-prev pull-left'><</button>",
            nextArrow:"<button type='button' class='btn-review-slider slick-next pull-right'>></button>",
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 1,
                        dots: true,
                        centerMode: true,
                        centerPadding: "20%"
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        dots: true,
                        centerMode: true,
                        centerPadding: "10%"
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1,
                        dots: true,
                        centerMode: true,
                        centerPadding: "20px"
                    }
                },
            ]
        });
        $(".js-arrivals-slider").slick({
            arrows: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            dots: true,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow:2,
                        dots: true,
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1,
                        dots: true,
                    }
                },
            ]
        });
        $(".js-blog-news-slider").slick({
            arrows: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            dots: true,
            fade: true,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {

                    }
                },
            ]
        });
        $(".js-rel-articles-list").slick({
            arrows: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 2,
                        dots: true,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        adaptiveHeight: true,
                        dots: true,
                    }
                },
            ]
        });
        
        $(".js-insta-slider").slick({
            arrows: false,
            variableWidth: true,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1,
                        centerMode: true,
                        centerPadding: "20%"
                    }
                },
            ]
        });
        $(".js-spread-message-slider").slick({
            arrows: false,
            variableWidth: true,
            autoplay: true
        });
        $('.js-product-slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.js-product-slider-nav'
        });
        $('.js-product-slider-nav').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: false,
            asNavFor: '.js-product-slider-for',
            focusOnSelect: true
        });
        $(".js-social-list-donate").slick({
            variableWidth: true,
            slidesToShow: 6,
            arrows: false,
            autoplay: false,
            responsive: [
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 3,
                        autoplay: true,
                    }
                },
            ]
        });
        $(".js-school-logos").slick({
            variableWidth: true,
            slidesToShow: 6,
            arrows: false,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 4,
                    }
                },
            ]
        });
    }

    // animation
    let scrolled = $(window).scrollTop();
    let windowHeight = $(window).height();

    function moveY(){
        $(".translate-down-anim").each(function(){
            eachSpeed = $(this).data("speed") ? $(this).data("speed") : "0.6";
            let yPos = -1*eachSpeed*($(this).offset().top - scrolled);
            if($(this).offset().top - scrolled < 1*windowHeight && $(this).offset().top - scrolled > -1*windowHeight){
                $(this).css({'transform' : 'translateY(' + 0.3*yPos +'px)'});
            }
        });
        $(".translate-up-anim").each(function(){
            eachSpeed = $(this).data("speed") ? $(this).data("speed") : "0.6";
            let yPos = eachSpeed*($(this).offset().top - scrolled);
            if($(this).offset().top - scrolled < windowHeight && $(this).offset().top - scrolled > -1*windowHeight){
                $(this).css({'transform' : 'translateY(' + 0.3*yPos +'px)'});
            }
        });
    }

    function animEach(isLoading){
        $('.animate-children').each(function () {
            $(this).children().each(function (i) {
                if(isLoading){
                    $(this).css("transition-delay", 0.1 * i + "s");
                }
                let eachImgOffsetTop = $(this).offset().top;
                let eachHeight = $(this).height();
                if (eachImgOffsetTop - scrolled < windowHeight - 30 && eachImgOffsetTop - scrolled + eachHeight > 20) {
                    $(this).addClass("complete");

                    $(this).find('[data-count-up]').each(function(){
                        $(this).prop('Counter', $(this).data('min')).animate({
                            Counter: $(this).data('max')
                        }, {
                            duration: 2000,
                            easing: 'swing',
                            step: function (now) {
                                $(this).text(Math.ceil(now));
                            }
                        });
                    });
                }
            });
        });
    }
    animEach(true);
    moveY();

    $(window).scroll(function () {
        scrolled = $(this).scrollTop();
        animEach(false);
        moveY();
    });


    /**   toggle menu */
    $('.js-menu-toggle').on('click', function (e){
        e.preventDefault();
        $('body').toggleClass('open');
    });
    $('.js-mobile-menu .mm-toggle-submenu').on('click', function (e) {
        e.preventDefault();
        $(this).toggleClass('active').parent().next('.mm-content').slideToggle();
    });

    /**   Page Scrolling */
    $("a[href*='#target']").click(function (e) {
        e.preventDefault();
        let elementClick = $(this).attr("href");
        elementClick = elementClick.split("#");
        elementClick = '#'+elementClick[1];
        if($(elementClick).length){
            $('body,html').animate({
                scrollTop: $(elementClick).offset().top
            }, 600);
        }
    });

    /**  mega menu */
    let mmLinkThis = null;
    $('.js-mm-link').hover(function () {
        mmLinkThis = this;
        $(mmLinkThis).addClass('active');
    }, function () {
        $(mmLinkThis).removeClass('active');
    });

   $(document).on("change",".parentCat,.catChild,.pDuring",function(event) {      
        window.location.href = $(this).val();
   });

   $('.news-updates-sidebar .widget > ul').addClass('social social-circle list-unstyled d-flex justify-content-center justify-content-md-start justify-content-lg-between');
    

    setTimeout(function(){        
        $('.mobile-menu .mm-submenu li').each(function(){
            $('a',this).removeClass('mm-link');
            $('div',this).removeClass('mm-content');
        });

        $('.footer-widget-area .col-head').each(function(){
            $('a:first-child',this).addClass('head_a');      
            $('ul li a',this).removeClass('head_a');      
        });

        $(document).on("click",".footer-widget-area .head_a",function(event) {

            event.preventDefault();

            if($(window).width() <= 991){
                $(this).toggleClass("is-active");
                $(this).next("ul").slideToggle();
            }

        });      
    },1000);

    setTimeout(function(){
        $('ol.breadcrumb li:last-child').each(function(){
            $(this).addClass('active');
            var text = $('a',this).text();
            if(text){
                $(this).html("<span>"+text+"</span>");    
            }
            
       });  
       var ii = 0;
       $('body.archive ol.breadcrumb li,body.single ol.breadcrumb li').each(function(){
            if(ii == 2){
                $(this).after('<li class="breadcrumb-item"><a href="/blog/">Blog</a></li><li><span class="breadcrumb-line"></span></li>');
            }
            ii++;
       });
    },200);
    

    $('.has_custom_nav_head').on('click', function (e) {
        e.preventDefault();
        $('.has_childer_jm',this).toggleClass('active').slideToggle();
    });

    /** horizontal scrolling animation **/
    $(".section-overlay-animation").each(function (){
        let eachOverlay = $(this),
            sectHeight = eachOverlay.height(),
            spanHeight = eachOverlay.find("span").outerHeight(),
            eachRow = eachOverlay.children(".text-row").last();

        for(var i = 0; i < Math.ceil(sectHeight/spanHeight + 1); i++){
            let num = Math.floor(Math.random() * 45) + 20;
            eachRow.clone().css("--anim-duration", num + 's').insertAfter(eachRow);
        }
    });

    /*** footer accordion **/
    if($(window).width() <= 767){
        $(".footer-widget-area .widget ul").hide();
        $(".footer-widget-area .sub-menu").hide();
    }else{
        $(".footer-widget-area .widget ul").show();
        $(".footer-widget-area .sub-menu").show();
    }
    $(window).resize(function(){
        if($(this).width() <= 767){
            $(".footer-widget-area .widget ul").hide();
            $(".footer-widget-area .sub-menu").hide();
            $(".footer-widget-area .widget h6").removeClass("is-active");
            $(".info-groups-list").addClass("js-info-groups-list");

        }else{
            $(".footer-widget-area .widget ul").show();
            $(".footer-widget-area .sub-menu").show();
            $(".info-groups-list").removeClass("js-info-groups-list");
        }
    });
    $(".footer-widget-area .widget h6").click(function(){
        if($(window).width() <= 767){
            $(this).toggleClass("is-active");
            $(this).next("ul").slideToggle();
        }
    });

    $(".header-top .btn-search").on("click", function (){
        $(this).parents(".header-top").toggleClass("search-form-visble");
        $(this).siblings(".search-form").find("input[type=search]").focus();
    });
    $(".header-content, .page-content, .footer").click(function (){
        $(".header-top").removeClass("search-form-visble");
    });

    /** shop articles **/
    let articlesLink = null;
    $('.by-category-section.v2 .by-shop-item').hover(function () {
        articlesLink = $(this).find('.by-shop-content');
        $(articlesLink).stop().slideDown();
    }, function () {
        $(articlesLink).stop().slideUp();
    });


    /*if (navigator.platform === 'MacIntel' || navigator.platform === 'MacPPC') {
        $("body").addClass("using-mac-plathform");
    }else {
        $("body").addClass("using-another-plathform");
    }*/

    //show hide comment section
    $(".show-comment").click(function(e){
        e.preventDefault();
        $(this).next('#disqus-comment').fadeIn(600);
    });

    // animate changing of words
    $(window).on("load", dataWord);

    //pricing script
    $(window).on("load", pricingOptions);

    $('.menu-item-has-megamenu').children('a[href="#"]').click(function(e){
        e.preventDefault();
    });
});

//show breadcrumb scroller if breadcrumb is too long
jQuery(document).on('ready', function(){    
    breadcrumbScroller();

    let count = 1;
    jQuery('.breadcrumb-nav').on('click', '.breadcrumb-scroller', function(){
        let $this = jQuery(this);
        let $breadcrumb = $this.prev('.breadcrumb');
        let len = $breadcrumb.find('li.breadcrumb-item').length - 1;
        
        if( count < len ) {
            let cur_pos_left = $breadcrumb.position().left * -1;
            let pos_left = $breadcrumb.find('li.breadcrumb-item').eq(count).outerWidth();

            $this.attr('data-count', count++);
            $breadcrumb.animate({ left: -(pos_left + cur_pos_left) }, 500);
        } else {
            $breadcrumb.animate({ left: 0 }, 500);
            count = 1;
        }
    });
});

jQuery(window).on('resize', function(){    
    breadcrumbScroller();
});

function breadcrumbScroller() {
    let $ = jQuery;

    if( $('.breadcrumb-nav').length > 0 ) {
        let breadcrumb_nav_width = $('.breadcrumb-nav').width();
        let breadcrumb_scroller = $('.breadcrumb-nav').find('.breadcrumb-scroller').length;
        let total_width = 0;

        $('.breadcrumb-nav').find('li').each(function( index ){
            let li_width = $(this).outerWidth();
            
            total_width += li_width;
        });

        if( total_width > breadcrumb_nav_width ) {
            if( breadcrumb_scroller > 0 ) {
                //no scroller
            } else {
                $('.breadcrumb-nav').append('<span class="breadcrumb-scroller"></span>');
            }
        } else {
            $('.breadcrumb-nav').find('.breadcrumb-scroller').remove();
        }
    } 
}

//signup modal
jQuery(document).ready(function(){    
	var livin_cookie = getCookie("livin_modal");

		if( "" == livin_cookie ){
			jQuery('#blockContentModal').modal('show');
		} 
        setCookie("livin_modal", 1, 60);
        
});

//set cookie
function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

//get  cookie
function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

function dataWord () {
    let $ = jQuery;

    $("[data-words]").attr("data-words", function(i, d){
      var $self  = $(this),
          $words = d.split(", "),
          tot    = $words.length,
          c      = 0; 
  
      // CREATE SPANS INSIDE SPAN
      for(var i=0; i<tot; i++) $self.append($('<span/>',{text:$words[i]}));
  
      // COLLECT WORDS AND HIDE
      $words = $self.find("span").hide();
  
      // ANIMATE AND LOOP
      (function loop(){
        $self.animate({ width: $words.eq( c ).width() });
        $words.stop().fadeOut().eq(c).fadeIn().delay(1000).show(0, loop);
        c = ++c % tot;
      }());
      
    });  
}

function pricingOptions() {
    let $ = jQuery;

    $('[data-donate]').click(function(e){
        e.preventDefault();

        let opt = $(this).data('donate');

        $('[data-donate]').removeClass('active');

        $(this).addClass('active');

        $('[data-opt]').addClass('d-none');

        $('[data-opt="'+ opt +'"]').removeClass('d-none');
    });

    $('[data-frequency]').change(function(){
        let el = $(this).data('frequency');
        let link = $(this).find('option:selected').val();

        $('[data-donatebtn="'+ el +'"]').attr('href', link);
    });
}

function hover(element) {
    var hoverImg = element.getAttribute('data-hoverimg');
    element.setAttribute('src', hoverImg);
}

function unhover(element) {
   var hoverOriginal = element.getAttribute('data-originalimg');
   console.log(hoverOriginal);
   element.setAttribute('src', hoverOriginal);
}
