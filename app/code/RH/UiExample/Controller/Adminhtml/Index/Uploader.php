<?php

namespace RH\UiExample\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;

class Uploader extends \Magento\Backend\App\Action
{
    public $ImageUploader;
   
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \RH\UiExample\Model\ImageUploader $ImageUploader
    ) {
        parent::__construct($context);
        $this->ImageUploader = $ImageUploader;
    }
    
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('RH_UiExample::category');
    }
   // imageId
    public function execute()
    {
        $imageId = $this->_request->getParam('param_name', 'logo');

        try {
            $result = $this->ImageUploader->saveFileToTmpDir($imageId);
            $result['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}