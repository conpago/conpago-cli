<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 13.10.15
	 * Time: 23:25
	 */

	namespace Conpago\Cli;


	use Conpago\Cli\CaseConverter\CaseConverter;
	use Conpago\Cli\Templates\TemplateEnvironment;

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
			$variables = [
				'name' => $context->getName(),
				'namespace' => $context->getNamespace(),
				'NAME' => $this->caseConverter->toMacroCase($context->getName()),
				'NAMESPACE' => $this->caseConverter->toMacroCase($context->getNamespace())
			];
			$this->templateEnvironment->render($template, $variables);
		}
	}