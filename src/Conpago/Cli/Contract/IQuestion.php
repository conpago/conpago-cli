<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 11.10.15
	 * Time: 19:12
	 */

	namespace Conpago\Cli\Contract;

	interface IQuestion
	{
		public function ask($question, array $acceptableAnswers = null, $defaultAnswer = null);
	}