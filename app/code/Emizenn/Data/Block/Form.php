<?php
namespace Emizenn\Data\Block;
class Form extends \Magento\Framework\View\Element\Template
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    public function hello()
    {
        return "Welcome";
    }
} 	
