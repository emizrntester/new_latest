<?php
namespace Emizen\Learn\Observer;
 
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\View\LayoutInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Serialize\SerializerInterface;
 
class CheckoutCartAddObserver implements ObserverInterface
{
    protected $layout;
    protected $storeManager;
    protected $request;
    private $serializer;
 
    public function __construct(
        StoreManagerInterface $storeManager,
        LayoutInterface $layout,
        RequestInterface $request,
        SerializerInterface $serializer,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->layout = $layout;
        $this->storeManager = $storeManager;
        $this->request = $request;
        $this->serializer = $serializer;
        $this->logger = $logger;
    }
 
    public function execute(EventObserver $observer)
    {
 
        $item = $observer->getQuoteItem();
        $post = $this->request->getPost();


       // $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/integerbyte.log');
       // $logger = new \Zend\Log\Logger();
//$logger->addWriter($writer);
       // $logger->info('Your text message');
/*        $logger->info($item->debug());
*/ 

         $this->logger->info("testing==================");
         $this->logger->info(print_r($item->debug()));
 
        $additionalOptions = array();
        if ($additionalOption = $item->getOptionByCode('additional_options')) {
            $additionalOptions = $this->serializer->unserialize($additionalOption->getValue());
                $productDescription = $objectManager->get('Magento\Catalog\Model\Product')->load($_item->getProductId())->getDescription();
        }
 
        $additionalOptions[] = [
            'label' => 'Quality',
            'value' => 'Good'
        ];
 
        if (count($additionalOptions) > 0) {
            $item->addOption(array(
                'product_id' => $item->getProductId(),
                'code' => 'additional_options',
                'value' => $this->serializer->serialize($additionalOptions)
            ));
        }


   



 
    }
}
