<?php
namespace Shop\Town\Block\Adminhtml\Customerdetails\Edit;

/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('customerdetails_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Customerdetails Information'));
    }
}