
define([
        'ko',
        'uiComponent',
        'Magento_Checkout/js/model/quote',
        'Magento_Catalog/js/price-utils'

    ], function (ko, Component, quote, priceUtils) {
        'use strict';
        var show_hide_Extracharge_blockConfig = window.checkoutConfig.show_hide_Extracharge_shipblock;
        var fee_label = window.checkoutConfig.fee_label;         
        var custom_fee_amount = window.checkoutConfig.custom_fee_amount;
        
        return Component.extend({
            defaults: {
                template: 'Karim_Extracharge/checkout/shipping/custom-fee'
            },
            canVisibleExtrachargeBlock: show_hide_Extracharge_blockConfig,
            getFormattedPrice: ko.observable(priceUtils.formatPrice(custom_fee_amount, quote.getPriceFormat())),
            getFeeLabel:ko.observable(fee_label)
        });
    });
