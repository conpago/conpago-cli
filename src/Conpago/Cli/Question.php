<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 11.10.15
     * Time: 19:12
     */

    namespace Conpago\Cli;

use Conpago\Cli\Contract\IInput;
    use Conpago\Cli\Contract\IOutput;
    use Conpago\Cli\Contract\IQuestion;

    /**
     * Class Question
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    class Question implements IQuestion
    {
        /**
         * @var IInput
         */
        private $input;
        /**
         * @var IOutput
         */
        private $output;

        public function __construct(IInput $input, IOutput $output)
        {
            $this->input = $input;
            $this->output = $output;
        }

        public function ask($question, array $acceptableAnswers = null, $defaultAnswer = null)
        {
            $this->output->writeLine($this->GetQuestionLine($question, $acceptableAnswers, $defaultAnswer));
            return $this->readValueFromInput($acceptableAnswers, $defaultAnswer);
        }

        /**
         * @param $question
         * @param array $acceptableAnswers
         * @param $defaultAnswer
         *
         * @return string
         */
        private function GetQuestionLine($question, array $acceptableAnswers = null, $defaultAnswer = null)
        {
            $line = $question;
            if ($acceptableAnswers != null) {
                $line .= " [" . implode("/", $acceptableAnswers) . "]";
            }

            if ($defaultAnswer != null) {
                $line .= " (" . $defaultAnswer . ")";
            }

            $line .= ": ";

            return $line;
        }

        /**
         * @param array $acceptableAnswers
         * @param $defaultAnswer
         *
         * @return null
         */
        private function readValueFromInput(array $acceptableAnswers = null, $defaultAnswer = null)
        {
            $value = null;
            do {
                $value = $this->input->readLine();
                if ($value == null) {
                    $value = $defaultAnswer;
                }
            } while ($acceptableAnswers != null && !in_array($value, $acceptableAnswers));

            return $value;
        }
    }
