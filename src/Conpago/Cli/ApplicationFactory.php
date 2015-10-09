<?php

	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-09
	 * Time: 14:28
	 */

	namespace Conpago\Cli;

	class ApplicationFactory {

		/**
		 * @return Application
		 */
		public function createApplication() {
			return new Application();
		}
	}