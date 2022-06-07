<?php
namespace Emizen\Techdata\Block\Adminhtml\Grid\Edit;

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
        $this->setId('techdata');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Techdata Menu'));
    }
}