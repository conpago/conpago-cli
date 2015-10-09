<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-09
	 * Time: 14:48
	 */

	namespace Conpago\Cli;


	class OutputTest extends \PHPUnit_Framework_TestCase {

		function testWrite_willEchoData()
		{
			$this->expectOutputString("echo data");
			$out = new Output();
			$out->write("echo data");
		}

		function testWrite_willEchoDataWithArgs()
		{
			$this->expectOutputString("echo data abc");
			$out = new Output();
			$out->write("echo data %s", "abc");
		}

	}