<?php
namespace Magezon\Deliverydate\Observer;
class SaveToOrder implements \Magento\Framework\Event\ObserverInterface
{   

	protected $logger;
	public function __construct(\Psr\Log\LoggerInterface $logger)
	{
	    $this->logger = $logger;
	}



    public function execute(\Magento\Framework\Event\Observer $observer)
    {
    	// print_r("Save to order");
    	// die("HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH");
        $event = $observer->getEvent();
        $quote = $event->getQuote();
    	$order = $event->getOrder();
           $order->setData('delivery_date', $quote->getData('delivery_date'));

          // $this->logger->info(print_r($order->debug(), true));

		/*	$writer = new \Laminas\Log\Writer\Stream(BP . '/var/log/test.log');
			$logger = new \Zend\Log\Logger();
			$logger->addWriter($writer);
			$logger->info('Custom text message'); 
			$logger->info(print_r($order->getData(), true)); 
*/


			
        $order->Save();
    }
}