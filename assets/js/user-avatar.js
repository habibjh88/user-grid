(function ($) {

    'use strict';

    var dowpAttachmentId = 'input[name="' + userGrid.input_name + '"]';
    var dowpAttachmentAvatar = '.user-grid-attachment-avatar';
    var dowpAttachmentDesc = '#user-grid-attachment-description';
    var dowpButtonAdd = '#gt-avatar-add';
    var dowpButtonRemove = '#gt-avatar-remove';

    var userAttachmentId = $(dowpAttachmentId);
    var userAttachmentAvatar = $('.user-grid-attachment-avatar img');
    var userAttachmentDesc = $(dowpAttachmentDesc);
    var userButtonAdd = $(dowpButtonAdd);
    var userButtonRemove = $(dowpButtonRemove);
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
        $(document).on('click', dowpButtonAdd, function () {
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
            .on('click', dowpButtonRemove, function () {
                var defaultAvatar = $(this).closest('.action-button').find('.input_default_avatar').val();
                updateAttachment(defaultAvatar, defaultSrcSet);
            })
            .on('click', dowpAttachmentAvatar, function () {
                $(dowpButtonAdd).trigger('click');
            });
    });


})(jQuery);
