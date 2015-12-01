<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 11.10.15
     * Time: 19:12
     */

    namespace Conpago\Cli;

use PHPUnit_Framework_MockObject_MockObject;

    class QuestionTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var PHPUnit_Framework_MockObject_MockObject
         */
        protected $output;
        /**
         * @var PHPUnit_Framework_MockObject_MockObject
         */
        protected $input;
        /**
         * @var Question
         */
        protected $question;

        public function test_InputReaderCreate()
        {
        }

        protected function setUp()
        {
            $this->input = $this->getMock('Conpago\Cli\Contract\IInput');
            $this->output = $this->getMock('Conpago\Cli\Contract\IOutput');
            $this->question = new Question($this->input, $this->output);
        }

        public function testAsk_WillReturnValueFromInputReadLine()
        {
            $this->input->expects($this->any())->method("readLine")->willReturn("x");
            $value = $this->question->ask("Prompt");
            $this->assertEquals("x", $value);
        }

        public function testAsk_WillCallReadLineAgainWhenResponseIsNotAcceptable()
        {
            $this->input->expects($this->exactly(2))->method("readLine")
                    ->willReturnOnConsecutiveCalls("x", "yes");

            $this->question->ask("Prompt", ["yes"]);
        }

        public function testAsk_WillAcceptsEmptyAnswerIfDefaultIsNotSet()
        {
            $this->input->expects($this->exactly(2))->method("readLine")
                    ->willReturnOnConsecutiveCalls("", "yes");

            $this->question->ask("Prompt", ["yes"]);
        }

        public function testAsk_WillAcceptsEmptyAnswerIfDefaultIsSet()
        {
            $this->input->expects($this->exactly(1))->method("readLine")->willReturn("");

            $this->question->ask("Prompt", ["yes"], "yes");
        }

        public function testAsk_WillCallReadLineTillResponseIsAcceptable()
        {
            $this->input->expects($this->exactly(3))->method("readLine")
                    ->willReturnOnConsecutiveCalls("x", "y", "yes");

            $this->question->ask("Propmt", ["yes"]);
        }

        public function testAsk_WillCallPrintPromptToOuput()
        {
            $this->output->expects($this->atLeast(1))->method("writeLine")
                         ->with("Propmt: ");

            $this->question->ask("Propmt");
        }

        public function testAsk_WillCallPrintPromptAcceptableAnswersToOuput()
        {
            $this->input->expects($this->any())->method("readLine")->willReturn("yes");

            $this->output->expects($this->atLeast(1))->method("writeLine")
                         ->with("Propmt [yes/no/cancel]: ");

            $this->question->ask("Propmt", ["yes", "no", "cancel"]);
        }

        public function testAsk_WillCallPrintPromptAcceptableAnswersAndDefaultToOuput()
        {
            $this->output->expects($this->atLeast(1))->method("writeLine")
                         ->with("Propmt [yes/no/cancel] (yes): ");

            $this->question->ask("Propmt", ["yes", "no", "cancel"], "yes");
        }
    }
