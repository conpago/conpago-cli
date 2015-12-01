<?php
    /**
     * Created by PhpStorm.
     * User: bgolek
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

        public function write($format = null, $args = null)
        {
            $args = func_get_args();
            $this->doWrite($format, $args);
        }

        public function writeLine($format = null, $args = null)
        {
            $args = func_get_args();
            $this->doWrite($format, $args);
            $this->writeTooutput(PHP_EOL);
        }

        /**
         * @param $format
         * @param $args
         */
        protected function doWrite($format, $args)
        {
            if ($format == null) {
                return;
            }

            if (count($args) == 1) {
                $this->writeTooutput($format);
            } else {
                $this->writeTooutput(vsprintf($format, array_slice($args, 1)));
            }
        }

        protected function writeTooutput($string)
        {
            fwrite($this->outputStream, $string);
        }
    }
