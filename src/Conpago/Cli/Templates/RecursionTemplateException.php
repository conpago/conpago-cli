<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 13.10.15
	 * Time: 00:27
	 */

	namespace Conpago\Cli\Templates;


	use Exception;

	/**
	 * Class RecursionTemplateException
	 *
	 * @license MIT
	 * @author Bartosz Gołek <bartosz.golek@gmail.com>
	 */
	class RecursionTemplateException extends Exception {
		/**
		 * RecursionTemplateException constructor.
		 *
		 * @param string $variables_stack
		 * @param int $code
		 * @param Exception|null $previous
		 */
		function __construct( $variables_stack, $code = 0, Exception $previous = null) {
			parent::__construct("Template contains recursiv variables: ".implode(" > ", $variables_stack), $code, $previous );
		}
	}