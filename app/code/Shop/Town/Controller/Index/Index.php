<?php

namespace Shop\Town\Controller\Index;

use Shop\Town\Model\DataExampleFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;


class Index extends \Magento\Framework\App\Action\Action
{

    protected $_dataExample;
    protected $resultRedirect;

    public function __construct(

        \Magento\Framework\App\Action\Context $context,
        \Shop\Town\Model\DataExampleFactory  $dataExample,
        \Magento\Framework\Controller\ResultFactory $result,
          \Magento\Framework\Filesystem $filesystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $_uploaderFactory
    ) {
        parent::__construct($context);
        $this->_dataExample = $dataExample;
        $this->resultRedirect = $result;
        $this->_uploaderFactory = $_uploaderFactory;
        $this->_varDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
 
    }


    public function execute()
    {

        $post = (array) $this->getRequest()->getPost();
        
        if (!empty($post)) {

            // $uploader = $this->_fileUploaderFactory->create(['fileId' => 'Upload_img']);   
            $resultRedirect = $this->resultRedirect->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            // print_r($post);
            
            $model = $this->_dataExample->create();
            $model->addData([
                "full_name" => $post['full_name'],
                "address" => $post['address'],
                "email" => $post['email'],
                "phone" => $post['phone'],
                "Upload_img" =>$_FILES['Upload_img']['name']

      ]); 
          if(isset($_FILES['Upload_img']['name'])) {
                    $uploader = $this->_uploaderFactory->create(['fileId' => 'Upload_img']);
                    $workingDir = $this->_varDirectory->getAbsolutePath('Town/');
                    $result = $uploader->save($workingDir);
                }
                   
                  
            $saveData = $model->save();
            if ($saveData) {
                $this->messageManager->addSuccess(__('Your registertion is successfull'));
            }
            return $resultRedirect;
        }
        
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
        // print_r("Please Enter Your detiles");

    }
}
