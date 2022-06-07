<?php
/**
 * Copyright © 2022 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mock\Exam\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Mock\Exam\Api\Data\MockexamInterface;
use Mock\Exam\Api\Data\MockexamInterfaceFactory;
use Mock\Exam\Api\Data\MockexamSearchResultsInterfaceFactory;
use Mock\Exam\Api\MockexamRepositoryInterface;
use Mock\Exam\Model\ResourceModel\Mockexam as ResourceMockexam;
use Mock\Exam\Model\ResourceModel\Mockexam\CollectionFactory as MockexamCollectionFactory;

class MockexamRepository implements MockexamRepositoryInterface
{

    /**
     * @var Mockexam
     */
    protected $searchResultsFactory;

    /**
     * @var MockexamCollectionFactory
     */
    protected $mockexamCollectionFactory;

    /**
     * @var MockexamInterfaceFactory
     */
    protected $mockexamFactory;

    /**
     * @var ResourceMockexam
     */
    protected $resource;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param ResourceMockexam $resource
     * @param MockexamInterfaceFactory $mockexamFactory
     * @param MockexamCollectionFactory $mockexamCollectionFactory
     * @param MockexamSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceMockexam $resource,
        MockexamInterfaceFactory $mockexamFactory,
        MockexamCollectionFactory $mockexamCollectionFactory,
        MockexamSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->mockexamFactory = $mockexamFactory;
        $this->mockexamCollectionFactory = $mockexamCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(MockexamInterface $mockexam)
    {
        try {
            $this->resource->save($mockexam);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the mockexam: %1',
                $exception->getMessage()
            ));
        }
        return $mockexam;
    }

    /**
     * @inheritDoc
     */
    public function get($mockexamId)
    {
        $mockexam = $this->mockexamFactory->create();
        $this->resource->load($mockexam, $mockexamId);
        if (!$mockexam->getId()) {
            throw new NoSuchEntityException(__('mockexam with id "%1" does not exist.', $mockexamId));
        }
        return $mockexam;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->mockexamCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(MockexamInterface $mockexam)
    {
        try {
            $mockexamModel = $this->mockexamFactory->create();
            $this->resource->load($mockexamModel, $mockexam->getMockexamId());
            $this->resource->delete($mockexamModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the mockexam: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($mockexamId)
    {
        return $this->delete($this->get($mockexamId));
    }
}

