<?php 
namespace Experius\CodeBlogAddressAttributeToCheckout\Plugin\Magento\Quote\Model;

class ShippingAddressManagement
{

    protected $logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function beforeAssign(
        \Magento\Quote\Model\ShippingAddressManagement $subject,
        $cartId,
        \Magento\Quote\Api\Data\AddressInterface $address
    ) {

        $extAttributes = $address->getExtensionAttributes();
         $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/extationattribute.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info("===========sdfsfsf=============");
        $logger->info($extAttributes);
        $getCustomAttributes = $address->getCustomAttributes();
        $logger->info("===========updateInvensdfsdfsdftory=============");
        $logger->info($getCustomAttributes);

        if (!empty($extAttributes)) {

            try {
                $address->setExample($extAttributes->getExample());
            } catch (\Exception $e) {
                $this->logger->critical($e->getMessage());
            }

        }

    }
}