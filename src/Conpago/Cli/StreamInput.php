<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 11.10.15
	 * Time: 16:44
	 */

	namespace Conpago\Cli;

	class Streaminput implements IInput
	{
		/**
		 * @var resource
		 */
		private $inputStream;

		/**
		 * Streaminput constructor.
		 *
		 * @param resource $i
		 */
		public function __construct($i) {

			$this->inputStream = $i;
		}

		public function readLine()
		{
			$fscanf = fscanf($this->inputStream, "%s" . PHP_EOL);
			if ($fscanf === false)
				return null;
			return $fscanf[0];
		}
	}