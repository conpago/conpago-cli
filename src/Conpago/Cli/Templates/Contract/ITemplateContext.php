<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 13.10.15
     * Time: 23:28
     */

    namespace Conpago\Cli\Templates\Contract;

/**
     * Interface ITemplateContext
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    interface ITemplateContext
    {
        /**
         * @return string
         */
        public function getAuthor();

        /**
         * @return array
         */
        public function getVariables();
    }
