<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 25.10.15
	 * Time: 19:14
	 */

	namespace Conpago\Cli\Interactor\Contract;


	interface ICreateInteractorContextBuilder
	{
		/**
		 * @return CreateinteractorContext
		 */
		public function build();
	}