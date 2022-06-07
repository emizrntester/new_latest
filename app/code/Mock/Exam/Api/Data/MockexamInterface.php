<?php
/**
 * Copyright © 2022 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mock\Exam\Api\Data;

interface MockexamInterface
{

    const CHOICE6 = 'choice6';
    const TYPE_QUESTION = 'type_question';
    const QUESTION = 'question';
    const CHOICE4 = 'choice4';
    const CHOICE2 = 'choice2';
    const CHOICE3 = 'choice3';
    const MOCKEXAM_ID = 'mockexam_id';
    const ANSWER = 'answer';
    const CHOICE5 = 'choice5';
    const CHOICE1 = 'choice1';

    /**
     * Get mockexam_id
     * @return string|null
     */
    public function getMockexamId();

    /**
     * Set mockexam_id
     * @param string $mockexamId
     * @return \Mock\Exam\Mockexam\Api\Data\MockexamInterface
     */
    public function setMockexamId($mockexamId);

    /**
     * Get question
     * @return string|null
     */
    public function getQuestion();

    /**
     * Set question
     * @param string $question
     * @return \Mock\Exam\Mockexam\Api\Data\MockexamInterface
     */
    public function setQuestion($question);

    /**
     * Get answer
     * @return string|null
     */
    public function getAnswer();

    /**
     * Set answer
     * @param string $answer
     * @return \Mock\Exam\Mockexam\Api\Data\MockexamInterface
     */
    public function setAnswer($answer);

    /**
     * Get choice1
     * @return string|null
     */
    public function getChoice1();

    /**
     * Set choice1
     * @param string $choice1
     * @return \Mock\Exam\Mockexam\Api\Data\MockexamInterface
     */
    public function setChoice1($choice1);

    /**
     * Get choice2
     * @return string|null
     */
    public function getChoice2();

    /**
     * Set choice2
     * @param string $choice2
     * @return \Mock\Exam\Mockexam\Api\Data\MockexamInterface
     */
    public function setChoice2($choice2);

    /**
     * Get choice3
     * @return string|null
     */
    public function getChoice3();

    /**
     * Set choice3
     * @param string $choice3
     * @return \Mock\Exam\Mockexam\Api\Data\MockexamInterface
     */
    public function setChoice3($choice3);

    /**
     * Get choice4
     * @return string|null
     */
    public function getChoice4();

    /**
     * Set choice4
     * @param string $choice4
     * @return \Mock\Exam\Mockexam\Api\Data\MockexamInterface
     */
    public function setChoice4($choice4);

    /**
     * Get choice5
     * @return string|null
     */
    public function getChoice5();

    /**
     * Set choice5
     * @param string $choice5
     * @return \Mock\Exam\Mockexam\Api\Data\MockexamInterface
     */
    public function setChoice5($choice5);

    /**
     * Get choice6
     * @return string|null
     */
    public function getChoice6();

    /**
     * Set choice6
     * @param string $choice6
     * @return \Mock\Exam\Mockexam\Api\Data\MockexamInterface
     */
    public function setChoice6($choice6);

    /**
     * Get type_question
     * @return string|null
     */
    public function getTypeQuestion();

    /**
     * Set type_question
     * @param string $typeQuestion
     * @return \Mock\Exam\Mockexam\Api\Data\MockexamInterface
     */
    public function setTypeQuestion($typeQuestion);
}

