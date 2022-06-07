<?php
namespace Bundle\Customoption\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;

class OrderObserver implements ObserverInterface
{
    /**
     * @var ObjectManagerInterface
     */
    protected $_objectManager;
    protected $messageManager;

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Quote\Model\QuoteFactory $quoteFactory,
        \Magento\Sales\Model\Order $order,
        ManagerInterface $messageManager
    )
    {
        $this->_objectManager = $objectManager;
        $this->messageManager = $messageManager;

    }


    public function execute(Observer $observer)
    {
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $order = $observer->getEvent()->getOrder();
        $orderId = $order->getId();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $order = $objectManager->create('Magento\Sales\Model\Order')->load($orderId);
        $email = $order->getCustomerEmail();
        $orderItems = $order->getAllItems();
         $model = $this->_objectManager->create('Bundle\Customoption\Model\Bundlecustomoption');
        foreach ($orderItems as $item) {
            if($item->getParentItemId() == null){
                $parent_product_id = $item->getProductId();

            }
                $product_id = $item->getProductId();
                $product = $objectManager->create('Magento\Catalog\Model\Product')->load($parent_product_id);
                 try{
                        $selectionCollection = $product->getTypeInstance(true)->getSelectionsCollection(
                        $product->getTypeInstance(true)->getOptionsIds($product), $product);
                    } catch (\Exception $e) {
                        $logger->critical($e->getMessage());
                    }
                    $data1 = '';

                    foreach ($selectionCollection as $key => $value) 
                    { 
                        if($item->getProductId() == $value['product_id']){
                              if($value['custom_bundle_option'])
                                {
                                  $data1 = $value['custom_bundle_option'];

                                }
                        }
                      
                    }
                /*if($product->getTypeId() == 'bundle'){
                    continue;
                }*/

                $data['order_id'] = $orderId;
                $data['item_id'] = $item->getId();
                $data['custom_bundle_option'] = $data1;
                $data['product_id'] = $product_id;
                $model->setData($data);
                $model->save();


         }

        
        

    }
}
?>