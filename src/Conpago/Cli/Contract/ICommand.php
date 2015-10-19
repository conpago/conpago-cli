<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 08.10.15
	 * Time: 22:13
	 */

	namespace Conpago\Cli\Contract;


	/**
	 * Interface ICommand
	 * @package Conpago\Cli\Contract
	 */
	interface ICommand {
		/**
		 * @return void
		 */
		function printHelp();

		/**
		 * @return string
		 */
		function getDescription();

		/**
		 * @param string[] $args
		 *
		 * @return void
		 */
		function run(array $args);
	}