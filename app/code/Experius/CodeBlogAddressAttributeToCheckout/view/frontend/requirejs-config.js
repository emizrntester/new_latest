var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/action/set-billing-address': {
                'Experius_CodeBlogAddressAttributeToCheckout/js/action/set-billing-address-mixin': true
            },
            'Magento_Checkout/js/action/set-shipping-information': {
                'Experius_CodeBlogAddressAttributeToCheckout/js/action/set-shipping-information-mixin': true
            },
            'Magento_Checkout/js/action/create-shipping-address': {
                'Experius_CodeBlogAddressAttributeToCheckout/js/action/create-shipping-address-mixin': true
            },
            'Magento_Checkout/js/action/place-order': {
                'Experius_CodeBlogAddressAttributeToCheckout/js/action/set-billing-address-mixin': true
            },
            'Magento_Checkout/js/action/create-billing-address': {
                'Experius_CodeBlogAddressAttributeToCheckout/js/action/set-billing-address-mixin': true
            }
        }
    }
};