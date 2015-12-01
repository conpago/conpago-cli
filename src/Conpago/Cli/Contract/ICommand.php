<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 08.10.15
     * Time: 22:13
     */

    namespace Conpago\Cli\Contract;

/**
     * Command definition. Implement it to add new command to Cli.
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    interface ICommand
    {
        /**
         * Prints help to presenter.
         *
         * @return void
         */
        public function printHelp();

        /**
         * Returns description of command.
         *
         * @return string
         */
        public function getDescription();

        /**
         * Runs command.
         *
         * @param string[] $args
         *
         * @return void
         */
        public function run(array $args);
    }
