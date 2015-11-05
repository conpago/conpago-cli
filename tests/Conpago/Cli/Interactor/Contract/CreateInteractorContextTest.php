<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 25.10.15
	 * Time: 10:37
	 */

	namespace Conpago\Cli\Interactor\Contract;


	class CreateInteractorContextTest extends \PHPUnit_Framework_TestCase
	{
		function test_getSourcesWillReturnNullInNewCreatedContext(){
			$c = new CreateInteractorContext();

			$this->assertNull($c->getSources());
		}

		function test_getSourcesWillReturnValueAfterSet(){
			$c = new CreateInteractorContext();

			$c->setSources("path");
			$this->assertEquals("path", $c->getSources());
		}

		function test_getAuthorWillReturnNullInNewCreatedContext(){
			$c = new CreateInteractorContext();

			$this->assertNull($c->getAuthor());
		}

		function test_getAuthorWillReturnValueAfterSet(){
			$c = new CreateInteractorContext();

			$c->setAuthor("path");
			$this->assertEquals("path", $c->getAuthor());
		}

		function test_getVariablesWillReturnEmptyArrayInNewCreatedContext(){
			$c = new CreateInteractorContext();

			$this->assertEquals([], $c->getVariables());
		}

		function test_getVariablesWillContainValueAfterSet(){
			$c = new CreateInteractorContext();

			$c->setVariable("path", "xxx");
			$this->assertEquals("xxx", $c->getVariables()["path"]);
		}

		function test_getVariableWillReturnValueAfterSet(){
			$c = new CreateInteractorContext();

			$c->setVariable("path", "xxx");
			$this->assertEquals("xxx", $c->getVariable("path"));
		}

		function test_getVariableWillReturnNullWhenNotExists(){
			$c = new CreateInteractorContext();

			$this->assertNull($c->getVariable("variable"));
		}
	}
