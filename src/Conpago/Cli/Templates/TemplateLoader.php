<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-12
	 * Time: 13:42
	 */

	namespace Conpago\Cli\Templates;


	use Conpago\Cli\Templates\Contract\ITemplateLoader;

	class TemplateLoader implements ITemplateLoader {
		function load($template)
		{
			return file_get_contents($template);
		}
	}