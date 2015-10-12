<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 13.10.15
	 * Time: 00:27
	 */

	namespace Conpago\Cli\Templates;


	use Exception;

	class RecursionTemplateException extends Exception {
		function __construct( $variables_stack, $code = 0, Exception $previous = null) {
			parent::__construct("Template contains recursiv variables: ".implode(" > ", $variables_stack), $code, $previous );
		}
	}