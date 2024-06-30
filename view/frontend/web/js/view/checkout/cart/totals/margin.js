/**
 * @category Mdbhojwani
 * @package Mdbhojwani_ResaleTheOrder
 * @author Manish Bhojwani <manishbhojwani3@gmail.com>
 * @github https://github.com/mdbhojwani
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
define(
    [
        'Mdbhojwani_ResaleTheOrder/js/view/checkout/summary/margin'
    ],
    function (Component) {
        'use strict';

        return Component.extend({

            /**
             * @override
             */
            isDisplayed: function () {
                console.log(this.isFullMode());
                console.log(this.getPureValue());
                return this.isFullMode() && this.getPureValue() != 0;
            }
        });
    }
);