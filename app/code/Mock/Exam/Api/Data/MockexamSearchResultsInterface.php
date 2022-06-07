<?php
/**
 * Copyright © 2022 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mock\Exam\Api\Data;

interface MockexamSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get mockexam list.
     * @return \Mock\Exam\Api\Data\MockexamInterface[]
     */
    public function getItems();

    /**
     * Set question list.
     * @param \Mock\Exam\Api\Data\MockexamInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

