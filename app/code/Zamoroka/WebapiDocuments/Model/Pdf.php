<?php

namespace Zamoroka\WebapiDocuments\Model;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\ValidatorException;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Zamoroka\WebapiDocuments\Api\PdfInterface;

/**
 * Class BlogManagement
 */
class Pdf implements PdfInterface
{
    public const FILE_TYPE = 'image/png';
    /** @var Http */
    private $request;
    /** @var Filesystem */
    private $filesystem;
    /** @var UploaderFactory */
    private $uploaderFactory;
    /** @var Filesystem\Directory\WriteInterface */
    private $varDirectory;

    /**
     * BlogManagement constructor.
     *
     * @param Http $request
     * @param Filesystem $filesystem
     * @param UploaderFactory $uploaderFactory
     *
     * @throws FileSystemException
     */
    public function __construct(
        Http $request,
        Filesystem $filesystem,
        UploaderFactory $uploaderFactory
    ) {
        $this->request = $request;
        $this->filesystem = $filesystem;
        $this->uploaderFactory = $uploaderFactory;
        $this->varDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
    }

    /**
     * @inheritDoc
     */
    public function upload(): string
    {
        try {

            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
             
            $storeManager->getStore()->getBaseUrl();  // to get Base Url
            $mediaurl = $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA); // to get Base Media url
         
          $resultJsonFactory = $objectManager->get('\Magento\Framework\Controller\Result\JsonFactory');
           // print_r($_FILES['upload']);die;
            $fileInfo = $_FILES['upload']['name'];
           // echo $fileInfo;
           //print_r($fileInfo['upload']['name']);die;
            $this->validateFile($_FILES['upload']);
           $res = $this->saveFile($_FILES['upload']['name']);
           if($res){
             $resultJson = $resultJsonFactory->create();
             return $url = $mediaurl.'webapidocuments/'.$_FILES['upload']['name'];;
             //return $resultJson->setData(['message' => 'come from json']);
           
           }
            return 'File successfully uploaded';
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @param array $fileInfo
     *
     * @throws ValidatorException
     */
    private function validateFile(array $fileInfo)
    {
        if (!$fileInfo) {
            throw new ValidatorException(__('File info is not set'));
        }
        if (!is_array($fileInfo)) {
            throw new ValidatorException(__('File data should be an array'));
        }
        if (isset($fileInfo['error']) && $fileInfo['error']) {
            throw new ValidatorException(__('Unknown error'));
        }
        if (!isset($fileInfo['name'])) {
            throw new ValidatorException(__('File name is not set'));
        }
        if (!isset($fileInfo['type']) || $fileInfo['type'] !== self::FILE_TYPE) {
            throw new ValidatorException(__('File type is not valid'));
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function saveFile()
    {


          $target = $this->varDirectory->getAbsolutePath('webapidocuments/');        
        /** @var $uploader \Magento\MediaStorage\Model\File\Uploader */
        $uploader = $this->uploaderFactory->create(['fileId' => 'upload']);
        /** Allowed extension types */
        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png', 'zip', 'doc', 'pdf']);
        /** rename file name if already exists */
        $uploader->setAllowRenameFiles(false);
        /** upload file in folder "mycustomfolder" */
        //echo $target;die;
       return $result = $uploader->save($target);
       // if($result){
       //  $target.''
       // }
        // $uploader = $this->uploaderFactory->create(['fileId' => $_FILES['upload']['name']]);
        // $workingDir = $this->varDirectory->getAbsolutePath('webapidocuments/');

        //return $uploader->save($workingDir);
    }
}
