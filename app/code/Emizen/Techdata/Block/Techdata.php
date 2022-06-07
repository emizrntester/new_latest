<?php
namespace Emizen\Techdata\Block;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
 
class Techdata extends Template
{
    public function __construct(Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        // print_r($data);
        // die("asd");
    }
 
    public function getFormAction()
    {
        return $this->getUrl('techdata/index/index', ['_secure' => true]);
    }
}
