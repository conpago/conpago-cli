<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 13.10.15
	 * Time: 22:58
	 */

	namespace Conpago\Cli\CaseConverter;


	class CaseConverter {

		public function toMacroCase( $string ) {
			$in = fopen('php://memory', 'w');
			fwrite($in, $string);
			fseek($in, 0);

			$result = "";
			$char = null;
			while (!feof($in)) {
				$last_char = $char;
				$char = fread($in, 1);
				if (ctype_lower($last_char) && ctype_upper($char)) {
					$result .= "_";
				}
				$result .= strtoupper( $char );
			}
			return $result;
		}
	}