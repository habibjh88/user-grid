(function ($) {

    'use strict';

    // Tags name
    var tagAttachmentId = 'input[name="' + userGrid.input_name + '"]';
    var tagAttachmentAvatar = '.user-grid-attachment-avatar';
    var tagAttachmentDesc = '#user-grid-attachment-description';
    var tagButtonAdd = '#gt-avatar-add';
    var tagButtonRemove = '#gt-avatar-remove';

    // jQuery elements by tags
    var userAttachmentId = $(tagAttachmentId);
    var userAttachmentAvatar = $(tagAttachmentAvatar);
    var userAttachmentDesc = $(tagAttachmentDesc);
    var userButtonAdd = $(tagButtonAdd);
    var userButtonRemove = $(tagButtonRemove);

    // WordPress default media sizes
    var WPMediaSizes = ['full', 'large', 'medium', 'thumbnail'];

    // Get default Src and default SrcSet
    var defaultSrc = userGrid.default_avatar_src;
    var defaultSrcSet = userGrid.default_avatar_srcset;


    /*
     * Update attachment
     *
     * @since  3.6
     * @return void
     */
    function updateAttachment(attachmentSrc = '', attachmentSrcSet = '', attachmentId = null) {

        // Change the image attributes
        userAttachmentAvatar.attr({
            'src': attachmentSrc,
            'srcset': attachmentSrcSet
        });

        // Set attachment ID value
        userAttachmentId.val(attachmentId === null ? ' ' : parseInt(attachmentId));

        // Toggle class hidden
        userAttachmentDesc.toggleClass('hidden');
        userButtonRemove.toggleClass('hidden');
    }


    /*
     * Init functions
     *
     * @since 2.8
     */
    $(function () {

        // Set click functions
        $(document)
            .on('click', tagButtonAdd, function () {

                // Open WordPress Media Library
                wp.media.editor.open();

                // WP Media Editor function
                wp.media.editor.send.attachment = function (props, attachment) {

                    // Set attachment Src to default URL
                    var attachmentSrc = attachment.url;

                    // If there is a smaller version I use it
                    for (const WPMediaSize of WPMediaSizes) {
                        if (typeof attachment.sizes[WPMediaSize] !== 'undefined' && typeof attachment.sizes[WPMediaSize].url !== 'undefined') {
                            attachmentSrc = attachment.sizes[WPMediaSize].url;
                        }
                    }
                    // Update Attachment
                    updateAttachment(attachmentSrc, attachmentSrc, attachment.id);
                }
            })
            .on('click', tagButtonRemove, function () {
                var default_avatar = $(this).closest('.action-button').find('.input_default_avatar').val();
                // Update Attachment
                updateAttachment(default_avatar, defaultSrcSet);
            })
            .on('click', tagAttachmentAvatar, function () {
                // Trigger to add button
                userButtonAdd.trigger('click');
            });

    });

})(jQuery);
