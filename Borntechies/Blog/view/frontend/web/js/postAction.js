/**
 * Born Techies Pvt. Ltd. 
 *
 * Born Techies Pvt. Ltd. serves customers all at one place who searches
 * for different types of extensions for Magento 2.
 * 
 * DISCLAIMER
 * 
 * 
 * Do not edit or add to this file if you wish to upgrade this
 * extension to newer 
 * version in the future.
 *
 * 
 * @category Born Techies Pvt. Ltd. 
 *
 * @package Borntechies_Blog
 * 
 * @copyright Copyright (c) Born Techies Pvt. Ltd. 
 * (https://borntechies.com/)
 * See COPYING.txt for license details.
 * 
 */
define([
    'jquery',
    "mage/adminhtml/events",
    "mage/adminhtml/wysiwyg/tiny_mce/setup"
], function ($) {
    'use strict';

    $.widget('borntechies.blogPostAction', {
            options: {},
            _create: function () {
                var self = this;

                $('button.blog-action-new').on('click', function () {
                    self._AddNew();
                });
            },
            _AddNew: function () {
                var form      = $('#mp_blog_post_form'),
                    formData  = new FormData(form[0]),
                    htmlPopup = $('#mp-blog-new-post-popup'),
                    url       = form.attr('action');

                $.ajax({
                    url: url,
                    type: "post",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    showLoader: true,
                    success: function (result) {
                        htmlPopup.data('mageModal').closeModal();
                        if (result.status === 1) {
                            setTimeout(function () {
                                location.reload();
                            }, 500);
                        }
                    }
                });
            }
        }
    );

    return $.borntechies.blogPostAction;
});
