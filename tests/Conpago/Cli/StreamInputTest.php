<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 11.10.15
	 * Time: 16:41
	 */

	namespace Conpago\Cli;


	class StreamInputTest extends \PHPUnit_Framework_TestCase
	{
		function testReadLine_willreturnValue()
		{
			$i = fopen('php://memory', 'w');
			fwrite($i, "test_value".PHP_EOL);
			fseek($i, 0);
			$out = new StreamInput($i);
			$value = $out->readLine();
			$this->assertEquals("test_value", $value);
		}
	}
