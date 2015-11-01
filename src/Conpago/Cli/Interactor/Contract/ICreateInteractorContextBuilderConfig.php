<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 30.10.15
	 * Time: 21:17
	 */

	namespace Conpago\Cli\Interactor\Contract;


	interface ICreateInteractorContextBuilderConfig
	{
		function getCompany();

		public function getAuthor();

		public function getProject();

		public function getSources();

		public function getTests();
	}