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

		function test_setSourcesWillSetVariable(){
			$c = new CreateInteractorContext();

			$c->setSources("path");
			$this->assertEquals("path", $c->getVariable("sources"));
		}

		function test_getTestsWillReturnNullInNewCreatedContext(){
			$c = new CreateInteractorContext();

			$this->assertNull($c->getTests());
		}

		function test_getTestsWillReturnValueAfterSet(){
			$c = new CreateInteractorContext();

			$c->setTests("path");
			$this->assertEquals("path", $c->getTests());
		}

		function test_setTestsWillSetVariable(){
			$c = new CreateInteractorContext();

			$c->setTests("path");
			$this->assertEquals("path", $c->getVariable("tests"));
		}

		function test_getCompanyWillReturnNullInNewCreatedContext(){
			$c = new CreateInteractorContext();

			$this->assertNull($c->getCompany());
		}

		function test_getCompanyWillReturnValueAfterSet(){
			$c = new CreateInteractorContext();

			$c->setCompany("path");
			$this->assertEquals("path", $c->getCompany());
		}

		function test_setCompanyWillSetVariable(){
			$c = new CreateInteractorContext();

			$c->setCompany("path");
			$this->assertEquals("path", $c->getVariable("company"));
		}

		function test_getProjectWillReturnNullInNewCreatedContext(){
			$c = new CreateInteractorContext();

			$this->assertNull($c->getProject());
		}

		function test_getProjectWillReturnValueAfterSet() {
			$c = new CreateInteractorContext();

			$c->setProject("path");
			$this->assertEquals("path", $c->getProject());
		}

		function test_setProjectWillSetVariable(){
			$c = new CreateInteractorContext();

			$c->setProject("zxc");
			$this->assertEquals("zxc", $c->getVariable("project"));
		}

		function test_getInteractorNameWillReturnNullInNewCreatedContext(){
			$c = new CreateInteractorContext();

			$this->assertNull($c->getInteractorName());
		}

		function test_getInteractorNameWillReturnValueAfterSet() {
			$c = new CreateInteractorContext();

			$c->setInteractorName("InteractorName");
			$this->assertEquals("InteractorName", $c->getInteractorName());
		}

		function test_setInteractorNameWillSetNameVariable(){
			$c = new CreateInteractorContext();

			$c->setInteractorName("intname");
			$this->assertEquals("intname", $c->getVariable("name"));
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
