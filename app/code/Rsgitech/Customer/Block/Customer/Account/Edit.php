<?php

namespace Rsgitech\Customer\Block\Customer\Account;


use Magento\Backend\Block\Template\Context;
use Magento\Framework\UrlInterface;
use Magento\Customer\Model\SessionFactory;

class Edit extends \Magento\Framework\View\Element\Template
{        
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
    * @var \Magento\Store\Model\StoreManagerInterface $storeManager
    */
    protected $storeManager;

    /**
     * @var \Magento\Customer\Model\Customer 
     */
    protected $customerModel;

    public function __construct(
        Context $context,
        UrlInterface $urlBuilder,
        SessionFactory $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\Customer $customerModel,
        array $data = []
    )
    {        
        $this->urlBuilder            = $urlBuilder;
        $this->customerSession       = $customerSession->create();
        $this->storeManager          = $storeManager;
        $this->customerModel         = $customerModel;

        parent::__construct($context, $data);

        $collection = $this->getContracts();
        $this->setCollection($collection);
    }

    public function getBaseUrl()
    {
        return $this->storeManager->getStore()->getBaseUrl();
    }

    public function getMediaUrl()
    {
        //return $this->getBaseUrl() . 'pub/media/';
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA );
    }

    public function getCustomerLogoUrl($logoPath)
    {
        return $this->getMediaUrl() . 'customer' . $logoPath;
    }

    public function getLogoUrl()
    {
        $customerData = $this->customerModel->load($this->customerSession->getId());
        $logo = $customerData->getData('my_customer_image');
        if (!empty($logo)) {
            return $this->getCustomerLogoUrl($logo);
        }
        return false;
    }

    public function getCustomField()
    {	
    	//$sv = $this->customerSession->getCustomer()->getCustomerNumber();
    	//custom_log($sv);
        return $this->customerSession->getCustomer()->getCustomerNumber();
        //return "9602042321";
    }
}


// class Edit extends \Magento\Customer\Block\Form\Edit
// {
//     public function getCustomField()
//     {	
//     	//$sv = $this->customerSession->getCustomer()->getCustomerNumber();
//     	//custom_log($sv);
//         return $this->customerSession->getCustomer()->getCustomerNumber();
//         //return "9602042321";
//     }

// }
