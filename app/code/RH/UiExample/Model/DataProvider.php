<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Created By : Rohan Hapani
 */
namespace RH\UiExample\Model;

use RH\UiExample\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    /**
     * @var array
     */
    protected $loadedData;
    protected $_storeManager;



    // @codingStandardsIgnoreStart
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $blogCollectionFactory,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $blogCollectionFactory->create();
         $this->_storeManager=$storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    // @codingStandardsIgnoreEnd

    public function getData()
    {

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        foreach ($items as $blog) {
           // echo $blog->getImage();die;
            $this->loadedData[$blog->getBlogId()] = $blog->getData();
            if ($blog->getLogo()) {

            $m['logo'][0]['name'] = $blog->getLogo();
            $m['logo'][0]['url'] = $this->getMediaUrl().$blog->getLogo();
            //echo $m['image'][0]['url'];die;
            $fullData = $this->loadedData;
            $this->loadedData[$blog->getBlogId()] = array_merge($fullData[$blog->getBlogId()], $m);
            }
        }
       // print_r($this->loadedData);
        //die("asda");
        return $this->loadedData;
    }
     public function getMediaUrl()
    {
        $mediaUrl = $this->_storeManager->getStore()
                        ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'testimg/';

        return $mediaUrl;
    }
}