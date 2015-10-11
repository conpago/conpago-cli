<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 11.10.15
	 * Time: 19:12
	 */

	namespace Conpago\Cli;


	class Question
	{
		/**
		 * @var IInput
		 */
		private $input;
		/**
		 * @var IOutput
		 */
		private $output;

		function __construct(IInput $input, IOutput $output)
		{
			$this->input = $input;
			$this->output = $output;
		}

		public function ask($question, $acceptableAnswers = null)
		{
			$acceptableAnswers = array_slice(func_get_args(), 1);

			$this->output->writeLine($question);
			$value = null;
			do {
				$value = $this->input->readLine();
			} while ($acceptableAnswers != null && !in_array($value, $acceptableAnswers));

			return $value;
		}
	}