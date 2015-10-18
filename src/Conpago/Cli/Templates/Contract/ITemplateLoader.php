<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-12
	 * Time: 14:05
	 */

	namespace Conpago\Cli\Templates\Contract;

	interface ITemplateLoader {
		function load( $template );
	}