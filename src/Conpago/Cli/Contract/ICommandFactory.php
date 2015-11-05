<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 11.10.15
	 * Time: 00:05
	 */

	namespace Conpago\Cli\Contract;


	/**
	 * Provider for all avialble commands.
	 *
	 * @license MIT
	 * @author Bartosz Gołek <bartosz.golek@gmail.com>
	 */
	interface ICommandFactory
	{
		/**
		 * Returns instance of command by command name.
		 *
		 * @return ICommand
		 */
		public function getCommand($command_name);

		/**
		 * Returns command helps for all commands.
		 *
		 * @return CommandHelp[]
		 */
		public function getCommandsDesc();
	}