/**
 * Created by smart on 10/3/2016.
 */
define(
    [
        'Magento_Checkout/js/model/quote',
        'jquery'
    ],
    function (quote,$) {
        "use strict";
        return function (shippingMethod) {
            if(shippingMethod)
            {
                if('baybanbua' == shippingMethod.carrier_code)
                {
                    $('#baybanbua_term').css('display','block');
                }
                else{
                    $('#baybanbua_term').css('display','none');
                }
            }
            quote.shippingMethod(shippingMethod)
        }
    }
);
