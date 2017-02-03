<?php
    /**
     * Created by PhpStorm.
     * User: Bartosz Gołek
     * Date: 2015-10-09
     * Time: 14:51
     */

    namespace Conpago\Cli;

use Conpago\Cli\Contract\IOutput;

    /**
     * Class StreamOutput
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    class StreamOutput implements IOutput
    {

        /**
         * @var
         */
        private $outputStream;

        public function __construct($outputStream)
        {
            $this->outputStream = $outputStream;
        }

        public function write($format = null, array $args = null)
        {
            $args = func_get_args();
            $this->doWrite($format, $args);
        }

        public function writeLine($format = null, array $args = null)
        {
            $args = func_get_args();
            $this->doWrite($format, $args);
            $this->writeToOutput(PHP_EOL);
        }

        /**
         * @param $format
         * @param $args
         */
        protected function doWrite($format, array $args)
        {
            if ($format == null) {
                return;
            }

            if (!isset($args[1]) || count($args[1]) == 0) {
                $this->writeToOutput($format);
            } else {
                $this->writeToOutput(vsprintf($format, $args[1]));
            }
        }

        protected function writeToOutput($string)
        {
            fwrite($this->outputStream, $string);
        }
    }
