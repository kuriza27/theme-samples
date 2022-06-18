/********FILTER GRANT OPPORTUNITY *** */
jQuery(function($) {
    loadMore = (e, filter = "") => {
        $("#loading").html('Loading...').show();
        var data = {
            'action': 'loadPage',
            'postType': 'investment',
            'pg': e
        };
        $.post('/wp-admin/admin-ajax.php', data, function(data) {
            if (data.entries) {
                $("#results-area").append(data.entries);
                $("#loading").hide();
            } else {
                $('.loading-pagination a,#loading').hide();
            }
            $('.list-main-container').removeClass('loading-jm');
        }, 'json');
    }
    loadMore = {
        cat: '',
        filter: '',
        tax: '',
        e: 1,
        isFilter: '',
        empty: function() {
            return `<div class="no-entry"><strong>No Entry Found.</strong></div>`;
        },
        load: function() {
            var data = {
                'action': 'loadPage',
                'postType': 'investment',
                'pg': loadMore.e
            };
            if (loadMore.cat) {
                data.cat = loadMore.cat;
            }
            if (loadMore.filter) {
                data.filter = loadMore.filter;
            }
            if (loadMore.tax) {
                data.tax = loadMore.tax;
            }
            $.post('/wp-admin/admin-ajax.php', data, function(data) {
                console.log(data.entries.length + '----');
                if (data.entries) {
                    if (loadMore.isFilter) {
                        $("#results-area").html(data.entries);
                    } else {
                        $("#results-area").append(data.entries);
                    }
                    $('.loading-pagination a').show();
                } else {
                    if (loadMore.isFilter) {
                        $("#results-area").html(loadMore.empty());
                    }
                }
                if (data.total < 9) {
                    $('.loading-pagination a').hide();
                }
                $('.list-main-container').removeClass('loading-jm');
            }, 'json');
        }
    };
    var currPage = 1;
    $(document).on("click", '.selects-section a.next', (e) => {
        e.preventDefault();
        $('.list-main-container').addClass('loading-jm');
        myThis = $(e.currentTarget);
        loadMore.e = ++currPage;
        loadMore.load();
    });
    $(document).on("click", '.selects-section .search-input-btn', (e) => {
        e.preventDefault();
        var val = $('.selects-section .d-block input').val();
        $('.list-main-container').addClass('loading-jm');
        $('select').val('');
        currPage = 1;
        loadMore.e = currPage;
        loadMore.isFilter = 1;
        loadMore.filter = val;
        loadMore.load();
    });
    $(document).on("change", '.selects-section select', (e) => {
        e.preventDefault();
        myThis = $(e.currentTarget);
        var val = myThis.val();
        $('select').val('');
        $('.selects-section .d-block').val('');
        $('.list-main-container').addClass('loading-jm');
        currPage = 1;
        loadMore.e = currPage;
        loadMore.isFilter = 1;
        loadMore.tax = myThis.attr('name');
        loadMore.cat = val;
        loadMore.load();
        myThis.val(val);
    });

    loadMore1 = (e, filter = "") => {
        $("#loading").html("Loading...").show(), $.post("/acftastage/wp-admin/admin-ajax.php", {
            action: "loadResearch",
            postType: "research",
            pg: e
        }, function(a) {
            a.entries ? ($("#results-area").append(a.entries), $("#loading").hide()) : $(".loading-pagination a,#loading").hide(), $(".list-main-container").removeClass("loading-jm")
        }, "json")
    }, loadMore1 = {
        cat: "",
        filter: "",
        tax: "",
        e: 1,
        isFilter: "",
        empty: function() {
            return '<div class="no-entry"><strong>No Entry Found.</strong></div>'
        },
        load: function() {
            var a = {
                action: "loadResearch",
                postType: "research",
                pg: loadMore1.e
            };
            loadMore1.cat && (a.cat = loadMore1.cat), loadMore1.filter && (a.filter = loadMore1.filter), loadMore1.tax && (a.tax = loadMore1.tax), o.post("/wp-admin/admin-ajax.php", a, function(a) {
                console.log(a.entries.length + "----"),  a.entries ? (loadMore1.isFilter ? $(".posts-list").html(a.entries) : $(".posts-list").append(a.entries), $(".loading-pagination a").show()) : loadMore1.isFilter && $(".posts-list").html(loadMore1.empty()), a.total < 9 && $(".loading-pagination a").hide(), $(".posts-list").removeClass("loading-jm"),$('span.totalpost').text(a.total);
            }, "json")
        }
    };
    a = 1;
    $(document).on("click", ".post-type-section .search-input-btn", e => {
        e.preventDefault();
        var val = $(".post-type-section .d-block input.search-by-title").val()
        $(".posts-list").addClass("loading-jm"), 
        $("select").val(""), 
        currpage = 1;
        loadMore1.e = currPage;
        loadMore1.isFilter = 1;
        loadMore1.filter = val;
        loadMore1.load();
    }), 
    $(document).on("change", ".post-type-section select", e => {
        e.preventDefault(); 
        myThis = $(e.currentTarget);
        var val = myThis.val();
        $("select").val("");
        $(".post-type-section .d-block").val("");
        $(".posts-list").addClass("loading-jm");
        currPage = 1; 
        loadMore1.e = currPage; 
        loadMore1.isFilter = 1;
        loadMore1.tax = myThis.attr("name"); 
        loadMore1.cat = val; 
        loadMore1.load();
        myThis.val(val);
    })



}); /*********** */
jQuery(function($) {
    // mobile menu
    $('.js-mm-link, .js-close-submenu').on('click', function() {
        $(this).parents('.menu-item').toggleClass('active');
    });
    $('.js-menu-btn, .menu-toggle').on('click', function() {
        $('body').toggleClass('open');
    });

    function nl2br(str) {
        return str.replace(/(?:\r\n|\r|\n)/g, '<br>');
    }
    if (typeof $.fn.slick === "function") {
        $(".js-header-slider").slick({
            slidesToShow: 1,
            dots: true,
            arrows: false,
            fade: true,
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
            slidesToScroll: 1,
            responsive: [{
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
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
        $(".js-highlights-slider").slick({
            slidesToShow: 3,
            arrows: false,
            responsive: [{
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
    $(".header-nav.alt > ul > .menu-item-has-children").hover(function() {
        let thisDropdownHeight = $(this).children(".megamenu").find(".sub-menu").outerHeight();
        $(this).parents(".header-nav.alt").addClass("megamenu-open");
        $(".nav-overlay").css("height", thisDropdownHeight);
    }, function() {
        $(this).parents(".header-nav.alt").removeClass("megamenu-open");
        $(".nav-overlay").css("height", 0);
    });
    if (typeof $.fn.masonry === "function") {
        $('.grid').masonry({
            itemSelector: '.grid-item',
        });
    }
    $(".facilitator-box .btn-plus[data-toggle='modal']").click(function() {
        $(this).parent(".facilitator-box").siblings(".facilitator-data").clone().appendTo("#faciliatorInfo");
        $("#faciliatorInfo h3").html($("#faciliatorInfo h3").text().replace(/\n/g, "<br />"))
    });
    $("#faciliatorModal").on("hide.bs.modal", function() {
        $(this).find("#faciliatorInfo").html("");
    });
    $(document).delegate(".modal-nav a", "click", function() {
        let hboxId = $(this).data("hbox");
        $("#faciliatorInfo > *").fadeOut().remove();
        $("#" + hboxId).find(".facilitator-data").clone().appendTo("#faciliatorInfo");
        $("#faciliatorInfo h3").html($("#faciliatorInfo h3").text().replace(/\n/g, "<br />"))
    });
});
/***
 * Scroll on Research Single Page
 */
var header = document.getElementById("top-header");
var singlePageNav = document.getElementById("singlePageNav");
if (header && singlePageNav) {
    var sticky = header.offsetTop;

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
    window.onscroll = function() {
        stickyFunction()
    };
}
$(document).ready(function() {
    // Add smooth scrolling to navigate links on research page single
    $("#top-header .breadcrumb a, #singlePageNav a").on('click', function(event) {
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
    $('.icon-grid-view').click(function() {
        $('.loader-area').addClass('button_loader');
        window.setTimeout(function() {
            $('.loader-area').removeClass('button_loader');
            $('.display-list-view').addClass('d-none');
            $('.display-grid-view').removeClass('d-none');
            Cookies.set('table_view', 'grid-view',{ expires: 7 });
        }, 1000);
    });
    $('.icon-list-view').click(function() {
        $('.loader-area').addClass('button_loader');
        window.setTimeout(function() {
            $('.loader-area').removeClass('button_loader');
            $('.display-list-view').removeClass('d-none');
            $('.display-grid-view').addClass('d-none');
            Cookies.set('table_view', 'list-view',{ expires: 7 })
        }, 1000);
    });

    if(Cookies.get('table_view') != undefined){
        if( Cookies.get('table_view') == 'list-view' ){
            $(".display-grid-view").addClass("d-none")
            $(".display-list-view").removeClass("d-none")
        }
        else if( Cookies.get('table_view') == 'grid-view' ){
            $(".display-list-view").addClass("d-none")
            $(".display-grid-view").removeClass("d-none")
        }
    }

    $(".alert-covid button.close").on("click",function(){
        Cookies.set("covid_alert",1, {expires:60} );
    });
    
    $(".alert-covid a").on("click",function(){
        Cookies.set("covid_alert",1, {expires:60} );
    });

    if( Cookies.get('covid_alert') == 1 ){
        $(".alert-covid").find('.icon-cancel').hide();
    }
    
});