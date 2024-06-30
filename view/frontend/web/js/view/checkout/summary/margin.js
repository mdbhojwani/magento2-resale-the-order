/**
 * @category Mdbhojwani
 * @package Mdbhojwani_ResaleTheOrder
 * @author Manish Bhojwani <manishbhojwani3@gmail.com>
 * @github https://github.com/mdbhojwani
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
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
                    console.log(totals);
                    var segment = totals.getSegment('margin_earned');
                    console.log("segment");
                    console.log(segment);
                    if (segment) {
                        console.log(segment.value);
                        price = segment.value;
                    }
                }
                console.log("price: " + price);
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
                if (this.totals()) {
                    console.log(totals);
                    var segment = totals.getSegment('margin_earned');
                    console.log("segment2");
                    console.log(segment);
                    if (segment) {
                        console.log(segment.value);
                        price = segment.value;
                    }
                }
                console.log("price2: " + price);
                return price;
            }
        });
    }
);