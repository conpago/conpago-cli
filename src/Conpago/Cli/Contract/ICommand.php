<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 08.10.15
	 * Time: 22:13
	 */

	namespace Conpago\Cli\Contract;


	interface ICommand {
		function getHelp();
		function getDescription();
		function run(array $args);
	}