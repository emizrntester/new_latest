<?php
namespace Bundle\Customoption\Plugin\Ui\DataProvider\Product\Form\Modifier;

use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Ui\Component\Form\Element\DataType\Number;
use Magento\Bundle\Ui\DataProvider\Product\Form\Modifier\BundleCustomOptions as MagentoBundleCustomOptions;

class BundleCustomOptions
{

    // ...

    //const FIELD_CUSTOM_FIELD_OPTION_NAME = 'custom_field';

    public function afterModifyMeta(MagentoBundleCustomOptions $subject, array $meta)
    {
        if (isset($meta['bundle-items']['children']['bundle_options']['children']['record']['children']['product_bundle_container']['children']['bundle_selections']['children']['record']['children'])) {


            $meta['bundle-items']['children']['bundle_options']['children']['record']['children']['product_bundle_container']['children']['bundle_selections']['children']['record']['children']['custom_bundle_option'] = $this->getCuststomFieldOptionFieldConfig(125);


            // Reorder table headings

            $action_delete = $meta['bundle-items']['children']['bundle_options']['children']['record']['children']['product_bundle_container']['children']['bundle_selections']['children']['record']['children']['action_delete'];
            unset($meta['bundle-items']['children']['bundle_options']['children']['record']['children']['product_bundle_container']['children']['bundle_selections']['children']['record']['children']['action_delete']);
            $meta['bundle-items']['children']['bundle_options']['children']['record']['children']['product_bundle_container']['children']['bundle_selections']['children']['record']['children']['action_delete'] = $action_delete;

            // There should be more convenient way to reorder table headings

        }

        return $meta;
    }

    protected function getCuststomFieldOptionFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Reorder Days'),
                        'componentType' => Field::NAME,
                        'formElement' => \Magento\Ui\Component\Form\Element\Input::NAME,
                        'dataScope' => 'custom_bundle_option',
                        'dataType' => Number::NAME,
                        'sortOrder' => $sortOrder,
                        'validation'        => [
                        'validate-number'     => true,
                        ],
                    ],
                ],
            ],
        ];
    }

    // ...

}
?>