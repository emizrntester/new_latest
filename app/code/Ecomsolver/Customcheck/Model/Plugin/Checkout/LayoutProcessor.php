<?php
  namespace Ecomsolver\Customcheck\Model\Plugin\Checkout;
class LayoutProcessor {
    public function afterProcess
        (
            \Magento\Checkout\Block\Checkout\LayoutProcessor $subject, array $jsLayout
        ) {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['custom_field'] =
            ['component' => 'Magento_Ui/js/form/element/abstract', 'config' =>
                [
                    'customScope' => 'shippingAddress.custom_attributes',
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/input',
                    'options' => [],
                    'id' => 'custom-field'
                ],
                'dataScope' => 'shippingAddress.custom_attributes.custom_field',
                'label' => 'Password',
                'provider' => 'checkoutProvider',
                'visible' => true,
                'validation' => [],
                'sortOrder' => 250,
                'id' => 'custom-field'
            ];
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['custom_field2'] =
            [
                'component' => 'Magento_Ui/js/form/element/abstract', 'config' =>
                [
                    'customScope' => 'shippingAddress.custom_attributes',
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/input',
                    'options' => [],
                    'id' => 'custom-field2'
                ],
                'dataScope' => 'shippingAddress.custom_attributes.custom_field2',
                'label' => 'Confirm Password',
                'provider' => 'checkoutProvider',
                'visible' => true,
                'validation' => [],
                'sortOrder' => 260,
                'id' => 'custom-field2'
            ];
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['custom_field3'] =
            [
                'component' => 'Magento_Ui/js/form/element/abstract',
                'config' =>
                [
                    'customScope' => 'shippingAddress.custom_attributes',
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/checkbox',
                    'options' => [],
                    'id' => 'custom-field3'
                ],
                'dataScope' => 'shippingAddress.custom_attributes.custom_field3',
                'label' => 'Create Account',
                'provider' => 'checkoutProvider',
                'visible' => true,
                'checked' => false,
                'validation' => [],
                'sortOrder' => 250,
                'id' => 'custom-field3'
            ];
        return $jsLayout;
    }
}