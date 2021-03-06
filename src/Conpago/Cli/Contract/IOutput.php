<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 11.10.15
     * Time: 00:06
     */

    namespace Conpago\Cli\Contract;

/**
     * Interface IOutput
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    interface IOutput
    {

        public function write($format = null, array $args = null);

        public function writeLine($format = null, array $args = null);
    }
