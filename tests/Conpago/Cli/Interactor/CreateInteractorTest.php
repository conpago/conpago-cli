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
		/**
		 * @var \PHPUnit_Framework_MockObject_MockObject
		 */
		protected $createInteractorContextBuilder;
		/**
		 * @var CreateInteractor
		 */
		protected $createInteractor;

		function test_PrinHelp_willPrintHelp()
		{
			$this->presenter->expects($this->once())
					->method("printHelp");
			$this->createInteractor->printHelp();
		}

		private function expectedDescription()
		{
			return "Generate interactor with interfaces and adapters stubs. ".
			       "It also generate tests stubs.".PHP_EOL;
		}

		function test_GetDescriptionWillReturnDescription()
		{
			$description = $this->createInteractor->getDescription();
			$this->assertEquals($this->expectedDescription(), $description);
		}

		function test_CommandRunWithMissingParameters_willPrintMissingParametersAndHelp()
		{
			$this->presenter->expects($this->once())
			                ->method("printMissingParameter");
			$this->presenter->expects($this->once())
			                ->method("printHelp");
			$this->createInteractor->run([]);
		}

		function test_WillAskForCreatingDifferentThings()
		{
			$this->createInteractorContextBuilder->expects($this->once())
					->method("build");

			$this->createInteractor->run(["CreateUser"]);
		}

		/**
		 * @return \PHPUnit_Framework_MockObject_MockObject
		 */
		function setUp() {
			$this->presenter = $this->getMock('Conpago\Cli\Interactor\Contract\ICreateInteractorPresenter');
			$this->createInteractorContextBuilder = $this->getMock('Conpago\Cli\Interactor\Contract\ICreateInteractorContextBuilder');
			$this->createInteractor = new CreateInteractor($this->presenter, $this->createInteractorContextBuilder);
		}
	}
