<?php
namespace Shop\Town\Model\ResourceModel;
class DataExample extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('Customerdetails', 'id');   //here "collegeform" is table name and "id" is the primary key of custom table
    }
}