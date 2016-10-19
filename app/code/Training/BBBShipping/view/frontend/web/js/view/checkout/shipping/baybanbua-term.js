/**
 * Created by smart on 10/3/2016.
 */
define([
    'uiComponent',
    'jquery',
    'ko',
    'Magento_Checkout/js/model/quote'
], function (Component,$,ko,quote) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Training_BBBShipping/checkout/shipping/baybanbua-term'
        },
        initialize: function() {
            var _this = this;
            _this.ratesText = ko.observable('aaaaa');
            _this._super().getRates();
        },
        getRates:function () {
            var _this = this;
            $.ajax({
                url: 'http://bbbws.local/server_processing.php',
                data: "format=json&getRate=eyJ1c2VybmFtZSI6ImRvbmd0aGFuaCIsInBhc3N3b3JkIjoidGhhbmhAMTIzIiwibGljZW5zZSI6ImFjYmQxMjM0NSJ9",
                type: 'GET',
                /*fail: function (res) {
                 alert('Has some error. Check console please');
                 var responseText = $.parseJSON(res.responseText);
                 console.log(responseText.message);
                 self.enableAddToCartButton(form);
                 },*/
                success: function(rates) {
                    var htmlForm ='<ul style="list-style-type: none;">';
                    for(var index in rates['rates'])
                    {
                        var rate = rates['rates'][index];
                        htmlForm += '<li><input type="radio" class="rate_radio" value="'+rate['value']+'"><span style="color: grey;font-weight: bold">'+rate['name']+':  </span><span style="color: green">$';
                        htmlForm += rate['value']+'</span></li>';
                    }
                    htmlForm+='</ul>';
                   _this.ratesText = ko.observable(htmlForm);
                }
            });
        },
        isShowed: ko.computed(function () {
            if(!quote.shippingMethod())
            {
                return false;
            }

            if('baybanbua' == quote.shippingMethod().carrier_code)
            {
                return true;
            }

           return false;
        })
    });
});
