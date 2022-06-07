<?php
/**
 * Copyright © 2022 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mock\Exam\Model;

use Magento\Framework\Model\AbstractModel;
use Mock\Exam\Api\Data\MockexamInterface;

class Mockexam extends AbstractModel implements MockexamInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Mock\Exam\Model\ResourceModel\Mockexam::class);
    }

    /**
     * @inheritDoc
     */
    public function getMockexamId()
    {
        return $this->getData(self::MOCKEXAM_ID);
    }

    /**
     * @inheritDoc
     */
    public function setMockexamId($mockexamId)
    {
        return $this->setData(self::MOCKEXAM_ID, $mockexamId);
    }

    /**
     * @inheritDoc
     */
    public function getQuestion()
    {
        return $this->getData(self::QUESTION);
    }

    /**
     * @inheritDoc
     */
    public function setQuestion($question)
    {
        return $this->setData(self::QUESTION, $question);
    }

    /**
     * @inheritDoc
     */
    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * @inheritDoc
     */
    public function setAnswer($answer)
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * @inheritDoc
     */
    public function getChoice1()
    {
        return $this->getData(self::CHOICE1);
    }

    /**
     * @inheritDoc
     */
    public function setChoice1($choice1)
    {
        return $this->setData(self::CHOICE1, $choice1);
    }

    /**
     * @inheritDoc
     */
    public function getChoice2()
    {
        return $this->getData(self::CHOICE2);
    }

    /**
     * @inheritDoc
     */
    public function setChoice2($choice2)
    {
        return $this->setData(self::CHOICE2, $choice2);
    }

    /**
     * @inheritDoc
     */
    public function getChoice3()
    {
        return $this->getData(self::CHOICE3);
    }

    /**
     * @inheritDoc
     */
    public function setChoice3($choice3)
    {
        return $this->setData(self::CHOICE3, $choice3);
    }

    /**
     * @inheritDoc
     */
    public function getChoice4()
    {
        return $this->getData(self::CHOICE4);
    }

    /**
     * @inheritDoc
     */
    public function setChoice4($choice4)
    {
        return $this->setData(self::CHOICE4, $choice4);
    }

    /**
     * @inheritDoc
     */
    public function getChoice5()
    {
        return $this->getData(self::CHOICE5);
    }

    /**
     * @inheritDoc
     */
    public function setChoice5($choice5)
    {
        return $this->setData(self::CHOICE5, $choice5);
    }

    /**
     * @inheritDoc
     */
    public function getChoice6()
    {
        return $this->getData(self::CHOICE6);
    }

    /**
     * @inheritDoc
     */
    public function setChoice6($choice6)
    {
        return $this->setData(self::CHOICE6, $choice6);
    }

    /**
     * @inheritDoc
     */
    public function getTypeQuestion()
    {
        return $this->getData(self::TYPE_QUESTION);
    }

    /**
     * @inheritDoc
     */
    public function setTypeQuestion($typeQuestion)
    {
        return $this->setData(self::TYPE_QUESTION, $typeQuestion);
    }
}

