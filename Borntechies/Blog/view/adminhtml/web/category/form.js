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

/*jshint jquery:true browser:true*/
/*global Ajax:true alert:true*/
define([
    "jquery",
    "mage/backend/form",
    "jquery/ui",
    "prototype"
], function ($) {
    "use strict";

    $.widget("mage.categoryForm", $.mage.form, {
        options: {
            categoryIdSelector: 'input[name="category[category_id]"]',
            categoryPathSelector: 'input[name="category[path]"]'
        },

        /**
         * Form creation
         * @protected
         */
        _create: function () {
            this._super();
            $('body').on('categoryMove.tree', $.proxy(this.refreshPath, this));
        },

        /**
         * Sending ajax to server to refresh field 'category[path]'
         * @protected
         */
        refreshPath: function () {
            var that = this;
            if (!this.element.find(this.options.categoryIdSelector).prop('value')) {
                return false;
            }
            $.ajax({
                type: 'POST',
                url: this.options.refreshUrl,
                dataType: 'json',
                data: {
                    form_key: FORM_KEY
                }
            }).success(function (data) {
                that._refreshPathSuccess(data);
            });
        },
        _refreshPathSuccess: function (response) {
            if (response.error) {
                alert(response.message);
            } else {
                if (this.element.find(this.options.categoryIdSelector).prop('value') == response.id) {
                    this.element.find(this.options.categoryPathSelector)
                        .prop('value', response.path);
                }
            }
        }
    });

    return $.mage.categoryForm;
});
