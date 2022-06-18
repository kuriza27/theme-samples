jQuery(function ($) {
  var postSliderBlockInit = function ($block) {
    $(".js-cards-slider").slick({
      arrows: false,
      slidesToShow: 5,
      slidesToScroll: 2,
      infinite: true,
      autoplay: true,
      responsive: [
        {
          breakpoint: 992,
          settings: {},
        },
      ],
    });
  };

  var reviewsSliderBlockInit = function ($block) {
    $(".js-review-slider").slick({
      arrows: false,
      slidesToShow: 3,
      slidesToScroll: 1,
      infinite: true,
      autoplay: true,
      responsive: [
        {
          breakpoint: 992,
          settings: {},
        },
      ],
    });
  };

  var gallerySliderBlockInit = function ($block) {
    $(".js-insta-slider").slick({
      arrows: false,
      variableWidth: true,
      autoplay: true,
    });
  };

  var partnersSliderBlockInit = function ($block) {
    $(".js-partners-list").slick({
      arrows: false,
      slidesToShow: 5,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            adaptiveHeight: true,
          },
        },
      ],
    });
  };

  var jsDonateBoxes = function($block) {
    $block.find(".js-donate-boxes").slick({
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
  }

  // Initialize dynamic block preview (editor).
  if (window.acf) {
    window.acf.addAction(
      "render_block_preview/type=posts-slider-block",
      postSliderBlockInit
    );

    window.acf.addAction(
      "render_block_preview/type=reviews-slider-block",
      reviewsSliderBlockInit
    );

    window.acf.addAction(
      "render_block_preview/type=gallery-slider-block",
      gallerySliderBlockInit
    );

    window.acf.addAction(
      "render_block_preview/type=partners-block",
      partnersSliderBlockInit
    );

    window.acf.addAction(
      "render_block_preview/type=donate-pricing-block",
      jsDonateBoxes
    );
  }
});
