<?php

namespace Rsgitech\Customer\Block\Customer\Account;

use Magento\Framework\Exception\NoSuchEntityException;

class Info extends \Magento\Customer\Block\Account\Dashboard\Info
{
    public function getCustomField()
    {   
        
        return $this->getCustomer()->getCustomAttribute('my_customer_image')->getValue();
        //return "7682046341";
    }

    public function getProfilemage()
    {   
        if($this->getCustomer()->getCustomAttribute('my_customer_image')){
            return $this->getCustomer()->getCustomAttribute('my_customer_image')->getValue();
        }
        //return "7682046341";
    }
}
