<?php
namespace Bundle\Customoption\Preference\Model;

class LinkManagement extends \Magento\Bundle\Model\LinkManagement
{

    // ....

    /**
     * @param \Magento\Bundle\Model\Selection $selectionModel
     * @param \Magento\Bundle\Api\Data\LinkInterface $productLink
     * @param string $linkedProductId
     * @param string $parentProductId
     * @return \Magento\Bundle\Model\Selection
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    protected function mapProductLinkToSelectionModel(
        \Magento\Bundle\Model\Selection $selectionModel,
        \Magento\Bundle\Api\Data\LinkInterface $productLink,
        $linkedProductId,
        $parentProductId
    ) {

        $selectionModel = parent::mapProductLinkToSelectionModel($selectionModel, $productLink, $linkedProductId, $parentProductId);
        if ($productLink->getCustomBundleOption() !== null) {
            //print_r($productLink->getData());die;
            //echo $productLink->getCustomBundleOption();die;
            $selectionModel->setCustomBundleOption($productLink->getCustomBundleOption());
        }

        return $selectionModel;
    }

    // ....
}
?>