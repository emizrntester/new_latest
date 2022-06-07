<?php
namespace RH\UiExample\Controller\index;
use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use RH\UiExample\Model\DataProvider;
 
class Showdata extends Template
{
                 // print_r("expression");die("asdfasd");

    public $collection;
 
    public function __construct(Context $context, DataProvider $DataProvider, array $data = [])
    {
        $this->collection = $DataProvider;
        parent::__construct($context, $data);
    }
 
    public function getCollection()
        {
            $post=$this->collection->create();
            // echo $post->getCollection()->getSelect();
            // die("dsfasdf");
            return $post->getCollection();
        }
 
}




