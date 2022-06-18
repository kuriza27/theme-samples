jQuery(function ($) {

    var homeBannerCarousel = function ($block) {
        $block.find(".js-header-slider").slick({
            slidesToShow: 1,
            dots: true,
            arrows: false,
            fade: true,
        });
    };

    var relatedSearchSlider = function ($block) {
        $block.find(".js-links-slider").slick({
            slidesToShow: 3,
            arrows: false,
            dots: true,
            autoplay: false,
            slidesToScroll: 1,
            responsive: [
                {
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
    };

    var textCarousel = function ($block) {
        $block.find(".js-text-slider").slick({
            slidesToShow: 3,
            arrows: false,
            dots: true,
            autoplay: false,
            slidesToScroll: 3,
            responsive: [
                {
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
                        dots: false,
                        fade: true,
                    }
                }
            ]
        });
    };

    var imageContentSlider = function ($block) {
        $block.find(".js-content-slider").slick({
            slidesToShow: 1,
            dots: true,
            arrows: false,
            fade: true,
            adaptiveHeight: true
        });
    };

    var gallery = function ($block) {
        if(typeof $.fn.masonry === "function"){
            $block.find('.grid').masonry({
                itemSelector: '.grid-item',
            });
        }
    }

    // Initialize dynamic block preview (editor).
    if (window.acf) {
        window.acf.addAction(
            "render_block_preview/type=home-banner-carousel",
            homeBannerCarousel
        );

        window.acf.addAction(
            "render_block_preview/type=home-carousel",
            homeBannerCarousel
        );

        window.acf.addAction(
            "render_block_preview/type=related-search-slider",
            relatedSearchSlider
        );

        window.acf.addAction(
            "render_block_preview/type=block-image-content-slider",
            imageContentSlider
        );

        window.acf.addAction(
            "render_block_preview/type=section-text-carousel",
            textCarousel
        );

        window.acf.addAction(
            "render_block_preview/type=masonry-gallery-section",
            gallery
        );
    }
});