<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 05.11.15
     * Time: 23:51
     */

    use Conpago\Time\Contract\ITimeService;

/**
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     **/
    class FeatureApplicationFactory extends \Conpago\Cli\ApplicationFactory
    {

        public function __construct(ITimeService $timeService)
        {
            $this->timeService = $timeService;
        }
    }
