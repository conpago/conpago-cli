<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 08.10.15
	 * Time: 22:10
	 */

	namespace Conpago\Cli;


	use Conpago\Cli\Interactor\CreateInteractor;

	class CommandFactory {

		private $version = "0.0.1-alpha";
		private $author = "Bartosz Gołek";

		/**
		 * @var ICommand[]
		 */
		private $command_list = [];

		function __construct() {
			$this->command_list['interactor'] = new CreateInteractor();
		}

		public function run($args) {
			echo sprintf("Conpago %s by %s", $this->version, $this->author).PHP_EOL;
			echo PHP_EOL;

			if (count($args) < 1) {
				$this->printHelp();
				return;
			}

			if (count($args) == 1 && ($args[0] == "--help" || $args[0] == "-h")) {
				$this->printHelp();
				return;
			}

			if ($args[0] == "--help" || $args[0] == "-h") {
				$this->printCommandHelp($args[1]);
				return;
			}

			if ($args[0] == "--version")
				return;

			if (!array_key_exists($args[0], $this->command_list)) {
				$this->printHelp();
				return;
			}

			$this->runCommand($args[0], array_slice($args, 1));
		}

		private function printHelp() {
			echo "Usage: conpago <command> [command_options]".PHP_EOL;
			if (count($this->command_list) > 0) {
				echo PHP_EOL;
				echo "Commands:".PHP_EOL;
				echo PHP_EOL;

				foreach ( $this->command_list as $name => $command ) {
					$padded_name = str_pad( $name, 25, " ", STR_PAD_RIGHT );
					echo sprintf( "  %s %s.", $padded_name, $command->getDescription() ) . PHP_EOL;
				}
			}
			echo PHP_EOL;
			echo "Miscellaneous Options:".PHP_EOL;
			echo PHP_EOL;
			echo "  -h|--help                 Prints this usage information.".PHP_EOL;
			echo "  -h|--help <command>       Prints detailed command usage information.".PHP_EOL;
			echo "  --version                 Prints the version and exits.".PHP_EOL;
		}

		private function printCommandHelp($command) {
			if (!array_key_exists($command, $this->command_list)) {
				echo sprintf("Could not find command '%s'!", $command).PHP_EOL;
				echo PHP_EOL;
				$this->printHelp();

				return;
			}

			$this->command_list[$command]->getHelp();
		}

		private function runCommand($command, array $command_args) {

			$this->command_list[$command]->run($command_args);
			echo PHP_EOL;
		}
	}