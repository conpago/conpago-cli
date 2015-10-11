<?php

	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-09
	 * Time: 14:28
	 */

	namespace Conpago\Cli;

	use Conpago\Cli\Interactor\CreateInteractor;

	class ApplicationFactory {

		/**
		 * @return Application
		 */
		public function createApplication() {
			return new Application(
					new StreamOutput(STDIN),
					new CommandFactory(
							[
									'interactor' => new CreateInteractor()
							]
					)
			);
		}
	}