<?php
namespace Spider\Tech\Model;

class Customerdetails extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Spider\Tech\Model\ResourceModel\Customerdetails');
    }
}
?>