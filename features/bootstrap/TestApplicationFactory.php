<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 28.11.15
     * Time: 12:36
     */

    /**
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     **/
    class TestApplicationFactory extends \Conpago\Cli\ApplicationFactory
    {

        /**
         * TestApplicationFactory constructor.
         *
         * @param $timeService
         */
        public function __construct($timeService)
        {
            $this->timeService = $timeService;
        }
    }
