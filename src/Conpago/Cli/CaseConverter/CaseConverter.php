<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 13.10.15
     * Time: 22:58
     */

    namespace Conpago\Cli\CaseConverter;

/**
     * Tool class to convert string between different case types.
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    class CaseConverter
    {

        /**
         * Changes case of given string to "macro case" ie. MACRO_CASE
         *
         * @param string $string String to convert.
         *
         * @return string
         */
        public function toMacroCase($string)
        {
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
                $result .= strtoupper($char);
            }
            return $result;
        }

        /**
         * @param string $string
         *
         * @return string
         */
        public function toCamelCase($string)
        {
            $in = fopen('php://memory', 'w');
            fwrite($in, $string);
            fseek($in, 0);

            $result = "";
            $char = null;
            $last_char = null;
            while (!feof($in)) {
                $char = fread($in, 1);

                if ($char !== '_') {
                    if ($last_char === '_' or (ctype_lower($last_char) && ctype_upper($char))) {
                        $result .= strtoupper($char);
                    } else {
                        $result .= strtolower($char);
                    }
                }
                $last_char = $char;
            }
            return $result;
        }
    }
