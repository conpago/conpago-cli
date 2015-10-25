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
		function test_getTargetPathWillReturnNullInNewCreatedContext(){
			$c = new CreateInteractorContext();

			$this->assertNull($c->getTargetPath());
		}

		function test_getCreateAccessRightWillReturnValueAfterSet(){
			$c = new CreateInteractorContext();

			$c->setTargetPath("path");
			$this->assertEquals("path", $c->getTargetPath());
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
	}
