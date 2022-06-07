<?php
namespace Emizen\Techdata\Model;
use Magento\Framework\Model\AbstractModel;
class Test extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Emizen\Techdata\Model\ResourceModel\Test');
    }
}