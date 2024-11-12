;(function ($) {

    'use strict';

    var UserGrid = {

        _init: function () {
            UserGrid.slickSlider();
        },

        slickSlider: function () {
            $('.usgr-carousel').css({'opacity': 1, 'transition':'0.4s'})
            if (typeof $.fn.slick == 'function') {
                $('.usgr-carousel').slick()
            }
        },

    };

    $(document).ready(function (e) {
        UserGrid._init();
    });


    window.UserGrid = UserGrid;

})(jQuery);
