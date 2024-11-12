(function ($) {

    'use strict';

    var usgrAttachmentId = 'input[name="' + userGrid.input_name + '"]';
    var usgrAttachmentAvatar = '.user-grid-attachment-avatar';
    var usgrAttachmentDesc = '#user-grid-attachment-description';
    var usgrButtonAdd = '#gt-avatar-add';
    var usgrButtonRemove = '#gt-avatar-remove';

    var userAttachmentId = $(usgrAttachmentId);
    var userAttachmentAvatar = $('.user-grid-attachment-avatar img');
    var userAttachmentDesc = $(usgrAttachmentDesc);
    var userButtonAdd = $(usgrButtonAdd);
    var userButtonRemove = $(usgrButtonRemove);
    var WPMediaSizes = ['full', 'large', 'medium', 'thumbnail'];

    var defaultSrc = userGrid.default_avatar_src;
    var defaultSrcSet = userGrid.default_avatar_srcset;


    function updateAttachment(attachmentSrc = '', attachmentSrcSet = '', attachmentId = null) {

        userAttachmentAvatar.attr({
            'src': attachmentSrc,
            'srcset': attachmentSrcSet
        });

        userAttachmentId.val(attachmentId === null ? ' ' : parseInt(attachmentId));

        userAttachmentDesc.toggleClass('hidden');
        userButtonRemove.toggleClass('hidden');
    }


    $(document).ready(function ($) {
        $(document).on('click', usgrButtonAdd, function () {
                var frame = wp.media({
                    title: 'Select or Upload Media',
                    button: {
                        text: 'Use this media'
                    },
                    multiple: false
                });

                frame.on('select', function () {
                    var attachment = frame.state().get('selection').first().toJSON();
                    console.log(attachment)
                    var attachmentSrc = attachment.sizes['full'].url;
                    updateAttachment(attachmentSrc, attachmentSrc, attachment.id);
                });

                frame.open();
            })
            .on('click', usgrButtonRemove, function () {
                var defaultAvatar = $(this).closest('.action-button').find('.input_default_avatar').val();
                updateAttachment(defaultAvatar, defaultSrcSet);
            })
            .on('click', usgrAttachmentAvatar, function () {
                $(usgrButtonAdd).trigger('click');
            });
    });


})(jQuery);
