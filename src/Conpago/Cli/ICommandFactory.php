<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 11.10.15
	 * Time: 00:05
	 */

	namespace Conpago\Cli;


	interface ICommandFactory
	{

		/**
		 * @return ICommand
		 */
		public function getCommand($command_name);

		/**
		 * @return array
		 */
		public function getCommandsDesc();

		/**
		 * @return string
		 */
		public function getCommandHelp();
	}