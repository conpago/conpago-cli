<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 08.10.15
	 * Time: 22:10
	 */

	namespace Conpago\Cli;


	use Conpago\Cli\Interactor\CreateInteractor;

	class CommandFactory implements  ICommandFactory{
		/**
		 * @var ICommand[]
		 */
		private $command_list = [];

		function __construct(array $command_list) {
			$this->command_list = $command_list;
		}

		/**
		 * @return ICommand
		 */
		public function getCommand($command_name)
		{
		}

		/**
		 * @return array
		 */
		public function getCommandsDesc()
		{
			return [];
		}

		/**
		 * @return string
		 */
		public function getCommandHelp()
		{
			return "";
		}
	}