<?php

namespace Spider\Tech\Model\ResourceModel\Customerdetails;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Spider\Tech\Model\Customerdetails', 'Spider\Tech\Model\ResourceModel\Customerdetails');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>