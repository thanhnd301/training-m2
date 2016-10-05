/**
 * Created by smart on 10/3/2016.
 */
define([
    'uiComponent'

], function (Component) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Training_BBBShipping/checkout/shipping/baybanbua-term'
        },
        isShowed: ko.computed(function () {
        if(quote.shippingMethod())
        {
            if('baybanbua' == quote.shippingMethod().carrier_code)
            {
                return true;
            }
        }

        return false;
    })
    });
});
