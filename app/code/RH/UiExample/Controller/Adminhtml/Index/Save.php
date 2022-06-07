<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Created By : Rohan Hapani
 */
namespace RH\UiExample\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use RH\UiExample\Model\Blog;
USE RH\UiExample\Model\ImageUploader;


class Save extends \Magento\Backend\App\Action
{

    /**
     * @var Blog
     */
    protected $uiExamplemodel;
    protected $ImageUploader;

    /**
     * @var Session
     */
    protected $adminsession;

    /**
     * @param Action\Context $context
     * @param Blog           $uiExamplemodel
     * @param Session        $adminsession
     */
    public function __construct(
        Action\Context $context,
        Blog $uiExamplemodel,
        Session $adminsession,
        ImageUploader $ImageUploader
    ) {
        parent::__construct($context);
        $this->uiExamplemodel = $uiExamplemodel;
        $this->adminsession = $adminsession;
        $this->ImageUploader=$ImageUploader;
    }

    /**
     * Save blog record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        {
   if (isset($data['logo'][0]['name']) && isset($data['logo'][0]['tmp_name'])) {
                $data['logo'] = $data['logo'][0]['name'];
                $this->ImageUploader->moveFileFromTmp($data['logo']);
               // print_r($data);die("asda");
            } elseif (isset($data['logo'][0]['name']) && !isset($data['logo'][0]['tmp_name'])) {
                $data['logo'] = $data['logo'][0]['name'];
            } else {
                $data['logo'] = '';
            }
}

        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $blog_id = $this->getRequest()->getParam('blog_id');
            if ($blog_id) {
                $this->uiExamplemodel->load($blog_id);
            }

            $this->uiExamplemodel->setData($data);

            try {
                $this->uiExamplemodel->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->adminsession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return $resultRedirect->setPath('*/*/add');
                    } else {
                        return $resultRedirect->setPath('*/*/edit', ['blog_id' => $this->uiExamplemodel->getBlogId(), '_current' => true]);
                    }
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['blog_id' => $this->getRequest()->getParam('blog_id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }

        // return $data;           
}