<?php 
namespace Spider\Tech\Model;
use Magento\Framework\Model\AbstractModel;
class DataExample extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Spider\Tech\Model\ResourceModel\DataExample');
    }
}

?>