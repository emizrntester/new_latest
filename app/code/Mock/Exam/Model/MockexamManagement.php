<?php
/**
 * Copyright © 2022 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mock\Exam\Model;

class MockexamManagement implements \Mock\Exam\Api\MockexamManagementInterface
{

    /**
     * {@inheritdoc}
     */
    public function getMockexam($param)
    {
        return 'hello api GET return the $param ' . $param;
    }
}

