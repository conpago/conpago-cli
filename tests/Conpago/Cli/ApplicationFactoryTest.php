<?php

	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-09
	 * Time: 14:28
	 */

	namespace Conpago\Cli;

	class ApplicationFactoryTest extends \PHPUnit_Framework_TestCase {

		/**
		 * @return Application
		 */
		public function testCreateApplication_willReturnApplication() {
			$fac = new ApplicationFactory();
			$this->assertEquals('Conpago\Cli\Application', get_class($fac->createApplication()));
		}
	}