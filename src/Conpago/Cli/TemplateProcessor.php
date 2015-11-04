<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 13.10.15
	 * Time: 23:25
	 */

	namespace Conpago\Cli;


	use Conpago\Cli\CaseConverter\CaseConverter;
	use Conpago\Cli\Contract\ITemplateContext;
	use Conpago\Cli\Templates\TemplateEnvironment;

	/**
	 * Class TemplateProcessor
	 *
	 * @license MIT
	 * @author Bartosz Gołek <bartosz.golek@gmail.com>
	 */
	class TemplateProcessor {

		/**
		 * @var TemplateEnvironment
		 */
		private $templateEnvironment;
		/**
		 * @var CaseConverter
		 */
		private $caseConverter;

		function __construct(TemplateEnvironment $templateEnvironment, CaseConverter $caseConverter) {

			$this->templateEnvironment = $templateEnvironment;
			$this->caseConverter = $caseConverter;
		}

		function processTemplate($template, ITemplateContext $context)
		{
			$this->templateEnvironment->render($template, $context->getVariables());
		}
	}