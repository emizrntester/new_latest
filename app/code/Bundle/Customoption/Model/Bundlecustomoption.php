<?php
namespace Bundle\Customoption\Model;

class Bundlecustomoption extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Bundle\Customoption\Model\ResourceModel\Bundlecustomoption');
    }
}
?>