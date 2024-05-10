(function ($) {
    'use strict';

    $('document').ready(function () {

        $('.load-user-button').on('click', function (e) {
            e.preventDefault();
            var $this = $(this);
            var userId = $this.data('userid');
            $this.parent().addClass('open-modal')

            var $bioElem = $this.parent().find('.bio-content');

            var data = {
                action: 'dowp_user_biography',
                user_id: userId,
                dowp_nonce: dowpParams.nonce
            };

            $.ajax({
                url: dowpParams.ajaxurl,
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
            $(this).parents('.cub-bio-wrapper').removeClass('open-modal')
        })


    })

})(jQuery);