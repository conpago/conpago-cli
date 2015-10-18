<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 08.10.15
	 * Time: 22:10
	 */

	namespace Conpago\Cli;


	use Conpago\Cli\Contract\CommandHelp;
	use Conpago\Cli\Contract\ICommand;
	use Conpago\Cli\Contract\ICommandFactory;

	class CommandFactory implements ICommandFactory{
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
			if (!array_key_exists($command_name, $this->command_list))
				return null;

			return $this->command_list[$command_name];
		}

		/**
		 * @return CommandHelp[]
		 */
		public function getCommandsDesc()
		{
			$result = [];
			foreach ($this->command_list as $name => $command)
			{
				$result[] = new CommandHelp($name, $command->getDescription());
			}
			return $result;
		}

		/**
		 * @return string
		 */
		public function getCommandHelp($command_name)
		{
			if (!array_key_exists($command_name, $this->command_list))
				return null;

			return $this->command_list[$command_name]->getHelp();
		}
	}