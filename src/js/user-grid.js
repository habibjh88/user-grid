;(function ($) {

    'use strict';

    var UserGrid = {

        _init: function () {
            UserGrid.slickSlider();
            console.log('asdfasdfasdfasdf')
        },

        slickSlider: function () {
            $('.dowp-carousel').css({'opacity': 1, 'transition':'0.4s'})
            if (typeof $.fn.slick == 'function') {
                $('.dowp-carousel').slick()
            }
        },

    };

    $(document).ready(function (e) {
        UserGrid._init();
    });


    window.UserGrid = UserGrid;

})(jQuery);
