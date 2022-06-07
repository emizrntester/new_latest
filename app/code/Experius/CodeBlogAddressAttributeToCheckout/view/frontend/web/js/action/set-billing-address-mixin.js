define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote'
], function ($, wrapper,quote) {
    'use strict';

    return function (setBillingAddressAction) {
        return wrapper.wrap(setBillingAddressAction, function (originalAction, messageContainer) {

            var billingAddress = quote.billingAddress();

            if(billingAddress != undefined) {
             //   billingAddress['extension_attributes']['default_shipping'] = billingAddress.customAttributes['default_shipping'];
            // pass execution to original action ('Magento_Checkout/js/action/set-shipping-information')
            return originalAction();
            }

            return originalAction(messageContainer);
        });
    };
});