<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 05.11.15
     * Time: 23:51
     */

    use Conpago\Cli\Contract\IInput;
    use Conpago\Cli\Contract\IOutput;
    use Conpago\Time\Contract\ITimeService;

/**
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     **/
    class FeatureApplicationFactory extends \Conpago\Cli\ApplicationFactory
    {

        public function __construct(ITimeService $timeService, IInput $input, IOutput $output)
        {
            $this->timeService = $timeService;
            $this->output = $output;
            $this->input = $input;
        }
    }
