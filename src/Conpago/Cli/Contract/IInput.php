<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 11.10.15
	 * Time: 00:06
	 */

	namespace Conpago\Cli\Contract;

	/**
	 * Interface IInput
	 *
	 * @license MIT
	 * @author Bartosz Gołek <bartosz.golek@gmail.com>
	 */
	interface IInput
	{
		public function readLine();
	}