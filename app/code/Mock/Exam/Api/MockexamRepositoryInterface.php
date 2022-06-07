<?php
/**
 * Copyright © 2022 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mock\Exam\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface MockexamRepositoryInterface
{

    /**
     * Save mockexam
     * @param \Mock\Exam\Api\Data\MockexamInterface $mockexam
     * @return \Mock\Exam\Api\Data\MockexamInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Mock\Exam\Api\Data\MockexamInterface $mockexam
    );

    /**
     * Retrieve mockexam
     * @param string $mockexamId
     * @return \Mock\Exam\Api\Data\MockexamInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($mockexamId);

    /**
     * Retrieve mockexam matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Mock\Exam\Api\Data\MockexamSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete mockexam
     * @param \Mock\Exam\Api\Data\MockexamInterface $mockexam
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Mock\Exam\Api\Data\MockexamInterface $mockexam
    );

    /**
     * Delete mockexam by ID
     * @param string $mockexamId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($mockexamId);
}

