(function ($) {
    'use strict';

    $('document').ready(function () {
        /*$('.load-user-button').magnificPopup({
            fixedContentPos: true,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in',

            type: 'ajax',

        });*/

        $('.load-user-button').on('click', function (e) {
            e.preventDefault();
            var $this = $(this);
            var userId = $this.data('userid');
            $this.parent().addClass('open-modal')

            var $bioElem = $this.parent().find('.bio-content');

            var data = {
                action: 'tpg_user_biography',
                user_id: userId,
                rttpg_nonce: rttpgParams.nonce
            };

            $.ajax({
                url: rttpgParams.ajaxurl,
                data: data,
                type: "POST",
                beforeSend: function () {
                    $bioElem.html('')
                    $bioElem.addClass('loading');
                },
                success: function (response) {
                    if (response.success === 'ok') {
                        $bioElem.removeClass('loading');
                        $bioElem.html(response.biography);
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });
        })

        $('.close-modal-btn').on('click', function (e) {
            e.preventDefault();
            $(this).parents('.cub-user-social-icons').removeClass('open-modal')
        })


    })

})(jQuery);