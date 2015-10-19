<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 11.10.15
	 * Time: 00:05
	 */

	namespace Conpago\Cli\Contract;


	interface ICommandFactory
	{

		/**
		 * @return ICommand
		 */
		public function getCommand($command_name);

		/**
		 * @return CommandHelp[]
		 */
		public function getCommandsDesc();
	}