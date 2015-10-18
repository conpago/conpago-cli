<?php

	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 16.10.15
	 * Time: 23:10
	 */

	namespace Conpago\Cli\Interactor;


	class CreateInteractorTest extends \PHPUnit_Framework_TestCase {

		protected $presenter;

		function test_GetHelpWillReturnHelp()
		{
			$c = (new CreateInteractor($this->presenter))->getHelp();
			$expectedHelp = "Usage: conpago interactor <InteractorName>".PHP_EOL.
				PHP_EOL.
                $this->expectedDescription().
                PHP_EOL;
			$this->assertEquals($expectedHelp, $c);
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

		/**
		 * @return \PHPUnit_Framework_MockObject_MockObject
		 */
		function setUp() {
			$this->presenter = $this->getMock('Conpago\Cli\Interactor\Contract\ICreateInteractorPresenter');
		}
	}
