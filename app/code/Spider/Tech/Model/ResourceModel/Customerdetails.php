<?php
namespace Spider\Tech\Model\ResourceModel;

class Customerdetails extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Customerdetails', 'id');
    }
}
?>