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