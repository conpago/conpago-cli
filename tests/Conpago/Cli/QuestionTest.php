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

		function test_InputReaderCreate()
		{
		}

		protected function setUp()
		{
			$this->input = $this->getMock('Conpago\Cli\IInput');
			$this->output = $this->getMock('Conpago\Cli\IOutput');
			$this->question = new Question($this->input, $this->output);
		}

		function testAsk_WillReturnValueFromInputReadLine()
		{
			$this->input->expects($this->any())->method("readLine")->willReturn("x");
			$value = $this->question->ask("Prompt");
			$this->assertEquals("x", $value);
		}

		function testAsk_WillCallReadLineAgainWhenResponseIsNotAcceptable()
		{
			$this->input->expects($this->exactly(2))->method("readLine")
					->willReturnOnConsecutiveCalls("x", "yes");

			$this->question->ask("Prompt", "yes");
		}

		function testAsk_WillCallReadLineTillResponseIsAcceptable()
		{
			$this->input->expects($this->exactly(3))->method("readLine")
					->willReturnOnConsecutiveCalls("x", "y", "yes");

			$this->question->ask("Propmt", "yes");
		}

		function testAsk_WillCallPrintPromptToOuput()
		{
			$this->input->expects($this->any())->method("readLine")
					->willReturnOnConsecutiveCalls("yes");
			$this->output->expects($this->atLeast(1))->method("writeLine")
					->willReturnOnConsecutiveCalls("Propmt");

			$this->question->ask("Propmt", "yes");
		}
	}
