<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-09
	 * Time: 14:29
	 */

	namespace Conpago\Cli;


	use Conpago\Cli\Contract\IApplicationPresenter;
	use Conpago\Cli\Contract\ICommandFactory;
	use Conpago\Cli\Contract\IOutput;

	class Application {

		/**
		 * @var CommandFactory
		 */
		protected $commandFactory;
		/**
		 * @var IApplicationPresenter
		 */
		private $applicationPresenter;

		/**
		 * Application constructor.
		 *
		 * @param IApplicationPresenter $applicationPresenter
		 * @param ICommandFactory $commandFactory
		 */
		function __construct(IApplicationPresenter $applicationPresenter, ICommandFactory $commandFactory)
		{
			$this->commandFactory = $commandFactory;
			$this->applicationPresenter = $applicationPresenter;
		}

		public function run(array $args)
		{
			$this->applicationPresenter->printVersion();

			if (count($args) < 1) {
				$this->applicationPresenter->printHelp($this->commandFactory->getCommandsDesc());
				return;
			}

			if ($this->isVersionOption($args[0])) {
				return;
			}

			if (count($args) > 1 && $this->isHelpOption($args[0])) {
				$command_help = $this->commandFactory->getCommandHelp($args[1]);
				if ($command_help == null) {
					$this->applicationPresenter->printCommandNotFound($args[1]);
					$this->applicationPresenter->printHelp($this->commandFactory->getCommandsDesc());
					return;
				}

				$this->applicationPresenter->printCommandHelp($command_help);
				return;
			}

			if ($this->isHelpOption($args[0])) {
				$this->applicationPresenter->printHelp($this->commandFactory->getCommandsDesc());
				return;
			}

			$command = $this->commandFactory->getCommand($args[0]);
			if ($command == null) {
				$this->applicationPresenter->printCommandNotFound($args[0]);
				$this->applicationPresenter->printHelp($this->commandFactory->getCommandsDesc());
				return;
			}
			$command->run(array_slice($args, 1));
		}

		/**
		 * @param array $args
		 *
		 * @return bool
		 */
		protected function isHelpOption($arg)
		{
			return $arg == '--help' || $arg == '-h';
}

		private function isVersionOption($arg)
		{
			return $arg == '--version';
		}
	}