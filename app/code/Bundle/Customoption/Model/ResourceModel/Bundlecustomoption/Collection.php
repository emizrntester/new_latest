<?php

namespace Bundle\Customoption\Model\ResourceModel\Bundlecustomoption;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Bundle\Customoption\Model\Bundlecustomoption', 'Bundle\Customoption\Model\ResourceModel\Bundlecustomoption');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>