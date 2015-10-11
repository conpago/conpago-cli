<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 11.10.15
	 * Time: 00:06
	 */

	namespace Conpago\Cli;


	interface IOutput
	{

		public function write($format = null, $args = null);

		public function writeLine($format = null, $args = null);
	}