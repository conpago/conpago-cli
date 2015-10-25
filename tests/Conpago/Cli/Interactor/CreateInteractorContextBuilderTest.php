<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 25.10.15
	 * Time: 19:16
	 */

	namespace Conpago\Cli\Interactor;


	class CreateInteractorContextBuilderTest extends \PHPUnit_Framework_TestCase
	{
		/**
		 * @var CreateInteractorContextBuilder
		 */
		protected $createInteractorContextBuilder;
		/**
		 * @var \PHPUnit_Framework_MockObject_MockObject
		 */
		protected $question;

		public function test_WillAskForContextData()
		{
			$this->question->expects($this->exactly(7))
				->method("ask")
				->withConsecutive(
					[$this->equalTo("Create access right for interactor?"),
						$this->equalTo(["yes", "no"]),
						$this->equalTo("yes")],
					[$this->equalTo("Create request data object for interactor?"),
						$this->equalTo(["yes", "no"]),
						$this->equalTo("yes")],
					[$this->equalTo("Create request data validator?"),
						$this->equalTo(["yes", "no"]),
						$this->equalTo("yes")],
					[$this->equalTo("Create dao for interactor?"),
						$this->equalTo(["yes", "no"]),
						$this->equalTo("yes")],
					[$this->equalTo("Create logger for interactor?"),
						$this->equalTo(["yes", "no"]),
						$this->equalTo("yes")],
					[$this->equalTo("Create preseter model for interactor?"),
						$this->equalTo(["yes", "no"]),
						$this->equalTo("yes")],
					[$this->equalTo("Create Conpago/DI module for interactor?"),
						$this->equalTo(["yes", "no"]),
						$this->equalTo("yes")]
				);

			$this->createInteractorContextBuilder->build();
		}

		public function test_WillbuildContextWithgatheredData()
		{
			$this->question->expects($this->any())
					->method("ask")
					->willReturn("yes");

			$context = $this->createInteractorContextBuilder->build();
			$this->assertEquals(
				[
					$context->getVariables()["createAccessRight"],
					$context->getVariables()["createRequestData"],
					$context->getVariables()["createRequestDataValidator"],
					$context->getVariables()["createDao"],
					$context->getVariables()["createLogger"],
					$context->getVariables()["createPreseterModel"],
					$context->getVariables()["createConpagoDiModule"],
				],
				[
					true,
					true,
					true,
					true,
					true,
					true,
					true
				]);
		}

		protected function setUp()
		{
			$this->question = $this->getMock('Conpago\Cli\Contract\IQuestion');
			$this->createInteractorContextBuilder = new CreateInteractorContextBuilder($this->question);
		}
	}
