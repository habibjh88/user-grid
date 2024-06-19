;(function ($) {

    'use strict';

    var UserGrid = {

        _init: function () {
            UserGrid.slickSlider();
        },

        slickSlider: function () {
            $('.dowp-users-block-wrapper.slider-style').css({'opacity': 1, 'transition':'0.4s'})
            if (typeof $.fn.slick == 'function') {
                $('.dowp-row').slick({
                    dots: true,
                    arrows: false,
                    // fade: true,
                    speed: 100,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    // adaptiveHeight: true,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                })
            }
        },

    };

    $(document).ready(function (e) {
        UserGrid._init();
    });


    window.UserGrid = UserGrid;

})(jQuery);
