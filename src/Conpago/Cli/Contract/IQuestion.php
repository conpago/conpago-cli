<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 11.10.15
     * Time: 19:12
     */

    namespace Conpago\Cli\Contract;

/**
     * Interface IQuestion
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    interface IQuestion
    {
        public function ask($question, array $acceptableAnswers = null, $defaultAnswer = null);
    }
