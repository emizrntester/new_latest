<?php
/**
 * Copyright © 2022 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mock\Exam\Api;

interface MockexamManagementInterface
{

    /**
     * GET for mockexam api
     * @param string $param
     * @return string
     */
    public function getMockexam($param);
}

