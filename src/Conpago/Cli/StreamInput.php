<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 11.10.15
	 * Time: 16:44
	 */

	namespace Conpago\Cli;

	use Conpago\Cli\Contract\IInput;

	/**
	 * Class StreamInput
	 *
	 * @license MIT
	 * @author Bartosz Gołek <bartosz.golek@gmail.com>
	 */
	class StreamInput implements IInput
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
			$input = fscanf($this->inputStream, "%s" . PHP_EOL);
			if ($input === false)
				return null;
			return $input[0];
		}
	}