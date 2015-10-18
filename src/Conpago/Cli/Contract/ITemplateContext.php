<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 13.10.15
	 * Time: 23:28
	 */

	namespace Conpago\Cli\Contract;


	interface ITemplateContext {

		public function getName();

		public function getNamespace();
	}