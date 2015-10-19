<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 17.10.15
	 * Time: 10:20
	 */

	namespace Conpago\Cli\Interactor;


	use Conpago\Cli\Contract\IOutput;
	use Conpago\Cli\Interactor\Contract\ICreateInteractorPresenter;

	class CreateInteractorPresenter implements ICreateInteractorPresenter {

		/**
		 * @var IOutput
		 */
		private $output;

		/**
		 * CreateInteractorPresenter constructor.
		 *
		 * @param IOutput $output
		 */
		function __construct(IOutput $output) {
			$this->output = $output;
		}

		/**
		 * @param $desc
		 */
		public function printHelp($desc) {
			$this->output->writeLine("Usage: conpago interactor <InteractorName>");
			$this->output->writeLine();
			$this->output->writeLine($desc);
			$this->output->writeLine();
		}


		/**
		 * @return void
		 */
		public function printMissingParameter() {
			$this->output->writeLine("Missing parameter <InteractorName>.");
			$this->output->writeLine();
		}
	}