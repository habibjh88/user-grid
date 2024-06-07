(function ($) {
    'use strict';

    $(document).ready(function () {
        // Hide the social icons by default
        $('.dowp-user-social-icons').hide();

        $('.user-item-col').each(function () {
            var item = $(this);

            var thumbSocialEl = item.find('.thumb-social');
            var socialIconWrap = item.find('.dowp-user-social-icons');

            // Get the position of thumbSocialEl relative to the parent .user-item-col
            var parentOffset = item.offset();
            var thumbSocialOffset = thumbSocialEl.offset();
            var socialHoverBottom = thumbSocialOffset.top + thumbSocialEl.outerHeight() - parentOffset.top;
            var socialHoverLeft = thumbSocialOffset.left - parentOffset.left;

            socialIconWrap.css({
                'position': 'absolute',
                'top': socialHoverBottom,
                'left': socialHoverLeft
            });

            // Show the social icons on hover over .thumb-social
            thumbSocialEl.hover(
                function () {
                    socialIconWrap.show();
                },
                function () {
                    socialIconWrap.hide();
                }
            );

            // Hide the social icons when mouse leaves the .dowp-user-social-icons
            socialIconWrap.mouseleave(function () {
                socialIconWrap.hide();
            });
        });
    });

})(jQuery);