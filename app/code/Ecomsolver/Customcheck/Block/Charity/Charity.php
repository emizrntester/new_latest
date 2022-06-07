<?php
namespace Ecomsolver\Customcheck\Block\Charity;

class Charity extends \Magento\Framework\View\Element\Template
{
    public function getWelcomeText()
    {
        return 'Hello World';
    }
}



































// use Magento\Sales\Api\Data\OrderInterface;
// class Charity extends \Magento\Backend\Block\Template
// {
//     public function __construct(
//         \Magento\Backend\Block\Widget\Context $context,
//         OrderInterface $orderInterface,
//         array $data = []
//     ) {
//         $this->orderInterface = $orderInterface;
//         parent::__construct($context, $data);
//     }
//     public function getAgree(){
        
//         $orderId = $this->getRequest()->getParam('order_id');
//         $order = $this->orderInterface->load($orderId);

//         return $order->getAgree();
//     }
// }
