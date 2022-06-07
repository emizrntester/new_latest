<?php
namespace Shop\Town\Model;

class Customerdetails extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Shop\Town\Model\ResourceModel\Customerdetails');
    }
}
?>