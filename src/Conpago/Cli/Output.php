<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-09
	 * Time: 14:51
	 */

	namespace Conpago\Cli;


	class Output {

		public function write( $format, $args = null ) {
			$args = func_get_args();

			if (count($args) == 1)
				echo $args[0];
			else
				echo vsprintf($args[0], array_slice($args, 1));
		}
	}