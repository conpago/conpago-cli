<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 17.10.15
     * Time: 23:46
     */

    namespace Conpago\Cli\Contract;

/**
     * Data structure containing Name and Help text of command.
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    class CommandHelp
    {
        /**
         * @var string Command name.
         */
        protected $name;
        /**
         * @var string Command Help text.
         */
        protected $help_text;

        /**
         * CommandHelp constructor.
         *
         * @param string $name Command name.
         * @param string $help_text Command Help text.
         */
        public function __construct($name, $help_text)
        {
            $this->name = $name;
            $this->help_text = $help_text;
        }

        /**
         * Gets command name.
         *
         * @return string
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * Gets command help text.
         *
         * @return string
         */
        public function getHelpText()
        {
            return $this->help_text;
        }
    }
