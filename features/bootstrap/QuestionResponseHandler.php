<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 03.02.17
     * Time: 23:07
     */
    use Conpago\Cli\StreamOutput;

    /**
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     **/
    class QuestionResponseHandler implements \Conpago\Cli\Contract\IInput, \Conpago\Cli\Contract\IOutput
    {
        /** @var string */
        protected $lastLine;

        /** @var resource */
        private $stream;

        /** @var StreamOutput */
        private $streamOutputInt;

        /** @var StreamOutput */
        private $streamOutput;

        /** @var array */
        private $answers;

        public function __construct(array $answers)
        {
            $streamOutput = $this->initIntStream();

            $this->streamOutput = $streamOutput = new StreamOutput(STDOUT);

            $this->answers = $answers;
        }

        public function readLine()
        {
            $question = $this->lastLine;
            if (isset($this->answers[0][$question])) {
                $answer = $this->answers[0][$question];
                array_shift($this->answers);

                return $answer;
            }

            $message = sprintf("Unexpected question '%s'.", $question);
            if (count($this->answers) > 0) {
                $message .= PHP_EOL . sprintf("Currently expected question is: '%s'.", array_keys($this->answers[0])[0]);
            }

            throw new Exception($message);
        }

        public function write($format = null, array $args = null)
        {
            $this->streamOutput->write($format, $args);
            $this->streamOutputInt->write($format, $args);
        }

        public function writeLine($format = null, array $args = null)
        {
            $this->streamOutput->writeLine($format, $args);
            $this->streamOutputInt->writeLine($format, $args);
            rewind($this->stream);

            $this->lastLine = $this->trim(stream_get_contents($this->stream));

            $this->initIntStream();
        }

        public function addAnswer($question, $answer)
        {
            $this->answers[] = [$question => $answer];
        }

        /**
         * @return StreamOutput
         */
        private function initIntStream()
        {
            $this->stream          = fopen("php://memory", "w+b");
            $this->streamOutputInt = $streamOutput = new StreamOutput($this->stream);

            return $streamOutput;
        }

        /**
         * @param $value
         *
         * @return string
         */
        private function trim($value)
        {
            return trim(trim($value, PHP_EOL));
        }

        public function getAnswersCount()
        {
            return count($this->answers);
        }
    }