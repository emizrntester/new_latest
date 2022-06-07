<?php
namespace Emizen\Techdata\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Test extends AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('techdata', 'id');   //here "vky_test" is table name and "test_id" is the primary key of custom table
    }
}