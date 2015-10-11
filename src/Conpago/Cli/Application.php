<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-09
	 * Time: 14:29
	 */

	namespace Conpago\Cli;


	class Application {

		private $version = "0.0.1-alpha";
		private $author = "Bartosz Gołek";

		/**
		 * @var CommandFactory
		 */
		protected $commandFactory;
		/**
		 * @var StreamOutput
		 */
		private $output;

		function __construct(IOutput $output, ICommandFactory $commandFactory)
		{
			$this->commandFactory = $commandFactory;
			$this->output = $output;
		}

		public function run(array $args)
		{
			$this->output->writeLine("Conpago %s by %s", $this->version, $this->author);
			$this->output->writeLine();

			if (count($args) < 1) {
				$this->printHelp();
				return;
			}

			if ($this->isVersionOption($args[0])) {
				return;
			}

			if (count($args) > 1 && $this->isHelpOption($args[0])) {
				$command_help = $this->commandFactory->getCommandHelp($args[1]);
				if ($command_help == null) {
					$this->printCommandNotFound($args[1]);
					$this->printHelp();
					return;
				}

				$this->output->writeLine($command_help);
				return;
			}

			if ($this->isHelpOption($args[0])) {
				$this->printHelp();
				return;
			}

			$command = $this->commandFactory->getCommand($args[0]);
			if ($command == null) {
				$this->printCommandNotFound($args[0]);
				$this->printHelp();
				return;
			}
			$command->run(array_slice($args, 1));
		}

		private function printHelp()
		{
			$this->output->writeLine("Usage: conpago <command> [command_options]");
			$commandsHelp = $this->commandFactory->getCommandsDesc();
			if (count($commandsHelp) > 0) {
				$this->output->writeLine();
				$this->output->writeLine("Commands:");
				$this->output->writeLine();

				foreach ($commandsHelp as $name => $description) {
					$padded_name = str_pad($name, 25, " ", STR_PAD_RIGHT);
					$this->output->writeLine("  %s %s.", $padded_name, $description);
				}
			}
			$this->output->writeLine();
			$this->output->writeLine("Miscellaneous Options:");
			$this->output->writeLine();
			$this->output->writeLine("  -h|--help                 Prints this usage information.");
			$this->output->writeLine("  -h|--help <command>       Prints detailed command usage information.");
			$this->output->writeLine("  --version                 Prints the version and exits.");
		}

		private function printCommandNotFound($command_name)
		{
			$this->output->writeLine("Could not find command '%s'!", $command_name);
			$this->output->writeLine();
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