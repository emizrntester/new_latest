<?php
 
namespace Emizen\Techdata\Controller\Index;

use Emizen\Techdata\Model\TestFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
 
class Index extends \Magento\Framework\App\Action\Action
{
    protected $_Test;
    protected $_resultPageFactory;
    protected $resultRedirect;

 
    public function __construct(
         Context $context,   
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Emizen\Techdata\Model\TestFactory  $Test,
        \Magento\Framework\Controller\ResultFactory $result)
    {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
        $this->resultRedirect = $result;
        $this->_Test = $Test;

    }
 
    public function execute()
    {
        $post = (array) $this->getRequest()->getPost();
        if (!empty($post)) {

            // $uploader = $this->_fileUploaderFactory->create(['fileId' => 'Upload_img']);   
            $resultRedirect = $this->resultRedirect->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            // print_r($post);
            
            $model = $this->_Test->create();
            $model->addData([
                "name" => $post['name'],
                "email" => $post['email'],
                "telephone" => $post['telephone'],
                "image" =>$_FILES['image']['name']
]); 
            if(isset($_FILES['image']['name'])) {
                    $uploader = $this->_uploaderFactory->create(['fileId' => 'image']);
                    $workingDir = $this->_varDirectory->getAbsolutePath('Town/');
                    $result = $uploader->save($workingDir);
                }

            $saveData = $model->save();

            if ($saveData) {
                            $this->messageManager->addSuccess(__('Your registertion is successfull'));
            }
                return $resultRedirect;
        }   

              $resultPage = $this->_resultPageFactory->create();
             return $resultPage;
    }
}









      
          