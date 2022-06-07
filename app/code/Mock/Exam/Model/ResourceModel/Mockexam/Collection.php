<?php
/**
 * Copyright © 2022 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mock\Exam\Model\ResourceModel\Mockexam;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'mockexam_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Mock\Exam\Model\Mockexam::class,
            \Mock\Exam\Model\ResourceModel\Mockexam::class
        );
    }
}

