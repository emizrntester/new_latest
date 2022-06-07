<?php
namespace Myvendor\Mymodule\Observer;
 
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
        SerializerInterface $serializer
    )
    {
        $this->layout = $layout;
        $this->storeManager = $storeManager;
        $this->request = $request;
        $this->serializer = $serializer;
    }
 
    public function execute(EventObserver $observer)
    {
 
        $item = $observer->getQuoteItem();
        $post = $this->request->getPost();
 
 
        $additionalOptions = array();
        if ($additionalOption = $item->getOptionByCode('additional_options')) {
            $additionalOptions = $this->serializer->unserialize($additionalOption->getValue());
        }
 
        $additionalOptions[] = [
            'label' => 'Size',
            'value' => 'XL'
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
