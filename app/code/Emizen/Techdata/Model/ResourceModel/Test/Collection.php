<?php
namespace Emizen\Techdata\Model\ResourceModel\Test;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Emizen\Techdata\Model\Test',
            'Emizen\Techdata\Model\ResourceModel\Test'
        );
    }
}