<?php
/**
 * Copyright © 2022 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mock\Exam\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Mockexam extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('mock_exam_mockexam', 'mockexam_id');
    }
}

