<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 08.10.15
	 * Time: 22:17
	 */

	namespace Conpago\Cli\Interactor;

	use Conpago\Cli\Contract\ICommand;
	use Conpago\Cli\Contract\IQuestion;
	use Conpago\Cli\Interactor\Contract\ICreateInteractorPresenter;

	class CreateInteractor implements ICommand {

		/**
		 * @var ICreateInteractorPresenter
		 */
		private $presenter;
		/**
		 * @var IQuestion
		 */
		private $question;

		/**
		 * CreateInteractor constructor.
		 *
		 * @param ICreateInteractorPresenter $presenter
		 * @param IQuestion $question
		 */
		function __construct(
			ICreateInteractorPresenter $presenter,
			IQuestion $question
		)
		{
			$this->presenter = $presenter;
			$this->question = $question;
		}

		function printHelp() {
			$this->presenter->printHelp($this->getDescription());
		}

		function run( array $args ) {
			if (count($args) < 1)
			{
				$this->printMissingParameter();
				$this->printHelp();
				return;
			}

			$this->question->ask("Create access right for interactor?", ["yes", "no"], "yes");
		}

		function getDescription() {
			return "Generate interactor with interfaces and adapters stubs. It also generate tests stubs.".PHP_EOL;
		}

		protected function printMissingParameter() {
			$this->presenter->printMissingParameter();
		}
	}