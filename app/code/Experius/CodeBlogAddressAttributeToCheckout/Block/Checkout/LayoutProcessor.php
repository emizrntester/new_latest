<?php

namespace Experius\CodeBlogAddressAttributeToCheckout\Block\Checkout;

class LayoutProcessor implements \Magento\Checkout\Block\Checkout\LayoutProcessorInterface
{
    
    public function process($result) {
       $customAttributeCode = 'default_shipping';
            $customField = [
                'component' => 'Magento_Ui/js/form/element/abstract',
                'config' => [
                    // customScope is used to group elements within a single form (e.g. they can be validated separately)
                    'customScope' => 'shippingAddress.custom_attributes',
                    'customEntry' => null,
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/checkbox',
                    'tooltip' => [
                        'description' => 'this is what the field is for',
                    ],
                ],
                'dataScope' => 'shippingAddress.custom_attributes' . '.' . $customAttributeCode,
                'label' => 'Default Shipping',
                'provider' => 'checkoutProvider',
                'sortOrder' => 0,
                'validation' => [
                   'required-entry' => false
                ],
                'value' => 0,
                'filterBy' => null,
                'customEntry' => null,
                'visible' => true,
            ];

$result['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$customAttributeCode] = $customField;

     //   $result = $this->getBillingFormFields($result);

// $result['components']['checkout']['children']['steps']['children']['billing-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$customAttributeCode] = $customField;
        return $result;
     }

    public function getAdditionalFields($addressType='shipping'){
        if($addressType=='shipping') {
            return ['default_shipping'];
        }
        return  ['default_shipping'];
    }

    public function getShippingFormFields($result){


        // $customAttributeCode = 'default_shipping';
        // $customField = [
        //     'component' => 'Magento_Ui/js/form/element/abstract',
        //     'config' => [
        //         // customScope is used to group elements within a single form (e.g. they can be validated separately)
        //         'customScope' => 'shippingAddress.custom_attributes',
        //         'customEntry' => null,
        //         'template' => 'ui/form/field',
        //         'elementTmpl' => 'ui/form/element/input',
        //         'tooltip' => [
        //             'description' => 'this is what the field is for',
        //         ],
        //     ],
        //     'dataScope' => 'shippingAddress.custom_attributes' . '.' . $customAttributeCode,
        //     'label' => 'Custom Attribute',
        //     'provider' => 'checkoutProvider',
        //     'sortOrder' => 11,
        //     'validation' => [
        //        'required-entry' => false
        //     ],
        //     'options' => [],
        //     'filterBy' => null,
        //     'customEntry' => null,
        //     'visible' => true,
        // ];
        // $result['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$customAttributeCode] = $customField;

        // if(isset($result['components']['checkout']['children']['steps']['children']
        //         ['shipping-step']['children']['shippingAddress']['children']
        //         ['shipping-address-fieldset'])
        // ){

        //     $shippingPostcodeFields = $this->getFields('shippingAddress.custom_attributes','shipping');

        //     $shippingFields = $result['components']['checkout']['children']['steps']['children']
        //     ['shipping-step']['children']['shippingAddress']['children']
        //     ['shipping-address-fieldset']['children'];

        //     if(isset($shippingFields['street'])){
        //         unset($shippingFields['street']['children'][1]['validation']);
        //         unset($shippingFields['street']['children'][2]['validation']);
        //     }

        //     $shippingFields = array_replace_recursive($shippingFields,$shippingPostcodeFields);

        //     $result['components']['checkout']['children']['steps']['children']
        //     ['shipping-step']['children']['shippingAddress']['children']
        //     ['shipping-address-fieldset']['children'] = $shippingFields;

        // }
        //print_r($result);die;

        return $result;
    }

    public function getBillingFormFields($result){
        if(isset($result['components']['checkout']['children']['steps']['children']
            ['billing-step']['children']['payment']['children']
            ['payments-list'])) {

            $paymentForms = $result['components']['checkout']['children']['steps']['children']
            ['billing-step']['children']['payment']['children']
            ['payments-list']['children'];

            foreach ($paymentForms as $paymentMethodForm => $paymentMethodValue) {

                $paymentMethodCode = str_replace('-form', '', $paymentMethodForm);

                if (!isset($result['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children'][$paymentMethodCode . '-form'])) {
                    continue;
                }

                $billingFields = $result['components']['checkout']['children']['steps']['children']
                ['billing-step']['children']['payment']['children']
                ['payments-list']['children'][$paymentMethodCode . '-form']['children']['form-fields']['children'];

                $billingPostcodeFields = $this->getFields('billingAddress' . $paymentMethodCode . 'custom_attributes','billing');

                $billingFields = array_replace_recursive($billingFields, $billingPostcodeFields);

                $result['components']['checkout']['children']['steps']['children']
                ['billing-step']['children']['payment']['children']
                ['payments-list']['children'][$paymentMethodCode . '-form']['children']['form-fields']['children'] = $billingFields;
            }
        }

        return $result;
    }

    public function getFields($scope,$addressType){
        $fields = [];
        foreach($this->getAdditionalFields($addressType) as $field){
            $fields[$field] = $this->getField($field,$scope);
        }
        return $fields;
    }

    public function getField($attributeCode,$scope) {
        $field = [
            'config' => [
                'customScope' => $scope,
            ],
            'dataScope' => $scope . '.'.$attributeCode,
        ];

        return $field;
    }

}
