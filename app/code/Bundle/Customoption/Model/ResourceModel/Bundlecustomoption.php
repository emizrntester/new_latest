<?php
namespace Bundle\Customoption\Model\ResourceModel;

class Bundlecustomoption extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('bundle_custom_option', 'id');
    }
}
?>