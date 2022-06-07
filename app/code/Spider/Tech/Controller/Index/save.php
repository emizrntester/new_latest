<?php

namespace Spider\Tech\Controller\Index;

use Spider\Tech\Model\DataExampleFactory;
use Magento\Framework\Controller\ResultFactory;


class save extends \Magento\Framework\App\Action\Action
{
    protected $_dataExample;
    protected $resultRedirect;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Spider\Tech\Model\DataExampleFactory  $dataExample,
        \Magento\Framework\Controller\ResultFactory $result
    ) {
        parent::__construct($context);
        $this->_dataExample = $dataExample;
        $this->resultRedirect = $result;
    }

    public function execute()
    {
        $post = (array) $this->getRequest()->getPost();

        if (!empty($post)) {

            $full_name = $post['full_name'];
            $email = $post['email'];
            $phone = $post['phone'];

            $this->messageManager->addSuccessMessage('Your Details submit successfully');
            // Redirect to your form page (or anywhere you want...)
            $resultRedirect = $this->resultRedirect->create(ResultFactory::TYPE_REDIRECT);
            $model = $this->_dataExample->create();
            $model->setData($post);

            $saveData = $model->save();
            if ($saveData) {
                $this->messageManager->addSuccess(__('Your registertion is successfull'));
                 $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            }
            // return $resultRedirect;

            return $resultRedirect;
        }
        // 2. GET request : Render the booking page 
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
