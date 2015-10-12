<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-12
	 * Time: 13:42
	 */

	namespace Conpago\Cli\Templates;


	class TemplateLoaderTest extends \PHPUnit_Framework_TestCase {

		function testLoad_willReturnFileContent()
		{
			$tl = new TemplateLoader();
			$template_path = __DIR__.DIRECTORY_SEPARATOR."TemplateLoaderTestContentFile";
			$content = $tl->load($template_path);
			$this->assertEquals(file_get_contents($template_path), $content);
		}
	}
