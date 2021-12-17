/**
 * Mdbhojwani
 * Copyright (C) 2021 Mdbhojwani
 *
 * @package Mdbhojwani_ResaleTheOrder
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author Mdbhojwani
 */
define([
    'jquery',
    'Magento_Checkout/js/model/quote',
    'Magento_Catalog/js/price-utils',
    'jquery-ui-modules/widget'
], function ($, quote, priceUtils) {
    'use strict';

    $.widget('mage.yourMargin', {
        options: {
        },

        /** @inheritdoc */
        _create: function () {
            this.yourMargin = $(this.options.yourMarginSelector);
            this.removeMargin = $(this.options.removeMarginSelector);
            this.marginMessage = $(this.options.marginMessageSelector);
            this.marginMessageUpdate = $(this.options.marginMessageSelector + ' strong');
            this.marginEarned = $(this.options.marginEarnedSelector);

            $(this.yourMargin).on('keyup', $.proxy(function () {
                var yourMargin = this.yourMargin.val();
                var subTotal = this.getSubtotal();
                var marginEarned = yourMargin - subTotal;
                
                this.marginMessage.hide();
                this.marginMessageUpdate.html('');

                if (yourMargin) {
                    this.marginMessageUpdate.html(priceUtils.formatPrice(marginEarned, quote.getPriceFormat()));
                    this.marginEarned.val(marginEarned);
                    this.marginMessage.show();
                }

            }, this));

            $(this.options.applyButton).on('click', $.proxy(function () {
                this.yourMargin.attr('data-validate', '{\'required\':true,\'validate-greater-than-zero\':true}');
                this.removeMargin.attr('value', '0');
                $(this.element).validation().submit();
            }, this));

            $(this.options.cancelButton).on('click', $.proxy(function () {
                this.yourMargin.attr('data-validate', '{\'validate-greater-than-zero\':true}');
                this.removeMargin.attr('value', '1');
                this.element.submit();
            }, this));
        },
        getSubtotal: function() {
            var totals = quote.totals();
            return (totals ? totals : quote)['subtotal'];
        },
        getGrandTotal: function() {
            var totals = quote.totals();
            return (totals ? totals : quote)['grand_total'];
        }
    });

    return $.mage.yourMargin;
});
