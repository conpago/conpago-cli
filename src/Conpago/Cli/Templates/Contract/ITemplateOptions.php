<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-12
	 * Time: 14:16
	 */

	namespace Conpago\Cli\Templates\Contract;

	/**
	 * Interface ITemplateOptions
	 *
	 * @license MIT
	 * @author Bartosz Gołek <bartosz.golek@gmail.com>
	 */
	interface ITemplateOptions {
		function getLineEndings();
	}