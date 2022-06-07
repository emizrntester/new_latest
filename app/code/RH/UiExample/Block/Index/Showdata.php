<?php
namespace RH\UiExample\Block\index;
use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use RH\UiExample\Model\ResourceModel\Blog\CollectionFactory;
 
class Showdata extends Template
{
            // die("dsfasdf");
 
    public $collection;
 
    public function __construct(Context $context, CollectionFactory $CollectionFactory,\Magento\Store\Model\StoreManagerInterface $storeManager, array $data = [])
    {
        //echo "sdfsdfsffffffffffff";die;
        $this->collection = $CollectionFactory;
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;       
    }
 
    public function getCollection()
        {
            $post=$this->collection->create();
            // echo $post->getCollection()->getSelect();die;
            return $post;
            // ->getCollection();
        }
    public function render($logo)
    {   
        $mediaDirectory = $this->_storeManager->getStore()->getBaseUrl(
           \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
       );
       // print_r($mediaDirectory);
        //exit();
        if(isset($logo)):
           
            if(!empty($logo)):
                 $imageUrl = $mediaDirectory.'testimg/'.$logo;
                $img='<img src="'.$imageUrl.'" width="100" height="100"/>';
        else:    
                $img='<img src="'.$mediaDirectory.'testimg/white.png'.'" width="100" height="100"/>';
        endif;

        else:
            $img='<img src="'.$mediaDirectory.'testimg/white.png'.'" width="100" height="100"/>';
        endif;
        return $img;
    }
}
