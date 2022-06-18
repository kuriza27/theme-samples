/**
 * Dynamic CPT loading and filter
 */
jQuery(document).ready(function ($) {

    let $parent = $('[data-form-filter]');
    let $form = $parent.find('form');
    let filter_criteria = {};
    let ajax_admin = $form.attr('action');
    let cpt = $form.attr('data-cpt');
    let action = $form.attr('data-action');
    let $output_html = $parent.find('[data-output="grid"]');
    let $output_list = $parent.find('[data-output="list"]');
    let post_number = $parent.data('form-filter');
    let url_param = {};

    loadMore = {
        cat: '',
        filter: '',
        tax: '',
        e: 1,
        isFilter: '',
        isPaginate: false,
        filter_criteria: {},
        date: '',
        empty: function () {
            return `<div class="no-entry"><strong>No Entry Found.</strong></div>`;
        },
        load: function () {

            var data = {
                'action': action,
                'postType': cpt,
                'posts_per_page': post_number,
                'pg': loadMore.e,
                'isPaginate': loadMore.isPaginate,
                'date': loadMore.date
            };

            if( $form.attr('data-columns') ) {
                data['columns'] = $form.attr('data-columns');
            }

            if (loadMore.cat) {
                data.cat = loadMore.cat;
            }

            if (loadMore.filter) {
                data.filter = loadMore.filter;
            }
            if (loadMore.tax) {
                data.tax = loadMore.tax;
            }
            if ($.isEmptyObject(loadMore.filter_criteria) === false) {
                data.filter_criteria = loadMore.filter_criteria;
            }

            $.post(ajax_admin, data, function (data) {

                if (data.entries) {

                    if (loadMore.isFilter && !loadMore.isPaginate) {
                        $output_html.html(data.entries);
                        $output_list.html(data.entries_list);

                        if (loadMore.filter != '') {
                            $parent.find('.post-type-results-info').html('Your search has returned <strong>' + data.total + ' results</strong>').show();
                        } else {
                            $parent.find('.loading-pagination a').hide();
                        }
                    } else {
                        $output_html.append(data.entries);
                        $output_list.append(data.entries_list);
                    }

                    $parent.find('.loading-pagination a').show();

                } else {
                    if (loadMore.isFilter) {
                        $output_html.html(loadMore.empty());
                        $output_list.html(loadMore.empty());
                        $parent.find('.post-type-results-info').hide();
                    }
                }
                if (data.total < 9) {
                    $parent.find('.loading-pagination a').hide();
                }
                $parent.find('.list-main-container').removeClass('loading-jm');

                if ($output_html.children('div').length >= data.total) {
                    $parent.find('.loading-pagination a').hide();
                }

            }, 'json');

        }
    };

    var currPage = 1;

    $parent.on("click", 'a.next', (e) => {
        e.preventDefault();
        $parent.find('.list-main-container').addClass('loading-jm');

        if( $form.find('input[type="hidden"]').length ) {
            let name = $form.find('input[type="hidden"]').attr('name');
            let val = $form.find('input[type="hidden"]').val();

            filter_criteria[name] = val;
        }

        $form.find('select[multiple]').each(function () {
            let n = $(this).attr("name").replace(/[\[\]']+/g, '');
            if ($(this).val()) {
                filter_criteria[n] = $(this).val();
            }
        });

        myThis = $(e.currentTarget);
        loadMore.e = ++currPage;
        loadMore.isPaginate = 1;
        loadMore.filter_criteria = filter_criteria;
        loadMore.load();
    });

    $parent.on("click", '.search-input-btn', (e) => {
        e.preventDefault();
        let $this = $(e.currentTarget);
        let val = $this.prev('input[name="title"]').val();
        $parent.find('input[name="title"]').val(val);

        $parent.find('.list-main-container').addClass('loading-jm');

        if( $form.find('input[type="hidden"]').length ) {
            let name = $form.find('input[type="hidden"]').attr('name');
            let val = $form.find('input[type="hidden"]').val();

            filter_criteria[name] = val;
        }

        currPage = 1;
        loadMore.e = currPage;
        loadMore.isFilter = 1;
        loadMore.filter = val;
        loadMore.isPaginate = 0;
        loadMore.filter_criteria = filter_criteria;
        loadMore.load();

        if (!val) {
            $parent.find('.post-type-results-info').hide();
        }        

        if ($form.data('urlfilter')) {
            let param = [];

            $form.find('select').each(function () {
                let n = $(this).attr("name").replace(/[\[\]']+/g, '');
                if ($(this).val()) {
                    url_param[n] = $(this).find('option:selected').toArray().map(item => item.text.replace(/\s/g, '+')).join();
                }
            });

            if ($form.find('input[name="title"]').val()) {
                url_param['title'] = $form.find('input[name="title"]').val();
            } else {
                delete url_param.title;
            }

            for (var key in url_param) {
                if (url_param.hasOwnProperty(key)) {
                    if (url_param[key]) {
                        param.push(key + '=' + url_param[key]);
                    }
                }
            }

            window.history.replaceState(null, null, '?' + param.join('&'));
        }
    });

    $parent.on("change", 'select', (e) => {
        e.preventDefault();
        $this = $(e.currentTarget);

        var val = $this.val();
        $parent.find('.list-main-container').addClass('loading-jm');        

        if( $this.data('redirect') ) {
            window.location.href = val;
        }

        $form.find('select[multiple]').each(function () {
            let n = $(this).attr("name").replace(/[\[\]']+/g, '');
            if ($(this).val()) {
                filter_criteria[n] = $(this).val();
            }
        });

        let name = $this.attr("name").replace(/[\[\]']+/g, '');
        //filter_criteria[name] = val;

        if( $form.find('input[type="hidden"]').length ) {
            let name = $form.find('input[type="hidden"]').attr('name');
            let val = $form.find('input[type="hidden"]').val();

            filter_criteria[name] = val;
        } 

        if( name == 'artform' && $this.attr('data-autoselect') ) {
            if( $this.attr('data-select') == 'selected' && val.length < 1 ) {
                $this.attr('data-select', '');
            } else {
                if( filter_criteria[name].indexOf( $this.attr('data-autoselect') ) === -1 )
                    filter_criteria[name].push($this.attr('data-autoselect'));
                $this.val(filter_criteria[name]);
                $this.attr('data-select', 'selected');
                $this.multiselect('refresh');
            }
        }

        currPage = 1;
        loadMore.e = currPage;
        loadMore.isFilter = 1;
        loadMore.isPaginate = 0;
        loadMore.filter_criteria = filter_criteria;
        loadMore.load();

        if ($form.data('urlfilter')) {
            let param = [];

            $form.find('select').each(function () {
                let n = $(this).attr("name").replace(/[\[\]']+/g, '');
                if ($(this).val()) {
                    url_param[n] = $(this).find('option:selected').toArray().map(item => item.text.replace(/\s/g, '+')).join();
                }
            });

            if ($form.find('input[name="title"]').val()) {
                url_param['title'] = $form.find('input[name="title"]').val();
            } else {
                delete url_param.title;
            }

            for (var key in url_param) {
                if (url_param.hasOwnProperty(key)) {
                    if (url_param[key]) {
                        param.push(key + '=' + url_param[key]);
                    }
                }
            }

            window.history.replaceState(null, null, '?' + param.join('&'));
        }
    });

    $parent.on("click", '[data-view]', function (e) {
        e.preventDefault(); console.log('aw');

        let view = $(this).data("view");

        if (view == 'list') {
            $('.post-filter-view-' + view).removeClass('d-none');
            $('.post-filter-view-grid').addClass('d-none');
        } else {
            $('.post-filter-view-' + view).removeClass('d-none');
            $('.post-filter-view-list').addClass('d-none');
        }
    });

    $parent.on("change", 'input[type="month"]', function (e) {
        let event_date = $(this).val();

        $parent.find('input[type="month"]').val(event_date);

        $parent.find('.list-main-container').addClass('loading-jm');

        if( $form.find('input[type="hidden"]').length ) {
            let name = $form.find('input[type="hidden"]').attr('name');
            let val = $form.find('input[type="hidden"]').val();

            filter_criteria[name] = val;
        }

        currPage = 1;
        loadMore.e = currPage;
        loadMore.isFilter = 1;
        loadMore.isPaginate = 0;
        loadMore.filter_criteria = filter_criteria;
        loadMore.date = event_date;
        loadMore.load();
    });

    $parent.on("change", 'input[type="month"]', function (e) {
        let application_approved_date = $(this).val();

        $parent.find('input[type="month"]').val(application_approved_date);

        $parent.find('.list-main-container').addClass('loading-jm');

        if( $form.find('input[type="hidden"]').length ) {
            let name = $form.find('input[type="hidden"]').attr('name');
            let val = $form.find('input[type="hidden"]').val();

            filter_criteria[name] = val;
        }

        currPage = 1;
        loadMore.e = currPage;
        loadMore.isFilter = 1;
        loadMore.isPaginate = 0;
        loadMore.filter_criteria = filter_criteria;
        loadMore.date = application_approved_date;
        loadMore.load();
    });

});

jQuery(document).ready(function () {
    //load more gallery images
    $('[data-gallery="loadGallery"]').click(function () {
        let $this = $(this);
        let offset = $this.attr('data-offset');
        let func = $this.data('gallery');
        let ids = $this.attr('data-ids');
        let ajax_admin = $this.attr('data-ajax');
        let elem_id = $this.attr('data-elem');
        let $elem = $('#' + elem_id).find('.grid');

        $this.addClass('loading');

        let data = {
            'action': func,
            'offset': offset,
            'ids': ids
        };

        $.post(ajax_admin, data, function (data) {
            if (data.images) {
                let grid = '';
                var i =  parseInt(offset) + 1;
                data.images.forEach(function (item, index) {
                    grid += '<div class="grid-item" onclick="openModal();currentSlide('+i+')"'+'"><img width="' + item[1] + '" height="' + item[2] + '" src="' + item[0] + '"></div>';
                    i++;
                });
                $html = $(grid);

                $elem.masonry({ itemSelector: '.grid-item' }).append($html).masonry('appended', $html);

                $this.attr('data-offset', parseInt(offset) + 8);
            }
            if (data.max) {
                $this.hide();
            }

            $this.removeClass('loading');
        }, 'json');
    });

    //load more cards
    $('[data-loadmore="cards"]').click(function(e){
        e.preventDefault();
        
        let $this = $(this);
        let $container = $this.prev('[data-loadmore="container"]');
        let max = $container.children().length;
        let limit = parseInt($this.attr('data-limit'));
        let start = parseInt($this.attr('data-offset'));
        let stop = start + limit;

        let $elems = $container.children().slice(start, stop);
        $this.attr('data-offset', stop);

        $elems.css('opacity', 0).show();
        $elems.animate({ 'opacity': 1 }, 500);
        
        if( stop > max ) {
            $this.remove();
        }
    });

    //Useful links modal popup
    $('.btn--useful-links').click(function(e){
        e.preventDefault();
        let modal_id = $(this).attr('data-target');
        let $modal = $(modal_id);
        let content = $(this).next().html();
        
        $modal.find('.modal-content-container').html(content);
    });

    //Load action ajax
    $('[data-action="loadFeaturedNewsCards"]').click(function(e){
        e.preventDefault();
        let $this = $(this);
        let action = $this.data('action');
        let ajax_admin = $this.data('ajax');

        $this.addClass('loading');

        if( action == 'loadFeaturedNewsCards' ) {
            let offset = parseInt($this.attr('data-offset'));
            let ids = $this.attr('data-ids');
            let elem = $this.attr('data-elem');
            let limit = parseInt($this.attr('data-limit'));
            let $container = $('[data-container="'+ elem +'"]');

            let data = {
                'action': action,
                'offset': offset,
                'ids': ids,
                'limit': limit
            };
    
            $.post(ajax_admin, data, function (data) { console.log(data);
                if( data.count ) {                    
                    $container.append( data.items );
    
                    $this.attr('data-offset', (offset + limit));
                } else {
                    alert('An error occured. Please refresh the page and try again.');
                }

                if( data.max ) {
                    $this.remove();
                }
    
                $this.removeClass('loading');
            }, 'json');
        }
    });

    //Load search applicant action ajax
    $('[data-action="loadSearchApplicantsCards"]').click(function(e){
        e.preventDefault();
        let $this = $(this);
        let action = $this.data('action');
        let ajax_admin = $this.data('ajax');

        $this.addClass('loading');

        if( action == 'loadSearchApplicantsCards' ) {
            let offset = parseInt($this.attr('data-offset'));
            let ids = $this.attr('data-ids');
            let elem = $this.attr('data-elem');
            let limit = parseInt($this.attr('data-limit'));
            let $container = $('[data-container="'+ elem +'"]');

            let data = {
                'action': action,
                'offset': offset,
                'ids': ids,
                'limit': limit
            };
    
            $.post(ajax_admin, data, function (data) { console.log(data);
                if( data.count ) {                    
                    $container.append( data.items );
    
                    $this.attr('data-offset', (offset + limit));
                } else {
                    alert('An error occured. Please refresh the page and try again.');
                }

                if( data.max ) {
                    $this.remove();
                }
    
                $this.removeClass('loading');
            }, 'json');
        }
    });
    //Add scroller for breadcrumbs if too long
    $(window).on('load', function(){
        positionBreadcrumbScroller();

        let count = 1;
        $(document).on('click', '.breadcrumb--scroller', function(){
            let $this = $(this);
            let $breadcrumb = $this.prev('.breadcrumb');
            let len = $breadcrumb.find('li').length - 1;
            
            if( count < len ) {
                let cur_pos_left = $breadcrumb.position().left * -1;
                let pos_left = $breadcrumb.find('li').eq(count).outerWidth();

                $this.attr('data-count', count++);
                $breadcrumb.animate({ left: -(pos_left + cur_pos_left) }, 500);
            } else {
                $breadcrumb.animate({ left: 0 }, 500);
                count = 1;
            }
        });
    });

    $(window).on('resize', function(){
        positionBreadcrumbScroller();
    });

    // Clone key dates for mobile view
    if( $('.clone-to-mobile-sidebar').length > 0 ) {
        let $clone = $('.clone-to-mobile-sidebar').clone();

        $clone.addClass( 'mobile--keydates d-lg-none d-block' );
        $('.page-single-content').prepend( $clone );
    }

    if( $('.accordion').length > 0 ) {
        $('.accordion').each(function(){
            let $this = $(this);

            if( !$this.parent().hasClass('card-body') ) {
                let $expand = $('<a href="#" class="accordion--expand-all">Expand all content <span>+</span></a>');

                if( $this.parent().hasClass('accordion-list') ) {
                    $this.parent().addClass('position-relative');
                    $this.parent().prepend( $expand );
                } else {
                    $this.css('padding-top', '37px');
                    $elem = $this.wrap('<div class="position-relative"></div>');
                    $elem.prepend( $expand );
                }   
            }        
            
        });

        $(document).on( 'click', '.accordion--expand-all', function(e){
            e.preventDefault();
            let $parent = $(this).parent();

            if( $(this).hasClass('expanded') ) {
                $(this).removeClass('expanded').html('Expand all content <span>+</span>');

                $parent.find('.card').find('[aria-expanded]').attr('aria-expanded', false);
                $parent.find('.card').find('.collapse').removeClass('show');
            } else {
                $(this).addClass('expanded').html('Close all content <span>-</span>');

                $parent.find('.card').find('[aria-expanded]').attr('aria-expanded', true);
                $parent.find('.card').find('.collapse').addClass('show');
            }
        });
    }


    // acknowledgemnt padding responsive fix
    acknowledgementTopPadding();
    $(window).resize(function(){
        acknowledgementTopPadding();
    });


    //Load more content feed ajax
    $('[data-load="content_feed"]').on('click', function(e){
        e.preventDefault();

        let $this = $(this);
        let offset = parseInt($this.attr('data-offset'));
        let limit = parseInt($this.attr('data-limit'));
        let block_id = $this.attr('data-block');
        let count = offset + limit;

        let $container = $('[data-container="content_feed_'+ block_id +'"]');
        let total = $container.find('.feed-item').length;

        if( total <= (count) ) {
            $this.remove();
        }

        console.log( count );

        $container.find('.feed-item').slice( offset, offset + limit ).slideDown(200).animate({opacity: 1}, 300, function(){
            //$(this).removeClass('feed-hidden');
        });

        $this.attr('data-offset', count);
    });
});

function acknowledgementTopPadding() {
    let header_h = $('header.header > .header-top').outerHeight();
    let adminbar_h = $('#wpadminbar').length > 0 ? $('#wpadminbar').outerHeight() : 0;
    let total_h = header_h + adminbar_h + 30;

    $('.footer-wrapper-acknowledgement .page-content').css('padding-top', total_h);
}

function positionBreadcrumbScroller() {
    let side_width = $('.right-sidebar').length > 0 ? $('.right-sidebar').width() : 0;
    let side_inner_width = $('.right-sidebar > .placement-aside').outerWidth();
    let container_width = $('.breadcrumb-container > .container').width();
    let max_width = container_width - side_width;
    let total_width = 0;
    let $nav = $('<span class="breadcrumb--scroller"><span class="icon-chevron-thin-down"></span></span>');
    let pos_right = (side_width < side_inner_width ) ? side_width : side_inner_width;
    let win_width = $(window).width();    

    $('.breadcrumb').find('li').each(function( index ){
        let li_width = $(this).outerWidth();
        
        total_width += li_width;
    });

    if( win_width < 992 ) {
        if( total_width > win_width )
            pos_right = 0;
        else 
            $nav.css('display', 'none');
    }

    let scroller_len = $('.breadcrumb-container').find('nav').find('.breadcrumb--scroller').length == 1 ? 1 : 0;
    if( max_width < total_width && !scroller_len ) {
        $('.breadcrumb-container').find('nav').append($nav);
        $nav.css('right', pos_right);
    }
}

/*********** END ***********/


jQuery(function ($) {
    // mobile menu
    $('.js-mm-link, .js-close-submenu').on('click', function () {
        $(this).parents('.menu-item').toggleClass('active');
    });
    $('.js-menu-btn, .menu-toggle').on('click', function () {
        $('body').toggleClass('open');
    });

    // animation

    let scrolled = $(window).scrollTop();
    let windowHeight = $(window).height();
    function animEach(isLoading) {
        $('.animate-children').each(function () {
            $(this).children().each(function (i) {
                if (isLoading) {
                    $(this).css("transition-delay", 0.1 * i + "s");
                }
                let eachImgOffsetTop = $(this).offset().top;
                let eachHeight = $(this).height();
                if (eachImgOffsetTop - scrolled < windowHeight - 30 && eachImgOffsetTop - scrolled + eachHeight > 20) {
                    $(this).addClass("complete");
                } else {
                    $(this).removeClass("complete").attr('style', '');
                }
            });
        });
    }
    animEach(true);

    $(window).on('scroll', function () {
        scrolled = $(this).scrollTop();
        animEach(false);
    });

    function nl2br(str) {
        return str.replace(/(?:\r\n|\r|\n)/g, '<br>');
    }

    if (typeof $.fn.slick === "function") {
        $(".js-header-slider").slick({
            slidesToShow: 1,
            dots: true,
            autoplay: true,
            arrows: false,
            fade: true,
            adaptiveHeight: true
        });
        $(".js-content-slider").slick({
            slidesToShow: 1,
            dots: true,
            arrows: false,
            fade: true,
            adaptiveHeight: true
        });
        $(".js-events-slider").slick({
            slidesToShow: 1,
            dots: false,
            fade: true,
            prevArrow: "#slPrev",
            nextArrow: "#slNext",
        });
        $(".js-links-slider").slick({
            slidesToShow: 3,
            arrows: false,
            dots: true,
            autoplay: false,
            slidesToScroll: 3,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: false,
                        arrows: true,
                        prevArrow: '<button class="slick-prev slider-arrow--left"><span class="icon icon-chevron-thin-down"></span></button>',
                        nextArrow: '<button class="slick-next slider-arrow--right"><span class="icon icon-chevron-thin-down"></span></button>',
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false,
                        arrows: true,
                        prevArrow: '<button class="slick-prev slider-arrow--left"><span class="icon icon-chevron-thin-down"></span></button>',
                        nextArrow: '<button class="slick-next slider-arrow--right"><span class="icon icon-chevron-thin-down"></span></button>',
                    }
                }
            ]
        });
        $(".js-text-slider").slick({
            slidesToShow: 3,
            arrows: false,
            dots: true,
            autoplay: false,
            slidesToScroll: 3,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: false,
                        arrows: true,
                        prevArrow: '<button class="slick-prev slider-arrow--left"><span class="icon icon-chevron-thin-down"></span></button>',
                        nextArrow: '<button class="slick-next slider-arrow--right"><span class="icon icon-chevron-thin-down"></span></button>',
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false,
                        arrows: true,
                        fade: true,
                        prevArrow: '<button class="slick-prev slider-arrow--left"><span class="icon icon-chevron-thin-down"></span></button>',
                        nextArrow: '<button class="slick-next slider-arrow--right"><span class="icon icon-chevron-thin-down"></span></button>',
                    }
                }
            ]
        });
        $(".js-highlights-slider").slick({
            slidesToShow: 3,
            arrows: false,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        dots: true
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: true
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        fade: true,
                    }
                }
            ]
        });
    }
    $('[data-toggle="tooltip"]').tooltip()

    if (typeof $.fn.masonry === "function") {
        $('.grid').masonry({
            itemSelector: '.grid-item',
        });
    }

    $(".card-img-faci").click(function () {
        $(this).parent(".facilitator-box").siblings(".facilitator-data").clone().appendTo("#faciliatorInfo");
        $("#faciliatorInfo h3").html($("#faciliatorInfo h3").text().replace(/\n/g, "<br />"));
    });

    $(".card-img-showcase").click(function () {
        $(this).parent(".card-showcase").siblings(".facilitator-data").clone().appendTo("#faciliatorInfo");
        $("#faciliatorInfo h3").html($("#faciliatorInfo h3").text().replace(/\n/g, "<br />"));
    });

    $(".podcast-button").click(function () {
        $(".podcast-data").clone().appendTo("#faciliatorInfo");
        $("#faciliatorInfo h3").html($("#faciliatorInfo h3").text().replace(/\n/g, "<br />"));
    });

    $("#faciliatorModal").on("hide.bs.modal", function () {
        $(this).find("#faciliatorInfo").html("");
    });

    $(document).delegate(".modal-nav a", "click", function () {
        let hboxId = $(this).data("hbox");
        $("#faciliatorInfo > *").fadeOut().remove();
        $("#" + hboxId).find(".facilitator-data").clone().appendTo("#faciliatorInfo");
        $("#faciliatorInfo h3").html($("#faciliatorInfo h3").text().replace(/\n/g, "<br />"));
    });

    $('.submenu-icon').click(function () {
        let $submenu = $(this).next('ul');
        let open = $(this).hasClass('icon-minus-light');

        if (open) {
            $submenu.slideUp();
            $(this).removeClass('icon-minus-light').addClass('icon-plus-light');
        } else {
            $submenu.slideDown();
            $(this).removeClass('icon-plus-light').addClass('icon-minus-light');
        }
    });

    $(document).ready(function () {

        $('.megamenu-list-toggle').each(function () {
            positionMegaMenu($(this));
        });

        $('.megamenu-list-toggle').hover(function () {
            let h = $('.header > .header-top').outerHeight();

            $(this).find('.megamenu-panel').css('top', h - 30);
        });

        $(window).resize(function () {
            $('.megamenu-list-toggle').each(function () {
                positionMegaMenu($(this));
            });
        });

        $(window).on('scroll', function () {
            stickyMenu();
        });

        $('.block--nav-menu ul.sidebar-list').find('li.menu-item-has-children').each(function () {
            let $icon = $('<span class="icon-plus-light submenu-icon"></span>');
            let $submenu = $(this).children('.sub-menu');

            $submenu.before($icon);

            $icon.on("click", $(this), function () {
                let close = $(this).hasClass('icon-plus-light'); console.log(close);

                if (close) {
                    $(this).removeClass('icon-plus-light').addClass('icon-minus-light');
                    $submenu.slideDown();
                } else {
                    $(this).removeClass('icon-minus-light').addClass('icon-plus-light');
                    $submenu.slideUp();
                }
            });
        });

        $(window).on('load', function(){
            $('.megamenu-list-toggle').each(function () {
                positionMegaMenu($(this));
            });
        });
    });   

});

// sticky header
function stickyMenu() {
    const scrolled = $(window).scrollTop();
    const pHeader = $(".header-top").length ? $(".header-top").height() : false;

    if (pHeader && scrolled - pHeader > 110) {
        $('body').css('padding-top', $(".header-top").height() + 'px');
        $("header.header").addClass("header-sticky");
        $('body').addClass('page-scrolled');
        $('.alert-covid').hide();
    } else {
        $('body').css('padding-top', 0);
        $("header.header").removeClass("header-sticky");
        $('body').removeClass('page-scrolled');
        $('.alert-covid').show();
    }
}

function positionMegaMenu($this) {
    let $row = $this.find('.megamenu-row');
    let $rowP = $row.find('.row-position');
    let $plus = $this.children('span.icon-plus-light');
    let $container = $('.megamenu-container');
    let $caret = $this.find('.megamenu-caret');

    let totalW = $rowP.width() / 2;
    let offsetX = $plus.offset().left;
    let positionX = offsetX - totalW;
    let containerX = $container.offset().left;

    let maxPosition = containerX + $container.width();
    let rowPosition = positionX + $rowP.width();

    if (maxPosition < rowPosition) {
        let newPositionX = positionX - (rowPosition - maxPosition) + 30;
        let caretPosition = offsetX - newPositionX;

        $rowP.css('left', newPositionX - containerX - 6);
        $caret.css('left', caretPosition);
    } else {
        let caretPosition = offsetX - positionX;

        $rowP.css('left', positionX - containerX - 6);
        $caret.css('left', caretPosition);
    }
}

/***
 * Scroll on Research Single Page
 */

var header = document.getElementById("top-header");
var singlePageNav = document.getElementById("singlePageNav");
if (header && singlePageNav) {
    var sticky = singlePageNav.offsetTop;

    function stickyFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
            header.classList.remove("hidden");
            singlePageNav.classList.add("d-none");
            singlePageNav.classList.remove("d-block");
        } else {
            header.classList.remove("sticky");
            header.classList.add("hidden");
            singlePageNav.classList.add("d-block");
            singlePageNav.classList.remove("d-none");
        }
    }

    window.onscroll = function () { stickyFunction() };
}

$(document).ready(function () {
    // Add smooth scrolling to navigate links on research page single
    $("#top-header .research-nav-link a, #singlePageNav a").on('click', function (event) {

        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            var topHeaderHeight = $('#top-header').height() + 40;
            if ($(window).width() < 960) {
                var topHeaderHeight = $('#top-header').height() + 80;
            }
            var hash = this.hash;

            $('html, body').animate({
                scrollTop: $(hash).offset().top - topHeaderHeight
            }, 1000);
        } //end if
    });

    $(".right-sidebar").clone().appendTo(".footer-sidebar");

    $('.icon-grid-view').click(function () {
        $('.loader-area').addClass('button_loader');
        window.setTimeout(function () {
            $('.loader-area').removeClass('button_loader');
            $('.display-list-view').addClass('d-none');
            $('.display-grid-view').removeClass('d-none');
        }, 1000);
    });

    $('.icon-list-view').click(function () {
        $('.loader-area').addClass('button_loader');
        window.setTimeout(function () {
            $('.loader-area').removeClass('button_loader');
            $('.display-list-view').removeClass('d-none');
            $('.display-grid-view').addClass('d-none');
        }, 1000);
    });
});


jQuery(document).ready(function ($) {

    $('a[href$=".pdf"]').attr('download', '');
    
    // Select all links with hashes
    $('a[href*="#"]')
        // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function (event) {
            // On-page links
            var topHeaderHeight = $('.header-top').height() + 60;
            console.log(topHeaderHeight);
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                &&
                location.hostname == this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?

                if (target.length) {
                    // Only prevent default if animation is actually gonna happen

                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - topHeaderHeight
                    }, 1000, function () {
                        // Callback after animation
                        // Must change focus!
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        };
                    });
                }
            }
        });

});

jQuery(document).bind("append_filters_to_pagination", function (e, filter_criteria, pagination) {

    if ($("div.nav-previous a", pagination).length > 0) {
        let prev_link = $("div.nav-previous a", pagination).attr("href");

        var _prev_link = new URL(prev_link);
        $.each(filter_criteria, function (name, value) {

            if (Array.isArray(value)) {
                value = value.join(",");
            }

            var _value = encodeURI(value);
            _prev_link.searchParams.set(name, _value);
        });

        $("div.nav-previous a", pagination).attr("href", _prev_link.href);
    }

});

//load more gallery images
jQuery(document).ready(function () {
    $("div.loadBox").each(function(){
        $(this).slice(0, 4).show()
    });
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $("div.loadBox:hidden").slice(0, 4).slideDown();
        if ($("div.loadBox:hidden").length == 0) {
            $("#loadMore").fadeOut('slow');
        }
        if ($("div.loadBox:hidden").length == 0) {
            $("#loadMore").css('visibility', 'hidden');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().bottom
        }, 1500);
    });
});

//load more sidebar post excerpt
jQuery(document).ready(function () {
    $("li.newsBox").slice(0, 3).show();
    $("#loadNews").on('click', function (e) {
        e.preventDefault();
        $("li.newsBox:hidden").slice(0, 3).slideDown();
        if ($("li.newsBox:hidden").length == 0) {
            $("#loadNews").fadeOut('slow');
        }
        if ($("li.NewsBox:hidden").length == 0) {
            $("#loadNews").css('visibility', 'hidden');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().bottom
        }, 1500);
    });
});

//footer menu links on mobile
jQuery(document).ready(function() {
    let w = $(window).width();

    if( w < 767 ) {
        $('.footer-widget--links h5').click(function(){
            let isActive = $(this).hasClass('active');

            if( isActive ) {
                $(this).removeClass('active');
                $(this).next().slideUp();
            } else {
                $(this).addClass('active');
                $(this).next().slideDown();
            }
            
        });
    }
});

//contact form salesforce
var emptySubReasonOptions = {
    '' : '--None--'
};

var subReasonOptions1 = {
    '' : '--None--',
    'Australia Council investment opportunities and programs' : 'Australia Council investment opportunities and programs',
    'International Opportunities' : 'International Opportunities',
    'Capacity Building and Leadership Programs' : 'Capacity Building and Leadership Programs',
    'First Nations Arts and Culture' : 'First Nations Arts and Culture',
'Other opportunities' : 'Other opportunities',
    'Co-investment opportunities' : 'Co-investment opportunities'     
};

var subReasonOptions2 = {
    '' : '--None--',
    'Potential research collaborations' : 'Potential research collaborations',
    'Current Australia Council research publications and reports (last 3 years)' : 'Current Australia Council research publications and reports (last 3 years)',
    'Historical Australia Council research publications and reports' : 'Historical Australia Council research publications and reports'
};


var subReasonOptions3 = {
    '' : '--None--',
    'First Nations Arts Awards' : 'First Nations Arts Awards',
    'Marketing Summit' : 'Marketing Summit',
    'Australia Council Awards' : 'Australia Council Awards',
    'National Arts and Disability Awards' : 'National Arts and Disability Awards',
    ' Other Australia Council events' : ' Other Australia Council events'
};

function validateFields() {

    var formIdentifierClass = 'web-to-case-form';
    var validator = validateFormWithJqueryValidationPlugin(formIdentifierClass);
    validateWebToCaseFields();
    validateRequiredFields();

    return validator;
}

function validateRequiredFields() {
 
    $("[class~='required-input-field']").each(function(i, value) {
        $(this).rules("add",{
            required: true,
            messages: {
                required : "This field is required.",
            }
        });
    });
}


function validateWebToCaseFields() {
    $.validator.addMethod("phoneNumber", function(phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.match(/^\d+$/);
    }, "Please specify a valid phone number.");

    $("[id=firstName]").rules("add",{
         maxlength: 40
    });

    $("[id=lastName]").rules("add",{
         maxlength: 80
    });

    $("[id=email]").rules("add",{
         email: true,
         maxlength: 80
    });

    $("[id=phone]").rules("add",{
        phoneNumber: true,
        maxlength: 40
    });

    $("[id=subReason]").rules("add",{
        required: function(element) {
            return ($.inArray($(element).val(), ["Advice or information about investment opportunities", "Reports or activity on arts research or industry analysis", "Events"]) >= 0);
        },
        messages: {
            required : "This field is required.",
        }
    });
}


function validateFormWithJqueryValidationPlugin(formIdentifierClass) {

    return $("[class~=" + formIdentifierClass + "]").validate({
        onfocusout: false,
        onkeyup: false,
        ignore: ":hidden",
        errorClass: 'error',
    });
    event.preventDefault()
}

function resetSubReasonSelectedValueAndOptions(caseSubReasonField) {

    caseSubReasonField.val("");
    caseSubReasonField.empty();
}


function buildSubReasonOptions(caseReasonSelectedValue) {

    var caseSubReasonField = $("[id=subReason]");
    resetSubReasonSelectedValueAndOptions(caseSubReasonField);    
    
    switch (caseReasonSelectedValue) {
        case "Advice or information about investment opportunities":
            caseSubReasonField.addClass("required-input-field");
            $.each(subReasonOptions1, function(val, text) {
                caseSubReasonField.append(
                    $('<option></option>').val(val).html(text)
                );
            });
            $('.contact-frm-salesforce.sub-reason').removeClass('d-none');
            break;
        case "Reports or activity on arts research or industry analysis":
            caseSubReasonField.addClass("required-input-field");
            $.each(subReasonOptions2, function(val, text) {
                caseSubReasonField.append(
                    $('<option></option>').val(val).html(text)
                );
            });
            $('.contact-frm-salesforce.sub-reason').removeClass('d-none');
            break;
        case "Events":
            caseSubReasonField.addClass("required-input-field");
            $.each(subReasonOptions3, function(val, text) {
                caseSubReasonField.append(
                    $('<option></option>').val(val).html(text)
                );
            });
            $('.contact-frm-salesforce.sub-reason').removeClass('d-none');
            break;    
        default:
            $.each(emptySubReasonOptions, function(val, text) {
                caseSubReasonField.removeClass("required-input-field");
                caseSubReasonField.append(
                    $('<option></option>').val(val).html(text)
                );
            });           
            $('.contact-frm-salesforce.sub-reason').addClass('d-none');  
            break;
    }
}

//end contact form salesforce

$(document).ready(function(){
    // if the cookie doesn't exist create it and show the modal
        if ( ! $.cookie('alert-covid') ) {

        // create the cookie. Set it to expire in 1 day
        $.cookie('alert-covid', true, { expires: 1 });

        //call the reveal modal
        var delay=5000; //in ms, this would mean 5 seconds
        setTimeout(function(){
           // $('#subscribe').reveal();
        },delay);
    }
});