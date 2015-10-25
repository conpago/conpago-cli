<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 08.10.15
	 * Time: 22:17
	 */

	namespace Conpago\Cli\Interactor;

	use Conpago\Cli\Contract\ICommand;
	use Conpago\Cli\Interactor\Contract\ICreateInteractorContextBuilder;
	use Conpago\Cli\Interactor\Contract\ICreateInteractorPresenter;

	class CreateInteractor implements ICommand {


		/**
		 * @var ICreateInteractorPresenter
		 */
		private $presenter;
		/**
		 * @var ICreateInteractorContextBuilder
		 */
		private $createInteractorContextBuilder;

		/**
		 * CreateInteractor constructor.
		 *
		 * @param ICreateInteractorPresenter $presenter
		 * @param ICreateInteractorContextBuilder $createInteractorContextBuilder
		 */
		function __construct(
			ICreateInteractorPresenter $presenter,
			ICreateInteractorContextBuilder $createInteractorContextBuilder
		)
		{
			$this->presenter = $presenter;
			$this->createInteractorContextBuilder = $createInteractorContextBuilder;
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

			$context = $this->createInteractorContextBuilder->build();
		}

		function getDescription() {
			return "Generate interactor with interfaces and adapters stubs. It also generate tests stubs.".PHP_EOL;
		}

		protected function printMissingParameter() {
			$this->presenter->printMissingParameter();
		}
	}