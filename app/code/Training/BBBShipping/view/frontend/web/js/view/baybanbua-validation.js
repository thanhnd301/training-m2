/**
 * Created by smart on 10/4/2016.
 */
define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/shipping-rates-validator',
        'Magento_Checkout/js/model/shipping-rates-validation-rules',
        '../model/shipping-rates-validator',
        '../model/shipping-rates-validation-rules'
    ],
    function (
        Component,
        defaultShippingRatesValidator,
        defaultShippingRatesValidationRules,
        shippingRatesValidator,
        shippingRatesValidationRules
    ) {
        'use strict';
        defaultShippingRatesValidator.registerValidator('baybanbua', shippingRatesValidator);
        defaultShippingRatesValidationRules.registerRules('baybanbua', shippingRatesValidationRules);
        return Component;
    }
);
