<?php
namespace Spider\Tech\Block\index;
use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Spider\Tech\Model\CustomerdetailsFactory;
 
class Showdata extends Template
{
 
    public $collection;
 
    public function __construct(Context $context, CustomerdetailsFactory $CustomerdetailsFactory, array $data = [])
    {
        $this->collection = $CustomerdetailsFactory;
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
