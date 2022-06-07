<?php
/**
 * Copyright © 2022 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mock\Exam\Controller\Adminhtml\Mockexam;

class Delete extends \Mock\Exam\Controller\Adminhtml\Mockexam
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('mockexam_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Mock\Exam\Model\Mockexam::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Mockexam.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['mockexam_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Mockexam to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

