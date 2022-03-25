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
    'Magento_Ui/js/grid/columns/select'
], function (Column) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'ui/grid/cells/html'
        },
        getLabel: function (record) {
            var label = this._super(record);

            if (label !== '') {
                switch (record.status) {
                    case '1':
                        label = '<span class="grid-severity-notice"><span>' + label + '</span></span>';
                        break;
                    case '2':
                        label = '<span class="grid-severity-critical"><span>' + label + '</span></span>';
                        break;
                    case '3':
                        label = '<span class="grid-severity-minor"><span>' + label + '</span></span>';
                        break;
                }
            }
            return label;
        }
    });
});