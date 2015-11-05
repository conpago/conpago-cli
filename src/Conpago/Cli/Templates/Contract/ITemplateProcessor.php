<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 04.11.15
	 * Time: 21:42
	 */

	namespace Conpago\Cli\Templates\Contract;


	interface ITemplateProcessor {

		function processTemplate($template, ITemplateContext $context);
	}