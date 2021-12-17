/**
 * Mdbhojwani
 * Copyright (C) 2021 Mdbhojwani
 *
 * @package Mdbhojwani_ResaleTheOrder
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author Mdbhojwani
 */
define(
    [
        'Magento_Checkout/js/view/summary/abstract-total',
        'Magento_Checkout/js/model/quote',
        'Magento_Catalog/js/price-utils',
        'Magento_Checkout/js/model/totals'
    ],
    function (Component, quote, priceUtils, totals) {
        "use strict";
        return Component.extend({
            defaults: {
                isFullTaxSummaryDisplayed: window.checkoutConfig.isFullTaxSummaryDisplayed || false,
                template: 'Mdbhojwani_ResaleTheOrder/checkout/summary/margin'
            },
            totals: quote.getTotals(),
            isTaxDisplayedInGrandTotal: window.checkoutConfig.includeTaxInGrandTotal || false,
            isDisplayed: function() {
                return this.isFullMode() && this.getPureValue() != 0;
            },
            getValue: function() {
                var price = 0;
                if (this.totals()) {
                    var segment = totals.getSegment('margin_earned');
                    if (segment) {
                        price = segment.value;
                    }
                }
                return this.getFormattedPrice(price);
            },
            getBaseValue: function() {
                var price = 0;
                if (this.totals()) {
                    price = this.totals().base_margin_earned;
                }
                return priceUtils.formatPrice(price, quote.getBasePriceFormat());
            },
            getPureValue: function () {
                var price = 0;
                if (this.totals) {
                    var segment = totals.getSegment('margin_earned');
                    if (segment) {
                        price = segment.value;
                    }
                }
                return price;
            }
        });
    }
);