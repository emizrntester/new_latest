<?php 
namespace Shop\Town\Model;
use Magento\Framework\Model\AbstractModel;
class DataExample extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Shop\Town\Model\ResourceModel\DataExample');
    }
}

?>