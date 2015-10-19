<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 17.10.15
	 * Time: 10:13
	 */

	namespace Conpago\Cli\Interactor\Contract;


	interface ICreateInteractorPresenter {

		/**
		 * @param $desc
		 */
		public function printHelp($desc);

		/**
		 * @return void
		 */
		public function printMissingParameter();
	}