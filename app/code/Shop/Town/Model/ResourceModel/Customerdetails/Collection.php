<?php

namespace Shop\Town\Model\ResourceModel\Customerdetails;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Shop\Town\Model\Customerdetails', 'Shop\Town\Model\ResourceModel\Customerdetails');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>