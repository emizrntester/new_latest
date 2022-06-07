<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : Rohan Hapani
 */

namespace Emizen\Techdata\Controller\Adminhtml\grid;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Auth\Session;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $_adminSession;

    /**
     * @var \Rh\Blog\Model\BlogFactory
     */
    // die("asdas");
    protected $TestFactory;
    protected $_mediaDirectory;
    protected $_fileUploaderFactory;

    /**
     * @param Action\Context                      $context
     * @param \Magento\Backend\Model\Auth\Session $adminSession
     * @param \Rh\Blog\Model\BlogFactory          $TestFactory
     */
    public function __construct(
        Action\Context $context,
        \Magento\Backend\Model\Auth\Session $adminSession,
        \Emizen\Techdata\Model\TestFactory $TestFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory
    ) {
        parent::__construct($context);
        $this->_adminSession = $adminSession;
        $this->TestFactory = $TestFactory;
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->_fileUploaderFactory = $fileUploaderFactory;
    }

    /**
     * Save blog record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {

        $postObj = $this->getRequest()->getPostValue();


        /** @var $uploader \Magento\MediaStorage\Model\File\Uploader */
        // print_r($_FILES);
        // die("asdasd");
        if (isset($_FILES['image']['name'])) {
            if ($_FILES['image']['name'] == "") {
                $image = "";
            } else {
                $uploader = $this->_fileUploaderFactory->create(['fileId' => 'image']);
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png', 'zip', 'doc']);
                /** rename file name if already exists */
                $uploader->setAllowRenameFiles(true);
                $target = $this->_mediaDirectory->getAbsolutePath('Town/');
                /** upload file in folder "mycustomfolder" */
                $result = $uploader->save($target);
                $image = $result['file'];
            }
        } else {
            $image = "";
        }

        $name = $postObj["name"];
        $date = date("Y-m-d");
        $username = $this->_adminSession->getUser()->getFirstname();


        if ($username == $name) {
            $username = $this->_adminSession->getUser()->getFirstname();
        } else {
            $username = $name;
        }

        $userDetail = ["name" => $username, "created_at" => $date];
        $data = array_merge($postObj, $userDetail);

        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {

            $model = $this->TestFactory->create();
            $id = $this->getRequest()->getParam('id');

            if ($id) {
                $model->load($id);

                if ($image != "") {
                    $data['image'] = $image;
                }else{
                    $image=$data['image']['value'];
                    $data['image'] = $image;
                }
            } else {


                // die("asd---------------------");
                $data['image'] = $image;
            }

            // print_r($data);
            // die("ds");

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->_adminSession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('techdata/*/edit', ['id' => $model->getId(), '_current' => true]);
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
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
