<?php  
namespace Emizen\Techdata\Block\Adminhtml\Town\Grid\Renderer;

class Image extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    protected $_storeManager;


    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,      
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;        
    }


    public function render(\Magento\Framework\DataObject $row)
    {   
        $mediaDirectory = $this->_storeManager->getStore()->getBaseUrl(
           \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
       );
       // print_r($mediaDirectory);
        //exit();
        if(isset($row['image'])):
            $imageUrl = $mediaDirectory.'Town/'.$row['image'];
            $img='<img src="'.$imageUrl.'" width="100" height="100"/>';
        else:
            $img='<img src="'.$mediaDirectory.'Town/no-img.jpg'.'" width="100" height="100"/>';
        endif;
        return $img;
    }
}