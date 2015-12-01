<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 17.10.15
     * Time: 23:38
     */

    namespace Conpago\Cli\Contract;

/**
     * Represents definition of Application class presentation methods.
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    interface IApplicationPresenter
    {

        /**
         * Prints command-line tool help with commands help to output.
         *
         * @param CommandHelp[] $commands_help array of available commands help definitions to print.
         *
         * @return void
         */
        public function printHelp(array $commands_help = null);

        /**
         * Prints version of command-line tool to output.
         *
         * @return void
         */
        public function printVersion();

        /**
         * Prints command not found message to output.
         *
         * @param string $command_name
         *
         * @return void
         */
        public function printCommandNotFound($command_name);
    }
