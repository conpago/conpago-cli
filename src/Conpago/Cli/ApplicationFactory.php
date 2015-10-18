<?php

	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-09
	 * Time: 14:28
	 */

	namespace Conpago\Cli;

	use Conpago\Cli\Interactor\CreateInteractor;
	use Conpago\Cli\Interactor\CreateInteractorPresenter;

	class ApplicationFactory {

		/**
		 * @return Application
		 */
		public function createApplication() {
			return new Application(
					new ApplicationPresenter(new StreamOutput(STDOUT)),
					new CommandFactory(
							[
									'interactor' => new CreateInteractor(
											new CreateInteractorPresenter()
									)
							]
					)
			);
		}
	}