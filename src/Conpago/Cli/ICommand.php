<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 08.10.15
	 * Time: 22:13
	 */

	namespace Conpago\Cli;


	interface ICommand {
		function getHelp();
		function getDescription();
		function run(array $args);
	}