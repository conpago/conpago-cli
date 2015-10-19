<?php

	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 16.10.15
	 * Time: 23:10
	 */

	namespace Conpago\Cli\Interactor;


	class CreateInteractorTest extends \PHPUnit_Framework_TestCase {

		/**
		 * @var \PHPUnit_Framework_MockObject_MockObject
		 */
		protected $presenter;

		function test_PrinHelp_willPrintHelp()
		{
			$this->presenter->expects($this->once())
					->method("printHelp");
			(new CreateInteractor($this->presenter))->printHelp();
		}

		private function expectedDescription()
		{
			return "Generate interactor with interfaces and adapters stubs. ".
			       "It also generate tests stubs.".PHP_EOL;
		}

		function test_GetDescriptionWillReturnDescription()
		{
			$description = (new CreateInteractor($this->presenter))->getDescription();
			$this->assertEquals($this->expectedDescription(), $description);
		}

		function test_CommandRunWithMissingParameters_willPrintMissingParametersAndHelp()
		{
			$this->presenter->expects($this->once())
			                ->method("printMissingParameter");
			$this->presenter->expects($this->once())
			                ->method("printHelp");
			(new CreateInteractor($this->presenter))->run([]);
		}

		/**
		 * @return \PHPUnit_Framework_MockObject_MockObject
		 */
		function setUp() {
			$this->presenter = $this->getMock('Conpago\Cli\Interactor\Contract\ICreateInteractorPresenter');
		}
	}
